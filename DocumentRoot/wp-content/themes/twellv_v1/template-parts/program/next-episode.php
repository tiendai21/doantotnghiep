<?php
/*
 * There is a same block in one_program_block.php for block selecting inside admin cms. This template part was made for static next episode rendered under banner in new design.
 * */
/* 記事情報を1件表示（次回予告など） */
$program_term = get_the_terms(get_the_ID(), 'program_cat')[0];
$program_term_id = $program_term->term_id;
$parent_term_id = wp_get_term_taxonomy_parent_id($program_term_id, 'program_cat');
$parent_term_object = get_term($parent_term_id);

$previewURL = get_field('preview_button_url', $parent_term_object);
$hasLivePreview = get_field('show_preview_button', $parent_term_object);
$previewBanner = get_field('preview_banner', $parent_term_object);

$args['post_type'] = 'program';
$args['posts_per_page'] = 1;
$args['orderby'] = array('post_date' => 'DESC', 'ID' => 'DESC');
$args['tax_query'] = [
    [
        'taxonomy' => 'program_cat',
        'field' => 'term_id',
        'terms' => $program_term->term_id,
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
<div class="content">
    <?php
    $the_query = new WP_Query($args);
    while ($the_query->have_posts()) :
        $the_query->the_post();
        $movietag = get_field('next_program_movietag');
        ?>
        <div class="next-ep <?= $hasLivePreview ? 'live_preview' : null ?>">
            <span>次回予告</span>
            <div class="brand_left">
                <?php
                if ($movietag) {
                    echo $movietag;
                } else {
                    $img = get_field('thumbnail');
                    ?>
                    <a href="<?php the_permalink() ?>">
                        <div class="thumb">
                            <img class="util_pc" src="<?php echo $previewBanner ? $previewBanner : $img['url']; ?>" alt="<?php the_title(); ?>">
                            <img class="util_sp" src="<?php echo $previewBanner ? $previewBanner : $img['url']; ?>" alt="<?php the_title(); ?>">
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
                    <p class="util_pc"><?php echo get_field('overview'); ?></p>
                </div>
            </div>
            <p class="util_sp"><?php echo get_field('overview'); ?></p>
            <?php
            if ($hasLivePreview) : ?>
                <div class="brand_right">
                    <a href="<?php echo ($previewURL) ? $previewURL : get_the_permalink() ?>">
                   <span>
                        <h4>放送直前SP見逃し配信中！</h4>
                   </span>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    <?php endwhile;
    ?>
    <?php
    $archive_term = get_queried_object();
    $args = array(
        'post_type' => 'program',
        'post_status' => 'publish',
        'tax_query' => array(
            array(
                'taxonomy' => 'program_cat',
                'field' => 'id',
                'terms' => get_term_children($archive_term->term_id, 'program_cat')[0],
            ),
        ),
    );
    $the_query = new WP_Query($args);

    if ($the_query->have_posts()) : ?>

        <div class="broadcast_schedule util_pc">
            <a href="#episode">これまでの放送</a>
        </div>
        <div class="broadcast_schedule util_sp">
            <a href="#episode">これまでの放送</a>
        </div>
    <?php endif; ?>
</div>
