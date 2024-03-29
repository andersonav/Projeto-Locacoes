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
                            <th class="corLogo-text">Material</th>
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
                            <tr id="<?= $equipamento->getIdEventoEquipamentoUtilizado(); ?>">
                                <td><strong><?= $equipamento->getDescricaoEventoEquipamentoUtilizado(); ?></strong></td>
                                <td><strong><?= $equipamento->getQtdEventoEquipamentoUtilizado(); ?></strong></td>
                                <td><strong><?= date_format(date_create($equipamento->getDataInicioEquipamentoUtilizado()), "d/m/Y"); ?></strong></td>
                                <td><strong><?= date_format(date_create($equipamento->getDataInicioEquipamentoUtilizado()), "H:i"); ?></strong></td>
                                <td><strong><?= date_format(date_create($equipamento->getDataFimEquipamentoUtilizado()), "d/m/Y"); ?></strong></td>
                                <td><strong><?= date_format(date_create($equipamento->getDataFimEquipamentoUtilizado()), "H:i"); ?></strong></td>
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

    public function tableEquipamentosByEventId($equipamentos) {
        ?>
        <div class="scroll">
            <table class="highlight centered tabelaEquipamentos">
                <thead>
                    <tr> 
                        <!--<i class="material-icons">check</i>-->
                        <th class="corLogo-text">Material</th>
                        <th class="corLogo-text">Qtd Disponível</th>
                        <th class="corLogo-text">Qtd Solicitada</th>
                        <th class="corLogo-text">Data Início</th>
                        <th class="corLogo-text">Hora Início</th>
                        <th class="corLogo-text">Data Final</th>
                        <th class="corLogo-text">Hora Final</th>
                        <th class="corLogo-text">Opção</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $idEvento= "";
                    foreach ($equipamentos as $equipamento) {
                        $idEvento = $equipamento->getIdEvento();
                        ?>
                        <tr id="<?= $equipamento->getIdEventoEquipamentoUtilizado(); ?>">
                            <td><strong><?= $equipamento->getDescricaoEventoEquipamentoUtilizado(); ?></strong></td>
                            <td><strong><?= $equipamento->getQtdDisponivelEquipamento(); ?></strong></td>
                            <td><strong><?= $equipamento->getQtdEventoEquipamentoUtilizado(); ?></strong></td>
                            <td><strong><?= date_format(date_create($equipamento->getDataInicioEquipamentoUtilizado()), "d/m/Y"); ?></strong></td>
                            <td><strong><?= date_format(date_create($equipamento->getDataInicioEquipamentoUtilizado()), "H:i"); ?></strong></td>
                            <td><strong><?= date_format(date_create($equipamento->getDataFimEquipamentoUtilizado()), "d/m/Y"); ?></strong></td>
                            <td><strong><?= date_format(date_create($equipamento->getDataFimEquipamentoUtilizado()), "H:i"); ?></strong></td>
                            <td><i class="material-icons btn-editar-material" id="<?= $equipamento->getIdEventoEquipamentoUtilizado(); ?>">edit</i><i class="material-icons btn-deletar-material" id="<?= $equipamento->getIdEventoEquipamentoUtilizado(); ?>">delete</i></td>
                        </tr>
                        <?php
                    }
                    if ($idEvento == "" || $idEvento == null) {
                        ?>
                        <tr><td colspan="8">Não há equipamentos disponíveis</td></tr>
                    <td><a class="btn-floating btn-large waves-effect waves-light btn-add-material" id=""><i class="material-icons">add</i></a></td>

                    <?php
                } else {
                    ?>
                    <td><a class="btn-floating btn-large waves-effect waves-light btn-add-material" id="<?php echo $idEvento; ?>"><i class="material-icons">add</i></a></td>
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

    public function jsonInformationsMaterial($materiais) {
        $array = array();
        foreach ($materiais as $material) {
            $array = array(
                "idTableEventoUtilizado" => $material->getIdEventoEquipamentoUtilizado(),
                "idEquipamento" => $material->getIdEquipamento(),
                "descricaoEquipamento" => $material->getDescricaoEventoEquipamentoUtilizado(),
                "qtdDisponivel" => $material->getQtdDisponivelEquipamento(),
                "qtdSolicitada" => $material->getQtdEventoEquipamentoUtilizado(),
                "dataInicio" => date_format(date_create($material->getDataInicioEquipamentoUtilizado()), "d/m/Y"),
                "horaInicio" => date_format(date_create($material->getDataInicioEquipamentoUtilizado()), "H:i"),
                "dataFim" => date_format(date_create($material->getDataFimEquipamentoUtilizado()), "d/m/Y"),
                "horaFim" => date_format(date_create($material->getDataFimEquipamentoUtilizado()), "H:i"),
                "dataInicioBancoDeDados" => $material->getDataInicioEquipamentoUtilizado(),
                "dataFimBancoDeDados" => $material->getDataFimEquipamentoUtilizado()
            );
        }
        echo json_encode($array);
    }

}
