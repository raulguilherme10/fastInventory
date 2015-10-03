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


<form action="<?php echo base_url('ativo/cadastrarProduto'); ?>" method="post">

    <div class="form-group">
        <label class="control-label" for="tipo">Tipo</label>
        <select name="tipo" id="tipo" class="form-control">
            <?php foreach($query->result() as $res) {?>
              <option value="<?php echo $res->tip_id; ?>"><?php echo $res->tip_nome;?></option>
            <?php } ?>
        </select>
    </div>

    <div class="form-group">
        <label class="control-label" for="marca">Marca</label>
        <input class="form-control" name="marca" id="marca" placeholder="Digite a marca do produto." autofocus type="text" required>
    </div>

    <div class="form-group">
        <label class="control-label" for="cor">Cor</label>
        <input class="form-control" name="cor" id="cor" placeholder="Digite a cor principal do produto." type="text">
    </div>

    <div class="form-group">
        <label class="control-label" for="descricao">Descrição</label>
        <textarea class="form-control" name="descricao" id="descricao" placeholder="Digite a descrição do produto." type="text" required rows="3"></textarea>
    </div>
  
  
    <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-floppy-disk"></i> Salvar</button>

  </form>