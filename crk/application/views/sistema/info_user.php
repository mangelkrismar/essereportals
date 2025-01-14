<?
function getDiaEspanol($diaIngles){
	switch($diaIngles){
		case "Monday":
			return "Lunes";
		break;
		case "Tuesday":
			return "Martes";
		break;
		case "Wednesday":
			return "Miércoles";
		break;
		case "Thursday":
			return "Jueves";
		break;
		case "Friday":
			return "Viernes";
		break;
		case "Saturday":
			return "Sabado";
		break;
		case "Sunday":
			return "Domingo";
		break;
	}
}

function getMesEspanol($mesIngles){
	switch($mesIngles){
		case "Jan":
			return "Enero";
		break;
		case "Feb":
			return "Febrero";
		break;
		case "Mar":
			return "Marzo";
		break;
		case "Apr":
			return "Abril";
		break;
		case "May":
			return "Mayo";
		break;
		case "Jun":
			return "Junio";
		break;
		case "Jul":
			return "Julio";
		break;
		case "Aug":
			return "Agosto";
		break;
		case "Sep":
			return "Septiembre";
		break;
		case "Oct":
			return "Octubre";
		break;
		case "Nov":
			return "Noviembre";
		break;
		case "Dec":
			return "Diciembre";
		break;
	}
}

?>
<div class="p_emertitle">Información</div>
<div class="p_emerfoto">
	<div class="p_emerfotoin">
		<?
			if($datosUser->imagen == ""){
		?>
		<img class="p_emerfotoimg" src="<?=base_url()?>/src/img/p_emergentefoto.png" onload = "/*colocaEmergente()*/">
		<?
			}else{
		?>
		<img class="p_emerfotoimg" src="data:image/png;base64,<?=$datosUser->imagen?>" onload = "/*colocaEmergente()*/">
		<?
			}
		?>
	</div>
</div>
<table class="p_emertable">
	<!--DATOS DEL USUARIO-->
	<tr>
		<td>País:</td>
		<td><?
		foreach($this->paises as $pais){
			if($pais == $datosUser->country){
				prev($this->paises);
				echo key($this->paises);
			}
		}		
		?></td>
	</tr>
	<tr>
		<td>Ciudad:</td>
		<td><?=$datosUser->city?></td>
	</tr>
	
	<tr>
		<td>Primer acceso:</td>
		
		<td><?=date("j",$datosUser->firstaccess)." de ".getMesEspanol(date("M",$datosUser->firstaccess))." de ".date("Y",$datosUser->lastaccess)?></td>
	</tr>
	<tr>
		<td>Último acceso:</td>
		<td><?=date("j",$datosUser->lastaccess)." de ".getMesEspanol(date("M",$datosUser->lastaccess))." de ".date("Y",$datosUser->lastaccess)?></td>
	</tr>
</table>
<div class="p_emerbtn" onclick = "muestraEmergente($('#edita_pass'))">
	<input type ="submit" class="p_emerbtnin" value ="CAMBIAR CONTRASEÑA"/>
</div>
<div class="p_emerbtn" onclick = "muestraEmergente($('#edita_info'), recuperaEditaDatosUsuario)">
	<input type ="submit" class="p_emerbtnin" value ="EDITAR INFORMACIÓN"/>
</div>
