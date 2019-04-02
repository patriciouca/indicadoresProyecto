<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script language="javascript" type="text/javascript" src="http://localhost/indicadoresProyecto/resources/js/graficas/jquery.js"></script>


            <script language="javascript" type="text/javascript" src="http://localhost/indicadoresProyecto/resources/js/graficas/jquery.js"></script>
        <script language="javascript" type="text/javascript" src="http://localhost/indicadoresProyecto/resources/js/graficas/jquery.canvaswrapper.js"></script>
        <script language="javascript" type="text/javascript" src="http://localhost/indicadoresProyecto/resources/js/graficas/jquery.colorhelpers.js"></script>
        <script language="javascript" type="text/javascript" src="http://localhost/indicadoresProyecto/resources/js/graficas/jquery.flot.js"></script>
        <script language="javascript" type="text/javascript" src="http://localhost/indicadoresProyecto/resources/js/graficas/jquery.flot.saturated.js"></script>
        <script language="javascript" type="text/javascript" src="http://localhost/indicadoresProyecto/resources/js/graficas/jquery.flot.browser.js"></script>
        <script language="javascript" type="text/javascript" src="http://localhost/indicadoresProyecto/resources/js/graficas/jquery.flot.drawSeries.js"></script>
        <script language="javascript" type="text/javascript" src="http://localhost/indicadoresProyecto/resources/js/graficas/jquery.flot.errorbars.js"></script>
        <script language="javascript" type="text/javascript" src="http://localhost/indicadoresProyecto/resources/js/graficas/jquery.flot.uiConstants.js"></script>
        <script language="javascript" type="text/javascript" src="http://localhost/indicadoresProyecto/resources/js/graficas/jquery.flot.logaxis.js"></script>
        <script language="javascript" type="text/javascript" src="http://localhost/indicadoresProyecto/resources/js/graficas/jquery.flot.symbol.js"></script>
        <script language="javascript" type="text/javascript" src="http://localhost/indicadoresProyecto/resources/js/graficas/jquery.flot.flatdata.js"></script>
        <script language="javascript" type="text/javascript" src="http://localhost/indicadoresProyecto/resources/js/graficas/jquery.flot.navigate.js"></script>
        <script language="javascript" type="text/javascript" src="http://localhost/indicadoresProyecto/resources/js/graficas/jquery.flot.fillbetween.js"></script>
        <script language="javascript" type="text/javascript" src="http://localhost/indicadoresProyecto/resources/js/graficas/jquery.flot.stack.js"></script>
        <script language="javascript" type="text/javascript" src="http://localhost/indicadoresProyecto/resources/js/graficas/jquery.flot.touchNavigate.js"></script>
        <script language="javascript" type="text/javascript" src="http://localhost/indicadoresProyecto/resources/js/graficas/jquery.flot.hover.js"></script>
        <script language="javascript" type="text/javascript" src="http://localhost/indicadoresProyecto/resources/js/graficas/jquery.flot.touch.js"></script>
        <script language="javascript" type="text/javascript" src="http://localhost/indicadoresProyecto/resources/js/graficas/jquery.flot.time.js"></script>
        <script language="javascript" type="text/javascript" src="http://localhost/indicadoresProyecto/resources/js/graficas/jquery.flot.axislabels.js"></script>
        <script language="javascript" type="text/javascript" src="http://localhost/indicadoresProyecto/resources/js/graficas/jquery.flot.selection.js"></script>
        <script language="javascript" type="text/javascript" src="http://localhost/indicadoresProyecto/resources/js/graficas/jquery.flot.composeImages.js"></script>
        <script language="javascript" type="text/javascript" src="http://localhost/indicadoresProyecto/resources/js/graficas/jquery.flot.legend.js"></script>



            <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <style>
        * {	padding: 0; margin: 0; vertical-align: top; }

        body {
        font: 18px "proxima-nova", Helvetica, Arial, sans-serif;
        line-height: 1.5;
        }

        a {	color: #069; }
        a:hover { color: #28b; }

        h2 {
        margin-top: 15px;
        font: normal 32px "omnes-pro", Helvetica, Arial, sans-serif;
        }

        h3 {
        margin-left: 30px;
        font: normal 26px "omnes-pro", Helvetica, Arial, sans-serif;
        color: #666;
        }

        p {
        margin-top: 10px;
        }

        button {
        font-size: 18px;
        padding: 1px 7px;
        }

        input {
        font-size: 18px;
        }

        input[type=checkbox] {
        margin: 7px;
        }

        #header {
        position: relative;
        width: 900px;
        margin: auto;
        }

        #header h2 {
        margin-left: 10px;
        vertical-align: middle;
        font-size: 42px;
        font-weight: bold;
        text-decoration: none;
        color: #000;
        }

        #content {
        width: 880px;
        margin: 0 auto;
        padding: 10px;
        }

        #footer {
        margin-top: 25px;
        margin-bottom: 10px;
        text-align: center;
        font-size: 12px;
        color: #999;
        }

        .demo-container {
        box-sizing: border-box;
        width: 850px;
        height: 450px;
        padding: 20px 15px 15px 15px;
        margin: 15px auto 30px auto;
        border: 1px solid #ddd;
        background: #fff;
        background: linear-gradient(#f6f6f6 0, #fff 50px);
        background: -o-linear-gradient(#f6f6f6 0, #fff 50px);
        background: -ms-linear-gradient(#f6f6f6 0, #fff 50px);
        background: -moz-linear-gradient(#f6f6f6 0, #fff 50px);
        background: -webkit-linear-gradient(#f6f6f6 0, #fff 50px);
        box-shadow: 0 3px 10px rgba(0,0,0,0.15);
        -o-box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        -ms-box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        -moz-box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        -webkit-box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        -webkit-tap-highlight-color: rgba(0,0,0,0);
        -webkit-tap-highlight-color: transparent;
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        }

        .demo-placeholder {
        width: 100%;
        height: 100%;
        font-size: 14px;
        }

        fieldset {
        display: block;
        -webkit-margin-start: 2px;
        -webkit-margin-end: 2px;
        -webkit-padding-before: 0.35em;
        -webkit-padding-start: 0.75em;
        -webkit-padding-end: 0.75em;
        -webkit-padding-after: 0.625em;
        min-width: -webkit-min-content;
        border-width: 2px;
        border-style: groove;
        border-color: threedface;
        border-image: initial;
        padding: 10px;
        }

        .legend {
        display: block;
        -webkit-padding-start: 2px;
        -webkit-padding-end: 2px;
        border-width: initial;
        border-style: none;
        border-color: initial;
        border-image: initial;
        padding-left: 10px;
        padding-right: 10px;
        padding-top: 10px;
        padding-bottom: 10px;
        }

        .legendLayer .background {
        fill: rgba(255, 255, 255, 0.85);
        stroke: rgba(0, 0, 0, 0.85);
        stroke-width: 1;
        }

        input[type="radio"] {
        margin-top: -1px;
        vertical-align: middle;
        }

        .tickLabel {
        line-height: 1.1;
        }


        </style>
        <style>
            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }



            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">


                <div id="grafica1"  style="width:600px;height:300px">

                </div>



            </div>
    </body>
</html>
<script>
    $( document ).ready(function() {
        window.onload = function () {


            $(function() {

                var d1 = [];
                for (var i = 0; i < 14; i += 0.5) {
                    d1.push([i, Math.sin(i)]);
                }

                var d2 = [[0, 3], [4, 8], [8, 5], [9, 13]];

                // A null signifies separate line segments

                var d3 = [[0, 12], [7, 12], null, [7, 2.5], [12, 2.5]];

                var  options= [{
                    data: d1,
                    lines: { show: true, fill: false }
                }
                ];


            $.plot("#grafica1", options);



            });


        }
    });
</script>