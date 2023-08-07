$(document).ready(function() {
    $(".icon-menu").click(function() {
        $("#aside").toggleClass("hide-aside");
        $("#main-section").toggleClass("full-size");
    });
});

$(document).ready(function() {
    $("#dashboard-button").click(function() {
        window.location.href = "/";
    });

    $("#clienti-button").click(function() {
        window.location.href = "/clients";
    });
});

$(document).ready(function() {
    $("#new-cliente-button").click(function() {
        window.location.href = "/clients/new";
    });

    $("#button-delete").click(function() {
        var id = $(this).data("id");

        $.ajax({
            type: "DELETE",
            url: "/clients/{{id}}",
            data: { id: id },
            success: function(response) {
                console.error('success');
            },
            error: function(error) {
                console.error(error);
            }
        });
    });
});

$(document).ready(function() {
    $("#back-button").click(function() {
        window.location.href = "/clients";
    });

    $("#submit-button").click(function(e) {
        e.preventDefault();
        
        var formData = $("#form").serialize();
        
        $.ajax({
            type: "POST",
            url: "/clients/new",
            data: formData,
            success: function(response) {
                window.location.href = "/clients";
            },
            error: function(error) {
                console.error(error);
            }
        });
    });
});
