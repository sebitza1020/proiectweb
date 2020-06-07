<!DOCTYPE html>
<html lang="ro">

<head>
    <title>Vot</title>
    <meta charset="utf-8">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link href="css/vote.css" rel="stylesheet" type="text/css">
    <link href="img/main.png" rel="icon">
</head>

<body>
    <div id="wrapper">
        <?php
            include "server.php";
            session_start();
        ?>
        <div id="header">
            <h5>ROMÂNIA</h5>
            <h4>ALEGERI PARLAMENTARE 2020</h4>
            <?php if(isset($_SESSION['proc_id']) && !empty($_SESSION['proc_id'])){ ?>
            <h3><?php echo $_SESSION['proc_vot']; ?></h3>
            <h2>Alegeți cu cine vreți să votați:</h2>
        </div>
        <div id="voting">
            <form action="checked.php" method="POST">
                <table>
                    <?php
                        $show_party = "SELECT * FROM party";
                        $query_party = mysqli_query($db, $show_party);
                        $id_voter=$_GET['voterid'];
                        
                        echo "<input type=\"hidden\" name=\"voterid\" value=\"$id_voter\" />";
                        if(mysqli_num_rows($query_party) > 0) {
                            while($row_party = mysqli_fetch_assoc($query_party)) {
                                echo "<tr><td><label class=\"form_label\">" . $row_party['nume'] . "</label></td><td><img src=\"" . $row_party['sigla'] 
                                        . "\" width=\"50px\" height=\"50px\"></td><td><input type=\"radio\" id=\"" . 
                                        $row_party['id'] . "\" name=\"party_radiogroup\" value=\"" . $row_party['id'] . "\"></td></tr>";
                            }
                        }?>
                </table>
                <p class="msg"><?php if(isset($_SESSION['vot-error'])) {echo $_SESSION['vot-error']; unset($_SESSION['vot-error']);} ?></p>
                <input class="vote_submit" type="submit" name="trimis" value="Trimite">
            </form>
            <?php
                }
                else {
                    header("location: index.php");
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