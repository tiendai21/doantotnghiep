<?php

remove_action( 'wp_head', 'wp_generator' ); // バージョン情報
remove_action( 'wp_head', 'rsd_link' ); // 外部のブログ投稿ツール
remove_action( 'wp_head', 'wlwmanifest_link' ); // remove wlwmanifest.xml (needed to support windows live writer)
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 ); // デフォルトパーマリンクURL
remove_action('wp_head', 'feed_links', 2); // フィードのリンク
remove_action('wp_head', 'feed_links_extra', 3); // フィードのリンク
remove_action('wp_head', 'index_rel_link');// remove link to index page
remove_action('wp_head', 'start_post_rel_link', 10, 0); // remove random post link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // remove parent post link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // remove the next and previous post links
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
remove_action( 'wp_head', 'wp_resource_hints', 2 );
remove_action('wp_head', 'rel_canonical');

remove_action( 'rss2_head', 'the_generator' );//RSS2からgeneratorタグを削除する add 20190807 yanagi

// 絵文字
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles' );
remove_action('admin_print_styles', 'print_emoji_styles');

// Embed系
remove_action('wp_head','rest_output_link_wp_head');
remove_action('wp_head','wp_oembed_add_discovery_links');
remove_action('wp_head','wp_oembed_add_host_js');
remove_action('template_redirect', 'rest_output_link_header', 11 );

/*
* Remove JSON API links in header html
*/
function remove_json_api () {
  // Remove the REST API lines from the HTML Header
  remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
  remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
  // Remove the REST API endpoint.
  remove_action( 'rest_api_init', 'wp_oembed_register_route' );
  // Turn off oEmbed auto discovery.
  add_filter( 'embed_oembed_discover', '__return_false' );
  // Don't filter oEmbed results.
  remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
  // Remove oEmbed discovery links.
  remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
  // Remove oEmbed-specific JavaScript from the front-end and back-end.
  remove_action( 'wp_head', 'wp_oembed_add_host_js' );
 // Remove all embeds rewrite rules.
 // add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
}
add_action( 'after_setup_theme', 'remove_json_api' );
