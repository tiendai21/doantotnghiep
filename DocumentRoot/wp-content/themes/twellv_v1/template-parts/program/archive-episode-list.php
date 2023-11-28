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
                );
                $the_query = new WP_Query($args);
                $array_rev = array_reverse($the_query->posts);
                $the_query->posts = $array_rev;
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