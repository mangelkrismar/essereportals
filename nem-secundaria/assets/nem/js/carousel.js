/***********************************************************************************
* 
*                                    CONSTANTES
*
*************************************************************************************/
//
/***********************************************************************************
* 
*                                    VARIABLES GLOBALES
*
*************************************************************************************/
var incCont = 1;//Incremento de conteo para cambio de imagenes automatico
/*************************************************************************************
*
* 								FUNCIONES Y PROCEDIMIENTOS
*
**************************************************************************************/
/**
 * @description Detecta el documento esta listo
 */
document.addEventListener("DOMContentLoaded", function(event) {
    automaticCarousel();/*Cambio de imagenes del carousel automatico*/
});
/**
 * @description Detecta el resize del navegador
 */
document.addEventListener("resize", (event) => {});
/**
 * @description Cambio de imagenes del carousel automatico
 */
const automaticCarousel = (getThis) => {
    incCont = 1;//Incremento de conteo para cambio de imagenes automatico
    let contDiv = document.querySelectorAll(".d_imgsslide").length;//Conteo de imagenes totales
    const useElement = document.querySelector("#d_carouselbts");//Elemento a asignar div
    for(var i=1; i<= contDiv; i++){//Agrega btns para cambiar imagenes
        useElement.innerHTML += `<div class="d_carouselbtn" id="carouselbtn_`+i+`" onclick="carouselChange(this.id);"><span></span></div>`;//Agrega elementos
    }
    let setInt = setInterval(function(){//Intervalo de tiempo
        if(incCont <= contDiv){//Aplica mientras sea dentro del total de imagenes
            carouselChange("carouselbtn_"+incCont);//Llama a la funcion para hacer cambio de imagenes
            incCont++;//Incrementa
        }else{
            incCont = 1;//resetea
        }
    },5000);
}
/**
 * @description Cambio de imagenes del carousel
 */
const carouselChange = (getThis) => {
    const imgAll = document.querySelectorAll(".d_imgsslide");//Obtiene el elemento principal
    imgAll.forEach(function (imgList) {//Busca el hijo de cada elemento
        imgList.style.display = 'none';//Oculta todas las imagenes
    });
    let getId = getThis.split('_')[1];//Obtiene el id del btn en curso
    incCont = getId;//Incremento de conteo para cambio de imagenes automatico
    const carrouselImg = document.querySelector("#carouselimg_"+getId);
    carrouselImg.style.display = 'block';//Muestra la imagen en turno
    const carouselBtn = document.querySelectorAll(".d_carouselbtn");//Obtiene el elemento principal
    carouselBtn.forEach(function (divList) {//Busca el hijo de cada elemento
        const carouselBtnspan = divList.querySelector('span');//Busca el span hijo
        carouselBtnspan.style.display = 'none';//Inactiva btns
    });
    const getThiselement = document.querySelector("#"+getThis);//Obtiene el elemento principal
    const getThiselementspan = getThiselement.querySelector('span');//Busca el hijo span del elemento
    getThiselementspan.style.display = 'block';//Activa btn de img en curso
}