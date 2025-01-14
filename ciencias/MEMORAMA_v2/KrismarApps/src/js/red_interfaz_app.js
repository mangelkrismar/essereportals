/***********************************************************************************
* 
*                                    CONSTANTES
*
*************************************************************************************/
var IP = "http://"+document.domain+"/KrismarApps/";//Path de ubicación de imágenes
var PREFIJOGRAL = "src/img/red_interfaz_";//Almacena parte de la ruta donde se ubican los archivos de imagen
var MAXNIVEL = 5;//Determina el nivel máximo a alcanzar.

/***********************************************************************************
* 
*                                    VARIABLES GLOBALES
*
*************************************************************************************/
var	tamHeader = null;//Contiene el height del encabezado.
var	tamAside = null;//Contiene el width del aside.
var	tamAsideBtns = null;//width del contenedor de botones
var	tamAsideNames = null;//width del contenedor de botones
var tamFooter = null;//Height del footer
	
var ctrlVerTiempo = 0;//Control para determinar cuando el footer está activo/desactivado
var ctrlMasMenos = 0;//Control para mostrar/ocultar el nombre de botones aside
var ctrlMenuConfig = 0;//Control para mostrar/ocultar el menu de configuración
var ctrlAudioBckgndApp = 0;//Controla el audio de fondo de la aplicación, inicialmente está deshabilitado

var minutos = 0;//Almacena los minutos de la aplicación
var segundos = 0;//Almacena los segundos de la aplicación
var dirTiempo = null;//Almacena la dirección del proceso que cuenta el tiempo

var indiceNivelApp = 1; //Indica el nivel de dificultad de la aplicación.

var velApp = null;//Registra la velocidad de ejecución de la aplicación (opcional)
var enviaBD = false;//Controla el envío de datos a la base de datos
var totReactivos = 0;//Almacena el total de reactivos.

var actividad = 1;//Contador para las actividades
var aciertos = 0;//Almacena los aciertos
var errores = 0;//Almacena los errores
var porcentaje = null;//Almacena la efectividad en la actividad
var device = null;//Determina la plataforma sobre la cual se ejecuta el script

/*************************************************************************************
*
* 								FUNCIONES Y PROCEDIMIENTOS
*
**************************************************************************************/
function preguntaReinicio(){
	/*
	* NOMBRE: preguntaReinicio
	* UTILIDAD: Muestra una ventana de confirmación para reiniciar.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	* VARIABLES: Ninguna.
	**************/
	$("#objetivoGeneral").hide();
	$("#instruccionesGeneral").hide();
	$("#borrarGeneral").hide();
	$("#opacidadGeneralInformacion").show();
	$("#reinGeneral").show();
	$("#reinGeneral").addClass("slideDown");
}
function borraRespuestas(){
	/*
	* NOMBRE: borraRespuestas.
	* UTILIDAD: 
	* ENTRADAS:
	* SALIDAS:
	*/
	$("#objetivoGeneral").hide();
	$("#instruccionesGeneral").hide();
	$("#reinGeneral").hide();
	$("#opacidadGeneralInformacion").show();
	$("#borrarGeneral").show();
	$("#borrarGeneral").addClass("slideDown");
	$(".d_btnSi").off("click");
	$(".d_btnNo").off("click");
	
	$(".d_btnSi").click(function(){
		desactivarBtn("#btnBorrar");
		desactivarBtn("#btnEvaluarActividad");
		borraSolucionActividad();
		ocultaInformacion();
		
	});
	$(".d_btnNo").click(function(){
		ocultaInformacion();
	});
}

function muestraInstrucciones(){
	/*
	* NOMBRE: muestraInstrucciones.
	* UTILIDAD: Muestra las instrucciones de la aplicación.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	*/
	$("#objetivoGeneral").hide();
	$("#borrarGeneral").hide();
	$("#reinGeneral").hide();
	$("#opacidadGeneralInformacion").show();
	$("#instruccionesGeneral").show();
	$("#instruccionesGeneral").addClass("slideDown");
    document.getElementById("sndTxtActividad").play();
}

