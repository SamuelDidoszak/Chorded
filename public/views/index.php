<!DOCTYPE html>
<html>
    <head>
        <title>chorded</title>
        <link rel="stylesheet" type="text/css" href="public/css/style.css">
        <script src="public/script/script.js"></script>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet"> 
    </head>
    <body>
        <div id="base_container">
            <div id="header">
                <!-- <img /> -->
            </div>
            <img src="public/img/profile.svg" id="profile_button"/>
            <p id="chorded">Chorded</p>
                <!-- <img /> -->

            <form id="search_container" action="results" method="POST">
                <input name="Artist name" type="text" id="search_bar_artist" placeholder="Artist name">
                <input name="Song title" type="text" id="search_bar_song_title" placeholder="Song title">
                <input name="submit" type="image" src="public/img/search.svg" id="search_button" style="margin: 0 0 0 1%;"/>
            </form>
        </div>

    </body>
</html>