<?php 
include "includes/header.inc.php";
$Conteudo= new Conteudo(0);
$SiteConfig = new SiteConfig();
$secaoValues = $SiteConfig->getSecao(base64_decode($_GET['secao']));

if(isset($_GET['a'])){
	if(htmlentities($_GET['a']) == "del"){
		if($Conteudo -> deleteConteudo(base64_decode(htmlentities($_GET['id']))))
			$core->redirectTo($admin->path."?admin=internas-grid&secao=".$_GET['secao']."&del=1");
		else
			$core->redirectTo($admin->path."?admin=internas-grid&secao=".$_GET['secao']."&del=0");
		die();
	}
}

$listConteudos = $Conteudo->listAll(base64_decode($_GET['secao']));

?>

	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header"><?php echo $secaoValues['secao'];?> <i class="fa fa-fw" aria-hidden="true">&#xf101</i> Gerenciar conteúdo</h2>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		
		<?php
			if(isset($_GET['del'])){
				if($_GET['del']=1){
					$css = "success";
					$msg = "{$secaoValues['secao']} apagada com sucesso!";
				}else{
					$css = "danger";
					$msg = "Erro ao apagar {$secaoValues['secao']}. Por favor, tente novamente!".$saveImage;
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
					<a href="<?php echo $admin->path."?admin=internas-form";?>" class="btn btn-default"><i class="fa fa-fw" aria-hidden="true">&#xf067</i> Novo conteúdo</a>
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
										<th class="col-sm-4 text-center">Título</th>
										<th class="col-sm-4 text-center">Período</th>
										<th class="col-sm-2 text-center">Data de criação</th>
										<th class="col-sm-2 text-center">Ações</th>
									</tr>
								</thead>
								<tbody>	
								
								<?php
									if($listConteudos){
										while($rows = $listConteudos->fetch_assoc()){
											$dt_created = new DateTime($rows['dt_created']);
											$periodo_inicio = (empty($rows['periodo_inicio'])) ? null : new DateTime($rows['periodo_inicio']);
											$periodo_fim = (empty($rows['periodo_fim'])) ? null : new DateTime($rows['periodo_fim']);
								?>
									<tr class="odd gradeX">
										<td><?php echo $rows['titulo'];?></td>
										<td><?php
											if($periodo_inicio) echo $periodo_inicio->format('d/m/Y');
										?> à
										<?php
											if($periodo_fim) echo $periodo_fim->format('d/m/Y');
										?></td>
										<td><?php echo $dt_created->format('d/m/Y H:i:s'); ?></td>
										<td class="text-center">
											<a href="<?php echo $admin->path."?admin=internas-form&secao=".$_GET['secao']."&id=".base64_encode($rows['id']);?>" class="btn btn-primary"><i class="fa gear" aria-hidden="true">&#xf013</i> Editar</a>
											<a href="<?php echo $admin->path."?admin=internas-grid&secao=".$_GET['secao']."&a=del&id=".base64_encode($rows['id']);?>" onclick="return confirm('Deseja excluir: <?php echo htmlentities($rows['titulo']);?>');" class="btn btn-danger"><i class="fa fa-fw" aria-hidden="true">&#xf071</i> Excluir</a>
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