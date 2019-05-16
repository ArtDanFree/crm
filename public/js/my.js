$(document).ready(function () {
  if ($('#add-new-lead-form').length) {
    $('#add-new-lead').click(function () {
      var form = $('#add-new-lead-form').ajaxSubmit();
      var xhr = form.data('jqxhr');
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
        });
      });
    });
  }
});

if ($('#transactions-pyramid-real-estate').length) {
  var transactionPyramidAuto = echarts.init(document.getElementById('transactions-pyramid-auto'), theme);
  $(document).ready(function () {
    var url = "pyramid/transactions_auto";
    $.ajaxSetup({
      headers: {
        'X-CSRF-Token': $('meta[name=_token]').attr('content')
      }
    });
    $.ajax({
      url: url,
      type: 'GET',
      success: function success(data) {
        transactionPyramidAuto.setOption({
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
      }
    });
  });
}

if ($('#transactions-pyramid-real-estate').length) {
  var transactionPyramidRealEstate = echarts.init(document.getElementById('transactions-pyramid-real-estate'), theme);
  $(document).ready(function () {
    var url = "pyramid/transactions_real_estate";
    $.ajaxSetup({
      headers: {
        'X-CSRF-Token': $('meta[name=_token]').attr('content')
      }
    });
    $.ajax({
      url: url,
      type: 'GET',
      success: function success(data) {
        transactionPyramidRealEstate.setOption({
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
      }
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
    data: {
      id: select_id,
      time: $(this).val()
    },
    dataType: 'json',
    success: function success(data) {
      new PNotify({
        title: 'Успех',
        text: 'Встреча назначена',
        type: 'success',
        styling: 'bootstrap3'
      });
    },
    error: function error(data) {
      var response = $.parseJSON(data.responseText);
      new PNotify({
        title: 'Ошибка',
        text: '',
        type: 'error',
        styling: 'bootstrap3'
      });
    }
  });
});

if ($('#issue-or-sign-table').length) {
  $('.modal-yes-signed').click(function () {
    $('.yes-signed').data('id', this.dataset.id);
    $('.customer-waiver').data('id', this.dataset.id);
  });
  $('.yes-signed').click(function () {
    var id = $('.yes-signed').data('id'),
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
        var item = $('#transactionId-' + data.id).find('.modal-yes-signed');
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
  });
  $(document).on('click', ".modal-yes-gave", function () {
    $('.yes-gave').data('id', this.dataset.id);
    $('.customer-waiver').data('id', this.dataset.id);
  });
  $('.yes-gave').click(function () {
    var id = $('.yes-gave').data('id'),
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
        var item = $('#transactionId-' + data.id).find('.modal-yes-gave');
        item.parent().parent().remove();
        new PNotify({
          title: 'Успех',
          text: data.message,
          type: 'success',
          styling: 'bootstrap3'
        });
      }
    });
  });
  $('.client-waiver-save').click(function () {
    var url = 'transaction/' + $('.customer-waiver').data('id') + '/updateStatus';
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
  });
}

if ($('.accordion-buttons').length) {
  $(document).on('click', '.accordion-button-change', function () {
    var buttons = $(this).parent();
    buttons.children('.accordion-button-change').addClass('hidden');
    buttons.children('.accordion-button-destroy').addClass('hidden');
    buttons.children('.accordion-button-cancel').removeClass('hidden');
    buttons.children('.accordion-button-save').removeClass('hidden');
    buttons.parent().children('form').children('input').removeAttr('readonly');
  });
  $(document).on('click', '.accordion-button-cancel', function () {
    var buttons = $(this).parent();
    buttons.children('.accordion-button-change').removeClass('hidden');
    buttons.children('.accordion-button-destroy').removeClass('hidden');
    buttons.children('.accordion-button-cancel').addClass('hidden');
    buttons.children('.accordion-button-save').addClass('hidden');
    buttons.parent().children('form').children('input').attr('readonly', true);
  });
  $(document).on('click', '.accordion-button-destroy', function () {
    if (confirm('Удалить ?')) {
      var form = $(this).parent().parent().children('form');
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
        error: function error(data) {
          var response = $.parseJSON(data.responseText);
          new PNotify({
            title: 'Ошибка',
            text: '',
            type: 'error',
            styling: 'bootstrap3'
          });
        }
      });
    }
  });
  $(document).on('click', '.accordion-button-save', function () {
    var form = $(this).parent().parent().children('form'),
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
      error: function error(data) {
        new PNotify({
          title: 'Ошибка',
          text: parseErrors(data),
          type: 'error',
          styling: 'bootstrap3'
        });
      }
    });
  });
}

if ($('.add-transaction-description-form').length) {
  $('.send-form-transaction-description').on('click', function () {
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
      error: function error(data) {
        var response = $.parseJSON(data.responseText);
        new PNotify({
          title: 'Ошибка',
          text: '',
          type: 'error',
          styling: 'bootstrap3'
        });
      }
    });
  });
}

