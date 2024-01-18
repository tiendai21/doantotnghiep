<?php
/**
 *  acfからimgタグを返す
 * @param string $key キー
 * @param WP_Term $obj termオブジェクト
 * @param string $alt altタグ
 * @param string $class classに入れる文字
 */
function get_acf_img_tag( $key, $obj = null, $alt = '', $class = '' ) {
    $img = get_field( $key, $obj );

    $alt_str = $alt;
    if ( $alt_str === '' ) {
        $alt_str = $img['alt'];
    }
    $class_str = $class;
    if( $class != '' ) {
        $class_str = ' class="' . $class . '" ';
    }


    $img_tag = sprintf( '<img loading="lazy" src="%s" alt="%s" %s>', $img['url'] ? $img['url'] : get_stylesheet_directory_uri() . '/assets/images/bs12_noimg.jpeg', $alt_str, $class_str );
    return $img_tag;
}

/*
 * タームを指定した年別アーカイブリストを出力する
 * @link https://qiita.com/m_t_of/items/3416a2913e0d06bbbc77
 * 出力例
 * $args = array(
 *  'type'            => 'yearly',
 *  'format'          => 'html',
 *  'show_post_count' => true,
 *  'post_type'       => '{カスタム投稿名}',
 *  'taxonomy'        => '{タクソノミー名}',
 *  'slug'            => '{ターム名}'
 * );
 * wp_get_archives( $args );
 */

add_filter( 'getarchives_join', 'my_getarchives_join', 10, 2 );

function my_getarchives_join( $join, $r ) {
    global $wpdb;

    if( isset( $r['taxonomy']) ) {
        $join .= "LEFT JOIN $wpdb->term_relationships ON ( $wpdb->posts.ID = $wpdb->term_relationships.object_id )";

        $join .= "LEFT JOIN $wpdb->term_taxonomy ON ( $wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id )";

        $join .= "LEFT JOIN $wpdb->terms ON ( $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id )";
    }
    return $join;
}

add_filter( 'getarchives_where', 'my_getarchives_where', 10, 2 );

function my_getarchives_where( $where, $r ) {
    global $wpdb;

    if( isset( $r['taxonomy']) ) {
        $where .= $wpdb->prepare( "AND $wpdb->term_taxonomy.taxonomy = %s", $r['taxonomy'] );
    }

    if( isset( $r['slug'] ) ) {
        $where .= $wpdb->prepare( "AND $wpdb->terms.slug = %s", $r['slug'] );
    }
    return $where;
}

/**
 *  TinyMCEがTableタグに「width」と「height」を勝手に設定する機能を無効にする
 * @param $mceInit
 * @return mixed
 * @link https://masshiro.blog/tinymce-table-resize/
 */
function customize_tinymce_settings( $mceInit ) {
    $mceInit['table_resize_bars'] = false;
    $mceInit['object_resizing'] = "img";
    return $mceInit;
}
add_filter( 'tiny_mce_before_init', 'customize_tinymce_settings' ,0);

/**
 * アーカイブの件数を変更
 */
