<?php

include "../config.php";

function generateHackfestID($conn)
{
    $sql = "SELECT * FROM teams";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    $hackfestID = "HF" . str_pad($resultCheck + 1, 3, "0", STR_PAD_LEFT);

    return $hackfestID;
}

if (isset($_POST['register'])) {
    if (!isset($_POST['tl-name']) || !isset($_POST['tl-email']) || !isset($_POST['tl-phone']) || !isset($_POST['tl-gender']) || !isset($_POST['tl-dept']) || !isset($_POST['tl-year']) || !isset($_POST['college']) || !isset($_POST['t_title']) || !isset($_FILES['abstract-file'])) {
        header("Location: ../register.php?error=emptyfields");
    }

    $tl_name = $_POST['tl-name'];
    $tl_email = $_POST['tl-email'];
    $tl_phone = $_POST['tl-phone'];
    $tl_gender = $_POST['tl-gender'];
    $tl_dept = $_POST['tl-dept'];
    $tl_year = $_POST['tl-year'];
    $college = $_POST['college'];
    $t_title = $_POST['t_title'];
    $abstract_file = $_FILES['abstract-file'];

    // Check for team member details
    $tm_name = [];
    $tm_phone = [];
    $tm_gender = [];
    $tm_dept = [];
    $tm_year = [];

    // Check if mail already exists
    $sql = "SELECT * FROM registration WHERE EMAIL='$tl_email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        header("Location: ../register.php?error=mailExists");
    }

    for ($i = 0; $i <= 2; $i++) {
        if (isset($_POST['tm-name-' . $i]) && isset($_POST['tm-phone-' . $i]) && isset($_POST['tm-gender-' . $i]) && isset($_POST['tm-dept-' . $i]) && isset($_POST['tm-year-' . $i])) {
            $tm_name[$i] = $_POST['tm-name-' . $i];
            $tm_phone[$i] = $_POST['tm-phone-' . $i];
            $tm_gender[$i] = $_POST['tm-gender-' . $i];
            $tm_dept[$i] = $_POST['tm-dept-' . $i];
            $tm_year[$i] = $_POST['tm-year-' . $i];
        } else {
            break;
        }
    }

    // Check for abstract file
    if ($abstract_file['error'] === 0) {
        $abstract_file_name = $abstract_file['name'];
        $abstract_file_tmp_name = $abstract_file['tmp_name'];
        $abstract_file_size = $abstract_file['size'];
        $abstract_file_type = $abstract_file['type'];

        $abstract_file_ext = explode('.', $abstract_file_name);
        $abstract_file_actual_ext = strtolower(end($abstract_file_ext));

        $allowed = ['pdf'];

        $hackfestID = generateHackfestID($conn);
        if (in_array($abstract_file_actual_ext, $allowed)) {
            if ($abstract_file_size < 5000000) {

                try {
                    $abstract_file_name_new = $hackfestID . "." . $abstract_file_actual_ext;

                    if (!file_exists('../assets/uploads')) {
                        mkdir('../assets/uploads', 0777, true);
                    }

                    $abstract_file_destination = '../assets/uploads/' . $abstract_file_name_new;

                    if (file_exists($abstract_file_destination)) {
                        unlink($abstract_file_destination);
                    }

                    move_uploaded_file($abstract_file_tmp_name, $abstract_file_destination);
                } catch (Exception $e) {
                    header("Location: ../register.php?error=uploadFailed");
                }
            } else {
                header("Location: ../register.php?error=tooLarge");
            }
        } else {
            header("Location: ../register.php?error=invalidFile");
        }
    } else {
        header("Location: ../register.php?error=somethingWentWrong");
    }


    $sql = "INSERT INTO teams (T_ID, TITLE ) VALUES ('$hackfestID', '$t_title')";
    if (mysqli_query($conn, $sql)) {
        $sql = "INSERT INTO registration ( NAME, EMAIL, MOBILE, YEAR, DEPARTMENT, COLLEGE, GENDER, T_ID ) VALUES ('$tl_name', '$tl_email', '$tl_phone', '$tl_year', '$tl_dept', '$college', '$tl_gender', '$hackfestID')";
        if (mysqli_query($conn, $sql)) {

            for ($i = 0; $i <= count($tm_name); $i++) {
                $sql = "INSERT INTO registration ( NAME, EMAIL, MOBILE, YEAR, DEPARTMENT, COLLEGE, GENDER, T_ID ) VALUES ('$tm_name[$i]', '$tl_email', '$tm_phone[$i]', '$tm_year[$i]', '$tm_dept[$i]', '$college', '$tm_gender[$i]', '$hackfestID')";

                if (!mysqli_query($conn, $sql)) {
                    header("Location: ../register.php?error=sqlerror");
                }
            }

            header("Location: ../register.php?success=registered");
        } else {
            header("Location: ../register.php?error=sqlerror");
        }
    } else {
        header("Location: ../register.php?error=sqlerror");
    }
}
