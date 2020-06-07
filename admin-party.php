<!DOCTYPE html>
<html lang="ro">

<head>
    <title>Admin Partide</title>
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
                $i = 1;

                if(isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id'])) {
            ?>
            <h5>ROMÂNIA</h5>
            <h4>ALEGERI PARLAMENTARE 2020</h4>
            <h3>Bun venit, <?php echo $_SESSION['admin_name']; ?>!</h3>
        </div>
        <div id="menu">
            <h4>Partidele participante la alegeri:</h4>
            <table class="adm-party" border="5px">
                <th>Nr. crt</th>
                <th>Partidul</th>
                <th>Sigla</th>
                <th colspan="2">Acțiune</th>
                <?php   
                    $get_party = "SELECT id, nume, sigla FROM party";
                    $run_party = mysqli_query($db, $get_party);

                    if(mysqli_num_rows($run_party) > 0) {
                        while($row_party = mysqli_fetch_assoc($run_party)) {
                            echo "<tr><td>" . $i . "</td><td><label class=\"form_label\">" . $row_party['nume'] . "</label>
                                    </td><td><img src=\"" . $row_party['sigla'] 
                                    . "\" width=\"50px\" height=\"50px\" alt=\"Fără siglă\"></td><td>" . 
                                    "<a href=\"update-party.php?edit=" . $row_party["id"] . "\">Editează</a></td><td>" . 
                                    "<a href=\"admin-party.php?delete=" . $row_party["id"] . "\">Șterge</a>" . "</td></tr>";
                            $i++;
                        }
                    }
                ?>
            </table>
            <div id="navi">
                <p class="adm"><a href="insert-party.php">Adăugați un nou partid</a></p>
                <p class="adm"><a href="admin.php">Înapoi</a></p>
            </div>
            <?php
                if(isset($_GET['delete'])) {
                    $id = $_GET['delete'];
                    mysqli_query($db, "DELETE FROM party WHERE id='$id'");
                    mysqli_query($db, "DELETE FROM vote WHERE id_party='$id'");
                    header("location: admin-party.php");
                }
            }  
            else {
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