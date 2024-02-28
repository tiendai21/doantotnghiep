<?php /* Nowonair表示処理 */ ?>

<?php
// エラーを出力する
//ini_set("display_errors", 1);
//error_reporting(E_ALL);

date_default_timezone_set('Asia/Tokyo');
/**
 * ***************************************************************************
 *
 * function
 *
 * **************************************************************************
 */
function var_dump_pre($mixed = null)
{
    echo '<pre>';
    var_dump($mixed);
    echo '</pre>';
    return null;
}

/**
 * 複数並列で実行します。
 * 引数のurlListにアクセスしたいURLの一覧を配列で入れておきます。
 */
function multi_curl_execute($urlList, $timeout, $referer_url)
{

    // なにもないときは戻る。
    if (empty($urlList)) {
        return false;
    }

    // まずはMultiCurlを実行するための配列を作る。
    $chList = array();
    foreach ($urlList as $url) {
        // echo $url;
        // CURL 初期化
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_REFERER, $referer_url);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $context);

        $chList[] = $ch;
    }

    // 存在しなければ戻る
    if (empty($chList)) {
        return false;
    }

    // マルチ cURL ハンドルを作成します
    $mh = curl_multi_init();
    foreach ($chList as $ch) {
        curl_multi_add_handle($mh, $ch);
    }

    $running = null;
    // 全部実行します。すべて実行し終わるまで待ちます。
    do {
        curl_multi_exec($mh, $running);
        // usleep(5);
    } while ($running > 0);

    // 結果の取得
    $returnList = array();
    foreach ($chList as $key => $ch) {
        $returnText = curl_multi_getcontent($ch);
        // echo $returnText;
        $returnList[] = json_decode($returnText, true);
    }

    // ハンドルを閉じます
    foreach ($chList as $ch) {
        curl_multi_remove_handle($mh, $ch);
    }
    curl_multi_close($mh);

    // 結果が戻ります。
    return $returnList;
}

/**
 * ***************************************************************************
 *
 * set
 *
 * **************************************************************************
 */
$context = stream_context_create(array(
    'http' => array(
        'ignore_errors' => true, // 403にならないようにするおまじない
        'header' => "Referer: http://renew.www.twellv.co.jp.5639.jp/\r\n" // リファラー設定
        // 'header' => "Referer: http://www.twellv.co.jp/\r\n" // リファラー設定(本番用)
    )
));

$referer_url = "http://renew.www.twellv.co.jp.5639.jp";
$referer_url = htmlspecialchars_decode($referer_url);

// 曜日セット
$week = array(
    "0" => "日",
    "1" => "月",
    "2" => "火",
    "3" => "水",
    "4" => "木",
    "5" => "金",
    "6" => "土"
);

$tmp_data = array();
$urlList = array();
$data_array = array();
$timeout = 20;
$html = "";
$modal = "";
$program_s = "";
$program_e = "";
$program_w_str = "";
$bangumi_s_data = array(); // 放送予定番組
$bangumi_e_data = array(); // 放送中/放送終了番組
$modal_s_data = array(); // 放送予定番組 for modal
$modal_e_data = array(); // 放送中/放送終了番組 for modal

// 現在日付取得 形式:yyyyMMddHHmmss
$now_time = date("YmdHis");

/**
 * ***************************************************************************
 *
 * processe / output
 *
 * **************************************************************************
 */

/**
 * IPG APIでデータを取得
 */
$nowonair_data = file_get_contents("http://rakuraku2.bangumi.org/nowonair?channelIndex=1", false, $context);
$nowonair_data_array = json_decode($nowonair_data, true);

if (is_array($nowonair_data_array["programs"])) {

    foreach ($nowonair_data_array["programs"] as $key => $nowonair_rec) {
        $program_id = $nowonair_rec["pid"]; // 番組ID
        $url = "http://rakuraku2.bangumi.org/master?channelIndex=1&programId=" . $program_id;
        $urlList[] = htmlspecialchars_decode($url);
    }
    $data_array = multi_curl_execute($urlList, $timeout, $referer_url);
}

// var_dump_pre($program_data_array);
// exit;
/**
 * 番組データを加工
 */
