<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FiltroEventoView
 *
 * @author Anderson Alves
 */
class FiltroEventoView {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance))
            self::$instance = new FiltroEventoView();

        return self::$instance;
    }

    public function htmlSelectFiltroEvento($filtros) {
        ?>
        <option value="" disabled selected>Escolha sua opção</option>
        <?php
        foreach ($filtros as $filtro) {
            ?>
            <option value="<?= $filtro->getId(); ?>"><?= $filtro->getDescricao(); ?></option>
            <?php
        }
    }

}
