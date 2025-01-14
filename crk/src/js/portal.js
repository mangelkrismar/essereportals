/******************************************************************************************************************************************************************************
*
*																	VARIABLES
*
********************************************************************************************************************************************************************************/
var disp = null;//Tipo de dispositivo
var ideSubtema = null;//Id subtema
var menuVisible = false;//Bandera para saber si el menú es in/visible
var altoHeader = null;//Alto del header
var bandConf = false;
var bandActUser = false;
var bandGuest = false;
var bandActUserConf = false;
var user = false;
var estadoSwitch = 1;//0->movil 1->pc
var condicionMobile = (disp == "movil" || $(".recienteicon").css("display") === "flex" || $(".recienteicon").css("display") === "block");
var altoNavegacion;
/******************************************************************************************************************************************************************************
*
*																	FUNCIONES Y PROCEDIMIENTOS
*
********************************************************************************************************************************************************************************/
$(document).ready(function() {
	$.get(IP+"js_config", function(data){
		data = JSON.parse(data);
		IPSRC = data.krismar_apps_url;
		IP = data.base_url;
	});
});



function cargaBodyListo(){

	
	/*if($("html body").scrollTop()>50){
		//irArriba(1000);
	}
	*/
	
	verBtnArriba();
	obtenDisp();
	altoNavegacion = $(".p_navsup").height()+50;//Altura de la barra de navegación mas 50 de p_headersmall.
	
}

function regresarLibros(){

	$("#iconregresarlibro, #libros_sep, #clasicos, #GRcontainer").hide();
	$("#lista2").removeClass("catalogosBackground");
    $("#lista2").removeClass("librosNEMBackground");
	irArriba();

}

