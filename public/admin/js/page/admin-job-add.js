

$(document).ready(function(){
    
    $('.validate-services').hide();
    const recommendHoursSpan = $("#recommend_hours");
    const recommendHoursIdInput = $('#recommend_hours_id');
    var currentSelectedDateSlots = [];

    $("#decrease").click(function () {
        console.log('clicked decrease');
        let recommendHoursCount = parseFloat(recommendHoursIdInput.val());
        if (recommendHoursCount > 4) {
            recommendHoursCount-=0.5;
            recommendHoursSpan.text(recommendHoursCount);
            recommendHoursIdInput.val(recommendHoursCount);
            calculateEstimatedTotal(recommendHoursCount+0.5, recommendHoursCount);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/booking-timeslot",
                type: 'POST',
                data: {
                    start_date: $("#job_date").val(),
                    hours: recommendHoursCount
                },
                cache: false
            }).then((response)=>{
                $("#timeDropdown").val("");
                $("#assigned_team").val("");
                currentSelectedDateSlots = response.selectedDateSlots;
                disableOptionsUpToHours(recommendHoursCount, response.selectedDateSlots);
                disableOptionsUpToTeams(response.selectedDateSlots);
            })
        }
    });

    $("#increase").click(function () {
        console.log('clicked increase');
        let recommendHoursCount = parseFloat(recommendHoursIdInput.val());
        if (recommendHoursCount < 9) {
            recommendHoursCount +=0.5;
            recommendHoursSpan.text(recommendHoursCount);
            recommendHoursIdInput.val(recommendHoursCount);
            calculateEstimatedTotal(recommendHoursCount-0.5, recommendHoursCount);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/booking-timeslot",
                type: 'POST',
                data: {
                    start_date: $("#job_date").val(),
                    hours: recommendHoursCount
                },
                cache: false
            }).then((response)=>{
                $("#timeDropdown").val("");
                $("#assigned_team").val("");
                currentSelectedDateSlots = response.selectedDateSlots;
                disableOptionsUpToHours(recommendHoursCount, response.selectedDateSlots);
                disableOptionsUpToTeams(response.selectedDateSlots);
            })
        }
    });    
    
    $('input[name="garden"]').change(function () {
        if ($(this).val() === 'yes') {
            $('.back-garden-option, .front-garden-option').show();
        } else if ($(this).val() === 'no') {
            $('.back-garden-option').show();
            $('.front-garden-option').hide();
        }
    });

    $("#job_date").on("change", function() {            
        this.setAttribute(
            "data-date",
            moment(this.value, "YYYY-MM-DD")
            .format( this.getAttribute("data-date-format") )
        )
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/booking-timeslot",
            type: 'POST',
            data: {
                start_date: $("#job_date").val(),
                hours: parseFloat(recommendHoursIdInput.val())
            },
            cache: false
        }).then((response)=>{
            $("#timeDropdown").val("");
            $("#assigned_team").val("");
            currentSelectedDateSlots = response.selectedDateSlots;
            disableOptionsUpToHours(parseFloat(recommendHoursIdInput.val()), response.selectedDateSlots);
            disableOptionsUpToTeams(response.selectedDateSlots);
        })
    }).trigger("change");

    $("#timeDropdown").change(function() {
        $("#assigned_team").val("");
        console.log(currentSelectedDateSlots);
        disableOptionsUpToTeams(currentSelectedDateSlots);
    })


    var customerId = $("#customer_id").val();
    $("#edit_customer_btn").attr("data-customer-id", customerId);

    // Check if the value is not null or empty
    if (customerId) {
        // If it's not null, show the #edit_customer_btn
        $("#edit_customer_btn").show();
    } else {
        // If it's null, hide the #edit_customer_btn
        $("#edit_customer_btn").hide();
    }       

    $('#validation_btn').click(function(){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: validationUrl,
            method: 'POST',
            data: 
            { 
                garden: $("input[name='garden']:checked").val(),
                condition: $("#editGardenCondition").val(),
                parking: $("#editParkingInfo").val(),
                back_size: $("#editBackGardenSize").val(),
                front_size: $("#editFrontGardenSize").val(),
                back_garden_partial_maintenance: $("#back_garden_partial_maintenance").prop('checked')?'on':'off',
                back_garden_jet_washing: $("#back_garden_jet_washing").prop('checked')?'on':'off',
                back_garden_lawn_moving: $("#back_garden_lawn_moving").prop('checked')?'on':'off',
                back_garden_leaves_clearing: $("#back_garden_leaves_clearing").prop('checked')?'on':'off',
                back_garden_tree_trimming: $("#back_garden_tree_trimming").prop('checked')?'on':'off',
                back_garden_lvy_removal: $("#back_garden_lvy_removal").prop('checked')?'on':'off',
                back_garden_ivy_trimming: $("#back_garden_ivy_trimming").prop('checked')?'on':'off',
                back_garden_week_killer: $("#back_garden_week_killer").prop('checked')?'on':'off',
                back_garden_full_maintenance: $("#back_garden_full_maintenance").prop('checked')?'on':'off',
                back_garden_pressure_washing: $("#back_garden_pressure_washing").prop('checked')?'on':'off',
                back_garden_patio_tick: $("#back_garden_patio_tick").prop('checked')?'on':'off',
                back_garden_patio: $("input[name='back_garden_patio']").val(),
                back_garden_decking_tick: $("#back_garden_decking_tick").prop('checked')?'on':'off',
                back_garden_decking: $("input[name='back_garden_decking']").val(),
                back_garden_wall_tick: $("#back_garden_wall_tick").prop('checked')?'on':'off',
                back_garden_wall: $("input[name='back_garden_wall']").val(),
                back_garden_waste_removal: $("#back_garden_waste_removal").prop('checked')?'on':'off',
                back_garden_green_waste_tick: $("#back_garden_green_waste_tick").prop('checked')?'on':'off',
                back_garden_jumbo_bags: $("input[name='back_garden_jumbo_bags']").val(),
                
                front_garden_partial_maintenance: $("#front_garden_partial_maintenance").prop('checked')?'on':'off',
                front_garden_jet_washing: $("#front_garden_jet_washing").prop('checked')?'on':'off',
                front_garden_lawn_moving: $("#front_garden_lawn_moving").prop('checked')?'on':'off',
                front_garden_leaves_clearing: $("#front_garden_leaves_clearing").prop('checked')?'on':'off',
                front_garden_tree_trimming: $("#front_garden_tree_trimming").prop('checked')?'on':'off',
                front_garden_lvy_removal: $("#front_garden_lvy_removal").prop('checked')?'on':'off',
                front_garden_ivy_trimming: $("#front_garden_ivy_trimming").prop('checked')?'on':'off',
                front_garden_week_killer: $("#front_garden_week_killer").prop('checked')?'on':'off',
                front_garden_full_maintenance: $("#front_garden_full_maintenance").prop('checked')?'on':'off',
                front_garden_pressure_washing: $("#front_garden_pressure_washing").prop('checked')?'on':'off',
                front_garden_patio_tick: $("#front_garden_patio_tick").prop('checked')?'on':'off',
                front_garden_patio: $("input[name='front_garden_patio']").val(),
                front_garden_decking_tick: $("#front_garden_decking_tick").prop('checked')?'on':'off',
                front_garden_decking: $("input[name='front_garden_decking']").val(),
                front_garden_wall_tick: $("#front_garden_wall_tick").prop('checked')?'on':'off',
                front_garden_wall: $("input[name='front_garden_wall']").val(),
                front_garden_waste_removal: $("#front_garden_waste_removal").prop('checked')?'on':'off',
                front_garden_green_waste_tick: $("#front_garden_green_waste_tick").prop('checked')?'on':'off',
                front_garden_jumbo_bags: $("input[name='front_garden_jumbo_bags']").val(),
            },
            success: function(data) {

                showNotification('Your job has been successfully calculated. Please select available time slot','success');
                // console.log(data);
                // Update the search results
                $('.validate-services').hide();
                $('#timeDropdown').prop('disabled', false);
                $('#job_date').prop('disabled', false);

                const recommendHoursSpan = $("#recommend_hours");
                const recommendHoursIdInput = $('#recommend_hours_id');
                const estimatedTotalInput = $("input[name='estimated_total']");
                const outstandingInput = $("input[name='outstanding']"); 
                const depositTakenInput = $("input[name='deposit_taken']");

                var oustanding = data.cost - depositTakenInput.val();

                recommendHoursSpan.text(data.estimate);
                recommendHoursIdInput.val(data.estimate.toFixed(2));
                estimatedTotalInput.val(data.cost.toFixed(2));
                outstandingInput.val(oustanding.toFixed(2));

                // Disable options corresponding to the first 2 hours
                currentSelectedDateSlots = data.selectedDateSlots;
                disableOptionsUpToHours(data.estimate, data.selectedDateSlots);
                $("#assigned_team").val("");
                disableOptionsUpToTeams(data.selectedDateSlots);
                
            },
            error: function(error) {
                $('.validate-services').show();
                $('.validate-services').empty();
                $('.validate-services').append(
                    'At least one of the services must be selected.'
                );
                $('#timeDropdown').prop('disabled', true);
                $('#job_date').prop('disabled', true);
                console.error('Error:', error);
            }
        });
    });
    
});

