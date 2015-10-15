<html lang="pt-BR">
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css"
        rel="stylesheet" type="text/css">


        <!-- DataTables CSS -->
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.9/css/jquery.dataTables.css">
  
        <!-- jQuery -->
        <script type="text/javascript" charset="utf8" src="<?php echo base_url('DataTables/jQuery-2.1.4/jquery-2.1.4.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/DataTables/datatables.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/Plugins/jquery.maskedinput.min.js'); ?>"></script>
        
       
              


        <link rel="stylesheet" href="<?php echo base_url('assets/css/theme.css'); ?> ">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css'); ?> ">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-theme.css'); ?> ">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?> ">

        <link rel="shortcut icon" href="favicon.ico" >

        <title>Fast Inventory</title>

        <script>
        $(document).ready(function() {
            $('#myTable').DataTable( {
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.9/i18n/Portuguese-Brasil.json"
                }
            } );
        } );

        $(function() {
            $("#cnpj").mask("99.999.999/9999-99");
            $("#ie").mask("99999999-99");
            $("#dataEmissao").mask("99/99/9999");
            $("#dataVencimento").mask("99/99/9999");
            $("#data").mask("99/99/9999");
        });

        

        </script>
        

    </head>
    
    <body>

        
        <!-- Inicio Menu principal-->
        <div class="navbar navbar-default navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-ex-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url('usuario')?>">Fast Inventory</a>
                </div>
                <div class="collapse navbar-collapse" id="navbar-ex-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="<?php if($this->uri->segment(1)=="usuario"){echo "active";}?>">
                            <a href="<?php echo base_url('usuario'); ?>"> <i class="glyphicon glyphicon-user"></i> Usuário</a>
                        </li>
                        <li class="<?php if($this->uri->segment(1)=="ativo"){echo "active";}?>">
                            <a href="<?php echo base_url('ativo/listarEmpresas'); ?>"> <i class="glyphicon glyphicon-asterisk"></i> Ativo</a>
                        </li>
                        <li class="<?php if($this->uri->segment(1)=="localizacao"){echo "active";}?>">
                            <a href="<?php echo base_url('localizacao/cadastrarLocalizacao'); ?>"><i class="glyphicon glyphicon-remove-circle"></i> Localização</a>
                        </li>
                        <li class="<?php if($this->uri->segment(1)=="relatorio"){echo "active";}?>">
                            <a href="<?php echo base_url('relatorio'); ?>"><i class="glyphicon glyphicon-file"></i> Relatório</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('login/logoutUsuario'); ?>"><i class="glyphicon glyphicon-off"></i> Sair</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Fim Menu principal-->
        
        
        <!-- Inicio Menu Lateral-->
        <div class="section">
            <div class="container">
                <div class="row">
                    
                    <div class="col-md-3">
                        <!-- aqui vai ser o menu lateral-->
                        <?php echo $template['partials']['lateral']; ?>
                    </div>

                    <div class="col-md-1">
                        <br />
                    </div>

                    <div class="col-md-8 text-left">
                       <!-- aqui vai ser o conteudo-->
                       <?php echo $template['body']; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fim Menu Lateral-->

        <!-- Inicio rodapé-->
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
        <!-- Fim rodapé-->

    </body>

</html>