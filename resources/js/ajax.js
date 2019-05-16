$(document).ready(function () {
    if ($('#add-new-lead-form').length) {
        $('#add-new-lead').click(function () {
            let form = $('#add-new-lead-form').ajaxSubmit();
            let xhr = form.data('jqxhr');
            xhr.done(function (data) {
                new PNotify({
                    title: 'Выполнено',
                    text: data.message,
                    type: 'success',
                    styling: 'bootstrap3'
                });
                $('#add-new-lead-form').trigger('reset');

            });
            xhr.fail(function (data) {
                new PNotify({
                    title: 'Ошибка',
                    text: parseErrors(data),
                    type: 'error',
                    styling: 'bootstrap3'
                })

            });
        })
    }
});

if ($('#transactions-pyramid-real-estate').length) {
    let transactionPyramidAuto = echarts.init(document.getElementById('transactions-pyramid-auto'), theme);
    $(document).ready(function () {
        let url = "pyramid/transactions_auto";
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name=_token]').attr('content')
            }
        });
        $.ajax({
            url: url,
            type: 'GET',
            success: function (data) {
                transactionPyramidAuto.setOption(
                    {
                        tooltip: {
                            trigger: 'item',
                            formatter: "{b} : {c}%"
                        },
                        toolbox: {
                            show: true,
                            feature: {
                                saveAsImage: {
                                    show: true,
                                    title: "Save Image"
                                }
                            }
                        },
                        legend: {
                            data: data,
                            orient: 'vertical',
                            x: 'left',
                            y: 'bottom'
                        },
                        calculable: true,
                        series: [{
                            type: 'funnel',
                            width: '45%',
                            data: data

                        }]
                    });
            },
        });
    });
}
if ($('#transactions-pyramid-real-estate').length) {
    let transactionPyramidRealEstate = echarts.init(document.getElementById('transactions-pyramid-real-estate'), theme);
    $(document).ready(function () {
        let url = "pyramid/transactions_real_estate";
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name=_token]').attr('content')
            }
        });
        $.ajax({
            url: url,
            type: 'GET',
            success: function (data) {
                transactionPyramidRealEstate.setOption(
                    {
                        tooltip: {
                            trigger: 'item',
                            formatter: "{b} : {c}%"
                        },
                        toolbox: {
                            show: true,
                            feature: {
                                saveAsImage: {
                                    show: true,
                                    title: "Save Image"
                                }
                            }
                        },
                        legend: {
                            data: data,
                            orient: 'vertical',
                            x: 'left',
                            y: 'bottom'
                        },
                        calculable: true,
                        series: [{
                            type: 'funnel',
                            width: '45%',
                            data: data

                        }]
                    });
            },
        });
    });
}

$('input[name="changedatetimes"]').on('apply.daterangepicker', function (ev, picker) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: change_reception,
        data: {id: select_id, time: $(this).val()},
        dataType: 'json',
        success: function (data) {
            new PNotify({
                title: 'Успех',
                text: 'Встреча назначена',
                type: 'success',
                styling: 'bootstrap3'
            })
        },
        error: function (data) {
            var response = $.parseJSON(data.responseText);
            new PNotify({
                title: 'Ошибка',
                text: '',
                type: 'error',
                styling: 'bootstrap3'
            })
        }
    });
});
if ($('#issue-or-sign-table').length) {

    $('.modal-yes-signed').click(function () {
        $('.yes-signed').data('id', this.dataset.id);
        $('.customer-waiver').data('id', this.dataset.id);
    });
    $('.yes-signed').click(
        function () {
            let id = $('.yes-signed').data('id'),
                signed = $('.yes-signed').data('signed'),
                url = 'transaction/' + id + '/updateStatus',
                status = $('.yes-signed').data('status_id');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name=_token]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    signed: signed,
                    status_id: status
                },
                success: function success(data) {
                    let item = $('#transactionId-' + data.id).find('.modal-yes-signed');
                    item.attr('href', '#give-modal');
                    item.removeClass('modal-yes-signed').addClass('modal-yes-gave');
                    item.text('Выдать');

                    $('.yes-gave').data('id', data.id);
                    new PNotify({
                        title: 'Успех',
                        text: data.message,
                        type: 'success',
                        styling: 'bootstrap3'
                    });
                }
            });
        }
    );
    $(document).on('click', ".modal-yes-gave", function () {
        $('.yes-gave').data('id', this.dataset.id);
        $('.customer-waiver').data('id', this.dataset.id);
    });

    $('.yes-gave').click(
        function () {
            let id = $('.yes-gave').data('id'),
                gave_money = $('.yes-gave').data('gave_money'),
                url = 'transaction/' + id + '/updateStatus',
                status = $('.yes-gave').data('status_id');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name=_token]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    gave_money: gave_money,
                    status_id: status
                },
                success: function success(data) {
                    let item = $('#transactionId-' + data.id).find('.modal-yes-gave');
                    item.parent().parent().remove();
                    new PNotify({
                        title: 'Успех',
                        text: data.message,
                        type: 'success',
                        styling: 'bootstrap3'
                    });
                }
            });
        }
    );

    $('.client-waiver-save').click(
        function () {
            let url = 'transaction/' + $('.customer-waiver').data('id') + '/updateStatus';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name=_token]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type: 'POST',
                data: $('.client-waiver').serialize(),
                success: function success(data) {
                    $('#transactionId-' + data.id).remove();
                    $('.modal').modal('hide');
                    new PNotify({
                        title: 'Успех',
                        text: data.message,
                        type: 'success',
                        styling: 'bootstrap3'
                    });
                }
            });
        }
    );
}

