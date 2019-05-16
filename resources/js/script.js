function FindFile() {
    document.getElementById('my_hidden_file').click();
}

function Count() {
    var el = document.getElementById('show_file');

    for (var i = 0; i < document.getElementById("my_hidden_file").files.length; i++) {
        var div1 = document.createElement('div');
        div1.innerHTML = document.getElementById("my_hidden_file").files[i].name;
        div1.setAttribute('id', 'del-icon-' + i);

        var img = document.createElement("i");
        img.setAttribute('class', 'fa fa-close');
        img.setAttribute('onclick', 'delete_file(' + i + ')');
        div1.insertBefore(img, div1.firstChild);

        var myImg = document.createElement("img");
        div1.insertBefore(myImg, div1.firstChild);

        el.insertBefore(div1, el.firstChild);
    }
}

function delete_file(i) {
    var elem = document.getElementById('del-icon-' + i);

    elem.innerHTML = '';
}

/////


function expiration(index) {

    var elem = document.getElementById('table_deals');
    elem.innerHTML = '';

    cb = document.getElementById('checkbox1');
    if (cb.checked) {
        index = parseInt($('#month_count').val()) + 2;
    }

    if ($("#effectTypes").val() == 1) {
        index++;
    }

    for (var i = index; i > 0; i--) {
        var tr = document.createElement("tr");

        var td = document.createElement("td");
        var input = document.createElement("input");
        input.setAttribute('id', 'all' + i);
        input.setAttribute('readonly', 'readonly');
        input.setAttribute('class', 'locked');
        td.insertBefore(input, td.firstChild);
        tr.insertBefore(td, tr.firstChild);

        var td = document.createElement("td");
        var input = document.createElement("input");
        input.setAttribute('id', 'perc' + i);
        input.setAttribute('readonly', 'readonly');
        input.setAttribute('class', 'locked');
        td.insertBefore(input, td.firstChild);
        tr.insertBefore(td, tr.firstChild);

        var td = document.createElement("td");
        var input = document.createElement("input");
        input.setAttribute('id', 'body' + i);
        input.setAttribute('readonly', 'readonly');
        input.setAttribute('class', 'locked');
        td.insertBefore(input, td.firstChild);
        tr.insertBefore(td, tr.firstChild);

        var td = document.createElement("td");
        var input = document.createElement("input");
        input.setAttribute('id', 'input' + i);
        input.setAttribute('readonly', 'readonly');
        input.setAttribute('class', 'locked');
        td.insertBefore(input, td.firstChild);
        tr.insertBefore(td, tr.firstChild);

        var td = document.createElement("td");
        td.innerHTML = i;
        tr.insertBefore(td, tr.firstChild);
        elem.insertBefore(tr, elem.firstChild);
    }
}

function showOrHide() {

    cb = document.getElementById('checkbox1');
    a = $('#month_count').val();
    if (cb.checked) {
        expiration(parseInt(a) + 2);
    } else {
        expiration(parseInt(a));
    }
}

$(document).ready(function () {

    $('#month_count').on('change', function () {
        a = $('#month_count').val();

        if (a <= 60) {
            expiration(a);
        } else {
            alert('Срок займа не должен превышать 5 лет');
        }
    });
});

///////////////// расчет  ///////////////////

function getDiffYear(input) {
    var date = new Date(input);
    month = date.getMonth();
    year = date.getFullYear();
    var year_date1 = new Date(['01', '01', year].join('/'));
    var year_date2 = new Date(['01', '01', year + 1].join('/'));
    var milliseconds = year_date2 - year_date1;
    var days = milliseconds / 1000 / 60 / 60 / 24;
    return days;
}

function getDiffYear2(input) {
    var date = new Date(input);
    year = date.getFullYear();
    day = date.getDate();
    month = date.getMonth();

    var year_date1 = new Date([month, day, year].join('/'));
    var year_date2 = new Date([month, day, year + 1].join('/'));
    var milliseconds = year_date2 - year_date1;
    var days = milliseconds / 1000 / 60 / 60 / 24;
    return days;
}

