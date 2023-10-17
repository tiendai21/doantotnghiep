<?php

/**
 * WPのURL自動補完機能を無効化
 */
function disable_redirect_canonical( $redirect_url ) {
  if( is_404() ) {
    return false;
  }
  return $redirect_url;
}
add_filter( 'redirect_canonical', 'disable_redirect_canonical' );


/**
 * 番組ページにおいて、ターム名が適当な場合（実在しないURLがリクエストされた場合）、正規URLにリダイレクト
 */
add_action( 'template_redirect', function() {

    // 変則URLの正規化 20201119 agui
    if (preg_match("/^(\/program\/sports\/baseball\/)/",$_SERVER['REQUEST_URI']) && ($_SERVER['QUERY_STRING'] == '%200%200%201%200%200%200%203%200%200%204%E8%A5%BF%E6%AD%A6%202%20%200%201%200%200%200%200%204%20X%207%E6%9D%B1%E6%B5%9C%E3%80%81%E5%98%89%E5%BC%A5%E7%9C%9F%E3%80%81%E5%B2%A9%E5%B5%9C%20-')){
        unset($_SERVER['QUERY_STRING']);
        wp_redirect( "/404/", 404 );
        die();
    }

    if (preg_match("/^(\/program\/sports\/baseball\/)/",$_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], "欧力士%200%200%200%200%200%200%202%200%200%202西%20武%20%200%200%200%202%200%201%200%200%20X%203アルバース、神戸")){
        wp_redirect( "/404/", 404 );
        die();
    }

    if (preg_match("/^(\/program\/sports\/baseball\/)/",$_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], "ソフトバンク%200%200%200%200%200%200%200%200%200%20%200西%20武%200%200%200%200%200%200%200%202%20X%202スアレス")){
        wp_redirect( "/404/", 404 );
        die();
    }
    
    if (preg_match("/^(\/program\/sports\/baseball\/)/",$_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], "ハム%200%201%200%200%203%200%201%201%200%206西武%201%20%204%200%200%202%200%204%200%20X%2011加藤、西村、生田")){
        wp_redirect( "/404/", 404 );
        die();
    }

    if (strpos($_SERVER['REQUEST_URI'], "Cleaning%20%20Up")){
        wp_redirect( "/404/", 404 );
        die();
    }

    // 番組タームの場合
    $object = get_queried_object();
    if($object->taxonomy == "program_cat") {
        $request_url  = is_ssl() ? 'https://' : 'http://';
        $request_url .= $_SERVER['HTTP_HOST'];
        $request_url .= $_SERVER['REQUEST_URI'];
        $redirect_url  = get_term_link( $object->term_id, "program_cat" );
        if ( ! empty( $_SERVER['QUERY_STRING'] ) ) {
            $redirect_url .= '?' . $_SERVER['QUERY_STRING'];
        }
        /* ページネーションのURL時リダイレクト回避する */
        /* add 20190808 yanagi ↓↓ */
        $arry_request_url = parse_url($request_url);
        $arry_path = explode("/",$arry_request_url["path"]);
        if($arry_path[count($arry_path) - 3] == "page"){
        	$redirect_url = $redirect_url."page/".$arry_path[count($arry_path) - 2]."/";
        }
        /* add 20190808 yanagi ↑↑ */
        
        if ( strcasecmp( $request_url, $redirect_url )) {
            wp_redirect( $redirect_url, 301 );
            die();
        }
    }

    // 番組記事の場合
    global $post;
    if ( ! is_singular( "program" ) ) return;
    if ( get_post_status( get_the_ID() ) != 'publish' ) return;
    if ( get_post_format( get_the_ID() ) != ('gallery' || 'chat')) return;//edit ishizaki20200512 【施策ID：52-6】ネガ排除
    $request_url  = is_ssl() ? 'https://' : 'http://';
    $request_url .= $_SERVER['HTTP_HOST'];
    $request_url .= $_SERVER['REQUEST_URI'];
    $redirect_url  = get_permalink();
    if ( ! empty( $_SERVER['QUERY_STRING'] ) ) {
        $redirect_url .= '?' . $_SERVER['QUERY_STRING'];
    }
    if ( strcasecmp( $request_url, $redirect_url )) {
        wp_redirect( $redirect_url, 301 );
        die();
    }

});


/**
 * 番組用taxonomy program_catをurlに入れなくても テンプレートが当たるように変更
 * program/以下2階層目まで。
 * @link https://sole-color-blog.com/blog/1187/
 */
add_action( 'generate_rewrite_rules', 'bs12_custom_rewrite_rules' );

function bs12_custom_rewrite_rules( $wp_rewrite  ) {
    $base_terms = array_map( function( $t ) { return $t->slug; },
        get_terms( 'program_cat', [ 'parent' => 0, 'hide_empty' => 0 ] ) );

    /* 第一階層のprogram_cat のみを rewrite_rule用 文字列に展開 */
    $base_terms_key = implode( '|', $base_terms ); // sports|dorama|korea|china|tabi .....

    $new_rules = [];
    $new_rules['program/(' . $base_terms_key . ')/?$'] = 'index.php?taxonomy=program_cat&term=$matches[1]';
    $new_rules['program/(' . $base_terms_key . ')/([a-z0-9_-]+)/?$'] = 'index.php?taxonomy=program_cat&term=$matches[2]';
    // 番組直下の固定ページは page- とする
    $new_rules['program/(' . $base_terms_key . ')/[a-z0-9_-]+/(page-.+?)/?$'] = 'index.php?post_type=program&name=$matches[2]';
	// 記事(idのみ)と区別するため、子カテゴリ名は戦闘文字アルファベット必須
    $new_rules['program/(' . $base_terms_key . ')/[a-z0-9_-]+/([a-z]+[a-z0-9_-]+)/?$'] = 'index.php?taxonomy=program_cat&term=$matches[2]';
	//番組アーカイブのページャー追加 add 20190808 yanagi
	$new_rules['program/(' . $base_terms_key . ')/[a-z0-9_-]+/([a-z]+[a-z0-9_-]+)/page/([0-9]{1,})/?$'] = 'index.php?taxonomy=program_cat&term=$matches[2]&paged=$matches[3]';
    // 終了番組一覧
    $new_rules['program/archive/?$'] = 'index.php?post_type=program&onair_status=finished';

    // news_catを無くす
    $news_cat_keys = 'whatsnew|release';
    $new_rules['news/(' . $news_cat_keys . ')/?$'] = 'index.php?taxonomy=news_cat&term=$matches[1]';
    $new_rules['news/(' . $news_cat_keys . ')/date/([0-9]{4})/?$'] = 'index.php?taxonomy=news_cat&term=$matches[1]&year=$matches[2]';

    // var_dump( $new_rules );
    $wp_rewrite->rules = array_merge($new_rules, $wp_rewrite->rules);
}

/**
 * /program/program_cat/ からprogram_catを削除
 */
function bs12_program_custom_term_link( $termlink, $term, $taxonomy ) {
    $link = $termlink;

    if ( preg_match( "/\/program\/program_cat\/.*/", $termlink ) ) {
        $link = str_replace( '/program/program_cat/', '/program/', $termlink );
    } elseif( preg_match( "/\/news\/news_cat\/.*/", $termlink )) {
        $link = str_replace( '/news/news_cat/', '/news/', $termlink );
    }
    return $link;
}
add_filter( 'term_link', 'bs12_program_custom_term_link' , 10, 3 );

/**
 * パラメーター追加
 */
function add_query_vars_filter( $vars ){
  $vars[] = "onair_status";
  return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );
