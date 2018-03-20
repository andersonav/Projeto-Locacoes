<!DOCTYPE html>
<html>
    <head>
        <title>SysReserva</title>
        <meta charset='utf-8' />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <meta name="csrf-token" content="HYPw6xw4Raa7CMtRIKgqxyu1bRuoyms7zGFfwumP">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">  
        <link href='public/img/favicon.ico' rel='shortcut icon' type='image/vnd.microsoft.icon' />
        <link href="public/css/materialize.min.css" rel="stylesheet" />
        <link href='public/css/fullcalendar.min.css' rel='stylesheet' />
        <link href='public/css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
        <link href='public/css/location_style.css' rel='stylesheet' />
        <link href='public/css/footer.css' rel='stylesheet' />
        <link href='public/css/estilo.css' rel='stylesheet' />
        <script src='public/js/lib/moment.min.js'></script>
        <script src='public/js/lib/jquery.min.js'></script>
        <script src='public/js/lib/jquery-ui.min.js'></script>
        <script src='public/js/fullcalendar.min.js'></script>
        <script src='public/js/locale-all.js'></script>
        <script src='public/js/locale/pt-br.js'></script>
        <script src='public/js/app_user.js'></script>
        <script src='public/js/materialize.min.js'></script>
    </head>
    <body>
        <nav class="nav">
            <div class="container desktop">
                <div class="logos left">
                    <img src="public/img/intraneteifce.png">
                </div>
                <div class="menu right">
                    <div class="informacoes">
                        <div class="about truncate">
                            <a href="#!">Sobre nós</a>
                            <a href="#!">Equipe</a>
                            <a href="#!">Trabalhe conosco</a>
                            <a href="#!">Contatos</a>
                        </div>
                        <div class="filter row">
                            <a href="#!"><img src="public/img/login.png" width="30px" height="30px"></a>

                            <div class="menuPesquisa z-depth-3">
                                <input class="pesquisa" id="search" type="search" placeholder="Pelo que você está procurando?">
                                <i class="material-icons prefix">&#xE8B6;</i>
                            </div>

                        </div>
                        <div class="blocoMenu">
                            <a class='dropdown-button' href='#' data-activates='dropdown1'>
                                Administrativo
                            </a>
                            <a class='dropdown-button' href='#' data-activates='dropdown1'>
                                Educacional
                            </a>
                            <a class='dropdown-button' href='#' data-activates='dropdown1'>
                                Esportivo
                            </a>
                            <a class='dropdown-button' href='#' data-activates='dropdown1'>
                                Outros
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="mobile row">
                <div class="col s2 nav-FuncoesMobile mobile-demo" id="button-collapse" data-activates="mobile-demo">
                    <img src="public/img/sanduiche.png">
                </div>
                <div class="col s2 nav-FuncoesMobile">
                    <a href="JavaScript: window.history.back();"><img src="public/img/back.png"></a>
                </div>
                <div class="col s2 nav-FuncoesMobile" onclick="#!">
                    <a href="#!"><img src="public/img/home.png"></a>
                </div>
                <div class="col s2 nav-FuncoesMobile">
                    <a href="#!"><img src="public/img/login.png"></a>
                </div>
                <div class="col offset-s2 s2 nav-FuncoesMobile" id="abrirPesquisa">
                    <a><img src="public/img/lupa.png"></a>
                </div>
                <ul class="side-nav" id="mobile-demo">
                    <li> <a href="JavaScript: window.history.back();"> <i class="material-icons left">undo</i>Voltar </a> </li>
                    <li> <a href="#!"> <i class="material-icons left">home</i>Início </a> </li>
                    <li >
                        <a href="#!"><i class="material-icons left">computer</i>Suporte</a>
                    </li>
                    <li >
                        <a href="#!"><i class="material-icons left">settings</i>Sistemas</a>
                    </li>
                    <li >
                        <a href="#!"><i class="material-icons left">restaurant</i>Refeições</a>
                    </li>
                    <li >
                        <a href="#!"><i class="material-icons left">send</i>Entrar</a>
                    </li>
                </ul>
            </div>
        </nav>
        <main>
            <div class="submenu desktop">
                <div class="container">
                    <a href="#!" class="breadcrumb">início</a>
                    <a href="#!" class="breadcrumb">Suporte</a>
                    <a href="#!" class="breadcrumb">Sistemas</a>
                    <a href="#!" class="breadcrumb">Reservas</a>
                    <!--<a href="#!" class="breadcrumb">Entrar</a>-->

                </div>
            </div>

            <div class="input-field col s12 pesquisar">
                <div class="z-depth-2">
                    <div class="input-field">
                        <input id="search" type="search" name="pesquisar" placeholder="Pelo que você está procurando?">                
                        <label class="label-icon" for="search"><i class="material-icons">&#xE8B6;</i></label>
                        <i class="material-icons fecharPesquisa">&#xE5CD;</i>

                    </div>

                </div>
            </div>
            <!--       Container para Modal e Adicionar Evento-->
            <div class="container">
                <div id="modalEventoNulo" class="modal" style="width: 20% !important; margin-top: 10% !important;">
                    <div class="modal-content">
                        <h4 class="center">Aviso</h4>
                        <p class="center">Não há eventos cadastrados neste ambiente!</p>
                    </div>
                    <div class="modal-footer">
                        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
                    </div>
                </div>
                <div id="modalCamposNulos" class="modal">
                    <div class="modal-content">
                        <h4>Alerta</h4>
                        <p>Por favor preencha todos os campos!</p>
                    </div>
                    <div class="modal-footer">
                        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
                    </div>
                </div>
                <div id="modalDataInicioMaiorQueFinal" class="modal">
                    <div class="modal-content">
                        <h4>Alerta</h4>
                        <p>A sua data inicial é maior que a final, por favor corrija isso!</p>
                    </div>
                    <div class="modal-footer">
                        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
                    </div>
                </div>
                <div id="modalInformationEvent" class="modal">
                    <div class="modal-content" id="contentInformationEvent">
                        <!--                    <h4>Alerta</h4>
                                            <p>Por favor preencha todos os campos!</p>-->
                    </div>
                    <div class="modal-footer">
                        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
                    </div>
                </div>
                <!--                <div class="row topo">
                                    <div class="col s12 m3 logo center"> 
                                        <img class="" src="public/img/logo_sysreserva.png" style="width: 150px; height: 90px; margin: 10px;"/>
                                    </div>
                                    <div class="col s12 m9 btnPesquisar">
                                        <form class="col s12 m12" style="margin: 15px;">
                                            <div class="input-field col s12 m12">
                                                <i class="material-icons prefix">search</i>
                                                <input id="icon_prefix" type="text" class="validate inputPesquisa" placeholder="Pesquisar">
                                                <label class="corLogo-text">Pesquise um evento</label>
                                            </div>
                                        </form>
                                    </div>
                </div>--><br><br><br>
                <div class="row pesquisaBySelects">
                    <div class="input-field col s12 m4">
                        <select name="tipo" class="sel-tipo-evento-pesquisa" id="sel-tipo-evento-pesquisa">
                            <option value="" disabled selected>Escolha sua opção</option>
                            <!--                        <option value="1">Servidor</option>
                                                    <option value="2">Aluno</option>
                                                    <option value="3">Tercerizado</option>
                                                    <option value="4">Mestrado</option>
                                                    <option value="5">Bolsista</option>-->
                        </select>
                        <label class="corLogo-text">Tipo de Evento: </label>
                    </div>
                    <div class="input-field col s12 m4 divSelBloco">
                        <select name="bloco" class="sel-bloco-pesquisa" id="sel-bloco-pesquisa">
                            <option value="" disabled selected>Escolha sua opção</option>
                            <!--                        <option value="1">Servidor</option>
                                                    <option value="2">Aluno</option>
                                                    <option value="3">Tercerizado</option>
                                                    <option value="4">Mestrado</option>
                                                    <option value="5">Bolsista</option>-->
                        </select>
                        <label class="corLogo-text">Bloco: </label>
                    </div>
                    <div class="input-field col s12 m4 divSelAmbiente">
                        <select name="ambiente" class="sel-ambiente-pesquisa" id="sel-ambiente-pesquisa">
                            <option value="" disabled selected>Escolha sua opção</option>
                            <!--<option value="" disabled selected>Escolha sua opção</option>-->
                            <!--                        <option value="1">Servidor</option>
                                                    <option value="2">Aluno</option>
                                                    <option value="3">Tercerizado</option>
                                                    <option value="4">Mestrado</option>
                                                    <option value="5">Bolsista</option>-->
                        </select>
                        <label class="corLogo-text">Ambiente: </label>
                    </div>
                    <div class="input-field col s12 m6 divDataInicio">
                        <input id="formDataInicio" type="text" class="dataInicio" placeholder="Escolha a Data Inicial" name="dataInicio">
                        <label for="icon_prefix" class="corLogo-text active dataInicioLabel">Data Início:</label>
                    </div>
                    <!--                    <div class="input-field col s12 m3">
                                            <input id="formHoraInicio" type="text" class="validate horaInicio" placeholder="Escolha a Hora Inicial" name="horaInicio">
                                            <label for="icon_prefix" class="corLogo-text active">Hora Início:</label>-->
                    <!--</div>-->
                    <div class="input-field col s12 m6">
                        <input id="formDataFim" type="text" class="dataFim" placeholder="Escolha a Data Final" name="dataFim">
                        <label for="icon_prefix" class="corLogo-text active dataFimLabel">Data Fim:</label>
                    </div>
                    <!--                    <div class="input-field col s12 m3">
                                            <input id="formHoraFim" type="text" class="validate horaFim" placeholder="Escolha a Hora Final" name="horaFim">
                                            <label for="icon_prefix" class="corLogo-text active">Hora Fim:</label>
                                        </div>-->
                </div>
                <!--            <div class="texto">
                                <h3>SysReserva</h3>
                            </div>-->

                <div id='calendarUser'></div>
                <div id='readyCalendarUser'></div>
            </div>
        </main>
        <footer>
            <div class="rodape1">
                <div class="container">
                    <div class="row rodape-row">
                        <div class="col m4 s12 rodape-icon">
                            <img src="public/img/intranethorizontal.png">
                        </div>
                        <div class="col m2 s4 rodape-icon right">
                            <img src="public/img/esportivo.png">
                        </div>
                        <div class="col m2 s4 rodape-icon right">
                            <img src="public/img/educacional.png">
                        </div>
                        <div class="col m2 s4 rodape-icon right">
                            <img src="public/img/administrativo.png">
                        </div>
                    </div>
                    <div class="linefooter"></div>
                    <div class="instituto">
                        Instituto Federal de Educação, Ciência e Tecnologia do Ceará
                    </div>
                    <div class="row white-text">
                        <div class="col m4 s12">
                            <h4 class="titulo-informacao">Endereço</h4>
                            Avenidade Parque Central, S/N Distrito Industrial I,
                            CEP: 61.939-140 - Maracanaú - Ceará
                        </div>
                        <div class="col m4 s12">
                            <h4 class="titulo-informacao">Contato</h4>
                            Horário de atendimento: 7h às 18h
                            Maiores informações: (85) 3878-6301
                        </div>
                        <div class="col m4 s12 rede-sociais">
                            <a  target="_blank" href="#!">
                                <img src="public/img/email.png"></a>
                            <a  target="_blank" href="https://www.facebook.com/Instituto-Federal-de-Educa%C3%A7%C3%A3o-Ci%C3%AAncia-e-Tecnologia-do-Cear%C3%A1-IFCE-471223182903300/">
                                <img src="public/img/facebook.png"></a>
                            <a target="_blank" href="https://www.youtube.com/user/ifcecoficialcomunica?feature=results_main">
                                <img src="public/img/youtube.png" ></a>
                            <a target="_blank" href="https://twitter.com/IFCE_">
                                <img src="public/img/twitter.png"></a>
                        </div>
                    </div>

                </div>
            </div>
            <div class="rodape2">
                <div class="desenvolvedores container">
                    <div class="equipe">
                        <p class="white-text">Núcleo de Desenvolvimento de Softwares - NDS</p>
                        <p class="white-text">Coordenadoria de Tecnologia da Informação - CTI</p>
                        <p class="white-text">IFCE Campus Maracanaú - 2018</p>
                    </div>
                </div>
            </div>
        </footer>

        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-90355801-2', 'auto');
            ga('send', 'pageview');

        </script>
    </body>
</html>