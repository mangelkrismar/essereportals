/***********************************************************************************
* 
*                                    CONSTANTES
*
*************************************************************************************/

/***********************************************************************************
* 
*                                    VARIABLES GLOBALES
*
*************************************************************************************/
var tecladoVisible = false;//Auxiliar para saber si el teclado está visible
var tmpValue = "";//almacena el numero producido por el teclado virtual
var idElemento = null;//Id del elemento sobre el cual se va a escribir
/*************************************************************************************
*
*                               FUNCIONES Y PROCEDIMIENTOS
*
**************************************************************************************/
function muestraTeclado(itm){
    /*
    * NOMBRE: muestraTeclado.
    * UTILIDAD: Muestra el teclado.
    * ENTRADAS: itm > cadena, es el id del elemento sobre el cual se escribe.
    * SALIDAS: Ninguna.
    */
    idElemento = itm;
    
    /*** Inhabilitamos el teclado del dispositivo móvil ***/
    $(idElemento).attr('readonly', 'readonly');//Lo ponemos en modo lectura
    $(idElemento).attr('disabled', 'true');//Se deshabilita para no mostrar el teclado vitual
    
    $(idElemento).blur();//Se oculta el input del teclado
    
    /*** Se muestra de nuevo para que no pierda sus estilos visuales ***/
    $(idElemento).removeAttr('readonly');
    $(idElemento).removeAttr('disabled');
    
    $("#teclado").show();
    $("#teclado").stop(true,true).animate({bottom: "0px"}, 300);
    $("#pieGeneral").fadeOut();//oculta el footer
    tmpValue = "";
    activarBtn("#p_punto","registraNum('.')");//Se habilita por si se ocultó
    tecladoVisible = true;
}

function ocultaTeclado(){
    /*
    * NOMBRE: ocultaTeclado.
    * UTILIDAD: Oculta el teclado.
    * ENTRADAS: Ninguna.
    * SALIDAS: Ninguna.
    */
    $("#teclado").stop(true,true).animate({bottom: "-102px"}, 0);
    $("#teclado").hide();
    
    $("#pieGeneral").fadeIn();//Muestra el footer
    tecladoVisible = false;
}

function registraNum(itm){
    /*
    * NOMBRE: registraNum.
    * UTILIDAD: Registra los números pulsados en la simulación del teclado.
    * ENTRADAS: itm > entero, es el número pulsado por el usuario.
    * SALIDAS: Ninguna.
    */
    
    /*** Si el caracter introducido al input es un punto, lo desactivamos ***/
    if (itm==".") {
        desactivarBtn("#p_punto");
    }

    if(itm == "del"){//Se presiona la tecla de borrar
        if(tmpValue.length >= 1){//Si la longitud es de uno o mas
            if(tmpValue[tmpValue.length-1] == "."){//Si se borra el punto que hemos escrito, se activa el btn de nuevo
                activarBtn("#p_punto","registraNum('.')");
            }
            tmpValue = tmpValue.substring(0,tmpValue.length-1);    
        }
        
        if(tmpValue.length == 0){
            tmpValue = "";
        }
        $(idElemento).val(tmpValue);//Ponemos en el input el numero correspondiente
    }else{//Se ingresa caracter
        if(tmpValue.length < MAXDIGIT) {//Si la longitud es de uno o mas
            tmpValue += itm;
            $(idElemento).val(tmpValue);//Ponemos en el div el número acumulado
        }   
    }
    
    simuladorKeyUp();//se ejecuta la funcion
}

$(window).on("orientationchange",function(evt){//detectamos la orientaciÃ³n del dispositivo para reposicionar el teclado
    if(tecladoVisible){
        ocultaTeclado();
        muestraTeclado();
    }
});
