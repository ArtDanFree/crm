@extends('layouts.app')
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Редактирование личных данных </h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <form id="update_profile_form" method="POST" action="{{  Route('profile_update')  }}" class="form-horizontal form-label-left">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first_name">Имя:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="first_name" type="text" class="{{ $errors->has('first_name') ? 'parsley-error' : '' }} form-control col-md-7 col-xs-12" value="{{ old('first_name', auth()->user()->first_name) }}">
                                    @if($errors->has('first_name'))
                                        <div class="red">{{ $errors->first('first_name') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last_name">Фамилия:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="last_name" type="text" class="{{ $errors->has('last_name') ? 'parsley-error' : '' }} form-control col-md-7 col-xs-12" value="{{ old('last_name', auth()->user()->last_name) }}">
                                    @if($errors->has('last_name'))
                                        <div class="red">{{ $errors->first('last_name') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="surname">Отчество:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="surname" type="text" class="{{ $errors->has('surname') ? 'parsley-error' : '' }} form-control col-md-7 col-xs-12" value="{{ old('surname', auth()->user()->surname) }}">
                                    @if($errors->has('surname'))
                                        <div class="red">{{ $errors->first('surname') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vk">ВКонтакте:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="vk" type="text" class="{{ $errors->has('vk') ? 'parsley-error' : '' }} form-control col-md-7 col-xs-12" value="{{ old('vk', auth()->user()->vk) }}">
                                    @if($errors->has('vk'))
                                        <div class="red">{{ $errors->first('vk') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Телефон:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="phone" type="text" class="{{ $errors->has('phone') ? 'parsley-error' : '' }} form-control col-md-7 col-xs-12" value="{{ old('phone', auth()->user()->phone) }}"
                                           data-inputmask="'mask': '7 999 999 99 99'">
                                    @if($errors->has('phone'))
                                        <div class="red">{{ $errors->first('phone') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="utc">Часовой пояс: +</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="utc" type="text" class="{{ $errors->has('utc') ? 'parsley-error' : '' }} form-control col-md-7 col-xs-12" value="{{ old('utc', auth()->user()->utc) }}">
                                    @if($errors->has('utc'))
                                        <div class="red">{{ $errors->first('utc') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="col-12 text-center">
                                <button id="update-data-profile" class="btn btn-success">Сохранить</button>
                                <a href="{{ Route('profile') }}" class="btn btn-primary">Назад</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection