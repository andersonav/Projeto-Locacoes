/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* 
 Created on : 14/09/2017, 13:58:42
 Author     : andersonalves
 */
$(function () {
    var controllerToAdmin = "controller/FrontController.php";
    var hoje = new Date();
    var hora = hoje.getHours();
    var minutos = hoje.getMinutes();
    var horaAtual = hora + ":" + minutos;

    function calendarAdmin(idAmbiente, idBloco, idSetor) {
        $('#calendar').fullCalendar('destroy');
        $('#calendar').fullCalendar({
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
                right: 'month,agendaWeek,agendaDay'
            },
            navLinks: true,
            selectable: true,
            selectHelper: true,
            editable: false,
            eventLimit: true,
            dayClick: function (date, jsEvent, view) {
//                console.log("Clicou no dia: " + date.format());
            },
            select: function (start, end) {
                isNumeric();
                habilitarInputsEquipamentos();
                habilitarInputsServicos();
                habilitarInputsRefeicoes();
                verifyCheck();
                verifyCheckServices();
                verifyCheckRefeicoes();
                pickDataInicio();
                pickHoraInicio();
                pickDataFim();
                pickHoraFim();
                start = $.fullCalendar.formatDate(start, "YYYY-MM-DD HH:mm:ss");
                var ano = hoje.getFullYear();
                var mes = hoje.getMonth() + 1;
                var dia = hoje.getDate();
                if (dia < 10) {
                    dia = 0 + "" + dia;
                }
                var hora = hoje.getHours();
                var minutos = hoje.getMinutes();
                var segundos = hoje.getSeconds();
                var hojeFormatada = ano + "-" + mes + "-" + dia + " " + hora + ":" + minutos + ":" + segundos;
                if (start < hojeFormatada) {
                    start = null;
                    end = null;
                    $("#modalDataAnterior").modal();
                    $("#modalDataAnterior").modal('open');
                } else {
                    var diaInicio = start.substr(8, 2);
                    var mesInicio = start.substr(5, 2);
                    var anoInicio = start.substr(0, 4);
                    var horaInicio = start.substr(11, 8);
                    var inicio = diaInicio + "/" + mesInicio + "/" + anoInicio;
                    end = $.fullCalendar.formatDate(end, "YYYY-MM-DD HH:mm:ss");
                    var diaFim = end.substr(8, 2);
                    var mesFim = end.substr(5, 2);
                    var anoFim = end.substr(0, 4);
                    var horaFim = end.substr(11, 8);
                    var fim = diaFim + "/" + mesFim + "/" + anoFim;
                    $(".divAula").addClass('esconderDivAula');
                    $('#modalAdicionarEventoClickDay').modal();
                    $("#form_add_event .dataInicio").attr('disabled', 'disabled');
                    $("#form_add_event .dataFim").attr('disabled', 'disabled');
                    $("#form_add_event .horaInicio").attr('disabled', 'disabled');
                    $("#form_add_event .horaFim").attr('disabled', 'disabled');
                    $(".dataInicio").val(inicio);
                    $(".horaInicio").val(horaInicio);
                    $(".dataFim").val(fim);
                    $(".horaFim").val(horaFim);
                    $("#modalAdicionarEventoClickDay").modal({
                        complete: function () {
                            start = null;
                            end = null;
                            $('#form_add_event').each(function () {
                                this.reset();
                            });
                        }
                    });

                    $("#modalAdicionarEventoClickDay").modal('open');
//                     compararQtdSolicitadaComQtdDisponivel();
                    $(".mostrarWhenClickBtn").addClass("cadastroClickBtn");
                    var title;
                    var eventData;
                    $(".buttonOkay").click(function () {
                        var nomeEvento = $(".nomeEvento").val();
                        var solicitanteEvento = $(".solicitante").val();
                        var tipoEvento = $("#sel-tipo-evento").val();
                        var blocoEvento = $("#sel-bloco").val();
                        var ambienteEvento = $("#sel-ambiente").val();
                        var eventoTipoRepeticao = 1;
                        var idAula = 2;
                        title = $(".descricaoEvento").val();
                        if (nomeEvento != "" || title != "" || solicitanteEvento != "" || tipoEvento != null || blocoEvento != null || ambienteEvento != null) {
                            if ($(".idEquipamento").is(":checked")) {
                                eventData = {
                                    title: title,
                                    start: start,
                                    end: end,
                                    imageurl: "../public/img/informacoes.png"
                                };
                                var valorBoolean = verifyDates(start, end, ambienteEvento);
                                if (valorBoolean == true) {
                                    if ($("#input1").is(":checked")) {
                                        if (insertEventoSelecionado(nomeEvento, solicitanteEvento, tipoEvento, blocoEvento, ambienteEvento, eventoTipoRepeticao, idAula, title, start, end) == true) {
                                            var valorIdEvento = getEventByAmbienteAndStartAndEnd(ambienteEvento, start, end);
                                            var valorCheck = $("#input1").val();
                                            var dataInicioEquipamento = $(".txt-data-inicial#input" + valorCheck).val();
                                            var horaInicioEquipamento = $(".txt-hora-inicial#input" + valorCheck).val();
                                            var dataFimEquipamento = $(".txt-data-final#input" + valorCheck).val();
                                            var horaFimEquipamento = $(".txt-hora-final#input" + valorCheck).val();
                                            var dataInicioFormatadaCompleta = dataInicioEquipamento.substr(6, 4) + "-" + dataInicioEquipamento.substr(3, 2) + "-" + dataInicioEquipamento.substr(0, 2) + " " + horaInicioEquipamento;
                                            var dataFimFormatadaCompleta = dataFimEquipamento.substr(6, 4) + "-" + dataFimEquipamento.substr(3, 2) + "-" + dataFimEquipamento.substr(0, 2) + " " + horaFimEquipamento;
                                            insertInTabelEventEquipamentUsed(valorIdEvento, valorCheck, "-", dataInicioFormatadaCompleta, dataFimFormatadaCompleta);
                                            start = null;
                                            end = null;
                                            $("#modalAdicionarEventoClickDay").modal('close');
                                        }
                                    } else {
                                        var errorCampoNulo = 0;
                                        $(".getInformationsEquipaments").each(function () {
                                            var qtdEquipamento = $(this).val();
                                            if (qtdEquipamento == "") {
                                                errorCampoNulo++;
                                            }
                                        });

                                        if (errorCampoNulo != 0) {
                                            $("#modalCamposNulos").modal();
                                            $("#modalCamposNulos").modal('open');
                                        } else {
                                            if (insertEventoSelecionado(nomeEvento, solicitanteEvento, tipoEvento, blocoEvento, ambienteEvento, eventoTipoRepeticao, idAula, title, start, end) == true) {
                                                var valorIdEvento = getEventByAmbienteAndStartAndEnd(ambienteEvento, start, end);
                                                $(".idEquipamento:checked").each(function () {
                                                    var idEquipamento = $(this).val();
                                                    var dataInicioEquipamento = $(".txt-data-inicial#input" + idEquipamento).val();
                                                    var horaInicioEquipamento = $(".txt-hora-inicial#input" + idEquipamento).val();
                                                    var dataFimEquipamento = $(".txt-data-final#input" + idEquipamento).val();
                                                    var horaFimEquipamento = $(".txt-hora-final#input" + idEquipamento).val();
                                                    var qtdEquipamentoSolicitada = $(".txt-quantidade-solicitada#input" + idEquipamento).val();
                                                    var dataInicioFormatadaCompleta = dataInicioEquipamento.substr(6, 4) + "-" + dataInicioEquipamento.substr(3, 2) + "-" + dataInicioEquipamento.substr(0, 2) + " " + horaInicioEquipamento;
                                                    var dataFimFormatadaCompleta = dataFimEquipamento.substr(6, 4) + "-" + dataFimEquipamento.substr(3, 2) + "-" + dataFimEquipamento.substr(0, 2) + " " + horaFimEquipamento;
                                                    insertInTabelEventEquipamentUsed(valorIdEvento, idEquipamento, qtdEquipamentoSolicitada, dataInicioFormatadaCompleta, dataFimFormatadaCompleta);
                                                });
                                                start = null;
                                                end = null;
                                                $("#modalAdicionarEventoClickDay").modal('close');
                                                location.reload();
                                            }
                                        }
                                    }

                                } else {
                                    $("#modalDatasIguais").modal();
                                    $("#modalDatasIguais").modal('open');
                                }

                            } else {
                                $("#modalCheckNulo").modal();
                                $("#modalCheckNulo").modal('open');
                            }
//                            $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
                        } else {
                            $("#modalCamposNulos").modal();
                            $("#modalCamposNulos").modal("open");
                        }
                    });
                    $(".buttonCancel").click(function () {
                        $("#modalAdicionarEventoClickDay").modal('close');
                        start = null;
                        end = null;
                    });
                    $('#calendar').fullCalendar('unselect');
                }
            },
            allDayText: 'Dia Inteiro',
            allDaySlot: false,
            minTime: '07:00:00',
            maxTime: '20:30:00',
            slotDuration: '00:30:00',
            slotLabelInterval: 30,
            slotLabelFormat: 'HH:mm',
            slotMinutes: 30,
            events: function (start, end, timezone, callback) {
                $.ajax({
                    url: controllerToAdmin,
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
                                    end: dados[i].dataFimEvento,
                                    imageurl: '../public/img/update.png'
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
                    url: controllerToAdmin,
                    type: 'POST',
                    data: {
                        action: "EventoLogica.getEventById",
                        idEvento: event.id
                    }, success: function (data, textStatus, jqXHR) {
                        $("#modalUpdateEvent").modal();
                        $("#modalUpdateEvent").modal('open');
                        $("#contentUpdateEvent").html(data);
                        $('.tabs#tabs-bosta').tabs();
                        pickDataInicio();
                        pickDataFim();
                        pickHoraInicio();
                        pickHoraFim();
                        getSetor();
                        getBlocoBySetorModalUpdate();
                        getAmbienteByBlocoModalUpdate();
                        updateEventById(event.id);
                    }
                });
                $('#calendar').fullCalendar('updateEvent', event);
            },
            eventRender: function (event, eventElement, element) {
                if (event.imageurl) {
                    eventElement.find("div.fc-content").prepend("<img src='" + event.imageurl + "' class='eventImg'>");
                }
            },
            defaultView: "agendaWeek"
        });
        $(".fc-axis.fc-widget-header").append("<a href='#'>IFCE</a>");
    }

    $(".openModalAdicionarEvento").click(function () {
        $("#formDataInicio").removeAttr("disabled");
        $("#formDataFim").removeAttr("disabled");
        $("#formHoraInicio").removeAttr("disabled");
        $("#formHoraFim").removeAttr("disabled");
        $(".mostrarWhenClickBtn").removeClass("cadastroClickBtn");
        $("#modalAdicionarEventoClickDay").modal({
            complete: function () {
                $('#form_add_event').each(function () {
                    this.reset();
                });
            }
        });
        $("#modalAdicionarEventoClickDay").modal('open');
        $(".divAula").removeClass('esconderDivAula');
        isNumeric();
        pickDataInicio();
        pickDataFim();
        pickHoraInicio();
        pickHoraFim();
        habilitarInputsEquipamentos();
        habilitarInputsServicos();
        habilitarInputsRefeicoes();
        verifyCheck();
        verifyCheckServices();
        verifyCheckRefeicoes();
        verifyCampos();
    });

    function pickDataInicio() {
        $('.dataInicio').pickadate({
            selectMonths: true,
            selectYears: 15,
            labelMonthNext: 'Próximo Mês',
            labelMonthPrev: 'Mês Anterior',
            labelMonthSelect: 'Selecione o Mês',
            labelYearSelect: 'Selecione o Ano',
            monthsFull: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            weekdaysFull: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
            weekdaysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
            weekdaysLetter: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
            today: 'Hoje',
            clear: 'Limpar',
            close: 'Confirmar',
            format: 'dd/mm/yyyy',
            formatSubmit: 'yyyy-mm-dd',
            min: hoje,
            onClose: function () {
                $(document.activeElement).blur();
            }
        });
    }

    function pickDataFim() {
        $('.dataFim').pickadate({
            selectMonths: true,
            selectYears: 15,
            labelMonthNext: 'Próximo Mês',
            labelMonthPrev: 'Mês Anterior',
            labelMonthSelect: 'Selecione o Mês',
            labelYearSelect: 'Selecione o Ano',
            monthsFull: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            weekdaysFull: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
            weekdaysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
            weekdaysLetter: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
            today: 'Hoje',
            clear: 'Limpar',
            close: 'Confirmar',
            format: 'dd/mm/yyyy',
            formatSubmit: 'yyyy-mm-dd',
            min: hoje,
            onClose: function () {
                $(document.activeElement).blur();
            }
        });
    }

    function pickHoraInicio() {
        $('.horaInicio').pickatime({
            default: 'now', horaAtual,
            fromnow: 0,
            twelvehour: false,
            donetext: 'OK',
            cleartext: 'Clear',
            canceltext: 'Cancel',
            autoclose: false,
            ampmclickable: true,
            aftershow: function () {}
        });
    }

    function pickHoraFim() {
        $('.horaFim').pickatime({
            default: 'now', horaAtual,
            fromnow: 0,
            twelvehour: false,
            donetext: 'OK',
            cleartext: 'Clear',
            canceltext: 'Cancel',
            autoclose: false,
            ampmclickable: true,
            aftershow: function () {}
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
                                            var valorCheck = $("#input1").val();
                                            var dataInicioEquipamento = $(".txt-data-inicial#input" + valorCheck).val();
                                            var horaInicioEquipamento = $(".txt-hora-inicial#input" + valorCheck).val();
                                            var dataFimEquipamento = $(".txt-data-final#input" + valorCheck).val();
                                            var horaFimEquipamento = $(".txt-hora-final#input" + valorCheck).val();
                                            var qtdEquipamentoSolicitada = $(".txt-quantidade-solicitada#input" + valorCheck).val();
                                            var dataInicioFormatadaCompleta = dataInicioEquipamento.substr(6, 4) + "-" + dataInicioEquipamento.substr(3, 2) + "-" + dataInicioEquipamento.substr(0, 2) + " " + horaInicioEquipamento;
                                            var dataFimFormatadaCompleta = dataFimEquipamento.substr(6, 4) + "-" + dataFimEquipamento.substr(3, 2) + "-" + dataFimEquipamento.substr(0, 2) + " " + horaFimEquipamento;
                                            insertInTabelEventEquipamentUsed(valorIdEvento, valorCheck, "-", dataInicioFormatadaCompleta, dataFimFormatadaCompleta);
                                            if (idAula == 1) {
                                                insertIntoTableAulaDetalhes(valorIdEvento, idAula, nomeProfessor);
                                            }
                                            $("#modalAdicionarEventoClickDay").modal('close');
                                        }
                                    } else {
                                        var errorCampoNulo = 0;
                                        $(".getInformationsEquipaments").each(function () {
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
                                                $(".idEquipamento:checked").each(function () {
                                                    var idEquipamento = $(this).val();
                                                    var dataInicioEquipamento = $(".txt-data-inicial#input" + idEquipamento).val();
                                                    var horaInicioEquipamento = $(".txt-hora-inicial#input" + idEquipamento).val();
                                                    var dataFimEquipamento = $(".txt-data-final#input" + idEquipamento).val();
                                                    var horaFimEquipamento = $(".txt-hora-final#input" + idEquipamento).val();
                                                    var qtdEquipamentoSolicitada = $(".txt-quantidade-solicitada#input" + idEquipamento).val();
                                                    var dataInicioFormatadaCompleta = dataInicioEquipamento.substr(6, 4) + "-" + dataInicioEquipamento.substr(3, 2) + "-" + dataInicioEquipamento.substr(0, 2) + " " + horaInicioEquipamento;
                                                    var dataFimFormatadaCompleta = dataFimEquipamento.substr(6, 4) + "-" + dataFimEquipamento.substr(3, 2) + "-" + dataFimEquipamento.substr(0, 2) + " " + horaFimEquipamento;
                                                    insertInTabelEventEquipamentUsed(valorIdEvento, idEquipamento, qtdEquipamentoSolicitada, dataInicioFormatadaCompleta, dataFimFormatadaCompleta);
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
            } else {
                $("#modalCamposNulos").modal();
                $("#modalCamposNulos").modal("open");
            }

        });
        $(".buttonCancel").click(function () {
            $("#modalAdicionarEventoClickDay").modal('close');
        });
    }

    function getSetor() {
        $.ajax({
            url: controllerToAdmin,
            type: "POST",
            data: {
                action: "SetorLogica.getSetor"
            },
            success: function (data) {
                $("#sel-tipo-evento").html(data);
                $("#sel-tipo-evento-pesquisa").html(data);
                $("#sel-tipo-evento-update").html(data);
                $("select").material_select();
            }
        });
    }

    function getBlocoBySetor() {
        $(".sel-tipo-evento").change(function () {
            $("#sel-ambiente").empty();
            $("#sel-ambiente").append('<option value="" disabled selected>Escolha sua opção</option>');
            $("#sel-ambiente").material_select();
            var valorTipoEvento = $(this).val();
            $.ajax({
                url: controllerToAdmin,
                type: "POST",
                data: {
                    action: "BlocoLogica.getBlocoBySetor",
                    valorTipoEvento: valorTipoEvento
                },
                success: function (data) {
                    $("#sel-bloco").empty();
                    $("#sel-bloco").append(data);
                    $("#sel-bloco").material_select();
                }
            });
        });

        $(".sel-tipo-evento-pesquisa").change(function () {
            $("#sel-ambiente-pesquisa").empty();
            $("#sel-ambiente-pesquisa").append('<option value="" disabled selected>Escolha sua opção</option>');
            $("#sel-ambiente-pesquisa").material_select();
            var valorTipoEvento = $(this).val();
            $.ajax({
                url: controllerToAdmin,
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

    function getAmbienteByBloco() {
        $(".sel-bloco").change(function () {
            var valorBloco = $(this).val();
            $.ajax({
                url: controllerToAdmin,
                type: "POST",
                data: {
                    action: "AmbienteLogica.getAmbienteByBloco",
                    valorBloco: valorBloco
                },
                success: function (data) {
                    $("#sel-ambiente").empty();
                    $("#sel-ambiente").append(data);
                    $("#sel-ambiente").material_select();
                    $(".divSelAmbiente").show();
                }
            });
        });
        $(".sel-bloco-pesquisa").change(function () {
            var valorBloco = $(this).val();
            $.ajax({
                url: controllerToAdmin,
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

    function getBlocoBySetorModalUpdate() {
        $(".sel-tipo-evento-update").change(function () {
            $("#sel-ambiente-update").empty();
            $("#sel-ambiente-update").append('<option value="" disabled selected>Escolha sua opção</option>');
            $("#sel-ambiente-update").material_select();
            var valorTipoEvento = $(this).val();
            $.ajax({
                url: controllerToAdmin,
                type: "POST",
                data: {
                    action: "BlocoLogica.getBlocoBySetor",
                    valorTipoEvento: valorTipoEvento
                },
                success: function (data) {
                    $("#sel-bloco-update").empty();
                    $("#sel-bloco-update").append(data);
                    $("#sel-bloco-update").material_select();
                }
            });
        });

    }

    function getAmbienteByBlocoModalUpdate() {
        $(".sel-bloco-update").change(function () {
            var valorBloco = $(this).val();
            $.ajax({
                url: controllerToAdmin,
                type: "POST",
                data: {
                    action: "AmbienteLogica.getAmbienteByBloco",
                    valorBloco: valorBloco
                },
                success: function (data) {
                    $("#sel-ambiente-update").empty();
                    $("#sel-ambiente-update").append(data);
                    $("#sel-ambiente-update").material_select();
                }
            });
        });
    }

    $(".sel-ambiente-pesquisa").change(function () {
        var idAmbiente = $("#sel-ambiente-pesquisa").val();
        var idBloco = $("#sel-bloco-pesquisa").val();
        var idSetor = $("#sel-tipo-evento-pesquisa").val();
        calendarAdmin(idAmbiente, idBloco, idSetor);
    });

    function insertEventoSelecionado(nomeEvento, solicitanteEvento, tipoEvento, blocoEvento, ambienteEvento, eventoTipoRepeticao, idAula, title, start, end) {
        var boolean;
        $.ajax({
            type: "POST",
            url: controllerToAdmin,
            async: false,
            data: {
                action: "EventoLogica.insertEventoSelecionado",
                nomeEvento: nomeEvento,
                solicitanteEvento: solicitanteEvento,
                ambienteEvento: ambienteEvento,
                descricaoEvento: title,
                eventoTipoRepeticao: eventoTipoRepeticao,
                idAula: idAula,
                dataInicioEvento: start,
                dataFimEvento: end
            }, success: function (data, textStatus, jqXHR) {
                boolean = true;
            }
        });
        return boolean;
    }

    function insertIntoTableAulaDetalhes(valorIdEvento, idAula, nomeProfessor) {
        $.ajax({
            url: controllerToAdmin,
            type: 'POST',
            data: {
                action: 'EventoLogica.insertIntoTableAulaDetalhes',
                valorIdEvento: valorIdEvento,
                idAula: idAula,
                nomeProfessor: nomeProfessor
            }, success: function (data, textStatus, jqXHR) {
//                console.log("Insert deu certo na tabela aulaDetails");
            }
        });
    }

    function getEventByAmbienteAndStartAndEnd(ambienteEvento, start, end) {
        var eventoId;
        $.ajax({
            url: controllerToAdmin,
            type: 'POST',
            async: false,
            data: {
                action: 'EventoLogica.getEventByAmbienteAndStartAndEnd',
                ambienteEvento: ambienteEvento,
                start: start,
                end: end
            }, success: function (data, textStatus, jqXHR) {
                dados = $.parseJSON(data);
                for (var i = 0; i < dados.length; i++) {
                    eventoId = dados[i].idEvento;
                }
            }
        });
        return eventoId;
    }

    function updateEventById(idEvento) {
        $(".buttonUpdate").click(function () {
            var nomeEvento = $("#modalUpdateEvent .nomeEvento").val();
            var solicitante = $("#modalUpdateEvent .solicitante").val();
            var descricaoEvento = $("#modalUpdateEvent .descricaoEvento").val();
            var tipoEvento = $("#sel-tipo-evento-update").val();
            var blocoEvento = $("#sel-bloco-update").val();
            var ambienteEvento = $("#sel-ambiente-update").val();
            var dataInicioEvento = $("#modalUpdateEvent .dataInicio").val();
            var dataInicioFormatada = dataInicioEvento.substr(6, 4) + "-" + dataInicioEvento.substr(3, 2) + "-" + dataInicioEvento.substr(0, 2);
            var horaInicioEvento = $("#modalUpdateEvent .horaInicio").val();
            var dataFimEvento = $("#modalUpdateEvent .dataFim").val();
            var dataFimFormatada = dataFimEvento.substr(6, 4) + "-" + dataFimEvento.substr(3, 2) + "-" + dataFimEvento.substr(0, 2);
            var horaFimEvento = $("#modalUpdateEvent .horaFim").val();
            var dataInicioUtilizada = dataInicioFormatada + " " + horaInicioEvento;
            var dataFimUtilizada = dataFimFormatada + " " + horaFimEvento;
            if (nomeEvento == "" || solicitante == "" || descricaoEvento == "" || dataInicioUtilizada == "" || dataFimUtilizada == "" || tipoEvento == null || blocoEvento == null || ambienteEvento == null) {
                $("#modalCamposNulos").modal();
                $("#modalCamposNulos").modal('open');
            } else {
                if (dataInicioUtilizada > dataFimUtilizada) {
                    $("#modalDataInicioMaiorQueFinal").modal();
                    $("#modalDataInicioMaiorQueFinal").modal('open');
                } else {
                    var valorBoolean = verifyDatesToUpdate(dataInicioUtilizada, dataFimUtilizada, ambienteEvento, idEvento);
                    if (valorBoolean == true) {
                        $.ajax({
                            url: controllerToAdmin,
                            type: 'POST',
                            async: false,
                            data: {
                                action: "EventoLogica.updateEventById",
                                idEvento: idEvento,
                                nomeEvento: nomeEvento,
                                solicitante: solicitante,
                                descricaoEvento: descricaoEvento,
                                tipoEvento: tipoEvento,
                                blocoEvento: blocoEvento,
                                ambienteEvento: ambienteEvento,
                                dataInicio: dataInicioUtilizada,
                                dataFim: dataFimUtilizada
                            }, success: function (data, textStatus, jqXHR) {
                                location.reload();
                            }
                        });
                    } else {
                        $("#modalDatasIguais").modal();
                        $("#modalDatasIguais").modal('open');
                    }
                }
            }
        });
        $(".buttonCancel").click(function () {
            $("#modalUpdateEvent").modal('close');
        });
    }

    function verifyDates(dataInicioUtilizada, dataFimUtilizada, ambienteEvento) {
        var boolean;
        $.ajax({
            url: controllerToAdmin,
            type: 'POST',
            async: false,
            data: {
                action: "EventoLogica.verifyDates",
                dataInicio: dataInicioUtilizada,
                dataFim: dataFimUtilizada,
                ambienteEvento: ambienteEvento
            }, success: function (data, textStatus, jqXHR) {
                dados = $.parseJSON(data);
                if (dados.length == 0) {
                    boolean = true;
                } else {
                    boolean = false;
                }
            }
        });
        return boolean;
    }

    function verifyDatesToUpdate(dataInicioUtilizada, dataFimUtilizada, ambienteEvento, idEvento) {
        var boolean;
        alert(dataInicioUtilizada + " " + dataFimUtilizada);
        $.ajax({
            url: controllerToAdmin,
            type: 'POST',
            async: false,
            data: {
                action: "EventoLogica.verifyDates",
                dataInicio: dataInicioUtilizada,
                dataFim: dataFimUtilizada,
                ambienteEvento: ambienteEvento
            }, success: function (data, textStatus, jqXHR) {
                dados = $.parseJSON(data);
                if (dados.length == 0) {
                    boolean = true;
                } else {
                    var retorno = 0;
                    for (var i = 0; i < dados.length; i++) {
                        retorno = dados[i].idEvento;
                    }
                    if (retorno == idEvento) {
                        boolean = true;
                    } else {
                        boolean = false;
                    }
                }
            }
        });
        return boolean;
    }

    function getEquipamentos() {
        $.ajax({
            url: controllerToAdmin,
            type: 'POST',
            data: {
                action: 'EquipamentoLogica.getEquipamentos'
            }, success: function (data, textStatus, jqXHR) {
                $(".equipamento").html(data);
            }
        });
    }

    function getServicos() {
        $.ajax({
            url: controllerToAdmin,
            type: 'POST',
            data: {
                action: 'ServicoLogica.getServicos'
            }, success: function (data, textStatus, jqXHR) {
                $(".servicos").html(data);
            }
        });
    }

    function getRefeicoes() {
        $.ajax({
            url: controllerToAdmin,
            type: 'POST',
            data: {
                action: 'RefeicaoLogica.getRefeicoes'
            }, success: function (data, textStatus, jqXHR) {
                $(".refeicoes").html(data);
            }
        });
    }

    function getAula() {
        $.ajax({
            url: controllerToAdmin,
            type: 'POST',
            data: {
                action: 'AulaLogica.getAula'
            }, success: function (data, textStatus, jqXHR) {
                $("#sel-aula").append(data);
                $("#sel-aula").material_select();
            }
        });
    }

    function getTipoRepeticao() {
        $.ajax({
            url: controllerToAdmin,
            type: 'POST',
            data: {
                action: 'TipoRepeticaoLogica.getTipoRepeticao'
            }, success: function (data, textStatus, jqXHR) {
                $("#sel-tip-repeticao").append(data);
                $("#sel-tip-repeticao").material_select();
            }
        });
    }

    function isNumeric() {
        $(".txt-quantidade-solicitada").on("keypress keyup blur", function (event) {
            $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
    }

    function compararQtdSolicitadaComQtdDisponivel() {
        $(".txt-quantidade-solicitada").on("keyup", function () {
            var idEquipamento = $(this).attr('id');
            var qtdSolicitada = $(this).val();
            $.ajax({
                url: controllerToAdmin,
                type: 'POST',
                data: {
                    action: 'EquipamentoLogica.verifyQtdSolicitadaByIdEquipamento',
                    idEquipamento: idEquipamento

                }, success: function (data, textStatus, jqXHR) {
                    dados = $.parseJSON(data);
                    console.log("Id Equipamento : " + dados.idEquipamento);
                    if (qtdSolicitada <= dados.qtdDisponivel || dados.qtdDisponivel >= qtdSolicitada) {
                        console.log("Quantidade solicitada: " + qtdSolicitada);
                        console.log("Quantidade disponível do Equipamento: " + dados.qtdDisponivel);
                    } else {
                        $(".txt-quantidade-solicitada").val($(".txt-quantidade-solicitada").val().replace(/,/g, ""));
                    }
//                            updateQtdDisponivelByQtdSolicitada(valorDigitado, dados.idEquipamento, dados.qtdDisponivel);

                }
            });
        });

    }

//    function updateQtdDisponivelByQtdSolicitada(qtdSolicitada, idEquipamento, qtdDisponivel) {
//        var valorDisponivelAtual = qtdDisponivel - qtdSolicitada;
//        $.ajax({
//            url: controllerToAdmin,
//            type: 'POST',
//            data: {
//                action: 'EquipamentoLogica.updateQtdDisponivelByIdEquipamento',
//                idEquipamento: idEquipamento,
//                qtdDisponivelAtual: valorDisponivelAtual
//            }, success: function (data, textStatus, jqXHR) {
//                getEquipamentos();
//                $("#"+idEquipamento).val(qtdSolicitada);
//                $("#"+idEquipamento).removeAttr('disabled');
//                console.log("Deu certo");
//            }
//        });
//    }

    function habilitarInputsEquipamentos() {
        $(".idEquipamento").click(function () {
            var valor = $(this).val();
            if (valor == 1) {
                $(this).each(function () {
                    $('.tabelaEquipamentos input[type=text]').each(function () {
                        $(this).attr('disabled', 'disabled');
                        $(this).removeClass('getInformationsEquipaments');
                    });
                });
            } else {
                if ($(this).prop('checked')) {
                    $(this).each(function () {
                        var check = $(this).attr('id');
                        $('.tabelaEquipamentos input:disabled').each(function () {
                            var valorIdInput = $(this).attr('id');
                            if (check == valorIdInput) {
                                $(this).removeAttr('disabled');
                                $(this).addClass('getInformationsEquipaments');
                            }
                        });
                    });
                } else {
                    $(this).each(function () {
                        var check = $(this).attr('id');
                        $('.tabelaEquipamentos input:disabled').each(function () {
                            var valorIdInput = $(this).attr('id');
                            if (check == valorIdInput) {
                                $(this).attr('disabled', 'disabled');
                                $(this).removeClass('getInformationsEquipaments');
                            }
                        });
                    });

                }
            }
        });
    }

    function habilitarInputsServicos() {
        $(".idServico").click(function () {
            var valor = $(this).val();
            if (valor == 1) {
                $(this).each(function () {
                    $('.tabelaServicos input[type=text]').each(function () {
                        $(this).attr('disabled', 'disabled');
                        $(this).removeClass('getInformationsServices');
                    });
                });
            } else {
                if ($(this).prop('checked')) {
                    $(this).each(function () {
                        var check = $(this).attr('id');
                        $('.tabelaServicos input:disabled').each(function () {
                            var valorIdInput = $(this).attr('id');
                            if (check == valorIdInput) {
                                $(this).removeAttr('disabled');
                                $(this).addClass('getInformationsServices');
                            }
                        });
                    });
                } else {
                    $(this).each(function () {
                        var check = $(this).attr('id');
                        $('.tabelaServicos input:disabled').each(function () {
                            var valorIdInput = $(this).attr('id');
                            if (check == valorIdInput) {
                                $(this).attr('disabled', 'disabled');
                                $(this).removeClass('getInformationsServices');
                            }
                        });
                    });
                }
            }
        });
    }

    function habilitarInputsRefeicoes() {
        $(".idRefeicao").click(function () {
            var valor = $(this).val();
            if (valor == 1) {
                $(this).each(function () {
                    $('.tabelaRefeicoes input[type=text]').each(function () {
                        $(this).attr('disabled', 'disabled');
                        $(this).removeClass('getInformationsRefeicoes');
                    });
                });
            } else {
                if ($(this).prop('checked')) {
                    $(this).each(function () {
                        var check = $(this).attr('id');
                        $('.tabelaRefeicoes input:disabled').each(function () {
                            var valorIdInput = $(this).attr('id');
                            if (check == valorIdInput) {
                                $(this).removeAttr('disabled');
                                $(this).addClass('getInformationsRefeicoes');
                            }
                        });
                    });
                } else {
                    $(this).each(function () {
                        var check = $(this).attr('id');
                        $('.tabelaRefeicoes input:disabled').each(function () {
                            var valorIdInput = $(this).attr('id');
                            if (check == valorIdInput) {
                                $(this).attr('disabled', 'disabled');
                                $(this).removeClass('getInformationsRefeicoes');
                            }
                        });
                    });
                }
            }
        });
    }

    function verifyCheck() {
        $(".idEquipamento").click(function () {
            var valorClicado = $(this).attr('id');
            if (valorClicado == "input1") {
                $(".tabelaEquipamentos input:checked").each(function () {
                    $(this).prop("checked", false);
                });
                $(".tabelaEquipamentos #" + valorClicado).prop("checked", true);
            } else {
                $(".tabelaEquipamentos #input1").prop("checked", false);
                if ($(".tabelaEquipamentos #" + valorClicado).is(":checked")) {

                } else {
                    $(this).prop("checked", false);
                    $('.tabelaEquipamentos input[type=text]:enabled').each(function () {
                        var valorIdInput = $(this).attr('id');
                        if (valorClicado == valorIdInput) {
                            $(this).attr('disabled', 'disabled');
                            $(this).removeClass('getInformationsEquipaments');
                        }
                    });
                }
            }
        });
    }

    function verifyCheckServices() {
        $(".idServico").click(function () {
            var valorClicado = $(this).attr('id');
            if (valorClicado == "inputSer1") {
                $(".tabelaServicos input:checked").each(function () {
                    $(this).prop("checked", false);
                });
                $(".tabelaServicos #" + valorClicado).prop("checked", true);
            } else {
                $(".tabelaServicos #inputSer1").prop("checked", false);
                if ($(".tabelaServicos #" + valorClicado).is(":checked")) {
                } else {
                    $(this).prop("checked", false);
                    $('.tabelaServicos input[type=text]:enabled').each(function () {
                        var valorIdInput = $(this).attr('id');
                        if (valorClicado == valorIdInput) {
                            $(this).attr('disabled', 'disabled');
                            $(this).removeClass('getInformationsServices');
                        }
                    });
                }
            }
        });
    }

    function verifyCheckRefeicoes() {
        $(".idRefeicao").click(function () {
            var valorClicado = $(this).attr('id');
            if (valorClicado == "inputRef1") {
                $(".tabelaRefeicoes input:checked").each(function () {
                    $(this).prop("checked", false);
                });
                $(".tabelaRefeicoes #" + valorClicado).prop("checked", true);
            } else {
                $(".tabelaRefeicoes #inputRef1").prop("checked", false);
                if ($(".tabelaRefeicoes #" + valorClicado).is(":checked")) {
                } else {
                    $(this).prop("checked", false);
                    $('.tabelaRefeicoes input[type=text]:enabled').each(function () {
                        var valorIdInput = $(this).attr('id');
                        if (valorClicado == valorIdInput) {
                            $(this).attr('disabled', 'disabled');
                            $(this).removeClass('getInformationsRefeicoes');
                        }
                    });
                }
            }
        });
    }

    function insertInTabelEventEquipamentUsed(valorIdEvento, idEquipamento, qtdEquipamento, dataInicio, dataFim) {
        $.ajax({
            url: controllerToAdmin,
            type: 'POST',
            data: {
                action: 'EventoLogica.insertInTabelEventEquipamentUsed',
                valorIdEvento: valorIdEvento,
                idEquipamento: idEquipamento,
                qtdEquipamento: qtdEquipamento,
                dataInicio: dataInicio,
                dataFim: dataFim
            }, success: function (data, textStatus, jqXHR) {
//                console.log("Acessou a função");
            }
        });
    }
    $('#tabs-swipe-demo.tabs').tabs();
    getSetor();
    calendarAdmin(1, 1, 1);
    pickDataInicio();
    pickDataFim();
    pickHoraInicio();
    pickHoraFim();
    getBlocoBySetor();
    getAmbienteByBloco();
    getEquipamentos();
    getServicos();
    getRefeicoes();
    getAula();
    getTipoRepeticao();
});