function verSeccionGuest(objeto){

	/*Transición entre las principales secciones de la pagina*/
	seccion = $("#" + objeto.attr("name"));
	
	if(objeto.attr("name") == 'clasicos'){
		$("#libros_sep, #clasicos").hide();
		
	}
	
	if(!seccion.is(":visible")){
		
		seccion.show();
		
	}
	
	ocultaMenuAnimado(function(){$("body").stop().animate({scrollTop: seccion.offset().top - (altoNavegacion + 20)},500, "linear")});
	
	
	if($("#libros_sep").css("display") == "block" || $("#clasicos").css("display") == "block"){
		$("#iconregresarlibro").show();
		

	}
	
}
/*function muestraLibros(){
	$("#libros_sep, #clasicos").hide();
	$("#libros_sep").find(".p_articletitle").text("Libros SEP");
	//$("#libros_sep").slideDown(function(){$("body").stop().animate({scrollTop: $("#libros_sep").offset().top - (altoNavegacion + 20)},500, "linear")});
	insertaLogLink('Libros SEP');
	$.post(
		IP + "Libros",
		function(data){
			var result = JSON.parse(data);
			$("#lista2").empty();
			$.each(result, function(grado, carpeta){
				lista = "<li><ol>";
				if(Array.isArray(carpeta)){//es un array
					carpeta.forEach(function(titulo, indice){
						lista +='<a onclick = "insertaLogLink('+"'"+titulo.replace('.pdf', '')+"'"+')" target = "_blank" href = "'+IP+'src/extra/'+grado+'/'+titulo+'"><ul>'+titulo.replace('.pdf', '')+'</ul></a>';
						//lista += "<a onclick = 'insertaLogLink("+"'"+3+"'"+")' target = '_blank' href = '"+IP+"src/extra/"+grado+"/"+titulo+"'><ul>"+titulo.replace(".pdf", "")+"</ul></a>";
					});
				}else{//Es un objeto
					for(var titulo in carpeta){
						if(Array.isArray(carpeta[titulo])){//Es un array
							listaIn = "<ul onclick = 'toggleLibros(this)'> <span id ='sum' style = 'font-weight:bold;'>+</span>" + titulo;
							carpeta[titulo].forEach(function(tituloIn, carpetaIn){
								
								listaIn += '<a onclick = "event.stopPropagation();insertaLogLink('+"'"+tituloIn.replace('.pdf', '')+"'"+')" class = "submenu" target = "_blank" href = "'+IP+'src/extra/'+grado+'/'+titulo+'/'+tituloIn+'"><ul>'+tituloIn.replace('.pdf', '')+'</ul></a>';
								//listaIn += "<a onclick = 'insertaLogLink('"+tituloIn.replace(".pdf", "")+"')' class = 'submenu' target = '_blank' href = '"+IP+"src/extra/"+grado+"/"+titulo+"/"+tituloIn+"'><ul>"+tituloIn.replace(".pdf", "")+"</ul></a>";
							});
							listaIn += "</ul>";
							lista += listaIn;
						}else{
							lista += '<a onclick = "insertaLogLink("'+carpeta[titulo].replace('.pdf', '')+'")" target = "_blank" href = "'+IP+'src/extra/'+grado+'/'+carpeta[titulo]+'"><ul>'+carpeta[titulo].replace('.pdf', '')+'</ul></a>';
							//lista += "<a onclick = 'insertaLogLink('"+carpeta[titulo].replace(".pdf", "")+"')' target = '_blank' href = '"+IP+"src/extra/"+grado+"/"+carpeta[titulo]+"'><ul>"+carpeta[titulo].replace(".pdf", "")+"</ul></a>";
						}
					}
				}
				lista += "</ol></li>";
				$("#lista2").append(lista);
				if($("#libros_sep").css("display") == "none"){
					$("#libros_sep").css("display","table");
				}
				$("body").stop().animate({scrollTop: $("#libros_sep").offset().top - (altoNavegacion + 20)},500, "linear", function(){
					ocultaMenuAnimado();
					$("#iconregresarlibro").show();

				});
			});
		}
		
	).fail(function(){
		if($("#libros_sep").css("display") == "none"){
			$("#libros_sep").css("display","table");
		}
		$("body").stop().animate({scrollTop: $("#libros_sep").offset().top - (altoNavegacion + 20)},500, "linear");
		$("#lista2").append("Ocurrio un error inesperado, revisa tu conexión a internet o intentalo más tarde.");
	});
}
*/
function muestraLibros(){
	$("#libros_sep, #clasicos, #GRcontainer").hide();
	$("#lista2").removeClass("catalogosBackground");
    $("#lista2").removeClass("librosNEMBackground");
	$("#libros_sep").find(".p_articletitle").text("Libros SEP");
	insertaLogLink('Libros SEP');
	$.post(
		IP+"Libros",
		function(data){
			var result = JSON.parse(data);
			$("#lista2").empty();
			$.each(result, function(grado, libros){
				lista = "<li><ol>";
				minilista = "<ul onclick = 'toggleLibros2(this)'><span>La entidad donde vivo +</span><div id='LibrosLaEntidadDondeVivo'>";
				marcado = false;
				re = new RegExp("La entidad donde vivo: ");
				$.each(libros,function(n,libro){
					if(libro.isArray){

					} else{
						if(!re.test(libro.titulo)){
							lista +='<a onclick = "insertaLogLink('+"'"+libro.titulo+"'"+')" target = "_blank" href = "'+libro.url+'"><ul>'+libro.titulo+'</ul></a>';
						}else{
							if(!marcado){
								lista += "MarcaEspecificaDeLibrosLaEntidadDondeVivo";
								marcado = true;
							}
							minilista += '<a onclick = "insertaLogLink('+"'"+libro.titulo.replace('La entidad donde vivo: ','')+"'"+')" target = "_blank" href = "'+libro.url+'"><ul>'+libro.titulo.replace('La entidad donde vivo: ','')+'</ul></a>';
						}
					}
				});
				minilista += "</div></ul>";
				lista += "</ol></li>";
				$("#lista2").append(lista.replace('MarcaEspecificaDeLibrosLaEntidadDondeVivo',minilista));
			});
			if($("#libros_sep").css("display") == "none"){
				$("#libros_sep").css("display","table");
			}
			$("body").stop().animate(
				{
					scrollTop: $("#libros_sep").offset().top - (altoNavegacion + 20)
				},
				500,
				"linear",
				function(){
					ocultaMenuAnimado();
					$("#iconregresarlibro").show();
				}
			);
		}
	);
}
function muestraLibrosNme(){
	$("#libros_sep, #clasicos, #GRcontainer").hide();
	$("#lista2").removeClass("catalogosBackground");
    $("#lista2").addClass("librosNEMBackground");
	$("#libros_sep").find(".p_articletitle").text("Libros SEP NME");
	insertaLogLink('Libros SEP NME');
	$.post(
		IP+"LibrosNme",
		function(data){
			var result = JSON.parse(data);
			$("#lista2").empty();
            
			$.each(result, function(grado, libros){
				lista = "<li><ol>";
				$.each(libros,function(n,libro){
					lista +='<a onclick = "insertaLogLink('+"'"+libro.titulo+"'"+')" target = "_blank" href = "'+libro.url+'"><ul>'+libro.titulo+'</ul></a>';
				});
				lista += "</ol></li>";
				$("#lista2").append(lista);
			});
			if($("#libros_sep").css("display") == "none"){
				$("#libros_sep").css("display","table");
			}
			$("body").stop().animate(
				{
					scrollTop: $("#libros_sep").offset().top - (altoNavegacion + 20)
				},
				500,
				"linear",
				function(){
					ocultaMenuAnimado();
					$("#iconregresarlibro").show();
				}
			);
		}
	);
}
function muestraLibrosGuia(){
	$("#libros_sep, #clasicos, #GRcontainer").hide();
    $("#lista2").removeClass("librosNEMBackground");
	$("#lista2").addClass("catalogosBackground");
	$("#libros_sep").find(".p_articletitle").text("Catálogos de aplicaciones");
	$.post(
		IP+"LibrosGuias",
		function(data){
			var result = JSON.parse(data);
			$("#lista2").empty();
			$.each(result, function(grado, libros){
				lista = "<li><ol>";
				$.each(libros,function(n,libro){
					lista +='<a target = "_blank" href = "'+libro.url+'"><ul>'+libro.titulo+'</ul></a>';
				});
				lista += "</ol></li>";
				$("#lista2").append(lista);
			});
			if($("#libros_sep").css("display") == "none"){
				$("#libros_sep").css("display","table");
			}
			$("body").stop().animate(
				{
					scrollTop: $("#libros_sep").offset().top - (altoNavegacion + 20)
				},
				500,
				"linear",
				function(){
					ocultaMenuAnimado();
					$("#iconregresarlibro").show();
				}
			);
		}
	);
}