function showNotification(message, type) {
    Swal.fire({
        icon: type, // 'success', 'error', 'warning', 'info', etc.
        text: message,
        showConfirmButton: false,
        timer: 2000 // Set the duration for how long the notification should appear (in milliseconds)   
    });
}

function disableOptionsUpToHours(hours, selectedDateSlots) {
    const startTime = new Date();
    startTime.setHours(8, 0, 0, 0);

    const endTime = new Date();
    endTime.setHours(18, 0, 0, 0);

    const step = 30; // in minutes
    let currentTime = new Date(endTime);        

    var i = selectedDateSlots.length - 1;
    while (currentTime >= startTime) {
        const option = $('#timeDropdown option[value="' + formatTime(currentTime) + '"]');

        // Convert hours and minutes to total minutes for comparison
        const endTimeInMinutes = endTime.getHours() * 60 + endTime.getMinutes();
        const currentTimeInMinutes = currentTime.getHours() * 60 + currentTime.getMinutes();

        // Disable options up to the specified hours
        if (endTimeInMinutes - currentTimeInMinutes < hours * 60 || selectedDateSlots[i].status==0) {
            option.prop('disabled', true);
        } else {
            option.prop('disabled', false);
        }

        i--;
        currentTime = new Date(currentTime.getTime() - step * 60000);
    }
}

