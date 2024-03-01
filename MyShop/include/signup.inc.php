
<?php

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $nume = $_POST["Nume"];
        $prenume = $_POST["Prenume"];
        $cnp = $_POST["CNP"];
        $oras = $_POST["Oras"];
        $strada = $_POST["Strada"];
        $nrtel = $_POST["NrTel"];
        $sex =  $_POST["Sex"];
        $data = $_POST["DataNasterii"];
        $salariu = $_POST["Salariu"];
        $linie = $_POST["Linie"];



        try {
            require_once "db.inc.php";
            require_once 'signup_model.inc.php';
            require_once 'signup_contr.inc.php';

            // ERROR HANDLERS
            $errors = [];

            if( is_input_empty($nume, $cnp) ){
                $errors["empty_input"] = "Completati toate campurile!";
            }
            if( is_username_taken($pdo, $nume)){
                $errors["username_taken"] = "Numele de utilizator exista deja!";
            }

            if( is_lastname_taken($pdo, $prenume)){
                $errors["lastname_taken"] = "Prenumele exista deja!";
            }

            if( is_cnp_taken($pdo, $cnp)){
                $errors["CNP_taken"] = "Codul numeric personal exita deja!";
            }

            require_once 'config_session.inc.php';

            if($errors) { // return true if there is data inside the array
                $_SESSION["errors_signup"] = $errors;

                $signupData = [
                    "Nume Utilizator" => $nume,
                    "Prenume" => $prenume,
                    "Cod numeric personal " => $cnp
                ];

                $_SESSION["signup_data"] = $signupData; // Send the data back to the signup form

                header("Location: ../signup.php");
                die();
            }

            create_user($pdo, $nume, $prenume, $cnp, $oras, $strada, $nrtel, $sex, $data, $salariu, $linie );
            header("Location: ../signup.php?signup=success");
            
            $pdo = null;
            $stmt = null;
            
            die();

        } catch (PDOException $e) {
            die("Querry failed: " . $e->getMessage());
        }

    }
    else{
        header("Location: ../signup.php");
        die();
    }

    