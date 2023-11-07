<section class="section" id="news">
    <div class="inner">
        <div class="tlt_section">
            <h2>新着情報</h2>
            <div class="btn_more">
                <a href="<?php echo esc_url(home_url('/news/whatsnew'))?>">
                    すべて見る
                </a>
            </div>
        </div>
        <?php
/* トップ新着 */
$args = [
    'post_type' => 'news',
    'posts_per_page' => 6,
//    'tax_query' => [
//        [
//            'taxonomy' => 'news_cat',
//            'field' => 'slug',
//            'terms' => ['whatsnew']
//        ]
//    ]
];
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) : ?>
    <div class="program_slide slide_news">
        <?php
        while ( $the_query->have_posts() ) : $the_query->the_post();
            $link_url = get_permalink();
            $pdf = get_field( 'pdf');
            $url = get_field( 'url' );
            $class_pdf = '';
            if( $pdf ) {
                $link_url = $pdf['url'];
                $class_pdf = 'pdf';
            } elseif( $url ) {
                $link_url = $url;
            }
            $target_blank = get_field( 'target_blank' ) ? ' target="_blank" ' : '';
            ?>
            <div class="item_slide">
                <a href="<?php echo $link_url; ?>" <?php echo $target_blank; ?>>
                    <div class="thumb">
                        <?php echo get_acf_img_tag( 'thumbnail', null, get_the_title() . 'のサムネイル' ); ?>
                    </div>
                    <div class="txt_desp">
                        <span><?php echo get_field( 'display_date' ); ?></span>
                        <p <?php echo $class_pdf; ?>><?php echo get_whatsnew_title( get_the_title() ); ?></p>
                    </div>
                </a>
            </div>
        <?php
        endwhile;
        wp_reset_postdata();
        ?>
    </div>
    <?php endif; ?>
    </div>
</section>