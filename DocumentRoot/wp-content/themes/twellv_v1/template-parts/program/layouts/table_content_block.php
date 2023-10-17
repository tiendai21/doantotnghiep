<?php
/* テーブル(WYSIWYG) */
$content = get_sub_field( 'table_content_text' );
// tableのstyle=,class=,width=を削除
$content = preg_replace('/<table ("[^"]*"|\'[^\']*\'|[^\'">])*>/', '<table>', $content);
echo add_tag_custom_class( $content );

