<?php /* -*- coding: utf-8 -*- */
/* ニュースリリース */
$args = [
    'post_type' => 'news',
    'posts_per_page' => 5,
    'tax_query' => [
        [
            'taxonomy' => 'news_cat',
            'field' => 'slug',
            'terms' => ['release']
        ]
    ]
];
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) : ?>
    <div class="list_news_release">
        <ul>
            <?php
            while ( $the_query->have_posts() ) : $the_query->the_post();
                $title = get_the_title();
                $class_pdf = '';
                $pdf_url = get_field( 'pdf' );
                $newsurl = get_news__title_link_tag();
                $link_url = null;
                if( $pdf_url ) {
                    $link_url = $pdf_url['url'];
                    $class_pdf = 'pdf';
                } else {
                    $url = get_field( 'url' );
                    if( $url ) {
                        $link_url = $url;
                    }
                }
                $target_blank = get_field( 'target_blank' ) ? ' target="_blank" ' : '';
                ?>
                <li>
                    <a href="<?php
                    if ( $link_url !== null ) {
                        echo sprintf( '%s', $link_url, $class_pdf, $target_blank, $title );
                    }
                    ?>">
                        <span><?php echo str_replace( '/', '.', get_field( 'display_date' ) ); ?></span>
                        <p><?php echo sprintf( '%s', $title ); ?></p>
                    </a>
                </li>
                <?php
            endwhile;
            wp_reset_postdata();
            ?>
        </ul>
    </div>
    <?php
endif;
