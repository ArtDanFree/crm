<div class="x_panel">
    <div class="x_content">
        <div class="" role="tabpanel" data-example-id="togglable-tabs">
            <ul id="myTab" class="row nav nav-tabs bar_tabs" role="tablist">
                <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab"
                                                          data-toggle="tab" aria-expanded="true">Все сделки</a>
                </li>
                <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab"
                                                    aria-expanded="false">Выданы</a>
                </li>
                <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab"
                                                    aria-expanded="false">Отказы</a>
                </li>
                <li role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab2" data-toggle="tab"
                                                    aria-expanded="false">На подписании</a>
                </li>
                <li role="presentation" class=""><a href="#tab_content5" role="tab" id="profile-tab2" data-toggle="tab"
                                                    aria-expanded="false">Закрытые</a>
                </li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                    <table id="all-transactions-table" class="table table-bordered dt-responsive nowrap"
                           cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Дата</th>
                            <th>ФИО</th>
                            <th>Телефон</th>
                            <th>Сумма</th>
                            <th><i class="fa fa-percent" aria-hidden="true"></i></th>
                            <th>Статус</th>
                        </tr>
                        </thead>
                        <tbody class="responsive-table">
                        @foreach($transactions as $transaction)
                            <tr id="transaction-id-" class="{{ $transaction->notification ? 'info' : '' }}">
                                <td> {{$transaction->client->reception_time}}</td>
                                <td><a href="{{Route('transaction.show', $transaction->id)}}" data-toggle="modal">
                                        {{ $transaction->client['last_name']}} {{ $transaction->client['first_name']}} {{ $transaction->client['surname']}} </a>
                                </td>
                                <td>{{$transaction->client['phone']}}</td>
                                <td>{{$transaction->money ?: ' - '}}</td>
                                <td> {{$transaction->percent ?: ' - '}}
                                </td>
                                <td>{{$transaction->status->name}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <form id="all-transactions-form" action="{{ Route('ajax.table.transaction.main') }}" method="GET" hidden>
                        <input type="text" name="chin_id" value="{{ Auth::id() }}">
                    </form>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                    <table id="issued" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                           width="100%">
                        <thead>
                        <tr>
                            <th>Дата платежа</th>
                            <th>ФИО</th>
                            <th>Телефон</th>
                            <th>Сумма</th>
                            <th><i class="fa fa-percent" aria-hidden="true"></i></th>
                            <th>Тело займа, руб.</th>
                            <th>Процент</th>
                            <th>Пени</th>
                        </tr>
                        </thead>
                        <tbody class="responsive-table">
                        @foreach($transactions as $transaction)
                            @if($transaction->status_id=='3')
                                <tr  class="success">
                                    <td> {{$transaction->created_at->format('d.m.Y')}}</td>
                                    <td><a href="{{Route('lead.show', $transaction->id)}}"
                                           data-toggle="modal">{{ $transaction->client->last_name}} {{ $transaction->client->first_name}} {{ $transaction->client->surname}} </a>
                                    </td>
                                    <td>{{$transaction->client->phone}}</td>
                                    <td>{{ ($transaction->money)+(($transaction->money)*($transaction->percent)/100)}}</td>
                                    <td> {{$transaction->percent ?: ' - '}}
                                    </td>
                                    <td>{{$transaction->money ?: ' - '}}</td>
                                    <td>{{($transaction->money)*($transaction->percent)/100 ?: ' - '}}</td>
                                    <td></td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                    <table id="refusals" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                           width="100%">
                        <thead>
                        <tr>
                            <th>Дата</th>
                            <th>ФИО</th>
                            <th>Телефон</th>
                            <th>Сумма</th>
                            <th><i class="fa fa-percent" aria-hidden="true"></i></th>
                            <th>Причина отказа</th>
                        </tr>
                        </thead>
                        <tbody class="responsive-table">
                        @foreach($transactions as $transaction)
                            @if($transaction->status_id=='4')
                                <tr class="danger">
                                    <td> {{$transaction->created_at->format('d.m.Y')}}</td>
                                    <td><a href="{{Route('lead.show', $transaction->id)}}"
                                           data-toggle="modal">{{ $transaction->client->last_name}} {{ $transaction->client->first_name}} {{ $transaction->client->surname}} </a>
                                    </td>
                                    <td>{{$transaction->client->phone}}</td>
                                    <td>{{ ($transaction->money)+(($transaction->money)*($transaction->percent)/100)}}</td>
                                    <td> {{$transaction->percent ?: ' - '}}
                                    </td>
                                    <td>@if($transaction->waiver!=null){{$transaction->waiver->name}} @endif</td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">
                    <table id="at-the-signing" class="table table-bordered dt-responsive nowrap"
                           cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Дата</th>
                            <th>ФИО</th>
                            <th>Телефон</th>
                            <th>Сумма</th>
                            <th>Статус</th>
                        </tr>
                        </thead>
                        <tbody class="responsive-table">
                        @foreach($transactions as $transaction)
                            @if($transaction->status_id=='2')
                                <tr >
                                    <td> {{$transaction->created_at->format('d.m.Y')}}</td>
                                    <td><a href="{{Route('lead.show', $transaction->id)}}"
                                           data-toggle="modal">{{ $transaction->client->last_name}} {{ $transaction->client->first_name}} {{ $transaction->client->surname}} </a>
                                    </td>
                                    <td>{{$transaction->client->phone}}</td>
                                    <td>{{$transaction->money ?: ' - '}}</td>

                                    <td>{{$transaction->status->name}}</td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="profile-tab">
                    <table id="closed" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                           width="100%">
                        <thead>
                        <tr>
                            <th>Дата</th>
                            <th>ФИО</th>
                            <th>Телефон</th>
                            <th>Сумма</th>
                            <th><i class="fa fa-percent" aria-hidden="true"></i></th>
                            <th>Фактический срок займа, дней</th>
                            <th>Оплатил <i class="fa fa-percent" aria-hidden="true"></i></th>
                            <th>Оплатил пеню</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($transactions as $transaction)
                            @if($transaction->status_id=='5')
                                <tr class="active">
                                    <td> {{$transaction->created_at->format('d.m.Y')}}</td>
                                    <td><a href="{{Route('lead.show', $transaction->id)}}"
                                           data-toggle="modal">{{ $transaction->client->last_name}} {{ $transaction->client->first_name}} {{ $transaction->client->surname}} </a>
                                    </td>
                                    <td>{{$transaction->client->phone}}</td>
                                    <td>{{$transaction->money ?: ' - '}}</td>
                                    <td> {{$transaction->percent ?: ' - '}}</td>
                                    <td>
                                        {{$daysCount[$transaction->id]}}
                                    </td>
                                    <td>
                                        {{$transaction->money * $transaction->percent / 100}}
                                    </td>
                                    <td>
                                        @php $sum=0; @endphp
                                        @foreach($transaction->payment as $payment)
                                            @if($payment->type==1)
                                                @php $sum=$sum+($payment->sum) @endphp
                                            @endif
                                        @endforeach
                                        {{$sum}}
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
