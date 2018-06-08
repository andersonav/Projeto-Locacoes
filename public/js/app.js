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
    var idEventWeekOrHalfYear = 1;
    var arrayValoresCompletos = [];
    var valorIdEvento = [];
    var inputs = $('input').get();
    var idEventoToUpdate = 0;
    var idTableEventoUtilizado = 0;
    $(".button-collapse").sideNav();
    $(inputs).on('focus', function () {
        var pos = $(this).offset();
        $(this).closest('.upage').scrollTop(pos.top);
    });


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
                right: 'agendaWeek,agendaDay'
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
                dateStart = $.fullCalendar.formatDate(start, "YYYY-MM-DD");
                dateEnd = $.fullCalendar.formatDate(end, "YYYY-MM-DD");
                start = $.fullCalendar.formatDate(start, "YYYY-MM-DD HH:mm:ss");
                end = $.fullCalendar.formatDate(end, "YYYY-MM-DD HH:mm:ss");
                var ambienteEvento = $("#sel-ambiente-pesquisa").val();
                var valorBoolean = verifyDates(start, end, ambienteEvento);
                if (dateStart == dateEnd) {
                    if (valorBoolean == true) {
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
                        var ano = hoje.getFullYear();
                        var mes = hoje.getMonth() + 1;
                        var dia = hoje.getDate();
                        if (dia < 10) {
                            dia = 0 + "" + dia;
                        }
                        if (mes < 10) {
                            mes = 0 + "" + mes;
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
                                dismissible: false,
                                complete: function () {
                                    start = null;
                                    end = null;
                                    $('#form_add_event').each(function () {
                                        this.reset();
                                    });
                                }
                            });
                            $("#modalAdicionarEventoClickDay").modal('open');
                            $(".buttonOkay").attr("disabled", false);
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

                            $(".mostrarWhenClickBtn").addClass("cadastroClickBtn");
                            var title;
                            var eventData;
                            $(".buttonOkay").click(function () {
                                var nomeEvento = $(".nomeEvento").val();
                                var idUsuario = $("#idUsuario").val();
                                var solicitanteEvento = $(".solicitante").val();
                                var telefoneSolicitante = $(".telefoneContatoSolicitante").val();
                                var emailSolicitante = $(".emailContatoSolicitante").val();
                                var tipoEvento = $("#sel-tipo-evento").val();
                                var blocoEvento = $("#sel-bloco").val();
                                var ambienteEvento = $("#sel-ambiente").val();
                                var eventoTipoRepeticao = 1;
                                var idAula = 2;
                                title = $(".descricaoEvento").val();
                                var contadorInput = 0;
                                var contadorSelect = 0;
                                $("#form_add_event input[type=text]:enabled").each(function () {
                                    $(this).val() == "" ? contadorInput++ : "";
                                });
                                $("#form_add_event select:visible").each(function () {
                                    $(this).val() == null ? contadorSelect++ : "";
                                });
                                if ((contadorInput == 0) && (contadorSelect == 0)) {
                                    eventData = {
                                        title: title,
                                        start: start,
                                        end: end
                                    };
                                    if (insertEventoSelecionado(idUsuario, nomeEvento, solicitanteEvento, telefoneSolicitante, emailSolicitante, tipoEvento, blocoEvento, ambienteEvento, eventoTipoRepeticao, idAula, title, start, end) == true) {
                                        var valorIdEvento = getEventByAmbienteAndStartAndEnd(ambienteEvento, start, end);
                                        getQtdSolicitadaAndUpdateQtdDisponivel();
                                        for (var i = 0; i < valorIdEvento.length; i++) {
                                            checkboxToEquipamentServiceRefeicao(valorIdEvento[i], start, end);
                                        }
                                        start = null;
                                        end = null;
                                        $("#modalAdicionarEventoClickDay").modal('close');
                                        location.reload();
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
                    } else {
                        $("#modalDatasIguais").modal();
                        $("#modalDatasIguais").modal('open');
                    }
                } else {
                    $('#calendar').fullCalendar('unselect');
                    alert("Selecione um evento repetido para continuar");
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
                    async: false,
                    data: {
                        action: "EventoLogica.getEventById",
                        idEvento: event.id
                    }, success: function (data, textStatus, jqXHR) {
                        $("#modalUpdateEvent").modal({
                            dismissible: false
                        });
                        $("#modalUpdateEvent").modal('open');
                        $("#contentUpdateEvent").html(data);
                        $('.tabs#tabs-bosta').tabs();
                        pickDataInicio();
                        pickDataFim();
                        pickHoraInicio();
                        pickHoraFim();
                        getSetorUpdate();
                        getBlocoBySetorModalUpdate();
                        getAmbienteByBlocoModalUpdate();
                        getEquipamentosByIdEvento(event.id);
                        getServicosByIdEvento(event.id);
                        getRefeicoesByIdEvento(event.id);
                        idEventoToUpdate = event.id;
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
        $("#calendar .fc-axis.fc-widget-header").append("<a href='#'>IFCE</a>");
    }

    function percorrerIdEquipamento(valorIdEvento) {
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
            getDadosEquipamentosByIdEventoSendEmail(valorIdEvento, idEquipamento);
        });

    }

    function percorrerIdServico(valorIdEvento) {
        $(".idServico:checked").each(function () {
            var idServico = $(this).val();
            var dataInicioServico = $(".txt-data-inicial-servico#inputSer" + idServico).val();
            var horaInicioServico = $(".txt-hora-inicial-servico#inputSer" + idServico).val();
            var dataFimServico = $(".txt-data-final-servico#inputSer" + idServico).val();
            var horaFimServico = $(".txt-hora-final-servico#inputSer" + idServico).val();
            var dataInicioFormatadaCompleta = dataInicioServico.substr(6, 4) + "-" + dataInicioServico.substr(3, 2) + "-" + dataInicioServico.substr(0, 2) + " " + horaInicioServico;
            var dataFimFormatadaCompleta = dataFimServico.substr(6, 4) + "-" + dataFimServico.substr(3, 2) + "-" + dataFimServico.substr(0, 2) + " " + horaFimServico;
            insertInTabelEventServiceUsed(valorIdEvento, idServico, dataInicioFormatadaCompleta, dataFimFormatadaCompleta);
            getDadosServicesByIdEventoSendEmail(valorIdEvento, idServico);
        });
    }

    function percorrerIdRefeicao(valorIdEvento) {
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
            getDadosRefeicoesByIdEventoSendEmail(valorIdEvento, idRefeicao)
        });
    }

    function logicaAddEditDeleteMaterial(idEvento) {
        $(".btn-add-material").click(function () {
            $("#sel-equipamentos").attr("disabled", false);
//            var idEvento = $(this).attr("id");
            $(".textAdionarAtualizarMaterial").html("Adicionar Material");
            loadInSelectMateriais(idEvento);
            dataEquipamentoMenorQueDataEventoToUpdate();
            isNumeric();
//            addMaterialInEvent(idEvento);
            $("#modalAdicionarAtualizarMaterial").modal({
                dismissible: false,
                complete: function () {
                    $('#formAddMaterialEvent').each(function () {
                        this.reset();
                    });
                }
            });
            var dataInicioForm = $("#form_upd_event .dataInicio").val();
            var horaInicioForm = $("#form_upd_event .horaInicio").val();
            var dataFimForm = $("#form_upd_event .dataFim").val();
            var horaFimForm = $("#form_upd_event .horaFim").val();
            $("#formAddMaterialEvent .dataInicio").val(dataInicioForm);
            $("#formAddMaterialEvent .horaInicio").val(horaInicioForm);
            $("#formAddMaterialEvent .dataFim").val(dataFimForm);
            $("#formAddMaterialEvent .horaFim").val(horaFimForm);
            $("#modalAdicionarAtualizarMaterial").modal('open');
            $(".buttonCadastroMaterial").show();
            $(".buttonUpdateMaterial").hide();
            fecharModalAddMaterial();
        });

        $(".btn-editar-material").click(function () {
            var idMaterialUtilizado = $(this).attr("id");
            $(".textAdionarAtualizarMaterial").html("Atualizar Material");
            getInformationsMaterialToEdit(idMaterialUtilizado, idEvento);
            isNumeric();
            dataEquipamentoMenorQueDataEventoToUpdate();
            $("#modalAdicionarAtualizarMaterial").modal({
                dismissible: false,
                complete: function () {
                    $('#formAddMaterialEvent').each(function () {
                        this.reset();
                    });
                }
            });
            $("#modalAdicionarAtualizarMaterial").modal('open');
            fecharModalAddMaterial();
        });

        $(".btn-deletar-material").click(function () {
            var idMaterialUtilizado = $(this).attr("id");
            var informationsMaterial = [];
            informationsMaterial = getInformationsMaterialByIdToExclusao(idMaterialUtilizado, idEvento);
            $("#dialog-confirm").dialog({
                show: {
                    effect: 'fade',
                    duration: 200 //at your convenience
                },
                resizable: false,
                height: "auto",
                width: 400,
                modal: true,
                buttons: {
                    "Sim": function () {
                        $(this).dialog("close");
                        deleteInTableMaterialUtilizado(informationsMaterial, idEvento);
                    },
                    Não: function () {
                        $(this).dialog("close");
                    }
                }
            });
        });
    }

    function logicaAddEditDeleteServico(idEvento) {
        $(".btn-add-servico").click(function () {
            $("#sel-servicos").attr("disabled", false);
            $(".textAdionarAtualizarServico").html("Adicionar Serviço");
            loadInSelectServicos(idEvento);
            $("#modalAdicionarAtualizarServico").modal({
                dismissible: false,
                complete: function () {
                    $('#formAddServicoEvent').each(function () {
                        this.reset();
                    });
                }
            });
            var dataInicioForm = $("#form_upd_event .dataInicio").val();
            var horaInicioForm = $("#form_upd_event .horaInicio").val();
            var dataFimForm = $("#form_upd_event .dataFim").val();
            var horaFimForm = $("#form_upd_event .horaFim").val();
            $("#formAddServicoEvent .dataInicio").val(dataInicioForm);
            $("#formAddServicoEvent .horaInicio").val(horaInicioForm);
            $("#formAddServicoEvent .dataFim").val(dataFimForm);
            $("#formAddServicoEvent .horaFim").val(horaFimForm);
            $("#modalAdicionarAtualizarServico").modal('open');
            $(".buttonCadastroServico").show();
            $(".buttonUpdateServico").hide();
            fecharModalAddServico();
        });

        $(".btn-editar-servico").click(function () {
            var idServicoUtilizado = $(this).attr("id");
            $(".textAdionarAtualizarServico").html("Atualizar Serviço");
            getInformationsServicoToEdit(idServicoUtilizado, idEvento);
            $("#modalAdicionarAtualizarServico").modal({
                dismissible: false,
                complete: function () {
                    $('#formAddServicoEvent').each(function () {
                        this.reset();
                    });
                }
            });
            $("#modalAdicionarAtualizarServico").modal('open');
            $(".buttonCadastroServico").hide();
            $(".buttonUpdateServico").show();
            fecharModalAddServico();
        });

        $(".btn-deletar-servico").click(function () {
            var idServicoUtilizado = $(this).attr("id");
            var informationsServico = [];
            informationsServico = getInformationsServicoByIdToExclusao(idServicoUtilizado, idEvento);
            $("#dialog-confirm").dialog({
                show: {
                    effect: 'fade',
                    duration: 200 //at your convenience
                },
                resizable: false,
                height: "auto",
                width: 400,
                modal: true,
                buttons: {
                    "Sim": function () {
                        $(this).dialog("close");
                        deleteInTableServicoUtilizado(informationsServico, idEvento);
                    },
                    Não: function () {
                        $(this).dialog("close");
                    }
                }
            });
        });
    }

    function logicaAddEditDeleteRefeicao(idEvento) {
        $(".btn-add-refeicao").click(function () {
            $("#sel-refeicoes").attr("disabled", false);
            $(".textAdionarAtualizarRefeicao").html("Adicionar Refeição");
            loadInSelectRefeicoes(idEvento);
            $("#modalAdicionarAtualizarRefeicao").modal({
                dismissible: false,
                complete: function () {
                    $('#formAddRefeicaoEvent').each(function () {
                        this.reset();
                    });
                }
            });
            var dataInicioForm = $("#form_upd_event .dataInicio").val();
            var horaInicioForm = $("#form_upd_event .horaInicio").val();
            var dataFimForm = $("#form_upd_event .dataFim").val();
            var horaFimForm = $("#form_upd_event .horaFim").val();
            $("#formAddRefeicaoEvent .dataInicio").val(dataInicioForm);
            $("#formAddRefeicaoEvent .horaInicio").val(horaInicioForm);
            $("#formAddRefeicaoEvent .dataFim").val(dataFimForm);
            $("#formAddRefeicaoEvent .horaFim").val(horaFimForm);
            $("#modalAdicionarAtualizarRefeicao").modal('open');
            $(".buttonCadastroRefeicao").show();
            $(".buttonUpdateRefeicao").hide();
            fecharModalAddRefeicao();
        });

        $(".btn-editar-refeicao").click(function () {
            var idRefeicaoUtilizado = $(this).attr("id");
            $(".textAdionarAtualizarRefeicao").html("Atualizar Serviço");
            getInformationsRefeicaoToEdit(idRefeicaoUtilizado, idEvento);
            $("#modalAdicionarAtualizarRefeicao").modal({
                dismissible: false,
                complete: function () {
                    $('#formAddRefeicaoEvent').each(function () {
                        this.reset();
                    });
                }
            });
            $("#modalAdicionarAtualizarRefeicao").modal('open');
            $(".buttonCadastroRefeicao").hide();
            $(".buttonUpdateRefeicao").show();
            fecharModalAddRefeicao();
        });

        $(".btn-deletar-refeicao").click(function () {
            var idRefeicaoUtilizado = $(this).attr("id");
            var informationsRefeicao = [];
            informationsRefeicao = getInformationsRefeicaoByIdToExclusao(idRefeicaoUtilizado, idEvento);
            $("#dialog-confirm").dialog({
                show: {
                    effect: 'fade',
                    duration: 200 //at your convenience
                },
                resizable: false,
                height: "auto",
                width: 400,
                modal: true,
                buttons: {
                    "Sim": function () {
                        $(this).dialog("close");
                        deleteInTableRefeicaoUtilizado(informationsRefeicao, idEvento);
                    },
                    Não: function () {
                        $(this).dialog("close");
                    }
                }
            });
        });
    }

    function loadInSelectMateriais(idEvento) {
        $.ajax({
            url: controllerToAdmin,
            type: 'POST',
            data: {
                action: 'EquipamentoLogica.getEquipamentosNotInEvento',
                idEvento: idEvento
            }, success: function (data, textStatus, jqXHR) {
                $("#sel-equipamentos").html(data);
                $("#sel-equipamentos").material_select();
                getQuantidadeDisponivelByIdEquipamento();
            }
        });
    }

    function getInformationsMaterialToEdit(idMaterialUtilizado, idEvento) {
        $.ajax({
            url: controllerToAdmin,
            type: 'POST',
            async: false,
            data: {
                action: 'EventoEquipamentoUtilizadoLogica.getInformationsMaterialToEdit',
                idMaterialUtilizado: idMaterialUtilizado,
                idEvento: idEvento
            }, success: function (data, textStatus, jqXHR) {
                data = $.parseJSON(data);
                var optionMaterial = "<option value=" + data.idEquipamento + ">" + data.descricaoEquipamento + "</option>";
                $("#sel-equipamentos").html(optionMaterial);
                $("#sel-equipamentos").attr("disabled", true);
                $("#sel-equipamentos").material_select();
                $(".quantidadeDisponivel").val(data.qtdDisponivel);
                $(".quantidadeSolicitada").val(data.qtdSolicitada);
                $("#formAddMaterialEvent .dataInicio").val(data.dataInicio);
                $("#formAddMaterialEvent .horaInicio").val(data.horaInicio);
                $("#formAddMaterialEvent .dataFim").val(data.dataFim);
                $("#formAddMaterialEvent .horaFim").val(data.horaFim);
                idTableEventoUtilizado = data.idTableEventoUtilizado;
                $(".buttonCadastroMaterial").hide();
                $(".buttonUpdateMaterial").show();
                $(".buttonUpdateMaterial").prop("disabled", false);
                $(".buttonUpdateMaterial").css("cursor", "pointer");
            }
        });
    }

    function getInformationsMaterialByIdToExclusao(idMaterialUtilizado, idEvento) {
        var informationsMaterial = [];
        $.ajax({
            url: controllerToAdmin,
            type: 'POST',
            async: false,
            data: {
                action: 'EventoEquipamentoUtilizadoLogica.getInformationsMaterialToEdit',
                idMaterialUtilizado: idMaterialUtilizado,
                idEvento: idEvento
            }, success: function (data, textStatus, jqXHR) {
                data = $.parseJSON(data);
                informationsMaterial.push(data.idTableEventoUtilizado);
                informationsMaterial.push(data.dataInicioBancoDeDados);
                informationsMaterial.push(data.dataFimBancoDeDados);
                $(".textExclusao").html("Você deseja realmente excluir <b>" + data.descricaoEquipamento + "</b> ?");
            }
        });
        return informationsMaterial;
    }

    function deleteInTableMaterialUtilizado(informationsMaterial, idEvento) {
        $.ajax({
            url: controllerToAdmin,
            type: 'POST',
            async: false,
            data: {
                action: 'EventoEquipamentoUtilizadoLogica.deleteInTableMaterialUtilizado',
                idMaterialUtilizadoOfTable: informationsMaterial[0],
                dataInicio: informationsMaterial[1],
                dataFim: informationsMaterial[2]
            }, success: function (data, textStatus, jqXHR) {
                getEquipamentosByIdEvento(idEvento);
                updateEventById(idEvento);
            }
        });
    }

    function fecharModalAddMaterial() {
        $("#modalAdicionarAtualizarMaterial .btnCancel").click(function () {
            $("#modalAdicionarAtualizarMaterial").modal("close");
        });
    }

    function loadInSelectServicos(idEvento) {
        $.ajax({
            url: controllerToAdmin,
            type: 'POST',
            data: {
                action: 'ServicoLogica.getServicoNotInEvento',
                idEvento: idEvento
            }, success: function (data, textStatus, jqXHR) {
                $("#sel-servicos").html(data);
                $("#sel-servicos").material_select();
            }
        });
    }

    function getInformationsServicoToEdit(idServicoUtilizado, idEvento) {
        $.ajax({
            url: controllerToAdmin,
            type: 'POST',
            async: false,
            data: {
                action: 'EventoServicoUtilizadoLogica.getInformationsServicoToEdit',
                idServicoUtilizado: idServicoUtilizado,
                idEvento: idEvento
            }, success: function (data, textStatus, jqXHR) {
                data = $.parseJSON(data);
                var optionServico = "<option value=" + data.idServico + ">" + data.descricaoServico + "</option>";
                $("#sel-servicos").html(optionServico);
                $("#sel-servicos").attr("disabled", true);
                $("#sel-servicos").material_select();
                $("#formAddServicoEvent .dataInicio").val(data.dataInicio);
                $("#formAddServicoEvent .horaInicio").val(data.horaInicio);
                $("#formAddServicoEvent .dataFim").val(data.dataFim);
                $("#formAddServicoEvent .horaFim").val(data.horaFim);
                idTableEventoUtilizado = data.idTableEventoUtilizado;
                $(".buttonCadastroServico").hide();
                $(".buttonUpdateServico").show();
                $(".buttonUpdateServico").prop("disabled", false);
                $(".buttonUpdateServico").css("cursor", "pointer");
            }
        });
    }

    function getInformationsServicoByIdToExclusao(idServicoUtilizado, idEvento) {
        var informationsServico = [];
        $.ajax({
            url: controllerToAdmin,
            type: 'POST',
            async: false,
            data: {
                action: 'EventoServicoUtilizadoLogica.getInformationsServicoToEdit',
                idServicoUtilizado: idServicoUtilizado,
                idEvento: idEvento
            }, success: function (data, textStatus, jqXHR) {
                data = $.parseJSON(data);
                informationsServico.push(data.idTableEventoUtilizado);
                informationsServico.push(data.dataInicioBancoDeDados);
                informationsServico.push(data.dataFimBancoDeDados);
                $(".textExclusao").html("Você deseja realmente excluir <b>" + data.descricaoServico + "</b> ?");
            }
        });
        return informationsServico;
    }

    function deleteInTableServicoUtilizado(informationsServico, idEvento) {
        $.ajax({
            url: controllerToAdmin,
            type: 'POST',
            async: false,
            data: {
                action: 'EventoServicoUtilizadoLogica.deleteInTableServicoUtilizado',
                idServicoUtilizadoOfTable: informationsServico[0],
                dataInicio: informationsServico[1],
                dataFim: informationsServico[2]
            }, success: function (data, textStatus, jqXHR) {
                getServicosByIdEvento(idEvento);
            }
        });
    }

    function fecharModalAddServico() {
        $("#modalAdicionarAtualizarServico .btnCancel").click(function () {
            $("#modalAdicionarAtualizarServico").modal("close");
        });
    }

    function loadInSelectRefeicoes(idEvento) {
        $.ajax({
            url: controllerToAdmin,
            type: 'POST',
            data: {
                action: 'RefeicaoLogica.getRefeicaoNotInEvento',
                idEvento: idEvento
            }, success: function (data, textStatus, jqXHR) {
                $("#sel-refeicoes").html(data);
                $("#sel-refeicoes").material_select();
            }
        });
    }

    function getInformationsRefeicaoToEdit(idRefeicaoUtilizado, idEvento) {
        $.ajax({
            url: controllerToAdmin,
            type: 'POST',
            async: false,
            data: {
                action: 'EventoRefeicaoUtilizadoLogica.getInformationsRefeicaoToEdit',
                idRefeicaoUtilizado: idRefeicaoUtilizado,
                idEvento: idEvento
            }, success: function (data, textStatus, jqXHR) {
                data = $.parseJSON(data);
                var optionRefeicao = "<option value=" + data.idRefeicao + ">" + data.descricaoRefeicao + "</option>";
                $("#sel-refeicoes").html(optionRefeicao);
                $("#sel-refeicoes").attr("disabled", true);
                $("#sel-refeicoes").material_select();
                $("#formAddRefeicaoEvent .dataInicio").val(data.dataInicio);
                $("#formAddRefeicaoEvent .horaInicio").val(data.horaInicio);
                $("#formAddRefeicaoEvent .dataFim").val(data.dataFim);
                $("#formAddRefeicaoEvent .horaFim").val(data.horaFim);
                $(".qtdPessoasRefeicao").val(data.qtdPessoasRefeicao);
                idTableEventoUtilizado = data.idTableEventoUtilizado;
                $(".buttonCadastroRefeicao").hide();
                $(".buttonUpdateRefeicao").show();
                $(".buttonUpdateRefeicao").prop("disabled", false);
                $(".buttonUpdateRefeicao").css("cursor", "pointer");
            }
        });
    }

    function getInformationsRefeicaoByIdToExclusao(idRefeicaoUtilizado, idEvento) {
        var informationsRefeicao = [];
        $.ajax({
            url: controllerToAdmin,
            type: 'POST',
            async: false,
            data: {
                action: 'EventoRefeicaoUtilizadoLogica.getInformationsRefeicaoToEdit',
                idRefeicaoUtilizado: idRefeicaoUtilizado,
                idEvento: idEvento
            }, success: function (data, textStatus, jqXHR) {
                data = $.parseJSON(data);
                informationsRefeicao.push(data.idTableEventoUtilizado);
                informationsRefeicao.push(data.dataInicioBancoDeDados);
                informationsRefeicao.push(data.dataFimBancoDeDados);
                $(".textExclusao").html("Você deseja realmente excluir <b>" + data.descricaoRefeicao + "</b> ?");
            }
        });
        return informationsRefeicao;
    }

    function deleteInTableRefeicaoUtilizado(informationsRefeicao, idEvento) {
        $.ajax({
            url: controllerToAdmin,
            type: 'POST',
            async: false,
            data: {
                action: 'EventoRefeicaoUtilizadoLogica.deleteInTableRefeicaoUtilizado',
                idRefeicaoUtilizadoOfTable: informationsRefeicao[0],
                dataInicio: informationsRefeicao[1],
                dataFim: informationsRefeicao[2]
            }, success: function (data, textStatus, jqXHR) {
                getRefeicoesByIdEvento(idEvento);
            }
        });
    }

    function fecharModalAddRefeicao() {
        $("#modalAdicionarAtualizarRefeicao .btnCancel").click(function () {
            $("#modalAdicionarAtualizarRefeicao").modal("close");
        });
    }

    function getQuantidadeDisponivelByIdEquipamento() {
        $("#sel-equipamentos").change(function () {
            var idEquipamento = $(this).val();
            $.ajax({
                url: controllerToAdmin,
                type: 'POST',
                data: {
                    action: 'EquipamentoLogica.verifyQtdSolicitadaByIdEquipamento',
                    idEquipamento: idEquipamento
                }, success: function (data, textStatus, jqXHR) {
                    data = $.parseJSON(data);
                    $(".quantidadeDisponivel").val(data.qtdDisponivel);
                    $(".quantidadeSolicitada").val("");
                }
            });
        });
    }

    function getDadosEquipamentosByIdEventoSendEmail(valorIdEvento, idEquipamento) {
        $.ajax({
            url: controllerToAdmin,
            type: 'POST',
            data: {
                action: "DadosToMailLogica.getDadosEquipamentosByIdEventoSendEmail",
                valorIdEvento: valorIdEvento,
                idEquipamento: idEquipamento
            }, success: function (data, textStatus, jqXHR) {
//                console.log("Email Enviado!");
            }
        });
    }

    function getDadosServicesByIdEventoSendEmail(valorIdEvento, idServico) {
        $.ajax({
            url: controllerToAdmin,
            type: 'POST',
            data: {
                action: "DadosToMailLogica.getDadosServicesByIdEventoSendEmail",
                valorIdEvento: valorIdEvento,
                idServico: idServico
            }, success: function (data, textStatus, jqXHR) {
//                console.log("Email Enviado!");
            }
        });
    }

    function getDadosRefeicoesByIdEventoSendEmail(valorIdEvento, idRefeicao) {
        $.ajax({
            url: controllerToAdmin,
            type: 'POST',
            data: {
                action: "DadosToMailLogica.getDadosRefeicoesByIdEventoSendEmail",
                valorIdEvento: valorIdEvento,
                idRefeicao: idRefeicao
            }, success: function (data, textStatus, jqXHR) {
//                console.log("Email Enviado!");
            }
        });
    }

    function loadCalendarDaysOfWeek(dataInicio, dataFim) {
        $("#calendarDayOfWeek").fullCalendar("destroy");

        $("#calendarDayOfWeek").fullCalendar({
            firstDay: 0,
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
                center: 'title'
            },
            navLinks: true,
            selectable: true,
            selectHelper: true,
            editable: false,
            eventLimit: true,
            dayClick: function (date, jsEvent, view) {
                console.log("Clicou no dia: " + date.format());
            },
            select: function (start, end, date) {
                var diaNumero = start.day();
                var arrayStartEnd = [];
                start = $.fullCalendar.formatDate(start, "YYYY-MM-DD HH:mm:ss");
                end = $.fullCalendar.formatDate(end, "YYYY-MM-DD HH:mm:ss");
                dataInicioToArray = dataInicio.substr(6, 4) + "-" + dataInicio.substr(3, 2) + "-" + dataInicio.substr(0, 2) + " " + start.substr(11, 8);
                dataFimToArray = dataFim.substr(6, 4) + "-" + dataFim.substr(3, 2) + "-" + dataFim.substr(0, 2) + " " + end.substr(11, 8);
                var ambienteEvento = $("#sel-ambiente").val();
                if (ambienteEvento != null) {
                    arrayStartEnd.push(idEventWeekOrHalfYear);
                    arrayStartEnd.push(dataInicioToArray);
                    arrayStartEnd.push(dataFimToArray);
                    arrayStartEnd.push(diaNumero);
                    arrayValoresCompletos.push(arrayStartEnd);
//                        console.log(arrayValoresCompletos);
                    $("#calendarDayOfWeek").fullCalendar('addEventSource', [{
                            id: idEventWeekOrHalfYear,
                            start: start,
                            end: end,
                            block: true
                        }, ]);
                    $("#calendarDayOfWeek").fullCalendar("unselect");
                } else {
                    $("#modalAmbienteNulo").modal();
                    $("#modalAmbienteNulo").modal("open");
                }
                idEventWeekOrHalfYear++;
            },
            eventClick: function (event, element) {
//                var start = $.fullCalendar.formatDate(event.start, "YYYY-MM-DD HH:mm:ss");
                for (var i = 0; i < arrayValoresCompletos.length; i++) {
                    if (arrayValoresCompletos[i][0] == event.id) {
//                        console.log(arrayValoresCompletos[i][0]);
                        arrayValoresCompletos.splice(i, 1);
                    }
                }
                $("#calendarDayOfWeek").fullCalendar("removeEvents", event.id);
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
            defaultDate: '2018-01-28',
            defaultView: "agenda",
            duration: {days: 7}
        });
        $("#modalAdicionarEventoClickDay .fc-day-header.fc-sun").empty();
        $("#modalAdicionarEventoClickDay .fc-day-header.fc-mon").empty();
        $("#modalAdicionarEventoClickDay .fc-day-header.fc-tue").empty();
        $("#modalAdicionarEventoClickDay .fc-day-header.fc-wed").empty();
        $("#modalAdicionarEventoClickDay .fc-day-header.fc-thu").empty();
        $("#modalAdicionarEventoClickDay .fc-day-header.fc-fri").empty();
        $("#modalAdicionarEventoClickDay .fc-day-header.fc-sat").empty();

        $("#modalAdicionarEventoClickDay .fc-day-header.fc-sun").html('<a href="#!">Dom</a>');
        $("#modalAdicionarEventoClickDay .fc-day-header.fc-mon").html('<a href="#!">Seg</a>');
        $("#modalAdicionarEventoClickDay .fc-day-header.fc-tue").html('<a href="#!">Ter</a>');
        $("#modalAdicionarEventoClickDay .fc-day-header.fc-wed").html('<a href="#!">Qua</a>');
        $("#modalAdicionarEventoClickDay .fc-day-header.fc-thu").html('<a href="#!">Qui</a>');
        $("#modalAdicionarEventoClickDay .fc-day-header.fc-fri").html('<a href="#!">Sex</a>');
        $("#modalAdicionarEventoClickDay .fc-day-header.fc-sat").html('<a href="#!">Sab</a>');
    }

    $(".openModalAdicionarEvento").click(function () {
        $("#formDataInicio").removeAttr("disabled");
        $("#formDataFim").removeAttr("disabled");
        $("#formHoraInicio").removeAttr("disabled");
        $("#formHoraFim").removeAttr("disabled");
        $(".mostrarWhenClickBtn").removeClass("cadastroClickBtn");
        $("#modalAdicionarEventoClickDay").modal({
            dismissible: false,
            complete: function () {
                $('#form_add_event').each(function () {
                    this.reset();
                });
            }
        });

        $("#modalAdicionarEventoClickDay").modal('open');
        $(".buttonOkay").attr("disabled", false);
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
            container: 'body',
            selectMonths: true,
            selectYears: 1,
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
            container: 'body',
            selectMonths: true,
            selectYears: 1,
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
            container: 'body',
            default: 'now', horaAtual,
            fromnow: 0,
            twelvehour: false,
            donetext: 'OK',
            cleartext: 'Limpar',
            canceltext: 'Cancelar',
            autoclose: false,
            ampmclickable: true,
            aftershow: function () {}
        });
    }

    function pickHoraFim() {
        $('.horaFim').pickatime({
            container: 'body',
            default: 'now', horaAtual,
            fromnow: 0,
            twelvehour: false,
            donetext: 'OK',
            cleartext: 'Limpar',
            canceltext: 'Cancelar',
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
        $("#formDataInicio").removeClass("hasError");
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
        var idRepeticao = $("#sel-tip-repeticao").val();
        var dataInicio = $("#formDataInicio").val();
        if (idRepeticao == 2) {
            if (dataInicio == "") {
                $("#formDataInicio").addClass("hasError");
                $("#formDataInicio").focus();
                $(".dataInicioLabel").addClass("hasError");
            } else {
                loadCalendarDaysOfWeek(dataInicio, valorDataFim);
            }
        } else if (idRepeticao == 1) {
            $("#calendarDayOfWeek").fullCalendar("destroy");
        }
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
            if (mes < 10) {
                mes = "0" + mes;
            }
            var dia = hoje.getDate();
            if (dia < 10) {
                dia = "0" + dia;
            }
            var hora = hoje.getHours();
            var minutos = hoje.getMinutes();
            if (minutos < 10) {
                minutos = "0" + minutos;
            }
            var segundos = hoje.getSeconds();
            if (segundos < 10) {
                segundos = "0" + segundos;
            }
            var hojeFormatada = ano + "-" + mes + "-" + dia + " " + hora + ":" + minutos + ":" + segundos;
            var idUsuario = $("#idUsuario").val();
            var nomeEvento = $(".nomeEvento").val();
            var solicitanteEvento = $(".solicitante").val();
            var telefoneSolicitante = $(".telefoneContatoSolicitante").val();
            var emailSolicitante = $(".emailContatoSolicitante").val();
            var tipoEvento = $("#sel-tipo-evento").val();
            var blocoEvento = $("#sel-bloco").val();
            var ambienteEvento = $("#sel-ambiente").val();
            var idAula = $("#sel-aula").val();
            var tipoRepeticao = $("#sel-tip-repeticao").val();
            var descricaoEvento = $(".descricaoEvento").val();
            var dataInicio = $("#form_add_event .dataInicio").val();
            var horaInicio = $("#form_add_event .horaInicio").val();
            var dataFim = $("#form_add_event .dataFim").val();
            var horaFim = $("#form_add_event .horaFim").val();
            var contadorInput = 0;
            var contadorSelect = 0;
            $("#form_add_event input[type=text]:enabled").each(function () {
                $(this).val() == "" ? contadorInput++ : "";
            });
            $("#form_add_event select:enabled").each(function () {
                $(this).val() == null ? contadorSelect++ : "";
            });
            if ((contadorInput == 0) && (contadorSelect == 0)) {
                var inicio = dataInicio.substr(6, 4) + "-" + dataInicio.substr(3, 2) + "-" + dataInicio.substr(0, 2) + " " + horaInicio;
                var fim = dataFim.substr(6, 4) + "-" + dataFim.substr(3, 2) + "-" + dataFim.substr(0, 2) + " " + horaFim;
                if (tipoRepeticao != 3 && inicio < hojeFormatada) {
                    $("#modalDataAnterior").modal();
                    $("#modalDataAnterior").modal('open');
                } else {
                    if (inicio > fim) {
                        $("#modalDataInicioMaiorQueFinal").modal();
                        $("#modalDataInicioMaiorQueFinal").modal('open');
                    } else {
                        var nomeProfessor = $(".nomeProfessor").val();
                        if ((idAula == 1) && (nomeProfessor == "")) {
                            $("#modalCamposNulos").modal();
                            $("#modalCamposNulos").modal('open');
                        } else {
                            if (verifyDates(inicio, fim, ambienteEvento) == true) {
                                if (insertEventoSelecionado(idUsuario, nomeEvento, solicitanteEvento, telefoneSolicitante, emailSolicitante, tipoEvento, blocoEvento, ambienteEvento, tipoRepeticao, idAula, descricaoEvento, inicio, fim) == true) {
                                    getQtdSolicitadaAndUpdateQtdDisponivel();
                                    if (tipoRepeticao == 1) {
                                        var valorIdEvento = getEventByAmbienteAndStartAndEnd(ambienteEvento, inicio, fim);
                                        if (idAula == 1) {
                                            for (var i = 0; i < valorIdEvento.length; i++) {
                                                insertIntoTableAulaDetalhes(valorIdEvento[i], idAula, nomeProfessor);
                                                updateEveLogicaToZero(valorIdEvento[i]);
                                            }
                                        }
                                        for (var i = 0; i < valorIdEvento.length; i++) {
                                            checkboxToEquipamentServiceRefeicao(valorIdEvento[i], inicio, fim);
                                        }

                                    } else {
                                        var valorIdEventoArray = getEventByAmbienteAndStartAndEnd(ambienteEvento, inicio, fim);
                                        if (idAula == 1) {
                                            for (var i = 0; i < valorIdEventoArray.length; i++) {
                                                insertIntoTableAulaDetalhes(valorIdEventoArray[i], idAula, nomeProfessor);
                                                updateEveLogicaToZero(valorIdEventoArray[i]);

                                            }
                                        }
                                        for (var i = 0; i < valorIdEventoArray.length; i++) {
                                            checkboxToEquipamentServiceRefeicao(valorIdEventoArray[i], inicio, fim);
                                        }

                                    }
                                    $("#modalAdicionarEventoClickDay").modal('close');
                                    location.reload();
                                }
                            } else {
                                $("#modalDatasIguais").modal();
                                $("#modalDatasIguais").modal('open');
                            }
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

    function checkboxToEquipamentServiceRefeicao(valorIdEvento, inicio, fim) {
        if ($(".idEquipamento").is(":checked") && (!$(".idServico").is(":checked")) && (!$(".idRefeicao").is(":checked"))) {
            percorrerIdEquipamento(valorIdEvento);
            insertInTabelEventServiceUsed(valorIdEvento, 0, inicio, fim);
            insertInTabelEventRefeicaoUsed(valorIdEvento, 0, "-", inicio, fim);
        } else if ($(".idServico").is(":checked") && (!$(".idEquipamento").is(":checked")) && (!$(".idRefeicao").is(":checked"))) {
            percorrerIdServico(valorIdEvento);
            insertInTabelEventEquipamentUsed(valorIdEvento, 0, "-", inicio, fim);
            insertInTabelEventRefeicaoUsed(valorIdEvento, 0, "-", inicio, fim);
        } else if ($(".idRefeicao").is(":checked") && (!$(".idServico").is(":checked")) && (!$(".idEquipamento").is(":checked"))) {
            percorrerIdRefeicao(valorIdEvento);
            insertInTabelEventServiceUsed(valorIdEvento, 0, inicio, fim);
            insertInTabelEventEquipamentUsed(valorIdEvento, 0, "-", inicio, fim);
        } else if (($(".idEquipamento").is(":checked")) && ($(".idServico").is(":checked")) && ($(".idRefeicao").is(":checked"))) {
            percorrerIdEquipamento(valorIdEvento);
            percorrerIdServico(valorIdEvento);
            percorrerIdRefeicao(valorIdEvento);
        } else if (($(".idEquipamento").is(":checked")) && ($(".idServico").is(":checked")) && (!$(".idRefeicao").is(":checked"))) {
            percorrerIdEquipamento(valorIdEvento);
            percorrerIdServico(valorIdEvento);
            insertInTabelEventRefeicaoUsed(valorIdEvento, 0, "-", inicio, fim);
        } else if (($(".idEquipamento").is(":checked")) && ($(".idRefeicao").is(":checked")) && (!$(".idServico").is(":checked"))) {
            percorrerIdEquipamento(valorIdEvento);
            percorrerIdRefeicao(valorIdEvento);
            insertInTabelEventServiceUsed(valorIdEvento, 0, inicio, fim);
        } else if ((!$(".idEquipamento").is(":checked")) && ($(".idServico").is(":checked")) && ($(".idRefeicao").is(":checked"))) {
            percorrerIdServico(valorIdEvento);
            percorrerIdRefeicao(valorIdEvento);
            insertInTabelEventEquipamentUsed(valorIdEvento, 0, "-", inicio, fim);
        } else {
            insertInTabelEventEquipamentUsed(valorIdEvento, 0, "-", inicio, fim);
            insertInTabelEventServiceUsed(valorIdEvento, 0, inicio, fim);
            insertInTabelEventRefeicaoUsed(valorIdEvento, 0, "-", inicio, fim);
        }
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

    function getSetorUpdate() {
        $.ajax({
            url: controllerToAdmin,
            type: "POST",
            data: {
                action: "SetorLogica.getSetor"
            },
            success: function (data) {
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
        if (idRepeticao == 3) {
            $.ajax({
                url: controllerToAdmin,
                type: 'POST',
                data: {
                    action: 'SemestreLogica.getDataBySemestre'
                }, success: function (data, textStatus, jqXHR) {
                    data = $.parseJSON(data);
                    $("#modalAdicionarEventoClickDay #formDataInicio").val(data.dataInicioSemestre);
                    $("#modalAdicionarEventoClickDay #formDataFim").val(data.dataFimSemestre);
                    $("#modalAdicionarEventoClickDay #formHoraInicio").attr("disabled", true);
                    $("#modalAdicionarEventoClickDay #formHoraFim").attr("disabled", true);
                    loadCalendarDaysOfWeek(data.dataInicioSemestre, data.dataFimSemestre);
                }
            });
        } else if (idRepeticao == 2) {
            $("#formHoraInicio").attr("disabled", true);
            $("#formHoraFim").attr("disabled", true);
            var dataInicio = $("#formDataInicio").val();
            var dataFim = $("#formDataFim").val();
            if (dataInicio != "" || dataFim != "") {
                $("#formDataInicio").val("");
                $("#formDataFim").val("");
                $(".txt-data-inicial").val("");
                $(".txt-data-final").val("");
                $(".txt-data-inicial-servico").val("");
                $(".txt-data-final-servico").val("");
                $(".txt-data-inicial-refeicao").val("");
                $(".txt-data-final-refeicao").val("");
                $("#formDataFim").val("");
                $("#calendarDayOfWeek").fullCalendar("destroy");
            }
        } else {
            $("#formHoraInicio").attr("disabled", false);
            $("#formHoraFim").attr("disabled", false);
            $("#formDataInicio").val("");
            $("#formDataFim").val("");
            $(".txt-data-inicial").val("");
            $(".txt-data-final").val("");
            $(".txt-data-inicial-servico").val("");
            $(".txt-data-final-servico").val("");
            $(".txt-data-inicial-refeicao").val("");
            $(".txt-data-final-refeicao").val("");
            $("#calendarDayOfWeek").fullCalendar("destroy");
        }

    });

    function insertEventoSelecionado(idUsuario, nomeEvento, solicitanteEvento, telefoneSolicitante, emailSolicitante, tipoEvento, blocoEvento, ambienteEvento, eventoTipoRepeticao, idAula, title, start, end) {
        var boolean;
        if (eventoTipoRepeticao == 1) {
            $.ajax({
                type: "POST",
                url: controllerToAdmin,
                async: false,
                data: {
                    action: "EventoLogica.insertEventoSelecionado",
                    idUsuario: idUsuario,
                    nomeEvento: nomeEvento,
                    solicitanteEvento: solicitanteEvento,
                    telefoneSolicitante: telefoneSolicitante,
                    emailSolicitante: emailSolicitante,
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
        } else {
            var jsonString = JSON.stringify(arrayValoresCompletos);
            $.ajax({
                type: "POST",
                url: controllerToAdmin,
                async: false,
                data: {
                    action: "EventoLogica.insertEventoSelecionadoTipoRepeticao",
                    idUsuario: idUsuario,
                    nomeEvento: nomeEvento,
                    solicitanteEvento: solicitanteEvento,
                    telefoneSolicitante: telefoneSolicitante,
                    emailSolicitante: emailSolicitante,
                    ambienteEvento: ambienteEvento,
                    descricaoEvento: title,
                    eventoTipoRepeticao: eventoTipoRepeticao,
                    idAula: idAula,
                    dataInicioEvento: start,
                    dataFimEvento: end,
                    horaInicioEvento: jsonString,
                    horaFimEvento: jsonString
                }, success: function (data, textStatus, jqXHR) {
                    if (data) {
                        $(".contentTipoRepeticaoDataIgual").html(data);
                        $("#modalDatasIguaisToRepeticao").modal();
                        $("#modalDatasIguaisToRepeticao").modal('open');
                        boolean = false;
                    } else {
                        boolean = true;

                    }
                }
            });
        }

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

    function updateEveLogicaToZero(valorIdEvento) {
        $.ajax({
            url: controllerToAdmin,
            type: 'POST',
            data: {
                action: 'EventoLogica.updateEveLogicaToZero',
                valorIdEvento: valorIdEvento
            }, success: function (data, textStatus, jqXHR) {
                console.log("Atualização deu certo!");
            }
        });
    }

    function getEventByAmbienteAndStartAndEnd(ambienteEvento, start, end) {
        var eventoId = [];
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
                    eventoId.push(dados[i].idEvento);
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
                var valorTd = $(".tabelaEquipamentos tbody tr").length;
                if (valorTd == 0) {
                    $(".tabelaEquipamentos tbody").prepend('<tr><td colspan="8">Não há equipamentos disponíveis</td></tr>');
                }
                dataEquipamentoMenorQueDataEvento();

            }
        });
    }

    function getEquipamentosByIdEvento(idEvento) {
        $.ajax({
            url: controllerToAdmin,
            type: 'POST',
            async: false,
            data: {
                action: 'EventoEquipamentoUtilizadoLogica.getEquipamentosByIdEvento',
                idEvento: idEvento
            }, success: function (data, textStatus, jqXHR) {
                $("#equipamentos-update").html(data);
                logicaAddEditDeleteMaterial(idEvento);
            }
        });
    }

    function getServicosByIdEvento(idEvento) {
        $.ajax({
            url: controllerToAdmin,
            type: 'POST',
            async: false,
            data: {
                action: 'EventoServicoUtilizadoLogica.getServicosByIdEvento',
                idEvento: idEvento
            }, success: function (data, textStatus, jqXHR) {
                $("#servicos-update").html(data);
                logicaAddEditDeleteServico(idEvento);
            }
        });
    }

    function getRefeicoesByIdEvento(idEvento) {
        $.ajax({
            url: controllerToAdmin,
            type: 'POST',
            async: false,
            data: {
                action: 'EventoRefeicaoUtilizadoLogica.getRefeicoesByIdEvento',
                idEvento: idEvento
            }, success: function (data, textStatus, jqXHR) {
                $("#refeicoes-update").html(data);
                logicaAddEditDeleteRefeicao(idEvento);
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
                var valorTd = $(".tabelaServicos tbody tr").length;
                if (valorTd == 0) {
                    $(".tabelaServicos tbody").prepend('<tr><td colspan="6">Não há serviços disponíveis</td></tr>');
                }
//                dataServicoMenorQueDataEvento();
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
                var valorTd = $(".tabelaRefeicoes tbody tr").length;
                if (valorTd == 0) {
                    $(".tabelaRefeicoes tbody").prepend('<tr><td colspan="8">Não há refeições disponíveis</td></tr>');
                }
                dataRefeicaoMenorQueDataEvento();
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
                $("#sel-tip-repeticao").val("1");
                $("#sel-tip-repeticao").material_select();
            }
        });
    }

    function isNumeric() {
        $(".txt-quantidade-solicitada").on("keyup", function (event) {
            $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
            $(this).val($(this).val().replace('.', ''));
            if ((event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
            var valorId = $(this).attr("id");
            var valorQtdSolicitada = $(this).val();
            compararQtdSolicitadaComQtdDisponivel(valorId, valorQtdSolicitada);
        });

        $.mask.definitions['~'] = '[+-]';
        $('.telefoneContatoSolicitante').focusout(function () {
            var phone, element;
            element = $(this);
            element.unmask();
            phone = element.val().replace(/\D/g, '');
            if (phone.length > 10) {
                element.mask("(99) 99999-999?9");
            } else {
                element.mask("(99) 9999-9999?9");
            }
        }).trigger('focusout');

        $("#formAddMaterialEvent .quantidadeSolicitada").on("keyup", function (event) {
            $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
            $(this).val($(this).val().replace('.', ''));
            if ((event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
            var valorId = $("#sel-equipamentos").val();
            var valorQtdSolicitada = $(this).val();
            compararQtdSolicitadaComQtdDisponivelToUpdate(valorId, valorQtdSolicitada);
        });
    }

    function compararQtdSolicitadaComQtdDisponivel(id, qtdSolicitada) {
        $(".txt-quantidade-solicitada:enabled").each(function () {
            var valorId = $(this).attr("id");
            var valorQtdSolicitada = $(this).val();
            var idEquipamento = valorId.substr(5, valorId.length - 5);
            $.ajax({
                url: controllerToAdmin,
                type: 'POST',
                async: false,
                data: {
                    action: 'EquipamentoLogica.verifyQtdSolicitadaByIdEquipamento',
                    idEquipamento: idEquipamento

                }, success: function (data, textStatus, jqXHR) {
                    dados = $.parseJSON(data);
                    if (parseInt(valorQtdSolicitada) <= parseInt(dados.qtdDisponivel)) {
//                        console.log(dados.qtdDisponivel);
                        $(".buttonOkay").prop("disabled", false);
                        $(".buttonOkay").css("cursor", "pointer");
                    } else if (valorQtdSolicitada == "") {
                        // Nulo
                    } else {
                        $(".buttonOkay").prop("disabled", true);
                        $(".buttonOkay").css("cursor", "not-allowed");
                        $("#modalQuantidadeSolicitadaMaiorQueDisponivel").modal();
                        $("#modalQuantidadeSolicitadaMaiorQueDisponivel").modal('open');
                    }
//                resultQuantidade = dados.qtdDisponivel - qtdSolicitada;
                }
            });
        });
    }

    function compararQtdSolicitadaComQtdDisponivelToUpdate(id, qtdSolicitada) {
        $.ajax({
            url: controllerToAdmin,
            type: 'POST',
            async: false,
            data: {
                action: 'EquipamentoLogica.verifyQtdSolicitadaByIdEquipamento',
                idEquipamento: id
            }, success: function (data, textStatus, jqXHR) {
                dados = $.parseJSON(data);
                if (parseInt(qtdSolicitada) <= parseInt(dados.qtdDisponivel)) {
//                        console.log(dados.qtdDisponivel);
                    $(".buttonOkay").prop("disabled", false);
                    $(".buttonOkay").css("cursor", "pointer");
                    $(".buttonUpdateMaterial").prop("disabled", false);
                    $(".buttonUpdateMaterial").css("cursor", "pointer");
                } else if (qtdSolicitada == "") {
                    // Nulo
                } else {
                    $(".buttonOkay").prop("disabled", true);
                    $(".buttonOkay").css("cursor", "not-allowed");
                    $(".buttonUpdateMaterial").prop("disabled", true);
                    $(".buttonUpdateMaterial").css("cursor", "not-allowed");
                    $("#modalQuantidadeSolicitadaMaiorQueDisponivel").modal();
                    $("#modalQuantidadeSolicitadaMaiorQueDisponivel").modal('open');
                }
//                resultQuantidade = dados.qtdDisponivel - qtdSolicitada;
            }
        });
    }

    function getQtdSolicitadaAndUpdateQtdDisponivel() {
        $(".txt-quantidade-solicitada:enabled").each(function () {
            var valorId = $(this).attr("id");
            var valorQtdSolicitada = $(this).val();
            var idEquipamento = valorId.substr(5, valorId.length - 5);
            var novaQuantidade = getQtdDisponivel(idEquipamento, valorQtdSolicitada);
            $.ajax({
                url: controllerToAdmin,
                type: 'POST',
                data: {
                    action: 'EquipamentoLogica.updateQtdDisponivelByIdEquipamento',
                    idEquipamento: idEquipamento,
                    valorAtual: novaQuantidade
                }, success: function (data, textStatus, jqXHR) {
                    console.log("Deu certo");
                }
            });
        });
    }

    function getQtdSolicitadaAndUpdateQtdDisponivelToUpdate() {
        var valorQtdSolicitada = $(".quantidadeSolicitada").val();
        var idEquipamento = $("#sel-equipamentos").val();
        var novaQuantidade = getQtdDisponivel(idEquipamento, valorQtdSolicitada);
        $.ajax({
            url: controllerToAdmin,
            type: 'POST',
            data: {
                action: 'EquipamentoLogica.updateQtdDisponivelByIdEquipamento',
                idEquipamento: idEquipamento,
                valorAtual: novaQuantidade
            }, success: function (data, textStatus, jqXHR) {
                console.log("Deu certo");
            }
        });
    }

    function getQtdDisponivel(idEquipamento, valorQtdSolicitada) {
        var novaQuantidade;
        $.ajax({
            url: controllerToAdmin,
            type: 'POST',
            async: false,
            data: {
                action: 'EquipamentoLogica.verifyQtdSolicitadaByIdEquipamento',
                idEquipamento: idEquipamento
            }, success: function (data, textStatus, jqXHR) {
                dados = $.parseJSON(data);
                novaQuantidade = parseInt(dados.qtdDisponivel) - parseInt(valorQtdSolicitada);
            }
        });
        return novaQuantidade;
    }

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

    function dataEquipamentoMenorQueDataEvento() {
        $(".txt-data-inicial").change(function () {
            var valorDataEquipamento = $(this).val();
            var valorId = $(this).attr('id');
            var valorDataInicio = $("#formDataInicio").val();
            var valorDataFim = $("#formDataFim").val();
            if (compararData(valorDataEquipamento, valorDataInicio, valorDataFim)) {
                var $input = $('.txt-data-inicial').pickadate();
                var picker = $input.pickadate('picker');
                picker.close();
                $("#modalDataEquiSerRef").modal();
                $("#modalDataEquiSerRef").modal('open');
                $(".txt-data-inicial#" + valorId).val(valorDataInicio);
            }
        });

        $(".txt-hora-inicial").change(function () {
            var valorDataInicio = $("#formDataInicio").val();
            var valorDataFim = $("#formDataFim").val();
            var valorHoraEquipamento = $(this).val();
            var valorId = $(this).attr('id');
            var valorHoraInicio = $("#formHoraInicio").val();
            var valorHoraFim = $("#formHoraFim").val();
            var valorDataEquipamento = $(".txt-data-inicial#" + valorId).val();
            if (compararHora(valorHoraEquipamento, valorHoraInicio, valorHoraFim, valorDataEquipamento, valorDataInicio, valorDataFim)) {
                var $input = $('.txt-hora-inicial').pickadate();
                var picker = $input.pickadate('picker');
                picker.close();
                $("#modalDataEquiSerRef").modal();
                $("#modalDataEquiSerRef").modal('open');
                $(".txt-hora-inicial").val(valorHoraInicio);
            }
        });
        $(".txt-data-final").change(function () {
            var valorDataEquipamento = $(this).val();
            var valorId = $(this).attr('id');
            var valorDataInicio = $("#formDataInicio").val();
            var valorDataFim = $("#formDataFim").val();
            var valorDataInicioSelecionado = $(".txt-data-inicial#" + valorId).val();
            if (compararDataMenorQueInicio(valorDataEquipamento, valorDataInicioSelecionado)) {
                $("#modalDataInicioMaiorQueFinal").modal();
                $("#modalDataInicioMaiorQueFinal").modal('open');
                $(this).val(valorDataFim);
            } else {
                if (compararData(valorDataEquipamento, valorDataInicio, valorDataFim)) {
                    var $input = $('.txt-data-final').pickadate();
                    var picker = $input.pickadate('picker');
                    picker.close();
                    $("#modalDataEquiSerRef").modal();
                    $("#modalDataEquiSerRef").modal('open');
                    $(".txt-data-final").val(valorDataFim);
                }
            }

        });
        $(".txt-hora-final").change(function () {
            var valorDataInicio = $("#formDataInicio").val();
            var valorDataFim = $("#formDataFim").val();
            var valorHoraEquipamento = $(this).val();
            var valorId = $(this).attr('id');
            var valorHoraInicio = $("#formHoraInicio").val();
            var valorHoraFim = $("#formHoraFim").val();
            var valorDataEquipamento = $(".txt-data-final#" + valorId).val();
            if (compararHora(valorHoraEquipamento, valorHoraInicio, valorHoraFim, valorDataEquipamento, valorDataInicio, valorDataFim)) {
                var $input = $('.txt-hora-final').pickadate();
                var picker = $input.pickadate('picker');
                picker.close();
                $("#modalDataEquiSerRef").modal();
                $("#modalDataEquiSerRef").modal('open');
                $(".txt-hora-final").val(valorHoraFim);
            }
        });
    }

    function dataEquipamentoMenorQueDataEventoToUpdate() {
        $("#formAddMaterialEvent .dataInicio").change(function () {
            var valorDataEquipamento = $(this).val();
            var valorDataInicio = $("#form_upd_event .dataInicio").val();
            var valorDataFim = $("#form_upd_event .dataFim").val();
            if (compararData(valorDataEquipamento, valorDataInicio, valorDataFim)) {
                var $input = $('#formAddMaterialEvent .dataInicio').pickadate();
                var picker = $input.pickadate('picker');
                picker.close();
                $("#modalDataEquiSerRef").modal();
                $("#modalDataEquiSerRef").modal('open');
                $("#formAddMaterialEvent .dataInicio").val(valorDataInicio);
            }
        });

        $("#formAddMaterialEvent .horaInicio").change(function () {
            var valorDataInicio = $("#form_upd_event .dataInicio").val();
            var valorDataFim = $("#form_upd_event .dataFim").val();
            var valorHoraEquipamento = $(this).val();
            var valorId = $(this).attr('id');
            var valorHoraInicio = $("#form_upd_event .horaInicio").val();
            var valorHoraFim = $("#form_upd_event .horaFim").val();
            var valorDataEquipamento = $("#formAddMaterialEvent .dataInicio").val();
            if (valorDataEquipamento == "") {
                valorDataEquipamento = valorDataInicio;
                $("#formAddMaterialEvent .dataInicio").val(valorDataInicio);
            }
            if (compararHora(valorHoraEquipamento, valorHoraInicio, valorHoraFim, valorDataEquipamento, valorDataInicio, valorDataFim)) {
                var $input = $('#formAddMaterialEvent .horaInicio').pickadate();
                var picker = $input.pickadate('picker');
                picker.close();
                $("#modalDataEquiSerRef").modal();
                $("#modalDataEquiSerRef").modal('open');
                $("#formAddMaterialEvent .horaInicio").val(valorHoraInicio);
            }
        });
        $("#formAddMaterialEvent .dataFim").change(function () {
            var valorDataEquipamento = $(this).val();
            var valorId = $(this).attr('id');
            var valorDataInicio = $("#form_upd_event .dataInicio").val();
            var valorDataFim = $("#form_upd_event .dataFim").val();
            var valorDataInicioSelecionado = $("#formAddMaterialEvent .dataInicio").val();
            if (compararDataMenorQueInicio(valorDataEquipamento, valorDataInicioSelecionado)) {
                $("#modalDataInicioMaiorQueFinal").modal();
                $("#modalDataInicioMaiorQueFinal").modal('open');
                $(this).val(valorDataFim);
            } else {
                if (compararData(valorDataEquipamento, valorDataInicio, valorDataFim)) {
                    var $input = $('#formAddMaterialEvent .dataFim').pickadate();
                    var picker = $input.pickadate('picker');
                    picker.close();
                    $("#modalDataEquiSerRef").modal();
                    $("#modalDataEquiSerRef").modal('open');
                    $("#formAddMaterialEvent .dataFim").val(valorDataFim);
                }
            }

        });
        $("#formAddMaterialEvent .horaFim").change(function () {
            var valorDataInicio = $("#form_upd_event .dataInicio").val();
            var valorDataFim = $("#form_upd_event .dataFim").val();
            var valorHoraEquipamento = $(this).val();
            var valorId = $(this).attr('id');
            var valorHoraInicio = $("#form_upd_event .horaInicio").val();
            var valorHoraFim = $("#form_upd_event .horaFim").val();
            var valorDataEquipamento = $("#formAddMaterialEvent .dataInicio").val();
            if (valorDataEquipamento == "") {
                valorDataEquipamento = valorDataInicio;
                $("#formAddMaterialEvent .dataInicio").val(valorDataInicio);
            }
            if (compararHora(valorHoraEquipamento, valorHoraInicio, valorHoraFim, valorDataEquipamento, valorDataInicio, valorDataFim)) {
                var $input = $('#formAddMaterialEvent .horaFim').pickadate();
                var picker = $input.pickadate('picker');
                picker.close();
                $("#modalDataEquiSerRef").modal();
                $("#modalDataEquiSerRef").modal('open');
                $("#formAddMaterialEvent .horaFim").val(valorHoraFim);
            }
        });
    }

    function dataRefeicaoMenorQueDataEvento() {
        $(".txt-data-inicial-refeicao").change(function () {
            var valorDataRefeicao = $(this).val();
            var valorId = $(this).attr('id');
            var valorDataInicio = $("#formDataInicio").val();
            var valorDataFim = $("#formDataFim").val();
            if (compararData(valorDataRefeicao, valorDataInicio, valorDataFim)) {
                var $input = $('.txt-data-inicial-refeicao').pickadate();
                var picker = $input.pickadate('picker');
                picker.close();
                $("#modalDataEquiSerRef").modal();
                $("#modalDataEquiSerRef").modal('open');
                $(".txt-data-inicial-refeicao#" + valorId).val(valorDataInicio);
            }
        });

        $(".txt-hora-inicial-refeicao").change(function () {
            var valorDataInicio = $("#formDataInicio").val();
            var valorDataFim = $("#formDataFim").val();
            var valorHoraRefeicao = $(this).val();
            var valorId = $(this).attr('id');
            var valorHoraInicio = $("#formHoraInicio").val();
            var valorHoraFim = $("#formHoraFim").val();
            var valorDataServico = $(".txt-data-inicial-servico#" + valorId).val();
            if (compararHora(valorHoraRefeicao, valorHoraInicio, valorHoraFim, valorDataServico, valorDataInicio, valorDataFim)) {
                var $input = $('.txt-hora-inicial-refeicao').pickadate();
                var picker = $input.pickadate('picker');
                picker.close();
                $("#modalDataEquiSerRef").modal();
                $("#modalDataEquiSerRef").modal('open');
                $(".txt-hora-inicial-refeicao#" + valorId).val(valorHoraInicio);
            }
        });

        $(".txt-data-final-refeicao").change(function () {
            var valorDataRefeicao = $(this).val();
            var valorId = $(this).attr('id');
            var valorDataInicio = $("#formDataInicio").val();
            var valorDataFim = $("#formDataFim").val();
            var valorDataInicioSelecionado = $(".txt-data-inicial-refeicao#" + valorId).val();
            if (compararDataMenorQueInicio(valorDataRefeicao, valorDataInicioSelecionado)) {
                $("#modalDataInicioMaiorQueFinal").modal();
                $("#modalDataInicioMaiorQueFinal").modal('open');
                $(this).val(valorDataFim);
            } else {
                if (compararData(valorDataRefeicao, valorDataInicio, valorDataFim)) {
                    var $input = $('.txt-data-final-refeicao').pickadate();
                    var picker = $input.pickadate('picker');
                    picker.close();
                    $("#modalDataEquiSerRef").modal();
                    $("#modalDataEquiSerRef").modal('open');
                    $(".txt-data-final-refeicao#" + valorId).val(valorDataFim);
                }
            }
        });

        $(".txt-hora-final-refeicao").change(function () {
            var valorDataInicio = $("#formDataInicio").val();
            var valorDataFim = $("#formDataFim").val();
            var valorHoraRefeicao = $(this).val();
            var valorId = $(this).attr('id');
            var valorHoraInicio = $("#formHoraInicio").val();
            var valorHoraFim = $("#formHoraFim").val();
            var valorDataServico = $(".txt-data-final-servico#" + valorId).val();
            if (compararHora(valorHoraRefeicao, valorHoraInicio, valorHoraFim, valorDataServico, valorDataInicio, valorDataFim)) {
                var $input = $('.txt-hora-final-refeicao').pickadate();
                var picker = $input.pickadate('picker');
                picker.close();
                $("#modalDataEquiSerRef").modal();
                $("#modalDataEquiSerRef").modal('open');
                $(".txt-hora-final-refeicao#" + valorId).val(valorHoraFim);
            }
        });
    }

    function compararHora(valorHoraEquipamento, valorHoraInicio, valorHoraFim, valorDataEscolhida, valorDataInicio, valorDataFim) {
        valorHoraEquipamento = valorHoraEquipamento.split(":");
        valorHoraInicio = valorHoraInicio.split(":");
        valorHoraFim = valorHoraFim.split(":");
        var anoInicioEscolhido = valorDataEscolhida.substr(6, 4);
        var mesInicioEscolhido = valorDataEscolhida.substr(3, 2);
        var diaInicioEscolhido = valorDataEscolhida.substr(0, 2);
        var anoInicio = valorDataInicio.substr(6, 4);
        var mesInicio = valorDataInicio.substr(3, 2);
        var diaInicio = valorDataInicio.substr(0, 2);
        var anoFim = valorDataFim.substr(6, 4);
        var mesFim = valorDataFim.substr(3, 2);
        var diaFim = valorDataFim.substr(0, 2);
        var d = new Date();
        var data1 = new Date(anoInicioEscolhido, mesInicioEscolhido, diaInicioEscolhido, valorHoraEquipamento[0], valorHoraEquipamento[1]);
        var data2 = new Date(anoInicio, mesInicio, diaInicio, valorHoraInicio[0], valorHoraInicio[1]);
        var data3 = new Date(anoFim, mesFim, diaFim, valorHoraFim[0], valorHoraFim[1]);
        if ((data1 < data2) || (data1 > data3)) {
            return true;
        } else {
            return false;
        }
    }

    function compararData(valorDataEscolhida, valorDataInicio, valorDataFim) {
        var anoInicioEscolhido = valorDataEscolhida.substr(6, 4);
        var mesInicioEscolhido = valorDataEscolhida.substr(3, 2);
        var diaInicioEscolhido = valorDataEscolhida.substr(0, 2);
        var anoInicio = valorDataInicio.substr(6, 4);
        var mesInicio = valorDataInicio.substr(3, 2);
        var diaInicio = valorDataInicio.substr(0, 2);
        var anoFim = valorDataFim.substr(6, 4);
        var mesFim = valorDataFim.substr(3, 2);
        var diaFim = valorDataFim.substr(0, 2);
        var d = new Date();
        var data1 = new Date(anoInicioEscolhido, mesInicioEscolhido, diaInicioEscolhido);
        var data2 = new Date(anoInicio, mesInicio, diaInicio);
        var data3 = new Date(anoFim, mesFim, diaFim);
        if ((data1 < data2) || (data1 > data3)) {
            return true;
        } else {
            return false;
        }
    }

    function compararDataMenorQueInicio(valorDataEscolhida, valorDataInicio) {
        var anoInicioEscolhido = valorDataEscolhida.substr(6, 4);
        var mesInicioEscolhido = valorDataEscolhida.substr(3, 2);
        var diaInicioEscolhido = valorDataEscolhida.substr(0, 2);
        var anoInicio = valorDataInicio.substr(6, 4);
        var mesInicio = valorDataInicio.substr(3, 2);
        var diaInicio = valorDataInicio.substr(0, 2);
        var d = new Date();
        var data1 = new Date(anoInicioEscolhido, mesInicioEscolhido, diaInicioEscolhido);
        var data2 = new Date(anoInicio, mesInicio, diaInicio);
        if ((data1 <= data2)) {
            return true;
        } else {
            return false;
        }
    }

    function compararDataInicioFim(valorDataInicio, valorDataFim, valorHoraInicio, valorHoraFim) {
        var arrayValorHoraInicio = valorHoraInicio.split(":");
        var arrayValorHoraFim = valorHoraFim.split(":");
        var anoInicio = valorDataInicio.substr(6, 4);
        var mesInicio = valorDataInicio.substr(3, 2);
        var diaInicio = valorDataInicio.substr(0, 2);
        var anoFim = valorDataFim.substr(6, 4);
        var mesFim = valorDataFim.substr(3, 2);
        var diaFim = valorDataFim.substr(0, 2);
        var d = new Date();
        var data1 = new Date(anoInicio, mesInicio, diaInicio, arrayValorHoraInicio[0], arrayValorHoraInicio[1]);
        var data2 = new Date(anoFim, mesFim, diaFim, arrayValorHoraFim[0], arrayValorHoraFim[1]);
        if ((data1 <= data2)) {
            return true;
        } else {
            return false;
        }
    }


    $(".nomeEvento").keyup(function () {
        $(this).val($(this).val().replace(/\^|#|\?|,|\*|\.|\-|\%|\@|\¨|\&|\(|\)|\=|\+|\$|\!|\'|\"|\;|\/|\\|\]|\[|\{|\}|\||\§|\ª|\º|\°|\£|\¢|\¬|\_|\>|\<|/g, ""));
    });

    $(".solicitante").keyup(function () {
        $(this).val($(this).val().replace(/\^|#|\?|,|\*|\.|\-|\%|\@|\¨|\&|\(|\)|\=|\+|\$|\!|\'|\"|\;|\\|\]|\[|\{|\}|\||\§|\ª|\º|\°|\£|\¢|\¬|\_|/g, ""));
    });

    $(".descricaoEvento").keyup(function () {
        $(this).val($(this).val().replace(/\^|#|\?|\*|\%|\@|\¨|\&|\=|\+|\$|\!|\;|\]|\[|\{|\}|\||\§|\ª|\º|\°|\£|\¢|\¬|\_|/g, ""));
    });

    $(".buttonCadastroMaterial").click(function () {
        var valorEquipamento = $("#sel-equipamentos").val();
        var quantidadeSolicitada = $(".quantidadeSolicitada").val();
        var dataInicio = $("#formAddMaterialEvent .dataInicio").val();
        var horaInicio = $("#formAddMaterialEvent .horaInicio").val();
        var dataFim = $("#formAddMaterialEvent .dataFim").val();
        var horaFim = $("#formAddMaterialEvent .horaFim").val();
        var contadorInput = 0;
        $("#formAddMaterialEvent input:enabled").each(function () {
            if ($(this).val() == "") {
                contadorInput++;
            }
        });
        if (contadorInput == 0 && valorEquipamento != null) {
            var inicio = dataInicio.substr(6, 4) + "-" + dataInicio.substr(3, 2) + "-" + dataInicio.substr(0, 2) + " " + horaInicio;
            var fim = dataFim.substr(6, 4) + "-" + dataFim.substr(3, 2) + "-" + dataFim.substr(0, 2) + " " + horaFim;
            getQtdSolicitadaAndUpdateQtdDisponivelToUpdate();
            $.ajax({
                url: controllerToAdmin,
                type: 'POST',
                async: false,
                data: {
                    action: 'EventoLogica.insertInTabelEventEquipamentUsed',
                    valorIdEvento: idEventoToUpdate,
                    idEquipamento: valorEquipamento,
                    qtdEquipamento: quantidadeSolicitada,
                    dataInicio: inicio,
                    dataFim: fim
                }, success: function (data, textStatus, jqXHR) {
                    $("#modalAdicionarAtualizarMaterial").modal();
                    $("#modalAdicionarAtualizarMaterial").modal('close');
                    getEquipamentosByIdEvento(idEventoToUpdate);
                }
            });
        } else {
            $("#modalCamposNulos").modal();
            $("#modalCamposNulos").modal('open');
        }
    });

    $(".buttonUpdateMaterial").click(function () {
        var quantidadeSolicitada = $("#formAddMaterialEvent .quantidadeSolicitada").val();
        var dataInicio = $("#formAddMaterialEvent .dataInicio").val();
        var horaInicio = $("#formAddMaterialEvent .horaInicio").val();
        var dataFim = $("#formAddMaterialEvent .dataFim").val();
        var horaFim = $("#formAddMaterialEvent .horaFim").val();
        var contadorInput = 0;
        $("#formAddMaterialEvent input:enabled").each(function () {
            if ($(this).val() == "") {
                contadorInput++;
            }
        });
        if (contadorInput == 0) {
            var inicio = dataInicio.substr(6, 4) + "-" + dataInicio.substr(3, 2) + "-" + dataInicio.substr(0, 2) + " " + horaInicio;
            var fim = dataFim.substr(6, 4) + "-" + dataFim.substr(3, 2) + "-" + dataFim.substr(0, 2) + " " + horaFim;
            getQtdSolicitadaAndUpdateQtdDisponivelToUpdate();
            $.ajax({
                url: controllerToAdmin,
                type: 'POST',
                data: {
                    action: "EventoEquipamentoUtilizadoLogica.updateMaterialByIdEventoUtilizado",
                    idTableEventoUtilizado: idTableEventoUtilizado,
                    quantidadeSolicitada: quantidadeSolicitada,
                    dataInicio: inicio,
                    dataFim: fim
                }, success: function (data, textStatus, jqXHR) {
                    $("#modalAdicionarAtualizarMaterial").modal();
                    $("#modalAdicionarAtualizarMaterial").modal('close');
                    getEquipamentosByIdEvento(idEventoToUpdate);
                    updateEventById(idEventoToUpdate);
                }
            });
        } else {
            $("#modalCamposNulos").modal();
            $("#modalCamposNulos").modal("open");
        }
    });

    $(".buttonCadastroServico").click(function () {
        var valorServico = $("#sel-servicos").val();
        var dataInicio = $("#formAddServicoEvent .dataInicio").val();
        var horaInicio = $("#formAddServicoEvent .horaInicio").val();
        var dataFim = $("#formAddServicoEvent .dataFim").val();
        var horaFim = $("#formAddServicoEvent .horaFim").val();
        var contadorInput = 0;
        $("#formAddServicoEvent input:enabled").each(function () {
            if ($(this).val() == "") {
                contadorInput++;
            }
        });
        if (compararDataInicioFim(dataInicio, dataFim, horaInicio, horaFim)) {
            if (contadorInput == 0 && valorServico != null) {
                var inicio = dataInicio.substr(6, 4) + "-" + dataInicio.substr(3, 2) + "-" + dataInicio.substr(0, 2) + " " + horaInicio;
                var fim = dataFim.substr(6, 4) + "-" + dataFim.substr(3, 2) + "-" + dataFim.substr(0, 2) + " " + horaFim;
                $.ajax({
                    url: controllerToAdmin,
                    type: 'POST',
                    async: false,
                    data: {
                        action: 'EventoLogica.insertInTabelEventServiceUsed',
                        valorIdEvento: idEventoToUpdate,
                        idServico: valorServico,
                        dataInicio: inicio,
                        dataFim: fim
                    }, success: function (data, textStatus, jqXHR) {
                        $("#modalAdicionarAtualizarServico").modal();
                        $("#modalAdicionarAtualizarServico").modal('close');
                        getServicosByIdEvento(idEventoToUpdate);
                    }
                });
            } else {
                $("#modalCamposNulos").modal();
                $("#modalCamposNulos").modal('open');
            }
        } else {
            console.log("vacilou");
        }

    });

    $(".buttonUpdateServico").click(function () {
        var valorServico = $("#sel-servicos").val();
        var dataInicio = $("#formAddServicoEvent .dataInicio").val();
        var horaInicio = $("#formAddServicoEvent .horaInicio").val();
        var dataFim = $("#formAddServicoEvent .dataFim").val();
        var horaFim = $("#formAddServicoEvent .horaFim").val();
        var contadorInput = 0;
        $("#formAddServicoEvent input:enabled").each(function () {
            if ($(this).val() == "") {
                contadorInput++;
            }
        });
        if (compararDataInicioFim(dataInicio, dataFim, horaInicio, horaFim)) {
            if (contadorInput == 0 && valorServico != null) {
                var inicio = dataInicio.substr(6, 4) + "-" + dataInicio.substr(3, 2) + "-" + dataInicio.substr(0, 2) + " " + horaInicio;
                var fim = dataFim.substr(6, 4) + "-" + dataFim.substr(3, 2) + "-" + dataFim.substr(0, 2) + " " + horaFim;
                $.ajax({
                    url: controllerToAdmin,
                    type: 'POST',
                    async: false,
                    data: {
                        action: "EventoServicoUtilizadoLogica.updateServicoByIdEventoUtilizado",
                        idTableEventoUtilizado: idTableEventoUtilizado,
                        dataInicio: inicio,
                        dataFim: fim
                    }, success: function (data, textStatus, jqXHR) {
                        $("#modalAdicionarAtualizarServico").modal();
                        $("#modalAdicionarAtualizarServico").modal('close');
                        getServicosByIdEvento(idEventoToUpdate);
                    }
                });
            } else {
                $("#modalCamposNulos").modal();
                $("#modalCamposNulos").modal('open');
            }
        } else {
            console.log("Vacilou");
        }

    });

    $(".buttonCadastroRefeicao").click(function () {
        var valorRefeicao = $("#sel-refeicoes").val();
        var dataInicio = $("#formAddRefeicaoEvent .dataInicio").val();
        var horaInicio = $("#formAddRefeicaoEvent .horaInicio").val();
        var dataFim = $("#formAddRefeicaoEvent .dataFim").val();
        var horaFim = $("#formAddRefeicaoEvent .horaFim").val();
        var qtdPessoasRefeicao = $("#formAddRefeicaoEvent .qtdPessoasRefeicao").val();
        var contadorInput = 0;
        $("#formAddRefeicaoEvent input:enabled").each(function () {
            if ($(this).val() == "") {
                contadorInput++;
            }
        });
        if (compararDataInicioFim(dataInicio, dataFim, horaInicio, horaFim)) {
            if (contadorInput == 0 && valorRefeicao != null) {
                var inicio = dataInicio.substr(6, 4) + "-" + dataInicio.substr(3, 2) + "-" + dataInicio.substr(0, 2) + " " + horaInicio;
                var fim = dataFim.substr(6, 4) + "-" + dataFim.substr(3, 2) + "-" + dataFim.substr(0, 2) + " " + horaFim;
                $.ajax({
                    url: controllerToAdmin,
                    type: 'POST',
                    async: false,
                    data: {
                        action: 'EventoLogica.insertInTabelEventRefeicaoUsed',
                        valorIdEvento: idEventoToUpdate,
                        qtdRefeicao: qtdPessoasRefeicao,
                        idRefeicao: valorRefeicao,
                        dataInicio: inicio,
                        dataFim: fim
                    }, success: function (data, textStatus, jqXHR) {
                        $("#modalAdicionarAtualizarRefeicao").modal();
                        $("#modalAdicionarAtualizarRefeicao").modal('close');
                        getRefeicoesByIdEvento(idEventoToUpdate);
                    }
                });
            } else {
                $("#modalCamposNulos").modal();
                $("#modalCamposNulos").modal('open');
            }
        } else {
            console.log("vacilou");
        }

    });

    $(".buttonUpdateRefeicao").click(function () {
        var valorRefeicao = $("#sel-refeicoes").val();
        var dataInicio = $("#formAddRefeicaoEvent .dataInicio").val();
        var horaInicio = $("#formAddRefeicaoEvent .horaInicio").val();
        var dataFim = $("#formAddRefeicaoEvent .dataFim").val();
        var horaFim = $("#formAddRefeicaoEvent .horaFim").val();
        var qtdPessoasRefeicao = $("#formAddRefeicaoEvent .qtdPessoasRefeicao").val();
        var contadorInput = 0;
        $("#formAddRefeicaoEvent input:enabled").each(function () {
            if ($(this).val() == "") {
                contadorInput++;
            }
        });
        if (compararDataInicioFim(dataInicio, dataFim, horaInicio, horaFim)) {
            if (contadorInput == 0 && valorRefeicao != null) {
                var inicio = dataInicio.substr(6, 4) + "-" + dataInicio.substr(3, 2) + "-" + dataInicio.substr(0, 2) + " " + horaInicio;
                var fim = dataFim.substr(6, 4) + "-" + dataFim.substr(3, 2) + "-" + dataFim.substr(0, 2) + " " + horaFim;
                $.ajax({
                    url: controllerToAdmin,
                    type: 'POST',
                    async: false,
                    data: {
                        action: "EventoRefeicaoUtilizadoLogica.updateRefeicaoByIdEventoUtilizado",
                        idTableEventoUtilizado: idTableEventoUtilizado,
                        qtdPessoasRefeicao: qtdPessoasRefeicao,
                        dataInicio: inicio,
                        dataFim: fim
                    }, success: function (data, textStatus, jqXHR) {
                        $("#modalAdicionarAtualizarRefeicao").modal();
                        $("#modalAdicionarAtualizarRefeicao").modal('close');
                        getRefeicoesByIdEvento(idEventoToUpdate);
                    }
                });
            } else {
                $("#modalCamposNulos").modal();
                $("#modalCamposNulos").modal('open');
            }
        } else {
            console.log("Vacilou");
        }

    });

    $(".logout").click(function () {
        $(".textExclusao").html("Você deseja realmente sair da aplicação?");
        $("#dialog-confirm").dialog({
            show: {
                effect: 'fade',
                duration: 200 //at your convenience
            },
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Sim": function () {
                    $(this).dialog("close");
                    logout();
                },
                Não: function () {
                    $(this).dialog("close");
                }
            }
        });
    });

    function logout() {
        $.ajax({
            url: controllerToAdmin,
            type: 'POST',
            data: {
                action: 'UsuarioLogica.logout'
            }, success: function (data, textStatus, jqXHR) {
                window.location = '../index.php';
            }
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