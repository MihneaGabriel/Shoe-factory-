<?php

    require_once '../include/db.inc.php';
    if(isset($_GET['deleteid'])){
        $id = $_GET['deleteid'];

        $sql = "UPDATE angajati SET SupervizorID= NULL WHERE AngajatiD=$id;";
        $result = $pdo->query($sql);
        if($result){
            header('Location: ../dislinieprod.php');
        } else{
            die();
        }
    }

?>