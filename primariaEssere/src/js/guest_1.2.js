/*    GOOGLE AUTH     */
let GAprofile = null;
let GAtoken = null;
/*                  */

let eCU = 0;   //Para el cambio de usuario

function estilosFocus(){
    if(disp == "movil"){
        setTimeout(function(){
            colocaEmergente();
        }, 1000);
    }
}

$(document).ready(function(){
    $(".p_temasbox, .p_gradosbox").click(function(){
        muestraIngresar("INGRESA PARA CONOCER A TODAS LAS ACTIVIDADES");
    }).css("cursor", "pointer");
    bloqueaSubtemas();
    bandGuest = true;
	$("#name, #password").attr("onfocus", "estilosFocus()");
	//$("#conoce").load(IP+"ConoceApps");
});

//Se valida el usuario
function ValUser(string){//solo letras y numeros
    var out = '';
    //Se añaden las letras validas
    var filtro = 'abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ1234567890@$.-_';//Caracteres validos
	
    for (var i=0; i<string.length; i++)
       if (filtro.indexOf(string.charAt(i)) != -1) 
	     out += string.charAt(i);
    return out;
}

//Se valida la contraseña
function ValPass(string){//solo letras y numeros
    var out = '';
    //Se añaden las letras validas
    var filtro = 'abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ1234567890@&$#_-*+().{}[]?¿¡!%=';//Caracteres validos
	
    for (var i=0; i<string.length; i++)
       if (filtro.indexOf(string.charAt(i)) != -1) 
	     out += string.charAt(i);
    return out;
}

function bloqueaSubtemas(){
    /*
    * NOMBRE: bloqueaSubtemas
    * UTILIDAD: Bloquea la barra de subtemas.
    * ENTRADAS: Ninguna.
    * SALIDAS: Ninguna.
    * VARIABLES: Ninguna.
    */
    //$(".contenido, .maskrismar, .britannica, .p_menulist").css({"cursor":"default","opacity":"0.5"});
    //$("[name = 'reciente'],.britannica,.maskrismar").css({"cursor":"pointer","opacity":"0.5"});
    $("[name = 'reciente'],.britannica, [name = 'docente']").css({"cursor":"pointer","opacity":"0.5"});
    
    
    //$("[name = 'reciente'], .maskrismar, .britannica").click(function(){
    $("[name = 'reciente'], .britannica, [name = 'docente']").click(function(){
        
        muestraIngresar("INGRESA PARA CONOCER A TODAS LAS ACTIVIDADES");
        
    }).css("cursor", "pointer");
    
    //$(".maskrismar:gt(1)").css({"cursor":"pointer","opacity":"1"}).off('click');
    //$(".maskrismar.krismarpage").css({"cursor":"pointer","opacity":"1"}).off('click');
} 

function muestraContraseniaOlvidada(mensaje){
	/*
	* NOMBRE: muestraContraseniaOlvidada
	* UTILIDAD: Muestra div emergente.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	* VARIABLES: Ninguna.
	*/
	$(".p_emerboxconte").hide(0);
	if(mensaje){
	  $(".p_emeralerta").text(mensaje);
	}else{
	  $(".p_emeralerta").text("");
	}
	$(".p_emergenteusuario").fadeIn();
	$($(".p_emerboxconte")[1]).css({"display":"table"});
	
    $("#name").focus();
    colocaEmergente();
}

function muestraIngresar(mensaje){
	/*
	* NOMBRE: muestraIngresar
	* UTILIDAD: Muestra div emergente.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	* VARIABLES: Ninguna.
	*/
    $(".p_emergenteusuario").fadeIn();
    colocaEmergente();
    
    var request;//Guarda ajax
    $(":input").blur();
  /***********/
	if(request){
		request.abort();
	}
	request = $.ajax({
		url : IP+"login/checkUser",
		type : "POST"
	});
	request.done(function(response, textStatus, jqXHR){
        var responseJSON = JSON.parse(response);
        compruebaAcceso(responseJSON);
	});
	request.fail(function(response, jqXHR, textStatus, thrown){
		console.log("Response: "+response+", Error: "+jqXHR+", textStatus: "+textStatus+", thrown: "+thrown);
		$("#entrar").val("ENTRAR");
	});
}

