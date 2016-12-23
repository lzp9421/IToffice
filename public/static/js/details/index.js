/**
 * Created by MyStudio on 2016/12/22.
 */

$(function () {
    $('a.detail-delete').click(function btnClick() {
        var self = this;
        console.log($(self).attr('delete-uri'));
        $(self).off('click');
        $.ajax({
            type: "POST",
            url: $(self).attr('delete-uri'),
            data: "_method=DELETE",
            dataType: "json",
            success: function(msg){
                if (msg.status === 'success') {
                    //JQuery删除元素
                    $(self).parents('tr').fadeOut();
                    console.log(msg.info);
                    //alert(msg.info);
                } else {
                    console.log(msg.info);
                    $(self).on('click', btnClick);
                    alert(msg.info);
                }
            },
            error: function () {
                console.log('删除出错！');
                $(self).on('click', btnClick);
                alert('删除出错！');
            }
        });
    });
});
