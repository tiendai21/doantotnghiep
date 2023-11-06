<?php /* TOPメインビジュアル */
if( get_field( 'main_visual_list' ) ) : ?>
<!-- banner -->
<section class="section section-hidden" id="banner">
    <div class="inner">
        <div class="notice_top">
            <span>無料で見られる！BS12の視聴方法</span>
        </div>
        <div class="slide_top">
            <?php
            while( the_repeater_field( 'main_visual_list' ) ) :
                $titleSlide = get_sub_field( 'title' );
                $target_blank = get_sub_field( 'target_blank' ) ? ' target="_blank" ' : '';
                $link_url = get_sub_field( 'url' );
                $description = get_sub_field( 'description' );
                $image_data = get_sub_field( 'main_image' );
                $image = '';
                if ( $image_data ) {
                    $image = $image_data['url'];
                }

            $target_program_id = get_sub_field( 'program_category' );

            if( $target_program_id > 0 ) {
                $target_program_term = get_term_by( 'id', $target_program_id, 'program_cat');
                $title = $target_program_term->name;
                $link_url = get_term_link( $target_program_term, 'program_cat' );
                $image_data = get_field( 'main_visual_vod', $target_program_term );
                // $description = get_field( 'pg_text', $target_program_term );
                $description = get_field( 'onairtime', $target_program_term );
                if ( ! empty( $image_data ) ) {
                    $image = $image_data['url'];
                }
            }
            ?>
            <div class="item_slide">
                <a href="<?php echo $link_url; ?>" <?php echo $target_blank; ?>>
                    <div class="thumb">
                        <img src="<?php echo $image; ?>" width="750" height="573" alt="<?php echo $title;  ?>のトップイメージ">
                    </div>
                    <div class="txt_desp">
                        <span><?php echo $title; ?></span>
                        <h3><?php echo $titleSlide; ?></h3>
                        <p><?php  echo $description; ?></p>
                    </div>
                </a>
            </div>
            <?php endwhile; ?>
        </div>
        <div class="program_list_top">
            <a href="<?php echo esc_url(home_url('/program_schedule'))?>">番組表</a>
            <a href="<?php echo esc_url(home_url('/program'))?>">番組一覧</a>
        </div>
    </div>
</section>
<!-- /banner -->
<?php endif; ?>