<div class="row tablist">
    <table class="table table-hover dt-responsive nowrap" cellspacing="0" id="myTable">
        <thead>
            <td>Nota Fiscal</td>
            <td>Local</td>
            <td>Patrimônio</td>
            <td>Status</td>
            <td></td>
        </thead>
        <tbody>
            <?php foreach($query->result() as $res){?>
                <tr>
                    <td><?php echo $res->ntf_numNota; ?></td>
                    <td><?php echo ellipsize($res->loc_nome, 15); ?></td>
                    <td><?php echo $res->atv_numPatr; ?></td>
                    <td><?php echo $res->atv_status==1?'Ativo':'Inativo'; ?></td>
                    <td>
                        <a href="<?php echo base_url('ativo/exibirAtivo/'.$res->atv_id);?>" class="btn btn btn-default btn-group" data-toggle="tooltip" data-placement="bottom" title="Exibir"><i class="glyphicon glyphicon-list-alt"></i></a>
                    </td>
                </tr>
            <?php }?>
        </tbody>

    </table>
</div>