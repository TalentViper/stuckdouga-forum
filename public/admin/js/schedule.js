var booking_object_changed = null;
var booking_object_original = null;
var changes_success = false;
var selected_booking_id = 0;

$(document).ready(function(){
    $('#reschedule-cancel-btn').click(function(){
        changes_success = false;
        $("#reschedule-close-btn").trigger("click");
    });

    $("#reschedule-close-btn").click(function() {
        if(!changes_success) {
            scheduler._events[booking_object_original.id] = booking_object_original;
            scheduler.updateView();
        }
    });

    $('#reschedule-ok-btn').click(function(){
        changes_success = false;
        var object = booking_object_changed;
        var booking_id = object.id;
        var booking_date = moment(object.start_date).format('YYYY-MM-DD');
        var booking_time = moment(object.start_date).format('HH:mm');
        var team_id = object.team_id;

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: update_event_url,
            data: {id: booking_id, start_date:booking_date, start_time: booking_time, team_id: team_id },
            cache: false,
            success: function (data)
            {
                showSuccessAlert(data.msg);
                loadBookingInfo(booking_id);
                changes_success = true;
                $("#reschedule-close-btn").trigger("click");
            }
        });

    });

    $('#booking_schedule').click(function(){
        if(confirm("Are you sure you want to schedule?")){
            var status = 'scheduled';
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: status_change_url,
                data: {id: selected_booking_id, status: status},
                cache: false,
                success: function (data)
                {
                    loadBookingInfo(selected_booking_id);
                }
            });
        }else{

        }
    })

    $('#booking_edit').click(function(){
        var bookingId = selected_booking_id;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "GET",
            url: 'jobs/' + bookingId,
            cache: false,
            success: function (data)
            {
                window.location.href = 'jobs/' + bookingId;
            },
            error: function(err)
            {
                toastr['error']('This booking is not scheduled yet.');
            }
        });
    });
});

function showSuccessAlert(msg) {
    showAlert(msg,"alert-success");
}

function showAlert(msg, type) {
    $("." + type).fadeIn(200);
    $("#" + type).text(msg);
    setTimeout(function(){
        $(".alert-success").fadeOut(200);
    }, 5000);
}

function formatTime(date) {
    return date.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: false });
}


function loadBookingInfo(id){
    $('#booking_loader').show();
    $("#booking_info").hide();
    if(id == 0){
        $('#booking_loader').hide();
    }else{
        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            url: booking_url + '/' + id, // Updated URL
            type: 'GET',
            cache: false,
            success: function(booking) {
                $('#booking_loader').hide();
                if(booking.error){

                } else {
                    $("#booking_info").show();
                    if(booking != null){
                        var deposit_price = 5;

                        // Update the class based on booking status
                        if (booking.status === 'pending') {
                            $('.tiles').removeClass('blue red green').addClass('blue');
                            $('#booking_schedule').show();
                        } else if (booking.status === 'scheduled') {
                            $('.tiles').removeClass('blue red green').addClass('green');
                            $('#booking_schedule').hide();
                        }

                        $('#booking_time').text(moment(booking.start_date).format("DD-MM-YYYY") + ' | ' + booking.start_time);
                        $('#booking_created_at').text(booking.created_on);
                        $('#booking_id').text(booking.booking_id);
                        $('#booking_status').text(booking.status);
                        $('#customer_name').text(booking.customer_name);
                        $('#customer_email').text(booking.customer_email);
                        $('#customer_phone').text(booking.customer_phone);
                        $('#booking_address').text(booking.address);
                        $('#booking_garden_type').text(booking.garden_type);
                        $('#booking_condition').text(booking.condition);
                        $('#booking_front_size').text(booking.front_size);
                        $('#booking_back_size').text(booking.back_size);
                        $('#booking_parking_fee').text(booking.parking_fee);
                        $('#estimated_hours').text(booking.recommend_hours);
                        $('#total_price').text(booking.cost);
                        $('#deposit_price').text(deposit_price);
                        $('#outstanding_price').text(booking.cost-deposit_price);
                        $('#booking_back_garden').html(booking.services_back_garden);
                        $('#booking_front_garden').html(booking.services_front_garden);

                    }
                }
            },
            error: function(xhr, status, error) {
                // Handle errors here
                console.error(error);
            }
        });
    }

}

