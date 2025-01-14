var altoNavegacion;
var atributosGrado = {
	"1°" : {nombre : "Primero", imagen : "p_gradosicon_primero.png"},
	"2°" : {nombre : "Segundo", imagen : "p_gradosicon_segundo.png"},
	"3°" : {nombre : "Tercero", imagen : "p_gradosicon_tercero.png"},
	"4°" : {nombre : "Cuarto", 	imagen : "p_gradosicon_cuarto.png"},
	"5°" : {nombre : "Quinto",  imagen : "p_gradosicon_quinto.png"},
	"6°" : {nombre : "Sexto",  imagen : "p_gradosicon_sexto.png"}
}
var atributosMateria = {
	mat : {nombre : "Matemáticas", 				imagen: "p_temasicon_mat.png"},
	len : {nombre : "Lenguaje y Comunicación",	imagen: "p_temasicon_esp.png"},
	tec : {nombre : "Tecnología",				imagen: "p_temasicon_tec.png"},
	geo : {nombre : "Geografía",				imagen: "p_temasicon_geo.png"},
	ing : {nombre : "Inglés",					imagen: "p_temasicon_ing.png"},
	his : {nombre : "Historia",					imagen: "p_temasicon_his.png"},
	nat : {nombre : "Ciencias Naturales",		imagen: "p_temasicon_nat.png"},
	cye : {nombre : "Formación cívica y ética", imagen: "p_temasicon_cye.png"},
	edf : {nombre : "Deportes", 				imagen: "p_temasicon_edf.png"},
	art : {nombre : "Educación artística", 		imagen: "p_temasicon_art.png"},
	hab : {nombre : "Habilidades", 				imagen: "p_temasicon_hab.png"},
	lec : {nombre : "Lecturas de Comprensión", 	imagen: "p_menuicon_lecturas.png"}
};
var contadorBtn = 1;
var disp;
estadoSwitch = 1;
var filtrosTotal;
var intApp = null;
var objetoFiltros = {};
var outBan = null;
var temas;
var timeOutReciente = null;
var tipoMenuVisible = null;
var xhrApps = null;
var xtime;
var $buscarT = "";
var $finLimite;
var $inicioLimite = 0;
var $lectura = false;
var $pagActual = 1;
$pagSeccion = 1;
var $totalAppsVisibles = 0;

function agregaObjetivos(objetivos){
	var listaObjetivos = objetivos.split("-").filter(function(item, index){return item != "";});
	var listaDom = "<ul>";

	listaObjetivos.forEach(function(item, index){
		if(index > 2)return;
		listaDom += "<li>*" + item + "</li>";
	});

	listaDom += "</ul>";
	return listaDom;
}

function agregaPaginas(){
	//Cantidad de Apps que caben en en una pagina
	$numeroApps = 2 * (Math.floor($(".p_act2center").width()/$("#medida").width()));
	$("#pag_user").empty();
	//Indices de la paginación
	for($i = ($pagSeccion * 4) - 3; $i <= ($pagSeccion * 4); $i++){
		if (Math.ceil($totalAppsVisibles / $numeroApps) >= $i){
			$("#pag_user").append("<div id = 'pagina"+$i+"' class='p_actnavnum' onclick='paginaActual(this)'>"+$i+"</div>");
		}
	}
	
	if (Math.ceil($totalAppsVisibles / $numeroApps) > ($pagSeccion * 4)) {
		$("#pag_user").append("<div class='p_actnavnum'>...</div>");
		$('#p_actnavarrowleft').css("opacity", 1);
		$('#p_actnavarrowright').css("opacity", 1);
		$('#p_actnavarrowleft').css('cursor','pointer');
		$('#p_actnavarrowright').css('cursor','pointer');
	}else{
		$('#p_actnavarrowleft').css("opacity", 1);
		$('#p_actnavarrowright').css("opacity", 0.3);
		$('#p_actnavarrowleft').css('cursor','pointer');
		$('#p_actnavarrowright').css('cursor','default');
	}

	if($pagSeccion==1){
		$('#p_actnavarrowleft').css("opacity", 0.3);	
		$('#p_actnavarrowleft').css('cursor','default');
	}
	$("#pagina" + $pagActual).attr("class", "p_actnavnum p_actnavnum_active");
}

