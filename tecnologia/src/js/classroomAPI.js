/***********************************************************************************
* 
*                                *.*.*.*.*.*.*CONSTANTES*.*.*.*.*.*.* 
*
*************************************************************************************/
const portal = "primaria";
var CLIENT_ID = '1002854476119-ns091bdc63gr1qlro9uomm7l86fgn8bf.apps.googleusercontent.com';
var API_KEY = 'AIzaSyDkFWgdWdMGHlBG-h4ltORYOdgpEgNIQbg';
var DISCOVERY_DOCS = ["https://www.googleapis.com/discovery/v1/apis/classroom/v1/rest"];
var SCOPES = "https://www.googleapis.com/auth/classroom.topics.readonly https://www.googleapis.com/auth/classroom.rosters.readonly https://www.googleapis.com/auth/classroom.courses.readonly https://www.googleapis.com/auth/classroom.coursework.me.readonly https://www.googleapis.com/auth/classroom.coursework.students.readonly"; //Permisos de Google classroom
/***********************************************************************************
* 
*                            *.*.*.*.*.*.* VARIABLES GLOBALES*.*.*.*.*.*.* 
*
*************************************************************************************/
var googleUser; //Cliente de google conectado
var banderas = -1; //Contadores para la asincronia de las peticiones a Google
var banderaPlus = 2; //Contadores para la asincronia de las peticiones a Google
var next = 0; //Contador para la asincronia de las peticiones a Google
var coursesWork = []; //Almacena los IDs de las tareas de un curso de classroom
var idAlumnos = []; //Almacena los IDs de los alumnos en un curso de classroom
var nombreAlumnos = []; //Almacena los nombres de los alumnos en un curso de classroom
var idAlumnosCurso;
var nombreAlumnosCurso;
var appCategoria;
let appCategoria2;
var lastDate = new Date();
let emstop = false;
let tareaAsignada = false;
let scanStarted = false;
/***********************************************************************************
* 
*                            *.*.*.*.*.*.* VARIABLES GLOBALES*.*.*.*.*.*.* 
*
*************************************************************************************/
const dominio = 'www.mdt.mx';
//classroom.mdt.mx --> Desarrollo
//www.mdt.mx --> Producción
const controller = 'classroomController';
//classroomController --> Producción / desarrollo
/***********************************************************************************
* 
*                            *.*.*.*.*.*.* ASIGNACIÓN DE ACTIVIDADES   *.*.*.*.*.*.* 
*
*************************************************************************************/
localStorage.setItem("ses", '0');
function authenticate(){
  /*
  * NOMBRE: authenticate.
  * UTILIDAD: Ejecuta la antenticación de Google.
  * ENTRADAS: Ninguna.
  * SALIDAS: Ninguna.
  */ 
  return gapi.auth2.getAuthInstance()
  .signIn({scope: SCOPES, prompt:"select_account"})
  .then(function() { console.log("Sign-in successful"); localStorage.setItem("ses", '1'); },
    function(err) { /*console.error("Error signing in", err);*/ });
}

function loadClientGAPI() {
   /*
  * NOMBRE: loadClientGAPI.
  * UTILIDAD: Carga el cliente Google con el API KEY Y DOCS correspondientes para el proyecto.
  * ENTRADAS: Ninguna.
  * SALIDAS: Ninguna.
  */
  gapi.client.setApiKey(API_KEY);
  return gapi.client.load(DISCOVERY_DOCS[0])
  .then(function() { console.log("GAPI client loaded for API"); },
    function(err) { console.error("Error loading GAPI client for API", err); });
}

function loadClient(){
  /*
  * NOMBRE: loadClient.
  * UTILIDAD: Carga el cliente Google.
  * ENTRADAS: Ninguna.
  * SALIDAS: Ninguna.
  */ 
  gapi.load("client:auth2", function() {
    gapi.auth2.init({client_id: CLIENT_ID});
  });
}

function startProfe(){
  /*
  * NOMBRE: startProfe.
  * UTILIDAD: Se ejecuta al presionar el share button de Google, guarda el ID del share button y encadena las funciones de autenticación.
  * ENTRADAS: Ninguna.
  * SALIDAS: Ninguna.
  */
  lastDate = new Date();
  tareaAsignada=false;
  scanStarted = false;
  appCategoria = appCategoria2;
  console.log("esta aplicacion es: "+appCategoria);
  if(localStorage.getItem("ses") == '1'){
    loadClientGAPI().then(getClientInfo);
  }else{
    authenticate().then(loadClientGAPI).then(getClientInfo);
  }
}

