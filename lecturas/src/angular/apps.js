// Impide utilizar variables no declaradas en Javascript
'use strict';

/*
	Declaración de la app, se especifican algunos modulos extras, estos están declarados en otros archivos
	dentro de un tag de sript dentro del header
*/
var app = angular.module("portalApps", ['angularUtils.directives.dirPagination','angular.filter']);
// Directiva que permite determinar el ancho de la ventana en tiempo real
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
    	scope.paginate();
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
			if(keys.indexOf(key) === -1){
				keys.push(key); 
				output.push(item);
			}
		});
		return output;
	}
});

app.filter('filtrarMaterias', function(){
	return function(collection, $scope){
		return collection;
	}
});

app.filter('filtrarGrados', function(){
	return function(collection, $scope){
		var output = [];
		if($scope.filtros[$scope.current_section].grados){
			angular.forEach(collection, function(aplicacion){
				var is_valid = false;
				angular.forEach($scope.filtros[$scope.current_section].grados, function(grado){
					if(aplicacion.g == grado.i){
						is_valid = true;
					}
				});
				if(is_valid){
					output.push(aplicacion);
				}
			});
			return output;
		}else{
			return collection;
		}
	}
});

app.filter('filtrarCategorias', function(){
	return function(collection, $scope){
		var output = [];
		if($scope.catAplicacion || $scope.catVideo || $scope.catLectura || $scope.catEvaluacion){
			angular.forEach(collection, function(aplicacion){
				var is_valid = false;
				switch(aplicacion.c){
					case 'aplicacion': case 'aplicacionL': case 'simuladorCL':
						if($scope.catAplicacion){
							is_valid = true;
						}
						break;
					case 'evaluacionC':
						if($scope.catEvaluacion){
							is_valid = true;
						}
						break;
					case 'lectura':
						if($scope.catLectura){
							is_valid = true;
						}
						break;
					case 'video': case 'videoT':
						if($scope.catVideo){
							is_valid = true;
						}
						break;
				}
				if(is_valid){
					output.push(aplicacion);
				}
			});
			return output;
		}else{
			return collection;
		}
	}
});

app.filter('filtrarFlash', function(){
	return function(collection, $scope){
		var output = [];
		if($scope.noFlash){
			angular.forEach(collection, function(aplicacion){
				if((aplicacion.p.indexOf('fla_') === -1)&&(aplicacion.p.indexOf('fls_') === -1)){
					output.push(aplicacion);
				}
			});
			return output;
		}else{
			return collection;
		}
	}
});