function muestraLibrosGuiaProf(){
	$("#libros_sep, #clasicos, #GRcontainer").hide();
	$("#lista2").removeClass("catalogosBackground");
    $("#lista2").removeClass("librosNEMBackground");
	$("#libros_sep").find(".p_articletitle").text("Guías para docentes");
	$.post(
		IP+"LibrosGuiasProf",
		function(data){
			var result = JSON.parse(data);
			$("#lista2").empty();
			$.each(result, function(grado, libros){
				lista = "<li><ol>";
				$.each(libros,function(n,libro){
					lista +='<a target = "_blank" href = "'+libro.url+'"><ul>'+libro.titulo+'</ul></a>';
				});
				lista += "</ol></li>";
				$("#lista2").append(lista);
			});
			if($("#libros_sep").css("display") == "none"){
				$("#libros_sep").css("display","table");
			}
			$("body").stop().animate(
				{
					scrollTop: $("#libros_sep").offset().top - (altoNavegacion + 20)
				},
				500,
				"linear",
				function(){
					ocultaMenuAnimado();
					$("#iconregresarlibro").show();
				}
			);
		}
	);
}

function muestraTutoriales(){
	$("#libros_sep, #clasicos, #GRcontainer").hide();
	$("#lista2").removeClass("catalogosBackground");
    $("#lista2").removeClass("librosNEMBackground");
	$("#libros_sep").find(".p_articletitle").text("Tutoriales de Novaschool");
	$.post(
		IP+"tutoriales",
		function(data){
			var result = JSON.parse(data);
			$("#lista2").empty();
			$.each(result, function(grado, libros){
				lista = "<li><ol>";
				$.each(libros,function(n,libro){
					lista +='<a target = "_blank" href = "'+libro.url+'"><ul>'+libro.titulo+'</ul></a>';
				});
				lista += "</ol></li>";
				$("#lista2").append(lista);
			});
			$("#lista2 > li:nth-child(1)").attr("id","gclasstuto");
			if($("#libros_sep").css("display") == "none"){
				$("#libros_sep").css("display","table");
			}
			$("body").stop().animate(
				{
					scrollTop: $("#libros_sep").offset().top - (altoNavegacion + 20)
				},
				500,
				"linear",
				function(){
					ocultaMenuAnimado();
					$("#iconregresarlibro").show();
				}
			);
		}
	);
}

function toggleLibros(obj){
	$(obj).find("a").toggle(500,function(){
		$(this).css("display",($(this).css("display")!="none")?"block":"none");
		$("#sum").html($($(obj).find("a")[0]).css("display") == "none"?"+":"-")
	});
}

function toggleLibros2(obj1){
	var obj = $(obj1).children()[0]
	var txtTema = $(obj).text();
	var signoReplace = (txtTema.indexOf("+") != -1)?"-":"+";
	var signoActual = (txtTema.indexOf("+") != -1)?"+":"-";
	$(obj).html(txtTema.replace(signoActual,signoReplace));

	$(obj).parent().find("div").toggle("slow",function(){
	});
}


/******************************************/
function cargaImgs(obj){
	/*
	* NOMBRE: cargaImgs
	* UTILIDAD: Descarga imágenes de manera asincrona.
	* ENTRADAS: obj > Objeto en formato JSON o un array de objetos JSON.
	* SALIDAS: Ninguna.
	* VARIABLES: Ninguna.
	*/
	if(Array.isArray(obj)){//Lo que se recibe es un array
		for(var indx in obj){
			loadImage(obj[indx], indx);
		}
	}else{
		loadImage(obj);
	}
	

	function loadImage(objInd, indx){
		indx = indx || null;

		if(indx != null){
			url = objInd.url || "src/img/" + objInd.nombre;

			var cdn = "$.get("
			+	"'"+ url +"'"
			+ ").done(function(){"
				+'$("'+objInd.selector+'").transition({"background-image": "url('+url+')"});'
			+"});"

			eval(cdn);
			
			return false;
		}
		//Solo fondo de imágen
		url = objInd.url || "src/img/" + objInd.nombre;
		
		$.get(
			url
		).done(function(){
		
			$(objInd.selector).transition({"background-image": "url("+url+")"});

		});
	}



}



