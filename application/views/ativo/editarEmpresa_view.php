<form action="<?php echo base_url('ativo/editarEmpresa'); ?>" method="post">

    <input type="hidden" id="cnpj" name="cnpj" value="<?php echo $query[0]->emp_cnpj;?>" />

    <div class="form-group">
        <label class="control-label" for="nf">Nome Fantasia</label>
        <input class="form-control" name="nf" id="nf" placeholder="Digite o nome fantasia empresa" type="text" value="<?php echo $query[0]->emp_nomeFantasia; ?>" required />
    </div>

    <div class="form-group">
        <label class="control-label" for="rs">Razão Social</label>
        <input class="form-control" name="rs" id="rs" placeholder="Digite a razão social empresa" type="text" value="<?php echo $query[0]->emp_razaoSocial; ?>" />
    </div>

  
  
    <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-floppy-disk"></i> Salvar</button>

  </form>