window.addEventListener("DOMContentLoaded", function(){
    scheduler.plugins({
        units: true,
        // minical: true,
    });


    // var team_array = @json($teams);
    var teams = team_array.map(function(team){
        return {
            key: team.id,
            label: team.name
        };
    });


    scheduler.locale.labels.unit_tab = "Teams";

    scheduler.config.details_on_dblclick = false;


    scheduler.createUnitsView({
        name:"unit",
        property: "team_id",
        list:teams
    });

    scheduler.attachEvent("onClick",function(id,e){
        if(selected_booking_id != id) {
            //console.log("clicked");
            $('#calender-current-day').html(moment(scheduler.getActionData(e).date).format('D dddd'));
            $('#calender-current-date').html(moment(scheduler.getActionData(e).date).format('MMM YYYY'));
            loadBookingInfo(id);
            selected_booking_id = id;
            return false;
        }
    });

    scheduler.attachEvent('onBeforeEventChanged', function(object, event, is_new, original, check){
        // $("#booking-reschedule-btn").trigger("click");

        booking_object_changed = object;
        booking_object_original = original;
        console.log("here");
        // Convert start_date and end_date to Date objects
        const startDate = new Date(object.start_date);
        const endDate = new Date(object.end_date);
        console.log(startDate);
        console.log(endDate);
        // Define working hours (8:00 to 17:00)
        const workingHoursStart = 8;
        const workingHoursEnd = 17;

        // Extract hours from the date objects
        const startHour = startDate.getHours();
        const endHour = endDate.getHours();
        const hours = endDate.getHours() - startDate.getHours();
        const team_id = object.team_id;
        const booking_id = object.id;
        console.log(booking_id);
        console.log(team_id);
        const day = startDate.getDate().toString().padStart(2, '0');
        const month = (startDate.getMonth() + 1).toString().padStart(2, '0');
        const year = startDate.getFullYear().toString();
        const start_date = year +"-"+month+"-"+day;
        console.log(start_date);
        if (startHour < workingHoursStart || endHour > workingHoursEnd) {
            $("#booking-reschedule-btn").trigger("click");
            console.log("msg1");
            // Display an error message or take appropriate action
            // alert('Event must be between 8:00 and 17:00.');
            $("#reschedule_booking_loader").hide();
            $('#warning_message').html('<p>Event must be between 8:00 and 17:00.</p>');
            $('#warning_message').show();
            $('#reschedule_booking_info').hide();
            // Reject the event change
            return false;
        }else{
            console.log("msg2");
    
                // Convert date strings to Date objects
                const startDateObject = new Date(object.start_date);
                const originalStartDateObject = new Date(original.start_date);
    
                if (startDateObject.getTime() !== originalStartDateObject.getTime() && object.team_id == original.team_id) {
                    console.log("msg5");
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "/admin/schedules-timeslot",
                        type: 'POST',
                        data: {
                            start_date: start_date,
                            time: formatTime(startDate),
                            hours: hours,
                            team_id:team_id,
                            id:booking_id
                        },
                        cache: false
                    }).then((response)=>{
                        console.log(response['msg']);
                        if(response['msg'] == 'success')  {
                            $("#booking-reschedule-btn").trigger("click");
                            $("#reschedule_booking_loader").hide();
                            $('#warning_message').html('<p>Are you sure you want to reschedule this booking from ' + original.start_date.toString().replace(/\sGMT.*/, '') + ' to <span style="color:#249316; font-weight:bold">' + object.start_date.toString().replace(/\sGMT.*/, '') + '</span>?</p>');
                            $('#warning_message').show();
                            $('#reschedule_booking_info').show();
                        }else{
                            $("#booking-reschedule-btn").trigger("click");
                            $("#reschedule_booking_loader").hide();
                            $('#warning_message').html("<p>Can't change the Team!</p>");
                            $('#warning_message').show();
                            $('#reschedule_booking_info').hide();
                            return false;
                        }
                    });
                    
                }
    
                if(object.team_id != original.team_id){
                    console.log("msg4");
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "/admin/schedules-timeslot",
                        type: 'POST',
                        data: {
                            start_date: start_date,
                            time: formatTime(startDate),
                            hours: hours,
                            team_id:team_id,
                            id:booking_id
                        },
                        cache: false
                    }).then((response)=>{
                        console.log(response['msg']); 
                        if(response['msg'] == 'success')    {
                            $("#booking-reschedule-btn").trigger("click");
                            $("#reschedule_booking_loader").hide();
                            $('#warning_message').html('<p>Are you sure you want to change the team?</p>');
                            $('#warning_message').show();
                            $('#reschedule_booking_info').show();
                        }else{
                            $("#booking-reschedule-btn").trigger("click");
                            $("#reschedule_booking_loader").hide();
                            $('#warning_message').html("<p>Can't change the Team!</p>");
                            $('#warning_message').show();
                            $('#reschedule_booking_info').hide();
                            return false;
                        }
                    });
                    
                }
            }
            // Continue with the event change
            console.log("msg1");
            return true;
    });

    scheduler.init('scheduler_here',new Date(),"unit");
    scheduler.load(events_url, "json", function(){
        $('#calender-current-day').html(moment(new Date()).format('D dddd'));
        $('#calender-current-date').html(moment(new Date()).format('MMM YYYY'));
        // var allBookings = scheduler.getEvents();
        // Get today's date in the format YYYY-MM-DD
        var today = scheduler.date.date_to_str('%Y-%m-%d')(new Date());

        // Filter events for today
        var allBookings = scheduler.getEvents().filter(function(event) {
            return scheduler.date.date_to_str('%Y-%m-%d')(event.start_date) === today;
        });


        if (allBookings !== null && allBookings.length > 0) {
            selected_booking_id = allBookings[allBookings.length - 1]["id"];
        } else {
            selected_booking_id = 0;
        }

        loadBookingInfo(selected_booking_id);
    });


    function show_minical() {
        if (scheduler.isCalendarVisible())
            scheduler.destroyCalendar();
        else
            scheduler.renderCalendar({
                position: "dhx_minical_icon",
                date: scheduler.getState().date,
                navigation: true,
                handler: function (date, calendar) {
                    scheduler.setCurrentView(date);
                    scheduler.destroyCalendar();
                }
            });
    }
    scheduler.event(document.querySelector("#dhx_minical_icon"), "click", show_minical);
});
