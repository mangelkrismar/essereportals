/***********************************************************************************

* 

*                                    VARIABLES GLOBALES

*

*************************************************************************************/

var timer = null;//variable de timer
var posicion = 0;//posicion del carrusel
var posicionFinal = 0;//posicion final donde se repetira
var anchoCarrusel = 0;//el ancho de carrusel
var ordenIconos = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33]//el orden de los iconos del carrusel
var arregloAuxiliar = []//arreglo auxiliar para ordenar los iconos
var codigoHtml = "";//variable para generar html
var cuantoRecorre = 0;//numero de posiciones que recorre el carrusel
var dondeRepite = 0;//en que posicion se repetira el carrusel
var nav = null;
var logoNova = "NOVASCHOOL-REDI";
var dondeE = true;

var direccionCeldas = ["",
						"http://localhost/preescolar", //celda 1
						"http://localhost/secundaria/", //celda 2
						"http://localhost/ciencias", //celda 3
						"http://localhost/primaria/", //celda 4
						"http://localhost/bachillerato/", //celda 5
						"http://localhost/crk/",//"https://smsem.mdt.mx/",//celda 6
						"http://localhost:8081", //celda 7, TecnoMakers
						"",//celda 8
						"http://localhost/nem-primaria",//"https://www.krismar-educa.com.mx/robotica/",//celda 9
						"http://localhost/habilidades/", //celda 10
						"contenido",//celda 11
						"http://localhost/tecnologia/", //celda 12
						"http://localhost:8081",//"http://www.mdt.mx/nutricion_ecologia/",//celda 13
						"contenido",//celda 14
						"", //celda 15, Demos    https://www.krismar-educa.com.mx/primaria/index.php/Home/demos
						//"https://drive.google.com/uc?export=download&id=1XTTvTMYzcWDLAggIEtPnxBSh8r0RneXg",//celda 15, APK FIL 2021
						"",//celda 16
						"contenido",//celda 17
						"contenido",//celda 18
						"contenido",//celda 19
						"contenido",//celda 20
						"contenido",//celda 21
						"http://localhost/nem-secundaria",//Aqui ira el LINK NEM Secundaria,//celda 8					   
						/*DEMOS*/
						"https://www.krismar-educa.com.mx/cursos/upmoodle/Dinosaurios/rompe/",//celda 1
						"https://www.krismar-educa.com.mx/cursos/upmoodle/Observa/Act8Observa1.php",//celda 2
						"https://www.krismar-educa.com.mx/cursos/upmoodle/SumasAlex/ardilla_globos.php",//celda 3
						"https://www.krismar-educa.com.mx/cursos/upmoodle/Paco/paco_leccion3_ej3.php",//celda 4
						"https://www.krismar-educa.com.mx/cursos/upmoodle/espanol4/actividad1.php", //celda 5
						"https://www.krismar-educa.com.mx/cursos/upmoodle/Paco/paco_leccion2_ej2.php",//celda 6
						"https://www.krismar-educa.com.mx/cursos/upmoodle/Ecologia/basura1.php",//celda 7
						"https://www.krismar-educa.com.mx/cursos/upmoodle/AtlasM/libroMaresActividades3.php",//celda 8
						"https://www.krismar-educa.com.mx/cursos/upmoodle/fracciones/tema2.php",//celda 9
						"https://www.krismar-educa.com.mx/cursos/upmoodle/LComputo/libro5/lec6.php",//celda 10
						"https://www.krismar-educa.com.mx/cursos/upmoodle/QuimicaE/B7_EM.php",//celda 11
						"https://www.krismar-educa.com.mx/cursos/upmoodle/QuimicaE/B6_E2.php",//celda 12
						"https://www.krismar-educa.com.mx/cursos/upmoodle/Habilidades/Clasifica/clasificaAct8.php",//celda 13
						"https://www.krismar-educa.com.mx/cursos/upmoodle/historiaM/aMexico_XXI/1_2.php",//celda 14
						/*Botones HTML*/
						//"https://www.krismar-educa.com.mx/cursos/upmoodle/mTecnologia/kids/", //celda 22
						"http://localhost:8081",//NEM ,//celda 37
						"contenido",//celda 38
						"", //celda 39     https://www.krismar.com.mx/evaluacionDocente/
						"http://localhost:8081", //celda 40
						"http://localhost:8081", //celda 41, RoboMaster
						"http://localhost:8081", //celda 42, Krismar
						"http://localhost/lecturas/", //celda 43, Krismar lecturas
						"contenido", //celda 44, navidad
						"http://localhost/page-crk/", //celda 45, CRK
					];//links celdas

var numeroCeldas = 45;//numero celdas
var pantallaActual = 1;//pantalla que se encuentra mostrada 
var contenidoCargar = "";//contenido que se mostrara al seleccionar cualquier opcion por ejemplo quienes somos
/*************************************************************************************
*
* 								FUNCIONES Y PROCEDIMIENTOS
*
**************************************************************************************/

