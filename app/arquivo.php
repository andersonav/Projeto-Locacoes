<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8' />
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
            <!--No cadastro do Evento $nomeEvento, que ocorrerá de $dataInicio - $dataFim, foram solicitados os seguintes itens  --> 
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

                    <?php
                    foreach ($informations as $information) {
                        ?>
                        <tr>
                            <td><strong><?= $information->getEquipamentoDescricaoEvento(); ?></strong></td>
                            <td><strong><?= $information->getEquipamentoQtdUtilizadaEvento(); ?></strong></td>
                            <td><strong><?= date_format(date_create($information->getDataInicioEvento()), "d/m/Y"); ?></strong></td>
                            <td><strong><?= date_format(date_create($information->getDataInicioEvento()), "H:i"); ?></strong></td>
                            <td><strong><?= date_format(date_create($information->getDataFimEvento()), "d/m/Y"); ?></strong></td>
                            <td><strong><?= date_format(date_create($information->getDataFimEvento()), "H:i"); ?></strong></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table> 
        </div>
    </body>
</html>
