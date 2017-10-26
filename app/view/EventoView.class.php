<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EventoView
 *
 * @author Anderson Alves
 */
class EventoView {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance))
            self::$instance = new EventoView();

        return self::$instance;
    }

    public function jsonCarregarEventos($eventos) {
        echo json_encode($eventos);
    }

    public function htmlModalToUpdateEvent($eventos) {

        foreach ($eventos as $evento) {
            ?>
            <h4 class="center">Atualizar Eventos</h4>
            <h6 class="center">Setor: <b><?= $evento->getSetorDescricaoEvento(); ?></b>. Bloco:  <b><?= $evento->getBlocoDescricaoEvento(); ?></b>. Ambiente: <b><?= $evento->getAmbienteDescricaoEvento(); ?></b>.</h6>
            <br>
            <div class="divider"></div>
            <br>
            <form class="col s12" id="form_add_event">

                <div class="row">
                    <div class="input-field col s12 m6">
                        <input id="icon_prefix" type="text" class="validate nomeEvento" placeholder="Digite o nome do Evento" value="<?= $evento->getNomeEvento(); ?>">
                        <label for="icon_prefix" class="corLogo-text active">Nome do Evento:</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input id="icon_prefix" type="text" class="validate solicitante" placeholder="Digite o nome do Solicitante" value="<?= $evento->getSolicitanteEvento(); ?>">
                        <label for="icon_prefix" class="corLogo-text active">Solicitante:</label>
                    </div>
                    <div class="input-field col s12 m12">
                        <input type="text" id="descricaoEvento" class="validate descricaoEvento" data-length="200" maxlength="201" value="<?= $evento->getDescricaoEvento(); ?>" placeholder="Digite a descrição do Evento">
                        <label for="icon_prefix" class="corLogo-text active">Descrição do Evento</label>
                    </div>
                    <div class="input-field col s12 m3">
                        <select name="cor" class="sel-color-update" id="sel-color-update">          
                        </select>
                        <label class="corLogo-text">Cor do Evento: </label>
                    </div>
                    <div class="input-field col s12 m3">
                        <select name="tipo" class="sel-tipo-evento-update" id="sel-tipo-evento-update">
                        </select>
                        <label class="corLogo-text">Tipo de Evento: </label>
                    </div>
                    <div class="input-field col s12 m3">
                        <select name="bloco" class="sel-bloco-update" id="sel-bloco-update">
                            <option value="" disabled selected>Escolha sua opção</option>
                        </select>
                        <label class="corLogo-text">Bloco: </label>
                    </div>
                    <div class="input-field col s12 m3">
                        <select name="ambiente" class="sel-ambiente-update" id="sel-ambiente-update">
                            <option value="" disabled selected>Escolha sua opção</option>
                        </select>
                        <label class="corLogo-text">Ambiente: </label>
                    </div>
                    <div class="input-field col s12 m3">
                        <input id="icon_prefix" type="text" class="dataInicio" placeholder="Escolha a Data Inicial" value="<?= date_format(date_create($evento->getDataInicioEvento()), 'd/m/Y'); ?>">
                        <label for="icon_prefix" class="corLogo-text active">Data Início:</label>
                    </div>
                    <div class="input-field col s12 m3">
                        <input id="icon_prefix" type="text" class="validate horaInicio" placeholder="Escolha a Hora Inicial" value="<?= date_format(date_create($evento->getDataInicioEvento()), 'H:i:s'); ?>">
                        <label for="icon_prefix" class="corLogo-text active">Hora Início:</label>
                    </div>
                    <div class="input-field col s12 m3">
                        <input id="icon_prefix" type="text" class="dataFim" placeholder="Escolha a Data Final" value="<?= date_format(date_create($evento->getDataFimEvento()), 'd/m/Y'); ?>">
                        <label for="icon_prefix" class="corLogo-text active">Data Fim:</label>
                    </div>
                    <div class="input-field col s12 m3">
                        <input id="icon_prefix" type="text" class="validate horaFim" placeholder="Escolha a Hora Final" value="<?= date_format(date_create($evento->getDataFimEvento()), 'H:i:s'); ?>">
                        <label for="icon_prefix" class="corLogo-text active">Hora Fim:</label>
                    </div>
                    <div class="col s12">
                        <ul id="tabs-bosta" class="tabs">
                            <li class="tab col s3 active"><a class="active" href="#equipamentos-update">Equipamentos</a></li>
                            <li class="tab col s3"><a href="#servicos-update">Serviços</a></li>
                            <li class="tab col s3"><a href="#refeicoes-update">Refeições</a></li>
                        </ul>
                    </div>
                    <div id="equipamentos-update" class="col s12 m12">
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
                    <div id="servicos-update" class="col s12 m12">
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
                    <div id="refeicoes-update" class="col s12 m12">
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
                <div class="row center" style="margin: 3px auto; width: 50%;">
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

            <?php
        }
    }
    
    public function htmlModalToInformationEvent($eventos) {

        foreach ($eventos as $evento) {
            ?>
            <h4 class="center">Informações do Evento</h4>
            <!--<h6 class="center">Setor: <b><?= $evento->getSetorDescricaoEvento(); ?></b>. Bloco:  <b><?= $evento->getBlocoDescricaoEvento(); ?></b>. Ambiente: <b><?= $evento->getAmbienteDescricaoEvento(); ?></b>.</h6>-->
            <br>
            <div class="divider"></div>
            <br>
            <form class="col s12" id="form_add_event">
                <div class="row">
                    <div class="input-field col s12 m6">
                        <input id="icon_prefix" type="text" class="validate nomeEvento" placeholder="Digite o nome do Evento" value="<?= $evento->getNomeEvento(); ?>" disabled>
                        <label for="icon_prefix" class="corLogo-text active">Nome do Evento:</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input id="icon_prefix" type="text" class="validate solicitante" placeholder="Digite o nome do Solicitante" value="<?= $evento->getSolicitanteEvento(); ?>" disabled>
                        <label for="icon_prefix" class="corLogo-text active">Solicitante:</label>
                    </div>
                    <div class="input-field col s12 m12">
                        <input type="text" id="descricaoEvento" class="validate descricaoEvento" data-length="200" maxlength="201" value="<?= $evento->getDescricaoEvento(); ?>" placeholder="Digite a descrição do Evento" disabled>
                        <label for="icon_prefix" class="corLogo-text active">Descrição do Evento</label>
                    </div>
                    <div class="input-field col s12 m3">
                        <select name="cor" class="sel-color-update" id="sel-color-update" disabled>   
                            <option value="<?= $evento->getColorIdEvento(); ?>"><?= $evento->getColorDescricaoEvento(); ?></option>
                        </select>
                        <label class="corLogo-text">Cor do Evento: </label>
                    </div>
                    <div class="input-field col s12 m3">
                        <select name="tipo" class="sel-tipo-evento-update" id="sel-tipo-evento-update" disabled>
                            <option value="<?= $evento->getSetorIdEvento(); ?>"><?= $evento->getSetorDescricaoEvento(); ?></option>
                        </select>
                        <label class="corLogo-text">Tipo de Evento: </label>
                    </div>
                    <div class="input-field col s12 m3">
                        <select name="bloco" class="sel-bloco-update" id="sel-bloco-update" disabled>
                            <option value="<?= $evento->getBlocoIdEvento(); ?>"><?= $evento->getBlocoDescricaoEvento(); ?></option>
                        </select>
                        <label class="corLogo-text">Bloco: </label>
                    </div>
                    <div class="input-field col s12 m3">
                        <select name="ambiente" class="sel-ambiente-update" id="sel-ambiente-update" disabled>
                            <option value="<?= $evento->getAmbienteIdEvento(); ?>"><?= $evento->getAmbienteDescricaoEvento(); ?></option>
                        </select>
                        <label class="corLogo-text">Ambiente: </label>
                    </div>
                    <div class="input-field col s12 m3">
                        <input id="icon_prefix" type="text" class="dataInicio" placeholder="Escolha a Data Inicial" value="<?= date_format(date_create($evento->getDataInicioEvento()), 'd/m/Y'); ?>" disabled>
                        <label for="icon_prefix" class="corLogo-text active">Data Início:</label>
                    </div>
                    <div class="input-field col s12 m3">
                        <input id="icon_prefix" type="text" class="validate horaInicio" placeholder="Escolha a Hora Inicial" value="<?= date_format(date_create($evento->getDataInicioEvento()), 'H:i:s'); ?>" disabled>
                        <label for="icon_prefix" class="corLogo-text active">Hora Início:</label>
                    </div>
                    <div class="input-field col s12 m3">
                        <input id="icon_prefix" type="text" class="dataFim" placeholder="Escolha a Data Final" value="<?= date_format(date_create($evento->getDataFimEvento()), 'd/m/Y'); ?>" disabled>
                        <label for="icon_prefix" class="corLogo-text active">Data Fim:</label>
                    </div>
                    <div class="input-field col s12 m3">
                        <input id="icon_prefix" type="text" class="validate horaFim" placeholder="Escolha a Hora Final" value="<?= date_format(date_create($evento->getDataFimEvento()), 'H:i:s'); ?>" disabled>
                        <label for="icon_prefix" class="corLogo-text active">Hora Fim:</label>
                    </div>
<!--                    <div class="col s12">
                        <ul id="tabs-user" class="tabs">
                            <li class="tab col s3 active"><a class="active" href="#equipamentos-user">Equipamentos</a></li>
                            <li class="tab col s3"><a href="#servicos-user">Serviços</a></li>
                            <li class="tab col s3"><a href="#refeicoes-user">Refeições</a></li>
                        </ul>
                    </div>
                    <div id="equipamentos-user" class="col s12 m12">
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
                    <div id="servicos-user" class="col s12 m12">
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
                    <div id="refeicoes-user" class="col s12 m12">
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
                    </div>-->
                </div>
<!--                <div class="row center" style="margin: 3px auto; width: 50%;">
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

                </div>-->

                <!--<div id="calendar2" class="cadastroClickBtn calendar2"></div>;-->
            </form>

            <?php
        }
    }

    public function jsonVerifyDates($eventos) {
        echo json_encode($eventos);
    }

}
