<?php
/*
 * 放送ラインナップ用アーカイブリスト
 */
// $archive_id = get_field( 'target_program_term' );

$terms = get_the_terms( get_the_ID(), 'program_cat' );

$archive_term = $terms[0];

$args = [
    'post_type' => 'program',
    'posts_per_page' => 6,
    'post__not_in' => [ get_the_ID() ],
    'tax_query' => [
        [
            'taxonomy' => 'program_cat',
            'field'  => 'slug',
            'terms' => $archive_term->slug
        ]
        ],
    'orderby' => array('post_date'=>'DESC','ID'=>'DESC'),
];
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) {
    ?>
    <h2 class="heading-title_lv1"><?php echo $archive_term->name; ?></h2>
    <!-- 放送ラインナップ -->
    <div class="program-list-wrap">
        <div class="program-list w320 type-B">
            <?php
            while( $the_query->have_posts() ) {
                $the_query->the_post();
                if( get_post_format( get_the_ID() ) === 'gallery' ) {
                    get_template_part('template-parts/program/lineup', 'item');
                }

            }
            wp_reset_postdata();
            ?>
        </div>
    </div>
    <!-- /放送ラインナップ -->
    <div class="btn-wrap w300">
        <p class="btn"><a href="<?php echo get_term_link( $archive_term ); ?>"><?php echo $archive_term->name; ?></a></p>
    </div>
    <?php
}