function addDescription(add, td) {
  if (add == 'Автомобиль на стоянке') {
    $('.accordion-transaction-description').append('<div class="panel" id="panel-id-' + td.id + '">\n' + '                        <a class="panel-heading collapsed" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapse-' + td.id + '" aria-expanded="false" aria-controls="collapseOne">\n' + '                            <h4 class="panel-title">' + td.deposit.name + '</h4>\n' + '                        </a>\n' + '                        <div id="collapse-' + td.id + '" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">\n' + '                            <div class="panel-body">\n' + '                                <form data-id="' + td.id + '" class="add-transaction-description-form" method="POST">\n' + '                                    <label for="VIN">VIN</label>\n' + '                                    <input type="text" readonly  class="form-control" name="VIN" id="VIN" value="' + (td.VIN || '') + '">\n' + '\n' + '                                    <label for="model_ts">Марка, модель ТС</label>\n' + '                                    <input type="text" readonly  class="form-control" name="model_ts" id="model_ts" value="' + (td.model_ts || '') + '">\n' + '\n' + '                                    <label for="object">Объект</label>\n' + '                                    <input type="text" readonly  class="form-control" name="object" id="object" value="' + (td.object || '') + '">\n' + '\n' + '                                    <label for="year_of_manufacture">Год изготовления ТС</label>\n' + '                                    <input type="text" readonly  class="form-control" name="year_of_manufacture" id="year_of_manufacture" value="' + (td.year_of_manufacture || '') + '">\n' + '\n' + '                                    <label for="engine_number">Номер двигателя</label>\n' + '                                    <input type="text" readonly  class="form-control" name="engine_number" id="engine_number" value="' + (td.engine_number || '') + '">\n' + '\n' + '                                    <label for="bodywork_number">Номер кузова</label>\n' + '                                    <input type="text" readonly  class="form-control" name="bodywork_number" id="bodywork_number" value="' + (td.bodywork_number || '') + '">\n' + '\n' + '                                    <label for="color">Цвет</label>\n' + '                                    <input type="text" readonly  class="form-control" name="color" id="color" value="' + (td.color || '') + '">\n' + '\n' + '                                    <label for="pts_series">ПТС серия</label>\n' + '                                    <input type="text" readonly  class="form-control" name="pts_series" id="pts_series" value="' + (td.pts_series || '') + '">\n' + '\n' + '                                    <label for="pts_number">ПТС номер</label>\n' + '                                    <input type="text" readonly  class="form-control" name="pts_number" id="pts_number" value="' + (td.pts_number || '') + '">\n' + '\n' + '                                    <label for="pts_issued">ПТС кем выдан</label>\n' + '                                    <input type="text" readonly  class="form-control" name="pts_issued" id="pts_issued" value="' + (td.pts_issued || '') + '">\n' + '\n' + '                                    <label for="pts_date_issued">ПТС дата выдачи</label>\n' + '                                    <input type="text" readonly  class="form-control" name="pts_date_issued" id="pts_date_issued" value="' + (td.pts_date_issued || '') + '">\n' + '\n' + '                                    <label for="state_number">Госномер ТС</label>\n' + '                                    <input type="text" readonly  class="form-control" name="state_number" id="state_number" value="' + (td.state_number || '') + '">\n' + '                                </form>\n' + '                                <div class="x_content accordion-buttons">\n' + '                                    <button type="button" class="btn btn-primary accordion-button-change">Изменить</button>\n' + '                                    <button type="button" class="btn btn-danger accordion-button-destroy">Удалить</button>\n' + '                                    <button type="button" class="btn btn-default accordion-button-cancel hidden">Отмена</button>\n' + '                                    <button type="button" class="btn btn-success accordion-button-save hidden">Сохранить</button>\n' + '                                </div>\n' + '                            </div>\n' + '                        </div>\n' + '                    </div>');
  } else if (add == 'ПТС') {
    $('.accordion-transaction-description').append('<div class="panel" id="panel-id-' + td.id + '">\n' + '                        <a class="panel-heading collapsed" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapse-' + td.id + '" aria-expanded="false" aria-controls="collapseOne">\n' + '                            <h4 class="panel-title">' + td.deposit.name + '</h4>\n' + '                        </a>\n' + '                        <div id="collapse-' + td.id + '" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">\n' + '                            <div class="panel-body">\n' + '                                <form data-id="' + td.id + '" class="add-transaction-description-form" method="POST">\n' + '                                    <label for="VIN">VIN</label>\n' + '                                    <input type="text" readonly  class="form-control" name="VIN" id="VIN" value="' + (td.VIN || '') + '">\n' + '\n' + '                                    <label for="model_ts">Марка, модель ТС</label>\n' + '                                    <input type="text" readonly  class="form-control" name="model_ts" id="model_ts" value="' + (td.model_ts || '') + '">\n' + '\n' + '                                    <label for="object">Объект</label>\n' + '                                    <input type="text" readonly  class="form-control" name="object" id="object" value="' + (td.object || '') + '">\n' + '\n' + '                                    <label for="year_of_manufacture">Год изготовления ТС</label>\n' + '                                    <input type="text" readonly  class="form-control" name="year_of_manufacture" id="year_of_manufacture" value="' + (td.year_of_manufacture || '') + '">\n' + '\n' + '                                    <label for="engine_number">Номер двигателя</label>\n' + '                                    <input type="text" readonly  class="form-control" name="engine_number" id="engine_number" value="' + (td.engine_number || '') + '">\n' + '\n' + '                                    <label for="bodywork_number">Номер кузова</label>\n' + '                                    <input type="text" readonly  class="form-control" name="bodywork_number" id="bodywork_number" value="' + (td.bodywork_number || '') + '">\n' + '\n' + '                                    <label for="color">Цвет</label>\n' + '                                    <input type="text" readonly  class="form-control" name="color" id="color" value="' + (td.color || '') + '">\n' + '\n' + '                                    <label for="pts_series">ПТС серия</label>\n' + '                                    <input type="text" readonly  class="form-control" name="pts_series" id="pts_series" value="' + (td.pts_series || '') + '">\n' + '\n' + '                                    <label for="pts_number">ПТС номер</label>\n' + '                                    <input type="text" readonly  class="form-control" name="pts_number" id="pts_number" value="' + (td.pts_number || '') + '">\n' + '\n' + '                                    <label for="pts_issued">ПТС кем выдан</label>\n' + '                                    <input type="text" readonly  class="form-control" name="pts_issued" id="pts_issued" value="' + (td.pts_issued || '') + '">\n' + '\n' + '                                    <label for="pts_date_issued">ПТС дата выдачи</label>\n' + '                                    <input type="text" readonly  class="form-control" name="pts_date_issued" id="pts_date_issued" value="' + (td.pts_date_issued || '') + '">\n' + '\n' + '                                    <label for="state_number">Госномер ТС</label>\n' + '                                    <input type="text" readonly  class="form-control" name="state_number" id="state_number" value="' + (td.state_number || '') + '">\n' + '                                </form>\n' + '                                <div class="x_content accordion-buttons">\n' + '                                    <button type="button" class="btn btn-primary accordion-button-change">Изменить</button>\n' + '                                    <button type="button" class="btn btn-danger accordion-button-destroy">Удалить</button>\n' + '                                    <button type="button" class="btn btn-default accordion-button-cancel hidden">Отмена</button>\n' + '                                    <button type="button" class="btn btn-success accordion-button-save hidden">Сохранить</button>\n' + '                                </div>\n' + '                            </div>\n' + '                        </div>\n' + '                    </div>');
  } else if (add == 'Земля') {
    $('.accordion-transaction-description').append('<div class="panel" id="panel-id-' + td.id + '">\n' + '                        <a class="panel-heading collapsed" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapse-' + td.id + '" aria-expanded="false" aria-controls="collapseOne">\n' + '                            <h4 class="panel-title">' + td.deposit.name + '</h4>\n' + '                        </a>\n' + '                        <div id="collapse-' + td.id + '" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">\n' + '                            <div class="panel-body">\n' + '                                <form data-id="' + td.id + '" class="add-transaction-description-form" method="POST">\n' + '                                    <label for="price_market">Цена по рынку, руб.</label>\n' + '                                    <input type="text" readonly  class="form-control" name="price_market" id="price_market" value=" ' + (td.price_market || '') + '">\n' + '\n' + '                                    <label for="evaluative_price">Наша оценка, руб.</label>\n' + '                                    <input type="text" readonly  class="form-control" name="evaluative_price" id="evaluative_price" value=" ' + (td.evaluative_price || '') + '">\n' + '\n' + '                                    <label for="appointment">Назначение</label>\n' + '                                    <input type="text" readonly  class="form-control" name="appointment" id="appointment" value=" ' + (td.appointment || '') + '">\n' + '\n' + '                                    <label for="area">Общая площадь, кв.м</label>\n' + '                                    <input type="text" readonly  class="form-control" name="area" id="area" value=" ' + (td.area || '') + '">\n' + '\n' + '                                    <label for="address">Адрес расположения объекта</label>\n' + '                                    <input type="text" readonly  class="form-control" name="address" id="address" value=" ' + (td.address || '') + '">\n' + '\n' + '                                    <label for="basis">Основание владения объектом (род.падеж)</label>\n' + '                                    <input type="text" readonly  class="form-control" name="basis" id="basis" value=" ' + (td.basis || '') + '">\n' + '\n' + '                                    <label for="cadastral_number">Кадастровый или условный номер</label>\n' + '                                    <input type="text" readonly  class="form-control" name="cadastral_number" id="cadastral_number" value=" ' + (td.cadastral_number || '') + '">\n' + '\n' + '                                    <label for="ownership_documents">Документ, подтверждающий право собственности</label>\n' + '                                    <input type="text" readonly  class="form-control" name="ownership_documents" id="ownership_documents" value=" ' + (td.ownership_documents || '') + '">\n' + '\n' + '                                    <label for="number_ownership_documents">Серия и номер документа, подтверждающего право собственности</label>\n' + '                                    <input type="text" readonly  class="form-control" name="number_ownership_documents" id="number_ownership_documents" value=" ' + (td.number_ownership_documents || '') + '">\n' + '\n' + '                                    <label for="date_ownership_documents">Дата выдачи документа, подтверждающего право собственности</label>\n' + '                                    <input type="text" readonly  class="form-control" name="date_ownership_documents" id="date_ownership_documents" value=" ' + (td.date_ownership_documents || '') + '">\n' + '\n' + '                                    <label for="ownership_documents_issued">Кем выдан документ</label>\n' + '                                    <input type="text" readonly  class="form-control" name="ownership_documents_issued" id="ownership_documents_issued" value=" ' + (td.ownership_documents_issued || '') + '">\n' + '\n' + '                                    <label for="restriction">Наличие ограничений или обременений</label>\n' + '                                    <input type="text" readonly  class="form-control" name="restriction" id="restriction" value=" ' + (td.restriction || '') + '">\n' + '                                </form>\n' + '                                <div class="x_content accordion-buttons">\n' + '                                    <button type="button" class="btn btn-primary accordion-button-change">Изменить</button>\n' + '                                    <button type="button" class="btn btn-danger accordion-button-destroy">Удалить</button>\n' + '                                    <button type="button" class="btn btn-default accordion-button-cancel hidden">Отмена</button>\n' + '                                    <button type="button" class="btn btn-success accordion-button-save hidden">Сохранить</button>\n' + '                                </div>\n' + '                            </div>\n' + '                        </div>\n' + '                    </div>');
  } else if (add == 'Квартира') {
    $('.accordion-transaction-description').append('<div class="panel" id="panel-id-' + td.id + '">\n' + '                        <a class="panel-heading collapsed" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapse-' + td.id + '" aria-expanded="false" aria-controls="collapseOne">\n' + '                            <h4 class="panel-title">' + td.deposit.name + '</h4>\n' + '                        </a>\n' + '                        <div id="collapse-' + td.id + '" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">\n' + '                            <div class="panel-body">\n' + '                                <form data-id="' + td.id + '" class="add-transaction-description-form" method="POST">\n' + '                                    <label for="price_market">Цена по рынку, руб.</label>\n' + '                                    <input type="text" readonly  class="form-control" name="price_market" id="price_market" value="' + (td.price_market || '') + '">\n' + '\n' + '                                    <label for="evaluative_price">Наша оценка, руб.</label>\n' + '                                    <input type="text" readonly  class="form-control" name="evaluative_price" id="evaluative_price" value="' + (td.evaluative_price || '') + '">\n' + '\n' + '                                    <label for="appointment">Назначение</label>\n' + '                                    <input type="text" readonly  class="form-control" name="appointment" id="appointment" value="' + (td.appointment || '') + '">\n' + '\n' + '                                    <label for="area">Общая площадь, кв.м</label>\n' + '                                    <input type="text" readonly  class="form-control" name="area" id="area" value="' + (td.area || '') + '">\n' + '\n' + '                                    <label for="floor">Этаж</label>\n' + '                                    <input type="text" readonly  class="form-control" name="floor" id="floor" value="' + (td.floor || '') + '">\n' + '\n' + '                                    <label for="address">Адрес расположения объекта</label>\n' + '                                    <input type="text" readonly  class="form-control" name="address" id="address" value="' + (td.address || '') + '">\n' + '\n' + '                                    <label for="basis">Основание владения объектом (род.падеж)</label>\n' + '                                    <input type="text" readonly  class="form-control" name="basis" id="basis" value="' + (td.basis || '') + '">\n' + '\n' + '                                    <label for="cadastral_number">Кадастровый или условный номер</label>\n' + '                                    <input type="text" readonly  class="form-control" name="cadastral_number" id="cadastral_number" value="' + (td.cadastral_number || '') + '">\n' + '\n' + '                                    <label for="ownership_documents">Документ, подтверждающий право собственности</label>\n' + '                                    <input type="text" readonly  class="form-control" name="ownership_documents" id="ownership_documents" value="' + (td.ownership_documents || '') + '">\n' + '\n' + '                                    <label for="number_ownership_documents">Серия и номер документа, подтверждающего право собственности</label>\n' + '                                    <input type="text" readonly  class="form-control" name="number_ownership_documents" id="number_ownership_documents" value="' + (td.number_ownership_documents || '') + '">\n' + '\n' + '                                    <label for="date_ownership_documents">Дата выдачи документа, подтверждающего право собственности</label>\n' + '                                    <input type="text" readonly  class="form-control" name="date_ownership_documents" id="date_ownership_documents" value="' + (td.date_ownership_documents || '') + '">\n' + '\n' + '                                    <label for="ownership_documents_issued">Кем выдан документ</label>\n' + '                                    <input type="text" readonly  class="form-control" name="ownership_documents_issued" id="ownership_documents_issued" value="' + (td.ownership_documents_issued || '') + '">\n' + '\n' + '                                    <label for="restriction">Наличие ограничений или обременений</label>\n' + '                                    <input type="text" readonly  class="form-control" name="restriction" id="restriction" value="' + (td.restriction || '') + '">\n' + '                                </form>\n' + '                                <div class="x_content accordion-buttons">\n' + '                                    <button type="button" class="btn btn-primary accordion-button-change">Изменить</button>\n' + '                                    <button type="button" class="btn btn-danger accordion-button-destroy">Удалить</button>\n' + '                                    <button type="button" class="btn btn-default accordion-button-cancel hidden">Отмена</button>\n' + '                                    <button type="button" class="btn btn-success accordion-button-save hidden">Сохранить</button>\n' + '                                </div>\n' + '                            </div>\n' + '                        </div>\n' + '                    </div>');
  } else if (add == 'Дом') {
    $('.accordion-transaction-description').append('<div class="panel" id="panel-id-' + td.id + '">\n' + '                        <a class="panel-heading collapsed" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapse-' + td.id + '" aria-expanded="false" aria-controls="collapseOne">\n' + '                            <h4 class="panel-title">' + td.deposit.name + '</h4>\n' + '                        </a>\n' + '                        <div id="collapse-' + td.id + '" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">\n' + '                            <div class="panel-body">\n' + '                                <form data-id="' + td.id + '" class="add-transaction-description-form" method="POST">\n' + '                                    <label for="price_market">Цена по рынку, руб.</label>\n' + '                                    <input type="text" readonly  class="form-control" name="price_market" id="price_market" value="' + (td.price_market || '') + '">\n' + '\n' + '                                    <label for="evaluative_price">Наша оценка, руб.</label>\n' + '                                    <input type="text" readonly  class="form-control" name="evaluative_price" id="evaluative_price" value="' + (td.evaluative_price || '') + '">\n' + '\n' + '                                    <label for="appointment">Назначение</label>\n' + '                                    <input type="text" readonly  class="form-control" name="appointment" id="appointment" value="' + (td.appointment || '') + '">\n' + '\n' + '                                    <label for="area">Общая площадь, кв.м</label>\n' + '                                    <input type="text" readonly  class="form-control" name="area" id="area" value="' + (td.area || '') + '">\n' + '\n' + '                                    <label for="floors_count">Этажей</label>\n' + '                                    <input type="text" readonly  class="form-control" name="floors_count" id="floors_count" value="' + (td.floors_count || '') + '">\n' + '\n' + '                                    <label for="address">Адрес расположения объекта</label>\n' + '                                    <input type="text" readonly  class="form-control" name="address" id="address" value="' + (td.address || '') + '">\n' + '\n' + '                                    <label for="basis">Основание владения объектом (род.падеж)</label>\n' + '                                    <input type="text" readonly  class="form-control" name="basis" id="basis" value="' + (td.basis || '') + '">\n' + '\n' + '                                    <label for="cadastral_number">Кадастровый или условный номер</label>\n' + '                                    <input type="text" readonly  class="form-control" name="cadastral_number" id="cadastral_number" value="' + (td.cadastral_number || '') + '">\n' + '\n' + '                                    <label for="ownership_documents">Документ, подтверждающий право собственности</label>\n' + '                                    <input type="text" readonly  class="form-control" name="ownership_documents" id="ownership_documents" value="' + (td.ownership_documents || '') + '">\n' + '\n' + '                                    <label for="number_ownership_documents">Серия и номер документа, подтверждающего право собственности</label>\n' + '                                    <input type="text" readonly  class="form-control" name="number_ownership_documents" id="number_ownership_documents" value="' + (td.number_ownership_documents || '') + '">\n' + '\n' + '                                    <label for="date_ownership_documents">Дата выдачи документа, подтверждающего право собственности</label>\n' + '                                    <input type="text" readonly  class="form-control" name="date_ownership_documents" id="date_ownership_documents" value="' + (td.date_ownership_documents || '') + '">\n' + '\n' + '                                    <label for="ownership_documents_issued">Кем выдан документ</label>\n' + '                                    <input type="text" readonly  class="form-control" name="ownership_documents_issued" id="ownership_documents_issued" value="' + (td.ownership_documents_issued || '') + '">\n' + '\n' + '                                    <label for="restriction">Наличие ограничений или обременений</label>\n' + '                                    <input type="text" readonly  class="form-control" name="restriction" id="restriction" value="' + (td.restriction || '') + '">\n' + '                                </form>\n' + '                                <div class="x_content accordion-buttons">\n' + '                                    <button type="button" class="btn btn-primary accordion-button-change">Изменить</button>\n' + '                                    <button type="button" class="btn btn-danger accordion-button-destroy">Удалить</button>\n' + '                                    <button type="button" class="btn btn-default accordion-button-cancel hidden">Отмена</button>\n' + '                                    <button type="button" class="btn btn-success accordion-button-save hidden">Сохранить</button>\n' + '                                </div>\n' + '                            </div>\n' + '                        </div>\n' + '                    </div>');
  } else if (add == 'Поручитель') {
    $('.accordion-transaction-description').append('<div class="panel" id="panel-id-' + td.id + '">\n' + '                        <a class="panel-heading collapsed" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapse-' + td.id + '" aria-expanded="false" aria-controls="collapseOne">\n' + '                            <h4 class="panel-title">' + td.deposit.name + '</h4>\n' + '                        </a>\n' + '                        <div id="collapse-' + td.id + '" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">\n' + '                            <div class="panel-body">\n' + '                                <form data-id="' + td.id + '" class="add-transaction-description-form" method="POST">\n' + '                                    <label for="fio">ФИО</label>\n' + '                                    <input type="text" readonly  class="form-control" name="fio" id="fio" value="' + (td.fio || '') + '">\n' + '\n' + '                                    <label for="phone">Телефон</label>\n' + '                                    <input type="text" readonly  class="form-control" name="phone" id="phone" value="' + (td.phone || '') + '">\n' + '\n' + '                                    <label for="series">Серия</label>\n' + '                                    <input type="text" readonly  class="form-control" name="series" id="series" value="' + (td.series || '') + '">\n' + '\n' + '                                    <label for="number">Номер</label>\n' + '                                    <input type="text" readonly  class="form-control" name="number" id="number" value="' + (td.number || '') + '">\n' + '\n' + '                                    <label for="birthdate">Дата рождения</label>\n' + '                                    <input type="text" readonly  class="form-control" name="birthdate" id="birthdate" value="' + (td.birthdate || '') + '">\n' + '\n' + '                                    <label for="place_of_birth">Место рождения</label>\n' + '                                    <input type="text" readonly  class="form-control" name="place_of_birth" id="place_of_birth" value="' + (td.place_of_birth || '') + '">\n' + '\n' + '                                    <label for="issued">Кем выдан</label>\n' + '                                    <input type="text" readonly  class="form-control" name="issued" id="issued" value="' + (td.issued || '') + '">\n' + '\n' + '                                    <label for="when_issued">Когда выдан</label>\n' + '                                    <input type="text" readonly  class="form-control" name="when_issued" id="when_issued" value="' + (td.when_issued || '') + '">\n' + '\n' + '                                    <label for="department_code">Код подразделения</label>\n' + '                                    <input type="text" readonly  class="form-control" name="department_code" id="department_code" value="' + (td.department_code || '') + '">\n' + '\n' + '                                    <label for="registration_address">Адрес регистрации</label>\n' + '                                    <input type="text" readonly  class="form-control" name="registration_address" id="registration_address" value="' + (td.registration_address || '') + '">\n' + '                                </form>\n' + '                                <div class="x_content accordion-buttons">\n' + '                                    <button type="button" class="btn btn-primary accordion-button-change">Изменить</button>\n' + '                                    <button type="button" class="btn btn-danger accordion-button-destroy">Удалить</button>\n' + '                                    <button type="button" class="btn btn-default accordion-button-cancel hidden">Отмена</button>\n' + '                                    <button type="button" class="btn btn-success accordion-button-save hidden">Сохранить</button>\n' + '                                </div>\n' + '                            </div>\n' + '                        </div>\n' + '                    </div>');
  } else if (add == 'Заёмщик юридическое лицо') {
    $('.accordion-transaction-description').append('<div class="panel" id="panel-id-' + td.id + '">\n' + '                        <a class="panel-heading collapsed" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapse-' + td.id + '" aria-expanded="false" aria-controls="collapseOne">\n' + '                            <h4 class="panel-title">' + td.deposit.name + '</h4>\n' + '                        </a>\n' + '                        <div id="collapse-' + td.id + '" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">\n' + '                            <div class="panel-body">\n' + '                                <form data-id="' + td.id + '" class="add-transaction-description-form" method="POST">\n' + '                                    <label for="legal_entity_name">Наименование юр.лица</label>\n' + '                                    <input type="text" readonly  class="form-control" name="legal_entity_name" id="legal_entity_name" value="' + (td.legal_entity_name || '') + '">\n' + '\n' + '                                    <label for="short_name">Сокращенно</label>\n' + '                                    <input type="text" readonly  class="form-control" name="short_name" id="short_name" value="' + (td.short_name || '') + '">\n' + '\n' + '                                    <label for="legal_address">Юридический адрес</label>\n' + '                                    <input type="text" readonly  class="form-control" name="legal_address" id="legal_address" value="' + (td.legal_address || '') + '">\n' + '\n' + '                                    <label for="ogrn">ОГРН</label>\n' + '                                    <input type="text" readonly  class="form-control" name="ogrn" id="ogrn" value="' + (td.ogrn || '') + '">\n' + '\n' + '                                    <label for="inn">ИНН</label>\n' + '                                    <input type="text" readonly  class="form-control" name="inn" id="inn" value="' + (td.inn || '') + '">\n' + '\n' + '                                    <label for="kpp">КПП</label>\n' + '                                    <input type="text" readonly  class="form-control" name="kpp" id="kpp" value="' + (td.kpp || '') + '">\n' + '\n' + '                                    <label for="position_of_representative">Должнасть представителя</label>\n' + '                                    <input type="text" readonly  class="form-control" name="position_of_representative" id="position_of_representative" value="' + (td.position_of_representative || '') + '">\n' + '\n' + '                                    <label for="basis_of_authority">Основание полномочий</label>\n' + '                                    <input type="text" readonly  class="form-control" name="basis_of_authority" id="basis_of_authority" value="' + (td.basis_of_authority || '') + '">\n' + '\n' + '                                    <label for="correspondent_account">Корр. счет</label>\n' + '                                    <input type="text" readonly  class="form-control" name="correspondent_account" id="correspondent_account" value="' + (td.correspondent_account || '') + '">\n' + '\n' + '                                    <label for="bik">БИК</label>\n' + '                                    <input type="text" readonly  class="form-control" name="bik" id="bik" value="' + (td.bik || '') + '">\n' + '\n' + '                                    <label for="bank">Банк</label>\n' + '                                    <input type="text" readonly  class="form-control" name="bank" id="bank" value="' + (td.bank || '') + '">\n' + '                                </form>\n' + '                                <div class="x_content accordion-buttons">\n' + '                                    <button type="button" class="btn btn-primary accordion-button-change">Изменить</button>\n' + '                                    <button type="button" class="btn btn-danger accordion-button-destroy">Удалить</button>\n' + '                                    <button type="button" class="btn btn-default accordion-button-cancel hidden">Отмена</button>\n' + '                                    <button type="button" class="btn btn-success accordion-button-save hidden">Сохранить</button>\n' + '                                </div>\n' + '                            </div>\n' + '                        </div>\n' + '                    </div>');
  }
}

