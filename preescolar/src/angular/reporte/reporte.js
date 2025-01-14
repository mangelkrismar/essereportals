'use strict'

var app = angular.module('reporteApp', ['ngRoute','angularUtils.directives.dirPagination']);

app.config(function($routeProvider){
	var templatesPrefix = IP + "src/angular/reporte/templates/";
	
	$routeProvider
	.when("/",{
		templateUrl: templatesPrefix + "sinCurso.htm",
		controller: "sinCursoController"
	})
	.when("/mdt",{
		templateUrl: templatesPrefix + "mdt.htm",
		controller: "mdtController"
	})
	.when("/portalApps",{
		templateUrl: templatesPrefix + "portalApps.htm",
		controller: "portalAppsController"
	})
});

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

app.controller('sinCursoController', function($scope, $http){

	$scope.base_url = IP;

	$http.get($scope.base_url+'Reporte/getAppsSinCurso').then(
		function success(response){
			$scope.apps = response.data;
			$scope.resetFilters();
		}, function error(response){
			console.log('Ha ocurrido un error');
			console.log(response);
		}
	);

	$scope.resetPagination = function(){
		$scope.pagination = {
			current: 1
		};
	}

	$scope.resetFilters = function(){
		$scope.search = '';
		$scope.sortKey = 'f';
		$scope.reverse = true;

		$scope.resetPagination();
	}

	$scope.sort = function(keyname){
		$scope.sortKey = keyname;
		$scope.reverse = !$scope.reverse;
		$scope.resetPagination();
	}

	$scope.filtrarPrefijo = function(prefijo){
		var pArray = prefijo.split('_');
		pArray.pop();
		$scope.search = pArray.join('_');
		$scope.sortKey = 'p';
		$scope.reverse = true;
		$scope.resetPagination();
	}

	$scope.filtrarFecha = function(fecha){
		var fArray = fecha.split('-');
		fArray.pop();
		$scope.search = fArray.join('-');
		$scope.sortKey = 'f';
		$scope.reverse = true;
		$scope.resetPagination();
	}
});