$(document).ready(function(){//carga documento

	var URLactual = window.location;
	
	//Para el registro del usuario en la plataforma
	$("#p_activacionU").css("display","block");
	dondeE = true;
	
	/********************************************/
	/*Para la ventana modal*/
	$( "#p_activacionU").on("click", function() {
		$("#validaUser").dialog("open");		
    });
	 n = 46;
	$("#p_celda"+n).addClass("d_celda"+n+"Hover");
	
	/*$("#validaUser" ).dialog({
		autoOpen: false,
		resizable: false,
		height: "auto",
		width: 250,
		modal: true,
		show: {
		effect: "fade",
			duration: 1000
		},
		hide: {
			effect: "puff",
			duration: 1000
		},
		open: function(event, ui){
			$(".ui-dialog-titlebar").hide();
			$('.ui-widget-overlay').bind('click',function(){
				$("#validaUser").dialog('close');
			});
		},
		buttons:{
			"Delete all items": function() {
				$("#validaUser").dialog('close');
			}
		}
    });*/
	
	/*Termina aquí*/
	/********************************************/
	
	$("#p_opciones2").change(function(){
		if ($("#p_opciones2").val()=="MX") {
			$("#p_cajaopcion2").css("display","block")
		}else{
			$("#p_cajaopcion2").css("display","none")
		}
		posicionaFooter();
	})



	// this is the id of the form

	$("#formularioContato").submit(function() {
    	var url = "php/envioContato.php"; // the script where you handle the form input.
    	$.ajax({
           type: "POST",
           url: url,
           data: $("#formularioContato").serialize(), // serializes the form's elements.
           success: function(data)
           {

           	if (data=="¡Captcha invalido!") {
           		alert(data); // show response from the php script.
           		$("#captcha").removeAttr("src")//cambia el captcha
				$("#captcha").attr("src","php/captcha.php")//cambia el captcha
				$("#captcha-form").val("");
           	}else {
				$("body").stop().animate({//animacion de body
					scrollTop:0//sube el scroll hast el inicio
				},"slow",function(){
					alert(data); // show response from the php script.
					$(contenidoCargar).css("display","none")//oculta division de contenido a mostrar
					$("#p_footer").css("display","none")//oculta el pie de pagina
					$("#p_sectiondemos").css("display","none")//oculta divisiones
					$("#p_activaciongeneral").css("display","none")//oculta divisiones
					$("#p_somosgeneral").css("display","none")//oculta divisiones
					$("#p_soportegeneral").css("display","none")//oculta divisiones
					$("#p_preguntasgeneral").css("display","none")//oculta divisiones
					$("#p_licenciasgeneral").css("display","none")//oculta divisiones
					$("#p_preguntasgeneral").css("display","none")//oculta divisiones
					$("#p_registrogeneral").css("display","none")//oculta divisiones  
					$("#p_registroUsuario").css("display","none")//oculta divisiones del registro de usuarios en la plataforma
					$("#p_footer").css("display","none")//oculta divisiones
					posicionaFooter();
				});//velocidad lento
			}
           }
        });
    	return false; // avoid to execute the actual submit of the form.
	});

$("#p_promocion").on("change",function(){
	if($(this).val()=="Evento"){
		$("#numeroSerie").removeAttr("required");
		//$("#numeroSerie").val("");
		$("#textoNumero").css("display", "none");
		$("#numeroSerie").css("display","none");
	}else{
		$("#numeroSerie").attr("required");
		//$("#numeroSerie").val("");
		$("#textoNumero").css("display", "block");
		$("#numeroSerie").css("display","block");
	}
	posicionaFooter();
})
$("#formularioTech").submit(function() {
		var url = "php/techtool.php"; // the script where you handle the form input.
		var usuario = "";		
		var password = "";
		var arregloDatos = "";
		var cadenaDatos = "";
		$.ajax({
           type: "POST",
           url: url,
           data: $("#formularioTech").serialize(), // serializes the form's elements.
           success: function(data){           	
           	if (data=="¡Captcha invalido!") {
           		alert(data); // show response from the php script.
           		$("#formularioTech #captcha-form").val("");
           		$("#captcha2").removeAttr("src")//cambia el captcha
				$("#captcha2").attr("src","php/captcha.php")//cambia el captcha
           	}else {
           		if (data=="El número de serie es incorrecto") {
           			$("#formularioTech #captcha-form").val("");
           			$("#numeroSerie").focus();
           			$("#captcha2").removeAttr("src")//cambia el captcha
           			alert(data);
					$("#captcha2").attr("src","php/captcha.php")//cambia el captcha
           		}else{
           			$("body").stop().animate({//animacion de body
						scrollTop:0//sube el scroll hast el inicio
					},"slow",function(){
						cadenaDatos = data;
						arregloDatos = cadenaDatos.split(",")
						usuario = arregloDatos[0];
						password = arregloDatos[1];
						portal = arregloDatos[2];
						empresa = arregloDatos[3];
						url = "http://www.krismar-educa.com.mx/regDispositivo/regUsuario.php"; // the script where you handle the form input.
						$.ajax({
							url: url,
							data: {usuario:usuario,pas:password,portal:portal,empresa:empresa}, // serializes the form's elements.
							type: "GET",
							crossDomain: true, 
							dataType : 'jsonp',           					
							jsonp: 'callback',//nombre de la variable get para reconocer la petición
							error: function(xhr, status, error) {
								alert("error");
							},
           					success: function(data){
           						if(data==1){
           							url = "php/registro.php";
           							$.ajax({
           								type: "POST",
           								url:url,
           								data: $("#formularioTech").serialize(), // serializes the form's elements.
           								success: function(data){
           									alert(data)
           								}
           							})
           						}else{
           							alert("El correo ya fue registrado"+data)
           						}
           					}
						})
						//alert(data); // show response from the php script.

						$(contenidoCargar).css("display","none")//oculta division de contenido a mostrar
						$("#p_footer").css("display","none")//oculta el pie de pagina
						$("#p_sectiondemos").css("display","none")//oculta divisiones
						$("#p_activaciongeneral").css("display","none")//oculta divisiones
						$("#p_somosgeneral").css("display","none")//oculta divisiones
						$("#p_soportegeneral").css("display","none")//oculta divisiones
						$("#p_preguntasgeneral").css("display","none")//oculta divisiones
						$("#p_licenciasgeneral").css("display","none")//oculta divisiones
						$("#p_preguntasgeneral").css("display","none")//oculta divisiones
						$("#p_registrogeneral").css("display","none")//oculta divisiones
						$("#p_registroUsuario").css("display","none")//oculta divisiones del registro de usuarios en la plataforma
						$("#p_footer").css("display","none")//oculta divisiones
						posicionaFooter();
					});//velocidad lento
           		}
				
			}

           }

        });
		return false; // avoid to execute the actual submit of the form.
	});




	$("#p_circuloscambios1").css({//da formato a puntos de licencias
		"cursor":"default",
		"background-color":"yellow"
	})


	$("#p_circuloscambios2").attr("onclick","cambioLicencia(2)")
	$("#p_circuloscambios3").attr("onclick","cambioLicencia(3)")
	$("#p_circuloscambios4").attr("onclick","cambioLicencia(4)")
	$("#p_licenciascontenido1").css("display","block")//muestra la primera pantalla de licencias
	$("#p_section2").css("display","none")//oculta panatallas 2
	$("#p_section3").css("display","none")//oculta panatallas 3
	$("#p_section4").css("display","none")//oculta panatallas 4, la que vamos a seleccionar por icono
	$("#p_activacion").attr("onclick","activacion()")//asigna funcion al boton de activacion de licencias
	//$("#p_activacionU").attr("onclick","activacionU()")//asigna funcion al boton de activacion de licencias
	$("#botonPantalla1").css({//da formato al boton de la pantalla 1 como activo
		"background-color":"yellow",
		"cursor":"default"
	})
    $(".d_sectionbtn1").addClass('d_sectionbtn_selected');
    $(".d_sectionbtncarruselprev").addClass('d_sectionbtncarrusel_inactive');

	$("#botonPantalla2").attr("onclick","irPantalla(2)")//agrega funcion a botones para redireccionar a ellos
	$("#botonPantalla3").attr("onclick","irPantalla(3)")//agrega funcion a botones para redireccionar a ellos
    $(".d_sectionbtn2").attr("onclick","irPantalla(2)")//agrega funcion a botones para redireccionar a ellos
	$(".d_sectionbtn3").attr("onclick","irPantalla(3)")//agrega funcion a botones para redireccionar a ellos
	$(".d_sectionbtncarruselnext").attr("onclick","irPantalla(2)")//agrega funcion a botones para redireccionar a ellos
	$("#p_somosicono1").attr("onclick","irContenido('#p_soportegeneral')")//agrega evento click para abrir ubicacion dentro del sitio
	$("#p_somosicono2").attr("onclick","irContenido('#p_soportegeneral')")//agrega evento click para abrir ubicacion dentro del sitio
	$("#p_somosicono3").attr("onclick","irContenido('#p_registrogeneral')")//agrega evento click para abrir ubicacion dentro del sitio
	$("#p_somosicono4").attr("onclick","irContenido('#p_preguntasgeneral')")//agrega evento click para abrir ubicacion dentro del sitio
	$("#p_preguntasicono31").attr("onclick","irContenido('#p_soportegeneral')")//agrega evento click para abrir ubicacion dentro del sitio
	$("#p_preguntasicono32").attr("onclick","irContenido('#p_soportegeneral')")//agrega evento click para abrir ubicacion dentro del sitio
	$("#p_preguntasicono33").attr("onclick","irContenido('#p_soportegeneral')")//agrega evento click para abrir ubicacion dentro del sitio
	$("#p_preguntasicono41").attr("onclick","irContenido('#p_soportegeneral')")//agrega evento click para abrir ubicacion dentro del sitio
	$("#p_preguntasicono42").attr("onclick","irContenido('#p_soportegeneral')")//agrega evento click para abrir ubicacion dentro del sitio
	$("#p_preguntasicono43").attr("onclick","irContenido('#p_soportegeneral')")//agrega evento click para abrir ubicacion dentro del sitio
	
	$("#p_preguntasicono45").attr("onclick","irContenido('#p_soportegeneral')")//agrega evento click para abrir ubicacion dentro del sitio

	// nav = navigator.userAgent.toLowerCase();//detecta navegador
	// if(nav.indexOf("firefox") != -1){///modifica estilos para firefox
	// 	$("html, body").css({"overflow":"hidden","height":"100%"});  
	// }

	// Internet Explorer 6-11
	var isIE = /*@cc_on!@*/false || !!document.documentMode;
    
	// Edge 20+
	var isEdge = !isIE && !!window.StyleMedia;

	if(isIE == true || isEdge == true){
		$(".d_footer").css("position","fixed");
	}
    
	$("#p_sectiondemos").css("display","none")//oculta divisiones
	$("#p_activaciongeneral").css("display","none")//oculta divisiones
	$("#p_somosgeneral").css("display","none")//oculta divisiones
	$("#p_soportegeneral").css("display","none")//oculta divisiones
	$("#p_preguntasgeneral").css("display","none")//oculta divisiones
	$("#p_licenciasgeneral").css("display","none")//oculta divisiones
	$("#p_preguntasgeneral").css("display","none")//oculta divisiones
	$("#p_registrogeneral").css("display","none")//oculta divisiones
	$("#p_registroUsuario").css("display","none")//oculta divisiones del registro de usuarios en la plataforma
	$("#p_footer").css("display","none")//oculta divisiones
	anchoCarrusel = $("#p_logosmascara").width();//se obtiene el ancho del carrusel
	
	obtenerPosicionFinal()//obtiene poscion final y otros valores

	$(window).resize(function(){//en caso de que se redimensione la pantalla
		if($("body").width()>640){
			$("#p_icono1").css("background-image","url('img/"+logoNova+".png')")
		}else{
			$("#p_icono1").css("background-image","url('img/headerIcono2_chico.png')")
		}

		clearInterval(timer)//termina intervalo
		posicion = 0;//reinicia posicion
		ordenIconos = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33]//reinicia orden de iconos
		anchoCarrusel = $("#p_logosmascara").width();//vuelve a obtener el ancho del carrusel

		$("#p_tiraPantalla").stop().animate({//animacion de carrusel
				left: "0"//menos noventa px por que es lo que mide cada logo
			},300)

		obtenerPosicionFinal()//obtiene poscion final y otros valores

		codigoHtml="";//prepara codigo html
		for(i=0;i<=33;i++){//recorre arreglo ordenIconos
			codigoHtml+="<div class='d_logo"+ordenIconos[i]+"' id='p_logo"+ordenIconos[i]+"'></div>"//dibuja condigo html
		}

		posicion = 0;//reinicia posicion 
		$("#p_logoscaja").css("left","0px")//posiciona division al estado inicial
		$("#p_logoscaja").html(codigoHtml);//coloca html en division
		timer = setInterval(giraCarrusel,1000)//corre carrusel
		posicionaFooter();

	})


	timer = setInterval(giraCarrusel,1000)//corre carrusel

	$("#p_up").click(function(){//boton de arriba 
		$("html, body").stop().animate({//animacion de body
 			scrollTop:0//sube el scroll hast el inicio
 		},"slow",function(){
			 $(contenidoCargar).css("display","none")//oculta division de contenido a mostrar

			if(isIE == true || isEdge == true){
				$(".d_footer").css("position","fixed");
			}
			
			$("#p_footer").css("display","none")//oculta el pie de pagina
			$("#p_sectiondemos").css("display","none")//oculta divisiones
			$("#p_activaciongeneral").css("display","none")//oculta divisiones
			$("#p_somosgeneral").css("display","none")//oculta divisiones
			$("#p_soportegeneral").css("display","none")//oculta divisiones
			$("#p_preguntasgeneral").css("display","none")//oculta divisiones
			$("#p_licenciasgeneral").css("display","none")//oculta divisiones
			$("#p_preguntasgeneral").css("display","none")//oculta divisiones
			$("#p_registrogeneral").css("display","none")//oculta divisiones
			$("#p_registroUsuario").css("display","none")//oculta divisiones del registro de usuarios en la plataforma
			
			if(dondeE){
				$("#p_section1").css("display","block")//oculta divisiones	
				$("#p_section4").css("display","none")//oculta divisiones	
				$("#p_registroUsuario").css("display","none")//oculta divisiones	d_cambiosgeneral
				$(".d_cambiosgeneral").css("display","block")//oculta divisiones
			}
			
			$("#p_footer").css("display","none")//oculta divisiones
			posicionaFooter();
 		});//velocidad lento 		

	})



	asignaDireccion()//establece links de direccionamiento
	if (URLactual=="https://www.novaschool.mx/?registro") {
			irPantalla(3)	
	}else if (URLactual=="https://www.novaschool.mx/?redi"){
		irPantalla(1)
	}else if (URLactual=="https://www.novaschool.mx/?ged"){
		irPantalla(2)
	}
	posicionaFooter();
})



