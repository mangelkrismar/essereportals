<?php
	//echo 'Viene de = '.$_SERVER['HTTP_REFERER'];
?>
<html>
<head>
	<meta name="theme-color" content="#323F47">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="format-detection" content="telephone=no">
	<meta name="msapplication-TileColor" content="#12619B">
	<meta name="msapplication-square70x70logo" content="<?= base_url(); ?>src/img/web_krismarlogo_windows.png">
	<meta name="msapplication-square150x150logo" content="<?= base_url(); ?>src/img/web_krismarlogo_windows.png">
	<meta name="msapplication-wide310x150logo" content="<?= base_url(); ?>src/img/web_krismarlogo_windows.png">
	<meta name="msapplication-square310x310logo" content="<?= base_url(); ?>src/img/web_krismarlogo_windows.png">
	<meta name="msapplication-TileColor" content="#12619B">
	<meta name="msapplication-TileImage" content="<?= base_url(); ?>src/img/web_krismarlogo_windows.png">

	<!-----GOOGLE AUTH---->
	<meta name="google-signin-scope" content="profile email">
	<meta name="google-signin-client_id" content="1002854476119-ns091bdc63gr1qlro9uomm7l86fgn8bf.apps.googleusercontent.com">
	<script src="https://apis.google.com/js/api.js"></script>
	<!-------------------->
	
	<link rel="shortcut icon" href="<?= base_url(); ?>src/img/web_krismarlogo_favicon.png">
	<link href="<?= base_url() ?>src/img/web_krismarlogo.png" rel="icon"/>
	<link href="<?= base_url() ?>src/img/web_krismarlogo.png" rel="apple-touch-icon"/>
	
	<!-----PARA LOS TERMINOS Y CONDICIONES---->
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	

	<script>
		var IP    = "<?php echo $this->config->item('base_url'); ?>";
		var IPSRC = "<?php echo $this->config->item('krismar_apps_url'); ?>";
		var qES = "<?echo($this->session->userdata('qEmp'));?>";     //Para saber si es de LG	

		
	</script>
	<?//echo("La session es = ".$this->session->userdata('qEmp'));		$qval = $this->session->userdata('qEmp');	?>		
	
	<title>Krismar - Portal CRK</title>
	<?
		$auxName = "usuario";
		if(!$this->session->userdata('log_in')){
			$auxName = "visitante";
		}

		$minCssFileName = 'css_'.$this->device.'_usuario.min.css';
		$pathFileCss = 'src/css_min/'.$minCssFileName;

		if(!file_exists($pathFileCss)){
            $this->minify->css(array(
                'fonts'.$this->device.'.css',
                'primaria_diseno_chat.css',
                'primaria_user'.$this->device.'.css'
            ));
			echo $this->minify->deploy_css(FALSE, $minCssFileName);
		} else{
			echo '<link rel="stylesheet" type="text/css" href="'.base_url().$pathFileCss.'">';
		}

		$minJsFileName = 'js_' . $auxName .'.min.js';
		$pathFileJs = 'src/js_min/'.$minJsFileName;

		if(!file_exists($pathFileJs)){
			if($auxName == "usuario"){
				$this->minify->js(array(
					'jquery-2.1.1.min.js',
					'jquery-ui.min.js',
					'jquery.transit.min.js',
					'portal.js',
					'user_1.1.js',
					'reciente.js',
					'user_apps.js'
				));
			} else{
				$this->minify->js(array(
					'jquery-2.1.1.min.js',
					'jquery-ui.min.js',
					'jquery.transit.min.js',
					'portal.js',
					'guest_1.2.js',
					'guest_apps.js'
				));
			}
			echo $this->minify->deploy_js(FALSE, 'js_'. $auxName .'.min.js');
		} else{
			echo '<script src="'.base_url().$pathFileJs.'" type="text/javascript"></script>';
		}
	?>
	<script src="<?php echo $this->config->item('base_url') ?>src/angular/angular.min.js"></script>
	<script src="<?php echo $this->config->item('base_url') ?>src/angular/angular-filter.min.js"></script>
	<script src="<?php echo $this->config->item('base_url') ?>src/angular/dirPagination.js"></script>
	<script src="<?php echo $this->config->item('base_url') ?>src/angular/apps.js"></script>
	<!-----PARA QUE LAS ALERTAR SE VEAN COOL---->
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>	
	<!-----GOOGLE CLASSROOM---->
	<script src="<?php echo $this->config->item('base_url') ?>src/js/classroomAPI.js"></script>
	<!-------------------->
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-FFRXHNEZ9G"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());
	  gtag('config', 'G-FFRXHNEZ9G');
	</script>
</head>
<div hidden id = "device" value = "<?=$this->device?>"></div>
<div class = "precarga"></div>

