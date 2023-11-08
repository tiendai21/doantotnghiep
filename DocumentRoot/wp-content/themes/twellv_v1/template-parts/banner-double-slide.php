<?php
/*
  * Banner double slide template for short-code
  * */
?>
<div class="siler_top_content">
    <?php if (have_rows('listcategory_field_banner_01', 'option')): ?>
        <div class="slide_top_odd">
            <?php while (have_rows('listcategory_field_banner_01', 'option')): the_row();
                $image = get_sub_field('listcategory_image');
                $urlItem = get_sub_field('listcategory_url');
                ?>
                <a href="<?php echo $urlItem; ?>">
                    <div class="thumb">
                        <img src="<?php echo $image; ?>" width="448px" height="252px"
                             alt="thumb slide top 01">
                    </div>
                </a>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
    <?php if (have_rows('listcategory_field_banner_02', 'option')): ?>
        <div class="slide_top_even">
            <?php while (have_rows('listcategory_field_banner_02', 'option')): the_row();
                $image = get_sub_field('listcategory_image');
                $urlItem = get_sub_field('listcategory_url');
                ?>
                <a href="<?php echo $urlItem; ?>">
                    <div class="thumb">
                        <img src="<?php echo $image; ?>" width="448px" height="252px"
                             alt="thumb slide top 02">
                    </div>
                </a>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</div>