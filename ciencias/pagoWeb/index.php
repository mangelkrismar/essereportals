<?php session_start(); 
$correo = $_REQUEST['correo1'];

 ?>
<?php 
 	$ruta = "secure/"; //Variable para guardar la ruta hacia la clase  Class.PayPalEWP.php 
	$cert_id = 'K6VAQ7DDLCL3U'; //Id del certificado 
	include($ruta ."Class.PayPalEWP.php"); //Ruta hacia la clase  
	$paypal = new PayPalEWP();     //Se crea un objeto nuevo de paypal
	$paypal->setTempFileDirectory($ruta ."/tmp"); // HAY que crear una carpeta tmp en el directorio de la clase 
	$paypal->setCertificate($ruta ."my-pubcert.pem", $ruta ."my-prvkey.pem");    //Para los certificados y encriptar los datos
	$paypal->setPayPalCertificate($ruta ."paypal_cert_pem.txt");          //Certificado de validadcion generado en la web
	$paypal->setCertificateID($cert_id);          //Asiganamos el ID de certificado
	
	$boton1 = array( 
	        'cmd' => '_xclick',                                  	        			//Tipo de boton
	        'cert_id' => $cert_id, 								 	        			//ID del certificado
	        'business' => 'paypalkrismar@krismar.com.mx', 				  	        			//Correo de quien vende; empresa que vende
	        'item_name' => 'Licencia anual portal La pandilla',       	       		 		// Nombre del objeto que vendemos 
	        'currency_code' => 'MXN',                            	       		 		//Tipo de moneda 
	        'amount' => '500.00', 
            //'amount' => '5.00',
	        'lc' => 'ES',                                         	        			//Idioma 
	        'no_note' => '0',                                     	        				//1-0 Mostrar cuadro de texto 
	        'no_shipping' => '1',                                 	         					//Evitar que se pregunte por una dirección de entrega
	        'shopping_url' => 'http://www.pandilla.mdt.mx/pagoWeb/',		  	         //La URL de mi web de venta
	        'rm' => '2',										  	         					//la forma en que se enviaran los datos de paypal a nuestra web (1:GET; 2:POST)
	        'return' => 'http://www.pandilla.mdt.mx/aprobado.php',             //Url de retorno a la que nos devuelve paypal al comprar (incluido en el tuto) 
	        'cancel_return' => 'http://www.pandilla.mdt.mx/cancelado.php',     //Url a la que nos devuelve al cancelar la compra 
	        'notify_url' => 'http://www.pandilla.mdt.mx/pagoWeb/prueba.php?correoE='.urlencode($correo),          //Url de notificación dónde se realiza el IPN (incluido en el tuto) 
	        'cbt' => 'Regresar al sitio',								     					//Texto del boton de regreso
	        'country' => 'MX'								      	         					//Para que nos dirija a paypal México
	    ); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width = device-width, maximum-scale = 1, user-scalable=no">
<script src="../js/jquery-1.12.1.js" type="text/javascript"></script>

<link rel="stylesheet" href="../css/estilosDiseno.css" />
<title>La Pandilla</title>
        <script type="text/javascript">
          function clickButton(){
            document.getElementById('push').click();
          }

        </script>
</head>
	<body onload="clickButton()"><!-- -->
	<header class="d_header">
            <div class="d_header_in">
                <a href="http://www.sandbox.krismar.com.mx/" target="_blank"><div class="d_header_krismar"></div></a>
                <div class="d_header_ingresar" id="p_ingresar" hidden></div><!--DESPLIEGA EL EMERGENTE PARA INICIAR SESI�N-->
                <div class="d_header_cerrarSesion" hidden></div><!--TERMINA LA SESI�N-->
            </div>
            <div class="d_header_pleca"></div>
     </header>
     <section class="d_inicio" hiddn>
      <div class="d_inicio_temasEsp"></div>
            <div class="d_inicio_temasEsp"></div>
            <div class="d_inicio_temasEsp"></div>
      	<div class="d_demos_gral">
                <div class="d_demos">
                    <table class="d_demosTXT"><tr><td>Ingresando al sitio, espere....</td></tr></table>
                </div>
            </div>
            <div class="d_linea"></div>
      </section>
	
        
		<div id="formula">
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
				<input type="hidden" name="cmd" value="_s-xclick"> 
      			<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----<?php echo $paypal->encryptButton($boton1); ?>-----END PKCS7-----"/> 
				<input type="image" src="http://www.paypal.com/es_XC/i/btn/x-click-but01.gif" id="push" style="display:none;" name="submit" alt="¡Realice pagos con PayPal - es rápido, gratis y seguro!">	
			</form>
		</div>
	</body>
</html>
