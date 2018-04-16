<?php 
include "includes/head_metas.inc.php";
if($mobile){
    include "includes/header.inc.php";
}else{
    include "includes/header.inc.php";
}
$HP = new HP(0);
$Depoimentos = new Depoimentos(0);
$getBanners = $HP->listBanners();
$getPublicidade = $HP->getLastPublicidade();
$getDepoimentos = $Depoimentos->HP_listDepoimentos();
?>

<div class="clearfix" id="slider_HP_container">
<?php if($getBanners) { ?>
	<!-- Loading Screen -->
	<div data-u="loading" class="jssorl-009-spin" style="position: absolute; top: 0px; left: 0px; width: 100%; height: 100%; text-align: center; background-color: rgba(0, 0, 0, 0.7);">
		<img alt="Aguarde..." style="margin-top: -19px; position: relative; top: 50%; width: 38px; height: 38px;" src="../svg/loading/static-svg/spin.svg" />
	</div>

	<!-- Slides Container -->
	<div data-u="slides" id="slider_HP_fotos">
	
		<?php foreach($getBanners as $banner){ 
			$url = "javascript:void(0)";
			if(!empty($banner['url'])){
				$url = $banner['url'];
			}
		?>
		<div>
			<a href="<?php echo $url;?>"><img data-u="image" alt="<?php echo $banner['titulo'];?>" src="img/banner-hp/<?php echo $banner['image'];?>" /></a>
		</div>
		<?php } ?>
		
	</div>

	<!--#region Bullet Navigator Skin Begin -->
	<div data-u="navigator" class="jssorb031" style="position: absolute; bottom: 12px; right: 12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
		<div data-u="prototype" class="i" style="width: 16px; height: 16px;">
			<svg viewBox="0 0 16000 16000" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
				<circle class="b" cx="8000" cy="8000" r="5800"></circle>
			</svg>
		</div>
	</div>
	<!--#endregion Bullet Navigator Skin End -->
	
	<!--#region Arrow Navigator Skin Begin -->
	<div data-u="arrowleft" class="jssora051" style="width: 55px; height: 55px; top: 0px; left: 25px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
		<svg viewBox="0 0 16000 16000" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
			<polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
		</svg>
	</div>
	<div data-u="arrowright" class="jssora051" style="width: 55px; height: 55px; top: 0px; right: 25px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
		<svg viewBox="0 0 16000 16000" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
			<polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
		</svg>
	</div>
	<!--#endregion Arrow Navigator Skin End -->

<?php } ?>
</div>

