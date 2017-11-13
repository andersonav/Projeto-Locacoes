<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RefeicaoView
 *
 * @author Anderson Alves
 */
class RefeicaoView {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance))
            self::$instance = new RefeicaoView();

        return self::$instance;
    }

    public function tableRefeicoes($refeicoes) {
        ?>
        <div class="scroll">
            <table class="highlight centered tabelaRefeicoes">
                <thead>
                    <tr> 
                        <!--<i class="material-icons">check</i>-->
                        <th></th>
                        <th class="corLogo-text">Refeição</th>
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
                    foreach ($refeicoes as $refeicao) {
                        ?>
                        <tr id="<?= $refeicao->getIdRefeicao(); ?>">
                            <td><input type="checkbox" id="inputRef<?= $refeicao->getIdRefeicao(); ?>" value="<?= $refeicao->getIdRefeicao(); ?>" class="idRefeicao"/><label for="inputRef<?= $refeicao->getIdRefeicao(); ?>"></label></td>
                            <td><strong><?= $refeicao->getDescricaoRefeicao(); ?></strong></td>
                            <td><strong><?= $refeicao->getQuantidadeRefeicao(); ?></strong></td>
                            <td><strong><input type="text" class="txt-quantidade-solicitada-refeicao" placeholder="Digite a quantidade solicitada" id="inputRef<?= $refeicao->getIdRefeicao(); ?>" disabled max="<?= $refeicao->getQuantidadeRefeicao(); ?>"></strong></td>
                            <td><strong><input type="text" class="txt-data-inicial-refeicao dataInicio" placeholder="Digite a data inicial" id="inputRef<?= $refeicao->getIdRefeicao(); ?>" disabled></strong></td>
                            <td><strong><input type="text" class="txt-hora-inicial-refeicao horaInicio" placeholder="Digite a hora inicial" id="inputRef<?= $refeicao->getIdRefeicao(); ?>" disabled></strong></td>
                            <td><strong><input type="text" class="txt-data-final-refeicao dataFim" placeholder="Digite a data final" id="inputRef<?= $refeicao->getIdRefeicao(); ?>" disabled></strong></td>
                            <td><strong><input type="text" class="txt-hora-final-refeicao horaFim" placeholder="Digite a hora final" id="inputRef<?= $refeicao->getIdRefeicao(); ?>" disabled></strong></td>
                        </tr>
                        <?php
                    }
                    ?>

                </tbody>
            </table> 
        </div> 
        <?php
    }

    public function jsonVerifyQtdSolicitadaByIdRefeicao($refeicao) {
        $array = array();
        foreach ($refeicao as $service) {
            $array = array(
                "idRefeicao" => $service->getIdRefeicao(),
                "qtdDisponivel" => $service->getQuantidadeRefeicao()
            );
        }
        echo json_encode($array);
    }

}
