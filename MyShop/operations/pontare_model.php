<?php
function set_articol(object $pdo, string $articol, string $codarticol, string $pret, string $termen, string $brand)
{
    $query = "INSERT INTO articolevestimentare(NumeModel, CodArticol, Pret, TermenLimita, LinieProductieID ) VALUES
               (:NumeModel, :CodArticol, :Pret, :TermenLimita, :LinieProductieID);";
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":NumeModel", $articol);
    $stmt->bindParam(":CodArticol", $codarticol);
    $stmt->bindParam(":Pret", $pret);
    $stmt->bindParam(":TermenLimita", $termen);
    $stmt->bindParam(":LinieProductieID", $brand);
    $stmt->execute();
}

function set_ore(object $pdo, string $id, string $articolid,  string $ore)
{
    $query = "INSERT INTO angajatiarticole(AngajatID, ArticolID, NrOreSaptamana) VALUES
               (:AngajatID, :ArticolID, :NrOreSaptamana);";
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":AngajatID", $id);
    $stmt->bindParam(":ArticolID", $articolid);
    $stmt->bindParam(":NrOreSaptamana", $ore);
    $stmt->execute();
}

function set_bucati(object $pdo, string $nrbucati , string $articolid )
{

    $query = "INSERT INTO articoleexport(ExportID, ArticolID, NrBucati) VALUES
              (:ExportID, :ArticolID, :NrBucati);";
    $stmt = $pdo->prepare($query);

    $export = 3;
    $stmt->bindParam(":ExportID", $export); // Asignam tot timpul articolele depozitului 
    $stmt->bindParam(":ArticolID", $articolid);
    $stmt->bindParam(":NrBucati", $nrbucati);
    $stmt->execute();
}

function also( object $pdo, string $codarticol )
{
    $sql = "SELECT ArticolID
            FROM articolevestimentare
            WHERE CodArticol = '$codarticol';";
    $result = $pdo->query($sql);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    return $row['ArticolID'];
}



