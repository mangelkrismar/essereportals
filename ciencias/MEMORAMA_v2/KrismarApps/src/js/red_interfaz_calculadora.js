/***********************************************************************************
* 
*                                    VARIABLES GLOBALES
*
*************************************************************************************/
var x = "0"; //número en pantalla
var xi = 1; //iniciar número en pantalla: 1=si; 0=no;
var coma = 0; //estado coma decimal 0=no, 1=si;
var numStandBy = 0; //número oculto o en espera.
var operacionActual = "no"; //operación en curso; "no" =  sin operación.
var bandLimpiaChar = true;    //Para limitar la cantidad de caracteres

/*************************************************************************************
*
* 								FUNCIONES Y PROCEDIMIENTOS
*
**************************************************************************************/

function abreCalculadora(){
	/*
	* NOMBRE: abreCalculadora.
	* UTILIDAD: Muestra la calculadora en la aplicación.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	*/
	$("#formCalculadora").show();
	$("#opacidadGeneralInformacion").hide();
	$("#detallesEvaluacion").hide();
	$("#menuConfiguracion").hide();
	ctrlMenuConfig = 0;
	$("#formCalculadora").draggable({//Se agrega propiedad para moverla de lugar
        cursor:"move",
        handle:".d_MOVER",
        containment: "#contenedor"
    });
}

function ocultaCalculadora(){
	/*
	* NOMBRE: ocultaCalculadora.
	* UTILIDAD: Oculta la calculadora de la aplicación.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	*/
	$("#formCalculadora").hide();
	borradoTotal();
}

function numero(tmpNum) {
	/*
	* NOMBRE: numero.
	* UTILIDAD: Obtiene el número que es desplegado en pantalla de la calculadora.
	* ENTRADAS:tmpNum > entero, números que ha pulsado el usuario.
	* SALIDAS: Ninguna.
	*/
	/*** VARIABLES LOCALE ***/
    snum = $("#textoPantalla").text();   //obtenemos el contenido del div
    /************************/        
    snum = snum.toString();

    if((snum.length >= 9) && (xi == 0)){
    	bandLimpiaChar = false;
    }
     
    if(bandLimpiaChar){
    	if (x=="0" || xi==1  ) {   // inicializar un número, 
            document.getElementById("txtPantallaCalc").innerHTML=tmpNum; //mostrar en pantalla
            x=tmpNum; //guardar número
            if (tmpNum==".") { //si escribimos una coma al principio del número
               document.getElementById("txtPantallaCalc").innerHTML="0."; //escribimos 0.
               x=tmpNum; //guardar número
               coma=1; //cambiar estado de la coma
           }
		}
        else { //continuar escribiendo un número
        	if (tmpNum=="." && coma==0) { //si escribimos una coma decimal pòr primera vez
            	document.getElementById("txtPantallaCalc").innerHTML+=tmpNum;
                x+=tmpNum;
                coma=1; //cambiar el estado de la coma  
			}
			//si intentamos escribir una segunda coma decimal no realiza ninguna acción.
           	else if (tmpNum=="." && coma==1) {} 
            //Resto de casos: escribir un número del 0 al 9:      
            else {
            	document.getElementById("txtPantallaCalc").innerHTML+=tmpNum;
                x+=tmpNum
			}
		}
		xi=0 //el número está iniciado y podemos ampliarlo.
	}
}

function operar(s) {
	/*
	* NOMBRE: operar.
	* UTILIDAD: Obtiene el número que es desplegado en pantalla de la calculadora.
	* ENTRADAS:s > cadena, tipo de operacion.
	* SALIDAS: Ninguna.
	*/
	igualar() //si hay operaciones pendientes se realizan primero
	numStandBy=x //ponemos el 1º número en "numero en espera" para poder escribir el segundo.
	operacionActual=s; //guardamos tipo de operación.
	xi=1; //inicializar pantalla.
	bandLimpiaChar = true;
	coma=0; //cambiar el estado de la coma
}  

