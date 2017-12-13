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
            $mail->Username = 'sys.reserva.ifce@gmail.com'; // Usuário do servidor SMTP (endereço de email)
            $mail->Password = 'sysreservaifce'; // Senha do servidor SMTP (senha do email usado)
            $mail->SMTPSecure = 'ssl';
            //Define o remetente
            // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=    
            $mail->SetFrom('sys.reserva.ifce@gmail.com', 'SysReserva'); //Seu e-mail
            // $mail->AddReplyTo('emerson.henrique@ifce.edu.br', 'SysReserva'); //Seu e-mail
            $mail->Subject = 'SysReserva - Locações'; //Assunto do e-mail
            //Define os destinatário(s)
            //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
//                    $mail->AddAddress('e-mail@destino.com.br', 'Teste Locaweb');
            //Campos abaixo são opcionais 
            //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
            //$mail->AddCC('destinarario@dominio.com.br', 'Destinatario'); // Copia
            //$mail->AddBCC('destinatario_oculto@dominio.com.br', 'Destinatario2`'); // Cópia Oculta
            //$mail->AddAttachment('images/phpmailer.gif');      // Adicionar um anexo
            //Define o corpo do email
            $replace = file_get_contents("../arquivo.php");
            $dados = "";
            $email = "";
            foreach ($informations as $information) {
                $email = $information->getEquipamentoEmailResponsavelEvento();
                $dados .= '<tr>
                    <td><strong>' . $information->getEquipamentoDescricaoEvento() . '</strong></td>
                    <td><strong>' . $information->getEquipamentoQtdUtilizadaEvento() . '</strong></td>
                    <td><strong>' . date_format(date_create($information->getDataInicioEvento()), "d/m/Y") . '</strong></td>
                    <td><strong>' . date_format(date_create($information->getDataInicioEvento()), "H:i") . '</strong></td>
                    <td><strong>' . date_format(date_create($information->getDataFimEvento()), "d/m/Y") . '</strong></td>
                    <td><strong>' . date_format(date_create($information->getDataFimEvento()), "H:i") . '</strong></td>
                </tr>';
            }
            $mail->addAddress($email);
            // Muda o nome {foreach} para o valor de informations dentro do arquivo replace
            $replace = str_replace("{{foreach}}", $dados, $replace);
            $mail->msgHTML($replace);
            $mail->Send();
        } catch (phpmailerException $e) {
            die($e->getMessage());
        }
    }

}
