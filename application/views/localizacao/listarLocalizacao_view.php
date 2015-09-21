<?php 
    if($this->session->flashdata('ok')){
    ?>
        <div class="alert alert-success" role="alert">
            <?php echo $this->session->flashdata('ok')?>
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
?>

<div class="row tablist">
	<table class="table table-hover" id="myTable">
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
				<td><?php echo $res->loc_status==1?'Ativado':'Desativado'; ?></td>
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
