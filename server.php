<?php

    $db = mysqli_connect('localhost:3306', 'root', '', 'voter') or die("Database not found...");
    
    if(isset($_GET['del'])) {
        $id = $_GET['del'];
        mysqli_query($db, "DELETE FROM voter WHERE id='$id'");
        mysqli_query($db, "DELETE FROM vote WHERE id_voter='$id'");
        header("refresh:0; url=admin.php");
    }
?>