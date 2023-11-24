<?php /* -*- coding: utf-8 -*- */
// echo '番組リスト';
$term_list_object = get_queried_object();
$term_list_object_name = $term_list_object->name;

$terms = get_terms('program_cat');
usort($terms, 'program_sort_by_term_order');
// foreach ( $terms as $t ) { echo '<p>' . $t->name . ':' . $t->term_order . '</p>' ;}

// 表示対象以外の番組は後に表示する

$target_terms = [];
$other_terms = [];
foreach ($terms as $t) {
    if ($t->parent === $term_list_object->term_id) {
        $target_terms[] = $t;
    } else {
        $other_terms[] = $t;
    }
}

$terms = array_merge($target_terms, $other_terms);

$top_view = null;
$programs_arr = [];
foreach ($terms as $t) {
    if (is_display_program_archive($t, $term_list_object->term_id)) {
        // 対象カテゴリの番組または 親番組カテゴリ以外のアーカイブに表示するで指定された番組

        $status = (int)get_field('onair', $t); // 1: 放送予定, 2: 放送中, 3: 放送終了
        if ((int)$status > 0) {
            // 放送ステータスで分離
            $programs_arr[$status][] = $t;
        }
        if (
            $t->parent === $term_list_object->term_id
            && get_field('top_view', $t) && ($status === 1 || $status === 2)
        ) {
            /*
             * 番組 D
             * 1.①～③全て条件を満たした番組のカテゴリ順先頭の1件を表示する。
    　　     * ① 親カテゴリに当該カテゴリが選択されている。
    　       * ② I-10.番組カテゴリTOPのメインに表示する項目にチェックが付いている。
             * ③ I-5.放送ステータスが「放送予定」、または、「放送中」である。
             */
            $top_view = $t;
        }
    }
}

