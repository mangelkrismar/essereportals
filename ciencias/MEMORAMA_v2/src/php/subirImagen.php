<?php
$nombreImagen;

if ($_FILES['file']["error"] > 0){

  echo "Error: " . $_FILES['file']['error'] . "<br>";

}else{
    $srcImg_type = $_FILES["file"]["type"];
    if($srcImg_type == "image/x-png"|| $srcImg_type == "image/png" || $srcImg_type == "image/pjpeg" || $srcImg_type == "image/jpeg"){
        $nombreImagen = generaPass();
        $prefijo = $_REQUEST['prefijo'];
        /*ahora co la funcion move_uploaded_file lo guardaremos en el destino que queramos*/
        move_uploaded_file($_FILES['file']['tmp_name'],"../../KrismarApps/src/img/" . $_FILES['file']['name']);
        rename("../../KrismarApps/src/img/" . $_FILES['file']['name'],"../../KrismarApps/src/img/".$prefijo."_".$nombreImagen.".png");
        echo "KrismarApps/src/img/".$prefijo."_".$nombreImagen.".png";
    }else{
        echo "no aceptado";
    } 
	

}

function generaPass(){
    //Se define una cadena de caractares. Te recomiendo que uses esta.
    $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    //Obtenemos la longitud de la cadena de caracteres
    $longitudCadena=strlen($cadena);
     
    //Se define la variable que va a contener la contraseña
    $pass = "";
    //Se define la longitud de la contraseña, en mi caso 10, pero puedes poner la longitud que quieras
    $longitudPass=6;
     
    //Creamos la contraseña
    for($i=1 ; $i<=$longitudPass ; $i++){
        //Definimos numero aleatorio entre 0 y la longitud de la cadena de caracteres-1
        $pos=rand(0,$longitudCadena-1);
     
        //Vamos formando la contraseña en cada iteraccion del bucle, añadiendo a la cadena $pass la letra correspondiente a la posicion $pos en la cadena de caracteres definida.
        $pass .= substr($cadena,$pos,1);
    }
    return $pass;
    }
?>
