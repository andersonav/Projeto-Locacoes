<?php

require_once '../autoload.php';

spl_autoload_register('autoloadBean');
spl_autoload_register('autoloadDB');

class EventoServicoUtilizadoDao {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance)) {
            self::$instance = new EventoServicoUtilizadoDao();
        }

        return self::$instance;
    }

    public function getObjEventoServicoUtilizado($row) {

        $servico = new EventoServicoUtilizado();
        $servico->setIdEventoServicoUtilizado($row->eve_ser_uti_id);
        $servico->setDescricaoEventoServicoUtilizado($row->ser_eve_desc);
        $servico->setDataInicioServicoUtilizado($row->eve_ser_uti_data_inicio);
        $servico->setDataFimServicoUtilizado($row->eve_ser_uti_data_fim);

        return $servico;
    }

    public function getListObjEventoServicoUtilizado($rows) {

        $arr = [];
        foreach ($rows as $row) {
            $arr[] = $this->getObjEventoServicoUtilizado($row);
        }
        return $arr;
    }

    public function getInformationsServices($idEvento) {
        try {
            $sql = "SELECT * from evento_servico_utilizado
                    JOIN servicos_evento ser ON ser.ser_eve_id = eve_ser_uti_fkser_id
                    WHERE eve_ser_uti_fkeve_id = ?";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $idEvento);
            $p_sql->execute();

            return $this->getListObjEventoServicoUtilizado($p_sql->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

}
