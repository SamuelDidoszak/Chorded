<!DOCTYPE html>
<html>
    <head>
        <title>chorded</title>
        <link rel="stylesheet" type="text/css" href="public/css/style.css">
        <script src="public/script/script.js"></script>

        <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
        <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
    </head>
    <body>
        <div id="base_container">
            <p id="chorded" style="margin:3%;">Chorded</p>
            <div id="login_container">
                <p id="login">Log in</p>
                <form id="login_form" action="loginResult" method="POST">
                    <input name="Email" type="text" class="email" placeholder="Email">
                    <input name="Password" type="password" class="password password_visible" placeholder="Password">
                    <input name="Repeat_password" type="password" class="password" placeholder="Repeat password" style="display: none;">
                </form>
                <div class="login_buttons display_buttons">
                    <button name="register" class="button">Register</button>
                    <button name="login" class="button" type="submit" form="login_form">Log in</button>
                </div>
                <div class="login_buttons">
                    <button name="login" class="button">Log in</button>
                    <button name="register" class="button" type="submit" form="login_form">Register</button>
                </div>
            </div>
            <div>
                <?php if(isset($variables)) {
                    foreach ($variables as $variable) {
                        echo $variable;
                    }
                }
                ?>
            </div>
        </div>
    </body>
</html>