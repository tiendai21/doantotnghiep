<?php
/* BS12 重要なお知らせ 20200304 add yanagi*/
$args = [
    'post_type' => 'important_notices',
    'posts_per_page' => -1
];
$the_query = new WP_Query($args);
if ($the_query->have_posts()) {
?>
    <section class="emergency">
        <div class="emergency-wrap">
            <?php
            while ($the_query->have_posts()) {
                $the_query->the_post();
            ?>
                <div class="notice_top">
                    <a href="">
                        <span>無料で見られる！BS12の視聴方法</span>
                    </a>
                </div>
                <div class="standard-announce">
                    <p class="date">【<?php the_time('Y年n月j日'); ?>】</p>
                    <?php echo get_field('notice_text'); ?>
                </div>
            <?php
            }
            ?>
        </div>
    </section>
    <!-- /BS12 重要なお知らせ -->
<?php
}
wp_reset_postdata();
