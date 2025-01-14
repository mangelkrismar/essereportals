<?php
/*include("conexion.php");

$sentencia0 = "SELECT id_aplicacion, nombre, categoria, prefijo, palabras_clave, objetivos, instrucciones FROM aplicacion WHERE aprobada = 1 and prefijo like '%red_pdc%' ORDER BY prefijo";
$resultado0 = mysql_query($sentencia0, $iden); 
if(!$resultado0) 
    die("Error: no se pudo realizar la consulta 0".$sentencia0);

while($fila0 = mysql_fetch_assoc($resultado0)) 
    {*/
	$contador = 1;
	$data = file_get_contents('apps.json',true);
	    $data = json_decode($data,true);
	    foreach ($data as $fila0) {
        switch($fila0['categoria']){
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

                ($fila0['categoria'] == "aplicacionL")
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
        echo "<div id='app_conf".$contador."' class='p_recientebox' tipoapp='".$tipo_ap."' nombre='".$fila0['nombre']."' prefijo='".$fila0['prefijo']."' palabrascv='".$fila0['palabras_clave']."' >";
            echo "<div class='p_recienteboximg p_resalteminiatura'>";
                echo "<div class='p_recienteboxminiatura' imgsrc = '../KrismarApps/src/img/miniatura/'>";
                    //echo "<img src='http://www.krismar-educa.com.mx/primaria/src/img/miniaturas/".$fila0['prefijo'].".png'>";
                    echo "<img src=''>";   
                    echo "<div class='p_recienteboxicon' style = 'background-image:url(img/".$imgIcon.")'></div>";
                    echo "<div class = 'p_recienteboxlight'></div>";
                    echo "<div class='p_recienteinfo'>";
                        echo "<div class='p_recienteinfoplay'>";
                            echo "<div class='p_recienteinfoplayicon' onclick = 'playDemo(".$fila0['id_aplicacion'].")'></div>";
                        echo "</div>";
                        echo "<div class='p_recienteinfotitle'>".$fila0['nombre']."</div>";
                        echo "<div class='p_recienteinfoobjetivos'>";
                            echo "<ul>";
                                $objetivos = trim($fila0['objetivos']);
                                $objetivos = explode("-",$objetivos);

                                $objetivos = array_filter($objetivos);
                                $interConta = 0;
                                foreach($objetivos as $objetivo){
                                    if($interConta <= 2){
                                        echo"<li>*$objetivo</li>";
                                    }
                                    $interConta++;
                                }
                            echo "</ul>";
                        echo "</div>";
                       
                    echo "</div>";
                echo "</div>";
            echo "</div>";
            echo "<div class='p_recienteboxtxt'>".$fila0['nombre']."</div>";

        echo "</div>";
        $contador++;
    }

?>