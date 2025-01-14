var numCartas = 6;//Numero de cartas
var formatoCartas = "vertical";//Formato de cartas
var posPleca = "izquierda";//Posicion de l aple9
var arrayColor = ["","","","","","","","","",""];//Guarda los colores para asiganarlos al input color
var arrayBorde = ["","","","","","","","","",""];//Guarda los colores de borde para asiganarlos al input color
var arrayShadow = ["","","","","","","","","",""];//Guarda los colores de sombra para asiganarlos al input color
var arrayTexto = ["","","","","","","","","",""];//Guarda los colores de texto para asiganarlos al input color
var arrayImg = ["","","","","","","","","",""];//Guarda las imágenes para asiganarlos al input file
var arrayPar1 = ["","","","","","","","","","",""];//Guarda las imágenes para asiganarlos al input file
var arrayPar2 = ["","","","","","","","","","",""];//Guarda las imágenes para asiganarlos al input file
var arrayZoom = ["","","","","","","","","",""];//Guarda el tamaño de imagen
var arraytipoImg = ["","","","","","","","","",""];//Guarda el tamaño de imagen
var arrayFontfamily = ["","","","","","","","","",""];//Guarda la familia de texto
var arrayFontsize = ["","","","","","","","","",""];//Guarda el tamaño de texto
var arrayRedondear = ["","","","","","","","","",""];//Guarda el border-radius
var num = 0;//Opcion que se selecciona, icono de engrane
var numeroPar = 0;
var htmlAplicacion = "";
var tipoMemorama = 1;
var distractoresAdd = 0;
var totalPares = 0;
var userName = $(".a_usuario span").text();
var asignatura = "";
var titulo = "";
var prefijo = "";
var instrucciones = "";
var objetivos = "";
var palabras = "";
var estructuraCompleta = false;
var disenoCompleta = false;

