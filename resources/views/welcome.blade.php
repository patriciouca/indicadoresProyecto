<!DOCTYPE html>
<html>
    <head>
    
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        
        <title>Generador de Indicadores Automático</title>

        <link rel="shortcut icon" href={{ URL::asset('img/logo1.ico') }} />
        
		<link rel="stylesheet" href="{{ URL::asset('css/estiloprincipal2.css') }}?{{date('l jS \of F Y h:i:s A')}}" type="text/css" media="all" />
        
        
    </head>
    
    <body>
    	
    	<section id="page"> 
    <br><br>
            <header> 
            
                <hgroup>
                    <img src={{ URL::asset('img/Saica-svg.svg') }} alt="">
                </hgroup>
                                
            
            </header>
			
				
            <section id="articles"> 

                <div class="line"></div> <br>
				
				    <nav class="clear">
                    <ul>
                        <li><a href="{{ url("/generacionIndicador/")}}">Generar Indicadores</a></li>
                    </ul>
					</nav>
					<br><br><br><br>
				
				<div class="line"></div> 
                
                <article id="article1"> 
                    <h2>¿Cómo generar indicadores automáticamente?</h2>
                    
                    <div class="line"></div>
                    
                    <div class="articleBody clear">
                    
                    	<figure>
                            <img src={{ URL::asset('img/gif1.gif') }}  width="640" height="339" alt="">
                        </figure>

                        <p>Antes de comenzar deberá elegir sobre que base de datos, de las disponibles en su sistema, se generarán los indicadores </p>
                        <p>En primer lugar debe seleccionar la tabla en la que se encuentre el indicador que desea utilizar. Una vez pulse sobre la tabla se desplegarán los distintos campos que esta contiene, cada campo indica el tipo de dato que maneja, en este momento deberá arrastrar el indicador deseado al eje en el que desee colocarlo tal y como puede ver en la imagen de la derecha.</p>
                        <p>Recuerde que puede hacer operaciones matemáticas entre los distintos indicadores tan solo arastrandolas y si lo desea, borrar arrastrando el elemento "borrar". </p>
						<p>También es posible contar el número de elementos existentes para un indicador determinado, utilizando la operación "contar" sobre un elemento numérico. </p>
                        <p>Puede realizar busquedas de tablas por nombre utilizando el buscador situado en la parte superior izquierda y arrastrar estas mismas tablas en el eje vertical a su gusto.</p>
                        <p>NOTA: Recuerde cerrar el paréntesis de la operación "contar" cuando finalice esta y que los operadores de comparacion solo son válidos para los filtros.</p>
						<p>Para finalizar pulse sobre "Generar consulta" </p>
                    </div>
                </article>

                <div class="line"></div>
                
                <article id="article1"> 
                    <h2>¿Qué hacer con los indicadores?</h2>
                    
                    <div class="line"></div>
                    
                    <div class="articleBody clear">
                    
                    	<figure>
	                    	<img src={{ URL::asset('img/gif22.gif') }} width="640" height="339" />
                        </figure>
                       
						<p>Una vez se hayan generado los indicadores, aparecerán en una tabla. </p>
						<p>En la parte superior puede ver la consulta SQL que se ha utilizado para generarlos. </p>
						<p>Bajo esta puede ber dos grupos de botones, los 4 primeros son para exportar la tabla en distintos formatos como son copiada en el portapapeles, en formato Excel, en PDF y en imagen para imprimir, en orden de izquierda a derecha, y el último botón es el que generará una gráfica con estos indicadores.</p>
						<p>En cuanto a la tabla puede realizar acciones como ordenar las distintas filas o realizar una búsqueda entre estas utilizando el buscador situado en la parte superior derecha de la tabla. </p>
						<p>Si lo desea puede guardar la consulta tan solo añadiendo un título y pulsando sobre el botón "Guardar" situado en la parte inferior izquierda. </p>
						
                    </div>
                </article>

                <div class="line"></div>

                <article id="article1">
                    <h2>¿Cómo manejar la gráfica?</h2>

                    <div class="line"></div>

                    <div class="articleBody clear">

                        <figure>
                            <img src={{ URL::asset('img/gif3.gif') }} width="640" height="339" />
                        </figure>

                        <p>Una vez se genere la tabla puede realizar cámbios de estilo sobre ella, por defecto aparecerá representada con lineas, puntos, barras y relleno. </p>
                        <br>
                        <p>Estas cuatro modalidades de representación de la gráfica son las que puede utilizar y combinar a su gusto tan solo haciando clic sobre el recuadro correspondiente. </p>
                        <br>
                        <p>También puede variar a su gusto el color de cada uno de estos cuatro elementos, pulsando sobre el rectángulo de color correspondiente.</p>
                        <br>
                        <p>Por último tiene la opción de exportar la gráfica en formato PNG pulsando sobre el botón que se encuentra en la parte superior central de la pantalla, sobre la gráfica. </p>
                    </div>
                </article>


            </section>

        <footer>

           <div class="line"></div>

           <a href="https://saicasl.eu/" ><img src={{ URL::asset('img/Saica-svgl.svg') }}></a>
           

        </footer>
            
		</section> 
        
    </body>
</html>
