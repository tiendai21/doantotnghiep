<?php
$archive_term = get_queried_object();
$program_term = get_term_by('id', $archive_term->parent, 'program_cat');
$category_term = get_term_by('id', $program_term->parent, 'program_cat');
?>
<section class="section" id="episode">
    <div class="inner">
        <h2>放送ラインアップ</h2>
        <div class="list_episode">
            <ul>
                <?php
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
                    'posts_per_page' => -1
                );
                $the_query = new WP_Query($args);
                foreach ($the_query->posts as $i => $post) {
                    $dateStr = get_field('onairtime', $post->ID);
                    $dateStamp = stringToTimeStamp($dateStr, 'U');
                    $episode = preg_replace('/[^0-9]/', '', $post->post_title); // Remove non-numeric characters
                    $the_query->posts[$i]->onairTime = $dateStamp;
                    $the_query->posts[$i]->episode = $episode;
                }
                usort($the_query->posts, function ($a, $b) {
                    if ($a->onairTime == $b->onairTime) {
                        return $a->episode > $b->episode; // Sort by another key when dates are equal
                    }
                    return $a->onairTime > $b->onairTime;
                });
                if ($the_query->have_posts()) {
                    while ($the_query->have_posts()) {
                        $the_query->the_post();
                        get_template_part('template-parts/program/lineup', 'item');
                    }
                }
                wp_reset_postdata();
                ?>
            </ul>
        </div>
        <div class="btn_all">
            <span>もっと見る</span>
        </div>
    </div>
</section>