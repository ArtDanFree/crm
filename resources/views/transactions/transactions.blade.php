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
            {{--<div class="col-lg-6 col-md-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Воронка продаж автомобилей</h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id="transactions-pyramid-auto" style="min-height:200px;"></div>
                    </div>
                </div>
            </div>--}}
            {{--<div class="col-lg-6 col-md-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Воронка продаж недвижимости</h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id="transactions-pyramid-real-estate" style="min-height:200px;"></div>
                    </div>
                </div>
            </div>--}}
            {{--<div class="col-lg-12 col-md-12 col-xs-12">
                @include('transactions.issue_or_sign_table')
            </div>--}}
            <div class="clearfix"></div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                @include('transactions.main_table')
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">

    var select_id;

    function selectId(id) {
        select_id = id;
    }

    $(function () {
        $('input[name="changedatetimes"]').daterangepicker({
            timePicker: true,
            singleDatePicker: true,
            timePicker24Hour: true,

            locale: {
                format: 'DD/MM/YYYY HH:mm ',
                applyLabel: "ОК",
                cancelLabel: "Отмена",
                daysOfWeek: [
                    "ПН",
                    "ВТ",
                    "СР",
                    "ЧТ",
                    "ПТ",
                    "СБ",
                    "ВС"
                ],
                monthNames: [
                    "Январь",
                    "Февраль",
                    "Март",
                    "Апрель",
                    "Май",
                    "Июнь",
                    "Июль",
                    "Август",
                    "Сентябрь",
                    "Октябрь",
                    "Ноябрь",
                    "Декабрь"
                ],
            },
        });
    });


        $(document).ready(function () {
            $('#issue-or-sign-table').DataTable();
        });
        $(document).ready(function () {
            $('#issued').DataTable();
        });
        $(document).ready(function () {
            $('#refusals').DataTable();
        });
        $(document).ready(function () {
            $('#at-the-signing').DataTable();
        });
        $(document).ready(function () {
            $('#closed').DataTable();
        });
    </script>
@endsection
