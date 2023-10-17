<?php

/**
 * 生活エンタ・BS12 知っ得を表示
 * 
 * add function 20200901 yanagi
 * BS12_RENEWAL-260 【タスク】「生活向上エンタテインメント」カテゴリ改修
 * BS12_RENEWAL-272 【タスク】「生活エンタ」配下「特選情報 資料請求」の字句修正
 * 
 */
$args = [
    'post_type' => 'info_materials',
    //'meta_key' => 'display_category',
    //'meta_value' => $slug
];
//var_dump( $args );
$the_query = new WP_Query($args);
if ($the_query->have_posts()) {
?>
    <section class="section-wrap entertainment-info">
        <h2 class="section-ttl">BS12 知っ得</h2>
        <div class="white-wrap">
            <div class="program-list-wrap of-v">
                <div class="program-list w245 type-C end">
                <?php
                while ($the_query->have_posts()) {
                    $the_query->the_post(); ?>
                    <?php while (have_rows('info_material_fd')) : the_row(); ?> 
                    <article class="item">
                        <a href="<?php the_sub_field('url'); ?>">
                            <figure>
                                <div class="img">
                                    <img src="<?php echo get_sub_field('img')['url']; ?>" alt="<?php the_title();?>">
                                </div>
                                <figcaption class="text-block">
                                    <div class="description">
                                        <?php the_sub_field('text'); ?>
                                    </div>
                                </figcaption>
                            </figure>
                        </a>
                    </article>
                    <?php endwhile;
                }
                wp_reset_postdata();
                ?>
                </div>
            </div>
        </div>
    </section>
<?php
}
