<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SituacaoView
 *
 * @author Anderson Alves
 */
class SituacaoView {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance))
            self::$instance = new SituacaoView();

        return self::$instance;
    }

    public function htmlSelectSituacao($situacoes) {
        ?>
        <option value="" disabled selected>Escolha sua opção</option>
        <?php
        foreach ($situacoes as $situacao) {
            ?>
            <option value="<?= $situacao->getId(); ?>"><?= $situacao->getDescricao(); ?></option>
            <?php
        }
    }

}
