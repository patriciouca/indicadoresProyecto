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


        <script>

            var metido1=[];
            var metido2=[];
            var elemento1=true,elemento2=true;
            var incontar1=false,incontar2=false;
            var inparentesis1=false,inparentesis2=false;

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
                    if(hemetido == "contar(" && !incontar1)
                    {
                        if(elemento1|| $( this ).html()=="Drop here")
                        {
                            predicado=true;
                            elemento1=true;
                        }
                    }
                    else if(textoOperacion=="("){
                        inparentesis1=true;
                        predicado=true;
                    }
                    else{
                        if(esElemento && elemento1){
                            predicado=true;
                            elemento1=false;
                            var tabla=$($($($(ui.draggable).get(0).closest('div').parentNode).get(0)).find($('h3')).get(0)).text();
                            tabla=tabla.trim();

                        }
                        else if(!esElemento && !elemento1 && !incontar1){
                            predicado=true;
                            elemento1=true;
                            if(textoOperacion==")"){
                                console.log("a");
                            }
                        }
                        else{
                            predicado=false;
                        }
                    }

                    if(predicado)
                    {
                        if(!elemento1)
                            metido1.push(tabla+"."+hemetido);
                        else
                            metido1.push(hemetido);

                        if(incontar1)
                        {
                            incontar1=false;
                            metido1.push(")");
                            hemetido+=")";
                        }
                        if(hemetido == "contar(" && predicado)
                        {
                            incontar1=true;
                        }
                        if(textoOperacion=="("){
                            inparentesis1=true;
                            predicado=true;
                        }
                    }
                }
                else{

                    if(hemetido == "contar(" && !incontar2)
                    {
                        if(elemento2 || $( this ).html()=="Drop here")
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
                            var tabla=$($($($(ui.draggable).get(0).closest('div').parentNode).get(0)).find($('h3')).get(0)).text();
                            tabla=tabla.trim();
                        }
                        else if(!esElemento && !elemento2 && !incontar2){
                            predicado=true;
                            elemento2=true;
                            if(textoOperacion==")"){
                                console.log("a");
                            }
                        }
                        else{
                            predicado=false;
                        }
                    }

                    if(predicado)
                    {
                        if(!elemento2)
                            metido2.push(tabla+"."+hemetido);
                        else
                            metido2.push(hemetido);

                        if(incontar2)
                        {
                            incontar2=false;
                            metido2.push(")");
                            hemetido+=")";
                        }


                        if(hemetido == "contar(" && predicado)
                        {
                            incontar2=true;
                        }
                        if(textoOperacion=="("){
                            inparentesis2=true;
                            predicado=true;
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


            function crearTabla(data,tabla){
                $('.content').html("");
                $('.contenidotablas').show();

                if(tabla==1)
                {
                    var body=$('#tabla1').find('tbody').get(0);
                }
                else{
                    var body=$('#tabla2').find('tbody').get(0);
                }

                var contenido="";
                data.forEach(function(element) {
                    contenido+="<tr>";
                    contenido+="<td>"+Object.keys(element)[0]+"</td>";
                    contenido+="<td>"+element[Object.keys(element)[0]]+"</td>";
                    contenido+="</tr>";
                });


                $(body).html(contenido);

                if(tabla==1)
                {
                    $('#tabla1').DataTable();
                }
                else{
                    $('#tabla2').DataTable();
                }


            }

            $(document).ready(function() {

                $( ".contenidotablas" ).hide();

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

                $('#generar').click(function() {
                    $.post("{{URL::to('/generacionIndicador/getConsulta')}}",{'_token': "{{ Session::token() }}",'campos':metido1}, function( data ) {
                        //console.log(metido1);
                        console.log(data);
                        $.post("{{URL::to('/generacionIndicador/evaluarConsulta')}}",{'_token': "{{ Session::token() }}",'consulta':data}, function( data2 ) {
                            console.log(data2);
                            crearTabla(data2,1);
                        });

                    });

                    $.post("{{URL::to('/generacionIndicador/getConsulta')}}",{'_token': "{{ Session::token() }}",'campos':metido2}, function( data ) {
                        //console.log(metido1);
                        console.log(data);
                        $.post("{{URL::to('/generacionIndicador/evaluarConsulta')}}",{'_token': "{{ Session::token() }}",'consulta':data}, function( data2 ) {
                            console.log(data2);
                            crearTabla(data2,2);
                        });

                    });

                });

            } );

        </script>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="contenidotablas">
                <table id="tabla1">
                    <thead>
                        <tr>
                            <th>Campo X</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
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
            </div>

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
                            <li class="btn btn-primary operacion draggable draggable2">(</li>
                            <li class="btn btn-primary operacion draggable draggable2">)</li>
                        </ul>
                    </div>


                    <p id="droppable1">Drop here</p>
                    <p id="droppable2">Drop here</p>

                    <div class="botones">

                        <button type="button" id="generar" class="btn btn-success">Generar consulta</button>
                        <button type="button" class="btn btn-primary">Guardar</button>
                    </div>

                </div>
            </div>
        </div>
    </body>
</html>
