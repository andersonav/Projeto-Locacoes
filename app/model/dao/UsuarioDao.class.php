<?php

require_once '../autoload.php';

spl_autoload_register('autoloadDB');
spl_autoload_register('autoloadBean');

class UsuarioDao {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance)) {
            self::$instance = new UsuarioDao();
        }
        return self::$instance;
    }

    public function getObjUsuario($obj) {

        return new Usuario(
                $obj->usu_id, $obj->usu_login, $obj->usu_nome, $obj->usu_senha, $obj->usu_tip_id, $obj->usu_set_id, $obj->usu_for_id, $obj->for_cod_millennium);
    }

    public function getUsuarioByID($id) {

        try {
            $sql = "SELECT * FROM usuario JOIN fornecedor ON (for_id = usu_for_id) WHERE usu_id = ?";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $id);

            $p_sql->execute();

            return $this->getObjUsuario($p_sql->fetch(PDO::FETCH_OBJ));
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function login($login, $senha) {

        try {

            $sql = "SELECT * FROM usuario WHERE usu_login = ? AND usu_ativo = 1";

            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindValue(1, strtoupper($login));

            $p_sql->execute();

            $obj = $p_sql->fetch(PDO::FETCH_OBJ);

            if ($obj) {
                $usuario = new Usuario($obj->usu_id, $obj->usu_login, $obj->usu_nome, $obj->usu_senha, $obj->usu_tip_id);
                if (md5($senha) == $usuario->getSenha()) {
                    $this->registraSessao($usuario);
                    return $usuario;
                } else {
                    print FALSE;
                }
            } else {
                print FALSE;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function logout() {

        session_start();
        $_SESSION = array();
        session_destroy();
        echo true;
    }

    public function registraSessao(Usuario $usuario) {
        session_start();
        $_SESSION['usuario_id'] = $usuario->getID();
        $_SESSION['usuario_login'] = $usuario->getLogin();
        $_SESSION['usuario_nome'] = $usuario->getNome();
        $_SESSION['usuario_tipo_id'] = $usuario->getTipoID();
    }

    public function resetSenha($usuarioId, $senhaNova) {

        try {

            $sql = "UPDATE usuario SET usu_senha = ? WHERE usu_id = ?";

            $p_sql = ConexaoMysql::getInstance()->prepare($sql);

            $p_sql->bindParam(1, password_hash($senhaNova, PASSWORD_DEFAULT));

            $p_sql->bindParam(2, $usuarioId);

            $p_sql->execute();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function verificaSenha($usuarioId, $senhaAntiga) {

        try {

            $sql = "SELECT * FROM usuario WHERE usu_id = ?";

            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $usuarioId);

            $p_sql->execute();

            $row = $p_sql->fetch(PDO::FETCH_OBJ);

            if (password_verify($senhaAntiga, $row->usu_senha))
                return true;
            else
                return false;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function novaSenha(array $param) {

        $teste = $this->verificaSenha($param['usuario'], $param['senhaAntiga']);

        if ($teste) {
            return $this->resetSenha($param['usuario'], $param['senhaNova']);
        } else {
            echo 'error-pass';
        }
    }

}
