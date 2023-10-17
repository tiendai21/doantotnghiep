<section class="section" id="ranking">
    <div class="inner">
        <div class="content_ranking">
            <div class="tlt_section">
                <h2>ランキング</h2>
            </div>
            <?php display_program_ranking_by_category_slug( 'all' ); ?>
            <div class="btn_link">
                <div class="btn_more">
                    <a href="<?php echo esc_url(home_url('/program_schedule'))?>">
                        <span>すべて見る</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="btn_sns">
            <a href="#">SNS一覧</a>
        </div>
    </div>
</section>