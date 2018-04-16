<?php 
include "includes/header.inc.php";
$HP = new HP(0);

if(isset($_GET['a'])){
	if(htmlentities($_GET['a']) == "del"){
		if($HP -> deleteBanner(base64_decode(htmlentities($_GET['id']))))
			$core->redirectTo($admin->path."?admin=hp-banner-grid&del=1");
		else
			$core->redirectTo($admin->path."?admin=hp-banner-grid&del=0");
		die();
	}
}

$listBanners = $HP->listBanners();
?>

	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header">HP <i class="fa fa-fw" aria-hidden="true">&#xf101</i> Banner <i class="fa fa-fw" aria-hidden="true" title="Copy to use angle-double-right">&#xf101</i> Gerenciar banners</h2>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		
		<?php
			if(isset($_GET['del'])){
				if($_GET['del']=1){
					$css = "success";
					$msg = "Banner apagado com sucesso!";
				}else{
					$css = "danger";
					$msg = "Erro ao apagar banner. Por favor, tente novamente!".$saveImage;
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
					<a href="<?php echo $admin->path."?admin=hp-banner-form";?>" class="btn btn-default"><i class="fa fa-fw" aria-hidden="true" title="Copy to use plus">&#xf067</i> Novo banner</a>
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
										<th class="col-sm-4 text-center">Nome</th>
										<th class="col-sm-4 text-center">URL</th>
										<th class="col-sm-2 text-center">Data de criação</th>
										<th class="col-sm-2 text-center">Ações</th>
									</tr>
								</thead>
								<tbody>	
								
								<?php
									if($listBanners){
										while($rows = $listBanners->fetch_assoc()){
											$date = new DateTime($rows['dt_created']);
								?>
									<tr class="odd gradeX">
										<td><?php echo $rows['titulo'];?></td>
										<td><?php echo $rows['url'];?></td>
										<td><?php echo $date->format('d/m/Y H:i:s'); ?></td>
										<td class="text-center">
											<a href="<?php echo $admin->path."?admin=hp-banner-form&id=".base64_encode($rows['id']);?>" class="btn btn-primary"><i class="fa gear" aria-hidden="true">&#xf013</i> Editar</a>
											<a href="<?php echo $admin->path."?admin=hp-banner-grid&a=del&id=".base64_encode($rows['id']);?>" onclick="return confirm('Deseja excluir o banner: <?php echo htmlentities($rows['titulo']);?>');" class="btn btn-danger"><i class="fa fa-fw" aria-hidden="true">&#xf071</i> Excluir</a>
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