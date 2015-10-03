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



<form action="<?php echo base_url('ativo/cadastrarEmpresa'); ?>" method="post">

    <div class="form-group">
        <label class="control-label" for="cnpj">CNPJ</label>
        <input class="form-control" name="cnpj" id="cnpj" placeholder="Digite o cnpj da empresa" autofocus type="text" required>
    </div>

    <div class="form-group">
        <label class="control-label" for="ie">Inscrição Estadual</label>
        <input class="form-control" name="ie" id="ie" placeholder="Digite a inscrição estadual da empresa" type="text" required>
    </div>

    <div class="form-group">
        <label class="control-label" for="nf">Nome Fantasia</label>
        <input class="form-control" name="nf" id="nf" placeholder="Digite o nome fantasia empresa" type="text" required>
    </div>

    <div class="form-group">
        <label class="control-label" for="rs">Razão Social</label>
        <input class="form-control" name="rs" id="rs" placeholder="Digite a razão social empresa" type="text">
    </div>

  
  
    <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-floppy-disk"></i> Salvar</button>

  </form>
