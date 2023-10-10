<?php
/**
 * json-ld作成
 */
function bs12_footer_json_ld() {
    $sufix_common = "BS無料放送ならBS12（トゥエルビ）";

    $json_arr = [
        "@context" => "http://schema.org",
        "@type" => "BreadcrumbList"
    ];

    $elements = [];
    if ( is_home() || is_front_page() ) {
        $json_ld = json_encode( get_bs12_json_ld_home_data() );
        echo '<script type="application/ld+json">' . $json_ld . '</script>' . "\n";
        return;
    } elseif( is_tax('program_cat') ) {
        $term_obj = get_queried_object() ;
        $code = get_field( 'code',  $term_obj );
        if ( ! empty( $code )  ) {
            // 番組トップの場合、カスタムフィールドを表示し、終了
            $json_ld = get_field('json_ld', $term_obj);
            if ($json_ld) {
                echo '<script type="application/ld+json">' . $json_ld . '</script>' . "\n";
                return;
            } else {
                $index = 1;
                $elements[] = get_json_ld_list_item( $index, $sufix_common, get_home_url() );
                $index++;
                // 番組内アーカイブ・放送スケジュール等
                $term_program = $term_obj;
                if ( strpos( 'baseball', $term_program->slug ) !== false ) {
                    // 野球の場合
                    // echo $term_obj->name . ' | ' . $term_program->name . " | $sufix_common";
                    $elements[] = get_json_ld_list_item( $index, $term_program->name, get_term_link($term_program ) );
                    $index++;
                } else {
                    // 野球以外
                    $term_category = get_term_by('id', $term_program->parent, 'program_cat'); // カテゴリ
                    if ( preg_match( '/(korea|china)/', $term_category->slug ) ) {
                        $elements[] = get_json_ld_list_item( $index, "ドラマ・映画",  get_home_url() . "/program/drama/" );
                        $index++;
                    }
                    // echo $term_obj->name . ' | ' . $term_program->name . ' | ' . $term_category->name . " | $sufix_common";
                    $elements[] = get_json_ld_list_item( $index, $term_category->name, get_term_link($term_category ) );
                    $index++;
                    $elements[] = get_json_ld_list_item( $index, $term_program->name, get_term_link($term_program ) );
                    $index++;
                }
            }
        } else {
            // 番組トップではない
            $index = 1;
            $elements[] = get_json_ld_list_item( $index, $sufix_common, get_home_url() );
            $index++;
            if ( $term_obj->parent === 0 ) {
                // 番組カテゴリー一覧
                $term_category = $term_obj;
                if ( preg_match( '/(korea|china)/', $term_category->slug ) ) {
                    $elements[] = get_json_ld_list_item( $index, "ドラマ・映画",  get_home_url() . "/program/drama/" );
                    $index++;
                }
                $elements[] = get_json_ld_list_item( $index, $term_category->name, get_term_link($term_category ) );
                // $index++;
            } elseif( $term_obj->parent !== 0 ) {
                // 番組内アーカイブ・放送スケジュール等
                $term_program = get_term_by( 'id', $term_obj->parent, 'program_cat'); // 番組
                if ( strpos( 'baseball', $term_program->slug ) !== false ) {
                    // 野球の場合
                    // echo $term_obj->name . ' | ' . $term_program->name . " | $sufix_common";
                    $elements[] = get_json_ld_list_item( $index, $term_program->name, get_term_link($term_program ) );
                    $index++;
                } else {
                    // 野球以外
                    $term_category = get_term_by('id', $term_program->parent, 'program_cat'); // カテゴリ
                    if ( preg_match( '/(korea|china)/', $term_category->slug ) ) {
                        $elements[] = get_json_ld_list_item( $index, "ドラマ・映画",  get_home_url() . "/program/drama/" );
                        $index++;
                    }
                    // echo $term_obj->name . ' | ' . $term_program->name . ' | ' . $term_category->name . " | $sufix_common";
                    $elements[] = get_json_ld_list_item( $index, $term_category->name, get_term_link($term_category ) );
                    $index++;
                    $elements[] = get_json_ld_list_item( $index, $term_program->name, get_term_link($term_program ) );
                    $index++;
                }
                $elements[] = get_json_ld_list_item( $index, $term_obj->name, get_term_link($term_obj ) );
            }
        }
    } elseif(is_singular('program')) {
        $index = 1;
        $elements[] = get_json_ld_list_item($index, $sufix_common, get_home_url());
        $index++;
        // 番組記事
        $terms = get_the_terms(get_the_ID(), 'program_cat');
        $term_program = null;
        $term_this = null;
        foreach ($terms as $t) {
            if (get_field('code', $t)) {
                $term_program = $t;
            } else {
                $term_this = $t;
            }
        }
        if ($term_program === null && $term_this !== null) {
            $term_program = get_term_by('id', $term_this->parent, 'program_cat');
        }
        if ($term_program) {
            if (strpos('baseball', $term_program->slug) === false) {
                // 野球以外ならカテゴリ階層を入れる
                $term_category = get_term_by('id', $term_program->parent, 'program_cat');
                if ( preg_match( '/(korea|china)/', $term_category->slug ) ) {
                    // 韓国・中国ドラマならドラマ・映画のを先に入れる
                    $elements[] = get_json_ld_list_item( $index, "ドラマ・映画", home_url( "/program/drama/" ) );
                    $index++;
                }
                $elements[] = get_json_ld_list_item($index, $term_category->name, get_term_link($term_category));
                $index++;
            }
            $elements[] = get_json_ld_list_item($index, $term_program->name, get_term_link($term_program));
            $index++;
        }
        // echo get_the_title();
        if ( $term_this ) {
            $elements[] = get_json_ld_list_item( $index, $term_this->name, get_term_link( $term_this ) );
            $index++;
        }
        $elements[] = get_json_ld_list_item( $index, get_the_title(), get_permalink() );
    }

    if( count($elements) > 0 ) {
        $json_arr['itemListElement'] = $elements;
        echo '<script type="application/ld+json">' . "\n";
        echo json_encode( $json_arr );
        echo '</script>' . "\n";
    }
    // echo 'test';
}

