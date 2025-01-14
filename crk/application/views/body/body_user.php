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
					<div class="p_switch" style="display: none;" ng-show="verApps" ng-click="toggleNoFlash()">
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
		<!-- Se muestran las actividades -->
		<article class="p_article bounceInLeft" ng-show="verApps">
			<div class="p_articlecenter">
				<div class="p_articleconte">
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
							<div class="p_actividadescategicon p_categsim tooltip" ng-click="toggleCategoria('simulador')">
								<span class="tooltiptext">Simulador</span>
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
								<div ng-mouseenter="enviaGClass(false, aplicacion)" class="p_recienteboximg" ng-class="movil?'p_resalteminiatura_over':'p_resalteminiatura'">
								<!-----                ---->
								<!--<div class="p_recienteboximg" ng-class="movil?'p_resalteminiatura_over':'p_resalteminiatura'">-->
									<div class="p_recienteboxminiatura" ng-class="{'p_appBlocked':!logged_in}">
										<img ng-src="{{getAppThumbnail(aplicacion.p)}}">
										<div class="p_recienteboxicon"
											ng-class="[{
												'aplicacion' :'p_recienteboxicon_app',
                                                'aplicacionCL':'p_recienteboxicon_app',
												'aplicacionL':'p_recienteboxicon_appL',
												'video'      :'p_recienteboxicon_video',
												'videoT'     :'p_recienteboxicon_video',
												'lectura'    :'p_recienteboxicon_lectura',
												'evaluacionC':'p_recienteboxicon_evalC',
                                                'evaluacionE':'p_recienteboxicon_evalC',
                                                'evaluacionP':'p_recienteboxicon_evalC',
                                                'evaluacionD':'p_recienteboxicon_evalC',
                                                'simuladorI':'p_recienteboxicon_simuladorCL',
                                                'simuladorcrk':'p_recienteboxicon_simuladorCL',
                                                'simuladorLabSol':'p_recienteboxicon_simuladorCL',
                                                'simuladorLabFuerzas':'p_recienteboxicon_simuladorCL',
                                                'simuladorLabGeometria':'p_recienteboxicon_simuladorCL',
												'simuladorCL':'p_recienteboxicon_simuladorCL'
											}[aplicacion.c]]"></div>
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
</section>