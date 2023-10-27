<?php /* おすすめ中国ドラマ */
/**
 * 1.①～③全て条件を満たした番組をカテゴリ順に表示する。
 *　① 親カテゴリに中国ドラマが選択されている。
 *  ② I-9-2.カテゴリおすすめ番組に表示する項目にチェックが付いている。
 *  ③ I-5.放送ステータスが「放送予定」、または、「放送中」である。
 */
$modal = "";
$program_cat_base_items = get_program_cat_base_items() ;
// var_dump( $program_cat_base_items );

$args = [
    'taxonomy' => 'program_cat',
    // 'hide_empty' => false,
    'parent' => $program_cat_base_items['china'], // 中国ドラマのterm_id
    'meta_query' => [
        'relation' =>'AND',
        [
            'key' => 'onair',
            'value' => [1, 2], // 放送予定か放送中
            'compare' => 'IN'
        ],
        [
            'key' => 'recommend_cat', // おすすめカテゴリ
            'value' => true,
            'compare' => '='
        ],
    ]
];
// var_dump( $args );
$term_query = new WP_Term_Query( $args );
if ( ! empty( $term_query ) && ! is_wp_error( $term_query ) ) :
    $term_arr = [];
    foreach ( $term_query->get_terms() as $t ) {
        $term_arr[] = $t;
    }
    usort( $term_arr, 'program_sort_by_term_order' );
    ?>
    <section class="section" id="chinese_drama">
        <div class="inner">
            <div class="tlt_section">
                <h2>中国・アジアドラマ</h2>
                <div class="btn_more">
                    <span>すべて見る</span>
                </div>
            </div>
            <div class="program_slide slide_chinese">
                <?php foreach ( $term_arr as $term ) :
                    ob_start();
                    get_template_part('template-parts/home/modal_category_item', null, array('term' => $term));
                    $modal .= ob_get_contents();
                    ob_end_clean();
                    ?>
                    <div class="item_slide">
                        <a href="<?php echo get_term_link( $term ); ?>">
                            <div class="thumb">
                                <?php echo get_acf_img_tag( 'list_thumb', $term, $term->name . 'のサムネイル' ); ?>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php get_template_part('template-parts/home/modal_category', null, array('title' => '中国・アジアドラマ','modal' => $modal)); ?>
        </div>
    </section>
    <?php
endif;