add_action( 'wp_footer', 'bs12_footer_json_ld' );

/**
 * 番組トップ - 番組名のマークアップ json-ld作成
 */
function bs12_program_top_json_ld() {

    $json_arr = [];

    if( is_tax('program_cat') ) {

        $term_obj = get_queried_object() ;
        $code = get_field( 'code',  $term_obj );

        if ( ! empty( $code )  ) {
            // JSON-LDカスタムフィールドが入力されている場合、そちらを優先する。
            $json_ld = get_field('json_ld', $term_obj);
            if ($json_ld) {
                return;
            } else {

                $term_program = $term_obj;//番組カテゴリ取得

                //下層カテゴリ取得
                $categories = get_categories(array(
                    'child_of' => $term_program->term_id,
                    'taxonomy' => 'program_cat'
                ));

                if($categories){//下層カテゴリが存在していた場合
                    $json_arr = [
                        "@context" => "http://schema.org",
                        "@type" => "TVSeries",
                        "name" => $term_program->name,//％番組名
                        "sameAs" => $categories[0]->name,//％番組のアーカイブページなんでもいいとのことなので取得した１番目を出力
                        "url" => get_term_link( $term_program )//％番組ページ
                        ];
                }else{
                    $json_arr = [
                        "@context" => "http://schema.org",
                        "@type" => "TVSeries",
                        "name" => $term_program->name,//％番組名
                        "url" => get_term_link( $term_program )//％番組ページ
                    ];

                }
            }
        }
    }

    if( count($json_arr) > 0 ) {
        echo '<script type="application/ld+json">' . "\n";
        echo json_encode( $json_arr );
        echo '</script>' . "\n";
    }
    // echo 'bs12_program_top_json_ld';
}

