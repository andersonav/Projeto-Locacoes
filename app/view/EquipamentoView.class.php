<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EquipamentoView
 *
 * @author Anderson Alves
 */
class EquipamentoView {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance))
            self::$instance = new EquipamentoView();

        return self::$instance;
    }

    public function tableEquipamentos($equipamentos) {
        ?>
        <div class="scroll">
            <table class="highlight centered tabelaEquipamentos">
                <thead>
                    <tr> 
                        <!--<i class="material-icons">check</i>-->
                        <th></th>
                        <th class="corLogo-text">Material</th>
                        <th class="corLogo-text">Qtd Disponível</th>
                        <th class="corLogo-text">Qtd Solicitada</th>
                        <th class="corLogo-text">Data Início</th>
                        <th class="corLogo-text">Hora Início</th>
                        <th class="corLogo-text">Data Final</th>
                        <th class="corLogo-text">Hora Final</th>

                    </tr>
                </thead>
                <tbody>

                    <?php
                    foreach ($equipamentos as $equipamento) {
                        ?>
                        <tr id="<?= $equipamento->getIdEquipamento(); ?>">
                            <td><input type="checkbox" id="input<?= $equipamento->getIdEquipamento(); ?>" value="<?= $equipamento->getIdEquipamento(); ?>" class="idEquipamento"/><label for="input<?= $equipamento->getIdEquipamento(); ?>"></label></td>
                            <td><strong><?= $equipamento->getDescricaoEquipamento(); ?></strong></td>
                            <td><strong><?= $equipamento->getQuantidadeEquipamento(); ?></strong></td>
                            <td><strong><input type="text" class="txt-quantidade-solicitada" placeholder="Digite a quantidade solicitada" id="input<?= $equipamento->getIdEquipamento(); ?>" disabled max="<?= $equipamento->getQuantidadeEquipamento(); ?>"></strong></td>
                            <td><strong><input type="text" class="txt-data-inicial dataInicio" placeholder="Digite a data inicial" id="input<?= $equipamento->getIdEquipamento(); ?>" disabled></strong></td>
                            <td><strong><input type="text" class="txt-hora-inicial horaInicio" placeholder="Digite a hora inicial" id="input<?= $equipamento->getIdEquipamento(); ?>" disabled></strong></td>
                            <td><strong><input type="text" class="txt-data-final dataFim" placeholder="Digite a data final" id="input<?= $equipamento->getIdEquipamento(); ?>" disabled></strong></td>
                            <td><strong><input type="text" class="txt-hora-final horaFim" placeholder="Digite a hora final" id="input<?= $equipamento->getIdEquipamento(); ?>" disabled></strong></td>
                        </tr>
                        <?php
                    }
                    ?>

                </tbody>
            </table> 
        </div> 
        <?php
    }
    
    public function tableEquipamentosByEventId($equipamentos) {
        ?>
        <div class="scroll">
            <table class="highlight centered tabelaEquipamentos">
                <thead>
                    <tr> 
                        <!--<i class="material-icons">check</i>-->
                        <th></th>
                        <th class="corLogo-text">Material</th>
                        <th class="corLogo-text">Qtd Disponível</th>
                        <th class="corLogo-text">Qtd Solicitada</th>
                        <th class="corLogo-text">Data Início</th>
                        <th class="corLogo-text">Hora Início</th>
                        <th class="corLogo-text">Data Final</th>
                        <th class="corLogo-text">Hora Final</th>

                    </tr>
                </thead>
                <tbody>

                    <?php
                    foreach ($equipamentos as $equipamento) {
                        ?>
                        <tr id="<?= $equipamento->getIdEquipamento(); ?>">
                            <td><input type="checkbox" id="input<?= $equipamento->getIdEquipamento(); ?>" value="<?= $equipamento->getIdEquipamento(); ?>" class="idEquipamento"/><label for="input<?= $equipamento->getIdEquipamento(); ?>"></label></td>
                            <td><strong><?= $equipamento->getDescricaoEquipamento(); ?></strong></td>
                            <td><strong><?= $equipamento->getQuantidadeEquipamento(); ?></strong></td>
                            <td><strong><input type="text" class="txt-quantidade-solicitada" placeholder="Digite a quantidade solicitada" id="input<?= $equipamento->getIdEquipamento(); ?>" disabled max="<?= $equipamento->getQuantidadeEquipamento(); ?>"></strong></td>
                            <td><strong><input type="text" class="txt-data-inicial dataInicio" placeholder="Digite a data inicial" id="input<?= $equipamento->getIdEquipamento(); ?>" disabled></strong></td>
                            <td><strong><input type="text" class="txt-hora-inicial horaInicio" placeholder="Digite a hora inicial" id="input<?= $equipamento->getIdEquipamento(); ?>" disabled></strong></td>
                            <td><strong><input type="text" class="txt-data-final dataFim" placeholder="Digite a data final" id="input<?= $equipamento->getIdEquipamento(); ?>" disabled></strong></td>
                            <td><strong><input type="text" class="txt-hora-final horaFim" placeholder="Digite a hora final" id="input<?= $equipamento->getIdEquipamento(); ?>" disabled></strong></td>
                        </tr>
                        <?php
                    }
                    ?>

                </tbody>
            </table> 
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
