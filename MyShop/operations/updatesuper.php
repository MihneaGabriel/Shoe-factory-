<?php
    require_once '../include/db.inc.php';

    $id = $_GET["updateid"];
    if(isset($_POST['submit'])){
        $supervizor = $_POST["SupervizorID"];


        #ERROR HANDLER
        $stmt = "";
        $querry = "SELECT TOP 1 $stmt=AngajatiD FROM angajati ORDER BY AngajatiD;";
        if(!$stmt){
            header("Location: ../dislinieprod.php");
            echo "Supervizor INEXISTENT!";
        }

        $sql = "UPDATE angajati SET AngajatiD=$id, SupervizorID=$supervizor WHERE AngajatiD=$id;";
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

        <h3 class="display-2">Adaugati/Modificati Supervizor</h3>
        <input type="number" value="0" name="SupervizorID" placeholder="Adaugati/Modificati Supervizor">
        <button type="submit" name="submit">Update</button>

    </form>


</body>

</html>