<!DOCTYPE html>
<html>
    <head>
    
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        
        <title>Generador de Indicadores Automático</title>
        
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
                            <img src={{ URL::asset('img/ejemplo.gif') }}  width="620" height="340" alt="">
                        </figure>
                        
                        <p>En primer lugar debe seleccionar la tabla en la que se encuentre el indicador que desea utilizar. Una vez pulse sobre la tabla se desplegarán los distintos campos que esta contiene, en este momento deberá arrastrar el indicador deseado al eje en el que desee colocarlo.</p>
                        <p>Recuerde que puede hacer operaciones entre los distintos indicadores como son: la suma, la multiplicación, la resta, y la división. </p>
						<p>También es posible contar el número de elementos existentes para un indicador determinado, utilizando la operación contar. </p>
						<p>NOTA: Recuerde cerrar el paréntesis de la operación contar cuando finalice esta.</p>
						<p>Para finalizar pulse sobre "Generar consulta" </p>
                    </div>
                </article>

                <div class="line"></div>
                
                <article id="article1"> 
                    <h2>¿Qué hacer con los indicadores?</h2>
                    
                    <div class="line"></div>
                    
                    <div class="articleBody clear">
                    
                    	<figure>
	                    	<img src={{ URL::asset('img/ejemplo.gif') }} width="620" height="340" />
                        </figure>
                       
						<p>Una vez se hayan generado los indicadores, aparecerán en una tabla para que los puedas interpretar. </p>
						<p>Tambien tienes la opción de generar una gráfica con estos </p>
						<p>NOTA: Recuerde cerrar el paréntesis de la operación contar cuando finalice esta.</p>
						<p>Para finalizar pulse sobre "Generar consulta" </p>
						<p>NOTA: Recuerde cerrar el paréntesis de la operación contar cuando finalice esta.</p>
						<p>Para finalizar pulse sobre "Generar consulta" </p>
						<p>NOTA: Recuerde cerrar el paréntesis de la operación contar cuando finalice esta.</p>
						<p>Para finalizar pulse sobre "Generar consulta" </p>
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
