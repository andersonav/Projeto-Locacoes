<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DadosServicoView
 *
 * @author Anderson Alves
 */
class DadosServicoView {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance))
            self::$instance = new DadosServicoView();

        return self::$instance;
    }

    public function htmlMailToResponsavelServico($informations) {
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
            $mail->CharSet = 'UTF-8';
            //Define os destinatário(s)
            //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
            //$mail->AddAddress('e-mail@destino.com.br', 'Teste Locaweb');
            //$mail->AddCC('destinarario@dominio.com.br', 'Destinatario'); // Copia
            //$mail->AddBCC('destinatario_oculto@dominio.com.br', 'Destinatario2`'); // Cópia Oculta
            //$mail->AddAttachment('images/phpmailer.gif');      // Adicionar um anexo
            //Arquivo php que contem o HTML
            $arquivo = file_get_contents("../arquivoTabelServiceMail.php");
            $dados = "";
            $email = "";
            $nomeEvento = "";
            $dataInicioEvento = "";
            $horaInicioEvento = "";
            $dataFimEvento = "";
            $horaFimEvento = "";
            foreach ($informations as $information) {
                $nomeEvento = $information->getNomeEvento();
                $email = $information->getServicoEmailResponsavelEvento();
                $dataInicioEvento = date_format(date_create($information->getDataInicioEvento()), "d/m/Y");
                $horaInicioEvento = date_format(date_create($information->getDataInicioEvento()), "H:i");
                $dataFimEvento = date_format(date_create($information->getDataFimEvento()), "d/m/Y");
                $horaFimEvento = date_format(date_create($information->getDataFimEvento()), "H:i");
                $dados .= '<tr>
                    <td><strong>' . $information->getServicoDescricaoEvento() . '</strong></td>
                    <td><strong>' . date_format(date_create($information->getServicoDataInicio()), "d/m/Y") . '</strong></td>
                    <td><strong>' . date_format(date_create($information->getServicoDataInicio()), "H:i") . '</strong></td>
                    <td><strong>' . date_format(date_create($information->getServicoDataFim()), "d/m/Y") . '</strong></td>
                    <td><strong>' . date_format(date_create($information->getServicoDataFim()), "H:i") . '</strong></td>
                </tr>';
            }
            $mensagem = "";
            $mail->addAddress($email);
            if ($dataInicioEvento == $dataFimEvento) {
                $mensagem = "<b>" . $horaInicioEvento . "h</b> às <b>" . $horaFimEvento . "h</b> do dia <b>" . $dataInicioEvento . "</b>";
            } else {
                $mensagem = "<b>" . $horaInicioEvento . "h</b> do dia <b>" . $dataInicioEvento . "</b> às <b>" . $horaFimEvento . "h</b> do dia <b>" . $dataFimEvento . "</b>";
            }
            // Muda o nome {foreach} para o valor de informations dentro do arquivo replace
            $replace = str_replace("{{foreach}}", $dados, $arquivo);
            $replaceToNomeEvento = str_replace("{{nomeEvento}}", $nomeEvento, $replace);
            $replaceToMensagem = str_replace("{{mensagem}}", $mensagem, $replaceToNomeEvento);
            $mail->msgHTML($replaceToMensagem);
            $mail->Send();
        } catch (phpmailerException $e) {
            die($e->getMessage());
        }
    }

}
