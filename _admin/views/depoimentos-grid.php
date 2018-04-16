<?php 
include "includes/header.inc.php";
$Depoimentos = new Depoimentos(0);

if(isset($_GET['a'])){
	if(htmlentities($_GET['a']) == "del"){
		if($Depoimentos -> deleteDepoimento(base64_decode(htmlentities($_GET['id']))))
			$core->redirectTo($admin->path."?admin=depoimentos-grid&del=1");
		else
			$core->redirectTo($admin->path."?admin=depoimentos-grid&del=0");
		die();
	}
}

$listDepoimentos = $Depoimentos->listDepoimentos();
?>

	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header">Depoimentos <i class="fa fa-fw" aria-hidden="true" title="Copy to use angle-double-right">&#xf101</i> Gerenciar depoimentos</h2>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		
		<?php
			if(isset($_GET['del'])){
				if($_GET['del']=1){
					$css = "success";
					$msg = "Depoimento apagado com sucesso!";
				}else{
					$css = "danger";
					$msg = "Erro ao apagar Depoimento. Por favor, tente novamente!".$saveImage;
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
					<a href="<?php echo $admin->path."?admin=depoimentos-form";?>" class="btn btn-default"><i class="fa fa-fw" aria-hidden="true" title="Copy to use plus">&#xf067</i> Novo depoimento</a>
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
										<th class="col-sm-5 text-center">Depoimento</th>
										<th class="col-sm-2 text-center">Data de criação</th>
										<th class="col-sm-2 text-center">Ações</th>
									</tr>
								</thead>
								<tbody>
								
								<?php
									if($listDepoimentos){
										while($rows = $listDepoimentos->fetch_assoc()){
											$date = new DateTime($rows['dt_created']);
								?>
									<tr class="odd gradeX">
										<td><?php echo $rows['nome'];?></td>
										<td><?php echo htmlentities($rows['depoimento']);?></td>
										<td><?php echo $date->format('d/m/Y H:i:s'); ?></td>
										<td class="text-center">
											<a href="<?php echo $admin->path."?admin=depoimentos-form&id=".base64_encode($rows['id']);?>" class="btn btn-primary"><i class="fa gear" aria-hidden="true">&#xf013</i> Editar</a>
											<a href="<?php echo $admin->path."?admin=depoimentos-grid&a=del&id=".base64_encode($rows['id']);?>" onclick="return confirm('Deseja excluir o depoimento de: <?php echo htmlentities($rows['nome']);?>');" class="btn btn-danger"><i class="fa fa-fw" aria-hidden="true">&#xf071</i> Excluir</a>
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