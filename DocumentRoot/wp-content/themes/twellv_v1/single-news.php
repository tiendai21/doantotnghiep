<?php
get_header();
$terms = get_the_terms(get_the_ID(), 'news_cat');
$t = $terms[0];
// var_dump( $t );
$year = get_the_time('Y');

/* BS12_RENEWAL-194 【施策ID：29-1】新着情報詳細ページ > パンくずリスト変更 */
/* add 20200227 yanagi ↓↓ */
$relate_program = get_field('relate_program');
if ($relate_program) {
    $relate_term = get_term_by('id', $relate_program, 'program_cat');

    $relate_term_id = esc_html($relate_term->term_id);
    $relate_term_idsp = "program_cat_" . $relate_term_id; // アンダーバー（_）は必須

    $relate_term_code = get_field('code', $relate_term_idsp);
    if ((int)$relate_term_code > 0) {

        $parent_term = get_term_by('id', $relate_term->parent, 'program_cat');

        $relate_parent_term_idsp = "program_cat_" . $relate_term_id; // アンダーバー（_）は必須
        if (get_field('code', $relate_parent_term_idsp, 'program_cat') > 0) {
            $program_parent_term = $parent_term;
        }
    }
}
?>
    <!-- main -->
    <main id="main">
        <ul class="breadcrumb">
            <li><a href="/"><?php bs12_pankuzu_text_top() ?></a></li>
            <?php if ($t->slug === 'whatsnew') { ?>
                <?php
                if ((int)$relate_term_code > 0) {
                    ?>
                    <?php if (preg_match('/(korea|china)/', $program_parent_term->slug)) { ?>
                        <li><a href="/program/drama/">ドラマ・映画</a></li>
                    <?php } ?>
                    <?php if (strpos($relate_term->slug, 'baseball') === false) { ?>
                        <li>
                            <a href="<?php echo get_term_link($program_parent_term); ?>"><?php echo $program_parent_term->name; ?></a>
                        </li>
                    <?php } ?>
                    <li class="util_pc"><a href="<?php echo get_term_link( $relate_term ); ?>"><?php echo $relate_term->name; ?></a></li>
                    <?php
                } else {
                    ?>
                    <li><a href="<?php echo get_term_link($t); ?>"><?php echo $t->name; ?>一覧</a></li>
                    <li><a href="/news/<?php echo $t->slug; ?>/date/<?php echo $year; ?>"><?php echo $year; ?>年</a></li>
                <?php } ?>
            <?php } elseif ($t->slug === 'release') { ?>
                <li><a href="<?php echo get_term_link($t); ?>"><?php echo $t->name; ?>一覧</a></li>
                <li><a href="/news/<?php echo $t->slug; ?>/#<?php echo $year; ?>"><?php echo $year; ?>年</a></li>
            <?php } ?>
            <li class="util_pc"><span><?php the_title(); ?></span></li>
        </ul>

        <section class="section" id="news_detail">
            <div class="inner">
                <div class="tlt">
                    <span><?php echo get_field('display_date'); ?></span>
                    <p><?php the_title(); ?></p>
                </div>
                <div class="social">
                    <a href="https://twitter.com/share?url=<?php the_permalink(); ?>" target="_blank">
                        <!--                        <img src="-->
                        <?php //echo get_stylesheet_directory_uri() . '/assets/images/icon_tw_a.svg' ?><!--" width="" height="" alt="">-->
                    </a>
                    <a href="https://www.facebook.com/share.php?u=<?php the_permalink(); ?>" target="_blank">
                        <!--                        <img src="-->
                        <?php //echo get_stylesheet_directory_uri() . '/assets/images/icon_fb_a.svg' ?><!--" width="" height="" alt="">-->
                    </a>
                    <a href="http://line.me/R/msg/text/?<?php the_title(); ?>%0D%0A<?php the_permalink(); ?>"
                       target="_blank">
                        <!--                        <img src="-->
                        <?php //echo get_stylesheet_directory_uri() . '/assets/images/icon_line.svg' ?><!--" width="" height="" alt="">-->
                    </a>
                </div>
                <?php $thumb = get_field("thumbnail");
                if ($thumb) :
                    ?>
                    <div class="thumb">
                        <img src="<?php echo $thumb["url"] ?>" alt="<?php echo $thumb["title"] ?>">
                    </div>
                <?php endif; ?>
                <div class="content">
                    <?php
                    $content = get_field('content_text');
                    if ($t->slug === 'whatsnew') {
                        $content = str_replace('BS12トゥエルビ', '<a href="/">BS12トゥエルビ</a>', $content);
                        $content = str_replace('BS12 トゥエルビ', '<a href="/">BS12 トゥエルビ</a>', $content);
                    }
                    $content = preg_replace('/<table ("[^"]*"|\'[^\']*\'|[^\'">])*>/', '<table>', $content);
                    echo add_tag_custom_class($content);
                    ?>
                </div>
            </div>
        </section>

        <!-- pr -->
        <?php get_template_part('template-parts/home/pr_top'); ?>
        <!-- /pr -->

        <!-- other -->
        <?php get_template_part('template-parts/news/single_whatsnew_other_list'); ?>
        <!-- /other -->
    </main>
    <!-- /main -->

<?php
get_footer();