<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
	  #tabela{
	  	margin-top: 30px;
	  }
	  #tabela th {
	    background-color: rgb(148, 22, 17);
	    color: white;
	    font-weight: normal;
	    padding: 10px 10px;
	    text-align: center;
	    border: 1px solid black;
	  }
	  #tabela td {
	    background-color: rgb(238, 238, 238);
	    color: rgb(111, 111, 111);
	    padding: 10px 10px;
	    border: 1px solid black;
	  }
	  .box{
	  	margin-top: 30px;
	  }
	  #informacao{
	  	background-color: rgb(238, 238, 238);
	  }
	 
	  #informacao table th{
		border: 1px solid black;
	  }	

	   #informacao table td{
		border: 1px solid black;
	  } 
		
	</style>
	  }
</head>

<body>
	<div id="informacao">
		<table>
			<tr>
				<th width="500" align="left">Data da realização do inventário</th>
				<td width="200" align="left"><?php echo $fiscalizar[0]->fis_data;?></td>
			</tr>
			<tr>
				<th align="left">Hora da realização do inventário</th>
				<td align="left"><?php echo $fiscalizar[0]->fis_hora;?></td>
			</tr>
			<tr>
				<th align="left">Local</th>
				<td align="left">
					<?php 
						foreach ($local->result() as $key) {
							if($key->loc_id == $fiscalizar[0]->fis_local){
								echo $key->loc_nome;
							}
						}
					?>
				</td>
			</tr>
			<tr>
				<th align="left">Total de ativos encontrados</th>
				<td align="left">
					<?php 
						$total = count($totalEncontrado);
						echo $total;
					?>
				</td>
			</tr>
			<tr>
				<th align="left">Toral de ativos em local errado</th>
				<td align="left">
					<?php 
						$total = count($localErrado);
						echo $total;
					?>
				</td>
			</tr>
			<tr>
				<th align="left">Toral de ativos não encontrado</th>
				<td align="left">
					<?php 
						$total = count($ativoPerdido);
						echo $total;
					?>
				</td>
			</tr>
		</table>
	</div>

	<div class="box">
		<h2 align="center">Relatório de Divergência</h2>
	</div>

	<div class="box">
		<h3>Ativos Encontrados</h3>

		<table id="tabela" align="center">	  
		    <tr>
		      <th>ID</th>
		      <th>Patrimônio</th>
		   	  <th>Tipo</th>
		      <th>Marca</th>
		      <th>Modelo</th>
		    </tr>
		    <?php foreach($query->result() as $res){?>
		    <tr>
		      	<td><?php echo $res->div_idATV;?></td>
		      	<td><?php echo $res->atv_numPatr; ?></td>
		      	<td>
		      		<?php
		      			foreach($tipo->result() as $tip){
	   						if($tip->tip_id == $res->pro_idTipo){
	   							echo $tip->tip_nome;
	   						}
			   			}
		      		?>
		      	</td>
		        <td><?php echo $res->pro_marca; ?></td>
		        <td><?php echo $res->pro_modelo; ?></td>
		    </tr>
		    <?php }?>
		</table>
	</div>


</body>

</html>