if (is_array($nowonair_data_array["programs"])) {

    foreach ($nowonair_data_array["programs"] as $key => $nowonair_rec) {

//         Hoangvv::var_dump($nowonair_rec);

        $tmp = trim($nowonair_rec["title"][0]["string"]);
        $tmp = trim(mb_convert_kana($tmp, "s", 'UTF-8'));

        if (empty($tmp) || $tmp == "放送休止") {
            continue;
        }

        $program_id = $nowonair_rec["pid"]; // 番組ID
        $title = $nowonair_rec["title"][0]["string"]; // タイトル設定
        $s_time = date('H:i', strtotime($nowonair_rec["s"])); // 放送開始時刻 start air
        $e_time = date('H:i', strtotime($nowonair_rec["e"])); // 放送終了時刻 end air
        $s_time_modal = date('Y年m月d日 ', strtotime($nowonair_rec["s"])); // 放送終了時刻 2022年10月28日
        $e_time_modal = date('Y年m月d日 ', strtotime($nowonair_rec["e"])); // 放送終了時刻 2022年10月28日
        $description = $nowonair_rec["dt"]; // 番組概要

        // 画像情報
        if (isset($nowonair_rec["pictures"][0])) {

            $picture = $nowonair_rec["pictures"][0]["url"];
        } else {

            $picture = esc_attr((get_the_post_thumbnail_url())) !== "" ? esc_attr((get_the_post_thumbnail_url())) : get_stylesheet_directory_uri() . '/assets/images/bs12_noimg.jpeg';
        }
        // URL設定
        if (isset($nowonair_rec["rurls"][0]["url"])) {

            $url = $nowonair_rec["rurls"][0]["url"];
        } else {

            $url = "";
        }

        // 番組マスタ取得
        $program_s = "";
        $program_e = "";
        $program_w_str = "";

        // echo "-------------------------------------------------------------------\n";
        // var_dump_pre($program_data_array);

        if (!empty($data_array[$key])) {
            $program_data_array = $data_array[$key];
            // 番組マスタの情報をセット
            if (!empty($program_data_array["s"])) {
                $program_s = substr($program_data_array["s"], 0, 2) . ":" . substr($program_data_array["s"], 2, 2) . "〜";
            } // 放送開始時刻
            if (!empty($program_data_array["e"])) {
                $program_e = $program_data_array["e"];
            } // 放送終了時刻

            if (!empty($program_data_array["w"])) {
                $program_w = array();
                // 放送曜日
                foreach ($program_data_array["w"] as $key => $w) {
                    if ($w == true) { // 放送する。

                        if ($key != 0 && $key != 6) { // 日、土曜日以外

                            if ($program_data_array["w"][$key - 1] == true && $program_data_array["w"][$key + 1] == true) {

                                if ($program_w[$key - 1] != "〜" && $program_w[$key - 1] != "") { // 1つ前が～なら空白
                                    $program_w[$key] = "〜";
                                } else {
                                    $program_w[$key] = "";
                                }
                            } else {
                                $program_w[$key] = $week[$key];
                            }
                        } else {
                            $program_w[$key] = $week[$key];
                        }
                    }
                    // 文字セット判定
                    $program_w_str = "";
                    foreach ($program_w as $key => $char) {
                        $program_w_str .= $char;
                    }
                }
            }
        }
        if (date(null) > strtotime($nowonair_rec["s"])) {
            $modal_item_time = $e_time_modal;
        } else {
            $modal_item_time = $s_time_modal;
        }
        // 放送予定Item要素作成
        $tmp_data = <<< HTML
<div class="item_slide">
    <a href="{$url}">
        <div class="thumb">
            <img src="{$picture}" width="338" height="198" alt="{$title}のサムネイル">
        </div>
        <div class="txt_desp">
            <h4>{$title}</h4>
            <p>{$description}</p>
        </div>
    </a>
</div>        

HTML;
        $modal_data = <<< HTML
<li>
    <a href="{$url}">
        <div class="thumb">
            <img src="{$picture}" width="338" height="198" alt="{$title}のサムネイル">
        </div>
        <div class="txt_desp">
            <h4>{$title}</h4>
            <p>{$description}</p>
            <span>{$modal_item_time}放送</span>
        </div>
    </a>
</li>   

HTML;
        // 放送順にソートする。
        if ($now_time > $nowonair_rec["e"]) { // 放送終了
            $bangumi_e_data[] = $tmp_data;
            $modal_e_data[] = $modal_data;
        } elseif ($nowonair_rec["s"] <= $now_time && $now_time <= $nowonair_rec["e"]) { // 放送中
            $bangumi_s_data[] = $tmp_data;
            $modal_s_data[] = $modal_data;
        } elseif ($nowonair_rec["s"] > $now_time && $now_time < $nowonair_rec["e"]) { // 放送予定
            $bangumi_s_data[] = $tmp_data;
            $modal_s_data[] = $modal_data;
        }
    }
}

foreach ($bangumi_s_data as $key => $d) {
    $html .= $d;
}
foreach ($bangumi_e_data as $key => $d) {
    $html .= $d;
}
//reverse slide
foreach (array_reverse($bangumi_e_data) as $key => $d) {
    $html_r .= $d;
}
foreach (array_reverse($bangumi_s_data) as $key => $d) {
    $html_r .= $d;
}
foreach ($modal_s_data as $key => $d) {
    $modal .= $d;
}
foreach ($modal_e_data as $key => $d) {
    $modal .= $d;
}

?>

<section class="section" id="program_list">
    <div class="inner">
        <div class="tlt_section">
            <h2>放送中の番組</h2>
            <div class="btn_more">
                <span>すべて見る</span>
            </div>
        </div>
        <div class="program_slide is_loading slide_list">
            <?php echo $html?>
        </div>
        <div class="program_slide is_loading slide_list">
            <?php echo $html_r?>
        </div>
        <?php get_template_part('template-parts/home/modal_category', null, array('modal' => $modal)); ?>
    </div>
</section>