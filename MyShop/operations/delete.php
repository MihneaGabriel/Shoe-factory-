<?php
    require_once '../include/db.inc.php';
    if(isset($_GET['deleteid'])){
        $id = $_GET['deleteid'];

        $sql = "DELETE FROM angajati WHERE AngajatiD=$id;";
        $result = $pdo->query($sql);
        if($result){
            header('Location: ../display.php');
        } else{
            die();
        }
    }

?>