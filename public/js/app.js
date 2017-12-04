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
        $("#readyCalendar").fullCalendar('destroy');
        $('#calendar').fullCalendar({
            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro',
                'Outubro', 'Novembro', 'Dezembro'],
            monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Aug', 'Set', 'Out', 'Nov', 'Dez'],
            dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
            dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
            lang: 'pt-br',
            locale: 'pt-br',
            timeFormat: 'HH:mm',
            height: 700,
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
                    var idSetor = $("#sel-tipo-evento-pesquisa").val();
                    var idBloco = $("#sel-bloco-pesquisa").val();
                    var nameBloco = $("#sel-bloco-pesquisa").find('option:selected').text();
                    var idAmbiente = $("#sel-ambiente-pesquisa").val();
                    var nameAmbiente = $("#sel-ambiente-pesquisa").find('option:selected').text();
                    $('#sel-tipo-evento').find('option[value="' + idSetor + '"]').prop('selected', true);
                    $("#sel-tipo-evento").material_select();
                    $("#sel-bloco").append("<option selected value=" + idBloco + ">" + nameBloco + "</option>");
                    $("#sel-bloco").material_select();
                    $("#sel-ambiente").append("<option selected value=" + idAmbiente + ">" + nameAmbiente + "</option>");
                    $("#sel-ambiente").material_select();
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
                            if ($(".idEquipamento").is(":checked") && ($(".idServico").is(":checked")) && ($(".idRefeicao").is(":checked"))) {
                                eventData = {
                                    title: title,
                                    start: start,
                                    end: end
                                };
                                var valorBoolean = verifyDates(start, end, ambienteEvento);
                                if (valorBoolean == true) {
                                    var verifyEquipaments = 0;
                                    $(".getInformationsEquipaments").each(function () {
                                        var qtdEquipamento = $(this).val();
                                        if (qtdEquipamento == "") {
                                            verifyEquipaments++;
                                        }
                                    });
                                    var verifyServices = 0;
                                    $(".getInformationsServices").each(function () {
                                        var qtdServicos = $(this).val();
                                        if (qtdServicos == "") {
                                            verifyServices++;
                                        }
                                    });
                                    var verifyRefeicoes = 0;
                                    $(".getInformationsRefeicoes").each(function () {
                                        var qtdRefeicoes = $(this).val();
                                        if (qtdRefeicoes == "") {
                                            verifyRefeicoes++;
                                        }
                                    });

                                    if ((verifyEquipaments != 0) || (verifyServices != 0) || (verifyRefeicoes != 0)) {
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
//                                                mailToAdminEquipament();
                                            });
                                            $(".idServico:checked").each(function () {
                                                var idServico = $(this).val();
                                                var dataInicioServico = $(".txt-data-inicial-servico#inputSer" + idServico).val();
                                                var horaInicioServico = $(".txt-hora-inicial-servico#inputSer" + idServico).val();
                                                var dataFimServico = $(".txt-data-final-servico#inputSer" + idServico).val();
                                                var horaFimServico = $(".txt-hora-final-servico#inputSer" + idServico).val();
                                                var dataInicioFormatadaCompleta = dataInicioServico.substr(6, 4) + "-" + dataInicioServico.substr(3, 2) + "-" + dataInicioServico.substr(0, 2) + " " + horaInicioServico;
                                                var dataFimFormatadaCompleta = dataFimServico.substr(6, 4) + "-" + dataFimServico.substr(3, 2) + "-" + dataFimServico.substr(0, 2) + " " + horaFimServico;
                                                insertInTabelEventServiceUsed(valorIdEvento, idServico, dataInicioFormatadaCompleta, dataFimFormatadaCompleta);
                                            });
                                            $(".idRefeicao:checked").each(function () {
                                                var idRefeicao = $(this).val();
                                                var dataInicioRefeicao = $(".txt-data-inicial-refeicao#inputRef" + idRefeicao).val();
                                                var horaInicioRefeicao = $(".txt-hora-inicial-refeicao#inputRef" + idRefeicao).val();
                                                var dataFimRefeicao = $(".txt-data-final-refeicao#inputRef" + idRefeicao).val();
                                                var horaFimRefeicao = $(".txt-hora-final-refeicao#inputRef" + idRefeicao).val();
                                                var qtdRefeicaoSolicitada = $(".txt-quantidade-solicitada-refeicao#inputRef" + idRefeicao).val();
                                                var dataInicioFormatadaCompleta = dataInicioRefeicao.substr(6, 4) + "-" + dataInicioRefeicao.substr(3, 2) + "-" + dataInicioRefeicao.substr(0, 2) + " " + horaInicioRefeicao;
                                                var dataFimFormatadaCompleta = dataFimRefeicao.substr(6, 4) + "-" + dataFimRefeicao.substr(3, 2) + "-" + dataFimRefeicao.substr(0, 2) + " " + horaFimRefeicao;
                                                insertInTabelEventRefeicaoUsed(valorIdEvento, idRefeicao, qtdRefeicaoSolicitada, dataInicioFormatadaCompleta, dataFimFormatadaCompleta);
                                            });
                                            start = null;
                                            end = null;
                                            $("#modalAdicionarEventoClickDay").modal('close');
                                            location.reload();
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

    function loadCalendarDaysOfWeek() {
        $("#calendarDayOfWeek").fullCalendar({
            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro',
                'Outubro', 'Novembro', 'Dezembro'],
            monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Aug', 'Set', 'Out', 'Nov', 'Dez'],
            dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
            dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
            lang: 'pt-br',
            locale: 'pt-br',
            timeFormat: 'HH:mm',
            height: 700,
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
                right: 'agendaWeek,agendaDay'
            },
            navLinks: true,
            selectable: true,
            selectHelper: true,
            editable: false,
            eventLimit: true,
            dayClick: function (date, jsEvent, view) {
                console.log("Clicou no dia: " + date.format());
            },
            select: function (start, end) {
                $("#calendarDayOfWeek").fullCalendar('addEventSource', [{
                        start: start,
                        end: end,
                        rendering: 'background',
                        block: true
                    }, ]);
                $("#calendarDayOfWeek").fullCalendar("unselect");
            },
            selectOverlap: function (event) {
                
                return !event.block;
            },
            allDaySlot: false,
            minTime: '07:00:00',
            maxTime: '20:30:00',
            slotDuration: '00:30:00',
            slotLabelInterval: 30,
            slotLabelFormat: 'HH:mm',
            slotMinutes: 30,
            defaultView: "agendaWeek"
        });
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

    $("input[name=dataInicio]").change(function () {
        var valorDataInicio = $(this).val();
        $(".txt-data-inicial").val(valorDataInicio);
        $(".txt-data-inicial-servico").val(valorDataInicio);
        $(".txt-data-inicial-refeicao").val(valorDataInicio);
    });

    $("input[name=horaInicio]").change(function () {
        var valorHoraInicio = $(this).val();
        $(".txt-hora-inicial").val(valorHoraInicio);
        $(".txt-hora-inicial-servico").val(valorHoraInicio);
        $(".txt-hora-inicial-refeicao").val(valorHoraInicio);
    });

    $("input[name=dataFim]").change(function () {
        var valorDataFim = $(this).val();
        $(".txt-data-final").val(valorDataFim);
        $(".txt-data-final-servico").val(valorDataFim);
        $(".txt-data-final-refeicao").val(valorDataFim);
    });

    $("input[name=horaFim]").change(function () {
        var valorHoraFim = $(this).val();
        $(".txt-hora-final").val(valorHoraFim);
        $(".txt-hora-final-servico").val(valorHoraFim);
        $(".txt-hora-final-refeicao").val(valorHoraFim);
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
            var idAula = $("#sel-aula").val();
            var tipoRepeticao = $("#sel-tip-repeticao").val();
            var descricaoEvento = $(".descricaoEvento").val();
            var dataInicio = $(".dataInicio").val();
            var horaInicio = $(".horaInicio").val();
            var dataFim = $(".dataFim").val();
            var horaFim = $(".horaFim").val();
            var contadorInput = 0;
            var contadorSelect = 0;
            $("#form_add_event input[type=text]:enabled").each(function () {
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
                        if ($(".idEquipamento").is(":checked") && ($(".idServico").is(":checked")) && ($(".idRefeicao").is(":checked"))) {
                            if (valorBoolean == true) {
                                var nomeProfessor = $(".nomeProfessor").val();
                                if ((idAula == 1) && (nomeProfessor == "")) {
                                    $("#modalCamposNulos").modal();
                                    $("#modalCamposNulos").modal('open');
                                } else {
                                    var verifyEquipaments = 0;
                                    $(".getInformationsEquipaments").each(function () {
                                        var qtdEquipamento = $(this).val();
                                        if (qtdEquipamento == "") {
                                            verifyEquipaments++;
                                        }
                                    });
                                    var verifyServices = 0;
                                    $(".getInformationsServices").each(function () {
                                        var qtdServicos = $(this).val();
                                        if (qtdServicos == "") {
                                            verifyServices++;
                                        }
                                    });
                                    var verifyRefeicoes = 0;
                                    $(".getInformationsRefeicoes").each(function () {
                                        var qtdRefeicoes = $(this).val();
                                        if (qtdRefeicoes == "") {
                                            verifyRefeicoes++;
                                        }
                                    });

                                    if ((verifyEquipaments != 0) || (verifyServices != 0) || (verifyRefeicoes != 0)) {
                                        $("#modalCamposNulos").modal();
                                        $("#modalCamposNulos").modal('open');
                                    } else {
                                        if (insertEventoSelecionado(nomeEvento, solicitanteEvento, tipoEvento, blocoEvento, ambienteEvento, tipoRepeticao, idAula, descricaoEvento, inicio, fim) == true) {
                                            var valorIdEvento = getEventByAmbienteAndStartAndEnd(ambienteEvento, inicio, fim);
                                            if (idAula == 1) {
                                                insertIntoTableAulaDetalhes(valorIdEvento, idAula, nomeProfessor);
                                            }
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
//                                                mailToAdminEquipament();
                                            });
                                            $(".idServico:checked").each(function () {
                                                var idServico = $(this).val();
                                                var dataInicioServico = $(".txt-data-inicial-servico#inputSer" + idServico).val();
                                                var horaInicioServico = $(".txt-hora-inicial-servico#inputSer" + idServico).val();
                                                var dataFimServico = $(".txt-data-final-servico#inputSer" + idServico).val();
                                                var horaFimServico = $(".txt-hora-final-servico#inputSer" + idServico).val();
                                                var dataInicioFormatadaCompleta = dataInicioServico.substr(6, 4) + "-" + dataInicioServico.substr(3, 2) + "-" + dataInicioServico.substr(0, 2) + " " + horaInicioServico;
                                                var dataFimFormatadaCompleta = dataFimServico.substr(6, 4) + "-" + dataFimServico.substr(3, 2) + "-" + dataFimServico.substr(0, 2) + " " + horaFimServico;
                                                insertInTabelEventServiceUsed(valorIdEvento, idServico, dataInicioFormatadaCompleta, dataFimFormatadaCompleta);
                                            });
                                            $(".idRefeicao:checked").each(function () {
                                                var idRefeicao = $(this).val();
                                                var dataInicioRefeicao = $(".txt-data-inicial-refeicao#inputRef" + idRefeicao).val();
                                                var horaInicioRefeicao = $(".txt-hora-inicial-refeicao#inputRef" + idRefeicao).val();
                                                var dataFimRefeicao = $(".txt-data-final-refeicao#inputRef" + idRefeicao).val();
                                                var horaFimRefeicao = $(".txt-hora-final-refeicao#inputRef" + idRefeicao).val();
                                                var qtdRefeicaoSolicitada = $(".txt-quantidade-solicitada-refeicao#inputRef" + idRefeicao).val();
                                                var dataInicioFormatadaCompleta = dataInicioRefeicao.substr(6, 4) + "-" + dataInicioRefeicao.substr(3, 2) + "-" + dataInicioRefeicao.substr(0, 2) + " " + horaInicioRefeicao;
                                                var dataFimFormatadaCompleta = dataFimRefeicao.substr(6, 4) + "-" + dataFimRefeicao.substr(3, 2) + "-" + dataFimRefeicao.substr(0, 2) + " " + horaFimRefeicao;
                                                insertInTabelEventRefeicaoUsed(valorIdEvento, idRefeicao, qtdRefeicaoSolicitada, dataInicioFormatadaCompleta, dataFimFormatadaCompleta);
                                            });
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
        $(".sel-tipo-evento").on("change selected", function () {
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

    $(".sel-tip-repeticao").change(function () {
        var idRepeticao = $(this).val();
        if (idRepeticao == 2 || idRepeticao == 3) {
            loadCalendarDaysOfWeek();
        } else {
            $("#calendarDayOfWeek").fullCalendar("destroy");
        }
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

        });
    }

    function habilitarInputsServicos() {
        $(".idServico").click(function () {
            var valor = $(this).val();
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

        });
    }

    function habilitarInputsRefeicoes() {
        $(".idRefeicao").click(function () {
            var valor = $(this).val();
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

        });
    }

    function verifyCheck() {
        $(".idEquipamento").click(function () {
            var valorClicado = $(this).attr('id');
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

        });
    }

    function verifyCheckServices() {
        $(".idServico").click(function () {
            var valorClicado = $(this).attr('id');
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

        });
    }

    function verifyCheckRefeicoes() {
        $(".idRefeicao").click(function () {
            var valorClicado = $(this).attr('id');
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

    function insertInTabelEventServiceUsed(valorIdEvento, idServico, dataInicio, dataFim) {
        $.ajax({
            url: controllerToAdmin,
            type: 'POST',
            data: {
                action: 'EventoLogica.insertInTabelEventServiceUsed',
                valorIdEvento: valorIdEvento,
                idServico: idServico,
                dataInicio: dataInicio,
                dataFim: dataFim
            }, success: function (data, textStatus, jqXHR) {
//                console.log("Acessou a função");
            }
        });
    }

    function insertInTabelEventRefeicaoUsed(valorIdEvento, idRefeicao, qtdRefeicao, dataInicio, dataFim) {
        $.ajax({
            url: controllerToAdmin,
            type: 'POST',
            data: {
                action: 'EventoLogica.insertInTabelEventRefeicaoUsed',
                valorIdEvento: valorIdEvento,
                idRefeicao: idRefeicao,
                qtdRefeicao: qtdRefeicao,
                dataInicio: dataInicio,
                dataFim: dataFim
            }, success: function (data, textStatus, jqXHR) {
//                console.log("Acessou a função");
            }
        });
    }

    function mostrarInPage() {
        $('#readyCalendar').fullCalendar({
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

    $('#tabs-swipe-demo.tabs').tabs();
    getSetor();
    mostrarInPage();
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