app.controller('mdtController', function($scope, $http){
	$scope.base_url = IP;
	$scope.apps = null;
	$scope.cursos = null;
	$scope.cargandoCursos = true;
	$scope.cargandoCurso = false;
	$scope.cursoActual = null;

	//$scope.base_url = IP;
	//$scope.apps = null;
	$scope.curso = null;
	$scope.categorias = null;
	$scope.filtros = {}
	
	$http.get($scope.base_url+'Reporte/getCursosMDT').then(
		function success(response){
			$scope.cursos = response.data;
			$scope.cargandoCursos = false;
		}, function error(response){
			console.log('Ha ocurrido un error');
			console.log(response);
		}
	);

	/*$http.get($scope.base_url+'Reporte/getCursoMDT?id_curso='+87).then(
		function success(response){
			$scope.apps = response.data;
			$scope.curso = $scope.getGrados($scope.apps);
			$scope.categorias = $scope.getCategorias($scope.apps);
			$scope.resetFiltros('all');
		}, function error(response){
			console.log('Ha ocurrido un error');
			console.log(response);
		}
	);*/
	
	$scope.cargarCurso = function(curso){
		$scope.cursoActual = curso;
		$scope.cargandoCurso = true;

		$http.get($scope.base_url+'Reporte/getCursoMDT?id_curso='+$scope.cursoActual.i).then(
			function success(response){
				$scope.apps = response.data;
				$scope.curso = $scope.getGrados($scope.apps);
				$scope.categorias = $scope.getCategorias($scope.apps);
				$scope.resetFiltros('all');
				$scope.cargandoCurso = false;
			}, function error(response){
				console.log('Ha ocurrido un error');
				console.log(response);
			}
		);
	}

	$scope.resetCurso = function(){
		$scope.cargandoCursos = true;
		$scope.apps = null;
		$scope.cursoActual = null;
		$scope.cargandoCursos = false;
	}

	$scope.getCategorias = function(apps){
		var categorias = [];
		angular.forEach(apps, function(a){
			if(categorias.indexOf(a.c) === -1){
				categorias.push(a.c);
			}
		});
		categorias.sort();
		return categorias;
	}

	$scope.getLecciones = function(apps, grado, materia, bloque){
		var lecciones = [];
		angular.forEach(apps, function(a){
			if(a.g == grado && a.m == materia && a.b == bloque){
				if(lecciones.indexOf(a.l) == -1){
					lecciones.push(a.l);
				}
			}
		});
		return lecciones;
	}

	$scope.getBloques = function(apps, grado, materia){
		var bloques = [];
		var bloquesMateria = [];
		var bloque = {}
		angular.forEach(apps, function(a){
			if(a.g == grado && a.m == materia){
				if(bloques.indexOf(a.b) == -1){
					bloque= {
						n: a.b,
						lecciones: $scope.getLecciones(apps, grado, materia, a.b)
					}
					bloques.push(a.b);
					bloquesMateria.push(bloque);
				}
			}
		});
		return bloquesMateria;
	}

	$scope.getMaterias = function(apps, grado){
		var materias = [];
		var gradoMaterias = [];
		var materia = {}
		angular.forEach(apps, function(a){
			if(a.g == grado){
				if(materias.indexOf(a.m) == -1){
					materias.push(a.m);
					materia = {
						n: a.m,
						bloques: $scope.getBloques(apps, grado, a.m)
					}
					gradoMaterias.push(materia);
				}
			}
		});
		return gradoMaterias;
	}

	$scope.getGrados = function(apps){	
		var curso = [];
		var grados = [];
		var grado = {}
		angular.forEach(apps, function(a){
			if(grados.indexOf(a.g) === -1){
				grado = {
					n: a.g,
					materias: $scope.getMaterias(apps, a.g)
				}
				grados.push(a.g);
				curso.push(grado);
			}
		});
		return curso;
	}

	$scope.resetFiltros = function(type){
		if($scope.filtros.buscador){
			var search = $scope.filtros.buscador;
		}
		switch(type){
			case 'all':
				$scope.currentGrado = null;
				$scope.currentMateria = null;
				$scope.currentBloque = null;
				$scope.currentLeccion = null;
				$scope.filtros = {}
				break;
			case 'g':
				
				$scope.currentGrado = null;
				$scope.currentMateria = null;
				$scope.currentBloque = null;
				$scope.currentLeccion = null;
				$scope.filtros = {}
				break;
			case 'm':
				$scope.currentMateria = null;
				$scope.currentBloque = null;
				$scope.currentLeccion = null;
				
				var g = $scope.filtros.grado;
				$scope.filtros = {}
				$scope.filtros.grado = g;
				break;
			case 'b':
				$scope.currentBloque = null;
				$scope.currentLeccion = null;

				var g = $scope.filtros.grado;
				var m = $scope.filtros.materia;
				$scope.filtros = {}
				$scope.filtros.grado = g;
				$scope.filtros.materia = m;
				break;
			case 'l':
				$scope.currentLeccion = null;
				var g = $scope.filtros.grado;
				var m = $scope.filtros.materia;
				var b = $scope.filtros.bloque;
				$scope.filtros = {}
				$scope.filtros.grado = g;
				$scope.filtros.materia = m;
				$scope.filtros.bloque = b;
				break;
		}
		if(type != 'all'){
			$scope.filtros.buscador = search;
		}
		$scope.resetPagination();
		$scope.filtros.categorias = [];
	}

	$scope.filtrarCurso = function(item, type){
		switch(type){
			case 'g':
				if($scope.currentGrado){
					if($scope.currentGrado.n == item.n){
						$scope.resetFiltros('g');
					} else{
						$scope.resetFiltros('g');
						$scope.currentGrado = item;
						$scope.filtros.grado = item.n;
					}
				} else{
					$scope.resetFiltros('g');
					$scope.currentGrado = item;
					$scope.filtros.grado = item.n;
				}
				break;
			case 'm':
				if($scope.currentMateria){
					if($scope.currentMateria.n == item.n){
						$scope.resetFiltros('m');
					} else{
						$scope.resetFiltros('m');
						$scope.currentMateria = item;
						$scope.filtros.materia = item.n;
					}
				} else{
					$scope.resetFiltros('m');
					$scope.currentMateria = item;
					$scope.filtros.materia = item.n;
				}
				break;
			case 'b':
				if($scope.currentBloque){
					if($scope.currentBloque.n == item.n){
						$scope.resetFiltros('b');
					} else{
						$scope.resetFiltros('b');
						$scope.currentBloque = item;
						$scope.filtros.bloque = item.n;
					}
				} else{
					$scope.resetFiltros('b');
					$scope.currentBloque = item;
					$scope.filtros.bloque = item.n;
				}
				break;
			case 'l':
				if($scope.currentLeccion){
					if($scope.currentLeccion == item){
						$scope.resetFiltros('l');
					} else{
						$scope.resetFiltros('l');
						$scope.currentLeccion = item;
						$scope.filtros.leccion = item;
					}
				} else{
					$scope.resetFiltros('l');
					$scope.currentLeccion = item;
					$scope.filtros.leccion = item;
				}
				break;
			case 'c':
				var categorias = $scope.filtros.categorias;
				$scope.resetFiltros('c');
				$scope.filtros.categorias = categorias;
				$scope.filtros.categorias = $scope.arrayRAVIPON($scope.filtros.categorias, item);
				break;
		}
	}

	$scope.arrayRAVIPON = function(array, value){
		/*
			Si un elemento esta en un array lo quita,
			si no está, lo agrega
		*/
		if(array.indexOf(value) > -1){
			array.splice(array.indexOf(value), 1);
		} else{
			array.push(value);
		}
		return array;
	}

	$scope.filtroSeleccionado = function(item, type){
		/*
			Devuelve true o false si el elemento es igual al filtro que está activo
		*/
		var is_valid = false;
		switch(type){
			case 'g':
				if($scope.filtros.grado){
					if($scope.filtros.grado == item.n){
						is_valid = true;
					}
				}
				break;
			case 'm':
				if($scope.filtros.materia){
					if($scope.filtros.materia == item.n){
						is_valid = true;
					}
				}
				break;
			case 'b':
				if($scope.filtros.bloque){
					if($scope.filtros.bloque == item.n){
						is_valid = true;
					}
				}
				break;
			case 'l':
				if($scope.filtros.leccion){
					if($scope.filtros.leccion == item){
						is_valid = true;
					}
				}
				break;
			case 'c':
				angular.forEach($scope.filtros.categorias, function(categoria){
					if(item == categoria){
						is_valid = true;
						return;
					}
				});
				break;
		}
		return is_valid;
	}

	$scope.resetPagination = function(){
		$scope.pagination = {
			current: 1
		};
	}

	$scope.filtrarCategoria = function(app){
		if($scope.filtros.categorias){
			if($scope.filtros.categorias.length > 0){
				var is_valid = false;
				angular.forEach($scope.filtros.categorias, function(categoria){
					if(app.c == categoria){
						is_valid = true;
						return;
					}
				});
				return is_valid;
			}
		}
		return true;
	}

	$scope.filtrarLeccion = function(app){
		if($scope.filtros.leccion){
			if(app.l == $scope.filtros.leccion){
				return true;
			}
			return false;
		}
		return true;
	}
	
	$scope.filtrarBloque = function(app){
		if($scope.filtros.bloque){
			if(app.b == $scope.filtros.bloque){
				return true;
			}
			return false;
		}
		return true;
	}
	
	$scope.filtrarMateria = function(app){
		if($scope.filtros.materia){
			if(app.m == $scope.filtros.materia){
				return true;
			}
			return false;
		}
		return true;
	}

	$scope.filtrarGrado = function(app){
		if($scope.filtros.grado){
			if(app.g == $scope.filtros.grado){
				return true;
			}
			return false;
		}
		return true;
	}
	
	$scope.getAppThumbnail = function(app){
	    if(app.p.startsWith('red_pla')){
	        return 'red_pla';
	    }
	    if(app.p.startsWith('fla_')||app.p.startsWith('fls_')){
	        return 'flash';
	    }
	    return app.p;
	}
});

