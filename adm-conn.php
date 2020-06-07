<?php
    include "server.php";

    $user = $_POST['username'];
    $pass = $_POST['password'];

    $user = mysqli_real_escape_string($db, filter_var($user, FILTER_SANITIZE_EMAIL));
    $pass = mysqli_real_escape_string($db, filter_var($pass, FILTER_SANITIZE_STRING));

    $pass = sha1($pass);
    $sql = "SELECT id, admin_user FROM admin WHERE admin_user= '$user' AND admin_pass=  '$pass'";

    if($result = mysqli_query($db, $sql)) {
        if(mysqli_num_rows($result) === 1) {
            while($row = mysqli_fetch_array($result)) {
                session_start();
                $_SESSION['admin_id'] = $row['id'];
                $_SESSION['admin_name'] = $row['admin_user'];
                $_SESSION['msg'] = "";
                session_write_close();
            }
        }
    }
    header("location: admin.php");
    exit();
?>