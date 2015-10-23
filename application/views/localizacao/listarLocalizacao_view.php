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
		<a href="#" class="btn btn-success btn-lg"  data-placement="bottom" title="Cadastrar Localização" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus"></i></a>
	</div>
</div>

<div class="row tablist">
	<table class="table table-hover dt-responsive nowrap" cellspacing="0" id="myTable">
		<thead>
			<td>ID</td>
			<td>Nome</td>
			<td>Pavimento</td>
			<td>Status</td>
			<td></td>
		</thead>
		<tbody>
			<?php foreach($query->result() as $res){?>
			<tr>
				<td><?php echo $res->loc_id;?></td>
				<td><?php echo $res->loc_nome;?></td>
				<td><?php echo $res->loc_pavimento;?></td>
				<td><?php echo $res->loc_status==1?'Ativo':'Inativo'; ?></td>
				<td>
					<a href="<?php echo base_url('localizacao/atualizarLocalizacao/'.$res->loc_id);?>" class="btn btn-info btn-group" data-toggle="tooltip" data-placement="bottom" title="Editar"><i class="glyphicon glyphicon-pencil"></i></a>
					<a href="<?php echo base_url('localizacao/excluirLocalizacao/'.$res->loc_id);?>" class="btn btn-danger btn-group"  onclick="return confirm('Deseja realmente excluir a localização?');" data-toggle="tooltip" data-placement="bottom" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a>
					<a href="<?php echo base_url('localizacao/gerarQRCode/'.$res->loc_id);?>" class="btn btn-default btn-group" data-toggle="tooltip" data-placement="bottom" title="Gerar QR Code"><i class="glyphicon glyphicon-qrcode"></i></a>
				</td>
			</tr>
			<?php }?>
		</tbody>

	</table>
</div>




<!-- Inicio Modal Cadastrar NF-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
  	<form action="<?php echo base_url('localizacao/cadastrarLocalizacao'); ?>" method="post">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cadastrar Localização</h4>
      </div>
      <div class="modal-body">

	
			 <div class="form-group">
		        <label class="control-label" for="nome">Nome</label>
		        <input class="form-control" name="loc_nome" id="nome" placeholder="Digite o nome do local" autofocus type="text" required>
	    	</div>

		    <div class="form-group">
		        <label class="control-label" for="pavimento">Pavimento</label>
		        <select name="loc_pavimento" id="pavimento" class="form-control">
		          <option value="Primeiro">Primeiro</option>
		          <option value="Segundo">Segundo</option>
		          <option value="Terceiro">Terceiro</option>
		        </select>
		    </div>

		    <div class="form-group">
		        <label class="control-label" for="status">Status</label>
		        <select name="loc_status" id="status" class="form-control">
				  <option value="1">Ativo</option>
				  <option value="0">Inativo</option>
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
<!-- Fim Modal Cadastrar NF-->