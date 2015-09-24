<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css"
        rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="<?php echo base_url('assets/css/theme.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css'); ?> ">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-theme.css'); ?> ">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?> ">
    </head>
    
    <body>
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                       <div class="page-header">
                           <h1>Fast Inventory</h1>
                        </div>
                </div>
            </div>
        </div>
    </div>

     <?php if($msg != NULL){ ?>   
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class = "col-md-4">

                    </div>

                    <div class = "col-md-4">
                        <div class="alert alert-danger" role="alert">
                            <?php echo $msg;?>
                        </div>
                    </div>

                    <div class = "col-md-4">

                    </div>
                </div>
            </div> 
        </div>
    <?php } ?>
  

        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        
                    </div>
                    
                    <div class="col-md-4">
                            <form  action = "<?php echo base_url('login/logarUsuario');?>" method="post">
                            <div class="form-group">
                                <label class="control-label" for="usuario">Usuário</label>
                                <input class="form-control" name="usuario" id="usuario" placeholder="Digite seu nome de usuário" type="text">
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="senha">Senha</label>
                                <input class="form-control" name="senha" id="senha" placeholder="Digite sua senha" type="password">
                            </div>
                            <button type="submit" class="btn btn-default">Entrar</button>
                        </form>

                    </div>

                    <div class="col-md-4">
                        
                    </div>

                </div>
            </div>
        </div>
        <footer class="section section-primary rodape">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <h1>Fast Inventory</h1>
                        <p>Copyright © 2015 | Raul Guilherme Pereira
                            <br>Telefone (11) 4022-3398
                            <br>Celular (11) 99988-2345</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="text-info text-right">
                            <br>
                            <br>
                        </p>
                        <div class="row">
                            <div class="col-md-12 hidden-lg hidden-md hidden-sm text-left">
                                <a href="#"><i class="fa fa-3x fa-fw fa-twitter text-inverse"></i></a>
                                <a href="#"><i class="fa fa-3x fa-fw fa-facebook text-inverse"></i></a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 hidden-xs text-right">
                                <a href="#"><i class="fa fa-3x fa-fw fa-twitter text-inverse"></i></a>
                                <a href="#"><i class="fa fa-3x fa-fw fa-facebook text-inverse"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</footer>