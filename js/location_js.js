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

    $('#calendar').fullCalendar({
        monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro',
            'Outubro', 'Novembro', 'Dezembro'],
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Aug', 'Set', 'Out', 'Nov', 'Dez'],
        dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
        dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
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
        defaultDate: '2017-09-12',
        navLinks: true,
        selectable: true,
        selectHelper: true,
        select: function (start, end) {
            $('.modal').modal();
            $('ul.tabs').tabs();
            $(".modal").modal({
                complete: function teste() {
                    start = null;
                }
            });
            var title;
            $(".modal").modal('open');

            var eventData;
            $(".buttonOkay").click(function () {
                $(".modal").modal('close');
                //$(".notification").fadeOut("slow");
                title = $("#opiniao").val();
                if (title != "") {
                    eventData = {
                        title: title,
                        start: start,
                        end: end
                    };
                    start = null;
                    end = null;
                    $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
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
        editable: true,
        eventLimit: true, // allow "more" link when too many events
//        events: [
//            {
//                title: 'All Day Event',
//                start: '2017-09-01'
//            }
//        ],
        eventRender: function (event, eventElement) {
            eventElement.find('.fc-event-inner').before($("<div class='fc-event-icons'></div>").html("<ul class='fc-icons'>" + "<li><img src='img/add.png'/></li>" + "<li><img src='\img/add.png\ /></li>" + "</ul>"));
        }
    });
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

});

