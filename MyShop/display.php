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
                    <th scope="col">Nume</th>
                    <th scope="col">Prenume</th>
                    <th scope="col">CNP</th>
                    <th scope="col">Oras</th>
                    <th scope="col">Strada</th>
                    <th scope="col">Nr.Tel</th>
                    <th scope="col">Sex</th>
                    <th scope="col">Data Nasterii</th>
                    <th scope="col">Salariu</th>
                    <th scope="col">Operation</th>
                </tr>
            </thead>
            <tbody>

                <?php

               // echo $title; // Aici e bine
                $sql = "SELECT A.* 
                        FROM angajati A LEFT JOIN liniedeproductie D ON A.LinieProductieID = D.LinieProductieID
                        ORDER BY A.Salariu >= ( SELECT AVG(Salariu)
                                             FROM angajati
                                             WHERE LinieProductieID = A.LinieProductieID )";
                $result = $pdo->query($sql);

                if ($result) {
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        $id = $row["AngajatiD"];
                        $nume = $row["Nume"];
                        $prenume = $row["Prenume"];
                        $cnp = $row["CNP"];
                        $oras = $row["Oras"];
                        $strada = $row["Strada"];
                        $nrtel = $row["NrTel"];
                        $sex = $row["Sex"];
                        $data = $row["DataNasterii"];
                        $salariu = $row["Salariu"];
                        echo '<tr>
                        <th scope="row">' . $id . '</th>
                        <td>' . $nume . '</td>
                        <td>' . $prenume . '</td>
                        <td>' . $cnp . '</td>
                        <td>' . $oras . '</td>
                        <td>' . $strada . '</td>
                        <td>' . $nrtel . '</td>
                        <td>' . $sex . '</td>
                        <td>' . $data . '</td>
                        <td>' . $salariu . '</td>
                        <td>
                        <button class="btn btn-info btn-sm"><a href="operations/update.php?
                        updateid=' . $id . '" class="text-light">Update</a></button>
                        <button class="btn btn-danger btn-sm"><a href="operations/delete.php?
                        deleteid=' . $id . '" class="text-light">Delete</a></button>
                        </td>
                        </tr>';
                    }
                }

                ?>
            </tbody>
        </table>
    </div>

    <div id="popup">
        <p class="h6">Are you sure?</p>
        <button class="btn btn-info" onclick="closePopupDa('operations/addintretinere.php?addid=<?php echo urlencode($title); ?>')">DA</button>
        <button class="btn btn-danger" onclick="closePopupNu(event)">NU</button>
    </div>


</body>

</html>