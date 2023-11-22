<?php $webroot = $_SERVER['DOCUMENT_ROOT']; ?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0" />
    <meta name="format-detection" content="telephone=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?php bs12_title(); ?></title>
    <meta name="description" content="<?php bs12_description(); ?>" />
    <meta name="keywords" content="<?php bs12_keywords(); ?>" />
    <?php
    //20210915 add yanagi
    //BS12_RENEWAL-293 【施策2】トップページのアイキャッチ画像
    bs12_meta_thumbnail();
    ?>
    <meta property="fb:app_id" content="ー" />
    <meta property="og:url" content="<?php bs12_og_url(); ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php bs12_title(); ?>" />
    <meta property="og:locale" content="ja_JP" />
    <meta property="og:image" content="<?php bs12_og_image(); ?>" />
    <meta property="og:description" content="<?php bs12_og_description(); ?>" />
    <meta property="og:site_name" content="BS12トゥエルビ" />
    <meta property="Twitter:card" content="summary_large_image" />
    <meta property="Twitter:site" content="@BS12_TwellV" />
    <meta property="Twitter:creator" content="@dmmolg_mash" />
    <meta property="Twitter:title" content="<?php bs12_title(); ?>" />
    <meta property="Twitter:description" content="<?php bs12_og_description(); ?>" />
    <meta property="Twitter:image" content="<?php bs12_og_image(); ?>" />
    <meta property="Twitter:url" content="<?php bs12_og_url(); ?>" />
    <link rel="icon" type="image/x-icon" href="" />
    <link rel="icon" type="image/vnd.microsoft.icon" href="" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;600;700&family=Roboto:wght@700&display=swap"
        rel="stylesheet">
    <?php if(get_field('page_css')): ?>
        <!-- [CONTENT CSS] -->
        <style type="text/css">
            <?php the_field('page_css'); ?>
        </style>
        <!-- /[CONTENT CSS] -->
    <?php endif; ?>
    <?php if(get_field('page_js')): ?>
        <!-- [CONTENT JS] -->
        <?php the_field('page_js'); ?>

        <!-- /[CONTENT JS] -->
    <?php endif; ?>

    <?php if(get_field('page_ad')): the_field('page_ad'); endif; ?>
    <?php get_template_part( 'inc/common/head_gtm' ); ?>
    <?php bs12_noindex(); ?>
    <?php get_template_part('header-ads.php') ?>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P3N9BL"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- header -->
<?php get_template_part( 'inc/common/header_content' ); ?>
<!-- /header -->