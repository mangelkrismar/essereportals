<?php
function Conecta(){
   if (!($link1=mysql_connect("localhost","krismarc_userPla","*_fw#MrFGD_6")))
   {
      echo "Error conectando a la base de datos.";
      exit();
   }

   if (!mysql_select_db("krismarc_userPlataformas",$link1))
   {
      echo "Error seleccionando la base de datos.";
      exit();
   }
   
   //Regresar la conexion activa
   return $link1;
}

//header(”Content-type: text/xml”);

//$link=Conectarse();
//echo "Conexión con la base de datos conseguida.<br>";

//mysql_close($link); //cierra la conexion
?>