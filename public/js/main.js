$(document).ready(function() {
    $(".icon-menu").click(function() {
        $("#aside").toggleClass("hide-aside");
        $("#main-section").toggleClass("full-size");
    });
});

$(document).ready(function () {
    $.ajax({
        url: "/",
        method: "GET",
        dataType: "json",
        success: function (response) {
            // Substitua os dados do placeholder e renderize o componente
            $("#dados-placeholder").text(response.dados);
            $("#componente-container").append('<p>' + response.dados + '</p>');
        }
    });
});