function muestraObjetivos(){
	/*
	* NOMBRE: muestraObjetivos.
	* UTILIDAD: Muestra los objetivos de la aplicación.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	*/
	$("#instruccionesGeneral").hide();
	$("#borrarGeneral").hide();
	$("#reinGeneral").hide();
	$("#opacidadGeneralInformacion").show();
	$("#objetivoGeneral").show();
	$("#objetivoGeneral").addClass("slideDown");
}

function ocultaInformacion(){
	/*
	* NOMBRE: ocultaInformacion.
	* UTILIDAD: Oculta la información de la app.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	*/
	$("#opacidadGeneralInformacion").hide();
	$("#instruccionesGeneral").hide();
	$("#objetivoGeneral").hide();
	$("#advertenciaTempGral").hide();
	$("#detallesEvaluacion").hide();
	$("#borrarGeneral").hide();
	$("#reinGeneral").hide();
	$("#plecaSquares").fadeOut();
	if(ctrlMasMenos == 1){
		muestraNombreBtns();
	}
    
    if(ctrlMenuConfig == 1){
		$("#opacidadGeneralInformacion").hide();
		$("#menuConfiguracion").fadeOut();
		ctrlMenuConfig = 0;
	}	
}

function verCronometro(){
	/*
	* NOMBRE: verCronometro.
	* UTILIDAD: Muestra la barra del temporizador para des/habilitarlo.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	*/    
	if(ctrlVerTiempo == 0){
        $("#pieGeneral").removeClass("footerUp");
        $("#pieGeneral").removeClass("footerDown");
        
		$("#btnCronometro").css("background-image","url("+IP+PREFIJOGRAL+"btntimeoff.png)");
        $("#cronoDown").show();
		$("#pieGeneral").addClass("footerUp");
    	ctrlVerTiempo = 1;
    }else{
    	$("#btnCronometro").css("background-image","url("+IP+PREFIJOGRAL+"btntimeon.png)");
		$("#pieGeneral").addClass("footerDown");
        setTimeout(function(){$("#cronoDown").hide();},1000);
    	ctrlVerTiempo = 0;
   	}
}

function muestraNombreBtns(){
	/*
	* NOMBRE: muestraNombreBtns.
	* UTILIDAD: Muestra los nombres de los botones de la barra aside.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	*/
	if(ctrlMasMenos == 0){
		$("#opacidadGeneralInformacion").show();
		$("#barraMenuAside").removeClass("slideLight");
		$("#barraMenuAside").removeClass("slideRight");
		
		$("#btnMasMenos").css({"background-image":"url("+IP+PREFIJOGRAL+"btnmenos.png)"});
		$("#plecaNames").show();
		$("#barraMenuAside").addClass("slideLeft");
		$("#contenedorBtnsMenu").fadeOut();
		
	    ctrlMasMenos = 1;
	}else{
		$("#btnMasMenos").css({"background-image":"url("+IP+PREFIJOGRAL+"btnmas.png)"});
		$("#barraMenuAside").addClass("slideRight");
		setTimeout(function(){$("#plecaNames").hide();},1001);
		
		$("#opacidadGeneralInformacion").hide();
		$("#contenedorBtnsMenu").delay(1000).fadeIn();
		
    	ctrlMasMenos = 0;
    }
}

function abreConfiguracion(){
	/*
	* NOMBRE: abreConfiguracion.
	* UTILIDAD: Muestra el menú para configurar audio y temporizador de la app.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	*/
	$("#detallesEvaluacion").hide();
	$("#plecaSquares").fadeIn();
	if(ctrlMenuConfig == 0){
		$("#opacidadGeneralInformacion").show();
		$("#menuConfiguracion").fadeIn();
		ctrlMenuConfig = 1;
	}else{
		$("#menuConfiguracion").fadeOut();
		$("#plecaSquares").fadeOut();
		ctrlMenuConfig = 0;
	}	
}

