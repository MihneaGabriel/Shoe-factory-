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
                    <th scope="col">Articol</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Cod Articol</th>
                    <th scope="col">Nr. Bucati</th>
                    <th scope="col">ADD to Export</th>
                    <th scope="col"></th>

                </tr>
            </thead>
            <tbody>

                <?php
                // echo $title; // Aici e bine
                $sql = "SELECT A.NumeModel, A.CodArticol, A.ArticolID, B.NumeBrand, C.NrBucati
                        FROM articolevestimentare A LEFT JOIN liniedeproductie B ON A.LinieProductieID = B.LinieProductieID
                                                    LEFT JOIN articoleexport C ON A.ArticolID = C.ArticolID
                        WHERE C.ExportID = 3
                        HAVING C.NrBucati > 0";
                $result = $pdo->query($sql);

                echo '<form action="cart/addcart.php" method="post">';
                $i = 0;
                if ($result) {
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        $i = $i + 1;
                        $inputId = "input" . $i;

                        $nume = $row["NumeModel"];
                        $codarticol = $row["CodArticol"];
                        $articolid = $row["ArticolID"];
                        $brand = $row["NumeBrand"];
                        $nrbucati = $row["NrBucati"];

                        if (!$nrbucati)
                            $nrbucati = 0;

                        echo '<tr>
                        <th scope="row">' . $nume . '</th>
                        <td>' . $brand . '</td>
                        <td><input type="hidden" value="' . $articolid . '" name="codes[]" id="<?php echo $inputId; ?>" >' . $codarticol . '</td>
                        <td>' . $nrbucati . '</td>
                        <td><input type="number" value="0" name="inputs[]" id="<?php echo $inputId; ?>"></td>
                        </tr>';
                    }
                }
                echo '<p class="h5">Selectati un Magazin </p>
                    <select name="Magazin">
                    <option value="1">AFI</option>
                    <option value="2">Bull Ring</option>
                    </select>';
                echo '<p style="text-align:center"><button>Add to stock</button></p></form>';


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