function giraCarrusel(){
	/*
	* NOMBRE: giraCarrusel. 
	* UTILIDAD: Animacion de girar carrusel.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	*/
	$("#p_logoscaja").stop().animate({//animacion de carrusel
		left: "-=90"//menos noventa px por que es lo que mide cada logo
	},300,function(){//en 3 milisegundos
		posicion = posicion + 90;//incrementa posicion
		if (posicion==posicionFinal) {//si posicion es igual a la posicion final
			posicion = 0;//reinicia posicion
			clearInterval(timer)//limpia timer
			codigoHtml="";//prepara para html
			contador=0;//reinicia contador
			for(i=0;i<=33;i++){//recorre arreglo
				if (i>=dondeRepite) {//si i es igual a donde se repite
					arregloAuxiliar[i]=ordenIconos[contador];//ordena de acuerdo al contador
					contador++//incrementa el contador
				}else{//de lo contrario
					arregloAuxiliar[i]=ordenIconos[i+cuantoRecorre]//ordena de acuerdo a i mas cuanto recorre
				}
			}
			for(i=0;i<=33;i++){//vuelve a llenar el arreglo de los iconos
				ordenIconos[i]=arregloAuxiliar[i];//llena arreglo
			}

			for(i=0;i<=26;i++){//for para generar html; aqui se controla el html, si se ponen mas de 28 se baja a un siguiente renglon
				codigoHtml+="<div class='d_logo"+ordenIconos[i]+"' id='p_logo"+ordenIconos[i]+"'></div>"//genera html
			}		
			
			$("#p_logoscaja").css("left","0px")//regresa a la posicion original
			$("#p_logoscaja").html(codigoHtml);//coloca html en el div
			anchoCarrusel = $("#p_logosmascara").width();//obtinen el ancho del carrusel		

			obtenerPosicionFinal()//obtinene posicion final con otros valores			

			timer = setInterval(giraCarrusel,1000)//corre carrusel
		};
	})
}



