<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ auth()->user()->first_name }} - учет займов Vaviloan</title>
    <script>
        var zone = "{{ route('lead.store') }}";
        var lead_info = "{{ route('show_lead_info') }}";
        var get_cities = "{{ route('get_cities') }}";
        var set_reception = "{{ route('set_reception') }}";
        var change_reception = "{{ route('change_reception') }}";
        var new_type = "{{ route('new_type') }}";
        var leads;
        var selected_city = "{{ auth()->user()->city_id }}" ;
        var transaction_info = "{{route('show_transaction_info')}}";
        var take_on_check = "{{route('take_on_check')}}";
        var lead_decline = "{{route('lead_decline')}}";
        var lead_remake = "{{route('lead_remake')}}";
        var userId = "{{ Auth::id() }}";
    </script>
    <script src="{{ mix('js/gentelella.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js" integrity="sha384-FzT3vTVGXqf7wRfy8k4BiyzvbNfeYjK+frTVqZeNDFl8woCbF0CYG6g2fMEFFo/i" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.0/css/all.css" integrity="sha384-Mmxa0mLqhmOeaE8vgOSbKacftZcsNYDjQzuCOm6D02luYSzBG8vpaOykv9lFQ51Y" crossorigin="anonymous">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>

</head>
<body class="nav-md">
<div class="container body" id="app">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a style="font-size: 18px" href="{{ Route('home') }}" class="site_title">
                        <img style="width: 40px; height: 40px" src="{{ asset('img/logo-w.png') }}">
                        <span>Частный инвестор</span>
                    </a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    <div class="profile_pic">
                        <a href="{{ Route('profile') }}"><img src="{{ srcAvatar(auth()->user()) }}" alt="..." class="img-circle profile_img user-avatar"></a>
                    </div>
                    <div class="profile_info">
                        <h2 class="user-name">{{ Request::user()->first_name }}</h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <br />
                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>Меню</h3>
                        <ul class="nav side-menu">
                            <li><a href="{{ Route('leads') }}" class="a-append">
                                    <i class="fa fa-group"></i>
                                    Лиды
                                    <span class="lead-n badge bg-green notification-menu notification-menu-revealed inline-block"></span>
                                </a>
                            </li>
                            <li><a href="{{ Route('transactions') }}" class="a-append">
                                    <i class="fa fa-handshake-o"></i>
                                    Сделки
                                    <span class="transaction-n badge bg-green notification-menu notification-menu-revealed inline-block"></span>
                                </a>
                            </li>
                            <li><a href="{{ Route('customers') }}" ><i class="fa fa-users" aria-hidden="true"></i>Клиенты</a></li>
                            <li><a href="{{ Route('portfolio') }}"><i class="fa fa-briefcase" aria-hidden="true"></i>Портфель</a></li>
                            <li><a href="{{ Route('income_and_expenses') }}"><i class="fa fa-money" aria-hidden="true"></i>Доходы и расходы</a></li>
                            <li><a href="{{ Route('user.index') }}"><i class="fa fa-users" aria-hidden="true"></i>Users</a></li>
                        </ul>
                    </div>
                    @role('Частный инвестор')
                    <div class="menu_section statistics clearfix">
                        <h3>Статистика по портфелю</h3>

                       <ul class="nav side-menu">
                            <li class="row">

                                <div class="col-xs-6 text-left">Лидов передано:</div>
                                <div class="col-xs-5 text-right">{{ $statistic['leads_count']}}</div>
                            </li>
                            <li class="row">
                                <div class="col-xs-6 text-left">Сделок заключено:</div>
                                <div class="col-xs-5 text-right">{{ $statistic['transactions_count']}}</div>
                            </li>
                            <li class="row">
                                <div class="col-xs-6 text-left">Конверсия:</div>
                                <div class="col-xs-5 text-right">{{$statistic['conversion']}} %</div>
                            </li>
                            <li class="row">
                                <div class="col-xs-6 text-left">Размер портфеля:</div>
                                <div class="col-xs-5 text-right">{{$statistic['bag']}} р. </div>
                            </li>
                            <li class="row">
                                <div class="col-xs-6 text-left">Эффективная ставка:</div>
                                <div class="col-xs-5 text-right">{{$statistic['effective_rate']}} %</div>
                            </li>
                            <li class="row">
                                <div class="col-xs-6 text-left">План доходности:</div>
                                <div class="col-xs-5 text-right">{{$statistic['plan']}} р.</div>
                            </li>
                        </ul>
                    </div>
                    @endrole
                    @role('Андеррайтер')
                    <div class="menu_section statistics">
                        <h3>Статистика месяца</h3>
                       <ul class="nav side-menu">
                            <li class="row">

                                <div class="col-xs-6 text-left">Лидов проверено:</div>
                                <div class="col-xs-5 text-right">{{ $statistic['lead_count']}}</div>
                            </li>
                            <li class="row">
                                <div class="col-xs-6 text-left">Сделок подготовлено:</div>
                                <div class="col-xs-5 text-right">{{ $statistic['transactions_count']}}</div>
                            </li>
                            <li class="row">
                                <div class="col-xs-6 text-left">Лидов в день:</div>
                                <div class="col-xs-5 text-right">{{ $statistic['leads_in_day']}}</div>
                            </li>
                            <li class="row">
                                <div class="col-xs-6 text-left">Время на 1 лид:</div>
                                <div class="col-xs-5 text-right">{{ $statistic['time_per_lead']}} мин.</div>
                            </li>
                        </ul>
                    </div>
                      @endrole
                </div>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small">
                    <a data-toggle="tooltip" data-placement="top" title="Settings">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Lock">
                        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                    </a>
                    <a onclick="$('#logout').submit()" data-toggle="tooltip" data-placement="top" title="Logout">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>
                </div>
                <!-- /menu footer buttons -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <img src="{{ Request::user()->avatar ? asset('/storage/' . Request::user()->avatar) : asset('img/noAvatar.jpg') }}" alt=""  class="user-avatar"><span class="user-name">{{ Request::user()->first_name }}</span>
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="{{ Route('profile') }}">Профиль</a></li>
                                <li>
                                    <form id="logout" action="{{ Route('logout') }}" method="POST">@csrf</form>
                                    <a onclick="$('#logout').submit()"><i class="fa fa-sign-out pull-right"></i> Выйти</a>
                                </li>
                            </ul>
                        </li>
                          @can('Добавить лида')
                        <li>
                            <button type="button" class="btn-top-menu btn btn-success" id="new-lead" data-toggle="modal" data-target="#add-lead">Добавить лида</button>
                        </li>
                        @endcan
                        @can('Задать вопрос')
                            <li>
                                <button type="button" class="btn-top-menu btn btn-success" onclick="location.href='{{ Route('questions.index') }}'">Мои вопросы</button>
                            </li>
                        @endcan
                        @can('Ответить на вопрос')
                            <li>
                                <button type="button" class="btn-top-menu btn btn-success" onclick="location.href='{{ Route('questions.index') }}'">Вопросы</button>
                            </li>
                        @endcan
                    </ul>
                </nav>
            </div>
    </div>

    <!-- page content -->
        @yield('content')
        <!-- /page content -->
