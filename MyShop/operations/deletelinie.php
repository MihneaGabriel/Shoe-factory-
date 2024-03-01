<?php
    require_once '../include/db.inc.php';
    if(isset($_GET['deleteid'])){
        $id = $_GET['deleteid'];

        $sql = "DELETE LinieProductieID FROM angajati WHERE LinieProductieID=$id;";
        $result = $pdo->query($sql);
        if($result){
            header('Location: ../dislinieprod.php');
        } else{
            die();
        }
    }

?>