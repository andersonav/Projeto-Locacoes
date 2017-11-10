<?php

require_once '../autoload.php';

spl_autoload_register('autoloadBean');
spl_autoload_register('autoloadDB');

class EventoEquipamentoUtilizadoDao {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance)) {
            self::$instance = new EventoEquipamentoUtilizadoDao();
        }

        return self::$instance;
    }

    public function getObjEventoEquipamentoUtilizado($row) {

        $equipamento = new EventoEquipamentoUtilizado();
        $equipamento->setIdEventoEquipamentoUtilizado($row->eve_equi_uti_id);
        $equipamento->setDescricaoEventoEquipamentoUtilizado($row->equi_eve_desc);
        $equipamento->setQtdEventoEquipamentoUtilizado($row->eve_equi_uti_qtd);

        return $equipamento;
    }

    public function getListObjEventoEquipamentoUtilizado($rows) {

        $arr = [];
        foreach ($rows as $row) {
            $arr[] = $this->getObjEventoEquipamentoUtilizado($row);
        }
        return $arr;
    }

    public function getInformationsEquipaments($idEvento) {
        try {
            $sql = "SELECT * from evento_equipamento_utilizado
                    JOIN equipamentos_evento equi ON equi.equi_eve_id = eve_equi_uti_fkequi_id
                    WHERE eve_equi_uti_fkeve_id = ? ";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $idEvento);
            $p_sql->execute();

            return $this->getListObjEventoEquipamentoUtilizado($p_sql->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

}