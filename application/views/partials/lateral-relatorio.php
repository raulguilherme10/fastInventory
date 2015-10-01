<ul class="nav nav-pills nav-stacked">
		<li class="<?php if($this->uri->segment(2)=="listarLocalizacao"){echo "active";}?>">
            <a href="<?php echo base_url('localizacao/listarLocalizacao')?>">Ativos por Localização</a>
        </li>
        <li class="<?php if($this->uri->segment(2)=="listarLocalizacao"){echo "active";}?>">
            <a href="<?php echo base_url('localizacao/listarLocalizacao')?>">Rastreabilidade</a>
        </li>
        <li class="<?php if($this->uri->segment(2)==""){echo "active";}?>">
            <a href="<?php echo base_url('localizacao/listarLocalizacao')?>">Divergência</a>
        </li>
 </ul>