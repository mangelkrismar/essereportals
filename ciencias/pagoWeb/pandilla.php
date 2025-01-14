<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
   
} else {
    header('Location: index.php');
    exit();
}



$now = time();
  
if($now > $_SESSION['expire']) {
    session_destroy();
    header('Location: index.php?expire');
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="msapplication-TileColor" content="#12619B"><!--color tiles windows 8.1-->
<meta name="msapplication-square70x70logo" content="../KrismarApps/src/sistema/img/web_krismarlogo_windows.png"><!--icon tiles windows 8.1-->
<meta name="msapplication-square150x150logo" content="../KrismarApps/src/sistema/img/web_krismarlogo_windows.png"><!--icon tiles windows 8.1-->
<meta name="msapplication-wide310x150logo" content="../KrismarApps/src/sistema/img/web_krismarlogo_windows.png"><!--icon tiles windows 8.1-->
<meta name="msapplication-square310x310logo" content="../KrismarApps/src/sistema/img/web_krismarlogo_windows.png"><!--icon tiles windows 8.1-->
    
<link rel="shortcut icon" href="../KrismarApps/src/sistema/img/web_krismarlogo_favicon.png"> 
<link href="../KrismarApps/src/sistema/img/web_krismarlogo.png" rel="icon"><!--icon android-->
<link href="../KrismarApps/src/sistema/img/web_krismarlogo.png" rel="apple-touch-icon"><!--icon apple-->
<meta name="msapplication-TileColor" content="#12619B"><!--color tiles windows 8-->
<meta name="msapplication-TileImage" content="../KrismarApps/src/sistema/img/web_krismarlogo_windows.png"><!--icon tiles windows 8-->

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width = device-width, maximum-scale = 1, user-scalable=no">
<script src="js/jquery-1.12.1.js" type="text/javascript"></script>
<script src="js/paginator.js" type="text/javascript"></script>
<script src="js/acciones.js" type="text/javascript"></script>

<link rel="stylesheet" href="css/estilosDiseno.css" />
<!--Chat-->
        <!--Inicia codigo del chat-->
        <!-- Coloque esta etiqueta después de la etiqueta de estado de Live Helper. -->
        <div id="lhc_status_container" ></div>

        <script type="text/javascript">

        
            var LHCChatOptions = {};
            LHCChatOptions.opt = {widget_height:240,widget_width:200,popup_height:420,popup_width:400};
            function initChat(){
                (function() {
                var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                var referrer = (document.referrer) ? encodeURIComponent(document.referrer.substr(document.referrer.indexOf('://')+1)) : '';
                var location  = (document.location) ? encodeURIComponent(window.location.href.substring(window.location.protocol.length)) : '';
                po.src = 'http://www.krismar-educa.com.mx/soporteLive/index.php/esp/chat/getstatus/(position)/middle_right/(top)/50/(units)/percents/(leaveamessage)/true/(noresponse)/true?r='+referrer+'&l='+location;
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                po.addEventListener('load', function(){
                    
                    if(document.getElementById('online-icon'))
                        document.getElementById('online-icon').innerHTML = "¿Tienes alguna duda?<br>¡CONTÁCTANOS!";
                });
                })();
            }
        
            initChat();
            setInterval(function(){
                initChat(); 
                
            },10000);
            
        </script>
        <!--Termina codigo del chat-->
        <!--Fin Chat-->
<title>La Pandilla</title>
</head>
    <body>
   
        
    
        <!----------------------------------
        ESTE ES EL HEADER 
        ------------------------------------>
        <header class="d_header">
            <div class="d_header_in">
                <a href="http://www.krismar.com.mx/" target="_blank"><div class="d_header_krismar"></div></a>
                <div class="d_header_ingresar" id="p_ingresar" hidden></div><!--DESPLIEGA EL EMERGENTE PARA INICIAR SESIÓN-->
                <a href="php/logout.php"><div class="d_header_cerrarSesion" ></div></a><!--TERMINA LA SESIÓN-->
            </div>
            <div class="d_header_pleca"></div>
        </header>
        <!----------------------------------
        ESTOS SON LOS DISCOS
        ------------------------------------>
        <section class="d_inicio" hiddn>
            <div class="d_inicio_temasEsp"></div>
            <div class="d_pleca">
                <div class="d_pleca_in">
                    <table class="d_plecaTxt"><tr><td>Discos</td></tr></table>
                </div>
            </div>
            <div class="d_inicio_temasEsp"></div>
            <div class="d_inicio_temas">
                <div class="d_cuadroA" id="p_cuadroA" numeroCD="1"></div>
                <div class="d_cuadroB" id="p_cuadroB" numeroCD="2"></div>
                <div class="d_cuadroC" id="p_cuadroC" numeroCD="3"></div>
                <div class="d_cuadroD" id="p_cuadroD" numeroCD="4"></div>
                <div class="d_cuadroE" id="p_cuadroE" numeroCD="5"></div>
                <div class="d_cuadroF" id="p_cuadroF" numeroCD="6"></div>
            </div>
            <div class="d_inicio_temasEsp"hidden></div>
            <div class="d_linea"hidden></div>
            <div class="d_inicio_temasEsp"hidden></div>
            <!----------------------------------
            ESTOS SON LOS DEMOS
            ------------------------------------>
            <div class="d_demos_gral"hidden>
                <div class="d_demos">
                    <table class="d_demosTXT"><tr><td>Prueba <span class="d_resaltar">gratis</span> alguno de los temas ¡AHORA MISMO!</td></tr></table>
                </div>
            </div>
            <div class="d_inicio_temasEsp"hidden></div>
            <div class="d_opcnes_gral"hidden>
                <div class="d_opcnes">
                    <div class="d_opcnA">
                        <div class="d_opcnAimg"></div>
                    </div>
                     <div class="d_opcnB">
                        <div class="d_opcnBimg"></div>
                    </div>
                     <div class="d_opcnC">
                        <div class="d_opcnCimg"></div>
                    </div>
                     <div class="d_opcnD">
                        <div class="d_opcnDimg"></div>
                    </div>
                     <div class="d_opcnE">
                        <div class="d_opcnEimg"></div>
                    </div>
                     <div class="d_opcnF">
                        <div class="d_opcnFimg"></div>
                    </div>
                    <div class="d_opcnA_B"></div>
                    <div class="d_opcnB_B"></div>
                    <div class="d_opcnC_B"></div>
                    <div class="d_opcnD_B"></div>
                    <div class="d_opcnE_B"></div>
                    <div class="d_opcnF_B"></div>
                </div>                
            </div>
            <div class="d_inicio_temasEsp"></div>
        </section>
        <!----------------------------------
        ESTAS SON LAS CATEGORÍAS
        ------------------------------------>
        <section class="d_categorias_gral" id="p_categorias">
            <div class="d_pleca">
                <div class="d_pleca_in">
                    <table class="d_plecaTxt"><tr><td>Categorías</td></tr></table>
                </div>
            </div>
            <div class="d_inicio_temasEsp"></div>
            <div class="d_categorias_in">
                <div class="d_categoriaA" id="p_categoriaA" categoria="Video"></div>
                <div class="d_categoriaB" id="p_categoriaB" categoria="Teoría"></div>
                <div class="d_categoriaC" id="p_categoriaC" categoria="Cuestionario"></div>
                <div class="d_categoriaD" id="p_categoriaD" categoria="Rompecabezas"></div>
                <div class="d_categoriaE" id="p_categoriaE" categoria="Memorama"></div>
                <div class="d_categoriaF" id="p_categoriaF" categoria="Crucigrama"></div>
                <div class="d_categoriaG" id="p_categoriaG" categoria="Sopa de letras"></div>
                <div class="d_categoriaH" id="p_categoriaH" categoria="Relaciona columnas"></div>
            </div>
            <div class="d_inicio_temasEsp"></div>
        </section>
        <!----------------------------------
        ESTAS SON LAS CATEGORÍAS
        ------------------------------------>
        <section class="d_actividades_gral" hidden id="p_actividadesGeneral">
            <div class="d_actividades_in">
                <!--BUSCAR-->
                <div class="d_buscar_gral">
                    <div class="d_buscar_in">
                        <input class="d_buscar_input" placeholder="Buscar..." id="p_buscarPalabra">
                        <div class="d_buscar_icono"></div>
                    </div>
                </div>
            </div>
            <div class="d_inicio_temasEsp"></div>
            <div class="d_actividades_menu">
                <!--ESTOS SON LAS OPCIONES EN PANTALLAS-->
                <div class="d_actividades_menuIN">
                    <div class="d_menu_opcn d_borderLeft" id="filtroDisco">
                        <table class="d_menuTXT"><tr><td>Disco</td></tr></table>
                         <div class="d_flecha"></div>
                    </div>
                    <div class="d_menu_opcn" id="filtroTema">
                        <table class="d_menuTXT"><tr><td>Tema</td></tr></table>
                        <div class="d_flecha"></div>
                    </div>
                    <div class="d_menu_opcn d_borderRight" id="filtroCategoria">
                        <table class="d_menuTXT"><tr><td>Categoría</td></tr></table>
                        <div class="d_flecha"></div>
                    </div>
                </div>
                <!--MENU EMERGENTE DE LOS DISCOS-->
                <div class="d_menuFondoEmergente" hidden id="emergenteDisco">
                    <div class="d_menuOpacidad"></div>
                    <div class="d_menuEmergenteGral">
                        <div class="d_emergenteCuadro">
                            <div class="d_emergenteDisco1" id="p_cuadroA2" numeroCD="1"></div>
                            <div class="d_emergenteDisco2" id="p_cuadroB2" numeroCD="2"></div>
                            <div class="d_emergenteDisco3" id="p_cuadroC2" numeroCD="3"></div>
                            <div class="d_emergenteDisco4" id="p_cuadroD2" numeroCD="4"></div>
                            <div class="d_emergenteDisco5" id="p_cuadroE2" numeroCD="5"></div>
                            <div class="d_emergenteDisco6" id="p_cuadroF2" numeroCD="6"></div>
                            <div class="d_close" id="p_cierraDisco"></div>
                        </div>
                    </div>
                </div>
                <!--MENU EMERGENTE DE LOS TEMAS-->
                <div class="d_menuFondoEmergente" hidden id="emergenteTema">
                    <div class="d_menuOpacidad"></div>
                    <div class="d_menuEmergenteGral d_top">
                        <div class="d_emergenteCuadro d_CuadroGris">
                            <table class="d_emergenteTema"><tr><td>Tu cuerpo</td></tr></table>
                            <table class="d_emergenteTema"><tr><td>Tu maravillosa estructura</td></tr></table>
                            <table class="d_emergenteTema"><tr><td>El increíble cerebro</td></tr></table>
                            <table class="d_emergenteTema"><tr><td>La comida y la bebida</td></tr></table>
                            <table class="d_emergenteTema"><tr><td>Respira ondo y profundo</td></tr></table>
                            <table class="d_emergenteTema"><tr><td>Corazón de melón</td></tr></table>
                            <table class="d_emergenteTema"><tr><td>¡Salud!</td></tr></table>
                            <table class="d_emergenteTema"><tr><td>Entre dinosaurios</td></tr></table>
                            <table class="d_emergenteTema"><tr><td>Reptiles y animales con escamas</td></tr></table>
                            <table class="d_emergenteTema"><tr><td>¡Cuantas plumas!</td></tr></table>
                            <table class="d_emergenteTema"><tr><td>¡Criaturas increíbles!</td></tr></table>
                            <table class="d_emergenteTema"><tr><td>Mamíferos maravilloso</td></tr></table>
                            <table class="d_emergenteTema"><tr><td>¿De dónde provenimos?</td></tr></table>
                            <div class="d_close" id="p_cierraTema"></div>
                        </div>
                    </div>
                </div>
                <!--MENU EMERGENTE DE LAS CATEGORIAS-->
                <div class="d_menuFondoEmergente" hidden id="emergenteCategoria">
                    <div class="d_menuOpacidad"></div>
                    <div class="d_menuEmergenteGral">
                        <div class="d_emergenteCuadro d_CuadroPadding">
                            <div class="d_categoriaA" id="p_categoriaA2" categoria="Video"></div>
                            <div class="d_categoriaB" id="p_categoriaB2" categoria="Teoría"></div>
                            <div class="d_categoriaC" id="p_categoriaC2" categoria="Cuestionario"></div>
                            <div class="d_categoriaD" id="p_categoriaD2" categoria="Rompecabezas"></div>
                            <div class="d_categoriaE" id="p_categoriaE2" categoria="Memorama"></div>
                            <div class="d_categoriaF" id="p_categoriaF2" categoria="Crucigrama"></div>
                            <div class="d_categoriaG" id="p_categoriaG2" categoria="Sopa de letras"></div>
                            <div class="d_categoriaH" id="p_categoriaH2" categoria="Relaciona columnas"></div>
                            <div class="d_close" id="p_cierraCategoria"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="p_articlecenter">
                <div class="p_articleconte">
                    <div class="p_actividadescategtxt">
                            <table><tbody><tr><td onclick="limpiaFiltros()">Limpiar filtros</td></tr></tbody></table>
                            <div></div>
                    </div>
                </div>
            </div>
           <div class="d_inicio_temasEsp"></div>
            <!--ESTAS SON LAS ACTIVIDADES-->
            <div class="p_articlecenter">

                <div class="p_articleconte">
                    <div class="p_conocecenter">
                    <?php  include('php/buscaActividad.php');?>
                        <!--div class="p_recientebox" id="1" rel="1012" prefijo="red_rob_1066b" nombre=" 10. Conclusiones de la práctica Palabras" tipoapp="1" style="display: block;">
                            <div class="p_recienteboximg p_resalteminiatura">
                               
                                <div class="p_recienteboxminiatura" imgsrc="http://www.mdt.mx/primaria/">
                                  <img src="http://www.mdt.mx/primaria/src/img/miniaturas/red_rob_1066b.png">
                                  
                                    <div class="p_recienteboxicon p_recienteboxicon_lectura"></div>
                                    <div class="p_recienteboxlight"></div>
                                    <div class="p_recienteinfo">
                                        <div class="p_recienteinfoplay">
                                            <div class="p_recienteinfoplayicon" onclick="playDemo($(this).parent().parent().parent().parent().parent().attr('rel'))"></div>
                                        </div>
                                        <div class="p_recienteinfotitle"> 10. Conclusiones de la práctica Palabras</div>
                                        <div class="p_recienteinfoobjetivos">
                                            <ul>
                                                <li>* Describe lo que aprendiste en la práctica.</li></ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p_recienteboxtxt"> 10. Conclusiones de la práctica Palabras</div>
                        </div-->
                        <div class="noHayAplicaciones" id="p_mensaje">No se han cargado aplicaciones...</div>
                    </div>
                    <div class="p_actbtnnav">
                        <div class="p_actnavcenter" id="paginas_demo">
                            <div class="p_actnavarrowleft"></div>
                            <table class="p_actnavnum p_actnavnum_active" onclick="actualizaApps(1)"><tr><td>1</td></tr></table>
                            <table class="p_actnavnum" onclick="actualizaApps(2)"><tr><td>2</td></tr></table>
                            <table class="p_actnavnum" onclick="actualizaApps(3)"><tr><td>3</td></tr></table>
                            <table class="p_actnavnum" onclick="actualizaApps(4)"><tr><td>4</td></tr></table>
                            <div class="p_actnavarrowright" onclick="actualizapack('++')">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d_inicio_temasEsp"></div>
        </section>
        <!----------------------------------
        BOTÓN PARA REGRESAR AL INICIO
        ------------------------------------>
        <div class="d_regresar_gral" hidden id="p_regresar">
            <div class="d_regresar_in">
                <div class="d_inicio_temasEsp"></div>
                <div class="d_regresarBTN"></div>
                <div class="d_inicio_temasEsp"></div>
            </div>
        </div>
        <!----------------------------------
        EMERGENTE PARA INICIAR SESIÓN
        ------------------------------------>
            <div class="d_emergente_gral" hidden>
                <div class="d_emergente"></div>
                <div class="d_inicioSesion">
                    <div class="d_tituloSesion"></div>
                    <div class="d_sesionEsp"></div>
                    <div class="d_sesionCont">
                        <div class="d_sesionCont_in">
                            <table class="d_sesionTxt"><tr><td>USUARIO</td></tr></table>
                            <div class="d_espacioSesion"></div>
                            <input class="d_sesionInput">
                            <div class="d_espacioSesion"></div>
                            <table class="d_sesionTxt"><tr><td>CONTRASEÑA</td></tr></table>
                            <input class="d_sesionInput">
                            <div class="d_espacioSesion"></div>
                            <div class="d_entrar">
                                <div class="d_entrarBtn"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d_sesionEsp"></div>
                    <div class="d_sesionComprar">
                        <table class="d_comprarTxt"><tr><td>¿Aún no formas parte de la pandilla?</td></tr></table>
                        <div class="d_comprarCont">
                            <div class="d_comprarBtn"></div>
                        </div>
                    </div>
                    <div class="d_cerrarB"></div>
                </div>
            </div>
        
        <!----------------------------------
        FOOTER
        ------------------------------------>
        <footer class="d_footer">
            <div class="d_footer_in">
                <div class="d_footer_datosGral">
                   <a href="https://www.google.com.mx/maps/place/Krismar+Computaci%C3%B3n+Toluca/@19.275963,-99.576864,17z/data=!3m1!4b1!4m2!3m1!1s0x85cd8a1dbca94065:0x8f322b025b3e280c" target="_blank"> <div class="d_footer_datos">
                        <div class="d_footer_ubicacion"></div>
                        <table class="d_footer_info"><tr><td>Av. 20 de Noviembre No. 68 San Salvador Tizatlali C.P. 52172 Metepec, Edo. de México</td></tr></table>
                    </div></a>
                    <div class="d_footer_datos">
                        <div class="d_footer_telefono"></div>
                        <table class="d_footer_info"><tr><td>(722) 271 5705, 271 6972</td></tr></table>
                    </div>
                    <div class="d_footer_datos">
                        <div class="d_footer_manual"></div>
                        <table class="d_footer_info"><tr><td>soporte@krismar.com.mx</td></tr></table>
                    </div>
                    <div class="d_footer_datos">
                        <div class="d_footer_contacto"></div>
                        <table class="d_footer_info"><tr><td>Manual de usuario</td></tr></table>
                    </div>
                    <div class="p_footerdatosboxredes">
                    <div onclick="window.open('https://www.facebook.com/Krismar-Educaci%C3%B3n-547605475386249/')"></div>
                    <div onclick="window.open('https://twitter.com/KrismarEduca?lang=es')"></div>
                    <div onclick="window.open('https://www.youtube.com/user/krismareduca')"></div>
                </div>
                </div>
                <a href="http://www.krismar.com.mx/" target="_blank"><div class="d_KrismarEducacion">
                    <div class="d_footer_krismar"></div>
                    <table class="d_footer_info"><tr><td>Krismar Computación Toluca, S. de R. L. de C. V.</td></tr></table>
                </div></a>
            </div>
        </footer>
        <div class="cambio"></div>

    </body>
</html>
