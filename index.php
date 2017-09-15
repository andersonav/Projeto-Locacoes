<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8' />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href='css/fullcalendar.min.css' rel='stylesheet' />
        <link href='css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
        <link href='css/nav_footer.css' rel='stylesheet' />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/js/materialize.min.js"></script>
        <script src='js/location_js.js'></script>
        <script src='js/lib/moment.min.js'></script>
        <script src='js/fullcalendar.min.js'></script>

        <style>
            body{
                font-family: 'Verdana', 'sans-serif' !important;

            }
            #calendar {
                margin: 15px auto;
            }
            .btnModal{
                border: solid 2px white;
                padding: 10px;
                min-width: 10%;
                display: block;
                margin-top: 2%;
                margin-left: 2%;
                float: right;
                font-weight: bold;
                margin-bottom: 2%;
            }
            .equipamento{
                margin: 10px;
            }
            .equipamento img{
                width: 120px;
                height: 100px;
            }
            .servicos{
                margin: 10px;
            }
            .servicos img{
                width: 120px;
                height: 100px;
            }
            .refeicoes{
                margin: 10px;
            }
            .refeicoes img{
                width: 120px;
                height: 100px;
            }
        </style>
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
            <div id="modalAdicionarEventoClickDay" class="modal">
                <div class="modal-content">
                    <h4 class="center">Adicionar Eventos</h4>
                    <div class="divider"></div>
                    <br>
                    <div class="row">
                        <form class="col s12">
                            <div class="input-field col s12 m6">
                                <input id="icon_prefix" type="text" class="validate nomeEvento" placeholder="Digite o nome do Evento">
                                <label for="icon_prefix" class="active">Nome do Evento:</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input id="icon_prefix" type="text" class="validate solicitante" placeholder="Digite o nome do Solicitante">
                                <label for="icon_prefix" class="active">Solicitante:</label>
                            </div>
                            <div class="input-field col s12 m12">
                                <textarea id="opiniao" class="materialize-textarea" name="opiniao" data-length="200" maxlength="201"></textarea>
                                <label for="textarea1">Por favor, digite a descrição do evento</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <select name="tipo">
                                    <option value="" disabled selected>Escolha sua opção</option>
                                    <!--                            <option value="1">Servidor</option>
                                                                <option value="2">Aluno</option>
                                                                <option value="3">Tercerizado</option>
                                                                <option value="4">Mestrado</option>
                                                                <option value="5">Bolsista</option>-->
                                </select>
                                <label>Tipo: </label>
                            </div>
                            <div class="input-field col s12 m6">
                                <select name="ambiente">
                                    <option value="" disabled selected>Escolha sua opção</option>
                                    <!--                            <option value="1">Servidor</option>
                                                                <option value="2">Aluno</option>
                                                                <option value="3">Tercerizado</option>
                                                                <option value="4">Mestrado</option>
                                                                <option value="5">Bolsista</option>-->
                                </select>
                                <label>Ambiente: </label>
                            </div>
                            <div class="input-field col s12 m3">
                                <input id="icon_prefix" type="text" class="dataInicio" disabled placeholder="Escolha a Data Inicial">
                                <label for="icon_prefix" class="active">Data Início:</label>
                            </div>
                            <div class="input-field col s12 m3">
                                <input id="icon_prefix" type="text" class="horaInicio" placeholder="Escolha a Hora Inicial">
                                <label for="icon_prefix" class="active">Hora Início:</label>
                            </div>
                            <div class="input-field col s12 m3">
                                <input id="icon_prefix" type="text" class="dataFim" placeholder="Escolha a Data Final">
                                <label for="icon_prefix" class="active">Data Fim:</label>
                            </div>
                            <div class="input-field col s12 m3">
                                <input id="icon_prefix" type="text" class="horaFim" placeholder="Escolha a Hora Final">
                                <label for="icon_prefix" class="active">Hora Fim:</label>
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
                                        <img src="img/datashow.png">
                                        <p>
                                            <input type="checkbox" class="filled-in" id="filled-in-box" />
                                            <label for="filled-in-box">Qtd: 1</label>
                                        </p>
                                    </div>
                                    <div class="col s12 m2">
                                        <img src="img/microfone.png">
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
                                        <img src="img/construcao.png">
                                        <p>
                                            <input type="checkbox" class="filled-in" id="servicos1" />
                                            <label for="servicos1">Qtd: 1</label>
                                        </p>
                                    </div>
                                    <div class="col s12 m2">
                                        <img src="img/construcao.png">
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
                                        <img src="img/construcao.png">
                                        <p>
                                            <input type="checkbox" class="filled-in" id="refeicoes1" />
                                            <label for="refeicoes1">Qtd: 1</label>
                                        </p>
                                    </div>
                                    <div class="col s12 m2">
                                        <img src="img/construcao.png">
                                        <p>
                                            <input type="checkbox" class="filled-in" id="refeicoes2" />
                                            <label for="refeicoes2">Qtd: 1</label>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btnModal buttonOkay">OK</button>
                    <button class="btnModal buttonCancel">CANCEL</button>
                    <!--                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a>-->
                </div>
            </div>
            <div class="texto">
                <h3>SysReserva</h3>
            </div>
            <div id='calendar'></div>

            <!--Modal Adicionar Evento Click BtnCadastros-->
            <div id="modalAdicionarEventoClickBtnCadastro" class="modal">
                <div class="modal-content">
                    <h4 class="center">Adicionar Eventos</h4>
                    <div class="divider"></div>
                    <br>
                    <div class="row">
                        <form class="col s12">
                            <div class="input-field col s12 m6">
                                <input id="icon_prefix" type="text" class="validate nomeEvento" placeholder="Digite o nome do Evento">
                                <label for="icon_prefix" class="active">Nome do Evento:</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <input id="icon_prefix" type="text" class="validate solicitante" placeholder="Digite o nome do Solicitante">
                                <label for="icon_prefix" class="active">Solicitante:</label>
                            </div>
                            <div class="input-field col s12 m12">
                                <textarea id="opiniao" class="materialize-textarea" name="opiniao" data-length="200" maxlength="201"></textarea>
                                <label for="textarea1">Por favor, digite a descrição do evento</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <select name="tipo">
                                    <option value="" disabled selected>Escolha sua opção</option>
                                    <!--                            <option value="1">Servidor</option>
                                                                <option value="2">Aluno</option>
                                                                <option value="3">Tercerizado</option>
                                                                <option value="4">Mestrado</option>
                                                                <option value="5">Bolsista</option>-->
                                </select>
                                <label>Tipo: </label>
                            </div>
                            <div class="input-field col s12 m6">
                                <select name="ambiente">
                                    <option value="" disabled selected>Escolha sua opção</option>
                                    <!--                            <option value="1">Servidor</option>
                                                                <option value="2">Aluno</option>
                                                                <option value="3">Tercerizado</option>
                                                                <option value="4">Mestrado</option>
                                                                <option value="5">Bolsista</option>-->
                                </select>
                                <label>Ambiente: </label>
                            </div>
                            <div class="input-field col s12 m3">
                                <input id="icon_prefix" type="text" class="dataInicio" disabled placeholder="Escolha a Data Inicial">
                                <label for="icon_prefix" class="active">Data Início:</label>
                            </div>
                            <div class="input-field col s12 m3">
                                <input id="icon_prefix" type="text" class="horaInicio" placeholder="Escolha a Hora Inicial">
                                <label for="icon_prefix" class="active">Hora Início:</label>
                            </div>
                            <div class="input-field col s12 m3">
                                <input id="icon_prefix" type="text" class="dataFim" placeholder="Escolha a Data Final">
                                <label for="icon_prefix" class="active">Data Fim:</label>
                            </div>
                            <div class="input-field col s12 m3">
                                <input id="icon_prefix" type="text" class="horaFim" placeholder="Escolha a Hora Final">
                                <label for="icon_prefix" class="active">Hora Fim:</label>
                            </div>
                            <div class="col s12">
                                <ul id="tabs-swipe-demo" class="tabs">
                                    <li class="tab col s3 active"><a class="active" href="#equipamentos2">Equipamentos</a></li>
                                    <li class="tab col s3"><a href="#servicos2">Serviços</a></li>
                                    <li class="tab col s3"><a href="#refeicoes2">Refeições</a></li>
                                </ul>
                            </div>
                            <div id="equipamentos2" class="col s12 m12">
                                <div class="row equipamento">
                                    <div class="col s12 m2">
                                        <img src="img/datashow.png">
                                        <p>
                                            <input type="checkbox" class="filled-in" id="filled-in-box" />
                                            <label for="filled-in-box">Qtd: 1</label>
                                        </p>
                                    </div>
                                    <div class="col s12 m2">
                                        <img src="img/microfone.png">
                                        <p>
                                            <input type="checkbox" class="filled-in" id="filled-in-box2" />
                                            <label for="filled-in-box2">Qtd: 1</label>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div id="servicos2" class="col s12 m12">
                                <div class="row servicos">
                                    <div class="col s12 m2">
                                        <img src="img/construcao.png">
                                        <p>
                                            <input type="checkbox" class="filled-in" id="servicos1" />
                                            <label for="servicos1">Qtd: 1</label>
                                        </p>
                                    </div>
                                    <div class="col s12 m2">
                                        <img src="img/construcao.png">
                                        <p>
                                            <input type="checkbox" class="filled-in" id="servicos2" />
                                            <label for="servicos2">Qtd: 1</label>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div id="refeicoes2" class="col s12 m12">
                                <div class="row refeicoes">
                                    <div class="col s12 m2">
                                        <img src="img/construcao.png">
                                        <p>
                                            <input type="checkbox" class="filled-in" id="refeicoes1" />
                                            <label for="refeicoes1">Qtd: 1</label>
                                        </p>
                                    </div>
                                    <div class="col s12 m2">
                                        <img src="img/construcao.png">
                                        <p>
                                            <input type="checkbox" class="filled-in" id="refeicoes2" />
                                            <label for="refeicoes2">Qtd: 1</label>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btnModal buttonOkay">OK</button>
                    <button class="btnModal buttonCancel">CANCEL</button>
                    <!--                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a>-->
                </div>
            </div>
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
