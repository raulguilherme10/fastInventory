<?php 
    if($this->session->flashdata('ok')){
    ?>
        <div class="alert alert-success" role="alert">
            <?php echo $this->session->flashdata('ok')?>
        </div
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

<form action="<?php echo base_url('localizacao/cadastrarLocalizacao'); ?>" method="post">

    <div class="form-group">
        <label class="control-label" for="nome">Nome</label>
        <input class="form-control" name="loc_nome" id="nome" placeholder="Digite o nome do local" autofocus type="text" required>
    </div>

    <div class="form-group">
        <label class="control-label" for="pavimento">Pavimento</label>
        <select name="loc_pavimento" id="pavimento" class="form-control">
          <option value="Primeiro">Primeiro</option>
          <option value="Segundo">Segundo</option>
          <option value="Terceiro">Terceiro</option>
        </select>
    </div>

    <div class="form-group">
        <label class="control-label" for="status">Status</label>
        <select name="loc_status" id="status" class="form-control">
		  <option value="1">Ativado</option>
		  <option value="0">Desativado</option>
		</select>
    </div>
  
    <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-floppy-disk"></i> Salvar</button>

  </form>