function imgTransition(){
    /*
	* NOMBRE: imgTransition.
	* UTILIDAD: Transición de las imagenes del header.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
    * VARIABLES****/
    var numImg = 0;//Contador de el número de imagen.
	/**************/
	//Cuando no sea movil se cargarán imágenes adicionales
	if(disp != "movil"){
		/*cargaImgs([
			{'nombre':'p_headerimg1.png', 'selector': '.p_headerImg1'},
			{'nombre':'p_headerimg2.png', 'selector': '.p_headerImg2'},
			{'nombre':'p_headerimg3.png', 'selector': '.p_headerImg3'}
		]);*/
		$('.p_headerImg1').css('background-image', 'url('+IP+'src/img/p_headerimg1.png)');
		$('.p_headerImg2').css('background-image', 'url('+IP+'src/img/p_headerimg2.png)');
		$('.p_headerImg3').css('background-image', 'url('+IP+'src/img/p_headerimg3.png)');
		setInterval(function(){
			numImg++;
			if(numImg== 4){
				numImg = 1;
			}
			$(".p_headerImg"+(numImg)).fadeIn(500);
			if(numImg== 1){
				$(".p_headerImg3").fadeOut(2000);
			}else{
				$(".p_headerImg"+(numImg-1)).fadeOut(2000);
			}
		}, 6000);

	}



 	
}

function centraElemento(contenedor, contenido){
	altoContenedor = contenedor.height();
	altoContenido = contenido.height();
	
	anchoContenedor = contenedor.width();
	anchoContenido = contenido.width();
	
	leftContenido = (anchoContenedor-anchoContenido)/2;
	topContenido = (altoContenedor-altoContenido)/2;
	contenido.css({"top":topContenido+"px", "left":leftContenido+"px"});
}

function colocaEmergente(param){
	/*
	* NOMBRE: colocaEmergente
	* UTILIDAD: Acomoda ventana emergente.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	* VARIABLES*****/
    //Asigna el máximo tamaño de altura y centra el contenido.
    var ventanaAlto = window.innerHeight;
    var ventanaAncho = $(window).width();
    var emergenteAlto = $(".p_emerbox").height();
    var emergenteAncho = $(".p_emerbox").width();
	/*************/


	$(".p_emerbox").css({"max-height":(window.innerHeight/4)*3});
    $(".p_emerbox").css({"top":((ventanaAlto/2)-(emergenteAlto/2)),"left":((ventanaAncho/2)-(emergenteAncho/2))});
	
    //Al div que esta visible, se obtiene el alto
   $(".p_emerboxconte").each(function(){
        if($(this).css("display") == "table"){
            if($(this).height() > $(".p_emerbox").height()){
                $(".p_emerbox").css({"overflow-y":"scroll"});
            }
        }
	});

	param = param || 'filtra';
    if(bandActUser && !bandConf){
	
		//paginadorUser.setValues();
		/*if(param == "filtra"){
			$pagActual = 1;
			$pagSeccion = 1;
			filtrarAppsSql();
		}		*/
    
    }else if(bandActUser && bandConf){
    	bandActUserConf = true;
		
    }
	
    if(bandConf){//Se muestra configuracion
	
		try{
			
			filtrarAppsAdmin();
		
		}catch(e){
			
		}
    }

    if(bandGuest){
		//paginadorGuest.setValues();
		//filtrarAppsGuest();
		mostrarApps();
    }
	
    /*try{
		modalidadMenuFiltro();//Se encuentra
	}catch(e){
		
	}*/
	
	if(bandInfo){cerrarEmergentes();}
	
    if(user){
		
		masReciente();
		
	}
	
}



function cerrarEmergentes(){
	/*
	* NOMBRE: cerrarEmergentes
	* UTILIDAD: Cierra div emergente.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	* VARIABLES: Ninguna.
	*/
	if($('#formChangeUser').is(":visible")){
		doIngresa("");
	};
	$(".p_emergenteusuario").fadeOut(300,function(){
		$("p_emergenteusuario, .p_emerboxconte").removeAttr("style");
	});
	bandInfo = false;
}

function verSubtemas(id){
	/*
	* NOMBRE: verSubtemas
	* UTILIDAD: Muestra subtemas del menú azul.
	* ENTRADAS: id > cadena, id de tema principal.
	* SALIDAS: Ninguna.
	* VARIABLES	*/
	var altoHeader = $(".p_header").height();
	var altoVentana = $(window).height();
	/************/
	ideSubtema = id;
	if(ideSubtema == "contacto"){//Tema contacto
		insertaLogLink("Contacto")
		ocultaSubtemas();
		$("html body").stop().animate({
			scrollTop: $(document).height()
		}, 1000);

		return false;//Finaliza la función

	}

	if(menuVisible){

		$(".p_menusup").stop().animate({"top":(altoHeader-$(".p_menusup").height())+"px","opacity":"1"}, 500, function(){
			$(".contenido, .maskrismar, .britannica, .libros, .docente").hide();
			$("."+ideSubtema).show();
			$(".p_menusup").stop().animate({"top":altoHeader+"px","opacity":"1"}, 500);//Se le asigna un "top" al menu respecto al header.
			menuVisible = true;
		});//Se le asigna un "top" al menu respecto al header.

	}else{

		$("."+ideSubtema).show();
		$(".p_menusup").stop().animate({"top":altoHeader+"px","opacity":"1"}, 500);//Se le asigna un "top" al menu respecto al header.
		menuVisible = true;
	}
	$("#contenido, #maskrismar, #britannica, #libros, #contacto, #docente").removeClass("p_navsupinbtn_indicador");
	$("#"+ideSubtema).addClass("p_navsupinbtn_indicador");
	$(".p_menuemergente").css({"display":"block","height":(altoVentana-altoHeader)+"px","top":altoHeader+"px"});//Muestra div emergente para cerrar menu de navegación.

}

