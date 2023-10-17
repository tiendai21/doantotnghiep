<?php
/*  画像テキストボックス */
if( get_sub_field( 'image_text_box_list' ) ) {
	$images_list = [];
	while( the_repeater_field( 'image_text_box_list' ) ){
		$item = [];
		$image = get_sub_field( 'image' );
		$item['image'] = $image['url'];
		$item['alt_text'] = get_sub_field( 'alt_text' );
		$item['text_area'] = get_sub_field( 'content_text' );
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
		<p class="img"><img src="<?php echo $item['image']; ?>" alt="<?php echo $item['alt_text']; ?>"></p>
		<figcaption><?php echo $item['text_area']; ?></figcaption>
	</figure>
	<?php
	}
	?>
</div>
<?php
}

