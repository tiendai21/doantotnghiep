<?php
get_header();
?>
    <!--main-->
    <main id="main">
        <!--breadcumb-->
        <div class="breadcrumb">
            <ul>
                <li>
                    <a href="<?php echo esc_url(home_url('/')) ?>">BS12 | BS無料放送ならBS12 トゥエルビ</a>
                </li>
                <li>
                    <span>プレス情報</span>
                </li>
            </ul>
        </div>
        <!--/breadcumb-->
        <!--content the press-->
        <?php
        $press_lists = [];
        $args = [
            'post_type' => 'press',
            'posts_per_page' => '-1'
        ];
        $the_query = new WP_Query($args);
        if ($the_query->have_posts()) {
            while ($the_query->have_posts()) {
                $the_query->the_post();
                // var_dump( get_the_time( 'Y.m.d'));
                $item = [];
                // var_dump( $press_category );
                $item['title_link'] = get_press__title_link_tag();
                $press_categories = get_field('press_category');
                foreach ($press_categories as $c) {
                    $press_lists[$c][] = $item;
                }
            }
        }

        // var_dump( $press_lists );
        ?>
        <section class="section" id="content_the_press">
            <div class="inner">
                <div class="tlt_head">
                    <h2>プレス情報</h2>
                </div>
                <div class="content">
                    <h3>Monthly TwellVのダウンロード</h3>
                    <div class="item_content">
                        <h4>番組案内（マンスリー）</h4>
                        <ul class="pdf">
                            <?php foreach ($press_lists['1'] as $item) { ?>
                                <li>
                                    <div class="link_pdf">
                                        <?php echo $item['title_link']; ?>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="item_content both_normal_pdf">
                        <h4>編成表</h4>
                        <ul class="normal">
                            <?php foreach ($press_lists['2'] as $item) { ?>
                                <li><?php echo $item['title_link']; ?></li>
                            <?php } ?>
                        </ul>
                        <ul class="pdf">
                            <?php foreach ($press_lists['3'] as $item) { ?>
                                <li>
                                    <div class="link_pdf">
                                        <?php echo $item['title_link']; ?>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="item_content">
                        <h4>画像データダウンロード</h4>
                        <div class="thumb">
                            <iframe src="https://whvc.box.com/s/aewajq84sn7rccmsh6s73l279n5ocwo9" width="750" height="400"
                                    frameborder="0" allowfullscreen webkitallowfullscreen msallowfullscreen></iframe>
                        </div>
                        <div class="txt_desp">
                            <span>※1 都合により放送日時や内容が変更になる場合がございます。最新の編成表をご確認ください。</span>
                            <span>※2 各番組の画像が必要な場合は下記までご連絡ください。</span>
                            <span>BS12 トゥエルビ広報　電話：03-6451-1234　FAX：03-6451-1212　e-mail：<a href="mailto:koho@whvc.jp">koho@whvc.jp</a></span>
                            <span>※3 上記より画像ダウンロードができない場合は<a href="">こちら</a>よりお試しください。</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/content the press-->
    </main>
    <!--/main-->

<?php
get_footer();