if ($('#change-avatar-button').length) {
  $(document).on('click', '#change-avatar-button', function () {
    var form_data = new FormData();
    var avatar = $("#avatar-file").prop('files')[0];
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
      success: function success(data) {
        new PNotify({
          title: 'Успех',
          text: 'Фотография обновлена',
          type: 'success',
          styling: 'bootstrap3'
        });
        $(".user-avatar").each(function () {
          this.src = data.src;
        });
        $('.close').click();
      },
      error: function error(data) {
        new PNotify({
          title: 'Ошибка',
          text: parseErrors(data),
          type: 'error',
          styling: 'bootstrap3'
        });
      }
    });
  });
}

if ($('.update-profile-data-buttons').length) {
  $(document).on('click', '#edit', function () {
    $('#edit').addClass('hidden');
    $('#cancel').removeClass('hidden');
    $('#save').removeClass('hidden');
    var form = $(this).parent().parent().parent();
    form.children('div').children('div').children('input').removeAttr('readonly');
  });
  $(document).on('click', '#cancel', function () {
    $('#edit').removeClass('hidden');
    $('#cancel').addClass('hidden');
    $('#save').addClass('hidden');
    var form = $(this).parent().parent().parent();
    form.children('div').children('div').children('input').attr('readonly', true);
  });
  $(document).on('click', '#save', function () {
    var form = $(this).parent().parent().parent();
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
      error: function error(data) {
        new PNotify({
          title: 'Ошибка',
          text: parseErrors(data),
          type: 'error',
          styling: 'bootstrap3'
        });
      }
    });
  });
}

