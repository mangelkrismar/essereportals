<?php
    function conexionBD(){
        //Datos para la conexion a la bd
        $user = 'mdt_krismarapps';  //Usuario de la Base de datos
        $pass = 'krismarapps??123';  //Passwor de la Base de datos
        $servi = 'localhost'; //Servidor a donde se conecta
        $db = 'mdt_pandilla';  //Nombre de la Base de Datos

        if(!$conex = @mysql_connect($servi, $user, $pass)){
            echo 'Error al conexio a MySQL';
            exit();
        }else{
		    if(!@mysql_select_db($db, $conex)){
		        echo('Error al seleccionar la Base de Datos');
                exit();
		    }else{
		        //echo('Conexión establecida con exito...');
		        return $conex;   //Se regresa el lin k de la conexion
		    }
        }
    }
?>