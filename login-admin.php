<?php
    include "server.php";
?>

<!DOCTYPE html>
<html lang="ro">

<head>
    <title>Admin Login</title>
    <meta charset="utf-8">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link href="css/login.css" rel="stylesheet" type="text/css">
    <link href="img/main.png" rel="icon">
</head>

<body>
    <div id="wrapper">
    <?php
        session_start();

        if(isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id'])) {
            header("location: admin.php");
        }
        ?>
        <div id="header">
            <h5>ROMÂNIA</h5>
            <h4>ALEGERI PARLAMENTARE 2020</h4>
            <h2>Autentificare administrator:</h2>
            <form method="POST" action="adm-conn.php">
                <label class="label_text" for="username">Admin:</label>
                <input class="input_text" id="username" type="text" name="username" required autofocus>
                <label class="label_text" for="password">Parolă:</label>
                <input class="input_text" id="password" type="password" name="password" required>
                <p class="msg"><?php if (isset($_SESSION['msg'])) { echo $_SESSION['msg']; unset($_SESSION['msg']); } ?></p>
                <input class="input_submit" type="submit" name="login_admin" value="Trimite">
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