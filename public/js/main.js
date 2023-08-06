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
