<?php
//【ザ・カセットテープ・ミュージック】番組ページ改修 箇条書きリスト処理 add 20200214 yanagi
//echo "bullet-item.php";
?>
<li>
    <span><?php echo get_field( 'onairtime'); ?></span>
    <h2><?php the_title(); ?></h2>
    <p><?php echo get_field( 'overview'); ?></p>
    <a href="<?php the_permalink(); ?>" class="btn_more">
        <span>詳しく見る</span>
    </a>
</li>