<?php 
include "includes/header.inc.php";
$acao = "conteudo-edit";
$Conteudo= new Conteudo(0);
$SiteConfig = new SiteConfig();
$secaoValues = $SiteConfig->getSecao(base64_decode($_GET['secao']));
$uploads_msg = "";
if(($_POST) && $core->exist($_POST['action']) && base64_decode($_POST['action'])=== $acao){
	$data = $_POST;
	// Upload Banner
	if(isset($_FILES['banner']) && $_FILES['banner']['size']>0){
		$uploadImage = new UploadImage($_FILES['banner'], 800, 600, "../img/internas/");
		$saveImage = $uploadImage->salvar();
		if(is_bool($saveImage) && $saveImage === true){
			$data['banner'] = $uploadImage->fileName;
		}
	}
	else if(isset($_POST['banner_atual'])){
		$data['banner'] = strip_tags($_POST['banner_atual']);
	}
	else $data['banner'] = "";
	
	// Upload Imagem do destaque
	if(isset($_FILES['img_destaque']) && $_FILES['img_destaque']['size']>0){
		sleep(1);
		$uploadImage = new UploadImage($_FILES['img_destaque'], 800, 600, "../img/internas/");
		$saveImage = $uploadImage->salvar();
		if(is_bool($saveImage) && $saveImage === true){
			$data['img_destaque'] = $uploadImage->fileName;
		}
	}
	else if(isset($_POST['img_destaque_atual'])){
		$data['img_destaque'] = strip_tags($_POST['img_destaque_atual']);
	}
	else $data['img_destaque'] = "";
	
	// Upload do PDF de roteiro
	if(isset($_FILES['pdf_file']) && $_FILES['pdf_file']['size']>0){
		$uploader   =   new Uploader();
		$uploader->setDir('../download/');
		$uploader->setExtensions(array('pdf','doc','docx','zip'));
		$uploader->setMaxSize(2); //MB

		if($uploader->uploadFile('pdf_file')){
			$data['pdf_file'] = $uploader->getUploadName();
		}
	}
	else if(isset($_POST['pdf_file_atual'])){
		$data['pdf_file'] = strip_tags($_POST['pdf_file_atual']);
	}
	else $data['pdf_file'] = "";
	
	if(isset($_POST['periodo_inicio']) && isset($_POST['periodo_fim'])){
		$startDate = new DateTime($_POST['periodo_inicio']);
		$endDate = new DateTime($_POST['periodo_fim']);
		
		$data['periodo_duracao'] = $endDate->diff($startDate)->format("%a");
	}else{
		$data['periodo_duracao'] = null;
		$data['periodo_fim'] = null;
		$data['periodo_duracao'] = null;
	}
	
	$validateAction = $Conteudo->save($data);
	if($validateAction === true){
		if(isset($data['id']) && !empty($data['id'])){
			$id = base64_decode($data['id']);
		}
		else{
			$getID = $Conteudo->find($data);
			$id = $getID[0];
		}
		$Conteudo->saveCross($id, $data['cross_1'], $data['cross_2']);
		
		$core->redirectTo($admin->path."?admin=internas-form&a=1&secao=".$_GET['secao']."&id=".base64_encode($id));
		die();
	}
	
}
if(isset($_GET['id']) && $core->exist($_GET['id']) && base64_decode($_GET['id'])>0){
	$conteudoValues = $Conteudo->get(base64_decode($_GET['id']));
	$getCross = $Conteudo->getCross(base64_decode($_GET['id']));
}
?>

	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header"><?php echo $secaoValues['secao'];?> <i class="fa fa-fw" aria-hidden="true">&#xf101</i> Criar/Atualizar </h2>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		
		<?php
			if(isset($validateAction) || isset($_GET['a'])){
				if($validateAction || $_GET['a']=1){
					$css = "success";
					$msg = $secaoValues['secao']." atualizada com sucesso!";
				}else{
					$css = "danger";
					$msg = "Erro ao atualizar {$secaoValues['secao']}. Por favor, tente novamente!".$uploads_msg;
				}
		?>
			<div class="panel-body">
				<div class="alert alert-<?php echo $css; unset($css);?>">
					<?php echo $msg; unset($msg);?>
				</div>
			</div>
		<?php
			}
		?>
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
							
								<form role="form" method="POST" action="" enctype="multipart/form-data">
									<input type="hidden" name="action" value="<?php echo base64_encode($acao);?>">
									<input type="hidden" name="id" value="<?php 
										if(isset($conteudoValues['id'])) echo base64_encode($conteudoValues['id']);
									?>">
									<div class="form-group">
										<label for="titulo">Título</label>
										<input value="<?php echo (isset($conteudoValues['titulo'])) ? htmlentities($conteudoValues['titulo']):"";?>" id="titulo" name="titulo" class="form-control" required placeholder="Título" maxlength="200">
									</div>
									
									<div class="form-group">
										<label for="categorias_id">Categoria / Sub-menu</label>
                                        
										<select required name="categorias_id" id="categorias_id" class="form-control">
											<?php
												$listSecoes = $SiteConfig->listSubMenu_Secao($secaoValues['id']);
												foreach($listSecoes as $item){
													if((isset($conteudoValues['categorias_id'])) && $item['id'] == $conteudoValues['categorias_id']){
														$selected = 'selected="selected"';
													}
													else $selected=''; 
													echo "<option value=\"{$item['id']}\" {$selected}>{$item['categoria']}</option>";
												}
											?>
										</select>
									</div>
									
									<hr>
									
									<div class="form-group">
										<div class="checkbox">
											<b>Inclui:</b>
											<label class="checkbox-inline">
												<?php
													$check = "";
													if(isset($conteudoValues['passagens'])){
														if($conteudoValues['passagens'] == "1"){
															$check = "checked";
														}
													}
												?>
												<input <?php echo $check;?> name="passagens" id="passagens" type="checkbox" value="1">Passagens Aéreas
											</label>
											<label class="checkbox-inline">
												<?php
													$check = "";
													if(isset($conteudoValues['estadia'])){
														if($conteudoValues['estadia'] == "1"){
															$check = "checked";
														}
													}
												?>
												<input <?php echo $check;?> name="estadia" id="estadia" type="checkbox" value="1">Estadia
											</label>
											<label class="checkbox-inline">
												<?php
													$check = "";
													if(isset($conteudoValues['alimentacao'])){
														if($conteudoValues['alimentacao'] == "1"){
															$check = "checked";
														}
													}
												?>
												<input <?php echo $check;?> name="alimentacao" id="alimentacao" type="checkbox" value="1">Alimentação
											</label>
										</div>
									</div>
									
									<div class="form-group">
										<label for="titulo">Valor/Preço</label>
										<input value="<?php echo (isset($conteudoValues['preco'])) ? htmlentities($conteudoValues['preco']):"";?>" id="preco" name="preco" class="form-control" placeholder="R$ 7.0000,00" maxlength="20">
									</div>
									
									<div class="form-group">
										<label for="titulo">Detalhe do Valor/Preço</label>
										<input value="<?php echo (isset($conteudoValues['preco_detalhe'])) ? htmlentities($conteudoValues['preco_detalhe']):"";?>" id="preco_detalhe" name="preco_detalhe" class="form-control" placeholder="Ex: por pessoa, por grupo, por casal, etc..." maxlength="20">
									</div>
									
									<div class="form-group">
										<div class="col-md-6" style="margin-left:0 !important;padding-left:0 !important">
											<label for="titulo">Data Ínicio</label>
											<input value="<?php echo (isset($conteudoValues['periodo_inicio'])) ? htmlentities($conteudoValues['periodo_inicio']):"";?>" type="date" id="periodo_inicio" name="periodo_inicio" class="form-control " placeholder="00/00/0000" maxlength="10">
										</div>
										<div class="col-md-6">
											<label for="titulo">Data Término</label>
											<input value="<?php echo (isset($conteudoValues['periodo_fim'])) ? htmlentities($conteudoValues['periodo_fim']):"";?>" type="date" id="periodo_fim" name="periodo_fim" class="form-control " placeholder="00/00/0000" maxlength="10">
										</div>
									</div>
									
									<p><hr></p>
									
									<div class="form-group"><br><br>
										<label>Banner principal</label>
										<input name="banner" id="banner" type="file">
									</div>
									<?php
										if(isset($conteudoValues['banner'])){
									?>
									
									<input type="hidden" name="banner_atual" value="<?php echo $conteudoValues['banner'];?>">
									<div class="form-group">
										<a target="_blank" href="../img/internas/<?php echo $conteudoValues['banner'];?>">Ver banner atual</a>
									</div>
									
									<?php
										}
									?>
									
									<hr>
									
									<div class="panel panel-default">
										<div class="panel-body">
											<ul class="nav nav-tabs">
												<li class="active"><a href="#tab1" data-toggle="tab">Destaque Principal</a>
												</li>
												<li><a href="#tab2" data-toggle="tab">Roteiro</a>
												</li>
												<li><a href="#tab3" data-toggle="tab">O Que Inclui</a>
												</li>
												<li><a href="#tab4" data-toggle="tab">Cross-content</a>
												</li>
											</ul>
											<div class="tab-content">
											
												<div class="tab-pane fade in active" id="tab1">
													<textarea class="form-control" name="destaque" id="destaque" rows="10"><?php echo (isset($conteudoValues['destaque'])) ? trim($conteudoValues['destaque']):"";?></textarea>
													<hr />
													<div class="form-group">
														<label>Imagem de destaque</label>
														<input name="img_destaque" id="img_destaque" type="file">
													</div>
													<?php
														if(isset($conteudoValues['img_destaque'])){
													?>
													
													<input type="hidden" name="img_destaque_atual" value="<?php echo $conteudoValues['img_destaque'];?>">
													<div class="form-group">
														<a target="_blank" href="../img/internas/<?php echo $conteudoValues['img_destaque'];?>">Ver imagem atual</a>
													</div>
													
													<?php
														}
													?>
												</div>
												
												<div class="tab-pane fade" id="tab2">
													<textarea class="form-control" name="aba_roteiro" id="aba_roteiro" rows="10"><?php echo (isset($conteudoValues['aba_roteiro'])) ? trim($conteudoValues['aba_roteiro']):"";?></textarea>
													<hr />
													<div class="form-group">
														<label>PDF do roteiro</label>
														<input name="pdf_file" id="pdf_file" type="file">
													</div>
													<?php
														if(isset($conteudoValues['pdf_file'])){
													?>
													
													<input type="hidden" name="pdf_file_atual" value="<?php echo $conteudoValues['pdf_file'];?>">
													<div class="form-group">
														<label>PDF atual</label>
														<p><a href="../download/<?php echo $conteudoValues['pdf_file'];?>" target="_blank">Ver PDF</a></p>
													</div>
													
													<?php
														}
													?>
												</div>
												
												<div class="tab-pane fade" id="tab3">
													<textarea class="form-control" name="aba_oque_inclui" id="aba_oque_inclui" rows="10"><?php echo (isset($conteudoValues['aba_oque_inclui'])) ? trim($conteudoValues['aba_oque_inclui']):"";?></textarea>
												</div>
												
												<div class="tab-pane fade" id="tab4">
													
													<div class="form-group">
														<label for="secao">Cross-content 1</label>
														
														<select name="cross_1" id="cross_1" class="form-control">
															<option>Selecione:</option>
															<?php
																$listConteudo = $Conteudo->listAll();
																foreach($listConteudo as $item){
																	if($item['ativo']>0){
																		if(isset($getCross[0])){
																			$cross1 = $getCross[0];
																			if($cross1['conteudo_vinculado'] == $item['id']) $selected = 'selected="selected"';
																			else $selected=''; 
																		}
																		else $selected=''; 
																		echo "<option value=\"{$item['id']}\" {$selected}>".strtoupper($item['secao'])." > {$item['titulo']}</option>";
																	}
																}
															?>
															
														</select>
													</div>
													
													<div class="form-group">
														<label for="secao">Cross-content 2</label>
														
														<select name="cross_2" id="cross_2" class="form-control">
															<option>Selecione:</option>
															<?php
																$listConteudo = $Conteudo->listAll();
																foreach($listConteudo as $item){
																	if($item['ativo']>0){
																		if(isset($getCross[1])){
																			$cross2 = $getCross[1];
																			if($cross2['conteudo_vinculado'] == $item['id']) $selected = 'selected="selected"';
																			else $selected=''; 
																		}
																		else $selected=''; 
																		echo "<option value=\"{$item['id']}\" {$selected}>".strtoupper($item['secao'])." > {$item['titulo']}</option>";
																	}
																}
															?>
															
														</select>
													</div>
												</div>
												
											</div>
										</div>
									</div>
									<br><hr />
									
									<div class="form-group">
										<?php
											$check1 = "checked";
											$check2 = "";
											if(isset($conteudoValues['ativo'])){
												if($conteudoValues['ativo'] == "0"){
													$check1 = "";
													$check2 = "checked";
												}
												else{
													$check1 = "checked";
													$check2 = "";
												}
											}
										?>
										<label>Conteúdo ativa?</label>
										<label class="radio-inline">
											<input type="radio" name="ativo" id="conteudo_ativo_1" value="1" <?php echo $check1;?>>Sim
										</label>
										<label class="radio-inline">
											<input type="radio" name="ativo" id="conteudo_ativo_0" value="0" <?php echo $check2;?>>Não
										</label>
									</div>
									
									<p class="center-block text-center">
									<button type="submit" class="btn btn-primary">Salvar / Atualizar</button>
									</p>
								</form>
							</div>
						</div>
						<!-- /.row (nested) -->
					</div>
					<!-- /.panel-body -->
				</div>
				<!-- /.panel -->
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->
		
		
	</div>
	<!-- /#page-wrapper -->


<?php include "includes/footer.inc.php"; ?>

									
	<script>
		$(document).ready(function(){
			CKEDITOR.replace( 'destaque' );
			CKEDITOR.replace( 'aba_roteiro' );
			CKEDITOR.replace( 'aba_oque_inclui' );
			$('.date').mask('99/99/9999');
		});
	</script>
    </body>
</html>