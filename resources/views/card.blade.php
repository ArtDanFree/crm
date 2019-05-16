@extends('layouts.app')
@section('content')
    <div class="right_col" role="main">
        <div class="page-title">
            <div class="title_left">
                <h3>Карточка лида</h3>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div id="scrolling" class="col-lg-7 col-md-12 col-xs-12">
                    <table id="table" class="table">
                        <tbody>
                        <tr>
                            <td>ФИО</td>
                            <td> {{ $lead->last_name  . ' ' . $lead->first_name . ' ' . $lead->surname}} </td>
                        </tr>
                        <tr>
                            <td>Телефон</td>
                            <td>{{$lead->phone}}</td>
                        </tr>
                        <tr>
                            <td>Желаемая сумма</td>
                            <td>{{$lead->money}}</td>
                        </tr>
                        <tr>
                            <td>Желаемый срок</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Процентная ставка</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Залог</td>
                            <td>{{$lead->depositType->name}}</td>
                        </tr>
                        <tr>
                            <td>Источник</td>
                            <td>{{$lead->source->name}}</td>
                        </tr>
                        </tbody>
                    </table>
                    @if(filled($lead->leadImage))
                        <h3>Документы</h3>
                        @foreach($lead->leadImage as $image)
                            <div class="col-lg-2">
                                <a target="_blank" href="{{ asset('storage/' . $image->img) }}"><img class="w-100 h-100" src="{{ asset('storage/' . $image->img) }}"></a>
                            </div>
                        @endforeach
                    @else
                        <h4>Документы отсутствуют</h4>
                    @endif
                </div>
                <div class="col-lg-3 col-md-12 col-xs-12">
                    <div id="check-panel">
                        <h2>Проверка</h2>

                        <table id="status-table" class="table ">
                            <tbody>
                            <tr>
                                <td>Создан</td>
                                <td>{{$lead->created_at->format('d.m.Y в H:i')}}</td>
                            </tr>
                            <tr>
                                <td>Частный инвестор</td>
                                <td>{{ $lead->chin->last_name  . ' ' . $lead->chin->first_name . ' ' . $lead->chin->surname}}</td>
                            </tr>
                            @if(!empty($lead->comment))
                                <tr>
                                    <td>Комментарий</td>
                                    <td>{{$lead->comment}}</td>
                                </tr>
                            @endif
                            <div id="status-panel">
                                @if(!empty($lead->underwriter_id))
                                    <tr>
                                        <td>Андеррайтер</td>
                                        <td>{{ $lead->underwriter->last_name  . ' ' . $lead->underwriter->first_name . ' ' . $lead->underwriter->surname}}</td>
                                    </tr>
                                    <tr>
                                        <td>Статус</td>
                                        <td>{{$lead->status->name}}</td>
                                    </tr>
                                @endif
                            </div>
                            </tbody>
                        </table>
                        <div id="button-panel">
                            @if(empty($lead->underwriter_id) || ($lead->underwriter_id == auth()->user()->id && $lead->status_id == 5))
                                <button id="start-check" onclick="startCheck({{$lead->id}})" class="btn btn-success btn-block" data-dismiss="modal">
                                    Начать проверку
                                </button>
                            @endif
                            @if($lead->underwriter_id == auth()->user()->id && $lead->status_id == 2)
                                @if(filled($lead->check))
                                    <button id="lead-approved-button" onclick="leadApproval({{$lead->id}})" class="btn btn-success btn-block">
                                        Одобрен
                                    </button>
                                @endif
                                <button data-target="#auto-check" class="btn btn-info btn-block" data-dismiss="modal" data-toggle="modal">
                                    Автоматическая проверка
                                </button>
                                <button class="btn btn-warning btn-block" data-dismiss="modal" data-toggle="modal" data-target="#modification_modal">
                                    Доработать
                                </button>
                                <button class="btn btn-danger btn-block" data-dismiss="modal" data-toggle="modal" data-target="#decline_modal">
                                    Отказаться
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modification_modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div id="offset">
                        <h2>Отправить на доработку частному инвестору</h2>
                        <p>Опишите причину доработки
                            для {{ $lead->last_name  . ' ' . $lead->first_name . ' ' . $lead->surname}}</p>
                    </div>
                    <textarea placeholder='Например, "Нечитаемый ПТС" или "Не хватает СТС"' class="comment" id="remake-comment" required></textarea>
                </div>
                <div class="modal-footer">
                    <button onclick="leadRemake({{$lead->id}});" id="margin_button" class="btn btn-warning" data-dismiss="modal">
                        Доработать
                    </button>
                    <button id="margin_button" class="btn btn-danger" data-dismiss="modal">Отменить</button>
                </div>
            </div>
        </div>
    </div>

    <div id="decline_modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div id="offset">
                        <h2>Отказаться от проверки лида</h2>
                        <p>Опишите причину отказа от проверки
                            для {{ $lead->last_name  . ' ' . $lead->first_name . ' ' . $lead->surname}}</p>
                    </div>
                    <textarea placeholder='Например, "Передаю другому"' class="comment" id="decline-comment" type="text" name="" value="" required></textarea>
                </div>
                <div class="modal-footer">
                    <button id="margin_button" onclick="leadDecline({{$lead->id}});" class="btn btn-warning" data-dismiss="modal">
                        Отказаться
                    </button>
                    <button id="margin_button" class="btn btn-danger" data-dismiss="modal">Отменить</button>
                </div>
            </div>
        </div>
    </div>

    <div id="auto-check" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">Автоматическая проверка</h4>
                </div>
                <form id="transaction_edit_form" method="POST" action="" class="form-horizontal form-label-left">
                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="born_date">Дата
                                рождения:</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input name="born_date" type="text" class="form-control col-md-7 col-xs-12" data-inputmask="'mask': '99-99-9999'">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fms_series">Серия и номер
                                паспорта:</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input name="fms_series" class="form-control col-md-7 col-xs-12" type="text" data-inputmask="'mask': '9999/999999'">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gibdd_vin">VIN:</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input name="gibdd_vin" class="form-control col-md-7 col-xs-12" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pledge_chassis">Шасси:</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input name="pledge_chassis" class="form-control col-md-7 col-xs-12" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pledge_bodyNum">Номер
                                кузова:</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input name="pledge_bodyNum" class="form-control col-md-7 col-xs-12" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gibdd_regnum">рег №:</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input name="gibdd_regnum" class="form-control col-md-7 col-xs-12" type="text" data-inputmask="'mask': 'a999aa/999'">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gibdd_sts">СТС:</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input name="gibdd_sts" class="form-control col-md-7 col-xs-12" type="text">
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button id="update-data-profile" class="btn btn-success">Проверить</button>
                        </div>
                    </div>
                </form>
                <div class="modal-header">
                    <h4 class="modal-title">Ручная проверка</h4>
                </div>
                <div class="modal-body">
                    <ul>
                        <li><a href="https://gibdd.ru">Проверить по ГИБДД</a></li>
                        <li><a href="https://reestr-zalogov.ru">Проверить в реестре залогов</a></li>
                        <li><a href="https://fssprus.ru">Проверить по ФССП</a></li>
                        <li><a href="http://services.fms.gov.ru/info-service.htm?sid=2000">Проверить по ФМС</a></li>
                        <li><a href="http://www.fedsfm.ru/documents/terr-list">Проверить через Росфинмониторинг </a>
                        </li>
                    </ul>
                    <form action="{{ Route('lead.update', $lead->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <textarea id="manual-check" name="check" class="form-control">{!! old('check', $lead->check) !!}</textarea>
                        <script>
                            CKEDITOR.replace('manual-check', window.options);
                        </script>
                        <div class="modal-footer">
                            <div class="col-12 text-center">
                                <button id="update-data-profile" class="btn btn-success">Сохранить</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Назад</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="waiver_modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div id="offset">
                        <h2>Отказ</h2>
                        <p>Опишите причину отказа
                            для {{ $lead->last_name  . ' ' . $lead->first_name . ' ' . $lead->surname}}</p>
                    </div>
                    <textarea placeholder='Например, ""' class="comment" id="waiver-comment" type="text" name="" value="" required></textarea>
                </div>
                <div class="modal-footer">
                    <button id="margin_button" onclick="leadWaiver({{$lead->id}})" onclick="leadDecline({{$lead->id}});" class="btn btn-warning" data-dismiss="modal">
                        Отказать
                    </button>
                    <button id="margin_button" class="btn btn-danger" data-dismiss="modal">Отменить</button>
                </div>
            </div>
        </div>
    </div>
@endsection
