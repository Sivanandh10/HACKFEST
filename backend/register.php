<?php

include "../connect.php";

function generateHackfestID($conn) {
    $sql = "SELECT * FROM team";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    $hackfestID = "HF" . str_pad($resultCheck + 1, 3, "0", STR_PAD_LEFT);

    return $hackfestID;
}

if (isset($_POST['register'])) {
    if (!isset($_POST['tl-name']) || !isset($_POST['tl-email']) || !isset($_POST['tl-phone']) || !isset($_POST['tl-gender']) || !isset($_POST['tl-dept']) || !isset($_POST['tl-year']) || !isset($_POST['college']) || !isset($_POST['t_title']) || !isset($_POST['abstract-file'])) {
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
        $abstract_file_error = $abstract_file['error'];
        $abstract_file_type = $abstract_file['type'];

        $abstract_file_ext = explode('.', $abstract_file_name);
        $abstract_file_actual_ext = strtolower(end($abstract_file_ext));

        $allowed = ['pdf'];

        if (in_array($abstract_file_actual_ext, $allowed)) {
            if ($abstract_file_error === 0) {
                if ($abstract_file_size < 1000000) {
                    $abstract_file_name_new = uniqid('', true) . "." . $abstract_file_actual_ext;

                    if (!file_exists('../assets/uploads')) {
                        mkdir('../assets/uploads', 0777, true);
                    }

                    $abstract_file_destination = '../assets/uploads' . $abstract_file_name_new;
                    move_uploaded_file($abstract_file_tmp_name, $abstract_file_destination);
                } else {
                    header("Location: ../register.php?error=abstractfiletoolarge");
                }
            } else {
                header("Location: ../register.php?error=abstractfileerror");
            }
        } else {
            header("Location: ../register.php?error=abstractfileinvalid");
        }
    } else {
        header("Location: ../register.php?error=abstractfileerror");
    }

    $hackfestID = generateHackfestID($conn);

    $sql = "INSERT INTO team (T_ID, TITLE ) VALUES ('$hackfestID', '$t_title')";
    mysqli_query($conn, $sql);

    $sql = "INSERT INTO registration
}

?>