function change_posts_per_page($query) {
    // 管理画面、メインクエリを回避
    if(is_admin() || ! $query->is_main_query()) {
        return;
    }
    // ニュースカテゴリアーカイブ
    if($query->is_tax('news_cat')) {
        // 年別
        $year = get_query_var( 'year');
        if ( $year ){
            $query->set('posts_per_page','-1');
        }
        return;
    } elseif ( $query->is_tax( 'program_cat' ) ) {

        //↓↓ページネーション追加 add 20190822 yanagi
        $code = get_field( 'code',  $query->term );
        // 番組内アーカイブ・放送スケジュール等(番組トップと番組大カテゴリ一覧: ドラマ、スポーツ等以外)
        if ( $code == '' && $query->parent !== 0){
            $query->set( 'posts_per_page', '15' );//上記クエリ条件の変更（ページネーション設置につき21件表示）
        } else {
            // 番組トップと番組大カテゴリ一覧: ドラマ、スポーツ等
            $query->set( 'posts_per_page', '-1' );
        }
        //↑↑ページネーション追加 add 20190822 yanagi
        //$query->set( 'posts_per_page', '-1' );

        //↓↓【ザ・カセットテープ・ミュージック】番組ページ改修 ソート順変更処理 add 20200214 yanagi
        $archive_sort_asc = get_field( 'archive_sort_asc',  $query->term );
        if ( $archive_sort_asc ){
            $query->set('orderby',array('post_date'=>'ASC','ID'=>'ASC'));
            $query->set('order','ASC');
        }else{
            //↑↑【ザ・カセットテープ・ミュージック】番組ページ改修 ソート順変更処理 add 20200214 yanagi
            $query->set('orderby',array('post_date'=>'DESC','ID'=>'DESC'));
            $query->set('order','DESC');
        }
        $isBullet = get_field( 'archive_bullet_design',  $query->term );
        if ($isBullet) {
            $query->set( 'posts_per_page', '10' );
        }
    }
}
add_action('pre_get_posts','change_posts_per_page');

/**
 * S3置換ドメイン
 */
function as3cf_local_domains( $domains ) {
    $domains[] = 'www.twellv.co.jp';
    $domains[] = 'edit.twellv.co.jp';

    return $domains;
}

add_filter( 'as3cf_local_domains', 'as3cf_local_domains', 10, 1 );

// アセットURLをCDNへ向ける
function replacement_asset_url_www($content){
    $replace = array(
        'www.twellv.co.jp' => 'ram6vj87.user.webaccel.jp',
        'live-twellv.s3-ap-northeast-1.amazonaws.com' => 'ram6vj87.user.webaccel.jp',
        'edit.twellv.co.jp' => 'ram6vj87.user.webaccel.jp',
        'localhost/twellv-wp/DocumentRoot' => 'ram6vj87.user.webaccel.jp',
    );
    $content = str_replace(array_keys($replace), $replace, $content);
    return $content;
}
function replacement_asset_url_edit($content){
    $replace = array(
        'edit.twellv.co.jp' => 'ram6vj87.user.webaccel.jp'
    );
    $content = str_replace(array_keys($replace), $replace, $content);
    return $content;
}
//For local env
function replacement_asset_url_www_local($content){
    $local_url = (TWELLV_LOCAL) ? TWELLV_LOCAL : 'localhost/twellv-wp/DocumentRoot';
    $replace = array(
        $local_url => 'ram6vj87.user.webaccel.jp',
    );
    $content = str_replace(array_keys($replace), $replace, $content);
    return $content;
}
// PRD環境で発火
if($_SERVER["HTTP_HOST"]=='www.twellv.co.jp'){
    add_filter('wp_get_attachment_url', 'replacement_asset_url_www',1);
}
// Edit環境で発火
if($_SERVER["HTTP_HOST"]=='edit.twellv.co.jp'){
    add_filter('wp_get_attachment_url', 'replacement_asset_url_edit',1);
}
// Local environment
if($_SERVER["HTTP_HOST"]=='localhost' || TWELLV_LOCAL ){
    add_filter('wp_get_attachment_url', 'replacement_asset_url_www_local',1);
}

// 20200619 agui add for dev environment
function replacement_asset_url_dev($content){
    $replace = array(
        'dev.twellv.co.jp' => 'intbqdkk.user.webaccel.jp',
        'live-twellv.s3-ap-northeast-1.amazonaws.com' => 'intbqdkk.user.webaccel.jp'
    );
    $content = str_replace(array_keys($replace), $replace, $content);
    return $content;
}
if($_SERVER["HTTP_HOST"]=='dev.twellv.co.jp'){
    add_filter('wp_get_attachment_url', 'replacement_asset_url_dev',1);
}

add_filter( 'wp_calculate_image_srcset_meta', '__return_null' );

