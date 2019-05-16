@if(!empty($transaction->depositType))

@if($transaction->depositType->name = 'Автомобиль')
<div class="modal fade add-deposit-id-1" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Добавить залог "Автомобиль на стоянке"</h4>
            </div>
            <div class="modal-body">
                <form id="add-transaction-description-form-1" class="add-transaction-description-form" method="POST" action="{{ route('transaction_description.store', $transaction->id) }}">
                    @csrf
                    <input name="transaction_id" value="{{ $transaction->id }}" hidden>
                    <input hidden name="deposit_id" value="1">
                    <label for="VIN">VIN</label>
                    <input type="text"  class="form-control" name="VIN" id="VIN" value="{{ old('VIN') }}">

                    <label for="model_ts">Марка, модель ТС</label>
                    <input type="text"  class="form-control" name="model_ts" id="model_ts" value="{{ old('model_ts') }}">

                    <label for="object">Объект</label>
                    <input type="text"  class="form-control" name="object" id="object" value="{{ old('object') }}">

                    <label for="year_of_manufacture">Год изготовления ТС</label>
                    <input type="text"  class="form-control" name="year_of_manufacture" id="year_of_manufacture" value="{{ old('year_of_manufacture') }}">

                    <label for="engine_number">Номер двигателя</label>
                    <input type="text"  class="form-control" name="engine_number" id="engine_number" value="{{ old('engine_number') }}">

                    <label for="bodywork_number">Номер кузова</label>
                    <input type="text"  class="form-control" name="bodywork_number" id="bodywork_number" value="{{ old('bodywork_number') }}">

                    <label for="color">Цвет</label>
                    <input type="text"  class="form-control" name="color" id="color" value="{{ old('color') }}">

                    <label for="pts_series">ПТС серия</label>
                    <input type="text"  class="form-control" name="pts_series" id="pts_series" value="{{ old('pts_series') }}">

                    <label for="pts_number">ПТС номер</label>
                    <input type="text"  class="form-control" name="pts_number" id="pts_number" value="{{ old('pts_number') }}">

                    <label for="pts_issued">ПТС кем выдан</label>
                    <input type="text"  class="form-control" name="pts_issued" id="pts_issued" value="{{ old('pts_issued') }}">

                    <label for="pts_date_issued">ПТС дата выдачи</label>
                    <input type="text"  class="form-control" name="pts_date_issued" id="pts_date_issued" value="{{ old('pts_date_issued') }}">

                    <label for="state_number">Госномер ТС</label>
                    <input type="text"  class="form-control" name="state_number" id="state_number" value="{{ old('state_number') }}">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                <button type="button" class="btn btn-success send-form-transaction-description" data-form_id="1">Добавить</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade add-deposit-id-2" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Добавить залог "ПТС"</h4>
            </div>
            <div class="modal-body">
                <form id="add-transaction-description-form-2" class="add-transaction-description-form" method="POST" action="{{ route('transaction_description.store', $transaction->id) }}">
                    @csrf
                    <input name="transaction_id" value="{{ $transaction->id }}" hidden>
                    <input hidden name="deposit_id" value="2">

                    <label for="VIN">VIN</label>
                    <input type="text"  class="form-control" name="VIN" id="VIN" value="{{ old('VIN') }}">

                    <label for="model_ts">Марка, модель ТС</label>
                    <input type="text"  class="form-control" name="model_ts" id="model_ts" value="{{ old('model_ts') }}">

                    <label for="object">Объект</label>
                    <input type="text"  class="form-control" name="object" id="object" value="{{ old('object') }}">

                    <label for="year_of_manufacture">Год изготовления ТС</label>
                    <input type="text"  class="form-control" name="year_of_manufacture" id="year_of_manufacture" value="{{ old('year_of_manufacture') }}">

                    <label for="engine_number">Номер двигателя</label>
                    <input type="text"  class="form-control" name="engine_number" id="engine_number" value="{{ old('engine_number') }}">

                    <label for="bodywork_number">Номер кузова</label>
                    <input type="text"  class="form-control" name="bodywork_number" id="bodywork_number" value="{{ old('bodywork_number') }}">

                    <label for="color">Цвет</label>
                    <input type="text"  class="form-control" name="color" id="color" value="{{ old('color') }}">

                    <label for="pts_series">ПТС серия</label>
                    <input type="text"  class="form-control" name="pts_series" id="pts_series" value="{{ old('pts_series') }}">

                    <label for="pts_number">ПТС номер</label>
                    <input type="text"  class="form-control" name="pts_number" id="pts_number" value="{{ old('pts_number') }}">

                    <label for="pts_issued">ПТС кем выдан</label>
                    <input type="text"  class="form-control" name="pts_issued" id="pts_issued" value="{{ old('pts_issued') }}">

                    <label for="pts_date_issued">ПТС дата выдачи</label>
                    <input type="text"  class="form-control" name="pts_date_issued" id="pts_date_issued" value="{{ old('pts_date_issued') }}">

                    <label for="state_number">Госномер ТС</label>
                    <input type="text"  class="form-control" name="state_number" id="state_number" value="{{ old('state_number') }}">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                <button type="button" class="btn btn-success send-form-transaction-description" data-form_id="2">Добавить</button>
            </div>
        </div>
    </div>