<div class="main-hp container clearfix">
	<?php
		$ReservaOnline = new ReservaOnline(0);
		$getReservas = $ReservaOnline->HP_list();
		if($getReservas){
	?>

	<section id="hp-reservas-online">
		<h2 class="titulo-hp">Reservas on-line</h2>
		<div class="row">
			<?php
				foreach($getReservas as $reserva){
			?>
			<div class="col-md-4 col-sm-12 reservas-online">
				<?php
					if(!empty($reserva['reserva_url'])){
						echo '
						<a href="'.$reserva['reserva_url'].'" data-featherlight="iframe" data-featherlight-iframe-width="1440" data-featherlight-iframe-height="800" data-featherlight-iframe-max-width="100%"><img alt="'.$reserva['reserva_nome'].'" src="img/reservas/'.$reserva['reserva_logo'].'"></a>
						';
					}
					else if(!empty($reserva['reserva_script'])){
					?>
						<a href="javascript:void(0);" data-featherlight="#fl<?php echo $reserva['id'];?>"><img alt="<?php echo $reserva['reserva_nome'];?>" src="img/reservas/<?php echo $reserva['reserva_logo'];?>"></a>
						<div class="lightbox" id="fl<?php echo $reserva['id'];?>">
							<?php echo $reserva['reserva_script'];?>
						</div>
					<?php
					}
				?>
				
			</div>
			<?php
				}
			?>
		</div>
	</section>
	
	<?php
		}
		$share_buttons = 0;
		$secoes = $SiteConfig->getSecoes();
		if($secoes){
			$Conteudo = new Conteudo(0);
			foreach($secoes as $item){
				$getConteudo = $Conteudo->HP_List($item['id']);
				if($item['id']<9 && $getConteudo){
	?>
	
					<section id="<?php echo $core->normalizaUrl($item['secao']);?>">
						<br><h2 class="titulo-hp"><?php echo $item['secao'];?></h2><br>
						<div class="row" <?php if(!$mobile){ echo 'style="display: flex;"'; };?>>
							<?php
								foreach($getConteudo as $destaque){
									$url = "/pacotes/".$core->normalizaUrl($destaque['secao'])."/".$destaque['id']."-".$core->normalizaUrl($destaque['titulo']);
									$share_buttons++;
							?>
							<div class="col-md-4 col-sm-12" <?php if(!$mobile){ echo 'style="display: flex;"'; };?> onmouseleave="$('#share_buttons_<?php echo $share_buttons;?>').hide();">
								<div class="hp-conteudo-destaque" <?php if(!$mobile){ echo 'style="flex:1;"'; };?>>
									<a href="<?php echo $url;?>"><img src="img/internas/<?php echo $destaque['banner'];?>"></a>
									<p class="text-center"><br><strong><?php echo $destaque['titulo'];?></strong><br></p>
									<p class="text-center"><br><?php 
										echo substr(strip_tags($destaque['destaque']), 0, 140);
										if(strlen($destaque['destaque'])>100) echo "...";
									?><br></p>
									<p class="text-center"><br>
										<a href="<?php echo $url;?>" class="btn btn-primary btn-round-lg btn-lg btn-veja-mais">Ver mais</a>
										<button type="button" class="btn btn-primary btn-round-lg btn-lg btn-compartilhar" onclick="$('#share_buttons_<?php echo $share_buttons;?>').fadeIn();">Compartilhar</button>
										<div class="share-buttons" id="share_buttons_<?php echo $share_buttons;?>">
											<a href="http://www.facebook.com/sharer.php?u=<?php echo $_SERVER['SERVER_NAME'].$url;?>" target="_blank">
												<img src="img/icons/facebook.png" alt="Facebook" />
											</a>
											<a href="https://plus.google.com/share?url=<?php echo $_SERVER['SERVER_NAME'].$url;?>" target="_blank">
												<img src="img/icons/google.png" alt="Google" />
											</a>
											<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $_SERVER['SERVER_NAME'].$url;?>" target="_blank">
												<img src="img/icons/linkedin.png" alt="LinkedIn" />
											</a>
											<a href="https://twitter.com/share?url=<?php echo $_SERVER['SERVER_NAME'].$url;?>&amp;text=<?php echo $destaque['titulo'];?>" target="_blank">
												<img src="img/icons/twitter.png" alt="Twitter" />
											</a>
										</div>
									<br><br></p>
								</div>
							</div>
							<?php
								}
							?>
						</div>
					</section>
	
	<?php
				}
			}
		}
		if($getPublicidade){
	?>
	
	<section id="hp-publicidade"><br><br><br>
		<p class="text-center"><a href="<?php echo $getPublicidade['url'];?>" target="_blank"><img src="img/banner-hp/<?php echo $getPublicidade['arquivo'];?>"></a></p>
		<p class="text-right"><small>Publicidade&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</small></p>
	</section>
	
	<?php
		}
	?>
</div>

<?php
if($getDepoimentos){
?>
<br><br><br>
<div id="hp-depoimentos">
	<div class="container clearfix">
		<div class="row" <?php if(!$mobile){ echo 'style="display: flex;"'; };?>>
		<?php
			foreach($getDepoimentos as $depoimento)
			{
		?>
			<div class="col-md-4 col-sm-12" <?php if(!$mobile){ echo 'style="display: flex;"'; };?>>
				<div class="hp-depoimento-destaque" <?php if(!$mobile){ echo 'style="flex:1;"'; };?>>
					<p><img src="img/depoimentos/<?php echo $depoimento['foto'];?>" /></p>
					<p class="text-center"><br><strong><?php echo $depoimento['nome'];?></strong></p>
					<p class="text-center">&ldquo; <?php echo $depoimento['depoimento'];?> &rdquo;<br></p>
				</div>
			</div>
		<?php
			}
		?>
		</div>
	</div>
</div>
<?php
}
?>

<?php include "includes/footer.inc.php"; ?>
<script src="plugins/featherlight/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>
	