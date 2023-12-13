<?php
/* オンエア情報を表示 */
if (get_sub_field('onair_info_switch')) {

    // 番組ターム取得
    $terms = get_the_terms(get_the_ID(), 'program_cat');
    $program_term = null;
    $this_term = $terms[0];
    foreach ($terms as $t) {
        $code = get_field('code', $t);
        if ((int)$code > 0) {
            $program_term = $t;
        } else {
            $this_term = $t;
        }
    }
    if ($program_term === null) {
        $parent_term = get_term_by('id', $this_term->parent, 'program_cat');
        $code = get_field('code', $parent_term);
        //if ( get_field( 'code', $parent_term) > 0 ) {
        //   $program_term = $parent_term;
        //}
    }
    ?>

    <!-- start -->
    <?php
    $context = stream_context_create(array(
        'http' => array(
            'ignore_errors' => true,                                            // 403にならないようにするおまじない
//            'header' => "Referer: http://renew.www.twellv.co.jp.5639.jp/\r\n"    // リファラー設定
            'header' => "Referer: http://www.twellv.co.jp/"                    // リファラー設定(本番用)
        )
    ));

    $program_id = $code;

//if( get_field( 'code', $program_term ) ) {
//	$program_id = get_field( 'code', $program_term );
//}

//if(!empty($_GET["mode"])){
//	$program_id = @$_GET["pid"];
//}
    $hasEpisode = false;
    $html = <<< HTML
<div class="no-episode"><h4>放送日程が決まり次第、お知らせ致します。 </h4></div>
HTML;
    if (!empty($program_id)) {
        $json_data = file_get_contents("http://rakuraku2.bangumi.org/programlist?channelIndex=1&programId=" . $program_id, false, $context);
        $data_r = json_decode($json_data, true);
        if (is_array($data_r["programs"])) {
            $hasEpisode = true;
            $week = array("0" => "日", "1" => "月", "2" => "火", "3" => "水", "4" => "木", "5" => "金", "6" => "土");

            $tmp_data = "";
            foreach ($data_r["programs"] as $v) {
                $tmp = trim($v["title"][0]["string"]);
                $tmp = trim(mb_convert_kana($tmp, "s", 'UTF-8'));
                if (empty($tmp) || $tmp == "放送休止") {
                    continue;
                }
                $onair_day = $onair_w = $onair_startdate = $onair_enddate = "";

                $onair_day = date("n月j日", strtotime($v["s"]));
                $onair_week = "(" . $week[date("w", strtotime($v["s"]))] . ")";
                $onair_startdate = date("H:i", strtotime($v["s"]));
                $onair_enddate = date("H:i", strtotime($v["e"]));
                $image = $v['pictures'][0]['url'] ? 'https:' . $v['pictures'][0]['url'] : get_stylesheet_directory_uri() . '/assets/images/bs12_noimg.jpeg';
                $url = $v['rurls'][1]['url'];
                $tmp_data .= <<< HTML
<li>
    <div class="tlt">
        <div class="thumb">
            <img class="util_pc" src={$image} alt="">
            <img class="util_sp" src={$image} alt="">
        </div>
        <div class="txt_desp">
            <h4>{$v["title"][0]["string"]}</h4>
            <span>{$onair_day} {$onair_week} {$onair_startdate} ～ {$onair_enddate}</span>
            <div class="util_pc">
                <p>{$v["dt"]}</p>
                    <a href={$url}>
                        <div class="btn_more">
                                <span>詳しく見る</span>
                        </div>
                    </a>
            </div>
        </div>
    </div>
    <div class="util_sp">
        <p>{$v["dt"]}</p>
        <div class="btn_more">
            <span>詳しく見る</span>
        </div>
    </div>
</li>
HTML;
            }
            if (!empty($tmp_data)) {
                $html = $tmp_data;
            }
        }
    }

    ?>

    <!-- end -->

    <?php
} ?>
<section class="section" id="episode">
    <div class="inner">
        <div class="list_episode">
            <ul>
                <?php echo $html; ?>
            </ul>
        </div>
        <?php if ($hasEpisode): ?>
            <div class="btn_all">
                <span>もっと見る</span>
            </div>
        <?php endif; ?>
    </div>
</section>
