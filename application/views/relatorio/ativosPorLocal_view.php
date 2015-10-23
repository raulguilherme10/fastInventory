<div class="row">
	<div class="col-md-10">
		<!-- Inicio formulario de pesquisar-->
			<form action="" action="get">

				<label for="status">Pesquisar Local:</label>
		        <select name="status" id="status">
		        	<?php foreach($combobox->result() as $res) {?>
		          		<option value="<?php echo $res->loc_id; ?>"><?php echo $res->loc_nome; ?></option>
		          	<?php } ?>
		        </select>

		        <button type="submit" class="btn btn-warning"><i class="glyphicon glyphicon-search"></i></button>

			</form>
		<!-- Fim formulario de pesquisar-->
	</div>

	<div class="col-md-2">
		<a href="#" class="btn btn-success btn-block btn-lg" data-toggle="tooltip" data-placement="bottom" title="Gerar Relatório"><i class="glyphicon glyphicon-list-alt"></i></a>
	</div>
</div>


<div class="row tablist">
	<table class="table table-hover dt-responsive nowrap" cellspacing="0" id="myTable">
		<thead>
			<td>ID</td>
			<td>Nome</td>
			<td>Pavimento</td>
			<td>Status</td>
		</thead>
		<tbody>

		</tbody>

	</table>
</div>