</div>
</div>
<div class="modal fade" id="add-lead"  role="dialog" aria-labelledby="exampleModalCenterTitle"
aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header flex-header">
      <h4 class="modal-title" id="exampleModalLongTitle">Добавление лида</h4>
      <button type="button" class="close flex-close-header" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <form id="add-new-lead-form" action="{{ Route('lead.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group" id="type_radio">
          <label>Тип залога</label>
          <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" id="customControlValidation2"
            name="deposit_type_id" value="1" required>
            <label class="custom-control-label" for="customControlValidation2">Недвижимость</label>
          </div>
          <div class="custom-control custom-radio mb-3">
            <input type="radio" class="custom-control-input" id="customControlValidation3"
            name="deposit_type_id" value="2" required>
            <label class="custom-control-label" for="customControlValidation3">Автомобиль</label>
          </div>
        </div>


        <div class="form-group">
          <input name="chin_id" value="{{Auth::user()->id}}" type="hidden"
          class="form-control">
          <label>Фамилия</label>

          <input name="last_name" value="" type="text"
          class="form-control"
          placeholder="Фамилия">
        </div>
        <div class="form-group">
          <label>Имя</label>
          <input name="first_name"  value="" type="text"
          class="form-control"
          placeholder="Имя">
        </div>
        <div class="form-group">
          <label>Отчество</label>
          <input name="surname" value="" type="text"
          class="form-control"
          placeholder="Отчество">

        </div>
        <div class="form-group">
          <label>Желаемая сумма:</label>
          <input name="money" type="text"
          class="form-control"
          placeholder="Желаемая сумма">

        </div>
        <div class="form-group">
          <label>Телефон:</label>
          <input name="phone" type="text" required
          class="phone form-control"
          placeholder="Телефон">
        </div>
        <div class="form-group">
          <label>Город:</label>
          <select id="add-city-select" name="city_id" class="custom-select form-control-lg" required>
            <option value="">Город</option>
            @foreach($cities as $city)
            <option value="{{ $city->id }}" @if($city->id == \Request::user()->city_id) selected @endif>{{ $city->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label>Источник:</label>
          <select id="add-source-select" name="source_id" class="custom-select form-control-lg" required>
            <option value="">Выберите источник</option>
            @foreach($sources as $source)
            <option value="{{ $source->id }}">{{ $source->name }}</option>
            @endforeach
          </select>
        </div>
          <div>
            <input type="file" name="files[]" id="file-field" multiple  />
          </div>

        <div id="img-container">
          <ul id="img-list"></ul>
        </div>

        <button id="add-new-lead" class="btn btn-success" data-dismiss="modal">Добавить</button>
        </form>
      </div>
  </div>
</div>
</div>
<script src="{{ mix('js/my.js') }}"></script>
<script src="https://use.fontawesome.com/0e4b844939.js"></script>
<script src=https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js charset=utf-8></script>
</body>
</html>