function agregaTemas(materia, callback){
	//Agrega los temas dependiendo de la materia
	$("#actsubtemas").empty().append('<div class="p_actsubtemas_"><table class="p_actsubtemastxt"><tbody><tr><td>No existen subtemas</td></tr></tbody></table></div>');
	
	if(callback) callback();
	if(materia){
		if(temas[materia].length > 1){
			$("#actsubtemas").empty();
			temas[materia].forEach(function(item, index){
				$("#actsubtemas").append('<div id = "tema_'+item+'" class="p_actsubtemas" onclick = "seleccionaFiltroTema('+"'"+item+"'"+', this)" ><div class="p_actsubtemasicon"><div class="p_actsubtemasiconin"></div></div><table class="p_actsubtemastxt"><tbody><tr><td>'+item+'</td></tr></tbody></table></div>');
			});
		}
	}else{
		$("#actsubtemas").empty().append('<div class="p_actsubtemas_"><table class="p_actsubtemastxt"><tbody><tr><td>Selecciona una asignatura para ver los temas.</td></tr></tbody></table></div>');
	}
}

function buscaTypeApps(){
	if($buscarT == $("#inputB").val())return false;
	$buscarT = $("#inputB").val();

	if(xhrApps!=null)xhrApps.abort();
	$pagActual = 1;
	$pagSeccion = 1;
	if($("#actividades").css("display") == "none"){
		muestraApps();
	}
	filtrarAppsSql();
}

function closeMenuAct(){
	//Cierra menu de filtros
	$(".p_actdesplegable").fadeOut();
	tipoMenuVisible = null;
	modalidadMenuFiltro();
	$("#materia_filtro").removeClass("p_actividadesmenubtn_active_left");
	$("#subtema_filtro").removeClass("p_actividadesmenubtn_active");
	$("#grado_filtro").removeClass("p_actividadesmenubtn_active_right");
}

function estilosFiltro(tipoFiltro, idBtnOver, objAtributos, palabraDefault){
	
	objetoFiltros[tipoFiltro]?$(idBtnOver).addClass("p_actividadesmenubtn_over"):$(idBtnOver).removeClass("p_actividadesmenubtn_over");
	nomC = tipoFiltro=="grado"?"grado":"tema";

	$(".p_act"+(nomC)+"s").removeClass("p_acttemas_over");
	$("#"+tipoFiltro+"_app").text(objAtributos[objetoFiltros[tipoFiltro]]?objAtributos[objetoFiltros[tipoFiltro]].nombre:palabraDefault);

	$("#img_"+ tipoFiltro).removeAttr("class");
	$("#img_"+ tipoFiltro).addClass("p_actmenubtnimg");
	$("#img_"+ tipoFiltro).addClass("p_actmenuimg");

	//Si es grado busca el 1°, 2°, materia hab, mat, len, objAtributos[objetoFiltros[tipoFiltro]]
	var filtro = (tipoFiltro == "grado") ? objAtributos[objetoFiltros[tipoFiltro] + "°"] : objAtributos[objetoFiltros[tipoFiltro]];

	if(filtro){
		nomCC= (objetoFiltros[tipoFiltro] == "len")?"esp":objetoFiltros[tipoFiltro];
		$("#"+tipoFiltro+"_" +nomCC) .addClass("p_acttemas_over");
		nombreClase = (nomC == "grado")? filtro.nombre:(objetoFiltros[tipoFiltro]=="len")?"esp":objetoFiltros[tipoFiltro];
		$("#img_"+ tipoFiltro).addClass("p_temas_" + nombreClase);
	}
}

