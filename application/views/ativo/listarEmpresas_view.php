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
	<table class="table table-hover" id="myTable">
		<thead>
			<td>CNPJ</td>
			<td>Nome Fantasia</td>
			<td>Status</td>
			<td></td>
		</thead>
		<tbody>
			<?php foreach($query->result() as $res){?>
			<tr>
				<td><?php echo $res->emp_cnpj;?></td>
				<td><?php echo ellipsize($res->emp_nomeFantasia, 21) ;?></td>
				<td><?php echo $res->emp_status==1?'Ativado':'Desativado'; ?></td>
				<td>
					<a href="<?php echo base_url('ativo/atualizarEmpresa/'.$res->emp_cnpj);?>" class="btn btn-info btn-group" data-toggle="tooltip" data-placement="bottom" title="Editar"><i class="glyphicon glyphicon-pencil"></i></a>
					<a href="<?php echo base_url('ativo/trocarStatusEmpresa/'.$res->emp_cnpj);?>" class="btn btn btn-default btn-group"  onclick="return confirm('Deseja trocar o status da empresa?');" data-toggle="tooltip" data-placement="bottom" title="Trocar Status"><i class="glyphicon glyphicon-edit"></i></a>
			</tr>
			<?php }?>
		</tbody>

	</table>
</div>



<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
  	<form action="<?php echo base_url('ativo/cadastrarEmpresa'); ?>" method="post">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cadastrar Empresa</h4>
      </div>
      <div class="modal-body">

		

		    <div class="form-group">
		        <label class="control-label" for="cnpj">CNPJ</label>
		        <input class="form-control" name="cnpj" id="cnpj" placeholder="Digite o cnpj da empresa" autofocus type="text" required />
		    </div>

		    <div class="form-group">
		        <label class="control-label" for="ie">Inscrição Estadual</label>
		        <input class="form-control" name="ie" id="ie" placeholder="Digite a inscrição estadual da empresa" type="text"/>
		    </div>

		    <div class="form-group">
		        <label class="control-label" for="nf">Nome Fantasia</label>
		        <input class="form-control" name="nf" id="nf" placeholder="Digite o nome fantasia empresa" type="text" required />
		    </div>

		    <div class="form-group">
		        <label class="control-label" for="rs">Razão Social</label>
		        <input class="form-control" name="rs" id="rs" placeholder="Digite a razão social empresa" type="text" />
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