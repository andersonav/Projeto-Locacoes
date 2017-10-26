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
    var controllerToUser = "app/controller/FrontController.php";
    var pagina = $("input[name=pagina]").val();
    var hoje = new Date();
    var hora = hoje.getHours();
    var minutos = hoje.getMinutes();
    var horaAtual = hora + ":" + minutos;
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
    function getColorEvento() {
        $.ajax({
            url: controllerToAdmin,
            type: "POST",
            data: {
                action: "CorEventoLogica.getColorEvento"
            },
            success: function (data) {
                $("#sel-color").html(data);
                $("#sel-color").material_select();
                $("#sel-color-update").html(data);
                $("#sel-color-update").material_select();
            }
        });
    }
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
            eventLimit: false,
            dayClick: function (date, jsEvent, view) {
                console.log("Clicou no dia: " + date.format());
            },
            select: function (start, end) {
                start = $.fullCalendar.formatDate(start, "YYYY-MM-DD HH:mm:ss");
                var ano = hoje.getFullYear();
                var mes = hoje.getMonth() + 1;
                var dia = hoje.getDate();
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
                    diaInicio = start.substr(8, 2);
                    mesInicio = start.substr(5, 2);
                    anoInicio = start.substr(0, 4);
                    horaInicio = start.substr(11, 8);
                    var inicio = diaInicio + "/" + mesInicio + "/" + anoInicio;
                    end = $.fullCalendar.formatDate(end, "YYYY-MM-DD HH:mm:ss");
                    diaFim = end.substr(8, 2);
                    mesFim = end.substr(5, 2);
                    anoFim = end.substr(0, 4);
                    horaFim = end.substr(11, 8);
                    var fim = diaFim + "/" + mesFim + "/" + anoFim;
                    $('#modalAdicionarEventoClickDay').modal();
                    $(".dataInicio").attr('disabled', 'disabled');
                    $(".dataFim").attr('disabled', 'disabled');
                    $(".horaInicio").attr('disabled', 'disabled');
                    $(".horaFim").attr('disabled', 'disabled');
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
                    var title;
                    $("#modalAdicionarEventoClickDay").modal('open');
                    $(".mostrarWhenClickBtn").addClass("cadastroClickBtn");
//            $(".calendar2").addClass("cadastroClickBtn");
                    var eventData;
                    $(".buttonOkay").click(function () {
                        var nomeEvento = $(".nomeEvento").val();
                        var solicitanteEvento = $(".solicitante").val();
                        var tipoEvento = $("#sel-tipo-evento").val();
                        var blocoEvento = $("#sel-bloco").val();
                        var ambienteEvento = $("#sel-ambiente").val();
                        var corEvento = $("#sel-color").val();
                        title = $(".descricaoEvento").val();
//                    console.log("Nome Evento " + nomeEvento + " Solicitante Evento : " + solicitanteEvento + " Tipo Evento " + tipoEvento + " Bloco Evento " + blocoEvento + " Ambiente Evento : " + ambienteEvento)
                        if (nomeEvento != "" || title != "" || solicitanteEvento != "" || tipoEvento != null || blocoEvento != null || ambienteEvento != null || corEvento != null) {
                            var descricaoCorIngles = getDescricaoCorEvento(corEvento);
                            eventData = {
                                title: title,
                                start: start,
                                end: end,
                                color: descricaoCorIngles
                            };
                            $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
//                        var teste = $(".active_repeat").attr("id");
                            insertEventoSelecionado(nomeEvento, solicitanteEvento, tipoEvento, blocoEvento, ambienteEvento, corEvento, title, start, end);
                            $(".repeatSwitch").removeClass(".active_repeat");
                            start = null;
                            end = null;
                            $("#modalAdicionarEventoClickDay").modal('close');
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
                                    title: dados[i].descricaoEvento,
                                    start: dados[i].dataInicioEvento,
                                    end: dados[i].dataFimEvento,
                                    color: dados[i].colorDescricaoEvento
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
                        getColorEvento();
                        getSetor();
                        getBlocoBySetorModalUpdate();
                        getAmbienteByBlocoModalUpdate();
                        updateEventById(event.id);
                    }
                });
//                event.title = "CLICKED!";
                //Abrir Modal e mostrar parâmetros pra pessoa digitar e atualizar o evento
                $('#calendar').fullCalendar('updateEvent', event);
            },
            eventRender: function (event, eventElement) {

            },
            defaultView: "agendaWeek"
        });
        $(".fc-axis.fc-widget-header").append("<a href='#'>IFCE</a>");
    }

    function calendarUser(idAmbiente, idBloco, idSetor) {
        $('#calendarUser').fullCalendar('destroy');
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
            eventLimit: false,
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
                                    title: dados[i].descricaoEvento,
                                    start: dados[i].dataInicioEvento,
                                    end: dados[i].dataFimEvento,
                                    color: dados[i].colorDescricaoEvento
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
                        $("select").material_select();
                    }
                });
