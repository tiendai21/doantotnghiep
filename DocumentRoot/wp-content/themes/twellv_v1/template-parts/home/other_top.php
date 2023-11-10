<?php
$hideSocial = $args['social'];
?>
<section class="section" id="other">
    <div class="inner">
        <div class="tlt_section">
            <h2>その他　一覧</h2>
        </div>
        <div class="list_other">
            <ul>
                <li>
                    <a href="<?php echo esc_url(home_url('/program/drama/')) ?>">ドラマ・映画</a>
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
                    <a href="#">ライフスタイル</a>
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
        <!--   Social banners     -->
        <?php if (have_rows('home_social_banners', 'option') && !$hideSocial): ?>
            <div class="list_social util_pc">
                <ul>
                    <?php while (have_rows('home_social_banners', 'option')) :
                        the_row();
                        $social_banner_img = get_sub_field('social_banner_image');
                        $social_banner_url = get_sub_field('social_banner_url');
                        ?>
                        <li>
                            <a href="<?php echo $social_banner_url?>">
                                <img src="<?php echo $social_banner_img ?>" width="420" height="105" alt="social_banner_img">
                            </a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        <?php endif; ?>
        <!--   /Social banner     -->
    </div>
</section>