if ($('.accordion-buttons').length) {
    $(document).on('click', '.accordion-button-change', function () {
        let buttons = $(this).parent();
        buttons.children('.accordion-button-change').addClass('hidden');
        buttons.children('.accordion-button-destroy').addClass('hidden');
        buttons.children('.accordion-button-cancel').removeClass('hidden');
        buttons.children('.accordion-button-save').removeClass('hidden');

        buttons.parent().children('form').children('input').removeAttr('readonly')
    });
    $(document).on('click', '.accordion-button-cancel', function () {
        let buttons = $(this).parent();
        buttons.children('.accordion-button-change').removeClass('hidden');
        buttons.children('.accordion-button-destroy').removeClass('hidden');
        buttons.children('.accordion-button-cancel').addClass('hidden');
        buttons.children('.accordion-button-save').addClass('hidden');
        buttons.parent().children('form').children('input').attr('readonly', true)
    });
    $(document).on('click', '.accordion-button-destroy', function () {
        if (confirm('Удалить ?')) {
            let form = $(this).parent().parent().children('form');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name=_token]').attr('content')
                }
            });
            $.ajax({
                url: '/transaction_description/' + $(form).data('id'),
                type: 'DELETE',
                data: form.serialize(),
                success: function success(data) {
                    $('#panel-id-' + data.id).remove();
                    new PNotify({
                        title: 'Вы удалили',
                        text: data.destroy,
                        type: 'error',
                        styling: 'bootstrap3'
                    });
                },
                error: function (data) {
                    let response = $.parseJSON(data.responseText);
                    new PNotify({
                        title: 'Ошибка',
                        text: '',
                        type: 'error',
                        styling: 'bootstrap3'
                    })
                }
            });
        }
    });
    $(document).on('click', '.accordion-button-save', function () {
        let form = $(this).parent().parent().children('form'),
            buttons = $(this).parent();
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name=_token]').attr('content')
            }
        });
        $.ajax({
            url: '/transaction_description/' + $(form).data('id'),
            type: 'PUT',
            data: form.serialize(),
            success: function success(data) {
                buttons.children('.accordion-button-change').removeClass('hidden');
                buttons.children('.accordion-button-destroy').removeClass('hidden');
                buttons.children('.accordion-button-cancel').addClass('hidden');
                buttons.children('.accordion-button-save').addClass('hidden');
                buttons.parent().children('form').children('input').attr('readonly', true);
                new PNotify({
                    title: 'Вы обновили',
                    text: data.update,
                    type: 'success',
                    styling: 'bootstrap3'
                });
            },
            error: function (data) {
                new PNotify({
                    title: 'Ошибка',
                    text: parseErrors(data),
                    type: 'error',
                    styling: 'bootstrap3'
                })
            }
        });

    })
}


