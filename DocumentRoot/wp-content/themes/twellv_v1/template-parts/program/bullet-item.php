<?php
//【ザ・カセットテープ・ミュージック】番組ページ改修 箇条書きリスト処理 add 20200214 yanagi
//echo "bullet-item.php";
?>
<article class="item">
	<a href="<?php the_permalink(); ?>">
		<figure>
			<figcaption class="text-block">
				<div class="onair-date"><?php echo get_field( 'onairtime'); ?></div>
				<div class="onair-state">
					<div class="heading">
						<h3 class="program-title"><?php the_title(); ?></p>
					</div>
					<p class="description"><?php echo get_field( 'overview'); ?></p>
				</div>
			</figcaption>
		</figure>
	</a>
</article>