function obtenerPosicionFinal(){

	/*
	* NOMBRE: obtenerPosicionFinal. 
	* UTILIDAD: obtine valores de posicionFinal, cuantoRecorre y dondeRepite.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	*/
	

	if (anchoCarrusel==810) {//ancho de carrusel de acuerdo al mediaquerie
		posicionFinal = 90//posicion final asignada numero de logos por 90
		cuantoRecorre = 1//numero de logos
		dondeRepite = 32//donde repite numero total de logos menos numero de logos
	}else if (anchoCarrusel==720) {//ancho de carrusel de acuerdo al mediaquerie
		posicionFinal = 180//posicion final asignada numero de logos por 90
		cuantoRecorre = 2//numero de logos
		dondeRepite = 31//donde repite numero total de logos menos numero de logos
	}else if (anchoCarrusel==630) {//ancho de carrusel de acuerdo al mediaquerie
		posicionFinal = 270//posicion final asignada numero de logos por 90
		cuantoRecorre = 3//numero de logos
		dondeRepite = 30//donde repite numero total de logos menos numero de logos
	}else if (anchoCarrusel==540) {//ancho de carrusel de acuerdo al mediaquerie
		posicionFinal = 360//posicion final asignada numero de logos por 90
		cuantoRecorre = 4//numero de logos
		dondeRepite = 29//donde repite numero total de logos menos numero de logos
	}else if (anchoCarrusel==450) {//ancho de carrusel de acuerdo al mediaquerie
		posicionFinal = 450//posicion final asignada numero de logos por 90
		cuantoRecorre = 5//numero de logos
		dondeRepite = 28//donde repite numero total de logos menos numero de logos
	}else if (anchoCarrusel==360) {//ancho de carrusel de acuerdo al mediaquerie
		posicionFinal = 540//posicion final asignada numero de logos por 90
		cuantoRecorre = 6//numero de logos
		dondeRepite = 27//donde repite numero total de logos menos numero de logos
	}else if (anchoCarrusel==270) {//ancho de carrusel de acuerdo al mediaquerie
		posicionFinal = 630//posicion final asignada numero de logos por 90
		cuantoRecorre = 7//numero de logos
		dondeRepite = 26//donde repite numero total de logos menos numero de logos
	}else if (anchoCarrusel==180) {//ancho de carrusel de acuerdo al mediaquerie
		posicionFinal = 720//posicion final asignada numero de logos por 90
		cuantoRecorre = 8//numero de logos
		dondeRepite = 25//donde repite numero total de logos menos numero de logos
	}

}

