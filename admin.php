<!DOCTYPE html>
<html lang="ro">

<head>
    <title>Admin</title>
    <meta charset="utf-8">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link href="css/administrator.css" rel="stylesheet" type="text/css">
    <link href="img/main.png" rel="icon">
</head>

<body>
    <div id="wrapper">
        <div id="header">
            <?php
            include "server.php";
            session_start();
            $i=1;
            $i_p=1;
            
        if(isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id'])) {?>
            <h5>ROMÂNIA</h5>
            <h4>ALEGERI PARLAMENTARE 2020</h4>
            <h3>Bun venit, <?php echo $_SESSION['admin_name']; ?>!</h3>
        </div>
        <div id="menu">
            <table class="results" border="5px">
                <th>Poziția</th>
                <th>Partidul</th>
                <th>Sigla</th>
                <th>Nr. voturi</th>
                <th>Procent</th>
                <?php    
                $get_party = "SELECT nume, sigla, (select count(*)  from vote v where v.id_party= p.id) as voturi FROM party p ORDER BY voturi DESC";
                $total_vote = "SELECT count(*)  FROM vote v";
                $run_party = mysqli_query($db, $get_party);
                $run_total = mysqli_query($db, $total_vote);
                $rowcount = mysqli_fetch_row($run_total);
                $sum_votes = $rowcount[0];

                if(mysqli_num_rows($run_party) > 0) {
                    while($row_party = mysqli_fetch_assoc($run_party))
                    {
                        $percentage = 0;
                        $party_votes = $row_party['voturi'];
                        if($party_votes != 0) {
                            $percentage = round(($party_votes/$sum_votes)*100); 
                        }
                        echo "<tr><td>$i_p</td><td><label class=\"form_label\">" . $row_party['nume'] . "</label>
                        </td><td><img src=\"" . $row_party['sigla'] 
                                . "\" width=\"50px\" height=\"50px\" alt=\"Fără siglă\"></td><td>" . $row_party['voturi'] . "</td><td>"
                                . $percentage . "%</td></tr>";
                        $i_p++;
                    }
                }
                ?>
            </table>
            <p class="adm"><a href="admin-party.php">Administrare partide</a></p>
            <h4>Au votat:</h4>
            <table class="adm-voter" border="5px">
                <th>Nr.crt</th>
                <th>Nume</th>
                <th>Prenume</th>
                <th>Email</th>
                <th>Nr. telefon</th>
                <th>Adresă domiciliu</th>
                <th>CNP</th>
                <th>Serie număr buletin</th>
                <th colspan="2">Acțiune</th>
                <?php
                $get_voters = "SELECT id, nume, prenume, data_nasterii, email, tel, adresa, cnp, sn FROM voter";
                $run_voters = mysqli_query($db, $get_voters);

                if(mysqli_num_rows($run_voters) > 0) {
                    while ($row_voters = mysqli_fetch_assoc($run_voters)) {
                        echo "<tr><td>" . $i . "</td><td>" . $row_voters["nume"] . "</td><td>" . $row_voters["prenume"] .
                             "</td><td>" . $row_voters['email'] . 
                                "</td><td>" . $row_voters['tel'] . "</td><td>" . $row_voters['adresa'] . 
                                "</td><td>" . $row_voters["cnp"] . "</td><td>" . $row_voters['sn'] . "</td><td>" . 
                                "<a href=\"update.php?edit=" . $row_voters["id"] . "\">Editează</a></td><td>" . 
                                "<a href=\"admin.php?del=" . $row_voters["id"] . "\">Șterge</a>" . "</td></tr>";
                        $i++;
                    }
                }
                ?>
            </table>
            <form action="logout.php" method="POST">
                <input class="reg" type="submit" name="logout" value="Deconectare">
            </form>
            <?php
            }
            else {
                $_SESSION['msg'] = "Conexiune eșuată. E-mail sau parolă incorecte";
                header("location: login-admin.php");
            }
        ?>
        </div>
        <div id="footer">
            <p>Copyright &copy; 2020 Sebastian Projects. All Rights Reserved</p>
            <p>For test purposes only</p>
        </div>
    </div>
</body>

</html>