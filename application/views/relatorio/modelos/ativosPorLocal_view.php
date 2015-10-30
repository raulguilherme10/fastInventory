<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		  
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
		
	</style>
</head>

<body>
	<div>
		<b>Data: <?php echo date('d/m/Y');?></b><br />
		<b>Hora: <?php echo date('H:i:s');?></b><br />
		<b>Local: <?php echo $local[0]->loc_nome;?></b><br />

	</div>

	<div>
		<h2 align="center">Ativos por Local</h2>
	</div>

	<table id="tabela" align="center">
	  
	    <tr>
	      <th>ID</th>
	      <th>Patrimônio</th>
	      <th>Marca</th>
	      <th>Modelo</th>
	      <th>Data</th>
	      <th>Hora</th>
	    </tr>
	    <?php foreach($query->result() as $res){?>
		    <tr>
		      	<td><?php echo $res->atv_id;?></td>
		      	<td><?php echo $res->atv_numPatr; ?></td>
	            <td><?php echo $res->pro_marca; ?></td>
	            <td><?php echo $res->pro_modelo; ?></td>
	            <td><?php echo $res->atv_data; ?></td>
	            <td><?php echo $res->atv_hora; ?></td>
		    </tr>
	    <?php }?>
	  </tbody>
	</table>
</body>

</html>





