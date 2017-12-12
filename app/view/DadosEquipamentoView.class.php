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
        $array = [];
        foreach ($informations as $information) {
            $array = [
                $information->getNomeEvento(),
                $information->getEquipamentoDescricaoEvento(),
                $information->getEquipamentoQtdUtilizadaEvento(),
                date_format(date_create($information->getDataInicioEvento()), "d/m/Y"),
                date_format(date_create($information->getDataInicioEvento()), "H:i"),
                date_format(date_create($information->getDataFimEvento()), "d/m/Y"),
                date_format(date_create($information->getDataFimEvento()), "H:i"),
            ];
        }
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
            $mail->addAddress('alveesbezerra13@gmail.com', 'Anderson Alves');
            //Campos abaixo são opcionais 
            //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
            //$mail->AddCC('destinarario@dominio.com.br', 'Destinatario'); // Copia
            //$mail->AddBCC('destinatario_oculto@dominio.com.br', 'Destinatario2`'); // Cópia Oculta
            //$mail->AddAttachment('images/phpmailer.gif');      // Adicionar um anexo
            //Define o corpo do email
            ////Caso queira colocar o conteudo de um arquivo utilize o método abaixo ao invés da mensagem no corpo do e-mail.
            $mail->MsgHTML('<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <style type="text/css">
            .corLogo-text{
                color: #006B43 !important;
            }
            .tabelaEquipamentos{
                width: 70%;
                /*margin: 5%;*/
            }
            .tabelaEquipamentos thead th{
                text-align: center;

                font-size: 20px !important;
                padding: 0.4em;
            }
            .tabelaEquipamentos tbody tr td{
                text-align: center;
                font-size: 17px !important;
            }
            h4{
                font-weight: normal;
                font-size: 17px;
            }
        </style>
    </head>
    <body>
        <div class="scroll">
        <h4 class="center">Olá, <br/><br/> No cadastro do Evento <b>' . $informations->$array[0] . '</b>, que ocorrerá de <b>' . $informations->dataInicioEvento . ' - ' . $informations->dataFimEvento . '</b>, foram solicitados os seguintes itens:<br/></h4>
            <table class="highlight centered tabelaEquipamentos">
                <thead>
                    <tr> 
                        <!--<i class="material-icons">check</i>-->
                        <th class="corLogo-text">Material</th>
                        <th class="corLogo-text">Qtd Solicitada</th>
                        <th class="corLogo-text">Data Início</th>
                        <th class="corLogo-text">Hora Início</th>
                        <th class="corLogo-text">Data Final</th>
                        <th class="corLogo-text">Hora Final</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td><strong> ' . $array[1] . '</strong></td>
                            <td><strong> ' . $array[2] . '</strong></td>
                            <td><strong> ' . $array[3] . '</strong></td>
                            <td><strong> ' . $array[4] . '</strong></td>
                            <td><strong> ' . $array[5] . '</strong></td>
                            <td><strong> ' . $array[6] . '</strong></td>
                        </tr>
                </tbody>
            </table> 
        </div>
    </body>
</html>');
            $mail->Send();
        } catch (phpmailerException $e) {
            die($e->getMessage());
        }
    }

}
