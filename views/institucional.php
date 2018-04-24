<?php 
include "includes/head_metas.inc.php";
if($mobile){
    include "includes/header.inc.php";
}else{
    include "includes/header.inc.php";
}
?>


<div class="banner_internas"></div>

<div class="internas container clearfix">
	
	<div class="breadcrumbs">
		<a href="/home">HOME</a> &nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;
		<a href="/institucionais/" >Institucionais</a> &nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;
		<span>Empresa</span>
	</div>
	
	<h2 class="titulo-hp">
	<wp-expose action="buscarpaginas" motor="Principal" idComp="24" propiedade="titulo" />
	</h2><br>
	
	<div class="row">
		<div class="<?php
			if($cross1 == null && $cross2 == null) echo "col-md-12";
			else echo "col-md-8";
		?>">
			<div class="destaques destaque-central-borda-inferior">
				<img class="destaque_img" src="/img/internas/<?php echo $dados['img_destaque'];?>">
				<div class="destaque-central">
				<wp-expose action="buscarpaginas" motor="Principal" idComp="24" propiedade="conteudo" />
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
	<div class="col-md-12 destaques" style="margin:0;padding:0"></div>
	<p class="clearfix"><br class="clear"></p>
	
	<br><br>
</div>
<?php include "includes/footer.inc.php"; ?>
<script src="js/wp/wp.js"></script>
<script src="js/wp/Motors/Principal.js"></script>

<script>
$(document).ready(function() {
	var a = window.location.pathname.split("/")

	$("wp-expose").attr("idComp",a[2]);


});
</script>
<script src="plugins/featherlight/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>
	
