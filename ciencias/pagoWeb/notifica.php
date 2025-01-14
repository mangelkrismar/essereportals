<?php 
    header("Content-Type: text/html;charset=utf-8");
    //Se incluyen las librerias necesarias
    //include("conexBD.php");   //Parfa la conexion

    /*********/
    /*$conn = Conectarse();
    $query = 'UPDATE pandilla_user SET activo=1, fCompra='.date("Y-m-d").' WHERE id = 1';
    mysql_query($query,$conn);  */

    /**********/

    
    $ip_remote = $_SERVER['REMOTE_ADDR'];    //Guardo la IP desde la que se realiza la petición, no es necesario 
    $comentario = ''; 

    // Primera comprobación. Comprobamos que haya variables pasadas por POST (como nos las pasa PayPal) 
    if($_POST){ 
     
        //************TRATAMIENTO DE INFO 
        // Obtenemos los datos en formato variable1=valor1&variable2=valor2&... 
        $raw_post_data = file_get_contents('php://input'); 

        // Los separamos en un array 
        $raw_post_array = explode('&',$raw_post_data); 

        // Separamos cada uno en un array de variable y valor 
        $myPost = array(); 
        foreach($raw_post_array as $keyval){ 
            $keyval = explode("=",$keyval); 
            if(count($keyval) == 2) 
                $myPost[$keyval[0]] = urldecode($keyval[1]); 
        } 

        //Nos comunicaremos con PayPal para verificar que la información es suya  
       //para ello nuestro string debe comenzar con cmd=_notify-validate 
        $req = 'cmd=_notify-validate'; 
        if(function_exists('get_magic_quotes_gpc')){ 
            $get_magic_quotes_exists = true; 
        } 
        foreach($myPost as $key => $value){ 
            // Cada valor se trata con urlencode para poder pasarlo por GET 
            if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) { 
                $value = urlencode(stripslashes($value));  
            } else { 
                $value = urlencode($value); 
            } 

            //Añadimos cada variable y cada valor 
            $req .= "&$key=$value"; 
        } 
         
        //********ENVIO DE INFO 
        // Esta URL debe variar dependiendo si usamos SandBox o no. Si no lo usamos, se queda así. 
        $ch = curl_init('https://www.paypal.com/cgi-bin/webscr');    
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1); 
        curl_setopt($ch, CURLOPT_POST, 1); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); 
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close')); 

        if( !($res = curl_exec($ch)) ) { 
            // Error con la petición de Curl. 
            curl_close($ch); 
            $comentario = "Error Curl IPN"; 
            //Guardo datos y $comentario en el Log de la DB 
            exit; //Paramos la ejecución 
        } 
        curl_close($ch); 
          
        //******RECIBIDA CONTESTACION 
        if (strcmp ($res, "VERIFIED") == 0) { //PayPal nos verifica que la Info es correcta 

         
            $item_name = $_POST['item_name']; 
            $payment_status = $_POST['payment_status'];       //Estado de la compra
            $payment_amount = $_POST['mc_gross']; 
            $payment_currency = $_POST['mc_currency']; 
            $txn_id = $_POST['txn_id'];                    
            $receiver_email = $_POST['receiver_email']; 
            $c_email = $_POST['payer_email'];              //Correo del usuario que realizo la compra
            $date = date('Y-m-d H:i:s',strtotime($_POST['payment_date'])); //Fecha en formato MySQL 
            $custom= $_POST['custom']; 
            $invoice= $_POST['invoice'];
            $claveU = gClave();           //Se genera la clave del usuario para su acceso
            

            /**Hacemos algunas comprobaciones extraordinarias 
             * * Comprobar que $_POST["payment_status"] tenga el valor "Completed", que nos confirma el pago como completado. 
             * * Tambien podemos aceptar Processed 
             strtotime  //para la fecha a unix
             **/ 
            if($payment_status=='Completed' || $payment_status=='Processed' ) { 
            /** 
             * *Comprobar que el email al que va dirigido el pago sea nuestro email principal de PayPal 
             **/ 
                if($receiver_email == 'paypalkrismar@krismar.com.mx'){ 
                /** 
                 * *Ahora podríamos hacer otras comprobaciones como 
                 * * Comprobar que no hemos tratado antes la misma id de transacción (txd_id) 
                 * * Comprobar que la cantidad y la divisa son correctas 
                 */ 
                    //Para la conexion a la base de datos
                   

                    /******ENVIO DE MAIL VIA PHP************/

                    $destinatario = "daniel@krismar.com.mx";   /*Aqui va el correo del usuario q compro*/
                    $asunto = "Cuenta de acceso a la Pandilla del conocimiento"; 
                    $cuerpo = '<html> 
                    <head> 
                       <title>Usuario y contraseña</title> 
                    </head> 
                    <body> 
                    <h1>Gracias por tu compra!</h1> 
                    <p> 
                    <b>"Bienvenido al maravilloso mundo de la pandilla del conocimiento"</b>.<br/> Estamos muy agradecidos de que nos prefieras. 
                    </p> 

                    <br>
                    <b>Tus datos de acceso son:</b><br>
                    <b>Usuario: </b><br/> 
                    <b>contraseña: </b><br/><br/>
                    <b>Link de acceso via pc: </b><a href="http://www.pandilla.novaschool.mx">http://www.pandilla.novaschool.mx</a><br/>
                    <br/>
                    <br/>
                    Atentamente<br/>
                    <a href="http://www.novaschool.mx" >Krismar Computación</a><br/>
                    Gracias por tu preferencia
                    </body> 
                    </html>'; 

                    /*$cuerpo = ' 
                    <html> 
                    <head> 
                       <title>Usuario y contraseña</title> 
                    </head> 
                    <body> 
                    <h1>Gracias por tu compra!</h1> 
                    <p> 
                    <b>"Bienvenido al maravilloso mundo de la pandilla del conocimiento"</b>.<br/> Estamos muy agradecidos de que nos prefieras. 
                    </p> 

                    <br>
                    <b>Tus datos de acceso son:</b><br>
                    <b>Id transacción: </b>'.$qry.'<br/>
                    <b>Usuario: </b>'.$nUsu.'<br/> 
                    <b>Correo: </b>'.$c_email.'<br/>
                    <b>Fecha Normal: </b>'.$date.'<br/>
                    <b>Fecha Unix: </b>'.strtotime($date).'<br/>
                    <b>Clave del usuario: </b>'.$claveU.'<br/>
                    <b>Total de usuarios: </b>'.$trow.'<br/>
                    <b>Id del usuario: </b>'.$idUsu.'<br/>
                    <b>Link de acceso via pc: </b><a href="http://www.pandilla.novaschool.mx">http://www.pandilla.novaschool.mx</a><br/>
                    <br/>
                    <br/>
                    Atentamente<br/>
                    <a href="http://www.novaschool.mx" >Krismar Computación</a> y <a href="http://www.ghia.com.mx">GHIA</a>
                    </body> 
                    </html> 
                    '; */

                    //para el envío en formato HTML 
                    $headers = "MIME-Version: 1.0\r\n"; 
                    $headers .= "Content-type: text/html; charset=utf-8\r\n";    //Para que podamos ver los acentos y ñ en nuestros correos

                    //dirección del remitente 
                    $headers .= "From: ventas <ventas@krismar.com.mx>\r\n"; 

                    //dirección de respuesta, si queremos que sea distinta que la del remitente 
                    $headers .= "Reply-To: ventas@krismar.com.mx\r\n"; 

                    //ruta del mensaje desde origen a destino 
                    $headers .= "Return-path: ventas@krismar.com.mx\r\n"; 

                    //direcciones que recibián copia 
                    //$headers .= "Cc: maria@desarrolloweb.com\r\n"; 

                    //direcciones que recibirán copia oculta 
                    //$headers .= "Bcc: pepe@pepe.com,juan@juan.com\r\n"; 

                    mail($destinatario,$asunto,$cuerpo,$headers);
                    /*******************/

                 
                /**Después de las comprobaciones, toca el procesamiento de los datos. 
                 * En este punto tratamos la información. 
                 * Podemos hacer con ella muchas cosas: 
                 *  
                 * * Guardarla en una base de datos. 
                 * * Guardar cada linea del pedido en una linea diferente en la base de datos. 
                 * * Guardar un log. 
                 * * Restar las cantidades de los artículos del stock. 
                 * * Enviar un mensaje de confirmcaión al cliente. 
                 * * Enviar un mensaje al encargado de pedidos para que lo prepare. 
                 * * etc 
                 */             
                }else{ 
                    $comentario = "Reciever email manipulado (".$receiver_email.")";
                } 
            }else{ 
              $comentario = "Payment_status inválido (".$payment_status.")/".$comentario; 
            } 
        }elseif(strcmp ($res, "INVALID") == 0){ 
            // El estado que devuelve es INVALIDO, la información no ha sido enviada por PayPal.  
            $comentario = "INVALID, informacion no enviada por PayPal/".$comentario; 
        }  
    }else{     
         // Si no hay datos $_POST podría tratarse de un acceso directo, para eso la IP 
        $comentario = "Acceso sin variables POST/".$comentario; 
    } 
    if($comentario != ''){  
        //Si comentario tiene contenido es que hubo un error 
        //Guardamos el comentario, la IP y toda la info que queramos en un log en la DB 
        if(!$_POST )echo '<meta http-equiv="Refresh" content="0;url=index.html" />'; 
    } 


  


    //funcion para generar la clave al usuario
    function gClave(){
        $mayu = Array("A","B","C","D","E","F","G","H","J","K","L","M","N","P","Q","R","S","T","U","V","X","Y","Z");
        $minu = Array("a","b","c","d","e","f","g","h","j","k","m","n","p","q","r","s","t","u","v","w","x","y","z");
        $cla = Array("Azul","Demo","Agua","Tierra","Rojo","Krismar","Verde","Naranja","Dorado","Amarillo","Negro","Tabla","cdROM","DVDrom","Hoja","Torre","Tablet","Android","Ventana","Alex","Mate","Monitor");   //Para las nuevas claves de la plataforma

        $cara = Array("*","+","/","#","=","$");      //Par los demos
        $clave = "";
        $claved = "";
        $p1 = 0;
        $p2 = 0;
        $p3 = 0;


        for ( $i = 1 ; $i <= 1000 ; $i ++) {
            $p1 = rand(0,(count($mayu)-1));
            $p2 = rand(0,(count($mayu)-1));
            $p3 = rand(0,(count($mayu)-1));
            $p4 = rand(0,(count($minu)-1));
            $p5 = rand(0,(count($cara)-1));
            $p6 = rand(0,(count($cla)-1));

            $clave = crc32($i.$p1.$p5);
            $clave = crc32($clave.$p4);
            $clave = trim($clave,"-");
            $clave = substr($clave,0,6);

            $clave = trim($clave,"-");

            $claved = $cla[$p6];
            $pt1 = $claved.$clave;

            $pt2 = substr($pt1,0,10);   //para obtener la clave
            
             return strtoupper($pt2);   //Regresamos la clave
        }
    }

?> 
     