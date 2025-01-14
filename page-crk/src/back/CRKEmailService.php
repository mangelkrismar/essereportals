<?php
header('Access-Control-Allow-Origin: *'); 
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Methods: POST, OPTIONS");

init();

function init(){
	//Obtener la información enviada
	//var_dump($_POST);
	$postdata = file_get_contents("php://input");
	$data = json_decode($postdata, TRUE);
	//JWT
	$client_jwt = 'crk-nivel2';

	if($data['jwt'] == $client_jwt){
		$data['success'] = true;
		//Enviar el email a Krismar con la info del usuario
		sendEmail_usr($data['name'], $data['email']);
		//Enviar el email al usuario para confirmar el contacto
		sendEmail_krs($data['name'], $data['email'], $data['insti'], $data['phone'], $data['mssg']);
		die();
	}
	echo json_encode($data);
}

function sendEmail_usr($name,$email){
	$destinatario =  $email;
	$asunto = "Hola ".$name.", gracias por contactarnos";
	$cuerpo = '<html>
					<head>
						<title>Gracias por ponerte en contacto con nosotros</title>
						<style>
							body{
								text-align: center;
								position:absolute;
								top: 0;
								left: 0;
								margin-top:0;
								margin-left:0;
								font-family: Calibri;
								width: 100%;
								height: 100%;
							}
							h1,h3{
								color: #12619B;
							}
							a{
								color: #12619B;
							}
							p{
								color: #4d4d4d;
							}
							img{
								width: 100%;
							}
							div{
								width:54%;
								display:table;
								margin:auto;
								margin-top:10px;
								margin-bottom:10px;
								border: 1px solid #4d4d4d;
								box-sizing:border-box;
								padding: 10px;
							}
							b{
								//display:table;
							}
							@media only screen and (max-width: 500px) {
								div{
										width:100%;
									}
								}
							</style>
						</head>
						<body>
							Gracias por contactarnos, tendremos en cuenta tus comentarios.
						</body>
						</html>';

	//para el envío en formato HTML
	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=utf-8\r\n";    //Para que podamos ver los acentos y ñ en nuestros correos
	$headers .= "From: Soporte CRK <soporte@crk.lat>\r\n";
	mail($destinatario, $asunto, $cuerpo, $headers);   //Aqui se envia el correo	
}	

function sendEmail_krs($name, $email, $insti, $phone, $mssg){
	$destinatario =  'soporte@crk.lat';
	$asunto = "Alguien quiere contactarse contigo";
	$cuerpo = '<html>
					<head>
						<title>'.$name.' te ha escrito.</title>
						<style>
							body{
								text-align: center;
								position:absolute;
								top: 0;
								left: 0;
								margin-top:0;
								margin-left:0;
								font-family: Calibri;
								width: 100%;
								height: 100%;
							}
							h1,h3{
								color: #12619B;
							}
							a{
								color: #12619B;
							}
							p{
								color: #4d4d4d;
							}
							img{
								width: 100%;
							}
							div{
								width:54%;
								display:table;
								margin:auto;
								margin-top:10px;
								margin-bottom:10px;
								border: 1px solid #4d4d4d;
								box-sizing:border-box;
								padding: 10px;
							}
							b{
								//display:table;
							}
							@media only screen and (max-width: 500px) {
								div{
										width:100%;
									}
								}
							</style>
						</head>
						<body>
							'.$name.' de '.$insti.' te ha escrito.<br><br>
							Dejó el siguiente mensaje:<br><br>
							'.$mssg.'
							<br><br>
							Sus datos:<br>
							Teléfono: '.$phone.'<br>
							Correo: '.$email.'
						</body>
						</html>';

	//para el envío en formato HTML
	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=utf-8\r\n";
	mail($destinatario, $asunto, $cuerpo, $headers);   //Aqui se envia el correo	
}

?>