function asignaDireccion(){
	/*
	* NOMBRE: asignaDireccion. 
	* UTILIDAD: habilita o deshabilita celdas y asigna direcciones.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	*/

	for(i=1;i<=numeroCeldas;i++){//recorre todas celdas		
		if((i != 36)){
			if (direccionCeldas[i]!="") {//si estan activas
				$("#p_celda"+i).attr("onclick","irA("+i+")")//agrega evento click
				$("#p_celda"+i).attr("onmouseover","celdaSobre("+i+")")//agrega evento over
				$("#p_celda"+i).attr("onmouseout","celdaFuera("+i+")")//agrega evento out
			}else{//si estan desactivadas
				$("#p_celda"+i).css({//bloquea botones
					"opacity":"0.2",
					"cursor":"default"
				})
			}
		}
	}
}



function irA(n){
	/*
	* NOMBRE: irA. 
	* UTILIDAD: agrega la ruta de redireccionamiento a cada celda.
	* ENTRADAS: n id de la celda seleccionada.
	* SALIDAS: Ninguna.
	*/

	if (direccionCeldas[n]=="contenido") { //si lo que va a cargar no es una direccion fuera del sitio
		queCarga(n)//ejecuta funcion de que va a cargar
		$(contenidoCargar).css("display","block")//muestra el contenido
		$("#p_footer").css({"display":"block"});//muestra el pie de pagina
		$(".d_footer").css({"position":"relative"});
		$("html, body").stop().animate({//animacion de scroll
 			scrollTop: $(contenidoCargar).offset().top-10//manda a donde se encuentra la division del contenido
 		},"slow");//velocidad lento
 		posicionaFooter();
	}else{//si es una direcccion de sitio externo	
//alert(n);	
		if(n == 15){
			/********************/
			var parametros = {
				"dato" : '8KSR6'
			};
			
			$.ajax({
				type: 'POST',
				data: parametros,
				cache: false,
				url: '../php/guardaDescarga.php',
				success: function(data){
					// Se pasa el string a un objeto JSON
					//console.log('Se almacena el clic '+data);
					//alert(data);			
					//window.open('https://www.krismar.com.mx', '_blank');
				},
				error: function(data){
					//Cuando la interacción retorne un error, se ejecutará esto.
					//alert("Error de conexión, favor de verificar...");
					console.log('Error de conexión, favor de verificar...');
				}
			});
			
			/*******************/
			
			
		}
		
		window.open(direccionCeldas[n],'_blank');//abre el sitio en una pestaña aparte
	}
}



