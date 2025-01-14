var tipoDemo;

var $inicioLimiteAdmin = 0;

var $finLimiteAdmin;

var $totalAppsVisiblesAdmin = 0;

var $pagActualAdmin = 1;

var $pagSeccionAdmin = 1;

var objetoFiltroAdmin = {};
 $.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '< Ant',
 nextText: 'Sig >',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'yy-mm-dd',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 
$.datepicker.setDefaults($.datepicker.regional['es']);

$(document).ready(function(){
     
    $("#fechaBus").datepicker();
	
	$("#p_actnavarrowleft_admin").click(function() {

		if ($pagSeccionAdmin > 1) {

			$pagSeccionAdmin--;

			$pagActualAdmin = (($pagSeccionAdmin-1) * 4) + 1;

			filtrarAppsAdmin();
		}

	});
		
	$("#p_actnavarrowright_admin").click(function() {

		if ($pagSeccionAdmin < (Math.ceil($totalAppsVisiblesAdmin / $numeroAppsAdmin)) / 4) {

			$pagSeccionAdmin++;

			$pagActualAdmin = (($pagSeccionAdmin-1) * 4) + 1;

			filtrarAppsAdmin();

		}

	});
	
});

function modificar(){
	
	
	if($(".p_filtro_asigna option:selected").val() == "selecciona"){
		
        alert("Selecciona una opción para continuar.");
		
    }else{
		
		if(tipoDemo != null){//Esta editando
		
			if(tipoDemo == $(".p_filtro_asigna option:selected").val()){
				
				return false;
				
			}
		
			appsSalvar = new Array();
		
			$(".p_act3box").each(function(index, item){
			
				appsSalvar.push({"nombre":$(item).find(".p_recienteboxtxt").text(), "prefijo":$(item).attr("id")})
			
			});
			
			if(!equals()){
				
				confirma = confirm("No has guardado cambios, si modificas otra seccion perderas todos los cambios, ¿Deseas seguir?");
				
				if(!confirma)return false;
				
				appsMoverBorrar = {};
				appsGuardar = {};
				appsSeleccionadas = {};
				appsEliminar = {};
				desactivarBtn("#moveL, #moveR, #trash");
				
			}
	
			tipoDemo = $(".p_filtro_asigna option:selected").val();
			
			recuperaAppsDemo('filtrarAppsAdmin');
			
			
			$("html body").stop().animate({scrollTop: $("#titulo").offset().top - (altoNavegacion + 20)},500, "linear");
			
			filtrarAppsAdmin();
			
			return;
		}
		bandConf = true;
		tipoDemo = $(".p_filtro_asigna option:selected").val();
		recuperaAppsDemo('filtrarAppsAdmin');
		
		$("#second_config").removeClass("p_oculta");
		$("#second_config").addClass("bounceInLeft");
		
		$("#activs").show();
		
		
		
		//$(".p_footer").removeClass("p_oculta");
		$("html body").stop().animate({scrollTop: $("#titulo").offset().top - (altoNavegacion + 20)},500, "linear");
		
		filtrarAppsAdmin();
    }
	
}

var appsDemo;

function recuperaAppsDemo(callback){
	
	$.post(
		IP + "Administracion/appsDemo",
		{
			demo : tipoDemo
		},
		function(data){
			$(".p_act3box").remove();
			
			result = JSON.parse(data);
			
			appsDemo = result;
			
			$.each(result, function(index, item){
				
				$("#moverIcon").before('<div class="p_act3box" id = "'+item.prefijo+'" ><div class="p_recienteboximg"><div class="p_recienteboxminiatura"><img src = "'+IPSRC+'src/img/miniatura/'+item.prefijo+'.png"/><div class="p_recienteboxicon p_recienteboxicon_'+item.categoria+'"></div><div class = "p_recienteboxlight"></div></div></div><div class="p_recienteboxtxt">'+item.nombre+'</div><input type="checkbox" class="c_checkbox" onclick = "selectApp('+"'"+item.nombre+"'"+', '+"'"+item.prefijo+"'"+', $(this))"></div>');
				
			});
			if(callback)eval(callback+"()");
		}
	);
}

var appsSeleccionadas = {};

