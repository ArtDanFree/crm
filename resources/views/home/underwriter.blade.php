<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3> Статистика месяца</h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <!-- top tiles -->
    <div class="row tile_count">
        <div class="col-md-3 col-sm-6 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user-plus"></i> Новые лиды</span>
            <div class="count">14</div>
            <span class="count_bottom"><i class="green">4% </i> С прошлой недели</span>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-handshake-o"></i> Новые сделки</span>
            <div class="count">7</div>
            <span class="count_bottom"><i class="green"><i
                            class="fa fa-sort-asc"></i>3% </i> С прошлой недели</span>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-filter"></i> Конверсия</span>
            <div class="count green">50%</div>
            <span class="count_bottom"><i class="green"><i
                            class="fa fa-sort-asc"></i>34% </i> С прошлой недели</span>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-rub"></i> Выдачи</span>
            <div class="count">670 000 <i class="fa fa-rub"></i></div>
            <span class="count_bottom"><i class="red"><i
                            class="fa fa-sort-desc"></i>12% </i> С прошлой недели</span>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-line-chart"></i> Рост портфеля</span>
            <div class="count">43%</div>
            <span class="count_bottom"><i class="green"><i
                            class="fa fa-sort-asc"></i>34% </i> С прошлой недели</span>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-rub"></i> Доход (план)</span>
            <div class="count">93 680 <i class="fa fa-rub"></i></div>
            <span class="count_bottom"><i class="green"><i
                            class="fa fa-sort-asc"></i>34% </i> С прошлой недели</span>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-rub"></i> Доход (факт)</span>
            <div class="count">27 000 <i class="fa fa-rub"></i></div>
            <span class="count_bottom"><i class="green"><i
                            class="fa fa-sort-asc"></i>34% </i> С прошлой недели</span>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa  fa-bullseye"></i> От плана</span>
            <div class="count">28,4 %</div>
            <span class="count_bottom"><i class="green"><i
                            class="fa fa-sort-asc"></i>34% </i> С прошлой недели</span>
        </div>

    </div>
    <!-- /top tiles -->
    <div class="clearfix"></div>
    @include('clock')
    <div class="clearfix"></div>
    <div class="row">
        @include('birthday_home')
        <div class="col-md-8 col-sm-8 col-xs-12">
            <div class=" x_panel">
                <div class="x_title">
                    <h2>Ближайшие платежи</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Дата платежа</th>
                                <th>Сделка</th>
                                <th>Телефон</th>
                                <th>К оплате</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th>Сегодня</th>
                                <td>Иванов Иван Иванович</td>
                                <td>89171234567</td>
                                <td>10 000 <i class="fa fa-rub"></i></td>
                            </tr>
                            <tr>
                                <th>Завтра</th>
                                <td>Васильев Василий Васильевич</td>
                                <td>89171234567</td>
                                <td>10 000 <i class="fa fa-rub"></i></td>
                            </tr>
                            <tr>
                                <th>Завтра</th>
                                <td>Петров Петр Петрович</td>
                                <td>89171234567</td>
                                <td>10 000 <i class="fa fa-rub"></i></td>
                            </tr>
                            <tr>
                                <th>Послезавтра</th>
                                <td>Сергеев Сергей Сергевич</td>
                                <td>89171234567</td>
                                <td>10 000 <i class="fa fa-rub"></i></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="x_panel">
            <div class="x_title">
                <h2>График работы андеррайтеров</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Дата платежа</th>
                            <th>Просрочка</th>
                            <th>Сделка</th>
                            <th>Телефон</th>
                            <th>Проценты</th>
                            <th>Пени</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th>01.01.2018</th>
                            <th>117 дней</th>
                            <td>Иванов Иван Иванович</td>
                            <td>89171234567</td>
                            <td>10 000 <i class="fa fa-rub"></i></td>
                            <td>10 000 <i class="fa fa-rub"></i></td>
                        </tr>
                        <tr>
                            <th>02.01.2018</th>
                            <th>111 дней</th>
                            <td>Васильев Василий Васильевич</td>
                            <td>89171234567</td>
                            <td>10 000 <i class="fa fa-rub"></i></td>
                            <td>10 000 <i class="fa fa-rub"></i></td>
                        </tr>
                        <tr>
                            <th>03.01.2018</th>
                            <th>67 дней</th>
                            <td>Петров Петр Петрович</td>
                            <td>89171234567</td>
                            <td>10 000 <i class="fa fa-rub"></i></td>
                            <td>10 000 <i class="fa fa-rub"></i></td>
                        </tr>
                        <tr>
                            <th>04.01.2018</th>
                            <th>68 дней</th>
                            <td>Сергеев Сергей Сергевич</td>
                            <td>89171234567</td>
                            <td>10 000 <i class="fa fa-rub"></i></td>
                            <td>10 000 <i class="fa fa-rub"></i></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="x_panel">
            <div class="x_title">
                <h2>Просрочки</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Дата платежа</th>
                            <th>Просрочка</th>
                            <th>Сделка</th>
                            <th>Телефон</th>
                            <th>Проценты</th>
                            <th>Пени</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th>01.01.2018</th>
                            <th>117 дней</th>
                            <td>Иванов Иван Иванович</td>
                            <td>89171234567</td>
                            <td>10 000 <i class="fa fa-rub"></i></td>
                            <td>10 000 <i class="fa fa-rub"></i></td>
                        </tr>
                        <tr>
                            <th>02.01.2018</th>
                            <th>111 дней</th>
                            <td>Васильев Василий Васильевич</td>
                            <td>89171234567</td>
                            <td>10 000 <i class="fa fa-rub"></i></td>
                            <td>10 000 <i class="fa fa-rub"></i></td>
                        </tr>
                        <tr>
                            <th>03.01.2018</th>
                            <th>67 дней</th>
                            <td>Петров Петр Петрович</td>
                            <td>89171234567</td>
                            <td>10 000 <i class="fa fa-rub"></i></td>
                            <td>10 000 <i class="fa fa-rub"></i></td>
                        </tr>
                        <tr>
                            <th>04.01.2018</th>
                            <th>68 дней</th>
                            <td>Сергеев Сергей Сергевич</td>
                            <td>89171234567</td>
                            <td>10 000 <i class="fa fa-rub"></i></td>
                            <td>10 000 <i class="fa fa-rub"></i></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>