function celdaSobre(n){
	/*
	* NOMBRE: celdaSobre. 
	* UTILIDAD: agrega el efecto over a celda seleccionada.
	* ENTRADAS: n id de la celda seleccionada.
	* SALIDAS: Ninguna.
	*/
	if((n != 36)){
    	$("#p_celda"+n).addClass("d_celda"+n+"Hover")	//agrega clase
	}

}



function celdaFuera(n){
	/*
	* NOMBRE: celdaFuera. 
	* UTILIDAD: quita el efecto over a celda seleccionada.
	* ENTRADAS: n id de la celda seleccionada.
	* SALIDAS: Ninguna.
	*/
	if((n != 36)){
		$("#p_celda"+n).removeClass("d_celda"+n+"Hover")//quita clase
	}
}



function irPantalla(n){
	/*
	* NOMBRE: irPantalla. 
	* UTILIDAD: realiza el cambio de pantalla.
	* ENTRADAS: n id de la pantalla a la que cambiara .
	* SALIDAS: Ninguna.
	*/
	
	$("#p_sectiondemos").css("display","none")//oculta divisiones
	$("#p_activaciongeneral").css("display","none")//oculta divisiones
	$("#p_somosgeneral").css("display","none")//oculta divisiones
	$("#p_soportegeneral").css("display","none")//oculta divisiones
	$("#p_preguntasgeneral").css("display","none")//oculta divisiones
	$("#p_licenciasgeneral").css("display","none")//oculta divisiones
	$("#p_preguntasgeneral").css("display","none")//oculta divisiones
	$("#p_registrogeneral").css("display","none")//oculta divisiones
	$("#p_registroUsuario").css("display","none")//oculta divisiones del registro de usuarios en la plataforma
	
	$("#p_footer").css("display","none")//oculta el pie de pagina
	
	
	var URLactual = window.location;
	for(i=1;i<=4;i++){//ciclo para colocar todas las pantallas en modo oculto
		$("#p_section"+i).css("display","none")//oculta pantalla
		$("#botonPantalla"+i).css({//desactiva botones
			"background-color":"white",
			"cursor":"pointer"
		})
        $(".d_sectionbtn"+i).removeClass('d_sectionbtn_selected');
        
        $(".d_sectionbtncarruselprev, .d_sectionbtncarruselnext").removeClass('d_sectionbtncarrusel_inactive');
        $(".d_sectionbtncarruselprev, .d_sectionbtncarruselnext").removeAttr('onclick');

		$("#botonPantalla"+i).attr("onclick","irPantalla("+i+")")//agrega eventos de click
		$(".d_sectionbtn"+i).attr("onclick","irPantalla("+i+")")//agrega eventos de click
	}

	if (n==1) {
		dondeE = true;
		$("#p_activacion").css("display","none");
		$("#p_activacionU").css("display","block");
		logoNova = "NOVASCHOOL-REDI";
		$("html").removeClass()
		$("html").addClass("d_background1")
        $(".d_sectionbtncarruselnext").attr("onclick","irPantalla(2)")//agrega funcion a botones para redireccionar a ellos
        $(".d_sectionbtncarruselprev").addClass('d_sectionbtncarrusel_inactive');
	}

	if (n==2) {
		dondeE = false;
		$("#p_activacion").css("display","none");
		$("#p_activacionU").css("display","none");
		logoNova = "NOVASCHOOL-GED";
		$("html").removeClass();
		$("html").addClass("d_background2");
        $(".d_sectionbtncarruselprev").attr("onclick","irPantalla(1)")//agrega funcion a botones para redireccionar a ellos
        $(".d_sectionbtncarruselnext").attr("onclick","irPantalla(3)")//agrega funcion a botones para redireccionar a ellos
	}

	if (n==3) {
		dondeE = false;
		$("#p_activacion").css("display","block");
		$("#p_activacionU").css("display","none");
		logoNova = "NOVASCHOOL";
		$("html").removeClass();
		$("html").addClass("d_background3");
        $(".d_sectionbtncarruselprev").attr("onclick","irPantalla(2)")//agrega funcion a botones para redireccionar a ellos
        $(".d_sectionbtncarruselnext").addClass('d_sectionbtncarrusel_inactive');
	}

	if($("body").width()>640){
		$("#p_icono1").css("background-image","url('img/"+logoNova+".png')")
	}
	

	$("#botonPantalla"+n).css({//activa boton de pantalla seleccionada
		"background-color":"yellow",
		"cursor":"default"
	})
    $(".d_sectionbtn"+n).addClass('d_sectionbtn_selected');

	$("#botonPantalla"+n).removeAttr("onclick")//remueve evento click boton de pantalla seleccionada
	$(".d_sectionbtn"+n).removeAttr("onclick")//remueve evento click boton de pantalla seleccionada
	$("#p_section"+n).fadeIn();//muestra pantalla seleccionada
	//$("#p_section"+n).slideDown();//muestra pantalla seleccionada



	/*if (URLactual=="http://localhost/2017_Novaschool/?registro") {

			activacion()	
	}*/
	posicionaFooter();

}



