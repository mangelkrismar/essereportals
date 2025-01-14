/***********************************************************************************
* 
*                                    VARIABLES GLOBALES
*
*************************************************************************************/
var imgTarjetas = [];//contiene el las imagenes que van al fondo de las tarjetas
var numTarje = [];//arreglo que contiene el número de tarjetas por posición
var numGiros  = [];//arreglo que contiene los id de los elejidos como pares
var intento = 0;//almacena e incrementa los intetos
var arrTarjeVolteado = [];//arreglo que contiene los id de las tarjetas que se han girado 
/*************************************************************************************
*
* 								FUNCIONES Y PROCEDIMIENTOS
*
**************************************************************************************/
function generaContenido(){
	/*
	* NOMBRE: generaContenido.
	* UTILIDAD: Genera el contenido de la actividad.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	*/
	for(i=1; i<=numMaxImg; i++){
		imgTarjetas.push(i);//realiza un ciclo según el número maximo de imagenes para gregarlos por posiciones
	}

	for(u=1; u<=numTarjetas; u++){
		numTarje.push(u);//realiza un ciclo según el número total de tarjetas d ela actividad para gregarlos por posiciones
	}
	
	imgTarjetas.sort(function(){return Math.random() - 0.5});//mezcla las imagenes disponibles
	numTarje.sort(function(){return Math.random() - 0.5});//mezcla los números para el número de tarjetas
	
	//Tipo de memoria 1: Dos imagenes repetidas
	if(tipoMemoria == 1){//Si es tipo de memoria 1 
		for(j=0; j<numImgMostrar; j++){//realiza ciclo según el número de de imagenes a mostrar
			$("#img"+numTarje[j]).css("background-image","url("+PREFIJO+"Par1img"+imgTarjetas[j]+".png)");//agrega al elemento la imagen
			$("#img"+numTarje[j]+" td").text("");
			$("#cartaMemorama"+numTarje[j]).attr("onclick","girarCarta($(this))");//agrega el evento onclick
			$("#cartaMemorama"+numTarje[j]).attr("data",imgTarjetas[j]);//agrega la carta un data con el número de imagen
		}
		
		numTarje.splice(0,numImgMostrar);//elimina los 6 id que ya se posicionaron
		
		for(i=0; i<numImgMostrar; i++){//se vuelve a realizar el ciclo para posicionar las 6 imagenes que se van a repetir
			$("#img"+numTarje[i]).css("background-image","url("+PREFIJO+"Par1img"+imgTarjetas[i]+".png)");//agrega al elemento la imagen ques e repita
			$("#img"+numTarje[i]+" td").text("");
			$("#cartaMemorama"+numTarje[i]).attr("onclick","girarCarta($(this))");//agrega el evento onclick
			$("#cartaMemorama"+numTarje[i]).attr("data",imgTarjetas[i]);//agrega la carta un data con el número de 
		}
	//Tipo de memoria 2 : Si muestra una imagnes y su descripción	
	}else if(tipoMemoria == 2){//Si es de tipo 2
		for(j=0; j<numImgMostrar; j++){//realiza ciclo según el número de de imagenes a mostrar en este caso descripcion
			$("#img"+numTarje[j]).css("background-image","url("+PREFIJO+"Par1img"+imgTarjetas[j]+".png)");//agrega la imagen
			$("#img"+numTarje[j]+" td").text("");
			$("#cartaMemorama"+numTarje[j]).attr("onclick","girarCarta($(this))");//agrega evento onclick
			$("#cartaMemorama"+numTarje[j]).attr("data",imgTarjetas[j]);//agrega un data con el num de img
		}
		
		numTarje.splice(0,numImgMostrar);//elimina los 6 id que ya se posicionaron
		
		for(a=0; a<numImgMostrar; a++){//realiza ciclo según el num de imagenes a mostrar
			for(i=0; i<tarjetasDescri.length; i++){//realiza ciclo según la longitud del arreglo de las descripciones
				if(tarjetasDescri[i][0] == imgTarjetas[a]){//compara si la imagen de la tarjeta que se posiciono es igual al número de la posicion[0] del arreglo de descripciones
					//$("#img"+numTarje[a]).addClass("d_cartatxt");//agrega la clase para mostrar texto
					$("#text"+numTarje[a]).text(tarjetasDescri[i][1]);//agrega la descripcion del arreglo a la tarjeta
					$("#cartaMemorama"+numTarje[a]).attr("onclick","girarCarta($(this))");//agrega el evento onclick
					$("#cartaMemorama"+numTarje[a]).attr("data",imgTarjetas[a]);//agrega un atributo data
				}
			}
		}	
	}else if(tipoMemoria == 3){//Si es de tipo 3
		
		for(a=0; a<numImgMostrar; a++){//realiza ciclo según el num de imagenes a mostrar
			for(i=0; i<tarjetasDescri.length; i++){//realiza ciclo según la longitud del arreglo de las descripciones
				
				if(tarjetasDescri[i][0] == imgTarjetas[a]){//compara si la imagen de la tarjeta que se posiciono es igual al número de la posicion[0] del arreglo de descripciones
					//$("#img"+numTarje[a]).addClass("d_cartatxt");//agrega la clase para mostrar texto
					$("#text"+numTarje[a]).text(tarjetasDescri[i][1]);//agrega la descripcion del arreglo a la tarjeta
					$("#cartaMemorama"+numTarje[a]).attr("onclick","girarCarta($(this))");//agrega el evento onclick
					$("#cartaMemorama"+numTarje[a]).attr("data",imgTarjetas[a]);//agrega un atributo data
				}
			}
		}
		numTarje.splice(0,numImgMostrar);//elimina los 6 id que ya se posicionaron
		for(a=0; a<numImgMostrar; a++){//realiza ciclo según el num de imagenes a mostrar
			for(i=0; i<tarjetasDescri.length; i++){//realiza ciclo según la longitud del arreglo de las descripciones
				if(tarjetasDescri[i][0] == imgTarjetas[a]){//compara si la imagen de la tarjeta que se posiciono es igual al número de la posicion[0] del arreglo de descripciones
					//$("#img"+numTarje[a]).addClass("d_cartatxt");//agrega la clase para mostrar texto
					$("#text"+numTarje[a]).text(tarjetasDescri[i][2]);//agrega la descripcion del arreglo a la tarjeta
					$("#cartaMemorama"+numTarje[a]).attr("onclick","girarCarta($(this))");//agrega el evento onclick
					$("#cartaMemorama"+numTarje[a]).attr("data",imgTarjetas[a]);//agrega un atributo data
				}
			}
		}
	}else if(tipoMemoria == 4){//Si es de tipo 4
		for(j=0; j<numImgMostrar; j++){//realiza ciclo según el número de de imagenes a mostrar
			$("#img"+numTarje[j]).css("background-image","url("+PREFIJO+"Par1img"+imgTarjetas[j]+".png)");//agrega al elemento la imagen
			$("#img"+numTarje[j]+" td").text("");
			$("#cartaMemorama"+numTarje[j]).attr("onclick","girarCarta($(this))");//agrega el evento onclick
			$("#cartaMemorama"+numTarje[j]).attr("data",imgTarjetas[j]);//agrega la carta un data con el número de imagen
		}
		
		numTarje.splice(0,numImgMostrar);//elimina los 6 id que ya se posicionaron
		
		for(i=0; i<numImgMostrar; i++){//se vuelve a realizar el ciclo para posicionar las 6 imagenes que se van a repetir
			$("#img"+numTarje[i]).css("background-image","url("+PREFIJO+"Par2img"+imgTarjetas[i]+".png)");//agrega al elemento la imagen ques e repita
			$("#img"+numTarje[i]+" td").text("");
			$("#cartaMemorama"+numTarje[i]).attr("onclick","girarCarta($(this))");//agrega el evento onclick
			$("#cartaMemorama"+numTarje[i]).attr("data",imgTarjetas[i]);//agrega la carta un data con el número de 
		}

	}          
}

