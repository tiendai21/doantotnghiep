<?php
get_header();
?>
<!-- main -->
<main id="main">
    <!-- banner -->
    <?php get_template_part('template-parts/home/banner_top'); ?>
    <!-- /banner -->

    <!-- program air -->
    <?php get_template_part('template-parts/home/program_air_top', null, array('hideBtnWatch' => false)); ?>
    <!-- /program air -->

    <!-- brand -->
    <?php get_template_part('template-parts/home/brand_top'); ?>
    <!-- /brand -->

    <!-- history -->
    <?php get_template_part('template-parts/home/brow_history'); ?>
    <!-- /history -->

    <!-- news -->
    <?php get_template_part('template-parts/news/news_top'); ?>
    <!-- /news -->

    <!-- recommend -->
    <?php get_template_part('template-parts/home/recommend_top'); ?>
    <!-- /recommend -->

    <!-- category drama chinese -->
    <?php get_template_part('template-parts/home/recommend_china_top'); ?>
    <!-- /category drama chinese -->

    <!-- category drama korean -->
    <?php get_template_part('template-parts/home/recommend_korean_top'); ?>
    <!-- /category drama korean -->

    <!-- ranking -->
    <?php get_template_part('template-parts/ranking/ranking', null, array('cat' => 'all', 'title' => 'ランキング', 'sns' => true)); ?>
    <!-- /ranking -->

    <!-- Ad news -->
    <?php get_template_part('template-parts/add/add_news'); ?>
    <!-- /Ad news -->

    <!-- pr -->
    <?php get_template_part('template-parts/home/pr_top'); ?>
    <!-- /pr -->

    <!-- other -->
    <?php get_template_part('template-parts/home/other_top'); ?>
    <!-- /other -->

    <!-- section infomation -->
    <section class="section" id="section_infomation">
        <div class="inner">
            <div class="section_content">
                <div class="section_faq">
                    <div class="tlt_section">
                        <h2>よくあるご質問</h2>
                        <div class="btn_more">
                            <a href="<?php echo esc_url(home_url('/corporate/faq')) ?>">
                                すべて見る
                            </a>
                        </div>
                    </div>
                    <div class="list_faq">
                        <div class="faq">
                            <div class="item_faq">
                                <h3><span>q</span>BS12 トゥエルビではどんな番組を放送していますか？</h3>
                                <div class="content">
                                    <span>a</span>
                                    <p>ドラマ、スポーツ、アニメーション、ドキュメンタリー、音楽、ショッピングなど、各ジャンルから選りすぐりの番組を放送しています。</p>
                                </div>
                            </div>
                            <div class="item_faq">
                                <h3><span>q</span>ワールド・ハイビジョン・チャンネルとBS12 トゥエルビは違うのですか？</h3>
                                <div class="content">
                                    <span>a</span>
                                    <p>「ワールド・ハイビジョン・チャンネル」は社名で、「BS12 トゥエルビ」はチャンネル名になります。</p>
                                </div>
                            </div>
                            <div class="item_faq">
                                <h3><span>q</span>BS12 トゥエルビを見るのにはお金がかかりますか？</h3>
                                <div class="content">
                                    <span>a</span>
                                    <p>24時間完全無料放送です。現在BSデジタル放送を見られる方であればどなたでも無料で見ることができます。</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script type="application/ld+json">
                        {
                            "@context": "http://schema.org",
                            "@type": "FAQPage",
                            "description": "BS12 | BS無料放送ならBS12 トゥエルビ",
                            "mainEntity": [
                                {
                                    "@type": "Question",
                                    "name": "BS12 トゥエルビではどんな番組を放送していますか？",
                                    "acceptedAnswer": {
                                        "@type": "Answer",
                                        "text": "ドラマ、スポーツ、アニメーション、ドキュメンタリー、音楽、ショッピングなど、各ジャンルから選りすぐりの番組を放送しています。"
                                    }
                                },
                                {
                                    "@type": "Question",
                                    "name": "ワールド・ハイビジョン・チャンネルとBS12 トゥエルビは違うのですか？",
                                    "acceptedAnswer": {
                                        "@type": "Answer",
                                        "text": "「ワールド・ハイビジョン・チャンネル」は社名で、「BS12 トゥエルビ」はチャンネル名になります。"
                                    }
                                },
                                {
                                    "@type": "Question",
                                    "name": "BS12 トゥエルビを見るのにはお金がかかりますか？",
                                    "acceptedAnswer": {
                                        "@type": "Answer",
                                        "text": "24時間完全無料放送です。現在BSデジタル放送を見られる方であればどなたでも無料で見ることができます。"
                                    }
                                }
                            ]
                        }
                    </script>
                </div>
                <div class="section_news">
                    <div class="tlt_section">
                        <h2>お知らせ</h2>
                    </div>
                    <?php get_template_part('template-parts/news/news_list'); ?>
                </div>
            </div>
            <div class="news_release">
                <div class="tlt_section">
                    <h2>ニュースリリース</h2>
                    <div class="btn_more">
                        <a href="<?php echo esc_url(home_url('/news/release/')) ?>">
                            すべて見る
                        </a>
                    </div>
                </div>
                <?php get_template_part('template-parts/news/news_release'); ?>
            </div>

            <!-- Ad info -->
            <?php get_template_part('template-parts/add/add_info'); ?>
            <!-- /Ad info -->

            <div class="txt_notice">
                <p>「BS12トゥエルビ」とはワールド・ハイビジョン・チャンネル株式会社が運営するテレビ局で、24時間全国無料のBSデジタル放送局です。
                    ドラマ、スポーツ、アニメ、ドキュメンタリー、音楽、ショッピングなど上質なエンターテインメント番組を総合編成でお送りしています。</p>
            </div>
        </div>
    </section>
    <!-- /section infomation -->

    <?php if (function_exists('the_views')) {
        the_views();
    } ?>
</main>
<!-- /main -->
<?php
get_footer();
?>
