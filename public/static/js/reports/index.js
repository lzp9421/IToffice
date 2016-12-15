/**
 * Created by MyStudio on 2016/12/9.
 */

$(function () {
    var selected = $('#report-select-class, #report-select-user');
    selected.change(function() {
        var value = $(this).attr('report-placeholder');
        var status = $(this).parent().children('.am-selected').children('button').children('.am-selected-status');
        $(this).val().length === 0 && status.text(value);
        $(this).val().length === $(this).children().length && status.text(value);
    });
    $(function () {
        selected.trigger('change');
    });
});

$(function () {
    var timebox = $('#report-start-time, #report-end-time');
    timebox.datepicker().on('changeDate.datepicker.amui', function(e) {
        var clearbtn = $(e.target).parent().children('.am-input-group-btn');
        if ($(e.target).val() == '') {
            clearbtn.addClass('am-hide');
            $(this).removeClass('no-border-right');
        } else {
            clearbtn.removeClass('am-hide');
            $(this).addClass('no-border-right');
        }
    });
    var clearbtn = $('#report-start-clear, #report-end-clear');
    clearbtn.click(function () {
        var timebox = $(this).parent().children('.am-form-field');
        timebox.attr('value', '');
        timebox.trigger('changeDate.datepicker.amui');
    });
    $(function () {
        timebox.trigger('changeDate.datepicker.amui');
    });
});

$('a.report-delete').click(function () {
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

$('#report-filter-btn').click(function () {
    $('#report-filter-form').submit();
});