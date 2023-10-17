<?php
/* ニュース関連 */
/*
 * サムネイル、またはタイトル部分のリンク領域をクリックすると、詳細ページに遷移する。
 * ①PDFがアップロードされた場合、PDFへ遷移させる。
 * ②URLが入力された場合、入力されたURLへリンクする。
 * ③　①、②以外の場合、記事ページに遷移する。
 */
function get_news__title_link_tag() {
    $title = get_the_title();
    $class_pdf = '';
    $pdf_url = get_field( 'pdf' );
    $link_url = get_permalink();
    if( $pdf_url ) {
        $link_url = $pdf_url['url'];
        $class_pdf = 'pdf';
    } else {
        $url = get_field( 'url' );
        if( $url ) {
            $link_url = $url;
        }
    }
    $target_blank = get_field( 'target_blank' ) ? ' target="_blank" ' : '';

    $tag = sprintf( '<a href="%s" class="%s" %s>%s</a>', $link_url, $class_pdf, $target_blank, $title );
    return $tag;
}

/**
 *  プレス情報リンクタグ
 *
 */
function get_press__title_link_tag() {
    $title = get_the_title();
    $up_file = get_field( 'upload_file' );
    $up_file_path = $up_file['url'];

    $class_pdf = '';
    $target_blank = '';
    if ( strpos( $up_file_path, '.pdf' ) !== false ) {
        $class_pdf = 'pdf';
        $target_blank = ' target="_blank" ';
    }

    return sprintf( '<a href="%s" class="%s" %s><span>%s</span></a>', $up_file_path, $class_pdf, $target_blank, $title );
}

/**
 * 新着タイトルを36で省略
 */
function get_whatsnew_title( $title ) {
    if( mb_strlen( $title ) > 35 ) {
        return mb_substr( $title, 0, 35 ) . '...';
    }
    return $title;
}




/**
 * ニュースカテゴリの選択を必須にする
 */
add_action( 'admin_head-post-new.php', 'mytheme_post_edit_required' ); // 新規投稿画面でフック
add_action( 'admin_head-post.php', 'mytheme_post_edit_required' ); // 投稿編集画面でフック
function mytheme_post_edit_required() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($){
            if( 'news' == $('#post_type').val()){

                $("#post").submit(function(e){

                    $("#taxonomy-news_cat").removeClass("error");
                    $("p.error").remove();

                    if($("#taxonomy-news_cat input:checked").length < 1 ) {
                        $('#taxonomy-news_cat').before('<p class="error">カテゴリを選択してください。</p>');
                        $('.spinner').hide();
                        $('#publish').removeClass('button-primary-disabled');
                        $('#taxonomy-news_cat').focus();
                        return false;
                    }
                });
            }
        });
    </script>
<?php
}