function disableOptionsUpToTeams(selectedDateSlots) {
    console.log("team");
    console.log(selectedDateSlots);
    if ($("#timeDropdown").val() == "" || $("#timeDropdown").val() == null) {
        $("#assigned_team").prop('disabled', true);
        console.log("NULL");
    } else {
        $("#assigned_team").prop('disabled', false);
        $("#assigned_team option").prop('disabled', false);

        console.log("here");
        // selectedDateSlots.map(slot => {
        //     if ($("#timeDropdown").val()==slot['time']){
        //         for(var i=0; i<slot['disableteam'].length; i++) {
        //             console.log(i);
        //             console.log(slot['time']);
        //             $("#assigned_team option[value='" + slot['disableteam'][i] + "']").prop('disabled', true);
        //         }
        //     }
        // });
        selectedDateSlots.forEach(slot => {
            console.log(slot);
            console.log($("#timeDropdown").val());
            if ($("#timeDropdown").val()==slot['time']){
                console.log("same");
                for(var i=0; i<slot['disableteam'].length; i++) {
                    console.log(i);
                    console.log(slot['time']);
                    $("#assigned_team option[value='" + slot['disableteam'][i] + "']").prop('disabled', true);
                }
            }
        });
    }
}

function formatTime(date) {
    return date.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: false });
}

function calculateEstimatedTotal(old, last){
    const estimatedTotalInput = $("input[name='estimated_total']");
    let oldCost = estimatedTotalInput.val();
        
    $.ajax({
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        url: costCalculateUrl,
        method: 'POST',
        data: { oldEstimate: old, lastEstimate: last, oldCost: oldCost },
        success: function(data) {
            
            const estimatedTotalInput = $("input[name='estimated_total']");
            const outstandingInput = $("input[name='outstanding']"); 
            const depositTakenInput = $("input[name='deposit_taken']");
            let outStanding = data.cost - depositTakenInput.val();

            estimatedTotalInput.val(data.cost.toFixed(2));
            outstandingInput.val(outStanding.toFixed(2));
        },
        error: function(error) {
            console.error('Error:', error);
        }
    });
}

