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
		}, 800)
		
		/*
		$("#iconregresar, #actividades").fadeOut(250, function(){
			$("#temas, #grados").fadeIn(250,function(){
				$(".p_switch").hide();
				ocultaMenuAnimado(function(){
					$("body").stop().animate({scrollTop: seccion.offset().top - (altoNavegacion + 20)},500, "linear")
				});
			})
		});
		*/
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
		//$("#busca_cierra_apps").addClass("p_closericon");
		
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
	//$("#busca_cierra_apps").removeClass("p_closericon");
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
	/*$("#iconregresar, #actividades").fadeOut(250,function() {
		
		$("#temas, #grados").fadeIn(250,function(){
			
			$(".p_switch").hide();
			
			//$("body").stop().animate({scrollTop: 0}, 500, "linear");
			
		});
		
	});
	*/
	bandActUser = false;
}

$(window).load(function(){
	/*$("#cargarApps").load( IP + "capps");
	
	$("#cargarReciente").load(IP + "Creciente");*/
	 //Mensaje renovación licencia
    var diasR = document.getElementsByClassName("diasR")[0];
    if(!isNaN(diasR.innerHTML)){//Es número
      
        if(Number(diasR.innerHTML) <= 10){

            if(Number(diasR.innerHTML) == 0){
                msj = "Hoy es el último día para renovar tu licencia, renuévala en:";
            }else{
                msj = "Tienes "+ 
                diasR.innerHTML+" día"+((Number(diasR.innerHTML) == 1) ? "": "s")
                + " para renovar tu licencia, renuévala en:"
            }
            
            
            $("#msjDiasR").text(msj);
            
            setTimeout(function(){
                $(".p_avisolicencia").animate({"bottom": "0px"}, 500);     
            }, 500);
        }
    }
});

$(document).ready(function(){
	
	// var utcSeconds = 1506373425;
	// var d = new Date(0); // The 0 there is the key, which sets the date to the epoch
	// d.setUTCSeconds(utcSeconds);
	
	
	
	user = true;
	altoNavegacion = $(".p_navsup").height()+50;//Altura de la barra de navegación mas 50 de p_headersmall.
	
	//$("#cargarApps").load( IP + "capps");
	
	//$("#cargarReciente").load(IP + "Creciente");
	
	if($(".p_configicon").length){//Configuración
		
		$(".p_ingresaradmin, .p_configiconcontent").click(function(){
			bandConf = false;
			if($("#section_1").hasClass("p_oculta")){//oculta la admin
				$("#txtConfiguracion").text("Configuración +");
        
                $("#txtInformes").text("Informes +");
				// aqui validacion para avisar que guarde antes de salir
				try{
					
					/*if(Object.keys(appsSeleccionadas).length > 0){
						
						confirma = confirm("Seleccionaste aplicaciones para agregar, ¿Deseas salir?");
						if(!confirma)return;
						
					}*/
					
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
					//limpiaFiltrosAdmin();
					
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
						//filtrarAppsSql();
						
					}, 800);
				
				}, 800);
				$(".tablinks").removeClass("active");
				$(".tabcontent, #conteInfo, #conteConfig, #registrosLog, #indiceHoja").hide();
				
				try{
					sectionSelected = "";
				}catch(e){
					
				}
			}else{
				
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

	/*PARA PDF SECUNDARIA */
    secusername = localStorage.getItem('secusername');
    var json = {
        'origin': IP,
        'secusername': secusername
    };
    window.parent.postMessage(JSON.stringify(json), '*'); 
});

/*function cerrarSesion(){
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

		},1500);
    });
	
	
}*/

/*    GOOGLE AUTH     */
function googleSignOut() {
	/*
    * NOMBRE: googleSignOut
    * UTILIDAD: Cierra sesión de Google y el localStorage.
    * ENTRADAS: Ninguna.
    * SALIDAS: Ninguna.
    * VARIABLES: Ninguna.
    */
	gapi.auth2.getAuthInstance().signOut().then(function () {
            gapi.auth2.getAuthInstance().disconnect();
        });
	localStorage.setItem("ses", '0');
}
/*                 */

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

		$(".p_emerboxbienvenido").css("background-image", randomBienvenido());
        $(".p_emerfrasesalir").css("background-image", "url(src/img/p_emergentefrasesalir.png)");
		colocaEmergente('noFiltra');
		/*    GOOGLE AUTH     */
		//googleSignOut();
		/*                   */
		setTimeout(function(){

			$(".p_emergenteusuario").fadeOut(1500);
			setTimeout(function(){
				location.reload();
			}, 0);

		},1500);

		/*PARA PDF SECUNDARIA*/
		localStorage.removeItem("secusername"); //Remover el nombre de usuario del localStorage al cerra sesión
    });
	
	//$("#log").attr("src",IPSRC+"index.php/inicio/restartIntro/primaria");
	
}
/*
function muestraLibros(){
	
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
								
								listaIn += '<a onclick = "insertaLogLink('+"'"+tituloIn.replace('.pdf', '')+"'"+')" class = "submenu" target = "_blank" href = "'+IP+'src/extra/'+grado+'/'+titulo+'/'+tituloIn+'"><ul>'+tituloIn.replace('.pdf', '')+'</ul></a>';
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
	
	/*request = $.ajax({
		data: {idUser : $("#rel_user").val()},
        url : IP+"Home/recuperaEditaDatosUsuario",
        type : "POST"
    });
	request.done(function(response){
		//$(".p_emertable").empty().append(response);
		colocaEmergente();
    });*/
}

