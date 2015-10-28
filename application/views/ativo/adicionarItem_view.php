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


<form action="<?php echo base_url('ativo/cadastrarItem'); ?>" method="post">
	
	<input type="hidden" id="id" name="id" value="<?php echo $id;?>" />
	<input type="hidden" id="cnpj" name="cnpj" value="<?php echo $cnpj;?>" />

	
    <div class="row">

        <div class="col-md-8">
            <div class="form-group">
                <select name="empresa" id="empresa" class="form-control" autofocus required>
                    <?php foreach($query->result() as $res) {?>
                      <option value="<?php echo $res->pro_id; ?>"><?php echo $res->tip_nome.' - '.$res->pro_marca.' - '.$res->pro_modelo;?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <input class="form-control" name="quantidade" id="quantidade" placeholder="Quantidade" type="number" required>
            </div>
        </div>

        <div class="col-md-1">
            <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-floppy-disk"></i> Salvar</button>
        </div>

    </div>

</form>



<!-- Inicio lista de itens-->
<div class="row tablist">
    <table class="table table-hover dt-responsive nowrap" cellspacing="0" id="myTable">

        <thead>
            <td>Tipo</td>
            <td>Marca</td>
            <td>Modelo</td>
            <td>Quantidade</td>
            <td></td>
        </thead>

        <tbody>
        <?php foreach($item->result() as $res){?>
            <tr>
                <td>
                    <?php foreach($tipo->result() as $tip){
                        if($tip->tip_id == $res->pro_idTipo){
                            echo $tip->tip_nome;
                        }
                    }?>
                </td>
                <td><?php echo $res->pro_marca; ?></td>
                <td><?php echo $res->pro_modelo; ?></td>
                <td><?php echo $res->itm_quantidade; ?></td>
                <td>
                    <a href="<?php echo base_url('ativo/excluirItem/'.$res->itm_id);?>" class="btn btn-danger btn-group"  onclick="return confirm('Deseja realmente excluir o item?');" data-toggle="tooltip" data-placement="bottom" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a>
                </td>   
            </tr>
        <?php }?>
        </tbody>

    </table>
</div>
<!-- Fim lista de itens-->