function Paginator(obj){
  //Inisializa atributos
  this.contenedor = obj.contenedor || ".p_conocecenter";
  this.app = obj.claseApp || ".p_recientebox";
  this.contenedorPaginas = obj.conteNumPaginas || "#paginas_demo";
  this.claseNumPagina = obj.claseNumPagina || "p_actnavnum";
  this.prefijoId = obj.prefijoId || 'app_conf';
  this.nombreFuncionPack = obj.nombreFuncionPack || "actualizapack";
  this.nombreFuncionApps = obj.nombreFuncionApps || "actualizaApps";
  this.claseMiniatura = obj.claseMiniatura || ".p_recienteboxminiatura";

  this.numeroPack;
  this.packPags = obj.packPags || 4;//Valor por default
  this.totalApps;
  this.anchoContenedor;
  this.anchoApp;
  this.cantAppsFila;
  this.filas = obj.filas || 2;
  this.cantAppsPagina;
  this.totalPaginas;
}

Paginator.prototype.asignaIdTodas = function(){
	var contadorId = 0;
	var prefijo = this.prefijoId;
	$(this.contenedor).find(this.app).each(function(index, item){
		$(this).removeAttr("id");
	});
	$(this.contenedor).find(this.app).each(function(index, item){
		contadorId++;
		$(this).attr("id", prefijo + contadorId);
	});
}

Paginator.prototype.ocultaApps = function(){
  //Oculta aplicaciones
  $(this.contenedor).find(this.app).hide();
}
Paginator.prototype.setTotalApps = function(){
  //Obtiene total de apps
  var contador = 0;
  $(this.contenedor).find(this.app).each(function(index, item){
    if($(this).attr("id")){contador++;}
  });
  //Retorna el total
  return contador;
}

Paginator.prototype.setValues = function(mensaje){
    //Asigna valores para paginar
    this.numeroPack = 1;
    this.totalApps = this.setTotalApps();
	//console.log("total de las apps: " + this.totalApps + "en: " + mensaje);
    this.anchoContenedor = $(this.contenedor).width();
    this.anchoApp = $(this.app).width();
    this.cantAppsFila = Math.floor(this.anchoContenedor / this.anchoApp);

    this.cantAppsPagina = this.cantAppsFila * this.filas;

    this.totalPaginas = Math.floor(this.totalApps / this.cantAppsPagina);
    if(this.totalApps%this.cantAppsPagina > 0){
      this.totalPaginas++;
    }
    this.agregaNumerosPagina();
}

Paginator.prototype.actualizaApps = function(indice){
  //Muestra apps por indice de página
  var inicio = ((indice * this.cantAppsPagina) - this.cantAppsPagina)+1;
  var fin = indice * this.cantAppsPagina;
  //console.log(inicio+" - "+fin)
  this.ocultaApps();
  $(this.contenedorPaginas).find("." + this.claseNumPagina).removeClass("p_actnavnum_active");
  $(this.contenedorPaginas).find("." + this.claseNumPagina).each(function(index, item){
    if(Number($(this).text()) == indice){
      $(this).addClass("p_actnavnum_active");
    }
  });
  for(var i = inicio; i <= fin; i++){
    if($(this.contenedor).find("#" + this.prefijoId + i).attr("flash") != undefined){
      var tmp_base = $(this.contenedor).find("#" + this.prefijoId + i).find(this.claseMiniatura).attr("imgsrc");
      $(this.contenedor).find("#" + this.prefijoId + i).find(this.claseMiniatura).find("img").attr("src", tmp_base+"src/img/miniaturas/flash.png");
    }else{
      if($(this.contenedor).find("#" + this.prefijoId + i).find(this.claseMiniatura).find("img").attr("src") == ""){
        var tmp_pref = $(this.contenedor).find("#" + this.prefijoId + i).attr("prefijo");
        var tmp_base = $(this.contenedor).find("#" + this.prefijoId + i).find(this.claseMiniatura).attr("imgsrc");
        $(this.contenedor).find("#" + this.prefijoId + i).find(this.claseMiniatura).find("img").attr("src", tmp_base+""+tmp_pref+".png");

      }
    }

    $(this.contenedor).find("#" + this.prefijoId + i).show();
  }
}

Paginator.prototype.actualizapack = function(elevator){
  var inicio = (((elevator == "++")?++this.numeroPack:--this.numeroPack)*(this.packPags+1))-this.packPags;
  var limite = this.numeroPack*(this.packPags+1);
  $($(this.contenedorPaginas).find("." + this.claseNumPagina)[inicio-1]).trigger("click");
  if(elevator == "--"){
  	$(this.contenedorPaginas).find(".p_actnavarrowright").attr("onclick", ''+this.nombreFuncionPack+'('+"'++'"+')').css("opacity", "1");
  }else{
  	$(this.contenedorPaginas).find(".p_actnavarrowleft").attr("onclick", ''+this.nombreFuncionPack+'('+"'--'"+')').css("opacity", "1");
  }

  $(this.contenedorPaginas).find("."+this.claseNumPagina).each(function(index, item){
    if(index >= (inicio-1) && index <= (limite-1)){
      $(this).show();
    }else{
      $(this).hide();
    };
  });
  if(this.numeroPack == 1){
  	$(this.contenedorPaginas).find(".p_actnavarrowleft").removeAttr("onclick").css("opacity", "0.5");
  }else if(this.numeroPack == Math.ceil(this.totalPaginas/this.packPags)){
  	$(this.contenedorPaginas).find(".p_actnavarrowright").removeAttr("onclick").css("opacity", "0.5");
  }

}

 Paginator.prototype.agregaNumerosPagina = function(){
    var contador = 1;
    var packPags = this.packPags;
    $(this.contenedorPaginas).empty();
    $(this.contenedorPaginas).append('<div class="p_actnavarrowleft"></div>');

    while(contador <= this.totalPaginas){

      $(this.contenedorPaginas).append("<div class = '"+this.claseNumPagina+"' onclick = '"+this.nombreFuncionApps+"("+contador+")'>"+contador+"</div>");
      if(contador%this.packPags == 0){//Es multiplo

        if(contador != this.totalPaginas){
          $(this.contenedorPaginas).append("<div class = '"+this.claseNumPagina+"' >...</div>");
        }
      }
      contador++;
    }
    $(this.contenedorPaginas).find("."+this.claseNumPagina).each(function(index, item){

      if(index > packPags){

        $(this).hide();
      }
    });
    if($(this.contenedorPaginas).find("div").size()>6){
      $(this.contenedorPaginas).append('<div class = "p_actnavarrowright" onclick = "'+this.nombreFuncionPack+'('+"'++'"+')"></div>');
    }else{
      $(this.contenedorPaginas).find(".p_actnavarrowleft").removeAttr("onclick").css("opacity", "0");
      $(this.contenedorPaginas).append('<div class = "p_actnavarrowright" style = "opacity:0;"></div>');
    }

    $($(this.contenedorPaginas).find("."+this.claseNumPagina)[0]).trigger("click");
  }