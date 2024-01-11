<?php
$type = $args['type'];
if ($type === 'famous') :
    ?>
    <section class="section" id="other">
        <div class="inner">
            <div class="tlt_section">
                <h2>人気の番組カテゴリ</h2>
            </div>
            <div class="list_other">
                <ul>
                    <li>
                        <a href="<?php echo esc_url(home_url('/program/drama/'))?>">ドラマ・映画</a>
                    </li>
                    <li class="util_pc">
                        <a href="<?php echo esc_url(home_url('/program/korea/'))?>">韓国・韓流ドラマ</a>
                    </li>
                    <li class="util_pc">
                        <a href="<?php echo esc_url(home_url('/program/china/'))?>">中国・アジアドラマ</a>
                    </li>
                    <li class="util_pc">
                        <a href="<?php echo esc_url(home_url('/program/sports/'))?>">スポーツ</a>
                    </li>
                    <li class="util_sp">
                        <a href="<?php echo esc_url(home_url('/program/korea/'))?>">韓国・韓流ドラマ</a>
                    </li>
                    <li class="util_sp">
                        <a href="<?php echo esc_url(home_url('/program/china/'))?>">中国・アジアドラマ</a>
                    </li>
                    <li class="util_sp">
                        <a href="<?php echo esc_url(home_url('/program/sports/'))?>">スポーツ</a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url(home_url('/sports/baseball/'))?>">プロ野球中継</a>
                    </li>
                    <li class="util_pc">
                        <a href="<?php echo esc_url(home_url('/program/drama/'))?>">旅・グルメ</a>
                    </li>
                    <li class="util_pc">
                        <a href="<?php echo esc_url(home_url('/program/variety/'))?>">バラエティ</a>
                    </li>
                    <li class="util_pc">
                        <a href="<?php echo esc_url(home_url('/program/documentary/'))?>">情報・ドキュメンタリー</a>
                    </li>
                    <li class="util_sp">
                        <a href="<?php echo esc_url(home_url('/program/tabi/'))?>">旅・グルメ</a>
                    </li>
                    <li class="util_sp">
                        <a href="<?php echo esc_url(home_url('/program/variety/'))?>">バラエティ</a>
                    </li>
                    <li class="util_sp">
                        <a href="<?php echo esc_url(home_url('/program/documentary/'))?>">情報・ <br>ドキュメンタリー</a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url(home_url('/program/music/'))?>">音楽番組(演歌・歌謡)</a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url(home_url('/program/anime/'))?>">アニメ</a>
                    </li>
                    <li class="util_pc">
                        <a href="<?php echo esc_url(home_url('/program/entertainment/'))?>">生活向上 <br>エンタテインメント</a>
                    </li>
                    <li class="util_pc">
                        <a href="<?php echo esc_url(home_url('/program/qvc/qvc-jp/'))?>">通販</a>
                    </li>
                    <li class="util_sp">
                        <a href="<?php echo esc_url(home_url('/program/entertainment/'))?>">生活向上 <br>エンタテインメント</a>
                    </li>
                    <li class="util_sp">
                        <a href="<?php echo esc_url(home_url('/program/qvc/qvc-jp/'))?>">通販</a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php
if ($type === 'all') :
    ?>
    <!-- other -->
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
                        <a href="<?php echo esc_url(home_url('/program/drama/'))?>">生活エンタ</a>
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
    <!-- /other -->
<?php endif; ?>
