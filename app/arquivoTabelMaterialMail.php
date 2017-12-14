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
            <h4 class="center">Olá, <br/><br/> No cadastro do Evento <b>{{nomeEvento}}</b>, que ocorrerá das {{mensagem}}, foram solicitados os seguintes itens:<br/></h4>
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
                    {{foreach}}
                </tbody>
            </table> 
        </div>
    </body>
</html>
