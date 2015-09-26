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


<form action="<?php echo base_url('usuario/cadastrarUsuario'); ?>" method="post">

    <div class="form-group">
        <label class="control-label" for="usuario">Usuário</label>
        <input class="form-control" name="usuario" id="usuario" placeholder="Digite o nome do usuário" autofocus type="text" required>
    </div>

    <div class="form-group">
        <label class="control-label" for="senha">Senha</label>
        <input class="form-control" name="senha" id="senha" placeholder="Digite sua senha" type="password" required>
    </div>

    <div class="form-group">
        <label class="control-label" for="senhaNov">Repita a Senha</label>
        <input class="form-control" name="senhaNov" id="senhaNov" placeholder="Digite sua senha novamente" type="password" required>
    </div>

    <div class="form-group">
        <label class="control-label" for="tipo">Tipo de Conta</label>
        <select name="tipo" id="tipo" class="form-control">
          <?php foreach($tipo->result() as $grupo){?>
          <option value="<?php echo $grupo->gru_id; ?>"><?php echo $grupo->gru_tipo;?></option>
          <?php }?>
        </select>
    </div>

    <div class="form-group">
        <label class="control-label" for="status">Status</label>
        <select name="status" id="status" class="form-control">
          <option value="1">Ativado</option>
          <option value="0">Desativado</option>
        </select>
    </div>



  
    <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-floppy-disk"></i> Salvar</button>

 </form>
