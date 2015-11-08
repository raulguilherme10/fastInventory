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
	<div class="col-md-12">
		<fieldset>
		<legend>
			<div class="col-md-4"><h2>Ativo</h2></div>
			<div class="col-md-4"></div>
			<div class="col-md-4 botao">
				<a href="<?php echo base_url('ativo/atualizarAtivo/'.$id);?>" class="btn btn-info btn-group" data-toggle="tooltip" data-placement="bottom" title="Editar"><i class="glyphicon glyphicon-pencil"></i></a>
				<a href="<?php echo base_url('ativo/gerarQRCode/'.$id);?>" class="btn btn-default btn-group" data-toggle="tooltip" data-placement="bottom" title="Gerar QR Code"><i class="glyphicon glyphicon-qrcode"></i></a>
				<a href="<?php echo base_url('ativo/listarAtivo');?>" class="btn btn-warning btn-group" data-toggle="tooltip" data-placement="bottom" title="Voltar para lista"><i class="glyphicon glyphicon-list-alt"></i></a>
			</div>
		</legend>
		</fieldset>
		
	</div>
	
</div>

<div class="row ativo">
	<div class="col-md-1">
		
	</div>
	
	<div class="col-md-4">
		<label><h4><b>ID</b></h4></label>		
	</div>

	<div class="col-md-7">
		<?php foreach($query->result() as $res){ ?>
			<h4><?php echo $res->atv_id; ?></h4>
		<?php } ?>
	</div>
</div>

<div class="row">
	<div class="col-md-1">
		
	</div>
	<div class="col-md-4">
		<label><h4><b>Número de Patrimônio</b></h4></label>		
	</div>

	<div class="col-md-7">
		<?php foreach($query->result() as $res){ ?>
			<h4><?php echo $res->atv_numPatr; ?></h4>
		<?php } ?>
	</div>
</div>

<div class="row">
	<div class="col-md-1">
		
	</div>
	<div class="col-md-4">
		<label><h4><b>Tipo</b></h4></label>		
	</div>

	<div class="col-md-7">
		<?php foreach($query->result() as $res){ ?>
			<h4><?php $id = $res->pro_idTipo; ?></h4>
		 <?php } 
			foreach($tipo->result() as $res){ ?>
			<h4>
			<?php if($res->tip_id == $id){
					echo $res->tip_nome;
				  } ?>
			</h4>
		<?php } ?>
	</div>
</div>

<div class="row">
	<div class="col-md-1">
		
	</div>
	<div class="col-md-4">
		<label><h4><b>Marca</b></h4></label>		
	</div>

	<div class="col-md-7">
		<?php foreach($query->result() as $res){ ?>
			<h4><?php echo $res->pro_marca; ?></h4>
		<?php } ?>
	</div>
</div>

<div class="row">
	<div class="col-md-1">
		
	</div>
	<div class="col-md-4">
		<label><h4><b>Modelo</b></h4></label>		
	</div>

	<div class="col-md-7">
		<?php foreach($query->result() as $res){ ?>
			<h4><?php echo $res->pro_modelo; ?></h4>
		<?php } ?>
	</div>
</div>

<div class="row">
	<div class="col-md-1">
		
	</div>
	<div class="col-md-4">
		<label><h4><b>Descrição</b></h4></label>		
	</div>

	<div class="col-md-7">
		<?php foreach($query->result() as $res){ ?>
			<h4><?php echo $res->pro_descricao; ?></h4>
		<?php } ?>
	</div>
</div>

<div class="row">
	<div class="col-md-1">
		
	</div>
	<div class="col-md-4">
		<label><h4><b>Preço</b></h4></label>		
	</div>

	<div class="col-md-7">
		<?php foreach($query->result() as $res){ ?>
			<h4>R$ <?php echo $res->itm_total; ?></h4>
		<?php } ?>
	</div>
</div>

<div class="row">
	<div class="col-md-1">
		
	</div>
	<div class="col-md-4">
		<label><h4><b>Local</b></h4></label>		
	</div>

	<div class="col-md-7">
		<?php foreach($query->result() as $res){ ?>
			<h4><?php echo $res->loc_nome; ?></h4>
		<?php } ?>
	</div>
</div>

<div class="row">
	<div class="col-md-1">
		
	</div>
	<div class="col-md-4">
		<label><h4><b>Data</b></h4></label>		
	</div>

	<div class="col-md-7">
		<?php foreach($query->result() as $res){ ?>
			<h4><?php echo $res->atv_data; ?></h4>
		<?php } ?>
	</div>
</div>

<div class="row">
	<div class="col-md-1">
		
	</div>
	<div class="col-md-4">
		<label><h4><b>Hora</b></h4></label>		
	</div>

	<div class="col-md-7">
		<?php foreach($query->result() as $res){ ?>
			<h4><?php echo $res->atv_hora; ?></h4>
		<?php } ?>
	</div>
</div>

<div class="row">
	<div class="col-md-1">
		
	</div>
	<div class="col-md-4">
		<label><h4><b>Status</b></h4></label>		
	</div>

	<div class="col-md-7">
		<?php foreach($query->result() as $res){ ?>
			<h4><?php echo $res->atv_status==1?'Ativo':'Inativo'; ?></h4>
		<?php } ?>
	</div>
</div>