//Para mostrar el cuadro de comprar
function muestraComprar(mensaje){
    /*
    * NOMBRE: muestraComprar
    * UTILIDAD: Muestra div emergente.
    * ENTRADAS: Ninguna.
    * SALIDAS: Ninguna.
    * VARIABLES: Ninguna.
    */
    $(".p_emerboxconte").hide(0);
    if(mensaje){
      $(".p_emeralerta").text(mensaje);
    }else{
      $(".p_emeralerta").text("");
    }
    $(".p_emergenteusuario").fadeIn();
    $($(".p_emerboxconte")[4]).css({"display":"table"});
    
	//alert(IP);
	
	/*****************/
	var parametros = {
		"portal" : 'primaria',
		"region": 'mx'
	};
	//alert(parametros['region']);
	
	$.ajax({
		type: 'POST',
		data: parametros,
		cache: false,
		url: IP+'muestraPro.php',
		success: function(data){
			//alert(data);
			// Se pasa el string a un objeto JSON
			var json = JSON.parse(data);
			//alert(json.cbox);
			/*var str = json.idP;
			var res = str.replace("+", "$s$");*/
			
			switch(String(json.status)){
				case '-1':
				case '0':
					alert('Se recargará la página porque '+json.result);
					//window.open('https://www.krismar-educa.com.mx/primariaLat','_self');
					break;
				case '1':
					$('#gradoCompra').html("");	
					$('#gradoCompra').html(json.cbox);					
					/*$("#costo").text('$ '+json.precio+' '+json.moneda);
					$("#correoCompra").val("");
					$("#correoCompra").focus();
					$("#idPro").val(res);*/
					
					break;
			}
			//alert(data);			
			//window.open('https://www.krismar.com.mx', '_blank');
		},
		error: function(data){
			//Cuando la interacción retorne un error, se ejecutará esto.
			alert("Error de conexión, favor de verificar...");
		}
	});
	
	
	
    $("#correoCompra").focus();
	$("#correoCompra").val("");
	document.getElementById("cProducto").innerHTML  = "";
	//$('#cProducto').innerHTML = "";
    colocaEmergente();

}

function doIngresa(valor){
	$(".p_emerfrasetxtdias").html('Días restantes: <span class = "diasR">'+valor+'</span>');
        $("#name_usuario").text($("#name").val());
        $(".p_emerclose").hide();
        //$(".p_emerbox").addClass("bounceOut");
        $(".p_emerbox").fadeOut(250, function(){
            $(".p_emerboxconte").hide();
            $(".p_emerboxbienvenido").show();
            $(".p_emerboxbienvenido").css("background-image", "url(src/img/p_emergentefondo.png)");
            $(".p_emerfrase").css("background-image", "url(src/img/p_emergentefrase.png)");

            $(".p_emerboxbienvenido").parent().fadeIn(250, function(){
                $(".p_emergenteclose").attr("onclick", 'location.reload();');
                $(".p_emergenteusuario").fadeOut(500);
                //No se agrega un metta para refresh porque cambia de tamaño los elementos en moviles
                setTimeout(function(){
                    location.reload();
                }, 500);
                
            });
        });
}

function muestraCambiarUsuario(mensaje){
	/*
	* NOMBRE: muestraCambiarUsuario
	* UTILIDAD: Muestra div emergente.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	* VARIABLES: Ninguna.
	*/

	eCU = 1;

	$(".p_emerboxconte").hide();
	if(mensaje){
	  $(".p_emeralerta").text(mensaje);
	}else{
	  $(".p_emeralerta").text("");
	}
	$(".p_emergenteusuario").fadeIn();
	$($(".p_emerboxconte")[5]).css({"display":"table"});
    $("#name").focus();
    colocaEmergente();
}

function cerrarEmergentesCU(){
	/*
	* NOMBRE: cerrarEmergentes
	* UTILIDAD: Cierra div emergente.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
	* VARIABLES: Ninguna.
	*/
	/*$(".p_emergenteusuario").fadeOut(300,function(){
		$("p_emergenteusuario, .p_emerboxconte").removeAttr("style");
	});
	bandInfo = false;*/
    if(eCU){
        eCU = 0;
        doIngresa(365);
    }else{
        cerrarEmergentes();
    }
    
}

