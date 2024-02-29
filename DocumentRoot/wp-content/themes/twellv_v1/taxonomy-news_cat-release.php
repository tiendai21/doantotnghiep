<?php
get_header();
?>
<?php
$args = [
    'post_type' => 'news',
    'posts_per_page' => -1,
    'tax_query' => [
        [
            'taxonomy' => 'news_cat',
            'field' => 'slug',
            'terms' => ['release']
        ]
    ]
];

$year_list = []; // 年度毎のニュース

$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) {
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
        $display_date = str_replace( '/', '.', get_field( 'display_date' ) );
        // $y = get_the_time( 'Y' );
        $y = substr( $display_date, 0, 4 );
        $item = [];
        $item['title'] = get_the_title();
        $item['date'] = $display_date;
        // リンク先
        $item['title_link_tag'] = get_news__title_link_tag();
        $year_list[$y][] = $item;
    }
}
?>
    <!-- main -->
    <main id="main">
        <div class="breadcrumb">
            <ul>
                <li>
                    <a href="<?php echo esc_url(home_url('/'))?>"><?php  bs12_pankuzu_text_top(); ?></a>
                </li>
                <li>
                    <span>ニュースリリース</span>
                </li>
            </ul>
        </div>
        <!--content-->
        <section class="section" id="content_news_release">
            <div class="inner">
                <div class="contain_head">
                    <div class="tlt_section">
                        <h2>ニュースリリース</h2>
                    </div>
                    <div class="list_year">
                        <ul>
                            <?php foreach ( $year_list as $year => $items ) : ?>
                                <li><a href="#<?php echo $year; ?>"><?php echo $year; ?>年</a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="list_introduce">
                    <ul>
                        <?php
                        foreach ( $year_list as $year => $items ) : ?>
                            <li id="<?php echo $year; ?>">
                                <h3><?php echo $year; ?>年</h3>
                                <ul>
                                    <?php foreach( $items as $item ) :?>
                                        <li>
                                            <a>
                                                <span><?php echo $item['date']; ?></span>
                                                <p><?php echo $item['title_link_tag']; ?></p>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>

                                </ul>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </section>
        <!--/content-->

        <!-- other -->
        <?php get_template_part('template-parts/home/other_top', null, array('type' => 'all')); ?>
        <!-- /other -->
    </main>
    <!-- /main -->

<?php
get_footer();
