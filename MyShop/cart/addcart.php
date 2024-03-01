<?php
// Hardcodare de urgenta!!
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputValues = $_POST['inputs'];
    $codesValues = $_POST['codes']; // ArticolID
    $magazinid = $_POST['Magazin']; // ExportID

    require_once '../include/db.inc.php';

    try {
        // Start a transaction
        $pdo->beginTransaction();

        // FIRST LOOP
        foreach (array_map(null, $inputValues, $codesValues) as [$value1, $value2]) {
            if ($value1) {

                $query = "SELECT ArticolID, ExportID FROM articoleexport WHERE ArticolID = :value2 AND ExportID = :magazinid;";
                $error = $pdo->prepare($query);
                $error->bindParam(':value2', $value2);
                $error->bindParam(':magazinid', $magazinid);
                $error->execute();

                $rowCount = $error->rowCount();

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
                            SET A.NrBucati = A.NrBucati + :value1 
                            WHERE A.ArticolID = :value2";

                    $anstmt = $pdo->prepare($ansql);
                    $anstmt->bindParam(':value1', $value1);
                    $anstmt->bindParam(':value2', $value2);
                    $anstmt->execute();
                }

            }

            //Second LOOP
            foreach (array_map(null, $inputValues, $codesValues) as [$value1, $value2]) {
                
                $sql = "UPDATE articoleexport A JOIN articolevestimentare B ON A.ArticolID = B.ArticolID
                        SET A.NrBucati = A.NrBucati - :value1 
                        WHERE B.ArticolID = :value2 AND A.ExportID = 3;"; //SCADERE DIN Depozit

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':value1', $value1);
                $stmt->bindParam(':value2', $value2);
                $stmt->execute();
        
            }

            // THE UPDATES DONT WORK SIMULTAN AND YOU NEEED TO MAKE TWO SEPARATE LOOPS
        }

        // Commit the transaction
        $pdo->commit();
        header('Location: ../userexport.php');

    } catch (PDOException $e) {
        // Rollback the transaction on error
        $pdo->rollBack();
        echo "Error: " . $e->getMessage();
    }
}