</div>
@endif
@if($transaction->depositType->name = 'Недвижимость')
<div class="modal fade add-deposit-id-3" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Добавить залог "Земля"</h4>
            </div>
            <div class="modal-body">
                <form id="add-transaction-description-form-3" class="add-transaction-description-form" method="POST" action="{{ route('transaction_description.store', $transaction->id) }}">
                    @csrf
                    <input name="transaction_id" value="{{ $transaction->id }}" hidden>
                    <input hidden name="deposit_id" value="3">
                    <label for="price_market">Цена по рынку, руб.</label>
                    <input type="text"  class="form-control" name="price_market" id="price_market" value="{{ old('price_market') }}">

                    <label for="evaluative_price">Наша оценка, руб.</label>
                    <input type="text"  class="form-control" name="evaluative_price" id="evaluative_price" value="{{ old('evaluative_price') }}">

                    <label for="appointment">Назначение</label>
                    <input type="text"  class="form-control" name="appointment" id="appointment" value="{{ old('appointment') }}">

                    <label for="area">Общая площадь, кв.м</label>
                    <input type="text"  class="form-control" name="area" id="area" value="{{ old('area') }}">

                    <label for="address">Адрес расположения объекта</label>
                    <input type="text"  class="form-control" name="address" id="address" value="{{ old('address') }}">

                    <label for="basis">Основание владения объектом (род.падеж)</label>
                    <input type="text"  class="form-control" name="basis" id="basis" value="{{ old('basis') }}">

                    <label for="cadastral_number">Кадастровый или условный номер</label>
                    <input type="text"  class="form-control" name="cadastral_number" id="cadastral_number" value="{{ old('cadastral_number') }}">

                    <label for="ownership_documents">Документ, подтверждающий право собственности</label>
                    <input type="text"  class="form-control" name="ownership_documents" id="ownership_documents" value="{{ old('ownership_documents') }}">

                    <label for="number_ownership_documents">Серия и номер документа, подтверждающего право собственности</label>
                    <input type="text"  class="form-control" name="number_ownership_documents" id="number_ownership_documents" value="{{ old('number_ownership_documents') }}">

                    <label for="date_ownership_documents">Дата выдачи документа, подтверждающего право собственности</label>
                    <input type="text"  class="form-control" name="date_ownership_documents" id="date_ownership_documents" value="{{ old('date_ownership_documents') }}">

                    <label for="ownership_documents_issued">Кем выдан документ</label>
                    <input type="text"  class="form-control" name="ownership_documents_issued" id="ownership_documents_issued" value="{{ old('ownership_documents_issued') }}">

                    <label for="restriction">Наличие ограничений или обременений</label>
                    <input type="text"  class="form-control" name="restriction" id="restriction" value="{{ old('restriction') }}">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                <button type="button" class="btn btn-success send-form-transaction-description" data-form_id="3">Добавить</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade add-deposit-id-4" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Добавить залог "Квартира"</h4>
            </div>
            <div class="modal-body">
                <form id="add-transaction-description-form-4" class="add-transaction-description-form" method="POST" action="{{ route('transaction_description.store', $transaction->id) }}">
                    @csrf
                    <input name="transaction_id" value="{{ $transaction->id }}" hidden>
                    <input hidden name="deposit_id" value="4">
                    <label for="price_market">Цена по рынку, руб.</label>
                    <input type="text"  class="form-control" name="price_market" id="price_market" value="{{ old('price_market') }}">

                    <label for="evaluative_price">Наша оценка, руб.</label>
                    <input type="text"  class="form-control" name="evaluative_price" id="evaluative_price" value="{{ old('evaluative_price') }}">

                    <label for="appointment">Назначение</label>
                    <input type="text"  class="form-control" name="appointment" id="appointment" value="{{ old('appointment') }}">

                    <label for="area">Общая площадь, кв.м</label>
                    <input type="text"  class="form-control" name="area" id="area" value="{{ old('area') }}">

                    <label for="floor">Этаж</label>
                    <input type="text"  class="form-control" name="floor" id="floor" value="{{ old('floor') }}">

                    <label for="address">Адрес расположения объекта</label>
                    <input type="text"  class="form-control" name="address" id="address" value="{{ old('address') }}">

                    <label for="basis">Основание владения объектом (род.падеж)</label>
                    <input type="text"  class="form-control" name="basis" id="basis" value="{{ old('basis') }}">

                    <label for="cadastral_number">Кадастровый или условный номер</label>
                    <input type="text"  class="form-control" name="cadastral_number" id="cadastral_number" value="{{ old('cadastral_number') }}">

                    <label for="ownership_documents">Документ, подтверждающий право собственности</label>
                    <input type="text"  class="form-control" name="ownership_documents" id="ownership_documents" value="{{ old('ownership_documents') }}">

                    <label for="number_ownership_documents">Серия и номер документа, подтверждающего право собственности</label>
                    <input type="text"  class="form-control" name="number_ownership_documents" id="number_ownership_documents" value="{{ old('number_ownership_documents') }}">

                    <label for="date_ownership_documents">Дата выдачи документа, подтверждающего право собственности</label>
                    <input type="text"  class="form-control" name="date_ownership_documents" id="date_ownership_documents" value="{{ old('date_ownership_documents') }}">

                    <label for="ownership_documents_issued">Кем выдан документ</label>
                    <input type="text"  class="form-control" name="ownership_documents_issued" id="ownership_documents_issued" value="{{ old('ownership_documents_issued') }}">

                    <label for="restriction">Наличие ограничений или обременений</label>
                    <input type="text"  class="form-control" name="restriction" id="restriction" value="{{ old('restriction') }}">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                <button type="button" class="btn btn-success send-form-transaction-description" data-form_id="4">Добавить</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade add-deposit-id-5" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Добавить залог "Дом"</h4>
            </div>
            <div class="modal-body">
                <form id="add-transaction-description-form-5" class="add-transaction-description-form" method="POST" action="{{ route('transaction_description.store', $transaction->id) }}">
                    @csrf
                    <input name="transaction_id" value="{{ $transaction->id }}" hidden>
                    <input hidden name="deposit_id" value="5">
                    <label for="price_market">Цена по рынку, руб.</label>
                    <input type="text"  class="form-control" name="price_market" id="price_market" value="{{ old('price_market') }}">

                    <label for="evaluative_price">Наша оценка, руб.</label>
                    <input type="text"  class="form-control" name="evaluative_price" id="evaluative_price" value="{{ old('evaluative_price') }}">

                    <label for="appointment">Назначение</label>
                    <input type="text"  class="form-control" name="appointment" id="appointment" value="{{ old('appointment') }}">

                    <label for="area">Общая площадь, кв.м</label>
                    <input type="text"  class="form-control" name="area" id="area" value="{{ old('area') }}">

                    <label for="floors_count">Этажей</label>
                    <input type="text"  class="form-control" name="floors_count" id="floors_count" value="{{ old('floors_count') }}">

                    <label for="address">Адрес расположения объекта</label>
                    <input type="text"  class="form-control" name="address" id="address" value="{{ old('address') }}">

                    <label for="basis">Основание владения объектом (род.падеж)</label>
                    <input type="text"  class="form-control" name="basis" id="basis" value="{{ old('basis') }}">

                    <label for="cadastral_number">Кадастровый или условный номер</label>
                    <input type="text"  class="form-control" name="cadastral_number" id="cadastral_number" value="{{ old('cadastral_number') }}">

                    <label for="ownership_documents">Документ, подтверждающий право собственности</label>
                    <input type="text"  class="form-control" name="ownership_documents" id="ownership_documents" value="{{ old('ownership_documents') }}">

                    <label for="number_ownership_documents">Серия и номер документа, подтверждающего право собственности</label>
                    <input type="text"  class="form-control" name="number_ownership_documents" id="number_ownership_documents" value="{{ old('number_ownership_documents') }}">

                    <label for="date_ownership_documents">Дата выдачи документа, подтверждающего право собственности</label>
                    <input type="text"  class="form-control" name="date_ownership_documents" id="date_ownership_documents" value="{{ old('date_ownership_documents') }}">

                    <label for="ownership_documents_issued">Кем выдан документ</label>
                    <input type="text"  class="form-control" name="ownership_documents_issued" id="ownership_documents_issued" value="{{ old('ownership_documents_issued') }}">

                    <label for="restriction">Наличие ограничений или обременений</label>
                    <input type="text"  class="form-control" name="restriction" id="restriction" value="{{ old('restriction') }}">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                <button type="button" class="btn btn-success send-form-transaction-description" data-form_id="5">Добавить</button>
            </div>
        </div>
    </div>
