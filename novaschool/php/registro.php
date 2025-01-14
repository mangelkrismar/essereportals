<?php
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
        $nombrePortal = "";

        if($portal==9500){
        	$nombrePortal = "Portal Preescolar";
        }else if($portal==9501){
        	$nombrePortal = "Portal Primaria";
        }else if($portal==9506){
        	$nombrePortal = "Portal Secundaria";
        }else if($portal==9504){
        	$nombrePortal = "Portal Bachiller";
        }

        include("conexion.php");

        if($serie!="false"){
        	$sentencia0 = "UPDATE licencias SET promocion='".$equipo."', nombre='".$nombre."', apellido='".$apellido."', empresa='".$empresa."', email='".$email."', portal='".$portal."', ciudad='".$ciudad."', estado='".$estado."', usado='true' WHERE serie='".$serie."' ";
        	$resultado0 = mysql_query($sentencia0,$iden);
        	if (!$resultado0) {
            	die("Error: no se pudo realizar consulta0");
        	}
    	}else{
            $sentencia0 = "INSERT INTO licencias (promocion,nombre,apellido,empresa,email,portal,ciudad,estado,usado,serie) VALUES ('".$equipo."','".$nombre."','".$apellido."','".$empresa."','".$email."','".$portal."','".$ciudad."','".$estado."','true','".$email."".$portal."".$nombre."')";
            $resultado0 = mysql_query($sentencia0,$iden);
            if (!$resultado0) {
                die("Error: no se pudo realizar consulta0");
            }
        }

        $email_from = $email;//correo del formulario
        $email_to = "soporte@novaschool.mx";//correo a donde se va enviar el correo
        $email_subject = "Registro Tech Tools";//asunto del correo

        $email_message = "
        <html> 
            <head>
                <script type='text/css'>
                    body{
                        font-family: Arial;
                        color: red;
                        background-color: pink:
                        font-size: 20em;
                    }
                </script>
            </head>
            <body style='font-size: 10pt; font-family: Verdana,Geneva,sans-serif'>";
        if ($serie!="") {
            $email_message .= "<p style='color: #00619d'><strong>Se ha registrado el número de serie ".$serie." con los siguientes datos</strong></p>";
        }
        $email_message .= "<p style='color: #00619d'><strong>Usuario: ".$email."</strong></p>
                <p style='color: #00619d'><strong>Promoción: ".$equipo."</strong></p>
                <p style='color: #00619d'><strong>Nombre: ".$nombre." ".$apellido."</strong></p>
                <p style='color: #00619d'><strong>E-mail: ".$email."</strong></p>
                <p style='color: #00619d'><strong>Ciudad/Estado: ".$ciudad." ".$estado."</strong></p>
                <p style='color: #00619d'><strong>Portal: ".$nombrePortal."</strong></p>
                <br>
                <p style='color: #888888'>Fecha: ".date("d") . " del " . date("m") . " de " . date("Y")."</p>
                <p style='color: #888888'>Hora: ".date("H") . ":" . date("i") . ":" . date("s")."</p>
            </body>
        </html>";//mensaje en formato html del correo
       

        $headers = "MIME-Version: 1.0\r\n"; //header del correo
        $headers .= "Content-type: text/html; charset=utf-8\r\n";    //Para que podamos ver los acentos y ñ en nuestros correos
        $headers .= "From:".$email."\r\n"; //de donde viene el correo
        @mail($email_to,$email_subject,$email_message,$headers);//envia el correo

        if ($equipo!="Evento") {
            if ($equipo=="touchtools") {
                $email_to = "soporte@techtools.com.mx";//correo a donde se va enviar el correo
            }
            if ($equipo=="celmi") {
                $email_to = "soporte@celmi.mx";//correo a donde se va enviar el correo
            }
            if ($equipo=="synnex") {
                $email_to = "soporte@synnex.mx";//correo a donde se va enviar el correo
            }
            
            @mail($email_to,$email_subject,$email_message,$headers);//envia el correo
        }
        


        echo "Registro correcto, llegara a tu correo el usuario y password para poder acceder";
?>

