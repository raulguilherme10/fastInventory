<ul class="nav nav-pills nav-stacked">
        <li class="<?php if($this->uri->segment(2)=="listarEmpresas" || $this->uri->segment(2)=="atualizarEmpresa" || $this->uri->segment(2)=="editarEmpresa" || $this->uri->segment(2)==""){echo "active";}?>">
            <a href="<?php echo base_url('ativo/listarEmpresas')?>">Empresa</a>
        </li>
        <li class="<?php if($this->uri->segment(2)=="listarProdutos" || $this->uri->segment(2)=="atualizarProduto" || $this->uri->segment(2)=="cadastrarProduto" || $this->uri->segment(2)=="editarProduto"){echo "active";}?>">
            <a href="<?php echo base_url('ativo/listarProdutos')?>">Produto</a>
        </li>
        <li class="<?php if($this->uri->segment(2)=="listarNF" || $this->uri->segment(2)=="cadastrarNF" || $this->uri->segment(2)=="atualizarNF" || $this->uri->segment(2)=="editarNF" || $this->uri->segment(2)=="carregarItem" || $this->uri->segment(2)=="cadastrarItem"){echo "active";}?>">
            <a href="<?php echo base_url('ativo/listarNF')?>">Nota Fiscal</a>
        </li>
        <li class="<?php if($this->uri->segment(2)=="listarAtivo" || $this->uri->segment(2)=="exibirAtivo" || $this->uri->segment(2)=="atualizarAtivo"){echo "active";}?>">
            <a href="<?php echo base_url('ativo/listarAtivo')?>">Ativo</a>
        </li>
 </ul>