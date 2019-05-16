<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3>Лиды</h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        {{--<div class="col-lg-5 col-md-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    {!! $chart->container() !!}
                </div>
            </div>
        </div>--}}
        {{--@include('leads.chin.make_appointment_table')--}}
        <div class="clearfix"></div>
        {{--<div class="col-md-12 col-xs-12 col-lg-8">
            <div class="x_panel">
                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Дата платежа</th>
                                <th>Просрочка</th>
                                <th>Сделка</th>
                                <th>Телефон</th>
                                <th>Проценты</th>
                                <th>Пени</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th> 01.01.2018</th>
                                <th>117 дней</th>
                                <td>Иванов Иван Иванович</td>
                                <td>89171234567</td>
                                <td>10 000 <i class="fa fa-rub"></i></td>
                                <td>10 000 <i class="fa fa-rub"></i></td>
                            </tr>
                            <tr>
                                <th>02.01.2018</th>
                                <th>111 дней</th>
                                <td>Васильев Василий Васильевич</td>
                                <td>89171234567</td>
                                <td>10 000 <i class="fa fa-rub"></i></td>
                                <td>10 000 <i class="fa fa-rub"></i></td>
                            </tr>
                            <tr>
                                <th>03.01.2018</th>
                                <th>67 дней</th>
                                <td>Петров Петр Петрович</td>
                                <td>89171234567</td>
                                <td>10 000 <i class="fa fa-rub"></i></td>
                                <td>10 000 <i class="fa fa-rub"></i></td>
                            </tr>
                            <tr>
                                <th>04.01.2018</th>
                                <th>68 дней</th>
                                <td>Сергеев Сергей Сергевич</td>
                                <td>89171234567</td>
                                <td>10 000 <i class="fa fa-rub"></i></td>
                                <td>10 000 <i class="fa fa-rub"></i></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>--}}
        <div class="clearfix"></div>
        @include('leads.all_leads_table')
    </div>
</div>

<div id="clientModal" class="modal fade" >
    <div class="modal-dialog">
        <div class="modal-content" style="height: 723px;">
            <div id="offset2" class="col-md-12 col-sm-12 col-xs-12">
                <div class="container">
                  <div id="hidden-block-info" class="hidden-block-info">
                    <h3>Результат проверки</h3>
                    <table id="table" class="table " >
                        <tbody>
                        <tr>
                            <td>Создан</td>
                            <td id="info-created"></td>
                        </tr>
                        <tr>
                            <td>Проверен</td>
                            <td id="info-checked"></td>
                        </tr>
                        <tr>
                            <td>Андеррайтер</td>
                            <td id="info-underwriter"></td>
                        </tr>
                        <tr>
                            <td>Статус</td>
                            <td id="info-status"></td>
                        </tr>
                        <tr>
                            <td>Одобренная сумма</td>
                            <td id="info-money-approve"></td>
                        </tr>
                        <tr>
                            <td>Комментарий</td>
                            <td id="info-comments"></td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="inside-header-button col-lg-4 ">
                        <a class="btn btn-warning btn-lg btn-block" data-target="#add-lead"> Отчет </a>
                    </div>
                <div class="container">
                    <h3> Карточка лида</h3>
                    <table id="table" class="table ">
                        <tbody>
                        <tr>
                            <td>ФИО</td>
                            <td id="info-fio"></td>
                        </tr>
                        <tr>
                            <td>Город</td>
                            <td id="info-city"></td>
                        </tr>
                        <tr>
                            <td>Желаема сумма</td>
                            <td id="info-money"></td>
                        </tr>
                        <tr>
                            <td>Телефон</td>
                            <td id="info-phone"></td>
                        </tr>
                        <tr>
                            <td>Залог</td>
                            <td id="info-type"></td>
                        </tr>
                        <tr>
                            <td>Источник</td>
                            <td id="info-source"></td>
                        </tr>
                        <tr>
                            <td id="">Документы</td>
                            <td>
                                <div class="inside-header-button col-lg-4 ">
                                    <a onclick="FindFile();" class="btn btn-secondary btn-lg btn-block"
                                       data-target="#add-lead">Загрузить </a>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div id="show_file">
                    </div>

                    <div id="img-container">
                        <ul id="img-list"></ul>
                    </div>

                    <form action="" target="rFrame" method="POST" enctype="multipart/form-data">
                        <div class="hiddenInput">
                            <input type="file" id="my_hidden_file" style="display: none"
                                   accept="image/jpeg,image/png,image/gif" name="loadfile" onchange=" Count();"
                                   multiple>
                            <input type="submit" id="my_hidden_load" style="display: none" value='Загрузить'>
                        </div>
                    </form>
                </div>
                </div>
</div>
<img id="img-loading" class="center-in-block show-block-info" src="{{asset('img/loading.gif')}}" alt="">
            </div>

            <div class="modal-footer">
                <button id="margin_button" type="button" class="btn btn-default" data-dismiss="modal">Закрыть
                </button>

            </div>
        </div>
    </div>
</div>

<div id="" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <input type="text" name="datetimes"/>
        </div>
    </div>
</div>

<form id="lead-approved-form" action="{{ Route('client.store') }}" method="POST" hidden >
    @csrf
    <input id="reception_first_name" type="text" name="first_name" value="">
    <input id="reception_last_name" type="text" name="last_name" value="">
    <input id="reception_surname" type="text" name="surname" value="">
    <input id="reception_phone" type="text" name="phone" value="">
    <input id="reception_lead_id" type="text" name="lead_id" value="">
    <input id="reception_time" type="text" name="reception_time" value="">
</form>

{!! $chart->script() !!}


<script type="text/javascript">

    var select_id;
    var table_approved;
    var all_leads;
    function selectId(id) {
        select_id = id;
    }

    function showInput(id) {
        $('#show-input-' + id).css("display", "block");
        $('#open-set-date-' + id).css("display", "none");

        $(function () {
            $('#show-input-' + id).daterangepicker({
                timePicker: true,
                singleDatePicker: true,
                timePicker24Hour: true,

                locale: {
                    format: 'DD.MM.YYYY HH:mm ',
                    applyLabel: "ОК",
                    cancelLabel: "Отмена",
                    daysOfWeek: [
                        "ПН",
                        "ВТ",
                        "СР",
                        "ЧТ",
                        "ПТ",
                        "СБ",
                        "ВС"
                    ],
                    monthNames: [
                        "Январь",
                        "Февраль",
                        "Март",
                        "Апрель",
                        "Май",
                        "Июнь",
                        "Июль",
                        "Август",
                        "Сентябрь",
                        "Октябрь",
                        "Ноябрь",
                        "Декабрь"
                    ],
                },
            });
        });

        $('#show-input-' + id).on('apply.daterangepicker', function (ev, picker) {
            $('#reception_first_name').val($('#send-first-name').text());
            $('#reception_last_name').val($('#send-last-name').text());
            $('#reception_surname').val($('#send-surname').text());
            $('#reception_phone').val($('#send-phone').text());
            $('#reception_lead_id').val(select_id);
            $('#reception_time').val($('#show-input-'+select_id).val());
            let form = $('#lead-approved-form').ajaxSubmit();
            let xhr = form.data('jqxhr');
            xhr.done(function (data) {
                makeAppointmentTable();
                allLeadsTable();
                new PNotify({
                    title: 'Успех',
                    text: 'Встреча назначена',
                    type: 'success',
                    styling: 'bootstrap3'
                })
            });
            xhr.fail(function (data) {
            });
        });
    }
</script>