function filtrarAppsAdmin(){
	
	$finLimiteAdmin = Math.ceil($("#activs").innerWidth() / $(".p_act2box").innerWidth()) * 2;

	$inicioLimiteAdmin = $pagActualAdmin;

	if($inicioLimiteAdmin == 1 || $inicioLimiteAdmin == 0){

		$inicioLimiteAdmin = 0;

	}else{

		$inicioLimiteAdmin = (($inicioLimiteAdmin * $finLimiteAdmin) - $finLimiteAdmin);
	}
	
	if(disp == "movil" || $(".recienteicon").css("display") === "flex" || $(".recienteicon").css("display") === "block"){
		
		$clase = "p_resalteminiatura_over";
		//$click = "muestraInfo($(this))";
		
	}else{
		$clase = "p_resalteminiatura";
		//$click = "playDemo(" +  + ")";
		
	}
	
	$.post(
		IP + "Administracion/totalApps",
		{
			filtros: objetoFiltroAdmin,
			demo: tipoDemo,
			inicio: $inicioLimiteAdmin,
			fin: $finLimiteAdmin
		},
		function(data){
			console.log("Data");
			$("#activs").empty();
			
			result = JSON.parse(data);
			
			apps = result.apps;
			
			$totalAppsVisiblesAdmin = result.total;
			
			$.each(apps, function(index, item){//
				
				var atributo = "";
				
				/*$.each(appsEliminar, function(indexElimina, itemElimina){
						
					if(itemElimina.prefijo == item.prefijo){//La app consultada ya no esta para guardar en la bd, pero aun esta en la db
						
						atributo = "";
						
						return false;
					
					}
					
				});*/
				
				$.each(appsDemo, function(indexDemo, itemDemo){
				
					if(itemDemo.prefijo == item.prefijo){
						atributo = "checked = 'true' disabled = 'true'";
						return false;
					}
					
				});
				
				if(atributo == ""){//No encontro nada en las apps demo
					//Buscamos en las apps que se seleccionaron
					$.each(appsSeleccionadas, function(indexSel, itemSel){
						
						if(itemSel.prefijo == item.prefijo){
							atributo = "checked = 'true'";
							return false;
						}
						
					});
					
				}
				//No se encontró ni el las apps demo ni en las seleccionadas
				if(atributo == ""){
					if(Object.keys(appsGuardar).length > 0){
						$.each(appsGuardar, function(indexGuarda, itemGuarda){
							if(item.prefijo == itemGuarda.prefijo){
								atributo = "checked = 'true' disabled = 'true'";
								
								return false;
							}
						});
					}
				}
				
				if(atributo != ""){
					
					$.each(appsEliminar, function(indexElimina, itemElimina){
						
						if(itemElimina.prefijo == item.prefijo){//La app consultada ya no esta para guardar en la bd, pero aun esta en la db
							
							atributo = "";
							
							return false;
						
						}
						
					});
					
					//delete appsEliminar[item.prefijo];
					
				}
				
				dataInfo = {
					rel : item.id_aplicacion,
					nombre : item.nombre,
					img : IPSRC+"src/img/miniatura/"+item.prefijo+".png",
					
				}
				
				$click = ($clase == "p_resalteminiatura_over")?"muestraInfo($(this),"+dataInfo.rel+",'"+dataInfo.nombre+"', '"+dataInfo.img+"')":"playDemo('"+ item.id_aplicacion +"')";
				$gradient = ($clase != "p_resalteminiatura_over")?'<div class="p_primerGradient"></div><div class="p_segundoGradient"></div>':'';
	
				$("#activs").append('<div prefijo = "'+item.prefijo+'" categoria = "'+item.categoria+'" class="p_act2box"><div class="p_recienteboximg '+$clase+'"><div class="p_recienteboxminiatura"><img src = "'+IPSRC+'src/img/miniatura/'+((item.prefijo.substring(0,3) == "fla")?"flash":item.prefijo)+'.png"/><div class="p_recienteboxicon p_recienteboxicon_'+item.categoria+'"></div><div class = "p_recienteboxlight"></div><div class="p_recienteinfo"><div class="p_recienteinfoplay"><div class="p_recienteinfoplayicon" onclick = "'+$click+'"><svg viewBox="0 0 148.253 150"><g><path fill-rule="evenodd" clip-rule="evenodd" d="M74.027,0.058c37.036-1.606,74.318,30.537,74.226,74.878c-0.088,43.053-35.125,75.344-74.689,75.063c-37.865-0.27-72.181-29.865-73.515-70.935C-1.431,33.571,30.971,0.058,74.027,0.058z"></path></g><g><path d="M76.697,0v4c16.848,0,33.871,7.376,46.707,20.239c13.484,13.513,20.89,31.514,20.85,50.688c-0.039,19.33-7.558,37.359-21.17,50.766C109.979,138.598,92.117,146,74.077,146l-0.484-0.002c-17.726-0.126-34.686-6.907-47.757-19.093C12.382,114.364,4.645,97.327,4.047,78.934C3.36,57.809,10.37,38.542,23.787,24.682c12.874-13.3,30.716-20.624,50.241-20.624c0.058,0,0.116-0.001,0.173-0.004C75.023,4.018,75.861,4,76.692,4L76.697,0 M76.691,0c-0.886,0-1.777,0.019-2.664,0.058c-43.057,0-75.458,33.514-73.979,79.006c1.334,41.069,35.65,70.665,73.515,70.935C73.735,150,73.906,150,74.077,150c39.354,0,74.089-32.198,74.177-75.065C148.343,31.655,112.832-0.003,76.691,0L76.691,0z"></path></g><path d="M103.804,71.464L69.521,37.181c-1.43-1.43-3.581-1.857-5.449-1.084c-1.868,0.774-3.086,2.597-3.086,4.62v68.567c0,2.022,1.218,3.846,3.086,4.619c0.619,0.257,1.269,0.381,1.913,0.381c1.301,0,2.58-0.508,3.537-1.465l34.283-34.283C105.757,76.583,105.757,73.417,103.804,71.464z"></path></svg></div></div><div class="p_recienteinfotitle">'+item.nombre+'</div><div class="p_recienteinfoobjetivos">'+agregaObjetivos(item.objetivos)+'</div>'+$gradient+'<input type ="checkbox" class="c_check2box" '+atributo+' onchange = "seleccionaApp('+"'"+item.nombre+"'"+', '+"'"+item.prefijo+"'"+', $(this))"></div></div></div><div class="p_recienteboxtxt">'+item.nombre+'</div><input '+atributo+' type="checkbox" class="c_checkbox" onchange = "seleccionaApp('+"'"+item.nombre+"'"+', '+"'"+item.prefijo+"'"+', $(this))"></div>')
			
			});
			mostrarAppsAdmin();
		}
	);
	
}

