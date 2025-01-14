var IP = 'http://'+document.domain+'/MEMORAMA_v2/KrismarApps/';
var PREFIJO = IP+'src/img/pruebaProyectoPar';
var TOTACTIVIDADES = 1;var HAYNIVEL = false;
var HAYVELAPP = false;var NIVEL = 5;
var numTarjetas = 6;
var numMaxImg = (6/2)+1;
var numImgMostrar = 6/2;
var tipoMemoria = 1;
var gradosGirar = 180;
var tarjetasDescri = [[1,''],[2,''],[3,''],[4,''],[5,'']];
function iniciaActividad(){
	iniciaDefault();
	generaContenido();
}
