<?php
/* Youtube動画表示 */
$yid = get_sub_field( 'youtube_id' );

if ( $yid != '' ) {
    ?>
    <!--video_youtube-->
    <section class="section" id="video_youtube">
        <div class="inner">
            <div class="video">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $yid; ?>"
                        frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
            </div>
        </div>
    </section>
    <!--/video_youtube-->
    <?php
}