function getClientInfo(){
  /*
  * NOMBRE: getClientInfo.
  * UTILIDAD: Obtiene la información de la cunta de Google.
  * ENTRADAS: Ninguna.
  * SALIDAS: Ninguna.
  */ 
  googleUser = gapi.auth2.getAuthInstance().currentUser.get();   
}

function setRegistro(){  
  /*
  * NOMBRE: setRegistro.
  * UTILIDAD: Arma el registro que se insertará en la DB.
  * ENTRADAS: Ninguna.
  * SALIDAS: Ninguna.
  */ 
  if(gapi.auth2.getAuthInstance().isSignedIn.get()){
    getCursos();
    setCompleteJson();
    guardaBase();
  }else{
    console.log('El usuario no tiene sesión activa');
  }
}

function setCompleteJson(){
  /*
  * NOMBRE: setCompleteJSON.
  * UTILIDAD: Completa el JSON a insertar en la DB para la actividad asignada.
  * ENTRADAS: Ninguna.
  * SALIDAS: Ninguna.
  */ 
  if(banderas == 0){
    getStudentsName();
    getTopic();
  }else{
    setTimeout(function(){
      setCompleteJson();
    }, 500)
  }
}

function GRchangeAccount(){
  emstop = false;
  googleSignOut();
  muestraDocente();
}

function guardaBase(){
  /*
  * NOMBRE: guardaBase.
  * UTILIDAD: Almacena la actividad en la DB de Krismar.
  * ENTRADAS: Ninguna.
  * SALIDAS: Ninguna.
  */ 
  if(banderaPlus == 0){    
    $.post(
      IP+"Classroom_controller/guardaTarea",
      {tarea:budo},
      function(data){
        appID = null;
        banderas = -1;
        banderaPlus = 2;
        lastDate = new Date();
        tareaAsignada = true;
        alert('Tarea asignada correctamente');
      }
    )
  }else{
    setTimeout(function(){
      guardaBase();
    }, 500)
  }
}

function getTopic(){
  /*
  * NOMBRE: getTopic.
  * UTILIDAD: Obtiene el Topic al que pertenece la actividad (Si el profesor le asignó uno).
  * ENTRADAS: Ninguna.
  * SALIDAS: Ninguna.
  */ 
  if(budo['topicId']!=undefined){    
    return gapi.client.classroom.courses.topics.get({
      "courseId": budo['courseID'],
      "id": budo['topicId']
    })
    .then(function(response) {
      budo['topic'] = response.result.name;
      banderaPlus-=1;
    },function(err) { console.error("Execute error", err); });
  }else{
    banderaPlus-=1;
  }
}

function getStudentsName(){
  /*
  * NOMBRE: getStudentsName.
  * UTILIDAD: Arma el JSOn de las calificaciones del usuario, con su nombre y ID.
  * ENTRADAS: Ninguna.
  * SALIDAS: Ninguna.
  */ 

  //Vacio --> Escala del 0 - 100
  // -1 --> Video NO visto / visto
  // -2 --> Lectura NO completada / completada
  // -3 --> Aplicación sin finalizar / finalizada
  return gapi.client.classroom.courses.students.list({
    "courseId": budo['courseID']
  }).then(function(response) {
    if(response.result.students == undefined || response.result.students == null){
      console.log("no se encontraron alumnos");
    }else{
      for (var i = 0; i < response.result.students.length; i++) { //Le crea una entrega a cada alumno 
        if(appCategoria == 'video' || appCategoria=='videoT'){
          budo['respuestas'].push({"idAlumno":response.result.students[i].userId, "nombreAlumno":response.result.students[i].profile.name.fullName, "entregas":[{calif:'-1', fechaEntrega:''}]});  
        }else if(appCategoria=='lectura'){
          budo['respuestas'].push({"idAlumno":response.result.students[i].userId, "nombreAlumno":response.result.students[i].profile.name.fullName, "entregas":[{calif:'-2', fechaEntrega:''}]});
        }else if(appCategoria=='aplicacionCL' || appCategoria=='aplicacionL'){
          budo['respuestas'].push({"idAlumno":response.result.students[i].userId, "nombreAlumno":response.result.students[i].profile.name.fullName, "entregas":[{calif:'-3', fechaEntrega:''}]});
        }else if(/.imulador.*/.test(appCategoria)){ //Simuladores
        	console.log("es un simulador, generando budo");
          	budo['respuestas'].push({"idAlumno":response.result.students[i].userId, "nombreAlumno":response.result.students[i].profile.name.fullName, "entregas":[{calif:'-4', fechaEntrega:''}]});
        }else{
          budo['respuestas'].push({"idAlumno":response.result.students[i].userId, "nombreAlumno":response.result.students[i].profile.name.fullName, "entregas":[{calif:'', fechaEntrega:''}]});  
        }
      }
      banderaPlus-=1;
    }
  },function(err) { console.error("Execute error", err); });
}