function estableceAudioConfig(){
	/*
	* NOMBRE: estableceAudioConfig.
	* UTILIDAD: Pone/quita el audio de la aplicación.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	*/
	if(ctrlAudioBckgndApp == 0){
		document.getElementById("sndFondoActividad").play();
		document.getElementById("btnAudioConfig").style.backgroundImage = "url('" + IP + PREFIJOGRAL + "audioon.png')";
		ctrlAudioBckgndApp = 1;
	}else{
		document.getElementById("sndFondoActividad").pause();
		document.getElementById("sndFondoActividad").currentTime = 0;
		document.getElementById("btnAudioConfig").style.backgroundImage = "url('" + IP + PREFIJOGRAL + "audiooff.png')";
		ctrlAudioBckgndApp = 0;
	}
}

function cambiaFondoAct(audioDeFondo){
	/*
	* NOMBRE: cambiaFondoAct.
	* UTILIDAD: cambia el audio de fondo de la aplicación.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	*/
	document.getElementById("fuenteOgg").src = IP + "src/audio/" + audioDeFondo + ".ogg";
	document.getElementById("fuenteMpeg").src = IP + "src/audio/" + audioDeFondo + ".mp3";
}

function fijaTiempoConf(id,itm){
	/*
	* NOMBRE: fijaTiempoConf.
	* UTILIDAD: Establece/Quita el temporizador.
	* ENTRADAS: id > cadena, es el id del botón que invoca el metodo;
	* 			itm > cadena, identifica el botón pulsado.
	* SALIDAS: Ninguna.
	*/
	document.getElementById("btnLento").style.backgroundImage = "url("+IP+IMGPREFIJOGRAL+"tlentooff.png)";
	document.getElementById("btnNormal").style.backgroundImage = "url("+IP+IMGPREFIJOGRAL+"tnormaloff.png)";
	document.getElementById("btnRapido").style.backgroundImage = "url("+IP+IMGPREFIJOGRAL+"trapidooff.png)";
		
	if(id == "btnLento"){
		document.getElementById(id).style.backgroundImage = "url("+IP+IMGPREFIJOGRAL+"tlentoon.png)";
	}else{
		if(id == "btnNormal"){
			document.getElementById(id).style.backgroundImage = "url("+IP+IMGPREFIJOGRAL+"tnormalon.png)";	
		}else{//el botón pulsado fue btnRapidoTempConfig
			document.getElementById(id).style.backgroundImage = "url("+IP+IMGPREFIJOGRAL+"trapidoon.png)";	
		}
	}
	HAYVELAPP = false;
	velApp = itm;//Establecemos la velocidad que se eligió
}

function ctrlTiempo(){
	/*
	* NOMBRE: ctrlTiempo.
	* UTILIDAD: Aumenta las variables que simulan el cronometro.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	*/
	segundos++;//Se incrementan los segundos
	if(segundos == 60){//Si ya se alcanzaron los 60 segundos que forman el minuto
		minutos++;//Se adiciona uno al contador de minutos
		segundos = 0;//Se resetea el valor de los segundos
	}
	if(minutos <= 9){
		if(segundos <= 9){
			document.getElementById("cronometro").innerHTML = "0" + minutos + ":" + "0" + segundos;
		}else{//los minutos son mayores a 10
			document.getElementById("cronometro").innerHTML = "0" + minutos + ":" + segundos;
		}
	}else{//los minutos son mayores a 10
		if(segundos <= 9){
			document.getElementById("cronometro").innerHTML = minutos + ":" + "0" + segundos;
		}else{//los minutos son mayores a 10
			document.getElementById("cronometro").innerHTML = minutos + ":" + segundos;
		}
	}
}

function cambiaNivel(){
	/*
	* NOMBRE: cambiaNivel.
	* UTILIDAD: Cambia el icono del nivel de las aplicaciones.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	*/
	if(NIVEL <= MAXNIVEL){
		document.getElementById("iconNivel").style.backgroundImage = "url("+IP+PREFIJOGRAL+"nivel"+NIVEL+".png)";	
	}
}

function hayNivel(){
	/*
	* NOMBRE: hayNivel.
	* UTILIDAD: Muestra/Oculta el icono de nivel para las actividades.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	*/
	if(!HAYNIVEL){
		document.getElementById("iconNivel").style.display = "none";
	}else{
		cambiaNivel();
	}
}

