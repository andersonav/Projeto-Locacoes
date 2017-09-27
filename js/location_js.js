/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* 
 Created on : 14/09/2017, 13:58:42
 Author     : andersonalves
 */
$(document).ready(function () {
    $("select").material_select();
    $('ul.tabs').tabs();
    $("#nao").addClass("active_repeat");
    $(".openModalAdicionarEvento").click(function () {
        $("#modalAdicionarEventoClickDay").modal();
        $("#modalAdicionarEventoClickDay").modal('open');
        $(".mostrarWhenClickBtn").removeClass("cadastroClickBtn");
//        $(".calendar2").removeClass("cadastroClickBtn");
//        $('#calendar2').fullCalendar({
//            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro',
//                'Outubro', 'Novembro', 'Dezembro'],
//            monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Aug', 'Set', 'Out', 'Nov', 'Dez'],
//            dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
//            dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
//            lang: 'pt-br',
//            locale: 'pt-br',
//            timeFormat: 'HH:mm',
//            buttonText: {
//                today: 'Hoje',
//                month: 'Mês',
//                week: 'Semana',
//                day: 'Dia'
//            },
//            header: {
//                left: 'prev,next today',
//                center: 'title',
//                right: 'agendaWeek'
//            },
//            navLinks: true,
//            selectable: true,
//            selectHelper: true,
//            editable: true,
//            eventLimit: true,
//            dayClick: function (date, jsEvent, view) {
//                console.log("Clicou no dia: " + date.format());
//            },
//            select: function (start, end) {
////            start = $.fullCalendar.formatDate(start, "YYYY-MM-DD HH:mm:ss");
////            end = $.fullCalendar.formatDate(end, "YYYY-MM-DD HH:mm:ss");
//                $('#modalAdicionarEventoClickDay').modal();
//                $(".dataInicio").val(start);
//                $(".dataFim").val(end);
//                $("#modalAdicionarEventoClickDay").modal({
//                    complete: function teste() {
//                        start = null;
//                        end = null;
//                    }
//                });
//                var title;
//                $("#modalAdicionarEventoClickDay").modal('open');
//                $(".mostrarWhenClickBtn").addClass("cadastroClickBtn");
//                var eventData;
//                $(".buttonOkay").click(function () {
//                    $(".modal").modal('close');
//                    title = $("#opiniao").val();
//                    if (title != "") {
//                        eventData = {
//                            title: title,
//                            start: start,
//                            end: end
//                        };
//                        $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
//                        var teste = $(".active_repeat").attr("id");
//                        $(".repeatSwitch").removeClass(".active_repeat");
//                        start = null;
//                        end = null;
//                    }
//                });
//                $(".buttonCancel").click(function () {
//                    $(".modal").modal('close');
//                    start = null;
//                    end = null;
//                });
//                $("#opiniao").val("");
//                $('#calendar').fullCalendar('unselect');
//            },
//            allDayText: 'Dia Inteiro',
//            minTime: '07:00:00',
//            maxTime: '20:30:00',
//            slotDuration: '00:30:00',
//            slotLabelInterval: 30,
//            slotLabelFormat: 'HH:mm',
//            slotMinutes: 30,
//
////        events: [
////            {
////                title: 'All Day Event',
////                start: '2017-09-01'
////            }
////        ],
//            eventRender: function (event, eventElement) {
////                eventElement.find(".fc-axis").remove();
//                var titleIF = '<th class="fc-axis fc-widget-header" style="width: 79px;"></th><a href="teste.php">Teste</a>';
////            var new_description =
////                    moment(event.start).format("HH:mm") + '-'
////                    + moment(event.end).format("HH:mm") + '<br/>'
////                    + event.customer + '<br/>'
////                    + '<strong>Address: </strong><br/>' + event.address + '<br/>'
////                    + '<strong>Task: </strong><br/>' + event.task + '<br/>'
////                    + '<strong>Place: </strong>' + event.place + '<br/>';
//
//                eventElement.append(titleIF);
//            },
//            defaultView: 'agendaWeek'
//        });
    });
    $(".repeatSwitch").each(function () {
        $(this).on("click", function () {
            $(this).siblings().removeClass("active_repeat");
            $(this).addClass("active_repeat");
            console.log($(this).attr('id'));
        });
    });
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
//            start = $.fullCalendar.formatDate(start, "YYYY-MM-DD HH:mm:ss");
//            end = $.fullCalendar.formatDate(end, "YYYY-MM-DD HH:mm:ss");
            $('#modalAdicionarEventoClickDay').modal();
            $(".dataInicio").val(start);
            $(".dataFim").val(end);
            $("#modalAdicionarEventoClickDay").modal({
                complete: function teste() {
                    start = null;
                    end = null;
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
            eventElement.find(".fc-axis").remove();
            var titleIF = '<th class="fc-axis fc-widget-header" style="width: 79px;"></th><a href="teste.php">Teste</a>';
//            var new_description =
//                    moment(event.start).format("HH:mm") + '-'
//                    + moment(event.end).format("HH:mm") + '<br/>'
//                    + event.customer + '<br/>'
//                    + '<strong>Address: </strong><br/>' + event.address + '<br/>'
//                    + '<strong>Task: </strong><br/>' + event.task + '<br/>'
//                    + '<strong>Place: </strong>' + event.place + '<br/>';

            eventElement.append(titleIF);
        },
        defaultView: "agendaWeek"
    });


    $(".fc-axis.fc-widget-header").append("<a href='#'>IFCE</a>");
//    $(".fc-next-button").removeClass("fc-state-hover");
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
        // Dia possível de ser marcado
        onClose: function () {
            $(document.activeElement).blur();
        }
    });
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
        // Dia possível de ser marcado
        onClose: function () {
            $(document.activeElement).blur();
        }
    });
    $('.horaInicio').pickatime({
        default: 'now', // Set default time: 'now', '1:30AM', '16:30'
        fromnow: 0, // set default time to * milliseconds from now (using with default = 'now')
        twelvehour: false, // Use AM/PM or 24-hour format
        donetext: 'OK', // text for done-button
        cleartext: 'Clear', // text for clear-button
        canceltext: 'Cancel', // Text for cancel-button
        autoclose: false, // automatic close timepicker
        ampmclickable: true, // make AM PM clickable
        aftershow: function () {} //Function for after opening timepicker
    });
    $('.horaFim').pickatime({
        default: 'now', // Set default time: 'now', '1:30AM', '16:30'
        fromnow: 0, // set default time to * milliseconds from now (using with default = 'now')
        twelvehour: false, // Use AM/PM or 24-hour format
        donetext: 'OK', // text for done-button
        cleartext: 'Clear', // text for clear-button
        canceltext: 'Cancel', // Text for cancel-button
        autoclose: false, // automatic close timepicker
        ampmclickable: true, // make AM PM clickable
        aftershow: function () {} //Function for after opening timepicker
    });

    $("select[name=escolhaAula]").change(function () {
        var valorSelect = $(this).val();
        if (valorSelect == 2) {
            $(".DivInputProfessor").hide(1000);
        } else {
            $(".DivInputProfessor").show(1000);
        }
    });

});