function seleccionaApp(nombre, prefijo, item){
	
	if(!item.prop('checked')){
		
		delete appsSeleccionadas[prefijo];
		
	}else{
		
		appsSeleccionadas[prefijo] =  {"nombre":nombre, "prefijo":prefijo};
	
	}
	if(item.attr("class") == "c_checkbox"){//pequeño chkbx
		
		console.log(item.parent().attr("class"))
		
	}else{//grande
	
		item.parent().parent().parent().parent().find(".c_checkbox").prop("checked", item.prop('checked'));
		
	}
	
}

var appsGuardar = {};

function agregaApps(){
	
	if(Object.keys(appsSeleccionadas).length == 0){
		alert("Selecciona alguna actividad para agregar");
		return false;
	}
	
	$.each(appsSeleccionadas, function(index, item){
		
		
		delete appsEliminar[item.prefijo];
		
		appsGuardar[item.prefijo] = item;
		$categoria = $("#activs").find("[prefijo = '"+item.prefijo+"']").attr("categoria");
		
		$("#moverIcon").before('<div class="p_act3box" id = "'+item.prefijo+'" ><div class="p_recienteboximg"><div class="p_recienteboxminiatura"><img src = "'+IPSRC+'src/img/miniatura/'+((item.prefijo.substring(0,3) == "fla")?"flash":item.prefijo)+'.png"/><div class="p_recienteboxicon p_recienteboxicon_'+$categoria+'"></div><div class = "p_recienteboxlight"></div></div></div><div class="p_recienteboxtxt">'+item.nombre+'</div><input type="checkbox" class="c_checkbox" onclick = "selectApp('+"'"+item.nombre+"'"+', '+"'"+item.prefijo+"'"+', $(this))"></div>');
	});
	
	appsSeleccionadas = {};
	filtrarAppsAdmin();
	$("html body").stop().animate({scrollTop: $("#subtitulo").offset().top - (altoNavegacion + 20)},500, "linear");
}

var appsMoverBorrar = {};

function selectApp(nombre, prefijo, item){
	
	if(!item.prop('checked')){
		
		delete appsMoverBorrar[prefijo];
		
	}else{
		
		appsMoverBorrar[prefijo] = {"prefijo":prefijo, "nombre": nombre};
		
	}
	
	if(Object.keys(appsMoverBorrar).length == 1){
		
		activarBtn("#moveL", "mueveIzquierda()");
		activarBtn("#moveR", "mueveDerecha()");
		activarBtn("#trash", "borraApps()");
		
	}else if(Object.keys(appsMoverBorrar).length > 1){
		
		desactivarBtn("#moveL, #moveR");
		activarBtn("#trash");
		
	}else{
		
		desactivarBtn("#moveL, #moveR, #trash");
	
	}
	
	
}

