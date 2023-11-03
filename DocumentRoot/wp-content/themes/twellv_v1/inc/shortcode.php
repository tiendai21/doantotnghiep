<?php
/*
 * Enable shortcode integrated for textarea field. If you wna to remove this func, change the field type to wysiwyg
 * */
function text_area_shortcode($value, $post_id, $field) {
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
add_shortcode( 'single-page-sidebar', 'singlePageSidebar' );
function singlePageSidebar( ) {
    $content = "";
    ob_start();
    get_template_part('template-parts/single-pages/sidebar');
    $content .= ob_get_contents();
    ob_end_clean();
    return $content;
}
add_shortcode( 'single-page-other', 'singlePageOther' );
function singlePageOther( ) {
    $content = "";
    ob_start();
    get_template_part('template-parts/single-pages/other');
    $content .= ob_get_contents();
    ob_end_clean();
    return $content;
}
add_shortcode( 'single-page-PR', 'singlePagePR' );
function singlePagePR( ) {
    $content = "";
    ob_start();
    get_template_part('template-parts/home/pr_top');
    $content .= ob_get_contents();
    ob_end_clean();
    return $content;
}
