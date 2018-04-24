<!DOCTYPE html>
<html lang="pt-br">
    <head>
		<base href="<?php echo $admin->path;?>">
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Navigate Tour - Admin</title>

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="css/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/admin.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <script data-require="mustache.js@0.7.2" data-semver="0.7.2" src="//cdnjs.cloudflare.com/ajax/libs/mustache.js/0.7.2/mustache.js"></script>
		<script src="js/ckeditor/ckeditor.js"></script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="navbar-header">
                    <a href="<?php echo $admin->path;?>?admin=home"><span class="navbar-brand">
					<img src="../img/logo_branco.png" style="height:30px; float:left;">
					<b style=" margin:5px 0 0 20px; display:block;float:left;">Painel administrativo</b></span></a>
                </div>

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
							<li>
                                <a href="#"><i class="fa fa-edit fa-fw"></i> <strong>HP</strong><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="<?php echo $admin->path;?>?admin=hp-banner-form">Criar novo banner</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $admin->path;?>?admin=hp-banner-grid">Gerenciar banners</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $admin->path;?>?admin=hp-publicidade-form">Criar nova publicidade</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $admin->path;?>?admin=hp-publicidade-grid">Gerenciar publicidade</a>
                                    </li>
                                </ul>
							</li>
							<li>
                                <a href="#"><i class="fa fa-edit fa-fw"></i> <strong>Depoimentos</strong><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="<?php echo $admin->path;?>?admin=depoimentos-form">Criar novo depoimento</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $admin->path;?>?admin=depoimentos-grid">Gerenciar depoimentos</a>
                                    </li>
                                </ul>
                            </li>
							<li>
                                <a href="#"><i class="fa fa-edit fa-fw"></i> <strong>Sub-menus</strong><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="<?php echo $admin->path;?>?admin=sub-menu-form">Criar novo sub-menu</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $admin->path;?>?admin=sub-menu-grid">Gerenciar sub-menus</a>
                                    </li>
                                </ul>
                            </li>
							<li>
                                <a href="#"><i class="fa fa-edit fa-fw"></i> <strong>Reservas ON-Line</strong><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="<?php echo $admin->path;?>?admin=reservas-form">Criar nova reserva</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $admin->path;?>?admin=reservas-grid">Gerenciar reservas</a>
                                    </li>
                                </ul>
                            </li>
							<br>
							<?php
								$SiteConfig = new SiteConfig();
								$listSecoes = $SiteConfig->getSecoes();
								foreach($listSecoes as $item){
									if($item['id']<9){
										$linkMenuForm =  $admin->path."?admin=internas-form&secao=".base64_encode($item['id']);
										$linkMenuGrid =  $admin->path."?admin=internas-grid&secao=".base64_encode($item['id']);
							?>
							<li>
                                <a href="#"><i class="fa fa-edit fa-fw"></i> <strong><?php echo $item['secao'];?></strong><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="<?php echo $linkMenuForm;?>">Criar novo</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $linkMenuGrid;?>">Gerenciar conteudo</a>
                                    </li>
                                </ul>
                            </li>
							<?php
									}
									else{
										$linkMenuForm =  $admin->path."?admin=institucionais-form&secao=".base64_encode($item['id']);
										$id = $SiteConfig->findInstitucional(trim($item['id']));
										if(isset($id['id'])) $linkMenuForm = $linkMenuForm."&id=".base64_encode($id['id']);
							?>
							<li>
                                <a href="<?php echo $linkMenuForm;?>"><i class="fa fa-edit fa-fw"></i> <strong><?php echo $item['secao'];?></strong><span class="fa arrow"></span></a>
                            </li>
							<?php
										$linkMenuGrid =  null;
									}
							?>
							
							<?php
								}
							?>
                        </ul>
                    </div>
                </div>
            </nav>