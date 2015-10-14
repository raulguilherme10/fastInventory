<form action="<?php echo base_url('ativo/editarEmpresa'); ?>" method="post">

    <input type="hidden" id="cnpj" name="cnpj" value="<?php echo $query[0]->emp_cnpj;?>" />
    
    <div class="form-group">
        <label class="control-label" for="cnpj">CNPJ</label>
        <input class="form-control" name="cnpj" id="nf" type="text" disabled="disabled" type="text" value="<?php echo $query[0]->emp_cnpj; ?>"/>
    </div>

    <div class="form-group">
        <label class="control-label" for="ie">Inscrição Estadual</label>
        <input class="form-control" name="ie" id="rs" type="text" disabled="disabled" value="<?php echo $query[0]->emp_ie; ?>"/>
    </div>

    <div class="form-group">
        <label class="control-label" for="nf">Nome Fantasia</label>
        <input class="form-control" name="nf" id="nf" placeholder="Digite o nome fantasia empresa" type="text" value="<?php echo $query[0]->emp_nomeFantasia; ?>" required />
    </div>

    <div class="form-group">
        <label class="control-label" for="rs">Razão Social</label>
        <input class="form-control" name="rs" id="rs" placeholder="Digite a razão social empresa" type="text" value="<?php echo $query[0]->emp_razaoSocial; ?>" />
    </div>

    <div class="form-group">
        <label class="control-label" for="status">Status</label>
        <select name="loc_status" id="status" class="form-control">
          <option value="1" <?php echo $query[0]->emp_status==1?'selected':'';?>>Ativado</option>
          <option value="0" <?php echo $query[0]->emp_status==0?'selected':'';?>>Desativado</option>
        </select>
    </div>

  
  
    <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-floppy-disk"></i> Salvar</button>
    <a type="submit" class="btn btn-default" href="<?php echo base_url('ativo/listarEmpresas');?>"><i class="glyphicon glyphicon-remove"></i> Cancelar</a>

  </form>