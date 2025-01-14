<?php
						
						    if($apps_aprobadas){
                                   $contador=0;
                                   foreach($apps_aprobadas as $app_individual){
									   
                                       
		
										foreach($this->materias as $result){
											
											if(preg_match("/".$result."/i", $app_individual->nombrem)){
												$materia = $result;
												break;
											}else{
												$materia = "s/m";
											}
											
										}

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
                              <div <?php if($flash[0] == "fla"){ ?> flash = "flash" <?php } ?> id = "app_<?=$contador?>" class="p_act4box" grado = "<?=$app_individual -> nombreg?>" materia = "<?=$materia?>" tema = "<?=$app_individual -> nombret?>" rel = "<?=$app_individual -> id_aplicacion?>" categoria = "<?=$tipo_ap?>" nombre = "<?=$app_individual->nombre?>" prefijo = "<?=$app_individual->prefijo?>" palabrascv = "<?=$app_individual->palabras_clave?>" leccion = "<?=$app_individual->seguimiento?>">
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