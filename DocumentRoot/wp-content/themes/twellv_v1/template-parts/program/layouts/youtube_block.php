<?php
/* Youtube動画表示 */
$yid = get_sub_field( 'youtube_id' );

if ( $yid != '' ) {
    ?>
    <div class="movie-contents">
        <!-- <h2 class="heading-title_lv1">新着動画</h2> -->
        <div class="movie">
            <div class="movie-wrap">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $yid; ?>"
                        frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
            </div>
        </div>
    </div>
    <?php
}
