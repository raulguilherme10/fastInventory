<div class="row tablist">
    <table class="table table-hover dt-responsive nowrap" cellspacing="0" id="myTable">
        <thead>
            <td>Nota Fiscal</td>
            <td>Local</td>
            <td>Patrimônio</td>
            <td>Marca</td>
            <td>Modelo</td>
            <td></td>
        </thead>
        <tbody>
            <?php foreach($query->result() as $res){?>
                <tr>
                    <td><?php echo $res->ntf_numNota; ?></td>
                    <td><?php echo ellipsize($res->loc_nome, 15); ?></td>
                    <td><?php echo $res->atv_numPatr; ?></td>
                    <td><?php echo ellipsize($res->pro_marca, 10); ?></td>
                    <td><?php echo ellipsize($res->pro_modelo, 10); ?></td>
                    <td>
                        <a href="<?php echo base_url('teste/inserirItem/'.$res->atv_id.'/'.$this->uri->segment(3));?>" class="btn btn btn-success btn-group" data-toggle="tooltip" data-placement="bottom" title="Inserir Item"><i class="glyphicon glyphicon-plus"></i></a>
                    </td>
                </tr>
            <?php }?>
        </tbody>

    </table>
</div>