$(function () {
    
    $("#receiver_id").autocomplete({
        authFocus: true,
        minLength: 1,
        source: function (request, response) {
            $.ajax({
                url: "/usersbykey",
                type: "POST",
                data: {username: request.term},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: true,
                success: function (data) {
                    const temp = data.map((item) => item.username);
                    response(temp);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error("Error fetching data: ", textStatus, errorThrown);
                }
            });
        },
        open: function() {
            $(".ui-autocomplete").css({
                "max-width": "349px",
                "width": "100%",
                "max-height": "200px",
                "overflow-y": "auto",
                "overflow-x": "hidden",
                "background-color": "#fff",
                "border": "1px solid #ccc",
                "z-index": "1000"
            });
        },
    });

    // $("#user_name").on('keyup', function (e) {
    //     const username = $(this).val();
    //     const ParentDom = $(this).parents('.form-group');
    //     $.ajax({
    //         url: "/usersbykey",
    //         type: "POST",
    //         data: {username: username, isMatch: "1"},
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         cache: true,
    //         success: function (data) {
    //             if (data.length > 0) {
    //                 console.log(data);
    //                 ParentDom.find('span').remove();
    //                 ParentDom.append('<span class="bg-danger mt-1 py-1 rounded-1 small text-center text-white">This username is already taken.</span>')
    //             } else {
    //                 ParentDom.find('span').remove();
    //                 ParentDom.append('<span class="bg-success mt-1 py-1 rounded-1 small text-center text-white">This username is available.</span>')
    //             }
    //         },
    //         error: function (jqXHR, textStatus, errorThrown) {
    //             console.error("Error fetching data: ", textStatus, errorThrown);
    //         }
    //     });
    // });
});