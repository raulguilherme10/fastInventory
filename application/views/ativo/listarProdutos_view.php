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
		<a href="#" class="btn btn-success btn-lg"  data-placement="bottom" title="Cadastrar Produto" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus"></i></a>
	</div>
</div>


<div class="row tablist">
	<table class="table table-hover" id="myTable">
		<thead>
			<td>Marca</td>
			<td>Tipo</td>
			<td>Status</td>
			<td></td>
		</thead>
		<tbody>
			<?php foreach($query->result() as $res){?>
			<tr>
				<td><?php echo $res->pro_marca;?></td>
				<td><?php echo $res->tip_nome; ?></td>
				<td><?php echo $res->pro_status==1?'Ativado':'Desativado'; ?></td>
				<td>
					<a  href="<?php echo base_url('ativo/atualizarProduto/'.$res->pro_id);?>" class="btn btn-info btn-group" data-toggle="tooltip" data-placement="bottom" title="Editar"><i class="glyphicon glyphicon-pencil"></i></a>
					<a  href="<?php echo base_url('ativo/trocarStatusProduto/'.$res->pro_id);?>" class="btn btn btn-default btn-group"  onclick="return confirm('Deseja trocar o status da empresa?');" data-toggle="tooltip" data-placement="bottom" title="Trocar Status"><i class="glyphicon glyphicon-edit"></i></a>
				</td>	
			</tr>
			<?php }?>
		</tbody>

	</table>
</div>



<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
  	<form action="<?php echo base_url('ativo/cadastrarProduto'); ?>" method="post">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cadastrar Produto</h4>
      </div>
      <div class="modal-body">

		<div class="form-group">
	        <label class="control-label" for="tipo">Tipo</label>
	        <select name="tipo" id="tipo" class="form-control" autofocus>
	            <?php foreach($tipos->result() as $res) { ?>
	              <option value="<?php echo $res->tip_id; ?>"><?php echo $res->tip_nome;?></option>
	            <?php } ?>
	        </select>
    	</div>

	    <div class="form-group">
	        <label class="control-label" for="marca">Marca</label>
	        <input class="form-control" name="marca" id="marca" placeholder="Digite a marca do produto."  type="text" required>
	    </div>

	    <div class="form-group">
	        <label class="control-label" for="cor">Cor</label>
	        <input class="form-control" name="cor" id="cor" placeholder="Digite a cor principal do produto." type="text">
	    </div>

	    <div class="form-group">
	        <label class="control-label" for="descricao">Descrição</label>
	        <textarea class="form-control" name="descricao" id="descricao" placeholder="Digite a descrição do produto." type="text" required rows="3"></textarea>
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