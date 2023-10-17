<?php /* -*- coding: utf-8 -*- */
// echo '番組リスト';
$term_list_object = get_queried_object();
$term_list_object_name = $term_list_object->name;

$terms = get_terms( 'program_cat', [ 'parent' => $term_list_object->term_id ]);

usort( $terms, 'program_sort_by_term_order' );

$top_view = null;
$programs_arr = [];
foreach( $terms as $t ) {
    $status = (int)get_field( 'onair', $t ); // 1: 放送予定, 2: 放送中, 3: 放送終了
    if ( (int)$status !== 3 ) {
        // 放送ステータスで分離
        $programs_arr[] = $t;
    }
}
// var_dump( $programs_arr );
?>

<div id="tpl-topicpath">
    <div class="tpl-inner-wrap">
        <ul>
            <li><a href="/"><?php  bs12_pankuzu_text_top(); ?></a> </li>
			<?php if ( preg_match( '/(korea|china)/', $term_list_object->slug ) ) { ?>
				<li><a href="/program/drama/">ドラマ・映画</a></li>
			<?php } ?>
            <li><?php echo esc_attr( $term_list_object_name ); ?></li>
        </ul>
    </div>
</div><!-- /tpl-topicpath -->


<div id="tpl-contents">
    <div class="tpl-inner-wrap">
        <h1 class="category-title"><?php echo esc_attr( $term_list_object_name ); ?></h1>

        <?php
        /**
        * add 20200127 ishizaki ↓
        * BS12_RENEWAL-201 【施策ID：34-1】旅・グルメページ > 上部テキスト追加
        */
        $mv_bottom_text =get_field('mv_bottom_text_parent_cat',$term_list_object);
        if($mv_bottom_text){
        ?>
        <div class="program-list-mv-lead">
            <p><?php echo $mv_bottom_text; ?></p>
        </div>
        <?php }
        // add 20200127 ishizaki ↑
        ?>


        <!-- 生活向上エンタテインメント -->
        <section class="section-wrap">
            <div class="program-list-wrap">
                <h2 class="section-ttl"><?php echo esc_attr( $term_list_object_name ); ?></h2>

                <div class="program-list w320 type-C end">
                    <?php
                    if ( ! empty( $programs_arr ) ) {
                        foreach ($programs_arr as $t) {
                            tpl_program_list_item( $t );
                        }
                    }
                    ?>
                </div>
            </div>
        </section>

		<?php get_template_part( 'template-parts/ad/ad-news-single', 'ad-news-single' ); ?>

        <!-- BS12 特選情報 -->
        <?php  //get_template_part( 'template-parts/top', 'special-select' ); ?>
        <!-- /BS12 特選情報 -->

        <!-- BS12 生活エンタ・BS12 知っ得 -->
        <?php  get_template_part( 'template-parts/program', 'info-materials' ); ?>
        <!-- /BS12 生活エンタ・BS12 知っ得 -->









        <!-- おすすめ -->
        <?php // display_program_recommend_by_category_slug(  $term_list_object->slug ); ?>

        <!-- /おすすめ%カテゴリー名% -->

		<!-- 動画 -->
        <?php
        /**
        * add 20200305 yanagi ↓
        * BS12_RENEWAL-209 【施策ID：41-1】スポーツ一覧ページ > 配下動画の表示
        */
        if(have_rows('movie_area',$term_list_object)): ?>
		<section class="section-wrap">
			<h2 class="section-ttl">おすすめ動画</h2>
			<div class="net-video program-list w320">
			<?php while(have_rows('movie_area',$term_list_object)): the_row(); ?>
				<article class="item">
				<?php the_sub_field('movie_tag',$term_list_object); ?>
				</article>
			<?php endwhile; ?>
			</div>
		</section>
        <?php endif;
        // add 20200305 yanagi ↑
        ?>
		<!-- /動画 -->

        <!-- お客様の声 -->
        <?php
        /**
         * add 20200306 yanagi
         * BS12_RENEWAL-202 【施策ID：39-1】お客様の声コンテンツ作成
         */
        ?>
        <?php display_program_voice_by_category_slug($term_list_object->slug); ?>
        <!-- お客様の声 -->

        <!-- 人気の番組カテゴリ -->
        <section class="section-wrap">
            <div class="program-list-wrap">
                <h2 class="section-ttl">人気の番組カテゴリ</h2>
                <div class="white-wrap">
                    <?php get_template_part( 'template-parts/seo/category', 'famous-list' ); ?>
                </div>
            </div>
        </section>
        <!-- /人気の番組カテゴリ -->



        <!-- 新着情報 -->
        <section class="section-wrap">
            <div class="program-list-wrap">
                <h2 class="section-ttl">新着情報</h2>
                <div class="program-mini-list twin">
                    <?php get_template_part( 'template-parts/news/program', 'whatsnew-list' ); ?>
                </div>
            </div>

            <div class="btn-wrap w300">
                <p class="btn"><a href="/news/whatsnew/">新着情報一覧を見る</a></p>
            </div>
        </section>
        <!-- /新着情報 -->

        <!-- BS12 サキドリ情報 -->
        <?php get_template_part( 'template-parts/top', 'sakidori' ); ?>
        <!-- /BS12 サキドリ情報 -->

        <section class="section-wrap">
            <div class="information">
                <h2 class="section-ttl">お知らせ</h2>
                <div class="info-box">
                    <div class="info-list-wrap info-scroll">
                        <?php get_template_part( 'template-parts/news/announce', 'list' ); ?>
                    </div>
                </div>
            </div>
        </section>
		<?php get_template_part( 'template-parts/ad/ad-info', 'ad-info' ); ?>

    </div>

</div>