function mueveIzquierda(){
	
	$.each(appsMoverBorrar, function(index, item){
		
		var itmBefore = $("#" + index).prev();
		
		if(itmBefore.attr("class") == "p_act3box"){
			
			$("#" + index).remove();
			
			itmBefore.before('<div class="p_act3box" id = "'+item.prefijo+'" ><div class="p_recienteboximg"><div class="p_recienteboxminiatura"><img src = "'+IPSRC+'src/img/miniatura/'+((item.prefijo.substring(0,3) == "fla")?"flash":item.prefijo)+'.png"/><div class="p_recienteboxicon"></div><div class = "p_recienteboxlight"></div></div></div><div class="p_recienteboxtxt">'+item.nombre+'</div><input type="checkbox" checked = "true" class="c_checkbox" onclick = "selectApp('+"'"+item.nombre+"'"+', '+"'"+item.prefijo+"'"+', $(this))"></div>')
		
		}
		
	});
}

function mueveDerecha(){
	
	$.each(appsMoverBorrar, function(index, item){
		
		var itmAfter = $("#" + index).next();
		
		if(itmAfter.attr("class") == "p_act3box"){
			
			$("#" + index).remove();
			
			itmAfter.after('<div class="p_act3box" id = "'+item.prefijo+'" ><div class="p_recienteboximg"><div class="p_recienteboxminiatura"><img src = "'+IPSRC+'src/img/miniatura/'+((item.prefijo.substring(0,3) == "fla")?"flash":item.prefijo)+'.png"/><div class="p_recienteboxicon"></div><div class = "p_recienteboxlight"></div></div></div><div class="p_recienteboxtxt">'+item.nombre+'</div><input type="checkbox" checked = "true" class="c_checkbox" onclick = "selectApp('+"'"+item.nombre+"'"+', '+"'"+item.prefijo+"'"+', $(this))"></div>')
		
		}
		
	});
	
}

var appsEliminar = {};

function borraApps(){
	
	$.each(appsMoverBorrar, function(index, item){
		
		$("#" + index).remove();
		
		$.each(appsDemo, function(indexDemo, itemDemo){
			
			if(itemDemo.prefijo == item.prefijo){
				
				appsEliminar[itemDemo.prefijo] = {"prefijo":itemDemo.prefijo};
				
			}
		
		});
		
	});
	
	desactivarBtn("#moveL, #moveR, #trash");
	
	appsMoverBorrar = {};
	
	filtrarAppsAdmin();
}

function activarBtn(id, funcion){
	
	$(id).attr("onclick", funcion).css({"opacity":1, "cursor":"pointer"});
	
}

function desactivarBtn(id){
	
	$(id).removeAttr("onclick").css({"opacity": 0.5, "cursor":"default"});

}

function guardarActividades(){
	
	if(Object.keys(appsSeleccionadas).length > 0){
		alert("No has terminado de agregar las aplicaciones que seleccionaste.");
		return;
	}
	
	appsSalvar = new Array();
	
	
	$(".p_act3box").each(function(index, item){
	
		appsSalvar.push({"nombre":$(item).find(".p_recienteboxtxt").text(), "prefijo":$(item).attr("id")})
	
	});
	
	if(equals()){
		
		alert("No se han añadido o modificado las aplicaciones.");
		
		return false;
		
	}
	
	$(".p_emergenteusuario").fadeIn();
	
	$("#mensaje_guardar").css({"display":"table"});
	
    $(".p_emerclose").hide();
	
	$("#mensaje_guardar").find(".p_emerdatos").find(".p_emerdatostxt").text("Guardando...");
	
	colocaEmergente();
	
	var dispUser = ($("#is_movil").size() == 1)? "PC" : "Móvil";
	
	$.post(
		IP + "Home/registraLogApp",
		{
			inf: "Modificó sección: "+(tipoDemo == 1)?"Lo más reciente":"Conoce nuestras aplicaciones",
			device: dispUser,
			accion: "Update"
		},
		function(data){
			console.log(data);
			
		}
	
	);
	
	
	$.post(
		IP + "Administracion/guardarDemos",
		{
			demo : tipoDemo,
			appsEliminar : JSON.stringify(appsEliminar),
			appsGuardar : JSON.stringify(appsSalvar)
			
		},
		function(data){
			$("#mensaje_guardar").find(".p_emerdatos").find(".p_emerdatostxt").text("Guardado correctamente.");
			recuperaAppsDemo();
			appsMoverBorrar = {};
			desactivarBtn("#moveL, #moveR, #trash");
			$("#cargarReciente").load("https://192.168.1.15/primaria_exp/creciente");
			setTimeout(function(){
				cerrarEmergentes();
				$("html body").stop().animate({scrollTop: 0},500, "linear");
			}, 2000);
		}
	).fail(function(){
		
		$("#mensaje_guardar").find(".p_emerdatos").find(".p_emerdatostxt").text("Ocurrio un error, no se guardaron los cambios, intentalo más tarde");
		
		setTimeout(function(){
			
			cerrarEmergentes();
			
		}, 2000);
		
	});
	
}

