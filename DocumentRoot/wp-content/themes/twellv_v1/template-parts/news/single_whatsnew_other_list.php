<?php
$args = [
    'post_type' => 'news',
    'posts_per_page' => 4,
    'post__not_in' => [ get_the_ID() ],
    'tax_query' => [
        [
            'taxonomy' => 'news_cat',
            'field' => 'slug',
            'terms' => ['whatsnew']
        ]
    ]
];
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) {
    ?>
    <section class="section" id="other">
        <div class="inner">
            <div class="tlt_section">
                <h2>その他　一覧</h2>
            </div>
            <div class="list_other">
                <ul>
                    <li>
                        <a href="<?php echo esc_url(home_url('/program/drama/'))?>">ドラマ・映画</a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url(home_url('/program/sports/')) ?>">スポーツ</a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url(home_url('/program/variety/')) ?>">バラエティ</a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url(home_url('/program/music/')) ?>">音楽（演歌・歌謡）</a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url(home_url('/program/tabi/')) ?>">旅・グルメ</a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url(home_url('/program/drama/'))?>">ライフスタイル</a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url(home_url('/program/documentary/')) ?>">情報・ドキュメンタリー</a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url(home_url('/program/anime/')) ?>">アニメ</a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url(home_url('/program/qvc/qvc-jp/')) ?>">通販</a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <?php
}
