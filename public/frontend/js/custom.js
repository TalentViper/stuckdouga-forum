$(function () {
    var availableTags = [
        "ActionScript",
        "AppleScript",
        "Asp",
    ];
    $("#receiver_id").autocomplete({
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
                    const temp = data.map((item) => item.email);
                    console.log(temp);
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
        }
    });
});