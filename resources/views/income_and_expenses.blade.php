@extends('layouts.app')
@section('content')
    <div class="right_col" role="main">
        <div class="page-title">
            <div class="title_left">
                <h3>Доходы и расходы</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row top_tiles">
            <div class="animated flipInY col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-rub"></i></div>
                    <div class="count">100 000</div>
                    <h3>Доходы</h3>
                </div>
            </div>
            <div class="animated flipInY col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-rub"></i></div>
                    <div class="count">30 000</div>
                    <h3>Расходы</h3>
                </div>
            </div>
            <div class="animated flipInY col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-money"></i></div>
                    <div class="count">40 000</div>
                    <h3>Инвестор</h3>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">

                        <table class="table">
                            <thead>
                            <tr>
                                <th>Дата</th>
                                <th>Доходы</th>
                                <th>Расходы</th>
                                <th>Инвестор</th>
                                <th>Тип</th>
                                <th>Комментарий</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>19.01.2018</td>
                                <td>5000</td>
                                <td></td>
                                <td>5000</td>
                                <td>@Проценты Семенов Сергей Петрович</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>20.01.2018</td>
                                <td>7000</td>
                                <td></td>
                                <td>6500</td>
                                <td>Реклама Теймур</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>23.01.2018</td>
                                <td>8000</td>
                                <td></td>
                                <td>2301</td>
                                <td>Проценты Семенов Сергей Петрович</td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
@endsection
@section('script')
@endsection