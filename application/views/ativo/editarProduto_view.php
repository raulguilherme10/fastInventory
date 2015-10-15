<form action="<?php echo base_url('ativo/editarProduto'); ?>" method="post">

	<input type="hidden" id="id" name="id" value="<?php echo $query[0]->pro_id;?>" />

	<div class="form-group">
        <label class="control-label" for="tipo">Tipo</label>
        <select name="tipo" id="tipo" class="form-control" autofocus>
            <?php foreach($combo->result() as $res) { ?>
              <option value="<?php echo $res->tip_id; ?>"  <?php echo $query[0]->pro_idTipo==$res->tip_id?'selected':'';?> ><?php echo $res->tip_nome; ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="form-group">
        <label class="control-label" for="marca">Marca</label>
        <input class="form-control" name="marca" id="marca" value="<?php echo $query[0]->pro_marca?>" placeholder="Digite a marca do produto."  type="text" required>
    </div>

    <div class="form-group">
        <label class="control-label" for="cor">Cor</label>
        <input class="form-control" name="cor" id="cor" value="<?php echo $query[0]->pro_cor?>"  placeholder="Digite a cor principal do produto." type="text">
    </div>

    <div class="form-group">
        <label class="control-label" for="descricao">Descrição</label>
        <textarea class="form-control" name="descricao" id="descricao" placeholder="Digite a descrição do produto." type="text" required rows="3"></textarea>
    </div>
	
	<button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-floppy-disk"></i> Salvar</button>
    <a type="submit" class="btn btn-default" href="<?php echo base_url('ativo/listarProdutos');?>"><i class="glyphicon glyphicon-remove"></i> Cancelar</a>

</form>