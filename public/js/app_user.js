/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* 
 Created on : 30/10/2017, 16:00:42
 Author     : andersonalves
 */
$(function () {
    var controllerToUser = "app/controller/FrontController.php";
    var hoje = new Date();
    var hora = hoje.getHours();
    var minutos = hoje.getMinutes();
    var horaAtual = hora + ":" + minutos;

    function getSetorPageUser() {
        $.ajax({
            url: controllerToUser,
            type: "POST",
            data: {
                action: "SetorLogica.getSetor"
            },
            success: function (data) {
                $(".sel-tipo-evento-pesquisa").html(data);
                $(".sel-tipo-evento-pesquisa").material_select();
                $("select").material_select();
            }
        });
    }

    function calendarUser(idAmbiente, idBloco, idSetor) {
        $('#calendarUser').fullCalendar('destroy');
        $('#readyCalendarUser').fullCalendar('destroy');
        $('#calendarUser').fullCalendar({
            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro',
                'Outubro', 'Novembro', 'Dezembro'],
            monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Aug', 'Set', 'Out', 'Nov', 'Dez'],
            dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
            dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
            lang: 'pt-br',
            locale: 'pt-br',
            timeFormat: 'HH:mm',
            buttonText: {
                today: 'Hoje',
                month: 'Mês',
                week: 'Semana',
                day: 'Dia'
            },
            displayEventEnd: true,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaDay'
            },
            navLinks: true,
            selectable: true,
            selectHelper: true,
            editable: false,
            eventLimit: true,
            dayClick: function (date, jsEvent, view) {
                console.log("Clicou no dia: " + date.format("DD/MM/YYYY"));
            },
            allDayText: 'Dia Inteiro',
            minTime: '07:00:00',
            maxTime: '20:30:00',
            slotDuration: '00:30:00',
            slotLabelInterval: 30,
            slotLabelFormat: 'HH:mm',
            slotMinutes: 30,
            events: function (start, end, timezone, callback) {
                $.ajax({
                    url: controllerToUser,
                    type: 'POST',
                    data: {
                        action: "EventoLogica.getEventoByAmbiente",
                        idAmbiente: idAmbiente,
                        idBloco: idBloco,
                        idSetor: idSetor
                    },
                    success: function (data) {
                        var events = [];
                        dados = $.parseJSON(data);
                        if (dados.length != 0) {
                            for (var i = 0; i < dados.length; i++) {
                                events.push({
                                    id: dados[i].idEvento,
                                    title: dados[i].nomeEvento,
                                    start: dados[i].dataInicioEvento,
                                    end: dados[i].dataFimEvento
                                });
                            }
                            callback(events);
                        } else {
                            $("#modalEventoNulo").modal();
                            $("#modalEventoNulo").modal("open");
                        }
                    }
                });
            },
            eventClick: function (event, element) {
                $.ajax({
                    url: controllerToUser,
                    type: 'POST',
                    data: {
                        action: "EventoLogica.getEventByIdPageUser",
                        idEvento: event.id
                    }, success: function (data, textStatus, jqXHR) {
                        $("#modalInformationEvent").modal();
                        $("#modalInformationEvent").modal('open');
                        $("#contentInformationEvent").html(data);
//                        $('.tabs#tabs-user').tabs();
                        $('.collapsible').collapsible();
                        getInformationEquipaments(event.id);
                        getInformationServices(event.id);
                        getInformationRefeicoes(event.id);
                        $("select").material_select();
                    }
                });
            }
        });
    }

    function mostrarInPage() {
        $('#readyCalendarUser').fullCalendar({
            header: {
                left: 'prev',
                center: 'title',
                right: 'next'
            },
            height: 300,
            noEventsMessage: 'Selecione um local para visualizar eventos cadastrados.',
            defaultView: 'listWeek'
        });
    }

    function getInformationEquipaments(idEvento) {
        $.ajax({
            url: controllerToUser,
            type: 'POST',
            data: {
                action: "EventoEquipamentoUtilizadoLogica.getInformationsEquipaments",
                idEvento: idEvento
            }, success: function (data, textStatus, jqXHR) {
                $("#equipamentos-user").html(data);
                var valorTd = $(".tabelaEquipamentos tbody tr").length;
                if (valorTd == 0) {
                    $(".tabelaEquipamentos tbody").prepend('<tr><td colspan="6">Não há equipamentos para esse evento</td></tr>');
                }
            }
        });
    }

    function getInformationServices(idEvento) {
        $.ajax({
            url: controllerToUser,
            type: 'POST',
            data: {
                action: "EventoServicoUtilizadoLogica.getInformationsServices",
                idEvento: idEvento
            }, success: function (data, textStatus, jqXHR) {
                $("#servicos-user").html(data);
                var valorTd = $(".tabelaServicos tbody tr").length;
                if (valorTd == 0) {
                    $(".tabelaServicos tbody").prepend('<tr><td colspan="6">Não há serviços para esse evento</td></tr>');
                }
            }
        });
    }

    function getInformationRefeicoes(idEvento) {
        $.ajax({
            url: controllerToUser,
            type: 'POST',
            data: {
                action: "EventoRefeicaoUtilizadoLogica.getInformationsRefeicoes",
                idEvento: idEvento
            }, success: function (data, textStatus, jqXHR) {
                $("#refeicoes-user").html(data);
                var valorTd = $(".tabelaRefeicoes tbody tr").length;
                if (valorTd == 0) {
                    $(".tabelaRefeicoes tbody").prepend('<tr><td colspan="6">Não há refeições para esse evento</td></tr>');
                }
            }
        });
    }

    function pickDataInicio() {
        $('.dataInicio').pickadate({
            selectMonths: true,
            selectYears: 15,
            // Título dos botões de navegação
            labelMonthNext: 'Próximo Mês',
            labelMonthPrev: 'Mês Anterior',
            // Título dos seletores de mês e ano
            labelMonthSelect: 'Selecione o Mês',
            labelYearSelect: 'Selecione o Ano',
            // Meses e dias da semana
            monthsFull: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            weekdaysFull: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
            weekdaysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
            // Letras da semana
            weekdaysLetter: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
            //Botões
            today: 'Hoje',
            clear: 'Limpar',
            close: 'Confirmar',
            // Formato da data que aparece no input
            format: 'dd/mm/yyyy',
            formatSubmit: 'yyyy-mm-dd',
            min: hoje,
            // Dia possível de ser marcado
            onClose: function () {
                $(document.activeElement).blur();
            }
        });
    }

    function pickDataFim() {
        $('.dataFim').pickadate({
            selectMonths: true,
            selectYears: 15,
            // Título dos botões de navegação
            labelMonthNext: 'Próximo Mês',
            labelMonthPrev: 'Mês Anterior',
            // Título dos seletores de mês e ano
            labelMonthSelect: 'Selecione o Mês',
            labelYearSelect: 'Selecione o Ano',
            // Meses e dias da semana
            monthsFull: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            weekdaysFull: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
            weekdaysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
            // Letras da semana
            weekdaysLetter: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
            //Botões
            today: 'Hoje',
            clear: 'Limpar',
            close: 'Confirmar',
            // Formato da data que aparece no input
            format: 'dd/mm/yyyy',
            formatSubmit: 'yyyy-mm-dd',
            min: hoje,
            // Dia possível de ser marcado
            onClose: function () {
                $(document.activeElement).blur();
            }
        });
    }

    function pickHoraInicio() {
        $('.horaInicio').pickatime({
            default: 'now', horaAtual, // Set default time: 'now', '1:30AM', '16:30'
            fromnow: 0, // set default time to * milliseconds from now (using with default = 'now')
            twelvehour: false, // Use AM/PM or 24-hour format
            donetext: 'OK', // text for done-button
            cleartext: 'Clear', // text for clear-button
            canceltext: 'Cancel', // Text for cancel-button
            autoclose: false, // automatic close timepicker
            ampmclickable: true, // make AM PM clickable
            aftershow: function () {} //Function for after opening timepicker
        });
    }

    function pickHoraFim() {
        $('.horaFim').pickatime({
            default: 'now', horaAtual, // Set default time: 'now', '1:30AM', '16:30'
            fromnow: 0, // set default time to * milliseconds from now (using with default = 'now')
            twelvehour: false, // Use AM/PM or 24-hour format
            donetext: 'OK', // text for done-button
            cleartext: 'Clear', // text for clear-button
            canceltext: 'Cancel', // Text for cancel-button
            autoclose: false, // automatic close timepicker
            ampmclickable: true, // make AM PM clickable
            aftershow: function () {} //Function for after opening timepicker
        });
    }

    function getBlocoBySetorPageUser() {
        $(".sel-tipo-evento-pesquisa").change(function () {
            $("#sel-ambiente-pesquisa").empty();
            $("#sel-ambiente-pesquisa").append('<option value="" disabled selected>Escolha sua opção</option>');
            $("#sel-ambiente-pesquisa").material_select();
            var valorTipoEvento = $(this).val();
            $.ajax({
                url: controllerToUser,
                type: "POST",
                data: {
                    action: "BlocoLogica.getBlocoBySetor",
                    valorTipoEvento: valorTipoEvento
                },
                success: function (data) {
                    $("#sel-bloco-pesquisa").empty();
                    $("#sel-bloco-pesquisa").append(data);
                    $("#sel-bloco-pesquisa").material_select();
                }
            });
        });
    }

    function getAmbienteByBlocoPageUser() {
        $(".sel-bloco-pesquisa").change(function () {
            var valorBloco = $(this).val();
            $.ajax({
                url: controllerToUser,
                type: "POST",
                data: {
                    action: "AmbienteLogica.getAmbienteByBloco",
                    valorBloco: valorBloco
                },
                success: function (data) {
                    $("#sel-ambiente-pesquisa").empty();
                    $("#sel-ambiente-pesquisa").append(data);
                    $("#sel-ambiente-pesquisa").material_select();
                }
            });
        });
    }

    $(".sel-ambiente-pesquisa").change(function () {
        var idAmbiente = $("#sel-ambiente-pesquisa").val();
        var idBloco = $("#sel-bloco-pesquisa").val();
        var idSetor = $("#sel-tipo-evento-pesquisa").val();
        calendarUser(idAmbiente, idBloco, idSetor);
    });

    $(".inputPesquisa").on("keypress keyup", function () {
        var valorDigitado = $(this).val();
        if (valorDigitado == "") {
            $(".pesquisaBySelects").show(1000);
            mostrarInPage();
        } else {
            $(".pesquisaBySelects").hide(1000);
            $('#calendarUser').fullCalendar('destroy');
            $('#readyCalendarUser').fullCalendar('destroy');
            $.ajax({
                type: "POST",
                url: controllerToUser,
                data: {
                    action: "EventoLogica.getEventoByPesquisa",
                    valorDigitado: valorDigitado
                }, success: function (data, textStatus, jqXHR) {
                    data = $.parseJSON(data);
                    var eventos = [];
                    for (var i = 0; i < data.length; i++) {
                        eventos = data[i].nomeEvento;
                        console.log(data[i].nomeEvento);
                    }
                }
            });
        }

    });

    getSetorPageUser();
    mostrarInPage();
    pickDataInicio();
    pickDataFim();
    pickHoraInicio();
    pickHoraFim();
    getBlocoBySetorPageUser();
    getAmbienteByBlocoPageUser();


});