add_action( 'wp_footer', 'bs12_program_top_json_ld' );

/**
 * json-ld用のリスト要素を返す
 * @param int $index TOPからの順番　TOPは1
 * @param string $title パンくずのタイトル
 * @param string $url パンくずのリンクurl
 */
function get_json_ld_list_item( $index, $title, $url ) {
    $item = [
        '@type' => "ListItem",
        "position" => $index,
        "item" => [
            "@id" => $url,
            "name" => $title
        ]
    ];
    return $item;
}

/**
 * トップページ用のjson-ldデータを返す
 */
function get_bs12_json_ld_home_data() {
    $r = [
        "@context" => "https://schema.org",
        "@type" => "Organization",
        "name" => "ワールド・ハイビジョン・チャンネル株式会社",
        "founder" => "",
        "foundingDate" => "2000-04-01",
        "description" => "",
        "url" => "https://www.twellv.co.jp/",
        "logo" => "",
        "telephone" => "+81-03-6451-1201",
        "faxNumber" => "+81-03-6451-1201",
        "address" => [
            "@type" => "PostalAddress",
            "addressLocality" => "渋谷区",
            "addressRegion" => "東京都",
            "postalCode" => "150-0001",
            "streetAddress" => "6-25-14",
            "addressCountry" => "JP"
        ],
        "contactPoint" =>[
            [ "@type" => "ContactPoint",
                "telephone" => "+81-03-5468-2122",
                "contactType" => "customer service"
            ]
        ],
        "sameAs" => [
            "https://twitter.com/BS12_TwellV",
            "https://www.facebook.com/bs12ch"]
    ];
    return $r;
}
/**
 * whatsnew single json_ld
 * 20220608 add yanagi
 * BS12_RENEWAL-335 【施策83】記事スキーママークアップの適用
 */
function bs12_whatsnew_single_json_ld()
{
    $terms = get_the_terms(get_the_ID(), 'news_cat');
    $t = $terms[0];
    $image = array(); 
    if (is_single() && $t->slug === 'whatsnew') {

        //投稿本文を取得
        $content = get_field('content_text');
		
        //本文内に入っている画像を全て抽出
        preg_match_all('/<img.*src\s*=\s*[\"|\'](.*?)[\"|\'].*>/i', $content, $img_path_list);

        if(isset($img_path_list[1])){
			foreach ($img_path_list[1] as $key => $value){
				$query_arr = parse_url ( $value );
				if(isset($query_arr['host'])){//ルート相対の場合、絶対パスにする。
					$image[] = $value;
				}else{
					$image[] = 'https://'. $_SERVER["HTTP_HOST"] .$value;
				}
			}
		}

        $json_arr = ["@context" => "http://schema.org",
            "@type" => "NewsArticle",
            "mainEntityOfPage" => [
                "@type" => "WebPage",
                "@id" => get_permalink()
            ],
            "headline" => get_the_title(),
            "image" => [
                $image
            ],
            "datePublished" => get_date_from_gmt(get_post_time('c', true), 'c'),
            "dateModified" => get_date_from_gmt(get_post_modified_time('c', true), 'c'),
            "author" => [
                "@type" => "Organization",
                "name" => "BS12",
                //"url"=> "http://example.com/profile/johndoe123"
            ],
            "publisher" => [
                "@type" => "Organization",
                "name" => "BS12",
                "logo" => [
                    "@type" => "ImageObject",
                    "url" => "https://www.twellv.co.jp/assets/common/img/ogp.jpg"
                ]
            ],
            "description" => get_field('meta_description'),
        ];

        if (count($json_arr) > 0) {
            echo '<script type="application/ld+json">' . "\n";
            echo json_encode($json_arr);
            echo '</script>' . "\n";
        }
        // echo 'bs12_program_top_json_ld';
    }
}
add_action('wp_footer', 'bs12_whatsnew_single_json_ld');