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
                    <a href="#">無料で見られる！BS12の視聴方法</a>
                </div>
            </div>
            <div class="list_watch">
                <ul>
                    <?php echo $modal_item?>
                </ul>
            </div>
        </div>
    </div>
</div>