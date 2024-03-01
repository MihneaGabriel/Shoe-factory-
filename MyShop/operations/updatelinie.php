<?php
    require_once '../include/db.inc.php';

    $id = $_GET["updateid"];
    if(isset($_POST['submit'])){
        $linieid = $_POST["LinieProductieID"];


        #ERROR HANDLER
        $stmt = "";
        $querry = "SELECT TOP 1 $stmt=LinieProductieID FROM angajati ORDER BY LinieProductieID;";
        if(!$stmt){
            header("Location: ../dislinieprod.php");
            echo "Linie de productie INEXISTENTA!";
        }

        $sql = "UPDATE angajati SET AngajatiD=$id, LinieProductieID=$linieid WHERE AngajatiD=$id;";
        $result = $pdo->query($sql);
        if($result){
            header("Location: ../dislinieprod.php");
        }else {
            die();
        }
    }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Security-Policy" content="
    default-src 'self';
    script-src 'self' 'unsafe-eval' https://trusted-cdn.com;
    ">
    <title>MyShop</title>
    <link rel="stylesheet" href="../style/indexstyle.css">

</head>

<body>
    <form method="post">

        <h3 class="display-2">Modificati linia de productie</h3>
        <input type="number" value="0" name="LinieProductieID" placeholder="Introduceti o noua linie de productie">
        <button type="submit" name="submit">Update</button>

    </form>


</body>

</html>