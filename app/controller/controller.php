<?php

$user = "root";
$pass = "1234";
$conn = new PDO("mysql:host=localhost; dbname=intranet;", $user, $pass);
$action = $_POST['action'];

switch ($action) {
    case 'buscarOuvidoriaTipo':

        $buscarOuvidoriaSetor = $conn->prepare("SELECT * FROM ouvidoria_tipos");
        $buscarOuvidoriaSetor->execute();
        $arr = array();
        while ($rows = $buscarOuvidoriaSetor->fetchObject()) {
            $arr[] = $rows;
        }
        echo json_encode($arr);

        break;
    case 'buscarNomeSetor':

        $buscarNameSetor = $conn->prepare("SELECT * FROM ouvidoria_setor");
        $buscarNameSetor->execute();
        $arr = array();
        while ($rows = $buscarNameSetor->fetchObject()) {
            $arr[] = $rows;
        }
        echo json_encode($arr);

        break;
    case 'buscarTipoUser':

        $buscarTipoUser = $conn->prepare("SELECT * FROM ouvidoria_tipo_user");
        $buscarTipoUser->execute();
        $arr = array();
        while ($rows = $buscarTipoUser->fetchObject()) {
            $arr[] = $rows;
        }
        echo json_encode($arr);

        break;
    case 'buscarLocalBySetor':
        $valorSelect = $_POST['valorSelect'];
        $buscarLocalBySetor = $conn->prepare("SELECT * FROM ouvidoria_local WHERE ouv_loc_set_id = ?");
        $buscarLocalBySetor->bindParam(1, $valorSelect);
        $buscarLocalBySetor->execute();

        $arr = array();
        while ($rows = $buscarLocalBySetor->fetchObject()) {
            $arr[] = $rows;
        }
        echo json_encode($arr);

        break;
    case 'buscarAmbienteByLocal':

        $valorSelectSetor = $_POST['valorSelectSetor'];
        $valorSelectLocal = $_POST['valorSelectLocal'];
        $buscarAmbienteByLocal = $conn->prepare("SELECT * FROM ouvidoria WHERE ouv_set_id = ? AND ouv_set_loc_id = ?");
        $buscarAmbienteByLocal->bindParam(1, $valorSelectSetor);
        $buscarAmbienteByLocal->bindParam(2, $valorSelectLocal);
        $buscarAmbienteByLocal->execute();

        $arr = array();
        while ($rows = $buscarAmbienteByLocal->fetchObject()) {
            $arr[] = $rows;
        }
        echo json_encode($arr);

        break;
    case 'buscarNaturezaAssuntoBySetor':

        $valorNatureza = $_POST['valor'];
        $buscarNaturezaBySetor = $conn->prepare("SELECT * FROM ouvidoria_natureza_assunto WHERE ouv_tip_id = ?");
        $buscarNaturezaBySetor->bindParam(1, $valorNatureza);
        $buscarNaturezaBySetor->execute();

        $arr = array();
        while ($rows = $buscarNaturezaBySetor->fetchObject()) {
            $arr[] = $rows;
        }
        echo json_encode($arr);

        break;


    default:
        
}
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>