<?php
    include "server.php";

    $email = $_POST['email'];
    $pass = $_POST['password'];

    $email = mysqli_real_escape_string($db, filter_var($email, FILTER_SANITIZE_EMAIL));
    $pass = mysqli_real_escape_string($db, filter_var($pass, FILTER_SANITIZE_EMAIL));

    $sql = "SELECT * FROM voter WHERE email= '$email'";

    if($result = mysqli_query($db, $sql)) {
        if(mysqli_num_rows($result) === 1) {
            while($row = mysqli_fetch_array($result)) {
                if(password_verify($pass, $row['parola'])){
                    session_start();
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['user_name'] = $row['nume'] . ' ' . $row['prenume'];
                    $_SESSION['log-check'] = "";
                    session_write_close();
                }
            }
        }
    }
    header("location: voter.php");
    exit();
?>