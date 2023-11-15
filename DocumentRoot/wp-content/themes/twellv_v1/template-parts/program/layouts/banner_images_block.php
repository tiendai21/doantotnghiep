<?php /* バナー画像（画像+URL）*/
if( get_sub_field( 'banner_images_list' ) ) {
    $images_list = [];
    while( the_repeater_field( 'banner_images_list' ) ){
        $item = [];
        $image = get_sub_field( 'image' );
        $item['image'] = $image['url'];
        $item['alt_text'] = get_sub_field( 'alt_text' );
        $item['text_area'] = get_sub_field( 'text_area_text' );
        $item['img_tag'] = sprintf( '<img src="%s" alt="%s" >', $item['image'], $item['alt_text'] );

        // urlが指定されていた場合リンクを張る
        $item['url'] = get_sub_field( 'url' );
        if ( ! empty( $item['url']  )  && $item['url'] !== '' ) {
            $target_blank = get_sub_field('target_blank') ? ' target="_blank" ' : '';
            $item['img_tag'] = sprintf( '<a href="%s" %s>%s</a>', $item['url'], $target_blank, $item['img_tag'] );
        }
        $images_list[] = $item;
    }
    $col_class = '';
    if ( count( $images_list ) > 1 ) {
        $col_class = 'col-' . count( $images_list );
    }
    ?>
    <div class="imglist <?php echo $col_class; ?>">
        <?php
        foreach( $images_list as $item ) {
            ?>
            <figure>
                <p class="img"><?php echo $item['img_tag']; ?></p>
                <figcaption><?php echo $item['text_area']; ?></figcaption>
            </figure>
            <?php
        }
        ?>
    </div>
    <?php
}