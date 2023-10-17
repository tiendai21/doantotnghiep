<?php // echo '各番組トップ';

$term = get_queried_object();

$parent_term = get_term_by( 'id', $term->parent, 'program_cat' );

?>

<div id="tpl-topicpath">
    <div class="tpl-inner-wrap">
        <ul>
            <li><a href="/"><?php  bs12_pankuzu_text_top(); ?></a> </li>
			<?php if ( preg_match( '/(korea|china)/', $parent_term->slug ) ) { ?>
				<li><a href="/program/drama/">ドラマ・映画</a></li>
			<?php } ?>
            <?php if ( strpos( $term->slug, 'baseball') === false ) { ?>
				<li><a href="<?php echo get_term_link( $parent_term ); ?>"><?php echo $parent_term->name; ?></a></li>
            <?php }  ?>
            <?php /*if ( preg_match( '/drama/', $parent_term->slug ) ) { ?>
					<li><a href="/program/drama/">日本ドラマ</a></li>
            <?php } */
            $program_name=get_field('pankuzu_program_name',$term);
            if($program_name == "") $program_name = $term->name;
            ?>
            <li><?php echo esc_attr( $program_name ); ?></li>
        </ul>
    </div>
</div><!-- /tpl-topicpath -->
<!-- main -->
<main id="main">
    <ul class="breadcrumb">
        <li>
            <a href="#">BS12 | BS無料放送ならBS12 トゥエルビ</a>
        </li>
        <li>
            <a href="#">ドラマ・映画</a>
        </li>
        <li>
            <a href="#">韓国・韓流ドラマ</a>
        </li>
        <li>
            <span>悪の花</span>
        </li>
    </ul>
