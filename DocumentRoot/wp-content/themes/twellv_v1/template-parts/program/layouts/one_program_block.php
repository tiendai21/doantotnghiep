<?php
/* 記事情報を1件表示（次回予告など） */
var_dump(get_the_ID());
if (get_sub_field('display_switch')) :
    $program_term_id = get_sub_field('target_program');

    $parent_term_id = wp_get_term_taxonomy_parent_id($program_term_id, 'program_cat');
    $hasLivePreview = get_field('has_special_live_preview', get_term($parent_term_id));
    $args['post_type'] = 'program';
    $args['posts_per_page'] = 1;
    $args['orderby'] = array('post_date' => 'DESC', 'ID' => 'DESC');
    $args['tax_query'] = [
        [
            'taxonomy' => 'program_cat',
            'field' => 'term_id',
            'terms' => $program_term_id
        ]
    ];
    $args['meta_query'] = [
        [
            'key' => 'display_next_program',
            'value' => '1',
            'compare' => '=',
        ]
    ];
    ?>
    <?php
    $the_query = new WP_Query($args);
    while ($the_query->have_posts()) :
        $the_query->the_post();
        $movietag = get_field('next_program_movietag');
        ?>
        <div class="one_program_block next-ep <?= $hasLivePreview ? 'live_preview' : null?>">
            <div class="brand_left">
                <?php
                if ($movietag) {
                    echo $movietag;
                } else {
                    $img = get_field('thumbnail');
                    ?>
                    <a href="<?php the_permalink() ?>">
                        <div class="thumb">
                            <img class="util_pc" src="<?php echo $img['url']; ?>" alt="<?php the_title(); ?>">
                            <img class="util_sp" src="<?php echo $img['url']; ?>" alt="<?php the_title(); ?>">
                        </div>
                    </a>
                <?php } ?>
                <div class="txt_desp">
                    <a href="<?php the_permalink() ?>">
                        <h2><?php the_title(); ?></h2>
                    </a>
                    <p><?php echo get_field('onairtime'); ?>
                        <?php if (get_field('rebroadcast')) : ?>
                            <span class="reair">再</span>
                        <?php endif; ?></p>
                    <p><?php echo get_field('overview'); ?></p>
                </div>
            </div>
            <p class="util_sp"><?php echo get_field('overview'); ?></p>
            <?php
            if ($hasLivePreview) : ?>
            <div class="brand_right">
                <a href="<?php the_permalink() ?>">
                   <span>
                        <h4>放送直前SP見逃し配信中！</h4>
                   </span>
                </a>
            </div>
            <?php endif;?>
        </div>
    <?php endwhile;
endif;
?>
