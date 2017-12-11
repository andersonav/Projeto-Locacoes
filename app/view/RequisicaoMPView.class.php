<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RequisicaoView
 *
 * @author anderson.alves
 */
class RequisicaoMPView {

    private static $instance;

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new RequisicaoMPView();
        }
        return self::$instance;
    }

    public function confirmaNovaRequisicao($mensagem) {
        echo $mensagem;
    }

    public function jsonRequisicaoDetalheProdutoAC(ProdutoAC $pa) {
        $array = array(
            "id" => $pa->getId(),
            "codigo" => $pa->getCodigo(),
            "cor" => $pa->getCorDescricao(),
            "tamanho" => $pa->getTamanho()
        );
        echo json_encode($array);
    }

    public function jsonItens(RequisicaoMP $req) {

        $array = array(
            "id" => $req->getId(),
            "codigo" => str_pad($req->getId(), 6, "0", STR_PAD_LEFT),
            "ordem" => $req->getOrdem(),
            "situacao" => $req->getSituacao(),
            "requisitante" => utf8_encode($req->getFornecedor()),
            "data" => date_format(date_create($req->getDataInclusao()), 'd-m-Y'),
            "observacao" => $req->getObservacao()
        );
        echo json_encode($array);
    }

    public function tableRequisicao($requisicoes) {
        ?>
        <table class="table datatable-mp">
            <thead>
                <tr> 
                    <th>REQUISICAO</th>
                    <th>SETOR</th>
                    <th>ORDEM DE CORTE</th>
                    <th>SITUAÇÃO</th>
                    <th>REQUISITANTE</th>
                    <th>GRUPO REQUISITANTE</th>
                    <th>DATA - HORA</th>
                    <th>CÉLULA</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($requisicoes as $r) {

                    if ($r->getSituacao() === "PENDENTE") {
                        $cor = "bg-warning";
                    } else if ($r->getSituacao() === "EM ATENDIMENTO") {
                        $cor = "bg-success";
                    } else if ($r->getSituacao() === "AGUARDANDO NOTA FISCAL") {
                        $cor = "bg-info";
                    } else {
                        $cor = "bg-danger";
                    }
                    ?>
                    <tr class="<?= $cor; ?> ">
                        <td><strong><a href="#" class="lnk-req" id="<?= $r->getId(); ?>"><?= str_pad($r->getId(), 6, "0", STR_PAD_LEFT); ?></a></strong></td>
                        <td><strong><?= $r->getSetorNome(); ?></strong></td>
                        <td><strong><?= $r->getOrdem(); ?></strong></td>
                        <td><strong><?= $r->getSituacao(); ?></strong></td>
                        <td><strong><?= $r->getUsuarioNomeInclusao(); ?></strong></td>
                        <td><strong><?= utf8_encode($r->getFornecedor()); ?></strong></td>
                        <td><strong><?= date_format(date_create($r->getDataInclusao()), 'd-m-Y - H:i:s'); ?></strong></td>
                        <td><strong><?php 
                        if ($r->getCelulaDescricao() == null) {
                            echo "NÃO INFORMADA";
                        }else{
                            echo $r->getCelulaDescricao();
                        } ?></strong></td>
                    </tr>
                <?php } ?>
            </tbody>
           
        </table> 
        <?php
    }

    public function requisicaoList($rows) {

        $list = "<option value=''>SELECIONE</option>";

        foreach ($rows as $r) {
            $list .= "<option value='" . $r->rmp_id . "'>" . str_pad($r->rmp_id, 6, "0", STR_PAD_LEFT) . "</option>";
        }

        $array = array(
            "list" => $list
        );
        echo json_encode($array);
    }

    public function exportXLSX($rows) {

        require_once("../library/xlsxwriter.class.php");

        $header = [
            "RM" => "string",
            "OC" => "string",
            "DT.EMISSAO" => "string",
            "HR.EMISSAO" => "string",
            "DT.ULTIMA_ATUALIZACAO" => "string",
            "HR.ULTIMA_ATUALIZACAO" => "string",
            "LEADTIME_ATEND" => "string",
            "MOTIVO" => "string",
            "EXPLICACAO_MOTIVO" => "string",
            "DIRECIONADO_PARA" => "string",
            "USUARIO_REQUISITANTE" => "string",
            "GRUPO_REQUISITANTE" => "string",
            "STATUS_ATENDIMENTO" => "string",
            "OBS.ATENDIMENTO" => "string",
            "RESPONSAVEL" => "string",
            "COD.PA" => "string",
            "DESC.PA" => "string",
            "COD.COR_PA" => "string",
            "DESC.COR_PA" => "string",
            "TAM.GRADE_PA" => "string",
            "COD.MP" => "string",
            "DESC.MP" => "string",
            "COD.COR_MP" => "string",
            "DESC.COR_MP" => "string",
            "TAMANHO_MP" => "string",
            "UNID.MEDIDA" => "string",
            "QTDE.REQ" => "string",
            "REQ.ATEND" => "string",
            "%" => "string",
            "FORNECEDOR" => "string",
            "SKU" => "string",
            "SKU_MODIFICADO" => "string",
            "SKU_PARETO" => "string",
            "SEMANA" => "string",
            "MES" => "string",
            "ANO" => "string",
            "CELULA" => "string"
        ];

        $data = [];

        setlocale(LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        foreach ($rows as $row) {

            $data[] = [
                str_pad($row->rmp_id, 6, "0", STR_PAD_LEFT),
                $row->ord_numero,
                date_format(date_create($row->rmp_data_inclusao), "d-m-Y"),
                date_format(date_create($row->rmp_data_inclusao), "H:i:s"),
                date_format(date_create($row->rmp_data_alteracao), "d-m-Y"),
                date_format(date_create($row->rmp_data_alteracao), "H:i:s"),
                date_diff(new DateTime(date_format(date_create($row->rmp_data_alteracao), "d-m-Y")), new DateTime(date_format(date_create($row->rmp_data_inclusao), "d-m-Y")))->format('%d'),
                utf8_encode($row->mot_descricao),
                strtoupper(strtr($row->pro_observacao, "áéíóúâêôãõàèìòùç", "ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ")),
                $row->setor_atendente,
                $row->usuario_inclusao,
                utf8_encode($row->fornecedor_usuario),
                $row->rmp_situacao,
                strtoupper(strtr($row->rmp_observacao, "áéíóúâêôãõàèìòùç", "ÁÉÍÓÚÂÊÔÃÕÀÈÌÒÙÇ")),
                utf8_encode($row->responsavel_motivo),
                $row->pa_codigo,
                $row->pa_descricao,
                $row->pa_cor_codigo,
                $row->pa_cor_descricao,
                $row->pa_tamanho,
                $row->pro_codigo,
                $row->pro_descricao,
                $row->pro_cor_codigo,
                $row->pro_cor_descricao,
                $row->pro_tamanho,
                $row->pro_unidade,
                number_format($row->quantidade_solicitada, 3, ',', '.'),
                number_format($row->pro_quantidade_paga, 3, ',', '.'),
                number_format(($row->pro_quantidade_paga / $row->quantidade_solicitada) * 100, 2, ",", ".") . "%",
                $row->pro_fornecedor,
                $row->pro_codigo . " - " . $row->pro_descricao . " - " . $row->pro_cor_descricao . " - " . $row->pro_tamanho,
                $row->pro_codigo . " - " . $row->pro_cor_descricao . " - " . $row->pro_tamanho,
                $row->pro_codigo . " - " . $row->pro_descricao,
                date_format(date_create($row->rmp_data_inclusao), "W"),
                strtoupper(strftime('%B', strtotime($row->rmp_data_inclusao))),
                date_format(date_create($row->rmp_data_inclusao), "Y"),
                $row->cel_descricao
            ];
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="DOC_MP_' . date('d-m-Y') . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new XLSXWriter();
        $writer->writeSheet($data, 'Plan1', $header);
        $writer->writeToStdOut();
    }

}
