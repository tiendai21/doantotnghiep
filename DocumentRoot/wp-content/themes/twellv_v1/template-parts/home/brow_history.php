<section class="section" id="history">
    <div class="inner">
        <div class="tlt_section">
            <h2>閲覧履歴</h2>
            <div class="btn_more">
                <span>すべて見る</span>
            </div>
        </div>
        <div class="program_slide slide_history">
            <?php
                $history = stripslashes($_COOKIE['HISTORY']);
//              var_export(json_decode($history));
                foreach (json_decode($history) as $index => $item) {
//                  var_dump($item->id);
                    if( $item->id) {
                          $post = get_post( $item->id);
                        $term =  get_the_terms( $item->id , "program_cat");

                        $img = get_field('list_thumb', $term[0]);
                    } ?>
                <div class="item_slide">
                    <a href="#">
                        <img src="<?php echo $img["url"] ?>" width="338" height="198" alt="program slide">
                    </a>
                </div>
            <?php } ?>


            <!--            <div class="item_slide">-->
            <!--                <a href="#">-->
            <!--                    <img src="-->
            <?php //echo get_stylesheet_directory_uri() . '/assets/images/img_program.jpg' ?><!--" width="338" height="198" alt="program slide">-->
            <!--                </a>-->
            <!--            </div>-->
            <!--            <div class="item_slide">-->
            <!--                <a href="#">-->
            <!--                    <img src="-->
            <?php //echo get_stylesheet_directory_uri() . '/assets/images/img_program.jpg' ?><!--" width="338" height="198" alt="program slide">-->
            <!--                </a>-->
            <!--            </div>-->
            <!--            <div class="item_slide">-->
            <!--                <a href="#">-->
            <!--                    <img src="-->
            <?php //echo get_stylesheet_directory_uri() . '/assets/images/img_program.jpg' ?><!--" width="338" height="198" alt="program slide">-->
            <!--                </a>-->
            <!--            </div>-->
        </div>
    </div>
</section>