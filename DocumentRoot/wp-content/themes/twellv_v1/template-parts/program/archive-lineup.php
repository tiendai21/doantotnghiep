<?php
$archive_term = get_queried_object();
$program_term = get_term_by('id', $archive_term->parent, 'program_cat');
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
        <section class="section-wrap">
            <div class="program-list-wrap">
                <?php
                // ↓↓【ザ・カセットテープ・ミュージック】番組ページ改修 リスト表示デザイン変更処理 add 20200214 yanagi
                $archive_bullet_design = get_field('archive_bullet_design', $archive_term);
                if ($archive_bullet_design) {
                    ?>
                    <div class="program2-list w320 type-B">
                        <?php
                        while (have_posts()) {
                            the_post();
                            get_template_part('template-parts/program/bullet', 'item');
                        }
                        ?>
                    </div>
                    <?php
                } else {
                    // ↑↑【ザ・カセットテープ・ミュージック】番組ページ改修 リスト表示デザイン変更処理 add 20200214 yanagi
                    ?>

                    <div class="program-list w320 type-B">

                    </div>
                    <?php
                }
                ?>
            </div>

        </section>
        <section class="section" id="episode">
            <div class="inner">
                <h2>エピソード</h2>
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
                    <span>エピソードをすべて見る</span>
                </div>
            </div>
        </section>
        <!-- /番組名％％ の放送ラインナップ -->


        <?php
        $archive_bottom_text = get_field('archive_bottom_text', $archive_term);
        if ($archive_bottom_text) {
            echo '<div class="text-wrap">';
            echo add_tag_custom_class($archive_bottom_text);
            echo '</div>';
        }
        ?>
        <?php
        //【施策ID：49-4】ハワイコラム対策：番組紹介コンテンツおよびリンク動線追加 add ishizaki20200420↓
        $link_programtop_under = get_field('link_programtop_under', $program_term);
        if ($link_programtop_under) {
            $img = get_field('list_thumb', $program_term);
            ?>
            <div class="program-list-wrap category-top-link">
                <div class="program-list w320 type-C card">
                    <article class="item">
                        <a href="<?php echo get_term_link($program_term); ?>">
                            <figure>
                                <div class="img"><img src="<?php echo $img['url'] ?>"
                                                      alt="<?php echo $program_term->name; ?>"></div>
                                <figcaption class="text-block">
                                    <div class="heading">
                                        <p class="program-title"><?php echo $program_term->name; ?></p>
                                        <p class="onair-date"><?php echo get_field('onairtime', $program_term); ?></p>
                                    </div>
                                    <p class="description"><?php echo get_field('pg_text', $program_term); ?></p>
                                    <p class="btn"><span><?php echo $program_term->name; ?>TOPへ</span></p>
                                </figcaption>
                            </figure>
                        </a>
                    </article>
                </div>
            </div>
            <?php
        }
        //add ishizaki20200420↑
        ?>

        <?php get_template_part('template-parts/program/share', 'buttons'); ?>

    </div>


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