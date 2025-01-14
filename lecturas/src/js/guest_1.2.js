$( window ).load(function() {
	//$("#conoce").load(IP+"ConoceApps");
});

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

function bloqueaSubtemas(){
    /*
    * NOMBRE: bloqueaSubtemas
    * UTILIDAD: Bloquea la barra de subtemas.
    * ENTRADAS: Ninguna.
    * SALIDAS: Ninguna.
    * VARIABLES: Ninguna.
    */
    //$(".contenido, .maskrismar, .britannica, .p_menulist").css({"cursor":"default","opacity":"0.5"});
	 $("[name = 'reciente'],.britannica,.maskrismar").css({"cursor":"pointer","opacity":"0.5"});
	
	
	
    $("[name = 'reciente'], .maskrismar, .britannica").click(function(){
		
        muestraIngresar("INGRESA PARA CONOCER A TODAS LAS ACTIVIDADES");
		
    }).css("cursor", "pointer");
	
	$(".maskrismar:gt(1)").css({"cursor":"pointer","opacity":"1"}).off('click');
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
	var request;
    request = $.ajax({
        url : IP+"login/checkUser",
        type : "POST"
    }).done(function(response, textStatus, jqXHR){
        var responseJSON = JSON.parse(response);
        compruebaAcceso(responseJSON);
    }).fail(function(response, jqXHR, textStatus, thrown){
        console.log("Response: "+response+", Error: "+jqXHR+", textStatus: "+textStatus+", thrown: "+thrown);
    });
}

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
            $("#name_usuario").text("Feria internacional del libro 2024");
            $(".p_emerclose").hide();
            $(".p_emerbox").fadeOut(250, function(){
                $(".p_emerboxconte").hide();
                $(".p_emerboxbienvenido").show();
                $(".p_emerboxbienvenido").css("background-image", "url(src/img/p_emergentefondo.png)");
                $(".p_emerfrase").css("background-image", "url(src/img/p_emergentefrase.png)");

                $(".p_emerboxbienvenido").parent().fadeIn(250, function(){
                    $(".p_emergenteclose").attr("onclick", 'location.reload();');
                    $(".p_emergenteusuario").fadeOut(1000);
                    //No se agrega un metta para refresh porque cambia de tamaño los elementos en moviles
                    location.reload();
                    
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