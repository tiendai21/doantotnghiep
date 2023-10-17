<?php /* ドラマ・映画アクセスランキング */ ?>
<div class="program-mini-list ranking">
    <?php
    $category_slug = 'dorama';
    $args = [
        'post_type' => 'ranking',
        'meta_key' => 'display_category',
        'meta_value' => $category_slug
    ];
    $the_query = new WP_Query( $args );
    while ( $the_query->have_posts() ) : $the_query->the_post();
        get_template_part( 'template-parts/ranking/rank_item' );
    endwhile;
    ?>
</div>
