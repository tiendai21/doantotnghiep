<?php
/* 記事情報を直近3件表示(放送日を使用) */
// echo 'three_new_post_block';

if ( get_sub_field( 'display_switch' ) ) {
    // echo 'display_switch: on';
    $program_term_id = get_sub_field( 'target_post_category' );

    $args[ 'post_type'] = 'program';
    $args['posts_per_page'] = 3;
    
    $args['order'] = 'ASC';
    $args['orderby'] = 'meta_value';
    $args['meta_key'] = 'onairdate';

    $args['tax_query'] = [
      [
          'taxonomy' => 'program_cat',
          'field' => 'term_id',
          'terms' => $program_term_id
      ]
    ];

    $args['meta_query'] = array(
        array(
            'key' => 'onairdate',
            'value' => date_i18n("Ymd"), 
            'compare' => '>', //値と一致する
            'type' => 'NUMERIC'
        ),
    );
    ?>
    <div class="program-list-wrap">
        <div class="program-list w320 type-B">
            <?php
            $the_query = new WP_Query( $args );
    		//var_dump($the_query);
            //初期値を設定
            //$i = 0;
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                //if($i == 0){$i++; continue;}
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
                //$i++;
            }
            wp_reset_postdata();
            ?>
        </div>
    </div>
<?php
}