<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TipoRepeticaoView
 *
 * @author Anderson Alves
 */
class TipoRepeticaoView {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance))
            self::$instance = new TipoRepeticaoView();

        return self::$instance;
    }

    public function htmlSelectTipoRepeticao($tipos) {
        ?>
        <option value="" disabled>Escolha sua opção</option>
        <?php
        foreach ($tipos as $tipo) {
            ?>
            <option value="<?= $tipo->getIdTipoRepeticao(); ?>"><?= $tipo->getDescricaoTipoRepeticao(); ?></option>
            <?php
        }
    }

}
