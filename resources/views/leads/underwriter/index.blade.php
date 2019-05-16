<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3>Лиды</h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        {{--<div class="col-lg-12 col-md-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Возьмите на проверку</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="table-responsive">
                        <table id="take-on-check-table" class="table table-hover">
                            <thead>
                            <tr>
                                <th>Добавлен</th>
                                <th>Лид</th>
                                <th>Залог</th>
                                <th>ЧИН</th>
                            </tr>
                            </thead>
                            <tbody id="leads_table_tbody">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>--}}
        @include('leads.all_leads_table')
    </div>
</div>
<script>
    $(document).ready(function () {
        takeOnCheckTable();
    });
</script>