function replacement_img_url_dev($content){
//var_dump($content);
    $replace = array(
        'live-twellv.s3-ap-northeast-1.amazonaws.com' => 'intbqdkk.user.webaccel.jp',
        'src="https://dev.twellv.co.jp/wp-content/uploads/' => 'src="https://intbqdkk.user.webaccel.jp/wp-content/uploads/',
        '<img src="https://dev.twellv.co.jp/wp-content/uploads/' => '<img src="https://intbqdkk.user.webaccel.jp/wp-content/uploads/',
        '<img src="/wp-content/uploads/' => '<img src="https://intbqdkk.user.webaccel.jp/wp-content/uploads/',
    );
    $content = str_replace(array_keys($replace), $replace, $content);
    return $content;
}

if($_SERVER["HTTP_HOST"]=='dev.twellv.co.jp'){
    add_filter( 'acf_the_content', 'replacement_img_url_dev' );
    add_filter( 'acf/load_value', 'replacement_img_url_dev' );
}

function replacement_img_url_edit($content){
    $replace = array(
        '<img src="https://edit.twellv.co.jp/wp-content/uploads/' => '<img src="https://ram6vj87.user.webaccel.jp/wp-content/uploads/',
        '<img src="/wp-content/uploads/' => '<img src="https://ram6vj87.user.webaccel.jp/wp-content/uploads/',
    );
    $content = str_replace(array_keys($replace), $replace, $content);
    return $content;
}

if($_SERVER["HTTP_HOST"]=='edit.twellv.co.jp'){
    add_filter( 'acf_the_content', 'replacement_img_url_edit' );
    add_filter( 'acf/load_value', 'replacement_img_url_edit' );
}

function replacement_img_url_www($content){
    /*
        $replace = array(
            'live-twellv.s3-ap-northeast-1.amazonaws.com' => 'ram6vj87.user.webaccel.jp',
            'src="https://www.twellv.co.jp/wp-content/uploads/' => 'src="https://ram6vj87.user.webaccel.jp/wp-content/uploads/',
            'src="https://edit.twellv.co.jp/wp-content/uploads/' => 'src="https://ram6vj87.user.webaccel.jp/wp-content/uploads/',
            '<img src="https://edit.twellv.co.jp/wp-content/uploads/' => '<img src="https://ram6vj87.user.webaccel.jp/wp-content/uploads/',
            '<img src="https://www.twellv.co.jp/wp-content/uploads/' => '<img src="https://ram6vj87.user.webaccel.jp/wp-content/uploads/',
            '<img src="/wp-content/uploads/' => '<img src="https://ram6vj87.user.webaccel.jp/wp-content/uploads/',
            'src="/wp-content/uploads/' => 'src="https://ram6vj87.user.webaccel.jp/wp-content/uploads/',
        );
    */
    $replace = array(
        'live-twellv.s3-ap-northeast-1.amazonaws.com' => 'ram6vj87.user.webaccel.jp',
        'https://edit.twellv.co.jp/wp-content/uploads/' => 'https://ram6vj87.user.webaccel.jp/wp-content/uploads/',
        'https://www.twellv.co.jp/wp-content/uploads/' => 'https://ram6vj87.user.webaccel.jp/wp-content/uploads/',
        '<img src="/wp-content/uploads/' => '<img src="https://ram6vj87.user.webaccel.jp/wp-content/uploads/',
        'src="/wp-content/uploads/' => 'src="https://ram6vj87.user.webaccel.jp/wp-content/uploads/',
    );
    $content = str_replace(array_keys($replace), $replace, $content);
    return $content;
}

if($_SERVER["HTTP_HOST"]=='www.twellv.co.jp'){
    add_filter( 'acf_the_content', 'replacement_img_url_www' );
    add_filter( 'acf/load_value', 'replacement_img_url_www' );
}
// Local environment
if($_SERVER["HTTP_HOST"]=='localhost' || TWELLV_LOCAL ){
    add_filter( 'acf_the_content', 'replacement_img_url_www' );
    add_filter( 'acf/load_value', 'replacement_img_url_www' );
}