?>
<main id="main">
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo esc_url(home_url('/')) ?>">BS12 | BS無料放送ならBS12 トゥエルビ</a>
        </li>
        <li>
            <a href="<?php echo esc_url(home_url('/program/')) ?>">ドラマ・映画</a>
        </li>
        <li class="util_pc">
            <span>韓国・韓流ドラマ</span>
        </li>
        <li class="util_sp">
            <span>韓国・</span>
        </li>
    </ul>
    <!-- banner catefory -->
    <section class="section" id="banner_category">
        <div class="inner">
            <div class="siler_category_top">
                <div class="txt_fixed">
                    <h2><?php echo esc_attr($term_list_object_name);?></h2>
                </div>
                <div class="siler_top_content">
                    <?php
                    if ($programs_arr[3]): ?>
                    <div class="slide_top_odd">
                        <?php
                        $i = 0;
                        foreach ($programs_arr[3] as $item):
                            if(++$i > 5) break;
                        $image = get_acf_img_tag('list_thumb', $item, $item->name . 'のサムネイル');
                        $urlItem = get_term_link($item);
                        ?>
                        <a href="<?php echo $urlItem; ?>">
                            <div class="thumb">
                                <?php echo $image; ?>
                            </div>
                        </a>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    <?php

                    if ($programs_arr[3]): ?>
                        <div class="slide_top_even">
                            <?php
                            $i = 0;
                            foreach (array_reverse($programs_arr[3]) as $item):
                                if(++$i > 4) break;
                                $image = get_acf_img_tag('list_thumb', $item, $item->name . 'のサムネイル');
                                $urlItem = get_term_link($item);
                                ?>
                                <a href="<?php echo $urlItem; ?>">
                                    <div class="thumb">
                                        <?php echo $image; ?>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
            <!-- brand -->
            <?php get_template_part('template-parts/home/brand_top'); ?>
            <!-- /brand -->
            <!--      List brand banners        -->
            <?php get_template_part('template-parts/home/brand-banner'); ?>
            <!--      /List brand banners        -->
        </div>
    </section>
    <!-- /banner category -->
    <!-- Korean dramas on air -->
    <section class="section" id="dramas_on_air">
        <div class="inner">
            <div class="tlt_section">
                <h2><?php echo $term_list_object->slug === 'korea' ? '放送中の韓国・韓流ドラマ' : esc_attr($term_list_object_name);?></h2>
                <div class="btn_more">
                    <span>すべて見る</span>
                </div>
            </div>
            <div class="dramas_slides">
                <div class="dramas_slide_top">
                    <div class="program_slide dramas_top">
                        <?php
                        if (!empty($programs_arr[2])) {
                            foreach ($programs_arr[2] as $t) {
                                ob_start();
                                get_template_part('template-parts/home/modal_category_item', null, array('term' => $t));
                                $dramas_on_air_modal .= ob_get_contents();
                                ob_end_clean();
                                tpl_program_list_item($t);
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="dramas_slide_bottom">
                    <div class="program_slide dramas_bottom">
                        <?php
                        if (!empty($programs_arr[2])) {
                            $programs_arr_reverse = array_reverse($programs_arr[2]);
                            foreach ($programs_arr_reverse as $t) {
                                ob_start();
                                get_template_part('template-parts/home/modal_category_item', null, array('term' => $t));
                                $dramas_on_air_modal .= ob_get_contents();
                                ob_end_clean();
                                tpl_program_list_item($t);
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php get_template_part('template-parts/home/modal_category', null, array('title' => $term_list_object_name, 'modal' => $dramas_on_air_modal)); ?>
            <div class="btn_watch">
                <a href="<?php echo esc_url(home_url('/howtowatch')) ?>">
                    <span></span>
                    <span>無料で見られる！BS12の視聴方法</span>
                </a>
            </div>
            <svg style="position: absolute; opacity: 0; width: 0; height: 0;" xmlns="http://www.w3.org/2000/svg"
                 width="494"
                 height="86" viewBox="40 0 494 86">
                <clipPath id="myClip" clipPathUnits="objectBoundingBox">
                    <path id="Subtraction_12" data-name="Subtraction 12"
                          d="m0.913,1 h-0.907 q-0.003,0,-0.006,-0.001 q0.003,-0.005,0.006,-0.012 q0.003,-0.007,0.006,-0.015 q0.003,-0.008,0.006,-0.017 q0.003,-0.01,0.006,-0.021 q0.003,-0.012,0.005,-0.024 q0.003,-0.014,0.005,-0.028 q0.002,-0.014,0.005,-0.029 q0.002,-0.015,0.004,-0.031 q0.002,-0.016,0.004,-0.035 q0.002,-0.017,0.003,-0.036 q0.002,-0.019,0.003,-0.037 q0.001,-0.02,0.002,-0.04 q0.002,-0.042,0.003,-0.086 q0.001,-0.043,0.001,-0.087 q0,-0.044,-0.001,-0.087 q-0.001,-0.044,-0.003,-0.086 q-0.001,-0.02,-0.002,-0.04 q-0.001,-0.019,-0.003,-0.037 q-0.001,-0.019,-0.003,-0.036 q-0.002,-0.019,-0.004,-0.035 q-0.002,-0.016,-0.004,-0.031 q-0.002,-0.015,-0.005,-0.029 q-0.002,-0.014,-0.005,-0.027 q-0.003,-0.014,-0.005,-0.026 q-0.003,-0.01,-0.006,-0.021 q-0.003,-0.009,-0.006,-0.017 q-0.003,-0.008,-0.006,-0.015 q-0.003,-0.007,-0.006,-0.012 q0.003,-0.001,0.006,-0.001 h0.907 c0.023,0,0.045,0.052,0.062,0.147 c0.016,0.094,0.026,0.221,0.026,0.353 c0,0.133,-0.009,0.259,-0.026,0.353 c-0.016,0.094,-0.038,0.147,-0.062,0.147"
                          fill="#c5dbf4"/>
                </clipPath>
            </svg>
        </div>
    </section>

    <!-- /Korean dramas on air -->
    <!-- Broadcast schedule -->
    <?php get_template_part('template-parts/program/broadcast_schedule', null, array('hideBrand' => true, 'term' => $term_list_object)); ?>
    <!-- /Broadcast schedule -->
    <!-- ranking -->
    <?php get_template_part('template-parts/ranking/ranking', null, array('cat' => $term_list_object->slug, 'title' => $term_list_object->name . 'ランキング', 'sns' => false));?>
    <!-- /ranking -->
    <!-- ranking -->
    <?php get_template_part('template-parts/ranking/ranking', null, array('cat' => 'all', 'title' => 'ランキング', 'sns' => false)); ?>
    <!-- /ranking -->
    <!-- Recommended movies -->
    <?php display_program_recommend_by_category_slug($term_list_object->slug); ?>
    <!-- /Recommended movies -->
    <!-- look at the program -->
    <?php
    if (have_rows('movie_area', $term_list_object)) : ?>
        <section class="section" id="look_program">
            <div class="inner">
                <div class="tlt_section">
                    <h2>番組のぞき見</h2>
                    <div class="btn_more">
                        <span>すべて見る</span>
                    </div>
                </div>
                <div class="program_content">
                    <?php
                    $index_movie = 0;
                    while (have_rows('movie_area', $term_list_object)) : the_row(); ?>
                        <?php
                        if ($index_movie < 2) {
                            the_sub_field('movie_tag', $term_list_object);
                        }
                        ob_start();
                        get_template_part('template-parts/home/modal_category_item', null, array('movie' => get_sub_field('movie_tag', $term_list_object)));
                        $scheduled_modal .= ob_get_contents();
                        ob_end_clean();
                        $index_movie++;
                        ?>
                    <?php endwhile; ?>
                </div>
                <?php get_template_part('template-parts/home/modal_category', null, array('title' => '放送予定の', 'modal' => $scheduled_modal)); ?>

            </div>
        </section>
    <?php endif;
    ?>
    <!-- /look at the program -->
    <!-- Korean dramas scheduled to air -->
    <section class="section" id="dramas_scheduled">
        <div class="inner">
            <div class="tlt_section">
                <h2><?php echo esc_attr($term_list_object_name); ?></h2>
                <div class="btn_more">
                    <span>すべて見る</span>
                </div>
            </div>
            <div class="program_slide side_brand">
                <?php
                if (!empty($programs_arr[1])) {
                    foreach ($programs_arr[1] as $t) {
                        ob_start();
                        get_template_part('template-parts/home/modal_category_item', null, array('term' => $t));
                        $scheduled_modal .= ob_get_contents();
                        ob_end_clean();
                        tpl_program_list_item_pre($t);
                    }
                }
                ?>
            </div>
            <?php get_template_part('template-parts/home/modal_category', null, array('title' => '放送予定の', 'modal' => $scheduled_modal)); ?>
        </div>
    </section>
    <!-- /Korean dramas scheduled to air -->
    <!-- The Korean drama has ended its broadcast -->
    <?php if (preg_match('/korea/', $term_list_object->slug)) : ?>
        <section class="section" id="dramas_ended">
            <div class="inner">
                <div class="tlt_section">
                    <h2>放送終了の韓国ドラマ</h2>
                    <div class="btn_more">
                        <span>すべて見る</span>
                    </div>
                </div>
                <div class="program_slide side_brand">
                    <?php
                    if (!empty($programs_arr[3])) {
                        foreach ($programs_arr[3] as $t) {
                            ob_start();
                            get_template_part('template-parts/home/modal_category_item', null, array('term' => $t));
                            $dramas_ended_modal .= ob_get_contents();
                            ob_end_clean();
                            tpl_program_list_item_pre($t);
                        }
                    }
                    ?>
                </div>
                <?php get_template_part('template-parts/home/modal_category', null, array('title' => '放送終了の韓国ドラマ', 'modal' => $dramas_ended_modal)); ?>
            </div>
        </section>
        <?php // add function 20200317 yanagi ↑↑ ?>
    <?php else : ?>
        <section class="section" id="dramas_ended">
            <div class="inner">
                <div class="tlt_section">
                    <h2>放送終了の<?php echo esc_attr($term_list_object_name); ?></h2>
                    <div class="btn_more">
                        <span>すべて見る</span>
                    </div>
                </div>
                <div class="program_slide side_brand">
                    <?php
                    if (!empty($programs_arr[3])) {
                        $i = 0;
                        foreach ($programs_arr[3] as $t) {
                            if ($i > 5) break; // 6件のみ表示
                            ob_start();
                            get_template_part('template-parts/home/modal_category_item', null, array('term' => $t));
                            $dramas_ended_modal .= ob_get_contents();
                            ob_end_clean();
                            tpl_program_list_item_pre($t);
                            $i++;
                        }
                    }
                    ?>
                </div>
                <?php get_template_part('template-parts/home/modal_category', null, array('title' => '放送終了の韓国ドラマ', 'modal' => $dramas_ended_modal)); ?>
            </div>
        </section>
    <?php endif; ?>

    <!-- /The Korean drama has ended its broadcast -->
    <!-- customer voice -->
    <?php display_program_voice_by_category_slug($term_list_object->slug); ?>
    <!-- /customer voice -->
    <!-- recommended_program -->
    <!-- recommend -->
    <?php get_template_part('template-parts/home/recommend_top'); ?>
    <!-- /recommend -->
    <!-- /recommended_program -->
    <!-- PR -->
    <?php get_template_part('template-parts/home/pr_top'); ?>
    <!-- /PR -->
    <!-- other -->
    <section class="section" id="other">
        <div class="inner">
            <div class="tlt_section">
                <h2>人気の番組カテゴリ</h2>
            </div>
            <?php get_template_part('template-parts/seo/category_famous_list'); ?>
        </div>
    </section>
    <!-- /other -->
</main>