<!--    --><?php //var_dump(get_field('list_thumb', $term)) ?>
    <section class="section" id="banner">
        <div class="inner">
            <div class="banner_scroll">
                <div class="thumb">
                    <img <?php echo get_program_thumbnail( $term, 'item' ); ?> alt="">
                </div>
            </div>
            <div class="content">
                <h2><?php the_title()?></h2>
                <div class="date">
                    <h4><?php echo get_field('onairtime', $term); ?></h4>
                    <div class="btn_google">
                        <a href="">Googleカレンダーで視聴予約</a>
                    </div>
                </div>
                <div class="txt_desp">
                    <div class="txt">
                        <p class="util_pc"><?php echo get_field('pg_text', $term); ?></p>
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
                                <img src="<?php echo get_stylesheet_directory_uri() . "/assets/images/icon_tw_a.svg" ?>" width="" height="" alt="">
                            </a>
                            <a href="">
                                <img src="<?php echo get_stylesheet_directory_uri() . "/assets/images/icon_fb_a.svg"?>" width="" height="" alt="">
                            </a>
                            <a href="">
                                <img src="<?php echo get_stylesheet_directory_uri() . "/assets/images/icon_line.svg"?>" width="" height="" alt="">
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
<div id="tpl-contents">
    <?php $bg_style = get_program_bg_style( $term ); ?>
    <div class="tpl-inner-bg <?php echo $bg_style['bg_style_type']; ?>" style="<?php echo $bg_style['bg_style_str']; ?>"></div>
    <div class="tpl-inner-wrap">
        <?php
        global $bs12_program_top_parts_arr;
        $bs12_program_top_parts_arr = [];
        if ( have_posts() ) {
            while ( have_posts() ) {
                the_post();
                // var_dump( get_the_title() );
                if ( get_post_format( get_the_ID() ) === 'aside') {
                    $bs12_program_top_parts_arr['top'] = get_post();
                } elseif( get_post_format( get_the_ID() ) === 'image') {
                    $bs12_program_top_parts_arr['nav'] = get_post();
                }
            }
        }

        //ログインしていない、かつ、トップページ属性の記事が公開ではない(＝getpost出来ない)の場合に404リダイレクトする。add yanagi 20190822
        if (! is_user_logged_in() && !isset($bs12_program_top_parts_arr['top'])){wp_redirect( home_url('/404/'), 404 );exit;}

        wp_reset_postdata();
        $html_area = get_field( 'html_area', $bs12_program_top_parts_arr['top']->ID );
        if ( trim( $html_area ) == '' ) {
            // htmlがない場合は表示
            ?>
            <section class="category-hero program-mv">
                <p class="img"><?php echo get_program_thumbnail($term, 'top'); ?></p>
                <div class="description">
                    <div class="heading">
						<h1 class="title"><?php echo $term->name; ?></h1>
                        <p class="onair-date"><?php echo get_field('onairtime', $term); ?></p>
                        <p class="text"><?php echo get_field('pg_text', $term); ?></p>
                    </div>
                    <?php get_template_part( 'template-parts/program/share', 'buttons' ); ?>
                </div>
            </section>


            <?php
            // 番組ナビゲーション
            get_template_part('template-parts/program', 'nav');


            // 番組トップページ要素を表示
            get_template_part( 'template-parts/program', 'front-page' );
        } else {
            echo $html_area;
        }

        $parent_term = get_term( $term->parent, 'program_cat' );

		if ( $parent_term->slug !== 'entertainment' ) {
        ?>

        <?php //BS12_RENEWAL-269 【タスク】レイアウト変更ならびにWP機能追加 edit 20201012 yanagi ?>
        <!-- こちらもおすすめ -->
        <?php display_program_recommend_often_watch_by_category_slug($term); ?>
        <!-- /こちらもおすすめ -->

        <?php //BS12_RENEWAL-290 【施策3】導線追加（TOP／番組TOP／記事ページ） add 20210406 ishizaki ↓?>
        <section class="section-wrap">
            <div class="btn-list">
                <ul class="w320">
                    <li class="btn"><a href="/program_schedule/">番組表を見る</a></li>
                    <li class="btn"><a href="<?php echo get_term_link( $parent_term ); ?>"><?php echo $parent_term->name; ?>一覧を見る</a></li>
                    <li class="btn"><a href="/corporate/faq/">よくあるご質問</a></li>
                </ul>
            </div>
        </section>
        <?php //add 20210406 ishizaki ↑?>

        <?php 
        //edit yanagi 20210915↓
        //BS12_RENEWAL-295 【施策18】コンテンツの順序変更 ドラマ詳細ページ
        ?>
        <!-- ランキング -->
        <section class="section-wrap">
            <div class="program-ranking-wrap">
                <div class="program-list-wrap">
                    <h2 class="section-ttl"><?php echo $parent_term->name; ?>ランキング</h2>
                    <?php display_program_ranking_by_category_slug( $parent_term->slug ); ?>
                </div>

                <?php //SPのみ　BS12_RENEWAL-227 【施策ID：51-2】内部リンクの追加：番組ページから番組カテゴリ一覧のリンク追加add_ishizaki20200420 ↓?>
                <div class="btn-wrap only-sp marB5">
                    <p class="btn"><a href="<?php echo get_term_link( $parent_term ); ?>"><?php echo $parent_term->name; ?>一覧を見る</a></p>
                </div>
                <?php //add_ishizaki20200420↑ ?>

                <div class="program-list-wrap">
                    <h2 class="section-ttl">アクセスランキング</h2>
                    <?php display_program_ranking_by_category_slug( 'all' ); ?>
                </div>

                <?php //PCのみ　BS12_RENEWAL-227 【施策ID：51-2】内部リンクの追加：番組ページから番組カテゴリ一覧のリンク追加add_ishizaki20200420 ↓?>
                <div class="btn-wrap only-pc">
                    <p class="btn"><a href="<?php echo get_term_link( $parent_term ); ?>"><?php echo $parent_term->name; ?>一覧を見る</a></p>
                </div>
                <?php //add_ishizaki20200420↑ ?>
            </div>
        </section>
        <!-- /ランキング -->
		<?php } ?>

        <!-- BS12おすすめ番組 -->
        <?php get_template_part( 'template-parts/top', 'recommend-you-programs' ); ?>
        <!-- /BS12おすすめ番組 -->

        <?php get_template_part( 'template-parts/ad/ad-recommend', 'ad-recommend' ); ?>

        <?php //edit yanagi 20210915↑ ?>

        <?php
        //BS12_RENEWAL-269 【タスク】レイアウト変更ならびにWP機能追加 edit 20201012 yanagi
        // BS12 特選情報
        get_template_part( 'template-parts/top', 'special-select' );
        ?>

        <!-- 人気の番組カテゴリ -->
        <section class="section-wrap">
            <div class="program-list-wrap">
                <h2 class="section-ttl">人気の番組カテゴリ</h2>
                <div class="white-wrap">
                    <?php get_template_part( 'template-parts/seo/category', 'famous-list' ); ?>
                </div>
            </div>
        </section>
        <!-- /人気の番組カテゴリ -->

        <?php //BS12_RENEWAL-269 【タスク】レイアウト変更ならびにWP機能追加 edit 20201012 yanagi ?>
        <!-- 新着情報 -->
        <section class="section-wrap">
            <div class="program-list-wrap">
                <h2 class="section-ttl">新着情報</h2>
                <div class="program-mini-list twin">
                    <?php get_template_part( 'template-parts/news/program', 'whatsnew-list' ); ?>
                </div>
                <div class="btn-wrap w300">
                    <p class="btn"><a href="/news/whatsnew/">新着情報一覧を見る</a></p>
                </div>
            </div>
        </section>
        <!-- /新着情報 -->

        <!-- BS12 サキドリ情報 -->
        <?php get_template_part( 'template-parts/top', 'sakidori' ); ?>
        <!-- /BS12 サキドリ情報 -->

        <section class="section-wrap">
            <div class="information">
                <h2 class="section-ttl">お知らせ</h2>
                <div class="info-box">
                    <div class="info-list-wrap info-scroll">
                        <?php get_template_part( 'template-parts/news/announce', 'list' ); ?>
                    </div>
                </div>
            </div>
        </section>
		<?php get_template_part( 'template-parts/ad/ad-info', 'ad-info' ); ?>


            <?php get_template_part( 'template-parts/uiux/bottom', 'roll-link' ); ?>

    </div>
</div>
