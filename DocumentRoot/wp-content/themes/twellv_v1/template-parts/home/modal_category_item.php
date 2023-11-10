<?php
$post = $args['post'];
$term = $args['term'];
$history = $args['history'];
$movie = $args['movie'];
if ($history) {
    $url = $history['url'];
    $title = $history['title'];
    $img = $history['img'];
    $date = $history['date'];
    $desc = $history['desc'];
} else {
    $url = get_term_link($term);
    $title = $term->name;
    $img = get_acf_img_tag('list_thumb', $term, $term->name . 'のサムネイル');
    $date = date('Y年m月d日 ', strtotime(get_field('display_date', $term)));
    $desc = get_field('pg_text', $term);
}
?>
<?php
if (!$movie) : ?>
    <li>
        <a href="<?php echo $url ?>">
            <div class="thumb">
                <?php echo $img; ?>
            </div>
            <div class="txt_desp">
                <h4><?php echo $title ?></h4>
                <p><?php echo $desc ?></p>
                <span><?php echo $date ?>放送</span>
            </div>
        </a>
    </li>
<?php else: ?>
    <li class="modal_ytb">
        <?php echo $movie; ?>
    </li>
<?php endif; ?>