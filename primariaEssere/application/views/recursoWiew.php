<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
	
	
	//Comprobamos que la variable exista
	if(isset($link)){
		
		$id = $link;
		
		if(is_numeric($id)){
			$link = 'http://localhost/KrismarApps/recurso/cargarApp/'.$id;
		}else{
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=http://localhost/primaria'>";
		}
	}else{
		echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=http://localhost/primaria'>";
	}
	
	
?>



<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Biblioteca Virtual</title>
        <script type="text/javascript">
          function clickButton(){
            document.getElementById('push').click();
			
			//window.history.back();
			 //alert (window.history.state+" hi");
			 //console.log("La ruta es : "+window.history.back());
          }
        </script>
	</head>
	<body onload="clickButton()">
        Accediendo al recurso, espere....
		<div id="formula">
			<form action="<?echo $link;?>" method="post" name="formLogin" id="formLogin">
		    	<div align="center">
		            <input type="hidden" name="nombre" value="<?echo $id;?>" />
		            <br>
		            <input type="hidden" name="password" value="dos" />
					<input type="hidden" name="sina" value="uno" />
		            <br>
		            <input id="push" name="submit" type="submit" value="Ingresar" style='display:none;' />
				  </p>
				</div>
			</form>
		</div>
	</body>
</html>