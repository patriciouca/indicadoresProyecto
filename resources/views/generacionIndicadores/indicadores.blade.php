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

    <title>Generador de Indicadores Automático</title>

    <link rel="shortcut icon" href={{ URL::asset('img/logo1.ico') }} />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/base/jquery-ui.css" type="text/css" media="all" />

    <link rel="stylesheet" href="{{ URL::asset('css/estiloprincipal.css') }}?{{date('l jS \of F Y h:i:s A')}}" type="text/css" media="all" />

    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" type="text/css" media="all" />


    <script>
        $(document).ready(function() {
            var table = $('#tabla1').DataTable();

        });
    </script>


</head>
<body>

<div class="flex-center position-ref full-height">
    <div class="contenidotablas">



        <table id="tabla1" class="table-striped  table-hover table">

            <thead>
            <tr>
                <td>Nombre</td>
                <td>Consulta</td>
            </tr>
            </thead>
            <tbody>

            @foreach($indicadores as $key=>$tabla)
                <tr>
                    <?php
                    $arraynuevo=explode( ':', $tabla[0] );
                    ?>
                        @foreach($arraynuevo as $key=>$a)
                            <td>{{$a}}</td>
                        @endforeach


                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</div>

</div>


</body>
</html>