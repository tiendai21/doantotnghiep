<?php
$archive_term = get_queried_object();
$program_term = get_term_by( 'id', $archive_term->parent, 'program_cat' );
$category_term = get_term_by( 'id', $program_term->parent, 'program_cat' );
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