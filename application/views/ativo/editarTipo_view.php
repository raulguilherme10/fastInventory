<form action="<?php echo base_url('ativo/editarTipo'); ?>" method="post">

	<input type="hidden" id="id" name="id" value="<?php echo $query[0]->tip_id;?>" />

	 <div class="form-group">
        <label class="control-label" for="nome">Nome</label>
        <input class="form-control" name="nome" id="nome" value="<?php echo $query[0]->tip_nome?>" placeholder="Digite o nome do Tipo."  type="text" autofocus required>
    </div>

    <div class="form-group">
        <label class="control-label" for="status">Status</label>
        <select name="status" id="status" class="form-control">
              <option value="1" <?php echo $query[0]->tip_status==1?'selected':'';?>>Ativo</option>
              <option value="0" <?php echo $query[0]->tip_status==0?'selected':'';?>>Inativo</option>
        </select>
    </div>

    <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-floppy-disk"></i> Salvar</button>
    <a type="submit" class="btn btn-default" href="<?php echo base_url('ativo/listarTipo');?>"><i class="glyphicon glyphicon-remove"></i> Cancelar</a>


</form>