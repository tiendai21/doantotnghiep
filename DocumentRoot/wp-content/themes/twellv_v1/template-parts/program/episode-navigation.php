<?php

/**
 * add function 20210210 yanagi
 * BS12_RENEWAL-277 【BS12相談】⑤各話ページに前後のリンク挿入
 */
$terms = get_the_terms(get_the_ID(), 'program_cat');
$oneNav = '';
$archive_term = $terms[0];
$kakuwa_posts = array();
$this_post_id = get_the_ID();

$args = [
    'post_type' => 'program',
    'posts_per_page' => -1,
    //'post__not_in' => [ get_the_ID() ],
    'tax_query' => [
        [
            'taxonomy' => 'program_cat',
            'field' => 'slug',
            'terms' => $archive_term->slug
        ]
    ],
    'orderby' => array('post_date' => 'DESC', 'ID' => 'DESC'),
];
$the_query = new WP_Query($args);
if ($the_query->have_posts()) {
    while ($the_query->have_posts()) {
        $the_query->the_post();
        if (get_post_format(get_the_ID()) === 'gallery') {
            $kakuwa_post['id'] = get_the_ID();
            $kakuwa_post['permalink'] = get_permalink();
            $kakuwa_posts[] = $kakuwa_post;
            //var_dump($kakuwa_post);
        }
    }
    wp_reset_postdata();
}
//全件取って前後を取得する処理を入れる
$kakuwa_posts = array_values($kakuwa_posts);
//echo '<pre>'.var_dump($kakuwa_posts).echo '</pre>';
$keyIndex = array_search($this_post_id, array_column($kakuwa_posts, 'id'));
if (array_key_exists($keyIndex - 1, $kakuwa_posts) || array_key_exists($keyIndex + 1, $kakuwa_posts)) {
    if (!array_key_exists($keyIndex - 1, $kakuwa_posts) || !array_key_exists($keyIndex + 1, $kakuwa_posts)) {
        $oneNav = "one-nav";
    }
    echo '<div class="episode-navigation '. $oneNav. '">' ;

    if (array_key_exists($keyIndex + 1, $kakuwa_posts)) {
        echo '<a class="prev" href="' . $kakuwa_posts[$keyIndex + 1]['permalink'] . '">前へ</a>';
    }
    if (array_key_exists($keyIndex - 1, $kakuwa_posts)) {
        echo '<a class="next" href="' . $kakuwa_posts[$keyIndex - 1]['permalink'] . '">次へ</a>';
    }
    echo '</div>';
}
