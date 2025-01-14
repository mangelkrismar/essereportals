<script type="text/javascript">
    document.title = 'Biblioteca Multimedia';
</script>

<?php
function Conectarse(){
	//Definimos las variables
	$host='localhost';
	$user='krismarc_cvaPand';
	$pass='t3?J8CJML{to';
	$dbname='krismarc_cvaPandilla';

    //Para la conexion al servidor
 if (!($link=@mysql_connect($host,$user,$pass)))
   {
      echo "Error conectando a la base de datos.";
      exit();
   }

   if (!mysql_select_db($dbname,$link))
   {
      echo "Error seleccionando la base de datos.";
      exit();
   }
   return $link;
}

//$link=Conectarse();
echo "Conexión con la base de datos conseguida.<br>";

//mysql_close($link); //cierra la conexion
?>