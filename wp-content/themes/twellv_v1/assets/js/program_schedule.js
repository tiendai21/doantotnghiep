(function ($) {
    var prev_index = 0;
    var current_index = 0;
    var list_day = $('.list_date');
    var list_content = $('.content_section');
    var list_title = list_day.find('.inner h3');
    var max_index = list_title.length;
    var item = list_content.toArray().reduce((pre, cur, index)=>{
        var temp = $(cur).find('.item_content');
        return [...pre, temp];
    },[])
    $('.prev_day').on('click', function(){
        if(current_index - 1 > 0){
            prev_index = current_index;
            current_index -= 1;
            //
            // tiêu đề
            list_title.eq(prev_index).addClass('util_pc');
            list_title.eq(current_index).removeClass('util_pc');

            // Nội dung
            item.forEach(element => {
                element.eq(prev_index).addClass('util_pc');
                element.eq(current_index).removeClass('util_pc');
            });

        }
    });
    $('.next_day').on('click', function(){
        if(current_index + 1 < max_index){
            prev_index = current_index;
            current_index += 1;

            // tiêu đề
            list_title.eq(prev_index).addClass('util_pc');
            list_title.eq(current_index).removeClass('util_pc');

            // Nội dung
            item.forEach(element => {
                element.eq(prev_index).addClass('util_pc');
                element.eq(current_index).removeClass('util_pc');
            });

        }
    });


})(jQuery);


