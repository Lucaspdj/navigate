<?php 
include "includes/header.inc.php";
$acao = "institucional-edit";
$Conteudo= new Conteudo(0);
$SiteConfig = new SiteConfig();
$secaoValues = $SiteConfig->getSecao(base64_decode($_GET['secao']));
$uploads_msg = "";
if(($_POST) && $core->exist($_POST['action']) && base64_decode($_POST['action'])=== $acao){
	
	$data = $_POST;
	$data['secoes_id'] = base64_decode($_GET['secao']);
	$validateAction = $Conteudo->saveInstitucional($data);
	if($validateAction === true){
		if(isset($data['id']) && !empty($data['id'])){
			$core->redirectTo($admin->path."?admin=institucionais-form&a=1&secao=".$_GET['secao']."&id=".trim($data['id']));
		}
		else{
			$getID = $Conteudo->findInstitucional($data);
			$core->redirectTo($admin->path."?admin=institucionais-form&a=1&secao=".$_GET['secao']."&id=".base64_encode($getID[0]));
		}
		die();
	}
	
}
if(isset($_GET['id']) && $core->exist($_GET['id']) && base64_decode($_GET['id'])>0){
	$conteudoValues = $Conteudo->getInstitucional(base64_decode($_GET['id']));
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
							
								<form role="form" method="POST" action="">
									<input type="hidden" name="action" value="<?php echo base64_encode($acao);?>">
									<input type="hidden" name="id" value="<?php 
										if(isset($conteudoValues['id'])) echo base64_encode($conteudoValues['id']);
									?>">
									<div class="form-group">
										<label for="titulo">Título</label>
										<input value="<?php echo (isset($conteudoValues['titulo'])) ? htmlentities($conteudoValues['titulo']):"";?>" id="titulo" name="titulo" class="form-control" required placeholder="Título" maxlength="200">
									</div>
									
									<div class="form-group">
										<textarea class="form-control" name="conteudo" id="conteudo" rows="10"><?php echo (isset($conteudoValues['conteudo'])) ? trim($conteudoValues['conteudo']):"";?></textarea>
										<hr />
									</div>
									
									<input type="hidden" name="ativo" id="ativo" value="1">
									
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
			CKEDITOR.replace( 'conteudo' );
		});
	</script>
    </body>
</html>