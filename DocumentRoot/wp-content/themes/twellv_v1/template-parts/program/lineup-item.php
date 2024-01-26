<?php
?>
<li class="active">
    <div class="tlt">
        <div class="thumb">
            <?php
            $img = get_field( 'thumbnail');
            $img_url = $img['url'] ? $img['url'] : get_stylesheet_directory_uri() . '/assets/images/bs12_noimg.jpeg';
            ?>
            <img class="util_pc" src="<?php echo $img_url; ?>" alt="<?php the_title(); ?>">
            <img class="util_sp" src="<?php echo $img_url; ?>" alt="<?php the_title(); ?>">
        </div>
        <div class="txt_desp">
            <h4><?php the_title(); ?></h4>
            <span><?php echo get_field( 'onairtime'); ?></span>
            <div class="util_pc">
                <p><?php echo get_field( 'overview'); ?></p>
                <a href="<?php the_permalink(); ?>">
                    <div class="btn_more">
                        <span>詳しく見る</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="util_sp">
        <p><?php echo get_field( 'overview'); ?></p>
        <div class="btn_more">
            <span>詳しく見る</span>
        </div>
    </div>
</li>
