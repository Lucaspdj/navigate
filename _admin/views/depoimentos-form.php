<?php 
include "includes/header.inc.php";
$acao = "depoimento-edit";
$Depoimentos = new Depoimentos($_GET['id']);
if(($_POST) && $core->exist($_POST['action']) && base64_decode($_POST['action'])=== $acao){
	if(isset($_FILES['depoimento_imagem']) && $_FILES['depoimento_imagem']['size']>0){
		$uploadImage = new UploadImage($_FILES['depoimento_imagem'], 1920, 800, "../img/depoimentos/");
		$saveImage = $uploadImage->salvar();
		if(is_bool($saveImage) && $saveImage === true){
			$validateAction = $Depoimentos->saveDepoimento($_POST, $uploadImage->fileName);
			$saveImage = null;
			if($validateAction === true){
				$getID = $Depoimentos->findDepoimento($_POST, $uploadImage->fileName);
				$core->redirectTo($admin->path."?admin=depoimentos-form&a=1&id=".base64_encode($getID[0]));
				die();
			}
		}
		else{
			$validateAction = false;
			$saveImage = "<br>".$saveImage;
		}
	}
	else{
		$validateAction = $Depoimentos->saveDepoimento($_POST, $_POST['imagem_atual']);
		if($validateAction === true){
			$getID = $Depoimentos->findDepoimento($_POST, $_POST['imagem_atual']);
			$core->redirectTo($admin->path."?admin=depoimentos-form&a=1&id=".base64_encode($getID[0]));
			die();
		}
	}
	
}
if(isset($_GET['id']) && $core->exist($_GET['id']) && base64_decode($_GET['id'])>0){
	$depoimentoValues = $Depoimentos->getDepoimento(base64_decode($_GET['id']));
}

?>

	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header">Depoimentos <i class="fa fa-fw" aria-hidden="true" title="Copy to use angle-double-right">&#xf101</i> Criar/Atualizar </h2>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		
		<?php
			if(isset($validateAction) || isset($_GET['a'])){
				if($validateAction || $_GET['a']=1){
					$css = "success";
					$msg = "Depoimentos atualizado com sucesso!";
				}else{
					$css = "danger";
					$msg = "Erro ao atualizar depoimento. Por favor, tente novamente!".$saveImage;
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
					<div class="panel-heading">
						<strong>Novo depoimento</strong></em>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
							
								<form role="form" method="POST" action="" enctype="multipart/form-data">
									<input type="hidden" name="action" value="<?php echo base64_encode($acao);?>">
									<div class="form-group">
										<label for="depoimento_nome">Nome</label>
										<input value="<?php echo (isset($depoimentoValues['nome'])) ? htmlentities($depoimentoValues['nome']):"";?>" id="depoimento_nome" name="depoimento_nome" class="form-control" required placeholder="Nome do depoente" maxlength="150">
									</div>
									<div class="form-group">
										<label for="depoimento_texto">Depoimento</label>
                                        <textarea name="depoimento_texto" id="depoimento_texto" class="form-control" rows="3"><?php echo (isset($depoimentoValues['depoimento'])) ? htmlentities($depoimentoValues['depoimento']):"";?></textarea>
									</div>
									<div class="form-group">
										<?php
											$check1 = "checked";
											$check2 = "";
											if(isset($depoimentoValues['ativo'])){
												if($depoimentoValues['ativo'] == "0"){
													$check1 = "";
													$check2 = "checked";
												}
												else{
													$check1 = "checked";
													$check2 = "";
												}
											}
										?>
										<label>Depoimento ativo?</label>
										<label class="radio-inline">
											<input type="radio" name="depoimento_ativo" id="depoimento_ativo_1" value="1" <?php echo $check1;?>>Sim
										</label>
										<label class="radio-inline">
											<input type="radio" name="depoimento_ativo" id="depoimento_ativo_0" value="0" <?php echo $check2;?>>Não
										</label>
									</div>
									<div class="form-group">
										<label>Foto do depoente</label>
										<input name="depoimento_imagem" id="depoimento_imagem" type="file">
									</div>
									<?php
										if(isset($depoimentoValues['foto'])){
									?>
									
									<input type="hidden" name="imagem_atual" value="<?php echo $depoimentoValues['foto'];?>">
									<div class="form-group">
										<label>Foto atual</label>
										<p><img class="img-responsive" src="../img/depoimentos/<?php echo $depoimentoValues['foto'];?>"></p>
									</div>
									
									<?php
										}
									?>
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

    </body>
</html>