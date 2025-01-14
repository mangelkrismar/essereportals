<?if($apps_aprobadas){
                                   $contador=0;
                                   foreach($apps_aprobadas as $app_individual){
                                       $contador++;
                                       switch($app_individual->categoria){
                                            case "lectura":
                                                $color="#FBBA00";
                                                $imgIcon = "p_recienteiconlectura.png";
                                                $tipo_ap = "lectura";
                                                break;
                                            case "video":
                                                $color="#00A99D";
                                                $imgIcon = "p_recienteiconvideo.png";
                                                $tipo_ap = "video";
                                                break;
                                            case "aplicacion":
                                            case "aplicacionL":
                                                $color="#7F3E7D";

                                                ($app_individual->categoria == "aplicacionL")
                                                ?
                                                    $imgIcon = "p_recienteiconaplicacionL.png"
                                                :
                                                    $imgIcon = "p_recienteiconaplicacion.png";


                                                $tipo_ap = "aplicacion";
                                                break;

                                            case "evaluacion":
                                            case "evaluacionC":
                                            case "evaluacionE":
                                                $color="#8CC63F";
                                                $tipo_ap = "evaluacion";
                                                ($app_individual->categoria == "evaluacionC")?
                                                    $imgIcon = "p_recienteiconevaluacionC.png"
                                                :
                                                    $imgIcon = "p_recienteiconevaluacionE.png";

                                                break;
                                        }
                                          $flash = str_split($app_individual->prefijo, 3);
                                    ?>

                              <div dispositivo = "<?=($flash[0] == "fla")?10:0?>" id = "app_conf<?=$contador?>" class="p_act2box" tipoapp = "<?=$tipo_ap?>" nombre = "<?=$app_individual->nombre?>" prefijo = "<?=$app_individual->prefijo?>" categoria = "<?=$tipo_ap?>" palabrascv = "<?=$app_individual->palabras_clave?>">
                                <div class="p_recienteboximg p_resalteminiatura">
                                  <!-- style = "background-image:url(<?=base_url()?>src/img/miniaturas/<?=$contador?>.png);" -->
                                    <div class="p_recienteboxminiatura" imgsrc = "<?=base_url()?>">
                                      <img src = ""/>
                                        <div class="p_recienteboxicon" style = "background-image:url( <?=base_url()?>src/img/<?=$imgIcon?> )"></div>
                                        <div class = "p_recienteboxlight"></div>

                                        <div class="p_recienteinfo">

                                            <div class="p_recienteinfoplay">
                                                <div class="p_recienteinfoplayicon" onclick = "playDemo(<?=$app_individual -> id_aplicacion?>)"></div>
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
                                                        foreach($objetivos as $objetivo){
                                                            echo"<li>$objetivo</li>";
                                                        }
                                                    ?>
                                                </ul>
                                            </div>
                                            <input type ="checkbox" class="c_check2box" onchange = "changeMirror($(this))">
                                        </div>


                                    </div>
                                </div>
                                <div class="p_recienteboxtxt"><?=$app_individual->nombre?></div>
                                <input type="checkbox" class="c_checkbox" onchange="registraApp('<?=$app_individual->prefijo?>', $(this))">
                            </div>

                            <?php
                                   }
                               }else{
                                   echo "No se han cargado aplicaciones, contacte con el administrador.";
                               }
                            ?>
