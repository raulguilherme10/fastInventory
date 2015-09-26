<form action="<?php echo base_url('usuario/trocarSenha'); ?>" method="post">

    <div class="form-group">
        <label class="control-label" for="senhaAnt">Senha Antiga</label>
        <input class="form-control" name="senhaAnt" id="senhaAnt" placeholder="Digite sua senha antiga" type="password" required autofocus>
    </div>

    <div class="form-group">
        <label class="control-label" for="senhaNov">Nova Senha</label>
        <input class="form-control" name="senhaNov" id="senhaNov" placeholder="Digite sua nova senha" type="password" required>
    </div>

    <div class="form-group">
        <label class="control-label" for="senhaRep">Repita a Nova Senha</label>
        <input class="form-control" name="senhaRep" id="senhaRep" placeholder="Digite sua nova senha novamente" type="password" required>
    </div>

  
    <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-floppy-disk"></i> Salvar</button>

 </form>