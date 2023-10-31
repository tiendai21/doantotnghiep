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

    <div id="tpl-topicpath">
        <div class="tpl-inner-wrap">
            <ul>
                <li><a href="/"><?php  bs12_pankuzu_text_top(); ?></a></li>
                <?php // BS12_RENEWAL-265 【施策ID：79-1】パンくず整理：企業情報配下 20201009 add yanagi ?>
                <?php
                if ( $post->post_parent ) {
                    $per_ids = array_reverse(get_post_ancestors($post->ID));
                    foreach ( $per_ids as $par_id ){
                        $pankuzu_title = get_field('pankuzu_title',$par_id);
                        if(!$pankuzu_title){
                            $pankuzu_title = get_page($par_id)->post_title;
                        }
                        echo '<li><a href="'.get_page_link( $par_id ).'">'.$pankuzu_title.'</a></li>';
                    }
                }
                ?>
                <li><?php the_title(); ?></li>
            </ul>
        </div>
    </div>
    <!-- /tpl-topicpath -->

    <div id="tpl-contents">
        <div class="tpl-inner-wrap">
            <?php
            if(!have_posts()){
                wp_safe_redirect( "/404/", 404 );
                exit;
            }else{
                while (have_posts()) {
                    the_post();
                    echo get_field('html_area');
                }
            }
            get_template_part('template-parts/uiux/bottom', 'roll-link');
            $slug = $post->post_name;
            if($slug == "program_schedule"){
                get_template_part( 'template-parts/seo/category', 'btn-list' );
            }
            ?>
        </div>
    </div>
    <!-- /tpl-contents -->


    <?php
//↓↓【【ザ・カセットテープ・ミュージック】番組ページ改修 ヘッダフッタ非表示バグ修正 add 20200214 yanagi
} else {
    while (have_posts()) {
        the_post();
        echo get_field('html_area');
    }
}
//↑↑【【ザ・カセットテープ・ミュージック】番組ページ改修 ヘッダフッタ非表示バグ修正 add 20200214 yanagi
get_footer($h_f);