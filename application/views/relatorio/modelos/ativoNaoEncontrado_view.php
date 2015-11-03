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
		  }
		  #tabela td {
		    background-color: rgb(238, 238, 238);
		    color: rgb(111, 111, 111);
		    padding: 10px 10px;
		  }
		  #box{
		  	margin-top: 30px;
		  }
		
	</style>
</head>
<body>
	<div id="box">
		<h3>Ativos não Encontrados no Local</h3>

		<table id="tabela" align="center">	  
		    <tr>
		      <th>ID</th>
		      <th>Patrimônio</th>
		   	  <th>Tipo</th>
		      <th>Marca</th>
		      <th>Modelo</th>
		    </tr>
		   	
		   	<?php
		   		$quantidade = count($ativoPerdido);
		   		foreach ($ativo->result() as $res) { ?>
		   		<tr>
		   			<?php
			   			for($i = 0; $i < $quantidade; $i++){
			   				if($res->atv_id == $ativoPerdido[$i]){
			   					echo '<td>'.$res->atv_id.'</td>';
			   					echo '<td>'.$res->atv_numPatr.'</td>';
			   					foreach($tipo->result() as $tip){
			   						if($tip->tip_id == $res->pro_idTipo){
			   							echo '<td>'.$tip->tip_nome.'</td>';
			   						}
			   					}
			   					echo '<td>'.$res->pro_marca.'</td>';
			   					echo '<td>'.$res->pro_modelo.'</td>';
			   				}
			   			}
		   			?>
		   		</tr>
		   		<?php }?>
		</table>
	</div>

	<div id="box">
		<p>*Observação: O ativo não encontrado no local, teve seu status alterado para INATIVO</p>
	</div>
</body>
</html>