function subtemasVisibles(){
	/*
	* NOMBRE: subtemasVisibles
	* UTILIDAD: Muestra subtemas visibles sin animación.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	* VARIABLES	*/
	var altoHeader = $(".p_header").height();
	/************/
	$("."+ideSubtema).show();
	$(".p_menusup").css({"top":altoHeader+"px", "opacity": "1"});//Se le asigna un "top" al menu respecto al header.
}

function ocultaSubtemas(){
	/*
	* NOMBRE: ocultaSubtemas
	* UTILIDAD: Oculta subtemas.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	* VARIABLES: Ninguna.
	*/
	menuVisible = false;
	ideSubtema = null;
	$(".p_menuemergente").removeAttr("style");
	$(".contenido, .maskrismar, .britannica, .libros, .docente").hide();
	$(".p_menusup").removeAttr("style");
  $("#contenido, #maskrismar, #britannica, #libros, #contacto, #docente").removeClass("p_navsupinbtn_indicador");
}



function ocultaMenuAnimado(callback, callback2){
	/*
	* NOMBRE: ocultaMenuAnimado
	* UTILIDAD: Oculta los subtemas, con animación.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	* VARIABLES	*/
	var altoHeader = $(".p_header").height();
	/***********/
    if(menuVisible){
        $(".p_menuemergente").removeAttr("style");
        $(".p_menusup").stop().animate({"top":(altoHeader-$(".p_menusup").height())+"px","opacity":"1"}, 300, function(){
            ocultaSubtemas();
			if(callback != undefined)callback();
			if(callback2 != undefined)callback2();
        });
    }
}


function obtenDisp(){
	/*
	* NOMBRE: obtenDisp
	* UTILIDAD:
		* Obtiene el tipo de dispositivo
		* Oculta banner
		* Asigna función de resize en pc/móvil
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	* VARIABLES: Ninguna.
	*/
	//if(navigator.userAgent.toLowerCase().search(/iphone|ipod|ipad|android|webos|blackberry|iemobile|phone|mobile/) > -1){
	if($("#device").attr("value") == "movil"){
		disp = "movil";
		ocultaBanner();
		resizeMovil();
		colocaEmergente();
	}else{
		disp = "pc";
		
		imgTransition();
		resizePc();
	}
	//cambiaModalidadApp();
	/*try{
		modalidadMenuFiltro();//Se encuentra
	}catch(e){
		
	}*/
	
}

function cambiaModalidadApp(){

	/*if(disp == "movil" || $(".recienteicon").css("display") === "flex" || $(".recienteicon").css("display") === "block"){
		$(".p_recienteboximg ").addClass("p_resalteminiatura_over").removeClass("p_resalteminiatura");
		$(".p_recienteinfoplayicon").removeAttr("onclick").attr("onclick", "muestraInfo($(this))");
		
	}else{

		$(".p_recienteboximg").removeClass("p_resalteminiatura_over").addClass("p_resalteminiatura");

		$(".p_recienteinfoplayicon").removeAttr("onclick").attr("onclick", "playDemo($(this).parent().parent().parent().parent().parent().attr('rel'))");
		$("#apps_demo_reciente").find(".p_recientebox").each(function(){
			$(this).find(".p_recienteboximg").removeClass("p_resalteminiatura").addClass("p_resalteminiatura_over");
		});
		if(bandInfo){cerrarEmergentes();}
		
		//Validacion solo para actividades mostradas en user, ¡No configuración!
		//$(".p_recienteinfoplayicon").each(function(){
			//if($(this).attr("flash") != undefined){

				//$(this).attr("onclick","playDemoFlash('"+$(this).attr("flash")+"')");
			//}
		//});
	}
	
	$(".p_recientescroll").find(".p_recientebox").each(function(){
		$(this).find(".p_recienteinfoplayicon").attr("onclick","playDemo($(this).parent().parent().parent().parent().parent().attr('rel'))");
	});
	*/
	//modalidadMenuFiltro();
	if(bandInfo){cerrarEmergentes();}
	
}



var bandInfo = false;

