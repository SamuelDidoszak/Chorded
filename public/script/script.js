document.addEventListener("DOMContentLoaded", function() {

    document.getElementById("chorded").addEventListener("click", changePage.bind(null, "index"));
    document.getElementById("profile_button").addEventListener("click", changePage.bind(null, "login"));

});


function changePage(page) {
    let currentLocation = window.location.href;
    window.location.href = currentLocation.substring(0, currentLocation.lastIndexOf("/") + 1) + page;
}