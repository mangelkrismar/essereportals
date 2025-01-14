var timeOutReciente = null;
var contadorBtn = 1;


function masReciente(){
    /*
	* NOMBRE: masReciente.
	* UTILIDAD: Apartado de slider de lo más reciente
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
    * VARIABLES: Ninguna
    ****/
    $(".p_recientebox").removeClass("p_iniciacarga")
    $(".p_recientebtn").remove();//Quita los botones.
    
	totalApps = $(".recienteicon").css("display") == "none" ? 3 : $(".recienteicon").css("display") == "flex" ? 2 : 1;
	
    appWidth = $(".p_recientebox").width();//Ancho de cada app.
	
	
	switch(totalApps){
		case 3:
		case 2:
			appBtn = appReciente/totalApps;//Total de apps entre 3 que se visualizan.
			$(".p_recientescroll").css({"width":(appWidth*appReciente)});//Se le asigna el ancho al contenedor de las apps.
			break;
		case 1:
			var appRound = appReciente/2;//Total de apps entre 2 que se visualizan.
			appBtn = (appRound % 1 == 0)?appRound:Math.round(Number(appRound.toString().split(".")[0]+".5"));
			
			$(".p_recientescroll").css({"width":(appWidth*appBtn)});//Se le asigna el ancho al contenedor de las apps.
			break;
	}
	
	$(".p_recientebox").show();
	agregaBtns();//Se agregan los botones del slider de lo más reciente.
	sliderReciente(appBtn, totalApps);//Control  de los botones del slider de lo más reciente.
	
    contadorBtn = 1;
    limiteInterval = $(".p_recientebtn").size();

    if(timeOutReciente != null){
    	clearInterval(timeOutReciente);
    }
    intervaloReciente();
    $("#btn1").trigger("click");
}

function intervaloReciente(){

    timeOutReciente = setInterval(function(){

		if(contadorBtn == limiteInterval){
			contadorBtn = 0;
		}
		contadorBtn++;
		$("#btn"+contadorBtn).trigger("click");

  }, 10000);
}

function agregaBtns(){
    /*
	* NOMBRE: agregaBtns.
	* UTILIDAD: Se agregan los botones del slider de lo más reciente.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
    * VARIABLES****/
    var contadorName = 0;//Contador para agregar "id" al div con la clase "p_recientebtn".
    /**************/
    //Es un número entero ("appReciente" es un número par).
    if (appBtn % 1 == 0) {
        for(i=0; i<=(appBtn-1); i++){
            contadorName++;
            $(".p_recientebtncenter").append('<div class="p_recientebtn" id="btn'+(contadorName)+'"></div>');//Se agregan los botones.
        }
    }
    //Tiene decialmes ("appReciente" es un número none).
    else{
        appTotalbtn = Math.round(Number(appBtn.toString().split(".")[0]+".5"));//El número decimal lo convierte a un número entero superior (ej. "2.0356" es 3)
        for(i=0; i<=(appTotalbtn-1); i++){
            contadorName++;
            $(".p_recientebtncenter").append('<div class="p_recientebtn" id="btn'+(contadorName)+'"></div>');//Se agregan los botones.
        }
    }
}

function sliderReciente(maxBtns,noMiniatura){
    /*
	* NOMBRE: sliderReciente.
	* UTILIDAD: Control  de los botones del slider de lo más reciente.
	* ENTRADAS: maxBtns > total de botones respecto al media query y total de apps.
                noMiniatura > cuentas minuaturas o apps se muestran en relación al media query.
	* SALIDAS: Ninguna.
    * VARIABLES****/
    var btnPress = $(".p_recientebtn");//Recorre todos los botones creados.
    idBtn = null;//Se elimina el id de la variable del ultimo boton presionado.
    appWidth = $(".p_recientebox").width();//Ancho de cada app.
    /**************/
    $("#btn1").addClass("p_recientebtnpress");//Agrega clase de indicador.
    $(".p_recientescroll").stop().animate({"margin-left":"0%"},0);//Vuelve la animación "slider" al inicio.
    for(i=0; i<=maxBtns; i++){
        $(btnPress[i]).click(function(){
        	clearInterval(timeOutReciente);
        	contadorBtn = $(this).attr("id").split("n")[1];
        	intervaloReciente();
			
            if(idBtn != $(this).attr("id")){
                idBtn = $(this).attr("id");//Obtiene el "id" del boton que se presiona y se asigna a la variable.
                $(".p_recientebtn").removeClass("p_recientebtnpress");//Quita la clase de indicador.
              
                if($(this).attr("id") === $(this).attr("id")){
                    $(this).addClass("p_recientebtnpress");//Agrega clase de indicador.
                    var indexBtn = $(this).index();//Le asigna un número al boton que presiono.

                    
                    $(".p_recientescroll").stop().animate({"margin-left":"-"+(appWidth*(noMiniatura*indexBtn))},1000);//Se hace la animación "slider", pero también se pausa primero al presionar otro boton.
                }
            }
        });
    }
}

function initReciente(){
    appReciente = $(".p_recientebox").size();
    masReciente();
}