<?php
$h4_text = get_sub_field( 'h4_text' );
$text = get_sub_field( 'text' );
$button_label = get_sub_field( 'button_label');
$url = get_sub_field( 'url' );
$target_blank = get_sub_field( 'target_blank' ) ? ' target="blank" ' : '';
?>
<!-- 資料請求リンク -->
<div class="gray-box doc-request-link">
    <div class="heading">
        <h4 class="heading-title_lv3"><?php echo $h4_text; ?></h4>
        <p><?php echo $text; ?></p>
    </div>
    <div class="link">
        <p><a href="<?php echo $url; ?>" <?php echo $target_blank; ?> ><?php echo $button_label; ?></a></p>
    </div>
</div>
<!-- /資料請求リンク -->