function equals(){
	
	if(appsDemo.length != appsSalvar.length){
		
		return false;
		
	}
	
	for(i = 0; i < appsDemo.length; i++){
		
		if(appsDemo[i].prefijo != appsSalvar[i].prefijo) {
			return false;
			break;
		}
	}
	return true;
	
}

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

function mostrarAppsAdmin(){
	
	//Cantidad de Apps que caben en en una pagina
	
	
	$numeroAppsAdmin = 2 * (Math.floor($("#activs").innerWidth() / $(".p_act2box").innerWidth()));
	
	$("#pag_admin").empty();


	for ( $i = ($pagSeccionAdmin * 4) - 3; $i <= ($pagSeccionAdmin * 4); $i++) {
		//alert($i)
		if (Math.ceil($totalAppsVisiblesAdmin / $numeroAppsAdmin) >= $i){

			$("#pag_admin").append("<div id = 'pagina_admin"+$i+"' class='p_actnavnum' onclick='paginaActualAdmin(this)'>"+$i+"</div>");

		}

	}
	
	if(Math.ceil($totalAppsVisiblesAdmin / $numeroAppsAdmin) > ($pagSeccionAdmin * 4)){

		$("#pag_admin").append("<div class='p_actnavnum'>...</div>");

		$('#p_actnavarrowleft_admin').css("opacity", 1);

		$('#p_actnavarrowright_admin').css("opacity", 1);

		$('#p_actnavarrowleft_admin').css('cursor','pointer');

		$('#p_actnavarrowright_admin').css('cursor','pointer');

	}else{

		$('#p_actnavarrowleft_admin').css("opacity", 1);

		$('#p_actnavarrowright_admin').css("opacity", 0.3);

		$('#p_actnavarrowleft_admin').css('cursor','pointer');

		$('#p_actnavarrowright_admin').css('cursor','default');

	}
	
	if($pagSeccionAdmin==1){

		$('#p_actnavarrowleft_admin').css("opacity", 0.3);	

		$('#p_actnavarrowleft_admin').css('cursor','default');

	}
	
	$("#pagina_admin" + $pagActualAdmin).attr("class", "p_actnavnum p_actnavnum_active");
	
	if($totalAppsVisiblesAdmin == 0){
		$(".p_conte_notificacion").show();
		$(".p_conte_notificacion").css("height","424px");
	}else{
		$(".p_conte_notificacion").hide();
	}
	
}

function paginaActualAdmin(element) {
	
	$pagActualAdmin = parseInt(element.textContent);
		
	filtrarAppsAdmin();

}

function filtrarKeyupC(valor){
	$inicioLimiteAdmin = 0;
	
	$pagActualAdmin = 1;
	$pagSeccionAdmin = 1;
	
	objetoFiltroAdmin.palabras = valor;
	filtrarAppsAdmin();
}

function seleccionaCategoriaAdmin(categoria){
	
	$inicioLimiteAdmin = 0;
	$pagActualAdmin = 1;
	$pagSeccionAdmin = 1;
	
	$("div[categoria]").removeAttr("style");
	objetoFiltroAdmin.categoria == categoria? delete objetoFiltroAdmin.categoria: objetoFiltroAdmin.categoria = categoria;
	
	if(objetoFiltroAdmin.categoria){
		
		objetoFiltroAdmin.categoria = categoria;
		
		$("div[categoria = "+categoria+"]").css("background-color", "rgb(0, 177, 233)")
	}
	
	filtrarAppsAdmin();
	
}

function limpiaFiltrosAdmin(){
	
	for (var attr in objetoFiltroAdmin)	{
		
		delete objetoFiltroAdmin[attr];
		
	}
	
	$("div[categoria]").removeAttr("style");
	$("#pal_bus").val("");
	$inicioLimiteAdmin = 0;
	
	$pagActualAdmin = 1;
	$pagSeccionAdmin = 1;
	filtrarAppsAdmin();
	
}

//Obitene registro de lista usuarios
var registrosPorPagina = 10;
var paginaHojaUsuario = 1;
var totalUsuarios;
var pagSeccionHoja = 1;
var orderBy = "firstname";
function listaUsuarios(){
	
	$("#resultadoRegistrosLog").hide();
	$("#resultadoListaUsuarios").show();
	
	/*if($("#cuentas").val() != 0){
		return;
	}*/
	filtraHojaUsuarios();
	
}