function hayVelocidadApp(){
	/*
	* NOMBRE: hayVelocidadApp.
	* UTILIDAD: Des/Habilita los botones para fijar la velocidad de la aplicación.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	*/
	if(HAYVELAPP){
		$("#btnLento").css({ opacity: 1 });
		$("#btnLento").css( "cursor", "pointer" );
		$("#btnLento").attr("onclick","fijaTiempoConf('btnLento','lento')");
		
		$("#btnNormal").css({ opacity: 1 });
		$("#btnNormal").css( "cursor", "pointer" );
		$("#btnNormal").attr("onclick","fijaTiempoConf('btnNormal','normal')");
		
		$("#btnRapido").css({ opacity: 1 });
		$("#btnRapido").css( "cursor", "pointer" );
		$("#btnRapido").attr("onclick","fijaTiempoConf('btnRapido','rapido')");
	}else{
		$("#btnLento").css({ opacity: 0.3 });
		$("#btnLento").css( "cursor", "default" );
		$("#btnLento").removeAttr("onclick");
		
		$("#btnNormal").css({ opacity: 0.3 });
		$("#btnNormal").css( "cursor", "default" );
		$("#btnNormal").removeAttr("onclick");
		
		$("#btnRapido").css({ opacity: 0.3 });
		$("#btnRapido").css( "cursor", "default" );
		$("#btnRapido").removeAttr("onclick");
	}
}

function incrementaActividad(){
	/*
	 * NOMBRE: incrementaActividad.
	 * UTILIDAD: Incrementa el número de la actividad.
	 * ENTRADAS: Ninguna.
	 * SALIDAS: Ninguna.
	 */
	actividad++;
	document.getElementById("txtNumEjercicio").innerHTML = actividad + "/" + TOTACTIVIDADES;
}

function iniciaCronometro(){
	/*
	 * NOMBRE: iniciaCronometro.
	 * UTILIDAD: Inicia el cronómetro de la actividad.
	 * ENTRADAS: Ninguna.
	 * SALIDAS: Ninguna.
	 */
	dirTiempo = setInterval(ctrlTiempo,1000);//Se sigue contando el tiempo
}

function detieneCronometro(){
	/* NOMBRE: detieneCronometro.
	 * UITLIDAD: Detiene el cronómetro de la actividad.
	 * ENTRADAS: Ninguna.
	 * SALIDAS: Ninguna.
	 */
	clearInterval(dirTiempo);//Detenemos el tiempo global
}

function despliegaDetallesEval(){
	/* NOMBRE: despliegaDetallesEval.
	* UTILIDAD: Muestra en pantalla el concentrado de la evaluación.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	*/
	$("#menuConfiguracion").hide();
	$("#plecaSquares").show();
	totReactivos = aciertos + errores;
	porcentaje = (aciertos*100)/totReactivos;
	
	document.getElementById("numAciertosEval").innerHTML = aciertos;
	document.getElementById("numErroresEval").innerHTML = errores;
	document.getElementById("numPorcentajeEval").innerHTML = parseInt(porcentaje)+"%";
	$("#opacidadGeneralInformacion").show();
	$("#detallesEvaluacion").fadeIn();
    
    /*** Enviamos los datos generado a la base de datos ***/
    if(!enviaBD){//Si no se han enviado datos a la base, se envían.
        enviaBD = true;
        document.getElementById('appC').src = "http://" + document.domain + "/KrismarApps/index.php/calificaApp/resultado/"+aciertos+"/"+errores+"/"+minutos+"-"+segundos;
    }
    
    /*if(parseInt(porcentaje)>=70){
        playCorrecto();
    }else{
        playIncorrecto();
    }*/
}

function desactivarBtn(btn){
	/* NOMBRE: desactivarBtn.
	 * UTILIDAD: Remueve el evento onclick el botón y la opacidad la fija a 0.3 (desactivar).
	 * ENTRADAS: btn > id del botón a desactivar.
	 * SALIDAS: Ninguna.
	 */
	$(btn).css({ opacity: 0.3 });
    $(btn).css( "cursor", "default" );
    $(btn).removeAttr("onclick");
	
	if(btn == "#idSolucion"){
		$("#idSolucion").css("opacity","1");
		$("#idSolucion").removeClass("solution");
		$("#txtSolucion").css("opacity","1");
	}
}

