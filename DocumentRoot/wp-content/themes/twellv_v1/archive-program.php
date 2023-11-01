<?php
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

<?php if (get_query_var('onair_status') !== 'finished') :?>
    <!-- main -->
    <main id="main">
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo esc_url(home_url('/')) ?>"><?php bs12_pankuzu_text_top(); ?></a>
            </li>
            <li>
                <span><?php echo $pre_title; ?>放送中の番組</span>
            </li>
        </ul>

        <!-- program air -->
        <?php get_template_part('template-parts/program/program-airing'); ?>
        <!-- /program air -->
        <?php get_template_part('template-parts/add/add_news'); ?>
        <?php get_template_part('template-parts/add/add_news_single'); ?>
        <!-- Broadcast schedule -->
        <section class="section" id="broadcast_schedule">
            <div class="inner">
                <div class="tlt_section">
                    <h2>放送予定</h2>
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
                </div>
                <!--      List brand banners        -->
                <?php get_template_part('template-parts/home/brand-banner'); ?>
                <!--      /List brand banners        -->
            </div>

        </section>
        <!-- /Broadcast schedule -->

        <!-- ranking -->
        <?php get_template_part('template-parts/ranking/ranking'); ?>
        <!-- /ranking -->

        <!-- program list -->
        <?php foreach ($base_terms as $base_t) {
            if (isset($program_cat_lists[$base_t->term_id]) && count($program_cat_lists[$base_t->term_id]) > 0) {
                $modal = "";
                ?>
                <section class="section slide_program_wrapper" id="<?php echo $base_t->slug; ?>">
                    <div class="inner">
                        <div class="tlt_section">
                            <h2><?php echo $base_t->name; ?></h2>
                            <div class="btn_more">
                                <span>すべて見る</span>
                            </div>
                        </div>
                        <div class="program_slide side_brand">
                            <?php foreach ($program_cat_lists[$base_t->term_id] as $t) :
                                ob_start();
                                get_template_part('template-parts/home/modal_category_item', null, array('term' => $t));
                                $modal .= ob_get_contents();
                                ob_end_clean();
                                ?>
                                <div class="item_slide">
                                    <a href="<?php echo get_term_link($t); ?>">
                                        <div class="thumb">
                                            <?php echo get_acf_img_tag('list_thumb', $t, $t->name . 'のサムネイル'); ?>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <?php get_template_part('template-parts/home/modal_category', null, array('title' => $base_t->name, 'modal' => $modal)); ?>
                    </div>
                </section>
                <?php
            }
        }
        ?>
        <!-- /program list -->


        <!-- news -->
        <?php get_template_part('template-parts/news/news_top'); ?>
        <!-- /news -->

        <!-- recommend -->
        <?php get_template_part('template-parts/home/recommend_top'); ?>
        <!-- /recommend -->

        <!-- pr -->
        <?php get_template_part('template-parts/home/pr_top'); ?>
        <!-- /pr -->

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
    <!-- /main -->
<?php else: ?>

<!-- Ended page goes here-->

<?php endif;?>
<?php
get_footer();
