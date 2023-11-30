<?php
/*
 * Enable shortcode integrated for textarea field. If you wna to remove this func, change the field type to wysiwyg
 * */
function text_area_shortcode($value, $post_id, $field)
{
    if (is_admin()) {
        // don't do this in the admin
        // could have unintended side effects

        // revision: return $value because we don't want to miss on the textarea content
        return $value;
    }

    return do_shortcode($value);
}
add_filter('acf/load_value/type=textarea', 'text_area_shortcode', 10, 3);

/*
 *  Shortcode
 * */
add_shortcode('single-page-sidebar', 'singlePageSidebar');
function singlePageSidebar()
{
    $content = "";
    ob_start();
    get_template_part('template-parts/single-pages/sidebar');
    $content .= ob_get_contents();
    ob_end_clean();
    return $content;
}
add_shortcode('single-page-other', 'singlePageOther');
function singlePageOther($args)
{
    $content = "";
    ob_start();
    get_template_part('template-parts/home/other_top', null, array('type' => $args['type'], 'hideSocial' => $args['social']));
    $content .= ob_get_contents();
    ob_end_clean();
    return $content;
}
add_shortcode('single-page-PR', 'singlePagePR');
function singlePagePR()
{
    $content = "";
    ob_start();
    get_template_part('template-parts/home/pr_top');
    $content .= ob_get_contents();
    ob_end_clean();
    return $content;
}
add_shortcode('single-ranking', 'singleRanking');
function singleRanking($args)
{
    $content = "";
    ob_start();
    get_template_part('template-parts/ranking/ranking', null, array('cat' => $args['cat'], 'title' => $args['title'], 'sns' => false));
    $content .= ob_get_contents();
    ob_end_clean();
    return $content;
}
add_shortcode('announce-list', 'announceList');
function announceList()
{
    $content = "";
    ob_start();
    get_template_part('template-parts/oshirase-announce-list');
    $content .= ob_get_contents();
    ob_end_clean();
    return $content;
}
add_shortcode('single-banner-double-slide', 'doubleSlide');
function doubleSlide()
{
    $content = "";
    ob_start();
    get_template_part('template-parts/banner-double-slide');
    $content .= ob_get_contents();
    ob_end_clean();
    return $content;
}
/**
 *   Test program schedule table
 **/
add_shortcode('test-rakuraku', 'testRaku');
function testRaku()
{
    $url = 'https://rakuraku2.bangumi.org/tablePage';
    //pc
    $data = 'platform=D&isSamplePage=false&referer=www.twellv.co.jp&channelIndex=1&fromArrow=&getPrevious=&getNext=';
    // sp
    // $data = 'platform=M&isSamplePage=false&referer=www.twellv.co.jp&channelIndex=1&fromArrow=&getPrevious=&getNext=&currentDataStartingDate=20231106&currentDataEndingDate=20231112';

    $headers = array(
        'authority: rakuraku2.bangumi.org',
        'accept: */*',
        'accept-language: vi,en;q=0.9,ja;q=0.8,en-US;q=0.7',
        'content-type: application/x-www-form-urlencoded; charset=UTF-8',
        'origin: https://www.twellv.co.jp',
        'referer: https://www.twellv.co.jp/',
        'sec-ch-ua: "Chromium";v="118", "Microsoft Edge";v="118", "Not=A?Brand";v="99"',
        'sec-ch-ua-mobile: ?0',
        'sec-ch-ua-platform: "macOS"',
        'sec-fetch-dest: empty',
        'sec-fetch-mode: cors',
        'sec-fetch-site: cross-site',
        'user-agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Edg/118.0.2088.76',
    );

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'cURL Error: ' . curl_error($ch);
    }

    curl_close($ch);

    return $response;
}
