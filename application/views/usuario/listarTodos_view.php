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
					<a href="<?php echo base_url('usuario/excluirusuario/'.$res->usu_id);?>" class="btn btn-danger btn-group"  onclick="return confirm('Deseja realmente excluir o usuário?');" data-toggle="tooltip" data-placement="bottom" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a>
				</td>
			</tr>
			<?php }?>
		</tbody>

	</table>
</div>