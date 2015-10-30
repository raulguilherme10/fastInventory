<div class="row">
    <div class="col-md-12">
        <form action="<?php echo base_url('localizacao/pesquisarPorLocal'); ?>" method="post">
            <label><b>Pesquisar:</b></label>
            <select name="opc" id="opc">
            <?php foreach($local->result() as $loc){?>
              <option value="<?php echo $loc->loc_id; ?>"><?php echo $loc->loc_nome; ?></option>
            <?php } ?>
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
            <td>Data</td>
            <td>Hora</td>
        </thead>
        <tbody>
            <?php foreach($query->result() as $res){?>
                <tr>
                    <td><?php echo $res->atv_id; ?></td>
                    <td><?php echo $res->atv_numPatr; ?></td>
                    <td><?php echo $res->pro_marca; ?></td>
                    <td><?php echo $res->pro_modelo; ?></td>
                    <td><?php echo $res->atv_data; ?></td>
                    <td><?php echo $res->atv_hora; ?></td>
                </tr>
            <?php }?>
        </tbody>

    </table>
</div>