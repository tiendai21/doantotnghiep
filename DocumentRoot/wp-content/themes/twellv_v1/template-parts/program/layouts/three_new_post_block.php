<?php
/* 記事情報を1件表示（次回予告など） */
// echo 'three_new_post_block';

if ( get_sub_field( 'display_switch' ) ) {
    // echo 'display_switch: on';
    $program_term_id = get_sub_field( 'target_post_category' );

    $args[ 'post_type'] = 'program';
    $args['posts_per_page'] = 3;
    // $args['orderby'] = 'post_date';
    // $args['order'] = 'DESC';
    $args['orderby'] = array('post_date'=>'DESC','ID'=>'DESC');
    $args['tax_query'] = [
      [
          'taxonomy' => 'program_cat',
          'field' => 'term_id',
          'terms' => $program_term_id
      ]
    ];
    // var_dump( $args );
    ?>
    <div class="program-list-wrap">
        <div class="program-list w320 type-B">
            <?php
            $the_query = new WP_Query( $args );
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                // echo get_the_time( 'Y.m.d' );
                $img = get_field( 'thumbnail');
                ?>
                <article class="item">
                    <a href="<?php echo get_permalink(); ?>">
                        <figure>
                            <div class="img"><img src="<?php echo $img['url']; ?>" alt="<?php the_title(); ?>のサムネイル"></div>
                            <figcaption class="text-block">
                                <div class="heading">
                                    <h3 class="program-title"><?php the_title(); ?></p>
                                    <p class="onair-date"><?php echo get_field( 'onairtime' ); ?></p>
                                </div>
                                <p class="description"><?php echo get_field( 'overview' ); ?></p>
                            </figcaption>
                        </figure>
                    </a>
                </article>
                <?php
            }
            wp_reset_postdata();
            ?>
        </div>
    </div>
<?php
}

