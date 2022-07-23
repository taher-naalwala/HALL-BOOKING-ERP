<?php

session_start();
require('connectDB.php');

function get_operating_system()
{
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $operating_system = 'Unknown Operating System';

    //Get the operating_system name
    if (preg_match('/linux/i', $u_agent)) {
        $operating_system = 'Linux';
    } elseif (preg_match('/macintosh|mac os x|mac_powerpc/i', $u_agent)) {
        $operating_system = 'Mac';
    } elseif (preg_match('/windows|win32|win98|win95|win16/i', $u_agent)) {
        $operating_system = 'Windows';
    } elseif (preg_match('/ubuntu/i', $u_agent)) {
        $operating_system = 'Ubuntu';
    } elseif (preg_match('/iphone/i', $u_agent)) {
        $operating_system = 'IPhone';
    } elseif (preg_match('/ipod/i', $u_agent)) {
        $operating_system = 'IPod';
    } elseif (preg_match('/ipad/i', $u_agent)) {
        $operating_system = 'IPad';
    } elseif (preg_match('/android/i', $u_agent)) {
        $operating_system = 'Android';
    } elseif (preg_match('/blackberry/i', $u_agent)) {
        $operating_system = 'Blackberry';
    } elseif (preg_match('/webos/i', $u_agent)) {
        $operating_system = 'Mobile';
    }

    return $operating_system;
}

$os = get_operating_system();


//3. If the form is submitted or not.
//3.1 If the form is submitted

//3.1.4 if the user is logged in Greets the user with message
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    if ($username == "30349223") {
        $_SESSION['access'] = "1";
        header("Location: main.php");
    } else {
        if (isset($_SESSION['access']) && $_SESSION['access'] == "1") {
            header("Location: main.php");
            die();
        } else {

            $_SESSION['access'] = "1";
            header("Location: main.php");
        }
    }
} else {
    //3.2 When the user visits the page first time, simple login form will be displayed.
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login-Hall Booking</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="colorrib/images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="colorrib/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="colorrib/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="colorrib/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="colorrib/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="colorrib/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="colorrib/css/util.css">
    <link rel="stylesheet" type="text/css" href="colorrib/css/main.css">
    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="colorrib/images/img-01.png" alt="IMG">
                </div>

                <form class="login100-form validate-form" method="POST">
                    <span class="login100-form-title">
                        Admin Login
                    </span>
                    <?php
                    if (isset($_POST['username']) and isset($_POST['password'])) {
                        //3.1.1 Assigning posted values to variables.


                        $username = $_POST['username'];
                        $password = $_POST['password'];
                        //3.1.2 Checking the values are existing in the database or not
                        $query = "SELECT COUNT(*) as c FROM web_login WHERE its='$username' and password='$password'";

                        $runc = $conn->query($query);
                        $rowc = $runc->fetch_assoc();
                        $c = $rowc['c'];
                        //3.1.2 If the posted values are equal to the database values, then session will be created for the user.
                        if ($c > 0) {
                            $s1 = "SELECT id,name,mobile,exp_date,email,role FROM web_login WHERE its='$username' and password='$password'";
                            $run1 = $conn->query($s1);
                            $forms_access = array();

                            $_SESSION['username'] = $username;
                            while ($row = $run1->fetch_assoc()) {
                                $id = $row["id"];
                                $Full_Name = $row["name"];
                                $mobile = $row['mobile'];
                                $exp_date = $row['exp_date'];
                                $email = $row['email'];
                                $_SESSION['email'] = $email;
                                $_SESSION['mobile'] = $mobile;
                                $_SESSION['varname'] = $id;
                                $role = $row['role'];
                                $_SESSION['role'] = $role;
                                $_SESSION['Full_Name'] = $Full_Name;
                                $_SESSION['exp_date'] = $exp_date;


                                $s1 = "SELECT formid from access_web_login WHERE adminid=$id";
                                $run1 = $conn->query($s1);
                                while ($row1 = $run1->fetch_assoc()) {
                                    $formid = $row1['formid'];
                                    array_push($forms_access, $formid);
                                }
                                $_SESSION['forms_access'] = $forms_access;
                            }
                    ?>
                            <script type="text/javascript">
                                window.location = 'main.php';
                            </script>
                    <?php
                        } else {
                            //3.1.3 If the login credentials doesn't match, he will be shown with an error message.
                            echo '<div class="alert alert-danger">
Invalid Login
</div>';
                        }
                    }
                    ?>

                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="number" name="username" placeholder="ITS Number">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-key" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">
                            Login
                        </button>
                    </div>




                </form>
            </div>
        </div>
    </div>




    <!--===============================================================================================-->
    <script src="colorrib/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="colorrib/vendor/bootstrap/js/popper.js"></script>
    <script src="colorrib/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="colorrib/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="colorrib/vendor/tilt/tilt.jquery.min.js"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    <!--===============================================================================================-->
    <script src="colorrib/js/main.js"></script>
    <?php
    require('footer.php');
    ?>
</body>

</html>