$(document).ready(function () {
    var csrfParam = $('meta[name="csrf-param"]').attr("content");
    var csrfToken = $('meta[name="csrf-token"]').attr("content");

    $('.js-add-comment').click(function () {
        $('.js-error-comment').hide();
        data = $(this).parents('form').serialize();
        $('.js-comment-text').val($.trim($('.js-comment-text').val()));
        a = $('.js-comment-text').val();
        if ($('.js-comment-text').val() == '') {
            $('.js-error-comment').show();
        } else {
            $.ajax({
                url: 'comment/default/add-comment',
                type: 'POST',
                data: data,
                async: false,
                dataType: "html",
                success: function (data) {
                    $('.js-comment-text').val('');
                    $('#add-comment').after(data);
                }
            });
        }
    });
    $(document).on('click','.js-delete-comment', function () {

        $.ajax({
            url: 'comment/default/delete-comment',
            type: 'POST',
            data: {
                csrfParam: csrfToken,
                id: $(this).parents('.data-id').data('id')
            },
            async: false,
            dataType: "html",
            success: function (data) {
                $('.data-id').each(function(){
                   if($(this).data('id') == data){
                       $(this).remove();
                   } 
                });
            }
        });
    });
    $(document).on('click','.js-edit-comment', function () {
        dataId = $(this).parents('.data-id');
        id = dataId.data('id');
        dataId.addClass('edit');
        $.ajax({
            url: 'comment/default/edit-comment',
            type: 'POST',
            data: {
                csrfParam: csrfToken,
                id: id
            },
            async: false,
            dataType: "html",
            success: function (data) {
                $('.edit').replaceWith(data);               
            }
        });
    });
    $(document).on('click','.js-replace-comment', function () {
        dataId = $(this).parents('.data-id');
        id = dataId.data('id');
        text = dataId.find('.coment-text').val();;
        dataId.addClass('edit');
        $.ajax({
            url: 'comment/default/replace-comment',
            type: 'POST',
            data: {
                csrfParam: csrfToken,
                id: id,
                comments: text
            },
            async: false,
            dataType: "html",
            success: function (data) {
                $('.edit').replaceWith(data);               
            }
        });
    });
    
});