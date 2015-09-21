<form action="<?php echo base_url('auth/create_user'); ?>" method="post">

    <div class="form-group">
        <label class="control-label" for="nome">Nome</label>
        <input class="form-control" name="nome" id="nome" placeholder="Digite o nome da localização" autofocus type="text" required>
    </div>

    <div class="form-group">
        <label class="control-label" for="senha">Status</label>
        <input class="form-control" name="password" id="senha" placeholder="Digite sua senha" type="password">
    </div>

  
    <button type="submit" class="btn btn-default">Salvar</button>

    </form>
