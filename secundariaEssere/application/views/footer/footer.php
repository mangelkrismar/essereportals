<!--    FOOTER    -->    
<footer class="p_footer" style="margin-top: 166px;">   
	<div class="p_footerin" <?if($this->session->userdata('sina')){?>style="opacity: 0.0;"<?}?>>    
		<div class="p_footerdatos"> 
			<div class="p_footerdatosbox2" onclick="window.open('https://www.essereeducacion.com','_blank')">    
				<div><i class="fa-solid fa-globe"></i></div>
				<div>
					<div>Conoce más en nuestro sitio web</div>
					<div>www.essereeducacion.com</div>         
				</div>
			</div>
			<div class="p_footerdatosbox2">
				<div><i class="fa-solid fa-phone"></i></div>
				<div>
					+52 55 4447 8074       
				</div>
			</div>
			<div class="p_footerdatosbox2" onclick="window.location.href = 'mailto:contacto@essereeducacion.com'">
				<div><i class="fa-regular fa-envelope"></i></div>
				<div>
					contacto@essereeducacion.com       
				</div>
			</div>
			     
		</div>    
		<div class="p_footerdatos">
			<div class="p_footerdatosbox2">Síguenos en:</div>
			<div class="p_footerdatosbox2 boxredes">
				<i class="fa-brands fa-facebook" onclick = "window.open('https://www.facebook.com/p/Essere-Educaci%C3%B3n-61551903282356/')"></i>
				<i class="fa-brands fa-instagram" onclick = "window.open('https://www.instagram.com/essere_educacion/')"></i>
			</div>
			<div class="p_footerdatosbox2">@essere_educacion</div>
		</div>        
		<div class="p_footerline">
			<div class="p_footerlinein"></div>            
		</div>            
		<div class="p_footerinfo">
			<table class="p_footerinfoin">
				<tr>
					<td></td>
					<td>ESSERE Educación: Escuela digital</td>
				</tr>
			</table>            
		</div>        
	</div>    
</footer>
<!--    ELEMENTOS EXTRAS Y EMERGENTES    -->
<!--table class="p_flotanteicon" onclick = "irArriba()"><tr><td id="p_flotanteicon"></td></tr></table-->  
<div class = "p_flotanteicon"  onclick = "irArriba()">
	<div id = "linea1"></div>
	<div id = "linea2"></div>
	<div id = "linea3"></div>
