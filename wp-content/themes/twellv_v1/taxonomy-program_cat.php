<?php
$term_obj = get_queried_object() ;

/* 同じslugがつづくurlがあるようなので、正しいurlにリダイレクト */
$check_url_format = sprintf( '/\/%s\/%s\//', $term_obj->slug, $term_obj->slug );
if( preg_match( $check_url_format, $_SERVER['REQUEST_URI'] ) ) {
    wp_safe_redirect( get_term_link( $term_obj ), 301 );
    exit;
}
get_header();
?>
<?php
// echo 'taxonomy-program_cat.php:番組カテゴリページ';

if ( $term_obj ) {
    $code = get_field( 'code',  $term_obj );
    if ( $code != '' ){
        // 番組トップ
        get_template_part( 'template-parts/program', 'top' );
    } elseif( $term_obj->parent === 0) {
        // 番組大カテゴリ一覧: ドラマ、スポーツ等
		if ( $term_obj->slug === 'entertainment' ) {
			get_template_part( 'template-parts/program', 'list-entertainment' );
		} else {
			get_template_part( 'template-parts/program', 'list' );
		}
    } else {
        // 番組内アーカイブ・放送スケジュール等
        get_template_part( 'template-parts/program/archive', 'lineup' );
    }
}
?>
</div><!-- #tpl-contents -->
<?php get_term_category_link(); ?>
<?php
get_footer();
