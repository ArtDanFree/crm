window.Echo.join(`underwriter.online`)
    .here((users) => {
        if ($('#underwriters_working_time').length) {
            if ($.fn.DataTable.isDataTable('#underwriters_working_time')) {
                $('#underwriters_working_time').DataTable().destroy();
            }
            let url = "/ajax/underwriters_working_time_table";
            $('#underwriters_working_time').DataTable({
                ajax: {
                    url: url,
                    dataSrc: function (data) {
                        for (id in data.data) {
                            for (user in users) {
                                if (users[user].underwriter) {
                                    if (data.data[id].DT_RowId == users[user].id) {
                                        data.data[id][2] = '<b>online</b>';
                                        data.data[id].DT_RowClass = 'success';
                                    }
                                }
                            }
                        }
                        return data.data
                    },
                },
            });
        }
    })
    .joining((user) => {
        joining(user);
    })
    .leaving((user) => {
        leaving(user);
    });

function joining(user) {
    if (user.underwriter) {
        let row = $('#' + String(user.id));
        row.addClass('success');
        let table = $('#underwriters_working_time').DataTable();
        let online = '<b>online</b>';
        let cell = row.find('b').parent();
        table.cell(cell).data(online).draw()
    }
}

function leaving(user) {
    if (user.underwriter) {
        let row = $('#' + String(user.id));
        row.removeClass('success');
        let table = $('#underwriters_working_time').DataTable();
        let offline = '<b>offline</b>';
        let cell = row.find('b').parent();
        table.cell(cell).data(offline).draw()
    }
}