function filtraHojaUsuarios(){
	
	var inicioHoja = paginaHojaUsuario;
	if(inicioHoja == 1){
		
		inicioHoja = 0;
		
	}else{
		
		inicioHoja = (paginaHojaUsuario * registrosPorPagina) - registrosPorPagina;
		
	}
	
	//
	
	$.post(
		IP + "Administracion/HojearListaUsuarios",
		{
			fin: registrosPorPagina,
			inicio: inicioHoja,
			order: orderBy
		},
		function(data){
			
			$result = JSON.parse(data);
			
			apps = $result.apps;
		
			totalUsuarios = $result.total
			
			//$("#lista").empty();
			$(".eliminaTr").remove();
			//$("#lista").append("<tr><td><div class = 'tituloTabla' onclick = 'orden(event, "+'"'+'firstname'+'"'+")'>Nombre</div> <div style = 'float:left;'>/</div> <div class = 'tituloTabla' onclick = 'orden(event, "+'"'+'lastname'+'"'+")'>Apellido</div></td><td onclick = 'orden(event, "+'"'+'email'+'"'+")'>Dirección de correo</td><td onclick = 'orden(event, "+'"'+'city'+'"'+")'>Ciudad</td><td onclick = 'orden(event, "+'"'+'country'+'"'+")'>País</td><td onclick = 'orden(event, "+'"'+'lastaccess'+'"'+")'>Último acceso</td></tr>");
			
			$.each(apps, function(index, item){
				
				$("#lista").append("<tr class = 'eliminaTr'><td>"+ item.firstname +" / "+ item.lastname +"</td><td>"+ item.email +"</td><td>"+ item.city +"</td><td>"+ item.country +"</td><td>"+ item.lastaccess +"</td></tr>");
			
			});
			
			mostrarUsuarios();
			
		}
	);
	
}

//firstname
// lastname
// email
// city onclick = 'orden(event, "+'"'+'city'+'"'+")'
// country onclick = 'orden(event, "+'"'+'country'+'"'+")'
// lastaccess onclick = 'orden(event, "+'"'+'lastaccess'+'"'+")'
function orden(evt, tipoOrden){
	
	var titulos = document.getElementsByClassName('tituloTablaSel');
	
	for(i = 0;i<titulos.length;i++){
		
		titulos[i].style.fontWeight = "";
		
	}
	
	if(orderBy == "firstname" || orderBy == tipoOrden + " ASC"){
		
		orderBy = tipoOrden + " DESC";
		
	}else{
		
		orderBy = tipoOrden + " ASC";
		
	}
	
	filtraHojaUsuarios();
		
	evt.currentTarget.style.fontWeight = "bold";
	
	/*if(tipoOrden == orderBy) {
		
		
		
		orderBy = 'firstname';
	
		filtraHojaUsuarios();
		
		document.getElementById('firstname').style.fontWeight = "bold";
		
		
	}else{
		
		orderBy = tipoOrden + " ASC";
	
		filtraHojaUsuarios();
		
		evt.currentTarget.style.fontWeight = "bold";
	
	}*/
	
}

function mostrarUsuarios(){
	
	var numeroApps = registrosPorPagina;
	
	$("#pag_hojaUser").empty();
	
	
	for(i = ((pagSeccionHoja * 10) - 9);i<=(pagSeccionHoja*10);i++){

		if(i <= Math.ceil(totalUsuarios / numeroApps)){
			
			$("#pag_hojaUser").append("<div id = 'paginaHoja"+i+"' class='p_actnavnum' 'cursor:pointer;' onclick = 'cambiaHojaSeccion(" + i + ")'>"+i+"</div>");
		
		}
		
	}
	
	if(Math.ceil(totalUsuarios / numeroApps) > (pagSeccionHoja * 10)){
		
		$("#pag_hojaUser").append("<div class='p_actnavnum'>...</div>");
		
		$("#p_rightHojaUser").css({"opacity": "1", "cursor":"pointer"});
		
		$("#p_leftHojaUser").css({"opacity": "1", "cursor":"pointer"});
		
	}else{
		
		$("#p_leftHojaUser").css({"opacity": "1", "cursor":"pointer"});
		
		$("#p_rightHojaUser").css({"opacity": "0.3", "cursor":"default"});
		
		
	}
	
	if(pagSeccionHoja == 1){
		
		$("#p_leftHojaUser").css({"opacity": "0.5", "cursor-pointer":"default"});
		
	}
	
	$("#paginaHoja" + paginaHojaUsuario).attr("class", "p_actnavnum p_actnavnum_active");
	
}

