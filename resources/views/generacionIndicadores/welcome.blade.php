<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script language="javascript" type="text/javascript" src="http://localhost/indicadoresProyecto/resources/js/graficas/jquery.js"></script>

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/base/jquery-ui.css" type="text/css" media="all" />
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">

        <script>

            $(document).ready(function() {
                $( "#accordion" ).accordion({
                    collapsible: true
                });

            });

        </script>
    </head>
    <body>
        <div class="flex-center position-ref full-height">


            <div class="content">
                <div id="accordion">
                @foreach($tablas as $tabla)

                        <h3>
                            {{$tabla[0]}}
                        </h3>
                        <div>
                            <ul>
                            @foreach($tabla[1] as $campo)
                                <li>
                                {{$campo->Field}}
                                </li>
                            @endforeach
                            </ul>
                        </div>
                @endforeach
                </div>
            </div>
        </div>
    </body>
</html>
