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
                        <th>Refeição</th>
                        <th>Qtd Disponível</th>
                        <th>Data Início</th>
                        <th>Hora Início</th>
                        <th>Data Final</th>
                        <th>Hora Final</th>
                        <th>Qtd Solicitada</th>
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
                            <td><strong><input type="text" class="txt-data-inicial-servico dataInicio" placeholder="Digite a data inicial" id="inputRef<?= $refeicao->getIdRefeicao(); ?>" disabled></strong></td>
                            <td><strong><input type="text" class="txt-hora-inicial-servico horaInicio" placeholder="Digite a hora inicial" id="inputRef<?= $refeicao->getIdRefeicao(); ?>" disabled></strong></td>
                            <td><strong><input type="text" class="txt-data-final-servico dataFim" placeholder="Digite a data final" id="inputRef<?= $refeicao->getIdRefeicao(); ?>" disabled></strong></td>
                            <td><strong><input type="text" class="txt-hora-final-servico horaFim" placeholder="Digite a hora final" id="inputRef<?= $refeicao->getIdRefeicao(); ?>" disabled></strong></td>
                            <td><strong><input type="text" class="txt-quantidade-solicitada-servico" placeholder="Digite a quantidade solicitada" id="inputRef<?= $refeicao->getIdRefeicao(); ?>" disabled max="<?= $refeicao->getQuantidadeRefeicao(); ?>"></strong></td>
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
