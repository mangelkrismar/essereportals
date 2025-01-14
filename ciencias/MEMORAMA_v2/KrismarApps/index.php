<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width = device-width, maximum-scale = 1, user-scalable=no">
		<title>Español</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		
        
        <!--============================ Zona de CSS =================================-->
       <link rel="stylesheet" type="text/css" href="src/css/red_interfaz_animaciones.css">
        <link rel="stylesheet" type="text/css" href="src/css/red_interfaz_helperloaders.css">
        <link rel="stylesheet" type="text/css" href="src/css/red_interfaz_preloader.css">
        <link rel="stylesheet" type="text/css" id="style" href="src/css/red_interfaz_calculadora.css"/>
        <link rel="stylesheet" type="text/css" id="style" href="src/css/red_interfaz_informativos.css"/>
        <link rel="stylesheet" type="text/css" href="src/css/red_interfaz_app.css">
        
        
        
        <link rel="stylesheet" type="text/css" href = "src/css/red_esp_general.css"><!--CSS ESPAÑOL-->
        <link rel="stylesheet" type="text/css" href = "src/css/red_memorama.css"><!--CSS ESPAÑOL-->
        <link rel="stylesheet" type="text/css" href = "src/css/<?php echo $_REQUEST['prefijo'];?>.css"><!--CSS ESPAÑOL-->
        <!--<link rel="stylesheet" type="text/css" href = "src/css/red_mat_general.css">--><!--CSS MATEMÁTICAS-->
        <!--<link rel="stylesheet" type="text/css" href = "src/css/red_his_general.css">--><!--CSS HISTORIA-->
        <!--<link rel="stylesheet" type="text/css" href = "src/css/red_geo_general.css">--><!--CSS GEOGRAFIA-->
        <!--<link rel="stylesheet" type="text/css" href = "src/css/red_nat_general.css">--><!--CSS CIENCIAS NATURALES-->
        <!--<link rel="stylesheet" type="text/css" href = "src/css/red_art_general.css">--><!--CSS ARTE-->
        <!--<link rel="stylesheet" type="text/css" href = "src/css/red_dep_general.css">--><!--CSS DEPORTES-->
        <!--<link rel="stylesheet" type="text/css" href = "src/css/red_eco_general.css">--><!--CSS ECOLOGIA-->
        <!--<link rel="stylesheet" type="text/css" href = "src/css/red_pdc_general.css">--><!--CSS PANDILLA-->
        <!--<link rel="stylesheet" type="text/css" href = "src/css/red_ant_general.css">--><!--CSS ESPAÑOL-->

        
        <!--==========================================================================-->
        
        <!--========================== Zona de SCRIPTS ===============================-->
        <script type="text/javascript" src="src/js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="src/js/jquery-ui.js"></script>
        <script type="text/javascript" src="src/js/jquery.ui.touch-punch-improved.js"></script>
        <script type="text/javascript" src="src/js/ion.sound.js"></script>
        <script type="text/javascript" src="src/js/jQueryRotateCompressed.2.2.js"></script>
        <script type="text/javascript" src="src/js/jquery.transit.min.js"></script>
        
        <script type="text/javascript" src="src/js/red_interfaz_preloadimages.js"></script>
        <script type="text/javascript" src="src/js/red_interfaz_printarea.js"></script>
        <script type="text/javascript" src="src/js/red_interfaz_calculadora.js"></script>
        <script type="text/javascript" src="src/js/red_interfaz_libreriaaudios.js"></script>
        <script type="text/javascript" src="src/js/red_interfaz_teclado.js"></script>
        
        <!-- Archivo js de la actividad-->
        <script type="text/javascript" src="src/js/memorama_robotica.js"></script>
        <script type="text/javascript" src="src/js/<?php echo $_REQUEST['prefijo'];?>.js"></script>
        
        <script type="text/javascript" src="src/js/red_interfaz_app.js"></script>
        <!--==========================================================================-->		
		

	</head>
	<body onresize="ajustaDivActividad();" class="d_background_d1"  id="background">
		<iframe id="appC" width="10px" height="10px" hidden="true" src=""></iframe>
        <div id="preloader" class="d_preloader d_txtProperties">
			<!-- Animación de la bolita -->
			<div id="circleLoader" class="d_circleLoader">
				<div class="d_interfazBox1">
                    
                    <svg viewBox="0 0 500 486.995" >
                        <g>
                            <path d="M350.979,142.248c55.802,55.805,55.802,146.283,0,202.087
                                c-27.829,27.826-64.272,41.715-100.741,41.781c4.649,0.408,9.341,0.646,14.069,0.646c42.19,0,81.851-16.428,111.681-46.26
                                c61.58-61.583,61.58-161.78,0-223.36c-29.832-29.834-69.5-46.264-111.691-46.264c-42.184,0-81.845,16.428-111.676,46.256
                                c-29.827,29.833-46.258,69.496-46.258,111.685c0,5.186,0.257,10.337,0.75,15.43c-0.264-36.887,13.624-73.853,41.775-102.006
                                C204.693,86.44,295.17,86.44,350.979,142.248z"/>
                            <path d="M271.25,232.781l63.893,93.565h-55.406l-61.481-92.392l-0.166,92.702l-44.905-0.078
                                c0,0,0-126.538,0-147.222s19.3-19.41,19.3-19.41l25.897,0.042l-0.126,73.746l57.914-73.647l56.026,0.096L271.25,232.781z
                                 M432.676,225.066c0.979,44.402-15.387,89.118-49.194,122.925c-31.837,31.834-74.155,49.363-119.174,49.363
                                c-45.02,0-87.342-17.529-119.172-49.357c-31.834-31.836-49.364-74.159-49.366-119.178c-0.002-45.017,17.53-87.341,49.362-119.175
                                c31.83-31.83,74.152-49.359,119.165-49.359c0.425,0,0.837,0.028,1.258,0.028c-52.076-4.427-105.672,13.227-145.521,53.076
                                c-71.746,71.741-71.742,188.062,0,259.803c71.739,71.74,188.057,71.74,259.799,0
                                C420.348,332.677,437.928,277.955,432.676,225.066z"/>
                            <path d="M390.188,405.259c0.019-12.112,9.622-21.789,21.731-21.768c12.057,0.012,21.686,9.73,21.662,21.838
                                c-0.02,12.009-9.676,21.686-21.734,21.669C399.744,426.978,390.166,417.263,390.188,405.259z M428.434,405.325
                                c0.021-9.751-7.203-16.664-16.52-16.686c-9.482-0.021-16.561,6.877-16.578,16.627c-0.012,9.645,7.043,16.562,16.52,16.578
                                C421.17,421.857,428.418,414.969,428.434,405.325z M422.279,416.327l-5.48-0.012l-5.029-9.541l-3.504-0.004l-0.018,9.536
                                l-5.039-0.017l0.035-22.572l10.965,0.021c5.203,0.008,8.762,0.948,8.754,6.918c-0.01,4.162-2.146,5.865-6.15,6.126L422.279,416.327
                                z M414.301,403.382c2.521,0.005,3.947-0.542,3.951-3.393c0.002-2.299-2.9-2.303-5.096-2.311l-4.871-0.004l-0.014,5.703
                                L414.301,403.382z"/>
                        </g>
                    </svg>
                
                </div>
			</div>
			<!-- Animación del letrero "cargando" -->
			<div id="letterPulse" class="loader-inner ball-pulse-sync d_interfazLetras">
				<div>C</div>
				<div>a</div>
				<div>r</div>
				<div>g</div>
				<div>a</div>
				<div>n</div>
				<div>d</div>
				<div>o</div>
				<div>.</div>
				<div>.</div>
				<div>.</div>
			</div>
        </div>
        
        
        <div id="helperResources" class="d_helperResources"></div>
		<iframe id="appC" width="10px" height="10px" hidden="true" src=""></iframe>
		<!--Audios de la aplicación-->		
		<audio id="sndTxtActividad"preload>
			<source src="src/audio/red_instrucciones.ogg" type="audio/ogg">
	        <source src="src/audio/red_instrucciones.mp3" type="audio/mpeg">
	        Tu navegador no soporta la etiqueta audio.
		</audio>
		
		<audio id="sndFondoActividad"preload>
			<source id="fuenteOgg" src="src/audio/red_fondo.ogg" type="audio/ogg">
	        <source id="fuenteMpeg" src="src/audio/red_fondo.mp3" type="audio/mpeg">
	        Tu navegador no soporta la etiqueta audio.
		</audio>
		
		<div id="contenedor" class="d_contenedorGeneralPpal">
			<!-- Calculadora -->
			<form id="formCalculadora" action="#" name="calculadora" class="d_FONDO">
		    	<div class="d_SUP">
		        	<img src="src/img/red_interfaz_btnmover.png" class="d_MOVER">
		            <img src="src/img/red_interfaz_btncerrar.png" class="d_CERRAR" onclick="ocultaCalculadora();">
		        </div>
		        <div id="txtPantallaCalc">0</div>
		        <div class="d_BTNS">
		        	<img src="src/img/red_interfaz_btnretr.png" class="largo d_anchoBtns" value="Retr" onclick="retro()">
		            <img src="src/img/red_interfaz_btnce.png" class="largo d_anchoBtns" value="CE" onclick="borradoParcial()">
		            <img src="src/img/red_interfaz_btnc.png"  class="largo d_anchoBtns" value="C" onclick="borradoTotal()">
		        </div>
		       	<div class="d_BTNS">
		        	<img src="src/img/red_interfaz_btn7.png" value="7" onclick="numero('7')" class="d_anchoBtnsNum">
		            <img src="src/img/red_interfaz_btn8.png" value="8" onclick="numero('8')" class="d_anchoBtnsNum">
		            <img src="src/img/red_interfaz_btn9.png" value="9" onclick="numero('9')" class="d_anchoBtnsNum">
		            <img src="src/img/red_interfaz_btndivision.png" value="/" onclick="operar('/')" class="d_anchoBtnsNum">
		            <img src="src/img/red_interfaz_btnraiz.png" value="Raiz" onclick="raizc()" class="d_anchoBtnsNum">
		        </div>
		        <div class="d_BTNS">
		        	<img src="src/img/red_interfaz_btn4.png" value="4" onclick="numero('4')" class="d_anchoBtnsNum">
		            <img src="src/img/red_interfaz_btn5.png" value="5" onclick="numero('5')" class="d_anchoBtnsNum">
		            <img src="src/img/red_interfaz_btn6.png" value="6" onclick="numero('6')" class="d_anchoBtnsNum">
		            <img src="src/img/red_interfaz_btnmultiplicar.png" value="*" onclick="operar('*')" class="d_anchoBtnsNum">
		            <img src="src/img/red_interfaz_btnporcentaje.png" value="%" onclick="porcent()" class="d_anchoBtnsNum">
		        </div>
		        <div class="d_BTNS">
		        	<img src="src/img/red_interfaz_btn1.png" value="1" onclick="numero('1')" class="d_anchoBtnsNum">
		            <img src="src/img/red_interfaz_btn2.png" value="2" onclick="numero('2')" class="d_anchoBtnsNum">
		            <img src="src/img/red_interfaz_btn3.png" value="3" onclick="numero('3')" class="d_anchoBtnsNum">
		            <img src="src/img/red_interfaz_btnresta.png" value="-" onclick="operar('-')" class="d_anchoBtnsNum">
		            <img src="src/img/red_interfaz_btninverso.png" value="1/x" onclick="inve()" class="d_anchoBtnsNum">
		        </div>
		        <div class="d_BTNS">
		        	<img src="src/img/red_interfaz_btn0.png" value="0" onclick="numero('0')" class="d_anchoBtnsNum">
		            <img src="src/img/red_interfaz_btnpunto.png" value="." onclick="numero('.')" class="d_anchoBtnsNum">
		            <img src="src/img/red_interfaz_btnmasmenos.png" value="+/-" onclick="opuest()" class="d_anchoBtnsNum">
		            <img src="src/img/red_interfaz_btnsuma.png" value="+" onclick="operar('+')" class="d_anchoBtnsNum">
		   			<img src="src/img/red_interfaz_btnigual.png" value="=" onclick="igualar()" class="d_anchoBtnsNum">
		        </div>
			</form>
            
			<div id="opacidadInicialGral" class="d_opacidadInicialGral" onclick="iniciaActividad();"></div>
			<div id="opacidadGeneralInformacion" class="d_opacidadGeneralInformacion" onclick="ocultaInformacion();"></div>
					
			<!-- Encabezado App -->		
			<div id="encabezadoAppGral" class="d_encabezadoAppGral">
				<!--<table id="temaGeneral" class="d_temaGeneral"><tr><td><?echo $titulo?></td></tr></table>-->
                <div id="temaGeneral" class="d_temaGeneral"><?echo $titulo?></div>
				<div id="contenedorBtnsMenu" class="d_contenedorBtnsMenu">
					<div class="d_btnHomeGeneral d_comunBtnsHeader" onclick="window.parent.cerrarVen();cerrarVen()"></div>
				  	<div class="d_btnObjetivosGeneral d_comunBtnsHeader" onclick="muestraObjetivos();"></div>
				  	<div class="d_btnInstruccionesGeneral d_comunBtnsHeader" onclick="muestraInstrucciones();"></div>
					<div id="iconNivel" class="d_iconNivel"></div>
					<div id="txtNumEjercicio" class="d_txtNumEjercicio">1/10</div>
                    <div class="marcador">
                        <div class="marcadorpoint point_bien"></div>
                        <div class="marcadorpoint point_mal"></div>
                        <div class="marcadorpoint point_bien"></div>
                        <div class="marcadorpoint point_bien"></div>
                        <div class="marcadorpoint point_mal"></div>
                        <div class="marcadorpoint point_bien"></div>
                        <div class="marcadorpoint"></div>
                        <div class="marcadorpoint"></div>
                        <div class="marcadorpoint"></div>
                        <div class="marcadorpoint"></div>
                    </div>
				</div>
			</div>
			
			<!--Instrucciones-->
			<div id="instruccionesGeneral" class="d_instruccionesGeneral">
				<div class="d_instruccionesContenido">
                    <div class="d_logoKrismar"></div>
					<div class="d_tituloInstrucciones">Instrucciones</div>
					<div id="instruccionesChanged" class="d_txtInstrucciones"><?echo $instrucciones?></div>
				</div>
				<div class="d_flechaDown"></div>
			</div>
			
			<!--Objetivo-->
			<div id="objetivoGeneral" class="d_objetivoGeneral">
				<div class="d_objetivoContenido">
                    <div class="d_logoKrismar"></div>
					<div class="d_tituloObjetivos">Objetivos</div>
					<div id="objetivos" objetivos="<?echo $objetivos?>" class="d_txtObjetivos"></div>
				</div>
				<div class="d_flechaDown"></div>
			</div>
            
            <!--Borrar-->
            <div id="borrarGeneral" class="d_borrarGeneral">
                <div class="d_borrarContenido">
                    <table class="d_borrarFrase">
                        <tr>
                            <td>Se borrarán las respuestas que llevas hasta el momento.</td>
                        </tr>
                        <tr>
                            <td>¿Deseas continuar?</td>
                        </tr>
                    </table>
                    <div class="d_btnSi"></div>
                    <div class="d_btnNo"></div>
                </div>
                <div class="d_flechaDown"></div>
            </div>
            
            <!--Reiniciar-->
            <div id="reinGeneral" class="d_reinGeneral">
                <div class="d_reinContenido">
                    <table class="d_reinFrase">
                        <tr>
                            <td>¿Quieres iniciar un nuevo conjunto de preguntas?</td>
                        </tr>
                        <tr>
                            <td>Se borrarán todas las que llevas hasta el momento.</td>
                        </tr>
                    </table>
                    <div class="d_btnSi" onclick="reiniciarVen();window.parent.reiniciaVen()"></div>
                    <div class="d_btnNo" onclick = "ocultaInformacion();"></div>
                </div>
                <div class="d_flechaDown"></div>
            </div>
			 <aside id="barraMenuAside" class="d_aside">
				<div id="plecaSquares" class="d_plecaSquares">
					<div class="d_plecaSquaresDos" onclick="ocultaInformacion();"></div>
					<!--Menu de Configuración-->
					<div id="menuConfiguracion" class="d_menuConfiguracion">
						<img src="src/img/red_interfaz_flecha.png" class="d_flechitaDer">
						<div class="d_contenedorOpcMenuConf">
							<div class="d_contenedorAudioConfig">
								<div class="d_txtAudioConfig">Sonido</div>
								<div id="btnAudioConfig" class="d_btnAudioConfig" onclick="estableceAudioConfig();"></div>
							</div>
							<div class="d_contenedorTempConfig">
								<div class="d_txtTempConfig">Velocidad</div>
								<div id="btnLento" class="d_btnLento"></div>
								<div id="btnNormal" class="d_btnNormal"></div>
								<div id="btnRapido" class="d_btnRapido"></div>
							</div>
							<div class="d_contenedorCalculadora">
								<div class="d_txtCalculadora">Calculadora</div>
								<div id="btnCalculadora" class="calculadora" onclick="abreCalculadora();"></div>
							</div>
						</div>
					</div>
					
					<!--Evaluación-->
					<div id="detallesEvaluacion" class="d_detallesEvaluacion">
						<img src="src/img/red_interfaz_flecha.png" class="d_flechitaDer">
						<div class="d_contenedorDetallesEvaluacion">
							<div class="d_contenedorAciertosEval">
                                <div class="d_iconAciertos"></div>
								<div id="txtAciertosEval" class="d_txtAciertosEval">Aciertos</div>
								<div id="numAciertosEval" class="d_numAciertosEval">70</div>
							</div>
							<div class="d_contenedorErroresEval">
                                <div class="d_iconErrores"></div>
								<div id="txtErroresEval" class="d_txtErroresEval">Errores</div>
								<div id="numErroresEval" class="d_numErroresEval">30</div>
							</div>
							<div class="d_contenedorPorcentajeEval">
                                <div class="d_iconPorcentaje"></div>
								<div id="txtPorcentajeEval" class="d_txtPorcentajeEval">Porcentaje</div>
								<div id="numPorcentajeEval" class="d_numPorcentajeEval">70%</div>
							</div>
						</div>
					</div>
				</div>
				<div id="plecaBotons" class="d_plecaBotons">
					<div class="d_allBotons">
						<div id="btnRepetirAudio" class="d_btnRepetiraudio"></div>
						<div class="d_btnSpace"></div><!--ESPACIO-->
						<div id="btnBorrar" class="d_btnBorrar"></div>
						<div class="d_btnSpace"></div><!--ESPACIO-->
						<div id="btnConfiguracion" class="d_btnConfiguracion" onclick="abreConfiguracion();"></div>
						<div class="d_btnSpace"></div><!--ESPACIO-->
						<div id="btnMasMenos" class="d_btnMas" onclick="muestraNombreBtns();"></div>
						<div class="d_btnSpace"></div><!--ESPACIO-->
						<div id="btnSiguiente" class="d_btnSiguiente"></div>
						<div class="d_btnSpace"></div><!--ESPACIO-->
						<div id="btnEvaluarActividad" class="d_btnEvaluar"></div>
						<div class="d_btnSpace"></div><!--ESPACIO-->
						<div id="btnReiniciarActividad" class="d_btnReiniciar" onclick = "preguntaReinicio();" ></div>
					</div>
				</div>
				<div id="plecaNames" class="d_plecaNames">
					<div class="d_allNames">
						<div class="d_nameStyle">Repetir audio</div>
						<div class="d_btnSpace"></div><!--ESPACIO-->
						<div class="d_nameStyle">Borrar</div>
						<div class="d_btnSpace"></div><!--ESPACIO-->
						<div class="d_nameStyle">Configuración</div>
						<div class="d_btnSpace"></div><!--ESPACIO-->
						<div class="d_nameStyle"></div>
						<div class="d_btnSpace"></div><!--ESPACIO-->
						<div class="d_nameStyle">Siguiente</div>
						<div class="d_btnSpace"></div><!--ESPACIO-->
						<div class="d_nameStyle">Evaluar</div>
						<div class="d_btnSpace"></div><!--ESPACIO-->
						<div class="d_nameStyle">Reiniciar</div>
					</div>
				</div>
			</aside>
			<div id="actividad" class="actividad">
			<?php
			include($_REQUEST['prefijo'].".html")
			?>
                <!--Solución-->
                <div class="btnsolucion">
                    <div class="btntxt" id = "txtSolucion">
                        <table><tr><td>Solución correcta</td></tr></table>
                    </div>
                    <div class="btnicon" id = "idSolucion"></div>
                </div>
			</div>
		<div id="pieGeneral" class="d_pieGeneral">
			<div id="cronoUp" class="d_contenedorBtnCrono">
				<div id="btnCronometro" class="d_btnCronometro" onclick="verCronometro();"></div>
			</div>
			<div id="cronoDown" class="d_contenedorCrono">
				<div id="cronometro" class="d_cronometro">00:00</div>
			</div>				
		</div>
		
		<!--ESTILOS PARA TECLADO NUMÉRICO-->
        <div id="conteTeclado" class="d_conteTeclado"></div>
		<div id="teclado" class="d_Ageneral">
	    	<div class="d_AgeneralIn">
                <div onclick="registraNum(1);" class="d_tn_1"></div>
                <div onclick="registraNum(2);" class="d_tn_2"></div>
                <div onclick="registraNum(3);" class="d_tn_3"></div>
                <div onclick="registraNum(4);" class="d_tn_4"></div>
                <div onclick="registraNum(5);" class="d_tn_5"></div>
                <div onclick="registraNum(6);" class="d_tn_6"></div>
                <div onclick="registraNum(7);" class="d_tn_7"></div>
                <div onclick="registraNum(8);" class="d_tn_8"></div>
                <div onclick="registraNum(9);" class="d_tn_9"></div>
                <div onclick="registraNum(0);" class="d_tn_0"></div>
                <div id="p_punto" onclick="registraNum('.');" class="d_tn_punto"></div>
                <div onclick="registraNum('del');" class="d_tn_borrar"></div>
                <div onclick="$('#teclado').fadeOut();" class="d_tn_close"></div>
	        </div>
	    </div>

		<div id="advertenciaTempGral" class="d_advertenciaTempGral">			
			<div id="advertenciaTemporizador" class="d_advertenciaTemporizador">
				<div class="d_txtAdvertenciaTemp">El ejercicio se reiniciará si activas/desactivas el tiempo.</div>
				<div class="d_pregAdvertenciaTemp">¿Deseas continuar?</div>
				<div class="d_btnsAdvertenciaTemporizador">
					<div class="d_btnSiAdvertenciaTemp" onclick="fijaTemporizador();">Sí</div>
					<div class="d_btnNoAdvertenciaTemp"onclick="ocultaInformacion();">No</div>
				</div>
			</div>
			<div class="d_flechaDownAdvert"></div>
		</div>

	</div>
    </body>
</html>