function muestraInfo(objeto, rel,nombre, img, objetivos){
	
	var objetivos  = objeto.parent().parent().find(".p_recienteinfoobjetivos").find("ul").find("li");
	//var nombre_info = objeto.parent().parent().parent().parent().parent().attr("nombre");
	
	$("#objetivo_info").empty();
	
	$("#nombre_info").text(nombre);
	
	$("#play_info").attr("onclick", "playDemo("+rel+", '"+nombre+"')");
	
	$("#play_info").css("background-image", "url("+img+")");
	
	
	
	objetivos.each(function(index, item){
		
		$("#objetivo_info").append("<li>"+item.innerHTML.replace("*", "")+"</li>");
		
	});
	
	
	$(".p_emergenteusuario").fadeIn("fast");
	
	$("#info_app").css({"display":"table"});
	
	colocaEmergente('noFiltra');
	
	bandInfo = true;
	
}




function irArriba(velocidad){
	/*
	* NOMBRE: irArriba.
	* UTILIDAD: Anima scroll scrollTop a 0.
	* ENTRADAS: velocidad > número, cantidad de milisegundos
	* SALIDAS: Ninguna
	* VARIABLES:
	*/
	velocidad = velocidad || 500;

	$("html body").stop().animate({
		scrollTop: 0
	}, velocidad);
}

function verBtnArriba(){
	/*
	* NOMBRE: verBtnArriba
	* UTILIDAD: Muestra el botón que regresa scroll.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	* VARIABLES: Ninguna.
	*/
    //if(navigator.userAgent.toLowerCase().search(/iphone|ipod|ipad|android|webos|blackberry|iemobile|phone|mobile/) > -1){
	if($("#device").attr("value") == "movil"){
        altoHeader = $(".p_navsup").height()+50;
    }else{
        altoHeader = $(".p_header").height();
    }

	otroAlto = $(".p_headersmall").height();
    var ultimoScroll = 0;
	$(document).scroll(function(){
		/*if($(document).scrollTop() == 0){
			
			if($("#libros_sep").length > 0){
				$("#libros_sep, #clasicos").hide();
			}
		}*/
		//console.log($(".p_headerin").height() +"---"+ $(document).scrollTop())
		if($(".p_headerin").height() >= $(document).scrollTop()){
			$(".p_flotanteicon").stop().fadeOut(250);
			
             if($(this).scrollTop() > ultimoScroll){

                $(".p_headerImg1, .p_headerImg2, .p_headerImg3").css({"background-position":"0% "+(70-((350+$(this).scrollTop())/10))+"%"});
            }else if($(this).scrollTop() < ultimoScroll){

                $(".p_headerImg1, .p_headerImg2, .p_headerImg3").css({"background-position":"0% "+(70-((350+$(this).scrollTop())/10))+"%"});
            }
		}else{
			$(".p_flotanteicon").stop().fadeIn(250);
		}
		if(disp != "movil"){
			headerTransit();
		}


		if(ideSubtema != null){
			subtemasVisibles();
		}
        ultimoScroll = $(document).scrollTop();
		
	});
}

function headerTransit(){
	/*
	* NOMBRE: headerTransit
	* UTILIDAD: Transición del header, oculta/Muestra el banner al mover scroll
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	* VARIABLES: Ninguna.
	*/
	//170 PORQUE LA MEDIDA DEL HEADER ES FIJA DE 220 - 50 DEL MENU AZUL(LAS MEDIDAS SIEMPRE SON FIJAS)
	if($(document).scrollTop() >= 170 ){

		ocultaBanner();

	}else{

		$("#sombras").show();
        $(".p_header, .p_headerdatos, .p_headersmall, .p_section, .p_menusup").removeAttr("style");//El header aparece con imagen y es parte del scroll.
        if(bandConf){
            $("#section_1").addClass("p_oculta");
        }

		$(".p_logonova").removeClass("p_logonovasmall");//Aparece el logo normal del header.
        $(".p_headergradient1, .p_headergradient2, .p_headerimgs").removeClass("p_headergradientsmall");
		$(".p_navsupinbtn").removeClass("p_navsupinbtn_indicador");//Quita clase de indicador.
	
	}
}

function ocultaBanner(){
	/*
	* NOMBRE: ocultaBanner
	* UTILIDAD: Oculta el banner.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	* VARIABLES: Ninguna.
	*/
	$("#sombras").hide();
	$(".p_headerdatos").css({"height":"50px"});//Se reduce el tamaño del encabezado.
	
	$(".p_headersmall").css({"opacity":"1"});//Se agrega la clase para dispositivo movil para el header.
	
	$(".p_logonova").addClass("p_logonovasmall");//Se agrega la clase para dispositivo
    $(".p_headergradient1, .p_headergradient2, .p_headerimgs").addClass("p_headergradientsmall");
	
	if($("#is_movil").length 	 == 1){//es pc
		if($(".p_header").height() == 298 || $(".p_header").height() == 128){
			//170 PORQUE LA MEDIDA DEL HEADER ES FIJA DE 220 +26 DEL MENU AZUL(LAS MEDIDAS SIEMPRE SON FIJAS)
		$(".p_section").css({"margin-top":310+"px"});//La sección se posiciona con un margen.
		}else{
			//170 PORQUE LA MEDIDA DEL HEADER ES FIJA DE 220 +26 DEL MENU AZUL(LAS MEDIDAS SIEMPRE SON FIJAS)
			$(".p_section").css({"margin-top":246+"px"});//La sección se posiciona con un margen.
		}
		
	}else{//es movil
		//170 PORQUE LA MEDIDA DEL HEADER ES FIJA DE 220 +26 DEL MENU AZUL(LAS MEDIDAS SIEMPRE SON FIJAS)
		$(".p_section").css({"margin-top":$(".p_header").height()+"px"});//La sección se posiciona con un margen.
	}
	
	

	$(".p_header").css({"position":"fixed"});//El header ya no forma parte del scroll.

}