function filtrarAppsSql(){
	var banderaClose = false;
	if(xhrApps!=null){
		xhrApps.abort();
	}
	if(outBan!=null){
		clearTimeout(outBan);
	}
	if(intApp!=null){
		clearInterval(intApp);
	}

	$(".p_act4box").remove();
	//Se modificará el alto del div que contiene las aplicaciones para que no se vea diferente cuando esten buscando

	var altoCargador = obtenerTamApps();

	$("#not_app, #load_app").css("height",altoCargador + "px").hide();
	$("#load_app").show();

	if($(".p_act4box").size()>0){
		$(".p_act4box").removeClass("bounceIn");
		outBan = setTimeout(function(){
			$(".p_act4box").remove();
			banderaClose = true;
			clearTimeout(outBan);
		}, 400);
	}else{
		banderaClose = true;
	}
	$finLimite = Math.ceil($(".p_act2center").innerWidth() / $("#medida").innerWidth()) * 2;
	$inicioLimite = $pagActual;

	if($inicioLimite == 1 || $inicioLimite == 0){
		$inicioLimite = 0;
	}else{
		$inicioLimite = (($inicioLimite * $finLimite) - $finLimite);
	}
	if(disp == "movil" || $(".recienteicon").css("display") === "flex" || $(".recienteicon").css("display") === "block"){
		$clase = "p_resalteminiatura_over";
	}else{
		$clase = "p_resalteminiatura";
	}

	xhrApps = $.post(
		IP + "ConsultaApps",
		{
			palabrascv: $("#inputB").val(),
			inicioLimite: $inicioLimite,
			finLimite: $finLimite,
			filtros: objetoFiltros,
			cantAppsPag:(($pagSeccion * 4) - 3),
			pagActual: $pagActual
		},

		function(data){
			var result = JSON.parse(data);
			var apps = JSON.parse(result.apps);
			var total = result.total;

			$totalAppsVisibles = total;

			intApp = setInterval(function(){
				if(!banderaClose){
					return false;
				}

				clearInterval(intApp);

				$.each(apps, function(index, item){
					switch(item.categoria){
						case 'evaluacionC':
							categoria = 'evalC';
							break;
						case 'evaluacionE':
							categoria = 'evalE';
							break;
						case 'aplicacion':
							categoria = 'app';
							break;
						case 'aplicacionL':
							categoria = 'appL';
							break;
						default:
							categoria = item.categoria;
					}

					dataInfo = {
						rel : item.id_aplicacion,
						nombre : item.nombre,
						img : IPSRC+"/src/img/miniatura/"+item.prefijo+".png"
					}

					if(item.prefijo.indexOf('fla') != -1){
						dataInfo.img = IPSRC+"/src/img/miniatura/flash.png"
					}
					$click = ($clase == "p_resalteminiatura_over")?"muestraInfo($(this),"+dataInfo.rel+",'"+dataInfo.nombre+"', '"+dataInfo.img+"')":"playDemo('"+ item.id_aplicacion +"', '"+item.nombre+"')";
					$gradient = "";
					if($clase != "p_resalteminiatura_over"){
						$gradient = '<div class="p_primerGradient"></div><div class="p_segundoGradient"></div>';
					}

					//Para facilitar su trabajo le mostramos el prefijo (sólo a miriam)
					$nombreMiriam = '';
					if($(".p_ingresarname").find("td").text() == "miriam"){
						$nombreMiriam  = ' <br/> '+item.prefijo;
					}

					$("#not_app").after(
						  '<div  class="p_act4box bounceIn" grado = "'+item.nombreg+'" style ="display:none;" >'
							+ '<div class="p_recienteboximg '+$clase+'">'
								+ '<div class="p_recienteboxminiatura" >'
									+ '<img id = "img" src = "'+dataInfo.img+'"/>'
									+ '<div class="p_recienteboxicon p_recienteboxicon_'+categoria+'"></div>'
									+ '<div class = "p_recienteboxlight"></div>'
									+ '<div class="p_recienteinfo">'
										+ '<div class="p_recienteinfoplay">'
											+ '<div class="p_recienteinfoplayicon" onclick = "'+$click+'">'
												+ '<svg viewBox="0 0 148.253 150">'
													+ '<g>'
														+ '<path fill-rule="evenodd" clip-rule="evenodd"  d="M74.027,0.058c37.036-1.606,74.318,30.537,74.226,74.878'
														+ 'c-0.088,43.053-35.125,75.344-74.689,75.063c-37.865-0.27-72.181-29.865-73.515-70.935C-1.431,33.571,30.971,0.058,74.027,0.058z"/>'
													+ '</g>'
													+ '<g>'
														+ '<path d="M76.697,0v4c16.848,0,33.871,7.376,46.707,20.239c13.484,13.513,20.89,31.514,20.85,50.688'
														+ 'c-0.039,19.33-7.558,37.359-21.17,50.766C109.979,138.598,92.117,146,74.077,146l-0.484-0.002'
														+ 'c-17.726-0.126-34.686-6.907-47.757-19.093C12.382,114.364,4.645,97.327,4.047,78.934C3.36,57.809,10.37,38.542,23.787,24.682'
														+ 'c12.874-13.3,30.716-20.624,50.241-20.624c0.058,0,0.116-0.001,0.173-0.004C75.023,4.018,75.861,4,76.692,4L76.697,0 M76.691,0'
														+ 'c-0.886,0-1.777,0.019-2.664,0.058c-43.057,0-75.458,33.514-73.979,79.006c1.334,41.069,35.65,70.665,73.515,70.935'
														+ 'C73.735,150,73.906,150,74.077,150c39.354,0,74.089-32.198,74.177-75.065C148.343,31.655,112.832-0.003,76.691,0L76.691,0z"/>'
													+ '</g>'
													+ '<path d="M103.804,71.464L69.521,37.181c-1.43-1.43-3.581-1.857-5.449-1.084c-1.868,0.774-3.086,2.597-3.086,4.62'
													+ 'v68.567c0,2.022,1.218,3.846,3.086,4.619c0.619,0.257,1.269,0.381,1.913,0.381c1.301,0,2.58-0.508,3.537-1.465l34.283-34.283'
													+ 'C105.757,76.583,105.757,73.417,103.804,71.464z"/>'
												+ '</svg>'
											+ '</div>'
										+ '</div>'
										+ '<div class="p_recienteinfotitle">'+(item.nombre + $nombreMiriam )+ '</div>'
										+ '<div class="p_recienteinfoobjetivos">'+agregaObjetivos(item.objetivos)+'</div>'
										+ $gradient
									+ '</div>'
								+ '</div>'
							+ '</div>'
							+ '<div class="p_recienteboxtxt">'+(item.nombre + $nombreMiriam) +'</div>'
						+ '</div>'
					);
				});
				agregaPaginas();
				$("#not_app, #load_app").hide();
				$(".p_act4box").show();
				mostrarApps();
			}, 10);
		}
	).done(function(){	
		xhrApps = null;
	}).fail(function(){
		console.log("falló");
	});
	agregaPaginas()
}

