<?php
/**
 * bs12テーマセットアップ
 */
function bs12_theme_setup() {
    // add_theme_support( 'title-tag' );
    add_theme_support('post-formats', [ 'aside', 'chat', 'gallery', 'image' ] );
}
add_action( 'after_setup_theme', 'bs12_theme_setup' );

// 投稿フォーマットの表示名を変更
function rename_post_formats($translation, $text, $context, $domain) {
  $names = array(
    'Standard'  => '標準',
    'Aside'  => 'トップページ',
    'Chat' => '固定ページ',
    'Gallery'  => '記事',
    'Image'  => 'ナビゲーション',
  );
  if ($context == 'Post format') {
    $translation = str_replace(array_keys($names), array_values($names), $text);
  }
  return $translation;
}
add_filter('gettext_with_context', 'rename_post_formats', 10, 4);

/**
 * ヘッダーにacf設定情報を表示
 */
function bs12_add_css() {
    $page_css = get_field( 'page_css' );
    if( $page_css && trim( $page_css ) !== '' )  echo $page_css;
}

function bs12_add_js() {
    $page_js = get_field( 'page_js' );
    if( $page_js && trim( $page_js ) !== '' ) echo $page_js;
}

/** 20190912 add ishizaki↓ ＜SEO対策＞指名キーワード対策 TOP ページ評価向上施策
 * pankuzu（第1階層）
*/
function bs12_pankuzu_text_top(){
  echo 'BS12 | BS無料放送ならBS12 トゥエルビ';
}
// 20190912 add ishizaki↑

/**
 * title
 */
function bs12_title() {
    $sufix_common = "BS無料放送ならBS12（トゥエルビ）";
    $title_sitetop = 'BS12 | BS無料放送ならBS12 トゥエルビ';//20190912 add ishizaki ＜SEO対策＞指名キーワード対策 TOP ページ評価向上施策
    $term_obj = get_queried_object() ;
    if($term_obj) {
      // ターム系
      $meta_title = get_field( 'meta_title_text',$term_obj ); // カスタムフィールド取得
    } else {
      // その他
      $meta_title = get_field( 'meta_title_text' ); // カスタムフィールド取得
    }

    // $meta_title = ""; // カスタムフィールド判定無効化処理

    if( $meta_title ) {
        // カスタムフィールド入力済の場合
        echo $meta_title;
    } else {
        // カスタムフィールド未入力
        if(is_tax('news_cat')) {
            // ニュースカテゴリアーカイブ
            $year = get_query_var( 'year');
            if ( $year ){
                // 年別アーカイブ
                echo $year."年の新着情報一覧 | $sufix_common";
            } else {
                // その他アーカイブ
                $term_title = single_term_title("", false);
                echo $term_title."一覧 | $sufix_common";
            }
        } elseif(is_tax('program_cat')) {
            // 番組カテゴリ
            if ( $term_obj ) {
                $code = get_field( 'code',  $term_obj );
                if ( $code != '' ){
                    // 番組トップ
					$term_category = get_term_by('id', $term_obj->parent, 'program_cat');
                    if ( strpos( 'baseball', $term_obj->slug ) !== false ) {
						// 野球はカテゴリーを出さない
                        echo $term_obj->name . " | $sufix_common";
                    } else {
                        echo $term_obj->name . ' | ' . $term_category->name . " | $sufix_common";
                    }
                } elseif( $term_obj->parent === 0) {
                    // 番組大カテゴリ一覧: ドラマ、スポーツ等
                    echo $term_obj->name . "一覧 | $sufix_common";
                } else {
                    // 番組内アーカイブ・放送スケジュール等
                    $term_program = get_term_by('id', $term_obj->parent, 'program_cat'); // 番組
                    $term_category = get_term_by('id', $term_program->parent, 'program_cat'); // カテゴリ
                    /* 2ページ目以降の場合：{ページ数}ページ目 {ページ名} | {カテゴリ名}「{番組名}」 | BS無料放送ならBS12（トゥエルビ） edit 20190821 ishizaki ↓↓ */
                    $paged = (get_query_var('paged'));
                    if ($paged >= 2 ) {
                        $paged_title = $paged . "ページ目 ";
                    } else {
                        $paged_title ="";
                    }
                    if ( strpos( 'baseball', $term_program->slug ) !== false || preg_match( '/(korea|china)/', $term_category->slug ) ) {
                    // 野球または韓国中国ドラマはカテゴリーを表示しない
                        echo $paged_title. $term_obj->name . ' | ' . $term_program->name . " | $sufix_common";
                    } else {
                        echo $paged_title. $term_obj->name . ' | ' . $term_program->name . ' | ' . $term_category->name . " | $sufix_common";
                        /* edit 20190821 ishizaki ↑↑ */
                    }
                }
            }
        } elseif(is_singular('program')){
            // 番組記事
            $terms = get_the_terms( get_the_ID(), 'program_cat');
            $term_this = null;
            $term_program = null;
            $term_category = null;
            foreach( $terms as $t ) {
                if ( get_field( 'code', $t )) {
                    $term_program = $t;
                } else {
                    $term_this = $t;
                }
            }

            echo get_the_title();
            if ( $term_program === null ) {
                if ( $term_this) {
                    $term_program = get_term_by('id', $term_this->parent, 'program_cat');
                    $term_category = get_term_by( 'id', $term_program->parent, 'program_cat' );
                }
            }

            /* 詳細は小カテゴリ（ラインナップ）を出さない
            if ( $term_this ) {
                if ( strpos( 'baseball', $term_program->slug ) === false
                && ! preg_match( '/(korea|china)/', $term_category->slug ) ) {
                    echo ' | ' . $term_this->name;
                }
            }
            */

            if( $term_program ) {
                echo ' | ' . $term_program->name;
            }

			if ( $term_category === null ) {
				$term_category = get_term_by( 'id', $term_program->parent, 'program_cat' );
			}

            if ( strpos( 'baseball', $term_program->slug ) === false
                && ! preg_match( '/(korea|china)/', $term_category->slug ) ) {
                // 野球・中国ドラマ・韓国ドラマ以外は番組子カテゴリを表示
                echo ' | ' . $term_category->name;
            }

            echo  " | $sufix_common";
        } elseif(is_singular('news')){
            // ニュース記事
            echo get_the_title()." | $sufix_common";
        } elseif(is_front_page()) {
            // トップページ
            echo $title_sitetop;
        } elseif(is_page()) {
            // 固定ページ
            echo get_the_title()." | $sufix_common";
        } elseif(is_post_type_archive("program")) {
          // 番組アーカイブ
          if ( get_query_var( 'onair_status' ) === 'finished'  ) {
            // /program/archive/
            echo "終了番組一覧 | $sufix_common";
          }else{
            // /program/
            echo "番組一覧 | $sufix_common";
          }
        } elseif(is_post_type_archive("press")) {
            // /press/
            echo "プレス情報 | $sufix_common";
        } else {
            // その他
        }
    }
}

