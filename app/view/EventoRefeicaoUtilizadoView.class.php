<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EventoRefeicaoUtilizadoView
 *
 * @author Anderson Alves
 */
class EventoRefeicaoUtilizadoView {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance))
            self::$instance = new EventoRefeicaoUtilizadoView();

        return self::$instance;
    }

    public function htmlInformationRefeicoes($refeicoes) {
        ?>
        <div class="row Refeicao">
            <div class="scroll">
                <table class="highlight centered tabelaRefeicoes">
                    <thead>
                        <tr> 
                            <!--<i class="material-icons">check</i>-->
                            <th class="corLogo-text">Refeição</th>
                            <th class="corLogo-text">Qtd Solicitada</th>
                            <th class="corLogo-text">Data Início</th>
                            <th class="corLogo-text">Hora Início</th>
                            <th class="corLogo-text">Data Final</th>
                            <th class="corLogo-text">Hora Final</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($refeicoes as $refeicao) {
                            ?>
                            <tr id="<?= $refeicao->getIdEventoRefeicaoUtilizado(); ?>">
                                <td><strong><?= $refeicao->getDescricaoEventoRefeicaoUtilizado(); ?></strong></td>
                                <td><strong><?= $refeicao->getQtdEventoRefeicaoUtilizado(); ?></strong></td>
                                <td><strong><?= date_format(date_create($refeicao->getDataInicioRefeicaoUtilizado()), "d/m/Y"); ?></strong></td>
                                <td><strong><?= date_format(date_create($refeicao->getDataInicioRefeicaoUtilizado()), "H:i"); ?></strong></td>
                                <td><strong><?= date_format(date_create($refeicao->getDataFimRefeicaoUtilizado()), "d/m/Y"); ?></strong></td>
                                <td><strong><?= date_format(date_create($refeicao->getDataFimRefeicaoUtilizado()), "H:i"); ?></strong></td>
                            </tr>
                            <?php
                        }
                        ?>
                        <!--date_format(date_create($row->eve_data_inicio), "H:i:s");-->
                    </tbody>
                </table> 
            </div>
        </div>
        <?php
    }

    public function jsonVerifyQtdSolicitadaByIdRefeicao($refeicao) {
        $array = array();
        foreach ($refeicao as $refact) {
            $array = array(
                "idRefeicao" => $refact->getIdRefeicao(),
                "qtdDisponivel" => $refact->getQuantidadeRefeicao()
            );
        }
        echo json_encode($array);
    }

}
