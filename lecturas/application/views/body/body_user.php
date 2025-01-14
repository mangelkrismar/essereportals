<input type = "hidden" value = "<?=$this->session->userdata('user_id')?>" id="rel_user">
<?php if(!$this->bandera_movil){ ?>
	<div id = "is_movil"></div>
<?php } ?>
<section class="p_section" id= "section_1">
	<!-- Mensaje de carga -->
	<div ng-if="!aplicaciones">
		<article class="p_article" ng-if="!error">
			<div class="p_articlecenter">
					<div class="p_articletitle">Cargando actividades</div>
					<div class="p_articleline"></div>
					<div class="p_articleconte fadeIn" style="height: 700px;">
						<div id = "load_app" class = "p_conte_notificacion" style="display: block;">
							<div class="sk-cube-grid">
								<div class="sk-cube sk-cube1"></div>
								<div class="sk-cube sk-cube2"></div>
								<div class="sk-cube sk-cube3"></div>
								<div class="sk-cube sk-cube4"></div>
								<div class="sk-cube sk-cube5"></div>
								<div class="sk-cube sk-cube6"></div>
								<div class="sk-cube sk-cube7"></div>
								<div class="sk-cube sk-cube8"></div>
								<div class="sk-cube sk-cube9"></div>
							</div>
						</div>
					</div>
				</div>
		</article>
		<article class="p_article" ng-if="error">
			<div class="p_articlecenter">
					<div class="p_articletitle">Atención</div>
					<div class="p_articleline"></div>
					<div class="p_articleconte fadeIn">
						<div class="p_act2center">
							<table class="p_conte_notificacion" style="min-height: 450px; display: table;">
								<tr>
									<td>{{error}}</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
		</article>
	</div>
	<!-- Las aplicaciones han sido cargadas -->
	<div ng-show="aplicaciones">
		<!-- Buscador -->
		<article class="p_article" id="buscar">
			<div class="p_articlecenter">
				<div class="p_buscador">
					<input class="p_buscadorinput" placeholder="Buscar actividades educativas" ng-change="changesForSection(true)" ng-model="filtros[0].buscador" ng-click="mostrarApps()">
					<div class="content-lupa" ng-if="!verApps" ng-click="mostrarApps()">
						<div class="circleLupa"></div>
						<div class="mangoLupa"></div>
					</div>
					<!--ng-click="ocultarApps()"-->
					<div class="content-lupa" ng-show="verApps && materias.length > 1" ng-click="limpiarBuscador()">
						<div class="circleLupa transitLupa"></div>
						<div class="mangoLupa transitMango"></div>
					</div>
				</div>
				<!-- Filtro Móvil o PC -->
				<?php if(!$this->bandera_movil){ ?>
					<div class="p_switch" style="display: block;" ng-show="verApps && materias[0].n != 'Lecturas de comprensión'" ng-click="toggleNoFlash()">
						<div class="p_switchconte">
							<table class="p_switchtext" ng-class="{'p_switchcolor':noFlash}" ng-click="toggleNoFlash()">
								<tr><td>Móvil</td></tr>
							</table>
							<div class="p_switchbtn">
								<div class="p_switch_m" id="movil"></div>
								<div class="p_switchbtnin ui-draggable ui-draggable-handle"></div>
								<div class="p_switch_pc" id="pc"></div>
							</div>
							<table class="p_switchtext" ng-class="{'p_switchcolor':!noFlash}">
								<tr><td>PC</td></tr>
							</table>
						</div>
					</div>
				<?php } else{ ?>
					<div hidden>{{noFlash = true; movil = true;}}</div>
				<?php }?>
			</div>
			<div class="p_articlecenter">
				<!-- Botones para filtrar grados, materias y bloques -->
				<div class="p_actividadesmenu">
					<!-- Grados -->
					<div class="p_actividadesmenubtn p_opcionuno"
						ng-class="{'p_actividadesmenubtn_active_left':verGrados, 'p_actividadesmenubtn_over':filtros[current_section].grados}"
						ng-click="mostrarMenu('grados')">
						<div class="p_actmenubtnimg p_actmenuimg {{clasePTema(filtros[current_section].grados[0].n)}}"></div>
						<div class="p_actmenubtntxt">{{ filtros[current_section].grados ? 'Grado' : 'Grados' }}</div>
					</div>
					<!-- Asignaturas -->
					<div class="p_actividadesmenubtn p_opciondos"
						ng-class="{'p_actividadesmenubtn_active':verMaterias, 'p_actividadesmenubtn_over':filtros[current_section].materias}"
						ng-if="materias.length > 1 && materias[0].n != 'Lecturas de comprensión'"
						ng-style="estiloBotonFiltro"
						ng-click="mostrarMenu('materias')">
						<div class="p_actmenubtnimg p_actmenuimg {{clasePTema(filtros[current_section].materias[0].n)}}"></div>
						<div class="p_actmenubtntxt">{{ filtros[current_section].materias ? filtros[current_section].materias[0].n : 'Asignaturas'}}</div>
					</div>
					<!-- Temas -->
					<div class="p_actividadesmenubtn p_opciontres"
						ng-class="{'p_actividadesmenubtn_active_right':verBloques, 'p_actividadesmenubtn_over':filtros[current_section].tema}"
						ng-style="estiloBotonFiltro"
						ng-click="mostrarMenu('bloques')">
						<div class="p_actmenubtnimg"></div>
						<div class="p_actmenubtntxt">{{ filtros[current_section].tema ? filtros[current_section].tema : 'Temas'}}</div>
					</div>
					<br/>
					<div class="p_actividadesmenu filterCleaner">
						<table>
							<tr>
								<td ng-click="reinitFiltros()">Limpiar filtros</td>
							</tr>
						</table>
						<div></div>
					</div>
					<br/>
				</div>
				<!-- Selecciona categoria (aplicacion, video, lectura o evaluacion) -->
				<div class="p_actividadescateg">
					<div class="p_actividadescategopcion" ng-class="{'p_actividadescategopcion_select':catAplicacion}">
						<div class="p_actividadescategicon p_categapp" ng-click="toggleCategoria('aplicacion')">
							<div class="p_iconcateg"></div>
						</div>
					</div>
					<div class="p_actividadescategopcion" ng-class="{'p_actividadescategopcion_select':catLectura}">
						<div class="p_actividadescategicon p_categlec" ng-click="toggleCategoria('lectura')">
							<div class="p_iconcateg"></div>
						</div>
					</div>
					<div class="p_actividadescategopcion" ng-class="{'p_actividadescategopcion_select':catVideo}">
						<div class="p_actividadescategicon p_categvid" ng-click="toggleCategoria('video')">
							<div class="p_iconcateg"></div>
						</div>
					</div>
					<div class="p_actividadescategopcion" ng-class="{'p_actividadescategopcion_select':catEvaluacion}">
						<div class="p_actividadescategicon p_categeva" ng-click="toggleCategoria('evaluacion')">
							<div class="p_iconcateg"></div>
						</div>
					</div>
					<div class="p_actividadescategtxt">
						<table>
							<tr>
								<td ng-click="limpiarFiltros()">Limpiar filtros</td>
							</tr>
						</table>
						<div></div>
					</div>
				</div>
				<!-- Selecciona grado, materia y bloque -->
				<div class="p_actdesplegable" style="display:block;margin-top:100;z-index:6" ng-if="verMenu">
					<div class="p_actconte">
						<!-- Grados -->
						<div class="p_actcontein" style="display: table;" ng-if="verGrados">
							<div class="p_actgrados" ng-if="current_section == 0"
								ng-class="{'p_actgrados_over':filtros[current_section].grados[0].n == grado.n}"
								ng-repeat="grado in grados|filter:filtrarGradosConTema">
								<div class="p_actgradosin {{ clasePTema(grado.n) }}"
									ng-click="filtrarCurso('grados',[grado]); ocultarMenu()">
									<div class="p_gradosboxlight"></div>
								</div>
							</div>
							<div class="p_actgrados" ng-if="current_section == 1"
								ng-class="{'p_actgrados_over':filtros[current_section].grados[0].n == grado.n}"
								ng-repeat="grado in secundaria.grados|filter:filtrarGradosConTema">
								<div class="p_actgradosin {{ clasePTema(grado.n) }}"
									ng-click="filtrarCurso('grados',[grado]); ocultarMenu()">
									<div class="p_gradosboxlight"></div>
								</div>
							</div>
							<div class="p_actgrados" ng-if="current_section == 2"
								ng-class="{'p_actgrados_over':filtros[current_section].grados[0].n == grado.n}"
								ng-repeat="grado in bachillerato.grados|filter:filtrarGradosConTema">
								<div class="p_actgradosin {{ clasePTema(grado.n) }}"
									ng-click="filtrarCurso('grados',[grado]); ocultarMenu()">
									<div class="p_gradosboxlight"></div>
								</div>
							</div>
						</div>
						<!-- Materias -->
						<div class="p_actcontein" style="display: table;" ng-if="verMaterias">
							<div class="p_acttemas"
								ng-class="{'p_acttemas_over':filtros[current_section].materias[0].n == grupoMaterias[0].n}"
								ng-repeat="grupoMaterias in materias|orderBy:'n'|groupBy:'n'"
								ng-click="filtrarCurso('materias',grupoMaterias); ocultarMenu()">
								<div class="p_acttemasicon">
									<div class="p_acttemasimg {{ clasePTema(grupoMaterias[0].n) }}">
										<div class="p_temasboxlight"></div>
									</div>
								</div>
								<table class="p_acttemastxt">
									<tr>
										<td>{{grupoMaterias[0].n}}</td>
									</tr>
								</table>
							</div>
						</div>
						<!-- Temas -->
						<div class="p_actcontein" style="display: table;" ng-if="verBloques">
							<div class="p_actsubtemas"
								ng-if="current_section == 0"
								ng-class="{'p_actsubtemas_over':filtros[current_section].tema == tema}"
								ng-repeat="tema in testtemas = filterTemaCompiler(temas)"
								ng-click="filtrarCurso('tema',tema); ocultarMenu()">
								<div class="p_actsubtemasicon" >
									<div class="p_actsubtemasiconin"></div>
								</div>
								<table class="p_actsubtemastxt">
									<tr>
										<td>{{tema}}</td>
									</tr>
								</table>
								
							</div>
							<div class="p_actsubtemas"
								ng-if="current_section == 1"
								ng-class="{'p_actsubtemas_over':filtros[current_section].tema == tema}"
								ng-repeat="tema in testtemas = filterTemaCompiler(secundaria.temas)"
								ng-click="filtrarCurso('tema',tema); ocultarMenu()">
								<div class="p_actsubtemasicon" >
									<div class="p_actsubtemasiconin"></div>
								</div>
								<table class="p_actsubtemastxt">
									<tr>
										<td>{{tema}}</td>
									</tr>
								</table>
								
							</div>
							<div class="p_actsubtemas"
								ng-if="current_section == 2"
								ng-class="{'p_actsubtemas_over':filtros[current_section].tema == tema}"
								ng-repeat="tema in testtemas = filterTemaCompiler(bachillerato.temas)"
								ng-click="filtrarCurso('tema',tema); ocultarMenu()">
								<div class="p_actsubtemasicon" >
									<div class="p_actsubtemasiconin"></div>
								</div>
								<table class="p_actsubtemastxt">
									<tr>
										<td>{{tema}}</td>
									</tr>
								</table>
							</div>
							<!--
							<div ng-if="filtros.materias" ng-repeat="materia in testTemas = (temas|filter:filtrarTemasEnMateria)">
								<div class="p_actsubtemas"
									ng-class="{'p_actsubtemas_over':filtros.tema == tema}"
									ng-repeat="tema in testtemas = (materia.ts|filter:filtrarTemasConGrado)"
									ng-click="filtrarCurso('tema',tema); ocultarMenu()">
									<div class="p_actsubtemasicon" >
										<div class="p_actsubtemasiconin"></div>
									</div>
									<table class="p_actsubtemastxt">
										<tr>
											<td>{{tema}}</td>
										</tr>
									</table>
								</div>
								<div class="p_actsubtemas" ng-if="!testTemas.length && filtros.materias">
									<div class="p_actsubtemasicon">
										<div class="p_actsubtemasiconin"></div>
									</div>
									<table class="p_actsubtemastxt">
										<tr>
											<td>No existen subtemas.</td>
										</tr>
									</table>
								</div>
								<div class="p_actsubtemas" ng-if="!filtros.materias">
									<div class="p_actsubtemasicon">
										<div class="p_actsubtemasiconin"></div>
									</div>
									<table class="p_actsubtemastxt">
										<tr>
											<td>Selecciona una asignatura para ver los temas.</td>
										</tr>
									</table>
								</div>
							</div>
						-->
						</div>
					</div>
					<div class="p_actclosemove">
						<div class="p_actclosemovecenter"></div>
					</div>
					<div class="p_actclose" ng-click="ocultarMenu()"></div>
				</div>
			</div>
		</article>
		<!-- Se muestran las actividades -->
		<article class="p_article bounceInLeft" ng-show="verApps || materias[0].n == 'Lecturas de comprensión'">
			<div id="divForApps" class="p_articlecenter">
				<!-- Se muestran las actividades de primaria -->
				<div class="p_articleconte">
					<div class="p_articletitle">Primaria</div>
					<div class="p_articleline"></div>
					<div class="p_act2center">
						<div style="min-height: 406px;">
							<!-- Actividades -->
							<div class="p_act4box bounceIn" ng-repeat="aplicacion in appsFiltradasPrimaria"
								ng-mouseenter="getAppObjetivos(aplicacion)">
								<div class="p_recienteboximg" ng-class="movil?'p_resalteminiatura_over':'p_resalteminiatura'">
									<div class="p_recienteboxminiatura">
										<img ng-src="{{getAppThumbnail(aplicacion.p)}}">
										<div class="p_recienteboxicon"
											ng-class="[{
												'aplicacion' :'p_recienteboxicon_app',
												'aplicacionL':'p_recienteboxicon_appL',
												'video'      :'p_recienteboxicon_video',
												'videoT'     :'p_recienteboxicon_video',
												'lectura'    :'p_recienteboxicon_lectura',
												'evaluacionC':'p_recienteboxicon_evalC',
												'simuladorCL':'p_recienteboxicon_app'
											}[aplicacion.c]]"></div>
										<div class="p_recienteboxlight"></div>
										<div class="p_recienteinfo">
											<div class="p_recienteinfoplay">
												<div class="p_recienteinfoplayicon" ng-click="getAppClickAction(aplicacion)">
													<svg viewBox="0 0 148.253 150">
														<g><path fill-rule="evenodd" clip-rule="evenodd" d="M74.027,0.058c37.036-1.606,74.318,30.537,74.226,74.878c-0.088,43.053-35.125,75.344-74.689,75.063c-37.865-0.27-72.181-29.865-73.515-70.935C-1.431,33.571,30.971,0.058,74.027,0.058z"></path></g>
														<g><path d="M76.697,0v4c16.848,0,33.871,7.376,46.707,20.239c13.484,13.513,20.89,31.514,20.85,50.688c-0.039,19.33-7.558,37.359-21.17,50.766C109.979,138.598,92.117,146,74.077,146l-0.484-0.002c-17.726-0.126-34.686-6.907-47.757-19.093C12.382,114.364,4.645,97.327,4.047,78.934C3.36,57.809,10.37,38.542,23.787,24.682c12.874-13.3,30.716-20.624,50.241-20.624c0.058,0,0.116-0.001,0.173-0.004C75.023,4.018,75.861,4,76.692,4L76.697,0 M76.691,0c-0.886,0-1.777,0.019-2.664,0.058c-43.057,0-75.458,33.514-73.979,79.006c1.334,41.069,35.65,70.665,73.515,70.935C73.735,150,73.906,150,74.077,150c39.354,0,74.089-32.198,74.177-75.065C148.343,31.655,112.832-0.003,76.691,0L76.691,0z"></path></g>
														<path d="M103.804,71.464L69.521,37.181c-1.43-1.43-3.581-1.857-5.449-1.084c-1.868,0.774-3.086,2.597-3.086,4.62v68.567c0,2.022,1.218,3.846,3.086,4.619c0.619,0.257,1.269,0.381,1.913,0.381c1.301,0,2.58-0.508,3.537-1.465l34.283-34.283C105.757,76.583,105.757,73.417,103.804,71.464z"></path>
													</svg>
												</div>
											</div>
											<div class="p_recienteinfotitle">{{aplicacion.n}}</div>
											<div class="p_recienteinfoobjetivos" ng-if="!movil">
												<ul>
													<li ng-repeat="objetivo in current_app_objectives">• {{objetivo}}</li>
												</ul>
											</div>
											<div class="p_primerGradient" ng-if="!movil"></div>
											<div class="p_segundoGradient" ng-if="!movil"></div>
										</div>
									</div>
								</div>
								<div class="p_recienteboxtxt">{{aplicacion.n}}</div>
							</div>
							<!-- Cuando no se encuentran actividades -->
							<div ng-if="appsFiltradasPrimaria.length === 0">
								<table  style="display: table;width:100%;">
									<tr>
										<td class="p_conte_notificacionn">No se encontraron resultados.</td>
									</tr>
								</table>
							</div>
						</div>
						<div class = "p_actfondo"></div>
					</div>
				</div>
				<!-- Paginación -->
				<div class="p_actnavcenter">
					<div ng-if="paginaActual[0] == 1 || current_section != 0 || appsFiltradasPrimaria.length < 1" style="opacity: 0.3; cursor: default;" class="p_actnavarrowleft"></div>
					<div ng-if="paginaActual[0] != 1 && current_section == 0 && appsFiltradasPrimaria.length > 0" style="opacity: 1.0; cursor: pointer;" class="p_actnavarrowleft" ng-click="changePage(paginaActual[0]-1)"></div>
					<div style="float:left;">
						<div ng-if="current_section == 0" class="p_actnavnum"
						ng-repeat="pageNumber in pages = (paginasFiltradas[0] | orderBy)"
						ng-class="{ p_actnavnum_active : paginaActual[0] == pageNumber}"
						ng-click="changePage(pageNumber)">
						{{ pageNumber }}
						</div>
						<div ng-if="current_section != 0" class="p_actnavnum p_actnavnum_active_locked"
						ng-repeat="pageNumber in pages = (paginasFiltradas[0] | orderBy)"
						ng-class="{ p_actnavnum_active : paginaActual[0] == pageNumber}">
						{{ pageNumber }}
						</div>
					</div>
					<div ng-if="paginaActual[0] == paginas[0].length || current_section != 0 || appsFiltradasPrimaria.length < 1" style="opacity: 0.3; cursor: default;" class="p_actnavarrowright"></div>
					<div ng-if="paginaActual[0] != paginas[0].length && current_section == 0 && appsFiltradasPrimaria.length > 0" style="opacity: 1.0; cursor: pointer;" class="p_actnavarrowright" ng-click="changePage(paginaActual[0]+1)">
					</div>
				</div>
				<!-- Se muestran las actividades de Secundaria -->
				<div class="p_articleconte">
					<div class="p_articletitle">Secundaria</div>
					<div class="p_articleline"></div>
					<div class="p_act2center">
						<div style="min-height: 406px;">
							<!-- Actividades -->
							<div class="p_act4box bounceIn" ng-repeat="aplicacion in appsFiltradasSecundaria"
								ng-mouseenter="getAppObjetivos(aplicacion)">
								<div class="p_recienteboximg" ng-class="movil?'p_resalteminiatura_over':'p_resalteminiatura'">
									<div class="p_recienteboxminiatura">
										<img ng-src="{{getAppThumbnail(aplicacion.p)}}">
										<div class="p_recienteboxicon"
											ng-class="[{
												'aplicacion' :'p_recienteboxicon_app',
												'aplicacionL':'p_recienteboxicon_appL',
												'video'      :'p_recienteboxicon_video',
												'videoT'     :'p_recienteboxicon_video',
												'lectura'    :'p_recienteboxicon_lectura',
												'evaluacionC':'p_recienteboxicon_evalC',
												'simuladorCL':'p_recienteboxicon_app'
											}[aplicacion.c]]"></div>
										<div class="p_recienteboxlight"></div>
										<div class="p_recienteinfo">
											<div class="p_recienteinfoplay">
												<div class="p_recienteinfoplayicon" ng-click="getAppClickAction(aplicacion)">
													<svg viewBox="0 0 148.253 150">
														<g><path fill-rule="evenodd" clip-rule="evenodd" d="M74.027,0.058c37.036-1.606,74.318,30.537,74.226,74.878c-0.088,43.053-35.125,75.344-74.689,75.063c-37.865-0.27-72.181-29.865-73.515-70.935C-1.431,33.571,30.971,0.058,74.027,0.058z"></path></g>
														<g><path d="M76.697,0v4c16.848,0,33.871,7.376,46.707,20.239c13.484,13.513,20.89,31.514,20.85,50.688c-0.039,19.33-7.558,37.359-21.17,50.766C109.979,138.598,92.117,146,74.077,146l-0.484-0.002c-17.726-0.126-34.686-6.907-47.757-19.093C12.382,114.364,4.645,97.327,4.047,78.934C3.36,57.809,10.37,38.542,23.787,24.682c12.874-13.3,30.716-20.624,50.241-20.624c0.058,0,0.116-0.001,0.173-0.004C75.023,4.018,75.861,4,76.692,4L76.697,0 M76.691,0c-0.886,0-1.777,0.019-2.664,0.058c-43.057,0-75.458,33.514-73.979,79.006c1.334,41.069,35.65,70.665,73.515,70.935C73.735,150,73.906,150,74.077,150c39.354,0,74.089-32.198,74.177-75.065C148.343,31.655,112.832-0.003,76.691,0L76.691,0z"></path></g>
														<path d="M103.804,71.464L69.521,37.181c-1.43-1.43-3.581-1.857-5.449-1.084c-1.868,0.774-3.086,2.597-3.086,4.62v68.567c0,2.022,1.218,3.846,3.086,4.619c0.619,0.257,1.269,0.381,1.913,0.381c1.301,0,2.58-0.508,3.537-1.465l34.283-34.283C105.757,76.583,105.757,73.417,103.804,71.464z"></path>
													</svg>
												</div>
											</div>
											<div class="p_recienteinfotitle">{{aplicacion.n}}</div>
											<div class="p_recienteinfoobjetivos" ng-if="!movil">
												<ul>
													<li ng-repeat="objetivo in current_app_objectives">• {{objetivo}}</li>
												</ul>
											</div>
											<div class="p_primerGradient" ng-if="!movil"></div>
											<div class="p_segundoGradient" ng-if="!movil"></div>
										</div>
									</div>
								</div>
								<div class="p_recienteboxtxt">{{aplicacion.n}}</div>
							</div>
							<!-- Cuando no se encuentran actividades -->
							<div ng-if="appsFiltradasSecundaria.length === 0">
								<table  style="display: table;width:100%;">
									<tr>
										<td class="p_conte_notificacionn">No se encontraron resultados.</td>
									</tr>
								</table>
							</div>
						</div>
						<div class = "p_actfondo"></div>
					</div>
				</div>
				<!-- Paginación -->
				<div class="p_actnavcenter">
					<div ng-if="paginaActual[1] == 1 || current_section != 1 || appsFiltradasSecundaria.length < 1" style="opacity: 0.3; cursor: default;" class="p_actnavarrowleft"></div>
					<div ng-if="paginaActual[1] != 1 && current_section == 1 && appsFiltradasSecundaria.length > 0" style="opacity: 1.0; cursor: pointer;" class="p_actnavarrowleft" ng-click="changePage(paginaActual[1]-1)"></div>
					<div style="float:left;">
						<div ng-if="current_section == 1" class="p_actnavnum"
						ng-repeat="pageNumber in pages = (paginasFiltradas[1] | orderBy)"
						ng-class="{ p_actnavnum_active : paginaActual[1] == pageNumber}"
						ng-click="changePage(pageNumber)">
						{{ pageNumber }}
						</div>
						<div ng-if="current_section != 1" class="p_actnavnum p_actnavnum_active_locked"
						ng-repeat="pageNumber in pages = (paginasFiltradas[1] | orderBy)"
						ng-class="{ p_actnavnum_active : paginaActual[1] == pageNumber}">
						{{ pageNumber }}
						</div>
					</div>
					<div ng-if="paginaActual[1] == paginas[1].length || current_section != 1 || appsFiltradasSecundaria.length < 1" style="opacity: 0.3; cursor: default;" class="p_actnavarrowright"></div>
					<div ng-if="paginaActual[1] != paginas[1].length && current_section == 1 && appsFiltradasSecundaria.length > 0" style="opacity: 1.0; cursor: pointer;" class="p_actnavarrowright" ng-click="changePage(paginaActual[1]+1)">
					</div>
				</div>
			</div>
		</article>
		<article class="p_article" style="display: block;" ng-show="materias.length > 1">
			<div class="p_actividadesregresar">
				<div class="p_regresarbtn" ng-click="lookTo('primaria')">
					<div class="p_regresaricon">
						<div id="linea1"></div>
						<div id="linea2"></div>
						<div id="linea3"></div>
					</div>
					<div class="p_regresartxt">Regresar al menú</div>
				</div>
			</div>
		</article>
	</div>
</section>