/**
 * meta:canonical
 * 20220608 add yanagi
 * BS12_RENEWAL-334 【施策80】アジア推しドラマページのcanonical属性タグ修正
 */
function bs12_meta_canonical() {
  $meta_canonical = "https://www.twellv.co.jp";
  if( is_page('bs12asia') ){
    $meta_canonical = 'https://www.twellv.co.jp/bs12asia/?utm_source=bs12&utm_medium=organic&utm_campaign=korea_top';
  }
  echo $meta_canonical;
}

/**
 * keywords
 */
function bs12_keywords() {
  $term_obj = get_queried_object() ;
  if($term_obj) {
    // ターム系
    $meta_keywords = get_field( 'meta_keywords',$term_obj );
  } else {
    // その他
    $meta_keywords = get_field( 'meta_keywords' );
  }
  if( $meta_keywords ) {
    // カスタムフィールド入力済の場合
    echo $meta_keywords;
  } else {
    // カスタムフィールド未入力
    if(is_post_type_archive("program")) {//add 20190726 yanagi ↓↓
      // 番組アーカイブ
      if ( get_query_var( 'onair_status' ) === 'finished'  ) {
        // /program/archive/
        echo "ドラマ,映画,韓国,韓流ドラマ,中国ドラマ,スポーツ,旅,グルメ,バラエティ,情報,ドキュメンタリー,音楽番組,アニメ,通販,BS12,トゥエルビ,TwellV";
      }else{
        // /program/
        echo "ドラマ,映画,韓国,韓流ドラマ,中国ドラマ,スポーツ,旅,グルメ,バラエティ,情報,ドキュメンタリー,音楽番組,アニメ,通販,BS12,トゥエルビ,TwellV";
      }
    }else{
    // その他
    echo "ドラマ,映画,BS12,トゥエルビ,TwellV";
    }//add 20190726 yanagi ↑↑
  }
}

/**
 * description
 */
