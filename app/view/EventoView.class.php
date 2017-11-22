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
                    <div class="input-field col s12 m4">
                        <select name="tipo" class="sel-tipo-evento-update" id="sel-tipo-evento-update">
                            <option value="<?= $evento->getSetorIdEvento(); ?>"><?= $evento->getSetorDescricaoEvento(); ?></option>
                        </select>
                        <label class="corLogo-text">Tipo de Evento: </label>
                    </div>
                    <div class="input-field col s12 m4">
                        <select name="bloco" class="sel-bloco-update" id="sel-bloco-update">
                            <option value="<?= $evento->getBlocoIdEvento(); ?>"><?= $evento->getBlocoDescricaoEvento(); ?></option>
                        </select>
                        <label class="corLogo-text">Bloco: </label>
                    </div>
                    <div class="input-field col s12 m4">
                        <select name="ambiente" class="sel-ambiente-update" id="sel-ambiente-update">
                            <option value="<?= $evento->getAmbienteIdEvento(); ?>"><?= $evento->getAmbienteDescricaoEvento(); ?></option>
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

                    </div>
                    <div id="servicos-update" class="col s12 m12">

                    </div>
                    <div id="refeicoes-update" class="col s12 m12">

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
                        <select name="aula" class="sel-aula" id="sel-aula" disabled>
                            <option value="<?= $evento->getAulaIdEvento(); ?>"><?= $evento->getAulaDescricaoEvento(); ?></option>
                        </select>
                        <label class="corLogo-text">Aula</label>
                    </div>
                    <div class="input-field col s12 m9 divInputProfessor">
                        <input id="icon_prefix" type="text" class="validate nomeProfessor" placeholder="" disabled value="<?= $evento->getNomeProfessorEvento(); ?>">
                        <label for="icon_prefix" class="corLogo-text active">Professor:</label>
                    </div>
                    <div class="input-field col s12 m4">
                        <select name="tipo" class="sel-tipo-evento-update" id="sel-tipo-evento-update" disabled>
                            <option value="<?= $evento->getSetorIdEvento(); ?>"><?= $evento->getSetorDescricaoEvento(); ?></option>
                        </select>
                        <label class="corLogo-text">Tipo de Evento: </label>
                    </div>
                    <div class="input-field col s12 m4">
                        <select name="bloco" class="sel-bloco-update" id="sel-bloco-update" disabled>
                            <option value="<?= $evento->getBlocoIdEvento(); ?>"><?= $evento->getBlocoDescricaoEvento(); ?></option>
                        </select>
                        <label class="corLogo-text">Bloco: </label>
                    </div>
                    <div class="input-field col s12 m4">
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
                    <div class="col s12">
                        <ul id="tabs-user" class="tabs">
                            <li class="tab col s3 active"><a class="active" href="#equipamentos-user">Materiais</a></li>
                            <li class="tab col s3"><a href="#servicos-user">Serviços</a></li>
                            <li class="tab col s3"><a href="#refeicoes-user">Refeições</a></li>
                        </ul>
                    </div>
                    <div id="equipamentos-user" class="col s12 m12">

                    </div>
                    <div id="servicos-user" class="col s12 m12">

                    </div>
                    <div id="refeicoes-user" class="col s12 m12">

                    </div>

                </div>
                <!--<div id="calendar2" class="cadastroClickBtn calendar2"></div>;-->
            </form>

            <?php
        }
    }

    public function jsonVerifyDates($eventos) {
        echo json_encode($eventos);
    }

    public function jsonEventByAmbienteAndStartAndEnd($evento) {
        echo json_encode($evento);
    }

}
