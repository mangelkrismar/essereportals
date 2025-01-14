<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width = device-width, maximum-scale = 1, user-scalable=no">
<title>KrismarApps</title>

<!--script type="text/javascript" src="<?echo base_url()?>src/sistema/js/web_apps.js"></script-->

</head>
<body>				
				<?$contClone=0; for($i=1; $i<=sizeof($filtros); $i++)://Aplicacion
							if(strlen(substr($filtros[$i], 0, strrpos($filtros[$i], "-")))==19): $contClone++;?>
								<input id="pifiltroApps<?echo $contClone?>" type="hidden" name="lecciones[]" value="<?echo $filtros[$i]?>">
						<?endif; endfor;?>
                		
                		<div id="inicioInput" totalClones="<?echo $contClone?>"><!--BOTÓN DE APLICACIÓN-->
					
                    <div class="p_actividadesmenu">
                        <div class="p_opcionuno p_actividadesmenubtn" id = "tema_filtro" onclick = "muestraMenuFiltro('acttemas', $(this))">
                            <div class="p_actmenubtnimg" id = "img_tema"></div>
                            <div class="p_actmenubtntxt" id = "tema_app">Tema</div>
                        </div>
                        <div class="p_opciondos p_actividadesmenubtn" id = "subtema_filtro" onclick = "muestraMenuFiltro('actsubtemas', $(this))">
                            <div class="p_actmenubtnimg" id = "img_grado"></div>
                            <div class="p_actmenubtntxt" id = "subtema_app">Subtemas</div>
                            <!--div class="p_actmenubtntxt" id = "grado_app">Grado</div-->
                        </div>
                        <div class="p_opciontres p_actividadesmenubtn" id = "grado_filtro" onclick = "muestraMenuFiltro('actgrados', $(this))">
                            <div class="p_actmenubtnimg" id = "img_cate"></div>
                            <!--div class="p_actmenubtntxt" id = "categoria_app">Categoría</div-->
                            <div class="p_actmenubtntxt" id = "grado_app">Grados</div>
                        </div>
                    </div>
                    
                    <div class="p_actividadescateg">
                        <div class="p_actividadescategopcion">
                            <div class="p_actividadescategicon p_categapp" id = "filtro_aplicacion" onclick = "cambiaFiltroCate('aplicacion',$(this))"></div>
                        </div>
                        <div class="p_actividadescategopcion">
                            <div class="p_actividadescategicon p_categlec" id = "filtro_lectura" onclick = "cambiaFiltroCate('lectura',$(this))" ></div>
                        </div>
                        <div class="p_actividadescategopcion">
                            <div class="p_actividadescategicon p_categvid" id = "filtro_video" onclick = "cambiaFiltroCate('video',$(this))"></div>
                        </div>
                        <div class="p_actividadescategopcion">
                            <div class="p_actividadescategicon p_categeva" id = "filtro_evaluacion" onclick = "cambiaFiltroCate('evaluacion',$(this))"></div>
                        </div>
                        <div class="p_actividadescategtxt">
                            <table><tr><td onclick = "limpiaFiltros()">Limpiar filtros</td></tr></table>
                        </div>
                    </div>

                    <div class="p_act2center">
                    	<table class = "p_conte_notificacion">
                    		<tr>
                    			<td>
                    				No se encontrarón resultados.
                    			</td>
                    		</tr>
                    	</table>
                        <?php
						echo "Aqui estan las aplicaciones aprobadas: ";
						$apps_aprobadas = $apps_aprobadas->result();
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

                                        /*if($app_movil && $flash[0] != "fla"){
                                          continue;
                                        }*/
										//si es pc
										
                                        if(($app_movil && $flash[0] != "fla") || !$app_movil){
										$contador++;
                                    ?>

							<!--style = "display:none"--> 
                              <div <?php if($flash[0] == "fla"){ ?> flash = "flash" <?php } ?> id = "app_<?=$contador?>" class="p_act4box" rel = "<?=$app_individual -> id_aplicacion?>" tipoapp = "<?=$tipo_ap?>" nombre = "<?=$app_individual->nombre?>" prefijo = "<?=$app_individual->prefijo?>" palabrascv = "<?=$app_individual->palabras_clave?>">
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
                                                        /*$objetivos = implode(",", $objetivos);
                                                        $objetivos = explode(",", $objetivos);
                                                        $objetivos = array_filter($objetivos);*/
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
                                        </div>


                                    </div>
                                </div>
                                <div class="p_recienteboxtxt"><?=$app_individual->nombre?></div>
                            </div>

                            <?php
                          }
                                   }
                               }else{
                                   echo "No se han cargado aplicaciones, contacte con el administrador.";
                               }
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
                        <div class="p_actnavcenter" id = "pag_user">
                            <!--div class="p_actnavarrowleft"></div>
                            <div class="p_actnavnum">1</div>
                            <div class="p_actnavnum p_actnavnum_active">2</div>
                            <div class="p_actnavnum">3</div>
                            <div class="p_actnavnum">4</div>
                            <div class="p_actnavnum">...</div>
                            <div class="p_actnavarrowright"></div-->
                        </div>
                    </div>
                    <div class = "p_actfondo"></div>

                    <div class="p_actdesplegable">
                        <div class="p_actconte">

                            <!--TEMAS-->
                            <div class="p_actcontein" id="acttemas">

                                <div class="p_acttemas" id = "tema_mat" onclick = "cambiaFiltroTema('mat', $(this))">
                                    <div class="p_acttemasicon">
                                        <div class="p_acttemasimg p_temas_mat">
                                            <div class="p_temasboxlight"></div>
                                        </div>
                                    </div>
                                    <table class="p_acttemastxt"><tr><td>Matemáticas</td></tr></table>
                                </div>

                                <div class="p_acttemas" id = "tema_esp" onclick = "cambiaFiltroTema('esp', $(this))">
                                    <div class="p_acttemasicon">
                                        <div class="p_acttemasimg p_temas_esp">
                                            <div class="p_temasboxlight"></div>
                                        </div>
                                    </div>
                                    <table class="p_acttemastxt"><tr><td>Español</td></tr></table>
                                </div>

                                <div class="p_acttemas" id = "tema_rv" onclick = "cambiaFiltroTema('rv', $(this))">
                                    <div class="p_acttemasicon">
                                        <div class="p_acttemasimg p_temas_rver">
                                            <div class="p_temasboxlight"></div>
                                        </div>
                                    </div>
                                    <table class="p_acttemastxt"><tr><td>Razonamiento Verbal</td></tr></table>
                                </div>

                                <div class="p_acttemas" id = "tema_ana" onclick = "cambiaFiltroTema('ana', $(this))">
                                    <div class="p_acttemasicon">
                                        <div class="p_acttemasimg p_temas_ana">
                                            <div class="p_temasboxlight"></div>
                                        </div>
                                    </div>
                                    <table class="p_acttemastxt"><tr><td>Anatomía</td></tr></table>
                                </div>

                                <div class="p_acttemas" id = "tema_hab" onclick = "cambiaFiltroTema('Habilidades', $(this))">
                                    <div class="p_acttemasicon">
                                        <div class="p_acttemasimg p_temas_hab">
                                            <div class="p_temasboxlight"></div>
                                        </div>
                                    </div>
                                    <table class="p_acttemastxt"><tr><td>Habilidades</td></tr></table>
                                </div>

                                <div class="p_acttemas" id = "tema_tec" onclick = "cambiaFiltroTema('tec', $(this))">
                                    <div class="p_acttemasicon">
                                        <div class="p_acttemasimg p_temas_tec">
                                            <div class="p_temasboxlight"></div>
                                        </div>
                                    </div>
                                    <table class="p_acttemastxt"><tr><td>Tecnología</td></tr></table>
                                </div>

                                <div class="p_acttemas" id = "tema_geo" onclick = "cambiaFiltroTema('geo', $(this))">
                                    <div class="p_acttemasicon">
                                        <div class="p_acttemasimg p_temas_geo">
                                            <div class="p_temasboxlight"></div>
                                        </div>
                                    </div>
                                    <table class="p_acttemastxt"><tr><td>Geografía</td></tr></table>
                                </div>

                                <!-- INGLES NO BORRAR <div class="p_acttemas" id = "tema_ing" onclick = "cambiaFiltroTema('ing', $(this))">
                                    <div class="p_acttemasicon">
                                        <div class="p_acttemasimg p_temas_ing">
                                            <div class="p_temasboxlight"></div>
                                        </div>
                                    </div>
                                    <table class="p_acttemastxt"><tr><td>Inglés</td></tr></table>
                                </div>-->

                                <div class="p_acttemas" id = "tema_his" onclick = "cambiaFiltroTema('his', $(this))">
                                    <div class="p_acttemasicon">
                                        <div class="p_acttemasimg p_temas_his">
                                            <div class="p_temasboxlight"></div>
                                        </div>
                                    </div>
                                    <table class="p_acttemastxt"><tr><td>Historia</td></tr></table>
                                </div>

                                <div class="p_acttemas" id = "tema_eco" onclick = "cambiaFiltroTema('eco', $(this))">
                                    <div class="p_acttemasicon">
                                        <div class="p_acttemasimg p_temas_eco">
                                            <div class="p_temasboxlight"></div>
                                        </div>
                                    </div>
                                    <table class="p_acttemastxt"><tr><td>Ecología</td></tr></table>
                                </div>

                                <div class="p_acttemas" id = "tema_rmat" onclick = "cambiaFiltroTema('rm', $(this))">
                                    <div class="p_acttemasicon">
                                        <div class="p_acttemasimg p_temas_rmat">
                                            <div class="p_temasboxlight"></div>
                                        </div>
                                    </div>
                                    <table class="p_acttemastxt"><tr><td>Razonamiento Matemático</td></tr></table>
                                </div>

                                <div class="p_acttemas" id = "tema_nat" onclick = "cambiaFiltroTema('nat', $(this))">
                                    <div class="p_acttemasicon">
                                        <div class="p_acttemasimg p_temas_nat">
                                            <div class="p_temasboxlight"></div>
                                        </div>
                                    </div>
                                    <table class="p_acttemastxt"><tr><td>Ciencias Naturales</td></tr></table>
                                </div>

                                <div class="p_acttemas" id = "tema_cye" onclick = "cambiaFiltroTema('cye', $(this))">
                                    <div class="p_acttemasicon">
                                        <div class="p_acttemasimg p_temas_cye">
                                            <div class="p_temasboxlight"></div>
                                        </div>
                                    </div>
                                    <table class="p_acttemastxt"><tr><td>Formación cívica y ética</td></tr></table>
                                </div>

                                <div class="p_acttemas" id = "tema_edf" onclick = "cambiaFiltroTema('edf', $(this))">
                                    <div class="p_acttemasicon">
                                        <div class="p_acttemasimg p_temas_efis">
                                            <div class="p_temasboxlight"></div>
                                        </div>
                                    </div>
                                    <table class="p_acttemastxt"><tr><td>Educación física</td></tr></table>
                                </div>

                                <div class="p_acttemas">
                                    <div class="p_acttemasicon">
                                        <div class="p_acttemasimg p_temas_art">
                                            <div class="p_temasboxlight"></div>
                                        </div>
                                    </div>
                                    <table class="p_acttemastxt"><tr><td>Educación artística</td></tr></table>
                                </div>

                            </div>
                            
                            <!--SUBTEMAS-->
                            <div class="p_actcontein" id="actsubtemas">
                                
                                <div class="p_actsubtemas">
                                    <div class="p_actsubtemasicon">
                                        <div class="p_actsubtemasiconin"></div>
                                    </div>
                                    <table class="p_actsubtemastxt"><tr><td>Razonamiento matemático</td></tr></table>
                                </div>
                                
                                <div class="p_actsubtemas p_actsubtemas_over">
                                    <div class="p_actsubtemasicon">
                                        <div class="p_actsubtemasiconin"></div>
                                    </div>
                                    <table class="p_actsubtemastxt"><tr><td>Razonamiento matemático</td></tr></table>
                                </div>
                                
                                <div class="p_actsubtemas">
                                    <div class="p_actsubtemasicon">
                                        <div class="p_actsubtemasiconin"></div>
                                    </div>
                                    <table class="p_actsubtemastxt"><tr><td>Razonamiento matemático</td></tr></table>
                                </div>
                                
                                <div class="p_actsubtemas">
                                    <div class="p_actsubtemasicon">
                                        <div class="p_actsubtemasiconin"></div>
                                    </div>
                                    <table class="p_actsubtemastxt"><tr><td>Razonamiento matemático</td></tr></table>
                                </div>
                                
                                <div class="p_actsubtemas">
                                    <div class="p_actsubtemasicon">
                                        <div class="p_actsubtemasiconin"></div>
                                    </div>
                                    <table class="p_actsubtemastxt"><tr><td>Razonamiento matemático</td></tr></table>
                                </div>
                            </div>

                            <!--GRADO-->
                            <div class="p_actcontein" id="actgrados">

                                <div class="p_actgrados" id = "grado_1">
                                    <div class="p_actgradosin p_temas_primero" onclick="cambiaFiltroGrado(1, $(this))">
                                        <div class="p_gradosboxlight"></div>
                                    </div>
                                </div>

                                <div class="p_actgrados" id ="grado_2">
                                    <div class="p_actgradosin p_temas_segundo" onclick="cambiaFiltroGrado(2, $(this))">
                                        <div class="p_gradosboxlight"></div>
                                    </div>
                                </div>

                                <div class="p_actgrados" id = "grado_3">
                                    <div class="p_actgradosin p_temas_tercero" onclick="cambiaFiltroGrado(3, $(this))">
                                        <div class="p_gradosboxlight"></div>
                                    </div>
                                </div>

                                <div class="p_actgrados" id = "grado_4">
                                    <div class="p_actgradosin p_temas_cuarto" onclick="cambiaFiltroGrado(4, $(this))">
                                        <div class="p_gradosboxlight"></div>
                                    </div>
                                </div>

                                <div class="p_actgrados" id = "grado_5">
                                    <div class="p_actgradosin p_temas_quinto" onclick="cambiaFiltroGrado(5, $(this))">
                                        <div class="p_gradosboxlight"></div>
                                    </div>
                                </div>

                                <div class="p_actgrados" id = "grado_6">
                                    <div class="p_actgradosin p_temas_sexto" onclick="cambiaFiltroGrado(6, $(this))">
                                        <div class="p_gradosboxlight"></div>
                                    </div>
                                </div>

                            </div>

                            <!--CATEGORIA-->
                            <div class="p_actcontein" id="actcategoria">
								<!--id = "filtro_aplicacion"-->
                                <div class="p_actcategoria"  onclick = "cambiaFiltroCate('aplicacion',$(this))">
                                    <div class="p_actcategoriaicon">
                                        <div class="p_actcategoriaimg p_aplicacion">
                                            <div class="p_temasboxlight"></div>
                                        </div>
                                    </div>
                                    <table class="p_actcategoriatxt"><tr><td>Aplicación</td></tr></table>
                                </div>
								<!--id = "filtro_lectura"-->
                                <div class="p_actcategoria"  onclick = "cambiaFiltroCate('lectura',$(this))">
                                    <div class="p_actcategoriaicon">
                                        <div class="p_actcategoriaimg p_lectura">
                                            <div class="p_temasboxlight"></div>
                                        </div>
                                    </div>
                                    <table class="p_actcategoriatxt"><tr><td>Lectura</td></tr></table>
                                </div>
								<!--id = "filtro_video"-->
                                <div class="p_actcategoria"  onclick = "cambiaFiltroCate('video',$(this))">
                                    <div class="p_actcategoriaicon">
                                        <div class="p_actcategoriaimg p_video">
                                            <div class="p_temasboxlight"></div>
                                        </div>
                                    </div>
                                    <table class="p_actcategoriatxt"><tr><td>Video</td></tr></table>
                                </div>
								<!--id = "filtro_evaluacion"-->
                                <div class="p_actcategoria"  onclick = "cambiaFiltroCate('evaluacion',$(this))">
                                    <div class="p_actcategoriaicon">
                                        <div class="p_actcategoriaimg p_evaluacion">
                                            <div class="p_temasboxlight"></div>
                                        </div>
                                    </div>
                                    <table class="p_actcategoriatxt"><tr><td>Evaluación</td></tr></table>
                                </div>

                            </div>

                        </div>
                        <div class="p_actclosemove">
                            <div class="p_actclosemovecenter"></div>
                        </div>
                        <div class="p_actclose" onclick = "closeMenuAct()"></div>
                    </div>


</body>
</html>