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
            <div class="col-md-5 col-sm-4 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Donut Graph</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <div id="portfolio_donut" style="height:350px;"></div>

                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Подпишите документы и выдайте деньги</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="table-responsive">
                            <table class="table table-hover">
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
                                <tr>
                                    <td>01.01.2018 в 16:00</td>
                                    <td>Иванов Иван Иванович</td>
                                    <td>Недвижимость</td>
                                    <td>10 000 <i class="fa fa-rub"></i></td>
                                    <td><a href="#">Выдать</a></td>
                                </tr>
                                <tr>
                                    <td>01.01.2018 в 16:00</td>
                                    <td>Васильев Василий Васильевич</td>
                                    <td>ПТС</td>
                                    <td>10 000 <i class="fa fa-rub"></i></td>
                                    <td><a href="#">Подписать</a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><i class="fa fa-bars"></i> Действующие сделки</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="all-transactions" class="table table-striped table-bordered dt-responsive nowrap"
                               cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th colspan="6"></th>
                                <th style="text-align: center; background-color: #F2F2F2" colspan="3">Задолженность</th>
                                <th></th>
                                <th style="text-align: center; background-color: #F2F2F2" colspan="3">Оплачено</th>
                            </tr>
                            <tr>
                                <th>Дата</th>
                                <th>ФИО</th>
                                <th>Телефон</th>
                                <th>Сумма</th>
                                <th><i class="fa fa-percent" aria-hidden="true"></i></th>
                                <th>Тело</th>
                                <th>Проценты</th>
                                <th>Пени</th>
                                <th>Срок займа</th>
                                <th>Тело</th>
                                <th>Проценты</th>
                                <th>Пени</th>
                            </tr>
                            </thead>
                            <tbody class="responsive-table">
                            <tr class="table-success">
                                <td><img src="img/car-garage.png" style="width: 12px; height: 13px"> 01.01.2018</td>
                                <td><a href="#myModal1" data-toggle="modal">Иванов Иван Иванович </a></td>
                                <td>89171234567</td>
                                <td>10 000 <i class="fa fa-rub"></i></td>
                                <td>6</td>
                                <td>Одобрен</td>
                                <td><img src="img/car-garage.png" style="width: 12px; height: 13px"> 01.01.2018</td>
                                <td>Иванов Иван Иванович</td>
                                <td>89171234567</td>
                                <td>10 000 <i class="fa fa-rub"></i></td>
                                <td>6</td>
                                <td>Одобрен</td>
                            </tr>

                            <tr class="table-danger">
                                <td><i class="fa fa-car"></i> 02.01.2018</td>
                                <td>Васильев Василий Васильевич</td>
                                <td>89171234567</td>
                                <td>10 000 <i class="fa fa-rub"></i></td>
                                <td>12</td>
                                <td>Отказ</td>
                                <td><img src="img/car-garage.png" style="width: 12px; height: 13px"> 01.01.2018</td>
                                <td>Иванов Иван Иванович</td>
                                <td>89171234567</td>
                                <td>10 000 <i class="fa fa-rub"></i></td>
                                <td>6</td>
                                <td>Одобрен</td>
                            </tr>

                            <tr class="table-danger">
                                <td><i class="fa fa-home" aria-hidden="true"></i> 04.01.2018</td>
                                <td>Петров Петр Петрович</td>
                                <td>89171234567</td>
                                <td>10 000 <i class="fa fa-rub"></i></td>
                                <td>6</td>
                                <td>Отказ</td>
                                <td><img src="img/car-garage.png" style="width: 12px; height: 13px"> 01.01.2018</td>
                                <td>Иванов Иван Иванович</td>
                                <td>89171234567</td>
                                <td>10 000 <i class="fa fa-rub"></i></td>
                                <td>6</td>
                                <td>Одобрен</td>
                            </tr>

                            <tr class="table-danger">
                                <td><i class="fa fa-car"></i> 06.01.2018</td>
                                <td>Сергеев Сергей Сергевич</td>
                                <td>89171234567</td>
                                <td>10 000 <i class="fa fa-rub"></i></td>
                                <td>11</td>
                                <td>Отказ</td>
                                <td><img src="img/car-garage.png" style="width: 12px; height: 13px"> 01.01.2018</td>
                                <td>Иванов Иван Иванович</td>
                                <td>89171234567</td>
                                <td>10 000 <i class="fa fa-rub"></i></td>
                                <td>6</td>
                                <td>Одобрен</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


