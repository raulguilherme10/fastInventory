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
	  	text-align: center;
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
</head>

<body>
	<div id="informacao">
		<table>
			<tr>
				<th width="500" align="left">Data</th>
				<td width="200" align="left"><?php echo date('d/m/Y');?></td>
			</tr>
			<tr>
				<th align="left">Hora</th>
				<td align="left"><?php echo date('H:i:s');?></td>
			</tr>
		</table>
	</div>

	<div class="box">
		<h2>Histórico do Ativo</h2>
	</div>

	<table id="tabela" align="center">
	  
	    <tr>
	      <th>ID</th>
	      <th>Patrimônio</th>
	      <th>Marca</th>
	      <th>Modelo</th>
	      <th>Local</th>
	      <th>Data</th>
	      <th>Hora</th>
	    </tr>
	    <?php foreach($query->result() as $res){?>
		    <tr>
		      	<td><?php echo $res->his_idATV;?></td>
		      	<td><?php echo $res->his_numPatr; ?></td>
	            <td><?php echo $res->pro_marca; ?></td>
	            <td><?php echo $res->pro_modelo; ?></td>
	            <td><?php echo $res->loc_nome; ?></td>
	            <td><?php echo $res->his_data; ?></td>
	            <td><?php echo $res->his_hora; ?></td>
		    </tr>
	    <?php }?>
	  </tbody>
	</table>
</body>

</html>





