<!--
SECTION
-->
<section class="p_section p_oculta" id= "section_2">
    <article class="p_article" >
        <div class="p_articlecenter">
            <div class="p_configicon">
                <div class="p_configiconcontent" onclick="muestraOcultaConfiguracion(false)">
                    <div class="p_configiconimgregresar"></div>
                    <table class="p_configicontxt"><tr><td>Regresar</td></tr></table>
                </div>
            </div>
            <div class="p_articletitle">Configuración</div>
            <div class="p_articleline"></div>
            <div class="p_articleconte">
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
    <article class="p_article" id = "second_config" >
        <div class="p_articlecenter">
            <div class="p_articletitle" id="titulo" seleccion = "2">Selecciona actividades</div>
            <div class="p_articleline"></div>
			
            <div class="p_articleconte">

                <div class="p_buscador p_buscardorconfig">
                    <input id = "pal_bus" class="p_buscadorinput" onkeyup = "filtrarKeyupC(this.value);" type = "text" placeholder="Buscar actividades.">
                    <div class="p_buscadoricon"></div>
                </div>


                <!--<div class = "p_filtros_sel">
                    select class = "p_filtro_asigna">
                        <option>Asignatura</option>
                        <option>Español</option>
                        <option>Matemáticas</option>
                    </select

                    <input id = "pal_bus" class = "p_filtro_input" onkeyup = "filtrar($(this), 'teclado')" type = "text" placeholder = "Buscar" />
                    <div class = "p_icon_busca"></div>
                </div>-->


                <div class = "p_filtros_sel">
                    <div class = "p_btn_filtro" onclick = "seleccionaCategoriaC('aplicacion')" categoria = "aplicacion"><div class="p_filtroslight"></div></div>
                    <div class = "p_btn_filtro" onclick = "seleccionaCategoriaC('lectura')" categoria = "lectura"><div class="p_filtroslight"></div></div>
                    <div class = "p_btn_filtro" onclick = "seleccionaCategoriaC('video')" categoria = "video"><div class="p_filtroslight"></div></div>
                    <div class = "p_btn_filtro" onclick = "seleccionaCategoriaC('evaluacion')" categoria = "evaluacion"><div class="p_filtroslight"></div></div>
                </div>

                <div class = "p_conte_limpia">
                    <div class = "p_limpia_filtros" onclick = "limpiaFiltrosC()">Limpia filtros</div>
                </div>
                <article class="p_article" >
                    <div class="p_articlecenter">
                        <div class="p_articleconte" id = "activs_config">
                            <!--div class="p_actcenter" id = "activs" style="display:none;"></div-->

                            <div class="p_act2center" id = "activs" >
                            <!--AQUI VAN LAS APLICACIONES-->
                            </div>

                            <!--   </div>-->

                        </div>
                    </div>
                </article>
                <div class="p_actbtnnav">
                    <div class="p_actnavcenter" id = "numerospc">
                        <div class="p_actnavarrowleft"></div>
                        <div class="p_actnavnum">1</div>
                        <div class="p_actnavnum p_actnavnum_active">2</div>
                        <div class="p_actnavnum">3</div>
                        <div class="p_actnavnum">4</div>
                        <div class="p_actnavnum">...</div>
                        <div class="p_actnavarrowright"></div>
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
</section>
