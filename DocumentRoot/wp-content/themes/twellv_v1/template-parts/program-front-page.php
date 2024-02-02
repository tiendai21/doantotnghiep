<input class="id_single" type="hidden" value="<?php the_ID() ?>">
<?php
/*
 * Program detail page
 * */
$program_term = get_queried_object();
$parent_term = get_term_by('id', $program_term->parent, 'program_cat');

global $bs12_program_top_parts_arr;
$top = $bs12_program_top_parts_arr['top'];

if (have_rows('page_flex_content', $top->ID)) {
    ?>
    <div class="program-contents-wrap">
        <div class="inner">
            <?php if (get_field('display_under_construction', $program_term)) { ?>
                <div class="caution">
                    <p>ただいまページ移行作業中につき、表示が崩れている場合がございます。<br>大変申し訳ありませんが今しばらくお待ちください。</p>
                </div>
            <?php } ?>
            <?php
            while (have_rows('page_flex_content', $top->ID)) {
                the_row();
                $layout = get_row_layout();
//                var_dump($layout);        // component name
//                var_dump($top->ID);       // post that contain components
                get_template_part('template-parts/program/layouts/' . $layout);
            }
            if(!get_field('hide_broadcast_lineup', $program_term)){
                get_template_part('template-parts/program/archive-episode-list');
            }
            ?>
        </div>
        <!--  back to cat  -->
        <div class="backToList">
            <a href='<?php echo get_term_link($parent_term)?>'><?php echo $parent_term->name?>に戻る</a>
        </div>
    </div>
    <?php
    get_template_part('template-parts/ad/ad-news', 'ad-news'); ?>

    <?php
} // if( have_rows ...
