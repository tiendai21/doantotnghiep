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
            'header' => "Referer: http://renew.www.twellv.co.jp.5639.jp/\r\n"    // リファラー設定
//		'header' => "Referer: http://www.twellv.co.jp/\r\n"					// リファラー設定(本番用)
        )
    ));

    $program_id = $code;

//if( get_field( 'code', $program_term ) ) {
//	$program_id = get_field( 'code', $program_term );
//}

//if(!empty($_GET["mode"])){
//	$program_id = @$_GET["pid"];
//}
    $html = <<< HTML
<div class="gray-box"><h4 class="heading-title_lv3">放送日程が決まり次第、お知らせ致します。 </h4></div>
HTML;
    if (!empty($program_id)) {
        $json_data = file_get_contents("http://rakuraku2.bangumi/programlist?channelIndex=1&programId=" . $program_id, false, $context);
        $data_r = json_decode($json_data, true);

        if (is_array($data_r["programs"])) {
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

                $tmp_data .= <<< HTML
	<div class="gray-box">
		<h4 class="heading-title_lv3">{$v["title"][0]["string"]}</h4>
		<p>{$v["dt"]}</p>
		<p>{$onair_day} {$onair_week} {$onair_startdate} ～ {$onair_enddate}</p>
	</div>
HTML;
            }
            if (!empty($tmp_data)) {
                $html = $tmp_data;
            }
        }
    }
    echo $html;
    ?>

    <!-- end -->

    <?php
}
