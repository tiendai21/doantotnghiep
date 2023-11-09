<?php /* -*- coding: utf-8 -*- */
// echo '番組リスト';
$term_list_object = get_queried_object();
$term_list_object_name = $term_list_object->name;

$terms = get_terms('program_cat', ['parent' => $term_list_object->term_id]);

usort($terms, 'program_sort_by_term_order');

$top_view = null;
$programs_arr = [];
foreach ($terms as $t) {
    $status = (int)get_field('onair', $t); // 1: 放送予定, 2: 放送中, 3: 放送終了
    if ((int)$status !== 3) {
        // 放送ステータスで分離
        $programs_arr[] = $t;
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
                                             alt="thumb slide top 02">
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

    <!-- Entertainment on air -->
    <section class="section" id="dramas_ended">
        <div class="inner">
            <div class="tlt_section">
                <h2><?php echo esc_attr( $term_list_object_name ); ?></h2>
                <div class="btn_more">
                    <span>すべて見る</span>
                </div>
            </div>
            <div class="dramas_slides">
                <div class="dramas_slide_top">
                    <div class="program_slide dramas_top">
                        <?php
                        if ( ! empty( $programs_arr ) ) {
                            foreach ($programs_arr as $t) {
                                ob_start();
                                get_template_part('template-parts/home/modal_category_item', null, array('term' => $t));
                                $dramas_on_air_modal .= ob_get_contents();
                                ob_end_clean();
                                tpl_program_list_item( $t );
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

    <!-- /Entertainment on air -->



    <!-- ranking -->
    <?php get_template_part('template-parts/ranking/ranking', null, array('cat' => 'all', 'title' => 'ランキング', 'sns' => false)); ?>
    <!-- /ranking -->
    <!-- Recommended movies -->
    <?php display_program_recommend_by_category_slug($term_list_object->slug); ?>
    <!-- /Recommended movies -->
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
