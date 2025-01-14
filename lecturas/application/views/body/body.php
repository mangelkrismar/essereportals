<input type = "hidden" value = "<?=$this->session->userdata('user_id')?>" id="rel_user">
<?php if(!$this->bandera_movil){ ?>
    <div id = "is_movil"></div>
<?php } ?>
<section class="p_section" id= "section_1" ng-init="cargaAppsDem()">
    <!-- Mensaje de carga -->
    <div ng-if="!aplicacionesDem">
        <article class="p_article">
            <div class="p_articlecenter">
                    <div class="p_articletitle">Cargando actividades</div>
                    <div class="p_articleline"></div>
                    <div class="p_articleconte" style="height: 700px;">
                    </div>
                </div>
        </article>
    </div>
    <!-- Las aplicaciones han sido cargadas -->
    <div ng-show="aplicacionesDem">
        <!-- Se muestran las actividades -->
        <article class="p_article bounceInLeft">
            <div class="p_articlecenter">
                <div class="p_articletitle">Conoce nuestras actividades</div>
                <!-- Se muestran las actividades de primaria -->
                <div class="p_articleconte">
                    <div class="p_articletitle">Primaria</div>
                    <div class="p_articleline"></div>
                    <div class="p_conocecenter">
                        <div style="min-height: 424px;">
                            <!-- Actividades -->
                            <div class="p_act4box bounceIn" ng-repeat="ap in appsFiltradasPrimaria track by $index">
                                <div class="p_recienteboximg" ng-class="movil?'p_resalteminiatura_over':'p_resalteminiatura'">
                                    <div class="p_recienteboxminiatura">
                                        <img ng-src="{{getAppThumbnail(ap['prefijo'])}}">
                                        <div class="p_recienteboxicon"
                                            ng-class="[{
                                                'app' :'p_recienteboxicon_app',
                                                'aplicacion' :'p_recienteboxicon_app',
                                                'aplicacionL':'p_recienteboxicon_appL',
                                                'video'      :'p_recienteboxicon_video',
                                                'videoT'     :'p_recienteboxicon_video',
                                                'lectura'    :'p_recienteboxicon_lectura',
                                                'evaluacionC':'p_recienteboxicon_evalC',
                                                'simuladorCL':'p_recienteboxicon_app'
                                            }[ap['categoria']]]"></div>
                                        <div class="p_recienteboxlight"></div>
                                        <div class="p_recienteinfo">
                                            <div class="p_recienteinfoplay">
                                                <div class="p_recienteinfoplayicon" ng-click="getAppClickAction(ap)">
                                                    <svg viewBox="0 0 148.253 150">
                                                        <g><path fill-rule="evenodd" clip-rule="evenodd" d="M74.027,0.058c37.036-1.606,74.318,30.537,74.226,74.878c-0.088,43.053-35.125,75.344-74.689,75.063c-37.865-0.27-72.181-29.865-73.515-70.935C-1.431,33.571,30.971,0.058,74.027,0.058z"></path></g>
                                                        <g><path d="M76.697,0v4c16.848,0,33.871,7.376,46.707,20.239c13.484,13.513,20.89,31.514,20.85,50.688c-0.039,19.33-7.558,37.359-21.17,50.766C109.979,138.598,92.117,146,74.077,146l-0.484-0.002c-17.726-0.126-34.686-6.907-47.757-19.093C12.382,114.364,4.645,97.327,4.047,78.934C3.36,57.809,10.37,38.542,23.787,24.682c12.874-13.3,30.716-20.624,50.241-20.624c0.058,0,0.116-0.001,0.173-0.004C75.023,4.018,75.861,4,76.692,4L76.697,0 M76.691,0c-0.886,0-1.777,0.019-2.664,0.058c-43.057,0-75.458,33.514-73.979,79.006c1.334,41.069,35.65,70.665,73.515,70.935C73.735,150,73.906,150,74.077,150c39.354,0,74.089-32.198,74.177-75.065C148.343,31.655,112.832-0.003,76.691,0L76.691,0z"></path></g>
                                                        <path d="M103.804,71.464L69.521,37.181c-1.43-1.43-3.581-1.857-5.449-1.084c-1.868,0.774-3.086,2.597-3.086,4.62v68.567c0,2.022,1.218,3.846,3.086,4.619c0.619,0.257,1.269,0.381,1.913,0.381c1.301,0,2.58-0.508,3.537-1.465l34.283-34.283C105.757,76.583,105.757,73.417,103.804,71.464z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="p_recienteinfotitle">{{ap['nombre']}}</div>
                                            <div class="p_recienteinfoobjetivos" ng-if="!movil">
                                                <ul>
                                                    <li ng-repeat="objetivo in arrayAuxObjetivos = (ap['objetivos'].split('||||'))">• {{objetivo}}</li>
                                                </ul>
                                            </div>
                                            <div class="p_primerGradient" ng-if="!movil"></div>
                                            <div class="p_segundoGradient" ng-if="!movil"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="p_recienteboxtxt">{{ap['nombre']}}</div>
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
                        <!-- Paginación -->
                        <div class="p_conocecenter">
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
                        </div>
                    </div>
                </div>
                <!-- Se muestran las actividades de Secundaria -->
                <div class="p_articleconte">
                    <div class="p_articletitle">Secundaria</div>
                    <div class="p_articleline"></div>
                    <div class="p_conocecenter">
                        <div style="min-height: 424px;">
                            <!-- Actividades -->
                            <div class="p_act4box bounceIn" ng-repeat="ap in appsFiltradasSecundaria track by $index">
                                <div class="p_recienteboximg" ng-class="movil?'p_resalteminiatura_over':'p_resalteminiatura'">
                                    <div class="p_recienteboxminiatura">
                                        <img ng-src="{{getAppThumbnail(ap['prefijo'])}}">
                                        <div class="p_recienteboxicon"
                                            ng-class="[{
                                                'app' :'p_recienteboxicon_app',
                                                'aplicacion' :'p_recienteboxicon_app',
                                                'aplicacionL':'p_recienteboxicon_appL',
                                                'video'      :'p_recienteboxicon_video',
                                                'videoT'     :'p_recienteboxicon_video',
                                                'lectura'    :'p_recienteboxicon_lectura',
                                                'evaluacionC':'p_recienteboxicon_evalC',
                                                'simuladorCL':'p_recienteboxicon_app'
                                            }[ap['categoria']]]"></div>
                                        <div class="p_recienteboxlight"></div>
                                        <div class="p_recienteinfo">
                                            <div class="p_recienteinfoplay">
                                                <div class="p_recienteinfoplayicon" ng-click="getAppClickAction(ap)">
                                                    <svg viewBox="0 0 148.253 150">
                                                        <g><path fill-rule="evenodd" clip-rule="evenodd" d="M74.027,0.058c37.036-1.606,74.318,30.537,74.226,74.878c-0.088,43.053-35.125,75.344-74.689,75.063c-37.865-0.27-72.181-29.865-73.515-70.935C-1.431,33.571,30.971,0.058,74.027,0.058z"></path></g>
                                                        <g><path d="M76.697,0v4c16.848,0,33.871,7.376,46.707,20.239c13.484,13.513,20.89,31.514,20.85,50.688c-0.039,19.33-7.558,37.359-21.17,50.766C109.979,138.598,92.117,146,74.077,146l-0.484-0.002c-17.726-0.126-34.686-6.907-47.757-19.093C12.382,114.364,4.645,97.327,4.047,78.934C3.36,57.809,10.37,38.542,23.787,24.682c12.874-13.3,30.716-20.624,50.241-20.624c0.058,0,0.116-0.001,0.173-0.004C75.023,4.018,75.861,4,76.692,4L76.697,0 M76.691,0c-0.886,0-1.777,0.019-2.664,0.058c-43.057,0-75.458,33.514-73.979,79.006c1.334,41.069,35.65,70.665,73.515,70.935C73.735,150,73.906,150,74.077,150c39.354,0,74.089-32.198,74.177-75.065C148.343,31.655,112.832-0.003,76.691,0L76.691,0z"></path></g>
                                                        <path d="M103.804,71.464L69.521,37.181c-1.43-1.43-3.581-1.857-5.449-1.084c-1.868,0.774-3.086,2.597-3.086,4.62v68.567c0,2.022,1.218,3.846,3.086,4.619c0.619,0.257,1.269,0.381,1.913,0.381c1.301,0,2.58-0.508,3.537-1.465l34.283-34.283C105.757,76.583,105.757,73.417,103.804,71.464z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="p_recienteinfotitle">{{ap['nombre']}}</div>
                                            <div class="p_recienteinfoobjetivos" ng-if="!movil">
                                                <ul>
                                                    <li ng-repeat="objetivo in arrayAuxObjetivos = (ap['objetivos'].split('||||'))">• {{objetivo}}</li>
                                                </ul>
                                            </div>
                                            <div class="p_primerGradient" ng-if="!movil"></div>
                                            <div class="p_segundoGradient" ng-if="!movil"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="p_recienteboxtxt">{{ap['nombre']}}</div>
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
                        <!-- Paginación -->
                        <div class="p_conocecenter">
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