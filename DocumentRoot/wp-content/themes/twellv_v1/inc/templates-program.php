<?php /* -*- mode: web; -*- */

/**
 * 番組カテゴリのslugとidのリストを返す
 */
function get_program_cat_base_items()
{
    $terms = get_terms('program_cat', ['parent' => 0, 'hide_empty' => 0]);
    // var_dump( $terms );
    $result = [];
    foreach ($terms as $t) {
        $result[$t->slug] = $t->term_id;
    }
    return $result;
}
// var_dump( get_program_cat_base_items() );

/**
 * 一覧表示の時の各番組情報
 */
function tpl_program_list_item($t)
{
?>
    <div class="item_slide">
        <a href="<?php echo get_term_link($t); ?>">
            <?php echo get_program_thumbnail($t, 'item'); ?>
            <div class="content_dramas">
                <h2><?php echo esc_attr($t->name); ?></h2>
                <span><?php echo get_field('pg_text', $t); ?></span>
                <p><?php echo get_field('onairtime', $t); ?></p>
            </div>
        </a>
    </div>
    <?php
}
function tpl_program_list_item_pre($t)
{
    ?>
    <div class="item_slide">
        <a href="<?php echo get_term_link($t); ?>">
            <?php echo get_program_thumbnail($t, 'item'); ?>
        </a>
    </div>
    <?php
}
/**
 * 番組画像
 * @param $term term object
 * @param $size
 */
function get_program_thumbnail($term, $size)
{
    $img_tag = '';
    switch ($size) {
        case 'top':
            $img_tag = get_acf_img_tag('main_visual_vod', $term, $term->name . 'のメインビジュアル');
            break;
        case 'item':
            $img_tag = get_acf_img_tag('list_thumb', $term, $term->name . 'のサムネイル');
            break;
    }
    return $img_tag;
}

// エディターのhtmlタグに独自のクラス付与
function add_tag_custom_class($content)
{
    $table = array(
        '<h1>' => '<h1 class="heading-title_lv1">',
        '<h2>' => '<h2 class="heading-title_lv1">',
        '<h3>' => '<h3 class="heading-title_lv2">',
        '<h4>' => '<h4 class="heading-title_lv3">',
        '<h5>' => '<h5 class="heading-title_lv4">',
        // '<p>' => '<div class="text-wrap"><p>',
        // '</p>' => '</p></div>',
        '<table>' => '<div class="table-contents"><div class="table-wrap"><table>',
        '</table>' => '</table></div></div>',
        '<ul>' => '<ul class="list">'
    );
    $search = array_keys($table);
    $replace = array_values($table);
    return str_replace($search, $replace, $content);
}

/**
 * 番組情報の背景処理。
 * @param WP_Term $term 番組情報
 * @return bg_style_type : class, bg_style_str : styleに入れる文字列
 */
function get_program_bg_style($term)
{
    /*
     * 表示処理は下記の通り。
     * ①I-11-2.番組ページ背景用画像に入力があった場合に、背景画像を設定する。
     * ②I-11-2.番組ページ背景用画像が未入力の場合にI-11-3.番組背景グラデーションを設定する。
     * ③両方未入力の場合は設定しない（デフォルトの背景がでる）
     */
    $bg_style_type = 'type-a';
    // $bg_style_str = "background-image: url('/wp-content/uploads/program_body_bg.jpg');";
    $bg_style_str = "";
    $bg_image_data = get_field('bg_visual', $term);
    if ($bg_image_data) {
        $bg_style_str = sprintf("background-image: url('%s')",  $bg_image_data['url']);
    } else {
        $bg_color = get_field('bg_color', $term);
        if ($bg_color) {
            $bg_style_type = 'type-b';
            $bg_color_hex = str_replace('#', '', $bg_color);
            $rgba_str = sprintf(
                '%d,%d,%d',
                hexdec(substr($bg_color_hex, 0, 2)),
                hexdec(substr($bg_color_hex, 2, 2)),
                hexdec(substr($bg_color_hex, 4, 2))
            );
            $bg_style_str = "background: linear-gradient(to bottom, rgba($rgba_str,1) 0%,rgba($rgba_str,1) 70%,rgba($rgba_str,0) 100%);";
        }
    }
    $result['bg_style_type'] = $bg_style_type;
    $result['bg_style_str'] = $bg_style_str;

    return $result;
}