function getCursos() {
  /*
  * NOMBRE: getCursos.
  * UTILIDAD: Obtiene todos los cursos de un profesor.
  * ENTRADAS: Ninguna.
  * SALIDAS: Ninguna.
  */ 
  gapi.client.classroom.courses.list()
  .then(function(response) {
    var courses = response.result.courses;
    if (courses.length > 0) { //Si se encontraron cursos
      banderas = courses.length;
      for (i = 0; i < courses.length; i++)//Para cada curso que se obtuvo del profesor
        getTareas(courses[i].id, courses[i].name); //Obtener las tareas de un curso en especifico
    } else {
      console.log('No se encontraron cursos');
    }
  });
}

function getTareas(id, nombre){
  /*
  * NOMBRE: getTareas.
  * UTILIDAD: Obtiene las tareas de un curso en especifico y arma el JSON que se va a insertar en la DB con la info de estas.
  * ENTRADAS: id -> ID del curso para buscar las tareas, nombre -> Nombre del curso para buscar las tareas.
  * SALIDAS: Ninguna.
  */ 
  gapi.client.classroom.courses.courseWork.list({
      "courseId": id,
      "courseWorkStates": [
        "PUBLISHED"
      ]
    }).then(function(response) {
      var tareas = response.result.courseWork; //Se obtienen las tareas de un curso de Google classroom
      if(tareas!=undefined){
        if (tareas.length > 0) { //Si se encontraron tareas
              for (i = 0; i < 1; i++) { //Para cada tarea MÁS RECIENTE DE CADA CURSO
                var tarea = tareas[i];
                if((tarea.materials!=undefined)&&(tarea.materials.length > 0)){ //Lista todos los materials[link][url] de cada tarea activa de cada curso activo
                  if(new Date(Date.parse(tarea['creationTime'])) > lastDate){
                    lastDate = new Date(Date.parse(tarea['creationTime']));
                    codigoTareaClassroom = tarea.materials[0]['link']['url'].split('=')[1]+'=';
                    budo = {'crID':codigoTareaClassroom,'courseName':nombre,'courseID':tarea.courseId,'courseWorkTitle':tarea.title, 'courseWorkID':tarea.id, 'activityLink':tarea.materials[0]['link']['url'], respuestas:[], 'maxPoint':tarea.maxPoints, 'type':tarea.workType, 'profesor':googleUser.getBasicProfile().getName(), 'dueDate':'', 'dueTime':'', 'creatorUserID':tarea.creatorUserId};
                      if(tarea.dueDate!=undefined){
                        tarea.dueDate.day--;                        
                        budo['dueDate'] = tarea.dueDate.day+'/'+tarea.dueDate.month+'/'+tarea.dueDate.year;
                        if(tarea.dueTime!=undefined){
                          if(tarea.dueTime.minutes==undefined)
                            tarea.dueTime.minutes = '00';
                          //Ajustar bien la hora!
                          tarea.dueTime.hours = tarea.dueTime.hours + 17;
                          budo['dueTime'] = tarea.dueTime.hours+':'+tarea.dueTime.minutes;
                        }
                      }
                      if(tarea.scheduledTime!= undefined){
                        budo['creationTime'] =  tarea.scheduledTime;
                      }else{
                        budo['creationTime'] =  tarea.creationTime;
                      }
                      if(tarea.topicId!=undefined)
                        budo['topicId'] =  tarea.topicId;
                      if(tarea.maxPoints==undefined)
                          budo['maxPoint'] = '';
                      break;
                  }else{
                    setTimeout(function(){
                      if(!tareaAsignada && !scanStarted){
                        scanStarted=true;
                        console.log("creation time:");console.log(tarea['creationTime']);
                        console.log("last date:");console.log(lastDate);
                        window.alert("Se encontró un problema, revise la fecha y hora correcta del dispositivo, recargue la página e intente nuevamente.");
                      }
                    },5000);
                  }
                }
              }
            } else {
              console.log('No se encontraron tareas.');
            }
      }
      banderas-=1;
    },
    function(err) { console.error("Execute error", err); });
}

