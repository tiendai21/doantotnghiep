<?php
global $bs12_program_top_parts_arr;

$nav = $bs12_program_top_parts_arr['nav'];
// var_dump( $nav->ID );

if (have_rows('navs', $nav->ID)) {
    ?>
    <ul class="items_link">
        <?php
        while (have_rows('navs', $nav->ID)) :
            the_row();
            $ttl = get_sub_field('ttl');
            $link = get_sub_field('link');
            $target_blank = get_sub_field('target_blank') ? ' target="_blank" ' : '';
            if ($ttl !== "放送ラインアップ") :
                ?>
                <li>
                    <a href="<?php echo esc_url($link); ?>" <?php echo $target_blank; ?>><?php echo esc_attr($ttl); ?></a>
                </li>
            <?php
            endif;
        endwhile;
        reset_rows();
        ?>
    </ul>
    <?php
}

