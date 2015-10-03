<ul class="nav nav-pills nav-stacked">
		<li class="<?php if($this->uri->segment(2)=="cadastrarEmpresa" || $this->uri->segment(2)==""){echo "active";}?>">
            <a href="<?php echo base_url('ativo')?>">Cadastrar Empresa</a>
        </li>
        <li class="<?php if($this->uri->segment(2)=="carregarProduto" || $this->uri->segment(2)=="cadastrarProduto"){echo "active";}?>">
            <a href="<?php echo base_url('ativo/carregarProduto')?>">Cadastrar Produto</a>
        </li>
        <li class="<?php if($this->uri->segment(2)=="listarLocalizacao"){echo "active";}?>">
            <a href="<?php echo base_url('localizacao/listarLocalizacao')?>">Cadastrar Nota Fiscal</a>
        </li>
        <li class="<?php if($this->uri->segment(2)=="add"){echo "active";}?>">
            <a href="<?php echo base_url('localizacao/listarLocalizacao')?>">Adicionar Item</a>
        </li>
 </ul>