function setID(prefijo, nombre, idApp, categoria){ 
  /*
    * NOMBRE: setID.
    * UTILIDAD: Genera un ID único para cada aplicación a compartir y lo inserta en el url de share classroom.
    * ENTRADAS: prefijo-> El prefijo de la aplicación a compartir, nombre-> Nombre de la aplicación a compartir, idApp-> Id de la app.
    * SALIDAS: Ninguna.
  */
  var dt = new Date();
  var generatedID = window.btoa(dt.getDate()+''+(dt.getMonth()+1)+''+dt.getFullYear()+''+dt.getHours() + "" + dt.getMinutes() + "" + dt.getSeconds()+''+prefijo); //Generar un ID único para cada aplicación.
  var dos = generatedID.substr(-2); //Debido a la recuperación del ID en la URL (con la función split(=)), hay problemas cuando el ID tiene dos '==' al final.

  if(dos[0]=='=' && dos[1]=='='){ //Tiene dos '=', eliminar el último
    generatedID = generatedID.slice(0, -1);
  }else if(dos[0]!='=' && dos[1]!='='){ //Para el caso de que no tenga ningun '=' insertarle uno
    generatedID = generatedID+'=';
  }
  idAppAux = idApp;
  if(idApp.split('-')[1] == 'cr') //Lo más reciente, quitar los últimos caracteres    
    idApp = idApp.split('-')[0];
  appCategoria2 = categoria;
  $('#classroomShareBtn1'+idAppAux).html('<script src="https://apis.google.com/js/platform.js" async defer></script><g:sharetoclassroom onsharestart="startProfe" onsharecomplete="setRegistro" title="'+nombre+'" url="https://'+dominio+'/KrismarApps/index.php/'+controller+'/cargarApp/'+idApp+'/'+portal+'?id='+generatedID+'" size="32" itemtype="assignment"></g:sharetoclassroom>'); //Insertar la información necesaria en el share btn MDT DESARROLLO
}
/***********************************************************************************
* 
*                            *.*.*.*.*.*.* CREACIÓN DE REPORTES  *.*.*.*.*.*.* 
*
*************************************************************************************/
function muestraDocente(){
  /*
    * NOMBRE: muestraDocente.
    * UTILIDAD: Realiza scrool al final de la páfina y lanza la función para revisar el login de Google.
    * ENTRADAS: Ninguna.
    * SALIDAS: Ninguna.
  */
  if($("[name='docente']").css("opacity") > '0.5' ){
    $("#libros_sep2, #libros_sep, #clasicos, #museosLat, #GRcontainer").hide();
	  ocultaSubtemas();
	  if($("#GRcontainer").css("display") == "none")
	    $("#GRcontainer").css("display","table");
	  $("body").stop().animate({
	      scrollTop: $("#GRcontainer").offset().top - (altoNavegacion + 20)
	    },500,"linear",
	    function(){
	      ocultaMenuAnimado();
	      $("#iconregresarlibro").show().css({'margin-top':'180px','margin-bottom':'0px'});
	    }
	  );
	  showCourseSelect(false);
	  checkGoogleReportLogged();
  }
}

function checkGoogleReportLogged(){
  /*
    * NOMBRE: checkGoogleReportLogged.
    * UTILIDAD: Encadena la ejecución de las funciones de autenticación de Google.
    * ENTRADAS: Ninguna.
    * SALIDAS: Ninguna.
  */
  if(localStorage.getItem("ses") == '1'){
    loadClientGAPI().then(executeGRP1).then(executeGRP2).then(showCourseSelect(true));
  }else{
    authenticate().then(loadClientGAPI).then(executeGRP1).then(executeGRP2).then(showCourseSelect(true));
  }
}

