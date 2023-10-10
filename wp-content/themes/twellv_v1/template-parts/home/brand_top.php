<?php
	// 表示対象が０件の場合は領域ごと表示をしない
	// 対象カテゴリーのデータを取得する。
	$term_list_object = get_queried_object();
	$term_list_object_name = $term_list_object->slug;
	// 取得できなかった場合はトップページ
    if($term_list_object_name == ""){$term_list_object_name = "all";}
	// 抽出条件式作成
	$args = array(
	    'post_type' => 'banner',
	    'posts_per_page' => 1,
	    'meta_query' => array(
            array(
                'key'=>'display_category',
                'value'=>$term_list_object_name,
                'compare'=>'='
            ),
       )
	);
	$the_query = new WP_Query($args);

	// レコードが取得できたらHTML出力
	if ($the_query->have_posts()) : $the_query->the_post(); ?>
<!-- バナー -->
<?php
if($the_query->post->banner_0_banner_image != ""): ?>
<div class="content_bottom">
    <div class="slide_brand">
        <ul>
            <?php
            if($the_query->post->banner_0_banner_image != ""): ?>
                <li>
                    <a href="<?php echo $the_query->post->banner_0_link_url; ?>" target="_blank">
                        <img src="<?php echo wp_get_attachment_url($the_query->post->banner_0_banner_image); ?>" width="420" height="105" alt="<?php the_title(); ?>">
                    </a>
                </li>
            <?php
            endif;

            if($the_query->post->banner_1_banner_image != ""): ?>
                <li>
                    <a href="<?php echo $the_query->post->banner_1_link_url; ?>" target="_blank">
                        <img src="<?php echo wp_get_attachment_url($the_query->post->banner_1_banner_image); ?>" width="420" height="105" alt="<?php the_title(); ?>">
                    </a>
                </li>
            <?php
            endif;

            if($the_query->post->banner_2_banner_image != ""): ?>
                <li>
                    <a href="<?php echo $the_query->post->banner_2_link_url; ?>" target="_blank">
                        <img src="<?php echo wp_get_attachment_url($the_query->post->banner_2_banner_image); ?>" width="420" height="105" alt="<?php the_title(); ?>">
                    </a>
                </li>
            <?php
            endif;
            ?>
        </ul>
    </div>
</div>
<!-- /バナー -->
<?php
    endif;
	endif;
	wp_reset_postdata();
