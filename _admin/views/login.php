<?php 
unset($_SESSION['login_admin']);
if($_POST){
	$login = $admin->login($_POST['email'], $_POST['password']);
	if($login === true){
		$_SESSION['login_admin'] = 'OK';
		$admin->go("home");
	}
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
		<base href="<?php echo $admin->path;?>">
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Navigate Tour - Admin</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/metisMenu.min.css" rel="stylesheet">
        <link href="css/startmin.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <div id="wrapper">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-md-offset-4">
						<div class="login-panel panel panel-default">
							<p class=" center-block text-center">
								<img src="img/logo.png" alt="Navigate">
							</p>
							<div class="panel-heading">
								<h3 class="panel-title text-center">Entre com seu usuário e senha</h3>
							</div>
							<div class="panel-body">
								<form role="form" method="post" action="">
									<fieldset>
										<div class="form-group">
											<input required class="form-control" placeholder="E-mail" name="email" type="text" autofocus>
										</div>
										<div class="form-group">
											<input required class="form-control" placeholder="Senha" name="password" type="password" value="">
										</div>
										<!-- 
										<div class="checkbox">
											<label>
												<input name="remember" type="checkbox" value="Remember Me">Remember Me
											</label>
										</div>-->
										<button class="btn btn-lg btn-success btn-block">Entrar</button>
									</fieldset>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>

<?php include "includes/footer.inc.php"; ?>

    </body>
</html>