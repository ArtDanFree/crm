<!-- start accordion -->
<div class="accordion accordion-transaction-description" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel">
        <a class="panel-heading collapsed" role="tab" id="headingZero" data-toggle="collapse" data-parent="#accordion" href="#collapseZero" aria-expanded="false" aria-controls="collapseZero">
            <h4 class="panel-title">
                <img class="add_icon" src="images/add.svg" alt=""> График платежей</h4>
        </a>
        <div id="collapseZero" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingZero">
            <div class="panel-body">
                <div id="print-content" class="col-md-10 col-sm-10 col-xs-10  ">
                    <a onClick="CallPrint('print-content');" title="Распечатать проект">Распечатать</a>
                    <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i>
                        Распечатать
                    </button>
                    <h3>График платежей</h3>
                    <i id="locked" class="fa fa-lock"></i>

                    <table id="table" class="table  ">
                        <tbody>
                        <tr>
                            <td>Схема платежей</td>
                            <td>
                                <select id='effectTypes'>
                                    <option value='0' id='select1'>Только проценты, тело в конце</option>
                                    <option value='1' id='select2' @if($transaction->schema==1) selected @endif >
                                        Аннуитетный платеж
                                    </option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Срок займа, мес.</td>
                            <td>
                                <input id="month_count" type="text" name="" value="{{$transaction->period}}">
                            </td>
                        </tr>
                        <tr>
                            <td>+2 платежа для взыскания авто</td>

                            <td>
                                <input type="checkbox" onclick="showOrHide();" id="checkbox1" name="feature" value=""/>
                            </td>
                            <td>
                                <button id="calculate" type="button" name="button"> Рассчитать</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <table id="table" class="table  ">
                        <thead>
                        <tr>
                            <th scope="col">Номер платежа</th>
                            <th scope="col">Дата платежа</th>
                            <th scope="col">Тело займа</th>
                            <th scope="col">Проценты</th>
                            <th scope="col">Всего</th>
                        </tr>
                        </thead>
                        <tbody id="table_deals">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @foreach($transaction->description as $description)
        @if($description->deposit->name == 'Автомобиль на стоянке')
            <div class="panel" id="panel-id-{{ $description->id }}">
                <a class="panel-heading collapsed" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{ $description->id }}" aria-expanded="false" aria-controls="collapseOne">
                    <h4 class="panel-title">{{ $description->deposit->name }}</h4>
                </a>
                <div id="collapse-{{ $description->id }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">
                    <div class="panel-body">
                        <form data-id="{{$description->id}}" class="add-transaction-description-form" method="POST">
                            @csrf
                            <label for="VIN">VIN</label>
                            <input type="text" readonly class="form-control" name="VIN" id="VIN" value="{{ $description->VIN }}">

                            <label for="model_ts">Марка, модель ТС</label>
                            <input type="text" readonly class="form-control" name="model_ts" id="model_ts" value="{{ $description->model_ts }}">

                            <label for="object">Объект</label>
                            <input type="text" readonly class="form-control" name="object" id="object" value="{{ $description->object }}">

                            <label for="year_of_manufacture">Год изготовления ТС</label>
                            <input type="text" readonly class="form-control" name="year_of_manufacture" id="year_of_manufacture" value="{{ $description->year_of_manufacture }}">

                            <label for="engine_number">Номер двигателя</label>
                            <input type="text" readonly class="form-control" name="engine_number" id="engine_number" value="{{ $description->engine_number }}">

                            <label for="bodywork_number">Номер кузова</label>
                            <input type="text" readonly class="form-control" name="bodywork_number" id="bodywork_number" value="{{ $description->bodywork_number }}">

                            <label for="color">Цвет</label>
                            <input type="text" readonly class="form-control" name="color" id="color" value="{{ $description->color }}">

                            <label for="pts_series">ПТС серия</label>
                            <input type="text" readonly class="form-control" name="pts_series" id="pts_series" value="{{ $description->pts_series }}">

                            <label for="pts_number">ПТС номер</label>
                            <input type="text" readonly class="form-control" name="pts_number" id="pts_number" value="{{ $description->pts_number }}">

                            <label for="pts_issued">ПТС кем выдан</label>
                            <input type="text" readonly class="form-control" name="pts_issued" id="pts_issued" value="{{ $description->pts_issued }}">

                            <label for="pts_date_issued">ПТС дата выдачи</label>
                            <input type="text" readonly class="form-control" name="pts_date_issued" id="pts_date_issued" value="{{ $description->pts_date_issued }}">

                            <label for="state_number">Госномер ТС</label>
                            <input type="text" readonly class="form-control" name="state_number" id="state_number" value="{{ $description->state_number }}">
                        </form>
                        @can('Редактировать сделку со статусом ' . $transaction->status->name)
                            <div class="x_content accordion-buttons">
                                <button type="button" class="btn btn-primary accordion-button-change">Изменить</button>
                                <button type="button" class="btn btn-danger accordion-button-destroy">Удалить</button>
                                <button type="button" class="btn btn-default accordion-button-cancel hidden">Отмена</button>
                                <button type="button" class="btn btn-success accordion-button-save hidden">Сохранить
                                </button>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
        @elseif($description->deposit->name == 'ПТС')
            <div class="panel" id="panel-id-{{ $description->id }}">
                <a class="panel-heading collapsed" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{ $description->id }}" aria-expanded="false" aria-controls="collapseOne">
                    <h4 class="panel-title">{{ $description->deposit->name }}</h4>
                </a>
                <div id="collapse-{{ $description->id }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">
                    <div class="panel-body">
                        <form data-id="{{$description->id}}" class="add-transaction-description-form" method="POST">
                            @csrf
                            @method('PUT')
                            <label for="VIN">VIN</label>
                            <input type="text" readonly class="form-control" name="VIN" id="VIN" value="{{ $description->VIN }}">

                            <label for="model_ts">Марка, модель ТС</label>
                            <input type="text" readonly class="form-control" name="model_ts" id="model_ts" value="{{ $description->model_ts }}">

                            <label for="object">Объект</label>
                            <input type="text" readonly class="form-control" name="object" id="object" value="{{ $description->object }}">

                            <label for="year_of_manufacture">Год изготовления ТС</label>
                            <input type="text" readonly class="form-control" name="year_of_manufacture" id="year_of_manufacture" value="{{ $description->year_of_manufacture }}">

                            <label for="engine_number">Номер двигателя</label>
                            <input type="text" readonly class="form-control" name="engine_number" id="engine_number" value="{{ $description->engine_number }}">

                            <label for="bodywork_number">Номер кузова</label>
                            <input type="text" readonly class="form-control" name="bodywork_number" id="bodywork_number" value="{{ $description->bodywork_number }}">

                            <label for="color">Цвет</label>
                            <input type="text" readonly class="form-control" name="color" id="color" value="{{ $description->color }}">

                            <label for="pts_series">ПТС серия</label>
                            <input type="text" readonly class="form-control" name="pts_series" id="pts_series" value="{{ $description->pts_series }}">

                            <label for="pts_number">ПТС номер</label>
                            <input type="text" readonly class="form-control" name="pts_number" id="pts_number" value="{{ $description->pts_number }}">

                            <label for="pts_issued">ПТС кем выдан</label>
                            <input type="text" readonly class="form-control" name="pts_issued" id="pts_issued" value="{{ $description->pts_issued }}">

                            <label for="pts_date_issued">ПТС дата выдачи</label>
                            <input type="text" readonly class="form-control" name="pts_date_issued" id="pts_date_issued" value="{{ $description->pts_date_issued }}">

                            <label for="state_number">Госномер ТС</label>
                            <input type="text" readonly class="form-control" name="state_number" id="state_number" value="{{ $description->state_number }}">
                        </form>
                        @can('Редактировать сделку со статусом ' . $transaction->status->name)
                        <div class="x_content accordion-buttons">
                            <button type="button" class="btn btn-primary accordion-button-change">Изменить</button>
                            <button type="button" class="btn btn-danger accordion-button-destroy">Удалить</button>
                            <button type="button" class="btn btn-default accordion-button-cancel hidden">Отмена</button>
                            <button type="button" class="btn btn-success accordion-button-save hidden">Сохранить
                            </button>
                        </div>
                        @endcan
                    </div>
                </div>
            </div>
        @elseif($description->deposit->name == 'Земля')
            <div class="panel" id="panel-id-{{ $description->id }}">
                <a class="panel-heading collapsed" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{ $description->id }}" aria-expanded="false" aria-controls="collapseOne">
                    <h4 class="panel-title">{{ $description->deposit->name }}</h4>
                </a>
                <div id="collapse-{{ $description->id }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">
                    <div class="panel-body">
                        <form data-id="{{$description->id}}" class="add-transaction-description-form" method="POST">
                            @csrf
                            @method('PUT')
                            <label for="price_market">Цена по рынку, руб.</label>
                            <input type="text" readonly class="form-control" name="price_market" id="price_market" value="{{ $description->price_market }}">

                            <label for="evaluative_price">Наша оценка, руб.</label>
                            <input type="text" readonly class="form-control" name="evaluative_price" id="evaluative_price" value="{{ $description->evaluative_price }}">

                            <label for="appointment">Назначение</label>
                            <input type="text" readonly class="form-control" name="appointment" id="appointment" value="{{ $description->appointment }}">

                            <label for="area">Общая площадь, кв.м</label>
                            <input type="text" readonly class="form-control" name="area" id="area" value="{{ $description->area }}">

                            <label for="address">Адрес расположения объекта</label>
                            <input type="text" readonly class="form-control" name="address" id="address" value="{{ $description->address }}">

                            <label for="basis">Основание владения объектом (род.падеж)</label>
                            <input type="text" readonly class="form-control" name="basis" id="basis" value="{{ $description->basis }}">

                            <label for="cadastral_number">Кадастровый или условный номер</label>
                            <input type="text" readonly class="form-control" name="cadastral_number" id="cadastral_number" value="{{ $description->cadastral_number }}">

                            <label for="ownership_documents">Документ, подтверждающий право собственности</label>
                            <input type="text" readonly class="form-control" name="ownership_documents" id="ownership_documents" value="{{ $description->ownership_documents }}">

                            <label for="number_ownership_documents">Серия и номер документа, подтверждающего право
                                собственности</label>
                            <input type="text" readonly class="form-control" name="number_ownership_documents" id="number_ownership_documents" value="{{ $description->number_ownership_documents }}">

                            <label for="date_ownership_documents">Дата выдачи документа, подтверждающего право
                                собственности</label>
                            <input type="text" readonly class="form-control" name="date_ownership_documents" id="date_ownership_documents" value="{{ $description->date_ownership_documents }}">

                            <label for="ownership_documents_issued">Кем выдан документ</label>
                            <input type="text" readonly class="form-control" name="ownership_documents_issued" id="ownership_documents_issued" value="{{ $description->ownership_documents_issued }}">

                            <label for="restriction">Наличие ограничений или обременений</label>
                            <input type="text" readonly class="form-control" name="restriction" id="restriction" value="{{ $description->restriction }}">
                        </form>
                        @can('Редактировать сделку со статусом ' . $transaction->status->name)
                        <div class="x_content accordion-buttons">
                            <button type="button" class="btn btn-primary accordion-button-change">Изменить</button>
                            <button type="button" class="btn btn-danger accordion-button-destroy">Удалить</button>
                            <button type="button" class="btn btn-default accordion-button-cancel hidden">Отмена</button>
                            <button type="button" class="btn btn-success accordion-button-save hidden">Сохранить
                            </button>
                        </div>
                        @endcan
                    </div>
                </div>
            </div>
        @elseif($description->deposit->name == 'Квартира')
            <div class="panel" id="panel-id-{{ $description->id }}">
                <a class="panel-heading collapsed" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{ $description->id }}" aria-expanded="false" aria-controls="collapseOne">
                    <h4 class="panel-title">{{ $description->deposit->name }}</h4>
                </a>
                <div id="collapse-{{ $description->id }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">
                    <div class="panel-body">
                        <form data-id="{{$description->id}}" class="add-transaction-description-form" method="POST">
                            @csrf
                            @method('PUT')
                            <label for="price_market">Цена по рынку, руб.</label>
                            <input type="text" readonly class="form-control" name="price_market" id="price_market" value="{{ $description->price_market }}">

                            <label for="evaluative_price">Наша оценка, руб.</label>
                            <input type="text" readonly class="form-control" name="evaluative_price" id="evaluative_price" value="{{ $description->evaluative_price }}">

                            <label for="appointment">Назначение</label>
                            <input type="text" readonly class="form-control" name="appointment" id="appointment" value="{{ $description->appointment }}">

                            <label for="area">Общая площадь, кв.м</label>
                            <input type="text" readonly class="form-control" name="area" id="area" value="{{ $description->area }}">

                            <label for="floor">Этаж</label>
                            <input type="text" readonly class="form-control" name="floor" id="floor" value="{{ $description->floor }}">

                            <label for="address">Адрес расположения объекта</label>
                            <input type="text" readonly class="form-control" name="address" id="address" value="{{ $description->address }}">

                            <label for="basis">Основание владения объектом (род.падеж)</label>
                            <input type="text" readonly class="form-control" name="basis" id="basis" value="{{ $description->basis }}">

                            <label for="cadastral_number">Кадастровый или условный номер</label>
                            <input type="text" readonly class="form-control" name="cadastral_number" id="cadastral_number" value="{{ $description->cadastral_number }}">

                            <label for="ownership_documents">Документ, подтверждающий право собственности</label>
                            <input type="text" readonly class="form-control" name="ownership_documents" id="ownership_documents" value="{{ $description->ownership_documents }}">

                            <label for="number_ownership_documents">Серия и номер документа, подтверждающего право
                                собственности</label>
                            <input type="text" readonly class="form-control" name="number_ownership_documents" id="number_ownership_documents" value="{{ $description->number_ownership_documents }}">

                            <label for="date_ownership_documents">Дата выдачи документа, подтверждающего право
                                собственности</label>
                            <input type="text" readonly class="form-control" name="date_ownership_documents" id="date_ownership_documents" value="{{ $description->date_ownership_documents }}">

                            <label for="ownership_documents_issued">Кем выдан документ</label>
                            <input type="text" readonly class="form-control" name="ownership_documents_issued" id="ownership_documents_issued" value="{{ $description->ownership_documents_issued }}">

                            <label for="restriction">Наличие ограничений или обременений</label>
                            <input type="text" readonly class="form-control" name="restriction" id="restriction" value="{{ $description->restriction }}">

                        </form>
                        @can('Редактировать сделку со статусом ' . $transaction->status->name)
                        <div class="x_content accordion-buttons">
                            <button type="button" class="btn btn-primary accordion-button-change">Изменить</button>
                            <button type="button" class="btn btn-danger accordion-button-destroy">Удалить</button>
                            <button type="button" class="btn btn-default accordion-button-cancel hidden">Отмена</button>
                            <button type="button" class="btn btn-success accordion-button-save hidden">Сохранить
                            </button>
                        </div>
                        @endcan
                    </div>
                </div>
            </div>
        @elseif($description->deposit->name == 'Дом')
            <div class="panel" id="panel-id-{{ $description->id }}">
                <a class="panel-heading collapsed" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{ $description->id }}" aria-expanded="false" aria-controls="collapseOne">
                    <h4 class="panel-title">{{ $description->deposit->name }}</h4>
                </a>
                <div id="collapse-{{ $description->id }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">
                    <div class="panel-body">
                        <form data-id="{{$description->id}}" class="add-transaction-description-form" method="POST">
                            @csrf
                            @method('PUT')
                            <label for="price_market">Цена по рынку, руб.</label>
                            <input type="text" readonly class="form-control" name="price_market" id="price_market" value="{{ $description->price_market }}">

                            <label for="evaluative_price">Наша оценка, руб.</label>
                            <input type="text" readonly class="form-control" name="evaluative_price" id="evaluative_price" value="{{ $description->evaluative_price }}">

                            <label for="appointment">Назначение</label>
                            <input type="text" readonly class="form-control" name="appointment" id="appointment" value="{{ $description->appointment }}">

                            <label for="area">Общая площадь, кв.м</label>
                            <input type="text" readonly class="form-control" name="area" id="area" value="{{ $description->area }}">

                            <label for="floors_count">Этажей</label>
                            <input type="text" readonly class="form-control" name="floors_count" id="floors_count" value="{{ $description->floors_count }}">

                            <label for="address">Адрес расположения объекта</label>
                            <input type="text" readonly class="form-control" name="address" id="address" value="{{ $description->address }}">

                            <label for="basis">Основание владения объектом (род.падеж)</label>
                            <input type="text" readonly class="form-control" name="basis" id="basis" value="{{ $description->basis }}">

                            <label for="cadastral_number">Кадастровый или условный номер</label>
                            <input type="text" readonly class="form-control" name="cadastral_number" id="cadastral_number" value="{{ $description->cadastral_number }}">

                            <label for="ownership_documents">Документ, подтверждающий право собственности</label>
                            <input type="text" readonly class="form-control" name="ownership_documents" id="ownership_documents" value="{{ $description->ownership_documents }}">

                            <label for="number_ownership_documents">Серия и номер документа, подтверждающего право
                                собственности</label>
                            <input type="text" readonly class="form-control" name="number_ownership_documents" id="number_ownership_documents" value="{{ $description->number_ownership_documents }}">

                            <label for="date_ownership_documents">Дата выдачи документа, подтверждающего право
                                собственности</label>
                            <input type="text" readonly class="form-control" name="date_ownership_documents" id="date_ownership_documents" value="{{ $description->date_ownership_documents }}">

                            <label for="ownership_documents_issued">Кем выдан документ</label>
                            <input type="text" readonly class="form-control" name="ownership_documents_issued" id="ownership_documents_issued" value="{{ $description->ownership_documents_issued }}">

                            <label for="restriction">Наличие ограничений или обременений</label>
                            <input type="text" readonly class="form-control" name="restriction" id="restriction" value="{{ $description->restriction }}">
                        </form>
                        @can('Редактировать сделку со статусом ' . $transaction->status->name)
                        <div class="x_content accordion-buttons">
                            <button type="button" class="btn btn-primary accordion-button-change">Изменить</button>
                            <button type="button" class="btn btn-danger accordion-button-destroy">Удалить</button>
                            <button type="button" class="btn btn-default accordion-button-cancel hidden">Отмена</button>
                            <button type="button" class="btn btn-success accordion-button-save hidden">Сохранить
                            </button>
                        </div>
                        @endcan
                    </div>
                </div>
            </div>
        @elseif($description->deposit->name == 'Поручитель')
            <div class="panel" id="panel-id-{{ $description->id }}">
                <a class="panel-heading collapsed" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{ $description->id }}" aria-expanded="false" aria-controls="collapseOne">
                    <h4 class="panel-title">{{ $description->deposit->name }}</h4>
                </a>
                <div id="collapse-{{ $description->id }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">
                    <div class="panel-body">
                        <form data-id="{{$description->id}}" class="add-transaction-description-form" method="POST">
                            @csrf
                            @method('PUT')
                            <label for="fio">ФИО</label>
                            <input type="text" readonly class="form-control" name="fio" id="fio" value="{{ $description->fio }}">

                            <label for="phone">Телефон</label>
                            <input type="text" readonly class="form-control" name="phone" id="phone" value="{{ $description->phone }}">

                            <label for="series">Серия</label>
                            <input type="text" readonly class="form-control" name="series" id="series" value="{{ $description->series }}">

                            <label for="number">Номер</label>
                            <input type="text" readonly class="form-control" name="number" id="number" value="{{ $description->number }}">

                            <label for="birthdate">Дата рождения</label>
                            <input type="text" readonly class="form-control" name="birthdate" id="birthdate" value="{{ $description->birthdate }}">

                            <label for="place_of_birth">Место рождения</label>
                            <input type="text" readonly class="form-control" name="place_of_birth" id="place_of_birth" value="{{ $description->place_of_birth }}">

                            <label for="issued">Кем выдан</label>
                            <input type="text" readonly class="form-control" name="issued" id="issued" value="{{ $description->issued }}">

                            <label for="when_issued">Когда выдан</label>
                            <input type="text" readonly class="form-control" name="when_issued" id="when_issued" value="{{ $description->when_issued }}">

                            <label for="department_code">Код подразделения</label>
                            <input type="text" readonly class="form-control" name="department_code" id="department_code" value="{{ $description->department_code }}">

                            <label for="registration_address">Адрес регистрации</label>
                            <input type="text" readonly class="form-control" name="registration_address" id="registration_address" value="{{ $description->registration_address }}">
                        </form>
                        @can('Редактировать сделку со статусом ' . $transaction->status->name)
                        <div class="x_content accordion-buttons">
                            <button type="button" class="btn btn-primary accordion-button-change">Изменить</button>
                            <button type="button" class="btn btn-danger accordion-button-destroy">Удалить</button>
                            <button type="button" class="btn btn-default accordion-button-cancel hidden">Отмена</button>
                            <button type="button" class="btn btn-success accordion-button-save hidden">Сохранить
                            </button>
                        </div>
                        @endcan
                    </div>
                </div>
            </div>
        @elseif($description->deposit->name == 'Заёмщик юридическое лицо')
            <div class="panel" id="panel-id-{{ $description->id }}">
                <a class="panel-heading collapsed" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{ $description->id }}" aria-expanded="false" aria-controls="collapseOne">
                    <h4 class="panel-title">{{ $description->deposit->name }}</h4>
                </a>
                <div id="collapse-{{ $description->id }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">
                    <div class="panel-body">
                        <form data-id="{{$description->id}}" class="add-transaction-description-form" method="POST">
                            @csrf
                            @method('PUT')
                            <label for="legal_entity_name">Наименование юр.лица</label>
                            <input type="text" readonly class="form-control" name="legal_entity_name" id="legal_entity_name" value="{{ $description->legal_entity_name }}">

                            <label for="short_name">Сокращенно</label>
                            <input type="text" readonly class="form-control" name="short_name" id="short_name" value="{{ $description->short_name }}">

                            <label for="legal_address">Юридический адрес</label>
                            <input type="text" readonly class="form-control" name="legal_address" id="legal_address" value="{{ $description->legal_address }}">

                            <label for="ogrn">ОГРН</label>
                            <input type="text" readonly class="form-control" name="ogrn" id="ogrn" value="{{ $description->ogrn }}">

                            <label for="inn">ИНН</label>
                            <input type="text" readonly class="form-control" name="inn" id="inn" value="{{ $description->inn }}">

                            <label for="kpp">КПП</label>
                            <input type="text" readonly class="form-control" name="kpp" id="kpp" value="{{ $description->kpp }}">

                            <label for="position_of_representative">Должнасть представителя</label>
                            <input type="text" readonly class="form-control" name="position_of_representative" id="position_of_representative" value="{{ $description->position_of_representative }}">

                            <label for="basis_of_authority">Основание полномочий</label>
                            <input type="text" readonly class="form-control" name="basis_of_authority" id="basis_of_authority" value="{{ $description->basis_of_authority }}">

                            <label for="correspondent_account">Корр. счет</label>
                            <input type="text" readonly class="form-control" name="correspondent_account" id="correspondent_account" value="{{ $description->correspondent_account }}">

                            <label for="bik">БИК</label>
                            <input type="text" readonly class="form-control" name="bik" id="bik" value="{{ $description->bik }}">

                            <label for="bank">Банк</label>
                            <input type="text" readonly class="form-control" name="bank" id="bank" value="{{ $description->bank }}">
                        </form>
                        @can('Редактировать сделку со статусом ' . $transaction->status->name)
                        <div class="x_content accordion-buttons">
                            <button type="button" class="btn btn-primary accordion-button-change">Изменить</button>
                            <button type="button" class="btn btn-danger accordion-button-destroy">Удалить</button>
                            <button type="button" class="btn btn-default accordion-button-cancel hidden">Отмена</button>
                            <button type="button" class="btn btn-success accordion-button-save hidden">Сохранить
                            </button>
                        </div>
                        @endcan
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>
<!-- end of accordion -->