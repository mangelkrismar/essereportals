// Impide utilizar variables no declaradas en Javascript
'use strict';
var app = angular.module("portalApps", ['angularUtils.directives.dirPagination','angular.filter']);
app.directive('windowSize', function ($window) {
  return function (scope, element) {
    var w = angular.element($window);
    scope.getWindowDimensions = function () {
        return {
            'h': w.height(),
            'w': w.width()
        };
	};
		
    scope.$watch(scope.getWindowDimensions, function (newValue, oldValue) {
      scope.windowHeight = newValue.h;
      scope.windowWidth = newValue.w;
    }, true);

    w.bind('resize', function () {
        scope.$apply();
    });
  }
})
// filtro que evita que hayan duplicados dentro de un conjunto
app.filter('unique', function(){
	return function(collection, keyname){
		var output = [], 
		keys = [];
		angular.forEach(collection, function(item){
			var key = item[keyname];
			if(keys.indexOf(key) == -1){
				keys.push(key); 
				output.push(item);
			}
		});
		return output;
	}
});

/*
	Lógica del controlador, se incluyen la variable $scope (hace referencia al controller, sus funciones y variables),
	$http permite hacer uso de ajax y $window permite hacer referencia al objeto window
*/
app.controller("CursoController", function($scope, $http, $window){
	
	// Hace referencia al base_url del proyecto
	$scope.base_url = IP;
	// La url de Krismar Apps
	$scope.kapps_url = IPSRC;
	// Se determina si el usuario ha iniciado sesión
	$scope.logged_in = false;
	
	// Variable de control, se muestran las apps o se muestra la pantalla de inicio
	$scope.verApps = true;

	// Determina si esta en dispositivo movil o no
	$scope.movil = false;

	// Determina si al hacer click en un aplicación, se envían los datos de la aplicación y el usuario a CCDig
	$scope.ccdig = false;
	$scope.ccdig_username = '';
	$scope.ccdig_json_url = '';
	
	// Determinan si se ha hecho click y se estra mostrando el menu correspondiente a cada tipo
	$scope.verGrados   = false;
	$scope.verMaterias = false;
	$scope.verBloques  = false;
	$scope.verMenu     = false;

	// Variable que guarda los objetivos mostrados en un momento dado
	$scope.temasPrueba = [];
	$scope.current_app_objectives = {};
	$scope.current_section = 0;
	$scope.current_section_aux = 0;
	$scope.paginaActual = [1, 1, 1];
	$scope.ultimaPagina = [];
	$scope.paginas = [];
	$scope.paginasFiltradas = [];
	$scope.temasFiltrados = [];
	$scope.filtros = [{},{},{}];

	$scope.appsFiltradasPrimaria = [];
	$scope.appsFiltradasSecundaria = [];
	$scope.appsFiltradasBachillerato = [];
	$scope.appsFiltradasPrimariaIntern = [];
	$scope.appsFiltradasSecundariaIntern = [];
	$scope.appsFiltradasBachilleratoIntern = [];

	$scope.actividadesPorPagina = function(width){
		/*
			De acuerdo con el ancho de la ventana, determina cuantas aplicaciones deben mostrarse
		*/
		if($scope.movil){
			if(width < 521){
				return 2;
			}
			if(width < 681){
				return 4;
			}
			if(width < 861){
				return 6;
			}
			else{
				return 8;
			}
		} else { 
			if(width < 503){
				return 2;
			}
			if(width < 663){
				return 4;
			}
			if(width < 843){
				return 6;
			}
			else{
				return 8;
			}
		}
	};

	$scope.cargarCurso = function(){
		/*
			Recupera información del curso, en este caso, si el usuario ha iniciado sesión,
			si ha iniciado sesión, entonces recupera las aplicaciones, junto con los grados, materias,etc.
			Asi mismo inicializa los valores de los filtros.
			Tambien determina el ancho de los botones si el dispositivo no es móvil y solo hay un grado en el que filtrar
		*/
		$http({
			method:'GET',
			url: $scope.base_url + 'js_config'
		}).then(
			function successCallback(response){
				$scope.logged_in = response.data.logged_in;
				$scope.username = response.data.username;
				$scope.ccdig = response.data.ccdig;
				$scope.ccdig_username = response.data.ccdig_username;
				$scope.ccdig_json_url = response.data.ccdig_json_url;
				$scope.ccdig_nivel_educativo = response.data.ccdig_nivel_educativo;
				
				if($scope.logged_in){
					$http({
						method:'GET',
						url: $scope.base_url + 'apps_json/curso'
					}).then(
						function successCallback(response){
							$scope.aplicaciones = response.data.aplicaciones;
							$scope.grados       = response.data.grados;
							$scope.materias     = response.data.materias;
							$scope.temas        = response.data.temas;
							$scope.error        = response.data.error;

							$scope.limpiarFiltros();
							$scope.cleanAppNames();

							if(!$scope.movil && $scope.grados){
								$scope.estiloBotonFiltro = {
									"width":"50%"
								}
							}
						}, function errorCallback(response){
						}
					);
				}
			}, function errorCallback(response){}
		);	
	}

	$scope.cleanAppNames = function(){
		let temp = [];
		angular.forEach($scope.aplicaciones, function(app) {
			app.n = $('<textarea />').html(app.n).text();
		  	this.push(app);
		},temp);
		$scope.aplicaciones = temp;
	}

	$scope.filtrarGradosConMateria = function(grado){
		var res = false;
		if($scope.filtros.materias){
			angular.forEach($scope.materias, function(mat) {
			  	if(mat.g == grado.i && mat.n == $scope.filtros.materias[0].n){
			  		res = true;
			  	}
			});
			return res;
		}
		return true;
	}

	$scope.filtrarMateriasConGrado = function(materia){
		if($scope.filtros.grados){
			return ($scope.filtros.grados[0].i  == materia.g);
		}
		return true;
	}

	$scope.clasePTema = function(nombre){
		// Devuelve una clase tipo p_tema_hab, debe definirse a que clase corresponde el nombre,
		// Aplica tanto para grados como materias
		if(nombre){
			switch(nombre.toLowerCase()){
				case '1': case 'primer grado' : return 'p_temas_primero';
				case '2': case 'segundo grado': return 'p_temas_segundo';
				case '3': case 'tercer grado' : return 'p_temas_tercero';
				case '4': case 'cuarto grado' : return 'p_temas_cuarto';
				case '5': case 'quinto grado' : return 'p_temas_quinto';
				case '6': case 'sexto grado'  : return 'p_temas_sexto';
				
				case 'atlas'                   : return 'p_temas_atl';
				case 'física'                  : return 'p_temas_fis';
				case 'inglés'                  : return 'p_temas_ing';
				case 'español'                 : return 'p_temas_esp';
				case 'química'                 : return 'p_temas_qui';
				case 'biología'                : return 'p_temas_bio';
				case 'ciencias'                : return 'p_temas_nat';
				case 'desafíos matemáticos'    : return 'p_temas_desafios';
				case 'pensamiento crítico y solución de problemas'    : return 'p_temas_desafios';
				case 'historia'                : return 'p_temas_his';
				case 'geografía'               : return 'p_temas_geo';
				case 'tecnología'              : return 'p_temas_tec';
				case 'habilidades digitales'   : return 'p_temas_tec';
				case 'habilidades'             : return 'p_temas_hab';
				case 'informática'             : return 'p_temas_inf';
				case 'matemáticas'             : return 'p_temas_mat';
				case 'pensamiento matemático'  : return 'p_temas_mat';
				case 'educación física'        : return 'p_temas_efis';
				case 'ciencias naturales'      : return 'p_temas_nat';
				case 'exploración del mundo natural'      : return 'p_temas_nat';
				case 'educación artística'     : return 'p_temas_art';
				case 'expresión artística'     : return 'p_temas_art';
				case 'lecturas de comprensión' : return 'p_temas_lec';
				case 'lenguaje y comunicación' : return 'p_temas_esp';
				case 'formación cívica y ética': return 'p_temas_cye';
				case 'convivencia y ciudadanía': return 'p_temas_cye';
				case 'básicas del pensamiento'                : return 'p_temas_nat';
				case 'r lógico'    : return 'p_temas_desafios';
				case 'r matemático'             : return 'p_temas_mat';
				case 'r verbal' : return 'p_temas_esp';
			}
			return '';
		}
		return '';
	}
	
	$scope.dynamicOrder = function(app) {
		var order = 0;
		if($scope.filtros.tema){
			order = app["p"];
		}else{
			order = ['ogrado','omateria','obloque','oleccion','orden'];
		}
        return order;
    }

	$scope.filtrarCategorias = function(aplicacion){
		/*
			Si se ha seleccionado un filtro para las categorias entonces
			basandose en la categoria de la aplicacion, devuelve un verdadero si entra dentro de alguna de ellas.
		*/
		if( $scope.catAplicacion ||
			$scope.catVideo      ||
			$scope.catLectura    ||
			$scope.catEvaluacion){
			switch (true) {
				case /video/gi.test(aplicacion.c):
					if($scope.catVideo) return true; break;
				case /lectura/gi.test(aplicacion.c):
					if($scope.catLectura) return true; break;
				
				case /evaluacion/gi.test(aplicacion.c):
					if($scope.catEvaluacion) return true; break;
				case /simulador/gi.test(aplicacion.c):
				case /aplicacion/gi.test(aplicacion.c):
				default:
					if($scope.catAplicacion) return true; break;
			}
			return false;
		}
		return true;
	}
	
	$scope.filtrarCurso = function(tipo, param){
		/*
			de acuerdo al tipo (grado, materia, etc), filtra de acuerdo al nombre (param),
			si ya se ha seleccionado ese mismo nombre, desactiva el filtro, si no, lo guarda
			en $scope.filtros.{tipo}
		*/
		switch(tipo){
			case 'grados':
				if($scope.filtros.grados && $scope.filtros.grados[0].n == param[0].n){
					delete $scope.filtros.grados;
					if($scope.filtros.materias !== undefined && $scope.filtros.materias !== null){
						$scope.auxvar1 = $scope.filtros.materias[0];
						$scope.filtros.materias = [];
						angular.forEach($scope.materias, function(mat) {
						  	if(mat.n == $scope.auxvar1.n){
						  		this.push(mat);
						  	}
						},$scope.filtros.materias);
					}
				} else{
					$scope.filtros.grados = param;
					if($scope.filtros.materias !== undefined && $scope.filtros.materias !== null){
						$scope.auxvar1 = $scope.filtros.materias[0];
						$scope.filtros.materias = [];
						angular.forEach($scope.materias, function(mat) {
						  	if(mat.g == $scope.filtros.grados[0].i && mat.n == $scope.auxvar1.n){
						  		this.push(mat);
						  	}
						},$scope.filtros.materias);
					}
				}
				break;
			case 'materias':
				if($scope.filtros.materias && $scope.filtros.materias[0].n == param[0].n){
					delete $scope.filtros.materias;
					delete $scope.filtros.tema;
				} else{
					$scope.filtros.materias = param;
					delete $scope.filtros.tema;
				}
				break;
			case 'tema':
				if($scope.filtros.tema && $scope.filtros.tema == param){
					delete $scope.filtros.tema;
				} else{
					$scope.filtros.tema = param;
				}
				break;
		}
		$scope.resetPagination();
	}

	$scope.filtrarMexico = function(aplicacion){
		/*
			Aquí se filtran las aplicaciones que contienen la palabra méxico, ya sea
			en su nombre, objetivos, palabras clave, etcétera.
			Hay excepciones que no se deben esconder
		*/
		var mex_exceptions = [
			"red_his_5210b",
			"red_geo_5303a",
			"red_geo_5301b",
			"red_geo_4302a",
			"red_geo_4401a",
			"red_geo_4401b",
			"red_his_6301d",
			"red_his_6301e"
		];

		var is_valid = true;
		var str_app = JSON.stringify(aplicacion);
		str_app = str_app.toLowerCase();
		
		if(str_app.includes('méxico')){
			is_valid = false;
		}
		
		mex_exceptions.forEach(function(prefijo){
			if(aplicacion.p == prefijo){
				is_valid = true;
			}
		});

		return is_valid;
	}
	
	$scope.filtrarFlash = function(aplicacion){
		/*
			De acuerdo con el prefijo, determina si la aplicacion es flash o no
		*/
		if($scope.noFlash){
			if((aplicacion.p.indexOf('fla_') == -1)&&(aplicacion.p.indexOf('fls_') == -1)){
				return true;
			}
			return false;
		}
		return true;
	}

	$scope.filtrarGrados = function(aplicacion){
		/*
			Si hay un grado seleccionado determina si una aplicación corresponde al grado,
			si no hay un grado seleccionado deja pasar la aplicacion
		*/
		if($scope.filtros.grados){
			var is_valid = false;
			angular.forEach($scope.filtros.grados, function(grado){
				if(aplicacion.g == grado.i){
					is_valid = true;
					return false;
				}
			});
			return is_valid;
		}
		return true;
	}

	$scope.filtrarGradosEnMaterias = function(grado){
		/*
			Determina que grados contienen la materia seleccionada
		*/
		if($scope.filtros.materias){
			var is_valid = false;
			angular.forEach($scope.filtros.materias, function(materia){
				if(materia.g == grado.i){
					is_valid = true;
					return false;
				}
			});
			return is_valid;
		}
		return true;
	}

	$scope.filtrarMaterias = function(aplicacion){
		/*
			Si hay una materia seleccionada determina si una aplicación corresponde a la materia,
			si no hay una materia seleccionada deja pasar la aplicacion
		*/
		if($scope.filtros.materias){
			var is_valid = false;
			angular.forEach($scope.filtros.materias, function(materia){
				if(aplicacion.obloque == materia.b){
					is_valid = true;
				}
			});
			return is_valid;
		}
		return true;
	}

	$scope.filtrarTemasParaMateria = function(tema){
		var omitir = [];
		switch($scope.filtros.materias[0].n){
			case "Atlas":
				omitir = ["México a finales s. XX y s. XXI"];
				break;
			case "Ciencias":
			case "Ciencias naturales":
				omitir = ["Básicas del pensamiento","Razonamiento matemático","Leer me encanta","Geometría","Edad Moderna y el Renacimiento","México a finales s. XX y s. XXI"];
				break;
			case "Desafíos":
				omitir = ["Primeros años de la vida independiente"];
				break;
			case "Educación Artística":
				omitir = [];
				break;
			case "Educación Física":
				omitir = [];
				break;
			case "Lenguaje y comunicación":
			case "Español":
				omitir = ["Dinámica interna de la Tierra","Dieta, sobrepeso y obesidad","Edad Media y el Islam","Básicas del pensamiento","Razonamiento matemático","Introducción a la química","De los caudillos a las instituciones","Desastres naturales y riesgos","Porcentajes","Población y migración"];
				break;
			case "Formación Civica y Ética":
				omitir = [];
				break;
			case "Geografía":
				omitir = ["Mesoamérica y los Andes","Célula, unidad estructural de los seres vivos","México a finales s. XX y s. XXI","De los caudillos a las instituciones"];
				break;
			case "Habilidades":
				omitir = [];
				break;
			case "Historia":
				omitir = ["Sustentabilidad y deterioro del medio","Sustentabilidad y deterioro del medio ambiente"];
				break;
			case "Lecturas de comprensión":
				omitir = [];
				break;
			case "Matemáticas":
				omitir = ["Relieve, conformación y distribución","Básicas del pensamiento"];
				break;
			case "Tecnología":
				omitir = ["Razonamiento matemático","Edad Moderna y el Renacimiento","Saca 10 en español","Básicas del pensamiento","Recta numérica"];
				break;
			default:
				omitir = [];
				break;
		}
		return tema.filter(function(element) {
			if(omitir.indexOf(element) != -1)
				return false;
			else
				return true;
		});
	}

	$scope.filtrarTemasEnMateria = function(tema){
		/*
			Determina que temas contiene la materia seleccionada
		*/
		if($scope.filtros.materias){
			if($scope.filtros.grados){
				var m;
				angular.forEach($scope.filtros.materias, function(mat){
					if(mat.g == $scope.filtros.grados[0].i){
						m=mat.i;
					}
				});
				var res = [];
				angular.forEach($scope.temas[m], function(entry){
					if(res.indexOf(entry) == -1){
						res.push(entry);
					}
				});
				return $scope.filtrarTemasParaMateria(res.map(function(tema) {
				    return tema.substring(2, tema.length-2);
				}));
			}else{
				var res = [];
				angular.forEach($scope.filtros.materias, function(mat){
					angular.forEach($scope.temas[mat.i], function(entry){
						if(res.indexOf(entry) == -1){
							res.push(entry);
						}
					});
				});
				return $scope.filtrarTemasParaMateria(res.map(function(tema) {
				    return tema.substring(2, tema.length-2);
				}));
			}
		}
		return [];
	}

	$scope.doGetAppClickAction = function(aplicacion, windowReference){
		/*
			Cuando se selecciona una aplicacion, el comportamiento es distinto en movil y en pc
		*/
        if(!aplicacion.i && aplicacion.id_aplicacion){aplicacion.i=aplicacion.id_aplicacion}
		if($scope.movil){
			$scope.muestraInfoNg(
				aplicacion.i,
				aplicacion.n,
				$scope.getAppThumbnail(aplicacion.p)
			);
		} else{
			$scope.abrirApp(aplicacion, windowReference);
		}
	}

	$scope.getAppClickAction = function(aplicacion){
		var windowReference = null;
		var isSafari = navigator.vendor && navigator.vendor.indexOf('Apple') > -1 &&
               navigator.userAgent &&
               navigator.userAgent.indexOf('CriOS') == -1 &&
               navigator.userAgent.indexOf('FxiOS') == -1;
		if($scope.logged_in){
			if(isSafari && !$scope.movil){
				windowReference = window.open("","_blank");
			}
			$http({
				method:'GET',
				url: $scope.base_url + 'Home/ValidarSesion'
			}).then(
				function successCallback(response){
					if(response.data=="false"){
						if(isSafari && !$scope.movil){
							windowReference.close();
						}
						muestraIngresar("Tu sesión ha sido abierta en otro dispositivo\nPor favor ingresa nuevamente.");
						//$window.location.reload();
					}else{
						$scope.doGetAppClickAction(aplicacion, windowReference);
					}
				}, function errorCallback(response){
				}
			);
		}else{
			$scope.doGetAppClickAction(aplicacion, windowReference);
		}
	}

	$scope.abrirApp= function(aplicacion, windowReference){
		/*
			Al hacer click en una aplicación se envía un JSON con la información de la aplicacióna una URL remota
		 */
		if($scope.ccdig){
			var remote_url = $scope.ccdig_json_url;
			
			var app_info = {
				usuario    : $scope.ccdig_username,
				grado      : $scope.getNombre('grado',aplicacion.g),
				materia    : $scope.getNombre('materia',aplicacion.m),
				aplicacion : aplicacion.n,
				nivel      : $scope.ccdig_nivel_educativo
			}
			
			$http.post(
				remote_url,
				app_info
			).then(function successCallback(response){
			},function errorCallback(response){
			});
		}
		//Aqui se debe de cambiar para lg
		//window.open($scope.kapps_url + "index.php/recurso/cargarApp/"+aplicacion.i+"/primaria");
		//alert(app_info[usuario]);
		var empresa = "";
		if(qES == 1){ 
			empresa = "LG";
		}else if(qES == 2){ 
			empresa = "LIMA";
		}else{ 
			empresa = "primaria";
		}

		if(windowReference!=null){
			windowReference.location = $scope.kapps_url + "recurso/cargarApp/"+aplicacion.i+"/"+empresa;
		}else{
			window.open($scope.kapps_url + "recurso/cargarApp/"+aplicacion.i+"/"+empresa);
		}
	}

	/*    GOOGLE CLASSROOM     */
	$scope.enviaGClass = function(flag,app_id){ 		
		/*
			Recupera el ID de la aplicación que se desea compartir y lo almacena para que lo use la API (para PC)
		*/
		if(!flag)
    		setID(app_id.p, app_id.n, app_id.i, app_id.c);
	}
	$scope.setCategoria = function(catego){ 		
		/*
			Recupera La categoria de la aplicación y la asigna a la variable appCategoria, para saber como se calificará
		*/
		if(catego=="video"||catego=="lectura"){
			appCategoria2 = catego;
		}else{
			appCategoria2 = "aplicacion";
		}
	}
	$scope.showHideElement = function(idElement, indi){
		if(indi == 's'){ //Mostrar elemento
			$('#'+idElement).show();
		}else{
			$('#'+idElement).hide();
		}
	}
	/*					    */

	$scope.getAppLink = function(id_aplicacion){
		/*
			Devuelve el enlace a la app basándose en su id
		*/
		return $scope.kapps_url + "recurso/cargarApp/"+id_aplicacion+"/primaria";
		
	}

	$scope.getAppObjetivos = function(app){
		/*
			Limpia los objetivos mostrados actualmente,
			Recupera los objetivos de una aplicacion en particualar
			Separa los objetivos.
			Si esta en un dispositivo movil, concatena cada objetivo en una lista para ser mostrados
			Si no, conserva el array de objetivos para mostrarlo al pasar el mouse encima
		*/
		var id_app = app.i;
		$scope.current_app_objectives = {}
		var str_objetivos = app.o;
		var array_objetivos = str_objetivos.split('-');
		array_objetivos.shift();
		if(array_objetivos.length > 3){
			array_objetivos = array_objetivos.slice(0,3);
		}
		if($scope.movil){
			$.each(array_objetivos, function(index,item){
				$("#objetivo_info").append("<li>"+item+"</li>");
			});
		} else{
			$scope.current_app_objectives = array_objetivos;
		}
	}

	$scope.getAppThumbnail = function(prefijo){
		/*
			De acuerdo al prefijo, recupera las miniaturas de las aplicaciones,
			si es una aplicacion flash recupera la misma miniatura
		*/
		if((prefijo.indexOf('fla_') == 0)||(prefijo.indexOf('fls_') == 0)){
			return $scope.kapps_url + "src/img/miniatura/flash.png";
		}
		if(prefijo.indexOf('red_pla_') == 0){
			return $scope.kapps_url + "src/img/miniatura/red_pla.png";
		}
		return $scope.kapps_url + "src/img/miniatura/"+prefijo+".png";
	}

	$scope.getNombre = function(tipo, id){
		/*
			Recupera el nombre del grado, materia, etc de acuerdo al tipo usando su id.
		*/
		var nombre = tipo + ": " + id;
		var objArr;
		
		switch(tipo){
			case "grado":   objArr = $scope.grados;    break;
			case "materia": objArr = $scope.materias;  break;
		}

		if(objArr){
			angular.forEach(objArr, function(obj){
				if(id == obj.i){
					nombre = obj.n;
					return false;
				}
			});
		}
		return nombre;
	}

	$scope.limpiarFiltros = function(conservarCategorias){
		/*
			Vacia el contenido de los filtros, tanto de grados y materias, asi como los de categorias,
			asi mismo resetea la paginacion a la pagina 1 y remueve el filtro para no mostrar flash
		*/
		if(!conservarCategorias){
			$scope.resetCategorias();
		}
		$scope.filtros = {};
		$scope.resetPagination();
		if($scope.noFlash && !$scope.movil){
			$scope.toggleNoFlash();
		}
	}

	$scope.mostrarApps = function(){
		/*
			Cambia la pagina principal por las aplicaciones y hace scroll a la barra de búsqueda
		*/
		$scope.verApps = true;
		// $("body").stop().animate({scrollTop: $("#buscar").offset().top - (altoNavegacion + 20)}, 500);
		// $("#iconregresarlibro, #libros_sep, #libros_sep2, #clasicos, #GRcontainer").hide();
	}

	$scope.mostrarMenu = function(menu){
		/*
			Determina si se esta mostrando un menu, que tipo de menu, y si ya se esta mostrando lo oculta.
		*/
		if($scope.verGrados && menu == 'grados'){
			$scope.ocultarMenu();	
		} else if($scope.verMaterias && menu == 'materias'){
			$scope.ocultarMenu();	
		} else if($scope.verBloques && menu == 'bloques'){
			$scope.ocultarMenu();	
		} else{
			$scope.ocultarMenu();
			switch(menu){
				case 'grados':
					$scope.verGrados = true;
					$scope.verMenu   = true;
					break;
				case 'materias':
					$scope.verMaterias = true;
					$scope.verMenu     = true;
					break;
				case 'bloques':
					$scope.verBloques = true;
					$scope.verMenu    = true;
					break;
			}
		}
	}

	$scope.muestraInfoNg = function(rel,nombre, img){
		/*
			Si esta en un dispositivo movil, muestra una ventana emergente con la informacion de la aplicacion
			y permite abrirla
		*/
		$("#objetivo_info").empty();
		$("#nombre_info").text(nombre);
		$("#play_info").attr("onclick", "playDemo("+rel+", '"+nombre+"')");
		$("#play_info").css("background-image", "url("+img+")");
		$(".p_emergenteusuario").fadeIn("fast");
		$("#info_app").css({"display":"table"});
		colocaEmergente('noFiltra');
		bandInfo = true;
	}

	$scope.checkForNet = function(whereTo, typ){
		let url = `${$scope.base_url}/home/is_connected`;
		$.get( url, function( data ) {
			if(data == "false"){
				muestraNoInternet();
				return true;
			}
			if(typ == "url"){
				window.open(whereTo,'_blank');
			}
			if(typ == "fun"){
				window[whereTo]();
			}
		});
	}

	$scope.ocultarApps = function(){
		/*
			Resetea los filtros, oculta los menus y cambia a la pagina principal, haciendo scroll a la barra de busqueda
		*/
		$scope.limpiarFiltros();
		$scope.ocultarMenu();
		// $scope.verApps = false;
		$("body").stop().animate({scrollTop: $("#buscar").offset().top - (altoNavegacion + 20)}, 500);
		$("#iconregresarlibro, #libros_sep, #libros_sep2, #clasicos, #GRcontainer").hide();
	}

	$scope.ocultarMenu = function(){
		/*
			Esconde los menus de seleccion
		*/
		$scope.verMenu     = false;
		$scope.verGrados   = false;
		$scope.verMaterias = false;
		$scope.verBloques  = false;
	}

	$scope.openApp = function(id_aplicacion){
		/*
			Abre la aplicacion en otra pestaña,
			se utiliza la funcion playDemo previamente declarada fuera del controller,
			pero se deja como posible referencia
		*/
		window.open($scope.getAppLink(id_aplicacion), '_blank');
	}

	$scope.resetCategorias = function(){
		/*
			resetea las categorias para deseleccionar todas
		*/
		$scope.catAplicacion = false;
		$scope.catVideo      = false;
		$scope.catLectura    = false;
		$scope.catEvaluacion = false;
	}

	$scope.resetPagination = function(){
		/*
			Cambia la pagina actual a la 1
		*/
		$scope.pagination = {
			current: 1
		};
	}

	$scope.toggleCategoria = function(categoria){
		/*
			Activa o desactiva una categoria seleccionada
			resetea la paginacion a la pagina 1
		*/
		switch(categoria){
			case 'aplicacion':
				$scope.catAplicacion = !$scope.catAplicacion;
				if($scope.catAplicacion){gtag('event','click',{'event_category':categoria});}
				break;
			case 'video':
				$scope.catVideo = !$scope.catVideo;
				if($scope.catVideo){gtag('event','click',{'event_category':categoria});}
				break;
			case 'evaluacion':
				$scope.catEvaluacion = !$scope.catEvaluacion;
				if($scope.catEvaluacion){gtag('event','click',{'event_category':categoria});}
				break;
			case 'lectura':
				$scope.catLectura = !$scope.catLectura;
				if($scope.catLectura){gtag('event','click',{'event_category':categoria});}
				break;
		}
		$scope.resetPagination();
	}

	$scope.toggleNoFlash = function(){
		/*
			Oculta o muestra las aplicaciones flash,
			controla la animación del botón de PC o Móvil
		*/
		$(".p_switchbtnin").animate({"left":""+($scope.noFlash?34:2)+"px"});
		$scope.noFlash = !$scope.noFlash;
		$scope.resetPagination();
	}

	$scope.getClassForCategoria = function(categoria) {
		switch (true) {
			case /videoT/gi.test(categoria):
				return "p_recienteboxicon_videoT"
			case /video/gi.test(categoria):
				return "p_recienteboxicon_video"
			case /lectura/gi.test(categoria):
				return "p_recienteboxicon_lectura"
			case /simuladorCL/gi.test(categoria):
				return "p_recienteboxicon_simuladorCL"
			case /simulador/gi.test(categoria):
				return "p_recienteboxicon_simuladorI"
			case /evaluacionP/gi.test(categoria):
				return "p_recienteboxicon_evalC"
			case /evaluacion/gi.test(categoria):
				return "p_recienteboxicon_evalC"
			case /aplicacionL/gi.test(categoria):
				return "p_recienteboxicon_appL"
			case /aplicacion/gi.test(categoria):
			default:
				return "p_recienteboxicon_app"
		}
	}
	$scope.aplicacionesDem = false;
	$scope.cargaAppsDem = function (){
		$http({
			method:'GET',
			url: $scope.base_url + 'apps_json/demapps'
		}).then(
			function successCallback(response){
				$scope.appsFiltradasPrimariaIntern = response.data.primaria;
				$scope.appsFiltradasSecundariaIntern = response.data.secundaria;
				$scope.appsFiltradasBachilleratoIntern = response.data.bachillerato;
				$scope.paginate2();
				$scope.aplicacionesDem = true;
			}, function errorCallback(response){
			}
		);
	}
	$scope.filterForPages = function(page){
		var output = [];
		if(page.length > 0){
			output.push(page[0]);
			if(page[page.length-1]!=null && !output.includes(page[page.length-1])){
				output.push(page[page.length-1]);
			}
			var keep = true;
			if(page[$scope.paginaActual[$scope.current_section]-1]!=null && !output.includes(page[$scope.paginaActual[$scope.current_section]-1])){
				output.push(page[$scope.paginaActual[$scope.current_section]-1]);
				keep=false;
			}
			if(keep && page[$scope.paginaActual[$scope.current_section]-2]!=null && !output.includes(page[$scope.paginaActual[$scope.current_section]-2])){
				output.push(page[$scope.paginaActual[$scope.current_section]-2]);
				keep=false;
			}
			if(keep && page[$scope.paginaActual[$scope.current_section]]!=null && !output.includes(page[$scope.paginaActual[$scope.current_section]])){
				output.push(page[$scope.paginaActual[$scope.current_section]]);
				keep=false;
			}
		}
		return output;
	}
	$scope.crearPaginas = function(pags){
		var output = [];
		var i;
		for (i=0; i < pags; i++){
			output.push(i+1);
		}
		return output;
	}

	$scope.paginate2 = function(){
		var n = $scope.actividadesPorPagina($scope.windowWidth);
		switch($scope.current_section){
			case 0:
				$scope.appsFiltradasPrimaria = $scope.appsFiltradasPrimariaIntern.slice(($scope.paginaActual[0]-1)*n,($scope.paginaActual[0])*n);
				$scope.appsFiltradasSecundaria = $scope.appsFiltradasSecundaria.slice(0,n);
				$scope.appsFiltradasBachillerato = $scope.appsFiltradasBachillerato.slice(0,n);
				$scope.paginas[$scope.current_section] = $scope.crearPaginas(Math.ceil($scope.appsFiltradasPrimariaIntern.length/n));
				break;
			case 1:
				$scope.appsFiltradasSecundaria = $scope.appsFiltradasSecundariaIntern.slice(($scope.paginaActual[1]-1)*n,($scope.paginaActual[1])*n);
				$scope.appsFiltradasPrimaria = $scope.appsFiltradasPrimaria.slice(0,n);
				$scope.appsFiltradasBachillerato = $scope.appsFiltradasBachillerato.slice(0,n);
				$scope.paginas[$scope.current_section] = $scope.crearPaginas(Math.ceil($scope.appsFiltradasSecundariaIntern.length/n));
				break;
			case 2:
				$scope.appsFiltradasBachillerato = $scope.appsFiltradasBachilleratoIntern.slice(($scope.paginaActual[2]-1)*n,($scope.paginaActual[2])*n);
				$scope.appsFiltradasPrimaria = $scope.appsFiltradasPrimaria.slice(0,n);
				$scope.appsFiltradasSecundaria = $scope.appsFiltradasSecundaria.slice(0,n);
				$scope.paginas[$scope.current_section] = $scope.crearPaginas(Math.ceil($scope.appsFiltradasBachilleratoIntern.length/n));
				break;
		}
		$scope.paginasFiltradas[$scope.current_section] = $scope.filterForPages($scope.paginas[$scope.current_section]);
	}
	$scope.mostrarApps();

	$(window).scroll(function() {
		var wh = $(document).height() - $(window).height();
		var minimized = $(".p_header").css("position") == "fixed";
		var localMovil = $('#is_movil').length==0;
		if(localMovil){
			if($("body").scrollTop() < wh*2.72/12){
				$scope.current_section = 0;
			}else if ($("body").scrollTop() < wh*7.55/12) {
				$scope.current_section = 1;
			}else {
				$scope.current_section = 2;
			}
		}else {
			if(minimized) {
				if($("body").scrollTop() < wh*5.2/12){
					$scope.current_section = 0;
				}else if ($("body").scrollTop() < wh*10.35/12) {
					$scope.current_section = 1;
				}else {
					$scope.current_section = 2;
				}
			} else {
				if($("body").scrollTop() < wh*5.8/12){
					$scope.current_section = 0;
				}else if ($("body").scrollTop() < wh*9.9/12) {
					$scope.current_section = 1;
				}else {
					$scope.current_section = 2;
				}
			}
		}
		$scope.changesForSection(false);
	});

	$scope.changesForSection = function(attr){
		if($scope.current_section != $scope.current_section_aux || attr){
			$scope.current_section_aux = $scope.current_section;
			$scope.paginaActual[$scope.current_section] = 1;
			$scope.paginate2();
			try{
				$scope.$digest();
			}catch(e){
			}
		}
	}
});