function getDiffMonth(input) {
    var date1 = new Date(input);
    month1 = date1.getMonth();
    year1 = date1.getFullYear();
    day1 = date1.getDate();
    date1.setMonth(date1.getMonth() + 1);
    month2 = date1.getMonth();
    year2 = date1.getFullYear();
    day2 = date1.getDate();

    var month_date1 = new Date([month1 + 1, day1, year1].join('/'));
    var month_date2 = new Date([month2 + 1, day2, year2].join('/'));
    var milliseconds = month_date2 - month_date1;
    var days1 = milliseconds / 1000 / 60 / 60 / 24;

    return days1;
}

function getTableDate(input) {
    var date = new Date(input);
    var s = 1;

    if ($("#checkbox1").prop("checked") == true) {
        var date2 = new Date(input);
        date2.setDate(date2.getDate() + 1);
        date2.setMonth(date2.getMonth() + 1);

        for (var i = 1; i < 3; i++) {
            day2 = date2.getDate();
            month2 = date2.getMonth();
            year2 = date2.getFullYear();

            if (("" + (month2 + 1)).length > 1) {
                $('#input' + i).val([day2, month2, year2].join('.'));
            } else {
                $('#input' + i).val([day2, "0" + month2, year2].join('.'));
            }

            date2.setDate(date2.getDate() + 1);
        }
        s = 3;
    }

    var count = $('#month_count').val();
    for (var i = s; i <= +count + 1 + s - 1; i++) {
        date.setMonth(date.getMonth() + 1);
        day = date.getDate();
        month = date.getMonth();
        year = date.getFullYear();
        if (("" + (month + 1)).length > 1) {
            $('#input' + i).val([day, month + 1, year].join('.'));
        } else {
            $('#input' + i).val([day, "0" + (month + 1), year].join('.'));
        }
    }
}

function getPercentYear(percent) {
    result = percent * 12;
    return result;
}

function getAll(ost, proc) {
    var result = 0;
    var st = getPercentYear($('#percent').val());
    var sum = $('#credit').val();
    var mes = $('#month_count').val();
    var temp = sum * st / 100 / 12 / (1 - Math.pow(1 + st / 100 / 12, -mes));
    if (sum * st / 100 / 12 / (1 - Math.pow(1 + st / 100 / 12, -mes)) < ost) {
        result = Math.ceil(sum * st / 100 / 12 / (1 - Math.pow(1 + st / 100 / 12, -mes)));
    } else {
        result = +ost + +proc;
    }
    return result;
}

function dateNormalization(input) {
    arr = input.split('.');

    var result = [arr[1], arr[0], arr[2]].join('/');
    return result;
}

function plusTwo(total) {
    var w = +total * 12 / getDiffYear2(dateNormalization($('#input0').val()));
    for (var i = 1; i <= 2; i++) {
        $('#body' + i).val('0');
        $('#all' + i).val(w.toFixed(2));
        $('#perc' + i).val(w.toFixed(2));
    }

    $('#all3').val(($('#all3').val() - w * 2).toFixed(2));
    $('#perc3').val(($('#perc3').val() - w * 2).toFixed(2));
}

function plusTwoAnn() {
    var k = getDiffMonth(dateNormalization($('#input0').val()));
    var total = $('#all3').val() / k;
    var body = $('#body3').val() / k;
    var perc = $('#perc3').val() / k;

    for (var i = 1; i <= 2; i++) {
        $('#body' + i).val(body.toFixed(2));
        $('#all' + i).val(total.toFixed(2));
        $('#perc' + i).val(perc.toFixed(2));
    }

    $('#body3').val(($('#body3').val() - body * 2).toFixed(2));
    $('#all3').val(($('#all3').val() - total * 2).toFixed(2));
    $('#perc3').val(($('#perc3').val() - perc * 2).toFixed(2));
}

