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

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/base/jquery-ui.css" type="text/css" media="all" />

        <link rel="stylesheet" href="{{ URL::asset('css/estiloprincipal.css') }}?{{date('l jS \of F Y h:i:s A')}}" type="text/css" media="all" />

        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" type="text/css" media="all" />

    </head>
    <body>

        <div class="flex-center position-ref full-height">
            <div class="contenidotablas">
                <table id="tabla1" class="table-striped  table-hover table">
                    <thead>
                        <tr>
                            <th id="campox">{{ array_keys(get_object_vars($tablas[0]))[0]}}</th>
                            <th id="campoy">{{ array_keys(get_object_vars($tablas[0]))[1]}}</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($tablas as $key=>$tabla)
                            <tr>
                            @foreach($tabla as $tam)
                                    <td>{{$tam}}</td>
                            @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!--
                <table id="tabla2">
                    <thead>
                    <tr>
                        <th>Campo Y</th>
                        <th>Valor</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                -->
            </div> </div>


     </body>
 </html>
