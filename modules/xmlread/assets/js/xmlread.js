$(document).ready(function () {
    var csrfParam = $('meta[name="csrf-param"]').attr("content");
    var csrfToken = $('meta[name="csrf-token"]').attr("content");

    $(document).on('click', '.js-okpd-open', function () {
        $this = $(this);
        kod = $this.data('kod');
        $this.removeClass('js-okpd-open');
        $this.parent().parent().parent().find('.panel-body').addClass('addKod');

        $.ajax({
            url: 'xmlread/default/find-kod',
            type: 'GET',
            data: {csrfParam: csrfToken,
                kod: kod},
            async: false,
            dataType: "html",
            success: function (data) {
                $kod = $('.addKod');
                $kod.append(data);
                $kod.removeClass('addKod');
            }
        });
    });

    $(document).on('click', '.js-onclick-open', function () {
        $this = $(this);
        $this.parent().parent().parent().find('.collapse:first').collapse('toggle');
    });

    $('.js-search').keyup(function () {
        var $this = $(this).val();
        var search = $this.trim();
        $.ajax({
            url: 'xmlread/default/search',
            type: 'GET',
            data: {csrfParam: csrfToken,
                search: search},
            dataType: "html",
            success: function (data) {
                $('#accordion').remove();
                $('.js-search-replace').prepend(data);
                $('.js-onclick-open').each(function (index, el) {
                    var serch = $('.js-search:first').val().trim();
                    var re = new RegExp(serch, "gi");
                    var text = $(this).text();
                    var result = text.replace(re, '<span class="js-text_blue">' + serch + '</span>');
                    $(this).html(result);
                });
            }
        });
    });


});