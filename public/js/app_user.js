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
                        $('.tabs#tabs-user').tabs();
                        getInformationEquipaments(event.id);
                        $("select").material_select();
                    }
                });
            },
            eventRender: function (event, eventElement, element) {


                // If you want it on a lin
            }
        });
    }

    function mostrarInPage() {
        $('#readyCalendarUser').fullCalendar({
            header: {
                left: 'prev today',
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
    $("select[name=aula]").change(function () {
        var valorSelect = $(this).val();
        if (valorSelect == 2) {
            $(".nomeProfessor").attr("disabled", "disabled");
        } else {
            $(".nomeProfessor").removeAttr("disabled");
        }
    });
    $(".openModalAdicionarEvento").click(function () {
        $(".dataInicio").removeAttr("disabled");
        $(".dataFim").removeAttr("disabled");
        $(".horaInicio").removeAttr("disabled");
        $(".horaFim").removeAttr("disabled");
        $(".mostrarWhenClickBtn").removeClass("cadastroClickBtn");
        $("#modalAdicionarEventoClickDay").modal({
            complete: function () {
                $('#form_add_event').each(function () {
                    this.reset();
                });
            }
        });
        $("#modalAdicionarEventoClickDay").modal('open');
        isNumeric();
        habilitarQutdSolicitada();
        verifyCheck();
        verifyCampos();
    });

    function verifyCampos() {
        $(".buttonOkay").click(function () {
            var ano = hoje.getFullYear();
            var mes = hoje.getMonth() + 1;
            var dia = hoje.getDate();
            var hora = hoje.getHours();
            var minutos = hoje.getMinutes();
            var segundos = hoje.getSeconds();
            var hojeFormatada = ano + "-" + mes + "-" + dia + " " + hora + ":" + minutos + ":" + segundos;
            var nomeEvento = $(".nomeEvento").val();
            var solicitanteEvento = $(".solicitante").val();
            var tipoEvento = $("#sel-tipo-evento").val();
            var blocoEvento = $("#sel-bloco").val();
            var ambienteEvento = $("#sel-ambiente").val();
            var corEvento = $("#sel-color").val();
            var idAula = $("#sel-aula").val();
            var tipoRepeticao = $("#sel-tip-repeticao").val();
            var descricaoEvento = $(".descricaoEvento").val();
            var dataInicio = $(".dataInicio").val();
            var horaInicio = $(".horaInicio").val();
            var dataFim = $(".dataFim").val();
            var horaFim = $(".horaFim").val();
//            23/12/2017

            var contadorInput = 0;
            var contadorSelect = 0;
            $("#form_add_event input:enabled").each(function () {
                $(this).val() == "" ? contadorInput++ : "";
            });

            $("#form_add_event select").each(function () {
                $(this).val() == null ? contadorSelect++ : "";
            });

            if ((contadorInput == 0) && (contadorSelect == 0)) {
                var inicio = dataInicio.substr(6, 4) + "-" + dataInicio.substr(3, 2) + "-" + dataInicio.substr(0, 2) + " " + horaInicio;
                var fim = dataFim.substr(6, 4) + "-" + dataFim.substr(3, 2) + "-" + dataFim.substr(0, 2) + " " + horaFim;
                if (inicio < hojeFormatada) {
                    $("#modalDataAnterior").modal();
                    $("#modalDataAnterior").modal('open');
                } else {
                    if (inicio > fim) {
                        $("#modalDataInicioMaiorQueFinal").modal();
                        $("#modalDataInicioMaiorQueFinal").modal('open');
                    } else {
                        var valorBoolean = verifyDates(inicio, fim, ambienteEvento);
                        if (valorBoolean == true) {
                            if ($(".idEquipamento").is(":checked")) {
                                var nomeProfessor = $(".nomeProfessor").val();
                                if ((idAula == 1) && (nomeProfessor == "")) {
                                    $("#modalCamposNulos").modal();
                                    $("#modalCamposNulos").modal('open');

                                } else {
                                    if ($("#input1").is(":checked")) {
                                        if (insertEventoSelecionado(nomeEvento, solicitanteEvento, tipoEvento, blocoEvento, ambienteEvento, corEvento, tipoRepeticao, idAula, descricaoEvento, inicio, fim) == true) {
                                            var valorIdEvento = getEventByAmbienteAndStartAndEnd(ambienteEvento, inicio, fim);
                                            if (valorIdEvento != 0) {
                                                var valorCheck = $("#input1").val();
                                                insertInTabelEventEquipamentUsed(valorIdEvento, valorCheck, "-");
                                                if (idAula == 1) {
                                                    insertIntoTableAulaDetalhes(valorIdEvento, idAula, nomeProfessor);
                                                }
                                            } else {
                                                console.log('Não tem valor');
                                            }
                                            $("#modalAdicionarEventoClickDay").modal('close');
                                        }

                                    } else {
                                        var errorCampoNulo = 0;
                                        $(".getQtd").each(function () {
                                            var qtdEquipamento = $(this).val();
                                            if (qtdEquipamento == "") {
                                                errorCampoNulo++;
                                            }
                                        });
                                        if (errorCampoNulo != 0) {
                                            $("#modalCamposNulos").modal();
                                            $("#modalCamposNulos").modal('open');
                                        } else {
                                            if (insertEventoSelecionado(nomeEvento, solicitanteEvento, tipoEvento, blocoEvento, ambienteEvento, corEvento, tipoRepeticao, idAula, descricaoEvento, inicio, fim) == true) {
                                                var valorIdEvento = getEventByAmbienteAndStartAndEnd(ambienteEvento, inicio, fim);
                                                $(".getQtd").each(function () {
                                                    if (valorIdEvento != 0) {
                                                        var valorEquipamento = $(this).attr('id');
                                                        var qtdEquipamento = $(this).val();
                                                        insertInTabelEventEquipamentUsed(valorIdEvento, valorEquipamento, qtdEquipamento);
                                                    } else {
                                                        console.log("Não tem valor");
                                                    }
                                                });
                                                if (idAula == 1) {
                                                    insertIntoTableAulaDetalhes(valorIdEvento, idAula, nomeProfessor);
                                                }
                                                $("#modalAdicionarEventoClickDay").modal('close');
                                            }
                                        }
                                    }
                                    location.reload();
                                }
                            } else {
                                $("#modalCheckNulo").modal();
                                $("#modalCheckNulo").modal('open');
                            }
                        } else {
                            $("#modalDatasIguais").modal();
                            $("#modalDatasIguais").modal('open');
                        }
                    }

                }
//                            $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
//                            insertEventoSelecionado(nomeEvento, solicitanteEvento, tipoEvento, blocoEvento, ambienteEvento, corEvento, title, start, end);
            } else {
                $("#modalCamposNulos").modal();
                $("#modalCamposNulos").modal("open");
            }

        });

        $(".buttonCancel").click(function () {
            $("#modalAdicionarEventoClickDay").modal('close');
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



    getSetorPageUser();
    mostrarInPage();
    pickDataInicio();
    pickDataFim();
    pickHoraInicio();
    pickHoraFim();
    getBlocoBySetorPageUser();
    getAmbienteByBlocoPageUser();

});