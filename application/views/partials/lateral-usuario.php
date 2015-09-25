 <ul class="nav nav-pills nav-stacked">
        <li class="<?php if($this->uri->segment(2)=="" || $this->uri->segment(2) == "cadastrarUsuario"){echo "active";}?>">
            <a href="<?php echo base_url('usuario')?>">Cadastrar Usuário</a>
        </li>
        <li class="<?php if($this->uri->segment(2)=="listarUsuario"){echo "active";}?>">
            <a href="<?php echo base_url('usuario/listarUsuario')?>">Gerenciador de Usuário</a>
        </li>
 </ul>
