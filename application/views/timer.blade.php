@extends('layout.header')

@section('content')
    <link href="{{base_url('/static')}}/css/clock.css" rel="stylesheet">


    <div id="page-wrapper">
        <div class="container-fluid" id="main-container">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">时钟工具
                    </h1>
                </div>
            </div>

            <ul id="tableList" class="nav nav-tabs">
                <li class="active">
                    <a href="#clock-tab" data-toggle="tab">时钟</a>
                </li>
                <li><a href="#timer-tab" data-toggle="tab">倒计时</a></li>
            </ul>

            <!--折叠标签内容-->
            <div id="tabContent" class="tab-content">

                <div class="tab-pane fade in active" id="clock-tab">

                    <div id="clock" class="light">
                        <div class="display">
                            <div class="weekdays"></div>
                            <div class="ampm"></div>
                            <div class="alarm"></div>
                            <div class="digits"></div>
                        </div>
                    </div>

                    <div class="button-holder">
                        <a id="switch-theme" class="button">Switch Theme</a>
                        <a class="alarm-button"></a>
                    </div>

                    <!-- The dialog is hidden with css -->
                    <div class="overlay">

                        <div id="alarm-dialog">

                            <h2>Set alarm after</h2>

                            <label class="hours">
                                Hours
                                <input type="number" value="0" min="0" />
                            </label>

                            <label class="minutes">
                                Minutes
                                <input type="number" value="0" min="0" />
                            </label>

                            <label class="seconds">
                                Seconds
                                <input type="number" value="0" min="0" />
                            </label>

                            <div class="button-holder">
                                <a id="alarm-set" class="button blue">Set</a>
                                <a id="alarm-clear" class="button red">Clear</a>
                            </div>

                            <a class="close"></a>

                        </div>

                    </div>

                    <div class="overlay">

                        <div id="time-is-up">

                            <h2>Time's up!</h2>

                            <div class="button-holder">
                                <a class="button blue">Close</a>
                            </div>

                        </div>

                    </div>

                    <audio id="alarm-ring" preload>
                        <source src="{{base_url('/static')}}/audio/clock/ticktac.mp3" type="audio/mpeg" />
                        <source src="{{base_url('/static')}}/audio/clock/ticktac.ogg" type="audio/ogg" />
                    </audio>

                </div>


                <div class="tab-pane fade" id="timer-tab">

                    <div class="timer-box">
                        <div id="timer-showtime">
                            <span>00</span>
                            <span>:</span>
                            <span>00</span>
                            <span>:</span>
                            <span>00</span>
                        </div>
                        <div class="timer-bnt">
                            <button>记次</button>
                            <button>启动</button>
                        </div>
                        <!--记录显示的次数-->
                        <div id="timer-record">
                            <!--/*<div>
                                <span class="left">第一次记录:</span>
                                <span class="right">00:00:00</span>
                            </div>*/-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script type="application/javascript">
        $(function () {
            var min = 0;
            var sec = 0;
            var ms = 0;
            var timer = null;
            var count = 0;
            //点击第一个按钮
            $('.timer-bnt button:eq(0)').click(function () {
                if ($(this).html() == '记次') {
                    if (!timer) {
                        alert("没有开启定时器!");
                        return;
                    }
                    count++;
                    var right1 = "<span class='timer-right'>" + $('#timer-showtime').text() + "</span>";
                    var insertStr = "<div><span class='timer-left'>记次" + count + "</span>" + right1 + "</div>";

                    $("#timer-record").prepend($(insertStr));

                } else {
                    min = 0;
                    sec = 0;
                    ms = 0;
                    count = 0;
                    $('#timer-showtime span:eq(0)').html('00');
                    $('#timer-showtime span:eq(2)').html('00');
                    $('#timer-showtime span:eq(4)').html('00');
                    $('#timer-record').html('');
                }

            });
            //点击第二个按钮
            $('.timer-bnt button:eq(1)').click(function () {
                if ($(this).html() == '启动') {
                    $(this).html('停止');
                    $('.timer-bnt button:eq(0)').html('记次');
                    clearInterval(timer);
                    timer = setInterval(show, 10)
                } else {
                    $(this).html('启动');
                    $('.timer-bnt button:eq(0)').html('复位');
                    clearInterval(timer);
                }
            });
            //生成时间
            function show() {
                ms++;
                if (sec == 60) {
                    min++;
                    sec = 0;
                }
                if (ms == 100) {
                    sec++;
                    ms = 0;
                }
                var msStr = ms;
                if (ms < 10) {
                    msStr = "0" + ms;
                }
                var secStr = sec;
                if (sec < 10) {
                    secStr = "0" + sec;
                }
                var minStr = min;
                if (min < 10) {
                    minStr = "0" + min;
                }
                $('#timer-showtime span:eq(0)').html(minStr);
                $('#timer-showtime span:eq(2)').html(secStr);
                $('#timer-showtime span:eq(4)').html(msStr);
            }
        })
    </script>
    <script type="application/javascript" src="{{base_url('/static')}}/js/moment.min.js"></script>
    <script type="application/javascript" src="{{base_url('/static')}}/js/clock.js"></script>
@endsection
