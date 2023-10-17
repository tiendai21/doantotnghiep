<?php
$label = get_sub_field( 'label' );
$url = get_sub_field( 'url' );
$target_blank = get_sub_field( 'target_blank' )  ? ' target="_blank" ' : '';
?>
<div class="btn-wrap w300">
    <p class="btn"><a href="<?php echo $url; ?>" <?php echo $target_blank; ?>><?php echo esc_attr( $label ); ?></a></p>
</div>

