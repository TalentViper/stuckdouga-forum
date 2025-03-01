/*!
Rescalendar.js - https://cesarchas.es/rescalendar
Licensed under the MIT license - http://opensource.org/licenses/MIT

Copyright (c) 2019 César Chas
*/



;(function($) {

    $.fn.rescalendar = function( options ) {

        console.log("HELLLLLLLLLLLLLLLLLLLLLLLO3211");

        var price = options.data[0];
        var hours = options.data[1];

        $('.scroll-view').empty();

        function alert_error( error_message ){

            console.log("HELLLLLLLLLLLLLLLLLLLLLLLO9");

            return [
                '<div class="error_wrapper">',

                      '<div class="thumbnail_image vertical-center">',

                        '<p>',
                            '<span class="error">',
                                error_message,
                            '</span>',
                        '</p>',
                      '</div>',

                    '</div>'
            ].join('');

        }

        function set_template( targetObj, settings ){

            console.log("HELLLLLLLLLLLLLLLLLLLLLLLO8");

            var template = '',
                id = targetObj.attr('id') || '';

            if( id == '' || settings.dataKeyValues.length == 0 ){

                targetObj.html( alert_error( settings.lang.init_error + ': No id or dataKeyValues' ) );
                return false;

            }

            if( settings.refDate.length != 10 ){

                targetObj.html( alert_error( settings.lang.no_ref_date ) );
                return false;

            }


            template = settings.template_html( targetObj, settings );

            targetObj.html( template );

            return true;

        };

        function dateInRange( date, startDate, endDate ){

            console.log("HELLLLLLLLLLLLLLLLLLLLLLLO6");

            if( date == startDate || date == endDate ){
                return true;
            }

            var date1        = moment( startDate, settings.format ),
                date2        = moment( endDate, settings.format ),
                date_compare = moment( date, settings.format);

            return date_compare.isBetween( date1, date2, null, '[]' );

        }

        function dataInSet( data, name, date ){

            console.log("HELLLLLLLLLLLLLLLLLLLLLLLO5");

            var obj_data = {};

            for( var i=0; i < data.length; i++){

                obj_data = data[i];

                if(
                    name == obj_data.name &&
                    dateInRange( date, obj_data.startDate, obj_data.endDate )
                ){

                    return obj_data;

                }

            }

            return false;

        }

        function setData( targetObj, dataKeyValues, data ){

            console.log("HELLLLLLLLLLLLLLLLLLLLLLLO4");

            var html          = '',
                dataKeyValues = settings.dataKeyValues,
                data          = settings.data,
                arr_dates     = [],
                name          = '',
                content       = '',
                hasEventClass = '',
                customClass   = '',
                classInSet    = false,
                obj_data      = {};

            targetObj.find('td.day_cell').each( function(index, value){

                arr_dates.push( $(this).attr('data-cellDate') );

            });

            for( var i=0; i<dataKeyValues.length; i++){

                content = '';
                date    = '';
                name    = dataKeyValues[i];

                html += '<tr class="dataRow">';
                html += '<td class="firstColumn">' + name + '</td>';

                for( var j=0; j < arr_dates.length; j++ ){

                    title    = '';
                    date     = arr_dates[j];
                    obj_data = dataInSet( data, name, date );

                    if( typeof obj_data === 'object' ){

                        if( obj_data.title ){ title = ' title="' + obj_data.title + '" '; }

                        content = '<a href="#" ' + title + '>&nbsp;</a>';
                        hasEventClass = 'hasEvent';
                        customClass = obj_data.customClass;

                    }else{

                        content       = ' ';
                        hasEventClass = '';
                        customClass   = '';

                    }

                    html += '<td data-date="' + date + '" data-name="' + name + '" class="data_cell ' + hasEventClass + ' ' + customClass + '">' + content + '</td>';
                }

                html += '</tr>';

            }

            targetObj.find('.rescalendar_data_rows').html( html );
        }

        function setDayCells( targetObj, refDate ){

            var format   = settings.format,
                f_inicio = moment( refDate, format ).subtract(settings.jumpSize, 'days'),
                f_fin    = moment( refDate, format ).add(settings.jumpSize, 'days'),
                today    = moment( ).startOf('day'),
                html            = '<td class="firstColumn"></td>',
                f_aux           = '',
                f_aux_format    = '',
                dia             = '',
                dia_semana      = '',
                num_dia_semana  = 0,
                mes             = '',
                clase_today     = '',
                clase_middleDay = '',
                clase_disabled  = '',
                middleDay       = targetObj.find('input.refDate').val();

            for( var i = 0; i< (settings.calSize + 1) ; i++){

                clase_disabled = '';

                f_aux        = moment( f_inicio ).add(i, 'days');
                f_aux_format = f_aux.format( format );

                dia        = f_aux.format('DD');
                mes        = f_aux.locale( settings.locale ).format('MMM').replace('.','');
                dia_semana = f_aux.locale( settings.locale ).format('dd');
                num_dia_semana = f_aux.day();

                f_aux_format == today.format( format ) ? clase_today     = 'today'         : clase_today = '';
                f_aux_format == middleDay              ? clase_middleDay = 'middleDay' : clase_middleDay = '';

                if(
                    settings.disabledDays.indexOf(f_aux_format) > -1 ||
                    settings.disabledWeekDays.indexOf( num_dia_semana ) > -1
                ){

                    clase_disabled = 'disabledDay';
                }

                html += [
                    '<td class="day_cell ' + clase_today + ' ' + clase_middleDay + ' ' + clase_disabled + '" data-cellDate="' + f_aux_format + '">',
                        '<span class="dia_semana">' + dia_semana + '</span>',
                        '<span class="dia">' + dia + '</span>',
                        '<span class="mes">' + mes + '</span>',
                    '</td>'
                ].join('');

            }

            html += '<td class="lastColumn"></td>',

            targetObj.find('.rescalendar_day_cells').html( html );

            addTdClickEvent( targetObj );

            setData( targetObj )
        }

        function addTdClickEvent(targetObj){

            var day_cell = targetObj.find('td.day_cell');

            // Get tomorrow's date and format it
            var today = moment().format(settings.format);
            var formattedToday = moment(today).format('dddd, DD MMM YYYY');

            // Set the initial value of the element with ID selected-day to tomorrow's date
            $('#selected-day').text(formattedToday);

            day_cell.on('click', function(e){
                var cellDate = e.currentTarget.attributes['data-cellDate'].value;
                var tomorrow = moment().add(1, 'days').format(settings.format);

                if (cellDate >= tomorrow) {
                    // Remove selected class from all day cells
                    day_cell.removeClass('selected');

                    targetObj.find('input.refDate').val(cellDate);

                    // Toggle selected class on the clicked cell
                    $(this).addClass('selected');

                    var formattedDate = moment(cellDate).format('dddd, DD MMM YYYY');
                    var startDate = moment(cellDate).format('YYYY-MM-DD');
                    $('#selected-day').text(formattedDate);
                    $('#start_date').val(startDate);

                    var selectedDateSlots = [
                        { time: '8:00', status: 1 },
                        { time: '8:30', status: 1 },
                        { time: '9:00', status: 1 },
                        { time: '9:30', status: 1 },
                        { time: '10:00', status: 1 },
                        { time: '10:30', status: 1 },
                        { time: '11:00', status: 1 },
                        { time: '11:30', status: 1 },
                        { time: '12:00', status: 1 },
                        { time: '12:30', status: 1 },
                        { time: '13:00', status: 1 },
                        { time: '13:30', status: 1 },
                        { time: '14:00', status: 1 },
                        { time: '14:30', status: 1 },
                        { time: '15:00', status: 1 },
                        { time: '15:30', status: 1 },
                        { time: '16:00', status: 1 },
                        { time: '16:30', status: 1 },
                        { time: '17:00', status: 1 },
                        { time: '17:30', status: 1 },
                        { time: '18:00', status: 1 },
                    ];
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "/booking-timeslot",
                        type: 'POST',
                        data: {
                            id: $('#booking_id').val(),
                            start_date: startDate,
                            hours: hours
                        },
                        cache: false
                    }).then((response)=>{
                        selectedDateSlots = response.selectedDateSlots;

                        var slotRange = Math.ceil(hours/0.5);

                        // Determine the starting index for the slots to change
                        var startIndex = selectedDateSlots.length - slotRange;

                        // Ensure the startIndex is within valid bounds
                        if (startIndex >= 0) {
                            // Loop through the last slotRange slots and set their status to 0
                            for (var i = startIndex; i < selectedDateSlots.length; i++) {
                                selectedDateSlots[i].status = 0;
                            }
                        } else {
                            // Handle the case where slotRange is greater than the number of slots
                            console.log("SlotRange is greater than the number of available slots.");
                        }

                        // Call a function to show available slots for the selected date
                        showAvailableSlots($('.scroll-view'), selectedDateSlots);
                    });
                }

            });

        }

        function renderSlotHtml(slot, index) {

            console.log("HELLLLLLLLLLLLLLLLLLLLLLLO3");
            const statusText =
                slot.status === 1 ? `<button class="button-available">&pound;${Math.ceil(price)}</button>` :
                slot.status === 0 ? 'n/a' :
                slot.status === 2 ? `<button class="button-booked">&pound;${Math.ceil(price)}</button>` :
                'Fully booked';

            return `
                <hr>
                <div class="d-flex justify-content-between" data-index="${index}">
                    <p class="text-center" style="width:50%">${slot.time}</p>
                    <p class="text-center" style="width:50%">${statusText}</p>
                </div>
            `;
        }

        function showAvailableSlots(scrollViewElement, availableSlots) {

            console.log("HELLLLLLLLLLLLLLLLLLLLLLLO2");
            const slotsHtml = availableSlots.map(renderSlotHtml).join('');

            scrollViewElement.html(slotsHtml);

            scrollViewElement.find('div[data-index]').click(function () {
                const index = $(this).data('index');
                const slot = availableSlots[index];

                const prevIndex = availableSlots.findIndex(oldSlot => oldSlot.status === 2);
                if (prevIndex !== -1) {
                    availableSlots[prevIndex].status = 1;
                }

                if (slot.status === 1) {
                    $('#start_time').val(slot.time);
                    slot.status = 2;
                } else if (slot.status === 2) {
                    slot.status = 1;
                    $('#start_time').val('');
                }

                showAvailableSlots(scrollViewElement, availableSlots); // Update the displayed slots
            });
        }


        function change_day( targetObj, action, num_days ){

            console.log("HELLLLLLLLLLLLLLLLLLLLLLLO1");

            var refDate = targetObj.find('input.refDate').val(),
                f_ref = '';

            if( action == 'subtract'){
                f_ref = moment( refDate, settings.format ).subtract(num_days, 'days');
            }else{
                f_ref = moment( refDate, settings.format ).add(num_days, 'days');
            }

            targetObj.find('input.refDate').val( f_ref.format( settings.format ) );

            setDayCells( targetObj, f_ref );

        }

        // INITIALIZATION
        var settings = $.extend({
            id           : 'rescalendar',
            format       : 'YYYY-MM-DD',
            refDate      : moment().format( 'YYYY-MM-DD' ),
            jumpSize     : 15,
            calSize      : 30,
            locale       : 'en',
            disabledDays : [],
            disabledWeekDays: [],
            dataKeyField: 'name',
            dataKeyValues: [],
            data: {},

            lang: {
                'init_error' : 'Error when initializing',
                'no_data_error': 'No data found',
                'no_ref_date'  : 'No refDate found',
                'today'   : 'Today'
            },

            template_html: function( targetObj, settings ){

                var id      = targetObj.attr('id'),
                    refDate = settings.refDate ;

                return [
                    '<div class="rescalendar ' , id , '_wrapper d-flex justify-content-center">',
                        '<input class="refDate" type="hidden" value="' + refDate + '" />',
                        '<button type="button" class="move_to_yesterday"><</button>',
                        '<div class="rescalendar_day_cells d-flex justify-content-between"></div>',
                        '<button type="button" class="move_to_tomorrow">></button>',
                    '</div>',
                ].join('');

            }

        }, options);




        return this.each( function() {

            var targetObj = $(this);

            set_template( targetObj, settings);

            setDayCells( targetObj, settings.refDate );

            // Events
            var move_to_last_month = targetObj.find('.move_to_last_month'),
                move_to_yesterday  = targetObj.find('.move_to_yesterday'),
                move_to_tomorrow   = targetObj.find('.move_to_tomorrow'),
                move_to_next_month = targetObj.find('.move_to_next_month'),
                move_to_today      = targetObj.find('.move_to_today'),
                refDate            = targetObj.find('.refDate');

            move_to_last_month.on('click', function(e){

                change_day( targetObj, 'subtract', settings.jumpSize);

            });

            move_to_yesterday.on('click', function(e){

                console.log('move_to_yesterday');
                change_day( targetObj, 'subtract', 1);

            });

            move_to_tomorrow.on('click', function(e){
                console.log('move_to_tomorrow');
                change_day( targetObj, 'add', 1);

            });

            move_to_next_month.on('click', function(e){

                change_day( targetObj, 'add', settings.jumpSize);

            });

            refDate.on('blur', function(e){

                var refDate = targetObj.find('input.refDate').val();
                setDayCells( targetObj, refDate );

            });

            move_to_today.on('click', function(e){

                var today = moment().startOf('day').format( settings.format );
                targetObj.find('input.refDate').val( today );

                setDayCells( targetObj, today );

            });

            return this;

        });

    } // end rescalendar plugin


}(jQuery));