$(document).ready(function() {
    
    // INIT FOR BACK GARDEN
    $('.back-garden-gardening-services').hide();
    $('.back-garden-pressure-washing').hide();
    $('.back-garden-waste-removal').hide(); 
    //  init for Gardening Services
    $('.back-garden-gardening-services-part').hide();
    $('.back-garden-partial-maintenance-part').hide();        

    // init for Pressure Washing
    $('.back-garden-pressure-washing-part').hide();
    $('.back-garden-patio-label').hide();
    $('.back-garden-decking-label').hide();
    $('.back-garden-wall-label').hide();

    // init for Waste Removal
    $('.back-garden-waste-removal-part').hide();
    $('.back-garden-household-waste-label').hide();
    $('.back-garden-green-waste-label').hide();
    $('.back-garden-office-clearance-label').hide();
    $('.back-garden-builders-waste-label').hide();  

    // INIT FOR FRONT GARDEN
    $('.front-garden-gardening-services').hide();
    $('.front-garden-pressure-washing').hide();
    $('.front-garden-waste-removal').hide(); 
    //  init for Gardening Services
    $('.front-garden-gardening-services-part').hide();
    $('.front-garden-partial-maintenance-part').hide();
    $('.front-garden-pressure-washing-part').hide(); 

    // init for Pressure Washing
    $('.front-garden-pressure-washing-part').hide();
    $('.front-garden-patio-label').hide();
    $('.front-garden-decking-label').hide();
    $('.front-garden-wall-label').hide();

    // init for Waste Removal
    $('.front-garden-waste-removal-part').hide();
    $('.front-garden-household-waste-label').hide();
    $('.front-garden-green-waste-label').hide();
    $('.front-garden-office-clearance-label').hide();
    $('.front-garden-builders-waste-label').hide();


    
    
    
    $('#back_garden_partial_maintenance').on('change', function() {
        if ($(this).prop('checked')) {
            $('.back-garden-partial-maintenance-part').show();
            $('#back_garden_full_maintenance').prop('checked', false);
        } else {
            $('.back-garden-partial-maintenance-part').hide();             
        }
    });

    $('#back_garden_full_maintenance').on('change', function() {
        if ($(this).prop('checked')) {
            $('#back_garden_partial_maintenance').prop('checked', false);
            $('.back-garden-partial-maintenance-part').hide();         
        }
    });

    // Pressure Washing
    $('#back_garden_pressure_washing').on('change', function() {
        if ($(this).prop('checked')) {
            $('.back-garden-pressure-washing-part').show();             
        } else {
            $('.back-garden-pressure-washing-part').hide();             
        }
    });

    $('#back_garden_patio_tick').on('change', function() {
        if ($(this).prop('checked')) {
            $('.back-garden-patio-label').show();
        } else {
            $('.back-garden-patio-label').hide();           
        }
    });

    $('#back_garden_decking_tick').on('change', function() {
        if ($(this).prop('checked')) {
            $('.back-garden-decking-label').show();             
        } else {
            $('.back-garden-decking-label').hide();           
        }
    });

    $('#back_garden_wall_tick').on('change', function() {
        if ($(this).prop('checked')) {
            $('.back-garden-wall-label').show();             
        } else {
            $('.back-garden-wall-label').hide();           
        }
    });

    // Waste Removal

    $('#back_garden_waste_removal').on('change', function() {
        if ($(this).prop('checked')) {
            $('.back-garden-waste-removal-part').show();               
        } else {
            $('.back-garden-waste-removal-part').hide();             
        }
    });

    $('#back_garden_household_waste_tick').on('change', function() {
        if ($(this).prop('checked')) {
            $('.back-garden-household-waste-label').show();               
        } else {
            $('.back-garden-household-waste-label').hide();           
        }
    });

    $('#back_garden_green_waste_tick').on('change', function() {
        if ($(this).prop('checked')) {
            $('.back-garden-green-waste-label').show();               
        } else {
            $('.back-garden-green-waste-label').hide();             
        }
    });

    $('#back_garden_office_clearance_tick').on('change', function() {
        if ($(this).prop('checked')) {
            $('.back-garden-office-clearance-label').show();               
        } else {
            $('.back-garden-office-clearance-label').hide();             
        }
    });

    $('#back_garden_builders_waste_tick').on('change', function() {
        if ($(this).prop('checked')) {
            $('.back-garden-builders-waste-label').show();               
        } else {
            $('.back-garden-builders-waste-label').hide();             
        }
    });

    

    // Gardening Services
    $('#front_garden_gardening_services').on('change', function() {
        if ($(this).prop('checked')) {
            $('.front-garden-gardening-services-part').show();               
        } else {
            $('.front-garden-gardening-services-part').hide();             
        }
    });

    $('#front_garden_partial_maintenance').on('change', function() {
        if ($(this).prop('checked')) {
            $('.front-garden-partial-maintenance-part').show();
            $('#front_garden_full_maintenance').prop('checked', false);
        } else {
            $('.front-garden-partial-maintenance-part').hide();             
        }
    });

    $('#front_garden_full_maintenance').on('change', function() {
        if ($(this).prop('checked')) {
            $('#front_garden_partial_maintenance').prop('checked', false);
            $('.front-garden-partial-maintenance-part').hide();         
        }
    });

    // Pressure Washing
    $('#front_garden_pressure_washing').on('change', function() {
        if ($(this).prop('checked')) {
            $('.front-garden-pressure-washing-part').show();               
        } else {
            $('.front-garden-pressure-washing-part').hide();             
        }
    });

    $('#front_garden_patio_tick').on('change', function() {
        if ($(this).prop('checked')) {
            $('.front-garden-patio-label').show();             
        } else {
            $('.front-garden-patio-label').hide();           
        }
    });

    $('#front_garden_decking_tick').on('change', function() {
        if ($(this).prop('checked')) {
            $('.front-garden-decking-label').show();             
        } else {
            $('.front-garden-decking-label').hide();           
        }
    });

    $('#front_garden_wall_tick').on('change', function() {
        if ($(this).prop('checked')) {
            $('.front-garden-wall-label').show();             
        } else {
            $('.front-garden-wall-label').hide();           
        }
    });

    // Waste Removal

    $('#front_garden_waste_removal').on('change', function() {
        if ($(this).prop('checked')) {
            $('.front-garden-waste-removal-part').show();               
        } else {
            $('.front-garden-waste-removal-part').hide();             
        }
    });

    $('#front_garden_household_waste_tick').on('change', function() {
        if ($(this).prop('checked')) {
            $('.front-garden-household-waste-label').show();               
        } else {
            $('.front-garden-household-waste-label').hide();           
        }
    });

    $('#front_garden_green_waste_tick').on('change', function() {
        if ($(this).prop('checked')) {
            $('.front-garden-green-waste-label').show();               
        } else {
            $('.front-garden-green-waste-label').hide();             
        }
    });

    $('#front_garden_office_clearance_tick').on('change', function() {
        if ($(this).prop('checked')) {
            $('.front-garden-office-clearance-label').show();               
        } else {
            $('.front-garden-office-clearance-label').hide();             
        }
    });

    $('#front_garden_builders_waste_tick').on('change', function() {
        if ($(this).prop('checked')) {
            $('.front-garden-builders-waste-label').show();               
        } else {
            $('.front-garden-builders-waste-label').hide();             
        }
    });

    // jumbo bags
    const jumboBagsSpan1 = $("#back_garden_jumbo_bags");
    let jumboBagsCount1 = 1; // Initial value

    $("#back_garden_decrease").click(function() {
        if (jumboBagsCount1 > 1) {
            jumboBagsCount1--;
            jumboBagsSpan1.text(jumboBagsCount1);
            $('#back_garden_jumbo_bags_id').val(jumboBagsCount1);
        }
    });

    $("#back_garden_increase").click(function() {
        if (jumboBagsCount1 < 30) {
            jumboBagsCount1++;
            jumboBagsSpan1.text(jumboBagsCount1);
            $('#back_garden_jumbo_bags_id').val(jumboBagsCount1);
        }
    });

    const jumboBagsSpan2 = $("#front_garden_jumbo_bags");
    let jumboBagsCount2 = 1; // Initial value

    $("#front_garden_decrease").click(function() {
        if (jumboBagsCount2 > 1) {
            jumboBagsCount2--;
            jumboBagsSpan2.text(jumboBagsCount2);
            $('#front_garden_jumbo_bags_id').val(jumboBagsCount2);
            
        }
    });

    $("#front_garden_increase").click(function() {
        if (jumboBagsCount2 < 30) {
            jumboBagsCount2++;
            jumboBagsSpan2.text(jumboBagsCount2);
            $('#front_garden_jumbo_bags_id').val(jumboBagsCount2);
        }
    });

    // Patio
    const backGardenPatio = $("#back_garden_patio");
    let backGardenPatioCount = 20; // Initial value

    $("#back_garden_patio_decrease").click(function() {
        if (backGardenPatioCount > 20) {
            backGardenPatioCount-=5;
            backGardenPatio.text(backGardenPatioCount);
            $("input[name='back_garden_patio']").val(backGardenPatioCount);
        }
    });

    $("#back_garden_patio_increase").click(function() {
        if (backGardenPatioCount < 300) {
            backGardenPatioCount+=5;
            backGardenPatio.text(backGardenPatioCount);
            $("input[name='back_garden_patio']").val(backGardenPatioCount);
        }
    });

    const frontGardenPatio = $("#front_garden_patio");
    let frontGardenPatioCount = 20; // Initial value

    $("#front_garden_patio_decrease").click(function() {
        if (frontGardenPatioCount > 20) {
            frontGardenPatioCount-=5;
            frontGardenPatio.text(frontGardenPatioCount);
            $("input[name='front_garden_patio']").val(frontGardenPatioCount);
            
        }
    });

    $("#front_garden_patio_increase").click(function() {
        if (frontGardenPatioCount < 300) {
            frontGardenPatioCount+=5;
            frontGardenPatio.text(frontGardenPatioCount);
            $("input[name='front_garden_patio']").val(frontGardenPatioCount);
        }
    });

    // Decking
    const backGardenDecking = $("#back_garden_decking");
    let backGardenDeckingCount = 20; // Initial value

    $("#back_garden_decking_decrease").click(function() {
        if (backGardenDeckingCount > 20) {
            backGardenDeckingCount-=5;
            backGardenDecking.text(backGardenDeckingCount);
            $("input[name='back_garden_decking']").val(backGardenDeckingCount);
        }
    });

    $("#back_garden_decking_increase").click(function() {
        if (backGardenDeckingCount < 300) {
            backGardenDeckingCount+=5;
            backGardenDecking.text(backGardenDeckingCount);
            $("input[name='back_garden_decking']").val(backGardenDeckingCount);
        }
    });

    const frontGardenDecking = $("#front_garden_decking");
    let frontGardenDeckingCount = 20; // Initial value

    $("#front_garden_decking_decrease").click(function() {
        if (frontGardenDeckingCount > 20) {
            frontGardenDeckingCount-=20;
            frontGardenDecking.text(frontGardenDeckingCount);
            $("input[name='front_garden_decking']").val(frontGardenDeckingCount);
            
        }
    });

    $("#front_garden_decking_increase").click(function() {
        if (frontGardenDeckingCount < 300) {
            frontGardenDeckingCount+=5;
            frontGardenDecking.text(frontGardenDeckingCount);
            $("input[name='front_garden_decking']").val(frontGardenDeckingCount);
        }
    });

    // Wall
    const backGardenWall = $("#back_garden_wall");
    let backGardenWallCount = 20; // Initial value

    $("#back_garden_wall_decrease").click(function() {
        if (backGardenWallCount > 20) {
            backGardenWallCount-=5;
            backGardenWall.text(backGardenWallCount);
            $("input[name='back_garden_wall']").val(backGardenWallCount);
        }
    });

    $("#back_garden_wall_increase").click(function() {
        if (backGardenWallCount < 300) {
            backGardenWallCount+=5;
            backGardenWall.text(backGardenWallCount);
            $("input[name='back_garden_wall']").val(backGardenWallCount);
        }
    });

    const frontGardenWall = $("#front_garden_wall");
    let frontGardenWallCount = 20; // Initial value

    $("#front_garden_wall_decrease").click(function() {
        if (frontGardenWallCount > 20) {
            frontGardenWallCount-=5;
            frontGardenWall.text(frontGardenWallCount);
            $("input[name='front_garden_wall']").val(frontGardenWallCount);
            
        }
    });

    $("#front_garden_wall_increase").click(function() {
        if (frontGardenWallCount < 300) {
            frontGardenWallCount+=5;
            frontGardenWall.text(frontGardenWallCount);
            $("input[name='front_garden_wall']").val(frontGardenWallCount);
        }
    });

});