function parseErrors(data) {
  var response = $.parseJSON(data.responseText);
  var ul = '<ul>';

  for (i in response.errors) {
    ul += '<li>' + response.errors[i][0] + '</li>';
  }

  ul += '</ul>';
  return ul;
}

function FindFile() {
  document.getElementById('my_hidden_file').click();
}

function Count() {
  var el = document.getElementById('show_file');

  for (var i = 0; i < document.getElementById("my_hidden_file").files.length; i++) {
    var div1 = document.createElement('div');
    div1.innerHTML = document.getElementById("my_hidden_file").files[i].name;
    div1.setAttribute('id', 'del-icon-' + i);
    var img = document.createElement("i");
    img.setAttribute('class', 'fa fa-close');
    img.setAttribute('onclick', 'delete_file(' + i + ')');
    div1.insertBefore(img, div1.firstChild);
    var myImg = document.createElement("img");
    div1.insertBefore(myImg, div1.firstChild);
    el.insertBefore(div1, el.firstChild);
  }
}

function delete_file(i) {
  var elem = document.getElementById('del-icon-' + i);
  elem.innerHTML = '';
} /////


function expiration(index) {
  var elem = document.getElementById('table_deals');
  elem.innerHTML = '';
  cb = document.getElementById('checkbox1');

  if (cb.checked) {
    index = parseInt($('#month_count').val()) + 2;
  }

  if ($("#effectTypes").val() == 1) {
    index++;
  }

  for (var i = index; i > 0; i--) {
    var tr = document.createElement("tr");
    var td = document.createElement("td");
    var input = document.createElement("input");
    input.setAttribute('id', 'all' + i);
    input.setAttribute('readonly', 'readonly');
    input.setAttribute('class', 'locked');
    td.insertBefore(input, td.firstChild);
    tr.insertBefore(td, tr.firstChild);
    var td = document.createElement("td");
    var input = document.createElement("input");
    input.setAttribute('id', 'perc' + i);
    input.setAttribute('readonly', 'readonly');
    input.setAttribute('class', 'locked');
    td.insertBefore(input, td.firstChild);
    tr.insertBefore(td, tr.firstChild);
    var td = document.createElement("td");
    var input = document.createElement("input");
    input.setAttribute('id', 'body' + i);
    input.setAttribute('readonly', 'readonly');
    input.setAttribute('class', 'locked');
    td.insertBefore(input, td.firstChild);
    tr.insertBefore(td, tr.firstChild);
    var td = document.createElement("td");
    var input = document.createElement("input");
    input.setAttribute('id', 'input' + i);
    input.setAttribute('readonly', 'readonly');
    input.setAttribute('class', 'locked');
    td.insertBefore(input, td.firstChild);
    tr.insertBefore(td, tr.firstChild);
    var td = document.createElement("td");
    td.innerHTML = i;
    tr.insertBefore(td, tr.firstChild);
    elem.insertBefore(tr, elem.firstChild);
  }
}

