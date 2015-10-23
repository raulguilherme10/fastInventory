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
		<a href="#" class="btn btn-success btn-lg"  data-placement="bottom" title="Cadastrar Usuário" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus"></i></a>
	</div>
</div>


<div class="row tablist">
	<table class="table table-hover dt-responsive nowrap" cellspacing="0" id="myTable">
		<thead>
			<td>Usuário</td>
			<td>Tipo de Conta</td>
			<td>Status</td>
			<td></td>
		</thead>
		<tbody>
			<?php foreach($query->result() as $res){?>
			<tr>
				<td><?php echo $res->usu_usuario;?></td>
				<td><?php echo $res->usu_idGru==1?'Administrador':'Comum';?></td>
				<td><?php echo $res->usu_status==1?'Ativo':'Inativo'; ?></td>
				<td>
					<a href="<?php echo base_url('usuario/restaurarSenha/'.$res->usu_id);?>" class="btn btn-info btn-group" onclick="return confirm('Deseja restaurar a senha do usuário?');" data-toggle="tooltip" data-placement="bottom" title="Restaurar senha"><i class="glyphicon glyphicon-refresh"></i></a>
					<a href="<?php echo base_url('usuario/excluirusuario/'.$res->usu_id);?>" class="btn btn-danger btn-group"  onclick="return confirm('Deseja realmente excluir o usuário?');" data-toggle="tooltip" data-placement="bottom" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a>
					<a href="<?php echo base_url('usuario/trocarStatus/'.$res->usu_id);?>" class="btn btn btn-default btn-group"  onclick="return confirm('Deseja trocar o status do usuário?');" data-toggle="tooltip" data-placement="bottom" title="Trocar Status"><i class="glyphicon glyphicon-edit"></i></a>
				</td>
			</tr>
			<?php }?>
		</tbody>

	</table>
</div>





<!-- Inicio Modal Cadastrar NF-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
  	<form action="<?php echo base_url('usuario/cadastrarUsuario'); ?>" method="post">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cadastrar Usuário</h4>
      </div>
      <div class="modal-body">


			<div class="form-group">
		        <label class="control-label" for="usuario">Usuário</label>
		        <input class="form-control" name="usuario" id="usuario" placeholder="Digite o nome do usuário" autofocus type="text" required>
	    	</div>

		    <div class="form-group">
		        <label class="control-label" for="senha">Senha</label>
		        <input class="form-control" name="senha" id="senha" placeholder="Digite sua senha" type="password" required>
		    </div>

		    <div class="form-group">
		        <label class="control-label" for="senhaNov">Repita a Senha</label>
		        <input class="form-control" name="senhaNov" id="senhaNov" placeholder="Digite sua senha novamente" type="password" required>
		    </div>

		    <div class="form-group">
		        <label class="control-label" for="tipo">Tipo de Conta</label>
		        <select name="tipo" id="tipo" class="form-control">
		          <?php foreach($tipo->result() as $grupo){?>
		          <option value="<?php echo $grupo->gru_id; ?>"><?php echo $grupo->gru_tipo;?></option>
		          <?php }?>
		        </select>
		    </div>

		    <div class="form-group">
		        <label class="control-label" for="status">Status</label>
		        <select name="status" id="status" class="form-control">
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