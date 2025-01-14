 	<?php if(!$this->bandera_movil){ ?><div id = "is_movil"></div><?php } ?>
	<input type = "hidden" value = "<?=$this->session->userdata('user_id')?>" id = "rel_user">
    <section class="p_section" id= "section_1">

        <article class="p_article" id="iconregresar">
            <div class="p_actividadesregresar">
                <div class="p_regresarbtn" onclick = "regresarMenu()">
                    <div class="p_regresaricon"></div>
                    <div class="p_regresartxt">Regresar al menú</div>
                </div>
            </div>
        </article>
		
		
		<!--LIBROS-->
		<article class="p_article" id="libros_sep">
			<div class="p_articlecenter">
                <div class="p_articletitle">Libros SEP</div>
                <div class="p_articleline"></div>
                <div class="p_articleconte">
					<div class="p_gradoscenter">
						<ol id="lista2">
						</ol>
                    </div>
				</div>
            </div>
		</article>
		<!--LIBROS-->
		<article class="p_article" id="clasicos">
			<div class="p_articlecenter">
                <div class="p_articletitle">Clásicos</div>
                <div class="p_articleline"></div>
                <div class="p_articleconte">
					<div class="p_gradoscenter">
						<ol id="lista3">
						
						<a onclick="insertaLogLink('El principito')" target="_blank" href="https://www.ellibrototal.com/ltotal/ficha.jsp?idLibro=9175">
						<ul>El Principito</ul>
						</a>
						<a onclick="insertaLogLink('Cuentos Infantiles')" target="_blank" href="https://www.ellibrototal.com/ltotal/?t=1&d=6831_6561_1_1_6831">
						<ul>Cuentos Infantiles</ul>
						</a>
						<a onclick="insertaLogLink('Lecturas Infantiles')" target="_blank" href="https://www.ellibrototal.com/ltotal/ficha.jsp?idLibro=6382">
						<ul>Lecturas Infantiles</ul>
						</a>
						<a onclick="insertaLogLink('Fabulas y verdades')" target="_blank" href="https://www.ellibrototal.com/ltotal/ficha.jsp?idLibro=8">
						<ul>Fábulas y verdades</ul>
						</a>
						<a onclick="insertaLogLink('Aventuras de don quijote')" target="_blank" href="https://www.ellibrototal.com/ltotal/ficha.jsp?idLibro=35">
						<ul>Aventuras de Don Quijote</ul>
						</a>
						
						</ol>
                    </div>
				</div>
            </div>
		</article>						 
        <article class="p_article" id="iconregresarlibro" style="display: none;">            
            <div class="p_actividadesregresar">                
                <div class="p_regresarbtn" onclick="regresarLibros()">                    
                    <div class="p_regresaricon">
                        <div id="linea1"></div>
                        <div id="linea2"></div>
                        <div id="linea3"></div>
                    </div>                    
                    <div class="p_regresartxt">Regresar al menú</div>                
                </div>            
            </div>        
        </article>

    </section>