function showOrHide() {
  cb = document.getElementById('checkbox1');
  a = $('#month_count').val();

  if (cb.checked) {
    expiration(parseInt(a) + 2);
  } else {
    expiration(parseInt(a));
  }
}

$(document).ready(function () {
  $('#month_count').on('change', function () {
    a = $('#month_count').val();

    if (a <= 60) {
      expiration(a);
    } else {
      alert('Срок займа не должен превышать 5 лет');
    }
  });
}); ///////////////// расчет  ///////////////////

function getDiffYear(input) {
  var date = new Date(input);
  month = date.getMonth();
  year = date.getFullYear();
  var year_date1 = new Date(['01', '01', year].join('/'));
  var year_date2 = new Date(['01', '01', year + 1].join('/'));
  var milliseconds = year_date2 - year_date1;
  var days = milliseconds / 1000 / 60 / 60 / 24;
  return days;
}

function getDiffYear2(input) {
  var date = new Date(input);
  year = date.getFullYear();
  day = date.getDate();
  month = date.getMonth();
  var year_date1 = new Date([month, day, year].join('/'));
  var year_date2 = new Date([month, day, year + 1].join('/'));
  var milliseconds = year_date2 - year_date1;
  var days = milliseconds / 1000 / 60 / 60 / 24;
  return days;
}

