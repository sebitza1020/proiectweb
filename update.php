<!DOCTYPE html>
<html lang="ro">

<head>
    <title>Modificare date alegător</title>
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
            <h2>Modificați datele personale ale votantului:</h2>
        </div>
        <div id="form-update">
            <?php
            include "server.php";
            

            if(isset($_GET['edit'])) {
                $id = $_GET['edit'];
            
                $rec = mysqli_query($db, "SELECT nume, prenume, data_nasterii, email, tel, adresa, cnp, sn FROM voter WHERE id='$id'");
                $record = mysqli_fetch_array($rec);
                $nume = $record['nume'];
                $prenume = $record['prenume'];
                $birthday = $record['data_nasterii'];
                $email = $record['email'];
                $tel = $record['tel'];
                $address = $record['adresa'];
                $cnp = $record['cnp'];
                $sn = $record['sn'];
            }
        
            if(isset($_POST['save'])){
                $nume = mysqli_real_escape_string($db, filter_var($nume, FILTER_SANITIZE_STRING));
                $prenume = mysqli_real_escape_string($db, filter_var($prenume, FILTER_SANITIZE_STRING));
                $birthday = mysqli_real_escape_string($db, filter_var($birthday, FILTER_SANITIZE_STRING));
                $email = mysqli_real_escape_string($db, filter_var($email, FILTER_SANITIZE_EMAIL));
                $tel = mysqli_real_escape_string($db, filter_var($tel, FILTER_SANITIZE_STRING));
                $address = mysqli_real_escape_string($db, filter_var($address, FILTER_SANITIZE_STRING));
                $cnp = mysqli_real_escape_string($db, filter_var($cnp, FILTER_SANITIZE_STRING));
                $sn = mysqli_real_escape_string($db, filter_var($sn, FILTER_SANITIZE_STRING));

                mysqli_query($db, "UPDATE voter SET nume='$nume', prenume='$prenume', data_nasterii='$birthday', email='$email', tel='$tel', 
                            adresa='$address', cnp='$cnp', sn='$sn' WHERE id='$id'");
                header("location: admin.php");
            
            }
        ?>
            <form method="POST">
                <label class="label_text" for="nume">Numele de familie</label>
                <input class="input_text" id="nume" type="text" name="nume" value="<?php echo "$nume"; ?>" required
                    autofocus>
                <label class="label_text" for="prenume">Prenumele</label>
                <input class="input_text" id="prenume" type="text" name="prenume" value="<?php echo "$prenume"; ?>"
                    required>
                <label class="label_text" for="birthday">Data nașterii</label>
                <input class="input_date" id="birthday" type="text" name="birthday" value="<?php echo "$birthday"; ?>"
                    required>
                <label class="label_text" for="email">Email</label>
                <input class="input_text" id="email" type="email" name="email" value="<?php echo "$email"; ?>">
                <label class="label_text" for="tel">Număr de telefon</label>
                <input class="input_text" id="tel" type="tel" name="tel" maxlength="10" value="<?php echo "$tel"; ?>"
                    required>
                <label class="label_text" for="adresa">Adresa de domiciliu</label>
                <input class="input_text" id="adresa" type="text" name="adresa" value="<?php echo "$address"; ?>"
                    required>
                <label class="label_text" for="cnp">CNP</label>
                <input class="input_text" id="cnp" type="text" name="cnp" maxlength="13" value="<?php echo "$cnp"; ?>"
                    required>
                <label class="label_text" for="sn">Seria și număr de buletin</label>
                <input class="input_text" id="sn" type="text" name="sn" maxlength="8" value="<?php echo "$sn"; ?>"
                    required>
                <div id="button">
                    <input class="input_submit" type="submit" name="save" value="Salvează">
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