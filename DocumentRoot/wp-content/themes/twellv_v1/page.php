<?php
/* -*- coding: utf-8; mode: web; -*- */
$display_header_footer = get_field('header_footer_display_switch');
// var_dump( $display_header_footer );
$h_f = null;
if ($display_header_footer === true) {
    $h_f = 'no_h_f';
}
get_header($h_f);
// echo '固定ページ';

if ($h_f !== "no_h_f") {//【ザ・カセットテープ・ミュージック】番組ページ改修 ヘッダフッタ非表示バグ修正 add 20200214 yanagi
    ?>
    <main id="main">
    <?php
    if (!have_posts()) {
        wp_safe_redirect("/404/", 404);
        exit;
    } else {
        while (have_posts()) {
            the_post();
            echo get_field('html_area');
        }
    }
    $slug = $post->post_name;
    if ($slug == "program_schedule") {
        get_template_part('template-parts/seo/category', 'btn-list');
    }
    ?>
    <!-- /tpl-contents -->


    <?php
//↓↓【【ザ・カセットテープ・ミュージック】番組ページ改修 ヘッダフッタ非表示バグ修正 add 20200214 yanagi
} else {
    while (have_posts()) {
        the_post();
        echo get_field('html_area');
    }
}
?>
    </main>
<?php
//↑↑【【ザ・カセットテープ・ミュージック】番組ページ改修 ヘッダフッタ非表示バグ修正 add 20200214 yanagi
get_footer($h_f);