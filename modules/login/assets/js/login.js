$(document).ready(function () {
    var csrfParam = $('meta[name="csrf-param"]').attr("content");
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    $('.js-reg').click(function () {
        $.ajax({
            url: '../login/default/registr',
            type: 'POST',
            data: {csrfParam: csrfToken},
            dataType: "html",
            success: function (data) {
                $('.site-login').after(data);
                $('#regUser').modal('show');
                $('#regUser').on('hidden.bs.modal', function () {
                    $('#regUser').remove();
                })
            }
        });
    });

});
