<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Все вопросы</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Лиды</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="table-responsive">
                        <table id="questions-table" class="table table-bordered dt-responsive " cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th>Вопрос</th>
                                <th>Ответ</th>
                                <th>What IS</th>
                                <th>Редактировать</th>
                            </tr>
                            </thead>
                            <tbody class="responsive-table"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('script')
    <script src="{{ asset('vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
    <script>
        $(document).ready(function () {
            questionsTable();
        });
    </script>
    @if (session('success'))
        <script>
            new PNotify({
                title: 'Вопрос успешно создан!',
                text: 'Вам ответят в ближайшее время',
                type: 'success',
                styling: 'bootstrap3'
            });
        </script>
    @endif
@endsection