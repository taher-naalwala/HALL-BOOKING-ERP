<?php

session_start();

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

require('connectDB.php');
//3. If the form is submitted or not.
//3.1 If the form is submitted
if (isset($_POST['username']) and isset($_POST['password']) ) {
    //3.1.1 Assigning posted values to variables.
?>


<?php

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
    } else {
        //3.1.3 If the login credentials doesn't match, he will be shown with an error message.
        echo '<div class="alert alert-danger">
Invalid Login
</div>';
    }
}
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

            header("Location: mobile_check_admin.php");
            die();
        }
    }
} else {
    //3.2 When the user visits the page first time, simple login form will be displayed.
}

?>

<html>

<head>
    <link rel="icon" href="http://indoreestates.com/sabaq/photo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login-Jamaat Khana Booking</title>
</head>
<style>
 

    body {
        padding-top: 40px;
        padding-bottom: 40px;
    }

    .form-signin {
        max-width: 300px;
        padding: 15px;
        margin: 0 auto;
    }

    .form-signin .form-signin-heading,
    .form-signin .checkbox {
        margin-bottom: 10px;
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 50%;
    }

    .form-signin .checkbox {
        font-weight: normal;
    }

    .form-signin .form-control {
        position: relative;
        height: auto;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        padding: 10px;
        font-size: 16px;
    }
	.footer {
  position:fixed;
    bottom: 0;
    width: 100%;
    height: 30px;
	
	text-align:center;
  
    background-color: #f5f5f5;
}

    .form-signin .form-control:focus {
        z-index: 2;
    }

    .form-signin input[type="email"] {
        margin-bottom: -1px;
        width: 100%;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
        padding: 10px;
    }

    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;

    }

    div {
        border-radius: 15px;
        background-color: #ffffff;
        padding: 20px 40px;
        width: 30%;
        margin: 0 auto;
        border-color: #790b98;
        /* border: 1px solid #d4d4d4; */
        box-shadow: 7px 29px 39px -10px rgba(179, 179, 179, 0.29);
        margin-top: 20px;
    }

    .center {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 15%;

    }

    label,
    input {
        display: block;
    }

    label {
        margin-bottom: 30px;
    }

    input[type=text] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        resize: vertical;


    }

    input[type=number] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        resize: vertical;


    }

    input[type=password] {
        width: 100%;

        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;

    }

    .loginText {
        margin-top: 5px;
        margin-bottom: 10px;


        text-align: center;
    }

    .button {
        width: 100%;
        border-radius: 12px;
        background-color: #790b98;
        /* Green */
        border: none;
        color: white;
        padding: 10px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 20px;
        margin: 4px 2px;
        cursor: pointer;

    }

    @media screen and (max-width: 600px) {
        div {
            border-radius: 15px;
            background-color: #ffffff;
            padding: 0px;
            width: 80%;
            margin: 0 auto;
            border-color: #790b98;
            /* border: 1px solid #d4d4d4; */
            box-shadow: 7px 29px 39px -10px rgba(179, 179, 179, 0.29);
            margin-top: 30px;
        }

        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;

        }

        .button {

            margin-bottom: 10px;

        }

    }
</style>
<p id="update"></p>

<body background="photos/bg.png">

    <img class="center" src="photos/photo.png">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">

    <div>
        <form class="form-signin" method="POST">
            <h3 class="loginText">
                <font color="#790b98"><b>SIGN IN</b></font>
            </h3>


            <input class="form-control" type="number" id="fname" name="username" placeholder="ITS Number" required>


            <input class="form-control" type="password" id="lname" name="password" placeholder="Password" required>
            <button class="button" id="login_button" type="submit">Login</button>

        </form>

    </div>

<footer class="footer">
     
        <span class="text-muted">Developed By Taher Naalwala (<a target="_blank" href="https://mail.google.com/mail/?view=cm&fs=1&to=naalwala12taher@gmail.com">naalwala12taher@gmail.com</a>)</span>
    
    </footer>
</body>

</html>