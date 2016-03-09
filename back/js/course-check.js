$('#delete_yes').click(function() {
    $.ajax({
        url: "../course/delete",
        type: "POST",
        data: "value=" + id,
        success: function(result) {
            $('.mask').hide();
            $('.cd-popup-container').hide();
            if (result == 1) {
                alert('删除成功！');
                location.reload();
            } else {
                alert('操作失败！！');
            }
        }
    })
});
$('.check_button').click(function() {
    kid = $(this).data('kid');
    $('.mask').show();
    $('.cd-popup-check').show();
});

$('#check_yes').click(function() {
    var data = {
        'kid':kid,
        'status':2,
    };
    $.ajax({
        url: "../course/change_status",
        type: "POST",
        data: data,
        success: function(result) {
            $('.mask').hide();
            $('.cd-popup-check').hide();
            if (result == 1) {
                alert('审核成功！');
                location.reload();
            } else {
                alert('操作失败！！');
            }
        }
    })
});


$('.mask').click(function() {
    $('.cd-popup-check').hide();
    $('.mask').hide();
});
$('.cd-popup-close').click(function() {
    $('.cd-popup-check').hide();
    $('.mask').hide();
});
$('#check_no').click(function() {
    var data = {
        'kid':kid,
        'status':-1,
    };
    $.ajax({
        url: "../course/change_status",
        type: "POST",
        data: data,
        success: function(result) {
            $('.mask').hide();
            $('.cd-popup-check').hide();
            if (result == 1) {
                alert('审核成功！');
                location.reload();
            } else {
                alert('操作失败！！');
            }
        }
    })
});