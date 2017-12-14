<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8' />
        <style type="text/css">
            .corLogo-text{
                color: #006B43 !important;
            }
            .tabelaServicos{
                width: 70%;
                /*margin: 5%;*/
            }
            .tabelaServicos thead th{
                text-align: center;
                font-size: 20px !important;
                padding: 0.4em;
            }
            .tabelaServicos tbody tr td{
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
            <table class="highlight centered tabelaServicos">
                <thead>
                    <tr> 
                        <!--<i class="material-icons">check</i>-->
                        <th class="corLogo-text">Serviço</th>
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
