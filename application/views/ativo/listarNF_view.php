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
		<a href="#" class="btn btn-success btn-lg"  data-placement="bottom" title="Cadastrar Nota Fiscal" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus"></i></a>
	</div>
</div>


<div class="row tablist">
	<table class="table table-hover dt-responsive nowrap" cellspacing="0" id="myTable">
		<thead>
			<td>CNPJ</td>
			<td>Nome</td>
			<td>Número da Nota</td>
			<td>Status</td>
			<td></td>
		</thead>
		<tbody>
		<?php foreach($query->result() as $res){?>
			<tr>
				<td><?php echo $res->ntf_cnpjEmp; ?></td>
				<td><?php echo ellipsize($res->emp_nomeFantasia, 15); ?></td>
				<td><?php echo ellipsize($res->ntf_numNota, 12); ?></td>
				<td><?php echo $res->ntf_status==1?'Ativo':'Inativo'; ?></td>
				<td>
					<a href="<?php echo base_url('ativo/atualizarNF/'.$res->ntf_id.'/'.$res->ntf_cnpjEmp);?>" class="btn btn-info btn-group" data-toggle="tooltip" data-placement="bottom" title="Editar"><i class="glyphicon glyphicon-pencil"></i></a>
					<a href="<?php echo base_url('ativo/excluirNF/'.$res->ntf_id);?>" class="btn btn-danger btn-group"  onclick="return confirm('Deseja realmente excluir a Nota Fiscal?');" data-toggle="tooltip" data-placement="bottom" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a>
					<a href="<?php echo base_url('ativo/trocarStatusNF/'.$res->ntf_id.'/'.$res->ntf_cnpjEmp);?>" class="btn btn btn-default btn-group"  onclick="return confirm('Deseja trocar o status da Nota Fiscal?');" data-toggle="tooltip" data-placement="bottom" title="Trocar Status"><i class="glyphicon glyphicon-edit"></i></a>
					<a href="<?php echo base_url('ativo/carregarItem/'.$res->ntf_id.'/'.$res->ntf_cnpjEmp);?>" class="btn btn-warning btn-group" data-toggle="tooltip" data-placement="bottom" title="Adicionar Item"><i class="glyphicon glyphicon-gift"></i></a>
				</td>	
			</tr>
		<?php }?>
		</tbody>

	</table>
</div>



<!-- Inicio Modal Cadastrar NF-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
  	<form action="<?php echo base_url('ativo/cadastrarNF'); ?>" method="post">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cadastrar Nota Fiscal</h4>
      </div>
      <div class="modal-body">

	
		<div class="form-group">
	        <label class="control-label" for="empresa">Empresa</label>
	        <select name="empresa" id="empresa" class="form-control" autofocus required>
	            <?php foreach($empresa->result() as $res) {?>
	              <option value="<?php echo $res->emp_cnpj; ?>"><?php echo $res->emp_nomeFantasia;?></option>
	            <?php } ?>
	        </select>
    	</div>
	
		<div class="row">
			<div class="col-md-9">
				<div class="form-group">
			        <label class="control-label" for="numNota">Número da nota</label>
			        <input class="form-control" name="numNota" id="numNota" placeholder="Digite o número da nota fiscal." type="text" required>
	    		</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
			        <label class="control-label" for="serie">Série</label>
			        <input class="form-control" name="serie" id="serie" placeholder="Série." type="number">
	    		</div>
			</div>
		</div>
    
	    <div class="form-group">
	        <label class="control-label" for="natureza">Natureza da operação</label>
	        <textarea class="form-control" name="natureza" id="natureza" placeholder="Digite a natureza da operação." type="text" rows="3"></textarea>
	    </div>

	    <div class="row">
	    	<div class="col-md-4">
	    		<div class="form-group">
	        		<label class="control-label" for="total">Total</label>
	        		<input class="form-control" name="total" id="total" placeholder="Total da nota fiscal." type="text">
	    		</div>
	    	</div>
	    	<div class="col-md-4">
	    		<div class="form-group">
			        <label class="control-label" for="dataEmissao">Data de Emissão</label>
			        <input class="form-control" name="dataEmissao" id="dataEmissao" placeholder="Data de emissão." type="text">
	    		</div>
	    	</div>
	    	<div class="col-md-4">
	    		<div class="form-group">
			        <label class="control-label" for="dataVencimento">Data de Vencimento</label>
			        <input class="form-control" name="dataVencimento" id="dataVencimento" placeholder="Data de vencimento." type="text">
	    		</div>
	    	</div>
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
<!-- Fim Modal Cadastrar NF-->






<!-- Inicio Modal Cadastrar NF-->
<div class="modal fade" id="item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
  	<form action="<?php echo base_url('ativo/cadastrarNF'); ?>" method="post">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Adicionar Item</h4>
      </div>
      <div class="modal-body">

	
		<div class="form-group">
	        <label class="control-label" for="empresa">Empresa</label>
	        <select name="empresa" id="empresa" class="form-control" autofocus required>
	            <?php foreach($empresa->result() as $res) {?>
	              <option value="<?php echo $res->emp_cnpj; ?>"><?php echo $res->emp_nomeFantasia;?></option>
	            <?php } ?>
	        </select>
    	</div>
	
		<div class="row">
			<div class="col-md-9">
				<div class="form-group">
			        <label class="control-label" for="numNota">Número da nota</label>
			        <input class="form-control" name="numNota" id="numNota" placeholder="Digite o número da nota fiscal." type="text" required>
	    		</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
			        <label class="control-label" for="serie">Série</label>
			        <input class="form-control" name="serie" id="serie" placeholder="Série." type="number">
	    		</div>
			</div>
		</div>
    
	    <div class="form-group">
	        <label class="control-label" for="natureza">Natureza da operação</label>
	        <textarea class="form-control" name="natureza" id="natureza" placeholder="Digite a natureza da operação." type="text" rows="3"></textarea>
	    </div>

	    <div class="row">
	    	<div class="col-md-4">
	    		<div class="form-group">
	        		<label class="control-label" for="total">Total</label>
	        		<input class="form-control" name="total" id="total" placeholder="Total da nota fiscal." type="text">
	    		</div>
	    	</div>
	    	<div class="col-md-4">
	    		<div class="form-group">
			        <label class="control-label" for="dataEmissao">Data de Emissão</label>
			        <input class="form-control" name="dataEmissao" id="dataEmissao" placeholder="Data de emissão." type="text">
	    		</div>
	    	</div>
	    	<div class="col-md-4">
	    		<div class="form-group">
			        <label class="control-label" for="dataVencimento">Data de Vencimento</label>
			        <input class="form-control" name="dataVencimento" id="dataVencimento" placeholder="Data de vencimento." type="text">
	    		</div>
	    	</div>
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
<!-- Fim Modal Cadastrar NF-->
