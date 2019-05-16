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
                            <div class="ln_solid"></div>
                            <p class="lead text-center">Паспортные данные:</p>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="passport_series">Серия паспорта:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="passport_series" type="text" class="{{ $errors->has('passport_series') ? 'parsley-error' : '' }} form-control col-md-7 col-xs-12" value="{{ old('passport_series', auth()->user()->passport_series) }}"
                                           data-inputmask="'mask': '99 99'">
                                    @if($errors->has('passport_series'))
                                        <div class="red">{{ $errors->first('passport_series') }}</div>
                                        @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="passport_id">Номер паспорта:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="passport_id" type="text" class="{{ $errors->has('passport_id') ? 'parsley-error' : '' }} form-control col-md-7 col-xs-12" value="{{ old('passport_id', auth()->user()->passport_id) }}"
                                           data-inputmask="'mask': '999999'">
                                    @if($errors->has('passport_id'))
                                        <div class="red">{{ $errors->first('passport_id') }}</div>
                                        @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="birthday">Дата рождения:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="birthday" type="text" class="{{ $errors->has('birthday') ? 'parsley-error' : '' }} form-control col-md-7 col-xs-12" value="{{ old('birthday', auth()->user()->birthday->format('Y-m-d')) }}"
                                           data-inputmask="'mask': '9999-99-99'" >
                                    @if($errors->has('birthday'))
                                        <div class="red">{{ $errors->first('birthday') }}</div>
                                        @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="issued_by">Кем выдан:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="issued_by" type="text" class="{{ $errors->has('issued_by') ? 'parsley-error' : '' }} form-control col-md-7 col-xs-12" value="{{ old('issued_by', auth()->user()->issued_by) }}">
                                    @if($errors->has('issued_by'))
                                        <div class="red">{{ $errors->first('issued_by') }}</div>
                                        @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="when_issued">Когда выдан:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="when_issued" type="text" class="{{ $errors->has('when_issued') ? 'parsley-error' : '' }} form-control col-md-7 col-xs-12" value="{{ old('when_issued', auth()->user()->when_issued) }}">
                                    @if($errors->has('when_issued'))
                                        <div class="red">{{ $errors->first('when_issued') }}</div>
                                        @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="division_code">Код подразделения:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="division_code" type="text" class="{{ $errors->has('division_code') ? 'parsley-error' : '' }} form-control col-md-7 col-xs-12" value="{{ old('division_code', auth()->user()->division_code) }}"
                                           data-inputmask="'mask': '999-999'">
                                    @if($errors->has('division_code'))
                                        <div class="red">{{ $errors->first('division_code') }}</div>
                                        @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="registration_address">Адрес регистрации:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="registration_address" type="text" class="{{ $errors->has('registration_address') ? 'parsley-error' : '' }} form-control col-md-7 col-xs-12" value="{{ old('registration_address', auth()->user()->registration_address) }}">
                                    @if($errors->has('registration_address'))
                                        <div class="red">{{ $errors->first('registration_address') }}</div>
                                        @endif
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <p class="lead text-center">Банковские реквизиты:</p>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bankcard_number">Номер банковской карты:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="bankcard_number" type="text" class="{{ $errors->has('bankcard_number') ? 'parsley-error' : '' }} form-control col-md-7 col-xs-12" value="{{ old('bankcard_number', auth()->user()->bankcard_number) }}"
                                           data-inputmask="'mask': '9999 9999 9999 9999'">
                                    @if($errors->has('bankcard_number'))
                                        <div class="red">{{ $errors->first('bankcard_number') }}</div>
                                        @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="personal_account">Лицевой счет:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="personal_account" type="text" class="{{ $errors->has('personal_account') ? 'parsley-error' : '' }} form-control col-md-7 col-xs-12" value="{{ old('personal_account', auth()->user()->personal_account) }}">
                                    @if($errors->has('personal_account'))
                                        <div class="red">{{ $errors->first('personal_account') }}</div>
                                        @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="corr_account">Корр. счет</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="corr_account" type="text" class="{{ $errors->has('corr_account') ? 'parsley-error' : '' }} form-control col-md-7 col-xs-12" value="{{ old('corr_account', auth()->user()->corr_account) }}">
                                    @if($errors->has('corr_account'))
                                        <div class="red">{{ $errors->first('corr_account') }}</div>
                                        @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bik">БИК:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="bik" type="text" class="{{ $errors->has('bik') ? 'parsley-error' : '' }} form-control col-md-7 col-xs-12" value="{{ old('bik', auth()->user()->bik) }}">
                                    @if($errors->has('bik'))
                                        <div class="red">{{ $errors->first('bik') }}</div>
                                        @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bank_name">Наименование банка:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="bank_name" type="text" class="{{ $errors->has('bank_name') ? 'parsley-error' : '' }} form-control col-md-7 col-xs-12" value="{{ old('bank_name', auth()->user()->bank_name) }}">
                                    @if($errors->has('bank_name'))
                                        <div class="red">{{ $errors->first('bank_name') }}</div>
                                        @endif
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <p class="lead text-center">Подсудность договоров:</p>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="court">Суд (предложный падеж)</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="court" type="text" class="{{ $errors->has('court') ? 'parsley-error' : '' }} form-control col-md-7 col-xs-12" value="{{ old('court', auth()->user()->court) }}">
                                    @if($errors->has('court'))
                                        <div class="red">{{ $errors->first('court') }}</div>
                                        @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="court_address">Адрес суда:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="court_address" type="text" class="{{ $errors->has('court_address') ? 'parsley-error' : '' }} form-control col-md-7 col-xs-12" value="{{ old('court_address', auth()->user()->court_address) }}">
                                    @if($errors->has('court_address'))
                                        <div class="red">{{ $errors->first('court_address') }}</div>
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
@section('script')
    <!-- jquery.inputmask -->
    <script src="{{ asset('vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js') }}"></script>
    @endsection