function resultDeals() {
    var body = 0;
    var total = 0;
    var percent = 0;
    var count = $('#month_count').val();
    var s = 0;
    if ($("#effectTypes").val() == 1) {
        s++;
    }
    if ($("#checkbox1").prop("checked") == true) {
        s = s + 2;
    }
    for (var i = 1; i <= +count + s; i++) {
        body = body + +$('#body' + i).val();
        percent = percent + +$('#perc' + i).val();
        total = total + +$('#all' + i).val();
    }
    $('#table_deals').append(" <tr> <td></td>  <td>Итого</td> <td>" + body.toFixed(2) + "</td> <td>" + percent.toFixed(2) + "</td> <td>" + total.toFixed(2) + "</td></tr> ");
}

function onlyPercents(s) {
    var count = $('#month_count').val();
    var total = $('#credit').val() * getPercentYear($('#percent').val()) / 100 / count;

    for (var i = s; i <= +count + s; i++) {
        $('#perc' + i).val(total);
        if (i != +count + s - 1) {
            $('#body' + i).val('0');
            $('#all' + i).val(total);
        } else {
            $('#body' + i).val($('#credit').val());
            $('#all' + i).val(+total + +$('#credit').val());
        }
    }
    if ($("#checkbox1").prop("checked") == true) {
        plusTwo(total);
    }
}

function annuityDeals(s) {
    var ost = $('#credit').val();
    var count = $('#month_count').val();
    for (var i = s; i <= +count + 1 + (s - 1); i++) {
        $('#perc' + i).val((ost * getPercentYear($('#percent').val()) * getDiffMonth(dateNormalization($('#input' + (i - 1)).val())) / getDiffYear(dateNormalization($('#input' + i).val())) / 100).toFixed(2));
        $('#all' + i).val(getAll(ost, $('#perc' + i).val()).toFixed(2));
        $('#body' + i).val(($('#all' + i).val() - $('#perc' + i).val()).toFixed(2));
        ost = ost - $('#body' + i).val();
    }
    if ($("#checkbox1").prop("checked") == true) {
        plusTwoAnn();
    }
}

function calculate() {

    var s = 1;
    if ($("#checkbox1").prop("checked") == true) {
        s = 3;
    }
    expiration(parseInt($('#month_count').val()));
    getTableDate(dateNormalization($('#input0').val()));

    if ($("#effectTypes").val() == 0) {
        onlyPercents(s);
    }

    if ($("#effectTypes").val() == 1) {
        annuityDeals(s);
    }

    resultDeals();
}

$(function () {
    $("#locked").click(function () {

        if ($('#locked').hasClass('fa-lock')) {
            $('#locked').removeClass('fa-lock').addClass('fa-unlock');
            $('.locked').prop('readonly', false);
        } else {
            $('#locked').removeClass('fa-unlock').addClass('fa-lock');
            $('.locked').prop('readonly', true);
        }
    });
});

function CallPrint(strid) {
    var prtContent = document.getElementById(strid);
    var WinPrint = window.open('', '', 'left=50,top=50,width=800,height=640,toolbar=0,scrollbars=1,status=0');
    WinPrint.document.write('<div id="print" class="contentpane">');
    WinPrint.document.write(prtContent.innerHTML);
    WinPrint.document.write('</div>');
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
    WinPrint.close();
    prtContent.innerHTML = strOldOne;
}

$(function () {
    $('input').on('input keyup', function (e) {

        checkInput();
    });
});

function checkInput(ins) {
    var state = 0;
    var arr = ['.pts', '.parking'];
    var arr_img = ['#pts-img', '#parking-img'];
    for (var i = 0; i < 2; i++) {
        $("#prokrutka").find(arr[i]).each(function () {
            if ($(this).val() != '') {
                state++;
            }
            if (state != 0) {
                $(arr_img[i]).css("display", "contents");
            } else {
                $(arr_img[i]).css("display", "none");
            }
        });
        state = 0;
    }
}

