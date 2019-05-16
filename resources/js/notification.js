var audio = new Audio();
audio.preload = 'auto';
audio.src = '/sound/1.mp3';

window.Echo.private('user.' + userId)
    .listen('NewLeadNotification', (e) => {
        allLeadsTable();
        updateNotification();
    })
    .listen('LeadTakeOnCheckNotification', (e) => {
        allLeadsTable();
        updateNotification()
    })
    .listen('LeadApprovalNotification', (e) => {
        makeAppointmentTable();
        allLeadsTable();
        updateNotification();
        $(audio.play());

    });


window.Echo.private('underwriters')
    .listen('NewLeadNotification', (e) => {
        takeOnCheckTable();
        allLeadsTable();
        updateNotification();
        $(audio.play());
    })
    .listen('LeadTakeOnCheckNotification', (e) => {
        takeOnCheckTable();
        allLeadsTable();
        updateNotification()
    });

function allLeadsTable() {
    if ($('#all-leads-table').length) {
        if ($.fn.DataTable.isDataTable('#all-leads-table')) {
            $('#all-leads-table').DataTable().destroy();
        }
        let url = "/ajax/all_leads_table";
        $('#all-leads-table').DataTable({
            ajax: url
        })
    }
}

function takeOnCheckTable() {
    if ($('#take-on-check-table').length) {
        if ($.fn.DataTable.isDataTable('#take-on-check-table')) {
            $('#take-on-check-table').DataTable().destroy();
        }
        let url = "/ajax/take_on_check_table";
        $('#take-on-check-table').DataTable({
            ajax: url
        })
    }
}

function makeAppointmentTable() {
    if ($('#make-appointment-table').length) {
        if ($.fn.DataTable.isDataTable('#make-appointment-table')) {
            $('#make-appointment-table').DataTable().destroy();
        }
        let url = "/ajax/make_appointment_table";
        $('#make-appointment-table').DataTable({
            ajax: url
        });
    }
}

function updateTransactionNotification() {
    $.ajax({
        type: 'GET',
        url: '/ajax/menu_notification/transaction'
    }).success(function (e) {
        $('.transaction-n').text(e);
        if (e == 0) {
            $('.transaction-n').addClass('hidden');
        } else {
            $('.transaction-n').removeClass('hidden');
        }
    });
}

function updateLeadNotification() {
    $.ajax({
        type: 'GET',
        url: '/ajax/menu_notification/lead'
    }).success(function (e) {
        $('.lead-n').text(e);
        if (e == 0) {
            $('.lead-n').addClass('hidden');
        } else {
            $('.lead-n').removeClass('hidden');
        }
    });
}

function updateNotification() {
    updateLeadNotification();
    updateTransactionNotification()
}

$(document).ready(function () {
    updateLeadNotification();
    updateTransactionNotification()
});


$(document).ready(function () {
    if ($('#all-transactions-table').length) {
        $('#all-transactions-table').DataTable();
    }
});

function questionsTable() {
    if ($('#questions-table').length) {
        if ($.fn.DataTable.isDataTable('#questions-table')) {
            $('#questions-table').DataTable().destroy();
        }
        let url = "/ajax/question_table";
        $('#questions-table').DataTable({
            ajax: url
        })
    }
}