let page = window.location.href.substring(window.location.href.lastIndexOf("/") + 1);

document.addEventListener("DOMContentLoaded", function() {

    document.getElementById("chorded").addEventListener("click", changePage.bind(null, "index"));

    if(page == "index" || page == "loginResult" || page == "registerResult") {
        document.getElementById("profile_button").addEventListener("click", changePage.bind(null, "login"));
        document.getElementById("search_button").addEventListener("click", submitSearch);

        if(document.cookie.search("userId") == -1) {
            let userId = document.getElementById("target").innerHTML.trim();

            if(userId != "") {
                document.cookie = "userId=" + userId;
            }
        }

    } else if(page == "login") {
        // user cookie related
        if(document.cookie.search("userId") != -1) {
            document.getElementsByName("logout")[0].style.removeProperty("display");
            document.getElementById("login_container").style.setProperty("display", "none");

            if(document.getElementById("target").innerHTML == 2) {
                let base_container = document.getElementById("base_container");
                base_container.innerHTML += "<p id='login'>You are an admin</p>";
            }
            document.getElementById("target").remove();
        }

        // button click listeners
        document.getElementsByName("register")[0].addEventListener("click", 
            changeLoginRegisterScreen.bind(null, true));
        document.getElementsByName("login")[1].addEventListener("click", 
            changeLoginRegisterScreen.bind(null, false));

        document.getElementsByName("logout")[0].addEventListener("click", function() {
            document.cookie = "userId=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            changePage("index");
        });
        
        // submit form parsing
        // document.getElementById("login_form").onsubmit = function() {return false};
        document.getElementById("login_form").addEventListener("submit",
            parseRegisterData, false);

    } else if(page == "results") {
        document.getElementById("profile_button").addEventListener("click", changePage.bind(null, "login"));
        document.getElementById("search_button").addEventListener("click", displaySearch);

        let title = document.getElementById("song_title").innerHTML;
        let artist = title.substring(0, title.indexOf("- "));
        title = title.substring(title.indexOf("- ") + 2);
        getSongData(artist, title);
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

function changeLoginRegisterScreen(showRegisterButtons) {
    let containers = document.getElementsByClassName("login_buttons");
    let repeatPassword = document.getElementsByName("Repeat_password")[0];
    let elementShow;
    let elementHide;
    let property;
    let loginRegisterValue;
    let action;
    if(showRegisterButtons) {
        elementShow = containers[1];
        elementHide = containers[0];
        property = "flex";
        loginRegisterValue = "Register";
        action = "registerResult";
    } else {
        elementShow = containers[0];
        elementHide = containers[1];
        property = "none";
        loginRegisterValue = "Log in";
        action = "loginResult";
    }
    elementShow.classList.toggle("display_buttons");
    elementHide.classList.remove("display_buttons");

    repeatPassword.style.setProperty("display", property);
    repeatPassword.classList.toggle("password_visible");

    document.getElementById("login").innerHTML = loginRegisterValue;

    document.getElementById("login_form").action = action;
}

function submitSearch() {
    console.log("submitting...");
    changePage("results");
}

function displaySearch() {
    let container = document.getElementsByClassName("search_container_results")[0];
    container.classList.toggle("displayed");
}

function parseRegisterData() {
    let isDataCorrect = true;
    if (!isEmail(document.getElementsByName("Email")[0].value)) {
        isDataCorrect = false;
        document.getElementsByName("Email")[0].classList.add("input_error");
    } else
        document.getElementsByName("Email")[0].classList.remove("input_error");
    if (document.getElementsByName("Password")[0].value.length < 8) {
        document.getElementById("errors").innerHTML = "Password has to be at least 8 characters long";
        document.getElementsByName("Password")[0].classList.add("input_error");
    } else {
        document.getElementById("errors").innerHTML = "";
        document.getElementsByName("Password")[0].classList.remove("input_error");
    }
    if (document.getElementById("login").innerHTML != "Log in" && document.getElementsByName("Password")[0].value !=
        document.getElementsByName("Repeat_password")[0].value) {
        isDataCorrect = false;
        document.getElementsByName("Repeat_password")[0].classList.add("input_error");
    } else
        document.getElementsByName("Repeat_password")[0].classList.remove("input_error");
    if(!isDataCorrect)
        event.preventDefault();
    return isDataCorrect;
}


function isEmail(email) {
    return /\S+@\S+\.\S+/.test(email);
}

function getSongData(artist, title) {
    // let query = JSON.stringify({
    //     query: {
    //         query: `query PaginatedLibraryTracksQuery {libraryTracks(first: 10 filter: {title: like you do}) {pageInfo {hasNextPage} edges {cursor node {id audioAnalysisV6 {__typename ... on AudioAnalysisV6Finished {result {predominantVoiceGender musicalEraTag}}}}}}}`,
    //     variables: {
    //         first: 10,
    //     },
    //     },
    // });

    // // query = query.replace("\n ", "");
    // query = query.trim();
    // console.log(query);

    // fetch("https://api.cyanite.ai/graphql", {
    // method: "POST",
    // body: query,
    // headers: {
    //     "Content-Type": "application/json",
    //     Authorization: "Bearer " + "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0eXBlIjoiSW50ZWdyYXRpb25BY2Nlc3NUb2tlbiIsInZlcnNpb24iOiIxLjAiLCJpbnRlZ3JhdGlvbklkIjoyODEsInVzZXJJZCI6MTAwMDYsImFjY2Vzc1Rva2VuU2VjcmV0IjoiNDQzM2Y5MDI3OTM2NDMxYWQxMGY1ZjE5NDAyZGFiNWNkNzFmNzI5N2Y4ZjJiZDAxOGM4ZGI5OTg2ODdhMTk0NSIsImlhdCI6MTY1NTczNTg4NH0.RUgVp9Pqx2Hm8Pkj852VEURqVu2XN5chGBwBJruEWIY",
    // },
    // })
    // .then((res) => res.json())
    // .then(console.log);
    fetch("https://api.cyanite.ai/graphql", {
  method: "POST",
  body: JSON.stringify({
    query: {
      query: /* GraphQL */ `query LibraryTracksQuery {libraryTracks(first: 10) {edges {node {id}}}}`,
      variables: {
        first: 10,
      },
    },
  }),
  headers: {
    "Content-Type": "application/json",
    Authorization: "Bearer" + "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0eXBlIjoiSW50ZWdyYXRpb25BY2Nlc3NUb2tlbiIsInZlcnNpb24iOiIxLjAiLCJpbnRlZ3JhdGlvbklkIjoyODEsInVzZXJJZCI6MTAwMDYsImFjY2Vzc1Rva2VuU2VjcmV0IjoiNDQzM2Y5MDI3OTM2NDMxYWQxMGY1ZjE5NDAyZGFiNWNkNzFmNzI5N2Y4ZjJiZDAxOGM4ZGI5OTg2ODdhMTk0NSIsImlhdCI6MTY1NTczNTg4NH0.RUgVp9Pqx2Hm8Pkj852VEURqVu2XN5chGBwBJruEWIY",
  },
})
  .then((res) => res.json())
  .then(console.log);
}