<ul class="nav nav-pills nav-stacked">
        <li class="<?php if($this->uri->segment(2)=="listarTipo" || $this->uri->segment(2)=="cadastrarTipo" || $this->uri->segment(2)=="atualizarTipo"){echo "active";}?>">
            <a href="<?php echo base_url('ativo/listarTipo')?>">Tipo</a>
        </li>
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
        <li class="<?php if($this->uri->segment(2)=="historico" || $this->uri->segment(2)=="pesquisarAtivo"){echo "active";}?>">
            <a href="<?php echo base_url('ativo/historico')?>">Histórico</a>
        </li>
        <li class="<?php if($this->uri->segment(2)=="carregarRelatorio"){echo "active";}?>">
            <a href="<?php echo base_url('ativo/carregarRelatorio')?>">Relatório</a>
        </li>
 </ul>