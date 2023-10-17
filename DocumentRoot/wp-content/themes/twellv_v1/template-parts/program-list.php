<?php /* -*- coding: utf-8 -*- */
// echo '番組リスト';
$term_list_object = get_queried_object();
$term_list_object_name = $term_list_object->name;

$terms = get_terms('program_cat');
usort($terms, 'program_sort_by_term_order');
// foreach ( $terms as $t ) { echo '<p>' . $t->name . ':' . $t->term_order . '</p>' ;}

// 表示対象以外の番組は後に表示する

$target_terms = [];
$other_terms = [];
foreach ($terms as $t) {
    if ($t->parent === $term_list_object->term_id) {
        $target_terms[] = $t;
    } else {
        $other_terms[] = $t;
    }
}

$terms = array_merge($target_terms, $other_terms);

$top_view = null;
$programs_arr = [];
foreach ($terms as $t) {
    if (is_display_program_archive($t, $term_list_object->term_id)) {
        // 対象カテゴリの番組または 親番組カテゴリ以外のアーカイブに表示するで指定された番組

        $status = (int) get_field('onair', $t); // 1: 放送予定, 2: 放送中, 3: 放送終了
        if ((int) $status > 0) {
            // 放送ステータスで分離
            $programs_arr[$status][] = $t;
        }
        if (
            $t->parent === $term_list_object->term_id
            && get_field('top_view', $t) && ($status === 1 || $status === 2)
        ) {
            /*
             * 番組 D
             * 1.①～③全て条件を満たした番組のカテゴリ順先頭の1件を表示する。
    　　     * ① 親カテゴリに当該カテゴリが選択されている。
    　       * ② I-10.番組カテゴリTOPのメインに表示する項目にチェックが付いている。
             * ③ I-5.放送ステータスが「放送予定」、または、「放送中」である。
             */
            $top_view = $t;
        }
    }
}
// var_dump( $programs_arr );

?>

<div id="tpl-topicpath">
    <div class="tpl-inner-wrap">
        <ul>
            <li><a href="/"><?php bs12_pankuzu_text_top(); ?></a> </li>
            <?php if (preg_match('/(korea|china)/', $term_list_object->slug)) { ?>
                <li><a href="/program/drama/">ドラマ・映画</a></li>
            <?php } ?>
            <li><?php echo esc_attr($term_list_object_name); ?></li>
        </ul>
    </div>
</div><!-- /tpl-topicpath -->