function authenticateGR() {
  /*
    * NOMBRE: authenticateGR.
    * UTILIDAD: Ejecuta la antenticación de Google..
    * ENTRADAS: Ninguna.
    * SALIDAS: Ninguna.
  */
  return gapi.auth2.getAuthInstance()
      .signIn({scope: "https://www.googleapis.com/auth/classroom.courses.readonly https://www.googleapis.com/auth/classroom.coursework.students.readonly"})
      .then(function() {},
      function(err) { /*console.error("Error signing in", err);*/ });
}

function loadClientGR() {
  /*
  * NOMBRE: loadClientGRI.
  * UTILIDAD: Carga el cliente Google con el API KEY Y DOCS correspondientes para el proyecto.
  * ENTRADAS: Ninguna.
  * SALIDAS: Ninguna.
  */
  gapi.client.setApiKey(API_KEY);
  return gapi.client.load("https://content.googleapis.com/discovery/v1/apis/classroom/v1/rest")
      .then(function() {  },
        function(err) { /*console.error("Error loading GAPI client for API", err);*/ });
}

function executeGRP1() {
  /*
  * NOMBRE: executeGRP1.
  * UTILIDAD: Obtiene los cursos de Classroom de un profesor.
  * ENTRADAS: Ninguna.
  * SALIDAS: Ninguna.
  */
  return gapi.client.classroom.courses.list({
      "courseStates": [
        "ACTIVE"
      ]
  })
    .then(function(response) {
      GRcourses = response.result;
    },function(err) { 
      GRcourses = [];
      //console.error("Execute error", err);
      emstop = true;
      $('.gRlistbody').hide(0);
      $('.gRlistNotice').html("No se encontró una sesión activa.");
      $('.gRlistNotice').append('<br/><div class="btngR2" onclick="GRchangeAccount()"><div class="btngR2img"><img src="src/img/glogo.png"></div><div class="btngR2txt">Acceder con Google</div></div>');
    }); 
}

function executeGRP2() { 
  /*
  * NOMBRE: executeGRP2.
  * UTILIDAD: Obtiene la info del usuario de Google.
  * ENTRADAS: Ninguna.
  * SALIDAS: Ninguna.
  */
  if(!emstop){
    GRuser = gapi.auth2.getAuthInstance().currentUser.get();
  }
}

function showCourseSelect(mustshow){
  /*
  * NOMBRE: showCourseSelect.
  * UTILIDAD: Dependiendo de la entrtada, carga el select de cursos.
  * ENTRADAS: mustshow -> Booleano para indicar si debe de cargar el select de cursos o limpiar las variables que se usan.
  * SALIDAS: Ninguna.
  */
  if(mustshow){
    $('.gRlistbody').hide(0);
    $(".gReportList").show(500);
    $('.gRlistNotice').html("Cargando cursos.").css({'position':'relative', 'left':'-2%', 'top':'9rem', 'text-align':'center'});
    loadCourses();
  }else{
    GRcourses = null;
    GRuser = null;
    GRaux = null;
    GRWorkAux = null;
    GRSelected = null;
    $(".gReportList").hide(500);
  }
}

function loadCourses(){
  /*
  * NOMBRE: loadCourses.
  * UTILIDAD: Llena un array con los cursos del profesor.
  * ENTRADAS: Ninguna.
  * SALIDAS: Ninguna.
  */
  if(GRuser!=null && GRcourses!=null){
    let aux = [];
    for(let i=0; i < GRcourses.courses.length; i++)
      if(GRcourses.courses[i]['ownerId'] == GRuser.getBasicProfile().getId())
        aux.push(GRcourses.courses[i]);
    GRaux = aux;
    GRprepareSelect();
  }else{
    setTimeout(function(){
      loadCourses();
    },500);
  }
}

