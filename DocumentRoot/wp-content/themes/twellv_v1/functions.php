<?php
require get_template_directory() . '/inc/clean_head.php';
require get_template_directory() . '/inc/theme-setup.php';
require get_template_directory() . '/inc/theme-rewrite.php';
require get_template_directory() . '/inc/theme-json-ld.php';
require get_template_directory() . '/inc/templates-common.php';
require get_template_directory() . '/inc/templates-program.php';
require get_template_directory() . '/inc/templates-news.php';

add_theme_support('post-thumbnails');
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
function theme_enqueue_styles()
{
    $css_unti_cache = '231012';
    // Get the theme data
    $the_theme = wp_get_theme();
    wp_enqueue_style('wp_style', get_stylesheet_uri());
    wp_enqueue_style('main-styles', get_stylesheet_directory_uri() . '/assets/css/style.css', array(), $css_unti_cache);

    wp_enqueue_style('slick-theme-styles', get_stylesheet_directory_uri() . '/assets/libs/css/slick-theme.css', array(), $css_unti_cache);

    wp_enqueue_style('slick-styles', get_stylesheet_directory_uri() . '/assets/libs/css/slick.css', array(), $css_unti_cache);

    wp_enqueue_script('jquery-min-js', get_stylesheet_directory_uri() . '/assets/libs/js/jquery.min.js', array(), $css_unti_cache);

    wp_enqueue_script('jquery-validate-min-js', get_stylesheet_directory_uri() . '/assets/libs/js/jquery.validate.min.js', array(), $css_unti_cache);

    wp_enqueue_script('slick-min-js', get_stylesheet_directory_uri() . '/assets/libs/js/slick.min.js', array(), $css_unti_cache);

    wp_enqueue_script('main-js', get_stylesheet_directory_uri() . '/assets/js/main.js', array(), $css_unti_cache);

    if(is_archive("program")) {
        wp_enqueue_script('single-js', get_stylesheet_directory_uri() . '/assets/js/single.js', array(), $css_unti_cache);
    }
}

register_nav_menus(array(
    'main-menu' => 'nav-main',
    'menu-footer' => 'nav-footer',
));

add_filter('body_class', 'twellv_class');
function twellv_class($classes)
{
    if (is_page_template('pages_template/page_contact.php')) {
        $classes[] = 'contact';
    }
    if (is_archive('program/program-top.php')) {
        $classes[] = 'program_detail';
    }
    $classes[] = '';
    return $classes;
}

/**
 * String length
 */

function trim_string_length($string, $limit = 40, $leader = "…")
{
    if (mb_strlen($string, 'UTF-8') > $limit) {
        $string = mb_substr($string, 0, $limit, 'UTF-8');
        return $string . $leader;
    } else {
        return $string;
    }
}