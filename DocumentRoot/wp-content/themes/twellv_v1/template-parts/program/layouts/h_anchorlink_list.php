<?php
/********************************************************
 * H3_見出し　の目次化
 *
 * add_ishizaki 2020/05/15
 * BS12_RENEWAL-223 【施策ID：49-3】ハワイコラム対策：目次の設置
 *
********************************************************/

if(get_sub_field('h_anchorlink_list_display')){
    $h3_list = array();
    $h3_list_exclusion =array();
    // 当該記事の繰り返しフィールドを取得
    $flex_set = get_field('page_flex_content');

    if($flex_set){
        foreach($flex_set as $layout){// 繰り返しフィールドの中身(CF)をループする。
            $flex_set_type = $layout['acf_fc_layout'];
            //h3テキストとidの配列を作成
            if($flex_set_type === 'h3_block'){
                $field_val = $layout['h3_text'];
                if($field_val){
                    $h_text = $field_val;
                    $id_text = preg_replace('/[^ぁ-んァ-ンーa-zA-Z0-9一-０-９]+/u', '', $h_text);
                    $id_text = strip_tags($id_text);
                    $id_text = str_replace(PHP_EOL, '', $id_text);
                    $h3_list[$h_text] = [
                        'h_text' => $h_text,
                        'id_text' => $id_text,
                    ];
                }
            }
            //除外テキストの配列を作成
            elseif($flex_set_type === 'h_anchorlink_list'){
                $field_val = $layout['h3_block_list_exclusion'];
                if($field_val){
                    $field_val = $layout['h3_block_list_exclusion'];
                    foreach($field_val as $text){
                        $h3_list_exclusion[] = $text['h3_block_list_exclusion_text'];
                    }
                }
            }
        }
    }


    // $h3_list_exclusionの値を、$h3_listキーに指定して要素を削除
    foreach($h3_list_exclusion as $text){
        if ( array_key_exists($text, $h3_list) ) {
            unset($h3_list[$text]);
        }
    }



    //タグ出力
    ?>
    <div class="page-index gray-box">
        <h4 class="heading-title_lv3">放送中</h4>
        <ul class="txtlink-list anchor">
            <?php foreach($h3_list as $text_arr){ ?>
            <li><a href="#<?php echo $text_arr['id_text']?>"><?php echo $text_arr['h_text']?></a></li>
            <?php } ?>
        </ul>
    </div>
    <?php
}

?>
