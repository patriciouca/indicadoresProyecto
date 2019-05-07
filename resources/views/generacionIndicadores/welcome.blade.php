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


        <style>
            /*
Theme Name: jqueryui-com
Template: jquery
*/

            a,
            .title {
                color: #b24926;
            }

            #content a:hover {
                color: #333;
            }

            #banner-secondary p.intro {
                padding: 0;
                float: left;
                width: 50%;
            }

            #banner-secondary .download-box {
                border: 1px solid #aaa;
                background: #333;
                background: -webkit-linear-gradient(left, #333 0%, #444 100%);
                background: linear-gradient(to right, #333 0%, #444 100%);
                float: right;
                width: 40%;
                text-align: center;
                font-size: 20px;
                padding: 10px;
                border-radius: 5px;
                box-shadow: 0 0 8px rgba(0, 0, 0, 0.8);
            }

            #banner-secondary .download-box h2 {
                color: #71d1ff;
                font-size: 26px;
            }

            #banner-secondary .download-box .button {
                float: none;
                display: block;
                margin-top: 15px;
            }

            #banner-secondary .download-box p {
                margin: 15px 0 5px;
            }

            #banner-secondary .download-option {
                width: 45%;
                float: left;
                font-size: 16px;
            }

            #banner-secondary .download-legacy {
                float: right;
            }

            #banner-secondary .download-option span {
                display: block;
                font-size: 14px;
                color: #71d1ff;
            }

            #content .dev-links {
                float: right;
                width: 30%;
                margin: -15px -25px .5em 1em;
                padding: 1em;
                border: 1px solid #666;
                border-width: 0 0 1px 1px;
                border-radius: 0 0 0 5px;
                box-shadow: -2px 2px 10px -2px #666;
            }

            #content .dev-links ul {
                margin: 0;
            }

            #content .dev-links li {
                padding: 0;
                margin: .25em 0 .25em 1em;
                background-image: none;
            }

            .demo-list {
                float: right;
                width: 25%;
            }

            .demo-list h2 {
                font-weight: normal;
                margin-bottom: 0;
            }

            #content .demo-list ul {
                width: 100%;
                border-top: 1px solid #ccc;
                margin: 0;
            }

            #content .demo-list li {
                border-bottom: 1px solid #ccc;
                margin: 0;
                padding: 0;
                background: #eee;
            }

            #content .demo-list .active {
                background: #fff;
            }

            #content .demo-list a {
                text-decoration: none;
                display: block;
                font-weight: bold;
                font-size: 13px;
                color: #3f3f3f;
                text-shadow: 1px 1px #fff;
                padding: 2% 4%;
            }

            .demo-frame {
                width: 70%;
                height: 420px;
            }

            .view-source a {
                cursor: pointer;
            }

            .view-source > div {
                overflow: hidden;
                display: none;
            }

            @media all and (max-width: 600px) {
                #banner-secondary p.intro,
                #banner-secondary .download-box {
                    float: none;
                    width: auto;
                }

                #banner-secondary .download-box {
                    overflow: auto;
                }
            }

            @media only screen and (max-width: 480px) {
                #content .dev-links {
                    width: 55%;
                    margin: -15px -29px .5em 1em;
                    overflow: hidden;
                }
            }

        </style>

        <script>

            var metido1=[];
            var metido2=[];
            var elemento1=true,elemento2=true;
            var incontar1=false,incontar2=false;

            var dropfuncion=function( event, ui ) {
                var hemetido=$(ui.draggable)[0].innerHTML;
                hemetido=hemetido.trim();
                var esElemento=false;

                //hasClass("draggable1")
                var clase=$(ui.draggable)[0].className;
                if(clase.indexOf("draggable1")!=-1)
                    esElemento=true;

                var predicado;
                var textoOperacion=$(ui.draggable)[0].innerHTML;

                if(hemetido=="contar")
                    hemetido+="(";

                if($( this ).is("#droppable1"))
                {
                    if(textoOperacion == "contar(" && !incontar1)
                    {
                        if(elemento1==false || $( this ).html()=="Drop here")
                        {
                            predicado=true;
                            elemento1=true;
                        }
                    }
                    else if(textoOperacion==")"){
                        predicado=true;
                        elemento1=true;
                    }
                    else{
                        if(esElemento && elemento1){
                            predicado=true;
                            elemento1=false;
                        }
                        else if(!esElemento && !elemento1 && !incontar1){
                            predicado=true;
                            elemento1=true;
                        }
                        else{
                            predicado=false;
                        }
                    }

                    if(predicado)
                    {
                        metido1.push(hemetido);
                        if(incontar1)
                        {
                            incontar1=false;
                            metido1.push(")");
                            hemetido+=")";
                        }
                        if(textoOperacion == "contar(" && predicado)
                        {
                            incontar1=true;
                        }
                    }
                }
                else{

                    if(textoOperacion == "contar(" && !incontar2)
                    {
                        if(elemento2==false || $( this ).html()=="Drop here")
                        {
                            predicado=true;
                            elemento2=true;
                        }

                    }
                    else if(textoOperacion==")"){
                        predicado=true;
                        elemento2=true;
                    }
                    else{
                        if(esElemento && elemento2){
                            predicado=true;
                            elemento2=false;
                        }
                        else if(!esElemento && !elemento2 && !incontar2){
                            predicado=true;
                            elemento2=true;
                        }
                        else{
                            predicado=false;
                        }
                    }

                    if(predicado)
                    {
                        metido2.push(hemetido);
                        if(incontar2)
                        {
                            incontar2=false;
                            metido2.push(")");
                        }
                        hemetido+=")";

                        if(textoOperacion == "contar(" && predicado)
                        {
                            incontar2=true;
                        }

                    }


                }



                console.log(metido1);
                console.log(metido2);


                if(predicado)
                {
                    if($( this ).html()=="Drop here")
                        $( this ).html(hemetido);
                    else
                        $( this ).append(hemetido);
                }


            };


            var dragablefuncionHelper=function(){
                $copy = $(this).clone();
                return $copy;};



            $(document).ready(function() {

                $( "#accordion" ).accordion({
                    header: "> div > h3",
                    collapsible: true,
                    active : 'none'
                }).sortable({
                    items: '.group'
                });

                $( ".draggable" ).draggable({
                    revert: "true" ,
                    helper: dragablefuncionHelper,
                    appendTo: 'body',
                    scroll: false
                });
                $( "#droppable1" ).droppable({
                    drop: dropfuncion
                });

                $( "#droppable2" ).droppable({
                    drop: dropfuncion
                });
            } );

        </script>
    </head>
    <body>
        <div class="flex-center position-ref full-height">


            <div class="content">
                <div id="accordion" class="contenedor">
                @foreach($tablas as $tabla)
                        <div class="group">
                            <h3>
                                {{$tabla[0]}}
                            </h3>
                            <div>
                                <ul>
                                @foreach($tabla[1] as $campo)
                                    <li class="draggable badge badge-secondary draggable1">
                                    {{$campo->Field}}
                                    </li>
                                @endforeach
                                </ul>
                            </div>
                        </div>

                @endforeach
                </div>
                <div class="contenedor">
                    <div class="operaciones">
                        <ul >
                            <li class="btn btn-primary operacion draggable draggable2">+</li>
                            <li class="btn btn-primary operacion draggable draggable2">-</li>
                            <li class="btn btn-primary operacion draggable draggable2">*</li>
                            <li class="btn btn-primary operacion draggable draggable2">/</li>
                            <li class="btn btn-primary operacion draggable draggable2">contar</li>
                            <li class="btn btn-primary operacion draggable draggable2">)</li>
                        </ul>
                    </div>


                    <p id="droppable1">Drop here</p>
                    <p id="droppable2">Drop here</p>

                    <div class="botones">

                        <button type="button" class="btn btn-success">Generar consulta</button>
                        <button type="button" class="btn btn-primary">Guardar</button>
                    </div>

                </div>
            </div>
        </div>
    </body>
</html>