function GRprepareSelect(){
  /*
  * NOMBRE: GRprepareSelect.
  * UTILIDAD: Despliega e inserta las opciones en el select de los cursos del profesor.
  * ENTRADAS: Ninguna.
  * SALIDAS: Ninguna.
  */
  $('#GRIdForReport').empty();
  $('.gRlistNotice').html("");
  $("#GRIdForReport span").html("Selecciona tu grupo:");
  $('.gRlistbodyName').html("Profesor: "+GRuser.getBasicProfile().getName());
  if(GRaux.length > 0){
    $('#GRIdForReport').append("<option value=-1>Selecciona un curso</option>");
    for (let i = 0; i < GRaux.length; i++)
      $('#GRIdForReport').append("<option value="+i+">"+GRaux[i]['name']+"</option>");
    $('.gRlistbody').show(200);
  }else{
    $('.gRlistbody').hide(0);
    $('.gRlistNotice').html("No se encontraron cursos disponibles.");
    $('.gRlistNotice').append('<br/><div class="btngR2" onclick="GRchangeAccount()"><div class="btngR2img"><img src="src/img/glogo.png"></div><div class="btngR2txt">Cambiar de cuenta Google</div></div>');
  }
}

function GRgetReporteP1(id){
  /*
  * NOMBRE: GRgetReporteP1.
  * UTILIDAD: Encadena la ejecución de funciones para obtener los cursos, actualizar las tareas y alumnos y generar el reporte.
  * ENTRADAS: Ninguna.
  * SALIDAS: Ninguna.
  */
  GRSelected = $('#GRIdForReport').val();
  if(GRSelected!=-1){
    $('.gRlistbody').hide(0);
    let curso = GRaux[GRSelected];
    $('.gRlistNotice').html("Generando el reporte de la clase "+GRaux[GRSelected]['name']+".").css({'position':'relative', 'top':'100px', 'left':'0%', 'text-align':'center'});;
    getCourseWork(curso['id'])
      .then(updateTareas(curso['id']))
        .then(getAlumnos(curso['id']))
          .then(updateAlumnos(curso['id']))
            .then(GRgetReporteP2);
  }else{
    $('.gRlistNotice').html("Elige un curso.").css({'position':'relative', 'left':'-2%', 'top':'20rem', 'text-align':'center'});
  }
}

function getCourseWork(id) {
  /*
  * NOMBRE: getCourseWork.
  * UTILIDAD: Obtiene las tareas de un cursos en especifico y las inserta en un array.
  * ENTRADAS: id -> ID del cursos seleccionado para generar el reporte.
  * SALIDAS: Ninguna.
  */
  return gapi.client.classroom.courses.courseWork.list({
    "courseId": id
  }).then(function(response) {
    if(response.result.courseWork != undefined ){
      console.log('getCourseWork');
      GRWorkAux = response.result.courseWork;
      coursesWork = []; /*azl*/
      for(var j=0;j<GRWorkAux.length;j++)
        coursesWork.push(GRWorkAux[j]['id']);
    }else{ //El curso seleccionado NO tiene tareas asignadas
        GRWorkAux =[];
    }
    next = 1; //Bandera para que la siguiente función encadenada se ejecute
    },function(err) { 
      GRWorkAux =[];
      /*console.error("Execute error", err);*/
    });
}

