<?php
$h_text = get_sub_field('h3_text');
$id_text = preg_replace('/[^ぁ-んァ-ンーa-zA-Z0-9一-０-９]+/u', '', $h_text);
$id_text = strip_tags($id_text);
$id_text = str_replace(PHP_EOL, '', $id_text);
?>
<h3 id="<?php echo $id_text; ?>" class="heading-title_lv2"><?php echo $h_text;?></h3>
