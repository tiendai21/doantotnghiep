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
            <div class="btn_sns">
                <a href="<?php echo esc_url(home_url('/social')) ?>">SNS一覧</a>
            </div>
        <?php endif; ?>
    </div>
</section>