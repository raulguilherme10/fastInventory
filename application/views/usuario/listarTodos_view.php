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
        }
    }
?>


<div class="row tablist">
	<table class="table table-hover" id="myTable">
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
				<td><?php echo $res->usu_status==1?'Ativado':'Desativado'; ?></td>
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