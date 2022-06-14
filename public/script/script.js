let page = window.location.href.substring(window.location.href.lastIndexOf("/") + 1);

document.addEventListener("DOMContentLoaded", function() {

    // Array.from(document.getElementsByTagName("input")).forEach(element => {
    //     element.addEventListener("focus", modifyTextField.bind(null, element));
    //     element.addEventListener("focusout", modifyTextField.bind(null, element));
    // });
    document.getElementById("chorded").addEventListener("click", changePage.bind(null, "index"));

    if(page == "index") {
        document.getElementById("profile_button").addEventListener("click", changePage.bind(null, "login"));
        document.getElementById("search_button").addEventListener("click", submitSearch);
    } else if(page == "login") {
        console.log("login");

    } else if(page == "results") {
        document.getElementById("profile_button").addEventListener("click", changePage.bind(null, "login"));
        document.getElementById("search_button").addEventListener("click", displaySearch);
    }
});


function changePage(page) {
    let currentLocation = window.location.href;
    window.location.href = currentLocation.substring(0, currentLocation.lastIndexOf("/") + 1) + page;
}

function modifyTextField(element) {
    if(element == document.activeElement) {
        element.style.setProperty("background", "#FFFFFF1F 0% 0% no-repeat padding-box");

        if(page == "login")
            element.style.setProperty("border", "1px solid #BB86FC");
        else
            element.style.setProperty("border-bottom", "1px solid #BB86FC");


    } else {
        element.style.removeProperty("background");
        element.style.removeProperty("border");
    }
    console.log(page);
}

function submitSearch() {
    console.log("submitting...");
    changePage("results");
}

function displaySearch() {
    let container = document.getElementsByClassName("search_container_results")[0];
    container.classList.toggle("displayed");
}