</div>
<div class="recienteicon"></div>	
<?php if($this->session->userdata('log_in')){ ?>	
	<!--    ELEMENTOS EXTRAS Y EMERGENTES    -->
	<!--    USUARIO    -->    
	<div class="p_emergenteusuario">        
		<div class="p_emergenteclose" onclick = "cerrarEmergentes()" ></div>        
		<div class="p_emerbox">            
			<!--CAMBIAR CONTRASEÑA-->            
			<div class="p_emerboxconte" style="display: none" id = "edita_pass">
				<form id = "form_cambia_pass">					
					<div class="p_emertitle">Cambiar contraseña</div>					
					<div class="p_emertexto">La contraseña debería tener al menos 8 caracter(es), al menos 1 mayúscula(s)</div>		
					<div class="p_emerdatos">						
						<div class="p_emerdatostxt">Contraseña actual*</div>						
						<input id = "psw_actual" name = "psw_actual" class="p_emerdatosinput" type="password" placeholder="********">	
						<div  class="p_emerdatostxt"> 
							<input id = "actual" type = "checkbox" onchange = "muestraPass(this.checked, this.id)"/> Mostrar
						</div>			
					</div>					
					<div class="p_emerdatos">						
						<div class="p_emerdatostxt">Nueva contraseña*</div>						
						<input id = "psw_nueva" name = "psw_nueva" class="p_emerdatosinput" type="password" placeholder="********" onkeyup = "coincidePsw()">						
						<div class="p_emerdatostxt"> 
							<input id = "nueva" type = "checkbox" onchange = "muestraPass(this.checked, this.id)"/> Mostrar
						</div>
					</div>					
					<div class="p_emerdatos">						
						<div class="p_emerdatostxt">Repetir nueva contraseña*</div>						
						<input id = "psw_confirma" name = "psw_confirma" class="p_emerdatosinput" type="password" placeholder="********" onkeyup = "coincidePsw()">						
						<div  class="p_emerdatostxt"> 
							<input id = "confirma" type = "checkbox" onchange = "muestraPass(this.checked, this.id)"/> Mostrar
						</div>		
					</div>					
					<div class="p_emerdatostxt" id = "msjPsw">Las contraseñas no coinciden</div>					
					<div class="p_emerbtn">						
						<input type ="button" class="p_emerbtnin" value ="GUARDAR" onclick = "cambiarPass();"/>					
					</div>					
					<div class="p_emerbtn">						
						<input type ="button" class="p_emerbtnin" value ="CANCELAR" onclick = "configuraInformacion();"/>				
					</div>				
				</form>            
			</div>            
			<!--INFORMACIÓN-->            
			<div class="p_emerboxconte" style="display: none" id = "informacion_usuario">
				<div class="p_emertitle">No hay conexión a internet</div>
				<div class="p_emerdatostxt">Se requiere conexión a internet para ver este conenido. Una disculpa por los inconvenientes</div>
				<div class="p_emerbtn" onclick = "cerrarEmergentes()">
					<input type ="button" class="p_emerbtnin" value ="Aceptar"/>
				</div>            
			</div>            
			<!--EDITAR INFORMACIÓN-->            
			<div class="p_emerboxconte" style="display: none" id = "edita_info">
				<div class="p_emertitle">Editar información</div>
				<div class="p_emerdatos">
					<div class="p_emerdatostxt">Nombre</div>
					<input class="p_emerdatosinput" type="text" placeholder="Nombre">
				</div>
				<div class="p_emerdatos">
					<div class="p_emerdatostxt">Apellido</div>
					<input class="p_emerdatosinput" type="text" placeholder="Apellido">
				</div>
				<div class="p_emerdatos">
					<div class="p_emerdatostxt">Dirección de correo</div>
					<input class="p_emerdatosinput" type="email" placeholder="nombre@correo.com.mx">
				</div>
				<div class="p_emerdatos">
					<div class="p_emerdatostxt">Mostrar correo</div>
					<select class="p_emerdatosselect">
						<option>Mostrar a todos mi dirección de correo</option>
						<option>Mostrar mi dirección de correo sólo a mis compañeros de curso</option>
						<option>Ocultar a todos mi dirección de correo</option>
					</select>
				</div>
				<div class="p_emerdatos">
					<div class="p_emerdatostxt">Correo activado</div>
					<select class="p_emerdatosselect">
						<option>La dirección de correo está habilitada</option>
						<option>La dirección de correo no está habilitada</option>
					</select>
				</div>
				<div class="p_emerdatos">
					<div class="p_emerdatostxt">Ciudad</div>
					<input class="p_emerdatosinput" type="text" placeholder="Ciudad">
				</div>
				<div class="p_emerdatos">
					<div class="p_emerdatostxt">Seleccione su país</div>
					<select class="p_emerdatosselect">
						<option value="">Seleccione su país...</option>
						<option value="AF">Afganistán</option>
						<option value="AL">Albania</option>
						<option value="DE">Alemania</option>
						<option value="AD">Andorra</option>
						<option value="AO">Angola</option>
						<option value="AI">Anguila</option>
						<option value="AQ">Antártida</option>
						<option value="AG">Antigua y Barbuda</option>
						<option value="AN">Antillas Holandesas</option>
						<option value="SA">Arabia Saudita</option>
						<option value="DZ">Argelia</option>
						<option value="AR">Argentina</option>
						<option value="AM">Armenia</option>
						<option value="AW">Aruba</option>
						<option value="AU">Australia</option>
						<option value="AT">Austria</option>
						<option value="AZ">Azerbaiyán</option>
						<option value="BS">Bahamas</option>
						<option value="BH">Bahrein</option>
						<option value="BD">Bangladesh</option>
						<option value="BB">Barbados</option>
						<option value="BE">Bélgica</option>
						<option value="BZ">Belice</option>
						<option value="BJ">Benin</option>
						<option value="BM">Bermuda</option>
						<option value="BY">Bielorrusia</option>
						<option value="BO">Bolivia</option>
						<option value="BA">Bosnia y Herzegovina</option>
						<option value="BW">Botswana</option>
						<option value="BR">Brasil</option>
						<option value="BN">Brunei Darussalam</option>
						<option value="BG">Bulgaria</option>
						<option value="BF">Burkina Faso</option>
						<option value="BI">Burundi</option>
						<option value="BT">Bután</option>
						<option value="CV">Cabo Verde</option>
						<option value="KH">Camboya</option>
						<option value="CM">Camerún</option>
						<option value="CA">Canadá</option>
						<option value="TD">Chad</option>
						<option value="CL">Chile</option>
						<option value="CN">China</option>
						<option value="CY">Chipre</option>
						<option value="CO">Colombia</option>
						<option value="KM">Comoras</option>
						<option value="CG">Congo</option>
						<option value="CD">Congo, República Democrática del</option>
						<option value="KP">Corea del Norte</option>
						<option value="KR">Corea del Sur</option>
						<option value="CI">Costa de Marfil</option>
						<option value="CR">Costa Rica</option>
						<option value="HR">Croacia</option>
						<option value="CU">Cuba</option>
						<option value="DK">Dinamarca</option>
						<option value="DJ">Djibouti</option>
						<option value="DM">Dominica</option>
						<option value="EC">Ecuador</option>
						<option value="EG">Egipto</option>
						<option value="SV">El Salvador</option>
						<option value="VA">El Vaticano</option>
						<option value="AE">Emiratos Árabes Unidos</option>
						<option value="ER">Eritrea</option>
						<option value="SK">Eslovaquia</option>
						<option value="SI">Eslovenia</option>
						<option value="ES">España</option>
						<option value="US">Estados Unidos</option>
						<option value="EE">Estonia</option>
						<option value="ET">Etiopía</option>
						<option value="RU">Federación Rusa</option>
						<option value="FJ">Fiji</option>
						<option value="PH">Filipinas</option>
						<option value="FI">Finlandia</option>
						<option value="FR">Francia</option>
						<option value="FX">Francia Metropolitana</option>
						<option value="GA">Gabón</option>
						<option value="WA">Gales</option>
						<option value="GM">Gambia</option>
						<option value="GE">Georgia</option>
						<option value="GS">Georgia del Sur e Islas Sandwich del Sur</option>
						<option value="GH">Ghana</option>
						<option value="GI">Gibraltar</option>
						<option value="GD">Granada</option>
						<option value="GR">Grecia</option>
						<option value="GL">Groenlandia</option>
						<option value="GP">Guadalupe</option>
						<option value="GU">Guam</option>
						<option value="GT">Guatemala</option>
						<option value="GG">Guernsey</option>
						<option value="GN">Guinea</option>
						<option value="GW">Guinea-Bissau</option>
						<option value="GQ">Guinea Ecuatorial</option>
						<option value="GY">Guyana</option>
						<option value="GF">Guyana Francesa</option>
						<option value="HT">Haití</option>
						<option value="NL">Holanda</option>
						<option value="HN">Honduras</option>
						<option value="HK">Hong Kong</option>
						<option value="HU">Hungría</option>
						<option value="IN">India</option>
						<option value="ID">Indonesia</option>
						<option value="IQ">Irak</option>
						<option value="IR">Irán</option>
						<option value="IE">Irlanda</option>
						<option value="IM">Isla de Man</option>
						<option value="IS">Islandia</option>
						<option value="AX">Islas Åland</option>
						<option value="BV">Islas Bouvet</option>
						<option value="KY">Islas Caimán</option>
						<option value="CC">Islas Cocos</option>
						<option value="CK">Islas Cook</option>
						<option value="CX">Islas de Navidad</option>
						<option value="FO">Islas Faroe</option>
						<option value="HM">Islas Heard y McDonald</option>
						<option value="FK">Islas Malvinas</option>
						<option value="MP">Islas Marianas del Norte</option>
						<option value="MH">Islas Marshall</option>
						<option value="NF">Islas Norfolk</option>
						<option value="SB">Islas Salomón</option>
						<option value="SJ">Islas Svalbard y Jan Mayen</option>
						<option value="TC">Islas Turcas y Caicos</option>
						<option value="VI">Islas Vírgenes (Americanas)</option>
						<option value="VG">Islas Vírgenes (Británícas)</option>
						<option value="WF">Islas Wallis y Futuna</option>
						<option value="IL">Israel</option>
						<option value="IT">Italia</option>
						<option value="LY">Jamahiriya Árabe Libia</option>
						<option value="JM">Jamaica</option>
						<option value="JP">Japón</option>
						<option value="JE">Jersey</option>
						<option value="JO">Jordania</option>
						<option value="KZ">Kazajstán</option>
						<option value="KE">Kenia</option>
						<option value="KG">Kirguistán</option>
						<option value="KI">Kiribati</option>
						<option value="KO">Kosovo</option>
						<option value="KW">Kuwait</option>
						<option value="LA">Laos</option>
						<option value="LV">Latvia</option>
						<option value="LS">Lesotho</option>
						<option value="LB">Líbano</option>
						<option value="LR">Liberia</option>
						<option value="LI">Liechtenstein</option>
						<option value="LT">Lituania</option>
						<option value="LU">Luxemburgo</option>
						<option value="MO">Macao</option>
						<option value="MK">Macedonia</option>
						<option value="MG">Madagascar</option>
						<option value="MY">Malasia</option>
						<option value="MW">Malawi</option>
						<option value="MV">Maldivas</option>
						<option value="ML">Mali</option>
						<option value="MT">Malta</option>
						<option value="MA">Marruecos</option>
						<option value="MQ">Martinica</option>
						<option value="MU">Mauricio</option>
						<option value="MR">Mauritania</option>
						<option value="YT">Mayotte</option>
						<option value="MX" selected="selected">México</option>
						<option value="FM">Micronesia</option>
						<option value="MD">Moldovia</option>
						<option value="MC">Mónaco</option>
						<option value="MN">Mongolia</option>
						<option value="ME">Montenegro</option>
						<option value="MS">Montserrat</option>
						<option value="MZ">Mozambique</option>
						<option value="MM">Myanmar</option>
						<option value="NA">Namibia</option>
						<option value="NR">Naurú</option>
						<option value="NP">Nepal</option>
						<option value="NI">Nicaragua</option>
						<option value="NE">Níger</option>
						<option value="NG">Nigeria</option>
						<option value="NU">Niue</option>
						<option value="NO">Noruega</option>
						<option value="NC">Nueva Caledonia</option>
						<option value="NZ">Nueva Zelandia</option>
						<option value="OM">Omán</option>
						<option value="PK">Pakistán</option>
						<option value="PW">Palau</option>
						<option value="PS">Palestina</option>
						<option value="PA">Panamá</option>
						<option value="PG">Papúa Nueva Guinea</option>
						<option value="PY">Paraguay</option>
						<option value="PE">Perú</option>
						<option value="PN">Pitcairn</option>
						<option value="PF">Polinesia Francesa</option>
						<option value="PL">Polonia</option>
						<option value="PT">Portugal</option>
						<option value="PR">Puerto Rico</option>
						<option value="QA">Qatar</option>
						<option value="GB">Reino Unido</option>
						<option value="CF">República Centroafricana</option>
						<option value="CZ">República Checa</option>
						<option value="DO">República Dominicana</option>
						<option value="RE">Reunión</option>
						<option value="RW">Ruanda</option>
						<option value="RO">Rumania</option>
						<option value="EH">Sahara Occidental</option>
						<option value="BL">Saint Barthélemy</option>
						<option value="WS">Samoa</option>
						<option value="AS">Samoa Americana</option>
						<option value="KN">San Cristóbal Nevis</option>
						<option value="SM">San Marino</option>
						<option value="MF">San Martín</option>
						<option value="PM">San Pedro y Miquelon</option>
						<option value="SH">Santa Helena</option>
						<option value="LC">Santa Lucía</option>
						<option value="ST">Santo Tomé y Príncipe</option>
						<option value="VC">San Vincente y Las Granadinas</option>
						<option value="SN">Senegal</option>
						<option value="RS">Serbia</option>
						<option value="CS">Serbia y Montenegro</option>
						<option value="SC">Seychelles</option>
						<option value="SL">Sierra Leona</option>
						<option value="SG">Singapur</option>
						<option value="SY">Siria</option>
						<option value="SO">Somalía</option>
						<option value="LK">Sri Lanka</option>
						<option value="ZA">Sudáfrica</option>
						<option value="SD">Sudán</option>
						<option value="SE">Suecia</option>
						<option value="CH">Suiza</option>
						<option value="SR">Surinam</option>
						<option value="SZ">Swazilandia</option>
						<option value="TH">Tailandia</option>
						<option value="TW">Taiwán</option>
						<option value="TZ">Tanzania</option>
						<option value="TJ">Tayikistán</option>
						<option value="IO">Territorio Británico del Océano Índico</option>
						<option value="TF">Territorios Franceses del Sur</option>
						<option value="TL">Timor-Leste</option>
						<option value="TP">Timor Oriental</option>
						<option value="TG">Togo</option>
						<option value="TK">Tokelau</option>
						<option value="TO">Tonga</option>
						<option value="TT">Trinidad y Tobago</option>
						<option value="TN">Túnez</option>
						<option value="TM">Turkmenistán</option>
						<option value="TR">Turquía</option>
						<option value="TV">Tuvalu</option>
						<option value="UA">Ucrania</option>
						<option value="UG">Uganda</option>
						<option value="UM">United States Minor Outlying Islands</option>
						<option value="UY">Uruguay</option>
						<option value="UZ">Uzbekistan</option>
						<option value="VU">Vanuatu</option>
						<option value="VE">Venezuela</option>
						<option value="VN">Vietnam</option>
						<option value="YE">Yemen</option>
						<option value="ZR">Zaire</option>
						<option value="ZM">Zambia</option>
						<option value="ZW">Zimbawe</option>
					</select>
				</div>
				<div class="p_emerfoto">
					<div class="p_emerfotoin">
						<img class="p_emerfotoimg" >
					</div>
					<input class="p_emerinputfile" type="file" name="file" id="file">
					<label for="file">Subir imagen</label>
				</div>
				<div class="p_emerinfo">Quitar imagen</div>
				<div class="p_emertexto">Imagen nueva (Tamaño máximo: 24Mb)</div>
				<div class="p_emerbtn">					
					<input type ="submit" class="p_emerbtnin" value ="GUARDAR" onclick = ""/>				
				</div>				
				<div class="p_emerbtn">					
					<input type ="button" class="p_emerbtnin" value ="CANCELAR" onclick = "configuraInformacion();"/>				
				</div>            
			</div>            
			<?php if($this->session->userdata('user_rol') == 1){?>            
				<!--MENSAJE GUARDAR-->            
				<form class="p_emerboxconte" id = "mensaje_guardar">
					<!--Su sesión ha excedido el tiempo límite. Por favor, ingrese de nuevo.-->
					<div class="p_emeralerta"></div>
					<div class="p_emerdatos">
						<div class="p_emerdatostxt">Nombre de usuario</div>
					</div>            
				</form>            
			<?php } ?>           
			<!--INFORMACION DE UNA APP-->     
			<div class="p_emerboxconte" id = "info_app">
				<!--Su sesión ha excedido el tiempo límite. Por favor, ingrese de nuevo.-->
				<div class="p_emeralerta"></div>
				<div class="p_emerdatos">
					<div class="p_emerdatosimg" id="play_info" onclick="playDemo(319)">
						<div class="p_emerdatosplay">
							<div class = "p_recienteinfoplayicon">
								<svg viewBox="0 0 148.253 150">
									<g>
										<path fill-rule="evenodd" clip-rule="evenodd"  d="M74.027,0.058c37.036-1.606,74.318,30.537,74.226,74.878
										c-0.088,43.053-35.125,75.344-74.689,75.063c-37.865-0.27-72.181-29.865-73.515-70.935C-1.431,33.571,30.971,0.058,74.027,0.058z"/>
									</g>
									<g>
										<path d="M76.697,0v4c16.848,0,33.871,7.376,46.707,20.239c13.484,13.513,20.89,31.514,20.85,50.688
										c-0.039,19.33-7.558,37.359-21.17,50.766C109.979,138.598,92.117,146,74.077,146l-0.484-0.002
										c-17.726-0.126-34.686-6.907-47.757-19.093C12.382,114.364,4.645,97.327,4.047,78.934C3.36,57.809,10.37,38.542,23.787,24.682
										c12.874-13.3,30.716-20.624,50.241-20.624c0.058,0,0.116-0.001,0.173-0.004C75.023,4.018,75.861,4,76.692,4L76.697,0 M76.691,0
										c-0.886,0-1.777,0.019-2.664,0.058c-43.057,0-75.458,33.514-73.979,79.006c1.334,41.069,35.65,70.665,73.515,70.935
										C73.735,150,73.906,150,74.077,150c39.354,0,74.089-32.198,74.177-75.065C148.343,31.655,112.832-0.003,76.691,0L76.691,0z"/>
									</g>
									<path d="M103.804,71.464L69.521,37.181c-1.43-1.43-3.581-1.857-5.449-1.084c-1.868,0.774-3.086,2.597-3.086,4.62
									v68.567c0,2.022,1.218,3.846,3.086,4.619c0.619,0.257,1.269,0.381,1.913,0.381c1.301,0,2.58-0.508,3.537-1.465l34.283-34.283
									C105.757,76.583,105.757,73.417,103.804,71.464z"/>
								</svg>
							</div>
						</div>
					</div>
					<div class="p_emerdatostitle" id = "nombre_info">Nombre App</div>
					<ul class="p_emerdatosobjetivos" id = "objetivo_info">
						<li>objetivo1</li>
					</ul>
				</div>   
			</div>  
			<!--SESION CERRADA-->
			<div class="p_emerboxbienvenido" style="display: none">
				<div class="p_emerfrasesalir"></div>
				<div class="p_emerfrasetxt" id = "name_usuario"><?= $this->session->userdata('nombre') ?></div>
				<div class="p_emerpleca"></div>
				<div class="p_emerfrasetxtdias" id = "name_usuario">Días restantes: <span class = "diasR"><?=$this->session->userdata('diasR')?></span></div>
			</div>
			<!--USUARIO-->            
			<form class="p_emerboxconte" style="display: none" id ="formLogin">
				<!--Su sesión ha excedido el tiempo límite. Por favor, ingrese de nuevo.-->
				<div class="p_emeralerta"></div>
				<div class="p_emerdatos">
					<div class="p_emerdatostxt">Nombre de usuario</div>
					<input class="p_emerdatosinput" type="text" placeholder="Nombre" required  name = "name" id = "name" />
				</div>
				<div class="p_emerdatos">
					<div class="p_emerdatostxt">Contraseña</div>
					<input class="p_emerdatosinput" type="password" placeholder="********" required name = "password" id = "password" />
				</div>
				<div class="p_emerinfo" >¿Cómo obtener usuario y contraseña?</div>
				<div class="p_emerbtn">
					<!--table class="p_emerbtnin"><tr><td>ENTRAR</td></tr></table-->					
					<input id = "entrar" type ="submit" class="p_emerbtnin" value ="ENTRAR"/>
				</div>
				<div class="p_emerinfo">¿Olvidó su nombre de usuario o contraseña?</div>            
			</form>
			<!--CERRAR SESSION FORM-->            
            <form class="p_emerboxconte" style="display: none" id="exitformfil">
                <div class="p_emertitle">Cerrando sesión</div>
                <div class="p_emertexto">Si te han gustado nuestras actividades, regístrate y <br>¡pronto te enviaremos más información!</div>
                <div class="p_emerdatos">
                    <div class="p_emerdatostxt">Correo Electrónico</div>
                    <input class="p_emerdatosinput" type="email" placeholder="correo@electronico.com" required  name = "email" id = "email" />
                </div>
                <div class="p_emerbtn">                 
                    <input type ="button" class="p_emerbtnin" value ="REGISTRAR" id="exitformfil1"/>
                </div>
                <div class="p_emerbtn">                 
                    <input type ="button" class="p_emerbtnin" value ="NO, MUCHAS GRACIAS" id="exitformfil2"/>
                </div>         
            </form>
			<!--No Network Advice-->            
			<form class="p_emerboxconte" style="display: none">
				<div class="p_emerdatos">
					<div class="p_emerdatostxt">Requieres de conexión a internet para acceder a este recurso.</div>
				</div>
				<div class="p_emerbtn">				
					<input type ="submit" onclick="cerrarEmergentes()" class="p_emerbtnin" value ="Aceptar"/>
				</div>          
			</form>
			<div class="p_emerclose" onclick = "cerrarEmergentes()" ></div>  
		</div> 
	</div>
	<?php if(!$this->config->item('mostrar_apps_a_visitantes')) {?>
		<div class = "p_avisolicencia">
			<div  id ="msjDiasR"></div>
			<a href="http://www.krismar.com.mx" target="_blank">www.krismar.com.mx</a>
			<article onclick="$(this.parentNode).animate({'bottom':'-'+($(this.parentNode).height()+4)+'px'})"></article>
		</div>
	<?php } ?>
<?php }else{ ?>
	<div class="p_emergenteusuario">        
		<div class="p_emergenteclose" onclick = "cerrarEmergentesCU()" ></div>        
		<div class="p_emerbox">     
		
			<!--USUARIO-->            
			<form class="p_emerboxconte" id ="formLogin">
				<!--Su sesión ha excedido el tiempo límite. Por favor, ingrese de nuevo.-->
				<div class="p_emeralerta"></div>
				<div class="p_emerdatos">
					<div class="p_emerdatostxt">Nombre de usuario</div>
					<input class="p_emerdatosinput" type="text" placeholder="Nombre" required  name = "name" id = "name" />
				</div>
				<div class="p_emerdatos">
					<div class="p_emerdatostxt">Contraseña</div>
					<input class="p_emerdatosinput" type="password" placeholder="********" required name = "password" id = "password" />
				</div>				
				<div class="p_emerbtn p_bcenter1">
					<!--table class="p_emerbtnin"><tr><td>ENTRAR</td></tr></table-->					
					<input id = "entrar" type ="submit" class="p_emerbtnin p_bcenter2" value ="ENTRAR"/>
					<input id = "compra"  class="p_emerbtnin p_bcenter2" onclick="muestraComprar()" value ="COMPRAR"/>
				</div>
				<div class="p_emerinfo" onclick="muestraContraseniaOlvidada()">¿Olvidó su nombre de usuario o contraseña?</div>            
			</form>    
			
			<!--CONTRASEÑA OLVIDADA-->            
			<div class="p_emerboxconte">
				<div class="p_emertitle">Contraseña olvidada</div>
				<div class="p_emertexto">Sus detalles deben encontrarse primero en la base de datos del usuario. Por favor, escriba o bien su nombre de usuario o bien su dirección registrada de correo electrónico en el recuadro apropiado. No es necesario escribir ambos.</div>
				<div class="p_emerdatos">
					<div class="p_emerdatostxt">Nombre de usuario</div>
					<input class="p_emerdatosinput" type="text" placeholder="Nombre">
				</div>
				<div class="p_emerdatos">
					<div class="p_emerdatostxt">Dirección de correo</div>
					<input class="p_emerdatosinput" type="email" placeholder="nombre@correo.com.mx">
				</div>
				<div class="p_emerbtn">
					<input type ="submit" class="p_emerbtnin" value ="ENVIAR"/>
				</div>            
			</div>			
			<!--BIENVENIDO-->
			<div class="p_emerboxbienvenido" style="display: none">
				<div class="p_emerfrase"></div>
				<div class="p_emerfrasetxt" id = "name_usuario">Nombre de usuario</div>
				<div class="p_emerpleca"></div>
				<!--div class="p_emerfrasetxtdias" id = "name_usuario">Dias restantes: <span class = "diasR"></span> </div-->
				<div class="p_emerfrasetxtdias" ><span class = "diasR"></span></div>
			</div>
			<!--DATOS DE CONTACTO-->            
			<div class="p_emerboxconte" style="display: none">
				<div class="p_emercontactotitle">Póngase en contacto con nosotros para obtener tu usuario y contraseña</div>
				<div class="p_emercontacto">
					<div class="p_emercontactoicon1"></div>
					<div class="p_emercontactotxt">(722) 271 5705, 271 6972</div>
				</div>
				<div class="p_emercontacto">
					<div class="p_emercontactoicon2"></div>
					<div class="p_emercontactotxt">soporte@krismar.com.mx</div>
				</div>
				<div class="p_emercontacto">
					<div class="p_emercontactoicon3"></div>
					<div class="p_emercontactotxt">Ayuda en línea</div>
				</div>
				<div class="p_emercontacto">
					<div class="p_emercontactoicon4"></div>
					<div class="p_emercontactotxt">Av. 20 de Noviembre No. 68 San Salvador Tizatlali C.P. 52172 Metepec, Edo. de México.</div>
				</div>            
			</div>          
			<!--INFORMACION DE UNA APP-->  
			<div class="p_emerboxconte" id = "info_app">
				<!--Su sesión ha excedido el tiempo límite. Por favor, ingrese de nuevo.-->
				<div class="p_emeralerta"></div>
				<div class="p_emerdatos">
					<div class="p_emerdatosimg" id="play_info" onclick="playDemo(319)">
						<div class="p_emerdatosplay">
							<div class = "p_recienteinfoplayicon">
								<svg viewBox="0 0 148.253 150">
									<g>
										<path fill-rule="evenodd" clip-rule="evenodd"  d="M74.027,0.058c37.036-1.606,74.318,30.537,74.226,74.878
										c-0.088,43.053-35.125,75.344-74.689,75.063c-37.865-0.27-72.181-29.865-73.515-70.935C-1.431,33.571,30.971,0.058,74.027,0.058z"/>
									</g>
									<g>
										<path d="M76.697,0v4c16.848,0,33.871,7.376,46.707,20.239c13.484,13.513,20.89,31.514,20.85,50.688
										c-0.039,19.33-7.558,37.359-21.17,50.766C109.979,138.598,92.117,146,74.077,146l-0.484-0.002
										c-17.726-0.126-34.686-6.907-47.757-19.093C12.382,114.364,4.645,97.327,4.047,78.934C3.36,57.809,10.37,38.542,23.787,24.682
										c12.874-13.3,30.716-20.624,50.241-20.624c0.058,0,0.116-0.001,0.173-0.004C75.023,4.018,75.861,4,76.692,4L76.697,0 M76.691,0
										c-0.886,0-1.777,0.019-2.664,0.058c-43.057,0-75.458,33.514-73.979,79.006c1.334,41.069,35.65,70.665,73.515,70.935
										C73.735,150,73.906,150,74.077,150c39.354,0,74.089-32.198,74.177-75.065C148.343,31.655,112.832-0.003,76.691,0L76.691,0z"/>
									</g>
									<path d="M103.804,71.464L69.521,37.181c-1.43-1.43-3.581-1.857-5.449-1.084c-1.868,0.774-3.086,2.597-3.086,4.62
									v68.567c0,2.022,1.218,3.846,3.086,4.619c0.619,0.257,1.269,0.381,1.913,0.381c1.301,0,2.58-0.508,3.537-1.465l34.283-34.283
									C105.757,76.583,105.757,73.417,103.804,71.464z"/>
								</svg>
							</div>
						</div>
					</div>
					<div class="p_emerdatostitle" id = "nombre_info">Nombre App</div>
					<ul class="p_emerdatosobjetivos" id = "objetivo_info">
						<li>objetivo1</li>
					</ul>
				</div>   
			</div> 
			
			<!--Pago Stripe-->            
			<form class="p_emerboxconte" id ="formCompra" action="https://www.krismar.com.mx/pagoKSR/secundaria.php" method="POST" onsubmit="return validarForm();"> <!--Ventana 5-->
				<!--Formato de compra de licencia-->
				<div class="p_emeralerta"></div>
				<div class="p_emerdatos">
					<div class="p_emerdatostxt">Correo electrónico</div>
					<input class="p_emerdatosinput" type="email" placeholder="Correo electrónico" required  name="correoCompra" id="correoCompra" />
				</div>
				<div class="p_emerdatos p_emerdatosSub1">
					<div class="p_emerdatostxt">Grado escolar</div>
					<select name = "gradoCompra" id = "gradoCompra" class="p_emerdatosselect" onchange="eligeOPC(this)" required>
						<!--<option>Elige una opción</option>
						<option value="1">1° grado</option>
						<option value="2">2° grado</option>
						<option value="3">3° grado</option>
						<option value="4">4° grado</option>
						<option value="5">5° grado</option>
						<option value="6">6° grado</option>
						<option value="7">Todos los grados</option>-->
					</select>
				</div>
				
				<div class="p_emerdatos p_emerdatosSub2">
					<div class="p_emerdatostxt">Costo</div>
					<label id="cProducto">$ </label>
				</div>
				
				<div class="p_emerbtn">					
					<input id = "comprar" type ="submit" class="p_emerbtnin" value ="PAGAR"/>
				</div>
				<div class="p_emerinfo" >Términos del Servicio</div>
			</form>

			<!--CAMBIAR USUARIO-->            
			<form class="p_emerboxconte" style="display: none" id ="formChangeUser">
				<div class="p_emeralerta"></div>
				<div class="p_emerdatos">
					<div class="p_emerdatostxt">Nombre de usuario</div>
					<input class="p_emerdatosinput" type="text" placeholder="Nombre"  name = "newusername" onkeyup="this.value=ValUser(this.value)" id = "newusername"/>
				</div>
				<div class="p_emerdatos">
					<div class="p_emerdatostxt">Contraseña</div>
					<input class="p_emerdatosinput" type="password" minlength="5" placeholder="********" name = "passwordc1" onkeyup="this.value=ValPass(this.value)" id = "passwordc1"/>
				</div>	
				<div class="p_emerdatos">
					<div class="p_emerdatostxt">Confirmar contraseña</div>
					<input class="p_emerdatosinput" type="password" placeholder="********" name = "passwordc2" onkeyup="this.value=ValPass(this.value)" id = "passwordc2"/>
				</div>	
				<div class="p_emerbtn">					
					<input id = "cambiarUsuario" type ="submit" class="p_emerbtnin" value ="CAMBIAR"/>
				</div>
				<div class="p_emerbtn">					
					<input type ="cancel" class="p_emerbtnin" onclick = "cerrarEmergentesCU()" value ="CANCELAR"/>
				</div>           
			</form>
			<!--No Network Advice-->            
			<form class="p_emerboxconte" style="display: none">
				<div class="p_emerdatos">
					<div class="p_emerdatostxt">Requieres de conexión a internet para acceder a este recurso.</div>
				</div>
				<div class="p_emerbtn">				
					<input type ="submit" onclick="cerrarEmergentes()" class="p_emerbtnin" value ="Aceptar"/>
				</div>          
			</form>
			<div class="p_emerclose" onclick = "cerrarEmergentesCU()" ></div> 
		</div>  
	</div>
<?php } ?>
<!--------------------------------------- GOOGLE --------------------------------------->
<script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
<!-------------------------------------------------------------------------------------->