<?php session_start(); ?>
<?php
/** Validate captcha */
if (!empty($_REQUEST['captcha'])) {//Revisa que el captcha este lleno
    if (empty($_SESSION['captcha']) || trim(strtolower($_REQUEST['captcha'])) != $_SESSION['captcha']) {//revisa que el captcha se correcto
        echo "¡Captcha invalido!";//si no es correcto manda mensaje de error
    } else {//de lo contrario
        $equipo = $_REQUEST['promocion'];
        if ($_REQUEST['serie']) {
            $serie = $_REQUEST['serie'];
        }else{
            $serie = "false";
        }
        $nombre = $_REQUEST['nombre'];
        $apellido = $_REQUEST['apellido'];
        $empresa = $_REQUEST['empresa'];
        $email = $_REQUEST['email'];
        $portal = $_REQUEST['portal'];
        $ciudad = $_REQUEST['ciudad'];
        $estado = $_REQUEST['estado'];
        $usuario = $email;     
        $banderaSerie = 0;   
        $password = generaPass();

        if($serie!="false"){
            include("conexion.php");

            $sentencia0 = "SELECT count(*) as total FROM licencias WHERE usado='false' AND serie='".$serie."'";
            $resultado0 = mysql_query($sentencia0,$iden);
            if (!$resultado0) {
                die("Error: no se pudo realizar consulta0");
            }

            while ($fila0 = mysql_fetch_assoc($resultado0)) {
                $banderaSerie = $fila0['total'];
            }

            if ($banderaSerie==1) {
                echo $usuario.",".$password.",".$portal.",".$equipo;
            }else{
                echo "El número de serie es incorrecto";
            }
        }else{
            echo $usuario.",".$password.",".$portal.",".$equipo;
        }

    }

    
    unset($_SESSION['captcha']);//creacion de sesion de captcha
}

function generaPass(){
    //Se define una cadena de caractares. Te recomiendo que uses esta.
    $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    //Obtenemos la longitud de la cadena de caracteres
    $longitudCadena=strlen($cadena);
     
    //Se define la variable que va a contener la contraseña
    $pass = "";
    //Se define la longitud de la contraseña, en mi caso 10, pero puedes poner la longitud que quieras
    $longitudPass=8;
     
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