$('#customer_name').on('input', function() {
    // Get the input value
    var customerName = $(this).val();

    clearTimeout(delayTimer);

    // Set a new timer to delay the execution of the function
    delayTimer = setTimeout(function () {
        // Perform AJAX request
        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            url: searchCustomerUrl,
            method: 'GET',
            data: { customerName: customerName },
            success: function(data) {
                // Update the search results
                displaySearchResults(data);
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    }, 500); // Adjust the delay time as needed
});

var delayTimer;

$('#createCustomerEmail').on('input', function() {
    // Clear the previous timer
    clearTimeout(delayTimer);

    // Set a new timer to delay the execution of the function
    delayTimer = setTimeout(function () {
        validateCustomer();
    }, 500); // Adjust the delay time as needed
});



$("#edit_customer_btn").click(function(){
    var customerId = $(this).data('customer-id');                            
    // Make an AJAX request to fetch the customer data
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: viewCustomerDetailUrl + '/' + customerId, // Updated URL
        type: 'GET',
        cache: false,
        success: function (data) {            
            // Populate the edit modal form fields with the retrieved data
            $('#viewCustomerId').val(data.id);
            $('#viewCustomerTitle').val(data.title);
            $('#viewCustomerFirstName').val(data.first_name);
            $('#viewCustomerLastName').val(data.last_name);
            $('#viewCustomerEmail').val(data.email);
            $('#viewCustomerPhone').val(data.phone);
            $('#viewCustomerAddress').val(data.address);
            $('#viewCustomerCity').val(data.city);
            $('#viewCustomerPostcode').val(data.postcode);
            $('#viewCustomerIsActive').val(data.is_active);
            // Show the edit modal
            $('#viewCustomerModal').modal('show');
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
            // Handle error if necessary
        }
    });
});

