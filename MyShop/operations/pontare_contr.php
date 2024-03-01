<?php

    declare(strict_types= 1);
    function create_ponting(object $pdo, string $articol, string $codarticol, string $pret, string $termen, string $brand, string $id, string $ore, string $nrbucati)
    {
        set_articol($pdo, $articol, $codarticol, $pret, $termen, $brand);
        
        $sql = "SELECT MAX(C.ArticolID) AS 'ArticolID'
                FROM angajati A JOIN liniedeproductie B ON A.LinieProductieID = B.LinieProductieID
                                JOIN articolevestimentare C ON B.LinieProductieID = C.LinieProductieID
                WHERE A.AngajatiD = $id ;";
        
        $result = $pdo->query($sql);
        if ($result){
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $articolid = $row["ArticolID"];
            set_ore($pdo, $id, $articolid, $ore);
            set_bucati($pdo, $nrbucati, $articolid);
        }

    }

    function is_codart_empty( string $codarticol )
    {
        if(empty($codarticol) ) {
            return true;
        } else {
            return false;
        }
    }

    function is_codart_the_same(object $pdo, string $codarticol )
    {
        if(also($pdo, $codarticol) ) {
            return true;
        } else {
            return false;
        }
    }
