<?php 
    if($this->session->flashdata('ok')){
    ?>
        <div class="alert alert-success" role="alert">
            <?php echo $this->session->flashdata('ok')?>
        </div>
    <?php
    }else{
    	if($this->session->flashdata('erro')){
    	?>
	        <div class="alert alert-danger" role="alert">
	            <?php echo $this->session->flashdata('erro')?>
	        </div>
    	<?php
    	}else{
    		if(validation_errors() != NULL){
            ?>
	            <div class="alert alert-danger" role="alert">
	                <?php echo validation_errors(); ?>
	            </div>
            <?php
        	}
    	}
    }
?>



<div class="row">
	<div class="col-md-10">
		
	</div>

	<div class="col-md-2">
		<a href="#" class="btn btn-success btn-lg"  data-placement="bottom" title="Cadastrar Empresa" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus"></i></a>
	</div>
</div>


<div class="row tablist">
	<table class="table table-hover dt-responsive nowrap" cellspacing="0" id="myTable">
		<thead>
			<td>ID</td>
			<td>Local</td>
			<td>Data</td>
			<td>Hora</td>
			<td></td>
		</thead>
		<tbody>
			<?php foreach($query->result() as $res){?>
			<tr>
				<td><?php echo $res->fis_id;?></td>
				<td><?php echo $res->loc_nome;?></td>
				<td><?php echo $res->fis_data;?></td>
				<td><?php echo $res->fis_hora;?></td>
				<td><a href="<?php echo base_url('teste/carregarItem/'.$res->fis_id);?>" class="btn btn-warning btn-group" data-toggle="tooltip" data-placement="bottom" title="Adicionar Item"><i class="glyphicon glyphicon-gift"></i></a></td>
			</tr>
			<?php }?>
		</tbody>

	</table>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <form action="<?php echo base_url('teste/cadastrarInventario'); ?>" method="post">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cadastrar Inventário</h4>
      </div>
      <div class="modal-body">

        <div class="form-group">
	        <label class="control-label" for="local">Local</label>
	        <select name="local" id="local" class="form-control" autofocus required>
	            <?php foreach($local->result() as $res) {?>
	              <option value="<?php echo $res->loc_id; ?>"><?php echo $res->loc_nome;?></option>
	            <?php } ?>
	        </select>
	     </div>

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Salvar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div>

    </form>
  </div>
</div>
