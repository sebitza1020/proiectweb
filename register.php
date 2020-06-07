<!DOCTYPE html>
<html lang="ro">

<head>
    <title>Înregistrare alegător</title>
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
            <h2>Introduceți datele dvs. personale:</h2>
        </div>
        <div id="formular">
            <form method="POST" action="verified.php">
                <label class="label_text" for="nume">Numele de familie</label>
                <input class="input_text" id="nume" type="text" name="nume" required autofocus>
                <label class="label_text" for="prenume">Prenumele</label>
                <input class="input_text" id="prenume" type="text" name="prenume" required>
                <label class="label_text" for="birthday">Data nașterii</label>
                <input class="input_date" id="birthday" type="text" name="birthday" required>
                <label class="label_text" for="email">Email</label>
                <input class="input_text" id="email" type="email" name="email" required>
                <label class="label_text" for="password">Parolă</label>
                <input class="input_text" id="password" type="password" name="password1" required>
                <label class="label_text" for="password">Confirmare parolă</label>
                <input class="input_text" id="password" type="password" name="password2" required>
                <label class="label_text" for="tel">Număr de telefon</label>
                <input class="input_text" id="tel" type="tel" name="tel" maxlength="10" required>
                <label class="label_text" for="adresa">Adresa de domiciliu</label>
                <input class="input_text" id="adresa" type="text" name="adresa" required>
                <label class="label_text" for="cnp">CNP</label>
                <input class="input_text" id="cnp" type="text" name="cnp" maxlength="13" required>
                <label class="label_text" for="sn">Seria și număr de buletin</label>
                <input class="input_text" id="sn" type="text" name="sn" maxlength="8" required>
                <label class="label_text" for="tc">Vă rugăm să bifați următoarea căsuță:</label>
                <div>
                    <input class="input_checkbox" id="tc" type="checkbox" name="tc" required>
                    Sunt de acord că am vârsta de 18 ani sau mai mult pentru a participa la vot.
                </div>
                <div>
                    <input class="input_submit" type="submit" name="registered" value="Trimite">
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