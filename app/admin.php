<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8' />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <title>Administrador</title>
        <meta name="csrf-token" content="HYPw6xw4Raa7CMtRIKgqxyu1bRuoyms7zGFfwumP">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">  
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link href="../public/css/materialize.min.css" rel="stylesheet" />
        <link href='../public/css/fullcalendar.min.css' rel='stylesheet' />
        <link href='../public/css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
        <link href='../public/css/footer.css' rel='stylesheet' />
        <link href='../public/css/estilo.css' rel='stylesheet' />
        <link href='../public/css/location_style.css' rel='stylesheet' />
        <link href='../public/img/favicon.ico' rel='shortcut icon' type='image/vnd.microsoft.icon' />
        <script src='../public/js/lib/moment.min.js'></script>

        <script src='../public/js/lib/jquery.min.js'></script>
        <script src="../public/js/lib/jquery-ui.js"></script>
        <script src='../public/js/lib/jquery.maskedinput.min.js'></script>
        <script src='../public/js/fullcalendar.min.js'></script>
        <script src='../public/js/locale-all.js'></script>
        <script src='../public/js/locale/pt-br.js'></script>
        <script src='../public/js/app.js'></script>
        <script src='../public/js/materialize.min.js'></script>
    </head>
    <body>
        <nav class="nav">
            <div class="container desktop">
                <div class="logos left">
                    <img src="../public/img/intraneteifce.png">
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
                            <a href="#!"><img src="../public/img/login.png" width="30px" height="30px"></a>

                            <div class="menuPesquisa z-depth-3">
                                <input class="pesquisa" id="search" type="search" placeholder="Pelo que você está procurando?">
                                <i class="material-icons prefix">&#xE8B6;</i>
                            </div>

                        </div>
                        <div class="blocoMenu">
                            <a class='dropdown-button openModalAdicionarEvento' href='#' data-activates='dropdown1'>
                                Cadastros
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
                    <a href="JavaScript: window.history.back();"><img src="../public/img/back.png"></a>
                </div>
                <div class="col s2 nav-FuncoesMobile" onclick="#!">
                    <a href="#!"><img src="../public/img/home.png"></a>
                </div>
                <div class="col s2 nav-FuncoesMobile">
                    <a href="#!"><img src="../public/img/login.png"></a>
                </div>
                <div class="col offset-s2 s2 nav-FuncoesMobile" id="abrirPesquisa">
                    <a><img src="../public/img/lupa.png"></a>
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
                        <a href="#!"><i class="material-icons left">restaurant</i>Reservas</a>
                    </li>
                    <li >
                        <a href="#!"><i class="material-icons left">send</i>Administrativo</a>
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
                    <a href="#!" class="breadcrumb">Administrativo</a>

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
            <!--            -->
            <!--            <nav>
                            <div class="nav-wrapper">
                                <div class="container">
                                    <a href="#!" class="brand-logo">IFCE</a>
                                    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
            
                                    <ul class="left hide-on-med-and-down" style="margin-left: 7em;">       
                                        <li> <a href="JavaScript: window.history.back();"> <i class="material-icons left">undo</i>Voltar </a> </li>
                                        <li> <a href="#"> <i class="material-icons left">home</i>Início </a> </li>
                                    </ul>
                                    <ul class="right hide-on-med-and-down ulNav">
                                        <li >
                                            <a href="javascript:void(0);" class="openModalAdicionarEvento"><i class="material-icons left">queue</i>Cadastros</a>
                                        </li>
                                        <li >
                                            <a href="#"><i class="material-icons left">assessment</i>Relatórios</a>
                                        </li>
                                        <li >
                                            <a href="#"><i class="material-icons left">settings</i>Utilitários</a>
                                        </li>
                                        <li >
                                            <a class='dropdown-button' href='#' data-activates='dropdown1'><i class="material-icons left">help</i>Ajuda</a>
                                        </li>
                                    </ul>
                                    <ul id='dropdown1' class='dropdown-content'>
                                        <li><a href="#!">Teste</a></li>
                                        <li><a href="#!">Teste</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#!">Teste</a></li>
                                        <li><a href="#!"><i class="material-icons">view_module</i>four</a></li>
                                        <li><a href="#!"><i class="material-icons">cloud</i>five</a></li>
                                    </ul>
                                    <ul class="side-nav" id="mobile-demo">
                                        <li> <a href="JavaScript: window.history.back();"> <i class="material-icons left">undo</i>Voltar </a> </li>
                                        <li> <a href="#"> <i class="material-icons left">home</i>Início </a> </li>
                                        <li >
                                            <a href="javascript:void(0);" class="openModalAdicionarEvento"><i class="material-icons left">queue</i>Cadastros</a>
                                        </li>
                                        <li >
                                            <a href="#"><i class="material-icons left">assessment</i>Relatórios</a>
                                        </li>
                                        <li >
                                            <a href="#"><i class="material-icons left">settings</i>Utilitários</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>-->
            <!--       Container para Modal e Adicionar Evento-->
            <div class="container"> 
                <div id="modalEventoNulo" class="modal" style="width: 20% !important; margin-top: 10% !important;">
                    <div class="modal-content" >
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
                <div id="modalDataAnterior" class="modal">
                    <div class="modal-content">
                        <h4>Alerta</h4>
                        <p>Não é possível adicionar eventos em datas ou horas anteriores a atual!</p>
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
                <div id="modalDataEquiSerRef" class="modal">
                    <div class="modal-content">
                        <h4>Alerta</h4>
                        <p>Data do Equipamento não está de acordo com a data do evento!</p>
                    </div>
                    <div class="modal-footer">
                        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
                    </div>
                </div>
                <div id="modalCheckNulo" class="modal">
                    <div class="modal-content">
                        <h4>Alerta</h4>
                        <p>Por favor, Material, Serviço e Refeição precisam ser preenchidos!</p>
                    </div>
                    <div class="modal-footer">
                        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
                    </div>
                </div>
                <div id="modalDatasIguais" class="modal">
                    <div class="modal-content">
                        <h4>Alerta</h4>
                        <p>No ambiente selecionado já existe um evento com esse horário, por favor selecione um novo ambiente ou um novo horário.</p>
                    </div>
                    <div class="modal-footer">
                        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
                    </div>
                </div>
                <div id="modalDatasIguaisToRepeticao" class="modal">
                    <div class="modal-content contentTipoRepeticaoDataIgual">
                        <h4>Alerta</h4>
                        <p>No ambiente selecionado já existe um evento com esse horário, por favor selecione um novo ambiente ou um novo horário.</p>
                    </div>
                    <div class="modal-footer">
                        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
                    </div>
                </div>
                <div id="modalQuantidadeSolicitadaMaiorQueDisponivel" class="modal">
                    <div class="modal-content">
                        <h4>Alerta</h4>
                        <p>Quantidade solicitada para este equipamento é maior que a disponível, por favor diminua a mesma.</p>
                    </div>
                    <div class="modal-footer">
                        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
                    </div>
                </div>
                <div id="modalAmbienteNulo" class="modal">
                    <div class="modal-content">
                        <h4>Alerta</h4>
                        <p>Por favor selecione um ambiente para verificar se a data selecionada está disponível.</p>
                    </div>
                    <div class="modal-footer">
                        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
                    </div>
                </div>
                <div id="modalMoreOneDaySelected" class="modal">
                    <div class="modal-content">
                        <h4>Alerta</h4>
                        <p>Por favor, selecione um cadastro mais específico para repetir esse evento.</p>
                    </div>
                    <div class="modal-footer">
                        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
                    </div>
                </div>
                <div id="modalDateNotSelected" class="modal">
                    <div class="modal-content">
                        <h4>Alerta</h4>
                        <p>Por favor, selecione uma data.</p>
                    </div>
                    <div class="modal-footer">
                        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
                    </div>
                </div>
                <div id="modalAdicionarAtualizarMaterial" class="modal">
                    <div class="modal-content">
                        <h4 class="center textAdionarAtualizarMaterial"></h4>
                        <div class="divider"></div>
                        <br>
                        <form class="col s12" id="form_upd_event">
                            <div class="row">
                                <div class="input-field col s12 m4">
                                    <select name="sel-equipamentos" class="sel-equipamentos" id="sel-equipamentos">
                                        <option>Teste</option>
                                        <option>Teste</option>
                                        <option>Teste</option>
                                    </select>
                                    <label class="corLogo-text">Equipamentos disponíveis:</label>
                                </div>
                                <div class="input-field col s12 m4">
                                    <input id="icon_prefix" type="text" class="validate quantidadeDisponivel" placeholder="Quantidade disponível" disabled>
                                    <label for="icon_prefix" class="corLogo-text active">Quantidade disponível:</label>
                                </div>
                                <div class="input-field col s12 m4">
                                    <input id="icon_prefix" type="text" class="validate quantidadeSolicitada" placeholder="Digite a quantidade solicitada">
                                    <label for="icon_prefix" class="corLogo-text active">Quantidade solicitada:</label>
                                </div>
                                <div class="input-field col s12 m3 divDataInicio">
                                    <input id="formDataInicio" type="text" class="dataInicio" placeholder="Escolha a Data Inicial" name="dataInicio">
                                    <label for="icon_prefix" class="corLogo-text active dataInicioLabel">Data Início:</label>
                                </div>
                                <div class="input-field col s12 m3">
                                    <input id="formHoraInicio" type="text" class="validate horaInicio" placeholder="Escolha a Hora Inicial" name="horaInicio">
                                    <label for="icon_prefix" class="corLogo-text active">Hora Início:</label>
                                </div>
                                <div class="input-field col s12 m3">
                                    <input id="formDataFim" type="text" class="dataFim" placeholder="Escolha a Data Final" name="dataFim">
                                    <label for="icon_prefix" class="corLogo-text active dataFimLabel">Data Fim:</label>
                                </div>
                                <div class="input-field col s12 m3">
                                    <input id="formHoraFim" type="text" class="validate horaFim" placeholder="Escolha a Hora Final" name="horaFim">
                                    <label for="icon_prefix" class="corLogo-text active">Hora Fim:</label>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
                    </div>
                </div>
                <div id="modalAdicionarEventoClickDay" class="modal">
                    <div class="modal-content">
                        <h4 class="center">Adicionar Eventos</h4>
                        <div class="divider"></div>
                        <br>
                        <form class="col s12" id="form_add_event">
                            <div class="row">
                                <!--<input type="hidden" value="<?php echo $_SESSION['usu_id']; ?>" id="idUsuario">-->
                                <input type="hidden" value="1" id="idUsuario">
                                <div class="input-field col s12 m6">
                                    <input id="icon_prefix" type="text" class="validate nomeEvento" placeholder="Digite o nome do Evento">
                                    <label for="icon_prefix" class="corLogo-text active">Nome do Evento:</label>
                                </div>
                                <div class="input-field col s12 m6">
                                    <input id="icon_prefix" type="text" class="validate solicitante" placeholder="Digite o nome do Solicitante">
                                    <label for="icon_prefix" class="corLogo-text active">Solicitante:</label>
                                </div>
                                <div class="input-field col s12 m6">
                                    <input id="icon_prefix" type="tel" class="validate telefoneContatoSolicitante" maxlength="15" placeholder="Digite o telefone do Solicitante">
                                    <label for="icon_prefix" class="corLogo-text active">Telefone para contato:</label>
                                </div>
                                <div class="input-field col s12 m6">
                                    <input id="icon_prefix" type="email" class="validate emailContatoSolicitante" placeholder="Digite o email do Solicitante">
                                    <label for="icon_prefix" class="corLogo-text active">Email para contato:</label>
                                </div>
                                <div class="input-field col s12 m12">
                                    <input type="text" id="descricaoEvento" class="validate descricaoEvento" data-length="200" maxlength="201" placeholder="Digite a descrição do Evento">
                                    <label for="icon_prefix" class="corLogo-text active">Descrição do Evento</label>
                                </div>
                                <div class="input-field col s12 m4">
                                    <select name="tipo" class="sel-tipo-evento" id="sel-tipo-evento">
                                    </select>
                                    <label class="corLogo-text">Tipo de Evento: </label>
                                </div>
                                <div class="input-field col s12 m4">
                                    <select name="bloco" class="sel-bloco" id="sel-bloco">
                                    </select>
                                    <label class="corLogo-text">Bloco: </label>
                                </div>
                                <div class="input-field col s12 m4">
                                    <select name="ambiente" class="sel-ambiente" id="sel-ambiente">
                                    </select>
                                    <label class="corLogo-text">Ambiente: </label>
                                </div>
                                <div class="cadastroClickBtn mostrarWhenClickBtn center">
                                    <div class="input-field col s12 m5">
                                        <select name="tipoRepeticao" class="sel-tip-repeticao" id="sel-tip-repeticao">
                                        </select>
                                        <label class="corLogo-text">Repetir: </label>
                                    </div>
                                    <div class="input-field col s12 m3">
                                        <select name="aula" class="sel-aula" id="sel-aula">
                                        </select>
                                        <label class="corLogo-text">Aula?</label>
                                    </div>
                                    <div class="input-field col s12 m4 divInputProfessor">
                                        <input id="icon_prefix" type="text" class="validate nomeProfessor" placeholder="Digite o nome do professor" disabled>
                                        <label for="icon_prefix" class="corLogo-text active">Professor:</label>
                                    </div>
                                    <div class="calendarDayOfWeek" id="calendarDayOfWeek">

                                    </div>
                                </div>
                                <br><br>
                                <div class="input-field col s12 m3 divDataInicio">
                                    <input id="formDataInicio" type="text" class="dataInicio" placeholder="Escolha a Data Inicial" name="dataInicio">
                                    <label for="icon_prefix" class="corLogo-text active dataInicioLabel">Data Início:</label>
                                </div>
                                <div class="input-field col s12 m3">
                                    <input id="formHoraInicio" type="text" class="validate horaInicio" placeholder="Escolha a Hora Inicial" name="horaInicio">
                                    <label for="icon_prefix" class="corLogo-text active">Hora Início:</label>
                                </div>
                                <div class="input-field col s12 m3">
                                    <input id="formDataFim" type="text" class="dataFim" placeholder="Escolha a Data Final" name="dataFim">
                                    <label for="icon_prefix" class="corLogo-text active dataFimLabel">Data Fim:</label>
                                </div>
                                <div class="input-field col s12 m3">
                                    <input id="formHoraFim" type="text" class="validate horaFim" placeholder="Escolha a Hora Final" name="horaFim">
                                    <label for="icon_prefix" class="corLogo-text active">Hora Fim:</label>
                                </div>
                                <div class="col s12">
                                    <ul id="tabs-swipe-demo" class="tabs">
                                        <li class="tab col s3 active"><a class="active" href="#equipamentos">Materiais</a></li>
                                        <li class="tab col s3"><a href="#servicos">Serviços</a></li>
                                        <li class="tab col s3"><a href="#refeicoes">Refeições</a></li>
                                    </ul>
                                </div>
                                <div id="equipamentos" class="col s12 m12">
                                    <div class="row equipamento">
                                    </div>
                                </div>
                                <div id="servicos" class="col s12 m12">
                                    <div class="row servicos">

                                    </div>
                                </div>
                                <div id="refeicoes" class="col s12 m12">
                                    <div class="row refeicoes">

                                    </div>
                                </div>
                            </div>

                            <!--<div id="calendar2" class="cadastroClickBtn calendar2"></div>;-->
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button class="btnModal buttonOkay">CADASTRAR</button>
                        <button class="btnModal buttonCancel">CANCELAR</button>
                    </div>
                </div>
                <div id="modalUpdateEvent" class="modal">
                    <div class="modal-content" id="contentUpdateEvent">
                    </div>
                    <div class="modal-footer">
                        <button class="btnModal buttonUpdate">ATUALIZAR</button>
                        <button class="btnModal buttonCancel">CANCELAR</button>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="input-field col s12 m4">
                        <select name="tipo" class="sel-tipo-evento-pesquisa" id="sel-tipo-evento-pesquisa">
                            <option value="" disabled selected>Escolha sua opção</option>
                        </select>
                        <label class="corLogo-text">Tipo de Evento: </label>
                    </div>
                    <div class="input-field col s12 m4">
                        <select name="bloco" class="sel-bloco-pesquisa" id="sel-bloco-pesquisa">
                            <option value="" disabled selected>Escolha sua opção</option>
                        </select>
                        <label class="corLogo-text">Bloco: </label>
                    </div>
                    <div class="input-field col s12 m4">
                        <select name="ambiente" class="sel-ambiente-pesquisa" id="sel-ambiente-pesquisa">
                            <option value="" disabled selected>Escolha sua opção</option>
                        </select>
                        <label class="corLogo-text">Ambiente: </label>
                    </div>
                </div>
                <div id='calendar'></div>
                <div id="readyCalendar"></div>
            </div>
        </main>
        <footer>
            <div class="rodape1">
                <div class="container">
                    <div class="row rodape-row">
                        <div class="col m4 s12 rodape-icon">
                            <img src="../public/img/intranethorizontal.png">
                        </div>
                        <div class="col m2 s4 rodape-icon right">
                            <img src="../public/img/esportivo.png">
                        </div>
                        <div class="col m2 s4 rodape-icon right">
                            <img src="../public/img/educacional.png">
                        </div>
                        <div class="col m2 s4 rodape-icon right">
                            <img src="../public/img/administrativo.png">
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
                                <img src="../public/img/email.png"></a>
                            <a  target="_blank" href="https://www.facebook.com/Instituto-Federal-de-Educa%C3%A7%C3%A3o-Ci%C3%AAncia-e-Tecnologia-do-Cear%C3%A1-IFCE-471223182903300/">
                                <img src="../public/img/facebook.png"></a>
                            <a target="_blank" href="https://www.youtube.com/user/ifcecoficialcomunica?feature=results_main">
                                <img src="../public/img/youtube.png" ></a>
                            <a target="_blank" href="https://twitter.com/IFCE_">
                                <img src="../public/img/twitter.png"></a>
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
        <div id="dialog-confirm" title="Exclusão">
            <p class="textExclusao"><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span></p>
        </div>
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
