<section class="section" id="history">
    <div class="inner">
        <div class="tlt_section">
            <h2>閲覧履歴</h2>
            <div class="btn_more">
                <span>すべて見る</span>
            </div>
        </div>
        <div class="program_slide slide_history">
            <?php
            $history = stripslashes($_COOKIE['HISTORY']);
            foreach (json_decode($history) as $index => $item) {
                if( $item->id) {
                    $post = get_post( $item->id);
                    $term =  get_the_terms( $post->ID , "program_cat")[0];
                    $term_parent_id = wp_get_term_taxonomy_parent_id($term->term_id, 'program_cat');
                    $term_parent = get_term( $term_parent_id , "program_cat");
                    $history_args = array(
                            "url" => get_permalink($post),
                            "title" => get_the_title($post),
                            "img" => get_acf_img_tag( 'list_thumb', $term_parent, $term->name . 'のサムネイル' ),
                            'date' => date('Y年m月d日 ', strtotime(get_field('display_date', $term_parent))),
                            'desc' => get_field('pg_text', $term_parent)
                    );
                    ob_start();
                    get_template_part('template-parts/home/modal_category_item', null, array('history' => $history_args));
                    $modal .= ob_get_contents();
                    ob_end_clean();
                } ?>
                <div class="item_slide">
                    <a href="<?php echo get_permalink($post);?>">
                        <?php echo get_acf_img_tag( 'list_thumb', $term_parent, $term->name . 'のサムネイル' ); ?>
                    </a>
                </div>
            <?php } ?>
        </div>
        <?php get_template_part('template-parts/home/modal_category', null, array('title' => '閲覧履歴' , 'modal' => $modal)); ?>
    </div>
</section>
