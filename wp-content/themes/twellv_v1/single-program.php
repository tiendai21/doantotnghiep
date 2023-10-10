<?php

/*
 * トップとナビゲーションを表示しようとした場合、番組トップへリダイレクト
 */
if( get_post_format( get_the_ID() ) === 'image' || get_post_format( get_the_ID() ) === 'aside' ) {
    $terms = get_the_terms( get_the_ID(), 'program_cat' );
    if ( ! empty( $terms ) ) {
        wp_safe_redirect(get_term_link($terms[0]), 301);
        exit;
    }
}

get_header();

$terms = get_the_terms( get_the_ID(), 'program_cat' );
$program_term = null;
$this_term = $terms[0];
foreach( $terms as $t ) :
    $code = get_field( 'code', $t );
    if ( (int)$code >  0) {
        $program_term = $t;
    } else {
        $this_term = $t;
    }
endforeach;
if ( $program_term === null ) {
    $parent_term = get_term_by( 'id', $this_term->parent, 'program_cat' );
    if ( get_field( 'code', $parent_term) > 0 ) {
        $program_term = $parent_term;
    }
}
// var_dump( $program_term );
// 番組カテゴリ
$category_term = get_term_by( 'id', $program_term->parent, 'program_cat' );
?>
    <!-- main -->
    <main id="main">
        <ul class="breadcrumb">
            <li><a href="/"><?php  bs12_pankuzu_text_top(); ?></a> </li>
            <?php if ( preg_match( '/(korea|china)/', $category_term->slug ) ) { ?>
                <li><a href="/program/drama/">ドラマ・映画</a></li>
            <?php } ?>
            <?php if ( strpos( $program_term->slug, 'baseball') === false && $program_term->slug != "") { ?>
                <li><a href="<?php echo get_term_link( $category_term ); ?>"><?php echo $category_term->name; ?></a></li>
            <?php } ?>
            <?php
            $program_name=get_field('pankuzu_program_name', $program_term);
            if($program_name == "") $program_name = $program_term->name;
            if($program_name == "") {exit;}
            ?>
            <li><a href="<?php echo get_term_link( $program_term ); ?>"><?php echo $program_name; ?></a></li>
            <?php if ( $this_term->term_id !== $program_term->term_id ) { ?>
                <li><a href="<?php echo get_term_link( $this_term ); ?>"><?php echo $this_term->name; ?></a></li>
            <?php } ?>
            <li><span><?php the_title(); ?></span></li>
        </ul>

        <section class="section" id="banner">
            <div class="inner">
                <div class="banner_scroll">
                    <div class="thumb">
                        <img src="https://dummyimage.com/3000x988/000000/fff" alt="">
                    </div>
                </div>
                <div class="content">
                    <h2>悪の花</h2>
                    <div class="date">
                        <h4>金曜 夕方 4：00～6：00（2話連続放送）</h4>
                        <div class="btn_google">
                            <a href="">Googleカレンダーで視聴予約</a>
                        </div>
                    </div>
                    <div class="txt_desp">
                        <div class="txt">
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
                                <div class="btn_more">
                                    <span>もっと見る</span>
                                </div>
                            </div>
                        </div>
                        <div class="social_banner">
                            <h4>みんなに教える</h4>
                            <div class="social">
                                <a href="">
                                    <img src="assets/images/icon_tw_a.svg" width="" height="" alt="">
                                </a>
                                <a href="">
                                    <img src="assets/images/icon_fb_a.svg" width="" height="" alt="">
                                </a>
                                <a href="">
                                    <img src="assets/images/icon_line.svg" width="" height="" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="brand">
                    <div class="brand_left">
                        <div class="thumb">
                            <img class="util_pc" src="https://dummyimage.com/332x207/000000/fff" alt="">
                            <img class="util_sp" src="https://dummyimage.com/155x110/000000/fff" alt="">
                        </div>
                        <div class="txt_desp">
                            <h2>第2話 微笑みの裏側 <br> 次回予告</h2>
                            <p>1月6日（金）16時</p>
                        </div>
                    </div>
                    <div class="brand_right">
                        <h4>放送直前SP見逃し配信中！</h4>
                    </div>
                </div>
                <div class="broadcast_schedule">
                    <a href="#episode">放送スケジュール</a>
                </div>
            </div>
        </section>

        <section class="section" id="synopsis">
            <div class="inner">
                <h2>あらすじ</h2>
                <p>“愛を演じる男”と“危うさまで愛する女” ふたりの出す答えは―― <br>「無法弁護士～最高のパートナー」以来2年ぶりのイ・ジュンギ主演作！<br class="util_pc"> 百想芸術大賞5部門ノミネートされた傑作！</p>
                <div class="item_1">
                    <div class="content">
                        <div class="thumb">
                            <img src="https://dummyimage.com/600x400/000000/fff" alt="">
                        </div>
                        <p class="txt">金属工芸作家のペク・ヒソンは、愛する妻ジウォンと娘のウナに囲まれ、平凡だが幸せな日々を送っている。</p>
                    </div>
                    <p>金属工芸作家のペク・ヒソンは、愛する妻ジウォンと娘のウナに囲まれ、平凡だが幸せな日々を送っている。ただひとつ、刑事である嫁を厭う両親との関係だけが問題だ。そんなある日、ジウォンはひょんなことから知り合いの記者キム・ムジンにヒソンを紹介することに。18
                        年前の連続殺人事件に関する連載記事を手がけるムジンは、事件の犯人と同じ金属工芸作家であることからヒソンに興味を抱き、彼の工房に足を運ぶ。だが、ヒソンの顔を見たムジンは…。</p>
                </div>
                <div class="item_2">
                    <p>金属工芸作家のペク・ヒソンは、愛する妻ジウォンと娘のウナに囲まれ、平凡だが幸せな日々を送っている。ただひとつ、刑事である嫁を厭う両親との関係だけが問題だ。そんなある日、ジウォンはひょんなことから知り合いの記者キム・ムジンにヒソンを紹介することに。18
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

        <section class="section" id="correlation_diagram">
            <div class="inner">
                <h2>相関図</h2>
                <div class="thumb">
                    <img src="assets/images/correlation_diagram.svg" alt="">
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
                                        <p>金属工芸作家のヒソンは、愛する妻ジウォンと娘のウナに囲まれ、平凡だが幸せな日々を送っている。そんなある日、ジウォンはひょんなことから知り合いの記者ムジンにヒソンを紹介することに。
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
                                        <p>金属工芸作家のヒソンは、愛する妻ジウォンと娘のウナに囲まれ、平凡だが幸せな日々を送っている。そんなある日、ジウォンはひょんなことから知り合いの記者ムジンにヒソンを紹介することに。
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
                                        <p>金属工芸作家のヒソンは、愛する妻ジウォンと娘のウナに囲まれ、平凡だが幸せな日々を送っている。そんなある日、ジウォンはひょんなことから知り合いの記者ムジンにヒソンを紹介することに。
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
                                        <p>金属工芸作家のヒソンは、愛する妻ジウォンと娘のウナに囲まれ、平凡だが幸せな日々を送っている。そんなある日、ジウォンはひょんなことから知り合いの記者ムジンにヒソンを紹介することに。
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

        <section class="section" id="customer_voice">
            <div class="inner">
                <div class="tlt_section">
                    <h2>お客様の声</h2>
                    <div class="btn_more">
                        <span>すべて見る</span>
                    </div>
                </div>
                <div class="program_slide voice_list">
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

        <div class="opinions">
            <span>ご意見・ご感想を書く</span>
        </div>

        <!-- Chinese drama -->
        <section class="section" id="chinese_drama">
            <div class="inner">
                <div class="tlt_section">
                    <h2>中国・アジアドラマ</h2>
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
        <!-- /Chinese drama -->

        <!-- Korean drama -->
        <section class="section" id="korean_drama">
            <div class="inner">
                <div class="tlt_section">
                    <h2>韓国・韓流ドラマ</h2>
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
        <!-- /Korean drama -->

        <!-- drama movie -->
        <section class="section" id="drama_movie">
            <div class="inner">
                <div class="tlt_section">
                    <h2>ドラマ・映画</h2>
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
        <!-- /drama movie -->

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
                            <a href="#">生活向上 <br> エンタテインメント</a>
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
<?php
get_footer();
