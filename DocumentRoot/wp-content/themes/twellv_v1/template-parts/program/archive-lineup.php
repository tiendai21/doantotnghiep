<?php
$archive_term = get_queried_object();
$program_term = get_term_by( 'id', $archive_term->parent, 'program_cat' );
$category_term = get_term_by( 'id', $program_term->parent, 'program_cat' );
?>
<div id="tpl-topicpath">
    <div class="tpl-inner-wrap">
        <ul>
            <li><a href="/"><?php  bs12_pankuzu_text_top(); ?></a> </li>
            <?php if ( preg_match( '/(korea|china)/', $category_term->slug ) ) { ?>
                <li><a href="/program/drama/">ドラマ・映画</a></li>
            <?php } ?>
			<?php if ( strpos( $program_term->slug, 'baseball') === false ) { ?>
				<li><a href="<?php echo get_term_link( $category_term ); ?>"><?php echo $category_term->name; ?></a></li>
            <?php } ?>
            <?php
                $program_name=get_field('pankuzu_program_name', $program_term);
                if($program_name == "") $program_name = $program_term->name;
            ?>
            <li><a href="<?php echo get_term_link( $program_term ); ?>"><?php echo $program_name; ?></a></li>
            <li><?php echo $archive_term->name; ?></li>
        </ul>
    </div>
</div><!-- /tpl-topicpath -->

