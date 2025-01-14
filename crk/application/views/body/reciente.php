<html>
<head>
	<script type ="text/javascript" src = "<?=base_url()?>src/js/reciente.js"></script>
	<title></title>
</head>
<body>
	<article class="p_article" id="reciente">
		<div class="p_articlecenter">
			<div class="p_articletitle">Lo más reciente</div>
			<div class="p_articleline"></div>
			<div class="p_articleconte">
				<div class="p_recientecenter">
					<div class="p_recienteapps">
						<div class="p_recientescroll" id = "apps_demo_reciente">
							<? foreach($apps_reciente as $appSola){
								switch($appSola[0]->categoria){
									case "lectura":
										$img = "lectura";
										break;
									case "video":
										$img = "video";
										break;
									case "aplicacion":
										$img = "app";
										break;
									case "aplicacionL":
										$img = "appL";
										break;
									case "evaluacionC":
										$img = "p_recienteiconevaluacionC.png";
										break;
									case "evaluacionE":
										$img = "p_recienteiconevaluacionE.png";
										break;
								}
								?>
								<div class="p_recientebox">
									<div class="p_recienteboximg p_resalteminiatura_over">
										<div class="p_recienteboxminiatura">
											<img src = "<?= $this->config->item('krismar_apps_url') ?>/src/img/miniatura/<?=$appSola[0]->prefijo?>.png"/>
											<div class="p_recienteboxicon p_recienteboxicon_<?=$img?>"></div>
											<div class="p_recienteboxlight"></div>
											<div class="p_recienteinfo">
												<div class="p_recienteinfoplay">
													<div class="p_recienteinfoplayicon" onclick = "playDemo(<?=$appSola[0]->id_aplicacion?>, '<?=$appSola[0]->nombre?>', 'Lo más reciente')"></div>
												</div>
											</div>
										</div>
									</div>
									<div class="p_recienteboxtxt"><?=$appSola[0]->nombre?></div>
								</div>
								<?
							} ?>
						</div>
					</div>
					<div class="p_recientebotones">
						<div class="p_recientebtncenter" id="center"></div>
					</div>
				</div>
			</div>
		</div>
	</article>
</body>
</html>