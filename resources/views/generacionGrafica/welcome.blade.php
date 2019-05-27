<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<?php
use Illuminate\Http\Request;
?>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script language="javascript" type="text/javascript" src="/indicadoresProyecto/resources/js/graficas/jquery.js"></script>
        <script
                src="https://code.jquery.com/jquery-1.11.3.js"
                integrity="sha256-IGWuzKD7mwVnNY01LtXxq3L84Tm/RJtNCYBfXZw3Je0="
                crossorigin="anonymous"></script>
        <script src="https://superal.github.io/canvas2image/canvas2image.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
        <script language="javascript" type="text/javascript" src="/indicadoresProyecto/resources/js/graficas/jquery.js"></script>
        <script language="javascript" type="text/javascript" src="/indicadoresProyecto/resources/js/graficas/jquery.canvaswrapper.js"></script>
        <script language="javascript" type="text/javascript" src="/indicadoresProyecto/resources/js/graficas/jquery.colorhelpers.js"></script>
        <script language="javascript" type="text/javascript" src="/indicadoresProyecto/resources/js/graficas/jquery.flot.js"></script>
        <script language="javascript" type="text/javascript" src="/indicadoresProyecto/resources/js/graficas/jquery.flot.saturated.js"></script>
        <script language="javascript" type="text/javascript" src="/indicadoresProyecto/resources/js/graficas/jquery.flot.browser.js"></script>
        <script language="javascript" type="text/javascript" src="/indicadoresProyecto/resources/js/graficas/jquery.flot.drawSeries.js"></script>
        <script language="javascript" type="text/javascript" src="/indicadoresProyecto/resources/js/graficas/jquery.flot.errorbars.js"></script>
        <script language="javascript" type="text/javascript" src="/indicadoresProyecto/resources/js/graficas/jquery.flot.uiConstants.js"></script>
        <script language="javascript" type="text/javascript" src="/indicadoresProyecto/resources/js/graficas/jquery.flot.logaxis.js"></script>
        <script language="javascript" type="text/javascript" src="/indicadoresProyecto/resources/js/graficas/jquery.flot.symbol.js"></script>
        <script language="javascript" type="text/javascript" src="/indicadoresProyecto/resources/js/graficas/jquery.flot.flatdata.js"></script>
        <script language="javascript" type="text/javascript" src="/indicadoresProyecto/resources/js/graficas/jquery.flot.navigate.js"></script>
        <script language="javascript" type="text/javascript" src="/indicadoresProyecto/resources/js/graficas/jquery.flot.fillbetween.js"></script>
        <script language="javascript" type="text/javascript" src="/indicadoresProyecto/resources/js/graficas/jquery.flot.stack.js"></script>
        <script language="javascript" type="text/javascript" src="/indicadoresProyecto/resources/js/graficas/jquery.flot.touchNavigate.js"></script>
        <script language="javascript" type="text/javascript" src="/indicadoresProyecto/resources/js/graficas/jquery.flot.hover.js"></script>
        <script language="javascript" type="text/javascript" src="/indicadoresProyecto/resources/js/graficas/jquery.flot.touch.js"></script>
        <script language="javascript" type="text/javascript" src="/indicadoresProyecto/resources/js/graficas/jquery.flot.time.js"></script>
        <script language="javascript" type="text/javascript" src="/indicadoresProyecto/resources/js/graficas/jquery.flot.axislabels.js"></script>
        <script language="javascript" type="text/javascript" src="/indicadoresProyecto/resources/js/graficas/jquery.flot.selection.js"></script>
        <script language="javascript" type="text/javascript" src="/indicadoresProyecto/resources/js/graficas/jquery.flot.composeImages.js"></script>
        <script language="javascript" type="text/javascript" src="/indicadoresProyecto/resources/js/graficas/jquery.flot.legend.js"></script>
        <script type="text/javascript" src="/js/jquery-1.8.3.min.js"></script>
        <script type="text/javascript" src="/js/flot/jquery.flot.js"></script>
        <script type="text/javascript" src="/js/flot/jquery.flot.time.js"></script>
        <script type="text/javascript" src="/js/flot/jquery.flot.axislabels.js"></script>


            <title>Generador de Indicadores Automático</title>

        <link rel="shortcut icon" href={{ URL::asset('img/logo1.ico') }} />

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

            .graficas{
                display: inline-flex;
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
                <div class="title m-b-md" id="export">

                    <button id="btnSave">Exportar a PNG</button>
                    <div id="grafica1"  style="width:600px;height:300px"></div>
                    <div class="graficas">

                        <div id="img-out"></div>
                    <table class="table">
                        <tr>
                            <td><h6 style ="float:left;margin: 20px">Líneas</h6></td>
                            <td><input type="checkbox" id="lines"  style ="float:left;margin: 20px" checked></td>
                            <td><input type="color" id="cLinea" value="#ffd3ab" style ="float:left;margin: 20px"></td>
                        </tr>
                        <tr>
                            <td><h6 style ="float:left;margin: 20px">Puntos</h6></td>
                            <td><input type="checkbox" id="points" style ="float:left;margin: 20px" checked></td>
                            <td><input type="color" id = "cPuntos" value="#d3ffb5" style ="float:left;margin: 20px"></td>

                        </tr>
                        <tr>
                            <td><h6 style ="float:left;margin: 20px">Barras</h6></td>
                            <td><input type="checkbox" id="bars" style ="float:left;margin: 20px" checked></td>
                            <td> <input type="color" id = "cBarras" value="#c1e9ff" style ="float:left;margin: 20px"></td>
                        </tr>
                        <tr>
                            <td><h6 style ="float:left;margin: 20px">Relleno</h6></td>
                            <td><input type="checkbox" id="relleno" style ="float:left;margin: 20px" checked></td>
                            <td><input type="color" id="cLineas" value="#ffd3ab" style ="float:left;margin: 20px"></td>
                        </tr>
                </table>



                    <!--<table class="table">
                        <tr>
                            <td><h6 style ="float:left;margin: 20px">Min</h6></td>
                            <td> <input id = "nMinY" type="number" value="0" style ="float:left;margin: 20px"></td>
                        </tr>
                        <tr>
                            <td><h6 style ="float:left;margin: 20px">Max</h6></td>
                            <td> <input id = "nMaxY" type="number" value="20" style ="float:left;margin: 20px"></td>
                        </tr>
                        <tr>
                            <td><h6 style ="float:left;margin: 20px">Ticks</h6></td>
                            <td> <input id = "ticksY" type="number" value="5" style ="float:left;margin: 20px"></td>
                        </tr>
                        <tr>
                            <td><h6 style ="float:left;margin: 20px">Digitos</h6></td>
                            <td> <input id = "ticksYD" type="number" value="0" style ="float:left;margin: 20px"></td>
                        </tr>
                    </table>

                        <table class="table">
                            <tr>
                                <td><h6 style ="float:left;margin: 20px">Min</h6></td>
                                <td> <input id = "nMinX" type="number" value="0" style ="float:left;margin: 20px"></td>
                            </tr>
                            <tr>
                                <td><h6 style ="float:left;margin: 20px">Max</h6></td>
                                <td> <input id = "nMaxX" type="number" value="20" style ="float:left;margin: 20px"></td>
                            </tr>
                            <tr>
                                <td><h6 style ="float:left;margin: 20px">Ticks</h6></td>
                                <td> <input id = "ticksX" type="number" value="5" style ="float:left;margin: 20px"></td>
                            </tr>
                            <tr>
                                <td><h6 style ="float:left;margin: 20px">Digitos</h6></td>
                                <td> <input id = "ticksXD" type="number" value="0" style ="float:left;margin: 20px"></td>
                            </tr>
                        </table>-->
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<script>

    var cL = "#ffd3ab";
    var cP = "#d3ffb5";
    var cB = "#c1e9ff";
    var cLL = "#ffd3ab";
    var nminY=0;
    var nmaxY=20;
    var ticksY=5;
    var ticksYD=0;

    var nminX=0;
    var nmaxX=5;
    var ticksX=5;
    var ticksXD=0;

    var bLines=true;
    var bPoints = true;
    var bBars = true;
    var bFill = true;

    $("#cLinea").change(function () {
        cL = $("#cLinea").val();
        carga();
    });

    $("#cPuntos").change(function () {
        cP = $("#cPuntos").val();
        carga();
    });

    $("#cBarras").change(function () {
        cB = $("#cBarras").val();
        carga();
    });

    $("#cRelleno").change(function () {
        cR = $("#cRelleno").val();
        carga();
    });

    $("#lines").click(function () {
        if ($(this).prop("checked")) {
            bLines = true;
            carga();
        }
        else {
            bLines = false;
            carga();
        }
    });

    $("#points").click(function () {
        if ($(this).prop("checked")) {
            bPoints = true;
            carga();
        }
        else {
            bPoints = false;
            carga();
        }
    });

    $("#bars").click(function () {
        if ($(this).prop("checked")) {
            bBars = true;
            carga();
        }
        else {
            bBars = false;
            carga();
        }
    });

    $("#relleno").click(function () {
        if ($(this).prop("checked")) {
            bFill = true;
            carga();
        }
        else {
            bFill = false;
            carga();
        }
    });

    $("#nMinY").change(function () {
        nminY = $("#nMinY").val();
        carga();
    });

    $("#nMaxY").change(function () {
        nMaxY = $("#nMaxY").val();
        carga();
    });

    $("#ticksY").change(function () {
        ticksY = $("#ticksY").val();
        carga();
    });

    $("#ticksYD").change(function () {
        ticksYD = $("#ticksYD").val();
        carga();
    });

    $("#nMinX").change(function () {
        nMinX = $("#nMinX").val();
        carga();
    });

    $("#nMaxX").change(function () {
        nMaxX = $("#nMaxX").val();
        carga();
    });

    $("#ticksX").change(function () {
        ticksX = $("#ticksX").val();
        carga();
    });

    $("#ticksXD").change(function () {
        ticksXD = $("#ticksXD").val();
        carga();
    });

    $("#cLinea").change(function () {
        cLL = $("#cLinea").val();
        carga();
    });

    $(function() {
        $("#btnSave").click(function() {

            html2canvas($("#grafica1"), {
            onrendered: function(canvas) {
                theCanvas = canvas;
                //document.body.appendChild(canvas);

                // Convert and download as image
                Canvas2Image.saveAsPNG(canvas);

                // Clean up
                //document.body.removeChild(canvas);
            }

            });

        });
    });


    function carga() {
        var i = 0;
        var d1=[];

        var maxX;
        var minX;

        var ejex = <?php print_r($ejex) ?>;
        var ejey = <?php print_r($ejey) ?>;

        ejex[0] = ejex[0].slice(0,ejex[0].length-1);
        ejey[0] = ejey[0].slice(0,ejey[0].length-1);

        var  myDate = new Array();

        for(int = 0;i<ejex[0].length;i++){
            myDate.push(new Date(ejex[0][i].replace(" ","T")));
        }

        var fecha = false;


        if (ejex[0][0].includes("-") && ejex[0][0].includes(":")) {
            fecha = true;
            nminX = myDate[0];
            nmaxX = myDate[myDate.length-1];

        }

        var minY = Math.min.apply(null,ejey[0]);
        var maxY = Math.max.apply(null,ejey[ejey.length-1]);


           if(fecha){
               for(i = 0; i<{{$numX}}-1;i++){

                var aux = [myDate[i].getTime(),ejey[0][i]];
                d1.push(aux);
           }
           }else{

               for(i = 0; i<{{$numX}}-1;i++){

                   var aux = [ejex[0][i],ejey[0][i]];

                   d1.push(aux);}

           }

            if(!fecha){
            var  options= {series:{
                lines: {show: bLines, fill: bFill,fillColor:cL},
                points: {show: bPoints, fill: bFill,fillColor:cP},
                bars: {show: bBars, fill: bFill,fillColor:cB}},
                xaxis:{
                    showTicks: true,
                    gridLines: true,
                    autoScale: "none",
                    ticks: ticksX,
                    min: ejex[0][0],
                    max: ejex[0][ejex[0].length-1],
                    tickDecimals: ticksXD,
                },
                yaxis: {
                    autoScale: "none",
                    ticks: ticksY,
                    min: nminY,
                    max: nmaxY,
                    tickDecimals: ticksYD
                }
            };}else{

                var dayOfWeek = ["Dom", "Lun", "Mar", "Mier", "Jue", "Vier", "Sab"];

                var  options= {series:{
                        lines: {show: bLines, fill: bFill,fillColor:cL},
                        points: {show: bPoints, fill: bFill,fillColor:cP},
                        bars: {show: bBars, fill: bFill,fillColor:cB}},
                    xaxis:{
                        showTicks: true,
                        gridLines: true,
                        autoScale: "none",
                        ticks: ticksX,
                        min: (new Date(myDate[0])).getTime(),
                        max: (new Date(myDate[myDate.length-1])).getTime(),
                        tickDecimals: ticksXD,
                        mode: "time"
                        //tickFormatter: <- AQUI SE LE DA FORMATO A LAS FECHAS
                    },
                    yaxis: {
                        autoScale: "none",
                        ticks: ticksY,
                        min: nminY,
                        max: nmaxY,
                        //tickDecimals: ticksYD
                    }
                };
            }

            var data=[{label:"Grafica de la consulta",data:d1,color: cLL}];

            $.plot("#grafica1",data, options);



    }
    $( document ).ready(function() {
        window.onload = carga();
    });
</script>