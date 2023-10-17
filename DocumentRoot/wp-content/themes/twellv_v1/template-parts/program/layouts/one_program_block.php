<?php
/* 記事情報を1件表示（次回予告など） */
if ( get_sub_field( 'display_switch' ) ) {
    $program_term_id = get_sub_field( 'target_program' );

    $args[ 'post_type'] = 'program';
    $args['posts_per_page'] = 1;
    $args['orderby'] = array('post_date'=>'DESC','ID'=>'DESC');
    $args['tax_query'] = [
      [
          'taxonomy' => 'program_cat',
          'field' => 'term_id',
          'terms' => $program_term_id
      ]
    ];
    $args['meta_query'] = [
      [
          'key'   => 'display_next_program',
          'value' => '1',
          'compare' => '=',
      ]
    ];
    ?>
	<div class="sneak-preview">
        <?php
        $the_query = new WP_Query( $args );
        while ( $the_query->have_posts() ) {
            $the_query->the_post();
        ?>
		<figure>
			<div class="image">
				<?php
        $movietag = get_field('next_program_movietag');
        if ($movietag) {
            echo $movietag;
        } else {
            $img = get_field('thumbnail');
            ?>
			<img src="<?php echo $img['url']; ?>" alt="<?php the_title(); ?>">
			<?php }?>
			</div>
			<figcaption>
				<div class="heading">
                    <p class="date"><?php echo get_field( 'onairtime' ); ?>
                        <?php if( get_field( 'rebroadcast' ) ) { ?>
                            <span class="reair">再</span>
                        <?php } ?>
                    </p>
					<h3 class="title"><?php the_title(); ?></h3>
					<p class="description"><?php echo get_field( 'overview' ); ?></p>
				</div>
				<div class="link btn-wrap w300">
					<p class="btn"><a href="<?php the_permalink(); ?>">放送内容詳細はこちら</a></p>
				</div>
			</figcaption>
		</figure>
        <?php }
        wp_reset_postdata();
        ?>
	</div>
<?php
}
