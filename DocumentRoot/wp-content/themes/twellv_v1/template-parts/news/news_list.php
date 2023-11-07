<?php /* -*- coding: utf-8 -*- */
/* お知らせ */
$args = [
    'post_type' => 'news',
    'posts_per_page' => -1,
    'tax_query' => [
        [
            'taxonomy' => 'news_cat',
            'field' => 'slug',
            'terms' => ['announce']
        ]
    ]
];
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) : ?>
    <div class="news">
        <ul>
            <?php
            while ( $the_query->have_posts() ) : $the_query->the_post();
                $title = get_the_title();
                $class_pdf = '';
                $pdf_url = get_field( 'pdf' );
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
                    <a <?php
                    if ($link_url) {
                        echo 'href="' . $link_url . '" class="pdf"';
                    } else {
                        echo 'href="' . get_the_permalink() . '"';
                    }
                    ?>>
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