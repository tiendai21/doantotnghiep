<?php
/* テキストリンクリスト(テキスト+URL） */
if( get_sub_field( 'text_link_list' ) ) {
    ?>
    <ul class="txtlink-list">
        <?php
        while( the_repeater_field( 'text_link_list' ) ) {
            $link_text = get_sub_field('label_text');
            $link_url = get_sub_field('url');
            $target_blank = '';
            if (!empty($link_url)) {
                $target_blank = get_sub_field('target_blank') ? ' target="_blank" ' : '';
                $link_text = sprintf('<a href="%s" %s>%s</a>', $link_url, $target_blank, $link_text);
            }

            printf('<li>%s</li>', $link_text);
        }
        ?>
    </ul>
    <?php
}
