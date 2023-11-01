<?php // echo '各番組トップ';

$term = get_queried_object();

$parent_term = get_term_by('id', $term->parent, 'program_cat');
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
            <span>悪の花</span>
        </li>
        <li class="util_sp">
            <a href="#">韓国</a>
        </li>
    </ul>

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
                <div class="banner">
                    <div class="txt_desp">
                        <h2>悪の花</h2>
                        <div class="date">
                            <h4>金曜 夕方 4：00～6：00（2話連続放送）</h4>
                            <p class="util_pc">＜無料BS初放送＞ <br> “愛を演じる男”と“危うさまで愛する女” ふたりの出す答えは――
                                「無法弁護士～最高のパートナー」以来2年ぶりのイ・ジュンギ主演作！百想芸術大賞5部門ノミネートされた傑作！</p>
                            <p class="util_sp">＜無料BS初放送＞ <br> “愛を演じる男”と“危うさまで愛する女” ふたりの出す答えは―― <br>
                                「無法弁護士～最高のパートナー」以来2年ぶりのイ・ジュンギ主演作！百想芸術大賞5部門ノミネートされた傑作！</p>
                            <div class="list">
                                <span>出演：</span>
                                <a href="">イ・ジュンギ、</a>
                                <a href="">ムン・チェウォン</a>
                            </div>
                            <div class="list">
                                <span>ジャンル：</span>
                                <a href="">サスペンス</a>
                                <div class="btn_bottom">
                                    <a href="#">もっと見る</a>
                                </div>
                            </div>
                        </div>
                        <div class="social_banner">
                            <h4>みんなに教える</h4>
                            <ul>
                                <li>
                                    <a href="#">
                                        <img src="assets/images/icon_text_x.png" width="60" height="60"
                                             alt="social banner">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="assets/images/icon_fb.png" width="60" height="60" alt="social banner">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="assets/images/icon_line.png" width="60" height="60"
                                             alt="social banner">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="thumb">
                        <img src="assets/images/img_1.jpg" width="850" height="649" alt="banner program detail">
                    </div>
                </div>
                <ul class="items_link">
                    <li class="active">
                        <a href="#">トップ</a>
                    </li>
                    <li>
                        <a href="#">相関図</a>
                    </li>
                    <li>
                        <a href="#">ご意見・ご感想</a>
                    </li>
                </ul>
                <div class="content">
                    <div class="brand">
                        <div class="brand_left">
                            <div class="thumb">
                                <img class="util_pc" src="https://dummyimage.com/332x207/000000/fff" alt="">
                                <img class="util_sp" src="https://dummyimage.com/155x110/000000/fff" alt="">
                            </div>
                            <div class="txt_desp">
                                <h2>第2話 微笑みの裏側 <br> 次回予告</h2>
                                <p>1月6日（金）16時</p>
                                <p class="util_pc">工房に人が訪ねてきたことに気づいたジウォンに、中学の同級生が来たと話すヒソン。</p>
                            </div>
                        </div>
                        <p class="util_sp">工房に人が訪ねてきたことに気づいたジウォンに、中学の同級生が来たと話すヒソン。</p>
                        <div class="brand_right">
                           <span>
                                <h4>放送直前SP見逃し配信中！</h4>
                           </span>
                        </div>
                    </div>
                    <div class="broadcast_schedule util_pc">
                        <a class="util_pc" href="#episode">放送スケジュール</a>
                    </div>
                    <div class="broadcast_schedule util_sp">
                        <a class="util_sp" href="#episode">放送ラインアップ</a>
                    </div>
                </div>
            </div>
        </section>
    <?php else:
        echo $html_area;
    endif;
    ?>
    <!--video_youtube-->
    <section class="section" id="video_youtube">
        <div class="inner">
            <h2>予告動画</h2>
            <div class="video">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/Ojrf1U_j9Eo?si=soxBcmP-rsFVJxTx"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
            </div>
        </div>
    </section>
    <!--/video_youtube-->
    <section class="section" id="synopsis">
        <div class="inner">
            <h2>あらすじ</h2>
            <p>“愛を演じる男”と“危うさまで愛する女” ふたりの出す答えは―― <br>「無法弁護士～最高のパートナー」以来2年ぶりのイ・ジュンギ主演作！<br class="util_pc">
                百想芸術大賞5部門ノミネートされた傑作！</p>
            <div class="item_1">
                <div class="content">
                    <div class="thumb">
                        <img src="https://dummyimage.com/600x400/000000/fff" alt="">
                    </div>
                    <p class="txt">金属工芸作家のペク・ヒソンは、愛する妻ジウォンと娘のウナに囲まれ、平凡だが幸せな日々を送っている。</p>
                </div>
                <p>
                    金属工芸作家のペク・ヒソンは、愛する妻ジウォンと娘のウナに囲まれ、平凡だが幸せな日々を送っている。ただひとつ、刑事である嫁を厭う両親との関係だけが問題だ。そんなある日、ジウォンはひょんなことから知り合いの記者キム・ムジンにヒソンを紹介することに。18
                    年前の連続殺人事件に関する連載記事を手がけるムジンは、事件の犯人と同じ金属工芸作家であることからヒソンに興味を抱き、彼の工房に足を運ぶ。だが、ヒソンの顔を見たムジンは…。</p>
            </div>
            <div class="item_2">
                <p>
                    金属工芸作家のペク・ヒソンは、愛する妻ジウォンと娘のウナに囲まれ、平凡だが幸せな日々を送っている。ただひとつ、刑事である嫁を厭う両親との関係だけが問題だ。そんなある日、ジウォンはひょんなことから知り合いの記者キム・ムジンにヒソンを紹介することに。18
                    年前の連続殺人事件に関する連載記事を手がけるムジンは、事件の犯人と同じ金属工芸作家であることからヒソンに興味を抱き、彼の工房に足を運ぶ。だが、ヒソンの顔を見たムジンは…。
                    年前の連続殺人事件に関する連載記事を手がけるムジンは、事件の犯人と同じ金属工芸作家であることからヒソンに興味を抱き、彼の工房に足を運ぶ。だが、ヒソンの顔を見たムジンは…。</p>
                <div class="content">
                    <div class="thumb">
                        <img src="https://dummyimage.com/606x400/000000/fff" alt="">
                    </div>
                    <p class="txt">ただひとつ、刑事である嫁を厭う両親との関係だけが問題だ。</p>
                </div>
            </div>
            <div class="item_3">
                <p>そんなある日、ジウォンはひょんなことから知り合いの記者キム・ムジンにヒソンを紹介することに。18
                    年前の連続殺人事件に関する連載記事を手がけるムジンは、事件の犯人と同じ金属工芸作家であることからヒソンに興味を抱き、彼の工房に足を運ぶ。</p>
                <div class="program_slide synopsis_list">
                    <div class="item_slide">
                        <a href="#">
                            <div class="thumb">
                                <img class="util_pc" src="https://dummyimage.com/600x400/000000/fff" alt="">
                                <img class="util_sp" src="https://dummyimage.com/336x221/000000/fff" alt="">
                            </div>
                        </a>
                    </div>
                    <div class="item_slide">
                        <a href="#">
                            <div class="thumb">
                                <img class="util_pc" src="https://dummyimage.com/600x400/000000/fff" alt="">
                                <img class="util_sp" src="https://dummyimage.com/336x221/111111/fff" alt="">
                            </div>
                        </a>
                    </div>
                    <div class="item_slide">
                        <a href="#">
                            <div class="thumb">
                                <img class="util_pc" src="https://dummyimage.com/600x400/000000/fff" alt="">
                                <img class="util_sp" src="https://dummyimage.com/336x221/222222/fff" alt="">
                            </div>
                        </a>
                    </div>
                    <div class="item_slide">
                        <a href="#">
                            <div class="thumb">
                                <img class="util_pc" src="https://dummyimage.com/600x400/000000/fff" alt="">
                                <img class="util_sp" src="https://dummyimage.com/336x221/555555/fff" alt="">
                            </div>
                        </a>
                    </div>
                    <div class="item_slide">
                        <a href="#">
                            <div class="thumb">
                                <img class="util_pc" src="https://dummyimage.com/600x400/000000/fff" alt="">
                                <img class="util_sp" src="https://dummyimage.com/336x221/888888/fff" alt="">
                            </div>
                        </a>
                    </div>
                    <div class="item_slide">
                        <a href="#">
                            <div class="thumb">
                                <img class="util_pc" src="https://dummyimage.com/600x400/000000/fff" alt="">
                                <img class="util_sp" src="https://dummyimage.com/336x221/999999/fff" alt="">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="episode">
        <div class="inner">
            <h2>エピソード</h2>
            <div class="list_episode">
                <ul>
                    <li>
                        <div class="tlt">
                            <div class="thumb">
                                <img class="util_pc" src="https://dummyimage.com/512x288/000000/fff" alt="">
                                <img class="util_sp" src="https://dummyimage.com/155x110/000000/fff" alt="">
                            </div>
                            <div class="txt_desp">
                                <h4>第1話 予期せぬ訪問者</h4>
                                <span>2022年10月28日放送</span>
                                <div class="util_pc">
                                    <p>
                                        金属工芸作家のヒソンは、愛する妻ジウォンと娘のウナに囲まれ、平凡だが幸せな日々を送っている。そんなある日、ジウォンはひょんなことから知り合いの記者ムジンにヒソンを紹介することに。
                                    </p>
                                    <div class="btn_more">
                                        <span>詳しく見る</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="util_sp">
                            <p>金属工芸作家のヒソンは、愛する妻ジウォンと娘のウナに囲まれ、平凡だが幸せな日々を送っている。そんなある日、ジウォンはひょんなことから知り合いの記者ムジンにヒソンを紹介することに。
                            </p>
                            <div class="btn_more">
                                <span>詳しく見る</span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="tlt">
                            <div class="thumb">
                                <img class="util_pc" src="https://dummyimage.com/512x288/000000/fff" alt="">
                                <img class="util_sp" src="https://dummyimage.com/155x110/000000/fff" alt="">
                            </div>
                            <div class="txt_desp">
                                <h4>第1話 予期せぬ訪問者</h4>
                                <span>2022年10月28日放送</span>
                                <div class="util_pc">
                                    <p>
                                        金属工芸作家のヒソンは、愛する妻ジウォンと娘のウナに囲まれ、平凡だが幸せな日々を送っている。そんなある日、ジウォンはひょんなことから知り合いの記者ムジンにヒソンを紹介することに。
                                    </p>
                                    <div class="btn_more">
                                        <span>詳しく見る</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="util_sp">
                            <p>金属工芸作家のヒソンは、愛する妻ジウォンと娘のウナに囲まれ、平凡だが幸せな日々を送っている。そんなある日、ジウォンはひょんなことから知り合いの記者ムジンにヒソンを紹介することに。
                            </p>
                            <div class="btn_more">
                                <span>詳しく見る</span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="tlt">
                            <div class="thumb">
                                <img class="util_pc" src="https://dummyimage.com/512x288/000000/fff" alt="">
                                <img class="util_sp" src="https://dummyimage.com/155x110/000000/fff" alt="">
                            </div>
                            <div class="txt_desp">
                                <h4>第1話 予期せぬ訪問者</h4>
                                <span>2022年10月28日放送</span>
                                <div class="util_pc">
                                    <p>
                                        金属工芸作家のヒソンは、愛する妻ジウォンと娘のウナに囲まれ、平凡だが幸せな日々を送っている。そんなある日、ジウォンはひょんなことから知り合いの記者ムジンにヒソンを紹介することに。
                                    </p>
                                    <div class="btn_more">
                                        <span>詳しく見る</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="util_sp">
                            <p>金属工芸作家のヒソンは、愛する妻ジウォンと娘のウナに囲まれ、平凡だが幸せな日々を送っている。そんなある日、ジウォンはひょんなことから知り合いの記者ムジンにヒソンを紹介することに。
                            </p>
                            <div class="btn_more">
                                <span>詳しく見る</span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="tlt">
                            <div class="thumb">
                                <img class="util_pc" src="https://dummyimage.com/512x288/000000/fff" alt="">
                                <img class="util_sp" src="https://dummyimage.com/155x110/000000/fff" alt="">
                            </div>
                            <div class="txt_desp">
                                <h4>第1話 予期せぬ訪問者</h4>
                                <span>2022年10月28日放送</span>
                                <div class="util_pc">
                                    <p>
                                        金属工芸作家のヒソンは、愛する妻ジウォンと娘のウナに囲まれ、平凡だが幸せな日々を送っている。そんなある日、ジウォンはひょんなことから知り合いの記者ムジンにヒソンを紹介することに。
                                    </p>
                                    <div class="btn_more">
                                        <span>詳しく見る</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="util_sp">
                            <p>金属工芸作家のヒソンは、愛する妻ジウォンと娘のウナに囲まれ、平凡だが幸せな日々を送っている。そんなある日、ジウォンはひょんなことから知り合いの記者ムジンにヒソンを紹介することに。
                            </p>
                            <div class="btn_more">
                                <span>詳しく見る</span>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="btn_all">
                <span>エピソードをすべて見る</span>
            </div>
        </div>
    </section>
    <section class="section" id="kboard">
        <div class="inner">
            <div class="thumb">
                <img class="util_pc" src="https://dummyimage.com/522x216/000000/fff" alt="">
                <img class="util_sp" src="https://dummyimage.com/187x91/000000/fff" alt="">
            </div>
            <div class="txt_desp">
                <h4>韓国情報なら！Kboard</h4>
                <p class="util_pc">説明を入ります説明を入ります説明を入ります説明を入ります説明を入ります説明を入ります <br>
                    説明を入ります説明を入ります説明を入ります説明を入ります説明を入ります。</p>
                <p class="util_sp">説明を入ります説明を入ります説明を入ります。</p>
            </div>
        </div>
    </section>
    <!-- ranking -->
    <section class="section" id="ranking">
        <div class="inner">
            <div class="content_ranking">
                <div class="tlt_section">
                    <h2>韓国・韓流ドラマランキング</h2>
                </div>
                <div class="program_slide slide_ranking">
                    <div class="item_slide">
                        <a href="#">
                            <img src="assets/images/img_program1.jpg" width="338" height="198" alt="program slide">
                        </a>
                        <span class="num">1</span>
                    </div>
                    <div class="item_slide">
                        <a href="#">
                            <img src="assets/images/img_program1.jpg" width="338" height="198" alt="program slide">
                        </a>
                        <span class="num">2</span>
                    </div>
                    <div class="item_slide">
                        <a href="#">
                            <img src="assets/images/img_program1.jpg" width="338" height="198" alt="program slide">
                        </a>
                        <span class="num">3</span>
                    </div>
                    <div class="item_slide">
                        <a href="#">
                            <img src="assets/images/img_program1.jpg" width="338" height="198" alt="program slide">
                        </a>
                        <span class="num">4</span>
                    </div>
                    <div class="item_slide">
                        <a href="#">
                            <img src="assets/images/img_program1.jpg" width="338" height="198" alt="program slide">
                        </a>
                        <span class="num">5</span>
                    </div>
                    <div class="item_slide">
                        <a href="#">
                            <img src="assets/images/img_program1.jpg" width="338" height="198" alt="program slide">
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
    <!-- ranking -->
    <section class="section" id="ranking_section">
        <div class="inner">
            <div class="content_ranking">
                <div class="tlt_section">
                    <h2>ランキング</h2>
                </div>
                <div class="program_slide slide_ranking">
                    <div class="item_slide">
                        <a href="#">
                            <img src="assets/images/img_program1.jpg" width="338" height="198" alt="program slide">
                        </a>
                        <span class="num">1</span>
                    </div>
                    <div class="item_slide">
                        <a href="#">
                            <img src="assets/images/img_program1.jpg" width="338" height="198" alt="program slide">
                        </a>
                        <span class="num">2</span>
                    </div>
                    <div class="item_slide">
                        <a href="#">
                            <img src="assets/images/img_program1.jpg" width="338" height="198" alt="program slide">
                        </a>
                        <span class="num">3</span>
                    </div>
                    <div class="item_slide">
                        <a href="#">
                            <img src="assets/images/img_program1.jpg" width="338" height="198" alt="program slide">
                        </a>
                        <span class="num">4</span>
                    </div>
                    <div class="item_slide">
                        <a href="#">
                            <img src="assets/images/img_program1.jpg" width="338" height="198" alt="program slide">
                        </a>
                        <span class="num">5</span>
                    </div>
                    <div class="item_slide">
                        <a href="#">
                            <img src="assets/images/img_program1.jpg" width="338" height="198" alt="program slide">
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
                <h2>BS12おすすめ番組</h2>
                <div class="btn_more">
                    <span>すべて見る</span>
                </div>
            </div>
            <div class="program_slide side_brand">
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
    <!-- pr -->
    <section class="section" id="pr">
        <div class="inner">
            <div class="tlt_section">
                <h2>pr</h2>
            </div>
            <div class="list_pr">
                <div class="item_pr">
                    <a href="#">
                        <div class="thumb">
                            <img src="assets/images/img_uzou.jpg" width="" height="" alt="">
                        </div>
                    </a>
                </div>
                <div class="item_pr">
                    <a href="#">
                        <div class="thumb">
                            <img src="assets/images/img_uzou.jpg" width="" height="" alt="">
                        </div>
                    </a>
                </div>
                <div class="item_pr">
                    <a href="#">
                        <div class="thumb">
                            <img src="assets/images/img_uzou.jpg" width="" height="" alt="">
                        </div>
                    </a>
                </div>
                <div class="item_pr">
                    <a href="#">
                        <div class="thumb">
                            <img src="assets/images/img_uzou.jpg" width="" height="" alt="">
                        </div>
                    </a>
                </div>
                <div class="item_pr">
                    <a href="#">
                        <div class="thumb">
                            <img src="assets/images/img_uzou.jpg" width="" height="" alt="">
                        </div>
                    </a>
                </div>
                <div class="item_pr">
                    <a href="#">
                        <div class="thumb">
                            <img src="assets/images/img_uzou.jpg" width="" height="" alt="">
                        </div>
                    </a>
                </div>
                <div class="item_pr">
                    <a href="#">
                        <div class="thumb">
                            <img src="assets/images/img_uzou.jpg" width="" height="" alt="">
                        </div>
                    </a>
                </div>
                <div class="item_pr">
                    <a href="#">
                        <div class="thumb">
                            <img src="assets/images/img_uzou.jpg" width="" height="" alt="">
                        </div>
                    </a>
                </div>
                <div class="item_pr">
                    <a href="#">
                        <div class="thumb">
                            <img src="assets/images/img_uzou.jpg" width="" height="" alt="">
                        </div>
                    </a>
                </div>
                <div class="item_pr">
                    <a href="#">
                        <div class="thumb">
                            <img src="assets/images/img_uzou.jpg" width="" height="" alt="">
                        </div>
                    </a>
                </div>
                <div class="item_pr">
                    <a href="#">
                        <div class="thumb">
                            <img src="assets/images/img_uzou.jpg" width="" height="" alt="">
                        </div>
                    </a>
                </div>
                <div class="item_pr">
                    <a href="#">
                        <div class="thumb">
                            <img src="assets/images/img_uzou.jpg" width="" height="" alt="">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- /pr -->

    <!-- other -->
    <section class="section" id="other">
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
                        <a href="#">韓国・韓流ドラマ</a>
                    </li>
                    <li>
                        <a href="#">中国・アジアドラマ</a>
                    </li>
                    <li>
                        <a href="#">スポーツ</a>
                    </li>
                    <li>
                        <a href="#">プロ野球中継</a>
                    </li>
                    <li>
                        <a href="#">旅・グルメ</a>
                    </li>
                    <li>
                        <a href="#">バラエティ</a>
                    </li>
                    <li>
                        <a href="#">情報・<br class="util_sp">ドキュメンタリー</a>
                    </li>
                    <li>
                        <a href="#">音楽番組(演歌・歌謡)</a>
                    </li>
                    <li>
                        <a href="#">アニメ</a>
                    </li>
                    <li>
                        <a href="#">生活向上 <br>エンタテインメント</a>
                    </li>
                    <li>
                        <a href="#">通販</a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!-- /other -->

    <div class="wrapper_modal" id="modal">
        <div class="inner">
            <div class="close active">
                <div class="line"><span></span></div>
            </div>
            <div class="tlt">
                <h2>BS12おすすめ番組</h2>
                <div class="btn_watch">
                    <a href="#">無料で見られる！BS12の視聴方法</a>
                </div>
            </div>
            <div class="list_watch">
                <ul>
                    <li>
                        <a href="#">
                            <div class="thumb">
                                <img src="assets/images/img_1.jpg" width="" height="" alt="img_1">
                            </div>
                            <div class="txt_desp">
                                <h4>韓国ドラマ「悪の花」</h4>
                                <p>出待ち・入り待ち禁止 ご協力のお願い</p>
                                <span>2022年10月28日放送</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="thumb">
                                <img src="assets/images/img_1.jpg" width="" height="" alt="img_1">
                            </div>
                            <div class="txt_desp">
                                <h4>韓国ドラマ「悪の花」</h4>
                                <p>出待ち・入り待ち禁止 ご協力のお願い</p>
                                <span>2022年10月28日放送</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="thumb">
                                <img src="assets/images/img_1.jpg" width="" height="" alt="img_1">
                            </div>
                            <div class="txt_desp">
                                <h4>韓国ドラマ「悪の花」</h4>
                                <p>出待ち・入り待ち禁止 ご協力のお願い</p>
                                <span>2022年10月28日放送</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="thumb">
                                <img src="assets/images/img_1.jpg" width="" height="" alt="img_1">
                            </div>
                            <div class="txt_desp">
                                <h4>韓国ドラマ「悪の花」</h4>
                                <p>出待ち・入り待ち禁止 ご協力のお願い</p>
                                <span>2022年10月28日放送</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="thumb">
                                <img src="assets/images/img_1.jpg" width="" height="" alt="img_1">
                            </div>
                            <div class="txt_desp">
                                <h4>韓国ドラマ「悪の花」</h4>
                                <p>出待ち・入り待ち禁止 ご協力のお願い</p>
                                <span>2022年10月28日放送</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="thumb">
                                <img src="assets/images/img_1.jpg" width="" height="" alt="img_1">
                            </div>
                            <div class="txt_desp">
                                <h4>韓国ドラマ「悪の花」</h4>
                                <p>出待ち・入り待ち禁止 ご協力のお願い</p>
                                <span>2022年10月28日放送</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="thumb">
                                <img src="assets/images/img_1.jpg" width="" height="" alt="img_1">
                            </div>
                            <div class="txt_desp">
                                <h4>韓国ドラマ「悪の花」</h4>
                                <p>出待ち・入り待ち禁止 ご協力のお願い</p>
                                <span>2022年10月28日放送</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="thumb">
                                <img src="assets/images/img_1.jpg" width="" height="" alt="img_1">
                            </div>
                            <div class="txt_desp">
                                <h4>韓国ドラマ「悪の花」</h4>
                                <p>出待ち・入り待ち禁止 ご協力のお願い</p>
                                <span>2022年10月28日放送</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="thumb">
                                <img src="assets/images/img_1.jpg" width="" height="" alt="img_1">
                            </div>
                            <div class="txt_desp">
                                <h4>韓国ドラマ「悪の花」</h4>
                                <p>出待ち・入り待ち禁止 ご協力のお願い</p>
                                <span>2022年10月28日放送</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="thumb">
                                <img src="assets/images/img_1.jpg" width="" height="" alt="img_1">
                            </div>
                            <div class="txt_desp">
                                <h4>韓国ドラマ「悪の花」</h4>
                                <p>出待ち・入り待ち禁止 ご協力のお願い</p>
                                <span>2022年10月28日放送</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="thumb">
                                <img src="assets/images/img_1.jpg" width="" height="" alt="img_1">
                            </div>
                            <div class="txt_desp">
                                <h4>韓国ドラマ「悪の花」</h4>
                                <p>出待ち・入り待ち禁止 ご協力のお願い</p>
                                <span>2022年10月28日放送</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="thumb">
                                <img src="assets/images/img_1.jpg" width="" height="" alt="img_1">
                            </div>
                            <div class="txt_desp">
                                <h4>韓国ドラマ「悪の花」</h4>
                                <p>出待ち・入り待ち禁止 ご協力のお願い</p>
                                <span>2022年10月28日放送</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</main>
<!-- /main -->

