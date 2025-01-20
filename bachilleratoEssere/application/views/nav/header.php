<style type="text/css">
	.p_logoCEN{
		background-image: url("src/img/logoCEN.png");
		width: 100%;
		height: 100%;
		background-size: contain;
		background-repeat: no-repeat;
	}
</style>
<body id="scroll" onload = "cargaBodyListo()" window-size my-directive ng-app="portalApps" ng-controller="CursoController" ng-init="cargarCurso()" ng-cloak> 
<!-- CONTENIDO -->
<div class="p_helperResources">
	<div class="p_act2box" id = "medida"></div>
</div>
<!-- HEADER -->    
<header class="p_header">
	<div class="p_menuemergente" onclick = "ocultaMenuAnimado()"></div>
	<div class = "p_contenedor_menu_swip">	  
		<div class="p_menusup">	          
			<div class="p_menuconte">	       
				<div class="p_menucontecenter">	      
					<div class="p_menuicon contenido" name="reciente" <?php if($this->session->userdata('log_in')): echo " ng-click='ocultarApps()' onclick = 'verSeccion($(this))'"; endif; ?>>
						<div class="p_menuimg p_iconreciente">
							<div class = "p_iconrecientein"></div>
						</div>	              
						<table class="p_menutxt"><tr><td>LO MÁS RECIENTE</td></tr></table>	
					</div>							                   
					<div class="p_menuicon contenido" name="temas" ng-click='ocultarApps()' onclick = "verSeccionGuest($(this))">	
						<div class="p_menuimg p_icontemas">
							<div class = "p_icontemasin"></div>
						</div>	      
						<table class="p_menutxt"><tr><td>ASIGNATURAS</td></tr></table>	          
					</div>							                   
					<div class="p_menuicon contenido" name="grados" ng-click='ocultarApps()' onclick = "verSeccionGuest($(this))">	
						<div class="p_menuimg p_icongrados">
							<div class = "p_icongradosin"></div>
						</div>	                        
						<table class="p_menutxt"><tr><td>SEMESTRES</td></tr></table>	
					</div>	          
					<!--  LECTURAS DE COMPRENSIÓN -->
					<!--<div class="p_menuicon maskrismar" name="maskrismar" <?php if($this->session->userdata('log_in')):?>  onclick="muestraLecturas();" <?endif; ?>>
						<div class="p_menuimg p_iconlecturas">
							<div class = "p_iconlecturasin"></div>
						</div>	           
						<table class="p_menutxt"><tr><td>LECTURAS DE COMPRENSIÓN</td></tr></table>
					</div>-->										
					<a ng-click="checkForNet('http://www.krismar.com.mx','url')" target="_blank">	
						<div class="p_menuicon maskrismar krismarpage" name="maskrismar">                         
							<div class="p_menuimg p_iconkrismar">
								<div class = "p_iconkrismarin"></div>
							</div>                                 
							<table class="p_menutxt"><tr><td>KRISMAR</td></tr></table>                
						</div>												
					</a>	
					<!--<div class="p_menuicon libros" id ="libros_guia_prof" name = "libros_guia" onclick = "muestraLibrosGuiaProf()" >
						<div class="p_menuimg p_iconguias">
							<?php $this->load->view('nav/guia_docente.svg');?>
						</div>
						<table class="p_menutxt"><tr><td>GUÍA PARA DOCENTES</td></tr></table>
					</div>-->	
					<div class="p_menuicon libros" id ="libros_sepi" name = "libros_sepi" ng-click="checkForNet('muestraLibrosAlumno','fun')"  >
                        <div class="p_menuimg p_iconlibrosepn">
							<div class = "p_iconlibrosepi"></div>
						</div>
                        <table class="p_menutxt"><tr><td>LIBROS SEP</td></tr></table>
                    </div>
					<!--<?php //if($this->session->userdata('log_in')){ ?>-->
						<a onclick="insertaLogLink('Efemérides')" href="../Efemerides/" target="_blank">	
							<!--<?php //} ?>-->		
							<div class="p_menuicon maskrismar" name="maskrismar">                  
								<div class="p_menuimg p_iconefemerides">
									<div class = "p_iconefemeridesin"></div>
								</div>                         
								<table class="p_menutxt"><tr><td>EFEMÉRIDES</td></tr></table>         
							</div>												
							<!--<?php //if($this->session->userdata('log_in')){ ?>-->		
						</a>
						<!--<div class="p_menuicon libros" id ="libros_sepi" name = "libros_sepi" onclick = "muestraLinksAdicionales()" >
	                        <div class="p_menuimg p_iconlibrosep">
								<div class = "p_iconlibrosepin"></div>
							</div>
	                        <table class="p_menutxt"><tr><td>SITIOS EN MÉXICO</td></tr></table>
	                    </div>-->
	                    <!--<div class="p_menuicon libros" id ="libros_sepi" name = "libros_sepi" onclick = "muestraLinksAdicionalesLat()" >
	                        <div class="p_menuimg p_iconlibrosep">
								<div class = "p_iconlibrosepin"></div>
							</div>
	                        <table class="p_menutxt"><tr><td>MUSEOS VIRTUALES DE AMÉRICA LATINA</td></tr></table>
	                    </div>-->
	                    <div class="p_menuicon libros" id ="libros_sepi" name = "libros_sepi" onclick="muestraLibrosCatalogo()" >
	                        <div class="p_menuimg p_iconlibrosepc">
								<?php $this->load->view('nav/guia_maestro2.svg');?>
							</div>
	                        <table class="p_menutxt"><tr><td>CATÁLOGOS DE APLICACIONES</td></tr></table>
	                    </div>
						<!--a href = "src/pdf/Manual.pdf" target="_blank"-->	
						<!--a href = "src/pdf/Manual.pdf" target="_blank"-->
							<!-- <div  style="cursor: default; opacity: 0.5;" class="p_menuicon maskrismar krismarpage" name="manualdeusuario">                         
								<div class="p_menuimg p_iconkrismar">
									<div class = "p_iconmanualusuario"></div>
								</div>                                 
								<table class="p_menutxt"><tr><td>MANUAL DE USUARIO</td></tr></table>                
							</div>												 -->
						<!--/a-->
						<div class="p_menuicon docente" id ="tutoriales_classroom" name = "tutoriales_classroom" ng-click="checkForNet('muestraTutoriales','fun')" >
							<div class="p_menuimg p_iconguias">
								<?php $this->load->view('nav/novaschool_google_classroom.svg');?>
							</div>
							<table class="p_menutxt"><tr><td>TUTORIALES DE CLASSROOM</td></tr></table>
						</div> 	
						<?php if($this->session->userdata('log_in')){ ?>
						<!--onclick = "insertaLogLink('Britannica Escolar')"-->
						<a class="mustBeLogged Escolar" target="_blank">					
							<?php } ?>						                                
							<div class="p_menuicon p_iconresize britannica" name="britannica">  
								<div class="p_menuimg p_iconbritannica">
									<div class = "p_iconbritannicain"></div>
								</div>                                    
								<table class="p_menutxt"><tr><td>MODERNA</td></tr></table>   
							</div>		
							<?php if($this->session->userdata('log_in')){ ?>			
						</a>
						<!--onclick = "insertaLogLink('Britannica School')"-->			
						<a class="mustBeLogged School" target="_blank">	
							<?php } ?>						                            
							<div class="p_menuicon p_iconresize britannica" name="britannica">   
								<div class="p_menuimg p_iconbritannica">
									<div class = "p_iconbritannicain"></div>
								</div>                           
								<table class="p_menutxt"><tr><td>SCHOOL</td></tr></table>                
							</div>											
							<?php if($this->session->userdata('log_in')){ ?>		
						</a>	
						<!--onclick = "insertaLogLink('Britannica Biografía')"-->
						<a class="mustBeLogged Biografía" target="_blank">
							<?php } ?>						                               
							<div class="p_menuicon p_iconresize britannica" name="britannica">  
								<div class="p_menuimg p_iconbritannica">
									<div class = "p_iconbritannicain"></div>
								</div>                
								<table class="p_menutxt"><tr><td>BIOGRAFÍAS</td></tr></table>    
							</div>											
							<?php if($this->session->userdata('log_in')){ ?>	
						</a>
						<!--onclick = "insertaLogLink('Britannica Mapas')"-->
						<a class="mustBeLogged Mapas" target="_blank">				
							<?php } ?>	                    
							<div class="p_menuicon p_iconresize britannica" name="britannica">	                    
								<div class="p_menuimg p_iconbritannica">
									<div class = "p_iconbritannicain"></div>
								</div>	                    
								<table class="p_menutxt"><tr><td>MAPAS</td></tr></table>	    
							</div>					
							<?php if($this->session->userdata('log_in')){ ?>	
						</a>						
					<?php } ?>	   
				</div>	                
				<div class="p_menuclose" onclick="ocultaMenuAnimado()"></div>	      
			</div>	            
			<div class="p_menupleca">	   
				<div class="p_menuplecabtn"></div>	
			</div>
		</div>        
	</div>       
	<div class="p_headerdatos" <?php if($this->bandera_movil){echo "style = 'height:50px'";}?>>  
		<div class="p_headertransition">    
			<? 
				if($qval==2){
					
				}else{
					echo '<div class = "p_headerImg3" ></div>';
					echo '<div class = "p_headerImg2"></div>';
					echo '<div class = "p_headerImg1"></div>';
				}
			?>
				             
				      
				
			
			
		</div>           
		<div class="helperResources"></div>         
		<div class="p_headerimgs"></div>  
		<div class="p_headersmall" <?php if($this->bandera_movil){echo "style = 'opacity:1'";}?>></div>
		<div class ="p_headergradient1"></div>
		<div class ="p_headergradient2"></div>
		<div class="p_headerimgs"></div> 
		<div class="p_headerin" onclick="ocultaMenuAnimado()">         
			<div class="p_logonova <?=($this->bandera_movil)?"p_logonovasmall":""?>" >
            <div id="logoPage" class="p_logonovaInter"></div>
			</div>
			<?if(!$this->session->userdata('sina')){?>  
				<div class="p_ingresar">         
					<div class="p_ingresarlogokrismar"></div>		
					<?php if($this->session->userdata('log_in')){  ?>           
						<!--USUARIO-->         
						<?php if(!$this->config->item('mostrar_apps_a_visitantes')) {?>
							<div class="p_ingresarusuario">
								<div class="p_ingresarsalir" onclick = "mostrarCerrarSesion()"></div>
								<?php if(!$this->session->userdata('multiaccess')){ ?>	
									<table class="p_ingresarname"><tr><td><?= $this->session->userdata('nombre')=="sinadep"?"":$this->session->userdata('nombre') ;?></td></tr></table>   
								<?php } ?> 
							</div>
						<?php } ?>
					<?php }else{?>					
					<!--BOTON INGRESAR-->            
					<div class="p_loginusuario" onclick = "muestraIngresar()">                    
						<table class="p_loginbtn"><tr><td>INGRESAR</td></tr></table>                 
					</div>					
					<?php }?>                
				</div>   
			<?}?>     
		</div>    
	</div>     
	<nav class="p_navsup">  
		<div class="p_navsupin">      
			<table class="p_navsupinbtn p_in1" id="contenido" onclick="verSubtemas(this.id)"><tr><td>CONTENIDO</td></tr></table>        
			<table class="p_navsupinbtn p_in2" id="maskrismar" onclick="verSubtemas(this.id)"><tr><td>MÁS DE KRISMAR</td></tr></table>  
			<table class="p_navsupinbtn p_in3" id="britannica" onclick="verSubtemas(this.id)"><tr><td>BRITANNICA</td></tr></table>
			<!-----GOOGLE CLASSROOM---->
			<table class="p_navsupinbtn p_in4" id="docente" onclick="verSubtemas(this.id)"><tr><td>DOCENTE</td></tr></table>
			<!-------------------->            
			<table class="p_navsupinbtn p_in5" id="libros" onclick="verSubtemas(this.id)"><tr><td>LIBROS</td></tr></table>
			<table class="p_navsupinbtn p_in6" id="contacto" onclick="verSubtemas(this.id)"><tr><td>CONTACTO</td></tr></table>  
		</div>  
	</nav>
</header>