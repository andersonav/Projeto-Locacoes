<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8' />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href='../public/css/fullcalendar.min.css' rel='stylesheet' />
        <link href='../public/css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
        <link href='../public/css/nav_footer.css' rel='stylesheet' />
        <link href='../public/css/location_style.css' rel='stylesheet' />
        <script src='../public/js/lib/moment.min.js'></script>
        <script src='../public/js/lib/jquery.min.js'></script>
        <script src='../public/js/fullcalendar.min.js'></script>
        <script src='../public/js/locale-all.js'></script>
        <script src='../public/js/locale/pt-br.js'></script>
        <script src='../public/js/app.js'></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/js/materialize.min.js"></script>
    </head>
    <body>
        <nav>
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
                            <a href="#" class="openModalAdicionarEvento"><i class="material-icons left">queue</i>Cadastros</a>
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
<!--                        <li><a href="#!"><i class="material-icons">view_module</i>four</a></li>
                        <li><a href="#!"><i class="material-icons">cloud</i>five</a></li>-->
                    </ul>
                    <ul class="side-nav" id="mobile-demo">
                        <li> <a href="JavaScript: window.history.back();"> <i class="material-icons left">undo</i>Voltar </a> </li>
                        <li> <a href="#"> <i class="material-icons left">home</i>Início </a> </li>
                        <li >
                            <a href="#" class="openModalAdicionarEvento"><i class="material-icons left">queue</i>Cadastros</a>
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
        </nav>
        <!--       Container para Modal e Adicionar Evento-->
        <div class="container">
            <input type="hidden" name="pagina" value="admin">
            <div id="modalEventoNulo" class="modal">
                <div class="modal-content">
                    <h4>Alerta</h4>
                    <p>Eventos no ambiente selecionado não existem!</p>
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
            <div id="modalDatasIguais" class="modal">
                <div class="modal-content">
                    <h4>Alerta</h4>
                    <p>No ambiente selecionado já existe um evento com esse horário, por favor selecione um novo ambiente ou um novo horário.</p>
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
                            <div class="input-field col s12 m6">
                                <input id="icon_prefix" type="text" class="validate nomeEvento" placeholder="Digite o nome do Evento">
                                <label for="icon_prefix" class="corLogo-text active">Nome do Evento:</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input id="icon_prefix" type="text" class="validate solicitante" placeholder="Digite o nome do Solicitante">
                                <label for="icon_prefix" class="corLogo-text active">Solicitante:</label>
                            </div>
                            <div class="input-field col s12 m12">
                                <input type="text" id="descricaoEvento" class="validate descricaoEvento" data-length="200" maxlength="201" placeholder="Digite a descrição do Evento">
                                <label for="icon_prefix" class="corLogo-text active">Descrição do Evento</label>
                            </div>
                            <div class="input-field col s12 m3">
                                <select name="cor" class="sel-color" id="sel-color">
                                    <!--                                    <option value="" disabled selected>Escolha sua opção</option>-->
                                    <!--                            <option value="1">Servidor</option>
                                                                <option value="2">Aluno</option>
                                                                <option value="3">Tercerizado</option>
                                                                <option value="4">Mestrado</option>
                                                                <option value="5">Bolsista</option>-->
                                </select>
                                <label class="corLogo-text">Cor do Evento: </label>
                            </div>
                            <div class="input-field col s12 m3">
                                <select name="tipo" class="sel-tipo-evento" id="sel-tipo-evento">
                                    <!--                                    <option value="" disabled selected>Escolha sua opção</option>-->
                                    <!--                            <option value="1">Servidor</option>
                                                                <option value="2">Aluno</option>
                                                                <option value="3">Tercerizado</option>
                                                                <option value="4">Mestrado</option>
                                                                <option value="5">Bolsista</option>-->
                                </select>
                                <label class="corLogo-text">Tipo: </label>
                            </div>
                            <div class="input-field col s12 m3">
                                <select name="bloco" class="sel-bloco" id="sel-bloco">
                                    <option value="" disabled selected>Escolha sua opção</option>
                                    <!--                            <option value="1">Servidor</option>
                                                                <option value="2">Aluno</option>
                                                                <option value="3">Tercerizado</option>
                                                                <option value="4">Mestrado</option>
                                                                <option value="5">Bolsista</option>-->
                                </select>
                                <label class="corLogo-text">Bloco: </label>
                            </div>
                            <div class="input-field col s12 m3">
                                <select name="ambiente" class="sel-ambiente" id="sel-ambiente">
                                    <option value="" disabled selected>Escolha sua opção</option>
                                    <!--                            <option value="1">Servidor</option>
                                                                <option value="2">Aluno</option>
                                                                <option value="3">Tercerizado</option>
                                                                <option value="4">Mestrado</option>
                                                                <option value="5">Bolsista</option>-->
                                </select>
                                <label class="corLogo-text">Ambiente: </label>
                            </div>
                            <div class="input-field col s12 m3">
                                <input id="icon_prefix" type="text" class="validate dataInicio" placeholder="Escolha a Data Inicial">
                                <label for="icon_prefix" class="corLogo-text active">Data Início:</label>
                            </div>
                            <div class="input-field col s12 m3">
                                <input id="icon_prefix" type="text" class="validate horaInicio" placeholder="Escolha a Hora Inicial">
                                <label for="icon_prefix" class="corLogo-text active">Hora Início:</label>
                            </div>
                            <div class="input-field col s12 m3">
                                <input id="icon_prefix" type="text" class="validate dataFim" placeholder="Escolha a Data Final">
                                <label for="icon_prefix" class="corLogo-text active">Data Fim:</label>
                            </div>
                            <div class="input-field col s12 m3">
                                <input id="icon_prefix" type="text" class="validate horaFim" placeholder="Escolha a Hora Final">
                                <label for="icon_prefix" class="corLogo-text active">Hora Fim:</label>
                            </div>
                            <div class="col s12">
                                <ul id="tabs-swipe-demo" class="tabs">
                                    <li class="tab col s3 active"><a class="active" href="#equipamentos">Equipamentos</a></li>
                                    <li class="tab col s3"><a href="#servicos">Serviços</a></li>
                                    <li class="tab col s3"><a href="#refeicoes">Refeições</a></li>
                                </ul>
                            </div>
                            <div id="equipamentos" class="col s12 m12">
                                <div class="row equipamento">
                                    <div class="col s12 m2">
                                        <img src="../public/img/datashow.png">
                                        <p>
                                            <input type="checkbox" class="filled-in" id="filled-in-box" />
                                            <label for="filled-in-box">Qtd: 1</label>
                                        </p>
                                    </div>
                                    <div class="col s12 m2">
                                        <img src="../public/img/microfone.png">
                                        <p>
                                            <input type="checkbox" class="filled-in" id="filled-in-box2" />
                                            <label for="filled-in-box2">Qtd: 1</label>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div id="servicos" class="col s12 m12">
                                <div class="row servicos">
                                    <div class="col s12 m2">
                                        <img src="../public/img/construcao.png">
                                        <p>
                                            <input type="checkbox" class="filled-in" id="servicos1" />
                                            <label for="servicos1">Qtd: 1</label>
                                        </p>
                                    </div>
                                    <div class="col s12 m2">
                                        <img src="../public/img/construcao.png">
                                        <p>
                                            <input type="checkbox" class="filled-in" id="servicos2" />
                                            <label for="servicos2">Qtd: 1</label>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div id="refeicoes" class="col s12 m12">
                                <div class="row refeicoes">
                                    <div class="col s12 m2">
                                        <img src="../public/img/construcao.png">
                                        <p>
                                            <input type="checkbox" class="filled-in" id="refeicoes1" />
                                            <label for="refeicoes1">Qtd: 1</label>
                                        </p>
                                    </div>
                                    <div class="col s12 m2">
                                        <img src="../public/img/construcao.png">
                                        <p>
                                            <input type="checkbox" class="filled-in" id="refeicoes2" />
                                            <label for="refeicoes2">Qtd: 1</label>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row cadastroClickBtn mostrarWhenClickBtn center" style="margin: 3px auto; width: 50%;">
                            <div class="col s12 m3 textRepeat">Repetir: </div>
                            <div class="col s12 m3 repeatSwitch" id="nao">Não</div>
                            <div class="col s12 m3 repeatSwitch" id="semana">Semana</div>
                            <div class="col s12 m3 repeatSwitch" id="semestre">Semestre</div>
                            <br><br>
                            <div class="aula">
                                <div class="col s12 m3 teste">Aula? </div>
                                <div class="col s12 m3" id="">
                                    <select name="escolhaAula">
                                        <option value="" disabled>Opção</option>
                                        <option value="1" selected>Sim</option>
                                        <option value="2">Não</option>
                                    </select>
                                </div>
                                <div class="col s12 m6 DivInputProfessor" id="">
                                    <input type="text" class="InputProfessor validate" placeholder="Nome do Professor">
                                </div>
                            </div>

                        </div>
                        <!--<div id="calendar2" class="cadastroClickBtn calendar2"></div>;-->
                    </form>

                </div>
                <div class="modal-footer">
                    <button class="btnModal buttonOkay">CADASTRAR</button>
                    <button class="btnModal buttonCancel">CANCEL</button>
                    <!--                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a>-->
                </div>
            </div>
            <div id="modalUpdateEvent" class="modal">
                <div class="modal-content" id="contentUpdateEvent">