function getDiffMonth(input) {
  var date1 = new Date(input);
  month1 = date1.getMonth();
  year1 = date1.getFullYear();
  day1 = date1.getDate();
  date1.setMonth(date1.getMonth() + 1);
  month2 = date1.getMonth();
  year2 = date1.getFullYear();
  day2 = date1.getDate();
  var month_date1 = new Date([month1 + 1, day1, year1].join('/'));
  var month_date2 = new Date([month2 + 1, day2, year2].join('/'));
  var milliseconds = month_date2 - month_date1;
  var days1 = milliseconds / 1000 / 60 / 60 / 24;
  return days1;
}

function getTableDate(input) {
  var date = new Date(input);
  var s = 1;

  if ($("#checkbox1").prop("checked") == true) {
    var date2 = new Date(input);
    date2.setDate(date2.getDate() + 1);
    date2.setMonth(date2.getMonth() + 1);

    for (var i = 1; i < 3; i++) {
      day2 = date2.getDate();
      month2 = date2.getMonth();
      year2 = date2.getFullYear();

      if (("" + (month2 + 1)).length > 1) {
        $('#input' + i).val([day2, month2, year2].join('.'));
      } else {
        $('#input' + i).val([day2, "0" + month2, year2].join('.'));
      }

      date2.setDate(date2.getDate() + 1);
    }

    s = 3;
  }

  var count = $('#month_count').val();

  for (var i = s; i <= +count + 1 + s - 1; i++) {
    date.setMonth(date.getMonth() + 1);
    day = date.getDate();
    month = date.getMonth();
    year = date.getFullYear();

    if (("" + (month + 1)).length > 1) {
      $('#input' + i).val([day, month + 1, year].join('.'));
    } else {
      $('#input' + i).val([day, "0" + (month + 1), year].join('.'));
    }
  }
}

function getPercentYear(percent) {
  result = percent * 12;
  return result;
}

function getAll(ost, proc) {
  var result = 0;
  var st = getPercentYear($('#percent').val());
  var sum = $('#credit').val();
  var mes = $('#month_count').val();
  var temp = sum * st / 100 / 12 / (1 - Math.pow(1 + st / 100 / 12, -mes));

  if (sum * st / 100 / 12 / (1 - Math.pow(1 + st / 100 / 12, -mes)) < ost) {
    result = Math.ceil(sum * st / 100 / 12 / (1 - Math.pow(1 + st / 100 / 12, -mes)));
  } else {
    result = +ost + +proc;
  }

  return result;
}

function dateNormalization(input) {
  arr = input.split('.');
  var result = [arr[1], arr[0], arr[2]].join('/');
  return result;
}

function plusTwo(total) {
  var w = +total * 12 / getDiffYear2(dateNormalization($('#input0').val()));

  for (var i = 1; i <= 2; i++) {
    $('#body' + i).val('0');
    $('#all' + i).val(w.toFixed(2));
    $('#perc' + i).val(w.toFixed(2));
  }

  $('#all3').val(($('#all3').val() - w * 2).toFixed(2));
  $('#perc3').val(($('#perc3').val() - w * 2).toFixed(2));
}

function plusTwoAnn() {
  var k = getDiffMonth(dateNormalization($('#input0').val()));
  var total = $('#all3').val() / k;
  var body = $('#body3').val() / k;
  var perc = $('#perc3').val() / k;

  for (var i = 1; i <= 2; i++) {
    $('#body' + i).val(body.toFixed(2));
    $('#all' + i).val(total.toFixed(2));
    $('#perc' + i).val(perc.toFixed(2));
  }

  $('#body3').val(($('#body3').val() - body * 2).toFixed(2));
  $('#all3').val(($('#all3').val() - total * 2).toFixed(2));
  $('#perc3').val(($('#perc3').val() - perc * 2).toFixed(2));
}

function resultDeals() {
  var body = 0;
  var total = 0;
  var percent = 0;
  var count = $('#month_count').val();
  var s = 0;

  if ($("#effectTypes").val() == 1) {
    s++;
  }

  if ($("#checkbox1").prop("checked") == true) {
    s = s + 2;
  }

  for (var i = 1; i <= +count + s; i++) {
    body = body + +$('#body' + i).val();
    percent = percent + +$('#perc' + i).val();
    total = total + +$('#all' + i).val();
  }

  $('#table_deals').append(" <tr> <td></td>  <td>Итого</td> <td>" + body.toFixed(2) + "</td> <td>" + percent.toFixed(2) + "</td> <td>" + total.toFixed(2) + "</td></tr> ");
}

function onlyPercents(s) {
  var count = $('#month_count').val();
  var total = $('#credit').val() * getPercentYear($('#percent').val()) / 100 / count;

  for (var i = s; i <= +count + s; i++) {
    $('#perc' + i).val(total);

    if (i != +count + s - 1) {
      $('#body' + i).val('0');
      $('#all' + i).val(total);
    } else {
      $('#body' + i).val($('#credit').val());
      $('#all' + i).val(+total + +$('#credit').val());
    }
  }

  if ($("#checkbox1").prop("checked") == true) {
    plusTwo(total);
  }
}

function annuityDeals(s) {
  var ost = $('#credit').val();
  var count = $('#month_count').val();

  for (var i = s; i <= +count + 1 + (s - 1); i++) {
    $('#perc' + i).val((ost * getPercentYear($('#percent').val()) * getDiffMonth(dateNormalization($('#input' + (i - 1)).val())) / getDiffYear(dateNormalization($('#input' + i).val())) / 100).toFixed(2));
    $('#all' + i).val(getAll(ost, $('#perc' + i).val()).toFixed(2));
    $('#body' + i).val(($('#all' + i).val() - $('#perc' + i).val()).toFixed(2));
    ost = ost - $('#body' + i).val();
  }

  if ($("#checkbox1").prop("checked") == true) {
    plusTwoAnn();
  }
}

function calculate() {
  var s = 1;

  if ($("#checkbox1").prop("checked") == true) {
    s = 3;
  }

  expiration(parseInt($('#month_count').val()));
  getTableDate(dateNormalization($('#input0').val()));

  if ($("#effectTypes").val() == 0) {
    onlyPercents(s);
  }

  if ($("#effectTypes").val() == 1) {
    annuityDeals(s);
  }

  resultDeals();
}

$(function () {
  $("#locked").click(function () {
    if ($('#locked').hasClass('fa-lock')) {
      $('#locked').removeClass('fa-lock').addClass('fa-unlock');
      $('.locked').prop('readonly', false);
    } else {
      $('#locked').removeClass('fa-unlock').addClass('fa-lock');
      $('.locked').prop('readonly', true);
    }
  });
});