function retrocedeSeccion(){
	
	if(pagSeccionHoja == 1){
		return;
	}
	
	pagSeccionHoja--;
	paginaHojaUsuario = ((pagSeccionHoja * 10) - 9);
	filtraHojaUsuarios();
	
	
}

function aumentaSeccion(){
	
	if (!(pagSeccionHoja < (Math.ceil(totalUsuarios / registrosPorPagina)) / 10)){
		return;
	}
	
	pagSeccionHoja++;
	paginaHojaUsuario = ((pagSeccionHoja * 10) - 9);
	filtraHojaUsuarios();
	
}

function cambiaHojaSeccion(indice){
	paginaHojaUsuario = indice;
	filtraHojaUsuarios();
}

var pagSeccionLog = 1;
function mostrarResultLog(){
	var numeroApps = registrosPorPaginaLog;
	
	$("#pag_logUser").empty();
	
	for(i = ((pagSeccionLog * 10)-9); i <= (pagSeccionLog*10) ;i++){
		
		if(i<= Math.ceil(totalRegistrosLog / numeroApps)){
			
			$("#pag_logUser").append("<div id =  'paginaLog"+i+"' class = 'p_actnavnum' onclick = 'cambiaLogSeccion(" + i + ")'>"+ i +"</div>");
			
		}
		
	}
	
	if(Math.ceil(totalRegistrosLog / numeroApps) > (pagSeccionLog * 10)){
		
		$("#pag_logUser").append("<div class='p_actnavnum'>...</div>");
		
		$("#p_rightLogUser").css({"opacity": "1", "cursor":"pointer"});
		
		$("#p_leftLogUser").css({"opacity": "1", "cursor":"pointer"});
		
		
	}else{
		
		$("#p_leftLogUser").css({"opacity": "1", "cursor":"pointer"});
		
		$("#p_rightLogUser").css({"opacity": "0.3", "cursor":"default"});
		
		
	}
	
	if(pagSeccionLog == 1){
		
		$("#p_leftLogUser").css({"opacity": "0.5", "cursor-pointer":"default"});
		
	}
	
	$("#paginaLog" + paginaLog).attr("class", "p_actnavnum p_actnavnum_active");
	
}

function cambiaLogSeccion(indice){
	
	paginaLog = indice;
	filtrarRegistros();
	
}

function retrocedeSeccionLog(){
	
	if(pagSeccionLog == 1){
		return;
	}
	
	pagSeccionLog--;
	paginaLog = ((pagSeccionLog * 10) - 9);
	filtrarRegistros();
	
}

function aumentaSeccionLog(){
	
	if (!(pagSeccionLog < (Math.ceil(totalRegistrosLog / registrosPorPaginaLog)) / 10)){
		return;
	}
	
	pagSeccionLog++;
	paginaLog = ((pagSeccionLog * 10) - 9);
	filtrarRegistros();
	
	
}

//Obtiene registros de log
function obtenerRegistrosLog(){
	
	$.get(
		IP + "Administracion/obtenerUsuariosActivos",
		function(data){
			result = JSON.parse(data);
			$("#participantes").empty();
				$("#participantes").append("<option>Todos</option>");
				$("#participantes").append("<option>guest</option>");
			$.each(result, function(index, item){
				
				$("#participantes").append("<option>"+item.username+"</option>");
				
			});
		}
	);
	
	$("#resultadoListaUsuarios").hide();
	$("#resultadoRegistrosLog").show();
}

