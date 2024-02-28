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
<!-- main -->
<main id="main">
    <div class="breadcrumb">
        <ul>
            <li>
                <a href="<?php echo esc_url(home_url('/')) ?>"><?php bs12_pankuzu_text_top(); ?></a>
            </li>
            <?php if (preg_match('/(korea|china)/', $term_list_object->slug)) : ?>
                <li><a href="/program/drama/">ドラマ・映画</a></li>
            <?php endif; ?>
            <li>
                <span><?php echo esc_attr($term_list_object_name); ?></span>
            </li>
        </ul>
    </div>
    <!-- banner catefory -->
    <section class="section" id="banner_category">
        <div class="inner">
            <div class="siler_category_top">
                <div class="txt_fixed">
                    <h2><?php echo esc_attr($term_list_object_name); ?></h2>
                </div>
                <div class="siler_top_content">
                    <div class="slide_top_odd">
                        <a href="">
                            <div class="thumb">
                                <img src="assets/images/the-road-main.png" width="448px" height="252px"
                                     alt="thumb slide top 01">
                            </div>
                        </a>
                        <a href="">
                            <div class="thumb">
                                <img src="assets/images/the-road-main.png" width="448px" height="252px"
                                     alt="thumb slide top 01">
                            </div>
                        </a>
                        <a href="">
                            <div class="thumb">
                                <img src="assets/images/the-road-main.png" width="448px" height="252px"
                                     alt="thumb slide top 01">
                            </div>
                        </a>
                        <a href="">
                            <div class="thumb">
                                <img src="assets/images/the-road-main.png" width="448px" height="252px"
                                     alt="thumb slide top 01">
                            </div>
                        </a>
                    </div>
                    <div class="slide_top_even">
                        <a href="">
                            <div class="thumb">
                                <img src="assets/images/the-road-main.png" width="448px" height="252px"
                                     alt="thumb slide top 01">
                            </div>
                        </a>
                        <a href="">
                            <div class="thumb">
                                <img src="assets/images/the-road-main.png" width="448px" height="252px"
                                     alt="thumb slide top 01">
                            </div>
                        </a>
                        <a href="">
                            <div class="thumb">
                                <img src="assets/images/the-road-main.png" width="448px" height="252px"
                                     alt="thumb slide top 01">
                            </div>
                        </a>
                        <a href="">
                            <div class="thumb">
                                <img src="assets/images/the-road-main.png" width="448px" height="252px"
                                     alt="thumb slide top 01">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="content_bottom">
                <div class="slide_brand">
                    <ul>
                        <li>
                            <a href="">
                                <img src="assets/images/asia_oshidrama.jpg" width="420px" height="150px" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="assets/images/twitter_asiadrama.jpg" width="420px" height="150px" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="assets/images/asia_oshidrama.jpg" width="420px" height="150px" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="assets/images/twitter_asiadrama.jpg" width="420px" height="150px" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="assets/images/asia_oshidrama.jpg" width="420px" height="150px" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="assets/images/twitter_asiadrama.jpg" width="420px" height="150px" alt="">
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="item_brand">
                    <div class="thumb">
                        <img src="assets/images/img_kboad.svg" width="430px" height="180px" alt="">
                    </div>
                    <div class="txt_desp">
                        <h3>韓国情報なら！Kboard</h3>
                        <p>説明を入ります説明を入ります説明を入ります説明を入ります説明を入ります。</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /banner category -->
    <!-- Korean dramas on air -->
    <section class="section" id="dramas_on_air">
        <div class="inner">
            <div class="tlt_section">
                <h2 class="util_pc">放送中の番組</h2>
                <h2 class="util_sp">放送中の韓国・ 韓流ドラマ</h2>
                <div class="btn_more">
                    <span>すべて見る</span>
                </div>
            </div>
            <div class="dramas_slides">
                <div class="dramas_slide_top">
                    <div class="program_slide is_loading dramas_top">
                        <div class="item_slide">
                            <a href="">
                                <img src="assets/images/img_1.jpg" width="320px" height="180px" alt="韓国ドラマ「悪の花」">
                                <div class="content_dramas">
                                    <h2>韓国ドラマ「悪の花」</h2>
                                    <span>次回：第1話 予期せぬ訪問者</span>
                                    <p>2022年10月28日放送</p>
                                </div>
                            </a>
                        </div>
                        <div class="item_slide">
                            <a href="">
                                <img src="assets/images/img_1.jpg" width="320px" height="180px" alt="韓国ドラマ「悪の花」">
                                <div class="content_dramas">
                                    <h2>韓国ドラマ「悪の花」</h2>
                                    <span>次回：第1話 予期せぬ訪問者</span>
                                    <p>2022年10月28日放送</p>
                                </div>
                            </a>
                        </div>
                        <div class="item_slide">
                            <a href="">
                                <img src="assets/images/img_1.jpg" width="320px" height="180px" alt="韓国ドラマ「悪の花」">
                                <div class="content_dramas">
                                    <h2>韓国ドラマ「悪の花」</h2>
                                    <span>次回：第1話 予期せぬ訪問者</span>
                                    <p>2022年10月28日放送</p>
                                </div>
                            </a>
                        </div>
                        <div class="item_slide">
                            <a href="">
                                <img src="assets/images/img_1.jpg" width="320px" height="180px" alt="韓国ドラマ「悪の花」">
                                <div class="content_dramas">
                                    <h2>韓国ドラマ「悪の花」</h2>
                                    <span>次回：第1話 予期せぬ訪問者</span>
                                    <p>2022年10月28日放送</p>
                                </div>
                            </a>
                        </div>
                        <div class="item_slide">
                            <a href="">
                                <img src="assets/images/img_1.jpg" width="320px" height="180px" alt="韓国ドラマ「悪の花」">
                                <div class="content_dramas">
                                    <h2>韓国ドラマ「悪の花」</h2>
                                    <span>次回：第1話 予期せぬ訪問者</span>
                                    <p>2022年10月28日放送</p>
                                </div>
                            </a>
                        </div>
                        <div class="item_slide">
                            <a href="">
                                <img src="assets/images/img_1.jpg" width="320px" height="180px" alt="韓国ドラマ「悪の花」">
                                <div class="content_dramas">
                                    <h2>韓国ドラマ「悪の花」</h2>
                                    <span>次回：第1話 予期せぬ訪問者</span>
                                    <p>2022年10月28日放送</p>
                                </div>
                            </a>
                        </div>
                        <div class="item_slide">
                            <a href="">
                                <img src="assets/images/img_1.jpg" width="320px" height="180px" alt="韓国ドラマ「悪の花」">
                                <div class="content_dramas">
                                    <h2>韓国ドラマ「悪の花」</h2>
                                    <span>次回：第1話 予期せぬ訪問者</span>
                                    <p>2022年10月28日放送</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="dramas_slide_bottom">
                    <div class="program_slide is_loading dramas_bottom">
                        <div class="item_slide">
                            <a href="">
                                <img src="assets/images/img_1.jpg" width="320px" height="180px" alt="韓国ドラマ「悪の花」">
                                <div class="content_dramas">
                                    <h2>韓国ドラマ「悪の花」</h2>
                                    <span>次回：第1話 予期せぬ訪問者</span>
                                    <p>2022年10月28日放送</p>
                                </div>
                            </a>
                        </div>
                        <div class="item_slide">
                            <a href="">
                                <img src="assets/images/img_1.jpg" width="320px" height="180px" alt="韓国ドラマ「悪の花」">
                                <div class="content_dramas">
                                    <h2>韓国ドラマ「悪の花」</h2>
                                    <span>次回：第1話 予期せぬ訪問者</span>
                                    <p>2022年10月28日放送</p>
                                </div>
                            </a>
                        </div>
                        <div class="item_slide">
                            <a href="">
                                <img src="assets/images/img_1.jpg" width="320px" height="180px" alt="韓国ドラマ「悪の花」">
                                <div class="content_dramas">
                                    <h2>韓国ドラマ「悪の花」</h2>
                                    <span>次回：第1話 予期せぬ訪問者</span>
                                    <p>2022年10月28日放送</p>
                                </div>
                            </a>
                        </div>
                        <div class="item_slide">
                            <a href="">
                                <img src="assets/images/img_1.jpg" width="320px" height="180px" alt="韓国ドラマ「悪の花」">
                                <div class="content_dramas">
                                    <h2>韓国ドラマ「悪の花」</h2>
                                    <span>次回：第1話 予期せぬ訪問者</span>
                                    <p>2022年10月28日放送</p>
                                </div>
                            </a>
                        </div>
                        <div class="item_slide">
                            <a href="">
                                <img src="assets/images/img_1.jpg" width="320px" height="180px" alt="韓国ドラマ「悪の花」">
                                <div class="content_dramas">
                                    <h2>韓国ドラマ「悪の花」</h2>
                                    <span>次回：第1話 予期せぬ訪問者</span>
                                    <p>2022年10月28日放送</p>
                                </div>
                            </a>
                        </div>
                        <div class="item_slide">
                            <a href="">
                                <img src="assets/images/img_1.jpg" width="320px" height="180px" alt="韓国ドラマ「悪の花」">
                                <div class="content_dramas">
                                    <h2>韓国ドラマ「悪の花」</h2>
                                    <span>次回：第1話 予期せぬ訪問者</span>
                                    <p>2022年10月28日放送</p>
                                </div>
                            </a>
                        </div>
                        <div class="item_slide">
                            <a href="">
                                <img src="assets/images/img_1.jpg" width="320px" height="180px" alt="韓国ドラマ「悪の花」">
                                <div class="content_dramas">
                                    <h2>韓国ドラマ「悪の花」</h2>
                                    <span>次回：第1話 予期せぬ訪問者</span>
                                    <p>2022年10月28日放送</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn_watch">
                <a href="<?php echo esc_url(home_url('/howtowatch'))?>">無料で見られる！BS12の視聴方法</a>
            </div>
        </div>
    </section>

    <!-- /Korean dramas on air -->
    <!-- Broadcast schedule -->
    <?php get_template_part('template-parts/program/broadcast_schedule', null, array('hideBrand' => true)); ?>
    <!-- /Broadcast schedule -->
    <!-- Korean drama ratings -->
    <section class="section" id="drama_ratings">
        <div class="inner">
            <div class="content_ranking">
                <div class="tlt_section">
                    <h2>韓国・韓流ドラマランキング</h2>
                </div>
                <div class="program_slide is_loading slide_ranking">
                    <div class="item_slide">
                        <a href="#">
                            <img src="assets/images/img_program.jpg" width="338" height="198" alt="program slide">
                        </a>
                        <span class="num">1</span>
                    </div>
                    <div class="item_slide">
                        <a href="#">
                            <img src="assets/images/img_program.jpg" width="338" height="198" alt="program slide">
                        </a>
                        <span class="num">2</span>
                    </div>
                    <div class="item_slide">
                        <a href="#">
                            <img src="assets/images/img_program.jpg" width="338" height="198" alt="program slide">
                        </a>
                        <span class="num">3</span>
                    </div>
                    <div class="item_slide">
                        <a href="#">
                            <img src="assets/images/img_program.jpg" width="338" height="198" alt="program slide">
                        </a>
                        <span class="num">4</span>
                    </div>
                    <div class="item_slide">
                        <a href="#">
                            <img src="assets/images/img_program.jpg" width="338" height="198" alt="program slide">
                        </a>
                        <span class="num">5</span>
                    </div>
                    <div class="item_slide">
                        <a href="#">
                            <img src="assets/images/img_program.jpg" width="338" height="198" alt="program slide">
                        </a>
                        <span class="num">6</span>
                    </div>
                </div>
                <div class="btn_link">
                    <div class="btn_more">
                        <span>すべて見る</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Korean drama ratings -->
    <!-- ranking -->
    <section class="section" id="ranking_section">
        <div class="inner">
            <div class="content_ranking">
                <div class="tlt_section">
                    <h2>ランキング</h2>
                </div>
                <div class="program_slide is_loading slide_ranking">
                    <div class="item_slide">
                        <a href="#">
                            <img src="assets/images/img_program.jpg" width="338" height="198" alt="program slide">
                        </a>
                        <span class="num">1</span>
                    </div>
                    <div class="item_slide">
                        <a href="#">
                            <img src="assets/images/img_program.jpg" width="338" height="198" alt="program slide">
                        </a>
                        <span class="num">2</span>
                    </div>
                    <div class="item_slide">
                        <a href="#">
                            <img src="assets/images/img_program.jpg" width="338" height="198" alt="program slide">
                        </a>
                        <span class="num">3</span>
                    </div>
                    <div class="item_slide">
                        <a href="#">
                            <img src="assets/images/img_program.jpg" width="338" height="198" alt="program slide">
                        </a>
                        <span class="num">4</span>
                    </div>
                    <div class="item_slide">
                        <a href="#">
                            <img src="assets/images/img_program.jpg" width="338" height="198" alt="program slide">
                        </a>
                        <span class="num">5</span>
                    </div>
                    <div class="item_slide">
                        <a href="#">
                            <img src="assets/images/img_program.jpg" width="338" height="198" alt="program slide">
                        </a>
                        <span class="num">6</span>
                    </div>
                </div>
                <div class="btn_link">
                    <div class="btn_more">
                        <span>すべて見る</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /ranking -->
    <!-- Recommended movies -->
    <section class="section" id="recommended_movies">
        <div class="inner">
            <div class="tlt_section">
                <h2>おすすめ韓流ドラマ</h2>
                <div class="btn_more">
                    <span>すべて見る</span>
                </div>
            </div>
            <div class="program_slide is_loading side_brand">
                <div class="item_slide">
                    <a href="#">
                        <img src="https://dummyimage.com/320x180/000000/fff" alt="">
                    </a>
                </div>
                <div class="item_slide">
                    <a href="#">
                        <img src="https://dummyimage.com/320x180/000000/fff" alt="">
                    </a>
                </div>
                <div class="item_slide">
                    <a href="#">
                        <img src="https://dummyimage.com/320x180/000000/fff" alt="">
                    </a>
                </div>
                <div class="item_slide">
                    <a href="#">
                        <img src="https://dummyimage.com/320x180/000000/fff" alt="">
                    </a>
                </div>
                <div class="item_slide">
                    <a href="#">
                        <img src="https://dummyimage.com/320x180/000000/fff" alt="">
                    </a>
                </div>
                <div class="item_slide">
                    <a href="#">
                        <img src="https://dummyimage.com/320x180/000000/fff" alt="">
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- /Recommended movies -->
    <!-- look at the program -->
    <section class="section" id="look_program">
        <div class="inner">
            <div class="tlt_section">
                <h2>番組のぞき見</h2>
                <div class="btn_more">
                    <span>すべて見る</span>
                </div>
            </div>
            <div class="program_content">
                <iframe width="753" height="402" src="https://www.youtube.com/embed/Hp3916uZFlU?si=r58g-mE4ONAWhiyM"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                <iframe width="753" height="402" src="https://www.youtube.com/embed/n37_YhH6AL8?si=X34vyIc86KmdMpXI"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
            </div>
        </div>
    </section>
    <!-- /look at the program -->
    <!-- Korean dramas scheduled to air -->
    <section class="section" id="dramas_scheduled">
        <div class="inner">
            <div class="tlt_section">
                <h2>放送予定の韓国・韓流ドラマ</h2>
                <div class="btn_more">
                    <span>すべて見る</span>
                </div>
            </div>
            <div class="program_slide is_loading side_brand">
                <div class="item_slide">
                    <a href="#">
                        <img src="https://dummyimage.com/320x180/000000/fff" alt="">
                    </a>
                </div>
                <div class="item_slide">
                    <a href="#">
                        <img src="https://dummyimage.com/320x180/000000/fff" alt="">
                    </a>
                </div>
                <div class="item_slide">
                    <a href="#">
                        <img src="https://dummyimage.com/320x180/000000/fff" alt="">
                    </a>
                </div>
                <div class="item_slide">
                    <a href="#">
                        <img src="https://dummyimage.com/320x180/000000/fff" alt="">
                    </a>
                </div>
                <div class="item_slide">
                    <a href="#">
                        <img src="https://dummyimage.com/320x180/000000/fff" alt="">
                    </a>
                </div>
                <div class="item_slide">
                    <a href="#">
                        <img src="https://dummyimage.com/320x180/000000/fff" alt="">
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- /Korean dramas scheduled to air -->
    <!-- The Korean drama has ended its broadcast -->
    <section class="section" id="dramas_ended">
        <div class="inner">
            <div class="tlt_section">
                <h2>放送終了した韓国ドラマ</h2>
                <div class="btn_more">
                    <span>すべて見る</span>
                </div>
            </div>
            <div class="program_slide is_loading side_brand">
                <div class="item_slide">
                    <a href="#">
                        <img src="https://dummyimage.com/320x180/000000/fff" alt="">
                    </a>
                </div>
                <div class="item_slide">
                    <a href="#">
                        <img src="https://dummyimage.com/320x180/000000/fff" alt="">
                    </a>
                </div>
                <div class="item_slide">
                    <a href="#">
                        <img src="https://dummyimage.com/320x180/000000/fff" alt="">
                    </a>
                </div>
                <div class="item_slide">
                    <a href="#">
                        <img src="https://dummyimage.com/320x180/000000/fff" alt="">
                    </a>
                </div>
                <div class="item_slide">
                    <a href="#">
                        <img src="https://dummyimage.com/320x180/000000/fff" alt="">
                    </a>
                </div>
                <div class="item_slide">
                    <a href="#">
                        <img src="https://dummyimage.com/320x180/000000/fff" alt="">
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- /The Korean drama has ended its broadcast -->
    <!-- customer voice -->
    <section class="section" id="customer_voice">
        <div class="inner">
            <div class="tlt_section">
                <h2>お客様の声</h2>
            </div>
            <div class="program_slide is_loading voice_list">
                <div class="item_slide">
                    <a href="#">
                        <span class="date">2022/12/17</span>
                        <h4>「悪の花」</h4>
                        <p>放送開始前から期待が大きかったのですが、毎週金曜、『悪の花』を観るのが楽しみです。本当は、毎日放送があったら嬉しいです。イ・ジュンギ氏の作品は、好きな時とそうでない時がありましたが、今回、脚本に恵まれ、全キャストも素晴らしく、あと6回で終わってしまうので、どういう着地になるか最後まで、楽しみます
                            　　　　　　　</p>
                        <span class="note">（50代／女性）</span>
                    </a>
                </div>
                <div class="item_slide">
                    <a href="#">
                        <span class="date">2022/12/17</span>
                        <h4>「悪の花」</h4>
                        <p>放送開始前から期待が大きかったのですが、毎週金曜、『悪の花』を観るのが楽しみです。本当は、毎日放送があったら嬉しいです。イ・ジュンギ氏の作品は、好きな時とそうでない時がありましたが、今回、脚本に恵まれ、全キャストも素晴らしく、あと6回で終わってしまうので、どういう着地になるか最後まで、楽しみます
                            　　　　　　　</p>
                        <span class="note">（50代／女性）</span>
                    </a>
                </div>
                <div class="item_slide">
                    <a href="#">
                        <span class="date">2022/12/17</span>
                        <h4>「悪の花」</h4>
                        <p>放送開始前から期待が大きかったのですが、毎週金曜、『悪の花』を観るのが楽しみです。本当は、毎日放送があったら嬉しいです。イ・ジュンギ氏の作品は、好きな時とそうでない時がありましたが、今回、脚本に恵まれ、全キャストも素晴らしく、あと6回で終わってしまうので、どういう着地になるか最後まで、楽しみます
                            　　　　　　　</p>
                        <span class="note">（50代／女性）</span>
                    </a>
                </div>
                <div class="item_slide">
                    <a href="#">
                        <span class="date">2022/12/17</span>
                        <h4>「悪の花」</h4>
                        <p>放送開始前から期待が大きかったのですが、毎週金曜、『悪の花』を観るのが楽しみです。本当は、毎日放送があったら嬉しいです。イ・ジュンギ氏の作品は、好きな時とそうでない時がありましたが、今回、脚本に恵まれ、全キャストも素晴らしく、あと6回で終わってしまうので、どういう着地になるか最後まで、楽しみます
                            　　　　　　　</p>
                        <span class="note">（50代／女性）</span>
                    </a>
                </div>
                <div class="item_slide">
                    <a href="#">
                        <span class="date">2022/12/17</span>
                        <h4>「悪の花」</h4>
                        <p>放送開始前から期待が大きかったのですが、毎週金曜、『悪の花』を観るのが楽しみです。本当は、毎日放送があったら嬉しいです。イ・ジュンギ氏の作品は、好きな時とそうでない時がありましたが、今回、脚本に恵まれ、全キャストも素晴らしく、あと6回で終わってしまうので、どういう着地になるか最後まで、楽しみます
                            　　　　　　　</p>
                        <span class="note">（50代／女性）</span>
                    </a>
                </div>
                <div class="item_slide">
                    <a href="#">
                        <span class="date">2022/12/17</span>
                        <h4>「悪の花」</h4>
                        <p>放送開始前から期待が大きかったのですが、毎週金曜、『悪の花』を観るのが楽しみです。本当は、毎日放送があったら嬉しいです。イ・ジュンギ氏の作品は、好きな時とそうでない時がありましたが、今回、脚本に恵まれ、全キャストも素晴らしく、あと6回で終わってしまうので、どういう着地になるか最後まで、楽しみます
                            　　　　　　　</p>
                        <span class="note">（50代／女性）</span>
                    </a>
                </div>
                <div class="item_slide">
                    <a href="#">
                        <span class="date">2022/12/17</span>
                        <h4>「悪の花」</h4>
                        <p>放送開始前から期待が大きかったのですが、毎週金曜、『悪の花』を観るのが楽しみです。本当は、毎日放送があったら嬉しいです。イ・ジュンギ氏の作品は、好きな時とそうでない時がありましたが、今回、脚本に恵まれ、全キャストも素晴らしく、あと6回で終わってしまうので、どういう着地になるか最後まで、楽しみます
                            　　　　　　　</p>
                        <span class="note">（50代／女性）</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- /customer voice -->
    <!-- recommended_program -->
    <section class="section" id="recommended_program">
        <div class="inner">
            <div class="tlt_section">
                <h2>BS12おすすめ番組</h2>
                <div class="btn_more">
                    <span>すべて見る</span>
                </div>
            </div>
            <div class="program_slide is_loading side_brand">
                <div class="item_slide">
                    <a href="#">
                        <img src="https://dummyimage.com/320x180/000000/fff" alt="">
                    </a>
                </div>
                <div class="item_slide">
                    <a href="#">
                        <img src="https://dummyimage.com/320x180/000000/fff" alt="">
                    </a>
                </div>
                <div class="item_slide">
                    <a href="#">
                        <img src="https://dummyimage.com/320x180/000000/fff" alt="">
                    </a>
                </div>
                <div class="item_slide">
                    <a href="#">
                        <img src="https://dummyimage.com/320x180/000000/fff" alt="">
                    </a>
                </div>
                <div class="item_slide">
                    <a href="#">
                        <img src="https://dummyimage.com/320x180/000000/fff" alt="">
                    </a>
                </div>
                <div class="item_slide">
                    <a href="#">
                        <img src="https://dummyimage.com/320x180/000000/fff" alt="">
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- /recommended_program -->
    <!-- PR -->
    <section class="section" id="pr_section">
        <div class="inner">
            <div class="tlt_section">
                <h2>PR</h2>
            </div>
            <div class="list_pr">
                <div class="item_pr">
                    <a href="#">
                        <div class="thumb">
                            <img src="assets/images/img_uzou.jpg" width="338px" height="198px" alt="">
                        </div>
                    </a>
                </div>
                <div class="item_pr">
                    <a href="#">
                        <div class="thumb">
                            <img src="assets/images/img_uzou.jpg" width="338px" height="198px" alt="">
                        </div>
                    </a>
                </div>
                <div class="item_pr">
                    <a href="#">
                        <div class="thumb">
                            <img src="assets/images/img_uzou.jpg" width="338px" height="198px" alt="">
                        </div>
                    </a>
                </div>
                <div class="item_pr">
                    <a href="#">
                        <div class="thumb">
                            <img src="assets/images/img_uzou.jpg" width="338px" height="198px" alt="">
                        </div>
                    </a>
                </div>
                <div class="item_pr">
                    <a href="#">
                        <div class="thumb">
                            <img src="assets/images/img_uzou.jpg" width="338px" height="198px" alt="">
                        </div>
                    </a>
                </div>
                <div class="item_pr">
                    <a href="#">
                        <div class="thumb">
                            <img src="assets/images/img_uzou.jpg" width="338px" height="198px" alt="">
                        </div>
                    </a>
                </div>
                <div class="item_pr">
                    <a href="#">
                        <div class="thumb">
                            <img src="assets/images/img_uzou.jpg" width="338px" height="198px" alt="">
                        </div>
                    </a>
                </div>
                <div class="item_pr">
                    <a href="#">
                        <div class="thumb">
                            <img src="assets/images/img_uzou.jpg" width="338px" height="198px" alt="">
                        </div>
                    </a>
                </div>
                <div class="item_pr">
                    <a href="#">
                        <div class="thumb">
                            <img src="assets/images/img_uzou.jpg" width="338px" height="198px" alt="">
                        </div>
                    </a>
                </div>
                <div class="item_pr">
                    <a href="#">
                        <div class="thumb">
                            <img src="assets/images/img_uzou.jpg" width="338px" height="198px" alt="">
                        </div>
                    </a>
                </div>
                <div class="item_pr">
                    <a href="#">
                        <div class="thumb">
                            <img src="assets/images/img_uzou.jpg" width="338px" height="198px" alt="">
                        </div>
                    </a>
                </div>
                <div class="item_pr">
                    <a href="#">
                        <div class="thumb">
                            <img src="assets/images/img_uzou.jpg" width="338px" height="198px" alt="">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- /PR -->
    <!-- popular program -->
    <section class="section" id="popular_program">
        <div class="inner">
            <div class="tlt_section">
                <h2>人気の番組カテゴリ</h2>
            </div>
            <div class="list_other">
                <ul>
                    <li>
                        <a href="#">ドラマ・映画</a>
                    </li>
                    <li>
                        <a href="#">スポーツ</a>
                    </li>
                    <li>
                        <a href="#">バラエティ</a>
                    </li>
                    <li>
                        <a href="#">韓国・韓流ドラマ</a>
                    </li>
                    <li>
                        <a href="#">プロ野球中継</a>
                    </li>
                    <li>
                        <a href="#">情報・ドキュメンタリー</a>
                    </li>
                    <li>
                        <a href="#">中国・アジアドラマ</a>
                    </li>
                    <li>
                        <a href="#">旅・グルメ</a>
                    </li>
                    <li>
                        <a href="#">音楽番組(演歌・歌謡)</a>
                    </li>
                    <li>
                        <a href="#">アニメ</a>
                    </li>
                    <li>
                        <a href="#">通販</a>
                    </li>
                    <li>
                        <a href="#">生活向上 エンタテインメント</a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!-- /popular program -->
</main>
<!-- /main  -->