/*
	Lógica del controlador, se incluyen la variable $scope (hace referencia al controller, sus funciones y variables),
	$http permite hacer uso de ajax y $window permite hacer referencia al objeto window
*/
app.controller("CursoController", ['$scope','$http','$window','$filter',function($scope, $http, $window, $filter, ApplicationRef){
	
	// Hace referencia al base_url del proyecto
	$scope.base_url = IP;
	// La url de Krismar Apps
	$scope.kapps_url = IPSRC;
	// Se determina si el usuario ha iniciado sesión
	$scope.logged_in = false;
	
	// Variable de control, se muestran las apps o se muestra la pantalla de inicio
	$scope.verApps = false;

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

	$scope.temasPrueba = [];

	// Variable que guarda los objetivos mostrados en un momento dado
	$scope.current_app_objectives = {};

	// Variable que indica el segmento de la página en la que se encuentra (0=Primaria,1=Secundaria,2=Bachillerato)
	$scope.current_section = 0;
	$scope.current_section_aux = 0;
	// Variables para paginacion
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

	$('.p_navsupinbtn.p_in2').stop().animate({"color":"#f1db0c"}, 100);

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
			if($scope.logged_in){
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
			}else{
				if(width < 680){
					return 2;
				}
				if(width < 860){
					return 4;
				}
				if(width < 1024){
					return 6;
				}
				else{
					return 8;
				}
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
						url: $scope.base_url + 'apps_json/cursoByID'
					}).then(
						function successCallback(response){
							$scope.aplicaciones = response.data['aplicaciones'];
							$scope.grados       = response.data['grados'];
							$scope.materias     = response.data['materias'];
							$scope.temas        = response.data['temas'];
							$scope.error        = response.data.error;

							//////////////////////////////////////////////////////////////////////////////////////////
							//                                     EXPERIMENTAL                                     //
							//////////////////////////////////////////////////////////////////////////////////////////
							$scope.secundaria = [];
							$scope.bachillerato = [];

							$scope.secundaria.aplicaciones 	= angular.copy(response.data['aplicaciones']);
							$scope.secundaria.grados 		= angular.copy(response.data['grados']);
							$scope.secundaria.materias 		= angular.copy(response.data['materias']);
							$scope.secundaria.temas 		= angular.copy(response.data['temas']);
							$scope.secundaria.error 		= angular.copy(response.data.error);

							$scope.bachillerato.aplicaciones 	= angular.copy(response.data.aplicaciones);
							$scope.bachillerato.grados 			= angular.copy(response.data.grados);
							$scope.bachillerato.materias 		= angular.copy(response.data.materias);
							$scope.bachillerato.temas 			= angular.copy(response.data.temas);
							$scope.bachillerato.error 			= angular.copy(response.data.error);


							$scope.grados = $scope.chop('primaria','grad',$scope.grados);
							$scope.secundaria.grados = $scope.chop('secundaria','grad',$scope.secundaria.grados);
							$scope.bachillerato.grados = $scope.chop('bachillerato','grad',$scope.bachillerato.grados);
							$scope.aplicaciones = $scope.chop('primaria','apps',$scope.aplicaciones);
							$scope.secundaria.aplicaciones = $scope.chop('secundaria','apps',$scope.secundaria.aplicaciones);
							$scope.bachillerato.aplicaciones = $scope.chop('bachillerato','apps',$scope.bachillerato.aplicaciones);
							
							$scope.materias = $scope.chop('primaria','apps',$scope.materias);
							$scope.secundaria.materias = $scope.chop('secundaria','apps',$scope.secundaria.materias);
							$scope.bachillerato.materias = $scope.chop('bachillerato','apps',$scope.bachillerato.materias);
							$scope.temas = $scope.chop('primaria','tema',$scope.temas);
							$scope.secundaria.temas = $scope.chop('secundaria','tema',$scope.secundaria.temas);
							$scope.bachillerato.temas = $scope.chop('bachillerato','tema',$scope.bachillerato.temas);

							//////////////////////////////////////////////////////////////////////////////////////////
							
							$scope.limpiarFiltros();

							/*if($scope.grados.length == 1 && $scope.materias.length == 1){
								$scope.verApps = true;
								$scope.filtrarCurso('grados',$scope.grados);
								$scope.filtrarCurso('materias',$scope.materias);
							}*/
							if($scope.materias.length > 1 && ($scope.materias[0].n == 'Lecturas de comprensión' || $scope.materias[0].n == 'Lenguaje y Comunicación')){
								$scope.filtrarCurso('materias',$scope.materias);
							}

							/*
							if(!$scope.movil && $scope.grados){
								if($scope.grados.length == 1){
									$scope.estiloBotonFiltro = {
										"width":"50%"
									}
								} else {
									$scope.estiloBotonFiltro = {
										"width":"33.33%"
									}
								}
							}
							*/
						}, function errorCallback(response){
						}
					);
				}
			}, function errorCallback(response){}
		);	
	}

	$scope.forThisGrade = function(seccion, grado){
		var valid = false;
		angular.forEach(seccion, function(gra) {
			if(gra.i == grado){
				valid = true;
			}
		});
		return valid;
	}

	$scope.forThisMat = function(seccion, tem){
		return seccion.map(mat => mat.i).includes(tem);
	}


	$scope.chop = function(seccion, tipo, arreglo){
		/*funcion que separa los datos de primaria, secundaria y bachillerato, requiere que los arreglos de scope esten completos*/
		var arr = [];
		switch(seccion){
			case 'primaria':
				switch(tipo){
					case 'apps'://requiere de grados
						angular.forEach(arreglo, function(app) {
							if($scope.forThisGrade($scope.grados,app.g)){
								this.push(app);
							}
						}, arr);
						return arr;
					case 'grad':
						angular.forEach(arreglo, function(grado) {
							if(grado.n.match(/\d+/) < 7){
								this.push(grado);
							}
						}, arr);
						return arr;
					case 'tema'://requiere materias
						angular.forEach(arreglo, function(tem, key) {
							if($scope.forThisMat($scope.materias,key)){
								this.push([key, tem]);
							}
						}, arr);
						return arr;
				}
				break;
			case 'secundaria':
				switch(tipo){
					case 'apps'://requiere de grados
						angular.forEach(arreglo, function(app) {
							if($scope.forThisGrade($scope.secundaria.grados,app.g)){
								this.push(app);
							}
						}, arr);
						return arr;
					case 'grad':
						angular.forEach(arreglo, function(grado) {
							if(grado.n.match(/\d+/) > 6 && grado.n.match(/\d+/) < 10){
								this.push(grado);
							}
						}, arr);
						return arr;
					case 'tema'://requiere materias
						angular.forEach(arreglo, function(tem, key) {
							if($scope.forThisMat($scope.secundaria.materias,key)){
								this.push([key, tem]);
							}
						}, arr);
						return arr;
				}
				break;
			case 'bachillerato':
				switch(tipo){
					case 'apps'://requiere de grados
						angular.forEach(arreglo, function(app) {
							if($scope.forThisGrade($scope.bachillerato.grados,app.g)){
								this.push(app);
							}
						}, arr);
						return arr;
					case 'grad':
						angular.forEach(arreglo, function(grado) {
							if(grado.n.match(/\d+/) > 9){
								this.push(grado);
							}
						}, arr);
						return arr;
					case 'tema'://requiere materias
						angular.forEach(arreglo, function(tem, key) {
							if($scope.forThisMat($scope.bachillerato.materias,key)){
								this.push([key, tem]);
							}
						}, arr);
						return arr;
				}
				break;
		}
		return arreglo;
	}

	$scope.clasePTema = function(nombre){
		// Devuelve una clase tipo p_tema_hab, debe definirse a que clase corresponde el nombre,
		// Aplica tanto para grados como materias
		if(nombre){
			switch(nombre.toLowerCase()){
				case '1°': case 'primer grado' : return 'p_temas_primero';
				case '2°': case 'segundo grado': return 'p_temas_segundo';
				case '3°': case 'tercer grado' : return 'p_temas_tercero';
				case '4°': case 'cuarto grado' : return 'p_temas_cuarto';
				case '5°': case 'quinto grado' : return 'p_temas_quinto';
				case '6°': case 'sexto grado'  : return 'p_temas_sexto';
				case '7°': case 'septimo grado': return 'p_temas_primero';
				
				case 'atlas'                   : return 'p_temas_atl';
				case 'física'                  : return 'p_temas_fis';
				case 'inglés'                  : return 'p_temas_ing';
				case 'español'                 : return 'p_temas_esp';
				case 'química'                 : return 'p_temas_qui';
				case 'biología'                : return 'p_temas_bio';
				case 'ciencias'                : return 'p_temas_nat';
				case 'desafíos'                : return 'p_temas_desafios';
				case 'historia'                : return 'p_temas_his';
				case 'geografía'               : return 'p_temas_geo';
				case 'tecnología'              : return 'p_temas_tec';
				case 'habilidades'             : return 'p_temas_hab';
				case 'informática'             : return 'p_temas_inf';
				case 'matemáticas'             : return 'p_temas_mat';
				case 'ciencias naturales'      : return 'p_temas_nat';
				case 'educación artística'     : return 'p_temas_art';
				case 'lecturas de comprensión' : return 'p_temas_lec';
				case 'Lenguaje y Comunicación' : return 'p_temas_esp';
				case 'formación cívica y ética': return 'p_temas_cye';
			}
			return '';
		}
		return '';
	}

	$scope.crearPaginas = function(pags){
		var output = [];
		var i;
		for (i=0; i < pags; i++){
			output.push(i+1);
		}
		return output;
	}

	$scope.paginate = function(){
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
		}
		$scope.paginasFiltradas[$scope.current_section] = $scope.filterForPages($scope.paginas[$scope.current_section]);
		//$scope.$apply();
	}

	$scope.changePage = function(page){
		$scope.paginaActual[$scope.current_section] = page;
		$scope.paginate();
	}

	$scope.appsForSection = function(){
		try{
			switch($scope.current_section){
				case 0:
					$scope.appsFiltradasPrimariaIntern = $filter('unique')($filter('filter')($filter('filter')($filter('filtrarMaterias')($filter('filtrarGrados')($filter('filtrarCategorias')($filter('filtrarFlash')($scope.aplicaciones,$scope),$scope),$scope),$scope),$scope.filtros[0].tema),$scope.filtros[0].buscador),'i');
					break;
				case 1:
					$scope.appsFiltradasSecundariaIntern = $filter('unique')($filter('filter')($filter('filter')($filter('filtrarMaterias')($filter('filtrarGrados')($filter('filtrarCategorias')($filter('filtrarFlash')($scope.secundaria.aplicaciones,$scope),$scope),$scope),$scope),$scope.filtros[1].tema),$scope.filtros[0].buscador),'i');
					break;
			}
			$scope.paginate();
		} catch (e){
		}
	}
	
	$scope.filtrarCurso = function(tipo, param){
		/*
			de acuerdo al tipo (grado, materia, etc), filtra de acuerdo al nombre (param),
			si ya se ha seleccionado ese mismo nombre, desactiva el filtro, si no, lo guarda
			en $scope.filtros.{tipo}
		*/
		switch(tipo){
			case 'grados':
				if($scope.filtros[$scope.current_section].grados && $scope.filtros[$scope.current_section].grados[0].n == param[0].n){
					delete $scope.filtros[$scope.current_section].grados;
				} else{
					$scope.filtros[$scope.current_section].grados = param;
				}
				break;
			case 'materias':
				if($scope.filtros[$scope.current_section].materias && $scope.filtros[$scope.current_section].materias[0].n == param[0].n){
					delete $scope.filtros[$scope.current_section].materias;
				} else{
					$scope.filtros[$scope.current_section].materias = param;
					delete $scope.filtros[$scope.current_section].tema;
				}
				break;
			case 'tema':
				if($scope.filtros[$scope.current_section].tema && $scope.filtros[$scope.current_section].tema == param){
					delete $scope.filtros[$scope.current_section].tema;
				} else{
					$scope.filtros[$scope.current_section].tema = param;
				}
				break;
		}
		$scope.resetPagination();
	}

	$scope.limpiarBuscador = function(){
		$scope.filtros[0].buscador="";
		$scope.ocultarApps();
		$scope.changesForSection(true);
	}

	$scope.filterForPages = function(page){
		/*
		*/
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

	$scope.filtrarGradosEnMaterias = function(grado){
		/*
			Determina que grados contienen la materia seleccionada
		*/
		if($scope.filtros[$scope.current_section].materias){
			var is_valid = false;
			angular.forEach($scope.filtros[$scope.current_section].materias, function(materia){
				if(materia.g == grado.i){
					is_valid = true;
					return false;
				}
			});
			return is_valid;
		}
		return true;
	}

	$scope.filtrarGradosConTema = function(grado){
		/*
			Determina que temas contiene la materia seleccionada
		*/
		if($scope.filtros[$scope.current_section].tema){
			if(grado.n == "1°"){if($scope.filtros[$scope.current_section].tema == "Leer me encanta"){return false;}if($scope.filtros[$scope.current_section].tema == "Fábulas infantiles"){return true;}if($scope.filtros[$scope.current_section].tema == "La casita misteriosa"){return false;}}
			if(grado.n == "2°"){if($scope.filtros[$scope.current_section].tema == "Leer me encanta"){return false;}if($scope.filtros[$scope.current_section].tema == "Fábulas infantiles"){return true;}if($scope.filtros[$scope.current_section].tema == "La casita misteriosa"){return false;}}
			if(grado.n == "3°"){if($scope.filtros[$scope.current_section].tema == "Leer me encanta"){return false;}if($scope.filtros[$scope.current_section].tema == "Fábulas infantiles"){return false;}if($scope.filtros[$scope.current_section].tema == "La casita misteriosa"){return true;}}
			if(grado.n == "4°"){if($scope.filtros[$scope.current_section].tema == "Leer me encanta"){return true;}if($scope.filtros[$scope.current_section].tema == "Fábulas infantiles"){return false;}if($scope.filtros[$scope.current_section].tema == "La casita misteriosa"){return false;}}
			if(grado.n == "5°"){if($scope.filtros[$scope.current_section].tema == "Leer me encanta"){return true;}if($scope.filtros[$scope.current_section].tema == "Fábulas infantiles"){return false;}if($scope.filtros[$scope.current_section].tema == "La casita misteriosa"){return false;}}
			if(grado.n == "6°"){if($scope.filtros[$scope.current_section].tema == "Leer me encanta"){return true;}if($scope.filtros[$scope.current_section].tema == "Fábulas infantiles"){return false;}if($scope.filtros[$scope.current_section].tema == "La casita misteriosa"){return false;}}
			if(grado.n == "7°"){if($scope.filtros[$scope.current_section].tema == "Saca 10"){return false;}}
		}
		return true;
	}

	$scope.filtrarTemasConGrado = function(tema){
		/*
			Determina que temas contiene la materia seleccionada
		*/
		if($scope.filtros[$scope.current_section].grados){
			if($scope.filtros[$scope.current_section].grados[0].n == "1°"){if(tema == "Leer me encanta"){return false;}if(tema == "Fábulas infantiles"){return true;}if(tema == "La casita misteriosa"){return false;}}
			if($scope.filtros[$scope.current_section].grados[0].n == "2°"){if(tema == "Leer me encanta"){return false;}if(tema == "Fábulas infantiles"){return true;}if(tema == "La casita misteriosa"){return false;}}
			if($scope.filtros[$scope.current_section].grados[0].n == "3°"){if(tema == "Leer me encanta"){return false;}if(tema == "Fábulas infantiles"){return false;}if(tema == "La casita misteriosa"){return true;}}
			if($scope.filtros[$scope.current_section].grados[0].n == "4°"){if(tema == "Leer me encanta"){return true;}if(tema == "Fábulas infantiles"){return false;}if(tema == "La casita misteriosa"){return false;}}
			if($scope.filtros[$scope.current_section].grados[0].n == "5°"){if(tema == "Leer me encanta"){return true;}if(tema == "Fábulas infantiles"){return false;}if(tema == "La casita misteriosa"){return false;}}
			if($scope.filtros[$scope.current_section].grados[0].n == "6°"){if(tema == "Leer me encanta"){return true;}if(tema == "Fábulas infantiles"){return false;}if(tema == "La casita misteriosa"){return false;}}
			if($scope.filtros[$scope.current_section].grados[0].n == "7°"){if(tema == "Saca 10"){return false;}}
		}
		if(tema == "Saca 10"){return false;}
		return true;
	}

	$scope.filterTemaCompiler = function(temas){
		let arr =[];
		if($scope.filtros[$scope.current_section].grados){
			let gfilt = $scope.filtros[$scope.current_section].grados[0].i;
			let mfilt = $scope.materias.find(mat => mat.g == gfilt)?.i;
			if(!mfilt){ return arr; }
			let temasAux = temas.find(tem => tem[0]==mfilt);
			arr = [...new Set(Object.values(temasAux[1]).map(r => r.replaceAll('$$','')))];
		}else{
			arr = [...new Set(temas.map(r => Object.values(r[1])).flat(3).map(r => r.replaceAll('$$','')))];
		}
		return arr;
	}

	$scope.filtrarTemasEnMateria = function(tema){
		/*
			Determina que temas contiene la materia seleccionada
		*/
		if($scope.filtros[$scope.current_section].materias){
			var is_valid = false;
			angular.forEach($scope.filtros[$scope.current_section].materias, function(materia){
				if(materia.n == tema.m){
					is_valid = true;
				}
			});
			return is_valid;
		}
		return true;
	}

	$scope.doGetAppClickAction = function(aplicacion, windowReference){
		/*
			Cuando se selecciona una aplicacion, el comportamiento es distinto en movil y en pc
		*/
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
		if($scope.movil){
			$scope.muestraInfoNg(
				aplicacion.i,
				aplicacion.n,
				$scope.getAppThumbnail(aplicacion.p)
			);
		} else{
			$scope.abrirApp(aplicacion);
		}
	}

	$scope.abrirApp= function(aplicacion){
		if(aplicacion.i == 'undefined' || aplicacion.i == null){
			window.open($scope.kapps_url + "recurso/cargarApp/"+aplicacion.id_aplicacion+"/primaria");
		}else{
			window.open($scope.kapps_url + "recurso/cargarApp/"+aplicacion.i+"/primaria");
		}
	}

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

	$scope.reinitFiltros = function(){
		/*
			Regresa los filtros al default del portal lecturas
		*/
		/*if(!conservarCategorias){
			$scope.resetCategorias();
		}*/
		$scope.filtros = [{},{},{}];
		$scope.filtros[0].materias = angular.copy($scope.materias);
		$scope.filtros[1].materias = angular.copy($scope.secundaria.materias);
		$scope.filtros[2].materias = angular.copy($scope.bachillerato.materias);
		$scope.resetPagination();
		if($scope.noFlash && !$scope.movil){
			$scope.toggleNoFlash();
		}
	}

	$scope.limpiarFiltros = function(conservarCategorias){
		/*
			Vacia el contenido de los filtros, tanto de grados y materias, asi como los de categorias,
			asi mismo resetea la paginacion a la pagina 1 y remueve el filtro para no mostrar flash
		*/
		if(!conservarCategorias){
			$scope.resetCategorias();
		}
		$scope.filtros = [{},{},{}];
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
		//$("body").stop().animate({scrollTop: $("#buscar").offset().top - (altoNavegacion + 20)}, 500);
	}

	$scope.mostrarMenu = function(menu){
		/*
			Determina si se esta mostrando un menu, que tipo de menu, y si ya se esta mostrando lo oculta.
		*/
		if($scope.grados.length == 1 && menu == 'grados'){
			return;
		}
		if($scope.materias.length == 11 && menu == 'materias'){
			return;
		}
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

	$scope.lookTo = function(pos) {
		var wh = $(document).height() - $(window).height();
		var localMovil = $('#is_movil').length==0;
		switch(pos){
			case 'primaria':
				$("body").stop().animate({scrollTop: 0}, 500);
				break;
			case 'secundaria':
				if (localMovil) {
					if ($scope.logged_in) {
						$("body").stop().animate({scrollTop: (wh*(55)/100)}, 500);
					}else{
						$("body").stop().animate({scrollTop: (wh*(75)/100)}, 500);
					}
				}else{
					if ($scope.logged_in) {
						if($(".p_header").css("position") == "fixed"){
							$("body").stop().animate({scrollTop: (wh*(100)/100)}, 500);
						}else{
							$("body").stop().animate({scrollTop: (wh*(70)/100)}, 800);
						}
					}else{
						if($(".p_header").css("position") == "fixed"){
							$("body").stop().animate({scrollTop: (wh*(110)/100)}, 500);
						}else{
							$("body").stop().animate({scrollTop: (wh*(75)/100)}, 800);
						}
					}
				}
				break;
		}
	}

	$scope.changesForSection = function(attr){
		if($scope.current_section != $scope.current_section_aux || attr){
			$scope.current_section_aux = $scope.current_section;
			///////////////////////////////////////////////////////
			//                EDITABLE       CODE                //
			///////////////////////////////////////////////////////
			$scope.paginaActual[$scope.current_section] = 1;
			if($scope.logged_in){
				$scope.appsForSection();
			}else{
				$scope.paginate();
			}
			
			$('.p_navsupinbtn').stop().animate({"color":"#f2f2f2"}, 100);
			$('.p_navsupinbtn.p_in'+($scope.current_section+2)).stop().animate({"color":"#f1db0c"}, 100);
			try{
				$scope.$digest();
			}catch(e){
			}
			//////////////////////////////////////////////////////
		}
	}

	$(window).scroll(function() {
		if($(".hiddenFlag1").length==0){
			var wh = $(document).height() - $(window).height();
			var minimized = $(".p_header").css("position") == "fixed";
			var localMovil = $('#is_movil').length==0;
			if(localMovil){
				if($("body").scrollTop() < wh*4.72/12){
					$scope.current_section = 0;
				}else{
					$scope.current_section = 1;
				}
			}else {
				if(minimized) {
					if($("body").scrollTop() < wh*7.2/12){
						$scope.current_section = 0;
					}else{
						$scope.current_section = 1;
					}
				} else {
					if($("body").scrollTop() < wh*7.8/12){
						$scope.current_section = 0;
					}else{
						$scope.current_section = 1;
					}
				}
			}
			$scope.changesForSection(false);
		}
	});

	$scope.ocultarApps = function(){
		/*
			Resetea los filtros, oculta los menus y cambia a la pagina principal, haciendo scroll a la barra de busqueda
		*/
		/*if($scope.filtros.materias){
			if($scope.filtros.materias[0].n != 'Lecturas de comprensión'){
				$scope.limpiarFiltros();
			}
			
		}*/
		$scope.ocultarMenu();
		$scope.verApps = false;
		//$("body").stop().animate({scrollTop: $("#buscar").offset().top - (altoNavegacion + 20)}, 500);
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
		$scope.appsForSection();
	}

	$scope.temasFiltrados = function(temas){
		var arr = temas.ts;
		var output = [];
		angular.forEach(arr, function(item){
			if($scope.filtrarTemasConGrado(item)){
				this.push(item);
			}
		}, output);
		return output;
	}

	$scope.toggleCategoria = function(categoria){
		/*
			Activa o desactiva una categoria seleccionada
			resetea la paginacion a la pagina 1
		*/
		switch(categoria){
			case 'aplicacion':
				$scope.catAplicacion = !$scope.catAplicacion;
				break;
			case 'video':
				$scope.catVideo = !$scope.catVideo;
				break;
			case 'evaluacion':
				$scope.catEvaluacion = !$scope.catEvaluacion;
				break;
			case 'lectura':
				$scope.catLectura = !$scope.catLectura;
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

	//////////////////////////////////////////////// segmento de apps demo ////////////////////////////////////////////////
	$scope.aplicacionesDem = false;

	$scope.cargaAppsDem = function (){
		$http({
			method:'GET',
			url: $scope.base_url + 'apps_json/demapps'
		}).then(
			function successCallback(response){
				$scope.appsFiltradasPrimariaIntern = eval(response.data['primaria']);
				$scope.appsFiltradasSecundariaIntern = eval(response.data['secundaria']);
				$scope.appsFiltradasBachilleratoIntern = [];
				$scope.paginate();
				$scope.aplicacionesDem = true;
			}, function errorCallback(response){
			}
		);
	}
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}]);