<form action="<?php echo base_url('ativo/cadastrarItem'); ?>" method="post">
	
	<input type="hidden" id="id" name="id" value="<?php echo $id;?>" />
	<input type="hidden" id="cnpj" name="cnpj" value="<?php echo $cnpj;?>" />

	
    <div class="form-group">
        <label class="control-label" for="numNota">Número da Nota Fiscal</label>
        <input class="form-control" name="numNota" id="numNota" type="text" disabled="disabled" type="text" value="<?php echo $numNota; ?>" />
    </div>

	<div class="form-group">
        <label class="control-label" for="empresa">Produto</label>
        <select name="empresa" id="empresa" class="form-control" autofocus required>
            <?php foreach($query->result() as $res) {?>
              <option value="<?php echo $res->pro_id; ?>"><?php echo $res->tip_nome.' - '.$res->pro_marca;?></option>
            <?php } ?>
        </select>
    </div>
	
	<div class="form-group">
        <label class="control-label" for="quantidade">Quantidade</label>
        <input class="form-control" name="quantidade" id="quantidade" placeholder="Digite a quantidade de item." type="number" required>
	</div>



	<button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-floppy-disk"></i> Salvar</button>
    <a type="submit" class="btn btn-default" href="<?php echo base_url('ativo/listarNF');?>"><i class="glyphicon glyphicon-remove"></i> Cancelar</a>


</form>