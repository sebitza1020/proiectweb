<!DOCTYPE html>
<html lang="ro">

<head>
    <title>Așteptați...</title>
    <meta charset="utf-8">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link href="css/verified.css" rel="stylesheet" type="text/css">
    <link href="img/main.png" rel="icon">
</head>

<body>
    <?php
    include "server.php";

    if(isset($_POST['registered'])) {
        $nume = mysqli_real_escape_string($db, $_POST['nume']);
        $prenume = mysqli_real_escape_string($db, $_POST['prenume']);
        $birthday = mysqli_real_escape_string($db, $_POST['birthday']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password1 = mysqli_real_escape_string($db, $_POST['password1']);
        $password2 = mysqli_real_escape_string($db, $_POST['password2']);
        $tel = mysqli_real_escape_string($db, $_POST['tel']);
        $address = mysqli_real_escape_string($db, $_POST['adresa']);
        $cnp = mysqli_real_escape_string($db, $_POST['cnp']);
        $sn = mysqli_real_escape_string($db, $_POST['sn']);

        $user_check_query = "SELECT * FROM voter WHERE cnp= '$cnp'";
        $result = mysqli_query($db, $user_check_query);
        $user = mysqli_fetch_assoc($result);
        $count = mysqli_num_rows($result);

        if($count > 0) {
            echo "<h1>Îmi pare rău! Deja ați votat...<br/> Interzis votul multiplu :( </h1>";
            header("refresh:2; url=index.php");
        }
        else {
            $password = password_hash($password1, PASSWORD_DEFAULT);
            $query = "INSERT INTO voter (nume, prenume, data_nasterii, email, parola, tel, adresa, cnp, sn)
                        VALUES ('$nume', '$prenume', '$birthday', '$email', '$password', '$tel', '$address', '$cnp', '$sn')";
            mysqli_query($db, $query);
            $query2 = "SELECT id FROM voter WHERE cnp='$cnp'";
            $result2 = mysqli_query($db, $query2);
            $voterrow = mysqli_fetch_row($result2);
            $voterid = $voterrow[0];
            
            session_start();
            $_SESSION['proc_id'] = $voterid;
            $_SESSION['proc_vot'] = $nume . " " . $prenume;
            session_write_close();
            
            echo "<h5>" . $_SESSION['proc_vot'] . "</h5><br/><h1>Perfect! Mergem mai departe. În câteva momente veți putea vota...</h1>";
            header("refresh:2; url=vote.php?voterid=$voterid");
        }
    }

?>
</body>

</html>