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
        
        <article class="p_article" id="conoce">
            <div class="p_articlecenter">
                <div class="p_articletitle">Conoce nuestras actividades</div>
                <div class="p_articleline"></div>
                <div class="p_articleconte" id = "demos_guest">

                <div class="p_conocecenter" id = "carga_apps">
                    <?
                    echo '<input id = "totalAppsC" type = "hidden" value = "'.count($apps_conoce).'" />';
                    foreach($apps_conoce as $app){

                    ?>
                    <div class="p_recientebox p_iniciacarga" imgsrc = "<?=$app->prefijo?>" rel = "<?=$app->id_aplicacion?>" name = '<?=$app->nombre?>'>
                        <div class="p_recienteboximg">
                            <div class="p_recienteboxminiatura" >
                                <div class="p_recienteboxicon p_recienteboxicon_<?=$app->categoria?>" ></div>
                                <div class="p_recienteboxlight"></div>
                                <div class="p_recienteinfo">
                                    <div class="p_recienteinfoplay">
                                        <?
                                        /*
                                        AQUI VA EL ONCLICK PARA LAS APLICACIONES
                                        */
                                        ?>
                                            <div class="p_recienteinfoplayicon" >
                                                <?
                                                /*
                                                SVG PARA EL BOTÓN DE PLAY                                                
                                                */
                                                ?>
                                                <svg viewBox="0 0 148.253 150">
                                                    <g>
                                                        <path fill-rule="evenodd" clip-rule="evenodd"  d="M74.027,0.058c37.036-1.606,74.318,30.537,74.226,74.878
                                                        c-0.088,43.053-35.125,75.344-74.689,75.063c-37.865-0.27-72.181-29.865-73.515-70.935C-1.431,33.571,30.971,0.058,74.027,0.058z"/>
                                                    </g>
                                                    <g>

                                                        <path d="M76.697,0v4c16.848,0,33.871,7.376,46.707,20.239c13.484,13.513,20.89,31.514,20.85,50.688
                                                            c-0.039,19.33-7.558,37.359-21.17,50.766C109.979,138.598,92.117,146,74.077,146l-0.484-0.002
                                                            c-17.726-0.126-34.686-6.907-47.757-19.093C12.382,114.364,4.645,97.327,4.047,78.934C3.36,57.809,10.37,38.542,23.787,24.682
                                                            c12.874-13.3,30.716-20.624,50.241-20.624c0.058,0,0.116-0.001,0.173-0.004C75.023,4.018,75.861,4,76.692,4L76.697,0 M76.691,0
                                                            c-0.886,0-1.777,0.019-2.664,0.058c-43.057,0-75.458,33.514-73.979,79.006c1.334,41.069,35.65,70.665,73.515,70.935
                                                            C73.735,150,73.906,150,74.077,150c39.354,0,74.089-32.198,74.177-75.065C148.343,31.655,112.832-0.003,76.691,0L76.691,0z"/>

                                                    </g>


                                                    <path d="M103.804,71.464L69.521,37.181c-1.43-1.43-3.581-1.857-5.449-1.084c-1.868,0.774-3.086,2.597-3.086,4.62
                                                        v68.567c0,2.022,1.218,3.846,3.086,4.619c0.619,0.257,1.269,0.381,1.913,0.381c1.301,0,2.58-0.508,3.537-1.465l34.283-34.283
                                                        C105.757,76.583,105.757,73.417,103.804,71.464z"/>


                                                </svg>
                                            </div>
                                        </div>
                                    <div class="p_recienteinfotitle"><?=$app->nombre?></div>
                                    <div class="p_recienteinfoobjetivos">
                                        <ul>
                                            <?=$app->objetivos?>
                                        </ul>
                                    </div>
                                    <?
                                    /*
                                    DEGRADADO BLANCO INFERIOR AL HACER HOVER A LAS APLICACIONES
                                    */
                                    ?>
                                    <div class = "p_primerGradient"></div>
                                    <div class = "p_segundoGradient"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p_recienteboxtxt"> <?=$app->nombre?> </div>
                    </div>
                    <?

                        }
                    ?>
                    
                </div>
                        
                <div class="p_actbtnnav">
                    <div class="p_actnavcenter" >
                        <div class="p_actnavarrowleft" id = "p_actnavarrowleft"></div>
                        <div id = "paginas_demo" style = "float:left"></div>
                        
                        <div class="p_actnavarrowright" id = "p_actnavarrowright"></div>
                    </div>
                </div>           
                <div class="p_conocetxt">INGRESA PARA CONOCER A TODAS LAS ACTIVIDADES</div>

                </div>
            </div>
        </article>
		
        <article class="p_article" id="temas">
            <div class="p_articlecenter">
                <div class="p_articletitle">Asignaturas</div>
                <div class="p_articleline"></div>
                <div class="p_articleconte">
                    <div class="p_temascenter">

                    	<div class="p_temasbox">
                            <div class="p_temasboximg">
                                <div class="p_temasboxicon p_temas_bio">
                                    <div class="p_temasboxlight"></div>
                                </div>
                            </div>
                            <div class="p_temasboxtxt">Biología</div>
                        </div>
                        <div class="p_temasbox">
                            <div class="p_temasboximg">
                                <div class="p_temasboxicon p_temas_esp">
                                    <div class="p_temasboxlight"></div>
                                </div>
                            </div>
                            <div class="p_temasboxtxt">Ciencias de la comunicación</div>
                        </div>
                        <div class="p_temasbox">
                            <div class="p_temasboximg">
                                <div class="p_temasboxicon p_temas_csa">
                                    <div class="p_temasboxlight"></div>
                                </div>
                            </div>
                            <div class="p_temasboxtxt">Ciencias de la salud</div>
                        </div>
                        <div class="p_temasbox">
                            <div class="p_temasboximg">
                                <div class="p_temasboxicon p_temas_cso">
                                    <div class="p_temasboxlight"></div>
                                </div>
                            </div>
                            <div class="p_temasboxtxt">Ciencias sociales</div>
                        </div>
                        <div class="p_temasbox">
                            <div class="p_temasboximg">
                                <div class="p_temasboxicon p_temas_der">
                                    <div class="p_temasboxlight"></div>
                                </div>
                            </div>
                            <div class="p_temasboxtxt">Derecho</div>
                        </div>
                        <div class="p_temasbox">
                            <div class="p_temasboximg">
                                <div class="p_temasboxicon p_temas_dco">
                                    <div class="p_temasboxlight"></div>
                                </div>
                            </div>
                            <div class="p_temasboxtxt">Desarrollo comunitario</div>
                        </div>
                        <div class="p_temasbox">
                            <div class="p_temasboximg">
                                <div class="p_temasboxicon p_temas_eco">
                                    <div class="p_temasboxlight"></div>
                                </div>
                            </div>
                            <div class="p_temasboxtxt">Ecología</div>
                        </div>
                        <div class="p_temasbox">
                            <div class="p_temasboximg">
                                <div class="p_temasboxicon p_temas_art">
                                    <div class="p_temasboxlight"></div>
                                </div>
                            </div>
                            <div class="p_temasboxtxt">Educación artística</div>
                        </div>
                        <div class="p_temasbox">
                            <div class="p_temasboximg">
                                <div class="p_temasboxicon p_temas_esm">
                                    <div class="p_temasboxlight"></div>
                                </div>
                            </div>
                            <div class="p_temasboxtxt">Estructura socioeconómica de México</div>
                        </div>
                        <div class="p_temasbox">
                            <div class="p_temasboximg">
                                <div class="p_temasboxicon p_temas_fil">
                                    <div class="p_temasboxlight"></div>
                                </div>
                            </div>
                            <div class="p_temasboxtxt">Filosofía</div>
                        </div>
                        <div class="p_temasbox">
                            <div class="p_temasboximg">
                                <div class="p_temasboxicon p_temas_fis">
                                    <div class="p_temasboxlight"></div>
                                </div>
                            </div>
                            <div class="p_temasboxtxt">Física</div>
                        </div>
                        <div class="p_temasbox">
                            <div class="p_temasboximg">
                                <div class="p_temasboxicon p_temas_geo">
                                    <div class="p_temasboxlight"></div>
                                </div>
                            </div>
                            <div class="p_temasboxtxt">Geografía</div>
                        </div>
                        <div class="p_temasbox">
                            <div class="p_temasboximg">
                                <div class="p_temasboxicon p_temas_his">
                                    <div class="p_temasboxlight"></div>
                                </div>
                            </div>
                            <div class="p_temasboxtxt">Historia de México</div>
                        </div>
                        <div class="p_temasbox">
                            <div class="p_temasboximg">
                                <div class="p_temasboxicon p_temas_hisu">
                                    <div class="p_temasboxlight"></div>
                                </div>
                            </div>
                            <div class="p_temasboxtxt">Historia universal</div>
                        </div>
                        <div class="p_temasbox">
                            <div class="p_temasboximg">
                                <div class="p_temasboxicon p_temas_lec">
                                    <div class="p_temasboxlight"></div>
                                </div>
                            </div>
                            <div class="p_temasboxtxt">Lecturas de comprensión</div>
                        </div>
                        <div class="p_temasbox">
                            <div class="p_temasboximg">
                                <div class="p_temasboxicon p_temas_lit">
                                    <div class="p_temasboxlight"></div>
                                </div>
                            </div>
                            <div class="p_temasboxtxt">Literatura</div>
                        </div>
                        <div class="p_temasbox">
                            <div class="p_temasboximg">
                                <div class="p_temasboxicon p_temas_mat">
                                    <div class="p_temasboxlight"></div>
                                </div>
                            </div>
                            <div class="p_temasboxtxt">Matemáticas</div>
                        </div>
                        <div class="p_temasbox">
                            <div class="p_temasboximg">
                                <div class="p_temasboxicon p_temas_met">
                                    <div class="p_temasboxlight"></div>
                                </div>
                            </div>
                            <div class="p_temasboxtxt">Metodología de la investigación</div>
                        </div>
                        <div class="p_temasbox">
                            <div class="p_temasboximg">
                                <div class="p_temasboxicon p_temas_inf">
                                    <div class="p_temasboxlight"></div>
                                </div>
                            </div>
                            <div class="p_temasboxtxt">Informática</div>
                        </div>
                        <div class="p_temasbox">
                            <div class="p_temasboximg">
                                <div class="p_temasboxicon p_temas_pro">
                                    <div class="p_temasboxlight"></div>
                                </div>
                            </div>
                            <div class="p_temasboxtxt">Probabilidad y estadística</div>
                        </div>
                        <div class="p_temasbox">
                            <div class="p_temasboximg">
                                <div class="p_temasboxicon p_temas_qui">
                                    <div class="p_temasboxlight"></div>
                                </div>
                            </div>
                            <div class="p_temasboxtxt">Química</div>
                        </div>
                        <div class="p_temasbox">
                            <div class="p_temasboximg">
                                <div class="p_temasboxicon p_temas_tle">
                                    <div class="p_temasboxlight"></div>
                                </div>
                            </div>
                            <div class="p_temasboxtxt">Taller de lectura y redacción</div>
                        </div>
                        <div class="p_temasbox">
                            <div class="p_temasboximg">
                                <div class="p_temasboxicon p_temas_cye">
                                    <div class="p_temasboxlight"></div>
                                </div>
                            </div>
                            <div class="p_temasboxtxt">Ética y valores</div>
                        </div>
                    </div>
                </div>
            </div>
        </article>

        <article class="p_article" id="grados">
            <div class="p_articlecenter">
                <div class="p_articletitle">Semestres</div>
                <div class="p_articleline"></div>
                <div class="p_articleconte">
                    <div class="p_gradoscenter">

                        <div class="p_gradosbox">
                            <div class="p_gradosicon p_temas_primero">
                                <div class="p_gradosboxlight"></div>
                            </div>
                        </div>

                        <div class="p_gradosbox">
                            <div class="p_gradosicon p_temas_segundo">
                                <div class="p_gradosboxlight"></div>
                            </div>
                        </div>

                        <div class="p_gradosbox">
                            <div class="p_gradosicon p_temas_tercero">
                                <div class="p_gradosboxlight"></div>
                            </div>
                        </div>

                        <div class="p_gradosbox">
                            <div class="p_gradosicon p_temas_cuarto">
                                <div class="p_gradosboxlight"></div>
                            </div>
                        </div>
                        <div class="p_gradosbox">
                            <div class="p_gradosicon p_temas_quinto">
                                <div class="p_gradosboxlight"></div>
                            </div>
                        </div>
                        <div class="p_gradosbox">
                            <div class="p_gradosicon p_temas_sexto">
                                <div class="p_gradosboxlight"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </article>
		
		<!--LIBROS-->
    <article class="p_article" id="libros_sep">
        <div class="p_articlecenter">
            <div class="p_articletitle">Artículos y sitios de interés </div>
            <div class="p_articleline"></div>
            <div class="p_articleconte">
                <div class="p_gradoscenter">
                    <ol id="lista2">
                        <ul >
                            <span bole = "1" >Arte+</span>
                        </ul>
                        <ul >
                            <span bole = "2">Biblioteca+</span>
                        </ul>
                        <ul >
                            <span bole = "3">Cultura+</span>
                        </ul>
                        <ul >                               
                            
                            <span bole = "4">Ecología+</span>
                        </ul>
                        <ul >
                            <span bole = "5">Educación+</span>
                        </ul>
                        <!--<ul >
                            <span bole = "6">Estados+</span>
                        </ul>
                        <ul>
                            <span bole = "7">Historia+</span>
                        </ul>-->
                    </ol>
                </div>
            </div>
        </div>
    </article>
    <!--LIBROS-->
        <article class="p_article" id="libros_sep2">
            <div class="p_articlecenter">
                <div class="p_articletitle"></div>
                <div class="p_articleline"></div>
                <div class="p_articleconte">
                    <div class="p_gradoscenter">
                        <ol id="listaN">
                        </ol>
                    </div>
                </div>
            </div>
        </article>
    <article class="p_article" id="museosLat" style="display: none;">
        <div class="p_articlecenter">
            <div class="p_articletitle">Museos virtuales de América Latina</div>
            <div class="p_articleline"></div>
            <div class="p_articleconte">
                <div class="p_gradoscenter">
                    <ol id="lista2">
                        <ul>
                            <span bole="8">Museos virtuales de América Latina+</span>
                            <a style="display: block;" target="_blank" href="http://sistemaecuatorianodemuseos.blogspot.com/">
                                <ul>Ecuador</ul>
                            </a>
                            <a style="display: block;" target="_blank" href="http://museos.cultura.pe/lista-de-museos">
                                <ul>Perú</ul>
                            </a>
                            <a style="display: block;" target="_blank" href="http://www.museoscolombianos.gov.co/Paginas/default.aspx">
                                <ul>Colombia</ul>
                            </a>
                            <a style="display: block;" target="_blank" href="https://www.bolivia.com/empresas/cultura/Museos_Boliva/">
                                <ul>Bolivia</ul>
                            </a>
                            <a style="display: block;" target="_blank" href="https://www.registromuseoschile.cl/663/w3-channel.html">
                                <ul>Chile</ul>
                            </a>
                            <a style="display: block;" target="_blank" href="https://rma.cultura.gob.ar/#/app">
                                <ul>Argentina</ul>
                            </a>
                        </ul>
                    </ol>
                </div>
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