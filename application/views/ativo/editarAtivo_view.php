<?php 
    if($this->session->flashdata('ok')){
    ?>
        <div class="alert alert-success" role="alert">
            <?php echo $this->session->flashdata('ok')?>
        </div>
    <?php
    }else{
        if($this->session->flashdata('erro')){
        ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $this->session->flashdata('erro')?>
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
    }
?>

<form action="<?php echo base_url('ativo/editarAtivo'); ?>" method="post">

    <input type="hidden" id="id" name="id" value="<?php echo $query[0]->atv_id;?>"/>
    
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label" for="np">Número de Patrimônio</label>
                <input class="form-control" name="np" id="np" type="text" autofocus value="<?php echo $query[0]->atv_numPatr; ?>" required>
            </div>
        </div>
        <div class="col-md-8">
            <div class="form-group">
                <label class="control-label" for="tipo">Tipo</label>
                <input class="form-control" name="tipo" id="tipo" type="text" disabled="disabled" 
                value="<?php foreach($tipo->result() as $tip){
                        if($tip->tip_id == $query[0]->pro_idTipo){
                            echo $tip->tip_nome;
                        }
                    }?>"/>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label" for="marca">Marca</label>
                <input class="form-control" name="marca" id="marca" type="text" disabled="disabled" value="<?php echo $query[0]->pro_marca; ?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label" for="modelo">Modelo</label>
                <input class="form-control" name="modelo" id="modelo" type="text" disabled="disabled" value="<?php echo $query[0]->pro_modelo; ?>"/>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label" for="descricao">Descrição</label>
        <textarea class="form-control" name="descricao" id="descricao" type="text" rows="3" disabled="disabled"><?php echo $query[0]->pro_descricao; ?></textarea>
    </div>

    
    <div class="form-group">
        <label class="control-label" for="local">Local</label>
        <select name="local" id="local" class="form-control">
            <?php foreach($local->result() as $res) { ?>
            <option value="<?php echo $res->loc_id; ?>" <?php echo $query[0]->atv_local==$res->loc_id?'selected':'';?>><?php echo $res->loc_nome; ?></option>
            <?php }?>
        </select>
    </div>


    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label" for="data">Data</label>
                <input class="form-control" name="data" id="data" type="text" disabled="disabled" value="<?php echo $query[0]->atv_data; ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label" for="hora">Hora</label>
                <input class="form-control" name="hora" id="hora" type="text" disabled="disabled" value="<?php echo $query[0]->atv_hora; ?>"/>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label" for="status">Status</label>
                <select name="status" id="status" class="form-control">
                      <option value="1" <?php echo $query[0]->atv_status==1?'selected':'';?>>Ativo</option>
                      <option value="0" <?php echo $query[0]->atv_status==0?'selected':'';?>>Inativo</option>
                </select>
            </div>
        </div>
    </div>

    
    <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-floppy-disk"></i> Salvar</button>
    <a href="<?php echo base_url('ativo/exibirAtivo/'.$query[0]->atv_id);?>" type="submit" class="btn btn-default"><i class="glyphicon glyphicon-remove"></i> Cancelar</a>

  </form>