 <!DOCTYPE html>
 <html>
 <head>
		<!--<link href="<?=base_url()?>src/css/primaria_diseno_apps.css" rel="stylesheet" type="text/css">
        <script src="<?=base_url()?>src/js/jquery-1.11.1.js" type="text/javascript"></script>
        <script src="<?=base_url()?>src/js/jquery-ui.min.js" type="text/javascript"></script>-->
        <script src="<?=base_url()?>src/js/user_apps.js?<?=rand()?>" type="text/javascript" async = "async"></script>
     <title></title>
 </head>
 <body>
    <article class="p_article" id="buscar" >
        <div class="p_articlecenter">
          
            <div class="p_buscador">
                <input id = "inputB" class="p_buscadorinput" placeholder="Buscar actividades educativas" onkeyup="buscaTypeApps(this.value)" onfocus = "muestraApps();" >
                <div id = "busca_cierra_apps" class="p_buscadoricon"></div>
            </div>
            <div class="p_buscadortxt">Ejemplo: ángulos, preposiciones, animales, historia, etc.</div>
			  <?php if(!$this->bandera_movil){ ?>
            <div class="p_switch" >
                <div class="p_switchconte" onclick = "filtraMovilPc(estadoSwitch == 1?0:1)">
                    <table class="p_switchtext" onclick = "filtraMovilPc(0);event.stopPropagation();"><tr><td>Móvil</td></tr></table>
                    <div class="p_switchbtn">
                        <div class = "p_switch_m" id = "movil"></div>
                        <div class="p_switchbtnin"></div>
                        <div class = "p_switch_pc" id = "pc"></div>
                    </div>
                    
                    <table class="p_switchtext p_switchcolor"  onclick = "filtraMovilPc(1);event.stopPropagation();"><tr><td>PC</td></tr></table>
                </div>
            </div>
            <?php } ?>
        </div>
    </article>
    <article id="actividades">
            <div class="p_articlecenter">
              

                <div class="p_articletitle">Nuestras actividades</div>
                <div class="p_articleline"></div>
                <div class="p_articleconte" id ="apps_user">

                    <div class="p_actividadesmenu">
                        <div class="p_opcionuno p_actividadesmenubtn" id = "materia_filtro" onclick = "muestraMenuFiltro('acttemas', $(this))">
                            <div class="p_actmenubtnimg" id = "img_materia"></div>
                            <div class="p_actmenubtntxt" id = "materia_app">Asignatura</div>
                        </div>
                        <div class="p_opciondos p_actividadesmenubtn" id = "subtema_filtro" onclick = "muestraMenuFiltro('actsubtemas', $(this))">
                            <div class="p_actmenubtnimg" id = "img_"></div>
                            <div class="p_actmenubtntxt" id = "subtema_app">Temas</div>
                            <!--div class="p_actmenubtntxt" id = "grado_app">Grado</div-->
                        </div>
                        <div class="p_opciontres p_actividadesmenubtn" id = "grado_filtro" onclick = "muestraMenuFiltro('actgrados', $(this))">
                            <div class="p_actmenubtnimg" id = "img_grado"></div>
                            <!--div class="p_actmenubtntxt" id = "categoria_app">Categoría</div-->
                            <div class="p_actmenubtntxt" id = "grado_app">Grados</div>
                        </div>
                    </div>
                    
                    <div class="p_actividadescateg">
                        <div class="p_actividadescategopcion" categoria = "aplicacion">
                            <div class="p_actividadescategicon p_categapp" id = "filtro_aplicacion" onclick = "seleccionaFiltroCategoria('aplicacion',$(this))"></div>
                        </div>
                        <div class="p_actividadescategopcion" categoria = "lectura">
                            <div class="p_actividadescategicon p_categlec" id = "filtro_lectura" onclick = "seleccionaFiltroCategoria('lectura',$(this))" ></div>
                        </div>
                        <div class="p_actividadescategopcion" categoria = "video">
                            <div class="p_actividadescategicon p_categvid" id = "filtro_video" onclick = "seleccionaFiltroCategoria('video',$(this))"></div>
                        </div>
                        <div class="p_actividadescategopcion" categoria = "evaluacion">
                            <div class="p_actividadescategicon p_categeva" id = "filtro_evaluacion" onclick = "seleccionaFiltroCategoria('evaluacion',$(this))"></div>
                        </div>
                        <div class="p_actividadescategtxt">
                            <table><tr><td onclick = "limpiarFiltros(true)">Limpiar filtros</td></tr></table>
                            <div></div>
                        </div>
                    </div>
                    
                    <div class="p_act2center">
                        
                        
                        <table class = "p_conte_notificacion">
                            <tr>
                                <td>
                                    No se encontraron resultados.
                                </td>
                            </tr>
                        </table>

                        <!--Aqui van las apps-->

                        
                      <div class="p_actbtnnav">
                    <div hidden  id= "pagActual"></div>
                        <div class="p_actnavcenter" >
                            <div id = "p_actnavarrowleft" class="p_actnavarrowleft"></div>
                            <div id = "pag_user" style = "float:left;">
                            <div class="p_actnavnum">1</div>
                            <div class="p_actnavnum p_actnavnum_active">2</div>
                            <div class="p_actnavnum">3</div>
                            <div class="p_actnavnum">4</div>
                            <div class="p_actnavnum">...</div>
                            </div>
                            <div id = "p_actnavarrowright" class="p_actnavarrowright"></div>
                        </div>
                    </div>
                    <div class = "p_actfondo"></div>

                    <div class="p_actdesplegable">
                        <div class="p_actconte">

                            <!--TEMAS-->
                            <div class="p_actcontein" id="acttemas">

                                <div class="p_acttemas" id = "materia_mat" onclick = "seleccionaFiltroMateria('mat', $(this))">
                                    <div class="p_acttemasicon">
                                        <div class="p_acttemasimg p_temas_mat">
                                            <div class="p_temasboxlight"></div>
                                        </div>
                                    </div>
                                    <table class="p_acttemastxt"><tr><td>Matemáticas</td></tr></table>
                                </div>
                                <!--div class="p_acttemas" id = "materia_esp" onclick = "seleccionaFiltroMateria('lec', $(this))">
                                    <div class="p_acttemasicon">
                                        <div class="p_acttemasimg p_temas_esp">
                                            <div class="p_temasboxlight"></div>
                                        </div>
                                    </div>
                                    <table class="p_acttemastxt"><tr><td>Lecturas</td></tr></table>
                                </div-->

                                <div class="p_acttemas" id = "materia_esp" onclick = "seleccionaFiltroMateria('len', $(this))">
                                    <div class="p_acttemasicon">
                                        <div class="p_acttemasimg p_temas_esp">
                                            <div class="p_temasboxlight"></div>
                                        </div>
                                    </div>
                                    <table class="p_acttemastxt"><tr><td>Lenguaje y Comunciación</td></tr></table>
                                </div>

                                <!--div class="p_acttemas" id = "tema_rv" onclick = "seleccionaFiltroMateria('rv', $(this))">
                                    <div class="p_acttemasicon">
                                        <div class="p_acttemasimg p_temas_rver">
                                            <div class="p_temasboxlight"></div>
                                        </div>
                                    </div>
                                    <table class="p_acttemastxt"><tr><td>Razonamiento Verbal</td></tr></table>
                                </div-->

                                <!--div class="p_acttemas" id = "tema_05" onclick = "seleccionaFiltroMateria('ana', $(this))">
                                    <div class="p_acttemasicon">
                                        <div class="p_acttemasimg p_temas_ana">
                                            <div class="p_temasboxlight"></div>
                                        </div>
                                    </div>
                                    <table class="p_acttemastxt"><tr><td>Anatomía</td></tr></table>
                                </div-->

                                <div class="p_acttemas" id = "materia_hab" onclick = "seleccionaFiltroMateria('hab', $(this))">
                                    <div class="p_acttemasicon">
                                        <div class="p_acttemasimg p_temas_hab">
                                            <div class="p_temasboxlight"></div>
                                        </div>
                                    </div>
                                    <table class="p_acttemastxt"><tr><td>Habilidades</td></tr></table>
                                </div>

                                <div class="p_acttemas" id = "materia_tec" onclick = "seleccionaFiltroMateria('tec', $(this))">
                                    <div class="p_acttemasicon">
                                        <div class="p_acttemasimg p_temas_tec">
                                            <div class="p_temasboxlight"></div>
                                        </div>
                                    </div>
                                    <table class="p_acttemastxt"><tr><td>Tecnología</td></tr></table>
                                </div>

                                <div class="p_acttemas" id = "materia_geo" onclick = "seleccionaFiltroMateria('geo', $(this))">
                                    <div class="p_acttemasicon">
                                        <div class="p_acttemasimg p_temas_geo">
                                            <div class="p_temasboxlight"></div>
                                        </div>
                                    </div>
                                    <table class="p_acttemastxt"><tr><td>Geografía</td></tr></table>
                                </div>

                                <!-- INGLES NO BORRAR <div class="p_acttemas" id = "materia_ing" onclick = "seleccionaFiltroMateria('ing', $(this))">
                                    <div class="p_acttemasicon">
                                        <div class="p_acttemasimg p_temas_ing">
                                            <div class="p_temasboxlight"></div>
                                        </div>
                                    </div>
                                    <table class="p_acttemastxt"><tr><td>Inglés</td></tr></table>
                                </div>-->

                                <div class="p_acttemas" id = "materia_his" onclick = "seleccionaFiltroMateria('his', $(this))">
                                    <div class="p_acttemasicon">
                                        <div class="p_acttemasimg p_temas_his">
                                            <div class="p_temasboxlight"></div>
                                        </div>
                                    </div>
                                    <table class="p_acttemastxt"><tr><td>Historia</td></tr></table>
                                </div>

                                <!--div class="p_acttemas" id = "tema_eco" onclick = "seleccionaFiltroMateria('eco', $(this))">
                                    <div class="p_acttemasicon">
                                        <div class="p_acttemasimg p_temas_eco">
                                            <div class="p_temasboxlight"></div>
                                        </div>
                                    </div>
                                    <table class="p_acttemastxt"><tr><td>Ecología</td></tr></table>
                                </div-->

                                <!--div class="p_acttemas" id = "tema_03" onclick = "seleccionaFiltroMateria('hab', $(this))">
                                    <div class="p_acttemasicon">
                                        <div class="p_acttemasimg p_temas_rmat">
                                            <div class="p_temasboxlight"></div>
                                        </div>
                                    </div>
                                    <table class="p_acttemastxt"><tr><td>Razonamiento</td></tr></table>
                                </div-->

                                <div class="p_acttemas" id = "materia_nat" onclick = "seleccionaFiltroMateria('nat', $(this))">
                                    <div class="p_acttemasicon">
                                        <div class="p_acttemasimg p_temas_nat">
                                            <div class="p_temasboxlight"></div>
                                        </div>
                                    </div>
                                    <table class="p_acttemastxt"><tr><td>Ciencias Naturales</td></tr></table>
                                </div>

                                <div class="p_acttemas" id = "materia_cye" onclick = "seleccionaFiltroMateria('cye', $(this))">
                                    <div class="p_acttemasicon">
                                        <div class="p_acttemasimg p_temas_cye">
                                            <div class="p_temasboxlight"></div>
                                        </div>
                                    </div>
                                    <table class="p_acttemastxt"><tr><td>Formación cívica y ética</td></tr></table>
                                </div>

                                <!--div class="p_acttemas" id = "materia_edf" onclick = "seleccionaFiltroMateria('edf', $(this))">
                                    <div class="p_acttemasicon">
                                        <div class="p_acttemasimg p_temas_efis">
                                            <div class="p_temasboxlight"></div>
                                        </div>
                                    </div>
                                    <table class="p_acttemastxt"><tr><td>Educación física</td></tr></table>
                                </div-->

                                <div class="p_acttemas" id = "materia_art" onclick = "seleccionaFiltroMateria('art', $(this))">
                                    <div class="p_acttemasicon">
                                        <div class="p_acttemasimg p_temas_art">
                                            <div class="p_temasboxlight"></div>
                                        </div>
                                    </div>
                                    <table class="p_acttemastxt"><tr><td>Educación artística</td></tr></table>
                                </div>

                            </div>
                            
                            <!--SUBTEMAS-->
                            <div class="p_actcontein" id="actsubtemas">
                                
                                <div class="p_actsubtemas">
                                    <div class="p_actsubtemasicon">
                                        <div class="p_actsubtemasiconin"></div>
                                    </div>
                                    <table class="p_actsubtemastxt"><tr><td>Selecciona una asignatura para ver los temas.</td></tr></table>
                                </div>
                            </div>

                            <!--GRADO-->
                            <div class="p_actcontein" id="actgrados">

                                <div class="p_actgrados" id = "grado_1">
                                    <div class="p_actgradosin p_temas_primero" onclick="seleccionaFiltroGrado('1°');">
                                        <div class="p_gradosboxlight"></div>
                                    </div>
                                </div>

                                <div class="p_actgrados" id ="grado_2">
                                    <div class="p_actgradosin p_temas_segundo" onclick="seleccionaFiltroGrado('2°');">
                                        <div class="p_gradosboxlight"></div>
                                    </div>
                                </div>

                                <div class="p_actgrados" id = "grado_3">
                                    <div class="p_actgradosin p_temas_tercero" onclick="seleccionaFiltroGrado('3°');">
                                        <div class="p_gradosboxlight"></div>
                                    </div>
                                </div>

                                <div class="p_actgrados" id = "grado_4">
                                    <div class="p_actgradosin p_temas_cuarto" onclick="seleccionaFiltroGrado('4°');">
                                        <div class="p_gradosboxlight"></div>
                                    </div>
                                </div>

                                <div class="p_actgrados" id = "grado_5">
                                    <div class="p_actgradosin p_temas_quinto" onclick="seleccionaFiltroGrado('5°');">
                                        <div class="p_gradosboxlight"></div>
                                    </div>
                                </div>

                                <div class="p_actgrados" id = "grado_6">
                                    <div class="p_actgradosin p_temas_sexto" onclick="seleccionaFiltroGrado('6°');">
                                        <div class="p_gradosboxlight"></div>
                                    </div>
                                </div>

                            </div>

                            <!--CATEGORIA-->
                            <div class="p_actcontein" id="actcategoria">
                                <!--id = "filtro_aplicacion"-->
                                <div class="p_actcategoria"  onclick = "seleccionaFiltroCategoria('aplicacion',$(this))">
                                    <div class="p_actcategoriaicon">
                                        <div class="p_actcategoriaimg p_aplicacion">
                                            <div class="p_temasboxlight"></div>
                                        </div>
                                    </div>
                                    <table class="p_actcategoriatxt"><tr><td>Aplicación</td></tr></table>
                                </div>
                                <!--id = "filtro_lectura"-->
                                <div class="p_actcategoria"  onclick = "seleccionaFiltroCategoria('lectura',$(this))">
                                    <div class="p_actcategoriaicon">
                                        <div class="p_actcategoriaimg p_lectura">
                                            <div class="p_temasboxlight"></div>
                                        </div>
                                    </div>
                                    <table class="p_actcategoriatxt"><tr><td>Lectura</td></tr></table>
                                </div>
                                <!--id = "filtro_video"-->
                                <div class="p_actcategoria"  onclick = "seleccionaFiltroCategoria('video',$(this))">
                                    <div class="p_actcategoriaicon">
                                        <div class="p_actcategoriaimg p_video">
                                            <div class="p_temasboxlight"></div>
                                        </div>
                                    </div>
                                    <table class="p_actcategoriatxt"><tr><td>Video</td></tr></table>
                                </div>
                                <!--id = "filtro_evaluacion"-->
                                <div class="p_actcategoria"  onclick = "seleccionaFiltroCategoria('evaluacion',$(this))">
                                    <div class="p_actcategoriaicon">
                                        <div class="p_actcategoriaimg p_evaluacion">
                                            <div class="p_temasboxlight"></div>
                                        </div>
                                    </div>
                                    <table class="p_actcategoriatxt"><tr><td>Evaluación</td></tr></table>
                                </div>

                            </div>

                        </div>
                        <div class="p_actclosemove">
                            <div class="p_actclosemovecenter"></div>
                        </div>
                        <div class="p_actclose" onclick = "closeMenuAct()"></div>
                    </div>


                </div>
            </div>
            </div>
        </article>
        
        <div class="recienteicon"></div>
		<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-106834730-1', 'auto');
  ga('send', 'pageview');

</script>
		<!-- Global Site Tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-106834730-1"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments)};
		  gtag('js', new Date());

		  gtag('config', 'UA-106834730-1');
		</script>
 </body>
 </html>
