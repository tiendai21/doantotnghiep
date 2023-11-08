<?php
$h_text = get_sub_field('h2_text');
$id_text = str_replace( [' ', '　'], '', $h_text );
$id_text = strip_tags($id_text);
$id_text = str_replace(PHP_EOL, '', $id_text);
?>
<h2><?php echo $h_text;?></h2>