<!--                    <h4>Alerta</h4>
                    <p>Por favor preencha todos os campos!</p>-->
                </div>
                <div class="modal-footer">
                    <button class="btnModal buttonUpdate">ATUALIZAR</button>
                    <button class="btnModal buttonCancel">CANCEL</button>
                </div>
            </div>
            <div class="row topo">
                <div class="col s12 m3 logo center"> 
                    <img class="" src="../public/img/logo_sysreserva.png" style="width: 150px; height: 90px; margin: 10px;"/>
                </div>
                <div class="col s12 m9 btnPesquisar">
                    <form class="col s12 m12" style="margin: 15px;">
                        <div class="input-field col s12 m12">
                            <i class="material-icons prefix">search</i>
                            <input id="icon_prefix" type="text" class="validate solicitante" placeholder="Pesquisar">
                            <label class="corLogo-text">Pesquise um evento</label>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m4">
                    <select name="tipo" class="sel-tipo-evento-pesquisa" id="sel-tipo-evento-pesquisa">
                        <option value="" disabled selected>Escolha sua opção</option>
                        <!--                       <option value="1">Servidor</option>
                                                <option value="2">Aluno</option>
                                                <option value="3">Tercerizado</option>
                                                <option value="4">Mestrado</option>
                                                <option value="5">Bolsista</option>-->
                    </select>
                    <label class="corLogo-text">Tipo de Evento: </label>
                </div>
                <div class="input-field col s12 m4">
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
                <div class="input-field col s12 m4">
                    <select name="ambiente" class="sel-ambiente-pesquisa" id="sel-ambiente-pesquisa">
                        <option value="" disabled selected>Escolha sua opção</option>
                        <!--                        <option value="1">Servidor</option>
                                                <option value="2">Aluno</option>
                                                <option value="3">Tercerizado</option>
                                                <option value="4">Mestrado</option>
                                                <option value="5">Bolsista</option>-->
                    </select>
                    <label class="corLogo-text">Ambiente: </label>
                </div>
            </div>
            <!--            <div class="texto">
                            <h3>SysReserva</h3>
                        </div>-->
            <div id='calendar'></div>
        </div>

        <footer>
            <div class="container">
                <div class="row rodape">
                    <div class="col s12 m3">
                        <section id="newsletter">
                            <h5 class="marcacaoRodape">Redes Sociais</h5>
                            <ul class="list-unstyled">
                                <li><a href="https://www.facebook.com/Instituto-Federal-de-Educa%C3%A7%C3%A3o-Ci%C3%AAncia-e-Tecnologia-do-Cear%C3%A1-IFCE-471223182903300/" target="_blank"> Facebook</a></li>
                                <li><a href="http://instagram.com/ifceoficial" target="_blank"> Instagram</a></li>
                                <li><a href="https://twitter.com/IFCE_" target="_blank"> Twitter</a></li>
                                <li><a href="https://www.youtube.com/user/ifcecoficialcomunica?feature=results_main" target="_blank">Youtube</a></li>
                            </ul>
                        </section>
                    </div>      

                    <div class="col s12 m3">
                        <section id="newsletter">
                            <h5 class="marcacaoRodape">Sistemas</h5>
                            <ul class="list-unstyled">
                                <li><a href="http://ifce.edu.br/maracanau" target="_blank"> IFCE Maracanaú</a></li>
                                <li><a href="https://qacademico.ifce.edu.br/" target="_blank"> Acadêmico</a></li>
                                <li><a href="http://biblioteca.ifce.edu.br/" target="_blank"> SophiA Biblioteca</a></li>
                            </ul>
                        </section>
                    </div>

                    <div class="col s12 m3">
                        <section id="newsletter">
                            <h5 class="marcacaoRodape">Serviços</h5>
                            <ul class="list-unstyled">
                                <li><a href="http://intranet.ifmaracanau.br/aluno/merenda">Merendas</a></li>
                                <li><a href="http://intranet.ifmaracanau.br/aluno/documentos">Documentos</a></li>
                                <li><a href="http://intranet.ifmaracanau.br/ifce/jardineira">Jardineira</a></li>
                            </ul>
                        </section>
                    </div>

                    <div class="col s12 m3">
                        <section id="newsletter">
                            <h5 class="marcacaoRodape">Desenvolvedores</h5>
                            <ul class="list-unstyled">
                                <li><a href=""> Thiago Valente</a></li>
                                <li><a href=""> Anderson Alves</a></li>
                                <li><a href=""> Emerson Henrique</a></li>
                            </ul>
                        </section>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