function girarCarta(objeto){
	/*
	* NOMBRE: girarContenido.
	* UTILIDAD: Realiza el movimiento de giro a la carta.
	* ENTRADAS: objeto ---> elmento que se selecciono (tarjeta)
	* SALIDAS: Ninguna.
	*/
	/*****VARIABLES******/
	var sonido = new Audio();//En realidad es un objeto de sonido
	var idGira = objeto.attr("id");//agrega el id del elemento seleccionado (tarjeta)
	/**********************/
	$("#"+idGira+" .agrega8").css({"opacity":"0"});
	sonido.src = IP+"src/audio/red_pdc_memoria_abrir.mp3";//cada que elige una tarjeta llama al sonido
	sonido.play();//reproduce el audio
	$("#"+idGira).transition({rotateY: gradosGirar+"deg"},1000);//agrega el movimiento de girar a las tarjetas
	numGiros.push(idGira);//agrega al array el id del elemento girado
	
	$("#"+idGira).removeAttr("onclick");//remueve el evento onclick a elemento seleccionado
	
	if(numGiros.length == 2){//si hasta el momento se han seleccionado una par

		for(a=1; a<=numTarjetas; a++){//realiza el ciclo según el num de tarjetas
			$("#cartaMemorama"+a).removeAttr("onclick");//quita el onlick
			$("#cartaReverso"+a).css("cursor","default");//cambia cursor
		}
		
		if($("#"+numGiros[0]).attr("data") == $("#"+numGiros[1]).attr("data")){//compara el atributo data de los elemento seleccionados para saber si los números coinciden
			arrTarjeVolteado.push(numGiros[0]);//agrega los dos elementos selecciondos
			arrTarjeVolteado.push(numGiros[1]);
			
			setTimeout(function(){  
				playCorrecto();//despues de 1000 suena correcto
			},1000);
			
			setTimeout(function(){  
				aciertos++;//incrementa aciertos
				$("#contAciertos").html(aciertos);//agrega los aciertos al div
				evaluaActividad();//llama a evaluar actividad
			},1700); 

		}else{
			setTimeout(function(){  
				playIncorrecto();//suene incorrecto
			},1000);
			//como fueron incorrecto regresan a su posición correcta
			setTimeout(function(){  
				$("#"+numGiros[0]+" .agrega8").css({"opacity":"1"});
				$("#"+numGiros[1]+" .agrega8").css({"opacity":"1"});
				$("#"+numGiros[0]).transition({rotateY: 0+"deg"},1000); //regresan a su posición
				$("#"+numGiros[1]).transition({rotateY: 0+"deg"},1000); //regresan a su posición
			},2000);
		}        
		
	setTimeout(function(){  
		for(i=1; i<=numTarjetas; i++){//realiza ciclo para agrega el onclick y cursor
			$("#cartaMemorama"+i).attr("onclick","girarCarta($(this))");
			$("#cartaReverso"+i).css("cursor","pointer");
		}			
		
		for(i=1; i<=numTarjetas; i++){//realiza ciclo segun el num de tarjetas
			for(h=0; h<arrTarjeVolteado.length; h++){//realiza ciclo según el num de elementos que ya fueron volteados
				if($("#cartaMemorama"+i).attr("id") == arrTarjeVolteado[h]){//compara el id de cada elemento con los elementos del arreglo que se encuentra dentro
					$("#cartaMemorama"+i).removeAttr("onclick","girarCarta($(this))");//remueve onclick
					$("#cartaReverso"+i).css("cursor","default");//cambia cursor
				}       
			}
		}	
		numGiros= [];//se vacía el arreglo de elementos girados
	},2100);
	
	intento++;//incrementa intento
	$("#contIntentos").html(intento);//agrega al div el intento
	}
}