function igualar() {
	/*
	* NOMBRE: igualar.
	* UTILIDAD: Realiza la operacion seleccionada.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	*/
	if (operacionActual=="no") { //no hay ninguna operación pendiente.
		document.getElementById("txtPantallaCalc").innerHTML=x;   //mostramos el mismo número 
	}
	else { //con operación pendiente resolvemos
		sl=numStandBy+operacionActual+x; // escribimos la operación en una cadena
		sol=eval(sl) //convertimos la cadena a código y resolvemos
		sol = sol.toFixed(5);  //Se limitra el numero de decimales a 5
		nx=Number(sol); //convertir en número
		sol=String(nx); 
		document.getElementById("txtPantallaCalc").innerHTML=sol //mostramos la soludión
		x=sol; //guardamos la solución
		operacionActual="no"; //ya no hayn operaciones pendientes
		xi=1; //se puede reiniciar la pantalla.
		coma=0; //cambiar el estado de la coma
	}
}

function raizc() {
	/*
	* NOMBRE: raizc.
	* UTILIDAD: Obtiene la raíz cuadrada.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	*/
	x=Math.sqrt(x) //resolver raíz cuadrada.
	x = x.toFixed(5);  //Se limitra el numero de decimales a 5
	nx=Number(x); //convertir en número
	x=String(nx); 
	document.getElementById("txtPantallaCalc").innerHTML=x; //mostrar en pantalla resultado
	operacionActual="no"; //quitar operaciones pendientes.
	xi=1; //se puede reiniciar la pantalla 
}

function porcent() {
	/*
	* NOMBRE: porcent.
	* UTILIDAD: Obtiene el porcentaje.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	*/
    x=x/100 //dividir por 100 el número
	x = x.toFixed(5);  //Se limitra el numero de decimales a 5
	nx=Number(x); //convertir en número
	x=String(nx); 
	document.getElementById("txtPantallaCalc").innerHTML=x; //mostrar en pantalla
    igualar(); //resolver y mostrar operaciones pendientes
	xi=1; //reiniciar la pantalla
}

function opuest() {
	/*
	* NOMBRE: opuest.
	* UTILIDAD: Cambia el signo del número en pantalla.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	*/
	nx=Number(x); //convertir en número
	nx=-nx; //cambiar de signo
	x=String(nx); //volver a convertir a cadena         
	document.getElementById("txtPantallaCalc").innerHTML=x; //mostrar en pantalla.
}

function inve() {
	/*
	* NOMBRE: inve.
	* UTILIDAD: Calcula el inverso del número.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	*/
	nx=Number(x);
    nx=(1/nx);
	x=String(nx);       
    document.getElementById("txtPantallaCalc").innerHTML=x;
	xi=1; //reiniciar pantalla al pulsar otro número.
}

function retro(){
	/*
	* NOMBRE: retro.
	* UTILIDAD: Borrar sólo el último número escrito.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	*/
	cifras=x.length; //hayar número de caracteres en pantalla
	br=x.substr(cifras-1,cifras) //describir último caracter
    x=x.substr(0,cifras-1) //quitar el ultimo caracter
	if (x=="") {x="0";} //si ya no quedan caracteres, pondremos el 0
	if (br==".") {coma=0;} //Si el caracter quitado es la coma, se permite escribirla de nuevo.
	document.getElementById("txtPantallaCalc").innerHTML=x; //mostrar resultado en pantalla   
}

function borradoParcial() {
	/*
	* NOMBRE: borradoParcial.
	* UTILIDAD: Borra el texto en pantalla de la calculadora.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	*/
	document.getElementById("txtPantallaCalc").innerHTML = 0; //Borrado de pantalla;
	x=0;//Borrado indicador número pantalla.
    coma=0; //reiniciamos también la coma               
}

function borradoTotal() {
	/*
	* NOMBRE: borradoTotal.
	* UTILIDAD: Borrar texto en pantalla e inicializa la operacion que se hacía.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	*/
	document.getElementById("txtPantallaCalc").innerHTML = 0; //poner pantalla a 0
    x="0"; //reiniciar número en pantalla
	coma=0; //reiniciar estado coma decimal 
	numStandBy=0; //indicador de número oculto a 0;
	operacionActual="no"; //borrar operación en curso.
	bandLimpiaChar = true;
}