function activarBtn(btn,funcion){
	/* NOMBRE: activarBtn.
	 * UTILIDAD: Agrega el evento onclick con su función correspondiente, así como fijar la opacidad a 1 (activar).
	 * ENTRADAS: btn > id del botón a activar,
				 funcion > nombre de la función a asociar.
	 * SALIDAS: Ninguna.
	 */
	$(btn).css({ opacity: 1 });
    $(btn).css( "cursor", "pointer" );
    
	
	switch(true){
		case (btn == "#btnBorrar" && funcion != undefined):
			$(btn).attr("onclick", funcion);
			break;
		case (btn == "#btnBorrar" && funcion == undefined):
			$(btn).attr("onclick", "borraRespuestas()");
			break;
		case (btn == "#btnSiguiente" && funcion != undefined):
			$(btn).attr("onclick",funcion);
			break;
		case (btn == "#btnSiguiente" && funcion == undefined):
			$(btn).attr("onclick","siguienteActividad()");
			break;
		case (btn == "#btnEvaluarActividad" && funcion == undefined):
			$(btn).attr("onclick","evaluaActividad()");
			break;
		case (btn == "#btnEvaluarActividad" && funcion != undefined):
			$(btn).attr("onclick",funcion);
			break;
		case (btn == "#idSolucion" && funcion != undefined):
			$(btn).attr("onclick",funcion);
			break;
		case (btn == "#idSolucion" && funcion == undefined):
			$(btn).attr("onclick","verSolucionCorr()");
			break;
		default:
			$(btn).attr("onclick",funcion);
	}
	if(btn == "#idSolucion"){
		$("#idSolucion").addClass("solution");
		$("#txtSolucion").css("opacity","0");
	}
	
}
function correctoDefault(){
	/*
	* NOMBRE: correctoDefault
	* UTILIDAD: Realiza procedimientos al evaluar ejercicio como correcto.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	* VARIABLES: Ninguna.
	***************/
	playCorrecto();
	fillBarBien();
	aciertos++;
}
function incorrectoDefault(){
	/*
	* NOMBRE: incorrectoDefault
	* UTILIDAD: Realiza procedimientos al evaluar ejercicio como incorrecto.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	* VARIABLES: Ninguna.
	**************/
	activarBtn("#idSolucion");
	playIncorrecto();
	fillBarMal();
	errores++;
}
function iniciaDefault(){
	/*
	* NOMBRE: iniciaDefault
	* UTILIDAD: Inicia cronómetro y muestra ejercicio inicial.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	* VARIABLES: Ninguna.
	*******************/
	$("#opacidadInicialGral").hide();
	$("#instruccionesGeneral").hide();
	iniciaCronometro();
	
}
function evaluaDefault(){
	/*
	* NOMBRE: evaluaDefault
	* UTILIDAD: Realiza evaluación por default.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna
	* VARIABLES: Ninguna.
	***************/
	detieneCronometro();		
	desactivarBtn("#btnEvaluarActividad");
	desactivarBtn("#btnBorrar");
	if(actividad == TOTACTIVIDADES){//Se alcanzó la última actividad
		despliegaDetallesEval();
	}else{//Todavía hay actividades por contestar
		activarBtn("#btnSiguiente");
	}
}
function siguienteDefault(){
	incrementaActividad();//Incrementa el número de la activad.
	iniciaCronometro();//Continua el cronómetro
	desactivarBtn("#btnSiguiente");
	clearTimeout(tmpSolucion);
  	desactivarBtn("#idSolucion");
	$("#idSolucion").css({"opacity":"0"});
	$("#idSolucion").removeClass("solution");
	$("#txtSolucion").css("opacity","0");
}
function getObjetivos(){
	/*
	* NOMBRE: getObjetivos.
	* UTILIDAD: obtiene los objetivos.
	* ENTRADAS: Cadena de objetivos.
	* SALIDAS: Ninguna.
	*/
	$objetivos = document.getElementById('objetivos').getAttribute("objetivos");
	$objetivosHTML="";
	while($objetivos.indexOf("-")!=-1){
		$objetivos = $objetivos.slice($objetivos.indexOf("-")+1,$objetivos.length);
		if($objetivos.indexOf("-")!=-1){
			$objetivosHTML=$objetivosHTML+"<li class='d_listaObj'>"+$objetivos.slice(0,$objetivos.indexOf("-"))+"</li>";
			$objetivos = $objetivos.slice($objetivos.indexOf("-"),$objetivos.length);
		}
		else{
			$objetivosHTML=$objetivosHTML+"<li class='d_listaObj'>"+$objetivos.slice($objetivos.indexOf("-")+1,$objetivos.length)+"</li>";
			$objetivos = "";
		}
	}
	document.getElementById('objetivos').innerHTML=$objetivosHTML;
}