function CallPrint(strid) {
  var prtContent = document.getElementById(strid);
  var WinPrint = window.open('', '', 'left=50,top=50,width=800,height=640,toolbar=0,scrollbars=1,status=0');
  WinPrint.document.write('<div id="print" class="contentpane">');
  WinPrint.document.write(prtContent.innerHTML);
  WinPrint.document.write('</div>');
  WinPrint.document.close();
  WinPrint.focus();
  WinPrint.print();
  WinPrint.close();
  prtContent.innerHTML = strOldOne;
}

$(function () {
  $('input').on('input keyup', function (e) {
    checkInput();
  });
});

function checkInput(ins) {
  var state = 0;
  var arr = ['.pts', '.parking'];
  var arr_img = ['#pts-img', '#parking-img'];

  for (var i = 0; i < 2; i++) {
    $("#prokrutka").find(arr[i]).each(function () {
      if ($(this).val() != '') {
        state++;
      }

      if (state != 0) {
        $(arr_img[i]).css("display", "contents");
      } else {
        $(arr_img[i]).css("display", "none");
      }
    });
    state = 0;
  }
}

$(function () {
  var fileInput = $('#file-field');
  var imgList = $('ul#img-list');
  var dropBox = $('#img-container');
  fileInput.bind({
    change: function change() {
      displayFiles(this.files);
    }
  });
  dropBox.bind({
    dragenter: function dragenter() {
      //$(this).addClass('highlighted');
      return false;
    },
    dragover: function dragover() {
      $(this).addClass('highlighted');
      return false;
    },
    dragleave: function dragleave() {
      $(this).removeClass('highlighted');
      return false;
    },
    drop: function drop(e) {
      var dt = e.originalEvent.dataTransfer;
      displayFiles(dt.files);
      return false;
    }
  });

  function displayFiles(files) {
    $.each(files, function (i, file) {
      if (!file.type.match(/image.*/)) {
        // Отсеиваем не картинки
        return true;
      }

      var li = $('<li/>').appendTo(imgList);
      var div = $('<div/>').appendTo(imgList);
      div.attr('aria-controls', 'datatable');
      div.attr('data-dt-idx', '1');
      var img = $('<img/>').appendTo(li);
      img.attr('aria-controls', 'datatable');
      img.attr('data-dt-idx', '2');
      img.attr('class', 'upload-picture');
      li.get(0).file = file;
      var reader = new FileReader();

      reader.onload = function (aImg) {
        return function (e) {
          aImg.attr('src', e.target.result);
          li.append('   <a data-fancybox="gallery" href="' + e.target.result + '">' + file.name + '</a> ');
          aImg.attr('width', 150);
        };
      }(img);

      reader.readAsDataURL(file);
    });
  }
}); /////////// переместить
//**//

$(document).ready(function () {
  if (jQuery().DataTable) {
    $('#datatable-responsive').DataTable({
      "order": [[1, "desc"]]
    });
  }

  if (jQuery().DataTable) {
    $('#all-leads').DataTable({
      "order": [[1, "desc"]],
      "pageLength": 50
    });
  }
});

function startCheck(id) {
  if ($('#start-check').hasClass('disabled') == false) {
    $('#start-check').addClass('disabled');
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
      }
    });
    $.ajax({
      type: 'POST',
      url: take_on_check,
      data: {
        id: id
      },
      dataType: 'json',
      success: function success(data) {
        if ($('#deposit_type').val() == 'Недвижимость') {
          $("#insert-panel-realty").css("display", "block");
        } else {
          $("#insert-panel-auto").css("display", "block");
        }

        $('#start-check').addClass('hidden');
        $("#button-panel").append('' + '<button data-target="#auto-check" class="btn btn-info btn-block" data-dismiss="modal" data-toggle="modal">\n' + '                                    Автоматическая проверка\n' + '                                </button>\n' + '                                <button class="btn btn-warning btn-block" data-dismiss="modal" data-toggle="modal" data-target="#modification_modal">\n' + '                                    Доработать\n' + '                                </button>\n' + '                                <button class="btn btn-danger btn-block" data-dismiss="modal" data-toggle="modal" data-target="#decline_modal">\n' + '                                    Отказаться\n' + '                                </button>' + '');
      }
    });
  }
}

function backButton() {
  if ($('#deposit_type').val() == 'Недвижимость') {
    $("#insert-panel-realty").css("display", "none");
  } else {
    $("#insert-panel-auto").css("display", "none");
  }

  $("#button-panel").css("display", "block");
  $("#status-table").css("display", "block");
}

function leadDecline(id) {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
  });

  if ($('#decline-comment').val() != '') {
    $.ajax({
      type: 'POST',
      url: lead_decline,
      data: {
        id: id,
        comment: $("#decline-comment").val()
      },
      dataType: 'json',
      success: function success(data) {
        $("#button-panel").empty();
        $("#button-panel").append('<button id="start-check" onclick="startCheck(' + id + ')" class="btn btn-success btn-block" data-dismiss="modal">Начать проверку</button>');

        for (var i = 3; i > 1; i--) {
          $('#status-table tr:eq(' + i + ')').remove();
        }

        $("#status-table").append('<tr><td>Комментарий</td><td>' + $("#decline-comment").val() + '</td> </tr>');
      }
    });
  } else {
    {
      new PNotify({
        title: 'Ошибка',
        text: 'Укажите комментарий',
        type: 'error',
        styling: 'bootstrap3'
      });
    }
  }
}

function leadRemake(id) {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
  });

  if ($('#remake-comment').val() != '') {
    $.ajax({
      type: 'POST',
      url: lead_remake,
      data: {
        id: id,
        comment: $("#remake-comment").val()
      },
      dataType: 'json',
      success: function success(data) {
        $("#button-panel").empty();
        $("#button-panel").append('<button id="start-check" onclick="startCheck(' + id + ')" class="btn btn-success btn-block" data-dismiss="modal">Начать проверку</button>');
        var rowCount = $('#status-table tr').length;

        for (var i = rowCount; i > 1; i--) {
          $('#status-table tr:eq(' + i + ')').remove();
        }

        $("#status-table").append('<tr><td>Комментарий</td><td>' + $("#remake-comment").val() + '</td> </tr>' + '<tr><td>Андеррайтер</td>' + '<td>' + data.underwriter + '</td>' + '</tr><tr><td>Статус</td><td>На доработку</td></tr>');
      }
    });
  } else {
    {
      new PNotify({
        title: 'Ошибка',
        text: 'Укажите комментарий',
        type: 'error',
        styling: 'bootstrap3'
      });
    }
  }
}

function leadWaiver(id) {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
  });

  if ($('#waiver-comment').val() != '') {
    $.ajax({
      type: 'POST',
      url: 'lead_waiver',
      data: {
        id: id,
        comment: $("#waiver-comment").val()
      },
      dataType: 'json',
      success: function success(data) {
        if ($('#deposit_type').val() == 'Недвижимость') {
          $("#insert-panel-realty").css("display", "none");
        } else {
          $("#insert-panel-auto").css("display", "none");
        }

        $("#status-table").css("display", "block");
      }
    });
  } else {
    {
      new PNotify({
        title: 'Ошибка',
        text: 'Укажите комментарий',
        type: 'error',
        styling: 'bootstrap3'
      });
    }
  }
}

