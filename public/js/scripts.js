function elementOnClick(tr) {
    window.document.location = $(tr).attr("href");
}

$(document).ready(function () {
    $(".dropdown-toggle").dropdown();
});
