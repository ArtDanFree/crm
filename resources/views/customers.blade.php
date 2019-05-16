@extends('layouts.app')
@section('content')
    <div class="right_col" role="main">
        <div class="page-title">
            <div class="title_left">
                <h3>Сделки</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 col-lg-4">
                <div class="x_panel">
                    <div class="x_content">
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-4 col-xs-12">
                <div class="x_panel">
                    <ul class="list-unstyled project_files">
                        <li>
                            <b>LTV:</b> 12 231 рублей
                        </li>
                        <li>
                            <b>ROI:</b> 12 231 рублей
                        </li>
                        <li>
                            <b>Цена клиента:</b> 10 000 рублей
                        </li>
                        <li>
                            <b>Цель:</b> 1 000 000 рублей
                        </li>
                        <li>
                            <b>Нужно:</b> 30 клиентов
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="table-responsive">
                            <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ФИО</th>
                                <th>Дата рождения</th>
                                <th>Телефон</th>
                                <th>Оформлен</th>
                                <th>Сделки</th>
                                <th>Доход</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th <a href="#clientModal"  data-toggle="modal">Иванов Иван Иванович </a></th>
                                <th>01.01.1990</th>
                                <td>89171234567</td>
                                <td>Да</td>
                                <td>1</td>
                                <td>10 000 <i class="fa fa-rub"></i></td>
                            </tr>
                            <tr>
                                <th><a href="#clientModal"  data-toggle="modal">Иванов Иван Иванович </a></th>
                                <th>02.04.1978</th>
                                <td>89171234567</td>
                                <td>Да</td>
                                <td>1</td>
                                <td>10 000 <i class="fa fa-rub"></i></td>
                            </tr>
                            <tr>
                                <th><a href="#clientModal"  data-toggle="modal">Иванов Иван Иванович </a></th>
                                <th>23.08.2001</th>
                                <td>89171234567</td>
                                <td>Да</td>
                                <td>1</td>
                                <td>10 000 <i class="fa fa-rub"></i></td>
                            </tr>
                            <tr>
                                <th><a href="#clientModal"  data-toggle="modal">Иванов Иван Иванович </a></th>
                                <th>23.07.1988</th>
                                <td>89171234567</td>
                                <td>Нет</td>
                                <td>0</td>
                                <td>0 <i class="fa fa-rub"></i></td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div id="clientModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">

          <div id="offset2" class="col-md-12 col-sm-12 col-xs-12">

            <table id="table" class=" user_table ">
              <thead >
                <tr>
                  <th  scope="col">Дата</th>

                  <th scope="col">Сумма</th>
                  <th scope="col">Ставка</th>

                  <th  scope="col">Статус</th>

                </tr>

              </thead>
              <tbody>
                <tr>
                  <td>10.03.2017</td>
                  <td>200000</td>
                  <td>100000</td>
                  <td>Выдан</td>
                </tr>
                <tr>
                  <td>10.02.2017</td>
                  <td>100000</td>
                  <td>10000</td>
                  <td>Закрыт</td>
                </tr>

              </tbody>
            </table>
          </div>



            <button id="margin_button" type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>


        </div>
      </div>
    </div>


@endsection
@section('css')
    <!-- Datatables -->
    <link href="{{ asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">
@endsection
@section('script')
    <!-- ECharts -->
    <script src="{{ asset('vendors/echarts/dist/echarts.min.js') }}"></script>
    <script src="{{ asset('vendors/echarts/map/js/world.js') }}"></script>
    <!-- Datatables -->
    <script src="{{ asset('vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
@endsection
