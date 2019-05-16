<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Лиды</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="table-responsive">
                <table data-order='[[ 0, "desc" ]]' id="all-leads-table" class="table table-bordered dt-responsive " cellspacing="0"
                       width="100%">
                    <thead>
                    <tr>
                        <th>Дата</th>
                        <th>ФИО</th>
                        <th>Телефон</th>
                        <th>Желаемая сумма</th>
                        <th>Одобренная сумма</th>
                        <th>Статус</th>
                    </tr>
                    </thead>
                    <tbody class="responsive-table"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        allLeadsTable()
    });
</script>