<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DadosEquipamentoView
 *
 * @author Anderson Alves
 */
class DadosEquipamentoView {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance))
            self::$instance = new DadosEquipamentoView();

        return self::$instance;
    }

    public function htmlMailToResponsavelEquipamento($informations) {
        require_once '../library/phpmailer/class.smtp.php';
        require_once '../library/phpmailer/class.phpmailer.php';

        $mail = new PHPMailer(true);

        $mail->isSMTP();

        try {

            $mail->Host = 'smtp.gmail.com'; // Endereço do servidor SMTP (Autenticação, utilize o host smtp.seudomínio.com.br)
            $mail->SMTPAuth = true;  // Usar autenticação SMTP (obrigatório para smtp.seudomínio.com.br)
            $mail->Port = 465; //  Usar 587 porta SMTP
            $mail->Username = 'cti.maracanau@ifce.edu.br'; // Usuário do servidor SMTP (endereço de email)
            // Senha nova: @cti!2018
            $mail->Password = '@cti!2018'; // Senha do servidor SMTP (senha do email usado)
            $mail->SMTPSecure = 'ssl';
            //Define o remetente
            // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=    
            $mail->SetFrom('cti.maracanau@ifce.edu.br', 'SysReserva'); //Seu e-mail
            // $mail->AddReplyTo('emerson.henrique@ifce.edu.br', 'SysReserva'); //Seu e-mail
            $mail->Subject = 'SysReserva - Solicitações'; //Assunto do e-mail
            $mail->CharSet = 'UTF-8';
            //Define os destinatário(s)
            //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
            //$mail->AddAddress('e-mail@destino.com.br', 'Teste Locaweb');
            //$mail->AddCC('destinarario@dominio.com.br', 'Destinatario'); // Copia
            //$mail->AddBCC('destinatario_oculto@dominio.com.br', 'Destinatario2`'); // Cópia Oculta
            //$mail->AddAttachment('images/phpmailer.gif');      // Adicionar um anexo
            //Arquivo php que contem o HTML
            $arquivo = file_get_contents("../arquivoMailHTML.php");
            $dados = "";
            $telefoneSolicitante = "";
            $emailSolicitante = "";
            $email = "";
            foreach ($informations as $information) {
                $email = $information->getEquipamentoEmailResponsavelEvento();
                $telefoneSolicitante = $information->getTelefoneSolicitante();
                $emailSolicitante = $information->getEmailSolicitante();
                $dados .= '
                    <b>Evento: </b>' . $information->getNomeEvento() . '<br/>
                    <b>Solicitante: </b>' . $information->getSolicitanteEvento() . '<br/>
                    <b>Ambiente: </b>' . $information->getAmbienteDescricaoEvento() . '<br/>
                    <b>Material: </b>' . $information->getEquipamentoDescricaoEvento() . '<br/>    
                    <b>Quantidade: </b>' . $information->getEquipamentoQtdUtilizadaEvento() . '<br/>     
                    <br/><b>Período de utilização do material: </b><br/>
                    <b>Data/Hora Início: </b>' . date_format(date_create($information->getEquipamentoDataInicio()), "d/m/Y") . ' ' . date_format(date_create($information->getEquipamentoDataInicio()), "H:i") . '<br/>
                    <b>Data/Hora Conclusão: </b>' . date_format(date_create($information->getEquipamentoDataFim()), "d/m/Y") . ' ' . date_format(date_create($information->getEquipamentoDataFim()), "H:i") . '<br/>';
            }
            $mail->addAddress($email);
            // Muda o nome {foreach} para o valor de informations dentro do arquivo replace
            $replace = str_replace("{{foreach}}", $dados, $arquivo);
            $replaceToTelefone = str_replace("{{telefoneSolicitante}}", $telefoneSolicitante, $replace);
            $replaceToEmail = str_replace("{{emailSolicitante}}", $emailSolicitante, $replaceToTelefone);
            $mail->msgHTML($replaceToEmail);
            $mail->Send();
        } catch (phpmailerException $e) {
            die($e->getMessage());
        }
    }

}