<div id="tpl-contents">

    <?php $bg_style = get_program_bg_style( $program_term ); ?>
    <div class="tpl-inner-bg <?php echo $bg_style['bg_style_type']; ?>" style="<?php echo $bg_style['bg_style_str']; ?>"></div>
    <div class="tpl-inner-wrap">
        <section class="category-hero program-mv img-only">
            <p class="img">
                <?php
                // pcとspで分離する?
                echo get_acf_img_tag( 'main_visual_under',
                    $program_term,
                    $program_term->name . 'メインビジュアル',
                    'only-pc'
                );
                echo get_acf_img_tag( 'main_visual_under_sp',
                    $program_term,
                    $program_term->name . 'メインビジュアル',
                    'only-sp'
                );
                ?>
            </p>
        </section>

        <?php
        // ナビゲーション
        display_program_navi( $program_term );
        ?>

        <div class="program-contents-wrap">
            <?php if( get_field( 'display_under_construction', $program_term ) ) { ?>
                <div class="caution">
                    <p>ただいまページ移行作業中につき、表示が崩れている場合がございます。<br>大変申し訳ありませんが今しばらくお待ちください。</p>
                </div>
            <?php } ?>
            <h1 class="heading-title_lv1"><?php echo $archive_term->name; ?></h1>

            <?php
			// WYSIWYG
			$archive_top_text = get_field( 'archive_top_text', $archive_term );
			if ( $archive_top_text ) {
				echo '<div class="text-wrap">';
				echo add_tag_custom_class( $archive_top_text );
				echo '</div>';
			}
			?>

            <!-- 番組名％％ の放送ラインナップ -->
            <section class="section-wrap">
                <div class="program-list-wrap">
                        <?php
                            // ↓↓【ザ・カセットテープ・ミュージック】番組ページ改修 リスト表示デザイン変更処理 add 20200214 yanagi
                        $archive_bullet_design = get_field('archive_bullet_design', $archive_term);
                        if ($archive_bullet_design) {
                            ?>
					<div class="program2-list w320 type-B">
                            <?php
                            while (have_posts()) {
                                the_post();
                                get_template_part('template-parts/program/bullet', 'item');
                            }
                            ?>
                    </div>
					<?php
                        } else {
                            // ↑↑【ザ・カセットテープ・ミュージック】番組ページ改修 リスト表示デザイン変更処理 add 20200214 yanagi
                            ?>
					<div class="program-list w320 type-B">
					<?php
                            while (have_posts()) {
                                the_post();
                                get_template_part('template-parts/program/lineup', 'item');
                            }
                            ?>
                    </div>
					<?php
                        }
                        ?>
                </div>
                    <?php
                    /* ページャー処理 add 20190808 yanagi ↓↓ */
                    if ( function_exists( 'pagination' ) ) :
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        pagination( $wp_query->max_num_pages, get_query_var( 'paged' ) );
                    endif;
                    /* ページャー処理 add 20190808 yanagi ↑↑ */
                    ?>
            </section>
            <!-- /番組名％％ の放送ラインナップ -->

            <?php
			$archive_bottom_text =  get_field( 'archive_bottom_text', $archive_term );
			if( $archive_bottom_text ) {
				echo '<div class="text-wrap">';
				echo add_tag_custom_class( $archive_bottom_text );
				echo '</div>';
			}
            ?>
            <?php
            //【施策ID：49-4】ハワイコラム対策：番組紹介コンテンツおよびリンク動線追加 add ishizaki20200420↓
            $link_programtop_under=get_field('link_programtop_under', $program_term);
            if($link_programtop_under){
            $img=get_field('list_thumb', $program_term);
            ?>
                <div class="program-list-wrap category-top-link">
                    <div class="program-list w320 type-C card">
                        <article class="item">
                            <a href="<?php echo get_term_link( $program_term ); ?>">
                                <figure>
                                    <div class="img"><img src="<?php echo $img['url']?>" alt="<?php echo $program_term->name; ?>"></div>
                                    <figcaption class="text-block">
                                        <div class="heading">
                                            <p class="program-title"><?php echo $program_term->name; ?></p>
                                            <p class="onair-date"><?php echo get_field('onairtime', $program_term);?></p>
                                        </div>
                                        <p class="description"><?php echo get_field('pg_text', $program_term);?></p>
                                        <p class="btn"><span><?php echo $program_term->name; ?>TOPへ</span></p>
                                    </figcaption>
                                </figure>
                            </a>
                        </article>
                    </div>
                </div>
            <?php
            }
            //add ishizaki20200420↑
            ?>

            <?php get_template_part( 'template-parts/program/share', 'buttons' ); ?>

        </div>

		<?php get_template_part( 'template-parts/ad/ad-news', 'ad-news' ); ?>
		<?php get_template_part( 'template-parts/ad/ad-news-single', 'ad-news-single' ); ?>

        <?php //BS12_RENEWAL-269 【タスク】レイアウト変更ならびにWP機能追加 edit 20201012 yanagi ?>
        <!-- こちらもおすすめ -->
        <?php display_program_recommend_often_watch_by_category_slug($program_term); ?>
        <!-- /こちらもおすすめ -->
        
        <?php 
        //edit yanagi 20210915↓
        //BS12_RENEWAL-295 【施策18】コンテンツの順序変更 ドラマ詳細ページ
        ?>
        <!-- ランキング -->
        <section class="section-wrap">
            <div class="program-ranking-wrap">
                <div class="program-list-wrap">
                    <h2 class="section-ttl"><?php echo esc_attr( $category_term->name ); ?>ランキング</h2>
                    <?php display_program_ranking_by_category_slug( $category_term->slug ); ?>
                </div>
                <?php //SPのみ　BS12_RENEWAL-227 【施策ID：51-2】内部リンクの追加：番組ページから番組カテゴリ一覧のリンク追加add_ishizaki20200420 ↓?>
                <div class="btn-wrap only-sp marB5">
                    <p class="btn"><a href="<?php echo get_term_link( $category_term ); ?>"><?php echo $category_term->name; ?>一覧を見る</a></p>
                </div>
                <?php //add_ishizaki20200420↑ ?>

                <div class="program-list-wrap">
                    <h2 class="section-ttl">アクセスランキング</h2>
                    <?php display_program_ranking_by_category_slug( 'all' ); ?>
                </div>

                <?php //PCのみ　BS12_RENEWAL-227 【施策ID：51-2】内部リンクの追加：番組ページから番組カテゴリ一覧のリンク追加add_ishizaki20200420 ↓?>
                <div class="btn-wrap only-pc">
                    <p class="btn"><a href="<?php echo get_term_link( $category_term ); ?>"><?php echo $category_term->name; ?>一覧を見る</a></p>
                </div>
                <?php //add_ishizaki20200420↑ ?>
            </div>
        </section>
        <!-- /ランキング -->

        <!-- BS12おすすめ番組 -->
        <?php get_template_part( 'template-parts/top', 'recommend-you-programs' ); ?>
        <!-- /BS12おすすめ番組 -->

        <?php get_template_part( 'template-parts/ad/ad-recommend', 'ad-recommend' ); ?>

        <?php //edit yanagi 20210915↑ ?>

        <?php //BS12_RENEWAL-269 【タスク】レイアウト変更ならびにWP機能追加 edit 20201012 yanagi ?>
        <!-- BS12 特選情報 -->
        <?php get_template_part( 'template-parts/top', 'special-select' ); ?>
        <!-- /BS12 特選情報 -->

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


            <?php get_template_part( 'template-parts/uiux/bottom', 'roll-link' ); ?>


    </div>
</div><!-- /tpl-contents -->
