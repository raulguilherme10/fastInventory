<table class="table table-hover" id="myTable">
		<thead>
			<td>ID</td>
			<td>Nome</td>
			<td>Pavimento</td>
			<td>Status</td>
		</thead>
		<tbody>
			<?php foreach($query->result() as $res){?>
			<tr>
				<td><?php echo $res->loc_id;?></td>
				<td><?php echo $res->loc_nome;?></td>
				<td><?php echo $res->loc_pavimento;?></td>
				<td><?php echo $res->loc_status==1?'Ativado':'Desativado'; ?></td>
			</tr>
			<?php }?>
		</tbody>

	</table>