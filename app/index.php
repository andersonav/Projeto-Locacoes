<html lang="pt-br">
    <head>
        <title>Locações - Login</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <style> 
            .hidden{
                display: none;
            }
            body{
                font-family: 'Calibri';
            }
            a{
                text-decoration: none;
                color: white;
                font-size: 20px;
            }
            a:hover{
                text-decoration: none;
                color: white;
            }
            .logo{
                height: 40%;
            }
            .logo img{
                display: block;
                margin-left: auto;
                margin-right: auto;

            }
            .formLogin{
                background-color: #006B43; 
                height: 60%;
                width: 100%;
            }
            .logo img{
                margin-top: 3%;
                width: 500px;
            }

            .container{
                text-align: center;
                width: 400px;
            }

            /* The triangle form is achieved by a CSS hack */
            .login-triangle {
                width: 0;
                margin-right: auto;
                margin-left: auto;
                border: 12px solid transparent;
                border-top-color: white;
            }
            .icon{
                background-color: white;
            }   
            .informacoes{
                color: white;
                margin-top: 5em;
            }
            .iconSignin{
                float: right;    
            }
            .login{
                float: left;
            }
            .btn-confirm{
                height: 50px;
                font-size: 20px;
                border: 2px solid #fff;
                background-color: transparent;
                color: white;

            }

            @media (max-width: 762px){
                .container{
                    width: 100%;
                }
                img{
                    width: 90% !important;
                }
                .logo{
                    height: 20%;
                }
                .formLogin{
                    height: 80%;
                }

            }

        </style>
    </head>
    <body>
        <div class="logo"> 
            <img class="" src="../public/img/logo_ifce.png" />
        </div>
        <div class="formLogin"> 
            <div class="login-triangle"></div>
            <div class="container">
                <form class="form-horizontal" role="form" method="POST">
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon icon" id="sizing-addon1"><i class="glyphicon glyphicon-user iconGly"></i></span>
                        <input type="email" class="form-control" placeholder="Usuário" name="email" required autofocus>   
                    </div>

                    <br>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon icon" id="sizing-addon1"><i class="glyphicon glyphicon-lock iconGly"></i></span>
                        <input type="password" class="form-control" placeholder="Senha" name="password" required>
                    </div>

                    <input type="checkbox" class="hidden" name="remember">
                    <br>
                    <button type="submit" class="form-control btn-confirm"><span class="login">Login </span><span class="iconSignin"><i class="glyphicon glyphicon-log-in"></i></span></button>
                </form>
                <span class=""><a href="#">Esqueceu sua senha?</a></span>
                <div class="informacoes">
                    <span class="">CTI - Coordenadoria de Tecnologia da Informação</span><br>
                    <span class="">NDS - Núcleo de Desenvolvimento de Software 2017</span>
                </div>
            </div>
        </div>
    </body>
</html>