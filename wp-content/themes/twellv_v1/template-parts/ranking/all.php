<?php /* 総合アクセスランキング */ ?>
<div class="program_slide slide_ranking">
    <?php
    $args = [
        'post_type' => 'ranking',
        'meta_key' => 'display_category',
        'meta_value' => 'all'
    ];
    $the_query = new WP_Query( $args );
    while ( $the_query->have_posts() ) :
        $the_query->the_post();
        get_template_part( 'template-parts/ranking/rank_item' );
    endwhile;
    ?>
</div>