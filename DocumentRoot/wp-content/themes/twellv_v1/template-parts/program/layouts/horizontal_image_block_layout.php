<?php
if (get_sub_field('horizontal_image_block_layout')) :
    $images_list = [];
    while (the_repeater_field('horizontal_image_block_layout')) :
        $item = [];
        $image = get_sub_field('image');
        $item['image'] = $image;
        $item['paragraph'] = get_sub_field('paragraph');
        $item['image_alt'] = get_sub_field('image_alt');
        $item['image_description'] = get_sub_field('image_description');
        $layout = get_sub_field('layout');
        $images_list[] = $item;
    endwhile;
    ?>
    <div class="image_text_block <?php echo $layout ?>">
        <?php if ($layout == "rtl"): ?>
            <p><?php echo $item['paragraph'] ?></p>
        <?php endif; ?>
        <div class="content">
            <div class="thumb">
                <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['alt_text']; ?>">
            </div>
            <p class="txt"><?php echo $item['image_description'] ?></p>
        </div>
        <?php if ($layout == "ltr"): ?>
            <p><?php echo $item['paragraph'] ?></p>
        <?php endif; ?>
    </div>
<?php
endif ?>