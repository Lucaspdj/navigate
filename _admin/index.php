<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

session_start();
header('X-UA-Compatible: IE=edge,chrome=1');
header('Content-Type: text/html; charset=UTF-8');
date_default_timezone_set('America/Sao_Paulo');

if ($_POST) {
    $_POST = array_map('filter_var', $_POST);
}
require_once ('../class/Conn.class.php');
require_once ('../class/Core.class.php');
require_once ('../class/Admin.class.php');
require_once ('../class/HP.class.php');
require_once ('../class/Depoimentos.class.php');
require_once ('../class/SiteConfig.class.php');
require_once ('../class/ReservasOnline.class.php');
require_once ('../class/Conteudo.class.php');
require_once ('../class/PHPMailer/class.phpmailer.php');
require_once ('../class/UploadImage.class.php');
require_once ('../class/UploadFile.class.php');

$core = new Core("mysql05-farm62.kinghost.net", "navigatetour", "HB4tULpDIoJfhn3T", "navigatetour", "3306");
#$core = new Core("localhost", "root", "", "navigatetour", "3306");
$core->set_charset("utf8");

$admin = new Admin();
$admin->path = "/_admin/";
// MONTA A PAGINA
$acao = null;
if($core->exist($_GET['admin'])){
	$acao = strip_tags(addslashes($_GET['admin']));
}
include_once ("views/" . $admin->setView($acao));

// FECHA CONEXAO E VARIAVEIS
unset($core);
unset($admin);
unset($conn);
?>