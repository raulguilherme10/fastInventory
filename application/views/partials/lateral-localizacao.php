<ul class="nav nav-pills nav-stacked">
		<li class="<?php if($this->uri->segment(2)=="cadastrarLocalizacao" || $this->uri->segment(2)=="atualizarLocalizacao"){echo "active";}?>">
            <a href="<?php echo base_url('localizacao/cadastrarLocalizacao')?>"><?php if($this->uri->segment(2) == "atualizarLocalizacao"){ echo "Editar Localização"; } else{ echo "Cadastrar Localização"; }?></a>
        </li>
        <li class="<?php if($this->uri->segment(2)=="listarLocalizacao"){echo "active";}?>">
            <a href="<?php echo base_url('localizacao/listarLocalizacao')?>">Gerenciador de Localização</a>
        </li>
        <li class="<?php if($this->uri->segment(2)==""){echo "active";}?>">
            <a href="<?php echo base_url('localizacao/listarLocalizacao')?>">Matriz de Rastreabilidade</a>
        </li>
 </ul>