function bs12_description() {
  $term_obj = get_queried_object() ;
  if($term_obj) {
    // ターム系
    $meta_description = get_field( 'meta_description',$term_obj );
  } else {
    // その他
    $meta_description = get_field( 'meta_description' );
  }
  if( $meta_description ) {
    // カスタムフィールド入力済の場合
    echo $meta_description;
  } else {
    // カスタムフィールド未入力
    if(is_post_type_archive("program")) {//add 20190726 yanagi ↓↓
      // 番組アーカイブ
      if ( get_query_var( 'onair_status' ) === 'finished'  ) {
        // /program/archive/
        echo "BS12 トゥエルビの終了番組一覧。過去に放送していた番組の一覧です。";
      }else{
        // /program/
        echo "BS12 トゥエルビの番組一覧。各ジャンルから選りすぐりの番組を無料でご覧いただけます。";
      }
    }else{
      // その他
      echo "BS12 トゥエルビのドラマ・映画番組一覧。BS12 トゥエルビは、無料放送です。";
    }//add 20190726 yanagi ↑↑
  }
}

/**
 * og:description
 */
function bs12_og_description() {
  $term_obj = get_queried_object() ;
  if($term_obj) {
    // ターム系
    $og_description = get_field( 'og_description',$term_obj );
  } else {
    // その他
    $og_description = get_field( 'og_description' );
  }
  if( $og_description ) {
    // カスタムフィールド入力済の場合
    echo $og_description;
  } else {
    // カスタムフィールド未入力
    if(is_tax('program_cat')) {
      // 番組カテゴリ
      if(get_queried_object()->parent == "0") {
        // 大カテゴリ
        echo "BS12 トゥエルビのドラマ・映画番組一覧。BS12 トゥエルビは、無料放送です。";
      } else {
        // 下層カテゴリ
        echo parent_program_term_object()->name."ならBS12 (トゥエルビ)で! ";
      }
    } elseif(is_singular('program')){
      // 番組記事
      echo parent_program_term_object()->name."ならBS12 (トゥエルビ)で! ";
    }elseif(is_post_type_archive("program")) {//add 20190726 yanagi ↓↓
      // 番組アーカイブ
      if ( get_query_var( 'onair_status' ) === 'finished'  ) {
        // /program/archive/
        echo "BS12 トゥエルビの終了番組一覧。過去に放送していた番組の一覧です。";
      }else{
        // /program/
        echo "BS12 トゥエルビの番組一覧。各ジャンルから選りすぐりの番組を無料でご覧いただけます。";
      }
    } else {//add 20190726 yanagi ↑↑
      // その他
      echo "BS12 トゥエルビのドラマ・映画番組一覧。BS12 トゥエルビは、無料放送です。";
    }
  }
}

/**
 * og:image
 */
function bs12_og_image() {
  $term_obj = get_queried_object() ;
  if($term_obj) {
    // ターム系
    $og_image = get_field( 'og_image',$term_obj );
  } else {
    // その他
    $og_image = get_field( 'og_image' );
  }
  if( $og_image ) {
    // カスタムフィールド入力済の場合
    echo $og_image['url'];
  } else {
    // カスタムフィールド未入力
    echo 'https://www.twellv.co.jp/assets/common/img/ogp.jpg';
  }
}

/**
 * og:url
 */
