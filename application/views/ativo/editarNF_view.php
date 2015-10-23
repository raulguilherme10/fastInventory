<form action="<?php echo base_url('ativo/editarNF'); ?>" method="post">
    
    <input type="hidden" id="id" name="id" value="<?php echo $query[0]->ntf_id;?>" />
    <input type="hidden" id="cnpj" name="cnpj" value="<?php echo $query[0]->ntf_cnpjEmp;?>" />
	
	<div class="row">
		<div class="col-md-9">
			<div class="form-group">
		        <label class="control-label" for="numNota">Número da nota</label>
		        <input class="form-control" name="numNota" id="numNota" placeholder="Digite o número da nota fiscal." type="text" required value="<?php echo $query[0]->ntf_numNota; ?>">
    		</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
		        <label class="control-label" for="serie">Série</label>
		        <input class="form-control" name="serie" id="serie" placeholder="Número de série." type="number" value="<?php echo $query[0]->ntf_serie; ?>">
    		</div>
		</div>
	</div>
    
    <div class="form-group">
        <label class="control-label" for="natureza">Natureza da operação</label>
        <textarea class="form-control" name="natureza" id="natureza" placeholder="Digite a natureza da operação." type="text" rows="3"><?php echo $query[0]->ntf_naturezaOpe;;?></textarea>
    </div>

    <div class="row">
    	<div class="col-md-4">
    		<div class="form-group">
        		<label class="control-label" for="total">Total</label>
        		<input class="form-control" name="total" id="total" placeholder="Digite o total da nota fiscal." type="text" value="<?php echo $query[0]->ntf_total; ?>">
    		</div>
    	</div>
    	<div class="col-md-4">
    		<div class="form-group">
		        <label class="control-label" for="dataEmissao">Data de Emissão</label>
		        <input class="form-control" name="dataEmissao" id="dataEmissao" placeholder="Digite a data de emissão." type="text"  value="<?php echo $query[0]->ntf_dataEmissao; ?>">
    		</div>
    	</div>
    	<div class="col-md-4">
    		<div class="form-group">
		        <label class="control-label" for="dataVencimento">Data de Vencimento</label>
		        <input class="form-control" name="dataVencimento" id="dataVencimento" placeholder="Digite a data de vencimento." type="text" value="<?php echo $query[0]->ntf_dataVencimento; ?>">
    		</div>
    	</div>
    </div>
  
  
    <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-floppy-disk"></i> Salvar</button>
    <a type="submit" class="btn btn-default" href="<?php echo base_url('ativo/listarNF');?>"><i class="glyphicon glyphicon-remove"></i> Cancelar</a>

  </form>