app.controller("portalAppsController", function($scope, $http){
	$scope.base_url = IP;

	$scope.apps = null;
	$scope.curso = null;
	$scope.categorias = null;

	$scope.filtros = {}
	
	$http.get($scope.base_url+'Reporte/getCursoMDT?id_curso='+87).then(
		function success(response){
			$scope.apps = response.data;
			$scope.curso = $scope.getGrados($scope.apps);
			$scope.categorias = $scope.getCategorias($scope.apps);
			$scope.resetFiltros('all');
		}, function error(response){
			console.log('Ha ocurrido un error');
			console.log(response);
		}
	);

	$scope.getCategorias = function(apps){
		var categorias = [];
		angular.forEach(apps, function(a){
			if(categorias.indexOf(a.c) === -1){
				categorias.push(a.c);
			}
		});
		categorias.sort();
		return categorias;
	}

	$scope.getLecciones = function(apps, grado, materia, bloque){
		var lecciones = [];
		angular.forEach(apps, function(a){
			if(a.g == grado && a.m == materia && a.b == bloque){
				if(lecciones.indexOf(a.l) == -1){
					lecciones.push(a.l);
				}
			}
		});
		return lecciones;
	}

	$scope.getBloques = function(apps, grado, materia){
		var bloques = [];
		var bloquesMateria = [];
		var bloque = {}
		angular.forEach(apps, function(a){
			if(a.g == grado && a.m == materia){
				if(bloques.indexOf(a.b) == -1){
					bloque= {
						n: a.b,
						lecciones: $scope.getLecciones(apps, grado, materia, a.b)
					}
					bloques.push(a.b);
					bloquesMateria.push(bloque);
				}
			}
		});
		return bloquesMateria;
	}

	$scope.getMaterias = function(apps, grado){
		var materias = [];
		var gradoMaterias = [];
		var materia = {}
		angular.forEach(apps, function(a){
			if(a.g == grado){
				if(materias.indexOf(a.m) == -1){
					materias.push(a.m);
					materia = {
						n: a.m,
						bloques: $scope.getBloques(apps, grado, a.m)
					}
					gradoMaterias.push(materia);
				}
			}
		});
		return gradoMaterias;
	}

	$scope.getGrados = function(apps){	
		var curso = [];
		var grados = [];
		var grado = {}
		angular.forEach(apps, function(a){
			if(grados.indexOf(a.g) === -1){
				grado = {
					n: a.g,
					materias: $scope.getMaterias(apps, a.g)
				}
				grados.push(a.g);
				curso.push(grado);
			}
		});
		return curso;
	}

	$scope.resetFiltros = function(type){
		if($scope.filtros.buscador){
			var search = $scope.filtros.buscador;
		}
		switch(type){
			case 'all':
				$scope.currentGrado = null;
				$scope.currentMateria = null;
				$scope.currentBloque = null;
				$scope.currentLeccion = null;
				$scope.filtros = {}
				break;
			case 'g':
				
				$scope.currentGrado = null;
				$scope.currentMateria = null;
				$scope.currentBloque = null;
				$scope.currentLeccion = null;
				$scope.filtros = {}
				break;
			case 'm':
				$scope.currentMateria = null;
				$scope.currentBloque = null;
				$scope.currentLeccion = null;
				
				var g = $scope.filtros.grado;
				$scope.filtros = {}
				$scope.filtros.grado = g;
				break;
			case 'b':
				$scope.currentBloque = null;
				$scope.currentLeccion = null;

				var g = $scope.filtros.grado;
				var m = $scope.filtros.materia;
				$scope.filtros = {}
				$scope.filtros.grado = g;
				$scope.filtros.materia = m;
				break;
			case 'l':
				$scope.currentLeccion = null;
				var g = $scope.filtros.grado;
				var m = $scope.filtros.materia;
				var b = $scope.filtros.bloque;
				$scope.filtros = {}
				$scope.filtros.grado = g;
				$scope.filtros.materia = m;
				$scope.filtros.bloque = b;
				break;
		}
		if(type != 'all'){
			$scope.filtros.buscador = search;
		}
		$scope.resetPagination();
		$scope.filtros.categorias = [];
	}

	$scope.filtrarCurso = function(item, type){
		switch(type){
			case 'g':
				if($scope.currentGrado){
					if($scope.currentGrado.n == item.n){
						$scope.resetFiltros('g');
					} else{
						$scope.resetFiltros('g');
						$scope.currentGrado = item;
						$scope.filtros.grado = item.n;
					}
				} else{
					$scope.resetFiltros('g');
					$scope.currentGrado = item;
					$scope.filtros.grado = item.n;
				}
				break;
			case 'm':
				if($scope.currentMateria){
					if($scope.currentMateria.n == item.n){
						$scope.resetFiltros('m');
					} else{
						$scope.resetFiltros('m');
						$scope.currentMateria = item;
						$scope.filtros.materia = item.n;
					}
				} else{
					$scope.resetFiltros('m');
					$scope.currentMateria = item;
					$scope.filtros.materia = item.n;
				}
				break;
			case 'b':
				if($scope.currentBloque){
					if($scope.currentBloque.n == item.n){
						$scope.resetFiltros('b');
					} else{
						$scope.resetFiltros('b');
						$scope.currentBloque = item;
						$scope.filtros.bloque = item.n;
					}
				} else{
					$scope.resetFiltros('b');
					$scope.currentBloque = item;
					$scope.filtros.bloque = item.n;
				}
				break;
			case 'l':
				if($scope.currentLeccion){
					if($scope.currentLeccion == item){
						$scope.resetFiltros('l');
					} else{
						$scope.resetFiltros('l');
						$scope.currentLeccion = item;
						$scope.filtros.leccion = item;
					}
				} else{
					$scope.resetFiltros('l');
					$scope.currentLeccion = item;
					$scope.filtros.leccion = item;
				}
				break;
			case 'c':
				var categorias = $scope.filtros.categorias;
				$scope.resetFiltros('c');
				$scope.filtros.categorias = categorias;
				$scope.filtros.categorias = $scope.arrayRAVIPON($scope.filtros.categorias, item);
				break;
		}
	}

	$scope.arrayRAVIPON = function(array, value){
		/*
			Si un elemento esta en un array lo quita,
			si no está, lo agrega
		*/
		if(array.indexOf(value) > -1){
			array.splice(array.indexOf(value), 1);
		} else{
			array.push(value);
		}
		return array;
	}

	$scope.filtroSeleccionado = function(item, type){
		/*
			Devuelve true o false si el elemento es igual al filtro que está activo
		*/
		var is_valid = false;
		switch(type){
			case 'g':
				if($scope.filtros.grado){
					if($scope.filtros.grado == item.n){
						is_valid = true;
					}
				}
				break;
			case 'm':
				if($scope.filtros.materia){
					if($scope.filtros.materia == item.n){
						is_valid = true;
					}
				}
				break;
			case 'b':
				if($scope.filtros.bloque){
					if($scope.filtros.bloque == item.n){
						is_valid = true;
					}
				}
				break;
			case 'l':
				if($scope.filtros.leccion){
					if($scope.filtros.leccion == item){
						is_valid = true;
					}
				}
				break;
			case 'c':
				angular.forEach($scope.filtros.categorias, function(categoria){
					if(item == categoria){
						is_valid = true;
						return;
					}
				});
				break;
		}
		return is_valid;
	}

	$scope.resetPagination = function(){
		$scope.pagination = {
			current: 1
		};
	}

	$scope.filtrarCategoria = function(app){
		if($scope.filtros.categorias){
			if($scope.filtros.categorias.length > 0){
				var is_valid = false;
				angular.forEach($scope.filtros.categorias, function(categoria){
					if(app.c == categoria){
						is_valid = true;
						return;
					}
				});
				return is_valid;
			}
		}
		return true;
	}

	$scope.filtrarLeccion = function(app){
		if($scope.filtros.leccion){
			if(app.l == $scope.filtros.leccion){
				return true;
			}
			return false;
		}
		return true;
	}
	
	$scope.filtrarBloque = function(app){
		if($scope.filtros.bloque){
			if(app.b == $scope.filtros.bloque){
				return true;
			}
			return false;
		}
		return true;
	}
	
	$scope.filtrarMateria = function(app){
		if($scope.filtros.materia){
			if(app.m == $scope.filtros.materia){
				return true;
			}
			return false;
		}
		return true;
	}

	$scope.filtrarGrado = function(app){
		if($scope.filtros.grado){
			if(app.g == $scope.filtros.grado){
				return true;
			}
			return false;
		}
		return true;
	}
	
	$scope.getAppThumbnail = function(app){
	    if(app.p.startsWith('red_pla')){
	        return 'red_pla';
	    }
	    if(app.p.startsWith('fla_')||app.p.startsWith('fls_')){
	        return 'flash';
	    }
	    return app.p;
	}
});