<?php 
include "includes/header.inc.php";
$SiteConfig = new SiteConfig();
$menuValues = $SiteConfig->getSecao(base64_decode($_GET['secao']));

if(isset($_GET['a'])){
	if(htmlentities($_GET['a']) == "del"){
		if($SiteConfig -> deleteSubMenu(base64_decode(htmlentities($_GET['id']))))
			$core->redirectTo($admin->path."?admin=sub-menu-grid&del=1");
		else
			$core->redirectTo($admin->path."?admin=sub-menu-grid&del=0");
		die();
	}
}

$listMenus = $SiteConfig->listAllSubMenu();
?>

	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header">Sub-menu <i class="fa fa-fw" aria-hidden="true">&#xf101</i> Gerenciar menus</h2>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		
		<?php
			if(isset($_GET['del'])){
				if($_GET['del']=1){
					$css = "success";
					$msg = "Sub-menu apagado com sucesso!";
				}else{
					$css = "danger";
					$msg = "Erro ao apagar Sub-menu. Por favor, tente novamente!".$saveImage;
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
				<p class="text-right">
					<a href="<?php echo $admin->path."?admin=sub-menu-form";?>" class="btn btn-default"><i class="fa fa-fw" aria-hidden="true" title="Copy to use plus">&#xf067</i> Novo sub-menu</a>
				</p>
				<div class="panel panel-default">
					<div class="panel-heading">
						
					</div>
					<!-- /.panel-heading -->
					<div class="panel-body">
						<div class="dataTable_wrapper">
							<table class="table table-striped table-bordered" id="dataTables-table">
								<thead>
									<tr>
										<th class="col-sm-3 text-center">Nome</th>
										<th class="col-sm-5 text-center">Menu Principal</th>
										<th class="col-sm-2 text-center">Data de criação</th>
										<th class="col-sm-2 text-center">Ações</th>
									</tr>
								</thead>
								<tbody>
								
								<?php
									if($listMenus){
										while($rows = $listMenus->fetch_assoc()){
											$date = new DateTime($rows['dt_created']);
								?>
									<tr class="odd gradeX">
										<td><?php echo $rows['categoria'];?></td>
										<td><?php echo htmlentities($rows['secao']);?></td>
										<td><?php echo $date->format('d/m/Y H:i:s'); ?></td>
										<td class="text-center">
											<a href="<?php echo $admin->path."?admin=sub-menu-form&id=".base64_encode($rows['id']);?>" class="btn btn-primary"><i class="fa gear" aria-hidden="true">&#xf013</i> Editar</a>
											<a href="<?php echo $admin->path."?admin=sub-menu-grid&a=del&id=".base64_encode($rows['id']);?>" onclick="return confirm('Deseja excluir o menu de: <?php echo htmlentities($rows['categoria']);?>');" class="btn btn-danger"><i class="fa fa-fw" aria-hidden="true">&#xf071</i> Excluir</a>
										</td>
									</tr>
								<?php
										}
									}
								?>
									
								</tbody>
							</table>
						</div>
					</div>
					<!-- /.panel-body -->
				</div>
				<!-- /.panel -->
			</div>
			<!-- /.col-lg-12 -->
		</div>
		
		
	</div>
	<!-- /#page-wrapper -->


<?php include "includes/footer.inc.php"; ?>
	
	<script>
		$(document).ready(function() {
			$('#dataTables-table').DataTable({
				responsive: true,
				"order": [[ 2, "desc" ]]
			});
		});
	</script>
    </body>
</html>