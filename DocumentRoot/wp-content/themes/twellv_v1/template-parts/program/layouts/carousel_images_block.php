<?php
if( get_sub_field( 'carousel_images_list' ) ) {
    ?>
    <div class="img-slider">
        <?php
        while( the_repeater_field( 'carousel_images_list' ) ) {
            $image = get_sub_field( 'image' );
            ?>
            <article class="item">
                <img src="<?php echo $image['url']; ?>" alt="<?php echo get_sub_field( 'alt_text'); ?>">
            </article>
            <?php
        }
        ?>
    </div>
    <?php
}
