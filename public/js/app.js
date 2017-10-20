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
    $(".divSelBloco").hide();
    $(".divSelAmbiente").hide();

    function getSetor() {
        $.ajax({
            url: controllerToAdmin,
            type: "POST",
            data: {
                action: "SetorLogica.getSetor"
            },
            success: function (data) {
                $(".sel-tipo-evento").html(data);
                $("select").material_select();
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
                $(".sel-tipo-evento").html(data);
                $(".sel-tipo-evento").material_select();
            }
        });
    }
    function calendarAdmin() {
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
            editable: true,
            eventLimit: true,
            dayClick: function (date, jsEvent, view) {
                console.log("Clicou no dia: " + date.format());
            },
            select: function (start, end) {
                start = $.fullCalendar.formatDate(start, "YYYY-MM-DD HH:mm:ss");
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
                    complete: function teste() {
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
                    $(".modal").modal('close');
                    title = $("#opiniao").val();
                    if (title != "") {
                        eventData = {
                            title: title,
                            start: start,
                            end: end
                        };
                        $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
                        var teste = $(".active_repeat").attr("id");
                        $(".repeatSwitch").removeClass(".active_repeat");
                        start = null;
                        end = null;
                    }
                });
                $(".buttonCancel").click(function () {
                    $(".modal").modal('close');
                    start = null;
                    end = null;
                });
                $("#opiniao").val("");
                $('#calendar').fullCalendar('unselect');
            },
            allDayText: 'Dia Inteiro',
            minTime: '07:00:00',
            maxTime: '20:30:00',
            slotDuration: '00:30:00',
            slotLabelInterval: 30,
            slotLabelFormat: 'HH:mm',
            slotMinutes: 30,

//        events: [
//            {
//                title: 'All Day Event',
//                start: '2017-09-01'
//            }
//        ],
            eventRender: function (event, eventElement) {
//            var new_description =
//                    moment(event.start).format("HH:mm") + '-'
//                    + moment(event.end).format("HH:mm") + '<br/>'
//                    + event.customer + '<br/>'
//                    + '<strong>Address: </strong><br/>' + event.address + '<br/>'
//                    + '<strong>Task: </strong><br/>' + event.task + '<br/>'
//                    + '<strong>Place: </strong>' + event.place + '<br/>';

            },
            defaultView: "agendaWeek"
        });
    }

    function calendarUser() {
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
            editable: true,
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
            slotMinutes: 30
//        events: [
//            {
//                title: 'All Day Event',
//                start: '2017-09-01'
//            }
//        ],
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
    $(".fc-axis.fc-widget-header").append("<a href='#'>IFCE</a>");
    $("select[name=escolhaAula]").change(function () {
        var valorSelect = $(this).val();
        if (valorSelect == 2) {
            $(".DivInputProfessor").hide(1000);
        } else {
            $(".DivInputProfessor").show(1000);
        }
    });
    $(".openModalAdicionarEvento").click(function () {
        $("#modalAdicionarEventoClickDay").modal();
        $("#modalAdicionarEventoClickDay").modal('open');
        $(".dataInicio").removeAttr("disabled");
        $(".dataFim").removeAttr("disabled");
        $(".horaInicio").removeAttr("disabled");
        $(".horaFim").removeAttr("disabled");
        $(".mostrarWhenClickBtn").removeClass("cadastroClickBtn");
    });

    function getBlocoBySetorPageUser() {
        $(".sel-tipo-evento").change(function () {
            var valorTipoEvento = $(this).val();
            $.ajax({
                url: controllerToUser,
                type: "POST",
                data: {
                    action: "BlocoLogica.getBlocoBySetor",
                    valorTipoEvento: valorTipoEvento
                },
                success: function (data) {
                    $("#sel-bloco").empty();
                    $("#sel-bloco").append(data);
                    $("#sel-bloco").material_select();
                    $(".divSelBloco").show();
                    $(".divSelAmbiente").hide();
                }
            });
        });
    }

    function getBlocoBySetor() {
        $(".sel-tipo-evento").change(function () {
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
                    $(".divSelBloco").show();
                    $(".divSelAmbiente").hide();
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
    }

    function getAmbienteByBlocoPageUser() {
        $(".sel-bloco").change(function () {
            var valorBloco = $(this).val();
            $.ajax({
                url: controllerToUser,
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
    }
    if (pagina == "admin") {
        $('ul.tabs').tabs();
        $("#nao").addClass("active_repeat");
        getSetor();
        calendarAdmin();
        pickDataInicio();
        pickDataFim();
        pickHoraInicio();
        pickHoraFim();
        getBlocoBySetor();
        getAmbienteByBloco();
    } else {
        getSetorPageUser();
        calendarUser();
        pickDataInicio();
        pickDataFim();
        pickHoraInicio();
        pickHoraFim();
        getBlocoBySetorPageUser();
        getAmbienteByBlocoPageUser();
    }

});