/*function filtraMovilPc(valor, paramFiltra){

	paramFiltra = paramFiltra || "noFiltra";
	estadoSwitch = valor;
	
	$(".p_switchtext").removeClass("p_switchcolor");
	$($(".p_switchtext")[estadoSwitch]).addClass("p_switchcolor");
	$(".p_switchbtnin").animate({"left":""+((estadoSwitch == 1)?34:2)+"px"});
	
	if(paramFiltra == "nofiltra") return false;
	$pagActual = 1;
	$pagSeccion = 1;

	objetoFiltros.dispositivo = estadoSwitch;
	
	filtrarAppsSql();
	insertaLog();
}*/


function insertaLog(){
	var info = "";
	var dispUser = ($("#is_movil").size() == 1)? "PC" : "Móvil";
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
	
	
	$.post(
		IP + "Home/registraLogApp",
		{
			inf: info,
			device: dispUser,
			accion: "Search"
		},
		function(data){
			//console.log(data);
			
		}
	
	)
}

function limpiarFiltros(){

	var totalAtributos = Object.keys(objetoFiltros).length;
	var valordisp = disp=="movil"?0:1;
	if(totalAtributos == 1 && objetoFiltros.dispositivo != undefined && $("#inputB").val() == "" && objetoFiltros.dispositivo == valordisp){
		return false;
	}

	$pagActual = 1;
	$pagSeccion = 1;
	for (var attr in objetoFiltros)	{
		if(attr == "dispositivo"){
			if(objetoFiltros.dispositivo != valordisp){
				filtraMovilPc(valordisp, "noFiltra");
			}
			objetoFiltros.dispositivo = valordisp;
		}else{
			delete objetoFiltros[attr];
		}
	}
	
	$(".p_actividadesmenubtn").removeClass("p_actividadesmenubtn_over");
	$(".p_actividadescategopcion").removeClass("p_actividadescategopcion_select");
	$(".p_acttemas, .p_actgrados").removeClass("p_acttemas_over");
	
	//document.getElementById('materia_filtro').classList.remove('p_actividadesmenubtn_over');
	
	$("#materia_app").text("Asignaturas");
	$("#subtema_app").text("Temas");
	$("#grado_app").text("Grados");
	
	closeMenuAct();
	
	$("#actsubtemas").empty().append('<div class="p_actsubtemas_"><table class="p_actsubtemastxt"><tbody><tr><td>Selecciona una asignatura para ver los temas.</td></tr></tbody></table></div>')
	$(".p_buscadorinput").val("");
	$(".p_conte_notificacion").removeAttr("style");
	$buscarT = "";
	filtrarAppsSql();
}

