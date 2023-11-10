<?php
$modal_item = $args['modal'];
$modal_title = $args['title'];
?>
<div class="wrapper_modal">
    <div class="inner">
        <div class="modal_content">
            <div class="close active">
                <div class="line"><span></span></div>
            </div>
            <div class="tlt">
                <h2><?php echo $modal_title?></h2>
                <div class="btn_watch">
                    <a href="<?php echo esc_url(home_url('/howtowatch')) ?>">
                        <span></span>
                        <span>無料で見られる！BS12の視聴方法</span>
                    </a>
                </div>
                <svg style="position: absolute; opacity: 0; width: 0; height: 0;" xmlns="http://www.w3.org/2000/svg" width="494"
                     height="86" viewBox="40 0 494 86">
                    <clipPath id="myClip" clipPathUnits="objectBoundingBox">
                        <path id="Subtraction_12" data-name="Subtraction 12"
                              d="m0.913,1 h-0.907 q-0.003,0,-0.006,-0.001 q0.003,-0.005,0.006,-0.012 q0.003,-0.007,0.006,-0.015 q0.003,-0.008,0.006,-0.017 q0.003,-0.01,0.006,-0.021 q0.003,-0.012,0.005,-0.024 q0.003,-0.014,0.005,-0.028 q0.002,-0.014,0.005,-0.029 q0.002,-0.015,0.004,-0.031 q0.002,-0.016,0.004,-0.035 q0.002,-0.017,0.003,-0.036 q0.002,-0.019,0.003,-0.037 q0.001,-0.02,0.002,-0.04 q0.002,-0.042,0.003,-0.086 q0.001,-0.043,0.001,-0.087 q0,-0.044,-0.001,-0.087 q-0.001,-0.044,-0.003,-0.086 q-0.001,-0.02,-0.002,-0.04 q-0.001,-0.019,-0.003,-0.037 q-0.001,-0.019,-0.003,-0.036 q-0.002,-0.019,-0.004,-0.035 q-0.002,-0.016,-0.004,-0.031 q-0.002,-0.015,-0.005,-0.029 q-0.002,-0.014,-0.005,-0.027 q-0.003,-0.014,-0.005,-0.026 q-0.003,-0.01,-0.006,-0.021 q-0.003,-0.009,-0.006,-0.017 q-0.003,-0.008,-0.006,-0.015 q-0.003,-0.007,-0.006,-0.012 q0.003,-0.001,0.006,-0.001 h0.907 c0.023,0,0.045,0.052,0.062,0.147 c0.016,0.094,0.026,0.221,0.026,0.353 c0,0.133,-0.009,0.259,-0.026,0.353 c-0.016,0.094,-0.038,0.147,-0.062,0.147"
                              fill="#c5dbf4"/>
                    </clipPath>
                </svg>
            </div>
            <div class="list_watch">
                <ul>
                    <?php echo $modal_item?>
                </ul>
            </div>
        </div>
    </div>
</div>