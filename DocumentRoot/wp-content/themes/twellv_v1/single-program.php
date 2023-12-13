<?php /* -*- coding: utf-8; mode: web; -*- */
$page_format = get_post_format();
//var_dump($page_format);
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
// 番組カテゴリ
$category_term = get_term_by('id', $program_term->parent, 'program_cat');

//var_dump( $page_format );
?>
    <!-- main -->
    <main id="main">
        <div class="breadcrumb">
            <ul>
                <li>
                    <a href="<?php echo esc_url(home_url('/')) ?>">BS12 | BS無料放送ならBS12 トゥエルビ</a>
                </li>
                <li>
                    <a href="<?php echo esc_url(home_url('/program/'.$category_term->slug)) ?>"><?php echo $category_term ->name ?></a>
                </li>
                <li>
                    <a href="<?php echo esc_url(home_url('/program/'.$category_term->slug.'/'.$program_term ->slug)) ?>"><?php echo $program_term ->name ?></a>
                </li>
                <?php if ($page_format === 'gallery'): ?>
                    <li>
                        <a href="<?php echo esc_url(home_url('/program/'.$category_term->slug.'/'.$program_term ->slug.'/archive-'.$program_term ->slug)) ?>">放送ラインアップ</a>
                    </li>
                <?php endif; ?>
                <li>
                    <span><?php the_title(); ?></span>
                </li>
            </ul>
        </div>
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
        <!-- Google ads here-->
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
        <!-- other -->
        <?php get_template_part('template-parts/home/other_top', null, array('type' => 'famous')); ?>
        <!-- /other -->
        <!--/correlation diagrams-->
    </main>
<?php
get_footer();
