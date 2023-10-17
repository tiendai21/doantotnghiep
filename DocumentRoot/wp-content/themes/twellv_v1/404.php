<?php header("HTTP/1.1 404 Not Found"); ?>
<?php /* -*- coding: utf-8; mode: web; -*- */
get_header();
?>
    <div class="mainContainer">

        <div id="sec-howtowatch">

            <div class="h1_detailTitleBox">
                <div class="innerBox cF">
                    <h1>404 File not found.</h1>
                    <!-- /innerBox -->
                </div>
                <!-- /h1_detailTitleBox -->
            </div>

            <div class="cF">
                <div class="howtoBox">

                    <p>お探しのページは見つかりません</p>
                    <p>一時的にアクセスできない状態か、移動もしくは削除された可能性があります。</p>

                </div>
                <!--cF-->
            </div>
        </div>
        <!-- /sec-howtowatch -->
        <!-- /.mainContainer -->
    </div>
<style>
    .mainContainer{
        width: 1000px;
        margin: 0 auto;
        padding: 200px;
    }

    @media screen and (max-width: 750px){
        .mainContainer{
            width: 100%;
            padding: 120px 20px;
        }
    }

    .mainContainer h1{
        font-size: 60px;
    }

    @media screen and (max-width: 750px){
        .mainContainer h1{
            font-size: 30px;
        }
    }
</style>
<?php

get_footer();
