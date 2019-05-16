@extends('layouts.app')
@section('content')
    <script type="text/javascript">
        window.onload = function () {
            expiration(12);
            el = document.getElementById('month_count');
//  el.value='12';
            calculate();
        };
    </script>
    <div class="right_col" role="main">
        <div class="container">
            <div class="col-lg-5 show_lead">
                <h3>Карточка сделки</h3>
                <div class="col-lg-8">
                    <table id="table" class="table ">
                        <tbody>
                        <tr>
                            <td>ФИО</td>
                            <td>
                                {{ fullName($transaction->client) ?: '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Телефон</td>
                            <td>{{ $transaction->client->phone ?: '-' }}</td>
                        </tr>
                        <tr>
                            <td>Сумма, руб</td>
                            <td>{{ $transaction->money ?: '-' }}</td>
                        </tr>
                        <tr>
                            <td>Ставка, % в мес.</td>
                            <td>{{ $transaction->percent ?: '-' }}</td>
                        </tr>
                        <tr>
                            <td>Дата выдачи кредита</td>
                            <td>{{ $transaction->created_at->format('d.m.Y') ?: '-' }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="clearfix"></div>
                <h3> Паспортные данные</h3>
                <div class="col-lg-8">
                    <table id="table" class="table ">
                        <tbody>
                        <tr>
                            <td>Серия</td>
                            <td>{{ $transaction->client->passport_series ?: '-'}}</td>
                        </tr>
                        <tr>
                            <td>Номер</td>
                            <td>{{ $transaction->client->passport_id ?: '-' }}</td>
                        </tr>
                        <tr>
                            <td>Дата рождения</td>
                            <td>{{ $transaction->client->birthday ? $transaction->client->birthday->format('d-m-Y') : '-' }}</td>
                        </tr>
                        <tr>
                            <td>Кем выдан</td>
                            <td>{{ $transaction->client->issued_by ?: '-' }}</td>
                        </tr>
                        <tr>
                            <td>Когда выдан</td>
                            <td>{{ $transaction->client->when_issued ?: '-' }}</td>
                        </tr>
                        <tr>
                            <td>Код подразд.</td>
                            <td>{{ $transaction->client->division_code ?: '-' }}</td>
                        </tr>
                        <tr>
                            <td>Адрес регистрации</td>
                            <td>{{ $transaction->client->registration_address ?: '-' }}</td>
                        </tr>
                        <tr>
                            <td><a data-toggle="modal" data-target="#edit-client-data-modal" class="btn btn-dark">Редактировать</a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-12">
                    <h3>Документы</h3>
                    @foreach($transaction->client->lead->leadImage as $image)
                        <div class="col-lg-3">
                            <a target="_blank" href="{{ asset('storage/' . $image->img) }}"><img class="w-100 h-100" src="{{ asset('storage/' . $image->img) }}"></a>
                        </div>
                    @endforeach
                </div>

                <div id="show_file"></div>
                <form action="" target="rFrame" method="POST" enctype="multipart/form-data">
                    <div class="hiddenInput">
                        <input type="file" id="my_hidden_file" style="display: none" accept="image/jpeg,image/png,image/gif" name="loadfile" onchange=" Count();" multiple>
                        <input type="submit" id="my_hidden_load" style="display: none" value='Загрузить'>
                    </div>
                </form>
            </div>

            <div id="scrolling" class="col-lg-6 col-sm-12 col-xs-12 show_lead">
                @can('Редактировать сделку со статусом ' . $transaction->status->name)
                    <div class="x_panel">
                        <div class="x_title">
                            <h2><i class="fa fa-plus"></i> Добавить</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button" aria-expanded="false">
                                Залог <span class="caret"></span>
                            </button>
                            <ul role="menu" class="dropdown-menu">
                                @foreach($transaction->depositType->deposit as $deposit)
                                    <li>
                                        <a data-toggle="modal" data-target=".add-deposit-id-{{ $deposit->id }}">{{ $deposit->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <button data-toggle="modal" data-target=".add-deposit-id-6" type="button" class="btn btn-default">
                                Поручителя
                            </button>
                            <button data-toggle="modal" data-target=".add-deposit-id-7" type="button" class="btn btn-default">
                                Юр.лицо
                            </button>
                            @include('transactions.description.add_modal')
                        </div>
                    </div>
                @endcan
                <div class="x_panel">
                    <div class="x_title">
                        <h2><i class="fa fa-align-left"></i> Детальная информация</h2>
                        <div class="clearfix"></div>
                    </div>Заполните все поля
                    <div class="x_content">
                        @include('transactions.description.accordion')
                    </div>
                </div>
                    @include('transaction.modal_edit_form')
                <script type="text/javascript">
                    function new_type(id, type) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: 'POST',
                            url: '{{route('new_type')}}',
                            data: {id: id, type: type},
                            dataType: 'json',
                            success: function (data) {
                                new PNotify({
                                    title: 'Успех',
                                    text: '',
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
                    }
                </script>

                <script type="text/javascript">
                    $(function () {


                        $("#save-descriptions").click(function () {

                            var types = [];
                            if ($("#pts_section").length) {
                                types[0] = 1;
                            }
                            if ($("#pts_section").length) {
                                types[1] = 1;
                            }


                            var msg = $('#formx').serialize();
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                }
                            });
                            $.ajax({
                                type: 'POST',
                                url: '{{route('description_update')}}',
                                data: {msg: msg, id: {{$transaction->id}}, types: types},
                                dataType: 'json',
                                success: function (data) {
                                    new PNotify({
                                        title: 'Успех',
                                        text: '',
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
                    });
                </script>
            </div>

        </div>

    </div>

@endsection
