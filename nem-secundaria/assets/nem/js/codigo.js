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
//Ninguno
/*************************************************************************************
*
* 								FUNCIONES Y PROCEDIMIENTOS
*
**************************************************************************************/
/**
 * @description Detecta el documento esta listo
 */
document.addEventListener("DOMContentLoaded", function(event) {
    document.addEventListener("scroll", onScroll);/*Acciones en scroll*/
    document.addEventListener("click", closeAction);/*Detecta clik en el documento*/
    limitScroll(0);/*Mueve el scroll top o bottom*/
});
/**
 * @description Detecta el resize del navegador
 */
document.addEventListener("resize", (event) => {
    closeMenu();/*Cierra menu en header*/
    limitScroll(0);/*Mueve el scroll top o bottom*/
});
/**
 * @description: Abre menu en header
 */
const openMenu = () => {
    const getHeaderelemnt = document.querySelector("#d_header");//Obtiene el elemento principal
    getHeaderelemnt.classList.add('d_headeropenmenu');
}
/**
 * @description: Cierra menu en header
 */
const closeMenu = () => {
    const getHeaderelemnt = document.querySelector("#d_header");//Obtiene el elemento principal
    getHeaderelemnt.classList.remove('d_headeropenmenu');
}
/**
 * @description: Abre overlay card en header
 */
const openMenuoverlaycard = () => {
    const getHeaderelemnt = document.querySelector("#d_principalcardoverlay_0");//Obtiene el elemento principal
    getHeaderelemnt.classList.add('d_principalcardoverlay_open');
}
/**
 * @description: Cierra overlay card en header
 */
const closeMenuoverlaycard = () => {
    const getHeaderelemnt = document.querySelector("#d_principalcardoverlay_0");//Obtiene el elemento principal
    getHeaderelemnt.classList.remove('d_principalcardoverlay_open');
}
/**
 * @description: Abre menu user en header
 */
const openMenuuser = () => {
    //const getHeaderelemnt = document.querySelector("#d_headeruser");//Obtiene el elemento principal
    //getHeaderelemnt.classList.add('d_headeropenuser');
}
/**
 * @description: Acciones en scroll
 */
const onScroll = () => {
    closeMenu();/*Cierra menu en header*/
    let savePosscroll = window.scrollY;/*Obtiene posicion scroll*/
    const getelement_a = document.querySelector('#d_navhome');/*Obtiene objetos a mostrar / ocultar*/
    const getelement_b = document.querySelector('#d_navconte');/*Obtiene objetos a mostrar / ocultar*/
    //(savePosscroll > 300)?getelement_a.style.display = "none":getelement_a.style.display = "flex";
    (savePosscroll > 300)?getelement_b.style.display = "none":getelement_b.style.display = "flex";
}
/**
 * @description: Abre los submenu
 */
const openSubmenu = (getThis,e) => {
    const headerMenuget = document.querySelector('#d_headermenu');//Obtiene el elemento principal
    const headerMenugetul = headerMenuget.querySelectorAll('ul');//Busca los ul hijos
    headerMenugetul.forEach(function (ulList) {//Busca los hijos ul
        ulList.style.display = 'none';//Cierra menu al dar clik en otro btn del mismo ul
    });
    let saveThis = getThis.parentNode.querySelector('ul');//Almacena el ul que contiene el submenu a mostrar y ocultar
    saveThis.style.display = (saveThis.style.display == 'flex') ? 'none' : 'flex';//Muestra y oculta el submenu
}
/**
 * @description: Abre los submenu
 */
const scrollEnd = () => {
    const offsetElement = document.querySelector("#d_footer");//Obtiene el top del footer
    const offsetBottom = offsetElement.offsetTop;//Obtiene el top del footer
    limitScroll(offsetBottom);/*Mueve el scroll top o bottom*/
}
/**
 * @description Regresa el scroll a su posicion inicial
 */
const btnScrollup = () =>{
    limitScroll(0);/*Mueve el scroll top o bottom*/
}
/**
 * @description Mueve el scroll top o bottom
 */
const limitScroll = (getControl) => {
    window.scroll({
        top: getControl,
        behavior: "smooth",
    });
}
/**
 * @description Detecta clik en el documento
 */
const closeAction = (e) => {
    const getHeadermenu = document.querySelector('#d_headermenu');//Obtiene el elemento principal
    const getHeadsubmenu = getHeadermenu.querySelectorAll('ul');//Busca los ul hijos
    if (document.getElementById('d_headermenu').contains(e.target)){//Si estoy presionando el que tiene la accion
    } else{//Presiono el que no tiene la accion
        getHeadsubmenu.forEach(function (ulList) {//Busca los hijos
            ulList.style.display = 'none';//Cierra menu al dar clik fuera
        });
    }
}