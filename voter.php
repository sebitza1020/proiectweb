<!DOCTYPE html>
<html lang="ro">

<head>
    <title>Meniu Votant</title>
    <meta charset="utf-8">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link href="css/votant.css" rel="stylesheet" type="text/css">
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
            
            if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
            ?>
            <h5>ROMÂNIA</h5>
            <h4>ALEGERI PARLAMENTARE 2020</h4>
            <h3>Bun venit, <?php echo $_SESSION['user_name']; ?>!</h3>
        </div>
        <div id="menu">
            <h2>Rezultatele:</h2>
            <table class="results" border="5px">
                <th>Poziția</th>
                <th>Partidul</th>
                <th>Sigla</th>
                <th>Nr. voturi</th>
                <th>Procent</th>
                <?php
                        
                    $get_party = "SELECT nume, sigla, (SELECT count(*) FROM vote v WHERE v.id_party= p.id) AS voturi FROM party p ORDER BY voturi DESC";
                    $total_vote = "SELECT count(*) FROM vote v";
                    $run_party = mysqli_query($db, $get_party);
                    $run_total = mysqli_query($db, $total_vote);
                    $count_party = mysqli_fetch_row($run_total);
                    $sum_votes = $count_party[0];

                    if(mysqli_num_rows($run_party) > 0) {
                        while($row_party = mysqli_fetch_assoc($run_party)) {
                            $percentage = 0;
                            $party_votes = $row_party['voturi'];
                            if($party_votes != 0) {
                                $percentage = round(($party_votes/$sum_votes)*100);
                            }
                            echo "<tr><td>$i_p</td><td><label class=\"form_label\">" . $row_party['nume'] . "</label></td><td><img src=\"" . $row_party['sigla'] 
                                    . "\" width=\"50px\" height=\"50px\" alt=\"Fără siglă\"></td><td>" . $row_party['voturi'] . "</td><td>" 
                                    . $percentage . "%</td></tr>";
                            $i_p++;
                        }
                    }?>
            </table>
            <form method="POST">
                <input class="reg" type="submit" name="exit" value="Deconectare">
            </form>
            <?php
            }
            else {
                $_SESSION['log-check'] = "E-mail sau parolă incorecte. Sau posibil să nu fi fost înregistrat.";
                header("location: login-voter.php");
            }
            
            if(isset($_POST['exit'])) {
                session_start();
                session_destroy();
                header("Location: login-voter.php");
                exit;
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