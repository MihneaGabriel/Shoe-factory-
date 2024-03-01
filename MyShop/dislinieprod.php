<?php
require_once 'include/db.inc.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/Popup.css">
    <script src="javascript/popup.js"></script>
    <title>Meniu Control</title>
</head>

<body>
    <?php
    require_once 'include/config_session.inc.php';
    $nume = $_SESSION["user_username"];
    $id = $_SESSION["user_id"];

    ?>
    <nav class="navbar navbar-expand-lg bg-body-tertiary " style="background-color: #2d545e;">
        <div class="container-fluid">
            <a class="navbar-brand" href="display.php">Hello
                <?php echo $nume; ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="dislinieprod.php">Production</a>
                    </li>
                    <!-- <li class="nav-item">
                        <?php
                        echo '<a class="nav-link" href="#" onclick="displayPopup(event)">Add intretinere</a>';
                        ?>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="distrace.php">Trace</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dislack.php">Lack of employees</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Log out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container">
        <table class="table my-5">
            <thead class="thead" style="background-color: #2d545e;">
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Nume</th>
                    <th scope="col">Prenume</th>
                    <th scope="col" style="text-align:center">Linie de Productie</th>
                    <th scope="col" style="text-align:center">Supervizor</th>
                    <th scope="col" style="text-align:center">Nr. ore lucrate</th>
                    <th scope="col" style="text-align:center">Operation</th>

            </thead>
            <tbody>

                <?php

                $sql = "SELECT A.AngajatiD, A.Nume, A.Prenume, B.NumeBrand, C.Nume AS 'NumeSupervizor', ( SELECT SUM(NrOreSaptamana)
                                                                                                          FROM `angajatiarticole`
                                                                                                          WHERE AngajatID = A.AngajatiD
                                                                                                        ) AS 'NrOreLucrate'
                        FROM angajati A
                        INNER JOIN liniedeproductie B ON A.LinieProductieID = B.LinieProductieID 
                        LEFT JOIN angajati AS C ON A.SupervizorID = C.AngajatiD
                        GROUP BY A.AngajatiD
                        ORDER BY ( SELECT AVG(NrOreSaptamana)
                                   FROM angajatiarticole
                                   WHERE AngajatID = A.AngajatiD
                                 ) DESC;"; // ordonata descrescator dupa media numarului de ore pe care le lucreaza saptamanal in productie.
                        
                $result = $pdo->query($sql);

                if ($result) {
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        $id = $row["AngajatiD"];
                        $nume = $row["Nume"];
                        $prenume = $row["Prenume"];
                        $linieid = $row["NumeBrand"];
                        $supervizor = $row["NumeSupervizor"];
                        $nrorelucrate = $row["NrOreLucrate"];

                        if(!$nrorelucrate)
                            $nrorelucrate = "Concediu";

                        echo '<tr>
                        <th scope="row">' . $id . '</th>
                        <td>' . $nume . '</td>
                        <td>' . $prenume . '</td>
                        <td class="align-middle" style="text-align:center">' . $linieid . '</td>
                        <td class="align-middle" style="text-align:center">' . $supervizor . '</td>
                        <td class="align-middle" style="text-align:center">' . $nrorelucrate . '</td>
                        <td style="text-align:center">
                        <button class="btn btn-info btn-sm" ><a href="operations/updatelinie.php?
                        updateid=' . $id . '" class="text-light align-middle">Update Linie</a></button>
                        <button class="btn btn-info btn-sm" ><a href="operations/updatesuper.php?
                        updateid=' . $id . '" class="text-light align-middle">Update Supervizor</a></button>
                        <button class="btn btn-danger btn-sm" ><a href="operations/deletesuper.php?
                        deleteid=' . $id . '" class="text-light align-middle">Delete Supervizor</a></button>
                        </tr>';
                    }
                }

                ?>
            </tbody>
        </table>
    </div>


    <div id="popup">
        <p class="h6">Sunteti sigur?</p>
        <button class="btn btn-info" onclick="closePopupDa('operations/addintretinere.php?addid=<?php echo urlencode($nume); ?>')">DA</button>
        <button class="btn btn-danger" onclick="closePopupNu(event)">NU</button>
    </div>
    
</body>

</html>