function queCarga(p){
	/*
	* NOMBRE: queCarga. 
	* UTILIDAD: realiza la carga de contenido dentro del sitio.
	* ENTRADAS: p id de la pantalla a la que cambiara .
	* SALIDAS: Ninguna.
	*/
	$("#p_sectiondemos").css("display","none")//oculta divisiones
	$("#p_activaciongeneral").css("display","none")//oculta divisiones
	$("#p_somosgeneral").css("display","none")//oculta divisiones
	$("#p_soportegeneral").css("display","none")//oculta divisiones
	$("#p_preguntasgeneral").css("display","none")//oculta divisiones
	$("#p_licenciasgeneral").css("display","none")//oculta divisiones
	$("#p_preguntasgeneral").css("display","none")//oculta divisiones
	$("#p_registrogeneral").css("display","none")//oculta divisiones
	$("#p_registroUsuario").css("display","none")//oculta divisiones del registro de usuarios en la plataforma
	$("#p_footer").css("display","none")//oculta divisiones

	if (p==15) {//id de la celdas que cargan contenido dentro del sitio
		contenidoCargar="#p_sectiondemos"//id de la division del contenido a cargar
	}

	if (p==11) {//id de la celdas que cargan contenido dentro del sitio
		contenidoCargar="#p_somosgeneral"//id de la division del contenido a cargar
	}

	if (p==18 || p==17) {//id de la celdas que cargan contenido dentro del sitio
		$("#captcha").removeAttr("src")//cambia el captcha
		$("#captcha").attr("src","php/captcha.php")//cambia el captcha
		contenidoCargar="#p_soportegeneral"//id de la division del contenido a cargar
		$("#p_soportegeneral input").val("");
		$("#p_soportegeneral textarea").val("");
	}

	if (p==19) {//id de la celdas que cargan contenido dentro del sitio
		contenidoCargar="#p_preguntasgeneral"//id de la division del contenido a cargar
	}

	if (p==14 || p==20) {//id de la celdas que cargan contenido dentro del sitio
		contenidoCargar="#p_licenciasgeneral"//id de la division del contenido a cargar
	}


	if (p==38) {//id de la celdas que cargan contenido dentro del sitio
		$("#captcha2").removeAttr("src")//cambia el captcha
		$("#captcha2").attr("src","php/captcha.php")//cambia el captcha		
		$("#p_registrogeneral input").val("")
		contenidoCargar="#p_registrogeneral"//id de la division del contenido a cargar
	}

	/*if (p==20) {//id de la celdas que cargan contenido dentro del sitio

		contenidoCargar="#p_registrogeneral"//id de la division del contenido a cargar

	};*/
	posicionaFooter();

}



function activacion(){
	/*
	* NOMBRE: activacion. 
	* UTILIDAD: muestra la seccion de activacion de productos.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	*/
	$("#p_sectiondemos").css("display","none")//oculta divisiones
	$("#p_activaciongeneral").css("display","none")//oculta divisiones
	$("#p_somosgeneral").css("display","none")//oculta divisiones
	$("#p_soportegeneral").css("display","none")//oculta divisiones
	$("#p_preguntasgeneral").css("display","none")//oculta divisiones
	$("#p_licenciasgeneral").css("display","none")//oculta divisiones
	$("#p_preguntasgeneral").css("display","none")//oculta divisiones
	$("#p_registrogeneral").css("display","none")//oculta divisiones
	$("#p_registroUsuario").css("display","none")//oculta divisiones del registro de usuarios en la plataforma
	$("#p_footer").css("display","none")//oculta divisiones

	$("#p_activaciongeneral").css("display","none")//muestra division	
	$("#captcha2").removeAttr("src")//cambia el captcha
		$("#captcha2").attr("src","php/captcha.php")//cambia el captcha		
		$("#p_registrogeneral input").val("")
	$("#p_registrogeneral").css("display","block")//oculta divisiones		

	$("#p_footer").css("display","block")//muestra  pie de pagina
	$('#p_promocion').val('Evento');
	$("#numeroSerie").removeAttr("required");
		//$("#numeroSerie").val("");
		$("#textoNumero").css("display", "none");
		$("#numeroSerie").css("display","none");
	$("body").stop().animate({//animacion de scroll
 		scrollTop: $("#p_registrogeneral").offset().top-10//mueve el scroll donde se encuentra el div del contenido
 	},"slow");//velocidad lento
 	posicionaFooter();

}

