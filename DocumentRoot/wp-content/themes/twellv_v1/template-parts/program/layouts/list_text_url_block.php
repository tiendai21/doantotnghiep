<?php 
/* リスト表記(テキスト+URL) */
if( get_sub_field( 'list_text_url_list' ) ):
 ?>
	<ul class="list">
	<?php 
	while( the_repeater_field( 'list_text_url_list' ) ){
		$link_text = get_sub_field( 'link_text' );
		$link_url = get_sub_field( 'link_url' );
		$target_blank = '';
		if ( ! empty( $link_url ) ) {
			$target_blank = get_sub_field( 'target_blank' )  ? ' target="_blank" ' : '';
			$link_text = sprintf('<a href="%s" %s>%s</a>', $link_url, $target_blank, $link_text );
		}
		
		printf( '<li>%s</li>', $link_text );
	}
	?>
	</ul>
<?php endif; ?>
