<?php 
include "includes/head_metas.inc.php";
if($mobile){
    include "includes/header.inc.php";
}else{
    include "includes/header.inc.php";
}
$findContent = explode("/", $GET_URL);
$findContent = explode("-", $findContent[3]);
if((is_numeric($findContent[0])) && $findContent[0]>0){
	$HP = new HP(0);
	$Conteudo = new Conteudo($findContent[0]);
	$dados = $Conteudo->get($findContent[0]);
	// if(!$dados){
	// 	$core->redirectTo("/home");
	// 	die();
	// }
	
	$getCross = $Conteudo->getCross($dados['id']);
	$cross1 = null;
	$cross2 = null;
	
	if($getCross[0]){
		$cross1 = new Conteudo(null);
		$cross1 = $cross1->get($getCross[0]['conteudo_vinculado']);
	}
	if($getCross[1]){
		$cross2 = new Conteudo(null);
		$cross2 = $cross2->get($getCross[1]['conteudo_vinculado']);
	}
	
}
else{
	// $core->redirectTo("/home");
	// die();
}
?>


<div class="banner_internas"><img src="img/internas/<?php echo $dados['banner'];?>"></div>

<div class="internas container clearfix">
	
	<div class="breadcrumbs">
		<a href="/home">HOME</a> &nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;
		<a href="/secao/<?php echo $core->normalizaUrl($dados['secoes_id']);?>-<?php echo $core->normalizaUrl($dados['secao']);?>"><?php echo strtoupper($dados['secao']);?></a> &nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;
		<span><?php echo strtoupper($dados['titulo']);?></span>
	</div>
	
	<h2 class="titulo-hp"><?php echo $dados['titulo'];?></h2><br>
	
	<div class="row">
		<div class="<?php
			if($cross1 == null && $cross2 == null) echo "col-md-12";
			else echo "col-md-8";
		?>">
			<div class="destaques destaque-central-borda-inferior">
				<img class="destaque_img" src="/img/internas/<?php echo $dados['img_destaque'];?>">
				<div class="destaque-central">
					<h2 class="destaque-central-titulo"><?php echo htmlentities($dados['titulo']);?></h2>
					<div class="destaque-central-texto"><?php echo str_replace("script>","scr1pt >",$dados['destaque']);?></div>
				</div>
			</div>
		</div>
		<?php
			if($cross1 != null || $cross2 != null){
		?>
		<div class="col-md-4">
			<?php
				if($cross1 != null){
					$url = "/institucional/".$core->normalizaUrl($cross1['secao'])."/".$cross1['id']."-".$core->normalizaUrl($cross1['titulo']);
			?>
			<div class="col-md-12 destaques destaque-central-borda-inferior noPadding">
				<?php if($cross1['img_destaque']){
					echo '<img class="destaque_img" src="/img/internas/'.$cross1['img_destaque'].'">';
				} ?>
				<div class="destaque-central">
					<h2 class="destaque-central-titulo"><?php echo htmlentities($cross1['titulo']);?></h2>
					<div class="destaque-central-texto"><?php echo substr(strip_tags($cross1['destaque']), 0, 150);?></div>
					<p class="text-center"><br>
						<a href="<?php echo $url;?>" class="btn btn-primary btn-round-lg btn-lg btn-veja-mais">Ver mais</a>
						<button type="button" class="btn btn-primary btn-round-lg btn-lg btn-compartilhar" onclick="$('#share_buttons_1').fadeIn();">Compartilhar</button>
						<div class="share-buttons" id="share_buttons_1">
							<a href="http://www.facebook.com/sharer.php?u=<?php echo $_SERVER['SERVER_NAME'].$url;?>" target="_blank">
								<img src="img/icons/facebook.png" alt="Facebook" />
							</a>
							<a href="https://plus.google.com/share?url=<?php echo $_SERVER['SERVER_NAME'].$url;?>" target="_blank">
								<img src="img/icons/google.png" alt="Google" />
							</a>
							<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $_SERVER['SERVER_NAME'].$url;?>" target="_blank">
								<img src="img/icons/linkedin.png" alt="LinkedIn" />
							</a>
							<a href="https://twitter.com/share?url=<?php echo $_SERVER['SERVER_NAME'].$url;?>&amp;text=<?php echo $cross1['titulo'];?>" target="_blank">
								<img src="img/icons/twitter.png" alt="Twitter" />
							</a>
						</div></p><br>
				</div>
			</div>
			<?php
				}
				if($cross2 != null){
					$url = "/institucional/".$core->normalizaUrl($cross2['secao'])."/".$cross2['id']."-".$core->normalizaUrl($cross2['titulo']);
			?>
			
			<p class="clearfix"><br class="clear"></p>
			<p class="clearfix"><br class="clear"></p>
			<p class="clearfix"><br class="clear"></p>
			<div class="col-md-12 destaques destaque-central-borda-inferior noPadding">
				<?php if($cross2['img_destaque']){
					echo '<img class="destaque_img" src="/img/internas/'.$cross2['img_destaque'].'">';
				} ?>
				<div class="destaque-central">
					<h2 class="destaque-central-titulo"><?php echo htmlentities($cross2['titulo']);?></h2>
					<div class="destaque-central-texto"><?php echo substr(strip_tags($cross2['destaque']), 0, 150);?></div>
					<p class="text-center"><br>
						<a href="<?php echo $url;?>" class="btn btn-primary btn-round-lg btn-lg btn-veja-mais">Ver mais</a>
						<button type="button" class="btn btn-primary btn-round-lg btn-lg btn-compartilhar" onclick="$('#share_buttons_2').fadeIn();">Compartilhar</button>
						<div class="share-buttons" id="share_buttons_2">
							<a href="http://www.facebook.com/sharer.php?u=<?php echo $_SERVER['SERVER_NAME'].$url;?>" target="_blank">
								<img src="img/icons/facebook.png" alt="Facebook" />
							</a>
							<a href="https://plus.google.com/share?url=<?php echo $_SERVER['SERVER_NAME'].$url;?>" target="_blank">
								<img src="img/icons/google.png" alt="Google" />
							</a>
							<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $_SERVER['SERVER_NAME'].$url;?>" target="_blank">
								<img src="img/icons/linkedin.png" alt="LinkedIn" />
							</a>
							<a href="https://twitter.com/share?url=<?php echo $url;?>&amp;text=<?php echo $cross2['titulo'];?>" target="_blank">
								<img src="img/icons/twitter.png" alt="Twitter" />
							</a>
						</div></p><br>
				</div>
			</div>
			<?php
				}
			?>
			
		</div>
		<?php
			}
		?>
	</div>
	
	<p class="clearfix"><br class="clear"></p>
	<div class="col-md-12 destaques" style="margin:0;padding:0">
		<div id="pacotes-abas">
			<a href="javascript:void(0)" class="aba-roteiro aba-ativa" onclick="$('#o-que-inclui').fadeOut('fast');$('#roteiro').fadeIn();$('.aba-roteiro').addClass('aba-ativa');$('.aba-o-que-inclui').removeClass('aba-ativa');">Roteiro</a>
			<a href="javascript:void(0)" class="aba-o-que-inclui" onclick="$('#roteiro').fadeOut('fast');$('#o-que-inclui').fadeIn();$('.aba-o-que-inclui').addClass('aba-ativa');$('.aba-roteiro').removeClass('aba-ativa');">O que inclui</a>
			<?php
				$url = "/institucional/".$core->normalizaUrl($dados['secao'])."/".$dados['id']."-".$core->normalizaUrl($dados['titulo']);
			?>
			<div id="roteiro" class="abas">
				<?php echo str_replace("script>","scr1pt >",$dados['aba_roteiro']);?>
				<div class="clearfix">
					
					<p class="text-center"><br>
					<?php 
						if(!empty($dados['pdf_file'])){
					?>
					<a href="/download/<?php echo $dados['pdf_file'];?>" target="_blank" class="btn btn-primary btn-round-lg btn-lg btn-veja-mais">Baixar roteiro</a>
					<?php
						}
					?>
					<button type="button" class="btn btn-primary btn-round-lg btn-lg btn-compartilhar" onclick="$('#share_buttons_3').fadeIn();">Compartilhar</button>
					<a href="javascript:void(0);" data-featherlight="#receber-orcamento" class="btn btn-primary btn-round-lg btn-lg btn-veja-mais">Receber Orçamento</a>
					<div class="share-buttons" id="share_buttons_3" style="left:40%">
						<a href="http://www.facebook.com/sharer.php?u=<?php echo $_SERVER['SERVER_NAME'].$url;?>" target="_blank">
							<img src="img/icons/facebook.png" alt="Facebook" />
						</a>
						<a href="https://plus.google.com/share?url=<?php echo $_SERVER['SERVER_NAME'].$url;?>" target="_blank">
							<img src="img/icons/google.png" alt="Google" />
						</a>
						<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $_SERVER['SERVER_NAME'].$url;?>" target="_blank">
							<img src="img/icons/linkedin.png" alt="LinkedIn" />
						</a>
						<a href="https://twitter.com/share?url=<?php echo $url;?>&amp;text=<?php echo $dados['titulo'];?>" target="_blank">
							<img src="img/icons/twitter.png" alt="Twitter" />
						</a>
					</div></p>
					<p class="clearfix"><br class="clear"></p>
					<div class="lightbox" id="receber-orcamento">
						<form method="POST">
							<h2 class="titulo">Receber orçamento para "<?php echo $dados['titulo'];?>" </h2>
							<br>
							<div class="form-group">
								<label for="orcamento_nome">Seu nome: </label>
								<input required value="" id="orcamento_nome" name="orcamento_nome" class="form-control" placeholder="Digite seu nome" maxlength="150">
							</div>
							<div class="form-group">
								<label for="orcamento_email">Seu Email: </label>
								<input required value="" id="orcamento_email" name="orcamento_email" class="form-control" placeholder="Digite seu Email" maxlength="150">
							</div>
							<div class="form-group">
								<label for="orcamento_celular">Seu Telefone: </label>
								<input required value="" id="orcamento_celular" name="orcamento_celular" class="form-control" placeholder="Digite seu Telefone" maxlength="50">
							</div>
							<p class="center-block text-center">
							<button type="button" class="btn btn-primary">Solicitar orçamento</button>
							</p>
						</form>
					</div>
				</div>
			</div>
			<div id="o-que-inclui" class="abas none">
				<?php echo str_replace("script>","scr1pt >",$dados['aba_oque_inclui']);?>
			</div>
		</div>
	</div>
	<p class="clearfix"><br class="clear"></p>
	
	<br><br>
</div>

<?php include "includes/footer.inc.php"; ?>
<script src="plugins/featherlight/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>
	