function leadApproval(id) {
  if ($('#lead-approved-button').hasClass('disabled') == false) {
    $('#lead-approved-button').addClass('disabled');
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
      }
    });
    $.ajax({
      type: 'POST',
      url: 'lead_approval',
      data: {
        id: id
      },
      dataType: 'json',
      success: function success(data) {
        window.location = data.url;

        if ($('#deposit_type').val() == 'Недвижимость') {
          $("#insert-panel-realty").css("display", "none");
        } else {
          $("#insert-panel-auto").css("display", "none");
        }

        $("#status-table").css("display", "block"); ///
      }
    });
  }
}

$(".check-vin").change(function () {
  if ($('#vin-in-pts').val() == $('#vin-in-sts').val()) {
    $('#vin-in-sts').attr('class', 'equal-vin');
    $('#vin-in-pts').attr('class', 'equal-vin');
  } else {
    $('#vin-in-sts').attr('class', 'different-vin');
    $('#vin-in-pts').attr('class', 'different-vin');
  }
});

if ($("#vin-in-pts").length) {
  var input = document.getElementById('vin-in-pts');

  input.oncut = input.oncopy = input.onpaste = function (event) {
    return false;
  };
}

$(document).on('onInit.fb', function (e, instance) {
  if ($('.fancybox-toolbar').find('#rotate_button').length === 0) {
    $('.fancybox-toolbar').prepend('<button id="rotate_button_right" class="fancybox-button" title="Rotate Image"><i class="fa fa-repeat"></i></button>');
    $('.fancybox-toolbar').prepend('<button id="rotate_button_left" class="fancybox-button" title="Rotate Image"><i class="fa fa-rotate-left"></i></button>');
  }

  var n = 0;
  $('.fancybox-toolbar').on('click', '#rotate_button_right', function () {
    n = n + 90;
    $('.fancybox-image').css('webkitTransform', 'rotate(' + n + 'deg)');
    $('.fancybox-image').css('mozTransform', 'rotate(' + n + 'deg)');
  });
  $('.fancybox-toolbar').on('click', '#rotate_button_left', function () {
    n = n - 90;
    $('.fancybox-image').css('webkitTransform', 'rotate(' + n + 'deg)');
    $('.fancybox-image').css('mozTransform', 'rotate(' + n + 'deg)');
  });
});
$('#clientModal').on('hidden.bs.modal', function () {
  $("#img-loading").removeClass("hidden-block-info");
  $("#img-loading").addClass("show-block-info");
  $("#hidden-block-info").removeClass("show-block-info");
  $("#hidden-block-info").addClass("hidden-block-info");
});
var audio = new Audio();
audio.preload = 'auto';
audio.src = '/sound/1.mp3';
window.Echo["private"]('user.' + userId).listen('NewLeadNotification', function (e) {
  allLeadsTable();
  updateNotification();
}).listen('LeadTakeOnCheckNotification', function (e) {
  allLeadsTable();
  updateNotification();
}).listen('LeadApprovalNotification', function (e) {
  makeAppointmentTable();
  allLeadsTable();
  updateNotification();
  $(audio.play());
});
window.Echo["private"]('underwriters').listen('NewLeadNotification', function (e) {
  takeOnCheckTable();
  allLeadsTable();
  updateNotification();
  $(audio.play());
}).listen('LeadTakeOnCheckNotification', function (e) {
  takeOnCheckTable();
  allLeadsTable();
  updateNotification();
});

function allLeadsTable() {
  if ($('#all-leads-table').length) {
    if ($.fn.DataTable.isDataTable('#all-leads-table')) {
      $('#all-leads-table').DataTable().destroy();
    }

    var url = "/ajax/all_leads_table";
    $('#all-leads-table').DataTable({
      ajax: url
    });
  }
}

function takeOnCheckTable() {
  if ($('#take-on-check-table').length) {
    if ($.fn.DataTable.isDataTable('#take-on-check-table')) {
      $('#take-on-check-table').DataTable().destroy();
    }

    var url = "/ajax/take_on_check_table";
    $('#take-on-check-table').DataTable({
      ajax: url
    });
  }
}

function makeAppointmentTable() {
  if ($('#make-appointment-table').length) {
    if ($.fn.DataTable.isDataTable('#make-appointment-table')) {
      $('#make-appointment-table').DataTable().destroy();
    }

    var url = "/ajax/make_appointment_table";
    $('#make-appointment-table').DataTable({
      ajax: url
    });
  }
}

function updateTransactionNotification() {
  $.ajax({
    type: 'GET',
    url: '/ajax/menu_notification/transaction'
  }).success(function (e) {
    $('.transaction-n').text(e);

    if (e == 0) {
      $('.transaction-n').addClass('hidden');
    } else {
      $('.transaction-n').removeClass('hidden');
    }
  });
}

function updateLeadNotification() {
  $.ajax({
    type: 'GET',
    url: '/ajax/menu_notification/lead'
  }).success(function (e) {
    $('.lead-n').text(e);

    if (e == 0) {
      $('.lead-n').addClass('hidden');
    } else {
      $('.lead-n').removeClass('hidden');
    }
  });
}

function updateNotification() {
  updateLeadNotification();
  updateTransactionNotification();
}

$(document).ready(function () {
  updateLeadNotification();
  updateTransactionNotification();
});
$(document).ready(function () {
  if ($('#all-transactions-table').length) {
    $('#all-transactions-table').DataTable();
  }
});

function questionsTable() {
  if ($('#questions-table').length) {
    if ($.fn.DataTable.isDataTable('#questions-table')) {
      $('#questions-table').DataTable().destroy();
    }

    var url = "/ajax/question_table";
    $('#questions-table').DataTable({
      ajax: url
    });
  }
}

window.Echo.join("underwriter.online").here(function (users) {
  if ($('#underwriters_working_time').length) {
    if ($.fn.DataTable.isDataTable('#underwriters_working_time')) {
      $('#underwriters_working_time').DataTable().destroy();
    }

    var url = "/ajax/underwriters_working_time_table";
    $('#underwriters_working_time').DataTable({
      ajax: {
        url: url,
        dataSrc: function dataSrc(data) {
          for (id in data.data) {
            for (user in users) {
              if (users[user].underwriter) {
                if (data.data[id].DT_RowId == users[user].id) {
                  data.data[id][2] = '<b>online</b>';
                  data.data[id].DT_RowClass = 'success';
                }
              }
            }
          }

          return data.data;
        }
      }
    });
  }
}).joining(function (user) {
  joining(user);
}).leaving(function (user) {
  leaving(user);
});

function joining(user) {
  if (user.underwriter) {
    var row = $('#' + String(user.id));
    row.addClass('success');
    var table = $('#underwriters_working_time').DataTable();
    var online = '<b>online</b>';
    var cell = row.find('b').parent();
    table.cell(cell).data(online).draw();
  }
}

function leaving(user) {
  if (user.underwriter) {
    var row = $('#' + String(user.id));
    row.removeClass('success');
    var table = $('#underwriters_working_time').DataTable();
    var offline = '<b>offline</b>';
    var cell = row.find('b').parent();
    table.cell(cell).data(offline).draw();
  }
}
