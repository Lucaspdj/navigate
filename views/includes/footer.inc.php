<footer>
	<div class="footer-1">
	<div class="container clearfix">
		<div class="menu_rodape row">
			<div class="col-md-3 col-sm-12">
				<ul>
					<li><a href="">Esportes</a></li>
					<li><a href="">Viagens de Incentivo</a></li>
					<li><a href="">Intercâmbio</a></li>
					<li><a href="">Viagens Especiais</a></li>
					<li><a href="">Aluguel de Carros</a></li>
					<li><a href="">Hotéis</a></li>
					<li><a href="">Cruzeiros Marítimos</a></li>
				</ul>
			</div>
			<div class="col-md-3 col-sm-12">
				<ul>
					<li><a href="">Parceiros</a></li>
					<li><a href="">Institucional</a></li>
					<li><a href="">Entre em contato</a></li>
					<li><a href="">Formulários</a></li>
					<li><a href="">Direitos do Consumidor</a></li>
					<li><a href="">Política de Privacidade</a></li>
				</ul>
			</div>
			<div class="col-md-3 col-sm-12">
				<div><strong>Redes Sociais</strong></div>
				<div>
				<p class="text-left"><br>
					<a target="_blank" href="<?php if(isset($dadosSite['redes_facebook'])) echo $dadosSite['redes_facebook'];?>"><img src="img/icons/rodape_facebook.png" alt="Facebook"></a>
					<a target="_blank" href="<?php if(isset($dadosSite['redes_twitter'])) echo $dadosSite['redes_twitter'];?>"><img src="img/icons/rodape_twitter.png" alt="Twitter"></a>
					<a target="_blank" href="<?php if(isset($dadosSite['redes_google_plus'])) echo $dadosSite['redes_google_plus'];?>"><img src="img/icons/rodape_google_plus.png" alt="Google+"></a>
					<a target="_blank" href="<?php if(isset($dadosSite['redes_instagram'])) echo $dadosSite['redes_instagram'];?>"><img src="img/icons/rodape_instagram.png" alt="Instagram"></a>
				</p></div>
				<br>
				<div><strong>Newsletter</strong></div>
				<div>
					<form method="GET" action="/newsletter" id="form_newsletter">
						<fieldset class="noMargin">
							<input placeholder="Digite seu email" type="email" id="newsletter_email" name="newsletter_email" maxlength="250"> <input type="image" src="img/icons/bt_newsletter.png" alt="Newsletter">
						</fieldset>
					</form>
				</div>
			</div>
			<div class="col-md-3 col-sm-12">
				<div><strong>Desenvolvimento</strong></div>
				<div>
				<p class="text-left"><br>
					<a target="_blank" href="https://www.ecelera.com.br" title="Ecelera | Marketing Digital de Alta Performance"><img src="img/logo_ecelera.png" alt="Ecelera"></a>
				</p></div>
				<br>
			</div>
		</div>
	</div>
	</div>
	
	<div class="footer-2">
	<div class="container clearfix">
		<div class="menu_rodape row">
			<div class="col-md-8 col-sm-12">
				<div class="float-left"> <?php if(isset($dadosSite['redes_facebook'])) echo nl2br($dadosSite['contatos_endereco']);?> </div>
			</div>
			<div class="col-md-4 col-sm-12">
				<div class="float-right"><br>&copy; COPYRIGHT <?php echo date('Y');?> - NAVIGATE TOUR</div>
			</div>
		</div>
	</div>
	</div>
</footer>
<script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<script src="js/vendor/jquery-1.11.2.min.js"></script>
<script src="js/vendor/bootstrap.min.js"></script>
<script src="js/vendor/docs.min.js"></script>
<script src="js/vendor/ie10-viewport-bug-workaround.js"></script>
<script src="js/jssor.slider.min.js"></script>

<script src="js/main.js"></script>

	<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. 
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
		-->
