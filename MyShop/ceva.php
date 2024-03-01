<?php
// Hardcodare de urgenta!!
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputValues = $_POST['inputs'];
    $codesValues = $_POST['codes']; // ArticolID
    $magazinid = $_POST['Magazin']; // ExportID
    //echo $magazinid;


    // Display the values
    // print_r($inputValues);
    // print_r($codesValues);

    require_once '../include/db.inc.php';

    $pdo->beginTransaction();

    foreach (array_map(null, $inputValues, $codesValues) as [$value1, $value2]) {


        if ($value1) {


            $sql = "UPDATE articoleexport A JOIN articolevestimentare B ON A.ArticolID = B.ArticolID
                    SET A.NrBucati=  A.NrBucati - $value1 
                    WHERE B.ArticolID = $value2 AND A.ExportID = 3 ;"; // SCADERE DIN DEPOZIT

            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            // echo $value2 . " " . $magazinid . " " . $value1 . " \n";

            $query = "SELECT ArticolID, ExportID FROM articoleexport WHERE ArticolID = $value2 AND ExportID = $magazinid ;";
            $error = $pdo->query($query);
            if ($error != false) { // DACA NU EXISTA DEJA
                $rowCount = $error->rowCount();
                echo "" . $rowCount . "";
                if ($rowCount == 0) {

                    $ansql = "INSERT INTO articoleexport(ArticolID, ExportID, NrBucati) VALUES
                (:ArticolID, :ExportID, :NrBucati);";

                    $anstmt = $pdo->prepare($ansql);

                    $anstmt->bindParam(":ArticolID", $value2);
                    $anstmt->bindParam(":ExportID", $magazinid);
                    $anstmt->bindParam(":NrBucati", $value1);
                    $anstmt->execute();

                } else {
                    $ansql = "UPDATE articoleexport A 
                    SET A.NrBucati=  A.NrBucati + $value1 
                    WHERE A.ArticolID = $value2 "; // ADAUGARE IN MAGAZINE

                    $anstmt = $pdo->prepare($ansql);
                    $anstmt->execute();
                }

            } else {
                echo "Exista deja in baza de date";
            }
        }

    }
    $pdo->commit();

}


?>