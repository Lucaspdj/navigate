<?php 
include "includes/header.inc.php";

if(($_POST) && $core->exist($_POST['action']) && base64_decode($_POST['action'])==="site_configs"){
	$validateAction = $admin->updateSiteConfig($_POST);
}

$SiteConfig = new SiteConfig();
$siteValues = $SiteConfig->getValues();
?>

	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header">Informações do site</h2>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		
		<?php
			if(isset($validateAction)){
				if($validateAction){
					$css = "success";
					$msg = "Dados atualizados com sucesso!";
				}else{
					$css = "danger";
					$msg = "Erro ao atualizar dados. Por favor, tente novamente!";
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
						<strong>SEO</strong> - <em>Defina como seu site aparecerá nos sistemas de busca.</em>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
							
								<form role="form" method="POST" id="formSEO" action="">
									<input type="hidden" name="action" value="<?php echo base64_encode("site_configs");?>">
									<div class="form-group">
										<label for="seo_titulo">Título do site</label>
										<input value="<?php echo ($siteValues['seo_titulo']) ? htmlentities($siteValues['seo_titulo']):"";?>" id="seo_titulo" name="seo_titulo" class="form-control" required placeholder="Título" maxlength="100">
									</div>
									<div class="form-group">
										<label for="seo_keywords">Palavras chaves</label>
										<input value="<?php echo ($siteValues['seo_keywords']) ? htmlentities($siteValues['seo_keywords']):"";?>" id="seo_keywords" name="seo_keywords" class="form-control" required placeholder="Separadas por virgulas. Ex: key1, key2, key3" maxlength="250">
									</div>
									<div class="form-group">
										<label for="seo_desc">Descrição do site</label>
										<input value="<?php echo ($siteValues['seo_desc']) ? htmlentities($siteValues['seo_desc']):"";?>" id="seo_desc" name="seo_desc" class="form-control" required placeholder="Descrição. Até 150 caracteres" maxlength="150">
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
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<strong>Endereço e Telefone</strong> - <em>Telefone que aparecerá no header do site, e o endereço no rodapé do site</em>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
							
								<form role="form" method="POST" id="formContatos" action="">
									<input type="hidden" name="action" value="<?php echo base64_encode("site_configs");?>">
									
									<div class="row">
										<label  class="col-md-12">Telefone</label>
										<div class="col-md-1">
											<input value="<?php echo (isset($siteValues['contatos_ddd'])) ? htmlentities($siteValues['contatos_ddd']):"";?>" id="contatos_ddd" name="contatos_ddd" type="text" size="3" class="form-control" placeholder="99" maxlength="2">
										</div>
										<div class="col-md-11">
											<input value="<?php echo (isset($siteValues['contatos_fone'])) ? htmlentities($siteValues['contatos_fone']):"";?>" id="contatos_fone" name="contatos_fone" type="text" size="10" class="form-control" placeholder="9999-9999" maxlength="10">
										</div>
									</div>
									<div class="form-group"><br>
										<label for="contatos_endereco">Endereço</label>
                                        <textarea name="contatos_endereco" id="contatos_endereco" class="form-control" rows="3"><?php echo (isset($siteValues['contatos_endereco'])) ? htmlentities($siteValues['contatos_endereco']):"";?></textarea>
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
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<strong>Redes Sociais</em>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
							
								<form role="form" method="POST" id="formRedesSociais" action="">
									<input type="hidden" name="action" value="<?php echo base64_encode("site_configs");?>">
									<div class="form-group">
										<label for="redes_facebook">Facebook</label>
										<input value="<?php echo ($siteValues['redes_facebook']) ? htmlentities($siteValues['redes_facebook']):"";?>" id="redes_facebook" name="redes_facebook" class="form-control" required placeholder="FACEBOOK" maxlength="250">
									</div>
									<div class="form-group">
										<label for="redes_twitter">Twitter</label>
										<input value="<?php echo ($siteValues['redes_twitter']) ? htmlentities($siteValues['redes_twitter']):"";?>" id="redes_twitter" name="redes_twitter" class="form-control" required placeholder="TWITTER" maxlength="250">
									</div>
									<div class="form-group">
										<label for="redes_instagram">Instagram</label>
										<input value="<?php echo ($siteValues['redes_instagram']) ? htmlentities($siteValues['redes_instagram']):"";?>" id="redes_instagram" name="redes_instagram" class="form-control" placeholder="INSTAGRAM" maxlength="250">
									</div>
									<div class="form-group">
										<label for="redes_google_plus">GOOGLE+</label>
										<input value="<?php echo ($siteValues['redes_google_plus']) ? htmlentities($siteValues['redes_google_plus']):"";?>" id="redes_google_plus" name="redes_google_plus" class="form-control" placeholder="GOOGLE+" maxlength="250">
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


<?php unset($siteValues); ?>
<?php include "includes/footer.inc.php"; ?>

    </body>
</html>