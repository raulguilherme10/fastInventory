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
                <?php echo "Erro na atualização"; ?>
            </div>
            <?php
        }
    }
?>

<form action="<?php echo base_url('localizacao/editarLocalizacao'); ?>" method="post">
	<input type="hidden" id="loc_id" name="loc_id" value="<?php echo $localizacao[0]->loc_id;?>" />
    <div class="form-group">
        <label class="control-label" for="nome">Nome</label>
        <input class="form-control" name="loc_nome" id="nome" placeholder="Digite o nome do local" autofocus type="text" value="<?php echo $localizacao[0]->loc_nome;?>" required>
    </div>

    <div class="form-group">
        <label class="control-label" for="pavimento">Pavimento</label>
        <select name="loc_pavimento" id="pavimento" class="form-control">
          <option value="Primeiro" <?php echo $localizacao[0]->loc_pavimento=='Primeiro'?'selected':'';?> >Primeiro</option>
          <option value="Segundo" <?php echo $localizacao[0]->loc_pavimento=='Segundo'?'selected':'';?>>Segundo</option>
          <option value="Terceiro" <?php echo $localizacao[0]->loc_pavimento=='Terceiro'?'selected':'';?>>Terceiro</option>
        </select>
    </div>

    <div class="form-group">
        <label class="control-label" for="status">Status</label>
        <select name="loc_status" id="status" class="form-control">
		  <option value="1" <?php echo $localizacao[0]->loc_status==1?'selected':'';?>>Ativado</option>
		  <option value="0" <?php echo $localizacao[0]->loc_status==0?'selected':'';?>>Desativado</option>
		</select>
    </div>
  
    <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-floppy-disk"></i> Salvar</button>

  </form>