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

        <link rel="stylesheet" href="{{ URL::asset('css/estiloprincipal2.css') }}?{{date('l jS \of F Y h:i:s A')}}" type="text/css" media="all" />


    </head>
    <body>
    <section id="page">
        <br>
        <header>

            <hgroup>
                <img src={{ URL::asset('img/Saica-svg.svg') }} alt="">
            </hgroup>


        </header>


        <section id="articles">

            <div class="line"></div> <br>

            <h2>Elija la base de datos sobre la que realizar la consula</h2>

            <br><br>

                <form method="post" action="{{ url("/generacionIndicador/setBd")}}">
                    @csrf

                    <select name="datos" id="select">
                        @foreach($bases as $base)
                            <option value={{$base->Database}}>{{$base->Database}}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">Generar Consulta</button>
                </form>

            <br>

            <div class="line"></div>


            <br><br>
        </section>

        <footer>


            <a href="https://saicasl.eu/" ><img src={{ URL::asset('img/Saica-svgl.svg') }}></a>


        </footer>

    </section>

    </body>
 </html>

