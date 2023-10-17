<?php
$h_text = get_sub_field('h5_text');
$id_text = str_replace( [' ', '　'], '', $h_text );
$id_text = strip_tags($id_text);
$id_text = str_replace(PHP_EOL, '', $id_text);
?>
<h5 id="<?php echo $id_text; ?>" class="heading-title_lv4"><?php the_sub_field('h5_text');?></h5>

