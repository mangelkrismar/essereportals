//var altoNavegacion;
function verSeccion(objeto){
	/*Transición entre las principales secciones de la pagina*/
	seccion = $("#" + objeto.attr("name"));
	if($("#actividades").css("display") == "block"){
		//limpiarFiltros();
		bandActUser = false;
		limpiarFiltros();
		$("#busca_cierra_apps").removeClass("p_closericon");
		$("#iconregresar, #actividades").addClass("bounceOutRight");
		$("#cargarApps").find(".p_switch").addClass("bounceOutRight");
		setTimeout(function(){
			$("#temas, #grados, #reciente").show().removeClass("p_oculta").addClass("bounceInLeft");
			$("#iconregresar, #actividades").hide().removeClass("bounceOutRight");
			$("#cargarApps").find(".p_switch").hide().removeClass("bounceOutRight");
			setTimeout(function(){
				$("#temas, #grados, #reciente").removeClass("bounceInLeft");
				$("#iconregresar, #actividades").removeClass("p_oculta");
				ocultaMenuAnimado(function(){
					$("body").stop().animate({scrollTop: seccion.offset().top - (altoNavegacion + 20)},500, "linear")
				});
			}, 800);
		}, 800);
	}else{
		ocultaMenuAnimado(function(){$("body").stop().animate({scrollTop: seccion.offset().top - (altoNavegacion + 20)},500, "linear")});
	}
}
function muestraLecturas(){
	if(objetoFiltros.materia == "lec" && $("#actividades").css("display") != "none" ){
		ocultaMenuAnimado();
		$("body").stop().animate({
				scrollTop: $("#buscar").offset().top - (altoNavegacion + 20)
		}, 500, "linear")
	}else{
		ocultaMenuAnimado();
		muestraApps();
		delete objetoFiltros.materia;
		seleccionaFiltroMateria('lec');
	}
}
function muestraApps(callback){
	bandActUser = true;
	if($("#cargarApps").find("#actividades").css("display") == "none"){
		$("#busca_cierra_apps").find(".circleLupa").addClass("transitLupa");
		$("#busca_cierra_apps").find(".mangoLupa").addClass("transitMango");
		if($("#cargarApps").find(".p_switch").length != 0){//Existe el botón de filtro de dispositivo
			muestraIntroApps(function(){
				$("#cargarApps").find(".p_switch").removeClass("bounceInLeft");
				$("body").stop().animate({scrollTop: $("#buscar").offset().top - (altoNavegacion + 20)}, 500);
			});
		}else{//No existe el filtro de dispositivo (abierta desde un móvil o tableta)
			muestraIntroApps();
		}
		function muestraIntroApps(callback){
			$(".p_act4box").remove();
			$("#not_app, #load_app").hide();
			$("#load_app").css("height","424px").show();
			$("#temas, #grados, #reciente").addClass("bounceOutRight");
			setTimeout(function(){
				$("#temas, #grados, #reciente").hide();
				$("#temas, #grados, #reciente").removeClass("bounceOutRight");
				if($("#cargarApps").find(".p_switch").length != 0){
					$("#cargarApps").find(".p_switch").show().addClass("bounceInLeft");
				}
				$("#cargarApps").find("#actividades").show().addClass("bounceInLeft");
				$("#iconregresar").show().addClass("bounceInLeft");
				setTimeout(function(){
					$("#cargarApps").find("#actividades").removeClass("bounceInLeft");
					var totalAtributos = Object.keys(objetoFiltros).length;
					if(totalAtributos == 1){
						try{
							filtrarAppsSql();
						}catch(e){
						}
					}
					if(callback)callback();
				}, 800);
			}, 800)
		}
	}else{
		$("body").stop().animate({
			scrollTop: $("#buscar").offset().top - (altoNavegacion + 20)
		},500, "linear");
	}
}
function regresarMenu(){
	limpiarFiltros();
	$("#busca_cierra_apps").find(".circleLupa").removeClass("transitLupa");
	$("#busca_cierra_apps").find(".mangoLupa").removeClass("transitMango");
	$("#iconregresar, #actividades").addClass("bounceOutRight");
	$("#cargarApps").find(".p_switch").addClass("bounceOutRight");
	setTimeout(function(){
		$("#temas, #grados, #reciente").show().removeClass("p_oculta").addClass("bounceInLeft");
		$("#iconregresar, #actividades").hide().removeClass("bounceOutRight");
		$("#cargarApps").find(".p_switch").hide().removeClass("bounceOutRight");
		setTimeout(function(){
			$("#temas, #grados, #reciente").removeClass("bounceInLeft");
			$("#iconregresar, #actividades").removeClass("p_oculta");
		}, 800);
	}, 800);
	bandActUser = false;
}
$(document).ready(function(){
	user = true;
	altoNavegacion = $(".p_navsup").height()+50;
	if($(".p_configicon").length){//Configuración
		$(".p_ingresaradmin, .p_configiconcontent").click(function(){
			bandConf = false;
			if($("#section_1").hasClass("p_oculta")){//oculta la admin
				$(".hiddenFlag1").remove();
				$('.p_navsupinbtn').stop().animate({"color":"#f2f2f2"}, 100);
				$('.p_navsupinbtn.p_in'+(2)).stop().animate({"color":"#f1db0c"}, 100);
				$("#txtConfiguracion").text("Configuración +");
                $("#txtInformes").text("Informes +");
				// aqui validacion para avisar que guarde antes de salir
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
						appsDemo= [];
						appsSalvar = [];
						$(".p_act3box").remove();
						desactivarBtn("#moveL, #moveR, #trash");
					}
				}catch(e){
				}
				try{
					tipoDemo = null;
					appsSeleccionadas = {};
				}catch(e){
					console.log("¡warning, demo undefined!");
				}
				$("#section_2").addClass("bounceOutRight");
				setTimeout(function(){
					$("#section_2").addClass("p_oculta");
					$("#section_2").removeClass("bounceOutRight");
					$("#section_1").removeClass("p_oculta");
					$("#section_1").addClass("bounceInLeft");
					$(".p_footer").removeClass("p_oculta");
					setTimeout(function(){
						$("#section_1").removeClass("bounceInLeft");
					}, 800);
				}, 800);
				$(".tablinks").removeClass("active");
				$(".tabcontent, #conteInfo, #conteConfig, #registrosLog, #indiceHoja").hide();
				try{
					sectionSelected = "";
				}catch(e){
				}
			}else{
				$('.p_navsupinbtn').stop().animate({"color":"#f2f2f2"}, 100);
				$("body").append("<input type='hidden' class='hiddenFlag1' value=1>");
				$("#section_1").addClass("bounceOutRight");
				$("#second_config").removeClass("bounceInLeft");
				$("#second_config").addClass("p_oculta");
				setTimeout(function(){
					$("#section_1").addClass("p_oculta");
					$("#section_1").removeClass("bounceOutRight");
					$("#section_2").removeClass("p_oculta");
					$("#section_2").addClass("bounceInLeft");
					$(".p_footer").addClass("p_oculta");
					setTimeout(function(){
						$("#section_2").removeClass("bounceInLeft");
					}, 800);
				}, 800);
			}
		});
	}
	appReciente = $(".p_recientebox").size();
	masReciente();
});
function cerrarSesion(){
    /*
    * NOMBRE: cerrarSesion
    * UTILIDAD: Cierra sesión.
    * ENTRADAS: Ninguna.
    * SALIDAS: Ninguna.
    * VARIABLES: Ninguna.
    */
	request = $.ajax({
        url : IP+"Login/cerrarSesion",
        type : "POST"
    });
	request.done(function(response){
		$(".p_emerclose").hide();
		$(".p_emergenteusuario").fadeIn();
		$(".p_emerboxbienvenido").css({"display":"table"});
		$(".p_emerboxbienvenido").css("background-image", "url(src/img/p_emergentefondo.png)");
        $(".p_emerfrasesalir").css("background-image", "url(src/img/p_emergentefrasesalir.png)");
		colocaEmergente('noFiltra');
		setTimeout(function(){
			$(".p_emergenteusuario").fadeOut(1500);
			setTimeout(function(){
				location.reload();
			}, 0);
		},500);
    });
}
/*************Configura información usuario************/
function muestraEmergente(obj, callback){
	$(".p_emerboxconte").hide();
	$(".p_emergenteusuario").fadeIn(function(){
		obj.fadeIn(function(){$(this).css("display", "table")});
		if(callback)callback();
	});
}
function configuraInformacion(){
	muestraEmergente($("#informacion_usuario"), function(){
		recuperaDatosUsuario();
		colocaEmergente('noFiltra');
	});
}
function recuperaEditaDatosUsuario(callback){
	if(callback == 1){
		$("#edita_info").load(IP+"Home/recuperarEditarDatosUsuario/"+callback, function(){
			colocaEmergente('noFiltra');
		});
	}else{
		$("#edita_info").load(IP+"Home/recuperarEditarDatosUsuario", function(){
			colocaEmergente('noFiltra');
		});
	}
}
function recuperaDatosUsuario()
{
	$("#informacion_usuario").load(IP+"Home/recuperaDatosUsuario",function(){
		colocaEmergente('noFiltra');
	});
}
function muestraPass(valor, id){
	$("#psw_" + id).attr("type", valor?"text":"password");
}
function coincidePsw(){
	if($("#psw_nueva").val() == "" || $("#psw_confirma").val() == ""){
		$("#msjPsw").text("");
		return true;
	}
	$("#msjPsw").text(($("#psw_nueva").val() == $("#psw_confirma").val())?"Listo":"Las contraseñas no coinciden");
}
function validaPsw(){
	if($("#psw_actual").val() != "" && $("#psw_nueva").val() != "" && $("#psw_confirma").val() != ""){
		if($("#psw_nueva").val() != $("#psw_confirma").val()){
			$("#msj_psw").text("Las contraseñas no coinciden");
			$("#psw_confirma").focus().css("outline-color", "red");
			return false;
		}
	}else{
		$("#msj_psw").text("Debes llenar todos los campos.");
		$("#form_cambia_pass").find(".p_emerdatosinput").each(function(){
			if($(this).val() == ""){
				$(this).focus().css("outline-color", "red");
				return false;
			}else{
				$(this).removeAttr("style");
			}
		});
		return false;
	}
	return true;
}
function cambiarPass(){
	if(validaPsw()){
		request = $.ajax({
			data: $("#form_cambia_pass").serialize(),
			url : IP+"Home/cambiarPass",
			type : "POST",
			before: function(){
				$("#msj_psw").text("Guardando...");
			}
		});
		request.done(function(response){
			notificaPsw(response)
		});
	}
}
function notificaPsw(response){
	$("#form_cambia_pass").find(".p_emerdatosinput").removeAttr("style");
	$("#msj_psw").text(response.split("/")[0]);
	$("#" + response.split("/")[1]).focus().css("outline-color", "red");
	if(response.split("/").length == 1){
		setTimeout(function(){location.reload()}, 2000);
		cerrarEmergentes(5000);
		$(".p_emergenteclose, .p_emerclose, .p_emerbtnin").removeAttr("onclick");
	}
}
function guardarInfoUser(event){
	event.preventDefault();
	var formData = new FormData($("#datoseditauser")[0]);
	request = $.ajax({
		data: formData,
		url : IP+"Home/editarUser",
		type : "POST",
		contentType: false,
		processData: false,
		before: function(){
			$("#msg_guarda").text("GUARDANDO");
		}
	});
	request.done(function(response){
		notificaInfo(response);
		$("#btnguardauser").text("GUARDAR");
	});
	request.fail(function(){
		$("#msg_guarda").html("<div>No se ha guardado la información, revisa los siguientes aspectos:</div><div>La imagen no debe pesar más de 24MB.</div><div>Conexión a internet.</div>");
	});
}
function notificaInfo(response){
	$("#datoseditauser").find("input").removeAttr("style");
	if(response.split("/").length == 2){
		$("#msj_info").text(response.split("/")[0]);
		$("input[name = " + response.split("/")[1]+"]").focus().css("outline-color", "red");
	}else{
		recuperaEditaDatosUsuario(1);
	}
}
function muestraIngresar(mensaje){
	/*
	* NOMBRE: muestraIngresar
	* UTILIDAD: Muestra div emergente.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	* VARIABLES: Ninguna.
	*/
	$("#entrar").val("ENTRAR");
	$(".p_emerboxbienvenido").hide();
	if(mensaje){
	  $(".p_emeralerta").text(mensaje);
	}else{
	  $(".p_emeralerta").text("");
	}
	$(".p_emergenteusuario").fadeIn();
	$($(".p_emerboxconte")[$(".p_emerboxconte").length-1]).css({"display":"table"});
    $("#name").focus();
    colocaEmergente();
}
$(document).on("click", "#exitformfil1", function(e){
	event.preventDefault();
	if($('#email').val().match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)){
		var request;//Guarda ajax
		request = $.ajax({
			url : IP+"home/keepEmail",
			type : "POST",
			data : {"email":$('#email').val()}
		}).done(function(response, textStatus, jqXHR){
	        $(".p_emerboxconte").hide();
			cerrarSesion();
		});
	}
})
$(document).on("click", "#exitformfil2", function(e){
	$(".p_emerboxconte").hide();
	cerrarSesion();
})
function mostrarCerrarSesion(){
	$(".p_emergenteusuario").fadeIn();
	$($(".p_emerboxconte")[$(".p_emerboxconte").length-2]).css({"display":"table"});
    colocaEmergente();
}
