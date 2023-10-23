<?php
$args = [
    'post_type' => 'news',
    'posts_per_page' => 6,
    'tax_query' => [
        [
            'taxonomy' => 'news_cat',
            'field' => 'slug',
            'terms' => ['whatsnew']
        ]
    ]
];
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) {
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
        get_template_part( 'template-parts/news/whatsnew', 'detail-a' );
    }
    wp_reset_postdata();
}
