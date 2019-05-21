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
        var grafo=<?php print_r($grafo);?>;
        var metido1=[];
        var metido2=[];
        var elemento1=true,elemento2=true;
        var incontar1=false,incontar2=false;
        var inparentesis1=false,inparentesis2=false;
        var borrar1=false,borrar2=false;
        var dropfuncion=function( event, ui ) {
            var arrastrado=$(ui.draggable);
            if(arrastrado.hasClass("draggable")){
                if($( this ).is("#droppable1"))
                {
                    var predicado1=true;
                    var hemetido1=$(ui.draggable)[0].innerHTML;
                    var textoOperacion1=$(ui.draggable)[0].innerHTML;
                    var esElemento1=false;
                    console.log("hemetido "+hemetido1);
                    var clase1=$(ui.draggable)[0].className;
                    if(clase1.indexOf("draggable1")!=-1)
                        esElemento1=true;
                    if(esElemento1)
                        hemetido1=$(hemetido1)[0].innerHTML;
                    hemetido1=hemetido1.trim();
                    if(hemetido1=="contar")
                        hemetido1+="(";
                    if(hemetido1 == "contar(" && !incontar1)
                    {
                        if(elemento1|| $( this ).html()=="Eje X")
                        {
                            predicado1=true;
                            elemento1=true;
                        }
                    }
                    else if(textoOperacion1=="("){
                        if(elemento1 && !inparentesis1)
                        {
                            inparentesis1=true;
                            predicado1=true;
                        }
                        else{
                            alert("Ahí no puede ir un parentesis en el eje X");
                            predicado1=false;
                        }
                    }
                    else if(textoOperacion1==")"){

                        if(inparentesis1 && !elemento1)
                        {
                            predicado1=true;
                            elemento1=false;
                            inparentesis1=false;
                        }
                        else{
                            alert("Respeta la norma de los parentesis en el eje X");
                            predicado1=false;
                        }

                    }
                    else{
                        if(esElemento1 && elemento1){
                            predicado1=true;
                            elemento1=false;
                            var tabla=$($($($(ui.draggable).get(0).closest('div').parentNode).get(0)).find($('h3')).get(0)).text();
                            tabla=tabla.trim();
                            console.log("esElemento")
                        }
                        else if(!esElemento1 && !elemento1 && !incontar1){
                            predicado1=true;
                            elemento1=true;
                            if(textoOperacion1==")"){
                                console.log("a");
                            }
                        }
                        else if(hemetido1!="borrar"){
                            predicado1=false;
                            if(elemento1)
                                alert("Recuerda que hay que poner un elemento en el contenedor X");
                            else
                                alert("Recuerda que hay que poner una operacion en el contenedor X");
                        }
                        if(hemetido1=="borrar") {
                            borrar1=true;
                            var borrado1=metido1[metido1.length-1];
                            if(borrado1.length == 1 || borrado1 == "cont("){
                                elemento1=false;
                            }else{
                                elemento1=true;
                            }
                            metido1.pop();
                        }
                    }
                    if(predicado1 && hemetido1!="borrar")
                    {
                        if(!elemento1)
                        {
                            var i = accesibles1.indexOf(tabla);
                            if(hemetido1!="(" && hemetido1!=")") {
                                if(i>=0)
                                {
                                    metido1.push(tabla+"."+hemetido1);
                                    poner(1,tabla);
                                }
                                else{
                                    alert("No se puede llegar a la tabla "+tabla+" con lo introducido en el cajetin x");
                                    predicado1=false;
                                }
                            }

                        }
                        else{
                            metido1.push(hemetido1);
                        }
                        if(incontar1)
                        {
                            incontar1=false;
                            metido1.push(")");
                            hemetido1+=")";
                        }
                        if(hemetido1 == "contar(" && predicado1)
                        {
                            incontar1=true;
                        }
                        if(textoOperacion1=="("){
                            inparentesis1=true;
                            predicado1=true;
                        }
                    }
                }
                else{
                    var predicado2=true;
                    var hemetido2=$(ui.draggable)[0].innerHTML;
                    var textoOperacion2=$(ui.draggable)[0].innerHTML;
                    var esElemento2=false;
                    var clase2=$(ui.draggable)[0].className;
                    if(clase2.indexOf("draggable1")!=-1)
                        esElemento2=true;
                    if(esElemento2)
                        hemetido2=$(hemetido2)[0].innerHTML;
                    console.log(hemetido2);
                    hemetido2=hemetido2.trim();
                    if(hemetido2 == "contar" && !incontar2)
                    {
                        if(elemento2 || $( this ).html()=="Eje Y")
                        {
                            hemetido2="contar(";
                            predicado2=true;
                            elemento2=true;
                        }
                    }
                    else if(textoOperacion2=="("){
                        if(elemento2 && !inparentesis2)
                        {
                            inparentesis2=true;
                            predicado2=true;
                        }
                        else{
                            alert("Ahí no puede ir un parentesis en el eje Y");
                            predicado2=false;
                        }
                    }
                    else if(textoOperacion2==")"){

                        if(inparentesis2 && !elemento2)
                        {
                            console.log("Depurar "+predicado2);
                            predicado2=true;
                            elemento2=false;
                            inparentesis2=false;
                        }
                        else{
                            alert("Respeta la norma de los parentesis en el eje Y");
                            predicado2=false;
                        }

                    }
                    else{
                        if(esElemento2 && elemento2){
                            predicado2=true;
                            elemento2=false;
                            var tabla=$($($($(ui.draggable).get(0).closest('div').parentNode).get(0)).find($('h3')).get(0)).text();
                            tabla=tabla.trim();
                        }
                        else if(!esElemento2 && !elemento2 && !incontar2){
                            predicado2=true;
                            elemento2=true;
                        }
                        else if(hemetido2!="borrar"){
                            predicado2=false;
                            if(elemento2)
                                alert("Recuerda que hay que poner un elemento en el contenedor Y");
                            else
                                alert("Recuerda que hay que poner una operacion en el contenedor Y");
                        }
                        if(hemetido2=="borrar") {
                            borrar2=true;
                            var borrado2=metido2[metido2.length-1];
                            if(borrado2.length == 1 || borrado2 == "cont("){
                                elemento2=false;
                            }else{
                                elemento2=true;
                            }
                            metido2.pop();
                        }
                    }
                    if(predicado2  && hemetido2!="borrar")
                    {
                        if(!elemento2) {

                            if(hemetido2!="(" && hemetido2!=")")
                            {
                                var i = accesibles2.indexOf(tabla);

                                if(i>=0)
                                {
                                    metido2.push(tabla+"."+hemetido2);
                                    poner(2,tabla);
                                }
                                else{
                                    alert("No se puede llegar a la tabla "+tabla+" con lo introducido en el cajetin y");
                                    predicado2=false;
                                }
                            }

                        }
                        else
                            metido2.push(hemetido2);
                        if(incontar2)
                        {
                            incontar2=false;
                            metido2.push(")");
                            hemetido2+=")";
                        }
                        if(hemetido2 == "contar(" && predicado2)
                        {
                            incontar2=true;
                        }
                        if(textoOperacion2=="("){
                            inparentesis2=true;
                            predicado2=true;
                        }
                    }
                }

                if(predicado1 && hemetido1!="borrar")
                {
                    if($( this ).html()=="Eje X" || $( this ).html()=="Eje Y")
                        $( this ).html(hemetido1);
                    else
                        $( this ).append(hemetido1);
                }
                if(predicado2 && hemetido2!="borrar")
                {
                    if($( this ).html()=="Eje X" || $( this ).html()=="Eje Y")
                        $( this ).html(hemetido2);
                    else
                        $( this ).append(hemetido2);
                }
                if(hemetido1=="borrar")
                {
                    if(borrar1) {
                        borrar1=false;
                        hemetido1 = $(this).html();
                        if(borrado1.indexOf(".") != -1){ //contiene '.'
                            borrado1=borrado1.split('.');
                            devolver(1,borrado1[0]);
                            $(this).empty();
                            $(this).append(hemetido1.substring(0,hemetido1.length-borrado1[1].length));
                        }else {
                            $(this).empty();
                            $(this).append(hemetido1.substring(0, hemetido1.length - borrado1.length));
                        }
                        if( $(this).html()==""){
                            $(this).append("Eje X");
                        }
                    }
                }
                if(hemetido2=="borrar"){
                    if(borrar2){
                        borrar2=false;
                        hemetido2 = $(this).html();
                        if(borrado2.indexOf(".") != -1){ //contiene '.'
                            borrado2=borrado2.split('.');
                            devolver(2,borrado2[0]);
                            $(this).empty();
                            $(this).append(hemetido2.substring(0,hemetido2.length-borrado2[1].length));
                        }else {
                            $(this).empty();
                            $(this).append(hemetido2.substring(0, hemetido2.length - borrado2.length));
                        }
                        if( $(this).html()==""){
                            $(this).append("Eje Y");
                        }
                    }
                }

                $("#campos1").val(metido1);
                $("#campos2").val(metido2);
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
            $('#campox').text(Object.keys(data[0])[0]);
            $('#campoy').text(Object.keys(data[0])[1]);
            data.forEach(function(element) {
                contenido+="<tr>";
                contenido+="<td>"+element[Object.keys(element)[0]]+"</td>";
                contenido+="<td>"+element[Object.keys(element)[1]]+"</td>";
                contenido+="</tr>";
            });
            if(tabla==1)
            {
                $('#tabla1').DataTable();
            }
            else{
                $('#tabla2').DataTable();
            }
        }
        function revisar(){
            var ac=$("#accordion").children();
            $.each(ac, function(index, value) {
                var texto=$(value).find("h3")[0];
                var textoplano=$(texto).text().trim();
                var i = accesibles.indexOf(textoplano);
                if(i==-1)
                {
                    $(texto).hide();
                }
                else{
                    $(texto).show();
                }
            });
        }
        function devolver(cual,pongo) {
            var fila=grafo[pongo];
            if(cual==1) {
                $.each(fila, function(index, value) {
                    if(value=="")
                    {
                        var i = accesibles1.indexOf(index);
                        console.log(value+" "+i);
                        if (i == -1) {
                            accesibles1.push(index);
                            var o = accesibles.indexOf(index);
                            if (o == -1) {
                                accesibles.push(index);
                            }
                        }
                    }
                });
            }
            else
            {
                $.each(fila, function(index, value) {
                    $.each(fila, function(index, value) {
                        if(value=="")
                        {
                            var i = accesibles2.indexOf(index);
                            console.log(value+" "+i);
                            if (i == -1) {
                                accesibles2.push(index);
                                var o = accesibles.indexOf(index);
                                if (o == -1) {
                                    accesibles.push(index);
                                }
                            }
                        }
                    });
                });
            }
            imprimirAce();
            revisar();
        }
        function poner(cual,pongo) {
            var fila=grafo[pongo];
            if(cual==1) {
                $.each(fila, function(index, value) {
                    if(value=="")
                        quitar(1,index);
                });
            }
            else
            {
                $.each(fila, function(index, value) {
                    if(value=="")
                        quitar(2,index);
                });
            }
        }
        function quitar(cual,quito){
            if(cual==1) {
                var index = accesibles1.indexOf(quito);
                if (index > -1) {
                    accesibles1.splice(index,1);
                }
            }
            else
            {
                var index = accesibles2.indexOf(quito);
                if (index > -1) {
                    accesibles2.splice(index,1);
                }
            }
            if(accesibles2.indexOf(quito)==-1 || accesibles1.indexOf(quito)==-1)
            {
                var index = accesibles.indexOf(quito);
                if (index > -1) {
                    accesibles.splice(index,1);
                }
            }
            imprimirAce();
            revisar();
        }
        function imprimirAce(){
            console.log("TOTAL "+accesibles);
            console.log("1 "+accesibles1);
            console.log("2 "+accesibles2);
        }
        function inicializarGrafo() {
            var fila=grafo[Object.keys(grafo)[0]];
            $.each(fila, function(index, value) {
                accesibles.push(index);
            });
            accesibles1=accesibles.slice(0);
            accesibles2=accesibles.slice(0);
        }
        var accesibles=[];
        var accesibles1=[];
        var accesibles2=[];
        $(document).ready(function() {
            inicializarGrafo();
            $('#formulario').submit(function (evt) {
                evt.preventDefault();
                if(metido1.length==0 && metido2.length==0)
                    alert("El eje X e Y está vacio");
                else{
                    if(metido1.length==0)
                        alert("El eje X está vacio");
                    if(metido2.length==0)
                        alert("El eje y está vacio");
                }
                if(elemento1 && elemento2)
                    alert("El eje X e Y deben acabar en un elemento");
                else{
                    if(elemento1)
                        alert("El eje X deben acabar en un elemento");
                    if(elemento2)
                        alert("El eje Y deben acabar en un elemento");
                }
                if(metido1.length>0 && metido2.length>0 && !elemento1 && !elemento2)
                    $(this)[0].submit();
            });

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
                                @if(strpos($campo->Type, 'tinyint(1)') !== false)
                                    <li class="draggable badge badge-secondary draggable1 bool">
                                @elseif(strpos($campo->Type, 'int') !== false)
                                    <li class="draggable badge badge-secondary draggable1 numero">
                                @elseif(strpos($campo->Type, 'timestamp') !== false)
                                    <li class="draggable badge badge-secondary draggable1 fecha">
                                @elseif(strpos($campo->Type, 'enum') !== false)
                                    <li class="draggable badge badge-secondary draggable1 enum">
                                @else
                                    <li class="draggable badge badge-secondary draggable1 texto">
                                        @endif
                                        <h3>{{$campo->Field}}</h3>
                                        <h5>{{$campo->Type}}</h5>
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
                    <li class="btn btn-primary operacion draggable draggable2">borrar</li>
                </ul>
            </div>


            <p id="droppable1">Eje X</p>
            <p id="droppable2">Eje Y</p>

            <div class="botones">
                <form id="formulario" method="post" style="display: inline" action="{{ url("/generacionIndicador/getConsulta2")}}">
                    @csrf
                    <button type="submit" id="generar" class="btn btn-success">Generar consulta</button>
                    <input hidden id="campos1" type="text" name="campos" class="">
                    <input hidden id="campos2" type="text" name="campos2">
                </form>
                <button hidden type="button" class="btn btn-primary">Guardar</button>

            </div>

        </div>
    </div>
</div>
</body>
</html>