<div id="myModal1" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">


                    <div class="container" id="offset">
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <a href="#pay" role="tab" data-toggle="tab" aria-expanded="true" id="head1"
                               class="myClass"> Оплата </a>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <a href="#history_pay" role="tab" data-toggle="tab" aria-expanded="false"
                               id="head2"> История платежей </a>
                        </div>
                        <div class="col-md-5 col-sm-5 col-xs-5 ">
                            <a class="btn btn-warning" data-toggle="modal" data-target="#add-lead">Открыть
                                карточку сделки</a>
                        </div>

                    </div>

                    <div class="container">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div id="myTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" id="pay"
                                     aria-labelledby="home-tab">

                                    <table id="table" class="table ">

                                        <tbody>
                                        <tr>
                                            <td>Сделка:</td>
                                            <td> Иванов Иван Иванович</td>
                                        </tr>
                                        <tr>
                                            <td>Сумма:</td>
                                            <td>10000 руб.</td>
                                        </tr>
                                        <tr>
                                            <td>Ставка:</td>
                                            <td> 6% в месяц (72% годовых)</td>
                                        </tr>

                                        </tbody>
                                    </table>


                                    <table id="table" class="table ">

                                        <tbody>
                                        <tr>
                                            <td>Тело займа:</td>
                                            <td> 10000 р.</td>
                                            <td><input type="text" name="" value=""></td>
                                        </tr>
                                        <tr>
                                            <td>Проценты:</td>
                                            <td>600 руб.</td>
                                            <td><input type="text" name="" value=""></td>
                                        </tr>
                                        <tr>
                                            <td>Пени:</td>
                                            <td> 0 р.</td>
                                            <td><input type="text" name="" value=""></td>
                                        </tr>

                                        </tbody>
                                    </table>

                                    <p>Комментарий:</p>
                                    <textarea id="comment" type="text" name="" value=""></textarea>

                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="history_pay"
                                     aria-labelledby="profile-tab">


                                    <table id="table" class=" user_table ">
                                        <thead>
                                        <tr>
                                            <th rowspan="2" scope="col">Дата</th>

                                            <th scope="col">Расход</th>
                                            <th scope="col">Приход</th>

                                            <th rowspan="2" scope="col">Комментарий</th>

                                        </tr>
                                        <tr>


                                            <th scope="col">200000</th>
                                            <th scope="col">132975</th>


                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>10.03.2017</td>
                                            <td></td>
                                            <td>
                                                <p> 10000</p>
                                                <p>2975</p>
                                            </td>
                                            <td>
                                                Оплата процентов
                                                Оплата пени
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                100000

                                            </td>
                                            <td>
                                                Оплата процентов
                                                Оплата пени
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>01.02.2017</td>
                                            <td></td>
                                            <td>
                                                20000
                                            </td>
                                            <td>
                                                Оплата тела займа. Оплатил частично 100000,
                                                пересчитываем график по договору.

                                            </td>
                                        </tr>

                                        <tr>
                                            <td>01.01.2017</td>
                                            <td> 200000</td>
                                            <td>

                                            </td>
                                            <td>
                                                Оплата процентов

                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>

                                </div>
                            </div>

                        </div>
                    </div>


                </div>
            </div>


            <div class="modal-footer">
                <button id="margin_button" type="button" class="btn btn-default" data-dismiss="modal">
                    Оплатить
                </button>

            </div>
        </div>
    </div>
</div>


@endsection
@section('css')
    <!-- Datatables -->
        <link href="{{ asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}"
              rel="stylesheet">
        <link href="{{ asset('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}"
              rel="stylesheet">
        <link href="{{ asset('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}"
              rel="stylesheet">
        <link href="{{ asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}"
              rel="stylesheet">
        <link href="{{ asset('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}"
              rel="stylesheet">
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
        <script type="text/javascript">
            $('#head1').click(function () {
                $('#head1').addClass('myClass');
                $("#head2").removeClass()
            });

            $('#head2').click(function () {
                $('#head2').addClass('myClass');
                $("#head1").removeClass()
            });

        </script>
@endsection