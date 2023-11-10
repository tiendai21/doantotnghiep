<?php
$page_uri = get_page_uri();
?>
<table class="tab_content">
    <thead>
    <tr>
        <th>ABOUT US</th>
    </tr>
    <tr <?php echo ($page_uri === 'corporate') ? 'class="active"' : null;?>>
        <th>
            <a href="<?php echo esc_url(home_url('/corporate'))?>">企業情報</a>
        </th>
    </tr>
    <tr <?php echo ($page_uri === 'corporate/mvv') ? 'class="active"' : null;?>>
        <th>
            <a href="<?php echo esc_url(home_url('/corporate/mvv'))?>">経営理念</a>
        </th>
    </tr>
    <tr <?php echo ($page_uri === 'corporate/program_council') ? 'class="active"' : null;?>>
        <th>
            <a href="<?php echo esc_url(home_url('/corporate/program_council'))?>">BS12 トゥエルビ放送番組審議会</a>
        </th>
    </tr>
    <tr <?php echo ($page_uri === 'program_standard2') ? 'class="active"' : null;?>>
        <th>
            <a href="<?php echo esc_url(home_url('/program_standard2'))?>">放送番組の編集基準</a>
        </th>
    </tr>
    <tr <?php echo ($page_uri === 'corporate/program_announce') ? 'class="active"' : null;?>>
        <th>
            <a href="<?php echo esc_url(home_url('/corporate/program_announce'))?>">BS12 トゥエルビ放送番組の種別基準</a>
        </th>
    </tr>
    <tr <?php echo ($page_uri === 'corporate/%e6%8e%a1%e7%94%a8%e6%83%85%e5%a0%b1') ? 'class="active"' : null;?>>
        <th>
            <a href="<?php echo esc_url(home_url('/corporate/%e6%8e%a1%e7%94%a8%e6%83%85%e5%a0%b1'))?>">採用情報</a>
        </th>
    </tr>
    <tr <?php echo ($page_uri === 'corporate/youth') ? 'class="active"' : null;?>>
        <th>
            <a href="<?php echo esc_url(home_url('/corporate/youth'))?>">青少年に見てもらいたい番組</a>
        </th>
    </tr>
    <tr <?php echo ($page_uri === 'news/release') ? 'class="active"' : null;?>>
        <th>
            <a href="<?php echo esc_url(home_url('/news/release'))?>">ニュースリリース</a>
        </th>
    </tr>
    <tr <?php echo ($page_uri === 'corporate/privacy_policy') ? 'class="active"' : null;?>>
        <th>
            <a href="<?php echo esc_url(home_url('/corporate/privacy_policy'))?>">プライバシーポリシー</a>
        </th>
    </tr>
    <tr <?php echo ($page_uri === 'corporate/site_policy') ? 'class="active"' : null;?>>
        <th>
            <a href="<?php echo esc_url(home_url('/corporate/site_policy'))?>">サイトポリシー</a>
        </th>
    </tr>
    <tr <?php echo ($page_uri === 'corporate/security') ? 'class="active"' : null;?>>
        <th>
            <a href="<?php echo esc_url(home_url('/corporate/security'))?>">情報セキュリティ方針</a>
        </th>
    </tr>
    <tr <?php echo ($page_uri === 'corporate/info') ? 'class="active"' : null;?>>
        <th>
            <a href="<?php echo esc_url(home_url('/corporate/info/'))?>">ケーブル局の皆さま</a>
        </th>
    </tr>
    <tr <?php echo ($page_uri === 'corporate/advertisement') ? 'class="active"' : null;?>>
        <th>
            <a href="<?php echo esc_url(home_url('/corporate/advertisement'))?>">生活向上エンタテインメントにおける個人情報の取り扱いについて</a>
        </th>
    </tr>
    <tr <?php echo ($page_uri === 'corporate/faq') ? 'class="active"' : null;?>>
        <th>
            <a href="<?php echo esc_url(home_url('/corporate/faq'))?>">よくあるご質問</a>
        </th>
    </tr>
    <tr <?php echo ($page_uri === 'site_map') ? 'class="active"' : null;?>>
        <th>
            <a href="<?php echo esc_url(home_url('/site_map'))?>">サイトマップ</a>
        </th>
    </tr>
    </thead>
</table>