<?php
    require_once '../include/db.inc.php';

    $id = $_GET["updateid"];
    if(isset($_POST['submit'])){
        $nume = $_POST["Nume"];
        $prenume = $_POST["Prenume"];
        $cnp = $_POST["CNP"];
        $oras = $_POST["Oras"];
        $strada = $_POST["Strada"];
        $nrtel = $_POST["NrTel"];
        $sex = $_POST["Sex"];
        $data = $_POST["DataNasterii"];
        $salariu = $_POST["Salariu"];

        $sql = "UPDATE angajati SET AngajatiD=$id, Nume='$nume', Prenume='$prenume', CNP='$cnp', Oras='$oras',
        Strada='$strada', NrTel='$nrtel', Sex='$sex', DataNasterii='$data', Salariu='$salariu' WHERE AngajatiD=$id;";
        $result = $pdo->query($sql);
        if($result){
            header("Location: ../display.php");
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

        <input type="text" name="Nume" placeholder="Nume de utilizator">
        <input type="text" name="Prenume" placeholder="Prenume">
        <input type="text" name="CNP" placeholder="Cod numeric personal">
        <input type="text" name="Oras" placeholder="Oras">
        <input type="text" name="Strada" placeholder="Strada">
        <input type="text" name="NrTel" placeholder="NrTel">
        <select name="Sex">
            <option value="M">Masculin</option>
            <option value="F">Feminin</option>
        </select>
        <input type="date" name="DataNasterii" placeholder="DataNasterii">
        <input type="number" value="0" name="Salariu" placeholder="Salariu">

        <button type="submit" name="submit">Update</button>

    </form>


</body>

</html>