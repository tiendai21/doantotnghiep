<?php
if (get_sub_field('carousel_images_list')) :
    ?>
    <div class="carousel_images_block">
        <div class="program_slide is_loading synopsis_list">
            <?php
            while (the_repeater_field('carousel_images_list')) :
                $image = get_sub_field('image');
                ?>
                <div class="item_slide">
                    <div class="thumb">
                        <img class="util_pc" src="<?php echo $image['url']; ?>"
                             alt="<?php echo get_sub_field('alt_text'); ?>">
                        <img class="util_sp" src="<?php echo $image['url']; ?>"
                             alt="<?php echo get_sub_field('alt_text'); ?>">
                    </div>
                </div>
            <?php
            endwhile;
            ?>
        </div>
    </div>
<?php
endif;
?>
