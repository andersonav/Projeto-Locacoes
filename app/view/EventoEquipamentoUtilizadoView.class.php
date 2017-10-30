<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EventoEquipamentoUtilizadoView
 *
 * @author Anderson Alves
 */
class EventoEquipamentoUtilizadoView {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance))
            self::$instance = new EventoEquipamentoUtilizadoView();

        return self::$instance;
    }

    public function htmlInformationEquipaments($equipamentos) {
        ?>
        <div class="row equipamento">
            <div class="scroll">
                <table class="highlight centered tabelaEquipamentos">
                    <thead>
                        <tr> 
                            <!--<i class="material-icons">check</i>-->
                            <th>Equipamento</th>
                            <th>Qtd Solicitada</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($equipamentos as $equipamento) {
                            ?>
                            <tr id="<?= $equipamento->getIdEventoEquipamentoUtilizado(); ?>">
                                <td><strong><?= $equipamento->getDescricaoEventoEquipamentoUtilizado(); ?></strong></td>
                                <td><strong><?= $equipamento->getQtdEventoEquipamentoUtilizado(); ?></strong></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table> 
            </div> 
        </div>
        <?php
    }

    public function jsonVerifyQtdSolicitadaByIdEquipamento($equipamento) {
        $array = array();
        foreach ($equipamento as $equipament) {
            $array = array(
                "idEquipamento" => $equipament->getIdEquipamento(),
                "qtdDisponivel" => $equipament->getQuantidadeEquipamento()
            );
        }
        echo json_encode($array);
    }

}
