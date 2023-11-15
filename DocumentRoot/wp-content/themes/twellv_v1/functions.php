<?php
require get_template_directory() . '/inc/clean_head.php';
require get_template_directory() . '/inc/theme-setup.php';
require get_template_directory() . '/inc/theme-rewrite.php';
require get_template_directory() . '/inc/theme-json-ld.php';
require get_template_directory() . '/inc/templates-common.php';
require get_template_directory() . '/inc/templates-program.php';
require get_template_directory() . '/inc/templates-news.php';
require get_template_directory() . '/inc/shortcode.php';

add_theme_support('post-thumbnails');
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
function theme_enqueue_styles()
{
//    $css_unti_cache = '231012';
    // Get the theme data
    $the_theme = wp_get_theme();
    wp_enqueue_style('wp_style', get_stylesheet_uri());
    wp_enqueue_style('main-styles', get_stylesheet_directory_uri() . '/assets/css/style.css', array(), $css_unti_cache);
    if (is_page_template() || is_tax('program_cat')) {
        wp_enqueue_style('main-styles_2', get_stylesheet_directory_uri() . '/assets/css/style_old.css', array(), $css_unti_cache);
    }

    wp_enqueue_style('slick-theme-styles', get_stylesheet_directory_uri() . '/assets/libs/css/slick-theme.css', array(), $css_unti_cache);

    wp_enqueue_style('slick-styles', get_stylesheet_directory_uri() . '/assets/libs/css/slick.css', array(), $css_unti_cache);

    wp_enqueue_script('jquery-min-js', get_stylesheet_directory_uri() . '/assets/libs/js/jquery.min.js', array(), $css_unti_cache);

    wp_enqueue_script('jquery-validate-min-js', get_stylesheet_directory_uri() . '/assets/libs/js/jquery.validate.min.js', array(), $css_unti_cache);

    wp_enqueue_script('slick-min-js', get_stylesheet_directory_uri() . '/assets/libs/js/slick.min.js', array(), $css_unti_cache);

    wp_enqueue_script('main-js', get_stylesheet_directory_uri() . '/assets/js/main.js', array(), $css_unti_cache);

    wp_enqueue_script('program_schedule', get_stylesheet_directory_uri() . '/assets/js/program_schedule.js', array(), $css_unti_cache);

    if (is_archive("program")) {
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
    // Define single-page body class in itself admin page
    if (is_page()) {
        $classes[] = get_field('body_class');
    }
    if (is_page_template('pages_template/page_contact.php')) {
        $classes[] = 'contact';
    }
    if (is_page('search')) {
        $classes[] = 'search';
    }
    if (is_page('program_schedule')) {
        $classes[] = 'program_schedule';
    }
    if (is_page('social')) {
        $classes[] = 'list_account';
    }
    if (is_tax('news_cat', 'release')) {
        $classes[] = 'news_release';
    }
    if (is_tax('news_cat', 'whatsnew')) {
        $classes[] = 'list_new';
    }
    if (is_singular('news')) {
        $classes[] = 'news_detail';
    }
    if (is_tax('news_cat', 'whatsnew')) {
        $classes[] = 'list_new';
    }
    if (is_post_type_archive('program')) {
        $classes[] = 'list_program';
    }
    if (is_singular('program') && get_post_format() === 'chat') {
        $classes[] = 'correlation_diagrams';
    }
    if (is_singular('program') && get_post_format() === 'gallery') {
        $classes[] = 'archive_episode';
    }
    if (is_tax('program_cat')) {
        $slug = get_the_terms(get_the_ID(), 'program_cat')[0]->slug;
        if (str_contains($slug, 'archive')) {
            $classes[] = 'program_detail_archive';
        }
        if ($slug === 'nikkei') {
            $classes[] = 'makita_debate';
        }
        $classes[] = 'program_detail';
    }
    if (is_post_type_archive('press')) {
        $classes[] = 'the_press';
    }
    $archive_term = get_queried_object();
    $archive_bullet_design = get_field('archive_bullet_design', $archive_term);
    if ($archive_bullet_design) {
        $classes[] = 'limited_rewards';
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

// Create theme option
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => 'Theme Options',
        'menu_title' => 'Theme Options',
        'menu_slug' => 'theme-settings',
        'capability' => 'edit_posts',
        'redirect' => false
    ));
}

add_filter( 'pre_get_posts', 'custom_posts_per_page' );

function custom_pagination($numpages = '', $pagerange = '', $paged = '', $pageName = '')
{
    if (empty($pagerange)) {
        $pagerange = 1;
    }
    global $paged;

    if (empty($paged)) {
        $paged = 1;
    }
    if ($numpages == '') {
        global $wp_query;
        $numpages = $wp_query->max_num_pages;
        if (!$numpages) {
            $numpages = 1;
        }
    }
    $url_params_regex = '/\?.*?$/';
    $big = 999999999;
    preg_match($url_params_regex, get_pagenum_link(), $url_params);
    $base = str_replace($big, '%#%', esc_url(get_pagenum_link($big)));
    $format = 'page/%#%';
    $pagination_args = array(
        //        'base'            => get_pagenum_link(1) . '%_%',
        //        'format'          => 'page/%#%',
        'base' => $base,
        'format' => $format,
        'total' => $numpages,
        'current' => $paged,
        'show_all' => false,
        'end_size' => 2,
        'mid_size' => 2,
        'prev_next' => true,
        'prev_text' => __('前へ'),
        'next_text' => __('次へ'),
        'type' => 'array',
        'add_args' => true,
        'add_fragment' => ''
    );
    $paginate_links = paginate_links($pagination_args);
    if ($paginate_links) {
        echo "<div id='pagination'>
        <ul>
        ";
        foreach ($paginate_links as $paginate_item) {
            if (str_contains($paginate_item, '')) {
                // continue;
            }
            if (str_contains($paginate_item, '')) {
                // continue;
            }
            echo
                '<li>'.
                $paginate_item.
                '</li>';
        }
        echo "</ul></div>";

    }
    wp_reset_postdata();

}