function recuperaDatosUsuario()
{	
	$("#informacion_usuario").load(IP+"Home/recuperaDatosUsuario",function(){
		colocaEmergente('noFiltra');
	});
	
	/*request = $.ajax({
		data: {idUser : $("#rel_user").val()},
        url : IP+"Home/recuperaDatosUsuario",
        type : "POST"
    });
	request.done(function(response){
		$(".p_emertable").empty().append(response);
		colocaEmergente();
    });*/
	
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
	//console.log(response.split("/"))
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
		//data: $("#datoseditauser").serialize(),
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
		//muestraEmergente($('#edita_info'), recuperaEditaDatosUsuario);
		
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
    
    
	/*$("#name").val("Supervisor");
	$("#password").val("123");*/
}

$(document).on("click", "#entrar", function(e){
	/*
  * NOMBRE: Función anónima.
  * UTILIDAD: Realiza login a traves de ajax.
  * ENTRADAS: e, event.
  * SALIDAS: Ninguna.
  * VARIABLES */
    var request;//Guarda ajax
    $(":input").blur();
  /***********/
	if(request){
		request.abort();
	}
	request = $.ajax({
		url : IP+"login/checkUser",
		type : "POST",
		data : $("#formLogin").serialize(),
        beforeSend:function(){
            $("#entrar").val("VALIDANDO...")
        }
	});
	request.done(function(response, textStatus, jqXHR){
		
        //Siempre recibirá una cadena JSON
        var responseJSON = JSON.parse(response);
        compruebaAcceso(responseJSON);
        
        
        
		/*if(response == "1"){
			compruebaAcceso(true);
		}else{
			compruebaAcceso(response);
            $("#entrar").val("ENTRAR")
		}*/
	});

	request.fail(function(response, jqXHR, textStatus, thrown){
		
		console.log("Response: "+response+", Error: "+jqXHR+", textStatus: "+textStatus+", thrown: "+thrown);
		$("#entrar").val("ENTRAR");
	});

	/*request.always(function(){
		console.log("Funcionando ajax");
	});*/
	e.preventDefault();

})

function compruebaAcceso(valor){
    /*
    * NOMBRE: accesoCorrecto
    * UTILIDAD: Muestra mensaje de Bienvenida.
    * ENTRADAS: Ninguna.
    * SALIDAS: Ninguna.
    * VARIABLES: Ninguna.
    */
    if(valor.acces){
        $(".p_emerfrasetxtdias").html('Días restantes: <span class = "diasR">'+valor.msj+'</span>');
        $("#name_usuario").text($("#name").val());
        $(".p_emerclose").hide();
        //$(".p_emerbox").addClass("bounceOut");
        $(".p_emerbox").fadeOut(250, function(){
        	$(".p_emerboxconte").hide();
        	$(".p_emerboxbienvenido").show();
        	$(".p_emerboxbienvenido").css("background-image", randomBienvenido());
        	$(".p_emerfrase").css("background-image", "url(src/img/p_emergentefrase.png)");
        	$(".p_emerboxbienvenido").parent().fadeIn(250, function(){
        		$(".p_emergenteclose").attr("onclick", 'location.reload();');
        		$(".p_emergenteusuario").fadeOut(3500);
        		//No se agrega un metta para refresh porque cambia de tamaño los elementos en moviles
        		if($("#name_usuario").text() != $("table.p_ingresarname td").text()){
        			setTimeout(function(){ location.reload(); }, 1500);
        		}
        	});
        });
    }else{
        $(".p_emeralerta").text(valor.msj);
        
        if(valor.msj.indexOf("Contraseña") != -1){
            $("#password").focus();
        }else{
            $("#name").focus();
        }
        $("#entrar").val("ENTRAR");
    }
}

function randomBienvenido(){
	let list = ["p_emergentefondo_graphos1.png","p_emergentefondo_graphos2.png", "p_emergentefondo_orthos1.png", "p_emergentefondo_orthos2.png"];
	return `url(src/img/${list[Math.floor(Math.random() * list.length)]})`;
}

$(function() {
    $(".p_emerboxbienvenido").show();
});

$(document).on("click", "#exitformfil1", function(e){
	e.preventDefault();
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
	$(".p_emerboxconte").hide(0);
	$(".p_emerboxbienvenido").hide(0);
	$(".p_emergenteusuario").fadeIn();
	$($(".p_emerboxconte")[$(".p_emerboxconte").length-2]).css({"display":"table"});
    colocaEmergente();
}