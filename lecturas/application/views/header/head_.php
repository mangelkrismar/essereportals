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
	<link rel="shortcut icon" href="<?= base_url(); ?>src/img/web_krismarlogo_favicon.png">
	<link href="<?= base_url() ?>src/img/web_krismarlogo.png" rel="icon"/>
	<link href="<?= base_url() ?>src/img/web_krismarlogo.png" rel="apple-touch-icon"/>

	<script>
		var IP    = "<?php echo $this->config->item('base_url'); ?>";
		var IPSRC = "<?php echo $this->config->item('krismar_apps_url'); ?>";
	</script>

	<title>(En construcción) Krismar - Portal Lecturas</title>
	<?
		$auxName = "usuario";
		if(!$this->session->userdata('log_in')){
			$auxName = "visitante";
		}

		$minCssFileName = 'css_'.$this->device.'_'.$auxName .'.min.css';

		if($auxName == "usuario"){
			$this->minify->css(array(
				'fonts'.$this->device.'.css',
				'primaria_user'.$this->device.'.css',
			));
		}else{
			$this->minify->css(array(
				'fonts'.$this->device.'.css',
				'primaria_guest'.$this->device.'.css',
			));
		}
		echo $this->minify->deploy_css(FALSE, $minCssFileName);

		$minJsFileName = 'js_' . $auxName .'.min.js';

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
	?>
	<script src="<?php echo $this->config->item('base_url') ?>src/angular/angular.min.js"></script>
	<script src="<?php echo $this->config->item('base_url') ?>src/angular/angular-filter.min.js"></script>
	<script src="<?php echo $this->config->item('base_url') ?>src/angular/dirPagination.js"></script>
	<script src="<?php echo $this->config->item('base_url') ?>src/angular/apps.js"></script>

	<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url') ?>src/css_lecturas/tema_portal_lecturas.css">
</head>
<div hidden id="device" value="<?=$this->device?>"></div>
<div class="precarga"></div>