$(document).ready(function(){
    document.oncontextmenu = function(){return false}
    userName = $(".a_usuario span").text();
    adminMemorama();//Click en pleca, no de cartas y formato
    newDiseno();//Click para agregar (fondo, imagen, sombra, borde, redondeado, tipo img, zoom img)
    btnNavegacion();//Click en los botones de navegacion inferiores.
    ajusteConte();//Ajusta el contenido en relacion al alto y ancho del fondo.
    $(window).resize(function(){
        ajusteConte();//Ajusta el contenido en relacion al alto y ancho del fondo.
    });
    //datosMemorama();
    $("#p_asignatura").off('change').on('change',function(){
        asignatura = $(this).val();
    });
    $("#p_titulo").off('keyup').on('keyup',function(){
        titulo = $(this).val();
    });
    $("#p_prefijo").off('keyup').on('keyup',function(){
        prefijo = $(this).val();
    });
    $("#p_instrucciones").off('keyup').on('keyup',function(){
        instrucciones = $(this).val();
    });
    $("#p_objetivos").off('keyup').on('keyup',function(){
        objetivos = $(this).val();
    });
    $("#p_palabras").off('keyup').on('keyup',function(){
        palabras = $(this).val();
    });
});
function newDiseno(){
    /*
	* NOMBRE: newDiseno.
	* UTILIDAD: Click para agregar (fondo, imagen, sombra, borde, redondeado, tipo img, zoom img)
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
    * VARIABLES: Ninguna
    */
    $("#opcionB").css("opacity","0.5")
    $("#cartas6").css({"background-image":"url(src/img/cartas_icon6_press.png)"});
    $("#formato_v").css({"background-image":"url(src/img/formato_icon_v_press.png)"});
    formatoCartas = "vertical";
    agregaCartas();
    addParejas();//AGREGA EL NÚMERO DE PAREJAS EN LA SECCIÓN DE DATOS
    //DISENO
    $(".a_config").click(function(){

        $('.a_btn-file :file').val("")
        $('.a_btn-file3 :file').val("")
        num = Number($(this).attr("id"));
        $("#box1").attr("checked","checked");
        $(".a_menudisenotxt").fadeOut(0);
        $(".a_menudiseno").fadeIn().removeClass("a_menuanimaIn");
        setTimeout(function(){
            $(".a_menudiseno").addClass("a_menuanimaIn");
        },10);
        $(".a_config").removeClass("a_config_press");
        $(this).addClass("a_config_press");
        $(".a_encabezado").text("DISEÑO DE FONDO");
        colorGeneral();//COLOR
        imagenGeneral();//IMAGEN
        tipoimgGeneral();//TIPO IMG
        zoomimgGeneral();//ZOOM IMG
        bordeGeneral();//BORDE
        sombraGeneral();//SOMBRA
        redondearGeneral();//REDONDEAR BORDE
        
        //DISEÑO DE FONDO
        if(num === 1){
            $(".a_disenoconte, .a_disenocontecarta").fadeOut(0);
            $("#optionborde, #optioncolor, #optionimg, .a_tipoimg").fadeIn();
            $(".rotate").css({"transform":"rotateY(0deg)"});
            $(".agrega8").css({"opacity":"1"});
            $(".a_encabezado").text("DISEÑO DE FONDO");
            colorGeneral();//COLOR
            imagenGeneral();//IMAGEN
            tipoimgGeneral();//TIPO IMG
            zoomimgGeneral();//ZOOM IMG
            bordeGeneral();//BORDE
        }
        //DISEÑO PERSONAJE PLECA
        if(num === 3){
            $(".a_disenoconte, .a_disenocontecarta").fadeOut(0);
            $(".rotate").css({"transform":"rotateY(0deg)"});
            $(".agrega8").css({"opacity":"1"});
            $("#optionimg").fadeIn();
            $(".a_encabezado").text("AGREGAR PERSONAJE");
            imagenGeneral();
        }
        //DISEÑO MARCADOR
        else if(num === 4){
            $(".a_disenoconte, .a_disenocontecarta").fadeOut(0);
            $("#optionborde, #optioncolor, #optionimg, #optionbtntxt, #optionsombra, #optiontxtreverso").fadeIn();
            $(".rotate").css({"transform":"rotateY(0deg)"});
            $(".agrega8").css({"opacity":"1"});
            imagenGeneral();
            colorGeneral();
            bordeGeneral();
            sombraGeneral();//SOMBRA
            tipoimgGeneral();
            zoomimgGeneral();
            textoGeneral();
            redondearGeneral();//REDONDEAR BORDE
        }
        //DISEÑO CARTAS
        else if(num === 7){
            $(".a_disenoconte").fadeOut(0);
            $("#optionborde, #optioncolor, #optionimg, .a_disenocontecarta, #optionsombra, #redondearborde").fadeIn(0);
            $(".a_encabezado").text("CARTA FRONTAL");
            $("#adddiscarta").prop('checked', true);
            $(".radiocarta").off('change').on('change',function(){
                $(".a_disenoconte").fadeOut(0);
                $(".a_tipoimg").fadeIn();
                $(".rotate").css({"transform":"rotateY(0deg)"});
                $(".agrega8").css({"opacity":"1"});
                //CAMBIO DE IMG
                if($("#adddiscarta").is(':checked')){
                    num = 7;
                    imagenGeneral();
                    colorGeneral();
                    bordeGeneral();
                    sombraGeneral();//SOMBRA
                    tipoimgGeneral();
                    zoomimgGeneral();
                    redondearGeneral();//REDONDEAR BORDE
                    $("#optionborde, #optioncolor, #optionimg, #optionsombra, #redondearborde").fadeIn();
                    $(".a_encabezado").text("CARTA FRONTAL");
                }
                //CAMBIO DE IMG PERSONAJE
                else if($("#addpersona").is(':checked')){
                    num = 8;
                    imagenGeneral();
                    tipoimgGeneral();
                    zoomimgGeneral();
                    $("#optionimg").fadeIn();
                    $(".a_encabezado").text("PERSONAJE CARTA");
                }
                //CAMBIO DE COLOR TEXTO Y FONDO
                else if($("#verreverso").is(':checked')){
                    num = 9;
                    colorGeneral();
                    textoGeneral();
                    sombraGeneral();//SOMBRA
                    imagenGeneral();
                    tipoimgGeneral();
                    zoomimgGeneral();
                    redondearGeneral();//REDONDEAR BORDE
                    previewTxt();//PREVISUALIZAR TEXTO EN CARTAS
                    editarTexto();//MODIFICA TIPO Y TAMAÑO DE FUENTE
                    $(".rotate").css({"transform":"rotateY(180deg)"});
                    $(".agrega8").css({"opacity":"0"});
                    $("#optioncolor, #optiontxtreverso, #optionsombra, #optionimg, .a_tipoimg, #previewtxt, #optiontxtedit, #redondearborde").fadeIn();
                    $(".a_encabezado").text("CARTA REVERSO");
                   // $(".a_tipoimg").fadeOut(0);
                }else{}
            });
        }else{
            $(".a_disenoconte, .a_disenocontecarta").fadeOut(0);
            $("#optionborde, #optioncolor, #optionimg, .a_tipoimg, #optionsombra").fadeIn();
            $(".rotate").css({"transform":"rotateY(0deg)"});
            $(".agrega8").css({"opacity":"1"});
        }
        $(".a_config").parent().removeClass("resalte");
        $(this).parent().addClass("resalte");
    }); 
}
function editarTexto(){
    /*
	* NOMBRE: editarTexto.
	* UTILIDAD: Modifica tipo y tamaño de fuente
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
    * VARIABLES: Ninguna
    */
    $(".a_txteditfont").find("select").on("change", function(){
        arrayFontfamily[num] = $(this).val();
        $(".txt"+num).css({"font-family":arrayFontfamily[num]});
    });
     $(".a_txteditsize").find("select").on("change", function(){
         arrayFontsize[num] = $(this).val();
        $(".txt"+num).css({"font-size":arrayFontsize[num]+"rem"});
    });
}
function previewTxt(){
    /*
	* NOMBRE: previewTxt.
	* UTILIDAD: Previsualizar texto en cartas
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
    * VARIABLES: Ninguna
    */
    $(".a_previewtexto").find("textarea").keyup(function(e){
        $(".txt10").text($(this).val());
    });
}
function redondearGeneral(){
    /*
	* NOMBRE: redondearGeneral.
	* UTILIDAD: Modifica borde redondeado
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
    * VARIABLES: Ninguna
    */
    $(".redondearopcionin").find("select").val(arrayRedondear[num]);
    $(".redondearopcionin").find("select").off('change').on("change", function(){
        arrayRedondear[num] = $(this).val();
        $(".agrega"+num).css({"border-radius":arrayRedondear[num]+"px"});   
    });
}
function textoGeneral(){
    /*
	* NOMBRE: textoGeneral.
	* UTILIDAD: Modifica color texto
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
    * VARIABLES: Ninguna
    */
    $(".a_colortxt").find("input").val(arrayTexto[num]);
    $(".a_colortxt").find("input").off('change').on('change',function(){
        arrayTexto[num] = $(this).val();
        $(".txt"+num).css({"color":arrayTexto[num]});
    });
    $(".a_colortxtnone").off('click').click(function(){
        $(".txt"+num).css({"color":"inherit"});
        $(".a_colortxt").find("input").val("");
        arrayTexto[num] = "";
    });
}
function colorGeneral(){
    /*
	* NOMBRE: colorGeneral.
	* UTILIDAD: Modifica color de fondo
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
    * VARIABLES: Ninguna
    */
    $(".a_color").find("input").val(arrayColor[num]);
    $(".a_color").find("input").off('change').on('change',function(){
        arrayColor[num] = $(this).val();
        $(".agrega"+num).css({"background-color":arrayColor[num]});
    });
    $(".a_colornone").off('click').click(function(){
        $(".agrega"+num).css({"background-color":"transparent"});
        $(".a_color").find("input").val("");
        arrayColor[num] = "";
    });
}
function imagenGeneral(){
    /*
	* NOMBRE: imagenGeneral.
	* UTILIDAD: Modifica imagen de fondo
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
    * VARIABLES: Ninguna
    */
    $(".a_form-control1").val(arrayImg[num]);
    $("#inFile1").off('change').on('change',function(){
        subeImagen(num);
    });
    $(".a_imgnone").off('click').click(function(){
        $(".agrega"+num).css({"background-image":"none"});
        $(".a_form-control1").val("Ningún archivo seleccionado");
        arrayImg[num] = "";
    });
}
function tipoimgGeneral(){
    /*
	* NOMBRE: tipoimgGeneral.
	* UTILIDAD: Modifica tipo de imagen
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
    * VARIABLES: Ninguna
    */
    $("#box1").prop('checked', true);
    $("#"+arraytipoImg[num]).prop('checked', true);
    $(".inradio").off('change').on('change',function(){
        arraytipoImg[num] = $('input:radio[name=tipoimg]:checked').attr("id");
        if($("#box1").is(':checked')){
            $("#zoom").text("100%");
            $("#zoomimg").val(50);
            $(".agrega"+num).css({"background-size":"contain","background-repeat":"no-repeat"});
        }
        if($("#box2").is(':checked')){
            $("#zoom").text("100%");
            $("#zoomimg").val(50);
            $(".agrega"+num).css({"background-size":"cover","background-repeat":"no-repeat"});
        }
        if($("#box3").is(':checked')){
            $("#zoom").text("100%");
            $("#zoomimg").val(50);
            $(".agrega"+num).css({"background-size":"100% 100%","background-repeat":"no-repeat"});
        }
        if($("#box4").is(':checked')){
            $("#zoom").text("100%");
            $("#zoomimg").val(50);
            $(".agrega"+num).css({"background-size":"auto","background-repeat":"repeat"});
        }
    });
}
function zoomimgGeneral(){
    /*
	* NOMBRE: zoomimgGeneral.
	* UTILIDAD: Modifica zoom de imagen
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
    * VARIABLES***/
    var bandera = false;//Identifica si el input range esta presionado
    /**********/
    if(arrayZoom[num] === ""){
        setTimeout(function(){
            $("#zoomimg").val("50");
            $("#zoom").text("100%");
        },100);
    }
    $("#zoomimg").val(arrayZoom[num]/2);
    $("#zoom").text(arrayZoom[num]+"%");
    $("#zoomimg").off('mousemove').on('mousemove',function(){
        if(bandera){
            arrayZoom[num] = 2*Number($(this).val());
            $("#zoom").text(arrayZoom[num]+"%");
            $(".agrega"+num).css({"background-size":""+arrayZoom[num]+"%"});

        }
    });
    $("#zoomimg").off('mousedown').on('mousedown',function(){
        bandera = true;
        if(arrayZoom[num] === ""){
           $("#zoom").text("100%");
        }
    });
    $("#zoomimg").off('mouseup').on('mouseup',function(){
        bandera = false;
        $("#zoom").text(arrayZoom[num]+"%");
    });
    $("#zoomimg").off('change').on('change',function(){
        $("#zoom").text(arrayZoom[num]+"%");
    });
}
function bordeGeneral(){
    /*
	* NOMBRE: bordeGeneral.
	* UTILIDAD: Modifica color de borde
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
    * VARIABLES: Ninguna
    */
    $(".a_colorborde").find("input").val(arrayBorde[num]);
    $(".a_colorborde").find("input").off('change').on('change',function(){
        arrayBorde[num] = $(this).val();
        $(".agrega"+num).css({"border-color":arrayBorde[num],"border-style":"solid"});
    });
    $(".a_colorbordenone").off('click').click(function(){
        $(".agrega"+num).css({"border-color":"transparent","border-style":"none"});
        $(".a_colorborde").find("input").val("");
        arrayBorde[num] = "";
    });
}
function sombraGeneral(){
    /*
	* NOMBRE: sombraGeneral.
	* UTILIDAD: Modifica color de sombra
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
    * VARIABLES: Ninguna
    */
    $(".a_colorsombra").find("input").val(arrayShadow[num]);
    $(".a_colorsombra").find("input").off('change').on('change',function(){
        arrayShadow[num] = $(this).val();
        $(".agrega"+num).css({"box-shadow":"0px 0px 6px 0px"+arrayShadow[num]});
    });
    $(".a_colorsombranone").off('click').click(function(){
        $(".agrega"+num).css({"box-shadow":"none"});
        $(".a_colorsombra").find("input").val("");
        arrayShadow[num] = "";
    });
}
function addParejas(){
    /*
	* NOMBRE: addParejas.
	* UTILIDAD: Agrega el numero de pares en la seccion de datos.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
    * VARIABLES***/
    totalPares = numCartas/2;//Total de pares que se agregan
    /**********/
    $(".a_parejasnum").empty();
    for(i=1; i<=totalPares; i++){
        $(".a_parejasnum").append('<div class="a_parejasbtn">'+i+'</div>');
        $(".a_parejasbtn").css({"width":(100/totalPares)+"%"});
    }
    clicParejas();
    $(".distractoropcionin").find("select").on("change", function(){
        distractoresAdd = $(this).val();
        $(".a_parejasnum").empty();
        totalPares = Number(distractoresAdd)+Number(numCartas/2);
        for(i=1; i<=totalPares; i++){
            $(".a_parejasnum").append('<div class="a_parejasbtn">'+i+'</div>');
            $(".a_parejasbtn").css({"width":(100/totalPares)+"%"});
        }
        clicParejas();
    });
}
function clicParejas(){
    /*
	* NOMBRE: clicParejas.
	* UTILIDAD: Click a los pares en la seccion de datos.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
    * VARIABLES***/
    var btnParejas = $(".a_parejasbtn");//Click en los botones de pares
    /**********/
    for(i=0; i<=totalPares; i++){
        $(btnParejas[i]).click(function(){
            numeroPar=$(this).text();
            $('.a_parejastxtup_a textarea:nth-child(1)').val(arrayPar1[numeroPar])
            $('.a_parejastxtup_b textarea:nth-child(1)').val(arrayPar2[numeroPar])
            $('.a_parejasimgup_a .a_miniaturaimg').css({"background-image":"url("+arrayPar1[numeroPar]+")"})
            $('.a_parejasimgup_b .a_miniaturaimg').css({"background-image":"url("+arrayPar2[numeroPar]+")"})
            $('.a_parejasimgup_b :text').val(arrayPar2[numeroPar])
            $('.a_parejasimgup_a :text').val(arrayPar1[numeroPar])
            $(".a_parejasbtn").removeClass("a_parejasbtn_press");
            $(this).addClass("a_parejasbtn_press");
        });
    }
    $(btnParejas[0]).trigger("click");
}
function btnNavegacion(){
    /*
	* NOMBRE: btnNavegacion.
	* UTILIDAD: Click en los botones de navegacion inferiores.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
    * VARIABLES***/
    var btnMenunav = $(".a_botones").find("div");//Click en los botones de nav inferiores
    /**********/
    $("#agrega").addClass("d_addlines");
    for(i=0; i<=3; i++){
        $(btnMenunav[i]).click(function(){
            banderaSelec = false;
            if($(this).attr("id") === "btndatos"){
                $(".a_emergente").fadeIn();
                $("#pregunta").text("SE BORRARÁ TODO LO QUE LLEVAS HASTA EL MOMENTO, ¿DESEAS CONTINUAR?");
                $("#aceptar").click(function(){
                    $(".a_emergente").fadeOut();
                    window.location.reload(true);
                    $("#agrega").addClass("d_addlines");
                });
                $("#cancelar").click(function(){
                    $(".a_emergente").fadeOut();
                });
                
            }
            if($(this).attr("id") === "btnestructura"){
                
                if(userName!="" && titulo!="" && prefijo!="" && prefijo.length >= 12 && instrucciones!="" && objetivos!="" && palabras!="" && asignatura!=""){
                    $("#estructura").fadeIn();
                    $("#contenido, #diseno, #datos").css({"display":"none"});
                    $("#agrega").addClass("d_addlines");
                    $("#agregaconf, .vistaprevia").fadeOut();
                    if (htmlAplicacion!="") {
                        $("#contenidoHTML").html(htmlAplicacion)
                    };
                    disenoCompleta=false;
                    estructuraCompleta=true;
                    banderaSelec=true;
                }else{
                    showEmergente("FALTAN CAMPOS POR LLENAR");
                }
                
            }
            if($(this).attr("id") === "btndiseno"){
                if (estructuraCompleta==true) {
                    $("#agregaconf, .vistaprevia, #diseno").fadeIn();
                    $("#estructura, #contenido, #datos").css({"display":"none"});
                    $("#agrega").addClass("d_addlines");
                    if (disenoCompleta==false) {
                        arrayColor = ["","","","","","","","","",""];//Guarda los colores para asiganarlos al input color
                        arrayBorde = ["","","","","","","","","",""];//Guarda los colores de borde para asiganarlos al input color
                        arrayShadow = ["","","","","","","","","",""];//Guarda los colores de sombra para asiganarlos al input color
                        arrayTexto = ["","","","","","","","","",""];//Guarda los colores de texto para asiganarlos al input color
                        arrayImg = ["","","","","","","","","",""];//Guarda las imágenes para asiganarlos al input file
                        arrayZoom = ["","","","","","","","","",""];//Guarda el tamaño de imagen
                        arraytipoImg = ["","","","","","","","","",""];//Guarda el tamaño de imagen
                        arrayFontfamily = ["","","","","","","","","",""];//Guarda la familia de texto
                        arrayFontsize = ["","","","","","","","","",""];//Guarda el tamaño de texto
                        arrayRedondear = ["","","","","","","","","",""];//Guarda el tamaño de texto
                        $(".a_color").find("input").val("#000");
                        var estiloContenido = $(".d_contenido").attr("style");
                        var estiloTxt = $(".txt4, .txt10").attr("style");
                        $(".d_contenido, .txt4, .txt10").removeAttr("style");
                        htmlAplicacion = $("#contenidoHTML").html()
                        $(".d_contenido").attr("style",estiloContenido);
                        $(".txt4, .txt10").attr("style",estiloTxt);
                    }
                    disenoCompleta=true
                    banderaSelec=true;
                }else{
                    showEmergente("COMPLETA TODOS LOS PASOS");
                };
                
            }
            if($(this).attr("id") === "btncontenido"){
                if (disenoCompleta==true) {
                    $("#agregaconf, .vistaprevia, #diseno").fadeOut();
                    $("#estructura, #diseno, #datos").css({"display":"none"});
                    $("#contenido").fadeIn();
                    $("#distractores").fadeIn();
                    $("#agrega").removeClass("d_addlines");
                    parejasTipo();
                    banderaSelec=true;
                }else{
                    showEmergente("COMPLETA TODOS LOS PASOS");
                };
                
            }
            if (banderaSelec==true) {
                $(".a_botones").find("div").removeClass("a_botones_press");
                $(this).addClass("a_botones_press");
            };
            
        });
    }
    showLines();
}
function showEmergente(frase){
    $(".a_emergente2").fadeIn();
    $("#pregunta2").text(frase);
    $("#aceptar2").click(function(){
        $(".a_emergente2").fadeOut();
    });
}
function showLines(){
    /*
	* NOMBRE: showLines.
	* UTILIDAD: Click en el boton de vista previa
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
    * VARIABLES: Ninguna
    */
    $(".vistaprevia").click(function(){
        if($(this).attr("name") === "activo"){
            $("#agrega").addClass("d_addlines");
            $("#agregaconf").fadeIn();
            $(this).attr("name","desactivo");
        }else{
            $("#agrega").removeClass("d_addlines");
            $("#agregaconf").fadeOut();
            $(this).attr("name","activo");
        }
    });
}
function parejasTipo(){
    /*
	* NOMBRE: parejasTipo.
	* UTILIDAD: Opciones de datos (imagen-imagen, imagen-texto, texto-texto)
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
    * VARIABLES: Ninguna
    */
    inputFile3();
    $("#parejatipo1").prop('checked', true);
    $(".parejacarta").off('change').on('change',function(){
            $('.a_parejasconf :file').val("")
            $('.a_parejasconf :input').val("")
            $('.a_parejastxtup_a textarea:nth-child(1)').val("")
            $('.a_parejastxtup_b textarea:nth-child(1)').val("")
            $('.a_parejasimgup_a .a_miniaturaimg').css({"background-image":"none"})
            $('.a_parejasimgup_b .a_miniaturaimg').css({"background-image":"none"})
            arrayPar1 = ["","","","","","","","","","",""];
            arrayPar2 = ["","","","","","","","","","",""];
        if($("#parejatipo1").is(':checked')){
            tipoMemorama=1;
            $("#opcionB").css("opacity","0.5")
             $("#opcionB input").attr("disabled","disabled")
            $("#chekparB").css("display","block")
            $("#chekparB input").prop( "checked", true );
            $(".a_parejasiconimg, .a_parejasicontxt").fadeOut(0);
            $(".imgladoa, .imgladob").fadeIn();
            $(".a_parejastitle").text("IMAGEN - IMAGEN");
            $(".campollenado").fadeOut(0);
            $(".a_parejasimgup_a, .a_parejasimgup_b").fadeIn();
        }
        else if($("#parejatipo2").is(':checked')){
            tipoMemorama=2;
            $("#opcionB").css("opacity","1")
            $("#chekparB").css("display","none")
            $(".a_parejasiconimg, .a_parejasicontxt").fadeOut(0);
            $(".imgladoa, .txtladob").fadeIn();
            $(".a_parejastitle").text("IMAGEN - TEXTO");
            $(".campollenado").fadeOut(0);
            $(".a_parejasimgup_a, .a_parejastxtup_b").fadeIn();
        }
        else if($("#parejatipo3").is(':checked')){
            tipoMemorama=3;
            $("#opcionB").css("opacity","1")
            $("#chekparB").css("display","none")
            $(".a_parejasiconimg, .a_parejasicontxt").fadeOut(0);
            $(".txtladoa, .txtladob").fadeIn();
            $(".a_parejastitle").text("TEXTO - TEXTO");
            $(".campollenado").fadeOut(0);
            $(".a_parejastxtup_a, .a_parejastxtup_b").fadeIn();
        }else{}
    });
    $("#chekparB input").off('change').on('change',function(){
        if($(this).is(':checked')){
            tipoMemorama=1
            $("#opcionB").css("opacity","0.5")
            $("#opcionB input").attr("disabled","disabled")
        }else{
            tipoMemorama=4
            $("#opcionB").css("opacity","1")
            $("#opcionB input").removeAttr("disabled")
        }
    });

} 
function adminMemorama(){
    /*
	* NOMBRE: adminMemorama.
	* UTILIDAD: Click en pleca, no de cartas y formato
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
    * VARIABLES: Ninguna
    */
    inputFile();
    agregaEstructura();
    $("#box").prop('checked', true);
    $(".a_fondopleca").css({"display":"block"});
    $("#pleca1").addClass("pleca_press");
    //Diseno de pleca
    $("#box").off('change').on('change',function(){
        if($("#box").is(':checked')){
            $("#pleca1, #pleca2, #pleca3").removeClass("pleca_press");
            $("#pleca1").addClass("pleca_press");
            $(".a_fondopleca").css({"display":"block"});
            posPleca = "izquierda";
            agregaEstructura();
            agregaCartas();
        }else{
            $(".a_fondopleca").css({"display":"none"});
            posPleca = "ninguna";
            agregaEstructura();
            agregaCartas();
        }
    });
    //PLECA
    var estructura = $(".plecas");
    for(i=0; i<=2; i++){
        $(estructura[i]).click(function(){
            $(".plecas").removeClass("pleca_press");
            $(this).addClass("pleca_press");
            if($(this).attr("id") === "pleca1"){
               posPleca = "izquierda";
            }
            if($(this).attr("id") === "pleca2"){
               posPleca = "derecha";
            }
            if($(this).attr("id") === "pleca3"){
               posPleca = "inferior";
            }
            agregaEstructura();
            agregaCartas();
        });
    }
    //CARTAS
    var noCartas = $(".a_icon");
    for(i=0; i<=4; i++){
        $(noCartas[i]).click(function(){
            var opcionClic = $(this).attr("id").split("s")[1];
            $(".a_icon").removeAttr("style");
            $(this).css({"background-image": "url(src/img/cartas_icon"+opcionClic+"_press.png)"});
            if($(this).attr("id") === "cartas18"){
               numCartas = 18;
            }
            if($(this).attr("id") === "cartas16"){
               numCartas = 16;
            }
            if($(this).attr("id") === "cartas12"){
               numCartas = 12;
            }
            if($(this).attr("id") === "cartas8"){
               numCartas = 8;
            }
            if($(this).attr("id") === "cartas6"){
               numCartas = 6;
            }
            agregaCartas();
            addParejas();//AGREGA EL NÚMERO DE PAREJAS EN LA SECCIÓN DE DATOS
        });
    }
    //FORMATO
    var formato = $(".a_format");
    for(i=0; i<=1; i++){
        $(formato[i]).click(function(){
            var opcionClic2 = $(this).attr("id").split("_")[1];
            $(".a_format").removeAttr("style");
            $(this).css({"background-image": "url(src/img/formato_icon_"+opcionClic2+"_press.png)"});
            if($(this).attr("id") === "formato_v"){
               formatoCartas = "vertical";
            }
            if($(this).attr("id") === "formato_h"){
               formatoCartas = "horizontal";
            }
            agregaCartas();
        });
    }
}
function agregaCartas(){
    /*
	* NOMBRE: agregaCartas.
	* UTILIDAD: Agrega cartas y formato.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
    * VARIABLES: Ninguna
    */
    //Quita clases de agregar cartas
    for(i=1; i<=18; i++){
        $("#agrega, #agregaconf").removeClass("d_pleca_inferior_"+i+"_horizontal d_pleca_inferior_"+i+"_vertical d_pleca_ninguna_"+i+"_horizontal d_pleca_ninguna_"+i+"_vertical");
        $("#agrega, #agregaconf").removeClass("d_"+i+"_cartas_vertical d_"+i+"_cartas_horizontal");
    }
    $("#agregacartas").empty();//Quita cartas agregadas
    //Agrega las cartas
    for(i=0; i<=(numCartas-1); i++){
        $("#agregacartas").append('<article id="contieneCarta'+(i+1)+'"><div class="rotate" id="cartaMemorama'+(i+1)+'"><div class="agrega7" id="cartaReverso'+(i+1)+'"><div class="agrega8"></div></div><article  ><table class="agrega9 txt9" ><tr id="img'+(i+1)+'"><td id="text'+(i+1)+'" class="txt10">AQUÍ VA TU TEXTO</td></tr></table></article></div></article>');
    }
    //Estructura de las cartas
    if(formatoCartas === formatoCartas && numCartas === numCartas){
        $("#agrega, #agregaconf").addClass("d_"+numCartas+"_cartas_"+formatoCartas+"");
        if(posPleca === "inferior"){
            $("#agrega, #agregaconf").addClass("d_pleca_"+posPleca+"_"+numCartas+"_"+formatoCartas+""); 
        }
        if(posPleca === "ninguna"){
            $("#agrega, #agregaconf").addClass("d_pleca_"+posPleca+"_"+numCartas+"_"+formatoCartas+""); 
        }
    } 

}
function agregaEstructura(){
    /*
	* NOMBRE: agregaEstructura.
	* UTILIDAD: Acomoda las cartas en relacion a la posicion de la pleca
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
    * VARIABLES: Ninguna
    */
    $("#agrega, #agregaconf").removeClass("d_pleca_izquierda d_pleca_derecha d_pleca_inferior d_pleca_ninguna");//Quita clases de agregar cartas
    $("#agregacartas").empty();//Quita cartas agregadas
    //Estado y posición de la pleca
    $("#agrega, #agregaconf").addClass("d_pleca_"+posPleca+"");
}
function inputFile(){
    /*
	* NOMBRE: inputFile.
	* UTILIDAD: Ajuste del diseño del INPUT FILE de diseno
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
    * VARIABLES: Ninguna
    */
    $(document).on('change', '.a_btn-file :file', function() {
      var input = $(this),
      numFiles = input.get(0).files ? input.get(0).files.length : 1,
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
      input.trigger('fileselect', [numFiles, label]);
    });
    $('.a_btn-file :file').on('fileselect', function(event, numFiles, label) {
        var input = $(this).parents('.a_input-group').find(':text'),
        log = numFiles > 1 ? numFiles + ' Archivos seleccionados' : label;
        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }
    });
}
function inputFile3(){
    /*
	* NOMBRE: inputFile3.
	* UTILIDAD: Ajuste del diseño del INPUT FILE de datos
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
    * VARIABLES: Ninguna
    */
    $(document).on('change', '.a_btn-file3 :file', function() {
        
        if($(this).val()!=""){
                var objetoCambiado = $(this);
                var file_data = $(this).prop('files')[0];   
                var form_data = new FormData();                  
                form_data.append('file', file_data);
                form_data.append('num', num);
                form_data.append('prefijo', prefijo);

                $.ajax({

                    type: "POST",
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    url:"src/php/subirImagen.php",
                    data: form_data,
                    success: function(data){

                        if ($(objetoCambiado).parent().parent().parent().attr("class")=="a_parejasimgup_a campollenado"){

                            arrayPar1[numeroPar]=data;
                            $('.a_parejasimgup_a .a_miniaturaimg').css({"background-image":"url("+data+")"})
                        }else{
                            arrayPar2[numeroPar]=data;
                            $('.a_parejasimgup_b .a_miniaturaimg').css({"background-image":"url("+data+")"})
                        }

                    }

                })
        }

        
        
        
      var input = $(this),
      numFiles = input.get(0).files ? input.get(0).files.length : 1,
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
      input.trigger('fileselect', [numFiles, label]);
    });

    $(document).on('keyup', '.a_parejastxtup_a textarea:nth-child(1)', function() {
        
        if ($(this).val()!="") {
            arrayPar1[numeroPar]=$(this).val();
        }else{
            arrayPar1[numeroPar]="";
        }
        
    });

    $(document).on('keyup', '.a_parejastxtup_b textarea:nth-child(1)', function() {
        
        if ($(this).val()!="") {
            arrayPar2[numeroPar]=$(this).val();
        }else{
            arrayPar2[numeroPar]="";
        }
    });

    $('.a_btn-file3 :file').on('fileselect', function(event, numFiles, label) {
        var input = $(this).parents('.a_input-group3').find(':text'),
        log = numFiles > 1 ? numFiles + ' Archivos seleccionados' : label;
        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }
    });
}
function ajusteConte(){
    /*
	* NOMBRE: ajusteConte.
	* UTILIDAD: Ajusta el contenido en relacion al alto y ancho del fondo.
	* ENTRADAS: Ninguna.
	* SALIDAS: Ninguna.
    * VARIABLES***/
    var anchoTotal = $(".d_fondo").width();//Ancho total del fondo
    var altoTotal = $(".d_fondo").height();//Alto total del fondo
    var anchoConte = anchoTotal-50;//Ancho total del contenido
    var margenIzq = -(anchoConte/2);//Margen izquierdo del contenido
    var altoConte = (anchoConte/4)*3;//Alto total del contenido
    var margenSup = -(altoConte/2);//Margen superior del contenido
    /**********/
    $(".d_contenido").css({"width":anchoConte,"margin-left":margenIzq,"height":altoConte,"margin-top":margenSup});
    if(altoConte > (altoTotal-50)){
        altoConte = altoTotal-50;
        anchoConte = (altoConte/3)*4;
        margenIzq = -(anchoConte/2);
        margenSup = -(altoConte/2);
        $(".d_contenido").css({"width":anchoConte,"margin-left":margenIzq,"height":altoConte,"margin-top":margenSup});
    }
    $(".txt4, .txt9").css({"font-size":anchoConte/40,"padding":"0px"});
}

