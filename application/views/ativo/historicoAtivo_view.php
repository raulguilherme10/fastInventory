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

<div class="row">
    <div class="col-md-12">
        <form action="<?php echo base_url('ativo/pesquisarAtivo'); ?>" method="post">
            <label><b>Pesquisar:</b></label>
            <input type="text" name="pesquisar" required autofocus />
            <select name="opc" id="opc">
              <option value="0">ID</option>
              <option value="1">Patrimônio</option>
              <option value="2">Local</option>
            </select>
            <button type="submit" class="btn btn-warning"><i class="glyphicon glyphicon-search"></i></button>
        </form>
    </div>  
</div>

<div class="row tablist">
    <table class="table table-hover dt-responsive nowrap" cellspacing="0" id="myTable">
        <thead>
            <td>ID</td>
            <td>Patrimônio</td>
            <td>Marca</td>
            <td>Modelo</td>
            <td>Local</td>
            <td>Data</td>
            <td>Hora</td>
        </thead>
        <tbody>
            <?php foreach($query->result() as $res){?>
                <tr>
                    <td><?php echo $res->his_idATV; ?></td>
                    <td><?php echo $res->his_numPatr; ?></td>
                    <td><?php echo $res->pro_marca; ?></td>
                    <td><?php echo $res->pro_modelo; ?></td>
                    <td><?php echo $res->loc_nome; ?></td>
                    <td><?php echo $res->his_data; ?></td>
                    <td><?php echo $res->his_hora; ?></td>
                </tr>
            <?php }?>
        </tbody>

    </table>
</div>