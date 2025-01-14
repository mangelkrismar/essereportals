<?php
$htmlAplicacion = $_REQUEST['htmlAplicacion'];
$arrayColor = $_REQUEST['arrayColor'];
$arrayBorde = $_REQUEST['arrayBorde'];
$arrayShadow = $_REQUEST['arrayShadow'];
$arrayTexto = $_REQUEST['arrayTexto'];
$arrayImg = $_REQUEST['arrayImg'];
$arrayPar1 = $_REQUEST['arrayPar1'];
$arrayPar2 = $_REQUEST['arrayPar2'];
$arrayZoom = $_REQUEST['arrayZoom'];
$arrayFontfamily = $_REQUEST['arrayFontfamily'];
$arrayFontsize = $_REQUEST['arrayFontsize'];
$arraytipoImg = $_REQUEST['arraytipoImg'];
$arrayRedondear = $_REQUEST['arrayRedondear'];
$numCartas = $_REQUEST['numCartas'];
$distractoresAdd = $_REQUEST['distractoresAdd'];
$tipoMemorama = $_REQUEST['tipoMemorama'];
$prefijo = $_REQUEST['prefijo'];


$banderaExiste = false;


$directorio = opendir("../../KrismarApps/src/img/"); //ruta actual
while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
{
    if (is_dir($archivo))//verificamos si es o no un directorio
    {
        
    }
    else
    {
        $cadena = $prefijo;
        $resultado = strpos($archivo, $cadena);
        //recho $cadena." -> ".$archivo." = ".$resultado;
        if($resultado !== false){
            $banderaExiste = false;
            for ($i=0; $i < count($arrayImg); $i++) {
                if ("KrismarApps/src/img/".$archivo==$arrayImg[$i]) {
                    $banderaExiste=true;
        
                }
            }

            if ($banderaExiste==false) {
                for ($i=0; $i < count($arrayPar1); $i++) {
                    if ("KrismarApps/src/img/".$archivo==$arrayPar1[$i]) {
                        $banderaExiste=true;
            
                    }
                }
            }

            if ($banderaExiste==false) {
                for ($i=0; $i < count($arrayPar2); $i++) {
                    if ("KrismarApps/src/img/".$archivo==$arrayPar2[$i]) {
                        $banderaExiste=true;
            
                    }
                }
            }

            if ($banderaExiste==false) {
               unlink("../../KrismarApps/src/img/".$archivo);
            }
        }
        
    }
}

for ($i=1; $i < count($arrayImg); $i++) {
    if($arrayImg[$i]!=""){
        rename("../../".$arrayImg[$i],"../../KrismarApps/src/img/".$prefijo."_".$i.".png");
        $arrayImg[$i] = "../img/".$prefijo."_".$i.".png";
    }
    
}

if ($tipoMemorama==1 || $tipoMemorama==2 || $tipoMemorama==4) {
    for ($i=1; $i < count($arrayPar1); $i++) {
        if($arrayPar1[$i]!=""){
            rename("../../".$arrayPar1[$i],"../../KrismarApps/src/img/".$prefijo."_Par1img".$i.".png");
            $arrayPar1[$i] = "../img/".$prefijo."_Par1img".$i.".png";
        }
    
    }
}

if ($tipoMemorama==4) {
    for ($i=1; $i < count($arrayPar2); $i++) {
        if($arrayPar2[$i]!=""){
            rename("../../".$arrayPar2[$i],"../../KrismarApps/src/img/".$prefijo."_Par2img".$i.".png");
            $arrayPar2[$i] = "../img/".$prefijo."_Par2img".$i.".png";
        }
    
    }
}



$cadena2="";

