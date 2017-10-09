<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Setor
 *
 * @author Anderson Alves
 */
class SetorView {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance))
            self::$instance = new SetorView();

        return self::$instance;
    }

    public function htmlSelectSetor($setores) {
        ?>
        <option value="" disabled selected>Escolha sua opção</option>
        <?php
        foreach ($setores as $setor) {
            ?>
            <option value="<?= $setor->getId(); ?>"><?= $setor->getDescricao(); ?></option>
            <?php
        }
    }

    public function htmlSelectTodosSetor($todosSetores) {
        ?>
        <option value="" disabled selected>Escolha sua opção</option>
        <?php
        foreach ($todosSetores as $setores) {
            ?>
            <option value="<?= $setores->getId(); ?>"><?= $setores->getDescricao(); ?></option>
            <?php
        }
    }

}
