<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
	/*require_once("/home/smsem/public_html/BVirtual/config.php");
 	require_login();*/
?>

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link type="text/css" rel="stylesheet" href="stylo.css" />
		<title>Biblioteca Virtual</title>
        <script type="text/javascript">
          function clickButton(){
            document.getElementById('push').click();
          }
        </script>
	</head>
	<body onload="clickButton()">
        Ingresando al sitio, espere....
		<div id="formula">
			<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
				<input type="hidden" name="cmd" value="_xclick">
				<input type="hidden" name="business" value="paypal-facilitator@krismar.com.mx">
				<input type="hidden" name="item_name" value="La pandilla del conocimiento">
				<input type="hidden" name="currency_code" value="MXN">
				<input type="hidden" name="amount" value="200.00">
				<input type="hidden" name="no_shipping" value="1">  
				<input type="image" src="http://www.paypal.com/es_XC/i/btn/x-click-but01.gif" id="push" style='display:none;' name="submit" alt="¡Realice pagos con PayPal - es rápido, gratis y seguro!">				
			</form>
		</div>
	</body>
</html>