$('#create_customer_btn').click(function(){
    $('#createCustomerModal').modal('show');

    $('#createCustomerForm').on('submit', function(e) {
        // Prevent the default form submission
        e.preventDefault();

        // Store the form reference
        var form = this;

        // Show a confirmation alert using SweetAlert
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: form.action,
            method: form.method,
            data: $(form).serialize(),
            success: function(response) {
                // Display a success message                
                $('#customer_name').val(response.first_name + ' ' + response.last_name);
                $('#customer_email').val(response.email);
                $('#customer_phone').val(response.phone);
                $('#customer_id').val(response.id);
                $("#edit_customer_btn").show();
                $("#edit_customer_btn").attr("data-customer-id", response.id);                
                $('#createCustomerModal').modal('hide');

                Swal.fire({
                    title: 'Success',
                    text: 'New customer was successfully added.',
                    icon: 'success'
                });                
            },
            error: function(response) {
                // Display an error message
                Swal.fire({
                    title: 'Error!',
                    text: 'There was an error submitting the form.',
                    icon: 'error'
                });
            }
        });
    });
});

function validateCustomer() {
    var customerEmail = $('#createCustomerEmail').val();
    $.ajax({
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        url: validationDuplicateEmailUrl,
        method: 'GET',
        data: { customerEmail: customerEmail },
        success: function(data) {
            // Update the search results
            if (!data) {
                $('#emailAlert').text('Customer with this email already exists!').show();
            } else {
                $('#emailAlert').hide();
            }
        },
        error: function(error) {
            console.error('Error:', error);
        }
    });
}
    

