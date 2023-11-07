<?php
$slug = $args['cat'];
$title = $args['title'];
$hasSns = $args['sns'];
?>
<section class="section" id="ranking">
    <div class="inner">
        <div class="content_ranking">
            <div class="tlt_section">
                <h2><?php echo $title ?></h2>
            </div>
            <?php display_program_ranking_by_category_slug($slug); ?>
        </div>
        <?php if ($hasSns): ?>
            <div class="btn_watch">
                <a href="<?php echo esc_url(home_url('/social')) ?>">
                    <span></span>
                    <span>SNS一覧</span>
                </a>
            </div>
            <svg style="position: absolute; opacity: 0; width: 0; height: 0;" xmlns="http://www.w3.org/2000/svg" width="464.695" height="86" viewBox="0 0 464.695 86">
                <clipPath id="myClip2" clipPathUnits="objectBoundingBox">
                    <path id="Subtraction_12" data-name="Subtraction 12" d="m0.924,1 h-0.924 c0.038,-0.051,0.065,-0.26,0.065,-0.5 c0,-0.24,-0.027,-0.449,-0.065,-0.5 h0.924 q0.004,0,0.008,0.002 q0.004,0.002,0.008,0.008 q0.004,0.005,0.007,0.012 q0.004,0.007,0.007,0.017 q0.003,0.009,0.007,0.021 q0.003,0.012,0.006,0.026 q0.003,0.014,0.006,0.029 q0.003,0.015,0.005,0.031 q0.003,0.017,0.005,0.036 q0.002,0.02,0.004,0.04 q0.002,0.02,0.004,0.041 q0.002,0.021,0.003,0.043 q0.003,0.047,0.005,0.095 q0.002,0.049,0.002,0.099 q0,0.05,-0.002,0.099 q-0.002,0.049,-0.005,0.095 q-0.001,0.022,-0.003,0.043 q-0.002,0.021,-0.004,0.041 q-0.002,0.02,-0.004,0.04 q-0.002,0.019,-0.005,0.036 q-0.002,0.016,-0.005,0.031 q-0.003,0.015,-0.006,0.029 q-0.003,0.014,-0.006,0.026 q-0.003,0.012,-0.007,0.021 q-0.003,0.01,-0.007,0.017 q-0.004,0.007,-0.007,0.012 q-0.004,0.006,-0.008,0.008 q-0.004,0.002,-0.008,0.002" fill="#4aa253"/>
                </clipPath>
            </svg>

        <?php endif; ?>
    </div>
</section>