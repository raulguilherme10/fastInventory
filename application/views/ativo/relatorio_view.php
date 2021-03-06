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
	<div class="col-md-5 col-md-offset-1 borda">
		<fieldset>
			<legend>Histórico do Ativo</legend>
			<form action="<?php echo base_url('relatorio/pesquisarHistorico'); ?>" method="post">
				<div class="form-group">
			     	<input class="form-control" name="pesq" id="pesq" placeholder="Pesquisar" autofocus type="text" required />
			    </div>

			    <div class="form-group">
			 		<select name="opc" id="opc" class="form-control">
		              <option value="0">ID</option>
		              <option value="1">Patrimônio</option>
		              <option value="2">Local</option>
		            </select>
			    </div>

			    <div class="form-group">
			    	<button type="submit" class="btn btn-warning"><i class="glyphicon glyphicon-file"></i> Gerar Relatório</button>
			    </div>
			</form>
		</fieldset>
	</div>

	<div class="col-md-5 col-md-offset-1 borda">
		<fieldset>
			<legend>Ativos por Localização</legend>

			<form action="<?php echo base_url('relatorio/ativosPorLocal'); ?>" method="post">
				 
				<div class="form-group">
			 		<select name="opc" id="opc" class="form-control">
			 		  <?php foreach($local->result() as $res) {?>
		              <option value="<?php echo $res->loc_id; ?>"><?php echo $res->loc_nome; ?></option>
		              <?php } ?>
		            </select>
			    </div>

			    <div class="form-group">
			    	<button type="submit" class="btn btn-warning"><i class="glyphicon glyphicon-file"></i> Gerar Relatório</button>
			    </div>
			    
		</fieldset>
	</div>
</div>


<div class="row divergencia">
	<div class="col-md-11 col-md-offset-1 borda">
		<fieldset>
			<legend>Divergência</legend>
	
			<table class="table table-hover dt-responsive nowrap" cellspacing="0" id="myTable">
				<thead>
					<td>Local</td>
					<td>Data</td>
					<td>Hora</td>
					<td></td>
				</thead>
				<tbody>
					<?php foreach($fiscalizar->result() as $res) {?>
					<tr>
						<td><?php echo $res->loc_nome; ?></td>
						<td><?php echo $res->fis_data; ?></td>
						<td><?php echo $res->fis_hora; ?></td>
						<td>
							<a href="<?php echo base_url('relatorio/gerarDivergencia/'.$res->fis_id);?>" class="btn btn-warning btn-group" data-toggle="tooltip" data-placement="bottom" title="Gerar Relatório"><i class="glyphicon glyphicon-file"></i></a>
						</td>	
					</tr>
					<?php }?>
				</tbody>

			</table>

		</fieldset>
	</div>
</div>