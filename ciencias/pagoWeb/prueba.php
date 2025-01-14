<?php 
            include ("../php/conexionPandilla.php");
 
                $conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

                if ($conexion->connect_error) {
                 die("La conexion falló: " . $conexion->connect_error);
                }

               $sql = "SELECT * FROM $tbl_name WHERE usuario = '".$_REQUEST['correoE']."'";
     
               $result = $conexion->query($sql);

                if(!$result) 
                    die("Error: no se pudo realizar la consulta 0".$sql);

                $row = $result->fetch_array(MYSQLI_ASSOC);

                if ($result->num_rows > 0) {     
                    
                    $sql2 = "UPDATE $tbl_name SET primerIngreso = 'no' WHERE usuario = '".$_REQUEST['correoE']."'";
                    $result2 = $conexion->query($sql2);
                }else{
                    $claveAcceso = generaPass();
                    $sql2 = "INSERT INTO $tbl_name (usuario, password, tipoLicencia) VALUES ('".$_REQUEST['correoE']."','".md5($claveAcceso)."','anual')";
                    $result2 = $conexion->query($sql2);
                }

                
                $email_from = "soporte@krismar.com.mx";//correo del formulario
                $email_to = $_REQUEST['correoE'];//correo a donde se va enviar el correo
                $email_subject = "Compra desde portal La Pandilla";//asunto del correo

                $email_message = "<html> 
    <head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<meta name='viewport' content='width = device-width, maximum-scale = 1, user-scalable=no'>
        <style>
        @font-face {
            font-family:FedraSansStd;
            src: url('http://www.krismar.com.mx/font/FedraSansStd Normal.otf') format('opentype');
        }
        .d_correoFondo{
            width:500px;
            display: table;
            background-color:#E9E9E9;
        }
        .d_correoContenedor{
            width: 96%;
            margin: auto;
            position: relative;
        }
        .d_correoEsp{
            width: 100%;
            height: 10px;
            float: left;
        }
        .d_correoTXTGral{
            width: 100%;
            float: left;
        }
        .d_correoTXT{
            font-family: FedraSansStd;
            font-size: 0.8em;
            padding: 1%;
            float: left
        }
        .d_titulo{
            width: 100%;
            text-align: center;
            font-size: 0.9em;
            color: #0069B0;
            font-weight: bold;
        }
        .d_subtitulo{
            width: 40%;
            color: #0069B0;
            font-weight: bold;
            text-align: right
        }
    .d_texto{
        width: 60%;
        color: #303030;
    }   
    .d_correoTabla{
        width: 100%;
        height: 150px;
        float: left;
    }
    .d_IMG_gral{
        width: 20%;
        height: 100%;
        float: left;
    }
    .d_IMG{
        width: 90%;
        height: 90%;
        position: relative;
        margin: auto;
        background: url('http://www.pandilla.mdt.mx/img/tituloSesion.png') no-repeat center;
        background-size: contain;
    }
    .d_INFO{
        width: 20%;
        height: 100%;
        float: left;
        font-family: FedraSansStd;
        font-size: 0.8em;
        text-align: center;
        color:#303030;
    }
    .d_sombra{
        width: 500px;
        height: 50px;
        background: url('http://www.krismar.com.mx/img/sombra2.png') no-repeat;
        background-size: contain;
        float: left;
    }
                    </style>
                </head>
                    <body >
        <div class='d_correoFondo'>
            <div class='d_correoContenedor'>
                        <div class='d_correoTXTGral'>
                    <div class='d_correoEsp'></div>
                    <table class='d_correoTXT d_titulo'><tr><td>¡GRACIAS POR TU COMPRA!</td></tr></table>
                    <table class='d_correoTXT d_titulo'><tr><td>“Bienvenido al maravilloso mundo de la pandilla del conocimiento.”</td></tr></table>
                    <table class='d_correoTXT d_titulo'><tr><td>Tus datos de acceso son:</td></tr></table>
                    <table class='d_correoTXT d_subtitulo'><tr><td>Usuario:</td></tr></table>
                    <table class='d_correoTXT d_texto'><tr><td>".$_REQUEST['correoE']."</td></tr></table>";
                    if ($result->num_rows == 0) { 
                    $email_message .= "<table class='d_correoTXT d_subtitulo'><tr><td>Clave:</td></tr></table>
                    
                    <table class='d_correoTXT d_texto'><tr><td>".$claveAcceso."</td></tr>";
                    }
                    $email_message .= "</table>
                    <table class='d_correoTXT d_titulo'><tr><td>DATOS DE PAGO:</td></tr></table>
                    <div class='d_correoEsp'></div>
                    
                    <div class='d_correoTabla'>
                        <div class='d_IMG_gral'>
                            <div class='d_IMG'></div>
                        </div>
                        <table class='d_INFO'><tr><td>Licencia portal “LA PANDILLA DEL CONOCIMIENTO”</td></tr></table>
                        <table class='d_INFO'><tr><td>Licencia anual</td></tr></table>
                        <table class='d_INFO'><tr><td>$500.00</td></tr></table>
                    </div>
                    <table class='d_correoTXT d_titulo'><tr><td>CANTIDAD PAGADA: $500.00</td></tr></table>
                    <div class='d_correoEsp'></div>
                    <table class='d_correoTXT d_subtitulo'><tr><td>Link de acceso:</td></tr></table>
                    <table class='d_correoTXT d_texto'><tr><td><a href='http://www.pandilla.mdt.mx'>http://www.pandilla.mdt.mx</a></td></tr></table>
                </div>
            </div>
        </div>
        <div class='d_sombra'></div>
                    </body>
                </html>";//mensaje en formato html del correo

        $headers = "MIME-Version: 1.0\r\n"; //header del correo
        $headers .= "Content-type: text/html; charset=utf-8\r\n";    //Para que podamos ver los acentos y ñ en nuestros correos
        $headers .= "From:".$email_from."\r\n"; //de donde viene el correo
        @mail($email_to,$email_subject,$email_message,$headers);//envia el correo
        @mail("soporte@krismar.com.mx",$email_subject,$email_message,$headers);//envia el correo
        @mail("veronica@krismar.com.mx",$email_subject,$email_message,$headers);//envia el correo
        @mail("daniel@krismar.com.mx",$email_subject,$email_message,$headers);//envia el correo
        
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