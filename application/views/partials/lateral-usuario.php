 <ul class="nav nav-pills nav-stacked">
        <li class="<?php if($this->uri->segment(2)=="listarUsuario" || $this->uri->segment(2)=="" || $this->uri->segment(2) == "cadastrarUsuario"){echo "active";}?>">
            <a href="<?php echo base_url('usuario/listarUsuario')?>">Usuário</a>
        </li>
        <li class="<?php if($this->uri->segment(2)=="trocarSenha"){echo "active";}?>">
            <a href="<?php echo base_url('usuario/trocarSenha')?>">Trocar Senha</a>
        </li>
 </ul>
