<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EventoServicoUtilizadoView
 *
 * @author Anderson Alves
 */
class EventoServicoUtilizadoView {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance))
            self::$instance = new EventoServicoUtilizadoView();

        return self::$instance;
    }

    public function htmlInformationServices($servicos) {
        ?>
        <div class="row servicos">
            <div class="scroll">
                <table class="highlight centered tabelaServicos">
                    <thead>
                        <tr> 
                            <!--<i class="material-icons">check</i>-->
                            <th class="corLogo-text">Serviço</th>
                            <th class="corLogo-text">Data Início</th>
                            <th class="corLogo-text">Hora Início</th>
                            <th class="corLogo-text">Data Fim</th>
                            <th class="corLogo-text">Hora Fim</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($servicos as $servico) {
                            ?>
                            <tr id="<?= $servico->getIdEventoServicoUtilizado(); ?>">
                                <td><strong><?= $servico->getDescricaoEventoServicoUtilizado(); ?></strong></td>
                                <td><strong><?= date_format(date_create($servico->getDataInicioServicoUtilizado()), "d/m/Y"); ?></strong></td>
                                <td><strong><?= date_format(date_create($servico->getDataInicioServicoUtilizado()), "H:i"); ?></strong></td>
                                <td><strong><?= date_format(date_create($servico->getDataFimServicoUtilizado()), "d/m/Y"); ?></strong></td>
                                <td><strong><?= date_format(date_create($servico->getDataFimServicoUtilizado()), "H:i"); ?></strong></td>
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

    public function tableServicosByEventId($servicos) {
        ?>
        <div class="scroll">
            <table class="highlight centered tabelaServicos">
                <thead>
                    <tr> 
                        <!--<i class="material-icons">check</i>-->
                        <th class="corLogo-text">Serviço</th>
                        <th class="corLogo-text">Data Início</th>
                        <th class="corLogo-text">Hora Início</th>
                        <th class="corLogo-text">Data Final</th>
                        <th class="corLogo-text">Hora Final</th>
                        <th class="corLogo-text">Opção</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $idEvento = "";
                    foreach ($servicos as $servico) {
                        $idEvento = $servico->getIdEvento();
                        ?>
                        <tr id="<?= $servico->getIdEventoServicoUtilizado(); ?>">
                            <td><strong><?= $servico->getDescricaoEventoServicoUtilizado(); ?></strong></td>
                            <td><strong><?= date_format(date_create($servico->getDataInicioServicoUtilizado()), "d/m/Y"); ?></strong></td>
                            <td><strong><?= date_format(date_create($servico->getDataInicioServicoUtilizado()), "H:i"); ?></strong></td>
                            <td><strong><?= date_format(date_create($servico->getDataFimServicoUtilizado()), "d/m/Y"); ?></strong></td>
                            <td><strong><?= date_format(date_create($servico->getDataFimServicoUtilizado()), "H:i"); ?></strong></td>
                            <td><i class="material-icons btn-editar-servico" id="<?= $servico->getIdEventoServicoUtilizado(); ?>">edit</i><i class="material-icons btn-deletar-servico" id="<?= $servico->getIdEventoServicoUtilizado(); ?>">delete</i></td>
                        </tr>
                        <?php
                    }
                    if ($idEvento == "" || $idEvento == null) {
                        ?>
                        <tr><td colspan="6">Não há serviços disponíveis</td></tr>
                    <td><a class="btn-floating btn-large waves-effect waves-light btn-add-servico" id=""><i class="material-icons">add</i></a></td>

                    <?php
                } else {
                    ?>
                    <td><a class="btn-floating btn-large waves-effect waves-light btn-add-servico" id="<?php echo $idEvento; ?>"><i class="material-icons">add</i></a></td>
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
                "idEquipamento" => $service->getIdServico()
            );
        }
        echo json_encode($array);
    }

}
