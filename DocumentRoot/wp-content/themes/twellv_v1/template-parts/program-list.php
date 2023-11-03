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
// var_dump( $programs_arr );

?>
<main id="main">
    <ul class="breadcrumb">
        <li>
            <a href="#">BS12 | BS無料放送ならBS12 トゥエルビ</a>
        </li>
        <li>
            <a href="#">ドラマ・映画</a>
        </li>
        <li>
            <span>韓国・</span>
        </li>
    </ul>
    <!-- banner catefory -->
    <section class="section" id="banner_category">
        <div class="inner">
            <div class="siler_category_top">
                <div class="txt_fixed">
                    <h2>韓国・韓流ドラマ</h2>
                </div>
                <div class="siler_top_content">
                    <?php if (have_rows('listcategory_field_banner_01', 'option')): ?>
                        <div class="slide_top_odd">
                            <?php while (have_rows('listcategory_field_banner_01', 'option')): the_row();
                                $image = get_sub_field('listcategory_image');
                                $urlItem = get_sub_field('listcategory_url');
                                ?>
                                <a href="<?php echo $urlItem; ?>">
                                    <div class="thumb">
                                        <img src="<?php echo $image; ?>" width="448px" height="252px"
                                             alt="thumb slide top 01">
                                    </div>
                                </a>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (have_rows('listcategory_field_banner_02', 'option')): ?>
                        <div class="slide_top_even">
                            <?php while (have_rows('listcategory_field_banner_02', 'option')): the_row();
                                $image = get_sub_field('listcategory_image');
                                $urlItem = get_sub_field('listcategory_url');
                                ?>
                                <a href="<?php echo $urlItem; ?>">
                                    <div class="thumb">
                                        <img src="<?php echo $image; ?>" width="448px" height="252px"
                                             alt="thumb slide top 01">
                                    </div>
                                </a>
                            <?php endwhile; ?>
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
                <h2><?php echo esc_attr($term_list_object_name); ?></h2>
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
            <?php get_template_part('template-parts/home/modal_category', null, array('title' => 'test', 'modal' => $dramas_on_air_modal)); ?>
            <div class="btn_watch">
                <a href="<?php echo esc_url(home_url('/howtowatch')) ?>">無料で見られる！BS12の視聴方法
                    <span></span>
                </a>
            </div>
        </div>
    </section>

    <!-- /Korean dramas on air -->
    <!-- broadcast schedule -->
    <section class="section" id="broadcast_schedule">
        <div class="inner">
            <div class="tlt_section">
                <h2>ドラマ・映画</h2>
                <div class="btn_more">
                    <span>すべて見る</span>
                </div>
            </div>
            <div class="program_slide side_brand">
                <div class="item_slide">
                    <a href="#">
                        <img src="https://dummyimage.com/320x180/000000/fff" alt="">
                    </a>
                </div>
                <div class="item_slide">
                    <a href="#">
                        <img src="https://dummyimage.com/320x180/000000/fff" alt="">
                    </a>
                </div>
                <div class="item_slide">
                    <a href="#">
                        <img src="https://dummyimage.com/320x180/000000/fff" alt="">
                    </a>
                </div>
                <div class="item_slide">
                    <a href="#">
                        <img src="https://dummyimage.com/320x180/000000/fff" alt="">
                    </a>
                </div>
                <div class="item_slide">
                    <a href="#">
                        <img src="https://dummyimage.com/320x180/000000/fff" alt="">
                    </a>
                </div>
                <div class="item_slide">
                    <a href="#">
                        <img src="https://dummyimage.com/320x180/000000/fff" alt="">
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- /broadcast schedule -->
    <!-- ranking -->
    <?php get_template_part('template-parts/ranking/ranking', null, array('cat' => $term_list_object->slug, 'title' => 'ランキング', 'sns' => true)); ?>
    <!-- /ranking -->
    <!-- ranking -->
    <?php get_template_part('template-parts/ranking/ranking', null, array('cat' => 'all', 'title' => 'ランキング', 'sns' => false)); ?>
    <!-- /ranking -->
    <!-- Recommended movies -->
    <?php display_program_recommend_by_category_slug($term_list_object->slug); ?>
    <!-- /Recommended movies -->
    <!-- look at the program -->
    <?php
    /**
     * add 20200305 yanagi ↓
     * BS12_RENEWAL-209 【施策ID：41-1】スポーツ一覧ページ > 配下動画の表示
     */
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
                    <?php while (have_rows('movie_area', $term_list_object)) : the_row(); ?>
                        <?php the_sub_field('movie_tag', $term_list_object); ?>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
    <?php endif;
    // add 20200305 yanagi ↑
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
    <?php
    /**
     * add function 20200317 yanagi ↓↓
     * BS12_RENEWAL-212 【施策ID：47-1】韓国ドラマ > 放送終了番組の統合
     *
     * edit 20201012 yanagi
     * BS12_RENEWAL-269 【タスク】レイアウト変更ならびにWP機能追加
     *
     */
    ?>
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
                <?php get_template_part('template-parts/home/modal_category', null, array('title' => 'test', 'modal' => $dramas_ended_modal)); ?>
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
                            tpl_program_list_item_pre($t);
                            $i++;
                        }
                    }
                    ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- /The Korean drama has ended its broadcast -->
    <!-- customer voice -->
    <?php display_program_voice_by_category_slug($term_list_object->slug); ?>
    <!-- /customer voice -->
    <!-- recommended_program -->
    <!-- recommend -->
    <?php get_template_part( 'template-parts/home/recommend_top' ); ?>
    <!-- /recommend -->
    <!-- /recommended_program -->
    <!-- PR -->
    <?php get_template_part( 'template-parts/home/pr_top' ); ?>
    <!-- /PR -->
    <!-- other -->
    <?php get_template_part( 'template-parts/home/other_top' ); ?>
    <!-- /other -->
</main>

