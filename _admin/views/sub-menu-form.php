<?php 
include "includes/header.inc.php";
$acao = "submenu-edit";

$SiteConfig = new SiteConfig();
if(($_POST) && $core->exist($_POST['action']) && base64_decode($_POST['action'])=== $acao){
	$validateAction = $SiteConfig->saveSubmenu($_POST);
	if($validateAction === true){
		$getID = $SiteConfig->findSubmenu($_POST['secao'], $_POST['categoria']);
		$core->redirectTo($admin->path."?admin=sub-menu-form&a=1&id=".base64_encode($getID[0]));
		die();
	}
	
}
if(isset($_GET['id']) && $core->exist($_GET['id']) && base64_decode($_GET['id'])>0){
	$menuValues = $SiteConfig->getSubmenu(base64_decode($_GET['id']));
}

?>

	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header">Sub-menu <i class="fa fa-fw" aria-hidden="true">&#xf101</i> Criar/Atualizar </h2>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		
		<?php
			if(isset($validateAction) || isset($_GET['a'])){
				if($validateAction || $_GET['a']=1){
					$css = "success";
					$msg = "Item atualizado com sucesso!";
				}else{
					$css = "danger";
					$msg = "Erro ao atualizar Item. Por favor, tente novamente!".$saveImage;
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
						<strong>Novo sub-menu</strong></em>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
							
								<form role="form" method="POST" action="">
									<input type="hidden" name="action" value="<?php echo base64_encode($acao);?>">
									<input type="hidden" name="id" value="<?php 
										if(isset($menuValues['id'])) echo base64_encode($menuValues['id']);
									?>">
									<div class="form-group">
										<label for="categoria">Nome</label>
										<input required value="<?php echo (isset($menuValues['categoria'])) ? htmlentities($menuValues['categoria']):"";?>" id="categoria" name="categoria" class="form-control" required placeholder="Nome do menu" maxlength="70">
									</div>
									<div class="form-group">
										<label for="secao">Menu do site</label>
                                        
										<select required name="secao" id="secao" class="form-control">
											<option>Selecione o menu:</option>
											<?php
												foreach($listSecoes as $item){
													if($item['id']<9){
														if((isset($menuValues['secoes_id'])) && $item['id'] == $menuValues['secoes_id']){
															$selected = 'selected="selected"';
														}
														else $selected=''; 
														echo "<option value=\"{$item['id']}\" {$selected}>{$item['secao']}</option>";
													}
												}
											?>
											
										</select>
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

    </body>
</html>