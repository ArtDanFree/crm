<div class="clearfix"></div>
<div class="row text-center">
    <div class=" x_panel">
        <div class="x_title">
            <h2>Часовые пояса</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="col-xs-6 col-sm-2 col-md-2 col-lg-1 col-lg-offset-1">
                <x-clock id="clock-kaliningrad"></x-clock>
                <br>
                <p class="clock-p">
                    Калининград
                    <br>
                    UTC +2
                </p>
            </div>
            <div class="col-xs-6 col-sm-2 col-md-2 col-lg-1">
                <x-clock id="clock-moscow"></x-clock>
                <br>
                <p class="clock-p">
                    Москва
                    <br>
                    UTC +3
                </p>
            </div>
            <div class="col-xs-6 col-sm-2 col-md-2 col-lg-1">
                <x-clock id="clock-samara"></x-clock>
                <br>
                <p class="clock-p">
                    Самара
                    <br>
                    UTC +4
                </p>
            </div>
            <div class="col-xs-6 col-sm-2 col-md-2 col-lg-1">
                <x-clock id="clock-yekaterinburg"></x-clock>
                <br>
                <p class="clock-p">
                    Екатеринбург
                    <br>
                    UTC +5
                </p>
            </div>
            <div class="col-xs-6 col-sm-2 col-md-2 col-lg-1">
                <x-clock id="clock-omsk"></x-clock>
                <br>
                <p class="clock-p">
                    Омск
                    <br>
                    UTC +6
                </p>
            </div>
            <div class="col-xs-6 col-sm-2 col-md-2 col-lg-1">
                <x-clock id="clock-krasnoyarsk"></x-clock>
                <br>
                <p class="clock-p">
                    Красноярск
                    <br>
                    UTC +7
                </p>
            </div>
            <div class="col-xs-6 col-sm-2 col-md-2 col-lg-1" >
                <x-clock id="clock-irkutsk"></x-clock>
                <br>
                <p class="clock-p">
                    Иркутск
                    <br>
                    UTC +8
                </p>
            </div>
            <div class="col-xs-6 col-sm-2 col-md-2 col-lg-1" >
                <x-clock id="clock-yakutia"></x-clock>
                <br>
                <p class="clock-p">
                    Якутия
                    <br>
                    UTC +9
                </p>
            </div>
            <div class="col-xs-6 col-sm-2 col-md-2 col-lg-1">
                <x-clock id="clock-vladivostok"></x-clock>
                <br>
                <p class="clock-p">
                    Владивосток
                    <br>
                    UTC +10
                </p>
            </div>
            <div class="col-xs-6 col-sm-2 col-md-2 col-lg-1">
                <x-clock id="clock-srednekolymsk"></x-clock>
                <br>
                <p class="clock-p">
                    Среднеколымск
                    <br>
                    UTC +11
                </p>
            </div>
        </div>
    </div>
</div>
<script>
    function time() {
        $('#clock-kaliningrad').html(moment().tz('Europe/Kaliningrad').format('H:m'));
        $('#clock-moscow').html(moment().tz('Europe/Moscow').format('H:m'));
        $('#clock-samara').html(moment().tz('Europe/Samara').format('H:m'));
        $('#clock-yekaterinburg').html(moment().tz('Asia/Yekaterinburg').format('H:m'));
        $('#clock-omsk').html(moment().tz('Asia/Omsk').format('H:m'));
        $('#clock-krasnoyarsk').html(moment().tz('Asia/Krasnoyarsk').format('H:m'));
        $('#clock-irkutsk').html(moment().tz('Asia/Irkutsk').format('H:m'));
        $('#clock-yakutia').html(moment().tz('Asia/Yakutsk').format('H:m'));
        $('#clock-vladivostok').html(moment().tz('Asia/Vladivostok').format('H:m'));
        $('#clock-srednekolymsk').html(moment().tz('Asia/Srednekolymsk').format('H:m'));
    }
    $(document).ready(function () {
        setInterval(time, 1000)
    });
</script>