@extends('layouts.app')
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Профиль Частного инвестора</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12 profile_left">
                                <div class="profile_img">
                                    <div id="crop-avatar">
                                        <!-- Current avatar -->
                                        <img class="img-responsive avatar-view user-avatar" alt="Аватар"
                                             src="{{ srcAvatar(auth()->user()) }}"
                                             style="cursor: pointer" width="220" height="220">
                                    </div>
                                </div>
                                <h3>{{ Request::user()->first_name }}</h3>
                                <ul class="list-unstyled user_data">
                                    @if(auth()->user()->phone)
                                        <li><i class="fa fa-mobile" aria-hidden="true"></i> {{ auth()->user()->phone }}</li>
                                    @endif
                                    @if(auth()->user()->vk)
                                        <li>
                                            <i class="fa fa-vk" aria-hidden="true"></i>
                                            <a href="{{ auth()->user()->vk }}">{{ friendlyURL(auth()->user()->vk) }}</a>
                                        </li>
                                    @endif

                                </ul>
                                <a href="{{ Route('profile_edit') }}" class="btn btn-success"><i class="fa fa-edit m-right-xs"></i> Редактировать</a>
                            </div>
                            <div class="col-md-9 col-sm-9 col xs-12">
                                <div class="col-lg-4">
                                    <div class="table-responsive">
                                        <p class="lead">Паспортные данные:</p>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <th>Серия паспорта</th>
                                                <td>{{ auth()->user()->passport_series ?: '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Номер паспорта:</th>
                                                <td>{{ auth()->user()->passport_id ?: '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Дата рождения:</th>
                                                <td>{{ auth()->user()->birthday->format('Y-m-d') ?: '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Кем выдан:</th>
                                                <td>{{ auth()->user()->issued_by ?: '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Когда выдан:</th>
                                                <td>{{ auth()->user()->when_issued ?: '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Код подразделения:</th>
                                                <td>{{ auth()->user()->division_code ?: '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Адрес регистрации:</th>
                                                <td>{{ auth()->user()->registration_address ?: '-' }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <p class="lead">Банковские реквизиты:</p>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <th>Номер банковской карты:</th>
                                                <td>{{ auth()->user()->bankcard_number ?: '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Лицевой счет:</th>
                                                <td>{{ auth()->user()->personal_account ?: '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Корр. счет</th>
                                                <td>{{ auth()->user()->corr_account ?: '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>БИК:</th>
                                                <td>{{ auth()->user()->bik ?: '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Наименование банка:</th>
                                                <td>{{ auth()->user()->bank_name ?: '-' }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <p class="lead">Подсудность договоров:</p>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <th>Суд (предложный падеж)</th>
                                                <td>{{ auth()->user()->court ?: '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Адрес суда:</th>
                                                <td>{{ auth()->user()->court_address ?: '-' }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Изменить аватар</h4>
                </div>
                <form id="change-avatar-form" action="{{ Route('change_avatar') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div id="change-avatar-input" class="form-group">
                        <input style="margin-top: 10px" type="file" name="avatar"  id="avatar-file">
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Назад</button>
                    <button id="change-avatar-button" type="button" class="btn btn-primary">Сохранить</button>
                </div>
            </div>
        </div>
    </div>
@endsection