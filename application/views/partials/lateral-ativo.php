<ul class="nav nav-pills nav-stacked">
        <li class="<?php if($this->uri->segment(2)=="listarEmpresas" || $this->uri->segment(2)=="atualizarEmpresa" || $this->uri->segment(2)=="editarEmpresa"){echo "active";}?>">
            <a href="<?php echo base_url('ativo/listarEmpresas')?>">Gerenciador Empresa</a>
        </li>
        <li class="<?php if($this->uri->segment(2)=="carregarProduto" || $this->uri->segment(2)=="cadastrarProduto"){echo "active";}?>">
            <a href="<?php echo base_url('ativo/carregarProduto')?>">Cadastrar Produto</a>
        </li>
        <li class="<?php if($this->uri->segment(2)=="carregarNF"){echo "active";}?>">
            <a href="<?php echo base_url('ativo/carregarNF')?>">Cadastrar Nota Fiscal</a>
        </li>
        <li class="<?php if($this->uri->segment(2)=="carregarItem"){echo "active";}?>">
            <a href="<?php echo base_url('ativo/carregarItem')?>">Adicionar Item</a>
        </li>
 </ul>