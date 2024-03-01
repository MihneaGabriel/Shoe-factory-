<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nume = $_POST["Nume"];
    $cnp = $_POST["CNP"];


    try {
        require_once 'db.inc.php';
        require_once 'login_model.inc.php';
        require_once 'login_contr.inc.php';

        // ERROR HANDLERS
        $errors = [];

        if (is_input_empty($nume, $cnp)) {
            $errors["empty_input"] = "Completati toate campurile!";
        }

        $result = get_user($pdo, $nume);

        if (is_username_wrong($result)) {
            $errors["login_incorrect"] = "Incorrect login info!";
        }

        if (!is_username_wrong($result) && is_cnp_wrong($cnp, $result["CNP"])) {
            $errors["login_incorrect"] = "Incorrect login info!";
        }

        require_once 'config_session.inc.php';

        if ($errors) { // return true if there is data inside the array
            $_SESSION["errors_login"] = $errors;

            header("Location: ../login.php");
            die();
        }

        if (is_admin($nume, $cnp)) {
            $newSessionId = session_create_id();
            $sessionId = $newSessionId . "_" . $result["id"];
            session_id($sessionId);

            $_SESSION["user_id"] = $result["id"];
            $_SESSION["user_username"] = htmlspecialchars($result["Nume"]);

            $_SESSION["last_regeneration"] = time();

            header("Location: ../login.php?login=success");
            $pdo = null;
            $stmt = null;

            die();

        } else {

            $newSessionId = session_create_id();
            $sessionId = $newSessionId . "_" . $result["id"];
            session_id($sessionId);

            $_SESSION["user_id"] = $result["id"];
            $_SESSION["user_username"] = htmlspecialchars($result["Nume"]);

            $_SESSION["last_regeneration"] = time();

            header("Location: ../login.php?login=nonadmin");
            $pdo = null;
            $stmt = null;

            die();

        }
    } catch (PDOException $e) {
        die("Querry failed: " . $e->getMessage());
    }
} else {
    header("Location: ../login.php");
    die();
}


