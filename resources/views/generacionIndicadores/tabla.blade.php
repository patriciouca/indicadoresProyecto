<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script
                src="https://code.jquery.com/jquery-3.4.0.min.js"
                integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg="
                crossorigin="anonymous"></script>
        <script
                src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"
                integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="
                crossorigin="anonymous"></script>

        <title>Generador de Indicadores Automáticos</title>
        <link rel="shortcut icon" href={{URL::asset('img/logo1.ico')}}/>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/base/jquery-ui.css" type="text/css" media="all" />

        <link rel="stylesheet" href="{{ URL::asset('css/estiloprincipal.css') }}?{{date('l jS \of F Y h:i:s A')}}" type="text/css" media="all" />


        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" type="text/css" media="all" />

        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.0.3/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.0.3/js/buttons.print.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.0.3/js/buttons.flash.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
        <script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://code.highcharts.com/highcharts.js"></script>

        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/base/jquery-ui.css" type="text/css" media="all" />

        <link rel="stylesheet" href="{{ URL::asset('css/estiloprincipal.css') }}?{{date('l jS \of F Y h:i:s A')}}" type="text/css" media="all" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/b-1.5.6/datatables.min.css"/>

        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" type="text/css" media="all" />

        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">

        <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.0.3/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.0.3/js/buttons.print.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.0.3/js/buttons.flash.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
        <script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://code.highcharts.com/highcharts.js"></script>


        <script>
            $(document).ready(function() {
                var table = $('#tabla1').DataTable( {
                    dom: 'lftBipr',

                        buttons: [
                            {
                                text: 'Generar gráfica',
                                action: function(){document.myform.submit();}
                            }
                        ]
                    } );
            });
        </script>
        <script>
            var numero=1;
            function funcion(tam) {
                switch(numero) {
                    case 1:$('#ejex').val($('#ejex').val() + tam+",");
                        numero = 2;
                        break;
                    case 2:
                        $('#ejey').val($('#ejey').val() + tam+",");
                        numero = 1;
                        break;
                }
            }
        </script>
    </head>
    <body>

        <div class="flex-center position-ref full-height">
            <div class="contenidotablas">
                <form name = "myform" method="POST" style="display: inline" action="{{ url("/generacionGrafica")}}">
                    {{csrf_field()}}
                    <div class="botones">
                    <input id="consulta" type="text" value="{{$consulta}}" disabled>
                    <input hidden id="ejex" name="ejex" type="text">
                    <input hidden id="ejey" name = "ejey" type="text">></div>
                </form>
                <div class="botones"></div>

                <table id="tabla1" class="table-striped  table-hover table">
                    <thead>
                        <tr>
                            @foreach($tablas[0] as $key=>$tam)
                                <th>{{$key}}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($tablas as $key=>$tabla)
                            <tr>
                            @foreach($tabla as $tam)
                                    <td>{{$tam}}
                                        <script>
                                            funcion('{{$tam}}');
                                        </script></td>
                            @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            </div> </div>


     </body>
 </html>
