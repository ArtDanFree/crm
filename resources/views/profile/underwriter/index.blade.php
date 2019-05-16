@extends('layouts.app')
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Профиль Андеррайтера</h3>
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
                                        <li><i class="fa fa-mobile" aria-hidden="true"></i> {{ auth()->user()->phone ?: '-' }}</li>
                                        <li>
                                            <i class="fa fa-vk" aria-hidden="true"></i>
                                            <a href="{{ auth()->user()->vk }}">{{ friendlyURL(auth()->user()->vk) ?: '-' }}</a>
                                        </li>

                                </ul>
                                <a href="{{ Route('profile_edit') }}" class="btn btn-success"><i class="fa fa-edit m-right-xs"></i> Редактировать</a>
                            </div>
                            <div class="col-md-9 col-sm-9 col xs-12">
                                <div class="col-lg-4">
                                    <div class="table-responsive">
                                        <p class="lead">Личные данные: </p>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <th>Имя:</th>
                                                <td>{{ auth()->user()->first_name ?: '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Фамилия:</th>
                                                <td>{{ auth()->user()->last_name ?: '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Отчество:</th>
                                                <td>{{ auth()->user()->surname ?: '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Часовой пояс:</th>
                                                <td>+{{ auth()->user()->utc ?: '-' }}</td>
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