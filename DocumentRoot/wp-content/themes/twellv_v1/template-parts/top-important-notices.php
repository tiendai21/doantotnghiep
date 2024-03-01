<?php 
/* BS12 重要なお知らせ 20200304 add yanagi*/
$args = [
    'post_type' => 'important_notices',
    'posts_per_page' => -1
];
$the_query = new WP_Query($args);
if ($the_query->have_posts()) {
?>
    <div id="emergency">
            <?php
            while ($the_query->have_posts()) {
                $the_query->the_post();
            ?>
                <div class="emergency-notice">
                    <span><?php echo get_field('notice_text'); ?></span>
                </div>
            <?php
            }
            ?>
    </div>
    <!-- /BS12 重要なお知らせ -->
<?php
}
wp_reset_postdata();
