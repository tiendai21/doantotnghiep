<?php // echo '各番組トップ';
$term = get_queried_object();
$parent_term = get_term_by('id', $term->parent, 'program_cat');
//var_dump($term);
?>
<!-- main -->
<main id="main">
    <div class="breadcrumb">
        <ul>
            <li>
                <a href="#">BS12 | BS無料放送ならBS12 トゥエルビ</a>
            </li>
            <li>
                <a href="#">韓国・韓流ドラマ</a>
            </li>
            <li>
                <span><?php echo $term->name ?></span>
            </li>
        </ul>
    </div>

    <?php $bg_style = get_program_bg_style($term);
    global $bs12_program_top_parts_arr;
    $bs12_program_top_parts_arr = [];
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            // var_dump( get_the_title() );
            if (get_post_format(get_the_ID()) === 'aside') {
                $bs12_program_top_parts_arr['top'] = get_post();
            } elseif (get_post_format(get_the_ID()) === 'image') {
                $bs12_program_top_parts_arr['nav'] = get_post();
            }
        }
    }
    //ログインしていない、かつ、トップページ属性の記事が公開ではない(＝getpost出来ない)の場合に404リダイレクトする。add yanagi 20190822
    if (!is_user_logged_in() && !isset($bs12_program_top_parts_arr['top'])) {
        wp_redirect(home_url('/404/'), 404);
        exit;
    }
    wp_reset_postdata();
    $html_area = get_field('html_area', $bs12_program_top_parts_arr['top']->ID);
    if (trim($html_area) == '') :
        // htmlがない場合は表示
        ?>
        <section class="section" id="banner">
            <div class="inner">
                <div class="banner" style="background-color: <?php echo get_field('bg_color', $term) ? get_field('bg_color', $term) : '#630307'?> ">
                    <div class="txt_desp">
                        <h2><?php echo $term->name; ?></h2>
                        <div class="date">
                            <h4><?php echo get_field('onairtime', $term); ?></h4>
                            <?php
                            function getStringBetween($string, $start, $end)
                            {
                                $startPos = strpos($string, $start);
                                $endPos = strpos($string, $end, $startPos + strlen($start));
                                return ($startPos === false || $endPos === false) ? false : substr($string, $startPos + strlen($start), $endPos - $startPos - strlen($start));
                            }

                            $og_txt = get_field('pg_text', $term);
                            $mod_txt = $og_txt;

                            $genre_str = explode('ジャンル：', $og_txt)[1];
                            if ($genre_str) {
                                $genre_arr = explode('、', $genre_str);
                                foreach ($genre_arr as $index => $genre) {
                                    $genre_arr[$index] = "<a target='_blank' href=" . esc_url(home_url('/')) . "search/?q={$genre}'>" . $genre . "</a>";
                                }
                                $mod_txt = str_replace('ジャンル：' . $genre_str, 'ジャンル：' . implode('、', $genre_arr), $mod_txt);
                            }


                            $actor_str = getStringBetween($og_txt, '出演：', "<br />");
                            if ($actor_str) {
                                $actor_arr = explode('、', $actor_str);
                                foreach ($actor_arr as $index => $actor) {
                                    $actor_arr[$index] = "<a target='_blank' href=" . esc_url(home_url('/')) . "search/?q={$actor}'>" . $actor . "</a>";
                                }
                                $mod_txt = str_replace('出演：' . $actor_str, '出演：' . implode('、', $actor_arr), $mod_txt);
                            }

                            ?>
                            <p class="util_pc"><?php echo $mod_txt ?></p>
                        </div>
                        <?php get_template_part('template-parts/program/share', 'buttons'); ?>
                    </div>
                    <div class="thumb">
                        <?php echo get_program_thumbnail($term, 'top'); ?>
                    </div>
                </div>
                <?php get_template_part('template-parts/program-nav'); ?>
                <?php get_template_part('template-parts/program/next-episode'); ?>
            </div>
        </section>
        <?php // 番組トップページ要素を表示
        get_template_part('template-parts/program', 'front-page'); ?>
    <?php else:
        echo $html_area;
    endif;
    ?>


    <!-- Below content-->
    <?php if ($parent_term->slug !== 'entertainment') :
        ?>

        <?php //BS12_RENEWAL-269 【タスク】レイアウト変更ならびにWP機能追加 edit 20201012 yanagi
        ?>
        <!-- こちらもおすすめ -->
        <?php display_program_recommend_often_watch_by_category_slug($term);
        ?>
        <!-- brand -->
        <?php get_template_part('template-parts/home/brand-banner'); ?>
        <!-- /brand -->
        <!-- cat ranking -->
        <?php get_template_part('template-parts/ranking/ranking', null, array('cat' => $parent_term->slug, 'title' => $parent_term->name . 'ランキング', 'sns' => false)); ?>
        <!-- /cat ranking -->
        <!-- ranking -->
        <?php get_template_part('template-parts/ranking/ranking', null, array('cat' => 'all', 'title' => 'ランキング', 'sns' => false)); ?>
        <!-- /ranking -->
        <!-- BS12おすすめ番組 -->
        <?php get_template_part('template-parts/top', 'recommend-you-programs'); ?>
        <!-- /BS12おすすめ番組 -->
        <!-- other -->
        <?php get_template_part('template-parts/home/other_top'); ?>
        <!-- /other -->
    <?php endif; ?>
</main>
<!-- /main -->