$(function () {
    var fileInput = $('#file-field');
    var imgList = $('ul#img-list');
    var dropBox = $('#img-container');
    fileInput.bind({
        change: function change() {
            displayFiles(this.files);
        }
    });
    dropBox.bind({
        dragenter: function dragenter() {
            //$(this).addClass('highlighted');
            return false;
        },
        dragover: function dragover() {
            $(this).addClass('highlighted');
            return false;
        },
        dragleave: function dragleave() {
            $(this).removeClass('highlighted');
            return false;
        },
        drop: function drop(e) {
            var dt = e.originalEvent.dataTransfer;
            displayFiles(dt.files);
            return false;
        }
    });

    function displayFiles(files) {
        $.each(files, function (i, file) {
            if (!file.type.match(/image.*/)) {
                // Отсеиваем не картинки
                return true;
            }

            var li = $('<li/>').appendTo(imgList);
            var div = $('<div/>').appendTo(imgList);
            div.attr('aria-controls', 'datatable');
            div.attr('data-dt-idx', '1');

            var img = $('<img/>').appendTo(li);
            img.attr('aria-controls', 'datatable');
            img.attr('data-dt-idx', '2');
            img.attr('class', 'upload-picture');
            li.get(0).file = file;

            var reader = new FileReader();
            reader.onload = function (aImg) {
                return function (e) {
                    aImg.attr('src', e.target.result);
                    li.append('   <a data-fancybox="gallery" href="' + e.target.result + '">' + file.name + '</a> ');
                    aImg.attr('width', 150);
                };
            }(img);

            reader.readAsDataURL(file);
        });
    }
});

/////////// переместить
//**//
$(document).ready(function () {
    if (jQuery().DataTable) {
        $('#datatable-responsive').DataTable({
            "order": [[1, "desc"]]
        });
    }

    if (jQuery().DataTable) {
        $('#all-leads').DataTable({
            "order": [[1, "desc"]],
            "pageLength": 50
        });
    }
});

function startCheck(id) {
    if ($('#start-check').hasClass('disabled') == false) {

        $('#start-check').addClass('disabled');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: take_on_check,
            data: {id: id},
            dataType: 'json',
            success: function (data) {
                if ($('#deposit_type').val() == 'Недвижимость') {
                    $("#insert-panel-realty").css("display", "block");
                } else {
                    $("#insert-panel-auto").css("display", "block");
                }
                $('#start-check').addClass('hidden');

                $("#button-panel").append('' +
                    '<button data-target="#auto-check" class="btn btn-info btn-block" data-dismiss="modal" data-toggle="modal">\n' +
                    '                                    Автоматическая проверка\n' +
                    '                                </button>\n' +
                    '                                <button class="btn btn-warning btn-block" data-dismiss="modal" data-toggle="modal" data-target="#modification_modal">\n' +
                    '                                    Доработать\n' +
                    '                                </button>\n' +
                    '                                <button class="btn btn-danger btn-block" data-dismiss="modal" data-toggle="modal" data-target="#decline_modal">\n' +
                    '                                    Отказаться\n' +
                    '                                </button>' +
                    '')

            }
        });
    }
}

function backButton() {
    if ($('#deposit_type').val() == 'Недвижимость') {
        $("#insert-panel-realty").css("display", "none");
    } else {
        $("#insert-panel-auto").css("display", "none");
    }

    $("#button-panel").css("display", "block");
    $("#status-table").css("display", "block");
}

function leadDecline(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    if ($('#decline-comment').val() != '') {
        $.ajax({
            type: 'POST',
            url: lead_decline,
            data: {id: id, comment: $("#decline-comment").val()},
            dataType: 'json',
            success: function (data) {
                $("#button-panel").empty();
                $("#button-panel").append('<button id="start-check" onclick="startCheck(' + id + ')" class="btn btn-success btn-block" data-dismiss="modal">Начать проверку</button>');
                for (var i = 3; i > 1; i--) {
                    $('#status-table tr:eq(' + i + ')').remove();
                }
                $("#status-table").append('<tr><td>Комментарий</td><td>' + $("#decline-comment").val() + '</td> </tr>');
            }
        });
    } else {
        {
            new PNotify({
                title: 'Ошибка',
                text: 'Укажите комментарий',
                type: 'error',
                styling: 'bootstrap3'
            })
        }
    }
}

