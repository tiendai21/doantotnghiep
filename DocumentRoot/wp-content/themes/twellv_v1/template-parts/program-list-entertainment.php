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
//var_dump($programs_arr);
?>
<main id="main">
    <div class="breadcrumb">
        <ul>
            <li>
                <a href="<?php echo esc_url(home_url('/')) ?>">BS12 | BS無料放送ならBS12 トゥエルビ</a>
            </li>
            <li>
                <span><?php echo ($term_list_object->slug == 'entertainment') ? 'BS12ガイド' : esc_attr($term_list_object_name); ?></span>
            </li>
        </ul>
    </div>
    <!-- banner catefory -->
    <section class="section" id="banner_entertainment">
        <div class="inner">
            <h2><?php echo ($term_list_object->slug == 'entertainment') ? 'BS12ガイド' : esc_attr($term_list_object_name); ?></h2>
        </div>
    </section>
    <!-- /banner category -->
    <!-- Entertainment on air -->
    <section class="section entertainment" id="dramas_ended">
        <div class="inner">
            <h3>「BS12ガイド」では、BS12で放送中の旬な番組を紹介しています。<br>放送時間は番組表をご確認ください。</h3>
            <div class="tlt_section">
                <h2><?php echo ($term_list_object->slug == 'entertainment') ? 'お役立ち情報' : esc_attr($term_list_object_name); ?></h2>
            </div>
            <div class="dramas_list">
                <ul>
                    <?php
                    if (!empty($programs_arr)) {
                        foreach ($programs_arr as $t) {
                            ob_start();
                            get_template_part('template-parts/home/modal_category_item', null, array('term' => $t));
                            $dramas_on_air_modal .= ob_get_contents();
                            ob_end_clean();
                            tpl_program_list_item($t);
                        }
                    }
                    ?>
                </ul>
            </div>
            <?php get_template_part('template-parts/home/modal_category', null, array('title' => esc_attr($term_list_object_name), 'modal' => $dramas_on_air_modal)); ?>
            <?php if ($term_list_object->slug !== 'entertainment'):?>
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
            <?php endif;?>
        </div>
    </section>


    <?php if ($term_list_object->slug == 'entertainment'):?>
        <!-- recommend -->
        <?php get_template_part('template-parts/home/recommend_top'); ?>
        <!-- /recommend -->
        <!-- news -->
        <?php get_template_part('template-parts/news/news_top'); ?>
        <!-- /news -->
        <!-- other -->
        <?php get_template_part('template-parts/home/other_top', null, array('type' => 'all')); ?>
        <!-- /other -->
    <?php else: ?>

    <!-- /Entertainment on air -->
    <!-- ranking -->
    <?php get_template_part('template-parts/ranking/ranking', null, array('cat' => 'all', 'title' => 'ランキング', 'sns' => false)); ?>
    <!-- /ranking -->
    <!-- Recommended movies -->
    <?php display_program_recommend_by_category_slug($term_list_object->slug); ?>
    <!-- /Recommended movies -->
    <!-- recommended_program -->
    <!-- recommend -->
    <?php get_template_part('template-parts/home/recommend_top'); ?>
    <!-- /recommend -->
    <!-- /recommended_program -->
    <!-- other -->
        <?php get_template_part('template-parts/home/other_top', null, array('type' => 'all')); ?>
        <!-- /other -->
    <?php endif; ?>
</main>
