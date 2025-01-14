<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width = device-width, maximum-scale = 1, user-scalable=no">
<title>KrismarApps</title>
<!--script type="text/javascript" src="<?echo base_url()?>src/sistema/js/web_apps.js"></script-->
<script type="text/javascript" src="<?echo base_url()?>src/js/config_grado_materia_subtema.js"></script>
</head>
<body>	

<div id = "lastId" hidden rel = " <?=$idUltimo?> "></div>

<form id = "formulario">
<article class="p_article">
	<div class="p_articlecenter">
		<div class="p_articletitle">Modificar grado materia subtema</div>
		<div class="p_articleline"></div>
		<div class="p_articleconte">
			<div class = "p_conteseccion">
				<div class = "p_tituloseccion p_txttitulo">Grado</div>
				<!--div class = "p_item p_txtfiltro">
					
					<div class = "p_editaitem" onclick = "edita(this)"></div>
					<div class = "p_eliminaitem"></div>
					<div class = "p_txtitem">1°</div>
				</div>
				<div class = "p_item p_txtfiltro">
					<div class = "p_editaitem" onclick = "edita(this)"></div>
					<div class = "p_eliminaitem"></div>
					<div class = "p_txtitem">2°</div>
				</div-->
				<?php
					foreach($grados->result() as $grado){
						?>
						<div class = "p_item p_txtfiltro">
					
							<div class = "p_editaitem" onclick = "editaGrado(this)"></div>
							<div class = "p_eliminaitem"></div>
							<div class = "p_txtitem"><?php echo $grado->nombre ?></div>
							<input hidden name = "grado[]" value ="<?=$grado->nombre ?>"/>
						</div>
						
						<?php
					}
				?>
				
				<div class = "p_item p_txtfiltro" onclick = "agregar(this, 'Grado')">Agregar</div>
			</div>
			<div class = "p_conteseccion">
				<div class = "p_tituloseccion p_txttitulo">Materias</div>
				<!--div class = "p_item p_txtfiltro">
					
					<div class = "p_editaitem" onclick = "edita(this)"></div>
					<div class = "p_eliminaitem"></div>
					<div class = "p_txtitem">Matemáticas</div>
				</div-->
				
				<?php
					foreach($materias->result() as $materia){
						?>
						<div class = "p_item p_txtfiltro" onclick = "modificaSubtemas('mate_<?= $materia->id_materia_primaria?>', '<?=$materia->nombre?>')">
							
							<div class = "p_editaitem" onclick = "editaMateria(this, event);"></div>
							<div class = "p_eliminaitem"></div>
							<div class = "p_txtitem"><?=$materia->nombre?></div>
							<input hidden name = "materia[]" value ="<?= $materia->nombre?>"/>
							<!--table id = "grados_materias" hidden>
								<tr>
								<?
									foreach($grados->result() as $grado){
								?>
									
									<td>
										
										<?= $grado->nombre?>
									</td>
									<td>
										<?
											$valor = 0;
											foreach($gradoMateria->result() as $gm){
												if($gm->id_materia_primaria == $materia->id_materia_primaria && ($gm->id_grado_curso_primaria == $grado->id_grado_curso_primaria)){
													$valor = 1;
												}
											}
											switch($valor){
												case 1:
													?><input   type = "checkbox" checked onclick = "cambiaValor(this);" value = "<?echo $materia->id_materia_primaria."-".$grado->id_grado_curso_primaria."/"."1";?>"/><?
													?><input class = "gm" hidden name = "grados_materia[]"  value = "<?echo $materia->id_materia_primaria."-".$grado->id_grado_curso_primaria."/"."1";?>"/><?
												break;
												default:
													?><input type = "checkbox"  onclick = "cambiaValor(this);" value = "<?echo $materia->id_materia_primaria."-".$grado->id_grado_curso_primaria."/"."0";?>"/><?
													?><input class = "gm" hidden name = "grados_materia[]"  value = "<?echo $materia->id_materia_primaria."-".$grado->id_grado_curso_primaria."/"."0";?>"/><?
												
											}
											
										?>
										
									</td>
									
								<?	
									}
								?>
								</tr>
							</table-->
						</div>
						
						<?php
						
					}
				?>
				
				
				
				
				<div class = "p_item p_txtfiltro" onclick = "agregar(this, 'Materia')">Agregar</div>
				
			</div>
			
			
			
			<div class = "p_conte_titulo">
				<div class = "c_ubicacion p_txtfiltro" id = "titulo_tema">Para editar los subtemas, selecciona una asignatura</div>
				<div class = "c_iconArrow" hidden></div>
				<div class = "c_ubicacion p_txtfiltro" style = "margin-left:0" hidden>Subtemas</div>
			</div>
			<?
			foreach($materias->result() as $materia){
			?>
			<div class = "p_conteseccion" id = "mate_<?=$materia->id_materia_primaria?>" hidden >
			<?/*La tabla grados_materias debera ser añadida a la edicion de materias para que puedan editar los grados*/?>
			<table class = "grados_materias" hidden >
				
				<tr>
					<!--td>La materia <?=$materia->nombre?> existe en:</td-->
				<?
					foreach($grados->result() as $grado){
				?>
					
					<td>
						
						<?= $grado->nombre?>
					</td>
					<td>
						<?
							$valor = 0;
							foreach($gradoMateria->result() as $gm){
								if($gm->id_materia_primaria == $materia->id_materia_primaria && ($gm->id_grado_curso_primaria == $grado->id_grado_curso_primaria)){
									$valor = 1;
								}
							}
							switch($valor){
								case 1:
									?><input   type = "checkbox" checked onclick = "cambiaValor(this);" value = "<?echo $materia->id_materia_primaria."-".$grado->id_grado_curso_primaria."/"."1";?>"/><?
									?><input class = "gm" hidden name = "grados_materia[]"  value = "<?echo $materia->id_materia_primaria."-".$grado->id_grado_curso_primaria."/"."1";?>"/><?
								break;
								default:
									?><input type = "checkbox"  onclick = "cambiaValor(this);" value = "<?echo $materia->id_materia_primaria."-".$grado->id_grado_curso_primaria."/"."0";?>"/><?
									?><input class = "gm" hidden name = "grados_materia[]"  value = "<?echo $materia->id_materia_primaria."-".$grado->id_grado_curso_primaria."/"."0";?>"/><?
								
							}
							
						?>
					</td>
					
				<?	
					}
				?>
				</tr>
			</table>
			<?
			
			foreach($subtemas->result() as $subtema){
				?><table class = "p_txtfiltro" >
					<?
				if($materia->id_materia_primaria == $subtema->id_materia_primaria){
				?>
				
						<tr>
						<td>
							<?=$subtema->nombre?>
						</td>
						<td>
							<input hidden name = "subtema[]" type = "text" value = "<?=$subtema->id_subtema."/".$materia->id_materia_primaria."/".$subtema->nombre?>"/>
						</td>
						<td class = "p_editasubtema" onclick = "editaNombreSubtema(this)"></td>
						<td class = "p_eliminasubtema" onclick = "eliminaSubtema(this)"></td>
						<td width = "50"></td>
						<?
						
						foreach($grados->result() as $grado){
							$gradoExiste = false;
							$inputMarca = false;
						?>
						
						
							<?
							foreach($gradoMateria->result() as $gradoM){
								if($gradoM->id_grado_curso_primaria == $grado->id_grado_curso_primaria){//Existe el grado
									$gradoExiste = true;
									foreach($gradoSubtema->result() as $gradoSbtma){
										if($gradoSbtma->id_grado_curso_primaria == $gradoM->id_grado_curso_primaria && $gradoSbtma->id_subtema == $subtema->id_subtema){
											$inputMarca = true;
										}
									}
								}
							}
							?>
							<?
							if($gradoExiste){
								?>
								<td>
									<?=$grado->nombre?>
								</td>
								<td>
								<?
								
								if($inputMarca){
									
									?>
									<input type = "checkbox" onclick = "cambiaValor(this);" checked value = "<?echo $subtema->id_subtema . "-" . $grado->id_grado_curso_primaria."/1";?>" />
									<input class = "gm" hidden name = "grados_subtema[]" value = "<?echo $subtema->id_subtema . "-" . $grado->id_grado_curso_primaria."/1";?>" />
									
									<?
								}else{
									
									?>
									<input type = "checkbox" onclick = "cambiaValor(this);" value = "<?echo $subtema->id_subtema . "-" . $grado->id_grado_curso_primaria."/0";?>" />
									<input class = "gm" hidden name = "grados_subtema[]" value = "<?echo $subtema->id_subtema . "-" . $grado->id_grado_curso_primaria."/0";?>" />
									
									<?
								}
								?>
								</td>
								<?
							}
							
							?>
							
						
						<?
						}
						?>
					
				<?
				?></tr><?
				}
				?></table><?
			}
			?>
					
				
				
				<table class = "p_txtfiltro">
					<tr>
						<td  style = "text-align:center;cursor:pointer;" colspan = "14" onclick = "agregarSubtema('mate_<?=$materia->id_materia_primaria?>', this)">Agregar</td>
					</tr>
				</table>
				
			</div>
			<?
			
			}
			?>
			<!--div class = "p_conteseccion">
				<table class = "p_txtfiltro">
					<tr>
						<td>Fracciones</td>
						<td width = "50"></td>
						<td>
							1°
						</td>
						<td>
							<input type = "checkbox"/>
						</td>
						<td>
							2°
						</td>
						<td>
							<input type = "checkbox"/>
						</td>
						<td>
							3°
						</td>
						<td>
							<input type = "checkbox"/>
						</td>
						<td>
							4°
						</td>
						<td>
							<input type = "checkbox"/>
						</td>
						<td>
							5°
						</td>
						<td>
							<input type = "checkbox"/>
						</td>
						<td>
							6°
						</td>
						<td>
							<input type = "checkbox"/>
						</td>
					</tr>
					<tr>
						<td style = "text-align:center;cursor:pointer;" colspan = "14">Agregar</td>
					</tr>
				</table>
			</div-->
			<div class ="c_agregarSeleccion" >
				<table onclick = "guardarGMS()" class = "c_agregarSelecion_icon"><tr><td>Guardar</td></tr></table>
			</div>
		</div>
	</div>
</article>
</form>
<body>
</html>