function llenaTemas(){
	$.post(
		IP + "ConsultaTemas",
		function(data){

			temas = JSON.parse(data);
			
		}
	);
}

function modalidadMenuFiltro(){
	//Modifica estilos para menu de filtros
	$(".p_actfondo").stop().fadeOut(200);
	if(tipoMenuVisible != null){//Se esta mostrando el menu de filtros
			
		//Se debe mostrar
		if(condicionMobile){
			$(".p_actfondo").stop().fadeIn(200);
			$(".p_actdesplegable").addClass("p_actdesplegable_movil").stop().fadeIn(500);
			centraElemento($(".p_actfondo"), $(".p_actdesplegable "));
		}else{
			$(".p_actdesplegable").removeClass("p_actdesplegable_movil").removeAttr("style").stop().fadeIn(500);
		
		}
	}else{//No se esta mostrando
		
		if(condicionMobile){
			$(".p_actdesplegable").addClass("p_actdesplegable_movil");
		}else{
			$(".p_actdesplegable").removeClass("p_actdesplegable_movil");
		}
	}
}

function mostrarApps(){	
	//Mensaje no apps
	if($totalAppsVisibles == 0){
		$("#not_app").show();
	}else{
		$("#not_app").hide();
	}
}

function muestraMenuFiltro(tipo, objeto){
	//Muestra el menu para seleccionar asignatura tema grado
	condicionMobile = (disp == "movil" || $(".recienteicon").css("display") === "flex" || $(".recienteicon").css("display") === "block");
	claseActive = $(objeto).attr("id")== "materia_filtro"?"p_actividadesmenubtn_active_left":$(objeto).attr("id")== "subtema_filtro"?"p_actividadesmenubtn_active":"p_actividadesmenubtn_active_right";
	
	$("#materia_filtro").removeClass("p_actividadesmenubtn_active_left");
	$("#subtema_filtro").removeClass("p_actividadesmenubtn_active");
	$("#grado_filtro").removeClass("p_actividadesmenubtn_active_right");
	
	if(tipo == tipoMenuVisible){
		closeMenuAct();
		$(objeto).removeClass(claseActive);
	}else{
		tipoMenuVisible = tipo;
		
		$("#acttemas, #actsubtemas, #actgrados").removeAttr('style');
		$("#" + tipo).css("display","table");
		$(objeto).addClass(claseActive);

	}
	modalidadMenuFiltro();
}

function obtenerTamApps() {
	var tam = 0;
	var altoApp = 424;
	if (typeof window.innerWidth != 'undefined')
	{
	  //tam = [window.innerWidth,window.innerHeight];
	  tam = window.innerWidth;
	}
	else if (typeof document.documentElement != 'undefined'
		&& typeof document.documentElement.clientWidth !=
		'undefined' && document.documentElement.clientWidth != 0)
	{
	  /*tam = [
		  document.documentElement.clientWidth,
		  document.documentElement.clientHeight
	  ];*/
	  tam = document.documentElement.clientWidth;
	}
	else   {
	  /*tam = [
		  document.getElementsByTagName('body')[0].clientWidth,
		  document.getElementsByTagName('body')[0].clientHeight
	  ];*/
	  tam = document.getElementsByTagName('body')[0].clientWidth;
	}

	//console.log("tamaño de la ventana: " + tam)
	if(tam <= 400){
		return (203*2);
	}else if(tam <= 520 && tam > 400){
		return (271 * 2);
	}else if(tam <= 680 && tam > 520){
		return (203 * 2);
	}else if(tam <= 860 && tam > 680){
		return (183 *2);
	}else if(tam <= 1024 && tam > 860){
		return (169*2);
	}

	return altoApp;
}

