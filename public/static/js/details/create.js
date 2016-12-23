/**
 * Created by MyStudio on 2016/12/21.
 */

$(function () {
    $('#direction input').change(function () {
        $value = $(this).attr('value');
        $('#direction em').text('');
        $(this).parent().children('em').html('&nbsp' + $(this).attr('title'));
        if ($value == 1) {
            $('#details-name').removeClass('am-hide');
            $('#details-asset-id').addClass('am-hide');
        } else {
            $('#asset_id + div .am-selected-status').html('请选择' + $(this).attr('title') + '的物品')
            $('#details-asset-id').removeClass('am-hide');
            $('#details-name').addClass('am-hide');
        }
    });
});

$(function () {
    $('a.detail-delete').click(function () {
        console.log($(this).attr('delete-uri'));
        $.ajax({
            type: "POST",
            url: $(this).attr('delete-uri'),
            data: "_method=DELETE",
            dataType: "json",
            success: function(msg){
                if (msg.status === 'success') {
                    console.log(msg.info);
                    alert(msg.info);
                } else {
                    console.log(msg.info);
                    alert(msg.info);
                }
            },
            error: function () {
                console.log('删除出错！');
                alert('删除出错！');
            }
        });
    });
});