$(document).ready(function () {
    var csrfParam = $('meta[name="csrf-param"]').attr("content");
    var csrfToken = $('meta[name="csrf-token"]').attr("content");

    $('.js-check-brackets').click(function () {
        data = $(this).parents('form').serialize();
        $.ajax({
            url: 'brackets/default/check-brackets',
            type: 'POST',
            data: data,
            dataType: "html",
            success: function (data) {
                if (data === '1') {
                    $('.js-check-brackets').addClass('btn-success').removeClass('btn-danger').text('Правильно!');
                } else {
                    $('.js-check-brackets').addClass('btn-danger').removeClass('btn-success').text('Не правильно!');
                }

            }
        });
    });
    $('.js-brackets-text').keyup(function(){
        $('.js-check-brackets').click();
    });
});