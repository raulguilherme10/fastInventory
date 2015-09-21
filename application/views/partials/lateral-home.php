 <ul class="nav nav-pills nav-stacked">
        <li class="<?php if($this->uri->segment(2)==""){echo "active";}?>">
            <a href="<?php echo base_url('home')?>">Trocar Senha</a>
        </li>
        <li class="<?php if($this->uri->segment(2)=="teste"){echo "active";}?>">
            <a href="<?php echo base_url('home/teste')?>">Teste</a>
        </li>
 </ul>
