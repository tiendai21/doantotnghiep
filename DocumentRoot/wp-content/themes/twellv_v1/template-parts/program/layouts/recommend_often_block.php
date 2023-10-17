<?php
/**
 * 指定されたカテゴリのお客様の声を表示
 * @param $slug string 対象番組のtermオブジェクト
 * 
 *  1.①かつ②の条件の番組選択順に表示する。
 *  ① こちらもおすすめに表示する項目にチェックが付いている番組。
 * 
 * add function 20210210 yanagi
 * BS12_RENEWAL-279 【BS12相談】⑦「こちらもおすすめ」エリア追加
 * 
 */
if ( get_sub_field( 'recommend_often_watch' ) ) {
    $recommend_often_watch = get_sub_field( 'recommend_often_watch' );
    foreach ($recommend_often_watch as $v) {
        $term = get_term_by('id', $v, 'program_cat');
        $program_term_ids[] = $v;
    }
    $args = [
        'taxonomy' => 'program_cat',
        'include' => $program_term_ids,
        // 'hide_empty' => false,
        'meta_query' => [
            // 'relation' => 'AND',
            [
                'key' => 'onair',
                'value' => [1, 2], //「放送予定」、または、「放送中」
                'compare' => 'IN'
            ],
        ]
    ];

    $term_query = new WP_Term_Query($args);

    //var_dump($term_query);
    if (!empty($term_query) && !is_wp_error($term_query)) {
        $term_arr = [];
        foreach ($term_query->get_terms() as $t) {
            $term_arr[] = $t;
        }
?>

    <div class="program-list-wrap">
		<h2 class="section-ttl">現在放送中のおすすめ番組</h2>

		<div class="program-list w320 type-B slider">

        <?php foreach ($term_arr as $term) { ?>
                        <article class="item">
                            <a href="<?php echo get_term_link($term); ?>">
                                <figure>
                                    <div class="img"><?php echo get_acf_img_tag('list_thumb', $term, $term->name . 'のサムネイル'); ?></div>
                                    <figcaption class="text-block">
                                        <div class="heading">
                                            <p class="category"><?php echo get_term($term->parent, 'program_cat')->name; ?></p>
                                            <h3 class="program-title"><?php echo $term->name; ?></p>
                                                <p class="onair-date"><?php echo get_field('airtime', $term); ?></p>
                                        </div>
                                        <p class="description"><?php echo get_field('pg_text', $term); ?></p>
                                    </figcaption>
                                </figure>
                            </a>
                        </article>
                    <?php } ?>
			<!-- 以下、<article>繰り返し -->
		</div>
	</div>

<?php
    }
}