//                event.title = "CLICKED!";
                //Abrir Modal e mostrar parâmetros pra pessoa digitar e atualizar o evento
//                $('#calendar').fullCalendar('updateEvent', event);
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
    $(".repeatSwitch").each(function () {
        $(this).on("click", function () {
            $(this).siblings().removeClass("active_repeat");
            $(this).addClass("active_repeat");
            console.log($(this).attr('id'));
        });
    });

    $("select[name=escolhaAula]").change(function () {
        var valorSelect = $(this).val();
        if (valorSelect == 2) {
            $(".DivInputProfessor").hide(1000);
        } else {
            $(".DivInputProfessor").show(1000);
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
        insertEvento();
    });

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
        if (pagina == "admin") {
            calendarAdmin(idAmbiente, idBloco, idSetor);
        } else {
            calendarUser(idAmbiente, idBloco, idSetor);
        }
    });
    function insertEventoSelecionado(nomeEvento, solicitanteEvento, tipoEvento, blocoEvento, ambienteEvento, corEvento, title, start, end) {
        $.ajax({
            type: "POST",
            url: controllerToAdmin,
            data: {
                action: "EventoLogica.insertEventoSelecionado",
                nomeEvento: nomeEvento,
                solicitanteEvento: solicitanteEvento,
                ambienteEvento: ambienteEvento,
                descricaoEvento: title,
                corEvento: corEvento,
                dataInicioEvento: start,
                dataFimEvento: end
            }, success: function (data, textStatus, jqXHR) {
                location.reload();
            }
        });
    }

    function updateEventById(idEvento) {
        $(".buttonUpdate").click(function () {
            var nomeEvento = $("#modalUpdateEvent .nomeEvento").val();
            var solicitante = $("#modalUpdateEvent .solicitante").val();
            var descricaoEvento = $("#modalUpdateEvent .descricaoEvento").val();
            var colorEvento = $("#sel-color-update").val();
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
            if (nomeEvento == "" || solicitante == "" || descricaoEvento == "" || dataInicioUtilizada == "" || dataFimUtilizada == "" || colorEvento == null || tipoEvento == null || blocoEvento == null || ambienteEvento == null) {
                $("#modalCamposNulos").modal();
                $("#modalCamposNulos").modal('open');
            } else {
                if (dataInicioUtilizada > dataFimUtilizada) {
                    $("#modalDataInicioMaiorQueFinal").modal();
                    $("#modalDataInicioMaiorQueFinal").modal('open');
                } else {
                    if (verifyDates(dataInicioUtilizada, dataFimUtilizada, ambienteEvento) == true) {
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
                                colorEvento: colorEvento,
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
        var boolean = true;
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
                console.log(dados.length);
                if (dados.length == 0) {
                    boolean = true;
                } else {
                    boolean = false;
                }
            }
        });
        return boolean;
    }

    function getDescricaoCorEvento(corEvento) {
        var descricao;
        $.ajax({
            url: controllerToAdmin,
            type: 'POST',
            async: false,
            data: {
                action: 'CorEventoLogica.getDescricaoCorEvento',
                corEvento: corEvento
            }, success: function (data, textStatus, jqXHR) {
                dados = $.parseJSON(data);
                for (var i = 0; i < dados.length; i++) {
                    descricao = dados[i].descricaoInglesColorEvento;
                }
            }
        });
        return descricao;
    }
    if (pagina == "admin") {
        $('#tabs-swipe-demo.tabs').tabs();
        $("#nao").addClass("active_repeat");
        getSetor();
        calendarAdmin(1, 1, 1);
        pickDataInicio();
        pickDataFim();
        pickHoraInicio();
        pickHoraFim();
        getBlocoBySetor();
        getAmbienteByBloco();
        getColorEvento();
    } else {
        getSetorPageUser();
        calendarUser(1, 1, 1);
        pickDataInicio();
        pickDataFim();
        pickHoraInicio();
        pickHoraFim();
        getBlocoBySetorPageUser();
        getAmbienteByBlocoPageUser();
    }
});