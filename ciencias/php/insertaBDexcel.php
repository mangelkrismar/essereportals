<?php
    //clases que se requieren de php
    require_once("Classes/PHPExcel.php");
    require_once("Classes/PHPExcel/Reader/Excel2007.php");
    require_once("conexionIns.php");       //Función que nos conecta a la Base de datos

    /*****SE CARGA LA HOJA DE CALCULO*****/
    //Se crea el objeto
    $oRead = new PHPExcel_Reader_Excel2007();

    //Se carga el archivo
    $ophpExcel = $oRead->load('subeUserSina.xlsx');

    //Se asigna la hoja activa
    $ophpExcel->setActiveSheetIndex(0);

    //Para el ciclo
    $i = 2;
    $name = '';   //Para el nombre de usuario
    $clave = '';  //Para la clave
    $query = '';      //Para la sentencia SQL
    $treg = 0;

    $conex = conexionBD();   //Para conectarme a la Base de Datos

    while($ophpExcel->getActiveSheet()->getCell("A".$i)->getValue() != ''){
        $name = $ophpExcel->getActiveSheet()->getCell("A".$i)->getValue();
        $clave = md5($ophpExcel->getActiveSheet()->getCell("B".$i)->getValue());
        
		/*
		echo($name.'****'.$clave.'*****'.$rol.'<br/>');
		echo('Usuario: '.$name.'<br/>');
		echo('Clave  : '.$clave.'<br/>');
   		echo("***".$ophpExcel->getActiveSheet()->getCell("A".$i)->getValue()."***<br><br/>");*/

        //verificamos si el usuario ya etsa dado de alta
        $query = 'SELECT usuario FROM usuarios WHERE usuario="'.$name.'"';
		//echo $query.'<br/>';
		
        $row = mysql_query($query, $conex) or die(mysql_error());
        $trow = mysql_num_rows($row);
        if($trow > 0){
    		echo(mysql_result($row,0,1).' ya dadao de alta con id = '.mysql_result($row,0,0).'<br/>');
        }else{
            $query = 'INSERT INTO usuarios(usuario,password,nombre,apellidos) VALUES("'.$name.'","'.$clave.'","'.$name.'","'.$name.'")';
            mysql_query($query, $conex) or die(mysql_error());
            $treg++;
        }
        $i++;      //Se incrementa el contador
    }
	echo('Total de registros insertados = '.$i);
    echo('Total de registros insertados = '.$treg);


    /*echo('<br/><br/>');
    echo($name.'****'.$clave.'*****'.$rol.'<br/>');
    //Verificamos si el usuario ya esta dado de alta
    $query = 'SELECT id_usuario,usuario FROM usuario WHERE usuario="'.$name.'"';
    $row = mysql_query($query, $conex) or die(mysql_error());
    $trow = mysql_num_rows($row);
    if($trow > 0){
		echo(mysql_result($row,0,1).' ya dadao de alta con id = '.mysql_result($row,0,0));
    }      */

    //$query = 'INSERT INTO usuario(usuario,password,rol) VALUES("'.$name.'","'.$clave.'","'.$rol.'")';
    //mysql_query($query, $conex);
    //echo mysql_insert_id();

    /*echo('E1519872298yp'.'<br/>');
    echo(md5('E1519872298yp'));*/

    //para el query
    //$query = 'SELECT usuario,password,nombre FROM usuario';
    //$rs = mysql_query($query, $conex) or die(mysql_error());   //Se ejecuta el sql
    //$trs = mysql_num_rows($rs);   //Total de registros que tiene
    //echo('los datos : '.$trs);
    //echo('<br/>'.mysql_result($rs,0,0));    //Acceso al primer elemento

    //1.- forma de mostrar los datos de un SELECT
    /*while($row = mysql_fetch_array($rs)){
        echo($row['usuario'].' - '.$row['password'].' - '.$row['nombre'].'<br/>');
    }*/

    //2.- forma de mostrar los datos de un SELECT
    /*while($obj = mysql_fetch_object($rs)){
		echo($obj->usuario.'  -  '.$obj->password.'  -  '.$obj->nombre.'<br/>');
    }*/

?>