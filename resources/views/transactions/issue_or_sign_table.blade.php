<div class="x_panel">
    <div class="x_title">
        <h2>Подпишите документы и выдайте деньги</h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div class="table-responsive">
            <table id="issue-or-sign-table" class="table table-hover">
                <thead>
                <tr>
                    <th>Встреча</th>
                    <th>Сделка</th>
                    <th>Залог</th>
                    <th>Сумма</th>
                    <th>Статус</th>
                </tr>
                </thead>
                <tbody id="leads_table">
                @foreach($transactionIssueOrSign as $transaction)
                    <tr id="transactionId-{{ $transaction->id }}">
                        <td> <input class="show-input"  onclick="selectId({{$transaction->id}})"  type="text" name="changedatetimes" value="{{$transaction->reception}}"/> </td>
                        <td><a href="{{ Route('transaction.show', $transaction->id) }}">{{ $transaction->client->surname . ' ' . $transaction->client->first_name . ' ' . $transaction->client->last_name }}</a></td>
                        <td>{{ $transaction->depositType->name }}</td>
                        <td>{{ $transaction->money }} <i class="fa fa-rub"></i></td>
                        @if($transaction->depositType->name == 'Недвижимость' and $transaction->signed == false)
                            <td><a class="modal-yes-signed" href="#sing-modal" data-toggle="modal" data-id="{{ $transaction->id }}">Подписать</a></td>
                        @elseif($transaction->depositType->name == 'Автомобиль' or $transaction->depositType->name == 'Недвижимость' and $transaction->signed == true)
                            <td><a class="modal-yes-gave" href="#give-modal" data-toggle="modal" data-id="{{ $transaction->id }}">Выдать</a></td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!--  modal -->
<div id="give-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">
                    Подпишите документы и выдайте деньги
                </h4>
            </div>
            <div class="modal-body">
                <p>Вы выдали деньги клиенту?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                <button type="button" class="btn btn-success yes-gave" data-id="" data-gave_money="1" data-status_id="3" data-dismiss="modal">Да, выдал</button>
                <button type="button" class="btn btn-danger customer-waiver" data-toggle="modal" data-target=".bs-example-modal-lg">Нет,
                    клиент отказался
                </button>
            </div>

        </div>
    </div>
</div>
<div id="sing-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">
                    Подпишите документы и выдайте деньги
                </h4>
            </div>
            <div class="modal-body">
                <p>Вы подписали договоры с клиентом?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                <button type="button" class="btn btn-success yes-signed" data-id="" data-signed="1" data-status_id="2" data-dismiss="modal">Да, подписал</button>
                <button type="button" class="btn btn-danger customer-waiver" data-id data-toggle="modal" data-target=".bs-example-modal-lg">Нет,
                    клиент отказался
                </button>
            </div>

        </div>
    </div>
</div>
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Причина отказа</h4>
            </div>
            <div class="modal-body">
                <h4>Укажите причину отказа </h4>
                <form class="client-waiver" action="" method="POST">
                    <div class="form-group">
                        <label style="margin-top: 10px"
                               class="control-label col-md-3 col-sm-3 col-xs-12">Причина</label>
                        <div style="margin-top: 10px" class="col-md-9 col-sm-9 col-xs-12">
                            <select name="waiver_id" class="form-control">
                                <option style="display: none" disabled selected value>Выберите</option>
                                @foreach($waivers as $waiver)
                                <option value="{{ $waiver->id }}">{{ $waiver->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label style="margin-top: 10px" class="control-label col-md-3 col-sm-3 col-xs-12">Другая
                            причина</label>
                        <div style="margin-top: 10px" class="col-md-9 col-sm-9 col-xs-12">
                            <textarea name="waiver_description" class="resizable_textarea form-control"
                                      placeholder="Опишите причину отказа"></textarea>
                        </div>
                    </div>
                    <input type="text" name="status_id" value="4" hidden>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                <button type="button" class="btn btn-primary client-waiver-save">Сохранить</button>
            </div>

        </div>
    </div>
</div>
<!-- /modals -->