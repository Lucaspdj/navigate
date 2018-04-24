
	<header class="container clearfix">
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-4">
				<h1 class="noMargin noPadding">
					<a href="/home"><span class="hidden">Navigatetour - Viagens e Turismo</span> <img src="img/logo.png" alt="Navigatetour"></a>
				</h1>
			</div>
			<div class="col-lg-5 col-md-5 col-sm-4">
				<ul class="menu_top">
					<li><a href="/institucional/24">A empresa</a></li>
					<li><a href="/institucional/25">Entre em contato</a></li>
					<li><a href="/institucional/27">Localização</a></li>
				</ul>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-4">
				<form method="POST" action="/busca" id="form_busca">
					<fieldset class="noMargin">
						<input placeholder="Pesquisar no site" type="text" id="s" name="s" maxlength="150"> <input type="image" src="img/icons/bt_submit.png" alt="Pesquisar" id="submit_busca" name="submit_busca">
					</fieldset>
				</form>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-4 telefone">
				<span class="noMargin">Atendimento</span>
				<p class="noMargin"><small>+55 <?php if(isset($dadosSite['contatos_ddd'])) echo $dadosSite['contatos_ddd'];?></small> <?php if(isset($dadosSite['contatos_fone'])) echo $dadosSite['contatos_fone'];?></p>
			</div>
		</div>
	</header>

	<nav class="navbar noMargin noPadding navbar-static-top">
		<div class="container">
			<div class="navbar-header noMargin noPadding">
				<button type="button" style="float: left;" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
					<span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
				</button>
			</div>

			<div class="collapse navbar-toggleable-md navbar-collapse navbar-left" id="menu">
				<ul class="nav navbar-nav">
					<li><a href="/">Esportes</a></li>
					<li><a href="/">Viagem de Incentivo</a></li>
					<li><a href="/">Intercâmbio</a></li>
					<li><a href="/">Viagens Especiais</a></li>
					<li><a href="/">Aluguel de Carros</a></li>
					<li><a href="/">Hotéis</a></li>
					<li><a href="/">Cruzeiros Marítimos</a></li>
					<li><a href="/">Parceiros</a></li>
				</ul>
			</div>

		</div>
	</nav>
	