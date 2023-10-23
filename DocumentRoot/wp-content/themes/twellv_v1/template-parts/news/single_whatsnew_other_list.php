<?php
$args = [
    'post_type' => 'news',
    'posts_per_page' => 4,
    'post__not_in' => [ get_the_ID() ],
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
    ?>
    <section class="section-wrap">
        <div class="program-list-wrap">
            <h2 class="section-ttl">その他の新着情報</h2>

            <div class="program-mini-list twin">
                <?php
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();
                    get_template_part( 'template-parts/news/whatsnew', 'detail-a' );
                }
                ?>

            </div>
            <div class="btn-wrap w300">
                <p class="btn"><a href="/news/whatsnew/">新着情報一覧を見る</a></p>
            </div>
        </div>
    </section>
    <?php
}
