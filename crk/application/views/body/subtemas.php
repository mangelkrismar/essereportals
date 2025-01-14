<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width = device-width, maximum-scale = 1, user-scalable=no">
<title>KrismarApps</title>
<!--script type="text/javascript" src="<?echo base_url()?>src/sistema/js/web_apps.js"></script-->
<script type="text/javascript" src="<?echo base_url()?>src/js/config_subtemas.js"></script>
</head>
<body>	

<?php 
	//var_dump($apps_aprobadas->result());
?>
	<article class="p_article">
		<div class="p_articlecenter">
            <div class="p_articletitle" id="titulo_subtemas">Selecciona actividades</div>
            <div class="p_articleline"></div>
			
            <div class="p_articleconte">

                <div class="p_buscador p_buscardorconfig">
                    <input id = "pal_bus" class="p_buscadorinput" onkeyup = "/*filtrar($(this), 'teclado')*/" type = "text" placeholder="Buscar actividades.">
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
                    <div class = "p_btn_filtro" onclick = "/*filtrar($(this), 'aplicacion')*/"><div class="p_filtroslight"></div></div>
                    <div class = "p_btn_filtro" onclick = "/*filtrar($(this), 'lectura')*/"><div class="p_filtroslight"></div></div>
                    <div class = "p_btn_filtro" onclick = "/*filtrar($(this), 'video')*/"><div class="p_filtroslight"></div></div>
                    <div class = "p_btn_filtro" onclick = "/*filtrar($(this), 'evaluacion')*/"><div class="p_filtroslight"></div></div>
                </div>

                <div class = "p_conte_limpia">
                    <div class = "p_limpia_filtros" onclick = "limpiaFiltros()">Limpia filtros</div>
                </div>
                <article class="p_article" >
                    <div class="p_articlecenter">
                        <div class="p_articleconte" id = "activs_config">
                            <!--div class="p_actcenter" id = "activs" style="display:none;"></div-->

                            <div class="p_act2center" id = "subA" >
                            <?php
							
                               if($apps_aprobadas){
								   $apps_aprobadas = $apps_aprobadas->result();
                                   $contador=0;
                                   foreach($apps_aprobadas as $app){
                                       $contador++;
                                       switch($app->categoria){
                                            case "lectura":
                                                $imgIcon = "p_recienteiconlectura.png";
                                                $tipo_ap = "lectura";
                                                break;
                                            case "video":
                                                $imgIcon = "p_recienteiconvideo.png";
                                                $tipo_ap = "video";
                                                break;
                                            case "aplicacion":
                                            case "aplicacionL":
                                                ($app->categoria == "aplicacionL")
                                                ?
                                                    $imgIcon = "p_recienteiconaplicacionL.png"
                                                :
                                                    $imgIcon = "p_recienteiconaplicacion.png";


                                                $tipo_ap = "aplicacion";
                                                break;

                                            case "evaluacion":
                                            case "evaluacionC":
                                            case "evaluacionE":
                                                
                                                $tipo_ap = "evaluacion";
                                                ($app->categoria == "evaluacionC")?
                                                    $imgIcon = "p_recienteiconevaluacionC.png"
                                                :
                                                    $imgIcon = "p_recienteiconevaluacionE.png";

                                                break;
                                        }
                                        $flash = str_split($app->prefijo, 3);
                                    ?>

                              <div <?php if($flash[0] == "fla"){ ?> flash = "flash" <?php } ?> id = "app_sub<?=$contador?>" class="p_act2box" tipoapp = "<?=$tipo_ap?>" nombre = "<?=$app->nombre?>" prefijo = "<?=$app->prefijo?>" palabrascv = "<?=$app->palabras_clave?>">
                                <div class="p_recienteboximg p_resalteminiatura">
                                  <!-- style = "background-image:url(<?=base_url()?>src/img/miniaturas/<?=$contador?>.png);" -->
                                    <div class="p_recienteboxminiatura" imgsrc = "<?=base_url()?>">
                                      <img src = ""/>
                                        <div class="p_recienteboxicon" style = "background-image:url(<?=base_url()?>src/img/<?=$imgIcon?>)"></div>
                                        <div class = "p_recienteboxlight"></div>

                                        <div class="p_recienteinfo">

                                            <div class="p_recienteinfoplay">
                                                <div class="p_recienteinfoplayicon" onclick = "playDemo(<?=$app -> id_aplicacion?>)"></div>
                                            </div>
                                            <div class="p_recienteinfotitle"><?=$app -> nombre?></div>
                                            <div class="p_recienteinfoobjetivos">
                                                <ul>
                                                    <?php
                                                        $objetivos = trim($app->objetivos);
                                                        $objetivos = explode("-",$objetivos);

                                                        $objetivos = array_filter($objetivos);
                                                        /*$objetivos = implode(",", $objetivos);
                                                        $objetivos = explode(",", $objetivos);
                                                        $objetivos = array_filter($objetivos);*/
                                                        foreach($objetivos as $objetivo){
                                                            echo"<li>$objetivo</li>";
                                                        }
                                                    ?>
                                                </ul>
                                            </div>
                                            <input type ="checkbox" class="c_check2box" onchange = "/*changeMirror($(this))*/">
                                        </div>


                                    </div>
                                </div>
                                <div class="p_recienteboxtxt"><?=$app->nombre?></div>
                                <input type="checkbox" class="c_checkbox" onchange="/*registraApp('<?=$app->prefijo?>', $(this))*/">
                            </div>

                            <?php
                                   }
                               }else{
                                   echo "No se han cargado aplicaciones, contacte con el administrador.";
                               }
                            ?>



                            </div>

                            <!--   </div>-->
							
                        </div>
                    </div>
                </article>
                <div class="p_actbtnnav">
                    <div class="p_actnavcenter" id = "numerospc2">
                        <div class="p_actnavarrowleft"></div>
                        <div class="p_actnavnum">1</div>
                        <div class="p_actnavnum p_actnavnum_active">2</div>
                        <div class="p_actnavnum">3</div>
                        <div class="p_actnavnum">4</div>
                        <div class="p_actnavnum">...</div>
                        <div class="p_actnavarrowright"></div>
                    </div>
                </div>
                <div class ="c_agregarSeleccion" onclick = "/*agregaApps(false)*/">
                    <table class = "c_agregarSelecion_icon"><tr><td>Agregar actividades</td></tr></table>
                </div>
				
				
				
                
				
            </div>
			
        </div>
    </article>
	<article class="p_article">
        <div class="p_articlecenter">
            <div class="p_articletitle">Aplicaciones en portal primaria</div>
            <div class="p_articleline"></div>
            <div class="p_articleconte">
                
				<div class = "p_agregarfiltros">
					<!--GRADOS-->
					<div class = "p_columnafiltro">
						<div class = "p_selectFiltro1">Grado</div>
						<div class = "p_menufiltro p_menustyle" id = "menugr">
							<!--<div class = "p_txtfiltro">-->
								<?
									foreach($grados->result() as $grado){
								?>
								<div class = "p_txtfiltro"><input class="p_txtinput" type="checkbox"><?=$grado->nombre?></div>
								<?
									}
								?>
							<!--</div>-->
							<!--div class = "p_txtfiltro" onclick = "agregaGr(this)">Agregar</div-->
						</div>
					</div>
					<!--MATERIAS-->
					<div class = "p_columnafiltro">
						<div class = "p_selectFiltro2">Asignatura</div>
						<div class = "p_menufiltro2 p_menustyle" id = "menumt">
							<?
								foreach($materias->result() as $materia){
							?>
							<div onclick = "muestraAppsMateria(this.id)" id = "<?=$materia->id_materia_primaria?>" class = "p_txtfiltro"><input class="p_txtinput" type="checkbox"><?=$materia->nombre?></div>
							<?
								}
							?>
						</div>
					</div>
					<!--SUBTEMAS-->
					<div class = "p_columnafiltro">
						<div class = "p_selectFiltro3">Tema</div>
						<div class = "p_menufiltro p_menustyle" id = "menusb">
							<?
								foreach($subtemas->result() as $subtema){
							?>
							<div hidden id = "<?=$subtema->id_subtema?>" class = "p_txtfiltro" rel = "<?=$subtema->id_materia_primaria?>"><input class="p_txtinput" type="checkbox"><?=$subtema->nombre?></div>
							<?
								}
							?>
						</div>
					</div>
				</div>
	
	
				
				
				
				<!--div class="p_actividadesmenu">
					<div class="p_opcionuno p_actividadesmenubtn" id = "subtema_filtro" onclick = "abrirMenuFiltro('#grado_subtema')">
						<div class="p_actmenubtnimg" id = "img_grado"></div>
						<div class="p_actmenubtntxt" id = "subtema_app">Grado</div>
					</div>
					<div class="p_opciondos p_actividadesmenubtn" id = "subtema_filtro" onclick = "abrirMenuFiltro('#materia_subtema')">
						<div class="p_actmenubtnimg" id = "img_grado"></div>
						<div class="p_actmenubtntxt" id = "subtema_app">Materia</div>
					</div>
					<div class="p_opciontres p_actividadesmenubtn" id = "subtema_filtro" onclick = "abrirMenuFiltro('#subtema_subtema')">
						<div class="p_actmenubtnimg" id = "img_grado"></div>
						<div class="p_actmenubtntxt" id = "subtema_app">Subtemas</div>
					</div>
					
					
				</div>
				<div class="p_actividadescateg">
					<div class="p_actividadescategopcion">
						<div class="p_actividadescategicon p_categapp" id = "filtro_aplicacion" onclick = "/*cambiaFiltroCate('aplicacion',$(this))*/"></div>
					</div>
					<div class="p_actividadescategopcion">
						<div class="p_actividadescategicon p_categlec" id = "filtro_lectura" onclick = "/*cambiaFiltroCate('lectura',$(this))*/" ></div>
					</div>
					<div class="p_actividadescategopcion">
						<div class="p_actividadescategicon p_categvid" id = "filtro_video" onclick = "/*cambiaFiltroCate('video',$(this))*/"></div>
					</div>
					<div class="p_actividadescategopcion">
						<div class="p_actividadescategicon p_categeva" id = "filtro_evaluacion" onclick = "/*cambiaFiltroCate('evaluacion',$(this))*/"></div>
					</div>
					<div class="p_actividadescategtxt">
						<table><tr><td onclick = "/*limpiaFiltros()*/">Limpiar filtros</td></tr></table>
					</div>
				</div-->
				<div class="p_act2center" id = "subA2">
                    	<table class = "p_conte_notificacion">
                    		<tr>
                    			<td>
                    				No se encontrarón resultados.
                    			</td>
                    		</tr>
                    	</table>
                        <?php
						/*
						    if($apps_aprobadas){
                                   $contador=0;
                                   foreach($apps_aprobadas as $app_individual){
                                       
                                       switch($app_individual->categoria){
                                            case "lectura":
                                                $color="#FBBA00";
                                                $imgIcon = "p_recienteboxicon_lectura";
                                                $tipo_ap = "lectura";
                                                break;
                                            case "video":
                                                $color="#00A99D";
                                                $imgIcon = "p_recienteboxicon_video";
                                                $tipo_ap = "video";
                                                break;
                                            case "aplicacion":
                                            case "aplicacionL":
                                                $color="#7F3E7D";

                                                ($app_individual->categoria == "aplicacionL")
                                                ?
                                                    $imgIcon = "p_recienteboxicon_appL"
                                                :
                                                    $imgIcon = "p_recienteboxicon_app";


                                                $tipo_ap = "aplicacion";
                                                break;

                                            case "evaluacion":
                                            case "evaluacionC":
                                            case "evaluacionE":
                                                $color="#8CC63F";
                                                $tipo_ap = "evaluacion";
                                                ($app_individual->categoria == "evaluacionC")?
                                                    $imgIcon = "p_recienteboxicon_evalC"
                                                :
                                                    $imgIcon = "p_recienteboxicon_evalE";

                                                break;
                                        }
                                        //print_r(str_split($app_individual->prefijo, 3));//;
                                        $flash = str_split($app_individual->prefijo, 3);

                                        //if($app_movil && $flash[0] != "fla"){
                                          //continue;
                                        //}
										//si es pc
										
                                        if(($this->bandera_movil && $flash[0] != "fla") || !$this->bandera_movil){
										$contador++;
                                    ?>

							<!--style = "display:none"--> 
                              <div <?php if($flash[0] == "fla"){ ?> flash = "flash" <?php } ?> id = "app_sb<?=$contador?>" class="p_act4box" rel = "<?=$app_individual -> id_aplicacion?>" tipoapp = "<?=$tipo_ap?>" nombre = "<?=$app_individual->nombre?>" prefijo = "<?=$app_individual->prefijo?>" palabrascv = "<?=$app_individual->palabras_clave?>">
                                <div class="p_recienteboximg p_resalteminiatura">

                                    <div class="p_recienteboxminiatura" imgsrc = "<?=base_url()?>"><!--style = "background-image:url(<?=base_url()?>src/img/miniaturas/<?=$contador?>.png);"-->
                                        <img src = ""/>
                                        <!-- " style = "background-image:url( <?=base_url()?>src/img/<?=$imgIcon?> )" -->
                                        <div class="p_recienteboxicon <?=$imgIcon?>"></div>
                                        <div class = "p_recienteboxlight"></div>

                                        <div class="p_recienteinfo">

                                            <div class="p_recienteinfoplay">
                                                <div class="p_recienteinfoplayicon" <?php if($flash[0] == "fla"){ ?> flash = "<?=$app_individual->instrucciones?>" <?php } ?>></div>
                                            </div>
                                            <div class="p_recienteinfotitle"><?=$app_individual -> nombre?></div>
                                            <div class="p_recienteinfoobjetivos">
                                                <ul>
                                                    <?php
                                                        $objetivos = trim($app_individual->objetivos);
                                                        $objetivos = explode("-",$objetivos);

                                                        $objetivos = array_filter($objetivos);
                                                        //$objetivos = implode(",", $objetivos);
                                                        //$objetivos = explode(",", $objetivos);
                                                        //$objetivos = array_filter($objetivos);
                                                        $interConta = 0;

                                                        foreach($objetivos as $objetivo){

                                                            if($interConta <= 2){
                                                                echo"<li>*$objetivo</li>";
                                                            }
                                                            $interConta++;

                                                        }
                                                    ?>
                                                </ul>
                                            </div>
											<input type ="checkbox" class="c_check2box" onchange = "">
                                        </div>


                                    </div>
                                </div>
                                <div class="p_recienteboxtxt"><?=$app_individual->nombre?></div>
								<input type="checkbox" class="c_checkbox" onchange="">
                            </div>

                            <?php
                          }
                                   }
                               }else{
                                   echo "No se han cargado aplicaciones, contacte con el administrador.";
                               }*/
                            ?>
                        <!--<div class="p_actbox">
                            <div class="p_actboximg">
                                <div class="p_actboxminiatura">
                                    <div class="p_actboxicon"></div>
                                    <div class="p_actboxin"></div>
                                    <div class="p_actbrillo"></div>
                                </div>
                            </div>
                            <div class="p_actboxtxt">Apago la televisión cuando me lo indican.</div>
                        </div>-->

                    </div>
				<div class="p_actbtnnav">
		<div class="p_actnavcenter" id = "nav_2">
			<div class="p_actnavarrowleft"></div>
			<div class="p_actnavnum">1</div>
			<div class="p_actnavnum p_actnavnum_active">2</div>
			<div class="p_actnavnum">3</div>
			<div class="p_actnavnum">4</div>
			<div class="p_actnavnum">...</div>
			<div class="p_actnavarrowright"></div>
		</div>
	</div>
	<div class = "p_actdesplegable" id = "desp_sub">
						<div class="p_actconte">
								
							<!--Grados-->
							
							<div class="p_actcontein" id = "grado_subtema">
								
								<div class="p_actsubtemas">
									<div class="p_actsubtemasicon">
										<div class="p_actsubtemasiconin"></div>
									</div>
									<table class="p_actsubtemastxt"><tbody><tr><td>Agregar</td></tr></tbody></table>
								</div>
							</div>
							
							<!--Materia-->
							<div class="p_actcontein" id = "materia_subtema">
								
								<div class="p_actsubtemas">
									<div class="p_actsubtemasicon">
										<div class="p_actsubtemasiconin"></div>
									</div>
									<table class="p_actsubtemastxt"><tbody><tr><td>Agregar</td></tr></tbody></table>
								</div>
							</div>
							
							<!--Subtema-->
							<div class="p_actcontein" id = "subtema_subtema">
								
								<div class="p_actsubtemas">
									<div class="p_actsubtemasicon">
										<div class="p_actsubtemasiconin"></div>
									</div>
									<table class="p_actsubtemastxt"><tbody><tr><td>Agregar</td></tr></tbody></table>
								</div>
							</div>
						</div>
						<div class="p_actclosemove">
							<div class="p_actclosemovecenter" onclick = "cerrarMenuFiltro()"></div>
						</div>
						<div class="p_actclose" onclick = "cerrarMenuFiltro()"></div>
					</div>
	<div class ="c_agregarSeleccion" onclick = "agregaApps(false)">
		<table class = "c_agregarSelecion_icon"><tr><td>Agregar actividades</td></tr></table>
	</div>
                <!--div class = "p_caja_actividades">
                    <div class="c_movericons" id="moverIcon">
                        <div id="moverApp" class="c_movericonscenter" style="display: table;">
                            <table id="mover" class="c_moveraplicacion"><tr><td>Mover aplicación</td></tr></table>
                            <div id="moveL" class="c_iconleft" onclick="/*moveL('-')*/" style="opacity: 0.5; cursor: default;"></div>
                            <div id="moveR" class="c_iconright" onclick="/*moveL('+')*/" style="opacity: 0.5; cursor: default;"></div>
                            <div id="trash" class="c_botonbasura" onclick="/*eliminaClones()*/" style="opacity: 0.5; cursor: default;"></div>
                        </div>
                    </div>
                </div-->
				

                
            </div>
        </div>
    </article>
	
	
</body>
</html>