function detectaDispositivo(){
	/*
	* NOMBRE: detectaDispositivo.
	* UTILIDAD: Hace una detección de la plataforma sobre la cual se ejecuta la aplicación.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	*/    
    if(navigator.userAgent.toLowerCase().search(/iphone|ipod|ipad|android|webos|blackberry|iemobile|phone|mobile/) > -1 ){
		device = "movil"; 
	}
	else{//Es una Pc
		device = "pc";
	}
	//device = "movil";
}

function ajustaDivActividad(){
	/*
	* NOMBRE: ajustaDivActividad.
	* UTILIDAD: Redimensiona el div que contiene la actividad.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	*/
    
    tamHeader = parseInt($("#encabezadoAppGral").innerHeight());
	tamAside = parseInt($("#barraMenuAside").innerWidth());
	tamAsideBtns = parseInt($("#plecaBotons").innerWidth());
	tamAsideNames = parseInt($("#plecaNames").innerWidth());
	tamFooter = (parseInt($("#pieGeneral").innerHeight()))/2;
	
	$("#contenedorBtnsMenu").css("right","0");
	$("#contenedorBtnsMenu").css("right", tamAsideBtns+"px");
	document.getElementById("plecaNames").style.display = "none";

	document.getElementById("txtNumEjercicio").innerHTML = actividad + "/" + TOTACTIVIDADES;
	
	hayNivel();
	hayVelocidadApp();
    $("#actividad").css({"width": (parseInt($(window).width()) - tamAsideBtns) + "px","height":(parseInt($(window).height())-tamHeader)+"px","top":tamHeader+"px"});
}
function reiniciarVen(){
	/*
	* NOMBRE: cerrarVen
	* UTILIDAD: cierra la ventana
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	*/
	var dispositivo = navigator.userAgent.toLowerCase();
	if( dispositivo.search(/iphone|ipod|ipad|android/) > -1 ){
		
		location.reload();
	}
}

function cerrarVen(){
	/*
	* NOMBRE: cerrarVen
	* UTILIDAD: cierra la ventana
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	*/
	var dispositivo = navigator.userAgent.toLowerCase();
	if( dispositivo.search(/iphone|ipod|ipad|android/) > -1 ){
		window.close();
	}
}

