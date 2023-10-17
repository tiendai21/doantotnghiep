<?php
//BS12_RENEWAL-316 新規コンポーネント作成（テキスト回り込み）
//20211116 add yanagi
$img_class =  'img-L';
if( (int)get_sub_field( 'layout_switch') === 1 ) {
    // 左テキスト右画像
    $img_class = 'img-R';
}
$image = get_sub_field( 'image' );
?>
<div class="imgtxt-box float <?php echo $img_class; ?>">
    <p class="img"><img src="<?php echo $image['url']; ?>" alt="<?php echo get_sub_field( 'alt_text'); ?>"></p>
    <div class="description">
        <h4 class="heading-title_lv3"><?php echo get_sub_field( 'h4_text'); ?></h4>
        <div class="txt-block">
            <?php echo get_sub_field( 'content_text' ); ?>
        </div>
    </div>
</div>
