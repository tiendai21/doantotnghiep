<?php /* BS12おすすめ */ ?>
    <!-- BS12おすすめ番組 -->
<?php
$modal = "";
/**
 * 1.①かつ②の条件の番組をカテゴリ順に表示する。
 *  ① I-9.BS12おすすめ番組に表示する項目にチェックが付いている。
 *  ② I-5.放送ステータスが「放送予定」、または、「放送中」である。"
 */
$args = [
    'taxonomy' => 'program_cat',
    // 'hide_empty' => false,
    'meta_query' => [
        'relation' => 'AND',
        [
            'key' => 'onair',
            'value' => [1, 2], //「放送予定」、または、「放送中」
            'compare' => 'IN'
        ],
        [
            'key' => 'recommend_you',
            'value' => true,
            'compare' => '='
        ]]
];

$term_query = new WP_Term_Query($args);
if (!empty($term_query) && !is_wp_error($term_query)) :
    $term_arr = [];
    foreach ($term_query->get_terms() as $t) {
        $term_arr[] = $t;
    }
    usort($term_arr, 'program_sort_by_term_order');

    ?>
    <section class="section" id="recommend">
        <div class="inner">
            <div class="tlt_section">
                <h2>BS12おすすめ番組</h2>
                <div class="btn_more">
                    <span>すべて見る</span>
                </div>
            </div>
            <div class="program_slide slide_recommend">
                <?php
                foreach ($term_arr as $term) :
                    ob_start();
                    get_template_part('template-parts/home/modal_category_item', null, array('term' => $term));
                    $modal .= ob_get_contents();
                    ob_end_clean();
                    ?>
                    <div class="item_slide">
                        <a href="<?php echo get_term_link($term); ?>">
                            <div class="thumb">
                                <?php echo get_acf_img_tag('list_thumb', $term, $term->name . 'のサムネイル'); ?>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            <!--      List brand banners        -->
            <?php if (have_rows('home_brand_banners', 'option')): ?>
                <div class="list_brand">
                    <?php while (have_rows('home_brand_banners', 'option')) :
                        the_row();
                        $banner_img = get_sub_field('banner_image');
                        $banner_title = get_sub_field('banner_title');
                        $banner_desc = get_sub_field('banner_desc');
                        $banner_url = get_sub_field('banner_url');
                        ?>
                        <div class="item_brand">
                            <a href="<?php echo $banner_url ?>">
                                <div class="thumb">
                                    <img src="<?php echo $banner_img ?>" width="430" height="180"
                                         alt="<?php echo $banner_title ?>">
                                </div>
                            </a>
                            <div class="txt_desp">
                                <a href="<?php echo $banner_url ?>">
                                    <h3><?php echo $banner_title ?></h3>
                                </a>
                                <p><?php echo $banner_desc ?></p>
                            </div>

                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>


            <?php get_template_part('template-parts/home/modal_category', null, array('title' => 'BS12おすすめ番組', 'modal' => $modal)); ?>
        </div>
    </section>
<?php
endif; ?>