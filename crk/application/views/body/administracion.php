<html>
	<head>
        <!--link href = "<?=base_url()?>/src/css/jquery-ui.min.css" rel = "stylesheet" type = "text/css"/-->
        <link href = "https://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" rel = "stylesheet" type = "text/css">
        
		<!--link href="<?=base_url()?>src/css/animate.css" rel="stylesheet" type="text/css" async = "async">
		<link href="<?=base_url()?>src/css/primaria_diseno.css" rel="stylesheet" type="text/css" async = "async">-->
		<!--========================================
		*
		*						JS
		*
		==========================================-->
		<!--<script src="<?=base_url()?>src/js/jquery-1.11.1.js" type="text/javascript"></script>
		<script src="<?=base_url()?>src/js/jquery-ui.min.js" type="text/javascript"></script>
		<script src="<?=base_url()?>src/js/jquery.transit.min.js" type="text/javascript"></script>
		-->
		<!--script src = "<?=base_url()?>src/sistema/js/administracion.js" type = "text/javascript"></script-->
	</head>
	<body>
	<!--
	SECTION
	-->
	<section class="p_section p_oculta" id= "section_2">
		<article class="p_article" >
			<div class="p_articlecenter">
				<div class="p_configicon">
					<div class="p_configiconcontent">
						<div class="p_configiconimgregresar"></div>
						<table class="p_configicontxt"><tr><td>Regresar</td></tr></table>
					</div>
				</div>
				<div class="p_articletitle" style = "cursor:pointer;" onclick = "seleccionaItem('conteConfig')" id = "txtConfiguracion">Configuración +</div>
				<div class="p_articleline"></div>
				<div class="p_articleconte" style = "display:none;" id = "conteConfig">
					<div class = "p_conte_inicio"></div>
					<div class = "p_conteSelect">
						<select class = "p_filtro_asigna">
							<option value = "selecciona">Elige una opción</option>
							<option value = 0>Conoce nuestras aplicaciones</option>
							<option value = 1>Lo más reciente</option>
							<!--option value = 2>Editar aplicaciones</option>
							<option value = 3>Modifica grados, materias, subtemas</option-->
						</select>
						<table class = "p_cambio_sel" onclick = "modificar()"><tr><td>Modificar</td></tr></table>
					</div>
				</div>
			</div>
		</article>
		<article class="p_article p_oculta" id = "second_config" >
			<div class="p_articlecenter">
				<div class="p_articletitle" id="titulo" seleccion = "2">Selecciona actividades</div>
				<div class="p_articleline"></div>
				
				<div class="p_articleconte">

					<div class="p_buscador p_buscardorconfig">
						<input id = "pal_bus" class="p_buscadorinput" onkeyup = "filtrarKeyupC(this.value);" type = "text" placeholder="Buscar actividades.">
						<div class="p_buscadoricon"></div>
					</div>

					<div class = "p_filtros_sel">
						<div class = "p_btn_filtro" onclick = "seleccionaCategoriaAdmin('aplicacion')" categoria = "aplicacion"><div class="p_filtroslight p_filtroslight_app"></div></div>
						<div class = "p_btn_filtro" onclick = "seleccionaCategoriaAdmin('lectura')" categoria = "lectura"><div class="p_filtroslight p_filtroslight_lec"></div></div>
						<div class = "p_btn_filtro" onclick = "seleccionaCategoriaAdmin('video')" categoria = "video"><div class="p_filtroslight p_filtroslight_vid"></div></div>
						<div class = "p_btn_filtro" onclick = "seleccionaCategoriaAdmin('evaluacion')" categoria = "evaluacion"><div class="p_filtroslight p_filtroslight_eva"></div></div>
					</div>

					<div class = "p_conte_limpia">
						<div class = "p_limpia_filtros" onclick = "limpiaFiltrosAdmin()">Limpia filtros</div>
					</div>
					<article class="p_article" >
						<div class="p_articlecenter">
							<div class="p_articleconte" id = "activs_config">
								<!--div class="p_actcenter" id = "activs" style="display:none;"></div-->

								<div class="p_act2center" id = "activs" style="display:none;">
								<!--AQUI VAN LAS APLICACIONES-->
								<div class="p_act2box" style="display: block;">
									<div class="p_recienteboximg p_resalteminiatura">
										<div class="p_recienteboxminiatura" >
											<div class="p_recienteboxicon"></div>
											<div class="p_recienteboxlight"></div>

											<div class="p_recienteinfo">

												<div class="p_recienteinfoplay">
													<div class="p_recienteinfoplayicon" ></div>
												</div>
												<div class="p_recienteinfotitle"></div>
												<div class="p_recienteinfoobjetivos">
													</div>
												<input type="checkbox" class="c_check2box" >
											</div>


										</div>
									</div>
									<div class="p_recienteboxtxt"></div>
									<input type="checkbox" class="c_checkbox">
								</div>
								</div>

								<!--   </div>-->

							</div>
						</div>
					</article>
					<div class="p_actbtnnav">
						<div class="p_actnavcenter" id = "numerospc">
							<div class="p_actnavarrowleft" id = "p_actnavarrowleft_admin"></div>
							<div id = "pag_admin" style = "float:left;">
								<div class="p_actnavnum">1</div>
								<div class="p_actnavnum p_actnavnum_active">2</div>
								<div class="p_actnavnum">3</div>
								<div class="p_actnavnum">4</div>
								<div class="p_actnavnum">...</div>
							</div>
							<div class="p_actnavarrowright" id = "p_actnavarrowright_admin"></div>
						</div>
					</div>
					
					<div class ="c_agregarSeleccion" onclick = "agregaApps(false)">
						<table class = "c_agregarSelecion_icon"><tr><td>Agregar actividades</td></tr></table>
					</div>
					
					<div class="p_articletitle" id="subtitulo">Selecciona actividades</div>
					<div class="p_articleline"></div>
					
					<div class = "p_caja_actividades">
						<div class="c_movericons" id="moverIcon">
							<div id="moverApp" class="c_movericonscenter" style="display: table;">
								<table id="mover" class="c_moveraplicacion"><tr><td>Mover aplicación</td></tr></table>
								<div id="moveL" class="c_iconleft" onclick="moveL('-')" style="opacity: 0.5; cursor: default;"></div>
								<div id="moveR" class="c_iconright" onclick="moveL('+')" style="opacity: 0.5; cursor: default;"></div>
								<div id="trash" class="c_botonbasura" onclick="eliminaClones()" style="opacity: 0.5; cursor: default;"></div>
							</div>
						</div>
					</div>


					<div class ="c_agregarSeleccion" >
						<table class = "c_agregarSelecion_icon" onclick = "guardarActividades()"><tr><td>Guardar actividades</td></tr></table>
					</div>
				</div>
			</div>
		</article>
		
		<div id = "subtemas_conte" ></div>
		
		<article class="p_article" >
		
			<div class="p_articlecenter">
			
				<div class="p_articletitle" style = "cursor:pointer;" onclick = "seleccionaItem('conteInfo')" id = "txtInformes">Informes +</div> 
				<div class="p_articleline"></div>
				<div class="p_articleconte" style = "display:none;" id = "conteInfo">
					<div class = "p_conte_inicio"></div>
					<div class = "p_conteSelect">
					
						<!--select class = "p_filtro_asigna" id = "cuentas">
						
							<option value = "selecciona">Elige una opción</option>
							
							<option value = 0>Hojear lista de usuarios</option-->
							
							<!--option value = 2>Editar aplicaciones</option>
							<option value = 3>Modifica grados, materias, subtemas</option-->
							
						<!--/select-->
					<!--section class="tabs">
						<input id="tab-1" type="radio" name="radio-set" class="tab-selector-1" checked="checked" />
						<label for="tab-1" class="tab-label-1">About</label>
				
						<input id="tab-2" type="radio" name="radio-set" class="tab-selector-2" />
						<label for="tab-2" class="tab-label-2">Services</label>
				
						<input id="tab-3" type="radio" name="radio-set" class="tab-selector-3" />
						<label for="tab-3" class="tab-label-3">Work</label>
					
						<input id="tab-4" type="radio" name="radio-set" class="tab-selector-4" />
						<label for="tab-4" class="tab-label-4">Contact</label>
					
						<div class="clear-shadow"></div>
					
						<div class="content">
							<div class="content-1">
								<h2>About us</h2>
								<p>You think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the world once and got a taste for murder. After the avalanche, it took us a week to climb out. Now, I don't know exactly when we turned on each other, but I know that seven of us survived the slide... and only five made it out. Now we took an oath, that I'm breaking now. We said we'd say it was the snow that killed the other two, but it wasn't. Nature is lethal but it doesn't hold a candle to man.</p>
								<h3>How we work</h3>
								<p>Like you, I used to think the world was this great place where everybody lived by the same standards I did, then some kid with a nail showed me I was living in his world, a world where chaos rules not order, a world where righteousness is not rewarded. That's Cesar's world, and if you're not willing to play by his rules, then you're gonna have to pay the price. </p>
							</div>
							<div class="content-2">
								<h2>Services</h2>
								<p>Do you see any Teletubbies in here? Do you see a slender plastic tag clipped to my shirt with my name printed on it? Do you see a little Asian child with a blank expression on his face sitting outside on a mechanical helicopter that shakes when you put quarters in it? No? Well, that's what you see at a toy store. And you must think you're in a toy store, because you're here shopping for an infant named Jeb.</p>
								<h3>Excellence</h3>
								<p>Like you, I used to think the world was this great place where everybody lived by the same standards I did, then some kid with a nail showed me I was living in his world, a world where chaos rules not order, a world where righteousness is not rewarded. That's Cesar's world, and if you're not willing to play by his rules, then you're gonna have to pay the price. </p>
							</div>
							<div class="content-3">
								<h2>Portfolio</h2>
								<p>The path of the righteous man is beset on all sides by the iniquities of the selfish and the tyranny of evil men. Blessed is he who, in the name of charity and good will, shepherds the weak through the valley of darkness, for he is truly his brother's keeper and the finder of lost children. And I will strike down upon thee with great vengeance and furious anger those who would attempt to poison and destroy My brothers. And you will know My name is the Lord when I lay My vengeance upon thee.</p>
								<h3>Examples</h3>
								<p>Now that we know who you are, I know who I am. I'm not a mistake! It all makes sense! In a comic, you know how you can tell who the arch-villain's going to be? He's the exact opposite of the hero. And most times they're friends, like you and me! I should've known way back when... You know why, David? Because of the kids. They called me Mr Glass. </p>
							</div>
							<div class="content-4">
								<h2>Contact</h2>
								<p>You see? It's curious. Ted did figure it out - time travel. And when we get back, we gonna tell everyone. How it's possible, how it's done, what the dangers are. But then why fifty years in the future when the spacecraft encounters a black hole does the computer call it an 'unknown entry event'? Why don't they know? If they don't know, that means we never told anyone. And if we never told anyone it means we never made it back. Hence we die down here. Just as a matter of deductive logic.</p>
								<h3>Get in touch</h3>
								<p>Well, the way they make shows is, they make one show. That show's called a pilot. Then they show that show to the people who make shows, and on the strength of that one show they decide if they're going to make more shows. Some pilots get picked and become television programs. Some don't, become nothing. She starred in one of the ones that became nothing. </p>
							</div>
						</div>
					</section-->
					<div class="tab">
					  <button class="tablinks" onclick="openTab(event, 'hojear_usuarios')">Hojear lista de usuario</button>
					  <button class="tablinks" onclick="openTab(event, 'registros')">Registros</button>
					  <!--button class="tablinks" onclick="openTab(event, 'Tokyo')">Tokyo</button*-->
					</div>

					<div id="hojear_usuarios" class="tabcontent">
					 	<!--div class = "p_oculta" id = "resultadoListaUsuarios"-->
						
							<table border = 1 id = "lista" style = "margin:auto">
								<tr>
									<td>
										<div id = "firstname" onclick = "orden(event, 'firstname')" class = 'tituloTabla tituloTablaSel'>Nombre</div>
										<div style = 'float:left;'>/</div>
										<div onclick = "orden(event, 'lastname')" class = 'tituloTabla tituloTablaSel'>Apellido</div>
									</td>
									<td class = 'tituloTablaSel' onclick = "orden(event, 'email')" >Email</td>
									<td class = 'tituloTablaSel' onclick = "orden(event, 'city')" >Ciudad</td>
									<td class = 'tituloTablaSel' onclick = "orden(event, 'country')" >País</td>
									<td class = 'tituloTablaSel' onclick = "orden(event, 'lastaccess')" >Último acceso</td>
								<tr>
							</table>
							
							<div class="p_actnavcenter" id = "indiceHoja">
							
								<div class="p_actnavarrowleft" id = "p_leftHojaUser" onclick = "retrocedeSeccion()"></div>
								
								<div id = "pag_hojaUser" style = "float:left;">
									<div class="p_actnavnum">1</div>
									<div class="p_actnavnum p_actnavnum_active">2</div>
									<div class="p_actnavnum">3</div>
									<div class="p_actnavnum">4</div>
									<div class="p_actnavnum">...</div>
								</div>
								
								<div class="p_actnavarrowright" id = "p_rightHojaUser" onclick = "aumentaSeccion()"></div>
								
							</div>				
						<!--/div-->
					</div>

					<div id="registros" class="tabcontent">
						<!--div class = "p_oculta" id = "resultadoRegistrosLog"-->
							<table style = "margin:auto">
                                
								<tr>
                                   
                                    <!--td > <div class = "p_txtlog">Fecha:</div></td-->
                                    <td><div class = "p_txtlog">Todos los dias <input type = "checkbox" id = "todasDias" checked = "true" onchange = "selectAllDias(this.checked)"/></div></td>
									<td>
                                        <!--input type="date" id = "fechaBus" step="1" min="2017-01-01" readonly = "true"-->
                                    <div class = "caja">
                                    <input id = "fechaBus" disabled = "true" type="text" value = "dd-mm-yyyy" /></div>
                                    </td>
								
									<td><div class = "caja">
                                            <select id = "acciones">
											<option>Todas</option>
											<option value = 'log'>Sesiones</option>
											<!--option value = ''>Cierre de sesión</option-->
											<option value = 'view'>Vistas</option>
											<option value = 'link'>Otros links</option>
											<option value = 'change'>Cambios</option>
										</select>
                                        </div>
										
									</td>
									
									<td>
                                        <div class = "caja">
										<select id = "participantes">
											<option>Todos</option>
											<option>guest</option>
											<!--option>Usuarios sin cuenta</option-->
										</select>
                                        </div>
										<!--input type = "button" value = "Más" /-->
									</td>
								</tr>
                               
								<tr >
									<td colspan = "6">
										<input style = "/*margin-left:calc(50% - (150px/2));width:150px;*/" type = "button" value = "Conseguir registros" onclick = "paginaLog = 1;pagSeccionLog = 1
									;filtrarRegistros()" class = "c_agregarSelecion_icon"/>
									</td>
								</tr>
							</table>
							
							<table border = 1 id = "registrosLog" style = "margin:auto">
								<tr>
									<td>
										Fecha
									</td>
									<td >Dirección IP</td>
									<td >Nombre completo</td>
									<td >Acción</td>
									<td >Información</td>
									<td >Dispositivo</td>
								<tr>
							</table>
							
							<div class="p_actnavcenter" id = "indiceHoja">
							
								<div class="p_actnavarrowleft" id = "p_leftLogUser" onclick = "retrocedeSeccionLog()"></div>
								
								<div id = "pag_logUser" style = "float:left;">
									<div class="p_actnavnum">1</div>
									<div class="p_actnavnum p_actnavnum_active">2</div>
									<div class="p_actnavnum">3</div>
									<div class="p_actnavnum">4</div>
									<div class="p_actnavnum">...</div>
								</div>
								
								<div class="p_actnavarrowright" id = "p_rightLogUser" onclick = "aumentaSeccionLog()"></div>
								
							</div>	
						<!--/div-->
					</div>

					<!--div id="Tokyo" class="tabcontent">
					  <h3>Tokyo</h3>
					  <p>Tokyo is the capital of Japan.</p>
					</div-->
					
					
						<!--input type = "button" onclick = "listaUsuarios()" value = "Hojear lista de usuarios">
						
						<input type = "button" onclick = "obtenerRegistrosLog()" value = "Registros"-->
						
						<!--table class = "p_cambio_sel" onclick = "listaUsuarios()"><tr><td>Ir</td></tr></table-->
						
						
						
					
						
						
					</div>
				</div>
			</div>
			
		</article>
		
	</section>

	</body>
</html>
