$('.delete_button').click(function() {
    id = $(this).data('id');
    $('.mask').show();
    $('.cd-popup-container').show();
});
$('.mask').click(function() {
    $('.cd-popup-container').hide();
    $('.mask').hide();
});
$('.cd-popup-close').click(function() {
    $('.cd-popup-container').hide();
    $('.mask').hide();
});
$('#delete_no').click(function() {
    $('.cd-popup-container').hide();
    $('.mask').hide();
});