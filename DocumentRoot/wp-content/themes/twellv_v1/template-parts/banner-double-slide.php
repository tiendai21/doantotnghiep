<?php
/*
  * Banner double slide template for short-code FOR ASIA
  * */
$program_cat_base_items = get_program_cat_base_items();
// var_dump( $program_cat_base_items );

$args = [
    'taxonomy' => 'program_cat',
    // 'hide_empty' => false,
    'parent' => $program_cat_base_items['korea'], // 中国ドラマのterm_id
    'meta_query' => [
        'relation' =>'AND',
        [
            'key' => 'onair',
            'value' => [1,2,3], // 放送予定か放送中
            'compare' => 'IN'
        ],
    ]
];
$args_2 = [
    'taxonomy' => 'program_cat',
    // 'hide_empty' => false,
    'parent' => $program_cat_base_items['china'], // 中国ドラマのterm_id
    'meta_query' => [
        'relation' =>'AND',
        [
            'key' => 'onair',
            'value' => [1,2,3], // 放送予定か放送中
            'compare' => 'IN'
        ],
    ]
];
// var_dump( $args );
$korea_term_query = new WP_Term_Query($args);
$china_term_query = new WP_Term_Query($args_2);

?>
<div class="slide_top_content">
    <div class="slide_scheduled_top" dir="rtl">
        <?php
        $i = 0;
        foreach ($korea_term_query->get_terms() as $term) :
            if (++$i > 5) break;
            ?>
            <a href="">
                <div class="thumb">
                    <?php echo get_acf_img_tag('list_thumb', $term, $term->name . 'のサムネイル'); ?>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
    <div class="slide_scheduled_bottom">
        <?php
        $i = 0;
        foreach ($china_term_query->get_terms() as $term) :
            if (++$i > 5) break;
            ?>
            <a href="">
                <div class="thumb">
                    <?php echo get_acf_img_tag('list_thumb', $term, $term->name . 'のサムネイル'); ?>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>
