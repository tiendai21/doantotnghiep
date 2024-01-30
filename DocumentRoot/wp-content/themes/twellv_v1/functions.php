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
    if (is_page() || is_tax('program_cat') || is_singular('program')) {
        wp_enqueue_style('old-styles_1', get_stylesheet_directory_uri() . '/assets/css/style_old_1.css', array(), $css_unti_cache);
        wp_enqueue_style('old-styles_2', get_stylesheet_directory_uri() . '/assets/css/style_old_2.css', array(), $css_unti_cache);
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

//add_filter('pre_get_posts', 'custom_posts_per_page');

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
                '<li>' .
                $paginate_item .
                '</li>';
        }
        echo "</ul></div>";

    }
    wp_reset_postdata();

}
// For movie archive page
function stringToTimeStamp($string, $format)
{
    $string = preg_replace('/[^0-9年月日]/u', '', $string); // Remove non-numeric and non-date characters
    $date = DateTime::createFromFormat('Y年n月j日', $string);
    if ($date !== false) {
        $timestamp = $date->format($format); // Get the Unix timestamp
        return $timestamp;
    } else {
        return null;
    }
}
// Only for program archive page
function custom_modify_archive_posts($posts, $query)
{
    if (is_archive() && $query->is_main_query() && is_tax('program_cat') && str_contains($query->query['term'], 'archive')) {
        // Modify the $posts array as needed
        foreach ($posts as $i => $post) {
            $dateStr = get_field('onairtime', $post->ID);
            $dateStamp = stringToTimeStamp($dateStr, 'U');
            $episode = preg_replace('/[^0-9]/', '', $post->post_title); // Remove non-numeric characters
            $posts[$i]->onairTime = $dateStamp;
            $posts[$i]->episode = $episode;
        }
        usort($posts, function ($a, $b) {
            if ($a->onairTime == $b->onairTime) {
                return $a->episode > $b->episode; // Sort by another key when dates are equal
            }
            return $a->onairTime > $b->onairTime;
        });
    }
    return $posts;
}
add_filter('the_posts', 'custom_modify_archive_posts', 10, 2);

// Admine clear cache menu
$crxl_cfi_page = 'Cache Manager';
$crxl_cfi_slug = 'cf-invalidation';
function cfi_admin_page_contents()
{
}

function cfi_admin_menu()
{
    global $crxl_cfi_page, $crxl_cfi_slug;
    add_menu_page(
        __($crxl_cfi_page),
        __($crxl_cfi_page),
        'manage_options',
        $crxl_cfi_slug,
        'cfi_admin_page_contents',
        'dashicons-schedule',
    );
}

add_action('admin_menu', 'cfi_admin_menu');

function cfi_remove_menu_pages()
{
    global $crxl_cfi_slug;
    remove_menu_page($crxl_cfi_slug);
}

add_action('admin_init', 'cfi_remove_menu_pages');

add_action('admin_init', function () {
    global $pagenow, $crxl_cfi_slug;
    if (($pagenow === 'admin.php') && ($_GET['page'] === $crxl_cfi_slug)) {
        if ($_GET['types']) {
            $types = explode(',', $_GET['types']);
            foreach ($types as $type) {
                if ($type !== 'kusanagi')
                    exec('aws cloudfront create-invalidation --distribution-id ' . constant('CFI_' . strtoupper($type) . '_ID') . ' --paths ' . CFI_PATHS);
                else
                    $base64Payload = base64_encode('{"tagKey": "'. CFL_TAG_KEY .'", "tagValue": "'. CFL_TAG_VALUE .'"}');
                exec('aws lambda invoke --function-name ' . CFL_FUNCTION_NAME . ' --payload ' . $base64Payload . ' --invocation-type Event ' . CFL_OUTPUT_FILE);
            }
        }
        wp_redirect(admin_url());
    }
});

function cfi_custom_toolbar_link($wp_admin_bar)
{
    global $crxl_cfi_page, $crxl_cfi_slug;
    $args = array(
        'id' => $crxl_cfi_slug,
        'title' => $crxl_cfi_page
    );
    $wp_admin_bar->add_node($args);

    $args = array(
        'id' => $crxl_cfi_slug . '-all',
        'title' => 'Clear All Cache',
        'href' => admin_url('admin.php?page=' . $crxl_cfi_slug . '&types=web,theme,kusanagi'),
        'parent' => $crxl_cfi_slug,
    );
    $wp_admin_bar->add_node($args);

    $args = array(
        'id' => $crxl_cfi_slug . '-web',
        'title' => 'Clear Web Cache',
        'href' => admin_url('admin.php?page=' . $crxl_cfi_slug . '&types=web'),
        'parent' => $crxl_cfi_slug,
    );
    $wp_admin_bar->add_node($args);

    $args = array(
        'id' => $crxl_cfi_slug . '-theme',
        'title' => 'Clear Theme Cache',
        'href' => admin_url('admin.php?page=' . $crxl_cfi_slug . '&types=theme'),
        'parent' => $crxl_cfi_slug,
    );
    $wp_admin_bar->add_node($args);

    $args = array(
        'id' => $crxl_cfi_slug . '-kusanagi',
        'title' => 'Clear Kusanagi Cache',
        'href' => admin_url('admin.php?page=' . $crxl_cfi_slug . '&types=kusanagi'),
        'parent' => $crxl_cfi_slug,
    );
    $wp_admin_bar->add_node($args);
}

add_action('admin_bar_menu', 'cfi_custom_toolbar_link', 9999);