function updateTareas(cID){
  /*
  * NOMBRE: updateTareas.
  * UTILIDAD: Actualiza las tareas del cursos seleccionado para generar reporte, eliminando de la DB las que no se encuentren en Classroom.
  * ENTRADAS: cID -> ID del curso seleccionado para generar su reporte.
  * SALIDAS: Ninguna.
  */
  if(next==1){ //Si el indicador es 1 (La petición de las tareas a Classroom se finalizó)
    console.log('updateTareas');
    $.post(
      IP+"Classroom_controller/getAllCourseWork",
      {cID:cID},
      function(data){
        data = data.split('-'); //Array con las tareas en la DB del curso seleccionado
        for(var j=1;j<data.length;j++){
          if(!coursesWork.includes(data[j])){ //La tarea NO está en Classroom, eliminarla
            $.post(
              IP+"Classroom_controller/deleteCourseWork", //Elimina la tarea de la DB si no está en Classroom
              {id:data[j]},
              function(data){
                console.log('Tarea: eliminada');
              });
          }
        }
        });
    next = 2; //Indicador para la siguiente función
  }else{
    setTimeout(function(){
      updateTareas(cID);
    },1000);
  }
}
function getAlumnos(courseID){
  /*
  * NOMBRE: getAlumnos.
  * UTILIDAD: Obtiene los alumnos de un curso de Classroom y almacena sus IDs y Nombres.
  * ENTRADAS: courseID -> ID del curso seleccionado para generar el reporte.
  * SALIDAS: Ninguna.
  */
  if(next==2){ //Si la actualización de las tareas terminó
    return gapi.client.classroom.courses.students.list({ //Petición a Google Classroom de los alumnos
      "courseId": courseID
    }).then(function(response) {
      if(response.result.students == undefined || response.result.students == null){
        emstop=true;
        next = 3;
      }else{
        idAlumnos=[];
        nombreAlumnos=[];
        for(var i=0;i<response.result.students.length;i++){ //Para cada alumno
          idAlumnos.push(response.result.students[i]['userId']); //Almacenar su ID en un array
          nombreAlumnos.push(response.result.students[i]['profile']['name']['fullName']) //Almacenar su nombre en un array
        }
        idAlumnosCurso = idAlumnos.join('-');
        nombreAlumnosCurso = nombreAlumnos.join('-');
        next = 3;
      }
    },function(err) { /*console.error("Execute error", err);*/ });
  }else{
    setTimeout(function(){
      getAlumnos(courseID);
    },1000);
  }
}

function updateAlumnos(courseID){
  /*
  * NOMBRE: updateAlumnos.
  * UTILIDAD: Sincroniza los alumnos que hay en Classroom con la DB de Krismar.
  * ENTRADAS: courseID -> ID del curso que se seleccionó para generar su reporte.
  * SALIDAS: Ninguna.
  */
  if(next==3){ //Si se terminó de obtener de Google los alumnos
    if(emstop){
      next = 4;
    }else{
      console.log('updateAlumnos');
      $.post(
        IP+"Classroom_controller/syncAlumnosCurso",
        {idCurso:courseID, idAlumnosCurso:idAlumnosCurso, nombreAlumnosCurso:nombreAlumnosCurso},
        function(data){
          next = 4; //Indicador para la función de generar el reporte
        });
    }
  }else{
    setTimeout(function(){
      updateAlumnos(courseID);
    },1000);
  }
}

function GRgetReporteP2(){
  /*
  * NOMBRE: GRgetReporteP2.
  * UTILIDAD: Prepara el array con la ifnormación del reporte y hace el POST al controlador con la info necesaria.
  * ENTRADAS: Ninguna.
  * SALIDAS: Ninguna.
  */
  if(next==4){
    if(emstop){
      GRprepareSelect();
      $('.gRlistNotice').html("No  se encontraron alumnos en el curso seleccionado.").css({'position':'relative', 'top':'20rem', 'left':'0%', 'text-align':'center'});
      next = 0; //Restaurar el indicador para la cadena de funciones a ejecutar
      coursesWork = [];
      idAlumnos = []; 
      nombreAlumnos = []; //Almacena los nombres de los alumnos en un curso de classroom
      idAlumnosCurso = '';
      nombreAlumnosCurso = '';
      $('.gRlistbody').show(200);
    }else{
      if(GRWorkAux.length > 0){
        let arr = [];
        for (let i = 0; i < GRWorkAux.length; i++)
          arr.push(GRWorkAux[i]['id']);
        $.post(
          IP+"Classroom_controller/getCourseForReport",
          {arr:arr.reverse(),name:GRuser.getBasicProfile().getId()},
          function(data){
            if(data!=undefined && data!=null && data!=false && data!=""){
              data = JSON.parse(data);
              window.open(data['url']);
              GRprepareSelect();
            }else{
              GRprepareSelect();
              $('.gRlistNotice').html("No se encontraron registros de tareas de esta clase.");
            }
          });
      }else{
        GRprepareSelect();
        $('.gRlistNotice').html("No  se encontraron tareas en el curso seleccionado.").css({'position':'relative', 'top':'20rem', 'left':'0%', 'text-align':'center'});
      }
    }
  }else{
    setTimeout(function(){
      GRgetReporteP2();
    },1000);
  }
}

gapi.load("client:auth2", function() {
  gapi.auth2.init({client_id: CLIENT_ID});
});