function subeImagen(num){

        if($('.a_btn-file :file').val()!=""){
         var file_data = $('.a_btn-file :file').prop('files')[0];   
                var form_data = new FormData();                  
                form_data.append('file', file_data);
                form_data.append('num', num);
                form_data.append('prefijo', prefijo);

                $.ajax({

                    type: "POST",
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    url:"src/php/subirImagen.php",
                    data: form_data,
                    success: function(data){
                        
                        if (data=="no aceptado") {
                            alert("Formato no permitido")
                        }else{
                           arrayImg[num] = data;
                       $(".agrega"+num).css({"background-image":"url("+arrayImg[num]+")"}); 

                        }
                        

                    }

                })
        }
        
}

function generaArchivos(){
    var banderaGenera = true;
    if (tipoMemorama==1) {
        for(i=1;i<=totalPares;i++){
            if (arrayPar1[i]=="") {
                banderaGenera=false;
                i=totalPares+1;
            };
        }
    }else{
        for(i=1;i<=totalPares;i++){
            if (arrayPar1[i]=="") {
                banderaGenera=false;
                i=totalPares+1;
            };
        }
        for(i=1;i<=totalPares;i++){
            if (arrayPar2[i]=="") {
                banderaGenera=false;
                i=totalPares+1;
            };
        }
    }

    if (banderaGenera!=false) {
        $.ajax({
                    type: "POST",
                    url:"src/php/generaAplicacion.php",
                    data: {htmlAplicacion:htmlAplicacion,
                           arrayColor:arrayColor,
                           arrayImg:arrayImg,
                           arrayBorde:arrayBorde,
                           arrayShadow:arrayShadow,
                           arrayTexto:arrayTexto,
                           arrayPar1:arrayPar1,
                           arrayPar2:arrayPar2,
                           arrayZoom:arrayZoom,
                           arraytipoImg:arraytipoImg,
                           numCartas:numCartas,
                           tipoMemorama:tipoMemorama,
                           arrayFontsize:arrayFontsize,
                           arrayFontfamily:arrayFontfamily,
                           distractoresAdd:distractoresAdd,
                           prefijo:prefijo,
                           arrayRedondear:arrayRedondear
                       },
                    success: function(data){
                      window.location.assign("KrismarApps/index.php?prefijo="+prefijo)
                       console.log(data);
                    }

        })
    }else{
        showEmergente("COMPLETA TODOS LOS PASOS O CAMPOS PARA GENERAR TU APLICACIÓN");
    };
    
}