</div>
@endif
<div class="modal fade add-deposit-id-6" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Добавить поручителя</h4>
            </div>
            <div class="modal-body">
                <form id="add-transaction-description-form-6" class="add-transaction-description-form" method="POST" action="{{ route('transaction_description.store', $transaction->id) }}">
                    @csrf
                    <input name="transaction_id" value="{{ $transaction->id }}" hidden>
                    <input hidden name="deposit_id" value="6">
                    <label for="fio">ФИО</label>
                    <input type="text"  class="form-control" name="fio" id="fio" value="{{ old('fio') }}">

                    <label for="phone">Телефон</label>
                    <input type="text"  class="form-control" name="phone" id="phone" value="{{ old('phone') }}">

                    <label for="series">Серия</label>
                    <input type="text"  class="form-control" name="series" id="series" value="{{ old('series') }}">

                    <label for="number">Номер</label>
                    <input type="text"  class="form-control" name="number" id="number" value="{{ old('number') }}">

                    <label for="birthdate">Дата рождения</label>
                    <input type="text"  class="form-control" name="birthdate" id="birthdate" value="{{ old('birthdate') }}">

                    <label for="place_of_birth">Место рождения</label>
                    <input type="text"  class="form-control" name="place_of_birth" id="place_of_birth" value="{{ old('place_of_birth') }}">

                    <label for="issued">Кем выдан</label>
                    <input type="text"  class="form-control" name="issued" id="issued" value="{{ old('issued') }}">

                    <label for="when_issued">Когда выдан</label>
                    <input type="text"  class="form-control" name="when_issued" id="when_issued" value="{{ old('when_issued') }}">

                    <label for="department_code">Код подразделения</label>
                    <input type="text"  class="form-control" name="department_code" id="department_code" value="{{ old('department_code') }}">

                    <label for="registration_address">Адрес регистрации</label>
                    <input type="text"  class="form-control" name="registration_address" id="registration_address" value="{{ old('registration_address') }}">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                <button type="button" class="btn btn-success send-form-transaction-description" data-form_id="6">Добавить</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade add-deposit-id-7" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Добавить Юр.лицо</h4>
            </div>
            <div class="modal-body">
                <form id="add-transaction-description-form-7" class="add-transaction-description-form" method="POST" action="{{ route('transaction_description.store', $transaction->id) }}">
                    @csrf
                    <input name="transaction_id" value="{{ $transaction->id }}" hidden>
                    <input hidden name="deposit_id" value="7">
                    <label for="legal_entity_name">Наименование юр.лица</label>
                    <input type="text"  class="form-control" name="legal_entity_name" id="legal_entity_name" value="{{ old('legal_entity_name') }}">

                    <label for="short_name">Сокращенно</label>
                    <input type="text"  class="form-control" name="short_name" id="short_name" value="{{ old('short_name') }}">

                    <label for="legal_address">Юридический адрес</label>
                    <input type="text"  class="form-control" name="legal_address" id="legal_address" value="{{ old('legal_address') }}">

                    <label for="ogrn">ОГРН</label>
                    <input type="text"  class="form-control" name="ogrn" id="ogrn" value="{{ old('ogrn') }}">

                    <label for="inn">ИНН</label>
                    <input type="text"  class="form-control" name="inn" id="inn" value="{{ old('inn') }}">

                    <label for="kpp">КПП</label>
                    <input type="text"  class="form-control" name="kpp" id="kpp" value="{{ old('kpp') }}">

                    <label for="position_of_representative">Должнасть представителя</label>
                    <input type="text"  class="form-control" name="position_of_representative" id="position_of_representative" value="{{ old('position_of_representative') }}">

                    <label for="basis_of_authority">Основание полномочий</label>
                    <input type="text"  class="form-control" name="basis_of_authority" id="basis_of_authority" value="{{ old('basis_of_authority') }}">

                    <label for="correspondent_account">Корр. счет</label>
                    <input type="text"  class="form-control" name="correspondent_account" id="correspondent_account" value="{{ old('correspondent_account') }}">

                    <label for="bik">БИК</label>
                    <input type="text"  class="form-control" name="bik" id="bik" value="{{ old('bik') }}">

                    <label for="bank">Банк</label>
                    <input type="text"  class="form-control" name="bank" id="bank" value="{{ old('bank') }}">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                <button type="button" class="btn btn-success send-form-transaction-description" data-form_id="7">Добавить</button>
            </div>
        </div>
    </div>
</div>
@endif