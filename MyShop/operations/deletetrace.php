<?php
    require_once '../include/db.inc.php';
    if(isset($_GET['deleteid'])){
        $id = $_GET['deleteid'];

        $sql = "DELETE articolevestimentare, angajatiarticole
                FROM articolevestimentare  INNER JOIN angajatiarticole 
                WHERE angajatiarticole.ArticolID = articolevestimentare.ArticolID AND angajatiarticole.ArticolID = $id;";
        $result = $pdo->query($sql);
        if($result){
            header('Location: ../distrace.php');
        } else{
            die();
        }
    }

?>