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
					<input class="p_buscadorinput" placeholder="Buscar actividades educativas" ng-model="filtros.buscador" ng-click="mostrarApps()">
					<div class="content-lupa" ng-if="!verApps" ng-click="mostrarApps()">
						<div class="circleLupa"></div>
						<div class="mangoLupa"></div>
					</div>
					<div class="content-lupa" ng-show="verApps" ng-click="ocultarApps()">
						<div class="circleLupa transitLupa"></div>
						<div class="mangoLupa transitMango"></div>
					</div>
				</div>
				<!-- Filtro Móvil o PC -->
				<?php if(!$this->bandera_movil){ ?>
					<div class="p_switch" style="display: block;" ng-show="false" ng-show="verApps" ng-click="toggleNoFlash()">
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
		</article>
		<!-- Lo mas reciente, selecciona grado y asignatura -->
		<div class="bounceInLeft" ng-show="!verApps">
			<!-- Lo más reciente -->
			<article class="p_article" id="reciente">
				<div class="p_articlecenter">
					<div class="p_articletitle">Lo más reciente</div>
					<div class="p_articleline"></div>
					<div class="p_articleconte">
						<div class="p_recientecenter">
							<div class="p_recienteapps">
								<div class="p_recientescroll" id = "apps_demo_reciente">
									<? foreach ($apps_reciente as $app){ ?>
										<div class="p_recientebox p_iniciacarga">
											<div class="p_recienteboximg p_resalteminiatura_over">
												<div class="p_recienteboxminiatura " >
													<img src = "<?= $this->config->item('krismar_apps_url') ?>src/img/miniatura/<?=$app->prefijo?>.png"/>
													<div class="p_recienteboxicon p_recienteboxicon_<?=$app->categoria?>"></div>
													<div class="p_recienteboxlight"></div>
													<div class="p_recienteinfo">
														<div class="p_recienteinfoplay" ng-mouseleave="showHideElement('classroomShareBtn1<?=$app->id_aplicacion?>-cr', 'h')" ng-mouseenter="showHideElement('classroomShareBtn1<?=$app->id_aplicacion?>-cr', 's')">
															<!-----GOOGLE CLASSROOM---->
															<div hidden="true" id="classroomShareBtn1<?=$app->id_aplicacion?>-cr" class="classroomShareBtn1">
															</div>
															<!-----                ---->
														<!--<div class="p_recienteinfoplay">
															<div class="classroomShareBtn1" ng-click="shareToGClass2(<?=$app->id_aplicacion?>,'<?=$app->nombre?>','<?=$app->prefijo?>')">
															</div>-->
															<div class="p_recienteinfoplayicon " onclick = "playDemo(<?=$app->id_aplicacion?>, '<?=$app->nombre?>', 'Lo más reciente')">
																<svg viewBox="0 0 148.253 150">
																	<g><path fill-rule="evenodd" clip-rule="evenodd" d="M74.027,0.058c37.036-1.606,74.318,30.537,74.226,74.878c-0.088,43.053-35.125,75.344-74.689,75.063c-37.865-0.27-72.181-29.865-73.515-70.935C-1.431,33.571,30.971,0.058,74.027,0.058z"></path></g>
																	<g><path d="M76.697,0v4c16.848,0,33.871,7.376,46.707,20.239c13.484,13.513,20.89,31.514,20.85,50.688c-0.039,19.33-7.558,37.359-21.17,50.766C109.979,138.598,92.117,146,74.077,146l-0.484-0.002c-17.726-0.126-34.686-6.907-47.757-19.093C12.382,114.364,4.645,97.327,4.047,78.934C3.36,57.809,10.37,38.542,23.787,24.682c12.874-13.3,30.716-20.624,50.241-20.624c0.058,0,0.116-0.001,0.173-0.004C75.023,4.018,75.861,4,76.692,4L76.697,0 M76.691,0c-0.886,0-1.777,0.019-2.664,0.058c-43.057,0-75.458,33.514-73.979,79.006c1.334,41.069,35.65,70.665,73.515,70.935C73.735,150,73.906,150,74.077,150c39.354,0,74.089-32.198,74.177-75.065C148.343,31.655,112.832-0.003,76.691,0L76.691,0z"></path></g>
																	<path d="M103.804,71.464L69.521,37.181c-1.43-1.43-3.581-1.857-5.449-1.084c-1.868,0.774-3.086,2.597-3.086,4.62v68.567c0,2.022,1.218,3.846,3.086,4.619c0.619,0.257,1.269,0.381,1.913,0.381c1.301,0,2.58-0.508,3.537-1.465l34.283-34.283C105.757,76.583,105.757,73.417,103.804,71.464z"></path>
																</svg>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="p_recienteboxtxt"><?=$app->nombre?></div>
										</div>
									<? } ?>
								</div>
							</div>
							<div class="p_recientebotones">
								<div class="p_recientebtncenter" id="center">
									<div class="p_recientebtn"></div>
									<div class="p_recientebtn "></div>
									<div class="p_recientebtn"></div>
									<div class="p_recientebtn"></div>
								</div>
							</div> 
						</div>
					</div>
				</div>
			</article>
			<!-- Asignaturas -->
			<article class="p_article" id="temas">
				<div class="p_articlecenter">
					<div class="p_articletitle">Campos formativos</div>
					<div class="p_articleline"></div>
					<div class="p_articleconte">
						<div class="p_temascenter">
							<div class="p_temasbox bounceInLeft" ng-repeat="grupoMaterias in materias|orderBy:'n'|groupBy:'n'">
								<div class="p_temasboximg" ng-click="filtrarCurso('materias',grupoMaterias); mostrarApps()">
									<div class="p_temasboxicon {{clasePTema(grupoMaterias[0].n)}}">
										<div class="p_temasboxlight"></div>
									</div>
								</div>
								<div class="p_temasboxtxt">{{grupoMaterias[0].n}}</div>
							</div>
						</div>
					</div>
				</div>
			</article>
			<!-- Grados -->
			<article class="p_article" id="grados" ng-if="grados.length > 1">
				<div class="p_articlecenter">
					<div class="p_articletitle">Grados</div>
					<div class="p_articleline"></div>
					<div class="p_articleconte">
						<div class="p_gradoscenter">
							<div class="p_gradosbox" ng-repeat="grado in grados">
								<div class="p_gradosicon {{clasePTema(grado.n)}}" ng-click="filtrarCurso('grados',[grado]); mostrarApps()">
									<div class="p_gradosboxlight"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</article>
		</div>
		<!-- Se muestran las actividades -->
		<article class="p_article bounceInLeft" ng-show="verApps">
			<div class="p_articlecenter">
				<div class="p_articletitle">Nuestras actividades</div>
				<div class="p_articleline"></div>
				<div class="p_articleconte">
					<!-- Botones para filtrar grados, materias y bloques -->
					<div class="p_actividadesmenu">
						<!-- Grados -->
						<div class="p_actividadesmenubtn p_opcionuno"
							ng-class="{'p_actividadesmenubtn_active_left':verGrados, 'p_actividadesmenubtn_over':filtros.grados}"
							ng-if="grados.length > 1"
							ng-click="mostrarMenu('grados')">
							<div class="p_actmenubtnimg p_actmenuimg {{clasePTema(filtros.grados[0].n)}}"></div>
							<div class="p_actmenubtntxt">Grados</div>
						</div>
						<!-- Asignaturas -->
						<div class="p_actividadesmenubtn"
							ng-class="{'p_actividadesmenubtn_active':verMaterias, 'p_actividadesmenubtn_over':filtros.materias , 'p_opcionuno':grados.length == 1, 'p_opciondos':grados.length > 1}"
							ng-style="estiloBotonFiltro"
							ng-click="mostrarMenu('materias')">
							<!--<div class="p_actmenubtnimg p_actmenuimg {{clasePTema(filtros.materias[0].n)}}"></div>--->
							<div class="p_actmenubtntxt">{{ filtros.materias ? filtros.materias[0].n: 'Campos formativos'}}</div>
						</div>
						<!-- Temas -->
						<div class="p_actividadesmenubtn p_opciontres"
							ng-class="{'p_actividadesmenubtn_active_right':verBloques, 'p_actividadesmenubtn_over':filtros.tema}"
							ng-style="estiloBotonFiltro"
							ng-click="mostrarMenu('bloques')">
							<div class="p_actmenubtnimg"></div>
							<div class="p_actmenubtntxt">{{ filtros.tema ? filtros.tema: 'Temas'}}</div>
						</div>
					</div>
					<!-- Selecciona categoria (aplicacion, video, lectura o evaluacion) -->
					<div class="p_actividadescateg">
						<div class="p_actividadescategopcion" ng-class="{'p_actividadescategopcion_select':catLectura}">
							<div class="p_actividadescategicon p_categlec tooltip" ng-click="toggleCategoria('lectura')">
								<span class="tooltiptext">Teoría</span>
								<div class="p_iconcateg"></div>
							</div>
						</div>
						<div class="p_actividadescategopcion" ng-class="{'p_actividadescategopcion_select':catVideo}">
							<div class="p_actividadescategicon p_categvid tooltip" ng-click="toggleCategoria('video')">
								<span class="tooltiptext">Animación</span>
								<div class="p_iconcateg"></div>
							</div>
						</div>
						<div class="p_actividadescategopcion" ng-class="{'p_actividadescategopcion_select':catAplicacion}">
							<div class="p_actividadescategicon p_categapp tooltip" ng-click="toggleCategoria('aplicacion')">
								<span class="tooltiptext">App. Interactiva</span>
								<div class="p_iconcateg"></div>
							</div>
						</div>
						<div class="p_actividadescategopcion" ng-class="{'p_actividadescategopcion_select':catEvaluacion}">
							<div class="p_actividadescategicon p_categeva tooltip" ng-click="toggleCategoria('evaluacion')">
								<span class="tooltiptext">Evaluación</span>
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
					<div class="p_act2center">
						<div style="min-height: 406px;">
							<!-- Actividades -->
							<div class="p_act4box bounceIn"
								dir-paginate="aplicacion in appsFiltradas = (aplicaciones
									|filter: filtrarFlash
									|filter: filtrarCategorias
									|filter: filtrarGrados
									|filter: filtrarMaterias
									|filter: filtros.tema
									|filter: filtros.buscador
									|unique: 'i'
									|orderBy: dynamicOrder)
									|itemsPerPage: actividadesPorPagina(windowWidth)"
								current-page="pagination.current"
								ng-mouseenter="getAppObjetivos(aplicacion)">
								<!-----GOOGLE CLASSROOM---->
								<div class="p_recienteboximg" ng-class="movil?'p_resalteminiatura_over':'p_resalteminiatura'">
								<!-----                ---->
								<!--<div class="p_recienteboximg" ng-class="movil?'p_resalteminiatura_over':'p_resalteminiatura'">-->
									<div class="p_recienteboxminiatura">
										<img ng-src="{{getAppThumbnail(aplicacion.p)}}">
										<div class="p_recienteboxicon"
											ng-class="getClassForCategoria(aplicacion.c)"></div>
										<div class="p_recienteboxlight"></div>
										<div class="p_recienteinfo">
											<div class="p_recienteinfoplay">
												<!-----GOOGLE CLASSROOM---->
												<div id="{{'classroomShareBtn1'+aplicacion.i}}"class="classroomShareBtn2"></div>
												<!-----                ---->
												<!--<div ng-id="{{'appContainer'+aplicacion.i}}" class="classroomShareBtn2" ng-click="shareToGClass(aplicacion)">
												</div>-->
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
							<table class="p_conte_notificacion" style="min-height: 428px; display: table;" ng-if="appsFiltradas.length == 0">
								<tr>
									<td>No se encontraron resultados.</td>
								</tr>
							</table>
						</div>
						<div class = "p_actfondo"></div>
						<!-- Paginación -->
						<dir-pagination-controls
							ng-if="appsFiltradas.length > 0"
							template-url="src/angular/pagination/portalPagination.tpl.html"
							max-size="5"
							auto-hide="false">
						</dir-pagination-controls>
						<!-- Selecciona grado, materia y bloque -->
						<div class="p_actdesplegable" style="display: block;" ng-if="verMenu">
							<div class="p_actconte">
								<!-- Grados -->
								<div class="p_actcontein" style="display: table;" ng-if="verGrados">
									<div class="p_actgrados"
										ng-class="{'p_actgrados_over':filtros.grados[0].n == grado.n}"
										ng-repeat="grado in grados|filter: filtrarGradosConMateria">
										<div class="p_actgradosin {{ clasePTema(grado.n) }}"
											ng-click="filtrarCurso('grados',[grado]); ocultarMenu()">
											<div class="p_gradosboxlight"></div>
										</div>
									</div>
								</div>
								<!-- Materias -->
								<div class="p_actcontein" style="display: table;" ng-if="verMaterias">
									<div class="p_acttemas"
										ng-class="{'p_acttemas_over':filtros.materias[0].n == grupoMaterias[0].n}"
										ng-repeat="grupoMaterias in materias|filter: filtrarMateriasConGrado|orderBy:'n'|groupBy:'n'"
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
										ng-if="filtros.materias"
										ng-class="{'p_actsubtemas_over':filtros.tema == tema}"
										ng-repeat="tema in testTemas = filtrarTemasEnMateria()"
										ng-click="filtrarCurso('tema',tema); ocultarMenu()">
										</table>
										<div class="p_actsubtemasicon" >
											<div class="p_actsubtemasiconin"></div>
										</div>
										<table class="p_actsubtemastxt">
											<tr>
												<td>{{tema}}</td>
											</tr>
										</table>
									</div>
									<div class="p_actsubtemas" ng-if="testTemas.length==0 && filtros.materias">
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
												<td>Selecciona un campo formativo para ver los temas.</td>
											</tr>
										</table>
									</div>
								</div>
							</div>
							<div class="p_actclosemove">
								<div class="p_actclosemovecenter"></div>
							</div>
							<div class="p_actclose" ng-click="ocultarMenu()"></div>
						</div>
					</div>
				</div>
			</div>
			<article class="p_article" style="display: block;">
				<div class="p_actividadesregresar">
					<div class="p_regresarbtn" ng-click="ocultarApps()">
						<div class="p_regresaricon">
							<div id="linea1"></div>
							<div id="linea2"></div>
							<div id="linea3"></div>
						</div>
						<div class="p_regresartxt">Regresar al menú</div>
					</div>
				</div>
			</article>
		</article>
	</div>
	<!--LIBROS-->
	<article class="p_article" id="libros_sep">
		<div class="p_articlecenter">
			<div class="p_articletitle">Libros SEP</div>
			<div class="p_articleline"></div>
			<div class="p_articleconte">
				<div class="p_gradoscenter">
					<ol id="lista2"></ol>
				</div>
			</div>
		</div>
	</article>
	<!-----GOOGLE CLASSROOM---->
    <article class="p_article" id="GRcontainer">
        <div class="p_articlecenter">
            <div class="p_articletitle">Reportes de Google Classroom</div>
            <div class="p_articleline"></div>
            <div class="p_articleconte">
                <div class="p_gradoscenter">
                    <div id="lista4">
                        <div class="gReportList">
                                <div class="gRlistbody">
                                    <span class="gRlistbodyName"></span>
                                    <br/>
                                    <div class="content-select"> 
                                        <select id="GRIdForReport"></select>
                                    </div>
                                    <div class="btngR" onclick="GRgetReporteP1()">Generar reporte</div>
                                    <br/>
                                    <br/>
                                    <div class="btngR2" onclick="GRchangeAccount()">
                                    	<div class="btngR2img"><img src="src/img/glogo.png"></div>
                                    	<div class="btngR2txt">Cambiar de cuenta Google</div>
                                	</div>
                                </div>
                                <div class="gRlistNotice"></div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
    <!-----              ---->
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