<?php 
include "includes/header.inc.php";
$acao = "reservas-edit";
$ReservaOnline= new ReservaOnline($_GET['id']);
if(($_POST) && $core->exist($_POST['action']) && base64_decode($_POST['action'])=== $acao){
	if(isset($_FILES['reserva_imagem']) && $_FILES['reserva_imagem']['size']>0){
		$uploadImage = new UploadImage($_FILES['reserva_imagem'], 800, 600, "../img/reservas/");
		$saveImage = $uploadImage->salvar();
		if(is_bool($saveImage) && $saveImage === true){
			$validateAction = $ReservaOnline->save($_POST, $uploadImage->fileName);
			$saveImage = null;
			if($validateAction === true){
				$getID = $ReservaOnline->find($_POST, $uploadImage->fileName);
				$core->redirectTo($admin->path."?admin=reservas-form&a=1&id=".base64_encode($getID[0]));
				die();
			}
		}
		else{
			$validateAction = false;
			$saveImage = "<br>".$saveImage;
		}
	}
	else{
		$validateAction = $ReservaOnline->save($_POST, $_POST['imagem_atual']);
		if($validateAction === true){
			$getID = $ReservaOnline->find($_POST, $_POST['imagem_atual']);
				$core->redirectTo($admin->path."?admin=reservas-form&a=1&id=".base64_encode($getID[0]));
			die();
		}
	}
	
}
if(isset($_GET['id']) && $core->exist($_GET['id']) && base64_decode($_GET['id'])>0){
	$reservaValues = $ReservaOnline->get(base64_decode($_GET['id']));
}

?>

	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header">Reservas Online <i class="fa fa-fw" aria-hidden="true">&#xf101</i> Criar/Atualizar </h2>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		
		<?php
			if(isset($validateAction) || isset($_GET['a'])){
				if($validateAction || $_GET['a']=1){
					$css = "success";
					$msg = "Reserva atualizada com sucesso!";
				}else{
					$css = "danger";
					$msg = "Erro ao atualizar Reserva. Por favor, tente novamente!".$saveImage;
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
						<strong>Reservas</strong> - <em>Preencha o campo URL ou insira script do parceiro</em>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
							
								<form role="form" method="POST" action="" enctype="multipart/form-data">
									<input type="hidden" name="action" value="<?php echo base64_encode($acao);?>">
									<div class="form-group">
										<label for="reserva_nome">Nome</label>
										<input value="<?php echo (isset($reservaValues['reserva_nome'])) ? htmlentities($reservaValues['reserva_nome']):"";?>" id="reserva_nome" name="reserva_nome" class="form-control" required placeholder="Nome" maxlength="150">
									</div>
									<div class="form-group">
										<label for="reserva_url">Link/URL</label>
										<input value="<?php echo (isset($reservaValues['reserva_url'])) ? htmlentities($reservaValues['reserva_url']):"";?>" id="reserva_url" name="reserva_url" class="form-control" placeholder="http://www.navigatetour.com.br">
									</div>
									<div class="form-group">
										<label for="reserva_url">Script HTML</label>
									    <textarea name="reserva_script" id="reserva_script" class="form-control" rows="5"><?php echo (isset($reservaValues['reserva_script'])) ? htmlentities($reservaValues['reserva_script']):"";?></textarea>
									</div>
									<div class="form-group">
										<?php
											$check1 = "checked";
											$check2 = "";
											if(isset($reservaValues['ativo'])){
												if($reservaValues['ativo'] == "0"){
													$check1 = "";
													$check2 = "checked";
												}
												else{
													$check1 = "checked";
													$check2 = "";
												}
											}
										?>
										<label>Reserva ativa?</label>
										<label class="radio-inline">
											<input type="radio" name="reserva_ativo" id="reserva_ativo_1" value="1" <?php echo $check1;?>>Sim
										</label>
										<label class="radio-inline">
											<input type="radio" name="reserva_ativo" id="reserva_ativo_0" value="0" <?php echo $check2;?>>Não
										</label>
									</div>
									<div class="form-group">
										<label>Imagem da reserva</label>
										<input name="reserva_imagem" id="reserva_imagem" type="file">
									</div>
									<?php
										if(isset($reservaValues['reserva_logo'])){
									?>
									
									<input type="hidden" name="imagem_atual" value="<?php echo $reservaValues['reserva_logo'];?>">
									<div class="form-group">
										<label>Imagem atual</label>
										<p><img class="img-responsive" src="../img/reservas/<?php echo $reservaValues['reserva_logo'];?>"></p>
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