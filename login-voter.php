<?php
    include "server.php";
    session_start();
?>

<!DOCTYPE html>
<html lang="ro">

<head>
    <title>Voter Login</title>
    <meta charset="utf-8">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link href="css/login.css" rel="stylesheet" type="text/css">
    <link href="img/main.png" rel="icon">
</head>

<body>
    <div id="wrapper">
        <div id="header">
            <h5>ROMÂNIA</h5>
            <h4>ALEGERI PARLAMENTARE 2020</h4>
            <h2>Autentificare votant:</h2>
        </div>
        <div id="login">
            <form action="vot-conn.php" method="POST">
                <label class="label_text" for="email">Adresa de mail:</label>
                <input class="input_text" id="email" type="text" name="email" required autofocus>
                <label class="label_text" for="password">Parolă:</label>
                <input class="input_text" id="password" type="password" name="password" required>
                <p class="msg"><?php if(isset($_SESSION['log-check'])) { echo $_SESSION['log-check']; unset($_SESSION['log-check']); } ?></p>
                <input class="input_submit" type="submit" name="login_voter" value="Trimite">
                <a href="index.php">Înapoi la pagina de pornire</a>
            </form>
        </div>
        <div id="footer">
            <p>Copyright &copy; 2020 Sebastian Projects. All Rights Reserved</p>
            <p>For test purposes only</p>
        </div>
    </div>
</body>

</html>