function openTab(evt, tabName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
	
    for (i = 0; i < tabcontent.length; i++) {
		
        tabcontent[i].style.display = "none";
		
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
	
    for (i = 0; i < tablinks.length; i++) {
		
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    
	}

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(tabName).style.display = "block";
	evt.currentTarget.className += " active";
	
	switch(tabName){
		case "hojear_usuarios":
			listaUsuarios();
		break;
		case "registros":
			obtenerRegistrosLog();
		break;
	}
}


function selectAllDias(bandera){
	
	var inptDate = document.getElementById('fechaBus');
	
	
	if(bandera){
		
		inptDate.setAttribute("disabled", true);
		
	}else{
		
		inptDate.removeAttribute("disabled");
		
	}
	
}

var totalRegistrosLog = 0;
var paginaLog = 1;
var registrosPorPaginaLog = 10;
function filtrarRegistros(){
	
	var inptDias = document.getElementById('todasDias');//.checked;
	var inptFecha = document.getElementById('fechaBus');//.value;//cadena: dd//mm/aaaa
	var inptAcciones = document.getElementById('acciones');//.value;
	var inptUsuarios = document.getElementById('participantes');
	
	if(!inptDias.checked && inptFecha.value == "dd-mm-yyyy"){//Selecciono todas las fechas
		
		alert("Selecciona una fecha o todos los dias.");
		return;
		
	}
	var inicioHoja = paginaLog;
	
	if(inicioHoja == 1){
		
		inicioHoja = 0;
		
	}else{
		
		inicioHoja = (paginaLog * registrosPorPaginaLog) - registrosPorPaginaLog;
		
	}
	
	$.post(
		IP + "Administracion/conseguirRegistros",
		{
			inicio: inicioHoja,
			fin: registrosPorPaginaLog,
			fecha: (!inptDias.checked)?inptFecha.value:"todos",
			acciones: inptAcciones.value,
			usuarios: inptUsuarios.value
			
		},
		function(data){
			result = JSON.parse(data);
			totalRegistrosLog = result.total;
			$(".eliminaTrLog").remove();
			$.each(result.apps, function(index, item){
				
				$("#registrosLog").append("<tr class = 'eliminaTrLog'><td>"+item.time+"</td><td>"+item.ip+"</td><td>"+item.firstname+" "+item.lastname+"</td><td>"+item.action+"</td><td>"+item.info.replace(new RegExp(">","g") ,"<br>")+"</td><td>"+item.dispositivo+"</td></tr>");
				
			});
			mostrarResultLog();
		}
	);
	$("#registrosLog, #indiceHoja").show();
	
}

var sectionSelected = "";
function seleccionaItem(id){
	//Se selecciona el que ya esta abierto
	if(id == sectionSelected){
		$("#txtConfiguracion").text("Configuración +");
        $("#txtInformes").text("Informes +");
		if(id == "conteConfig"){
			//alert($("#second_config").hasClass("p_oculta"))
			if(!$("#second_config").hasClass("p_oculta")){
				try{
				
					appsSalvar = new Array();

					
					$(".p_act3box").each(function(index, item){
					
						appsSalvar.push({"nombre":$(item).find(".p_recienteboxtxt").text(), "prefijo":$(item).attr("id")});
					
					});
					
					if(!equals()){
						
						confirma = confirm("No has guardado cambios, ¿Deseas salir?");
						
						if(!confirma)return false;
						
						appsMoverBorrar = {};
						appsGuardar = {};
						appsSeleccionadas = {};
						appsEliminar = {};
						desactivarBtn("#moveL, #moveR, #trash");
						
					}
						
				}catch(e){
					
				}
			}
			tipoDemo = null;
		
			$("#second_config").addClass("p_oculta");
			
			
			
		}
		
		
		
		$("#" + id).hide(300);
		
		$(".p_footer").addClass("p_oculta");
		
		sectionSelected = "";
		
		return;
		
	}else{
		
		//if(id == "conteInfo"){
			//alert($("#second_config").hasClass("p_oculta"))
			
			if(!$("#second_config").hasClass("p_oculta")){//Esta visible actividades para configuración
				
				
		
				
				try{
				
					appsSalvar = new Array();

					
					$(".p_act3box").each(function(index, item){
					
						appsSalvar.push({"nombre":$(item).find(".p_recienteboxtxt").text(), "prefijo":$(item).attr("id")});
					
					});
					
					if(!equals()){
						
						confirma = confirm("No has guardado cambios, ¿Deseas salir?");
						
						if(!confirma)return false;
						
						appsMoverBorrar = {};
						appsGuardar = {};
						appsSeleccionadas = {};
						appsEliminar = {};
						desactivarBtn("#moveL, #moveR, #trash");
						
					}
						
				}catch(e){
					
				}
			}
			
			$(".tablinks").removeClass("active");
			$(".tabcontent, #registrosLog, #indiceHoja").hide();
			tipoDemo = null;
		
			$("#second_config").addClass("p_oculta");
			
			
		//}
		
	}
    if(id == "conteInfo"){
        $("#txtConfiguracion").text("Configuración +");

        $("#txtInformes").text("Informes -");
        
    }else{
        
        $("#txtConfiguracion").text("Configuración -");
        
        $("#txtInformes").text("Informes +");
        
    }
    /*if($("#conteConfig").css("display") == "none"){//No Visible configuración
                
				$("#txtConfiguracion").text("Configuración -");
				
				$("#txtInformes").text("Informes +");
                
    }else{

        $("#txtConfiguracion").text("Configuración +");

        $("#txtInformes").text("Informes -");

    }*/
	
	$("#conteConfig, #conteInfo").hide(300);
	
	$("#" + id).show(300);
	
	sectionSelected = id;
}
