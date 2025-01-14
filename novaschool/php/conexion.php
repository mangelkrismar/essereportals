<?php
	 // Se conecta al SGBD 
  	if(!($iden = mysql_connect("localhost", "krismarc_page", "+Ic?RZkrW{Hv"))) 
    	die("Error: No se pudo conectar");
	
  	// Selecciona la base de datos 
  	if(!mysql_select_db("krismarc_techtools", $iden)) 
    	die("Error: No existe la base de datos");
    mysql_set_charset('utf8');
?>