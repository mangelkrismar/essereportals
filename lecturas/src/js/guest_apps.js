var $pagActual = 1;
var $totalAppsVisibles = 0;
$pagSeccion = 1;

$(document).ready(function(){
	$(".p_recientebox").removeClass(".p_iniciacarga");
	$totalAppsVisibles = $("#totalAppsC").val();
	mostrarApps();
	//filtrarAppsGuest();
	
	$("#p_actnavarrowleft").click(function() {
		if ($pagSeccion > 1) {
			$pagSeccion--;
			$pagActual = (($pagSeccion-1) * 4) + 1;
			//filtrarAppsGuest();
			mostrarApps();
		}
	});

	$("#p_actnavarrowright").click(function() {
		if ($pagSeccion < (Math.ceil($totalAppsVisibles / $numeroApps)) / 4) {
			$pagSeccion++;
			$pagActual = (($pagSeccion-1) * 4) + 1;
			mostrarApps();
		}

	});	
});

var xhr = [];//Imgs a precargar
var xhr1 = null;
var xhr2 = null;
var xhr3 = null;
var xhr4 = null;
var xhr5 = null;
var xhr6 = null;

function mostrarApps(){
	if(disp == "movil" || $(".recienteicon").css("display") === "flex" || $(".recienteicon").css("display") === "block"){
		
		$clase = "p_resalteminiatura_over";
		
		
	}else{
		$clase = "p_resalteminiatura";
		
		
	}
	$(".p_recienteboximg").removeClass("p_resalteminiatura_over");
	$(".p_recienteboximg").removeClass("p_resalteminiatura");
	$(".p_recienteboximg").addClass($clase);
	if(xhr1!=null)xhr1.abort();
	if(xhr2!=null)xhr2.abort();
	if(xhr3!=null)xhr3.abort();
	if(xhr4!=null)xhr4.abort();
	if(xhr5!=null)xhr5.abort();
	if(xhr6!=null)xhr6.abort();
	xhr1 = null;
	xhr2 = null;
	xhr3 = null;
	xhr4 = null;
	xhr5 = null;
	xhr6 = null;
	for(var indx in xhr){
		//xhr[indx].abort();
	}	
	xhr = [];//Imgs a precargar
	var item = 0;
	var url = IPSRC + "src/img/miniatura/";
	//Cantidad de Apps que caben en en una pagina
	$arImgsAjax = [];
	$numeroApps = 6 * (Math.floor($(".p_conocecenter").width()/$(".p_recientebox").width()));
	

	$("#paginas_demo").empty();


	$(".p_recientebox").hide();
	$contador = 0;
	
	for($i = ($numeroApps * $pagActual)-$numeroApps;$i<($numeroApps * $pagActual);$i++){
		var divACTUAL = $($(".p_recientebox")[$i]);
		$click = ($clase == "p_resalteminiatura_over")?"muestraInfo($(this),"+divACTUAL.attr('rel')+",'"+divACTUAL.attr('name')+"', '"+IPSRC+"src/img/miniatura/"+divACTUAL.attr('imgsrc')+".png')":"playDemo("+ divACTUAL.attr('rel') +", '"+divACTUAL.attr('name')+"', 'Conoce')";
		
		$(divACTUAL).find(".p_recienteinfoplayicon").attr("onclick", $click);
		
		
		if(divACTUAL.size() !== 0){
		$contador++;

		divACTUAL.find(".p_recienteboximg").find(".p_recienteboxminiatura").css({"background-image":"url("+IPSRC+"src/img/miniatura/"+divACTUAL.attr("imgsrc")+".png)"});

		divACTUAL.show();
	}
	
	for(var indx in xhr){
		//xhr[indx].abort();
		console.log(xhr[indx])
		//eval(xhr[indx])
	}	

	

	//if($arImgsAjax.length > 0)xhrImg();

	function xhrImg(){
		xhr.push($.get(
			url+$arImgsAjax[item]+".png"
		).done(function(){
			
			//$("[imgsrc = '"+$arImgsAjax[item]+"']").find(".p_recienteboxminiatura").css({"background-image":"url("+url+$arImgsAjax[item]+".png)"});
			$("[imgsrc = '"+$arImgsAjax[item]+"']").attr("imgReady", true);

			if(item < $arImgsAjax.length-1){
				item++;
				xhrImg();
			}else{
				xhr = [];//Imgs a precargar
			}
		}));
	}


}
	for ( $i = ($pagSeccion * 4) - 3; $i <= ($pagSeccion * 4); $i++) {
			
		if (Math.ceil($totalAppsVisibles / $numeroApps) >= $i) {
			
			$("#paginas_demo").append("<div id = 'pagina"+$i+"' class='p_actnavnum' onclick='paginaActual(this)'>"+$i+"</div>");

		}

	}
	
	if (Math.ceil($totalAppsVisibles / $numeroApps) > ($pagSeccion * 4)) {

		$("#paginas_demo").append("<div class='p_actnavnum'>...</div>");

		$('#p_actnavarrowleft').css("opacity", 1);

		$('#p_actnavarrowright').css("opacity", 1);

		$('#p_actnavarrowleft').css('cursor','pointer');

		$('#p_actnavarrowright').css('cursor','pointer');

	}

	else{

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
	
	if($totalAppsVisibles == 0){
		$(".p_conte_notificacion").show();
		$(".p_conte_notificacion").css("height","424px");
	}else{
		$(".p_conte_notificacion").hide();
	}
	
}
function paginaActual(element) {
	
	$pagActual = parseInt(element.textContent);
	mostrarApps();
	$(".p_recientebox").css("background-image", "none");
	//filtrarAppsGuest();

}