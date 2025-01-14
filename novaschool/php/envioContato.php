<?php session_start(); ?>
<?php
/** Validate captcha */
if (!empty($_REQUEST['captcha'])) {//Revisa que el captcha este lleno
    if (empty($_SESSION['captcha']) || trim(strtolower($_REQUEST['captcha'])) != $_SESSION['captcha']) {//revisa que el captcha se correcto
        echo "¡Captcha invalido!";//si no es correcto manda mensaje de error
    } else {//de lo contrario
        $email_from = $_POST['correo'];//correo del formulario
        $email_to = "soporte@novaschool.mx";//correo a donde se va enviar el correo
        $email_subject = "Contacto desde Novaschool";//asunto del correo

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
            <body style='font-size: 10pt; font-family: Verdana,Geneva,sans-serif'>
                <p style='color: #00619d'><strong>Nombre: ".$_POST['nombre']."</strong></p>
                <p style='color: #00619d'><strong>E-mail: ".$_POST['correo']."</strong></p>
                <br>
                <p style='color: #888888'>Comentarios: <br>".$_POST['comentarios']."</p>
                <br>
                <p style='color: #888888'>Fecha: ".date("d") . " del " . date("m") . " de " . date("Y")."</p>
                <p style='color: #888888'>Hora: ".date("H") . ":" . date("i") . ":" . date("s")."</p>
            </body>
        </html>";//mensaje en formato html del correo
       

        $headers = "MIME-Version: 1.0\r\n"; //header del correo
        $headers .= "Content-type: text/html; charset=utf-8\r\n";    //Para que podamos ver los acentos y ñ en nuestros correos
        $headers .= "From:".$_POST['correo']."\r\n"; //de donde viene el correo
        @mail($email_to,$email_subject,$email_message,$headers);//envia el correo

       /* $email_to = $_POST['correo'];//correo del formulario
        $email_from = "daniel@novaschool.mx";//correo a donde se va enviar el correo
        $email_subject = "Contacto desde Novaschool";//asunto del correo

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
            <body style='font-size: 10pt; font-family: Verdana,Geneva,sans-serif'>
                <p style='color: #00619d'><strong>Nombre: ".$_POST['nombre']."</strong></p>
                <p style='color: #00619d'><strong>E-mail: ".$_POST['correo']."</strong></p>
                <br>
                <p style='color: #888888'>Pronto sera atendido</p>
                <br>
                <p style='color: #888888'>Fecha: ".date("d") . " del " . date("m") . " de " . date("Y")."</p>
                <p style='color: #888888'>Hora: ".date("H") . ":" . date("i") . ":" . date("s")."</p>
            </body>
        </html>";//mensaje en formato html del correo
       

        $headers = "MIME-Version: 1.0\r\n"; //header del correo
        $headers .= "Content-type: text/html; charset=utf-8\r\n";    //Para que podamos ver los acentos y ñ en nuestros correos
        $headers .= "From: Soporte Novaschool <soporte@novaschool.mx>\r\n"; //de donde viene el correo
        @mail($email_to,$email_subject,$email_message,$headers);//envia el correo*/

        echo "¡El formulario se ha enviado con exito!";//mensaje de exito de mensaje

    }

    
    unset($_SESSION['captcha']);//creacion de sesion de captcha
}


?>