function leadRemake(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    if ($('#remake-comment').val() != '') {
        $.ajax({
            type: 'POST',
            url: lead_remake,
            data: {id: id, comment: $("#remake-comment").val()},
            dataType: 'json',
            success: function (data) {
                $("#button-panel").empty();
                $("#button-panel").append('<button id="start-check" onclick="startCheck(' + id + ')" class="btn btn-success btn-block" data-dismiss="modal">Начать проверку</button>');

                var rowCount = $('#status-table tr').length;

                for (var i = rowCount; i > 1; i--) {
                    $('#status-table tr:eq(' + i + ')').remove();
                }

                $("#status-table").append('<tr><td>Комментарий</td><td>' + $("#remake-comment").val() + '</td> </tr>' +
                    '<tr><td>Андеррайтер</td>' +
                    '<td>' + data.underwriter + '</td>' +
                    '</tr><tr><td>Статус</td><td>На доработку</td></tr>');
            }
        });
    } else {
        {
            new PNotify({
                title: 'Ошибка',
                text: 'Укажите комментарий',
                type: 'error',
                styling: 'bootstrap3'
            })
        }
    }
}

function leadWaiver(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    if ($('#waiver-comment').val() != '') {
        $.ajax({
            type: 'POST',
            url: 'lead_waiver',
            data: {id: id, comment: $("#waiver-comment").val()},
            dataType: 'json',
            success: function (data) {
                if ($('#deposit_type').val() == 'Недвижимость') {
                    $("#insert-panel-realty").css("display", "none");
                } else {
                    $("#insert-panel-auto").css("display", "none");
                }
                $("#status-table").css("display", "block");
            }
        });
    } else {
        {
            new PNotify({
                title: 'Ошибка',
                text: 'Укажите комментарий',
                type: 'error',
                styling: 'bootstrap3'
            })
        }
    }
}

function leadApproval(id) {
    if ($('#lead-approved-button').hasClass('disabled') == false) {
        $('#lead-approved-button').addClass('disabled');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: 'lead_approval',
            data: {id: id},
            dataType: 'json',
            success: function (data) {
                window.location = data.url;
                if ($('#deposit_type').val() == 'Недвижимость') {
                    $("#insert-panel-realty").css("display", "none");
                } else {
                    $("#insert-panel-auto").css("display", "none");
                }
                $("#status-table").css("display", "block");///
            }
        });
    }
}

$(".check-vin").change(function () {
    if ($('#vin-in-pts').val() == $('#vin-in-sts').val()) {
        $('#vin-in-sts').attr('class', 'equal-vin');
        $('#vin-in-pts').attr('class', 'equal-vin');
    } else {
        $('#vin-in-sts').attr('class', 'different-vin');
        $('#vin-in-pts').attr('class', 'different-vin');
    }
});

if ($("#vin-in-pts").length) {
    var input = document.getElementById('vin-in-pts');
    input.oncut = input.oncopy = input.onpaste = function (event) {
        return false;
    };
}


$(document).on('onInit.fb', function (e, instance) {
    if ($('.fancybox-toolbar').find('#rotate_button').length === 0) {
        $('.fancybox-toolbar').prepend('<button id="rotate_button_right" class="fancybox-button" title="Rotate Image"><i class="fa fa-repeat"></i></button>');
        $('.fancybox-toolbar').prepend('<button id="rotate_button_left" class="fancybox-button" title="Rotate Image"><i class="fa fa-rotate-left"></i></button>');
    }
    var n = 0;
    $('.fancybox-toolbar').on('click', '#rotate_button_right', function () {
        n = n + 90;
        $('.fancybox-image').css('webkitTransform', 'rotate(' + n + 'deg)');
        $('.fancybox-image').css('mozTransform', 'rotate(' + n + 'deg)');
    });

    $('.fancybox-toolbar').on('click', '#rotate_button_left', function () {
        n = n - 90;
        $('.fancybox-image').css('webkitTransform', 'rotate(' + n + 'deg)');
        $('.fancybox-image').css('mozTransform', 'rotate(' + n + 'deg)');
    });
});


$('#clientModal').on('hidden.bs.modal', function () {
    $("#img-loading").removeClass("hidden-block-info");
    $("#img-loading").addClass("show-block-info");

    $("#hidden-block-info").removeClass("show-block-info");
    $("#hidden-block-info").addClass("hidden-block-info");
});