/**
 * 指定されたカテゴリのランキングを表示
 * @param $slug string 番組カテゴリーのスラッグ
 */
global $_ranking_display_cat;

function display_program_ranking_by_category_slug($slug)
{
    $args = [
        'post_type' => 'ranking',
        'meta_key' => 'display_category',
        'meta_value' => $slug
    ];

    global $_ranking_cat_display;

    $_ranking_cat_display = $slug;

    // var_dump( $_ranking_cat_display );
    $the_query = new WP_Query($args);
    if ($the_query->have_posts()) { ?>
        <div class="program_slide slide_ranking">
            <?php
            while ($the_query->have_posts()) : $the_query->the_post();
                get_template_part('template-parts/ranking/rank_item');
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
    <?php
    }
}

/**
 * 指定されたカテゴリのお勧めを表示
 *  1.①～③全て条件を満たした番組を登録日が新しい順に降順で表示する。
 *　① 親カテゴリに当該カテゴリが選択されている。
 *  ② I-9-2.カテゴリおすすめ番組に表示する項目にチェックが付いている。
 *  ③ I-5.放送ステータスが「放送予定」、または、「放送中」である。
 * 
 * 親番組カテゴリ以外のアーカイブに表示する
 * 1.①～③全て条件を満たした番組を登録日が新しい順に降順で表示する。
 *  ①親番組カテゴリ以外のアーカイブに表示する、に当該カテゴリが選択されている
 *  ② I-9-2.カテゴリおすすめ番組に表示する項目にチェックが付いている。
 *  ③ I-5.放送ステータスが「放送予定」、または、「放送中」である。
 * 
 * マージは　親番組カテゴリーに当該カテゴリを指定した番組（登録日降順）＞親番組カテゴリ以外のアーカイブに表示する項目に当該カテゴリを指定した場合（登録日降順）
 */