function resizePc(){
	/*
	* NOMBRE: resizePc
	* UTILIDAD: Reestablece valores al redimensionar pantalla.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	* VARIABLES: Ninguna
	*/

	$(window).resize(function(){
		altoNavegacion = $(".p_navsup").height()+50;//Altura de la barra de navegación mas 50 de p_headersmall.
		condicionMobile = (disp == "movil" || $(".recienteicon").css("display") === "flex" || $(".recienteicon").css("display") === "block");
		colocaEmergente();
		//$("html body").scrollTop(0);

		setTimeout(function(){
			altoHeader = $(".p_header").height();
			otroAlto = $(".p_headersmall").height();
		},600);

		if(menuVisible){
			ocultaSubtemas();
            $(".p_menuemergente").removeAttr("style");
		}

	});
}

var timerMovil = null;
function resizeMovil(){
	/*
	* NOMBRE: resizeMovil
	* UTILIDAD: Reestablece valores en móviles.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	* VARIABLES: Ninguna.
	*/
    window.addEventListener("orientationchange", function() {
		altoNavegacion = $(".p_navsup").height()+50;//Altura de la barra de navegación mas 50 de p_headersmall.
		ocultaBanner();
		
		if(timerMovil != null){
			clearTimeout(timerMovil);
		}
       	timerMovil = setTimeout(function(){
			condicionMobile = (disp == "movil" || $(".recienteicon").css("display") === "flex" || $(".recienteicon").css("display") === "block");
		
			colocaEmergente();
			//altoHeader = $(".p_navsup").height()+50;
			//$(".p_section").css({"margin-top":$(".p_header").height()+"px"});//La sección se posiciona con un margen.
			
			if(menuVisible){
				ocultaSubtemas();
			}
		}, 1000);
	}, false);
}


function cerrarIframe(){
	
	$(".p_iframe").fadeOut();
	$(".p_iframe").removeAttr("src");
	
}

function execPlayDemo(numero, nombre, lugar, windowReference){
	/*
	* NOMBRE: execPlayDemo
	* UTILIDAD: Despliega una ventana con la aplicacion especificada.
	* ENTRADAS: numero > numero de aplicacion, nombre > nombre de la aplicacion, lugar > portal desde donde se realiza la peticion, windowReference > una referencia a la ventana que va a utilizarse para desplegar la aplicación (puede ser nula en cuyo caso se abre una nueva ventana).
	* SALIDAS: Ninguna.
	* VARIABLES:
	*/
	var empresa = "";
	if(qES == 1){ empresa = "LG";}else{ empresa = "primaria";}

	if(windowReference!=null){
		windowReference.location = IPSRC + "index.php/recurso/cargarApp/"+numero+"/"+empresa;
	} else {
		window.open(IPSRC + "index.php/recurso/cargarApp/"+numero+"/"+empresa);
	}
	//window.open(IPSRC + "index.php/recurso/cargarApp/"+numero+"/primaria");
	//window.open('https://www.krismar-educa.com.mx/primariauat/','_blank');
	var info = "";
	var dispUser = ($("#is_movil").size() == 1)? "PC" : "Móvil";
	var lugarProviene = lugar || "Cursos";
	/*********/
	try{
		
		if(objetoFiltros.hasOwnProperty('dispositivo')){
			info += "Dispositivo búsqueda: ";
			info += (objetoFiltros.dispositivo == 1)? "PC \n" : "Móvil \n";
		}
		if(objetoFiltros.hasOwnProperty('materia')){
			info += ">Materia: " + atributosMateria[objetoFiltros.materia].nombre +" \n";
		}
		if(objetoFiltros.hasOwnProperty('tema')){
			info += ">Tema: " + objetoFiltros.tema +" \n";
		}
		if(objetoFiltros.hasOwnProperty('grado')){
			info += ">Grado: " + objetoFiltros.grado +" \n";
		}
		if(objetoFiltros.hasOwnProperty('categoria')){
			info += ">Categoria: " + objetoFiltros.categoria +" \n";
		}
		if($("#inputB").val() != ""){
			info += ">Palabras cv: " + $("#inputB").val() +" \n";
		}
		//Validar si es movil o pc
		/*info += ">Dispositivo usuario: ";
		info += ($("#is_movil").size() == 1)? "PC \n" : "Móvil \n";*/
		
		info += ">Abierta desde: " + lugarProviene;
		info += ">Nombre app: "+ nombre;
		info += ">Id app: "+ numero;
	}catch(e){
		info += "Dispositivo usuario: ";
		info += ($("#is_movil").size() == 1)? "PC \n" : "Móvil \n";
		info += ">Abierta desde: " + lugarProviene;
		info += ">Nombre app: "+ nombre;
		info += ">Id app: "+ numero;	
	}
	
	
	$.post(
		IP + "Home/registraLogApp",
		{
			rel:numero,
			inf:info,
			device: dispUser,
			accion: "View App"
		},
		function(data){
			
		}
	);
}

