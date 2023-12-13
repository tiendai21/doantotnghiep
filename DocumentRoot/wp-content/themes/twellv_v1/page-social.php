<?php
get_header();
?>

    <!-- main -->
    <main id="main">
        <div class="breadcrumb">
            <ul>
                <li>
                    <a href="<?php echo esc_url(home_url('/')) ?>">BS12 | BS無料放送ならBS12 トゥエルビ</a>
                </li>
                <li>
                    <span>Twitter・Facebook・Instagramアカウント一覧</span>
                </li>
            </ul>
        </div>
        <!--content-->
        <section class="section" id="list_account_content">
            <div class="inner">
                <div class="tlt_head">
                    <h2>Twitter・Facebook・Instagramアカウント一覧</h2>
                </div>
                <div class="list_content">
                    <ul>
                        <?php
                        $args = ['taxonomy' => 'program_cat',
                            'hide_empty' => false,
                            'meta_query' => [
                                'relation' => 'OR',
                                [
                                    'key' => 'twitter_url',
                                    'value' => '',
                                    'compare' => '!='
                                ],
                                [
                                    'key' => 'facebook_url',
                                    'value' => '',
                                    'compare' => '!='
                                ]
                            ]
                        ];

                        $term_query = new WP_Term_Query($args);
                        if (!empty($term_query) && !is_wp_error($term_query)) :
                            foreach ($term_query->get_terms() as $term) :
                                ?>
                                <li>
                                    <div class="thumb">
                                        <?php echo get_acf_img_tag('list_thumb', $term, $term->name . 'のサムネイル'); ?>
                                    </div>
                                    <div class="txt_desp">
                                        <h3><?php echo $term->name; ?></h3>
                                        <span><?php echo get_field('sns_text', $term); ?></span>
                                        <div class="social">
                                            <ul>
                                                <?php
                                                $twitter_url = get_field('twitter_url', $term);
                                                if ($twitter_url != '') {
                                                    ?>
                                                    <li>
                                                        <a href="<?php echo $twitter_url; ?>">
                                                            <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/icon_insta.svg' ?>"
                                                                 width="60"
                                                                 height="60"
                                                                 alt="icon social twitter">
                                                        </a>
                                                    </li>
                                                    <?php
                                                }
                                                ?>
                                                <?php
                                                $facebook_url = get_field('facebook_url', $term);
                                                if ($facebook_url != '') {
                                                    ?>
                                                    <li>
                                                        <a href="<?php echo $facebook_url; ?>">
                                                            <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/icon_fb_a.svg' ?>"
                                                                 width="83"
                                                                 height="83"
                                                                 alt="icon social facebook">
                                                        </a>
                                                    </li>
                                                    <?php
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach;
                        endif; ?>
                    </ul>
                </div>
            </div>
        </section>
        <!--/content-->
        <!-- program air -->
        <?php get_template_part('template-parts/home/program_air_top', null, array('hideBtnWatch' => true)); ?>
        <!-- /program air -->

        <!-- news -->
        <?php get_template_part('template-parts/news/news_top'); ?>
        <!-- /news -->

        <!-- ranking -->
        <?php get_template_part('template-parts/ranking/ranking', null, array('cat' => 'all', 'title' => 'ランキング', 'sns' => false)); ?>
        <!-- /ranking -->
    </main>
    <!-- /main -->


<?php
get_footer();