if ($('.add-transaction-description-form').length) {
    $('.send-form-transaction-description').on('click',
        function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name=_token]').attr('content')
                }
            });
            $.ajax({
                url: '/transaction_description',
                type: 'POST',
                data: $('#add-transaction-description-form-' + this.dataset.form_id).serialize(),
                success: function success(data) {
                    addDescription(data.add, data.td);
                    $('.modal').modal('hide');
                    new PNotify({
                        title: 'Вы добавили',
                        text: data.add,
                        type: 'success',
                        styling: 'bootstrap3'
                    });
                },
                error: function (data) {
                    let response = $.parseJSON(data.responseText);
                    new PNotify({
                        title: 'Ошибка',
                        text: '',
                        type: 'error',
                        styling: 'bootstrap3'
                    })
                }
            });
        }
    );
}

function addDescription(add, td) {
    if (add == 'Автомобиль на стоянке') {
        $('.accordion-transaction-description')
            .append(
                '<div class="panel" id="panel-id-' + td.id + '">\n' +
                '                        <a class="panel-heading collapsed" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapse-' + td.id + '" aria-expanded="false" aria-controls="collapseOne">\n' +
                '                            <h4 class="panel-title">' + td.deposit.name + '</h4>\n' +
                '                        </a>\n' +
                '                        <div id="collapse-' + td.id + '" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">\n' +
                '                            <div class="panel-body">\n' +
                '                                <form data-id="' + td.id + '" class="add-transaction-description-form" method="POST">\n' +

                '                                    <label for="VIN">VIN</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="VIN" id="VIN" value="' + (td.VIN || '') + '">\n' +
                '\n' +
                '                                    <label for="model_ts">Марка, модель ТС</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="model_ts" id="model_ts" value="' + (td.model_ts || '') + '">\n' +
                '\n' +
                '                                    <label for="object">Объект</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="object" id="object" value="' + (td.object || '') + '">\n' +
                '\n' +
                '                                    <label for="year_of_manufacture">Год изготовления ТС</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="year_of_manufacture" id="year_of_manufacture" value="' + (td.year_of_manufacture || '') + '">\n' +
                '\n' +
                '                                    <label for="engine_number">Номер двигателя</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="engine_number" id="engine_number" value="' + (td.engine_number || '') + '">\n' +
                '\n' +
                '                                    <label for="bodywork_number">Номер кузова</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="bodywork_number" id="bodywork_number" value="' + (td.bodywork_number || '') + '">\n' +
                '\n' +
                '                                    <label for="color">Цвет</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="color" id="color" value="' + (td.color || '') + '">\n' +
                '\n' +
                '                                    <label for="pts_series">ПТС серия</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="pts_series" id="pts_series" value="' + (td.pts_series || '') + '">\n' +
                '\n' +
                '                                    <label for="pts_number">ПТС номер</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="pts_number" id="pts_number" value="' + (td.pts_number || '') + '">\n' +
                '\n' +
                '                                    <label for="pts_issued">ПТС кем выдан</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="pts_issued" id="pts_issued" value="' + (td.pts_issued || '') + '">\n' +
                '\n' +
                '                                    <label for="pts_date_issued">ПТС дата выдачи</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="pts_date_issued" id="pts_date_issued" value="' + (td.pts_date_issued || '') + '">\n' +
                '\n' +
                '                                    <label for="state_number">Госномер ТС</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="state_number" id="state_number" value="' + (td.state_number || '') + '">\n' +
                '                                </form>\n' +
                '                                <div class="x_content accordion-buttons">\n' +
                '                                    <button type="button" class="btn btn-primary accordion-button-change">Изменить</button>\n' +
                '                                    <button type="button" class="btn btn-danger accordion-button-destroy">Удалить</button>\n' +
                '                                    <button type="button" class="btn btn-default accordion-button-cancel hidden">Отмена</button>\n' +
                '                                    <button type="button" class="btn btn-success accordion-button-save hidden">Сохранить</button>\n' +
                '                                </div>\n' +
                '                            </div>\n' +
                '                        </div>\n' +
                '                    </div>'
            );
    } else if (add == 'ПТС') {
        $('.accordion-transaction-description')
            .append(
                '<div class="panel" id="panel-id-' + td.id + '">\n' +
                '                        <a class="panel-heading collapsed" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapse-' + td.id + '" aria-expanded="false" aria-controls="collapseOne">\n' +
                '                            <h4 class="panel-title">' + td.deposit.name + '</h4>\n' +
                '                        </a>\n' +
                '                        <div id="collapse-' + td.id + '" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">\n' +
                '                            <div class="panel-body">\n' +
                '                                <form data-id="' + td.id + '" class="add-transaction-description-form" method="POST">\n' +

                '                                    <label for="VIN">VIN</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="VIN" id="VIN" value="' + (td.VIN || '') + '">\n' +
                '\n' +
                '                                    <label for="model_ts">Марка, модель ТС</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="model_ts" id="model_ts" value="' + (td.model_ts || '') + '">\n' +
                '\n' +
                '                                    <label for="object">Объект</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="object" id="object" value="' + (td.object || '') + '">\n' +
                '\n' +
                '                                    <label for="year_of_manufacture">Год изготовления ТС</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="year_of_manufacture" id="year_of_manufacture" value="' + (td.year_of_manufacture || '') + '">\n' +
                '\n' +
                '                                    <label for="engine_number">Номер двигателя</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="engine_number" id="engine_number" value="' + (td.engine_number || '') + '">\n' +
                '\n' +
                '                                    <label for="bodywork_number">Номер кузова</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="bodywork_number" id="bodywork_number" value="' + (td.bodywork_number || '') + '">\n' +
                '\n' +
                '                                    <label for="color">Цвет</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="color" id="color" value="' + (td.color || '') + '">\n' +
                '\n' +
                '                                    <label for="pts_series">ПТС серия</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="pts_series" id="pts_series" value="' + (td.pts_series || '') + '">\n' +
                '\n' +
                '                                    <label for="pts_number">ПТС номер</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="pts_number" id="pts_number" value="' + (td.pts_number || '') + '">\n' +
                '\n' +
                '                                    <label for="pts_issued">ПТС кем выдан</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="pts_issued" id="pts_issued" value="' + (td.pts_issued || '') + '">\n' +
                '\n' +
                '                                    <label for="pts_date_issued">ПТС дата выдачи</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="pts_date_issued" id="pts_date_issued" value="' + (td.pts_date_issued || '') + '">\n' +
                '\n' +
                '                                    <label for="state_number">Госномер ТС</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="state_number" id="state_number" value="' + (td.state_number || '') + '">\n' +
                '                                </form>\n' +
                '                                <div class="x_content accordion-buttons">\n' +
                '                                    <button type="button" class="btn btn-primary accordion-button-change">Изменить</button>\n' +
                '                                    <button type="button" class="btn btn-danger accordion-button-destroy">Удалить</button>\n' +
                '                                    <button type="button" class="btn btn-default accordion-button-cancel hidden">Отмена</button>\n' +
                '                                    <button type="button" class="btn btn-success accordion-button-save hidden">Сохранить</button>\n' +
                '                                </div>\n' +
                '                            </div>\n' +
                '                        </div>\n' +
                '                    </div>'
            )
    } else if (add == 'Земля') {
        $('.accordion-transaction-description')
            .append(
                '<div class="panel" id="panel-id-' + td.id + '">\n' +
                '                        <a class="panel-heading collapsed" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapse-' + td.id + '" aria-expanded="false" aria-controls="collapseOne">\n' +
                '                            <h4 class="panel-title">' + td.deposit.name + '</h4>\n' +
                '                        </a>\n' +
                '                        <div id="collapse-' + td.id + '" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">\n' +
                '                            <div class="panel-body">\n' +
                '                                <form data-id="' + td.id + '" class="add-transaction-description-form" method="POST">\n' +

                '                                    <label for="price_market">Цена по рынку, руб.</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="price_market" id="price_market" value=" ' + (td.price_market || '') + '">\n' +
                '\n' +
                '                                    <label for="evaluative_price">Наша оценка, руб.</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="evaluative_price" id="evaluative_price" value=" ' + (td.evaluative_price || '') + '">\n' +
                '\n' +
                '                                    <label for="appointment">Назначение</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="appointment" id="appointment" value=" ' + (td.appointment || '') + '">\n' +
                '\n' +
                '                                    <label for="area">Общая площадь, кв.м</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="area" id="area" value=" ' + (td.area || '') + '">\n' +
                '\n' +
                '                                    <label for="address">Адрес расположения объекта</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="address" id="address" value=" ' + (td.address || '') + '">\n' +
                '\n' +
                '                                    <label for="basis">Основание владения объектом (род.падеж)</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="basis" id="basis" value=" ' + (td.basis || '') + '">\n' +
                '\n' +
                '                                    <label for="cadastral_number">Кадастровый или условный номер</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="cadastral_number" id="cadastral_number" value=" ' + (td.cadastral_number || '') + '">\n' +
                '\n' +
                '                                    <label for="ownership_documents">Документ, подтверждающий право собственности</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="ownership_documents" id="ownership_documents" value=" ' + (td.ownership_documents || '') + '">\n' +
                '\n' +
                '                                    <label for="number_ownership_documents">Серия и номер документа, подтверждающего право собственности</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="number_ownership_documents" id="number_ownership_documents" value=" ' + (td.number_ownership_documents || '') + '">\n' +
                '\n' +
                '                                    <label for="date_ownership_documents">Дата выдачи документа, подтверждающего право собственности</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="date_ownership_documents" id="date_ownership_documents" value=" ' + (td.date_ownership_documents || '') + '">\n' +
                '\n' +
                '                                    <label for="ownership_documents_issued">Кем выдан документ</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="ownership_documents_issued" id="ownership_documents_issued" value=" ' + (td.ownership_documents_issued || '') + '">\n' +
                '\n' +
                '                                    <label for="restriction">Наличие ограничений или обременений</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="restriction" id="restriction" value=" ' + (td.restriction || '') + '">\n' +
                '                                </form>\n' +
                '                                <div class="x_content accordion-buttons">\n' +
                '                                    <button type="button" class="btn btn-primary accordion-button-change">Изменить</button>\n' +
                '                                    <button type="button" class="btn btn-danger accordion-button-destroy">Удалить</button>\n' +
                '                                    <button type="button" class="btn btn-default accordion-button-cancel hidden">Отмена</button>\n' +
                '                                    <button type="button" class="btn btn-success accordion-button-save hidden">Сохранить</button>\n' +
                '                                </div>\n' +
                '                            </div>\n' +
                '                        </div>\n' +
                '                    </div>'
            )
    } else if (add == 'Квартира') {
        $('.accordion-transaction-description')
            .append(
                '<div class="panel" id="panel-id-' + td.id + '">\n' +
                '                        <a class="panel-heading collapsed" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapse-' + td.id + '" aria-expanded="false" aria-controls="collapseOne">\n' +
                '                            <h4 class="panel-title">' + td.deposit.name + '</h4>\n' +
                '                        </a>\n' +
                '                        <div id="collapse-' + td.id + '" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">\n' +
                '                            <div class="panel-body">\n' +
                '                                <form data-id="' + td.id + '" class="add-transaction-description-form" method="POST">\n' +

                '                                    <label for="price_market">Цена по рынку, руб.</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="price_market" id="price_market" value="' + (td.price_market || '') + '">\n' +
                '\n' +
                '                                    <label for="evaluative_price">Наша оценка, руб.</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="evaluative_price" id="evaluative_price" value="' + (td.evaluative_price || '') + '">\n' +
                '\n' +
                '                                    <label for="appointment">Назначение</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="appointment" id="appointment" value="' + (td.appointment || '') + '">\n' +
                '\n' +
                '                                    <label for="area">Общая площадь, кв.м</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="area" id="area" value="' + (td.area || '') + '">\n' +
                '\n' +
                '                                    <label for="floor">Этаж</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="floor" id="floor" value="' + (td.floor || '') + '">\n' +
                '\n' +
                '                                    <label for="address">Адрес расположения объекта</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="address" id="address" value="' + (td.address || '') + '">\n' +
                '\n' +
                '                                    <label for="basis">Основание владения объектом (род.падеж)</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="basis" id="basis" value="' + (td.basis || '') + '">\n' +
                '\n' +
                '                                    <label for="cadastral_number">Кадастровый или условный номер</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="cadastral_number" id="cadastral_number" value="' + (td.cadastral_number || '') + '">\n' +
                '\n' +
                '                                    <label for="ownership_documents">Документ, подтверждающий право собственности</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="ownership_documents" id="ownership_documents" value="' + (td.ownership_documents || '') + '">\n' +
                '\n' +
                '                                    <label for="number_ownership_documents">Серия и номер документа, подтверждающего право собственности</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="number_ownership_documents" id="number_ownership_documents" value="' + (td.number_ownership_documents || '') + '">\n' +
                '\n' +
                '                                    <label for="date_ownership_documents">Дата выдачи документа, подтверждающего право собственности</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="date_ownership_documents" id="date_ownership_documents" value="' + (td.date_ownership_documents || '') + '">\n' +
                '\n' +
                '                                    <label for="ownership_documents_issued">Кем выдан документ</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="ownership_documents_issued" id="ownership_documents_issued" value="' + (td.ownership_documents_issued || '') + '">\n' +
                '\n' +
                '                                    <label for="restriction">Наличие ограничений или обременений</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="restriction" id="restriction" value="' + (td.restriction || '') + '">\n' +
                '                                </form>\n' +
                '                                <div class="x_content accordion-buttons">\n' +
                '                                    <button type="button" class="btn btn-primary accordion-button-change">Изменить</button>\n' +
                '                                    <button type="button" class="btn btn-danger accordion-button-destroy">Удалить</button>\n' +
                '                                    <button type="button" class="btn btn-default accordion-button-cancel hidden">Отмена</button>\n' +
                '                                    <button type="button" class="btn btn-success accordion-button-save hidden">Сохранить</button>\n' +
                '                                </div>\n' +
                '                            </div>\n' +
                '                        </div>\n' +
                '                    </div>'
            )
    } else if (add == 'Дом') {
        $('.accordion-transaction-description')
            .append(
                '<div class="panel" id="panel-id-' + td.id + '">\n' +
                '                        <a class="panel-heading collapsed" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapse-' + td.id + '" aria-expanded="false" aria-controls="collapseOne">\n' +
                '                            <h4 class="panel-title">' + td.deposit.name + '</h4>\n' +
                '                        </a>\n' +
                '                        <div id="collapse-' + td.id + '" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">\n' +
                '                            <div class="panel-body">\n' +
                '                                <form data-id="' + td.id + '" class="add-transaction-description-form" method="POST">\n' +

                '                                    <label for="price_market">Цена по рынку, руб.</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="price_market" id="price_market" value="' + (td.price_market || '') + '">\n' +
                '\n' +
                '                                    <label for="evaluative_price">Наша оценка, руб.</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="evaluative_price" id="evaluative_price" value="' + (td.evaluative_price || '') + '">\n' +
                '\n' +
                '                                    <label for="appointment">Назначение</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="appointment" id="appointment" value="' + (td.appointment || '') + '">\n' +
                '\n' +
                '                                    <label for="area">Общая площадь, кв.м</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="area" id="area" value="' + (td.area || '') + '">\n' +
                '\n' +
                '                                    <label for="floors_count">Этажей</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="floors_count" id="floors_count" value="' + (td.floors_count || '') + '">\n' +
                '\n' +
                '                                    <label for="address">Адрес расположения объекта</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="address" id="address" value="' + (td.address || '') + '">\n' +
                '\n' +
                '                                    <label for="basis">Основание владения объектом (род.падеж)</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="basis" id="basis" value="' + (td.basis || '') + '">\n' +
                '\n' +
                '                                    <label for="cadastral_number">Кадастровый или условный номер</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="cadastral_number" id="cadastral_number" value="' + (td.cadastral_number || '') + '">\n' +
                '\n' +
                '                                    <label for="ownership_documents">Документ, подтверждающий право собственности</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="ownership_documents" id="ownership_documents" value="' + (td.ownership_documents || '') + '">\n' +
                '\n' +
                '                                    <label for="number_ownership_documents">Серия и номер документа, подтверждающего право собственности</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="number_ownership_documents" id="number_ownership_documents" value="' + (td.number_ownership_documents || '') + '">\n' +
                '\n' +
                '                                    <label for="date_ownership_documents">Дата выдачи документа, подтверждающего право собственности</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="date_ownership_documents" id="date_ownership_documents" value="' + (td.date_ownership_documents || '') + '">\n' +
                '\n' +
                '                                    <label for="ownership_documents_issued">Кем выдан документ</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="ownership_documents_issued" id="ownership_documents_issued" value="' + (td.ownership_documents_issued || '') + '">\n' +
                '\n' +
                '                                    <label for="restriction">Наличие ограничений или обременений</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="restriction" id="restriction" value="' + (td.restriction || '') + '">\n' +
                '                                </form>\n' +
                '                                <div class="x_content accordion-buttons">\n' +
                '                                    <button type="button" class="btn btn-primary accordion-button-change">Изменить</button>\n' +
                '                                    <button type="button" class="btn btn-danger accordion-button-destroy">Удалить</button>\n' +
                '                                    <button type="button" class="btn btn-default accordion-button-cancel hidden">Отмена</button>\n' +
                '                                    <button type="button" class="btn btn-success accordion-button-save hidden">Сохранить</button>\n' +
                '                                </div>\n' +
                '                            </div>\n' +
                '                        </div>\n' +
                '                    </div>'
            )
    } else if (add == 'Поручитель') {
        $('.accordion-transaction-description')
            .append(
                '<div class="panel" id="panel-id-' + td.id + '">\n' +
                '                        <a class="panel-heading collapsed" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapse-' + td.id + '" aria-expanded="false" aria-controls="collapseOne">\n' +
                '                            <h4 class="panel-title">' + td.deposit.name + '</h4>\n' +
                '                        </a>\n' +
                '                        <div id="collapse-' + td.id + '" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">\n' +
                '                            <div class="panel-body">\n' +
                '                                <form data-id="' + td.id + '" class="add-transaction-description-form" method="POST">\n' +

                '                                    <label for="fio">ФИО</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="fio" id="fio" value="' + (td.fio || '') + '">\n' +
                '\n' +
                '                                    <label for="phone">Телефон</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="phone" id="phone" value="' + (td.phone || '') + '">\n' +
                '\n' +
                '                                    <label for="series">Серия</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="series" id="series" value="' + (td.series || '') + '">\n' +
                '\n' +
                '                                    <label for="number">Номер</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="number" id="number" value="' + (td.number || '') + '">\n' +
                '\n' +
                '                                    <label for="birthdate">Дата рождения</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="birthdate" id="birthdate" value="' + (td.birthdate || '') + '">\n' +
                '\n' +
                '                                    <label for="place_of_birth">Место рождения</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="place_of_birth" id="place_of_birth" value="' + (td.place_of_birth || '') + '">\n' +
                '\n' +
                '                                    <label for="issued">Кем выдан</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="issued" id="issued" value="' + (td.issued || '') + '">\n' +
                '\n' +
                '                                    <label for="when_issued">Когда выдан</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="when_issued" id="when_issued" value="' + (td.when_issued || '') + '">\n' +
                '\n' +
                '                                    <label for="department_code">Код подразделения</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="department_code" id="department_code" value="' + (td.department_code || '') + '">\n' +
                '\n' +
                '                                    <label for="registration_address">Адрес регистрации</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="registration_address" id="registration_address" value="' + (td.registration_address || '') + '">\n' +
                '                                </form>\n' +
                '                                <div class="x_content accordion-buttons">\n' +
                '                                    <button type="button" class="btn btn-primary accordion-button-change">Изменить</button>\n' +
                '                                    <button type="button" class="btn btn-danger accordion-button-destroy">Удалить</button>\n' +
                '                                    <button type="button" class="btn btn-default accordion-button-cancel hidden">Отмена</button>\n' +
                '                                    <button type="button" class="btn btn-success accordion-button-save hidden">Сохранить</button>\n' +
                '                                </div>\n' +
                '                            </div>\n' +
                '                        </div>\n' +
                '                    </div>'
            )
    } else if (add == 'Заёмщик юридическое лицо') {
        $('.accordion-transaction-description')
            .append(
                '<div class="panel" id="panel-id-' + td.id + '">\n' +
                '                        <a class="panel-heading collapsed" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapse-' + td.id + '" aria-expanded="false" aria-controls="collapseOne">\n' +
                '                            <h4 class="panel-title">' + td.deposit.name + '</h4>\n' +
                '                        </a>\n' +
                '                        <div id="collapse-' + td.id + '" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">\n' +
                '                            <div class="panel-body">\n' +
                '                                <form data-id="' + td.id + '" class="add-transaction-description-form" method="POST">\n' +

                '                                    <label for="legal_entity_name">Наименование юр.лица</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="legal_entity_name" id="legal_entity_name" value="' + (td.legal_entity_name || '') + '">\n' +
                '\n' +
                '                                    <label for="short_name">Сокращенно</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="short_name" id="short_name" value="' + (td.short_name || '') + '">\n' +
                '\n' +
                '                                    <label for="legal_address">Юридический адрес</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="legal_address" id="legal_address" value="' + (td.legal_address || '') + '">\n' +
                '\n' +
                '                                    <label for="ogrn">ОГРН</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="ogrn" id="ogrn" value="' + (td.ogrn || '') + '">\n' +
                '\n' +
                '                                    <label for="inn">ИНН</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="inn" id="inn" value="' + (td.inn || '') + '">\n' +
                '\n' +
                '                                    <label for="kpp">КПП</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="kpp" id="kpp" value="' + (td.kpp || '') + '">\n' +
                '\n' +
                '                                    <label for="position_of_representative">Должнасть представителя</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="position_of_representative" id="position_of_representative" value="' + (td.position_of_representative || '') + '">\n' +
                '\n' +
                '                                    <label for="basis_of_authority">Основание полномочий</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="basis_of_authority" id="basis_of_authority" value="' + (td.basis_of_authority || '') + '">\n' +
                '\n' +
                '                                    <label for="correspondent_account">Корр. счет</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="correspondent_account" id="correspondent_account" value="' + (td.correspondent_account || '') + '">\n' +
                '\n' +
                '                                    <label for="bik">БИК</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="bik" id="bik" value="' + (td.bik || '') + '">\n' +
                '\n' +
                '                                    <label for="bank">Банк</label>\n' +
                '                                    <input type="text" readonly  class="form-control" name="bank" id="bank" value="' + (td.bank || '') + '">\n' +
                '                                </form>\n' +
                '                                <div class="x_content accordion-buttons">\n' +
                '                                    <button type="button" class="btn btn-primary accordion-button-change">Изменить</button>\n' +
                '                                    <button type="button" class="btn btn-danger accordion-button-destroy">Удалить</button>\n' +
                '                                    <button type="button" class="btn btn-default accordion-button-cancel hidden">Отмена</button>\n' +
                '                                    <button type="button" class="btn btn-success accordion-button-save hidden">Сохранить</button>\n' +
                '                                </div>\n' +
                '                            </div>\n' +
                '                        </div>\n' +
                '                    </div>'
            )
    }
}

