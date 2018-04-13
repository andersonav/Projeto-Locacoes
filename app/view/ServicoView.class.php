<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ServicoView
 *
 * @author Anderson Alves
 */
class ServicoView {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance))
            self::$instance = new ServicoView();

        return self::$instance;
    }

    public function tableServicos($servicos) {
        ?>
        <div class="scroll">
            <table class="highlight centered tabelaServicos">
                <thead>
                    <tr> 
                        <!--<i class="material-icons">check</i>-->
                        <th></th>
                        <th class="corLogo-text">Serviço</th>
                        <th class="corLogo-text">Data Início</th>
                        <th class="corLogo-text">Hora Início</th>
                        <th class="corLogo-text">Data Final</th>
                        <th class="corLogo-text">Hora Final</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    foreach ($servicos as $servico) {
                        ?>
                        <tr id="<?= $servico->getIdServico(); ?>">
                            <td><input type="checkbox" id="inputSer<?= $servico->getIdServico(); ?>" value="<?= $servico->getIdServico(); ?>" class="idServico"/><label for="inputSer<?= $servico->getIdServico(); ?>"></label></td>
                            <td><strong><?= $servico->getDescricaoServico(); ?></strong></td>
                            <td><strong><input type="text" class="txt-data-inicial-servico dataInicio" placeholder="Digite a data inicial" id="inputSer<?= $servico->getIdServico(); ?>" disabled></strong></td>
                            <td><strong><input type="text" class="txt-hora-inicial-servico horaInicio" placeholder="Digite a hora inicial" id="inputSer<?= $servico->getIdServico(); ?>" disabled></strong></td>
                            <td><strong><input type="text" class="txt-data-final-servico dataFim" placeholder="Digite a data final" id="inputSer<?= $servico->getIdServico(); ?>" disabled></strong></td>
                            <td><strong><input type="text" class="txt-hora-final-servico horaFim" placeholder="Digite a hora final" id="inputSer<?= $servico->getIdServico(); ?>" disabled></strong></td>
                        </tr>
                        <?php
                    }
                    ?>

                </tbody>
            </table> 
        </div> 
        <?php
    }

    public function jsonVerifyQtdSolicitadaByIdServico($servico) {
        $array = array();
        foreach ($servico as $service) {
            $array = array(
                "idServico" => $service->getIdServico(),
                "qtdDisponivel" => $service->getQuantidadeServico()
            );
        }
        echo json_encode($array);
    }

    public function htmlSelectServicos($servicos) {
        ?>
        <option value="" selected disabled>Escolha sua opção</option>

        <?php
        foreach ($servicos as $servico) {
            ?>
            <option value="<?= $servico->getIdServico() ?>"><?= $servico->getDescricaoServico(); ?></option>
            <?php
        }
    }

}
