<?php /* -*- coding: utf-8; mode: web; -*- */

get_header();
?>
    <!--main-->
    <main id="main">
        <div class="breadcrumb">
            <ul>
                <li>
                    <a href="<?php echo esc_url(home_url('/')) ?>">BS12 | BS無料放送ならBS12 トゥエルビ</a>
                </li>
                <li>
                    <span>プレゼント・イベント情報一覧</span>
                </li>
            </ul>
        </div>
        <?php
        $present_event_list = [];

        // 新着
        $whats_new_args = [
            'post_type' => 'news',
            'posts_per_page' => -1,
            'meta_query' => [
                [
                    'key' => 'display_present_event',
                    'value' => true,
                    'compare' => '='
                ]
            ]
        ];
        $the_query = new WP_Query( $whats_new_args );
        if ( $the_query->have_posts() ) {
            while ($the_query->have_posts()) {
                $the_query->the_post();
                if ( get_field('thumbnail') ) {
                    // $item['title'] = get_field('present_event_text');
                    $item['title'] = get_the_title();
                    $item['text'] = get_field('present_event_catch');
                    $img = get_field('thumbnail');
                    $item['thumb'] = sprintf('<img src="%s" alt="%s">', $img['url'], $item['title'].'のサムネイル');
                    // $item['url'] = get_permalink();
                    $link_url = get_permalink();
                    $pdf = get_field( 'pdf');
                    $url = get_field( 'url' );
                    $class_pdf = '';
                    if( $pdf ) {
                        $link_url = $pdf['url'];
                        $class_pdf = 'pdf';
                    } elseif( $url ) {
                        $link_url = $url;
                    }
                    $item['url'] = $link_url;
                    $item['target_blank'] = get_field( 'target_blank' ) ? ' target="_blank" ' : '';

                    $present_event_list[] = $item;
                }
            }
            wp_reset_postdata();
        }

        // 番組
        $args = [ 'taxonomy' => 'program_cat',
            'meta_query' => [
                ['key' => 'present_url',
                    'value' => '',
                    'compare' => '!=' ]]
        ];

        $term_query = new WP_Term_Query( $args );
        if ( ! empty( $term_query ) && ! is_wp_error( $term_query ) ) {
            $terms_arr = [];
            foreach ($term_query->get_terms() as $t) {
                $terms_arr[] = $t;
            }

            usort( $terms_arr, 'program_sort_by_term_order' );

            foreach ( $terms_arr as $term) {
                $item = [];
                $item['title'] = $term->name;
                $item['thumb'] = get_acf_img_tag('list_thumb', $term, $item['title'].'のサムネイル');
                $item['text'] = get_field( 'present_text', $term );
                $item['url'] = get_field( 'present_url', $term );
                $item['target_blank'] = get_field( 'target_blank' ) ? ' target="_blank" ' : '';
                $present_event_list[] = $item; // カテゴリ別
            }
        }
        ?>
        <!--list topic-->
        <section class="section" id="list_topic">
            <div class="inner">
                <div class="tlt_head">
                    <h2>プレゼント・イベント情報一覧</h2>
                </div>
                <div class="content_section">
                    <?php
                    foreach ( $present_event_list as $item ) {
                        ?>
                        <div class="program_baseball">
                            <div class="thumb">
                                <?php echo $item['thumb'];  ?>
                            </div>
                            <div class="txt_desp">
                                <h2><?php echo $item['title']; ?></h2>
                                <span> <?php echo $item['text'] ?></span>
                                <div class="btn_bottom">
                                    <a href="<?php echo $item['url']; ?>" <?php echo $item['target_blank']; ?>>詳細はこちら</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>
        <!--/list topic-->
        <!-- program air -->
        <?php get_template_part('template-parts/home/program_air_top', null, array('hideBtnWatch' => true)); ?>
        <!-- /program air -->
        <!-- ranking -->
        <?php get_template_part('template-parts/ranking/ranking', null, array('cat' => 'all', 'title' => 'ランキング', 'sns' => false)); ?>
        <!-- /ranking -->
        <!-- news -->
        <?php get_template_part('template-parts/news/news_top'); ?>
        <!-- /news -->
        <!-- other -->
        <?php get_template_part('template-parts/home/other_top', null, array('social' => true, 'type' => 'all')); ?>
        <!-- /other -->
    </main>
    <!--/main-->
<?php

get_footer();
