<?php
require_once 'include/db.inc.php';
require_once 'operations/pontare_view.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/Popup.css">
    <link rel="stylesheet" href="style/anotherindexstyle.css">
    <script src="javascript/popup.js"></script>


    <title>Meniu Control</title>
</head>

<body>
    <?php
    require_once 'include/config_session.inc.php';
    $title = $_SESSION["user_username"];
    ?>
    <nav class="navbar navbar-expand-lg bg-body-tertiary " style="background-color: #2d545e;">
        <div class="container-fluid">
            <a class="navbar-brand" href="userdisplay.php">Hello
                <?php echo $title; ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="usertodo.php">To Do</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="userexport.php">Export</a>
                    </li>
                    <li class="nav-item">
                        <?php
                        echo '<a class="nav-link" href="#" onclick="displayPopup(event)">Add intretinere</a>';
                        ?>
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
                    <th scope="col">Articol</th>
                    <th scope="col">Cod Articol</th>
                    <th scope="col">Pret</th>
                    <th scope="col">Nr Bucati</th>
                    <th scope="col">Termen limita</th>
                    <th scope="col" style="text-align:center">Brand</th>
                    <th scope="col" style="text-align:center">Nr. Ore Saptamana</th>
                    <th scope="col"></th>

                </tr>
            </thead>
            <tbody>

                <?php

                // echo $title; // Aici e bine
                $sql = "SELECT AngajatiD FROM angajati
                        WHERE Nume='$title';";
                $result = $pdo->query($sql);

                if ($result) {
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        $id = $row["AngajatiD"];


                        echo '<form action="operations/pontare.php" method="post">
                        <tr>
                        <th scope="row"><input type="hidden" name="id" value="' . $id . '" >
                        ' . $id . '</th>
                        <td><select name="Articol">
                            <option value="Tricou">Tricou</option>
                            <option value="Pantaloni">Pantaloni</option>
                            <option value="Geaca">Geaca</option>
                            <option value="Blugi">Blugi</option>
                            <option value="Camasa">Camasa</option>
                            <option value="Hanorac">Hanorac</option>
                        </select></td>
                        <td><input type="text" name="CodArticol" placeholder="CodArticol"></td>
                        <td><input type="number" value="0" name="Pret" placeholder="Pret"></td>
                        <td><input type="number" value="0" name="Bucati" placeholder="Bucati"></td>
                        <td><input type="date" name="TermenLimita" placeholder="TermenLimita"></td>';

                        $stmt = "SELECT B.LinieProductieID AS 'linieid', B.NumeBrand AS 'brand' 
                                 FROM liniedeproductie B JOIN angajati A ON B.LinieProductieID = A.LinieProductieID
                                 WHERE A.AngajatiD = $id ;";
                        $brandresult = $pdo->query($stmt);
                        $row1 = $brandresult->fetch(PDO::FETCH_ASSOC);
                        
                        echo '<td><h3><input type="hidden" name="SelectedBrand" value="' . $row1['linieid'] . '">
                             '. $row1['brand'] .'</h3></td>';
                        
                        echo '<td><input type="number" value="0" name="Ore" placeholder="Ore"></td>
                              <td><h3><button class="btn btn-info btn-sm">Finish</button></h3></td>
                              </tr></form>';
                    }
                }

                ?>
            </tbody>
        </table>
    </div>

    <?php
        check_ponting_errors()
    ?>

    <div id="popup">
        <p class="h6">Are you sure?</p>
        <button class="btn btn-info"
            onclick="closePopupDa('operations/addintretinere.php?addid=<?php echo urlencode($title); ?>')">DA</button>
        <button class="btn btn-danger" onclick="closePopupNu(event)">NU</button>
    </div>

</body>

</html>