//Para la activacion de los usuarios
function activacionU(){
	/*
	* NOMBRE: activacion. 
	* UTILIDAD: muestra la seccion de activacion de productos.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	*/
	$("#p_sectiondemos").css("display","none")//oculta divisiones
	$("#p_activaciongeneral").css("display","none")//oculta divisiones
	$("#p_somosgeneral").css("display","none")//oculta divisiones
	$("#p_soportegeneral").css("display","none")//oculta divisiones
	$("#p_preguntasgeneral").css("display","none")//oculta divisiones
	$("#p_licenciasgeneral").css("display","none")//oculta divisiones
	$("#p_preguntasgeneral").css("display","none")//oculta divisiones
	$("#p_registrogeneral").css("display","none")//oculta divisiones
	$("#p_registroUsuario").css("display","none")//oculta divisiones del registro de usuarios en la plataforma
	$("#p_footer").css("display","none")//oculta divisiones

	$("#p_activaciongeneral").css("display","none")//muestra division	
	
	
	//Muestra la sección para el registro del usuario
	$("#p_section1").css("display","none")//oculta divisiones	
	$("#p_section4").css("display","block")//oculta divisiones	
	$("#p_registroUsuario").css("display","block")//oculta divisiones	d_cambiosgeneral
	$(".d_cambiosgeneral").css("display","none")//oculta divisiones
	

	$("#p_footer").css("display","block")//muestra  pie de pagina
	
	$("body").stop().animate({//animacion de scroll
 		scrollTop: $("#p_registroUsuario").offset().top-10//mueve el scroll donde se encuentra el div del contenido
 	},"slow");//velocidad lento
 	posicionaFooter();

}

function irContenido(donde){
	/*
	* NOMBRE: irContenido. 
	* UTILIDAD: muestra la seccion que se haya seleccionado dentro del contenido.
	* ENTRADAS: donde lo que va mostrar.
	* SALIDAS: Ninguna.
	*/

	$("#p_sectiondemos").css("display","none")//oculta divisiones
	$("#p_activaciongeneral").css("display","none")//oculta divisiones
	$("#p_somosgeneral").css("display","none")//oculta divisiones
	$("#p_soportegeneral").css("display","none")//oculta divisiones
	$("#p_preguntasgeneral").css("display","none")//oculta divisiones
	$("#p_licenciasgeneral").css("display","none")//oculta divisiones
	$("#p_preguntasgeneral").css("display","none")//oculta divisiones
	$("#p_registrogeneral").css("display","none")//oculta divisiones
	$("#p_registroUsuario").css("display","none")//oculta divisiones del registro de usuarios en la plataforma
	$("#p_footer").css("display","none")//oculta divisiones

	$(donde).css("display","block")//muestra division
	$("#p_footer").css("display","block")//muestra  pie de pagina
	$("#p_soportegeneral input").val("");
	$("#p_soportegeneral textarea").val("");
	$("#captcha").removeAttr("src")//cambia captcha
	$("#captcha").attr("src","php/captcha.php")//cambia captcha
	$("body").stop().animate({//animacion de scroll
 		scrollTop: $(donde).offset().top-10//mueve el scroll donde se encuentra el div del contenido
 	},"slow");//velocidad lento
	posicionaFooter();
}



function cambioLicencia(l){
	/*
	* NOMBRE: cambioLicencia. 
	* UTILIDAD: cambia el contenido de Licencias.
	* ENTRADAS: l indica que imagen va a mostrar.
	* SALIDAS: Ninguna.
	*/

	for(i=1;i<=4;i++){
		$("#p_circuloscambios"+i).css({//da formato a puntos de licencias
			"cursor":"pointer",
			"background-color":"white"
		})


		$("#p_circuloscambios"+i).attr("onclick","cambioLicencia("+i+")")
		$("#p_licenciascontenido"+i).css("display","none")//muestra la primera pantalla de licencias
	}

	$("#p_circuloscambios"+l).css({//da formato a puntos de licencias
			"cursor":"default",
			"background-color":"yellow"
		})


		$("#p_circuloscambios"+l).removeAttr("onclick")
		$("#p_licenciascontenido"+l).fadeIn()

}
function posicionaFooter(){
	// if (($(".d_contenedor").height()+$(".d_footer").height())>$(window).height()) {
	// 	$(".d_footer").css("position","relative")
	// }else{
	// 	$(".d_footer").css("position","fixed")
	// }
}