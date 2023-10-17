<?php
$h_text = get_sub_field('h4_text');
$id_text = str_replace( [' ', '　'], '', $h_text );
$id_text = strip_tags($id_text);
$id_text = str_replace(PHP_EOL, '', $id_text);
?>
<h4 id="<?php echo $id_text; ?>" class="heading-title_lv3"><?php the_sub_field('h4_text');?></h4>

