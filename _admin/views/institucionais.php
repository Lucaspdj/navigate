<?php 
include "includes/header.inc.php";
?>
<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header">Teste<i class="fa fa-fw" aria-hidden="true">&#xf101</i> Criar/Atualizar </h2>
			</div>
			<!-- /.col-lg-12 -->
		</div>
        <div class="panel-body">
				<div class="alert">
					
				</div>
			</div>
            <div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
							
                            <table class="table table-striped table-bordered table-hover" id="GridWP">
                                <tr>
                                    <th> ID </th>
                                    <th> Nome </th>
                                    <th> Titulo </th>
                                    <th> Url </th>
                                    <th> Ativo </th>
                                    <th></th>
                                </tr>
                                <tr>
                                <script id="item-template" type="text/template">
                                    {{#items}}
                                    <td> {{titulo}} </td>
                                    <td> {{conteudo}} </td>
                                    <td> {{usuarioEdicao}} </td>
                                    <td> {{ativo}} </td>
                                    <td> {{status}} </td>
                                    <td> {{idCliente}} </td>
                                    <td> 
                                        <a href="/editar/{{id}}" >Editar |</a>
                                        <a href="/deletar/{{id}}" >Deletar</a>
                                    </td>
                                    {{/items}}
                                </script>
                                </tr>
                            </table>
							</div>
						</div>
						<!-- /.row (nested) -->
					</div>
					<!-- /.panel-body -->
				</div>
				<!-- /.panel -->
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->
	</div>
	<!-- /#page-wrapper -->
<?php include "includes/footer.inc.php"; ?>									
<script src="js/adminwp.js"></script>
<script>
$(document).ready(function(){
        CKEDITOR.replace( 'conteudo' );
});
</script>
</body>
</html>