function bs12_og_url() {
  $url = ( empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
  $url = esc_url( $url );
  echo $url;
}

/**
 * meta:thumbnail
 * 20210915 add yanagi
 * BS12_RENEWAL-293 【施策2】トップページのアイキャッチ画像
 */
function bs12_meta_thumbnail() {
  $meta_thumbnail = "";
  if( is_front_page() || is_home() ){
    $meta_thumbnail = '<meta name="thumbnail" content="https://www.twellv.co.jp/assets/common/img/ogp.jpg" />';
  }
  echo $meta_thumbnail;
}

/**
 * noindex
 */
function bs12_noindex() {
  // noindexスクリプト
  $format = '<meta name="robots" content="noindex" />';
  // 付与ディレクトリリスト作成
  $target_dir = array('present_event', 'social', 'event', 'news_release', '1609drunk', 'shini', 'ev', 'mirai-car');
  // 条件に合致したらスクリプトを出力する。
  if(is_page($target_dir)) {
    echo $format."\n";
    //20200715 add yanagi ↓↓↓
    //参照：BS12_RENEWAL-244 【施策ID：65-1】news配下の低品質コンテンツのnoindex
  }elseif(is_singular('news')){// ニュース記事
    $terms = get_the_terms( get_the_ID() , 'news_cat');
    $t = $terms[0];
    if( $t->slug === 'release' || $t->slug === 'whatsnew' ) {
      $pdf = get_field( 'pdf');
      $url = get_field( 'url' );
      if( $pdf || $url) {
        echo $format."\n";
      }
    }elseif( $t->slug === 'announce' ){
      echo $format."\n";
    }
    //edit_isizaki20200608 ↓↓↓
    //クエリパラメータが存在している場合、noindexタグを出力する
    //参照：BS12_RENEWAL-236 【施策ID：53-1】パラメータページのnoindex
  }elseif(!empty($_SERVER['QUERY_STRING'])){
    echo $format."\n";
  }
  
  // 20201119 以下のURLのnoindex化対応を実施
  // /news/
  // /news/announce/
  // /event/
  // /news_release/
  // /1609drunk/
  // /shini/
  // /ev/
  // /mirai-car/mirai-car-audi/
  
}

/**
 *
 * bs12_footer_scroll_pagetop
 *
 * BS12_RENEWAL-240 【施策ID：55-1】番組カテゴリ：ページ内リンクの修正
 * 20200617 add yanagi
 *
 */


/**
 *
 * bs12_footer_program_links
 *
 * BS12_RENEWAL-241 【施策ID：57-1】全体：フッターリンク追加
 * BS12_RENEWAL-272 【タスク】「生活エンタ」配下「特選情報 資料請求」の字句修正
 * 20200706 add yanagi
 *
 */
function bs12_footer_program_links() {

  $program_links_items = [
    'drama'   => ['label' => 'ドラマ・映画', 'url' => '/program/drama/"'],
    'korea'   => ['label' => '韓国・韓流ドラマ', 'url' => '/program/korea/'],
    'china'   => ['label' => '中国・アジアドラマ', 'url' => '/program/china/'],
    'sports'  => ['label' => 'スポーツ', 'url' => '/program/sports/'],
    'baseball' => ['label' => 'プロ野球中継', 'url' => '/program/sports/baseball/'],
    'tabi'    => ['label' => '旅・グルメ', 'url' => '/program/tabi/'],
    'variety' => ['label' => 'バラエティ', 'url' => '/program/variety/'],
    'documentary' => ['label' => '情報・ドキュメンタリー', 'url' => '/program/documentary/'],
    'music'   => ['label' => '音楽番組(演歌・歌謡)', 'url' => '/program/music/'],
    'anime'   => ['label' => 'アニメ', 'url' => '/program/anime/'],
    'entertainment' => ['label' => '生活エンタ・BS12 知っ得', 'url' => '/program/entertainment/'],
    'qvc'     => ['label' => '通販', 'url' => '/program/qvc/qvc-jp/']
  ];

  foreach( $program_links_items as $key => $item ) {
    echo "<li><a href=\"".$item["url"]."\">".$item["label"]."</a>";

    $args = [
      'post_type' => 'footer_program',
      'posts_per_page' => 1,
      'meta_key' => 'display_category',
      'meta_value' => $key
    ];

    $the_query = new WP_Query( $args );
    while ( $the_query->have_posts() ) {
      $the_query->the_post();
      echo "<ul>\n";
      while( have_rows( 'footer_program_list', get_the_ID() ) ) {
        the_row();
        $term_id = get_sub_field( 'footer_program');
        if($term_id){
          $term_obj = get_term_by( 'id', $term_id, 'program_cat' );
         //$category_term = get_term($term_obj->parent, 'program_cat' );
         echo "<li><a href=\"".get_term_link( $term_obj )."\">".$term_obj->name."</a></li>\n";
        }
      }
      echo "</ul>\n";
    }
    echo "</li>\n";
    wp_reset_postdata();
  }
}

/**
 * 
 * page_toplevel_slug
 * 
 * 固定ページの最上位のスラッグを取得する
 * 
 * BS12_RENEWAL-265 【施策ID：79-1】パンくず整理：企業情報配下
 * 20201009 add yanagi
 */
function page_toplevel_slug()
{
  global $post;

  if (is_page()) :
    if ($post->post_parent != 0) : //親がいる場合
      $ancestor = array_pop(get_ancestors($post->ID, 'page'));
      return esc_html(get_page_uri($ancestor));
    else : //親がいない場合は自身を返す
      return esc_html($post->post_name);
    endif;

  endif;
}

/**
 * 【管理画面】メニュー非表示設定
 */
add_action( 'admin_menu', 'remove_menus' );
function remove_menus(){
    // remove_menu_page( 'index.php' ); //ダッシュボード
    remove_menu_page( 'edit.php' ); //投稿メニュー
    // remove_menu_page( 'upload.php' ); //メディア
    // remove_menu_page( 'edit.php?post_type=page' ); //ページ追加
    remove_menu_page( 'edit-comments.php' ); //コメントメニュー
    // remove_menu_page( 'themes.php' ); //外観メニュー
    // remove_menu_page( 'plugins.php' ); //プラグインメニュー
    // remove_menu_page( 'tools.php' ); //ツールメニュー
    // remove_menu_page( 'options-general.php' ); //設定メニュー
}

/**
 * 【管理画面】韓国ドラマでフィルタリングするメニューを追加
 */
// add_action( 'restrict_manage_posts', 'add_custom_taxonomies_term_filter' );
// function add_custom_taxonomies_term_filter() {
//   global $post_type;
//   if ( $post_type == 'program' ) {
//     $taxonomy = 'program_cat';
//     wp_dropdown_categories( array(
//       'show_option_all' => '韓国ドラマ',
//       'child_of' => 14,
//       'hierarchical' => 1,
//       'orderby' => 'name',
//       'selected' => get_query_var( $taxonomy ),
//       'hide_empty' => 0,
//       'name' => $taxonomy,
//       'taxonomy' => $taxonomy,
//       'value_field' => 'slug',
//     ) );
//   }
// }

/**
 *  MIMEタイプ追加
 */
function add_mimes($mimes) {
  $mimes['xls']  = 'application/vnd.ms-excel';

  return $mimes;
}
add_filter('upload_mimes','add_mimes');

/*-------------------------------------------*/
/* 　カスタムフィールドもプレビューできるようにする
/*-------------------------------------------*/
function get_preview_id($postId) {
    global $post;
    $previewId = 0;
    if ( isset($_GET['preview'])
            && ($post->ID == $postId)
                && $_GET['preview'] == true
                    &&  ($postId == url_to_postid($_SERVER['REQUEST_URI']))
        ) {
        $preview = wp_get_post_autosave($postId);
        if ($preview != false) { $previewId = $preview->ID; }
    }
    return $previewId;
}

add_filter('get_post_metadata', function($meta_value, $post_id, $meta_key, $single) {
    if ($preview_id = get_preview_id($post_id)) {
        if ($post_id != $preview_id) {
            $meta_value = get_post_meta($preview_id, $meta_key, $single);
        }
    }
    return $meta_value;
}, 10, 4);

add_action('wp_insert_post', function ($postId) {
    global $wpdb;
    if (wp_is_post_revision($postId)) {
        if (count($_POST['fields']) != 0) {
            foreach ($_POST['fields'] as $key => $value) {
                $field = get_field($key);
                if ( !isset($field['name']) || !isset($field['key']) ) continue;
                if (count(get_metadata('post', $postId, $field['name'], $value)) != 0) {
                    update_metadata('post', $postId, $field['name'], $value);
                    update_metadata('post', $postId, "_" . $field['name'], $field['key']);
                } else {
                    add_metadata('post', $postId, $field['name'], $value);
                    add_metadata('post', $postId, "_" . $field['name'], $field['key']);
                }
            }
        }
        do_action('save_preview_postmeta', $postId);
    }
});

/**
 * smartnews RSS
 */
add_action( 'do_feed_smartnews', 'do_feed_smartnews' );
function do_feed_smartnews() {
	$feed_template = get_template_directory() . '/smartnews.php';
	load_template( $feed_template );
}
/**
 * smartnews RSS
 */
//add_action( 'do_feed_smartnews2', 'do_feed_smartnews2' );
//function do_feed_smartnews2() {
//	$feed_template = get_template_directory() . '/smartnews2.php';
//	load_template( $feed_template );
//}
/**
 * smartnews RSS
 */
//add_action( 'do_feed_smartnews3', 'do_feed_smartnews3' );
//function do_feed_smartnews3() {
//	$feed_template = get_template_directory() . '/smartnews3.php';
//	load_template( $feed_template );
//}

// outside404 page

function outsite404_exclude() {
	if($_SERVER['REQUEST_URI']=="/404.html"){return true;}
}
add_filter( 'pre_handle_404', 'outsite404_exclude' );

/**
 * Offload MediaでS3にアップする際のCacheControlの条件を変更
 */
function as3cf_cache_control($args, $post_id, $image_size){

	$args['CacheControl'] = "max-age=0,s-maxage=3600";
	unset($args['Expires']);
	return $args;
}
add_filter( 'as3cf_object_meta', 'as3cf_cache_control', 10, 3);