$(document).on("click", "#cambiarUsuario", function(e){
	/*
  * NOMBRE: Función anónima.
  * UTILIDAD: Realiza el cambio de usuario a traves de ajax.
  * ENTRADAS: e, event.
  * SALIDAS: Ninguna.
  * VARIABLES */

	let pval = validaCambioUser();

	/******************************** */
	if(pval){
        $.ajax({
            type: 'POST',
            data: $("#formChangeUser").serialize(),
            cache: false,
            url: IP+'login/changeUser',
            success: function(data){
                var json = JSON.parse(data);
                
                if(json.success){
                                       
                    /********************** */
                    var parametros = {
                        "portal" : 'Primaria',
                        "region": 'mx',
                        "correo": json.correoe,
                        "usuario": json.usere,
                        "usuarioold": json.userold,
                        "clave": json.clavee,
                        "keyAPI": json.keyAPI
                    };

                    $.ajax({
                        type: 'POST',
                        data: parametros,
                        cache: false,
                        url: 'https://www.krismar.com.mx/actualizaUser/modificaUser.php',
                        success: function(data){
                            // Se pasa el string a un objeto JSON
                            var datar = JSON.parse(data);

                            if(datar.success){
                                swal({
                                    title: "¡Cambio exitoso!",
                                    text: "En breve recibirás un correo con tus nuevos datos de acceso",
                                    icon: "success",
                                    button: "Aceptar",
                                })
                                    .then((value) => {
                                        doIngresa(json.diasR);
                                        //console.log('Datos enviados  '+json.usere+' ; '+json.clavee+' ; '+json.correoe);
                                });
                            }else{
                                doIngresa(json.diasR);
                            }                           
                        },
                        error: function(data){
                            //Cuando la interacción retorne un error, se ejecutará esto.
                            alert("Error de conexión, favor de verificar...");
                        }
                    });
                    
                }else{
                    muestraCambiarUsuario(json.msg);
                }
            },
            error: function(data){
                alert("Error de conexión, favor de verificar..."+5);
            }
        });
        e.preventDefault();
    }


	/******************************** */







  /*  $.ajax({
		type: 'POST',
		data: $("#formChangeUser").serialize(),
		cache: false,
		url: IP+'login/changeUser',
		success: function(data){
			var json = JSON.parse(data);
			console.log(json);
			if(json.success){
				doIngresa(json.diasR);
			}else{
				muestraCambiarUsuario(json.msg);
			}
		},
		error: function(data){
			alert("Error de conexión, favor de verificar...");
		}
	});
	e.preventDefault();  */
});

//Para saber que licencia se elige
function eligeOPC(opc){
	document.getElementById("cProducto").innerHTML  = "";
	
	var saldo = $('option:selected', opc).attr("cProducto");
	document.getElementById("cProducto").innerHTML  = "$ "+saldo;
	
	$(".p_emeralerta").text("");
	//$(".p_emeralerta").text($("#gradoCompra").val());  //gradoCompra
}

/****VALIDA EL CAMBIO DE USUARIO****/
function validaCambioUser(){
    let bol = false;

    if(($("#newusername").val().length < 1) || ($("#newusername").val().length < 5)) {
        swal({
            title: "¡Atención!",
            text: "El nombre del usuario debe ser de al menos 5 caracteres",
            icon: "error",
            button: "Aceptar",
        })
            .then((value) => {
                $("#newusername").focus();
        });
    }else if(($("#passwordc1").val().length < 1) || ($("#passwordc1").val().length < 5)) {
        swal({
            title: "¡Atención!",
            text: "La contraseña debe ser de al menos 5 caracteres",
            icon: "error",
            button: "Aceptar",
        })
            .then((value) => {
                $("#passwordc1").focus();
        });
    }else if(($("#passwordc2").val().length < 1) || ($("#passwordc2").val().length < 5)) {
        swal({
            title: "¡Atención!",
            text: "La contraseña debe ser de al menos 5 caracteres",
            icon: "error",
            button: "Aceptar",
        })
            .then((value) => {
                $("#passwordc2").focus();
        });
    }else if($("#passwordc1").val() != $("#passwordc2").val()){
        swal({
            title: "¡Atención!",
            text: "Las contraseñas no coinciden, verificar",
            icon: "error",
            button: "Aceptar",
        })
            .then((value) => {
                $("#passwordc2").focus();
        });
    }else{
        bol = true;
    }


    return bol;
}


/*Para validar los campos de compra antes de enviarlos*/
function validarForm(){
	/*
    * NOMBRE: validarForm
    * UTILIDAD: Valida los campos de el formulario de compras.
    * ENTRADAS: Ninguna.
    * SALIDAS: Ninguna.
    * VARIABLES: Ninguna.
    */
	var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
	var bol = false;
	
	if (regex.test($('#correoCompra').val().trim())) {
		//Se valida que se sekccione algo del combo
		if(($("#gradoCompra").val() == "") || ($("#gradoCompra").val() == null) || ($("#gradoCompra").val() == 0)) {
			$(".p_emeralerta").text("");
			$(".p_emeralerta").text("Selecciona una opción"); 
			$("#gradoCompra").focus();
		}else{
			cerrarEmergentes();
			bol = true;
		}
		
	} else {
		//alert('La direccón de correo no es válida');
		$(".p_emeralerta").text("");
		$(".p_emeralerta").text("La direccón de correo no es válida"); 
		$("#correoCompra").focus();
		//return false;
	}
	
	return bol;
}