// Function to display search results
// Function to display search results
function displaySearchResults(results) {
    var searchResultsList = $('#searchResults');
    searchResultsList.empty();

    // Iterate through the results and append them to the list
    for (var i = 0; i < results.length; i++) {
        var resultItem = $('<li>' + results[i].first_name + ' ' + results[i].last_name + '</li>');

        // Add a click event listener to each result item
        resultItem.click((function(result) {
            return function() {
                // Set the input field values to the clicked result
                $('#customer_name').val(result.first_name + ' ' + result.last_name);
                $('#customer_email').val(result.email);
                $('#customer_phone').val(result.phone);
                $('#customer_id').val(result.id);
                $("#edit_customer_btn").show();
                $("#edit_customer_btn").attr("data-customer-id", result.id);
                // Clear the search results
                searchResultsList.empty();
            };
        })(results[i]));

        searchResultsList.append(resultItem);
    }
}

$(document).ready(function() {
            
    const depositTakenInput = $("input[name='deposit_taken']");

    // Initial calculation on page load
    updateOutstanding();

    // Attach an input event listener to depositTakenInput
    depositTakenInput.on('input', function() {
        // Recalculate outstanding when the input value changes
        updateOutstanding();
    });
    

    $('#createJobForm').on('submit', function(e) {
        // Prevent the default form submission
        e.preventDefault();

         var customer = $("#customer_id").val();                  
        if (customer.trim() === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Warning!',
                text: 'Please enter a valid customer.',
                showConfirmButton: false,
                timer: 2000 // Set the duration for how long the notification should appear (in milliseconds)   
            });
            return;
        }
        var addressInput = $("#address").val();        
        var geocoder = new google.maps.Geocoder();

        if (addressInput.trim() === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Warning!',
                text: 'Address is required.',
                showConfirmButton: false,
                timer: 2000 // Set the duration for how long the notification should appear (in milliseconds)
            });
        } else {
            validateAddress(addressInput)
                .then(function (results) {
                    // Handle success, e.g., display a success message
                    console.log(results);
                })
                .catch(function () {
                    // Handle failure, e.g., display a warning for invalid address
                    Swal.fire({
                        icon: 'warning',
                        title: 'Warning!',
                        text: 'Please enter a valid address.',
                        showConfirmButton: false,
                        timer: 2000 // Set the duration for how long the notification should appear (in milliseconds)
                    });
                });
        }
        function validateAddress(address) {
            return new Promise(function (resolve, reject) {
                geocoder.geocode({ address: address }, function (results, status) {
                    if (status === google.maps.GeocoderStatus.OK) {
                        console.log('Yes');
                        resolve(results);
                    } else {
                        console.log('No');
                        reject();
                    }
                });
            });
        }
        
        var jobDate = $("#job_date").val();
        if (jobDate.trim() === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Warning!',
                text: 'Job date is required.',
                showConfirmButton: false,
                timer: 2000 // Set the duration for how long the notification should appear (in milliseconds)   
            });
            return;
        }
        
        var jobTime = $("#timeDropdown").val();
        if (jobTime === "" || jobTime === null) {
            Swal.fire({
                icon: 'warning',
                title: 'Warning!',
                text: 'Job time is required.',
                showConfirmButton: false,
                timer: 2000 // Set the duration for how long the notification should appear (in milliseconds)   
            });
            return;
        }
        
        var assignedTeam = $("#assigned_team").val();
        if (assignedTeam === "" || assignedTeam === null) {
            Swal.fire({
                icon: 'warning',
                title: 'Warning!',
                text: 'Team is required.',
                showConfirmButton: false,
                timer: 2000 // Set the duration for how long the notification should appear (in milliseconds)   
            });
            return;
        }

        var startingTime = $("#timeDropdown").val();
        if (startingTime.trim() === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Warning!',
                text: 'Job starting time is required.',
                showConfirmButton: false,
                timer: 2000 // Set the duration for how long the notification should appear (in milliseconds)   
            });
            return;
        }

        var estimatedTime = $("#recommend_hours_id").val();
        if (estimatedTime.trim() === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Warning!',
                text: 'Job estimated time is required.',
                showConfirmButton: false,
                timer: 2000 // Set the duration for how long the notification should appear (in milliseconds)   
            });
            return;
        }

        var estimatedTotal = $("input[name='estimated_total']").val();
        if (estimatedTotal.trim() === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Warning!',
                text: 'Estimated total is required.',
                showConfirmButton: false,
                timer: 2000 // Set the duration for how long the notification should appear (in milliseconds)   
            });
            return;
        }

        // Store the form reference
        var form = this;

        // Show a confirmation alert using SweetAlert
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: form.action,
            method: form.method,
            data: $(form).serialize(),
            success: function(response) {
                // Display a success message
                Swal.fire({
                    title: 'Success!',
                    text: 'The Job ID #' + response.job + ' was successfully created.',
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonColor: 'green',
                    cancelButtonColor: 'grey',
                    confirmButtonText: 'Continue',
                    cancelButtonText: 'Go To Jobs Page'
                }).then((result) => {
                    // Handle the button click based on the result
                    if (result.isConfirmed) {
                        // Redirect to the "Continue" page
                        // Redirect to the "Continue" page
                        window.location.href = response.continueUrl;

                    } else {
                        // Redirect to the "Go To Jobs Page" page
                        window.location.href = response.goToUrl;
                    }
                });
            },
            error: function() {
                // Display an error message
                Swal.fire({
                    title: 'Error!',
                    text: 'There was an error submitting the form.',
                    icon: 'error'
                });
            }
        });
    });
});


// Function to calculate outstanding and update the input field
function updateOutstanding() {
    const estimatedTotalInput = $("input[name='estimated_total']");
    const outstandingInput = $("input[name='outstanding']");
    const depositTakenInput = $("input[name='deposit_taken']");

    var outstanding = parseFloat(estimatedTotalInput.val() || 0) - parseFloat(depositTakenInput.val() || 0);
    outstandingInput.val(outstanding.toFixed(2));
}

