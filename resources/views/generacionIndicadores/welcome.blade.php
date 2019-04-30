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

        <script>

            $(document).ready(function() {
                $( "#accordion" ).accordion({
                    collapsible: true
                });

                /*
                var url="{{Request::url()}}";
                $( "div.tabla" ).click(function(event) {
                    texto=$($(event.target).find("h3").context).text();
                    $.get( url+"/getCampos/"+texto, function( data ) {

                        var cadena="<div><ul>";
                        data.forEach(function(element) {
                            cadena+="<li>";
                            cadena+=element['Field'];
                            cadena+="</li>";
                        });
                        cadena+="</ul></div>";
                        $(event.target).append(cadena)
                    });
                });*/
            });

        </script>
    </head>
    <body>
        <div class="flex-center position-ref full-height">


            <div class="content">
                <div id="accordion">
                @foreach($tablas as $tabla)
                    <div class="tabla group">
                        <h3>
                            {{head($tabla)}}
                        </h3>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </body>
</html>