$(document).on("submit", "#formRepoPassword", function(e){
	/*
  * NOMBRE: Función anónima.
  * UTILIDAD: Realiza login a traves de ajax.
  * ENTRADAS: e, event.
  * SALIDAS: Ninguna.
  * VARIABLES */
	e.preventDefault();
	cerrarEmergentes();
	/*$.post( 
		IP+"login/checkUser",
		$( "#formRepoPassword" ).serialize(),
		function( data ) {
			cerrarEmergentes();
		} 
	);*/
});

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

});

function compruebaAcceso(valor){
    /*
    * NOMBRE: accesoCorrecto
    * UTILIDAD: Muestra mensaje de Bienvenida.
    * ENTRADAS: Ninguna.
    * SALIDAS: Ninguna.
    * VARIABLES: Ninguna.
    */
      if(valor.acces){
      	if(valor.cambiarUsuario){
      		muestraCambiarUsuario('Esta acción solo se permitirá una única vez.');
      	}else{
      		$(".p_emerfrasetxtdias").html('Días restantes: <span class = "diasR">'+valor.msj+'</span>');
	            $("#name_usuario").text(event_name);
	            $(".p_emerclose").hide();
	            //$(".p_emerbox").addClass("bounceOut");
	            $(".p_emerbox").fadeOut(250, function(){
	                $(".p_emerboxconte").hide();
	                $(".p_emerboxbienvenido").show();
	                $(".p_emerboxbienvenido").css("background-image", "url(src/img/p_emergentefondo.png)");
	                $(".p_emerfrase").css("background-image", "url(src/img/p_emergentefrase.png)");

	                $(".p_emerboxbienvenido").parent().fadeIn(250, function(){
	                    $(".p_emergenteclose").attr("onclick", 'location.reload();');
	                    $(".p_emergenteusuario").fadeOut(3500);
	                    //No se agrega un metta para refresh porque cambia de tamaño los elementos en moviles
	                    setTimeout(function(){
	                        location.reload();
	                    }, 1500);
	                    
	                });
	            });
      	}
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

/*    GOOGLE AUTH     */
function onGoogleSignIn(googleUser) {
    /*
    * NOMBRE: onGoogleSignIn
    * UTILIDAD: Autentica con el controladorcorrespondiente las credenciales de Google
    * ENTRADAS: googleUser -> Objeto de autenticación de Google.
    * SALIDAS: Ninguna.
    * VARIABLES: Ninguna.
    */
    GAprofile = googleUser.getBasicProfile();
    GAtoken = googleUser.getAuthResponse().id_token;
    request = $.ajax({
        url : IP+"login/checkGoogleLogin",
        type : "POST",
        data : {profile:GAprofile,token:GAtoken, email:GAprofile.getEmail(), nombre:GAprofile.getName()}
    });
    request.done(function(response, textStatus, jqXHR){
        //console.log(response);
        var responseJSON = JSON.parse(response);
        compruebaAcceso(responseJSON);
    });
    request.fail(function(response, jqXHR, textStatus, thrown){
        console.log("Response: "+response+", Error: "+jqXHR+", textStatus: "+textStatus+", thrown: "+thrown);
    });
}

function googleSignOut() {
    /*
    * NOMBRE: googleSignOut
    * UTILIDAD: Cierra la sesión de l objeto de autenticación de Google.
    * ENTRADAS: Ninguna.
    * SALIDAS: Ninguna.
    * VARIABLES: Ninguna.
    */
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut();
}

function onGoogleFailure(error) {
  console.log(error);
}

function renderButton() {
    /*
    * NOMBRE: renderButton
    * UTILIDAD: Renderiza el botón de Google sign in con los parametros y funciones adecuadas
    * ENTRADAS: Ninguna.
    * SALIDAS: Ninguna.
    * VARIABLES: Ninguna.
    */
  gapi.signin2.render('my-signin2', {
    'scope': 'profile email',
    'width': 225,
    'height': 40,
    'theme': 'dark',
    'prompt':'select_account',
    'onsuccess': onGoogleSignIn,
    'onfailure': onGoogleFailure,
  });
}
/*                  */