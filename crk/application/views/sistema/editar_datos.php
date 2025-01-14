<?
	//print_r($datosUsuario);
?>
	<form id = "datoseditauser" enctype="multipart/form-data" method="post">
                <div class="p_emertitle">Editar información</div>
				<div class="p_emertexto" id = "msj_info"></div>
                <div class="p_emerdatos">
                    <div class="p_emerdatostxt">Nombre</div>
                    <input required name = "firstname" class="p_emerdatosinput" type="text" placeholder="Nombre" value = "<?=$datosUsuario->firstname?>">
                </div>
                <div class="p_emerdatos">
                    <div class="p_emerdatostxt">Apellido</div>
                    <input name = "lastname" class="p_emerdatosinput" type="text" placeholder="Apellido" value = "<?=$datosUsuario->lastname?>">
                </div>
                <div class="p_emerdatos">
                    <div class="p_emerdatostxt">Dirección de correo</div>
                    <input name = "email" class="p_emerdatosinput" type="email" placeholder="nombre@correo.com.mx" value = "<?=$datosUsuario->email?>">
                </div>
                <!--div class="p_emerdatos">
                    <div class="p_emerdatostxt">Mostrar correo</div>
                    <select class="p_emerdatosselect">
                        <option>Mostrar a todos mi dirección de correo</option>
                        <option>Mostrar mi dirección de correo sólo a mis compañeros de curso</option>
                        <option>Ocultar a todos mi dirección de correo</option>
                    </select>
                </div-->
                <!--div class="p_emerdatos">
                    <div class="p_emerdatostxt">Correo activado</div>
                    <select class="p_emerdatosselect">
                        <option>La dirección de correo está habilitada</option>
                        <option>La dirección de correo no está habilitada</option>
                    </select>
                </div-->
                <div class="p_emerdatos">
                    <div class="p_emerdatostxt">Ciudad</div>
                    <input name = "city" class="p_emerdatosinput" type="text" placeholder="Ciudad" value = "<?=$datosUsuario->city?>">
                </div>
                <div class="p_emerdatos">
                    <div class="p_emerdatostxt">Seleccione su país</div>
                    <select name = "country" class="p_emerdatosselect" value = "<?=$datosUsuario->country?>">
                        <option value="">Seleccione su país...</option>
                        <?
						
						
						$opciones =
						[
                        '<option value="AF">Afganistán</option>',
                        '<option value="AL">Albania</option>',
                        '<option value="DE">Alemania</option>',
                        '<option value="AD">Andorra</option>',
                        '<option value="AO">Angola</option>',
                        '<option value="AI">Anguila</option>',
                        '<option value="AQ">Antártida</option>',
                        '<option value="AG">Antigua y Barbuda</option>',
                        '<option value="AN">Antillas Holandesas</option>',
                        '<option value="SA">Arabia Saudita</option>',
                        '<option value="DZ">Argelia</option>',
                        '<option value="AR">Argentina</option>',
                        '<option value="AM">Armenia</option>',
                        '<option value="AW">Aruba</option>',
                        '<option value="AU">Australia</option>',
                        '<option value="AT">Austria</option>',
                        '<option value="AZ">Azerbaiyán</option>',
                        '<option value="BS">Bahamas</option>',
                        '<option value="BH">Bahrein</option>',
                        '<option value="BD">Bangladesh</option>',
                        '<option value="BB">Barbados</option>',
                        '<option value="BE">Bélgica</option>',
                        '<option value="BZ">Belice</option>',
                        '<option value="BJ">Benin</option>',
                        '<option value="BM">Bermuda</option>',
                        '<option value="BY">Bielorrusia</option>',
                        '<option value="BO">Bolivia</option>',
                        '<option value="BA">Bosnia y Herzegovina</option>',
                        '<option value="BW">Botswana</option>',
                        '<option value="BR">Brasil</option>',
                        '<option value="BN">Brunei Darussalam</option>',
                        '<option value="BG">Bulgaria</option>',
                        '<option value="BF">Burkina Faso</option>',
                        '<option value="BI">Burundi</option>',
                        '<option value="BT">Bután</option>',
                        '<option value="CV">Cabo Verde</option>',
                        '<option value="KH">Camboya</option>',
                        '<option value="CM">Camerún</option>',
                        '<option value="CA">Canadá</option>',
                        '<option value="TD">Chad</option>',
                        '<option value="CL">Chile</option>',
                        '<option value="CN">China</option>',
                        '<option value="CY">Chipre</option>',
                        '<option value="CO">Colombia</option>',
                        '<option value="KM">Comoras</option>',
                        '<option value="CG">Congo</option>',
                        '<option value="CD">Congo, República Democrática del</option>',
                        '<option value="KP">Corea del Norte</option>',
                        '<option value="KR">Corea del Sur</option>',
                        '<option value="CI">Costa de Marfil</option>',
                        '<option value="CR">Costa Rica</option>',
                        '<option value="HR">Croacia</option>',
                        '<option value="CU">Cuba</option>',
                        '<option value="DK">Dinamarca</option>',
                        '<option value="DJ">Djibouti</option>',
                        '<option value="DM">Dominica</option>',
                        '<option value="EC">Ecuador</option>',
                        '<option value="EG">Egipto</option>',
                        '<option value="SV">El Salvador</option>',
                        '<option value="VA">El Vaticano</option>',
                        '<option value="AE">Emiratos Árabes Unidos</option>',
                        '<option value="ER">Eritrea</option>',
                        '<option value="SK">Eslovaquia</option>',
                        '<option value="SI">Eslovenia</option>',
                        '<option value="ES">España</option>',
                        '<option value="US">Estados Unidos</option>',
                        '<option value="EE">Estonia</option>',
                        '<option value="ET">Etiopía</option>',
                        '<option value="RU">Federación Rusa</option>',
                        '<option value="FJ">Fiji</option>',
                        '<option value="PH">Filipinas</option>',
                        '<option value="FI">Finlandia</option>',
                        '<option value="FR">Francia</option>',
                        '<option value="FX">Francia Metropolitana</option>',
                        '<option value="GA">Gabón</option>',
                        '<option value="WA">Gales</option>',
                        '<option value="GM">Gambia</option>',
                        '<option value="GE">Georgia</option>',
                        '<option value="GS">Georgia del Sur e Islas Sandwich del Sur</option>',
                        '<option value="GH">Ghana</option>',
                        '<option value="GI">Gibraltar</option>',
                        '<option value="GD">Granada</option>',
                        '<option value="GR">Grecia</option>',
                        '<option value="GL">Groenlandia</option>',
                        '<option value="GP">Guadalupe</option>',
                        '<option value="GU">Guam</option>',
                        '<option value="GT">Guatemala</option>',
                        '<option value="GG">Guernsey</option>',
                        '<option value="GN">Guinea</option>',
                        '<option value="GW">Guinea-Bissau</option>',
                        '<option value="GQ">Guinea Ecuatorial</option>',
                        '<option value="GY">Guyana</option>',
                        '<option value="GF">Guyana Francesa</option>',
                        '<option value="HT">Haití</option>',
                        '<option value="NL">Holanda</option>',
                        '<option value="HN">Honduras</option>',
                        '<option value="HK">Hong Kong</option>',
                        '<option value="HU">Hungría</option>',
                        '<option value="IN">India</option>',
                        '<option value="ID">Indonesia</option>',
                        '<option value="IQ">Irak</option>',
                        '<option value="IR">Irán</option>',
                        '<option value="IE">Irlanda</option>',
                        '<option value="IM">Isla de Man</option>',
                        '<option value="IS">Islandia</option>',
                        '<option value="AX">Islas Åland</option>',
                        '<option value="BV">Islas Bouvet</option>',
                        '<option value="KY">Islas Caimán</option>',
                        '<option value="CC">Islas Cocos</option>',
                        '<option value="CK">Islas Cook</option>',
                        '<option value="CX">Islas de Navidad</option>',
                        '<option value="FO">Islas Faroe</option>',
                        '<option value="HM">Islas Heard y McDonald</option>',
                        '<option value="FK">Islas Malvinas</option>',
                        '<option value="MP">Islas Marianas del Norte</option>',
                        '<option value="MH">Islas Marshall</option>',
                        '<option value="NF">Islas Norfolk</option>',
                        '<option value="SB">Islas Salomón</option>',
                        '<option value="SJ">Islas Svalbard y Jan Mayen</option>',
                        '<option value="TC">Islas Turcas y Caicos</option>',
                        '<option value="VI">Islas Vírgenes (Americanas)</option>',
                        '<option value="VG">Islas Vírgenes (Británícas)</option>',
                        '<option value="WF">Islas Wallis y Futuna</option>',
                        '<option value="IL">Israel</option>',
                        '<option value="IT">Italia</option>',
                        '<option value="LY">Jamahiriya Árabe Libia</option>',
                        '<option value="JM">Jamaica</option>',
                        '<option value="JP">Japón</option>',
                        '<option value="JE">Jersey</option>',
                        '<option value="JO">Jordania</option>',
                        '<option value="KZ">Kazajstán</option>',
                        '<option value="KE">Kenia</option>',
                        '<option value="KG">Kirguistán</option>',
                        '<option value="KI">Kiribati</option>',
                        '<option value="KO">Kosovo</option>',
                        '<option value="KW">Kuwait</option>',
                        '<option value="LA">Laos</option>',
                        '<option value="LV">Latvia</option>',
                        '<option value="LS">Lesotho</option>',
                        '<option value="LB">Líbano</option>',
                        '<option value="LR">Liberia</option>',
                        '<option value="LI">Liechtenstein</option>',
                        '<option value="LT">Lituania</option>',
                        '<option value="LU">Luxemburgo</option>',
                        '<option value="MO">Macao</option>',
                        '<option value="MK">Macedonia</option>',
                        '<option value="MG">Madagascar</option>',
                        '<option value="MY">Malasia</option>',
                        '<option value="MW">Malawi</option>',
                        '<option value="MV">Maldivas</option>',
                        '<option value="ML">Mali</option>',
                        '<option value="MT">Malta</option>',
                        '<option value="MA">Marruecos</option>',
                        '<option value="MQ">Martinica</option>',
                        '<option value="MU">Mauricio</option>',
                        '<option value="MR">Mauritania</option>',
                        '<option value="YT">Mayotte</option>',
                        '<option value="MX">México</option>',
                        '<option value="FM">Micronesia</option>',
                        '<option value="MD">Moldovia</option>',
                        '<option value="MC">Mónaco</option>',
                        '<option value="MN">Mongolia</option>',
                        '<option value="ME">Montenegro</option>',
                        '<option value="MS">Montserrat</option>',
                        '<option value="MZ">Mozambique</option>',
                        '<option value="MM">Myanmar</option>',
                        '<option value="NA">Namibia</option>',
                        '<option value="NR">Naurú</option>',
                        '<option value="NP">Nepal</option>',
                        '<option value="NI">Nicaragua</option>',
                        '<option value="NE">Níger</option>',
                        '<option value="NG">Nigeria</option>',
                        '<option value="NU">Niue</option>',
                        '<option value="NO">Noruega</option>',
                        '<option value="NC">Nueva Caledonia</option>',
                        '<option value="NZ">Nueva Zelandia</option>',
                        '<option value="OM">Omán</option>',
                        '<option value="PK">Pakistán</option>',
                        '<option value="PW">Palau</option>',
                        '<option value="PS">Palestina</option>',
                        '<option value="PA">Panamá</option>',
                        '<option value="PG">Papúa Nueva Guinea</option>',
                        '<option value="PY">Paraguay</option>',
                        '<option value="PE">Perú</option>',
                        '<option value="PN">Pitcairn</option>',
                        '<option value="PF">Polinesia Francesa</option>',
                        '<option value="PL">Polonia</option>',
                        '<option value="PT">Portugal</option>',
                        '<option value="PR">Puerto Rico</option>',
                        '<option value="QA">Qatar</option>',
                        '<option value="GB">Reino Unido</option>',
                        '<option value="CF">República Centroafricana</option>',
                        '<option value="CZ">República Checa</option>',
                        '<option value="DO">República Dominicana</option>',
                        '<option value="RE">Reunión</option>',
                        '<option value="RW">Ruanda</option>',
                        '<option value="RO">Rumania</option>',
                        '<option value="EH">Sahara Occidental</option>',
                        '<option value="BL">Saint Barthélemy</option>',
                        '<option value="WS">Samoa</option>',
                        '<option value="AS">Samoa Americana</option>',
                        '<option value="KN">San Cristóbal Nevis</option>',
                        '<option value="SM">San Marino</option>',
                        '<option value="MF">San Martín</option>',
                        '<option value="PM">San Pedro y Miquelon</option>',
                        '<option value="SH">Santa Helena</option>',
                        '<option value="LC">Santa Lucía</option>',
                        '<option value="ST">Santo Tomé y Príncipe</option>',
                        '<option value="VC">San Vincente y Las Granadinas</option>',
                        '<option value="SN">Senegal</option>',
                        '<option value="RS">Serbia</option>',
                        '<option value="CS">Serbia y Montenegro</option>',
                        '<option value="SC">Seychelles</option>',
                        '<option value="SL">Sierra Leona</option>',
                        '<option value="SG">Singapur</option>',
                        '<option value="SY">Siria</option>',
                        '<option value="SO">Somalía</option>',
                        '<option value="LK">Sri Lanka</option>',
                        '<option value="ZA">Sudáfrica</option>',
                        '<option value="SD">Sudán</option>',
                        '<option value="SE">Suecia</option>',
                        '<option value="CH">Suiza</option>',
                        '<option value="SR">Surinam</option>',
                        '<option value="SZ">Swazilandia</option>',
                        '<option value="TH">Tailandia</option>',
                        '<option value="TW">Taiwán</option>',
                        '<option value="TZ">Tanzania</option>',
                        '<option value="TJ">Tayikistán</option>',
                        '<option value="IO">Territorio Británico del Océano Índico</option>',
                        '<option value="TF">Territorios Franceses del Sur</option>',
                        '<option value="TL">Timor-Leste</option>',
                        '<option value="TP">Timor Oriental</option>',
                        '<option value="TG">Togo</option>',
                        '<option value="TK">Tokelau</option>',
                        '<option value="TO">Tonga</option>',
                        '<option value="TT">Trinidad y Tobago</option>',
                        '<option value="TN">Túnez</option>',
                        '<option value="TM">Turkmenistán</option>',
                        '<option value="TR">Turquía</option>',
                        '<option value="TV">Tuvalu</option>',
                        '<option value="UA">Ucrania</option>',
                        '<option value="UG">Uganda</option>',
                        '<option value="UM">United States Minor Outlying Islands</option>',
                        '<option value="UY">Uruguay</option>',
                        '<option value="UZ">Uzbekistan</option>',
                        '<option value="VU">Vanuatu</option>',
                        '<option value="VE">Venezuela</option>',
                        '<option value="VN">Vietnam</option>',
                        '<option value="YE">Yemen</option>',
                        '<option value="ZR">Zaire</option>',
                        '<option value="ZM">Zambia</option>',
                        '<option value="ZW">Zimbawe</option>'
                    ];
					
					foreach($opciones as $opcion){
						if($datosUsuario->country == substr($opcion,15, 2)){
							echo substr($opcion,0, 18)." selected = 'selected'>".substr($opcion,19);
						}else{
							echo $opcion;
						}
						
					}
					
					
					?>
                    </select>
                </div>
                <div class="p_emerfoto">
                    <div class="p_emerfotoin" id = "imgEdit">
					<?
						if($datosUsuario->imagen == ""){
					?>
					<img id = "imgUser" class="p_emerfotoimg" src="<?=base_url()?>/src/img/p_emergentefoto.png" onload = "colocaEmergente('noFiltra')">
					<?
						}else{
					?>
					<img id = "imgUser" class="p_emerfotoimg" src="data:image/png;base64,<?=$datosUsuario->imagen?>" onload = "colocaEmergente('noFiltra')">
					<?
						}
					?>
                        
                    </div>
					
                    <input class="p_emerinputfile" type="file" name="foto" id="file" accept=".jpg,.png">
                    <label for="file">Subir imagen</label>
                </div>
				
                <div class="p_emerinfo" <?if($datosUsuario->imagen == ""){echo "style = 'opacity:0.5;cursor:default;' ";}?>><?if($datosUsuario->imagen != ""){echo '<input name = "borraImg" type = "checkbox">';}?>Quitar imagen</div>
                <div class="p_emertexto" id = "msg_guarda"><?=$mensaje?></div>
                <div class="p_emerbtn">
					<input id = "btnguardauser" type ="submit" class="p_emerbtnin" value ="GUARDAR" onclick = "guardarInfoUser(event)"/>
				</div>
				<div class="p_emerbtn">
					<input type ="button" class="p_emerbtnin" value ="REGRESAR" onclick = "configuraInformacion();"/>
				</div>
</form>
<script>
	function archivo(evt) {
	  var files = evt.target.files; // FileList object
 
	  // Obtenemos la imagen del campo "file".
	  for (var i = 0, f; f = files[i]; i++) {
		//Solo admitimos imágenes.
		if (!f.type.match('image.*')) {
			continue;
		}
 
		var reader = new FileReader();
 
		reader.onload = (function(theFile) {
			return function(e) {
			  // Insertamos la imagen
			 document.getElementById("imgEdit").innerHTML = ['<img class="p_emerfotoimg" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
			};
		})(f);
 
		reader.readAsDataURL(f);
	  }
	}
 
  document.getElementById('file').addEventListener('change', archivo, false);


</script>