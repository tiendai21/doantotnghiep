<?php /* -*- coding: utf-8; mode: web; -*- */
$page_format = get_post_format();
/*
 * トップとナビゲーションを表示しようとした場合、番組トップへリダイレクト
 */
if (get_post_format(get_the_ID()) === 'image' || get_post_format(get_the_ID()) === 'aside') {
    $terms = get_the_terms(get_the_ID(), 'program_cat');
    if (!empty($terms)) {
        wp_safe_redirect(get_term_link($terms[0]), 301);
        exit;
    }
}

get_header();

$terms = get_the_terms(get_the_ID(), 'program_cat');
$program_term = null;
$this_term = $terms[0];
foreach ($terms as $t) {
    $code = get_field('code', $t);
    if ((int)$code > 0) {
        $program_term = $t;
    } else {
        $this_term = $t;
    }
}
if ($program_term === null) {
    $parent_term = get_term_by('id', $this_term->parent, 'program_cat');
    if (get_field('code', $parent_term) > 0) {
        $program_term = $parent_term;
    }
}
// var_dump( $program_term );
// 番組カテゴリ
$category_term = get_term_by('id', $program_term->parent, 'program_cat');
?>
    <!-- main -->
    <main id="main">
        <ul class="breadcrumb">
            <li>
                <a href="#">BS12 | BS無料放送ならBS12 トゥエルビ</a>
            </li>
            <li>
                <a href="#">ドラマ・映画</a>
            </li>
            <li class="util_pc">
                <a href="#">韓国・韓流ドラマ</a>
            </li>
            <li class="util_pc">
                <a href="#">悪の花</a>
            </li>
            <li class="util_pc">
                <span>相関図</span>
            </li>
            <li class="util_sp">
                <a href="#">韓国</a>
            </li>
        </ul>
        <!--banner-->
        <?php $bg_style = get_program_bg_style($program_term); ?>
        <?php
        $html_area = get_field('html_area');
        if ($html_area == '') :
            ?>
            <section class="section" id="banner">
                <div class="inner">
                    <div class="thumb">
                        <?php
                        // pcとspで分離する?
                        echo get_acf_img_tag('main_visual_under',
                            $program_term,
                            $program_term->name . 'メインビジュアル',
                            'util_pc'
                        );
                        echo get_acf_img_tag('main_visual_under_sp',
                            $program_term,
                            $program_term->name . 'メインビジュアル',
                            'util_sp'
                        );
                        ?>
                    </div>
                    <?php display_program_navi($program_term); ?>
                </div>
            </section>

        <?php
        endif;
        ?>
        <!--/banner-->
        <?php if ($page_format === 'chat'): ?>
            <!--correlation diagrams-->
            <section class="section" id="correlation_diagrams">
                <div class="inner">
                    <?php if ($html_area) {
                        echo $html_area;
                    } else {

                        while (have_posts()) {
                            the_post();
                            ?>
                            <span class="onair-date"><?php echo get_field('onairtime'); ?></span>
                            <h2><?php the_title(); ?></h2>
                            <?php
                            if (have_rows('page_flex_content', get_the_ID())) {
                                while (have_rows('page_flex_content', get_the_ID())) {
                                    the_row();
                                    $layout = get_row_layout();
                                    get_template_part('template-parts/program/layouts/' . $layout);
                                }
                            }
                        }
                    }
                    get_template_part('template-parts/program/share-buttons', null, ['isSimple' => true]);
                    ?>
                </div>
            </section>
            <!-- cat ranking -->
        <?php endif; ?>
        <?php if ($page_format === 'gallery'): ?>
            <!--   archive episode      -->
            <!--correlation diagrams-->
            <section class="section" id="archive_episode">
                <div class="inner">
                    <?php if ($html_area) {
                        echo $html_area;
                    } else {

                        while (have_posts()) {
                            the_post();
                            ?>
                            <span class="onair-date"><?php echo get_field('onairtime'); ?></span>
                            <h2><?php the_title(); ?></h2>
                            <?php
                            if (have_rows('page_flex_content', get_the_ID())) {
                                while (have_rows('page_flex_content', get_the_ID())) {
                                    the_row();
                                    $layout = get_row_layout();
                                    get_template_part('template-parts/program/layouts/' . $layout);
                                }
                            }
                        }
                    }
                    get_template_part('template-parts/program/share-buttons', null, ['isSimple' => true]);
                    ?>
                </div>
            </section>
            <!--   /archive episode      -->
        <?php endif; ?>

        <!--      List brand banners        -->
        <?php get_template_part('template-parts/home/brand-banner'); ?>
        <!--      /List brand banners        -->
        <!--   Social banners     -->
        <?php if (have_rows('home_social_banners', 'option') && !$hideSocial): ?>
            <div class="list_social util_pc">
                <ul>
                    <?php while (have_rows('home_social_banners', 'option')) :
                        the_row();
                        $social_banner_img = get_sub_field('social_banner_image');
                        $social_banner_url = get_sub_field('social_banner_url');
                        ?>
                        <li>
                            <a href="<?php echo $social_banner_url?>">
                                <img src="<?php echo $social_banner_img ?>" width="420" height="105" alt="social_banner_img">
                            </a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        <?php endif; ?>
        <!--   /Social banner     -->
        <!-- cat ranking -->
        <?php
        get_template_part('template-parts/ranking/ranking', null, array('cat' => $category_term->slug, 'title' => $category_term->name . 'ランキング', 'sns' => false)); ?>
        <!-- /cat ranking -->
        <!-- ranking -->
        <?php get_template_part('template-parts/ranking/ranking', null, array('cat' => 'all', 'title' => 'ランキング', 'sns' => false)); ?>
        <!-- /ranking -->
        <!-- BS12おすすめ番組 -->
        <?php get_template_part('template-parts/top', 'recommend-you-programs'); ?>
        <!-- /BS12おすすめ番組 -->
        <!-- pr -->
        <?php get_template_part('template-parts/home/pr_top'); ?>
        <!-- /pr -->
        <!-- other -->
        <?php get_template_part('template-parts/home/other_top'); ?>
        <!-- /other -->
        <!--/correlation diagrams-->
    </main>
<?php
get_footer();
