<?php 
$ruta = 'secure/' //Variable para guardar la ruta hacia la clase  Class.PayPalEWP.php 
$cert_id = 'XXXXXXXXXX'; //Id del certificado 
include($ruta ."Class.PayPalEWP.php"); //Ruta hacia la clase  
$paypal = new PayPalEWP(); 
$paypal->setTempFileDirectory($ruta ."tmp"); // HAY que crear una carpeta tmp en el directorio de la clase 
$paypal->setCertificate($ruta ."my-pubcert.pem", $ruta ."my-prvkey.pem"); 
$paypal->setPayPalCertificate($ruta ."paypal_cert_pem.txt"); 
$paypal->setCertificateID($cert_id);  

$boton1 = array( 
        'cmd' => '_xclick', 
        'cert_id' => $cert_id, 
        'business' => 'emaildepaypal@dominio.com',                 
        'receiver_email' => 'emailbeneficiario@dominio.com',                 
        'custom' => 'Datos personalizados a mayores',         //Por si quieres añadir algún dato más 
        'item_name' => 'Nombre del objeto',                   // Nombre del objeto que vendemos 
        'currency_code' => 'EUR',                             //Tipo de moneda 
        'amount' => '10',                                     //Precio 
        'lc' => 'ES',                                         //Idioma 
        'no_note' => '1',                                     //1-0 Mostrar cuadro de texto 
        'no_shipping' => '1',                                  
        'return' => 'http://urlDeRetorno',                    //Url de retorno a la que nos devuelve paypal al comprar (incluido en el tuto) 
        'cancel_return' => 'http://urlDeRetorno',             //Url a la que nos devuelve al cancelar la compra 
        'notify_url' => 'http://urlDeRetorno',                //Url de notificación dónde se realiza el IPN (incluido en el tuto) 
        'cbt' => 'Texto Voler a mi página' 
    ); 
?> 
      <form action="https://www.paypal.com/cgi-bin/webscr" method="post"> 
      <input type="hidden" name="cmd" value="_s-xclick"> 
      <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----<?php echo $paypal->encryptButton($boton1); ?>-----END PKCS7-----"/> 
      <input type="image" src="https://www.paypal.com/es_XC/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal, la forma más segura y rápida de pagar en línea."> 
      <img alt="" border="0" src="https://www.paypal.com/es_XC/i/scr/pixel.gif" width="1" height="1"> 
      </form>