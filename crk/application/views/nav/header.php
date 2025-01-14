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
		<!-- <div class="p_headerimgs"></div>   -->
		<div class="p_headersmall" <?php if($this->bandera_movil){echo "style = 'opacity:1'";}?>></div>
		<!-- <div class ="p_headergradient1"></div> -->
		<div class ="p_headergradient2"></div>
		<!-- <div class="p_headerimgs"></div>  -->
		<div class="p_headerin" onclick="ocultaMenuAnimado()">         
			<div class="p_logonova <?=($this->bandera_movil)?"p_logonovasmall":""?>" >
				<svg viewBox="0 0 500 486.995" >
					<g>
						<path d="M350.979,142.248c55.802,55.805,55.802,146.283,0,202.087
						c-27.829,27.826-64.272,41.715-100.741,41.781c4.649,0.408,9.341,0.646,14.069,0.646c42.19,0,81.851-16.428,111.681-46.26
						c61.58-61.583,61.58-161.78,0-223.36c-29.832-29.834-69.5-46.264-111.691-46.264c-42.184,0-81.845,16.428-111.676,46.256
						c-29.827,29.833-46.258,69.496-46.258,111.685c0,5.186,0.257,10.337,0.75,15.43c-0.264-36.887,13.624-73.853,41.775-102.006
						C204.693,86.44,295.17,86.44,350.979,142.248z"/>
						<path d="M271.25,232.781l63.893,93.565h-55.406l-61.481-92.392l-0.166,92.702l-44.905-0.078
						c0,0,0-126.538,0-147.222s19.3-19.41,19.3-19.41l25.897,0.042l-0.126,73.746l57.914-73.647l56.026,0.096L271.25,232.781z
						M432.676,225.066c0.979,44.402-15.387,89.118-49.194,122.925c-31.837,31.834-74.155,49.363-119.174,49.363
						c-45.02,0-87.342-17.529-119.172-49.357c-31.834-31.836-49.364-74.159-49.366-119.178c-0.002-45.017,17.53-87.341,49.362-119.175
						c31.83-31.83,74.152-49.359,119.165-49.359c0.425,0,0.837,0.028,1.258,0.028c-52.076-4.427-105.672,13.227-145.521,53.076
						c-71.746,71.741-71.742,188.062,0,259.803c71.739,71.74,188.057,71.74,259.799,0
						C420.348,332.677,437.928,277.955,432.676,225.066z"/>
						<path d="M390.188,405.259c0.019-12.112,9.622-21.789,21.731-21.768c12.057,0.012,21.686,9.73,21.662,21.838
						c-0.02,12.009-9.676,21.686-21.734,21.669C399.744,426.978,390.166,417.263,390.188,405.259z M428.434,405.325
						c0.021-9.751-7.203-16.664-16.52-16.686c-9.482-0.021-16.561,6.877-16.578,16.627c-0.012,9.645,7.043,16.562,16.52,16.578
						C421.17,421.857,428.418,414.969,428.434,405.325z M422.279,416.327l-5.48-0.012l-5.029-9.541l-3.504-0.004l-0.018,9.536
						l-5.039-0.017l0.035-22.572l10.965,0.021c5.203,0.008,8.762,0.948,8.754,6.918c-0.01,4.162-2.146,5.865-6.15,6.126L422.279,416.327
						z M414.301,403.382c2.521,0.005,3.947-0.542,3.951-3.393c0.002-2.299-2.9-2.303-5.096-2.311l-4.871-0.004l-0.014,5.703
						L414.301,403.382z"/>
					</g>
				</svg>
				<!-- LOGO DE KRISMAR -->
				<?//echo("La session es = ".$this->session->userdata('ulg'));?>				
				<div id="logoPage" class="p_logonovaInter"></div>
			</div>
			<?if(!$this->session->userdata('sina')){?>  
				<div class="p_ingresar">         
					<div class="p_ingresarlogokrismar"></div>		
					<!--<div class="p_accesos">Accesos: <b><script src="https://regvisitas.mdt.mx/regVisitaredicrk.php"></script></b></div>-->
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
			<!-- <table class="p_navsupinbtn p_in1" id="contenido" onclick="verSubtemas(this.id)"><tr><td>CONTENIDO</td></tr></table>        
			<table class="p_navsupinbtn p_in2" id="maskrismar" onclick="verSubtemas(this.id)"><tr><td>MÁS DE KRISMAR</td></tr></table>  
			<table class="p_navsupinbtn p_in3" id="britannica" onclick="verSubtemas(this.id)"><tr><td>BRITANNICA</td></tr></table> -->
			<!-----GOOGLE CLASSROOM---->
			<!-- <table class="p_navsupinbtn p_in4" id="docente" onclick="verSubtemas(this.id)"><tr><td>DOCENTE</td></tr></table> -->
			<!-------------------->            
			<!-- <table class="p_navsupinbtn p_in5" id="libros" onclick="verSubtemas(this.id)"><tr><td>LIBROS</td></tr></table>
			<table class="p_navsupinbtn p_in6" id="contacto" onclick="verSubtemas(this.id)"><tr><td>CONTACTO</td></tr></table>   -->
		</div>  
	</nav>
</header>