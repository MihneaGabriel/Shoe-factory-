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
    $title = $_SESSION["user_username"];
    ?>
    <nav class="navbar navbar-expand-lg bg-body-tertiary " style="background-color: #2d545e;">
        <div class="container-fluid">
            <a class="navbar-brand" href="display.php">Hello
                <?php echo $title; ?>
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
                    <th scope="col">Nume Brand</th>
                    <th scope="col">CodRaion</th>
                    <th scope="col">Nr. Angajati Necesari </th>
                    <th scope="col">Media Salarilor </th>
                </tr>
            </thead>
            <tbody>

                <?php
                $value = 0;
                $sql1 = "SELECT A.*, ( SELECT 5 - COUNT(B.AngajatiD)
                                               FROM angajati B 
                                               WHERE A.LinieProductieID = B.LinieProductieID
                                             ) AS 'NrNecesari', AVG(C.Salariu) AS MediaSalarilor
                        FROM liniedeproductie A LEFT JOIN angajati C ON A.LinieProductieID = C.LinieProductieID
                        GROUP BY A.LinieProductieID";

                $result = $pdo->query($sql1);

                if ($result) {
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        $id = $row["LinieProductieID"];
                        $nume = $row["NumeBrand"];
                        $codraion = $row["CodRaion"];
                        $necesari = $row["NrNecesari"];
                        $media = $row["MediaSalarilor"];


                        if($necesari < 0) // Daca nr de angajati necesari a fost atins
                            $necesari = 'None';

                        if(!$media) // Daca nu avem medie , nu exista angajati
                            $media = "Nu exista angajati";

                        echo '<tr>
                        <th scope="row">' . $id . '</th>
                        <td>' . $nume . '</td>
                        <td>' . $codraion . '</td>
                        <td>' . $necesari . '</td>
                        <td>' . $media . '</td>
                        </tr>';
                    }
                }

                ?>
            </tbody>
        </table>
    </div>



    <div id="popup">
        <p class="h6">Are you sure?</p>
        <button class="btn btn-info"
            onclick="closePopupDa('operations/addintretinere.php?addid=<?php echo urlencode($title); ?>')">DA</button>
        <button class="btn btn-danger" onclick="closePopupNu(event)">NU</button>
    </div>


</body>

</html>