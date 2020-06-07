<!DOCTYPE html>
<html lang="ro">

<head>
    <title>Așteptați...</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link href="css/verified.css" rel="stylesheet" type="text/css">
    <link href="img/main.png" rel="icon">
</head>

<body>
    <?php
        include "server.php";
        session_start();
    
        if(isset($_SESSION['proc_id']) && !empty($_SESSION['proc_id'])) {
            $party_id = $_POST['party_radiogroup'];
            $voterid = $_POST['voterid'];
            if(isset($party_id)){
                $vot_party = "INSERT INTO vote (id_voter, id_party) VALUES ('$voterid', '$party_id') ";
                $rez_party = mysqli_query($db, $vot_party);   
                echo "<h1>Vă mulțumim că ați votat!</h1>
                <h5>Veți fi acum redirecționați înapoi în pagina de pornire...</h5>";
                header("refresh:2.0; url=index.php");
            }
            else {
                $_SESSION['vot-error'] = "Trebuie să selectați cel puțin o opțiune.";
                header("location: vote.php?voterid=$voterid");
            }
        }
        session_write_close();
    ?>
</body>

</html>