function replaceIcons(inst){
    /*
	* NOMBRE: replaceIcons.
	* UTILIDAD: Incrusta las rutas de los iconos en las instrucciones.
	* ENTRADAS: inst > cadena, son las instrucciones a cambiar.
	* SALIDAS: instChanged > cadena, son las intrucciones con los iconos en ellas.
	*/
    /*** VARIABLES LOCALES ***/
    equivalencia = [
        ["*borrar","*borrar;","*borrar,","*borrar.","iconborrar.png"],
        ["*configurar","*configurar;","*configurar,","*configurar.","iconconfig.png"],
        ["*home","*home;","*home,","*home.","iconhome.png"],
        ["*instrucciones","*instrucciones;","*instrucciones,","*instrucciones.","iconinst.png"],
        ["*mas","*mas;","*mas,","*mas.","iconmas.png"],
        ["*menos","*menos;","*menos,","*menos.","iconmenos.png"],
        ["*objetivos","*objetivos;","*objetivos,","*objetivos.","iconobjetivo.png"],
        ["*reiniciar","*reiniciar;","*reiniciar,","*reiniciar.","iconreinicia.png"],
        ["*siguiente","*siguiente;","*siguiente,","*siguiente.","iconsiguiente.png"],
        ["*sonido","*sonido;","*sonido,","*sonido.","iconsonido.png"],
        ["*evaluar","*evaluar;","*evaluar,","*evaluar.","iconverifica.png"],
        ["*sinaudio","*sinaudio;","*sinaudio,","*sinaudio.","iconaudiooff.png"],
        ["*conaudio","*conaudio;","*conaudio,","*conaudio.","iconaudioon.png"],
        ["*calculadora","*calculadora;","*calculadora,","*calculadora.","iconcalculadora.png"],
        ["*flechaizq","*flechaizq;","*flechaizq,","*flechaizq.","iconflechaleft.png"],
        ["*flechader","*flechader;","*flechader,","*flechader.","iconflecharight.png"],
        ["*lento","*lento;","*lento,","*lento.","iconlentooff.png"],
        ["*normal","*normal;","*normal,","*normal.","iconnormaloff.png"],
        ["*rapido","*rapido;","*rapido,","*rapido.","iconrapidooff.png"],
        ["*teoria","*teoria;","*teoria,","*teoria.","iconteoria.png"]
    ];//Almacena las equivalencias en iconos para palabras clave
    instChanged = "";//Almacena las instrucciones transformadas
    tmpWord = null;//Almacena temporalmente la palabra a analizar
    /************************/
    instPalabras = inst.split(" ");//Separamos las instrucciones en palabras
    
    /*** Comenzamos a hacer la identificación de keywords para insertar iconos ***/
    for(i=0; i<instPalabras.length; i++){
        tmpWord = instPalabras[i];//Reemplazamos por el icono respectivo
        for(j=0; j<equivalencia.length; j++){
            if(tmpWord.localeCompare(equivalencia[j][0]) == 0){
                tmpWord = "<img class=d_iconinstrucciones src="+IP+PREFIJOGRAL+equivalencia[j][4]+">";//Reemplazamos por el icono respectivo
                break;
            }else if(tmpWord.localeCompare(equivalencia[j][1]) == 0){
                tmpWord = "<img class=d_iconinstrucciones src="+IP+PREFIJOGRAL+equivalencia[j][4]+">;";//Reemplazamos por el icono respectivo con punto y coma al final
                break;
            }else if(tmpWord.localeCompare(equivalencia[j][2]) == 0){
                tmpWord = "<img class=d_iconinstrucciones src="+IP+PREFIJOGRAL+equivalencia[j][4]+">,";//Reemplazamos por el icono respectivo con coma al final
                break;
            }else if(tmpWord.localeCompare(equivalencia[j][3]) == 0){
                tmpWord = "<img class=d_iconinstrucciones src="+IP+PREFIJOGRAL+equivalencia[j][4]+">.";//Reemplazamos por el icono respectivo con punto al final
                break;
            }
        }
        instChanged += tmpWord+" ";//Agregamos el temporal del icono respectivo
    }
    
    document.getElementById("instruccionesChanged").innerHTML = instChanged;
}

$(window).load(function(){
	$("#temaGeneral").css({"Width":"0px"});
	agregaBarra();
	
	
    $("#preloader").hide();
    $("#helperResources").hide();
    $("#encabezadoAppGral").show();
    $("#pieGeneral").show();
    $("#barraMenuAside").show();
    $("#instruccionesGeneral").show();
    ajustaDivActividad();
	
	tamConteBtns = parseInt($("#contenedorBtnsMenu").innerWidth()+20);//Width del contenedor de los botones y noAct
	tamAside = parseInt($("#barraMenuAside").innerWidth());
	$("#temaGeneral").css({"width":parseInt(window.innerWidth-(tamConteBtns+tamAside))+"px"});
});

