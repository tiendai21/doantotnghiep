<?php
?>
<article class="item">
    <a href="<?php the_permalink(); ?>">
        <figure>
            <div class="img">
                <?php
                $img = get_field( 'thumbnail');
                ?>
                <img src="<?php echo $img['url']; ?>" alt="<?php the_title(); ?>">
            </div>
            <figcaption class="text-block">
                <div class="heading">
                    <h3 class="program-title"><?php the_title(); ?></p>
                    <p class="onair-date"><?php echo get_field( 'onairtime'); ?></p>
                </div>
                <p class="description">
                    <?php echo get_field( 'overview'); ?>
                </p>
            </figcaption>
        </figure>
    </a>
</article>