function paginaActual(element) {

	if($(element).hasClass('p_actnavnum p_actnavnum_active')){
		return false;
	}

	if(xhrApps!=null)xhrApps.abort();
	$pagActual = parseInt(element.textContent);
	//console.log($pagActual);
	filtrarAppsSql();
}

function seleccionaFiltroMateria(materia, objeto){
	$pagActual = 1;
	$pagSeccion = 1;
	objetoFiltros.materia == materia? delete objetoFiltros.materia: objetoFiltros.materia = materia;
	
	delete objetoFiltros.tema;

	agregaTemas(objetoFiltros.materia, closeMenuAct);
	
	estilosFiltro("materia", "#materia_filtro", atributosMateria, "Asignaturas");
	
	seleccionaFiltroTema(objetoFiltros.tema);
	
	if(objetoFiltros.hasOwnProperty('materia')){
		insertaLog();
	}
}

function seleccionaFiltroTema(tema){
	$pagActual = 1;
	$pagSeccion = 1;
	objetoFiltros.tema == tema? delete objetoFiltros.tema: objetoFiltros.tema = tema;
	
	filtrarAppsSql();

	$(".p_actsubtemas").removeClass("p_actsubtemas_over");
	
	$("#subtema_app").text((objetoFiltros.tema)?objetoFiltros.tema:"Temas");
	objetoFiltros.tema?$("#subtema_filtro").addClass("p_actividadesmenubtn_over"):$("#subtema_filtro").removeClass("p_actividadesmenubtn_over");
	
	$(".p_actsubtemastxt").filter(function(index, item){
	
		return ($(item).text() == objetoFiltros.tema);
		
	}).each(function(index, item){
		
		$(item).parent().addClass("p_actsubtemas_over");
		
	});
	closeMenuAct();
	if(objetoFiltros.hasOwnProperty('tema')){
		insertaLog();
	}
}

function seleccionaFiltroGrado(grado){
	$pagActual = 1;
	$pagSeccion = 1;
	grado = grado.split("°")[0];

	objetoFiltros.grado == grado?delete objetoFiltros.grado:objetoFiltros.grado = grado;
	
	filtrarAppsSql();
	
	estilosFiltro("grado", "#grado_filtro", atributosGrado, "Grados");
	
	closeMenuAct();
	if(objetoFiltros.hasOwnProperty('grado')){
		insertaLog();
	}
}

function seleccionaFiltroCategoria(categoria){
	$pagActual = 1;
	$pagSeccion = 1;
	objetoFiltros.categoria == categoria? delete objetoFiltros.categoria: objetoFiltros.categoria = categoria;
	filtrarAppsSql();
	
	$(".p_actividadescategopcion").removeClass("p_actividadescategopcion_select").filter(function(index, item){
		
		return $(item).attr("categoria") == objetoFiltros.categoria;
		
	}).each(function(index, item){
		
		$(item).addClass("p_actividadescategopcion_select");
	
	});
	
	if(objetoFiltros.hasOwnProperty('categoria')){
		insertaLog();
	}
}
/*
$(document).ready(function(){
	objetoFiltros.dispositivo = $("#is_movil").length;
	//Obteniendo limites iniciales para la paginacion
	llenaTemas();
	if($(".p_switch").length > 0){
		$(".p_switchbtnin").draggable({
			start: function(){$(".p_switchtext").removeClass("p_switchcolor")},
			containment:".p_switchbtn",
			axis:"x"
		});
		
		$(".p_switch_m").droppable({
			drop:function(){filtraMovilPc(0);}
		});

		$(".p_switch_pc").droppable({
			drop:function(){filtraMovilPc(1);}
		});	
	}
		
	$("#p_actnavarrowleft").click(function(){
		if ($pagSeccion > 1){
			$pagSeccion--;
			$pagActual = (($pagSeccion-1) * 4) + 1;
			filtrarAppsSql();
		}
	});
		
	$("#p_actnavarrowright").click(function(){
		if ($pagSeccion < (Math.ceil($totalAppsVisibles / $numeroApps)) / 4){
			$pagSeccion++;
			$pagActual = (($pagSeccion-1) * 4) + 1;
			filtrarAppsSql();
		}
	});
	
	$("#busca_cierra_apps").click(function(){
		if($("#actividades").css("display") == "none"){
			muestraApps();
		}else{
			regresarMenu();
		}
	});
});
*/