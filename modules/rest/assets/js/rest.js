$(document).ready(function () {
//запрос городов со странами и регионами
    $.ajax({
        url: 'cities',
        type: 'get',
        dataType: "json",
        success: function (data) {
            $.each(data, function (i, v) {
                $html = getHtml(v);
                $('.js-load').append($html);
            });
        }
    });
//запрос стран
    $.ajax({
        url: 'country',
        type: 'get',
        dataType: "json",
        success: function (data) {
            $.each(data, function (i, v) {
                $html = "<option value=" + v.id + ">" + v.name + "</option>";
                $('.js-country-select').append($html);
            });
        }
    });
//запрос регионов
    $.ajax({
        url: 'region',
        type: 'get',
        dataType: "json",
        success: function (data) {
            $.each(data, function (i, v) {
                $html = "<option value=" + v.id + ">" + v.name + "</option>";
                $('.js-region-select').append($html);
            });
        }
    });
//удаление города
    $(document).on('click', '.js-cities-delete', function () {
        $.ajax({
            url: 'cities/' + $(this).closest('.js-index').data('id'),
            type: 'delete',
            dataType: "json",
            success: function (data) {
                if (data) {
                    $('.js-index').each(function () {
                        if ($(this).data('id') == data) {
                            $(this).remove();
                        }
                    });
                }
            }
        });
    });
//добавление города
    $(document).on('click', '.js-cities-created', function () {
        $('.js-cities-created-input').val($.trim($('.js-cities-created-input').val()));
        if ($('.js-cities-created-input').val() != '') {
            $.ajax({
                url: 'cities',
                type: 'post',
                data: {
                    name: $('.js-cities-created-input').val(),
                    id_country: $('.js-country-select:first').val(),
                    id_region: $('.js-region-select:first').val()
                },
                dataType: "json",
                success: function (data) {
                    $('.js-cities-created-input').val('');
                    if (data) {
                        $html = getHtml(data);
                        $('.js-index:first').after($html);
                        $('.js-index[data-id=' + data.id + ']').addClass('js-background-created');
                        $('.js-background-created').animate({backgroundColor: '#fff'}, 1000);
                    }
                }
            });
        }
    });
//редактирование города
    $(document).on('click', '.js-cities-update', function () {
        $this = $(this).closest('.js-index');
        $cities = $this.find('.js-cities-update-input');
        $cities.html("Город: <input type='text' class='js-update-cities-val'>");
        $cities.find('.js-update-cities-val').val($cities.data('name'));
        $country = $this.find('.js-country-update-input').html($('.js-index:first').find('.js-country-select').clone()).prepend('Страна: ');
        $region = $this.find('.js-region-update-input').html($('.js-index:first').find('.js-region-select').clone()).prepend('Регион: ');
        $this.append("<br><button class='js-update-save'>Изменить</button>");
        $('.js-update-save').click(function () {
            $.ajax({
                url: 'cities/' + $this.data('id'),
                type: 'put',
                data: {
                    name: $this.find('.js-update-cities-val').val(),
                    id_country: $this.find('.js-country-select').val(),
                    id_region: $this.find('.js-region-select').val()
                },
                dataType: "json",
                success: function (data) {
                    if (data) {
                        $html = getHtml(data);
                        $('.js-index[data-id=' + data.id + ']').replaceWith($html);
                    } else {
                        $this = $('.js-index[data-id=' + data.id + ']');
                        $this.css({backgroundColor: '#800000'});
                        $this.animate({backgroundColor: '#fff'}, 1000);
                    }
                },
                error: function () {
                    $this.css({backgroundColor: '#800000'});
                    $this.animate({backgroundColor: '#fff'}, 1000);
                }
            });
        });
    });
});
function getHtml(data) {
    return "<div class='js-index rest-border' data-id='" + data.id + "'>\n\
                <span class='js-cities-update typo-link'>Изменить</span>\n\
                <span class='js-cities-delete typo-link'>Удалить</span><br>\n\
                <label class='js-cities-update-input' data-name=" + data.name + ">Город: " + data.name + "</label><br>\n\
                <label class='js-country-update-input' data-country=" + data.country + "> Страна: " + data.country + "</label><br>\n\
                <label class='js-region-update-input' data-region=" + data.region + "> Регион: " + data.region + "</label>\n\
                </div>";
}