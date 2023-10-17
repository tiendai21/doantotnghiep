<?php
if( get_sub_field( 'news_list' ) ) {
    $news_list = [];
    while( the_repeater_field( 'news_list' ) ) {
        $news_item = [];
        // $news_item['news_text'] = get_sub_field( 'news_text' );
        $news_item['news_date'] = get_sub_field( 'news_date' );
        $news_text = get_sub_field( 'news_text' );
        $url = get_sub_field( 'news_url' );
        if ( $url ) {
            $target_blank = get_sub_field( 'target_blank' ) ? ' target="blank" ' : '';
            $news_text = sprintf( '<a href="%s" %s>%s</a>', $url, $target_blank, $news_text );
        }
        $news_item['news_text'] = $news_text;
        $news_list[] = $news_item;
    }
    rsort( $news_list );

    ?>
    <!-- 日付つきリスト -->
    <div class="list-wrap line-list date-list more-list">
        <div class="more-wrap">
            <ul>
                <?php
                foreach ( $news_list as $item ) {
                    ?>
                    <li>
                        <dl>
                            <dt><?php echo $item['news_date']; ?></dt>
                            <dd><?php echo $item['news_text']; ?></dd>
                        </dl>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
    <!-- 日付つきリスト -->
    <?php
}
