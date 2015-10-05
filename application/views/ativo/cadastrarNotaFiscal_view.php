<form action="<?php echo base_url('ativo/cadastrarProduto'); ?>" method="post">

    <div class="form-group">
        <label class="control-label" for="empresa">Empresa</label>
        <select name="empresa" id="empresa" class="form-control" autofocus>
            <?php foreach($query->result() as $res) {?>
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
		        <input class="form-control" name="serie" id="serie" placeholder="Número de série." type="text">
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
        		<input class="form-control" name="total" id="total" placeholder="Digite o total da nota fiscal." type="text">
    		</div>
    	</div>
    	<div class="col-md-4">
    		<div class="form-group">
		        <label class="control-label" for="dataEmissao">Data de Emissão</label>
		        <input class="form-control" name="dataEmissao" id="dataEmissao" placeholder="Digite a data de emissão." type="text">
    		</div>
    	</div>
    	<div class="col-md-4">
    		<div class="form-group">
		        <label class="control-label" for="dataVencimento">Data de Vencimento</label>
		        <input class="form-control" name="dataVencimento" id="dataVencimento" placeholder="Digite a data de vencimento." type="text">
    		</div>
    	</div>
    </div>
  
  
    <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-floppy-disk"></i> Salvar</button>

  </form>