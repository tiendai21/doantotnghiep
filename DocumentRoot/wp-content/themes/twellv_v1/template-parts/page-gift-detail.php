<?php
/**
 * Template Name: gift-detail
 *
 */
get_header();
// echo '番組一覧ページ';

$base_terms_order = ['drama', 'korea', 'china', 'sports', 'tabi', 'variety', 'documentary',
    'music', 'anime', 'entertainment', 'qvc'];

// 番組カテゴリーを取得
$base_terms = array_map(function ($term_slug) {
    return get_term_by('slug', $term_slug, 'program_cat');
},
    $base_terms_order);

$args = [
    'taxonomy' => 'program_cat'
];

//　通常
// var_dump( get_query_var( 'onair_status' ));
// var_dump( $base_terms );

$pre_title = '';
if (get_query_var('onair_status') === 'finished') {
    // 終了番組

    // BS12_RENEWAL-212 【施策ID：47-1】韓国ドラマ > 放送終了番組の統合
    //終了番組リストの場合、韓国ドラマカテゴリ[korea]を非表示にするため削除する。
    //配列の1要素目はbase_terms_orderでソート済み

    unset($base_terms[1]);// add 20200318 yanagi

    $pre_title = '終了';
    $args['meta_query'] = [
        [
            'key' => 'onair',
            'value' => [3],
            'compare' => 'IN'
        ]
    ];
} else {
    // 放送予定か放送中
    $args['meta_query'] = [
        [
            'key' => 'onair',
            'value' => [1, 2],
            'compare' => 'IN'
        ]
    ];
}

// カテゴリ毎の番組一覧
$program_cat_lists = [];

$term_query = new WP_Term_Query($args);
if (!empty($term_query) && !is_wp_error($term_query)) {
    $term_arr = [];
    foreach ($term_query->get_terms() as $t) {
        $term_arr[] = $t;
    }
    usort($term_arr, 'program_sort_by_term_order');
    // 最初は親カテゴリが同じもの
    foreach ($term_arr as $term) {
        $program_cat_lists[$term->parent][] = $term;
    }
    // 次に別カテゴリ表示の設定があるもの
    foreach ($term_arr as $term) {
        $cats = get_field('view_other', $term);
        if ($cats) {
            foreach ($cats as $c) {
                $program_cat_lists[$c][] = $term;
            }
        }
    }

}
?>
<!-- main -->
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
    ?>
    <?php get_template_part('template-parts/ranking/ranking', null, array('cat' => 'sports', 'title' => 'スポーツ番組ランキング', 'sns' => false)); ?>
    <!-- /cat ranking -->
    <!-- ranking -->
    <?php get_template_part('template-parts/ranking/ranking', null, array('cat' => 'all', 'title' => 'ランキング', 'sns' => false)); ?>
    <!-- /ranking -->
    <!-- Recommended movies sport -->
    <?php display_program_recommend_by_category_slug("sports"); ?>
    <!-- /Recommended movies -->
    <!-- Ended movie -->
    <section class="section" id="dramas_ended">
        <div class="inner">
            <div class="tlt_section">
                <h2>BS12のおすすめ番組</h2>
<!--                <h2>放送終了の--><?php //echo esc_attr($term_list_object_name); ?><!--</h2>-->
                <div class="btn_more">
                    <span>すべて見る</span>
                </div>
            </div>
            <div class="program_slide side_brand">
                <?php
                $total = 0;
                // for slide
                foreach ($base_terms as $base_t) :
                    if (++$total > 8) break;
                    if (isset($program_cat_lists[$base_t->term_id]) && count($program_cat_lists[$base_t->term_id]) > 0) :
                        $modal = "";
                        if (count($program_cat_lists[$base_t->term_id]) > 0) :
                            $index = 0;
                            foreach ($program_cat_lists[$base_t->term_id] as $t) :
                                if (++$index > 1) break;
                                ?>
                                <div class="item_slide">
                                    <a href="<?php echo get_term_link($t); ?>">
                                        <?php echo get_acf_img_tag('list_thumb', $t); ?>
                                    </a>
                                </div>
                            <?php endforeach;
                        endif;
                    endif;
                endforeach;
                // for modal
                foreach ($base_terms as $base_t) :
                    foreach ($program_cat_lists[$base_t->term_id] as $t) :
                        ob_start();
                        get_template_part('template-parts/home/modal_category_item', null, array('term' => $t));
                        $modal .= ob_get_contents();
                        ob_end_clean();
                    endforeach;
                endforeach;
                ?>
            </div>
            <?php get_template_part('template-parts/home/modal_category', null, array('title' => '放送終了', 'modal' => $modal)); ?>
        </div>
    </section>
    <!-- /Ended movie -->
    <!-- news -->
    <?php get_template_part('template-parts/news/news_top'); ?>
    <!-- /news -->
    <!-- section infomation -->
    <section class="section" id="section_infomation">
        <div class="inner">
            <div class="news_release">
                <div class="tlt_section">
                    <h2>お知らせ</h2>
                </div>
                <?php get_template_part('template-parts/news/news_list'); ?>
            </div>
        </div>
    </section>
    <!-- /section infomation -->
    <!-- other -->
    <?php echo do_shortcode( '[single-page-other type="all"]' ); ?>
    <!-- /other -->
</main>
<!-- /main  -->
<?php
get_footer();
?>