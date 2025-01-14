/***********************************************************************************
* 
*                                    CONSTANTES
*
*************************************************************************************/
var IP = "http://"+document.domain+"/KrismarApps/";//Path de ubicación de imágenes
var PREFIJO = "define_el_prefijo_para_tu_Actividad";//Almacena parte de la ruta donde se ubican los archivos de imagen
var TOTACTIVIDADES = 5;//Almacena el total de actividades, definelo

var HAYNIVEL = true;//Indica si existe o no nivel en la aplicación para mostrar/ocultar icono
var HAYVELAPP = false;//Determina si la aplicación requiere fijar velocidad de ejecución (definela)

var NIVEL = 5;//Define el nivel de tu actividad
var MAXDIGIT = 2;//Es el tope de escritura de digitos en los divs
/***********************************************************************************
* 
*                                    VARIABLES GLOBALES
*
*************************************************************************************/


/*************************************************************************************
*
* 								FUNCIONES Y PROCEDIMIENTOS
*
**************************************************************************************/
function repiteAudioActividad(){
	/*
	* NOMBRE: repiteAudioActividad.
	* UTILIDAD: Vuelve a reproducir el audio de la actividad.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	*/
	/*
	*
	* Escribe aquí tu código
	*
	*/
}

function borraSolucionActividad(){
	/*
	* NOMBRE: borraSolucionActividad. 
	* UTILIDAD: Borra la solución de la actividad en curso.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	*/
	/*
	* 
	* Escribe aquí tu código
	* 
	*/
}

function siguienteActividad(){
	/*
	* NOMBRE: siguienteActividad.
	* UTILIDAD: Cambia al siguiente ejercicio.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	*/		
	incrementaActividad();//Incrementa el número de la activad.
	iniciaCronometro();//Continua el cronómetro
	desactivarBtn("#btnSiguiente");
	/*
	 * 
	 * Escribe aquí tu código
	 * 
	 */
}

function evaluaActividad(){
	/*
	* NOMBRE: evaluarActividad.
	* UTILIDAD: Evalua las soluciones en la actividad.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	*/
	detieneCronometro();		
	desactivarBtn("#btnEvaluarActividad");
	
	if(actividad == TOTACTIVIDADES){//Se alcanzó la última actividad
		/*
		 * 
		 * Escribe aquí tu código
		 * 
		 */
		despliegaDetallesEval();
	}else{//Todavía hay actividades por contestar
		activarBtn("#btnSiguiente","siguienteActividad()");
		/*
		 * 
		 * Escribe aquí tu código
		 * 
		 */
	}
}

function simuladorKeyUp(){
	/*
	* NOMBRE: simuladorKeyUp.
	* UTILIDAD: Ejecuta el código que contiene cada vez que se presiona una tecla.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	*/
	/*
	 * 
	 * Escribe aquí tu código
	 * 
	 */
    
    
    console.log("Ya me presionaste");
}

function iniciaActividad(){
	/*
	* NOMBRE: iniciaActividad.
	* UTILIDAD: Quita opacidad inicial, ejecuta el codigo que iniciliza la aplicación.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	*/
	if(actividad == 1){//Controla que se ejecute una sola vez cuando inicia la aplicación
		$("#opacidadInicialGral").hide();
		$("#instruccionesGeneral").hide();
		iniciaCronometro();
	}
    if(device == "movil"){
        activarBtn("#prueba","muestraTeclado('#'+this.id)");
    }
	
	/*
	 * 
	 * Escribe aquí tu código
	 * 
	 */
}


/**************************************************************************
*
* Para habilitar/deshabilitar botones haz uso de las siguientes sentencias:
*
*	> para activar: 
*		activarBtn("#btnRepetirAudio","repiteAudioActividad()");
*		activarBtn("#btnBorrar","borraSolucionActividad()");
*		activarBtn("#btnSiguiente","siguienteActividad()");
*		activarBtn("#btnEvaluarActividad","evaluaActividad()");
*
*	> para desactivar: 
*		desactivarBtn("#btnRepetirAudio");
*		desactivarBtn("#btnBorrar");
*		desactivarBtn("#btnSiguiente");
*		desactivarBtn("#btnEvaluarActividad");
*
*
*	Si tu actividad tiene ajuste para la velocidad de ejecución, entonces deberás
*	poner en true la constante HAYVELAPP y usarás la variable velApp, la cual
*	es de tipo cadena y almacena literal la velocidad; esto es:
*
*			velApp = "lento", si la velocidad es lento.
*			velApp = "normal", si la velocidad es normal.
*			velApp = "rapido", si la velocidad es rapido.
*
*	Para cambiar el audio de fondo de la actividad, sólo invoca el método
*	cambiaFondoAct(); y envíale como parámetro el nombre de tu archivo de audio,
*	por ejemplo:
*			cambiaFondoAct("mdt_act51_3_t");
*
*	Para reproducir el sonido de una respuesta correcta, solo invoca la función;
*			playCorrecto();
*	Para reproducir el sonido de una respuesta incorrecta, solo invoca la función:
*			playIncorrecto();
*
*
*********************************************************
*********************************************************
*********************************************************
*
*	Estas son las variables que NO deben utilizar en la
*	declaración de sus aplicaciones ni modificar, salvo
*	las mencionadas anteriormente:
*
*		minutos, segundos, dirTiempo, indiceNivelApp,
*		velApp, enviaBD, totReactivos, actividad, 
*		aciertos, errores, porcentaje.
*
***************************************************************************/