function evaluaActividad(){
	/*
	* NOMBRE: evaluaActividad.
	* UTILIDAD: Evalua las soluciones en la actividad.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	*/
	if(aciertos == numImgMostrar){//compara para saber si los aciertos son igual al número de imagens mostradas
		if(intento < 9){//si los intentos son menor a 9
			aciertos = 6;//agrega 6 aciertos
			errores = 0;
			fillBarBien();//el ejercicios es correcto
		}else if(intento >14){//si los intento son mayor a 14
			aciertos = 0;
			errores = 6;//agrega 6 errores
			fillBarMal();//el ejercicio es incorrecto
		}else{
			switch(intento){//se realiza un switch enviando los intento

				case 10://si son 10
					aciertos = 5;//agrega 5 aciertos 1 error
					errores = 1;
					break;
				
				case 11:
					aciertos = 4;//agrega 4 aciertos 2 errores
					errores = 2;
					break;				
				
				case 12:	
					aciertos = 3;//agrega 3 aciertos 3 errores
					errores = 3;
					break;
					
				case 13:	
					aciertos = 2; //agrega 2 aciertos 4 errores
					errores = 4;
					break;
					
				case 14:	
					aciertos = 1; //agrega 1 aciertos 5 errores
					errores = 5;
					break;	 
			}
		fillBarMal();	
		}
		evaluaDefault();
	}
}