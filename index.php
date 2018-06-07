<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login  - SysReserva</title>
        <link href='public/img/favicon.ico' rel='shortcut icon' type='image/vnd.microsoft.icon' />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="public/css/login.css">
        <link rel="stylesheet" type="text/css" href="public/css/loading.css">
        <script src="public/js/lib/jquery.min.js"></script>
        <script src="public/js/signin.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </head>
    <body>

        <div class="logo container">
            <img src="public/img/logo_ifce.png" class="logo-if"><br>

        </div>
        <div class="logo-sysreserva container">
            <img src="public/img/logo_sysreserva.png" class="">
        </div>
        <div class="formLogin" >
            <div class="login-triangle"></div>
            <div class="container_form container">
                <form class="form-horizontal login-form" name="login-form" id="login-form">
                    <div class="input-group input-group-lg" style="margin-top: 2%;">
                        <span class="input-group-addon icon" id="sizing-addon1"><i class="glyphicon glyphicon-user iconGly"></i></span>
                        <input type="text" class="form-control" id="login" name="login" placeholder="Usuário">
                    </div>
                    <br>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon icon" id="sizing-addon1">
                            <i class="glyphicon glyphicon-lock iconGly"></i>
                        </span>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Senha">
                    </div>
                    <br>
                    <button type="button" class="form-control btn-confirm btn-login">
                        <span class="login" >Login </span>
                        <span class="iconSignin"><i class="glyphicon glyphicon-log-in "></i></span>
                    </button>
                    <div class="loader container" id="loader"></div><br/>
                    <span class="">
                        <a href="#" style="color: white;">Esqueceu sua senha?</a><br><br>
                        <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                    </span>
                    <div class="informacoes">
                        <span class="">CTI - Coordenadoria de Tecnologia da Informação</span><br>
                        <span class="">NDS - Núcleo de Desenvolvimento de Software 2017</span>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" role="dialog" id="modalCamposNulos">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" style="text-align: center;">Aviso</h4>
                    </div>
                    <div class="modal-body">
                        <p class="" style="text-align: center;">Por favor preencha todos os campos!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="modalErroLogin">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" style="text-align: center;">Aviso</h4>
                    </div>
                    <div class="modal-body">
                        <p class="" style="text-align: center;">Erro de login, por favor tente novamente!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </body>
</html>