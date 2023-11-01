<?php if (have_rows('home_brand_banners', 'option')): ?>
    <div class="list_brand">
        <?php while (have_rows('home_brand_banners', 'option')) :
            the_row();
            $banner_img = get_sub_field('banner_image');
            $banner_title = get_sub_field('banner_title');
            $banner_desc = get_sub_field('banner_desc');
            $banner_url = get_sub_field('banner_url');
            ?>
            <div class="item_brand">
                <a href="<?php echo $banner_url ?>">
                    <div class="thumb">
                        <img src="<?php echo $banner_img ?>" width="430" height="180"
                             alt="<?php echo $banner_title ?>">
                    </div>
                </a>
                <div class="txt_desp">
                    <a href="<?php echo $banner_url ?>">
                        <h3><?php echo $banner_title ?></h3>
                    </a>
                    <p><?php echo $banner_desc ?></p>
                </div>

            </div>
        <?php endwhile; ?>
    </div>
<?php endif; ?>
