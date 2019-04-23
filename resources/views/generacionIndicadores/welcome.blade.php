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
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

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

            .title {
                font-size: 84px;
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
        <script>

            $(document).ready(function() {
                $( "#accordion" )
                    .accordion({
                        header: "> div > h3"
                    })
                    .sortable({
                        axis: "y",
                        handle: "h3",
                        stop: function( event, ui ) {
                            // IE doesn't register the blur when sorting
                            // so trigger focusout handlers to remove .ui-state-focus
                            ui.item.children( "h3" ).triggerHandler( "focusout" );

                            // Refresh accordion to handle new order
                            $( this ).accordion( "refresh" );
                        }
                    });

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
                });
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
