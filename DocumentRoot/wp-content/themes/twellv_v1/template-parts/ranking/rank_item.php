<?php
global $_ranking_cat_display;

// ランキングループの中
$rank = 1;
while( have_rows( 'ranking_list', get_the_ID() ) ) : the_row();
    $term_id = get_sub_field( 'rank_in_program');
    $term_obj = get_term_by( 'id', $term_id, 'program_cat' );
    $category_term = get_term($term_obj->parent, 'program_cat' ); ?>
    <div class="item_slide">
        <a href="<?php echo get_term_link( $term_obj ); ?>">
            <div class="thumb">
                <?php echo get_acf_img_tag( 'list_thumb', $term_obj, $term_obj->name . 'のサムネイル' ); ?>
            </div>
        </a>
        <span class="num"><?php echo $rank; ?></span>
    </div>
    <?php
    $rank++;
endwhile;