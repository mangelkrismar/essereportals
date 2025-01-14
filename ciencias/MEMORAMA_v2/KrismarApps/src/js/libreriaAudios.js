/***********************************************************************************
* 
*                                    CONSTANTES
*
*************************************************************************************/
var IP = "http://"+document.domain+"/KrismarApps/"; //Almacena el path de donde se alojan los recursos
var PREFIJOSND = "src/audio/mdt_";//Prefijo para las imágenes

/*************************************************************************************
*
* 								FUNCIONES Y PROCEDIMIENTOS
*
**************************************************************************************/
function generaAleatorio(itm){
	/*
	* NOMBRE: generaAleatorio.
	* UTILIDAD: Generar número aleatorio.
	* ENTRADAS: itm > entero que limita la generación de números aleatorios.
	* SALIDAS: entero > Número aleatorio generado.
	*/
	/*** Variables locales ***/
	rand = null;//Almacena el número a retornar.
	/*************************/
	do{
		rand = Math.floor(Math.random()*100);
	}while(rand > itm);
	return (rand);
}

function playCorrecto(){
	/*
	* NOMBRE: playCorrecto.
	* UTILIDAD: Reproduce un audio aleatorio para respuesta correcta.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	*/
	switch(generaAleatorio(16)){
		case 0:
			ion.sound.play("bien1");
			break;
		case 1:
			ion.sound.play("bien2");
			break;
		case 2:
			ion.sound.play("bien3");
			break;
		case 3:
			ion.sound.play("bien4");
			break;
		case 4:
			ion.sound.play("bien5");
			break;
		case 5:
			ion.sound.play("bien6");
			break;
		case 6:
			ion.sound.play("bien7");
			break;
		case 7:
			ion.sound.play("bien8");
			break;
		case 8:
			ion.sound.play("bien9");
			break;
		case 9:
			ion.sound.play("bien10");
			break;
		case 10:
			ion.sound.play("bien11");
			break;
		case 11:
			ion.sound.play("bien12");
			break;
		case 12:
			ion.sound.play("bien13");
			break;
		case 13:
			ion.sound.play("bien14");
			break;
		case 14:
			ion.sound.play("bien15");
			break;
		case 15:
			ion.sound.play("bien16");
			break;
		case 16:
			ion.sound.play("bien17");
			break;
	}
}

function playIncorrecto(){
	/*
	* NOMBRE: playIncorrecto.
	* UTILIDAD: Reproduce un audio aleatorio para respuesta incorrecta.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	*/
	switch(generaAleatorio(8)){
		case 0:
			ion.sound.play("mal1");
			break;
		case 1:
			ion.sound.play("mal2");
			break;
		case 2:
			ion.sound.play("mal3");
			break;
		case 3:
			ion.sound.play("mal4");
			break;
		case 4:
			ion.sound.play("mal5");
			break;
		case 5:
			ion.sound.play("mal6");
			break;
		case 6:
			ion.sound.play("mal7");
			break;
		case 7:
			ion.sound.play("mal8");
			break;
		case 8:
			ion.sound.play("mal9");
			break;
	}
}
	
function initAudios(){
	/*
	* NOMBRE: initAudios.
	* UTILIDAD: Inicializa los audios a reproducir.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	*/
	ion.sound({
        sounds: [
            {name: "bien1"},
			{name: "bien2"},
			{name: "bien3"},
			{name: "bien4"},
			{name: "bien5"},
			{name: "bien6"},
			{name: "bien7"},
			{name: "bien8"},
			{name: "bien9"},
			{name: "bien10"},
			{name: "bien11"},
			{name: "bien12"},
			{name: "bien13"},
			{name: "bien14"},
			{name: "bien15"},
			{name: "bien16"},
			{name: "bien17"},
			{name: "mal1"},
			{name: "mal2"},
			{name: "mal3"},
			{name: "mal4"},
			{name: "mal5"},
			{name: "mal6"},
			{name: "mal7"},
			{name: "mal8"},
			{name: "mal9"}
        ],
        path: IP+PREFIJOSND,
        volume: 1.0
    });
}
	
window.addEventListener("load",initAudios,false); //Indica que cuando termine de cargar la página, se ejecuta el metodo iniciliaizaAudios