if ($('#change-avatar-button').length) {
    $(document).on('click', '#change-avatar-button', function () {
        let form_data = new FormData();
        let avatar = $("#avatar-file").prop('files')[0];

        form_data.append('avatar', avatar);
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name=_token]').attr('content')
            }
        });
        $.ajax({
            url: $("#change-avatar-form").attr('action'),
            data: form_data,
            type: 'POST',
            contentType: false,
            cache: false,
            processData: false,

            success: function (data) {
                new PNotify({
                    title: 'Успех',
                    text: 'Фотография обновлена',
                    type: 'success',
                    styling: 'bootstrap3'
                });
                $(".user-avatar").each(function () {
                    this.src = data.src
                });
                $('.close').click();
            },
            error: function (data) {
                new PNotify({
                    title: 'Ошибка',
                    text: parseErrors(data),
                    type: 'error',
                    styling: 'bootstrap3'
                })
            }
        });
    });
}
if ($('.update-profile-data-buttons').length) {
    $(document).on('click', '#edit', function () {
        $('#edit').addClass('hidden');
        $('#cancel').removeClass('hidden');
        $('#save').removeClass('hidden');
        let form = $(this).parent().parent().parent();
        form.children('div').children('div').children('input').removeAttr('readonly')
    });
    $(document).on('click', '#cancel', function () {
        $('#edit').removeClass('hidden');
        $('#cancel').addClass('hidden');
        $('#save').addClass('hidden');
        let form = $(this).parent().parent().parent();
        form.children('div').children('div').children('input').attr('readonly', true)
    });
    $(document).on('click', '#save', function () {
        let form = $(this).parent().parent().parent();
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name=_token]').attr('content')
            }
        });
        $.ajax({
            url: '/profile/update',
            type: 'PUT',
            data: form.serialize(),
            success: function success(data) {
                $('.user-name').text(data.first_name);
                form.children('div').children('div').children('input').attr('readonly', true);
                $('#edit').removeClass('hidden');
                $('#cancel').addClass('hidden');
                $('#save').addClass('hidden');
                new PNotify({
                    title: 'Успех',
                    text: 'Профиль успешно обновлен',
                    type: 'success',
                    styling: 'bootstrap3'
                });
            },
            error: function (data) {
                new PNotify({
                    title: 'Ошибка',
                    text: parseErrors(data),
                    type: 'error',
                    styling: 'bootstrap3'
                })
            }
        });
    })
}

function parseErrors(data) {
    let response = $.parseJSON(data.responseText);
    let ul = '<ul>';
    for (i in response.errors) {
        ul += '<li>' + response.errors[i][0] + '</li>'
    }
    ul += '</ul>';
    return ul
}