<div id="tpl-contents">
    <div class="tpl-inner-wrap">
        <h1 class="category-title"><?php echo esc_attr($term_list_object_name); ?></h1>
        <?php
        if ($top_view) {
        ?>
            <div class="category-hero-wrap">
                <section class="category-hero archive-mv">
                    <p class="img"><a href="<?php echo get_term_link($top_view); ?>"><?php echo get_program_thumbnail($top_view, 'top'); ?></a></p>
                    <div class="description">
                        <div class="heading">
                            <h2 class="title"><?php echo $top_view->name; ?></h2>
                            <p class="onair-date"><?php echo get_field('onairtime', $top_view); ?></p>
                            <p class="text"><?php echo get_field('pg_text', $top_view); ?></p>
                        </div>
                        <div class="btn-wrap w300">
                            <p class="btn"><a href="<?php echo get_term_link($top_view); ?>">番組詳細はこちら</a></p>
                        </div>
                    </div>
                </section>
            </div>
        <?php
        }
        ?>

        <?php
        /**
         * add 20200127 ishizaki ↓
         * BS12_RENEWAL-201 【施策ID：34-1】旅・グルメページ > 上部テキスト追加
         */
        $mv_bottom_text = get_field('mv_bottom_text_parent_cat', $term_list_object);
        if ($mv_bottom_text) {
        ?>
            <div class="program-list-mv-lead">
                <p><?php echo $mv_bottom_text; ?></p>
            </div>
        <?php }
        // add 20200127 ishizaki ↑
        ?>
		<?php
            // バナー
            get_template_part( 'template-parts/top', 'banner' );
		?>
        <!-- 放送中の韓国ドラマ -->
        <section class="section-wrap">
            <div class="program-list-wrap">
                <h2 class="section-ttl">放送中の<?php echo esc_attr($term_list_object_name); ?></h2>

                <div class="program-list w320 type-B slider">
                    <?php
                    if (!empty($programs_arr[2])) {
                        foreach ($programs_arr[2] as $t) {
                            tpl_program_list_item($t);
                        }
                    }
                    ?>
                </div>
            </div>

            <div class="btn-wrap w300">
                <p class="btn"><a href="/program_schedule/">番組表を見る</a></p>
            </div>
            <?php //BS12_RENEWAL-291 【施策6】よくある質問追加（カテゴリTOP) add 20210406 ishizaki　↓ ?>
            <div class="btn-wrap w300">
                <p class="btn"><a href="/corporate/faq/">よくあるご質問</a></p>
            </div>
            <?php //add 20210406 ishizaki　↑ ?>
        </section>
        <!-- /放送中の韓国ドラマ -->


        <!-- 放送予定の%%% -->
        <section class="section-wrap">
            <div class="program-list-wrap">
                <h2 class="section-ttl">放送予定の<?php echo esc_attr($term_list_object_name); ?></h2>

                <div class="program-list w320 type-B slider">
                    <?php
                    if (!empty($programs_arr[1])) {
                        foreach ($programs_arr[1] as $t) {
                            tpl_program_list_item($t);
                        }
                    }
                    ?>
                </div>
            </div>

            <div class="btn-wrap w300">
                <p class="btn"><a href="/program_schedule/">番組表を見る</a></p>
            </div>
        </section>
        <!-- /放送予定の韓国ドラマ -->

        <?php get_template_part('template-parts/ad/ad-news-single', 'ad-news-single'); ?>

        <!-- おすすめ -->
        <?php display_program_recommend_by_category_slug($term_list_object->slug); ?>

        <!-- /おすすめ%カテゴリー名% -->

        <!-- 動画 -->
        <?php
        /**
         * add 20200305 yanagi ↓
         * BS12_RENEWAL-209 【施策ID：41-1】スポーツ一覧ページ > 配下動画の表示
         */
        if (have_rows('movie_area', $term_list_object)) : ?>
            <section class="section-wrap">
                <h2 class="section-ttl">おすすめ動画</h2>
                <div class="net-video program-list w320">
                    <?php while (have_rows('movie_area', $term_list_object)) : the_row(); ?>
                        <article class="item">
                            <?php the_sub_field('movie_tag', $term_list_object); ?>
                        </article>
                    <?php endwhile; ?>
                </div>
            </section>
        <?php endif;
        // add 20200305 yanagi ↑
        ?>
        <!-- /動画 -->

        <!-- ランキング -->
        <section class="section-wrap">
            <div class="program-ranking-wrap">
                <div class="program-list-wrap">
                    <h2 class="section-ttl"><?php echo esc_attr($term_list_object_name); ?>ランキング</h2>
                    <?php display_program_ranking_by_category_slug($term_list_object->slug); ?>
                </div>

                <div class="program-list-wrap">
                    <h2 class="section-ttl">アクセスランキング</h2>
                    <?php // get_template_part( 'template-parts/ranking/all' );
                    ?>
                    <?php display_program_ranking_by_category_slug('all'); ?>
                </div>
            </div>
        </section>
        <!-- /ランキング -->

        <?php get_template_part('template-parts/ad/ad-news', 'ad-news'); ?>




        <!-- お客様の声 -->
        <?php
        /**
         * add 20200306 yanagi
         * BS12_RENEWAL-202 【施策ID：39-1】お客様の声コンテンツ作成
         */
        ?>
        <?php display_program_voice_by_category_slug($term_list_object->slug); ?>
        <!-- お客様の声 -->


        <!-- 人気の番組カテゴリ -->
        <section class="section-wrap">
            <div class="program-list-wrap">
                <h2 class="section-ttl">人気の番組カテゴリ</h2>
                <div class="white-wrap">
                    <?php get_template_part('template-parts/seo/category', 'famous-list'); ?>
                </div>
            </div>
        </section>
        <!-- /人気の番組カテゴリ -->

        <!-- BS12 特選情報 -->
        <?php 
        //BS12_RENEWAL-269 【タスク】レイアウト変更ならびにWP機能追加 edit 20201012 yanagi
        get_template_part('template-parts/top', 'special-select');
         ?>
        <!-- /BS12 特選情報 -->

        <!-- 放送終了の韓国ドラマ -->
        <section class="section-wrap">
        <?php
        /**
         * add function 20200317 yanagi ↓↓
         * BS12_RENEWAL-212 【施策ID：47-1】韓国ドラマ > 放送終了番組の統合
         * 
         * edit 20201012 yanagi
         * BS12_RENEWAL-269 【タスク】レイアウト変更ならびにWP機能追加 
         * 
         */
        ?>
            <?php if (preg_match('/korea/', $term_list_object->slug)) { ?>
                <section class="section-wrap">
                    <div class="program-list-wrap">
                        <h2 class="section-ttl">放送終了の韓国ドラマ</h2>

                        <div class="program-list-accordion-wrap" data-pc="3" data-sp="3" data-btn="ac1">

                            <div class="program-list w320 type-C end">

                                <?php
                                if (!empty($programs_arr[3])) {
                                    foreach ($programs_arr[3] as $t) {
                                        tpl_program_list_accordion_item($t);
                                    }
                                }
                                ?>
                            </div>

                        </div>

                        <div class="btn-wrap w300">
                            <p class="btn accordion-btn"><a href="#" rel="ac1" class="non-scroll">もっと見る</a></p>
                        </div>

                    </div>

                    <div class="btn-wrap w300">
                        <p class="btn"><a href="/program/">番組一覧</a></p>
                    </div>
                </section>
        <?php // add function 20200317 yanagi ↑↑ ?>
            <?php } else { ?>
                <div class="program-list-wrap">
                    <h2 class="section-ttl">放送終了の<?php echo esc_attr($term_list_object_name); ?></h2>

                    <div class="program-list w320 type-C end">
                        <?php
                        if (!empty($programs_arr[3])) {
                            $i = 0;
                            foreach ($programs_arr[3] as $t) {
                                if ($i > 5) break; // 6件のみ表示
                                tpl_program_list_item($t);
                                $i++;
                            }
                        }
                        ?>
                    </div>
                </div>

                <div class="btn-wrap w300">
                    <p class="btn"><a href="/program/">番組一覧</a></p>
                    <p class="btn"><a href="/program/archive/#<?php echo $term_list_object->slug; ?>"><?php echo $term_list_object_name; ?>終了番組一覧</a></p>
                </div>
            <?php } ?>
        </section>
        <!-- /放送終了の韓国ドラマ -->

        <!-- 新着情報 -->
        <?php //BS12_RENEWAL-269 【タスク】レイアウト変更ならびにWP機能追加 edit 20201012 yanagi ?>
        <section class="section-wrap">
            <div class="program-list-wrap">
                <h2 class="section-ttl">新着情報</h2>
                <div class="program-mini-list twin">
                    <?php get_template_part('template-parts/news/program', 'whatsnew-list'); ?>
                </div>
            </div>

            <div class="btn-wrap w300">
                <p class="btn"><a href="/news/whatsnew/">新着情報一覧</a></p>
            </div>
        </section>
        <!-- /新着情報 -->

        <!-- BS12 サキドリ情報 -->
        <?php get_template_part('template-parts/top', 'sakidori'); ?>
        <!-- /BS12 サキドリ情報 -->

        <section class="section-wrap">
            <div class="information">
                <h2 class="section-ttl">お知らせ</h2>
                <div class="info-box">
                    <div class="info-list-wrap info-scroll">
                        <?php get_template_part('template-parts/news/announce', 'list'); ?>
                    </div>
                </div>
            </div>
        </section>

        <?php get_template_part('template-parts/ad/ad-info', 'ad-info'); ?>



        <?php get_template_part('template-parts/uiux/bottom', 'roll-link'); ?>

    </div>

</div>