$(document).ready(function() {//Tan pronto como el HTML sea cargado, se centra el título
	/*** VARIABLES ***/
	
    /*****************/
    detectaDispositivo();
    getObjetivos();
	
    replaceIcons($("#instruccionesChanged").text());
    $("#encabezadoAppGral").hide();
    $("#pieGeneral").hide();
    $("#barraMenuAside").hide();
    /*** forzamos las cargas de imágenes ***/
    $.preloadCssImages();
	
});

function agregaBarra(){
	/*
	* NOMBRE: agregaBarra
	* UTILIDAD: Agrega esferas según el no. de ejercicios.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna
	* VARIABLES: Ninguna.
	****************/
	$(".marcadorpoint ").hide();
	for(i = 1;i<=TOTACTIVIDADES;i++){
		$($(".marcadorpoint ").get(i-1)).show().removeClass("point_bien");
		$($(".marcadorpoint ").get(i-1)).removeClass("point_mal");
	}
}

function fillBarBien(){
	/*
	* NOMBRE: fillBarBien
	* UTILIDAD: Llena un circulo con color verde.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	* VARIABLES**/
	$($(".marcadorpoint").get(actividad-1)).addClass("point_bien");
}

function fillBarMal(){
	/*
	* NOMBRE: fillBarMal
	* UTILIDAD: Llena un circulo con color rojo.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	* VARIABLES**/
	$($(".marcadorpoint").get(actividad-1)).addClass("point_mal");
}

$(window).on("orientationchange",function(evt){//detectamos la orientación del dispositivo para ajustar tamaño del titulo
    /*** VARIABLES ***/
    tamConteBtns = parseInt($("#contenedorBtnsMenu").innerWidth()+20);//Width del contenedor de los botones y noAct
    tamHeader = parseInt($("#encabezadoAppGral").innerHeight());
    tamAside = parseInt($("#plecaBotons").innerWidth());
    /*****************/
    $("#temaGeneral").css("width",parseInt(window.innerWidth-(tamConteBtns+tamAside))+"px");
    
    
	
	tamAsideBtns = parseInt(document.getElementById("plecaBotons").offsetWidth);
	tamAsideNames = parseInt(document.getElementById("plecaNames").offsetWidth);
	tamFooter = (parseInt(document.getElementById("pieGeneral").offsetHeight))/2;
	
	$("#actividad").css({"width": ($(window).innerWidth - tamAside) + "px","height":($(window).innerHeight-tamHeader)+"px"});
	
	$("#contenedorBtnsMenu").css("right","0");
	$("#contenedorBtnsMenu").css("right", tamAsideBtns+"px");
	document.getElementById("plecaNames").style.display = "none";

	document.getElementById("txtNumEjercicio").innerHTML = actividad + "/" + TOTACTIVIDADES;
});

$( window ).resize(function(){//detectamos si se redimenciona la ventana para ajustar tamaño del titulo
    /*** VARIABLES ***/
    tamConteBtns = parseInt($("#contenedorBtnsMenu").innerWidth()+20);//Width del contenedor de los botones y noAct, se quitó un +20 que era del no de actividad
    tamHeader = parseInt($("#encabezadoAppGral").innerHeight());
    tamAside = parseInt($("#plecaBotons").innerWidth());
    /*****************/
    $("#temaGeneral").css("width",parseInt(window.innerWidth-(tamConteBtns+tamAside))+"px");
    
    
    
	
	tamAsideBtns = parseInt(document.getElementById("plecaBotons").offsetWidth);
	tamAsideNames = parseInt(document.getElementById("plecaNames").offsetWidth);
	tamFooter = (parseInt(document.getElementById("pieGeneral").offsetHeight))/2;
	
	document.getElementById("actividad").style.width = (document.body.clientWidth - tamAsideBtns) + "px";
	document.getElementById("actividad").style.height = (document.documentElement.clientHeight - tamHeader) + "px";
	
	$("#contenedorBtnsMenu").css("right","0");
	$("#contenedorBtnsMenu").css("right", tamAsideBtns+"px");
	document.getElementById("plecaNames").style.display = "none";

	document.getElementById("txtNumEjercicio").innerHTML = actividad + "/" + TOTACTIVIDADES;
});