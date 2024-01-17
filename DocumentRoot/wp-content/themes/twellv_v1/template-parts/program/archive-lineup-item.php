<?php
?>
<li>
    <a href="<?php the_permalink(); ?>">
        <div class="thumb">
            <?php
            $img = get_field('thumbnail');
            $img_url = $img['url'] ? $img['url'] : get_stylesheet_directory_uri() . '/assets/images/bs12_noimg.jpeg';
            ?>
            <img class="util_pc" src="<?php echo $img_url; ?>" alt="<?php the_title(); ?>">
            <img class="util_sp" src="<?php echo $img_url; ?>" alt="<?php the_title(); ?>">
        </div>
        <div class="txt_desp">
            <h4><?php the_title(); ?></h4>
            <div>
                <p><?php echo get_field('overview'); ?></p>
            </div>
        </div>
    </a>
</li>
