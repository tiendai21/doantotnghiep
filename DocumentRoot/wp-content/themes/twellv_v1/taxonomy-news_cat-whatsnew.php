<?php
get_header();

$term_obj = get_queried_object();

$year = get_query_var( 'year');
?>
    <!-- main -->
    <main id="main">
        <div class="breadcrumb">
            <ul>
                <li>
                    <a href="<?php echo esc_url(home_url('/'))?>"><?php  bs12_pankuzu_text_top(); ?></a>
                </li>
                <li>
                    <span>新着情報、プレスリリース</span>
                </li>
                <?php if ( $year ) : ?>
                    <li><?php echo $year; ?>年</li>
                <?php endif; ?>
            </ul>
        </div>
        <section class="section" id="list_new">
            <div class="inner">
                <h1>新着情報 | プレスリリース</h1>
                <div class="list_year">
                    <ul>
                        <?php
                        $whats_new_list = wp_get_archives(
                            [
                                'type' => 'yearly',
                                'show_post_count' => false,
                                'post_type' => 'news',
                                'taxonomy' => 'news_cat',
                                'slug' => 'whatsnew',
                                'echo' => false
                            ]);
                        $whats_new_list = str_replace('</a>', '年</a>', $whats_new_list );
                        $whats_new_list = str_replace('/news/', '/news/whatsnew/', $whats_new_list );
                        echo $whats_new_list;
                        ?>
                    </ul>
                </div>
                <div class="list_news">
                    <ul>
                        <?php while( have_posts() ) : the_post();
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
                            <li>
                                <a href="<?php echo $link_url; ?>" <?php echo $target_blank; ?> >
                                    <div class="thumb">
                                        <?php echo get_acf_img_tag('thumbnail', get_the_id(), get_the_title().'のサムネイル'); ?>
                                    </div>
                                    <div class="txt_desp">
                                        <h4><?php echo get_field( 'display_date' ); ?></h4>
                                        <p><?php echo get_whatsnew_title( get_the_title() ); ?></p>
                                    </div>
                                </a>
                            </li>
                        <?php
                        endwhile;
                        ?>
                    </ul>
                    <div class="util_sp">
                        <div class="btn_link">
                            <div class="btn_more">
                                <a href="<?php echo esc_url(home_url('/news/whatsnew/'))?>">もっと見る</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- other -->
        <?php get_template_part('template-parts/home/other_top', null, array('type' => 'all')); ?>
        <!-- /other -->
    </main>
    <!-- /main -->

<?php
get_footer();
