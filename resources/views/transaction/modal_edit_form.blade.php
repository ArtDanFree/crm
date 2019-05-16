<div id="edit-client-data-modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Редактирование данных клиента</h4>
            </div>
            <div class="modal-body">
                <form id="transaction_edit_form" method="POST" action="{{  Route('transaction.update', $transaction)  }}" class="form-horizontal form-label-left">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first_name">Имя:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input name="first_name" type="text" class="{{ $errors->has('first_name') ? 'parsley-error' : '' }} form-control col-md-7 col-xs-12" value="{{ old('first_name', $transaction->client->first_name) }}">
                            @if($errors->has('first_name'))
                                <div class="red">{{ $errors->first('first_name') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last_name">Фамилия:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input name="last_name" type="text" class="{{ $errors->has('last_name') ? 'parsley-error' : '' }} form-control col-md-7 col-xs-12" value="{{ old('last_name', $transaction->client->last_name) }}">
                            @if($errors->has('last_name'))
                                <div class="red">{{ $errors->first('last_name') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="surname">Отчество:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input name="surname" type="text" class="{{ $errors->has('surname') ? 'parsley-error' : '' }} form-control col-md-7 col-xs-12" value="{{ old('surname', $transaction->client->surname) }}">
                            @if($errors->has('surname'))
                                <div class="red">{{ $errors->first('surname') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Телефон:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="phone" name="phone" type="text" class="{{ $errors->has('phone') ? 'parsley-error' : '' }} form-control col-md-7 col-xs-12" value="{{ old('phone', $transaction->client->phone) }}"
                                   data-inputmask="'mask': '7 999 999 99 99'">
                            @if($errors->has('phone'))
                                <div class="red">{{ $errors->first('phone') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="money">Сумма, руб:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input name="money" type="text" class="{{ $errors->has('money') ? 'parsley-error' : '' }} form-control col-md-7 col-xs-12" value="{{ old('money', $transaction->money) }}">
                            @if($errors->has('money'))
                                <div class="red">{{ $errors->first('money') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="percent">Ставка, % в мес.</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input name="percent" type="text" class="{{ $errors->has('percent') ? 'parsley-error' : '' }} form-control col-md-7 col-xs-12" value="{{ old('percent', $transaction->percent) }}">
                            @if($errors->has('percent'))
                                <div class="red">{{ $errors->first('percent') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <p class="lead text-center">Паспортные данные:</p>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="passport_series">Серия:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input name="passport_series" type="text" class="{{ $errors->has('passport_series') ? 'parsley-error' : '' }} form-control col-md-7 col-xs-12" value="{{ old('passport_series', $transaction->client->passport_series) }}"
                                   data-inputmask="'mask': '99 99'">
                            @if($errors->has('passport_series'))
                                <div class="red">{{ $errors->first('passport_series') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="passport_id">Номер:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input name="passport_id" type="text" class="{{ $errors->has('passport_id') ? 'parsley-error' : '' }} form-control col-md-7 col-xs-12" value="{{ old('passport_id', $transaction->client->passport_id) }}"
                                   data-inputmask="'mask': '999999'">
                            @if($errors->has('passport_id'))
                                <div class="red">{{ $errors->first('passport_id') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="birthday">Дата рождения:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input name="birthday" type="text" class="{{ $errors->has('birthday') ? 'parsley-error' : '' }} form-control col-md-7 col-xs-12" value="{{ old('birthday', $transaction->client->birthday ? $transaction->client->birthday->format('d-m-Y') : '' ) }}"
                                   data-inputmask="'mask': '9999-99-99'" >
                            @if($errors->has('birthday'))
                                <div class="red">{{ $errors->first('birthday') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="issued_by">Кем выдан:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input name="issued_by" type="text" class="{{ $errors->has('issued_by') ? 'parsley-error' : '' }} form-control col-md-7 col-xs-12" value="{{ old('issued_by', $transaction->client->issued_by) }}">
                            @if($errors->has('issued_by'))
                                <div class="red">{{ $errors->first('issued_by') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="when_issued">Когда выдан:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input name="when_issued" type="text" class="{{ $errors->has('when_issued') ? 'parsley-error' : '' }} form-control col-md-7 col-xs-12" value="{{ old('when_issued', $transaction->client->when_issued) }}"
                                   data-inputmask="'mask': '9999-99-99'">
                            @if($errors->has('when_issued'))
                                <div class="red">{{ $errors->first('when_issued') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="division_code">Код подразделения:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input name="division_code" type="text" class="{{ $errors->has('division_code') ? 'parsley-error' : '' }} form-control col-md-7 col-xs-12" value="{{ old('division_code', $transaction->client->division_code) }}"
                                   data-inputmask="'mask': '999-999'">
                            @if($errors->has('division_code'))
                                <div class="red">{{ $errors->first('division_code') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="registration_address">Адрес регистрации:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input name="registration_address" type="text" class="{{ $errors->has('registration_address') ? 'parsley-error' : '' }} form-control col-md-7 col-xs-12" value="{{ old('registration_address', $transaction->client->registration_address) }}">
                            @if($errors->has('registration_address'))
                                <div class="red">{{ $errors->first('registration_address') }}</div>
                            @endif
                        </div>
                    </div>


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
<script>

</script>