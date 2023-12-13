<?php
$archive_term = get_queried_object();
$program_term = get_term_by('id', $archive_term->parent, 'program_cat');
$category_term = get_term_by('id', $program_term->parent, 'program_cat');
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
            <li>
                <span>放送ラインアップ</span>
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
    <div class="program-contents-wrap">
        <?php if (get_field('display_under_construction', $program_term)) { ?>
            <div class="caution">
                <p>ただいまページ移行作業中につき、表示が崩れている場合がございます。<br>大変申し訳ありませんが今しばらくお待ちください。</p>
            </div>
        <?php } ?>
        <h2 class="heading-title_lv1"><?php echo $archive_term->name; ?></h2>

        <?php
        // WYSIWYG
        $archive_top_text = get_field('archive_top_text', $archive_term);
        if ($archive_top_text) {
            echo '<div class="text-wrap">';
            echo add_tag_custom_class($archive_top_text);
            echo '</div>';
        }
        ?>

        <!-- 番組名％％ の放送ラインナップ -->
                <?php
                // ↓↓【ザ・カセットテープ・ミュージック】番組ページ改修 リスト表示デザイン変更処理 add 20200214 yanagi
                $archive_bullet_design = get_field('archive_bullet_design', $archive_term);
                if ($archive_bullet_design) {
                    ?>
                    <section class="section" id="limited_rewards">
                        <div class="inner">
                            <ul>
                                <?php
                                while (have_posts()) {
                                    the_post();
                                    get_template_part('template-parts/program/bullet', 'item');
                                }
                                ?>
                            </ul>

                            <!--       Paging             -->
                            <?php
                            $total_pages = $the_query->max_num_pages;
                            if (function_exists('custom_pagination')) :
                                custom_pagination($total_pages, 1, $paged);
                            endif;
                            ?>
                            <!--       /Paging             -->
                        </div>
                    </section>
                    <?php
                } else {
                    // ↑↑【ザ・カセットテープ・ミュージック】番組ページ改修 リスト表示デザイン変更処理 add 20200214 yanagi
                    ?>
                    <section class="section" id="episode">
                        <div class="inner">
                            <div class="list_episode">
                                <ul>
                                    <?php
                                    while (have_posts()) {
                                        the_post();
                                        get_template_part('template-parts/program/lineup', 'item');
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div class="btn_all">
                                <span>もっと見る</span>
                            </div>
                        </div>
                    </section>
                    <?php
                }
                ?>

        <!-- /番組名％％ の放送ラインナップ -->
        <?php   get_template_part('template-parts/program/share-buttons', null, ['isSimple' => true]);
        ?>
    </div>


    <?php
    get_template_part('template-parts/ranking/ranking', null, array('cat' => $category_term->slug, 'title' => $category_term->name . 'ランキング', 'sns' => false)); ?>
    <!-- /cat ranking -->
    <!-- ranking -->
    <?php get_template_part('template-parts/ranking/ranking', null, array('cat' => 'all', 'title' => 'ランキング', 'sns' => false)); ?>
    <!-- /ranking -->
    <?php get_template_part('template-parts/top', 'recommend-you-programs'); ?>
    <!-- /BS12おすすめ番組 -->
    <!-- other -->
    <?php get_template_part('template-parts/home/other_top'); ?>
    <!-- /other -->
    <!--/correlation diagrams-->
</main>