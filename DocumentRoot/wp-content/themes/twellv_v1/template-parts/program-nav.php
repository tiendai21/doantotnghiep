<?php
global $bs12_program_top_parts_arr;

$nav = $bs12_program_top_parts_arr['nav'];
// var_dump( $nav );
if (have_rows('navs', $nav->ID)) {
    ?>
    <div class="items_link">
        <ul>
            <?php
            $i = 0;
            while (have_rows('navs', $nav->ID)) :
                the_row();
                $i++;
                $ttl = get_sub_field('ttl');
                $link = get_sub_field('link');
                $target_blank = get_sub_field('target_blank') ? ' target="_blank" ' : '';
                ?>
                <li <?php echo ($i === 1) ? 'class="active"' : '' ?>>
                    <a href="<?php echo esc_url($link); ?>" <?php echo $target_blank; ?>><?php echo esc_attr($ttl); ?></a>
                </li>
            <?php
            endwhile;
            reset_rows();
            ?>
        </ul>
    </div>
    <?php
}

