<ul class="nav nav-pills nav-stacked">
        <li class="<?php if($this->uri->segment(2)=="listarLocalizacao" || $this->uri->segment(2)=="cadastrarLocalizacao" || $this->uri->segment(2)=="atualizarLocalizacao"){echo "active";}?>">
            <a href="<?php echo base_url('localizacao/listarLocalizacao')?>">Localização</a>
        </li>
        <li class="<?php if($this->uri->segment(2)=="carregarAtivosLocal" || $this->uri->segment(2)=="pesquisarPorLocal"){echo "active";}?>">
            <a href="<?php echo base_url('localizacao/carregarAtivosLocal')?>">Ativos por Localização</a>
        </li>
 </ul>