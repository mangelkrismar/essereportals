<?php 
	//Se incluyen las librerias necesarias
    include("conexBD.php");

	$header = '';
 	$req = 'cmd=_notify-validate';

 	$conn = Conectarse();//conex($CFG->dbhost,$CFG->dbuser,$CFG->dbpass,$CFG->dbname);  //Conexion establecida
 
	 foreach($_POST as $clave => $valor) {
	    //Hay que utilizar codificación URL en todas las solicitudes a PayPal
	    $valor = urlencode(stripslashes($valor));
	    //Añadir clave => valor al string CMD
	    $req .= "&$clave=$valor";
	 }
 
	 //Enviar un POST de vuelta a Paypal para verificación
	 $header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
	 $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
	 $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
	 $fp = fsockopen ('www.sandbox.paypal.com', 80, $errno, $errstr, 30);
	 
	 if(!$fp) {
	     //Procesar Error HTTP
	     $message .= "\n HTTP ERROR. \n";
	 
	 } else {
	     fputs ($fp, $header . $req);
	     while (!feof($fp)) {
	         $res = fgets ($fp, 1024);
	         if (!strcmp ($res, "VERIFIED")) {
	             //TRANSACCION VERIFICADA
	             //PAGO
	             if($_POST['payment_status'] == 'completed') {
	 
	                 //THE PAYMENT IS COMPLETE, UPDATE INFORMATION IN SUBSCRIPTION & ADD PAYMENT
	                 $subscription = //Obtener la subscripción identificada por $_POST['invoice']
	 
	                 //UPDATE SUBSCRIPTION
	                 // We know that the payment has succeeded, so we can modify
	                 // the last_paid fields and set the paypal id
	                 // Using $_POST['txn_id']
	 
	                 //ADD PAYMENT
	                 // We can now add the payment information 
	                 // using $_POST['payer_id'], ['auth_id'] ['mc_gross'] ['payment_status']
	 
	             } elseif ($_POST['payment_status'] == 'failed' ||
	                      $_POST['payment_status'] == 'expired' ||
	                      $_POST['payment_status'] == 'voided') {
	                 // El pago no se ha realizado, eliminar la suscripción
	             }
	 
	         } elseif (!strcmp($res, "INVALID")) {
	             // INVALID - EMAIL FOR INVESTIGATION
	         }
	     }
	     fclose ($fp);
	 }
?> 
     