function playDemo(numero, nombre, lugar){
	/*
	* NOMBRE: playDemo
	* UTILIDAD: 
		* Despliega la aplicacion solicitada si no existe un usuario (logged).
		* Si existe un usuario (logged) verifica que tenga una sesion válida (que no exista otro usuario con un login mas reciente con sus mismas credenciales para ese portal en especifico):
			* Si no existe otro usuario, procede a desplegar la aplicación.
			* Si existe otro usuario, recarga su página.
		* Si el navegador en el que se intenta correr la aplicaicon se detecta como safari, abre la ventana antes de realizar la petición ajax para evitar que la apertura de la ventana sea bloqueada.
	* Objetivo: Evitar que existan dos usuarios accesando con las mismas credenciales, al mismo portal y al mismo tiempo.
	* ENTRADAS: numero > numero de aplicacion, nombre > nombre de la aplicacion, lugar > portal desde donde se realiza la peticion.
	* SALIDAS: Ninguna.
	* VARIABLES: Ninguna.
	*/
	var windowReference = null;
	var isSafari = navigator.vendor && navigator.vendor.indexOf('Apple') > -1 &&
               navigator.userAgent &&
               navigator.userAgent.indexOf('CriOS') == -1 &&
               navigator.userAgent.indexOf('FxiOS') == -1;
	if(!user){
		execPlayDemo(numero, nombre, lugar, windowReference);
	}else{
		if(isSafari){
			windowReference = window.open("","_blank");
		}
		$.get(
			IP + "Home/ValidarSesion",{},
			function(data){
				if(data=="false"){
					if(isSafari){
						windowReference.close();
					}
					muestraIngresar("Tu sesión ha sido abierta en otro dispositivo\nPor favor ingresa nuevamente.");
					//location.reload();
				}else{
					execPlayDemo(numero, nombre, lugar, windowReference);
				}
			}
		);
	}
}

function insertaLogLink(seccion){
	
	
	var dispUser = ($("#is_movil").size() == 1)? "PC" : "Móvil";
	$.post(
		IP + "Home/registraLogApp",
		{
			inf: "Click en: "+seccion,
			device: dispUser,
			accion: "Link"
		},
		function(data){
		}
	
	)
}

$(document).ready(function(){
	$('a.mustBeLogged').click(function(event) {
        event.preventDefault();
        var a = $(this);
        var windowReference = null;
        var isSafari = navigator.vendor && navigator.vendor.indexOf('Apple') > -1 &&
               navigator.userAgent &&
               navigator.userAgent.indexOf('CriOS') == -1 &&
               navigator.userAgent.indexOf('FxiOS') == -1;
        if(isSafari){
        	windowReference = window.open("","_blank");
        }
        $.get(
			IP + "Home/ValidarSesion",{},
			function(data){
				if(data=="false"){
					if(isSafari){
			        	windowReference.close();
			        }
					muestraIngresar("Tu sesión ha sido abierta en otro dispositivo\nPor favor ingresa nuevamente.");
				}else{
					var url = null;
					//if(a.attr('class').includes('Efemérides')){ insertaLogLink('Efemérides'); url = "http://www.krismar-educa.com.mx/cursos/upmoodle/historiaM/Efemerides/";}
					if(a.attr('class').includes('Escolar')){ insertaLogLink('Britannica Escolar'); url = "http://www.krismar-educa.com.mx/primaria/primaria.php"; }
					if(a.attr('class').includes('School')){ insertaLogLink('Britannica School'); url = "http://www.krismar-educa.com.mx/primaria/escolar.php"; }
					if(a.attr('class').includes('Biografía')){ insertaLogLink('Britannica Biografía'); url = "http://www.krismar-educa.com.mx/primaria/biografias.php"; }
					if(a.attr('class').includes('Mapas')){ insertaLogLink('Britannica Mapas'); url = "http://www.krismar-educa.com.mx/primaria/mapas.php"; }
					if(windowReference!=null){
						windowReference.location = url;
					} else {
						window.open(url);
					}
				}
			}
		);
    });
});
/*$(window).load(function(){
	$(".precarga").fadeOut();
});*/