function display_program_recommend_by_category_slug($slug)
{
    $category_term = get_term_by('slug', $slug, 'program_cat');

    $args = [
        'taxonomy' => 'program_cat',
        // 'hide_empty' => false,
        'parent' => $category_term->term_id,
        'meta_query' => [
            'relation' => 'AND',
            [
                'key' => 'onair',
                'value' => [1, 2], // 放送予定か放送中
                'compare' => 'IN'
            ],
            [
                'key' => 'recommend_cat', // おすすめカテゴリ
                'value' => true,
                'compare' => '='
            ],
        ]
    ];

    $term_query = new WP_Term_Query($args);
    if (!empty($term_query) && !is_wp_error($term_query)) {
        $term_arr = [];
        foreach ($term_query->get_terms() as $t) {
            $term_arr[] = $t;
        }
        usort($term_arr, 'program_sort_by_term_order');
    }


    $args_others = [
        'taxonomy' => 'program_cat',
        // 'hide_empty' => false,
        'meta_query' => [
            'relation' => 'AND',
            [
                'key' => 'onair',
                'value' => [1, 2], // 放送予定か放送中
                'compare' => 'IN'
            ],
            [
                'key' => 'recommend_cat', // おすすめカテゴリ
                'value' => true,
                'compare' => '='
            ],
        ]
    ];

    $term_query_others = new WP_Term_Query($args_others);
    if (!empty($term_query_others) && !is_wp_error($term_query_others)) {
        $term_arr_others = [];
        foreach ($term_query_others->get_terms() as $t) {
            if ($category_term->term_id !== $t->parent && is_display_program_archive($t, $category_term->term_id)) {
                $term_arr_others[] = $t;
            }
        }
        usort($term_arr_others, 'program_sort_by_term_order');
    }

    $term_arr = array_merge($term_arr, $term_arr_others);
    if (!empty($term_arr)) {
        /*<?php echo $category_term->name; ?>*/
    ?>
        <section class="recommended_movies">
            <div class="inner">
                <div class="tlt_section">
                    <h2>おすすめ韓国・韓流ドラマ</h2>
                    <div class="btn_more">
                        <span>すべて見る</span>
                    </div>
                </div>
                <div class="program_slide side_brand">
                    <?php foreach ($term_arr as $term) {
                        $archive_modal = "";
                        ob_start();
                        get_template_part('template-parts/home/modal_category_item', null, array('term' => $t));
                        $archive_modal .= ob_get_contents();
                        ob_end_clean();
                        ?>
                        <div class="item_slide">
                            <a href="<?php echo get_term_link($term); ?>">
                                <?php echo get_acf_img_tag('list_thumb', $term, $term->name . 'のサムネイル'); ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
                <?php get_template_part('template-parts/home/modal_category', null, array('title' => 'おすすめ韓国・韓流ドラマ', 'modal' => $archive_modal)); ?>
            </div>
        </section>
    <?php
    }
}

/**
 * 指定した番組のナビゲーションを表示する
 * @param $term WP_Term 対象番組のオブジェクト
 */
function display_program_navi($term)
{
    // navigationを検索
    $args = [
        'post_type' => 'program',
        'posts_per_page' => -1,
        'tax_query' => [
            [
                'taxonomy' => 'program_cat',
                'field' => 'slug',
                'terms' => $term->slug
            ]
        ]
    ];
    $nav_id = 0;
    $the_query = new WP_Query($args);
    if ($the_query->have_posts()) {
        while ($the_query->have_posts()) {
            $the_query->the_post();
            if (get_post_format(get_the_ID()) === 'image') {
                $nav_id = get_the_ID();
            }
        }
        wp_reset_postdata();
    }
    if ($nav_id > 0 &&  have_rows('navs', $nav_id)) {
    ?>
        <nav class="program-navi">
            <ul>
                <?php
                while (have_rows('navs', $nav_id)) {
                    the_row();
                    $ttl = get_sub_field('ttl');
                    $link = get_sub_field('link');
                    $target_blank = get_sub_field('target_blank') ? ' target="_blank" ' : '';
                ?>
                    <li><a href="<?php echo esc_url($link); ?>" class="" <?php echo $target_blank; ?>><?php echo esc_attr($ttl); ?></a></li>
                <?php
                }
                ?>
            </ul>
        </nav>
    <?php
    }
}

/**
 * どの階層にいても番組カテゴリのterm情報を取る
 */
function parent_program_term_object()
{
    $terms = get_the_terms(get_the_ID(), 'program_cat');
    $program_term = null;
    $this_term = $terms[0];
    foreach ($terms as $t) {
        $code = get_field('code', $t);
        if ((int) $code >  0) {
            $program_term = $t;
        } else {
            $this_term = $t;
        }
    }
    if ($program_term === null) {
        $parent_term = get_term_by('id', $this_term->parent, 'program_cat');
        if (get_field('code', $parent_term) > 0) {
            $program_term = $parent_term;
        }
    }
    return $program_term;
}

/**
 * 番組アーカイブに表示するかを判定
 * @param WP_Term $term 判定対象番組のtermオブジェクト
 * @param int $category_id 親カテゴリid
 */
function is_display_program_archive($term, $category_id)
{
    if ($term->parent === $category_id) {
        return true;
    }
    $view_other = get_field('view_other', $term);
    if (!empty($view_other) && is_array($view_other) && in_array($category_id, $view_other, true)) {
        return true;
    }
    return false;
}

/**
 * 番組ソート用 比較関数
 * @param WP_Term $a
 * @param WP_Term  $b
 * @return int
 */
function program_sort_by_term_order($a, $b)
{
    $a_display_date = strtotime(get_field('display_date', $a));
    $b_display_date = strtotime(get_field('display_date', $b));
    if ($a_display_date === $b_display_date) {
        return 0;
    }
    return $a_display_date > $b_display_date ? -1 : 1;
}


/**
 * 番組新規作成時に条件に基づいてスラッグ名を変更する
 * 番組管理、かつ、記事属性、かつ、日本語のタイトルの場合、先頭pの記事idの0詰め10桁をセットさせる処理を入れる
 * 番組管理、かつ、記事属性、かつ、スラッグが数字のみの場合、先頭に"p"を付与する
 * 番組管理、かつ、固定ページ属性、かつ、日本語のタイトルの場合、先頭"page-"の記事idの0詰め10桁をセットさせる処理を入れる
 * 番組管理、かつ、固定ページ属性、かつ、先頭に"page-"が付与されていない場合、先頭に"page-"を付与する
 */
function slug_save_post_callback($post_ID, $post, $update)
{
    // slugの自動書き換えを行いたいpost_type
    $types = array(
        'program' // カスタム投稿名
    );
    // 'publish', 'draft', 'future' の時だけ実行
    if (!in_array($post->post_type, $types) || $post->post_status == 'auto-draft')
        return;

    // 新規作成以外ならslugを書き換えない
    if ($post->post_date_gmt != $post->post_modified_gmt)
        return;

    // 記事フォーマット（記事の属性）
    $post_format = get_post_format();
    // slugのフォーマット
    $digit = 10; //桁数
    $format = '%0' . $digit . 'd';
    if ($post_format == 'chat') {
        // 固定ページフォーマット
        if (preg_match('/(%[0-9a-f]{2})+/', $post->post_name)) {
            // 日本語の場合
            $new_slug = "page-" . sprintf($format, $post_ID); //page-+0詰め10桁id
        } elseif (!preg_match('/page-/', $post->post_name)) {
            // page-が含まれていない場合
            $new_slug = "page-" . $post->post_name; //page-+元のスラッグ
        }
    } elseif ($post_format == 'gallery') {
        // 記事フォーマット
        if (preg_match('/(%[0-9a-f]{2})+/', $post->post_name)) {
            // 日本語の場合
            $new_slug = "p" . sprintf($format, $post_ID); //p+0詰め10桁id
        } elseif (preg_match('/^[0-9]+$/', $post->post_name)) {
            // 数字のみの場合
            $new_slug = "p" . $post->post_name; //p+元のスラッグ
        }
    }

    if ($new_slug == $post->post_name)
        return; // already set

    // unhook this function to prevent infinite looping
    remove_action('save_post', 'slug_save_post_callback', 10, 3);
    // update the post slug (WP handles unique post slug)
    wp_update_post(array(
        'ID' => $post_ID,
        'post_name' => $new_slug
    ));
    // re-hook this function
    add_action('save_post', 'slug_save_post_callback', 10, 3);
}
add_action('save_post', 'slug_save_post_callback', 10, 3);

/**
 * add function 20190808 yanagi
 * ページネーション出力関数
 * $paged : 現在のページ
 * $pages : 全ページ数
 * $range : 左右に何ページ表示するか
 * $show_only : 1ページしかない時に表示するかどうか
 */
function pagination($pages, $paged, $range = 2, $show_only = false)
{

    $pages = (int) $pages;    //float型で渡ってくるので明示的に int型 へ
    $paged = $paged ?: 1;       //get_query_var('paged')をそのまま投げても大丈夫なように

    //表示テキスト
    //$text_first   = "« 最初へ";
    $text_before  = "前へ";
    $text_next    = "次へ";
    //$text_last    = "最後へ »";

    if ($show_only && $pages === 1) {
        // １ページのみで表示設定が true の時
        echo '<div class="pagenation"><div class="wrap"><ol><li class="active"><span>1</span></li></ol></div></div>';
        return;
    }

    if ($pages === 1) return;    // １ページのみで表示設定もない場合

    if (1 !== $pages) {
        //２ページ以上の時
        echo '<div class="pagenation"><div class="wrap">';
        //if ( $paged > $range + 1 ) {
        // 「最初へ」 の表示
        //    echo '<a href="', get_pagenum_link(1) ,'" class="first">', $text_first ,'</a>';
        //}
        if ($paged > 1) {
            // 「前へ」 の表示
            echo '<p class="pn prev"><a href="', get_pagenum_link($paged - 1), '">', $text_before, '</a></p>';
            //echo '<a href="', get_pagenum_link( $paged - 1 ) ,'" class="prev">', $text_before ,'</a>';
        }
        echo "<ol>";
        for ($i = 1; $i <= $pages; $i++) {

            if ($i <= $paged + $range && $i >= $paged - $range) {
                // $paged +- $range 以内であればページ番号を出力
                if ($paged === $i) {
                    echo '<li class="active"><span>', $i, '</span></li>';
                } else {
                    echo '<li><a href="', get_pagenum_link($i), '">', $i, '</a></li>';
                }
            }
        }
        echo "</ol>";
        if ($paged < $pages) {
            // 「次へ」 の表示
            echo '<p class="pn next"><a href="', get_pagenum_link($paged + 1), '">', $text_next, '</a></p>';
        }
        //if ( $paged + $range < $pages ) {
        // 「最後へ」 の表示
        //    echo '<a href="', get_pagenum_link( $pages ) ,'" class="last">', $text_last ,'</a>';
        //}
        echo '</div></div>';
    }
}

/**
 * add function 20191107 ishizaki
 * 【SEO施策】フッター近辺にテキスト（カテゴリ名）挿入
 */
function get_term_category_link()
{
    if (is_tax('program_cat')) {
        $queried_obj = get_queried_object();
        if ($queried_obj->parent !== 0) {
            $program_term = parent_program_term_object();
        } else {
            return;
        }
    }
    if (is_singular('program')) {
        $program_term = parent_program_term_object();
    }
    $category_term  = get_term_by('id', $program_term->parent, 'program_cat');
    //var_dump($category_term );
    if($category_term != false){
    ?>
    <a href="<?php echo get_term_link($category_term); ?>" class="backToList"><?php echo $category_term->name . "一覧へ戻る" ?></a>
    <?php
    }
}

/**
 * 指定されたカテゴリのお客様の声を表示
 * @param $slug string 番組カテゴリーのスラッグ
 * 
 * add function 20200306 yanagi
 * BS12_RENEWAL-202 【施策ID：39-1】お客様の声コンテンツ作成
 * 
 */
function display_program_voice_by_category_slug($slug)
{
    $args = [
        'post_type' => 'voice',
        'meta_key' => 'display_category',
        'meta_value' => $slug
    ];

    //var_dump( $args );
    $the_query = new WP_Query($args);
    if ($the_query->have_posts()) {
    ?>
        <section class="section" id="customer_voice">
            <div class="inner">
                <div class="tlt_section">
                    <h2>お客様の声</h2>
                    <div class="btn_more">
                        <a href="<?php echo esc_url(home_url('/faq'))?>">
                            <span>すべて見る</span>
                        </a>
                    </div>
                </div>
                <div class="program_slide voice_list">
                    <?php
                    while ($the_query->have_posts()) {
                        $the_query->the_post(); ?>
                        <?php while (have_rows('customer_voice')) :
                            the_row(); ?>
                            <div class="item_slide">
                                <a href="#">
                                    <span class="date"><?php the_sub_field('updateday'); ?></span>
                                    <h4><?php the_sub_field('program_name'); ?></h4>
                                    <p><?php the_sub_field('voice'); ?></p>
                                    <span class="note"><?php the_sub_field('age'); ?></span>
                                </a>
                            </div>
                        <?php endwhile;
                    }
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </section>
    <?php
    }
}
/**
 * add function 20200317 yanagi
 * BS12_RENEWAL-212 【施策ID：47-1】韓国ドラマ > 放送終了番組の統合
 * 
 * 一覧アコーディオン表示の時の各番組情報
 */
function tpl_program_list_accordion_item($t)
{
    $img = get_field('list_thumb', $t);
    ?>
    <article class="item">
        <a href="<?php echo get_term_link($t); ?>">
            <figure>
                <div class="img"><span class="imgalt" data-src="<?php echo $img['url']; ?>"></span></div>
                <figcaption class="text-block">
                    <div class="heading">
                        <h3 class="program-title"><?php echo esc_attr($t->name); ?></h3>
                            <p class="onair-date"><?php echo get_field('onairtime', $t); ?></p>
                    </div>
                    <p class="description"><?php echo get_field('pg_text', $t); ?></p>
                </figcaption>
            </figure>
        </a>
    </article>
    <?php
}
/**
 * 指定されたカテゴリのお客様の声を表示
 * @param $slug string 対象番組のtermオブジェクト
 * 
 *  1.①かつ②の条件の番組選択順に表示する。
 *  ① こちらもおすすめに表示する項目にチェックが付いている番組。
 *  ② 放送ステータスが「放送予定」、または、「放送中」である。
 * 
 * add function 20201016 yanagi
 * BS12_RENEWAL-269 【タスク】レイアウト変更ならびにWP機能追加
 * 
 */
function display_program_recommend_often_watch_by_category_slug($t)
{
    if (get_field('recommend_often_watch', $t)) {
        $recommend_often_watch = get_field('recommend_often_watch', $t);
        foreach ($recommend_often_watch as $v) {
            $term = get_term_by('id', $v, 'program_cat');
            $program_term_ids[] = $v;
        }
        $args = [
            'taxonomy' => 'program_cat',
            'include' => $program_term_ids,
            // 'hide_empty' => false,
            'meta_query' => [
                // 'relation' => 'AND',
                [
                    'key' => 'onair',
                    'value' => [1, 2], //「放送予定」、または、「放送中」
                    'compare' => 'IN'
                ],
            ]
        ];

        $term_query = new WP_Term_Query($args);

        //var_dump($term_query);
        if (!empty($term_query) && !is_wp_error($term_query)) {
            $term_arr = [];
            foreach ($term_query->get_terms() as $t) {
                $term_arr[] = $t;
            }
    ?>
            <section class="section-wrap">
                <div class="program-list-wrap">
                    <h2 class="section-ttl">こちらもおすすめ</h2>
                    <div class="program-list w320 type-A slider">
                        <?php foreach ($term_arr as $term) { ?>
                            <article class="item">
                                <a href="<?php echo get_term_link($term); ?>">
                                    <figure>
                                        <div class="img"><?php echo get_acf_img_tag('list_thumb', $term, $term->name . 'のサムネイル'); ?></div>
                                        <figcaption class="text-block">
                                            <div class="heading">
                                                <p class="category"><?php echo get_term($term->parent, 'program_cat')->name; ?></p>
                                                <h3 class="program-title"><?php echo $term->name; ?></h3>
                                                    <p class="onair-date"><?php echo get_field('airtime', $term); ?></p>
                                            </div>
                                            <p class="description"><?php echo get_field('pg_text', $term); ?></p>
                                        </figcaption>
                                    </figure>
                                </a>
                            </article>
                        <?php } ?>
                    </div>
                </div>
            </section>
            <!-- /こちらもおすすめ -->
<?php
        }
    }
}
?>