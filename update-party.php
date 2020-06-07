<!DOCTYPE html>
<html lang="ro">

<head>
    <title>Modificare partid</title>
    <meta charset="utf-8">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link href="css/register.css" rel="stylesheet" type="text/css">
    <link href="img/main.png" rel="icon">
</head>

<body>
    <div id="wrapper">
        <div id="header">
            <h5>ROMÂNIA</h5>
            <h4>ALEGERI PARLAMENTARE 2020</h4>
            <h2>Modificați datele partidului:</h2>
        </div>
        <div id="form-update">
            <?php
            include "server.php";
            

            if(isset($_GET['edit'])) {
                $id = $_GET['edit'];
            
                $rec = mysqli_query($db, "SELECT nume, sigla FROM party WHERE id='$id'");
                $record = mysqli_fetch_array($rec);
                $nume = $record['nume'];
                $sigla = $record['sigla'];
            }
        
            if(isset($_POST['save_party'])){
                $nume = $_POST['nume'];
                $sigla = $_POST['logo'];
                $nume = mysqli_real_escape_string($db, filter_var($nume, FILTER_SANITIZE_STRING));
                $sigla = mysqli_real_escape_string($db, filter_var($sigla, FILTER_SANITIZE_STRING));

                mysqli_query($db, "UPDATE party SET nume='$nume', sigla='$sigla' WHERE id='$id'");
                header("location: admin-party.php");
            
            }
            ?>
            <form method="POST">
                <label class="label_text" for="nume">Numele partidului</label>
                <input class="input_text" id="nume" type="text" name="nume" value="<?php echo "$nume"; ?>" required
                    autofocus>
                <label class="label_text" for="logo">Sigla</label>
                <input class="input_text" id="logo" type="text" name="logo" value="<?php echo "$sigla"; ?>">
                <div>
                    <input class="input_submit" type="submit" name="save_party" value="Salvează">
                </div>
            </form>
        </div>
        <div id="footer">
            <p>Copyright &copy; 2020 Sebastian Projects. All Rights Reserved</p>
            <p>For test purposes only</p>
        </div>
    </div>
</body>

</html>