for ($i=1; $i < count($arrayImg); $i++) {
    $cadena2 .= ".agrega".$i."{";
        if($arrayColor[$i]!=""){
            $cadena2 .= " background-color:".$arrayColor[$i]." !important;";
        }
        if($arrayTexto[$i]!=""){
            $cadena2 .= " color:".$arrayTexto[$i]." !important;";
        }
        if($arrayImg[$i]!=""){
            $cadena2 .= " background-image:url(".$arrayImg[$i].") !important;";
        }
        if ($arraytipoImg[$i]=="box1") {
            $cadena2 .= " background-size:contain !important; background-repeat:no-repeat !important;";
        }
        if ($arraytipoImg[$i]=="box2") {
            $cadena2 .= " background-size:cover !important; background-repeat:no-repeat !important;";
        }
        if ($arraytipoImg[$i]=="box3") {
            $cadena2 .= " background-size:100% 100% !important; background-repeat:no-repeat !important;";
        }
        if ($arraytipoImg[$i]=="box4") {
            $cadena2 .= " background-size:auto !important; background-repeat:repeat !important;";
        }
        if ($arrayZoom[$i]!="") {
            $cadena2 .= " background-size:".$arrayZoom[$i]."% !important;";
        }
        if ($arrayBorde[$i]!="") {
            $cadena2 .= " border-color:".$arrayBorde[$i]."; border-style:solid !important;";
        }
        if ($arrayShadow[$i]!="") {
            $cadena2 .= " box-shadow: 0px 0px 6px 0px".$arrayShadow[$i]." !important;";
        }
        if ($arrayRedondear[$i]!="") {
            $cadena2 .= " border-radius:".$arrayRedondear[$i]."px !important;";
        }
    $cadena2 .= "}";
    
}
 
    $archivo2 = fopen("../../KrismarApps/src/css/".$prefijo.".css", "w");
    fwrite($archivo2, $cadena2."".PHP_EOL);
    fclose($archivo2);

    for ($i=1; $i < count($arrayTexto); $i++) {
        $cadena2 .= ".txt".$i."{";
            if($arrayTexto[$i]!=""){
                $cadena2 .= " color:".$arrayTexto[$i]." !important;";
            }
            if ($arrayFontfamily[$i]!="") {
                $cadena2 .= " font-family:".$arrayFontfamily[$i]." !important;";
            }
            if ($arrayFontsize[$i]!="") {
                $cadena2 .= " font-size:".$arrayFontsize[$i]."rem !important;";
            }
        $cadena2 .= "}";
    }
    
    $archivo2 = fopen("../../KrismarApps/src/css/".$prefijo.".css", "w");
    fwrite($archivo2, $cadena2."".PHP_EOL);
    fclose($archivo2);

    $archivo2 = fopen("../../KrismarApps/".$prefijo.".html", "w");
    fwrite($archivo2, $htmlAplicacion."".PHP_EOL);
    fclose($archivo2);
    
    $cadena2="var IP = 'http://'+document.domain+'/MEMORAMA_v2/KrismarApps/';";
    $cadena2.="var PREFIJO = IP+'src/img/".$prefijo."_';";
    $cadena2.="var TOTACTIVIDADES = 1;";
    $cadena2.="var HAYNIVEL = false;";
    $cadena2.="var HAYVELAPP = false;";
    $cadena2.="var NIVEL = 5;";

    $cadena2.="var numTarjetas = ".$numCartas.";";
    $cadena2.="var numMaxImg = (".$numCartas."/2)+".$distractoresAdd.";";
    $cadena2.="var numImgMostrar = ".$numCartas."/2;";
    $cadena2.="var tipoMemoria = ".$tipoMemorama.";";
    $cadena2.="var gradosGirar = 180;";
    if ($tipoMemorama==1) {
        $cadena2.="var tarjetasDescri = [[1,''],[2,''],[3,''],[4,''],[5,'']];";
    }
    if ($tipoMemorama==2) {
        $cadena2.="var tarjetasDescri = [";
        for ($i=1; $i <= ($numCartas/2)+$distractoresAdd; $i++) {
            $cadena2 .= "[".$i.",'".$arrayPar2[$i]."']";
            if ($i<($numCartas/2)+$distractoresAdd) {
                $cadena2 .= ",";
            }
        }
        $cadena2 .= "];";
    }
    if ($tipoMemorama==3) {
        $cadena2.="var tarjetasDescri = [";
        for ($i=1; $i <= ($numCartas/2)+$distractoresAdd; $i++) {
            $cadena2 .= "[".$i.",'".$arrayPar1[$i]."','".$arrayPar2[$i]."']";
            if ($i<($numCartas/2)+$distractoresAdd) {
                $cadena2 .= ",";
            }
        }
        $cadena2 .= "];";
    }
    if ($tipoMemorama==4) {
        $cadena2.="var tarjetasDescri = [[1,''],[2,''],[3,''],[4,''],[5,'']];";
    }

    $cadena2.="function iniciaActividad(){";
    //$cadena2.="var arrImgTrasera = [1,2,3,4];";
    $cadena2.="iniciaDefault();";
    /*$cadena2.="arrImgTrasera.sort(function(){return Math.random() - 0.5});";
    $cadena2.="for(i=0;i<numTarjetas; i++){";
    $cadena2.="$('#cartaReverso'+(i+1)).css('background-image','url('+PREFIJO+'cartaBack_'+arrImgTrasera[0]+'.png), url('+PREFIJO+'cartatexture.png)');";
    $cadena2.="}";

    $cadena2.="$('.d_cartareverso').hover(";
    $cadena2.="function(){";
    $cadena2.="$(this).css('background-image','url('+PREFIJO+'cartaBack_'+arrImgTrasera[0]+'_over.png), url('+PREFIJO+'cartatexture.png)');";
    $cadena2.="},";
    $cadena2.="function(){";
    $cadena2.="$(this).css('background-image','url('+PREFIJO+'cartaBack_'+arrImgTrasera[0]+'.png), url('+PREFIJO+'cartatexture.png)');";
    $cadena2.="}";
    $cadena2.=");";*/
    $cadena2.="generaContenido();";
    $cadena2.="}";

    $archivo2 = fopen("../../KrismarApps/src/js/".$prefijo.".js", "w");
    fwrite($archivo2, $cadena2."".PHP_EOL);
    fclose($archivo2);
   
?>