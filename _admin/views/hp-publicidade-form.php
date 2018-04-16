<?php 
include "includes/header.inc.php";
$acao = "hp-publicidade";
$HP = new HP($_GET['id']);
if(($_POST) && $core->exist($_POST['action']) && base64_decode($_POST['action'])=== $acao){
	if(isset($_FILES['banner_imagem']) && $_FILES['banner_imagem']['size']>0){
		$uploadImage = new UploadImage($_FILES['banner_imagem'], 1920, 800, "../img/banner-hp/");
		$saveImage = $uploadImage->salvar();
		if(is_bool($saveImage) && $saveImage === true){
			$validateAction = $HP->savePublicidade($_POST, $uploadImage->fileName);
			$saveImage = null;
			if($validateAction === true){
				$getID = $HP->findBanner($_POST, $uploadImage->fileName);
				$core->redirectTo($admin->path."?admin=hp-publicidade-form&a=1&id=".base64_encode($getID[0]));
				die();
			}
		}
		else{
			$validateAction = false;
			$saveImage = "<br>".$saveImage;
		}
	}
	else{
		$validateAction = $HP->savePublicidade($_POST, $_POST['imagem_atual']);
		if($validateAction === true){
			$getID = $HP->findPublicidade($_POST, $_POST['imagem_atual']);
			$core->redirectTo($admin->path."?admin=hp-publicidade-form&a=1&id=".base64_encode($getID[0]));
			die();
		}
	}
	
}
if(isset($_GET['id']) && $core->exist($_GET['id']) && base64_decode($_GET['id'])>0){
	$bannerValues = $HP->getPublicidade(base64_decode($_GET['id']));
}

?>

	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header">HP <i class="fa fa-fw" aria-hidden="true">&#xf101</i> Publicidade <i class="fa fa-fw" aria-hidden="true" title="Copy to use angle-double-right">&#xf101</i> Criar/Atualizar </h2>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		
		<?php
			if(isset($validateAction) || isset($_GET['a'])){
				if($validateAction || $_GET['a']=1){
					$css = "success";
					$msg = "HP atualizada com sucesso!";
				}else{
					$css = "danger";
					$msg = "Erro ao atualizar HP. Por favor, tente novamente!".$saveImage;
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
						<strong>Imagem</strong> - <em>A imagem final deverá ter 1920 x 680px para cobrir área de resolução full hd.</em>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
							
								<form role="form" method="POST" action="" enctype="multipart/form-data">
									<input type="hidden" name="action" value="<?php echo base64_encode($acao);?>">
									<div class="form-group">
										<label for="banner_nome">Nome</label>
										<input value="<?php echo (isset($bannerValues['titulo'])) ? htmlentities($bannerValues['titulo']):"";?>" id="banner_nome" name="banner_nome" class="form-control" required placeholder="Nome do banner" maxlength="150">
									</div>
									<div class="form-group">
										<label for="banner_url">Link/URL</label>
										<input value="<?php echo (isset($bannerValues['url'])) ? htmlentities($bannerValues['url']):"";?>" id="banner_url" name="banner_url" class="form-control" placeholder="http://www.navigatetour.com.br">
									</div>
									<div class="form-group">
										<?php
											$check1 = "checked";
											$check2 = "";
											if(isset($bannerValues['ativo'])){
												if($bannerValues['ativo'] == "0"){
													$check1 = "";
													$check2 = "checked";
												}
												else{
													$check1 = "checked";
													$check2 = "";
												}
											}
										?>
										<label>Banner ativo?</label>
										<label class="radio-inline">
											<input type="radio" name="banner_ativo" id="banner_ativo_1" value="1" <?php echo $check1;?>>Sim
										</label>
										<label class="radio-inline">
											<input type="radio" name="banner_ativo" id="banner_ativo_0" value="0" <?php echo $check2;?>>Não
										</label>
									</div>
									<div class="form-group">
										<label>Imagem do banner</label>
										<input name="banner_imagem" id="banner_imagem" type="file">
									</div>
									<?php
										if(isset($bannerValues['arquivo'])){
									?>
									
									<input type="hidden" name="imagem_atual" value="<?php echo $bannerValues['arquivo'];?>">
									<div class="form-group">
										<label>Imagem atual</label>
										<p><img class="img-responsive" src="../img/banner-hp/<?php echo $bannerValues['arquivo'];?>"></p>
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