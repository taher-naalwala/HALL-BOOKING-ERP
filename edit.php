<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
$c_d = date('Y-m-d');
if (isset($_SESSION['access']) && $_SESSION['exp_date'] > $c_d) {

    if ($_GET['name'] == "Access") {
        $forms_access = $_SESSION['forms_access'];
        $flag = 0;
        foreach ($forms_access as $formid) {
            if ($formid == "33" || $formid == "31") {
                $flag = 1;
            }
        }
        if ($flag == 0) {
            header('Location:main.php');
            exit();
        }
    }
    if ($_GET['name'] == "Jamaat Khaana") {
        $forms_access = $_SESSION['forms_access'];
        $flag = 0;
        foreach ($forms_access as $formid) {
            if ($formid == "4" || $formid == "1") {
                $flag = 1;
            }
        }
        if ($flag == 0) {
            header('Location:main.php');
            exit();
        }
    }
    if ($_GET['name'] == "Rent") {
        $forms_access = $_SESSION['forms_access'];
        $flag = 0;
        foreach ($forms_access as $formid) {
            if ($formid == "10" || $formid == "8") {
                $flag = 1;
            }
        }
        if ($flag == 0) {
            header('Location:main.php');
            exit();
        }
    }
    if ($_GET['name'] == "Trust") {
        $forms_access = $_SESSION['forms_access'];
        $flag = 0;
        foreach ($forms_access as $formid) {
            if ($formid == "14" || $formid == "12") {
                $flag = 1;
            }
        }
    }
} else if (isset($_SESSION['access']) && $_SESSION['exp_date'] <= $c_d) {
    header("Location: maintainence.php");

    die();
} else {
    header("Location: login.php");
    die();
}


?>
<!DOCTYPE html>
<html lang="en">

<head>


    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {
            $(".datepicker").datepicker();
        });
    </script>




    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1569006288/BBBootstrap/choices.min.css?version=7.0.0">
    <script src="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1569006273/BBBootstrap/choices.min.js?version=7.0.0"></script>


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="https://use.fontawesome.com/3582a84b00.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit <?php echo $_GET['name'] ?></title>
    <style>
        .btn-block {
            background-color: #4e73df;
        }

        .btn {
            color: #fff;
        }

        @media (min-width: 600px) {
            .card {
                width: 50%;
            }
        }
    </style>
    <script>
        $(document).ready(function() {

            var multipleCancelButton = new Choices('.choices-multiple-remove-button', {
                removeItemButton: true,
                searchResultLimit: 5,
                renderChoiceLimit: 5
            });


        });
    </script>

</head>

<body id="page-top">
    <div id="wrapper">
        <?php
        require('style.php');
        ?>



        <div class="container-fluid">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit <?php echo $_GET['name'] ?></h6>
                </div>
                <div class="card-body">

                    <?php if ($_GET['name'] == "Access") { ?>

                        <form method="POST">

                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group"> <select class="form-control" name="adminid">
                                            <option value=''>Select Admin</option>
                                            <?php require('connectDB.php');
                                            $sql = "SELECT name,id from web_login";
                                            $run = $conn->query($sql);
                                            while ($row = $run->fetch_assoc()) {
                                                $id = $row['id'];
                                                $name = $row['name'];
                                            ?>
                                                <option value="<?php echo $id; ?>"><?php echo $name; ?></option>

                                            <?php   }


                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <button name="editaccess" value="Add" class=" btn  btn-primary ">Open</button>
                                </div>
                            </div>
                            <?php
                            if (isset($_POST['editaccess'])) {
                                $adminid = $_POST['adminid'];
                                $sql = "SELECT name,password,its,mobile,email,role from web_login WHERE id=$adminid ";
                                $run = $conn->query($sql);
                                $row = $run->fetch_assoc();
                                $name = $row['name'];
                                $pass = $row['password'];
                                $its = $row['its'];
                                $mobile = $row['mobile'];
                                $email = $row['email'];
                                $role = $row['role'];
                            ?>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" value="<?php echo $name ?>" name="name" required>
                                </div>
                                <input type="hidden" class="form-control" value="<?php echo $adminid ?>" name="adminid" required>
                                <div class="form-group">
                                    <label>ITS</label>
                                    <input type="number" class="form-control" value="<?php echo $its ?>" name="its" required>
                                </div>


                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" class="form-control" value="<?php echo $pass ?>" name="pass" required>
                                </div>
                                <div class="form-group">
                                    <label>Mobile Number</label>
                                    <input type="number" class="form-control" value="<?php echo $mobile ?>" name="mobile" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" value="<?php echo $email ?>" name="email" required>
                                </div>

                                <div class="form-group">
                                    <label>Role</label>
                                    <select name="role" class="form-control" required>

                                        <option value='<?php echo $role  ?>' selected><?php echo $role ?></option>


                                        <option value="">----</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Manager">Manager</option>
                                        <option value="User">User</option>


                                    </select>
                                </div>



                                <div class="form-group">
                                    <label>Powers</label>
                                    <select name="powers[]" class="choices-multiple-remove-button" multiple required>
                                        <?php require('connectDB.php');
                                        $sql = "SELECT formid from access_web_login WHERE adminid=$adminid";
                                        $run = $conn->query($sql);
                                        while ($row = $run->fetch_assoc()) {

                                            $formid = $row['formid'];
                                            $s1 = "SELECT name from form WHERE id=$formid";
                                            $run1 = $conn->query($s1);
                                            $row1 = $run1->fetch_assoc();
                                            $formname = $row1['name'];
                                        ?>
                                            <option value='<?php echo $formid  ?>' selected><?php echo $formname ?></option>


                                        <?php   } ?>

                                        <option value="">----</option>

                                        <?php $sql = "SELECT name,id from form";
                                        $run = $conn->query($sql);
                                        while ($row = $run->fetch_assoc()) {
                                            $formname1 = $row['name'];
                                            $formid1 = $row['id'];
                                        ?>
                                            <option value='<?php echo $formid1  ?>'><?php echo $formname1 ?></option>


                                        <?php   }

                                        ?>

                                        ?>
                                    </select>
                                </div>
                                <button name="finaledit" value="Add" class=" btn  btn-block ">Submit</button>


                            <?php
                            }
                            if (isset($_POST['finaledit'])) {
                                $powers = array_unique($_POST['powers']);
                                $name = $_POST['name'];
                                $pass = $_POST['pass'];
                                $its = $_POST['its'];
                                $mobile = $_POST['mobile'];
                                $email = $_POST['email'];
                                $adminid = $_POST['adminid'];
                                $role = $_POST['role'];
                                $sql = "UPDATE web_login SET name='$name',password='$pass',its='$its',mobile='$mobile',email='$email',role='$role'  WHERE id=$adminid ";
                                if (mysqli_query($conn, $sql)) {
                                    $s1 = "DELETE FROM access_web_login WHERE adminid=$adminid";
                                    if (mysqli_query($conn, $s1)) {
                                        $flag = 0;
                                        foreach ($powers as $formid) {
                                            $s3 = "INSERT INTO access_web_login (`adminid`, `formid`) VALUES($adminid,$formid)";
                                            if (mysqli_query($conn, $s3)) {
                                                $flag = 1;
                                            } else {
                                                $flag = 0;
                                            }
                                        }
                                        echo '<div class="alert alert-success mt-2">
                                    Access Editted
                                    </div>';
                                    }
                                }
                            }
                        } else if ($_GET['name'] == "Jamaat Khaana") { ?>

                            <form method="POST">

                                <div class="row">
                                    <div class="col-lg-3 col-md-3">
                                        <div class="form-group"> <select onchange="change_edit_option()" class="form-control" id="choice_id" name="choice_id" required>
                                                <option value=''>--Select--</option>
                                                <option value="0">Name/Capacity</option>
                                                <option value="1">Edit/Remove Timing</option>
                                                <option value="2">Add Timing</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3">
                                        <div id="jk_id_edit">

                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3">
                                        <div id="timing_id_edit">

                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-3">
                                        <button name="editaccess" value="Add" class=" btn  btn-primary ">Open</button>
                                    </div>
                                </div>
                            </form>
                            <?php
                            if (isset($_POST['editaccess']) && $_POST['choice_id'] == "0") {
                                $jk_id = $_POST['jk_id'];
                                require('connectDB.php');
                                $s1 = "SELECT name,capacity from jk_info WHERE id=$jk_id";
                                $run1 = $conn->query($s1);
                                $row1 = $run1->fetch_assoc();
                                $jk_name = $row1['name'];
                                $capacity = $row1['capacity'];

                                /* $sql = "SELECT * from timings WHERE jk_id=$jk_id";
                                    $run = $conn->query($sql);
                                    $row = $run->fetch_assoc();
                                    $label=$row['label'];
                                    $start_time=$row['start_time'];
                                    $end_time=$row['end_time']; */
                            ?>
                                <form method="POST">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" value="<?php echo $jk_name ?>" name="jk_name" required>
                                    </div>
                                    <input type="hidden" class="form-control" value="<?php echo $jk_id ?>" name="jk_id" required>
                                    <div class="form-group">
                                        <label>Capacity</label>
                                        <input type="number" class="form-control" value="<?php echo $capacity ?>" name="capacity" required>
                                    </div>


                                    <button name="submit_info" type="submit" value="submit" class="btn btn-primary btn-block">Submit</button>

                                </form>
                            <?php
                            } else if (isset($_POST['editaccess']) && $_POST['choice_id'] == "1") {
                                $jk_id = $_POST['jk_id'];
                                require('connectDB.php');
                                $s1 = "SELECT name from jk_info WHERE id=$jk_id";
                                $run1 = $conn->query($s1);
                                $row1 = $run1->fetch_assoc();
                                $jk_name = $row1['name'];
                                $timings_id_edit = $_POST['timing_id'];

                                $sql = "SELECT label,start_time,end_time from timings WHERE jk_id=$jk_id AND id=$timings_id_edit";
                                $run = $conn->query($sql);
                                $row = $run->fetch_assoc();
                                $label = $row['label'];
                                $start_time = $row['start_time'];
                                $end_time = $row['end_time'];
                                if ($start_time >= 12 && $start_time < 13) {
                                    $start_whole = "12";
                                    $start_fraction = floor(($start_time - $start_whole) * 60);
                                    $start_type = "PM";
                                } else if ($start_time >= 0 && $start_time < 1) {
                                    $start_whole = "12";
                                    $start_fraction = floor(($start_time) * 60);
                                    $start_type = "AM";
                                } else if ($start_time < 12) {
                                    $start_whole = floor($start_time);
                                    $start_fraction = floor(($start_time - $start_whole) * 60);
                                    $start_type = "AM";
                                } else  if ($start_time > 12) {
                                    $start_whole = floor($start_time) - 12;
                                    $start_fraction = floor(($start_time - ($start_whole + 12)) * 60);
                                    $start_type = "PM";
                                }


                                if ($end_time >= 12 && $end_time < 13) {
                                    $end_whole = "12";
                                    $end_fraction = floor(($end_time - $end_whole) * 60);
                                    $end_type = "PM";
                                } else if ($end_time >= 0 && $end_time < 1) {
                                    $end_whole = "12";
                                    $end_fraction = floor(($end_time) * 60);
                                    $end_type = "AM";
                                } else if ($end_time < 12) {
                                    $end_whole = floor($end_time);
                                    $end_fraction = floor(($end_time - $end_whole) * 60);
                                    $end_type = "AM";
                                } else  if ($end_time > 12) {
                                    $end_whole = floor($end_time) - 12;
                                    $end_fraction = floor(($end_time - ($end_whole + 12)) * 60);
                                    $end_type = "PM";
                                }
                            ?>
                                <p><?php echo $jk_name ?></p>
                                <form method="POST">
                                    <div class="form-group">
                                        <label>Label</label>
                                        <input type="text" class="form-control" value='<?php echo $label ?>' name="label_name" required>
                                    </div>
                                    <label>Start Time</label>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <input name="start_hour" class="form-control" value='<?php echo $start_whole ?>' required>


                                        </div>
                                        <div class="col-lg-4">
                                            <input name="start_min" class="form-control" value='<?php echo $start_fraction ?>' required>

                                        </div>
                                        <div class="col-lg-4">
                                            <select class="form-control" name="start_type">
                                                <option value='<?php echo $start_type ?>'><?php echo $start_type ?></option>
                                                <option value="">----</option>
                                                <option value="AM">AM</option>
                                                <option value="PM">PM</option>
                                            </select>
                                        </div>
                                    </div>

                                    <label>End Time</label>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <input name="end_hour" class="form-control" value='<?php echo $end_whole ?>' required>


                                        </div>
                                        <div class="col-lg-4">
                                            <input name="end_min" class="form-control" value='<?php echo $start_fraction ?>' required>

                                        </div>
                                        <div class="col-lg-4">
                                            <select class="form-control" name="end_type">
                                                <option value='<?php echo $end_type ?>'><?php echo $end_type ?></option>
                                                <option value="">----</option>
                                                <option value="AM">AM</option>
                                                <option value="PM">PM</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <button name="submit_timing" type="submit" value='<?php echo $timings_id_edit ?>' class="btn btn-primary btn-block">Submit</button>
                                    <button name="remove_timing" type="submit" value='<?php echo $timings_id_edit ?>' class="btn btn-danger btn-block">Remove</button>

                                </form>
                            <?php
                            } else if (isset($_POST['editaccess']) && $_POST['choice_id'] == "2") {
                                $jk_id = $_POST['jk_id'];
                                require('connectDB.php');
                                $s1 = "SELECT name from jk_info WHERE id=$jk_id";
                                $run1 = $conn->query($s1);
                                $row1 = $run1->fetch_assoc();
                                $jk_name = $row1['name'];


                            ?>
                                <p><?php echo $jk_name ?></p>
                                <form method="POST">
                                    <div class="form-group">
                                        <label>Label</label>
                                        <input type="text" placeholder="Enter Label" class="form-control" name="label_name" required>
                                    </div>
                                    <label>Start Time</label>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <input name="start_hour" placeholder="00" class="form-control" required>


                                        </div>
                                        <div class="col-lg-4">
                                            <input name="start_min" placeholder="00" class="form-control" required>

                                        </div>
                                        <div class="col-lg-4">
                                            <select class="form-control" name="start_type">
                                                <option value="AM">AM</option>
                                                <option value="PM">PM</option>
                                            </select>
                                        </div>
                                    </div>

                                    <label>End Time</label>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <input name="end_hour" placeholder="00" class="form-control" required>


                                        </div>
                                        <div class="col-lg-4">
                                            <input name="end_min" placeholder="00" class="form-control" required>

                                        </div>
                                        <div class="col-lg-4">
                                            <select class="form-control" name="end_type">

                                                <option value="AM">AM</option>
                                                <option value="PM">PM</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <button name="add_timing" type="submit" value='<?php echo $jk_id  ?>' class="btn btn-primary btn-block">Add</button>

                                </form>
                            <?php
                            }
                            if (isset($_POST['add_timing'])) {
                                require('connectDB.php');

                                $jk_id = $_POST['add_timing'];
                                $label_name = $_POST['label_name'];
                                $start_hour = $_POST['start_hour'];
                                $start_min = $_POST['start_min'];
                                $start_type = $_POST['start_type'];
                                $end_hour = $_POST['end_hour'];
                                $end_min = $_POST['end_min'];
                                $end_type = $_POST['end_type'];
                                $start_time;

                                if ($start_type == "AM" && $start_hour != "12") {
                                    $start_time =  $start_hour + ($start_min / 60);
                                } else if ($start_type == "PM" && $start_hour != "12") {

                                    $start_time =   $start_hour + 12 + ($start_min / 60);
                                } else if ($start_type == "PM" && $start_hour == "12") {
                                    $start_time =   $start_hour + ($start_min / 60);
                                } else if ($start_type == "AM" && $start_hour == "12") {
                                    $start_time =   $start_hour - 12 + ($start_min / 60);
                                }
                                $end_time;
                                if ($end_type == "AM" && $end_hour != "12") {
                                    $end_time =   $end_hour  + ($end_min / 60);
                                } else if ($end_type == "PM" && $end_hour  != "12") {

                                    $end_time =   $end_hour  + 12 + ($end_min / 60);
                                } else if ($end_type == "PM" && $end_hour  == "12") {
                                    $end_time =   $end_hour  + ($end_min / 60);
                                } else if ($end_type == "AM" && $end_hour  == "12") {
                                    $end_time =   $end_hour  - 12 + ($end_min / 60);
                                }
                                $s2 = "INSERT INTO timings ( `jk_id`, `label`, `start_time`, `end_time`) VALUES($jk_id,'$label_name','$start_time','$end_time')";
                                if (mysqli_query($conn, $s2)) {
                                    echo '<div class="alert alert-success mt-2">
                                        Timing Added
                                        </div>';
                                }
                            }
                            if (isset($_POST['submit_timing'])) {
                                require('connectDB.php');
                                $timing_id = $_POST['submit_timing'];
                                $label_name = $_POST['label_name'];
                                $start_hour = $_POST['start_hour'];
                                $start_min = $_POST['start_min'];
                                $start_type = $_POST['start_type'];
                                $end_hour = $_POST['end_hour'];
                                $end_min = $_POST['end_min'];
                                $end_type = $_POST['end_type'];
                                $start_time;

                                if ($start_type == "AM" && $start_hour != "12") {
                                    $start_time =  $start_hour + ($start_min / 60);
                                } else if ($start_type == "PM" && $start_hour != "12") {

                                    $start_time =   $start_hour + 12 + ($start_min / 60);
                                } else if ($start_type == "PM" && $start_hour == "12") {
                                    $start_time =   $start_hour + ($start_min / 60);
                                } else if ($start_type == "AM" && $start_hour == "12") {
                                    $start_time =   $start_hour - 12 + ($start_min / 60);
                                }
                                $end_time;
                                if ($end_type == "AM" && $end_hour != "12") {
                                    $end_time =   $end_hour  + ($end_min / 60);
                                } else if ($end_type == "PM" && $end_hour  != "12") {

                                    $end_time =   $end_hour  + 12 + ($end_min / 60);
                                } else if ($end_type == "PM" && $end_hour  == "12") {
                                    $end_time =   $end_hour  + ($end_min / 60);
                                } else if ($end_type == "AM" && $end_hour  == "12") {
                                    $end_time =   $end_hour  - 12 + ($end_min / 60);
                                }

                                $sql = "UPDATE timings SET label='$label_name',start_time='$start_time',end_time='$end_time' WHERE id=$timing_id";
                                if (mysqli_query($conn, $sql)) {
                                    echo '<div class="alert alert-success mt-2">
                                        Jamaat Khaana Editted
                                        </div>';
                                }
                            }

                            if (isset($_POST['submit_info'])) {
                                $jk_name = $_POST['jk_name'];
                                require('connectDB.php');

                                $capacity = $_POST['capacity'];
                                $jk_id = $_POST['jk_id'];
                                $sql = "UPDATE jk_info SET name='$jk_name',capacity='$capacity' WHERE id=$jk_id";
                                if (mysqli_query($conn, $sql)) {

                                    echo '<div class="alert alert-success mt-2">
                                        Jamaat Khaana Editted
                                        </div>';
                                }
                            }

                            if (isset($_POST['remove_timing'])) {
                                require('connectDB.php');
                                $timings_id = $_POST['remove_timing'];
                                $s1 = "DELETE FROM timings WHERE id=$timings_id";
                                if (mysqli_query($conn, $s1)) {
                                    echo '<div class="alert alert-success mt-2">
                                        Timing Removed
                                        </div>';
                                }
                            }
                        }

                        if ($_GET['name'] == "Rent") { ?>
                            <form method="POST">

                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group"> <select class="form-control" name="jk_id">
                                                <option value=''>Select Jamaat Khaana</option>
                                                <?php require('connectDB.php');
                                                $sql = "SELECT name,id from jk_info";
                                                $run = $conn->query($sql);
                                                while ($row = $run->fetch_assoc()) {
                                                    $id = $row['id'];
                                                    $name = $row['name'];
                                                ?>
                                                    <option value="<?php echo $id; ?>"><?php echo $name; ?></option>

                                                <?php   }


                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <button name="editaccess" value="Add" class=" btn  btn-primary ">Open</button>
                                    </div>
                                </div>
                                <?php
                                if (isset($_POST['editaccess'])) {
                                    $jk_id = $_POST['jk_id'];
                                    $sql = "SELECT start_date,amount,end_date from rent WHERE jk_id=$jk_id AND day='' and status=0";
                                    $run = $conn->query($sql);
                                    if ($run->num_rows > 0) {
                                        while ($row = $run->fetch_assoc()) {
                                            $start_date = $row['start_date'];
                                            $end_date = $row['end_date'];

                                            $rent = $row['amount']; ?>
                                            <div class="row mt-2">
                                                <div class="col-lg-4">
                                                    <?php
                                                    list($y, $m, $d) = explode('-', $start_date);
                                                    $f_first0 = $m . "/" . $d . "/" . $y;
                                                    $final = str_replace(' ', '', $f_first0);

                                                    list($y1, $m1, $d1) = explode('-', $end_date);
                                                    $f_first01 = $m1 . "/" . $d1 . "/" . $y1;
                                                    $final1 = str_replace(' ', '', $f_first01);

                                                    echo "<label>FROM</label><input type='text' value='$final' name='start_date[]' class='form-control datepicker' >";

                                                    ?>
                                                </div>
                                                <div class="col-lg-4">
                                                    <?php
                                                    echo "<label>TO</label><input type='text' value='$final1' name='end_date[]' class='form-control datepicker' >";

                                                    ?>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label>RENT</label>
                                                    <input name="rent[]" value='<?php echo $rent ?>' class="form-control">
                                                </div>
                                            </div>

                                    <?php  }
                                        echo "<button name='sub' value='$jk_id' class='btn btn-primary btn-block mt-2'>Submit</button>";
                                    }
                                    ?>
                            </form>
                            <br>

                            <hr>
                            <hr>
                            <br>
                            <form method="POST">
                                <?php
                                    $jk_id = $_POST['jk_id'];
                                    $sql = "SELECT amount,day from rent WHERE jk_id=$jk_id AND day!='' and status=0";
                                    $run = $conn->query($sql);
                                    if ($run->num_rows > 0) {
                                        while ($row = $run->fetch_assoc()) {
                                            $day = $row['day'];
                                            $rent = $row['amount']; ?>
                                        <div class="row mt-2">
                                            <div class="col-lg-4">
                                                <label>DAY</label> <select class="form-control" name="day[]" required>
                                                <option value="<?php echo $day ?>"><?php echo $day ?></option>
                                                    <option value="">--SELECT DAY--</option>
                                                    <option value="MONDAY">MONDAY</option>
                                                    <option value="TUESDAY">TUESDAY</option>
                                                    <option value="WEDNESDAY">WEDNESDAY</option>
                                                    <option value="THURSDAY">THURSDAY</option>
                                                    <option value="FRIDAY">FRIDAY</option>
                                                    <option value="SATURDAY">SATURDAY</option>
                                                    <option value="SUNDAY">SUNDAY</option>
                                                </select>
                                            </div>

                                            <div class="col-lg-4">
                                                <label>RENT</label>
                                                <input name="rent[]" value='<?php echo $rent ?>' class="form-control">
                                            </div>
                                        </div>
                                        <br>
                                        <br>

                                <?php  }
                                        echo "<button name='sub_day' value='$jk_id' class='btn btn-primary btn-block mt-2'>Submit</button>";
                                    }
                                ?>
                            </form>

                        <?php
                                }
                                if (isset($_POST['sub'])) {
                                    $jk_id = $_POST['sub'];
                                    $rent = $_POST['rent'];
                                    $start_date = $_POST['start_date'];
                                    $end_date = $_POST['end_date'];
                                    $sql = "UPDATE rent set status=1 WHERE jk_id=$jk_id and date=''";
                                    if (mysqli_query($conn, $sql)) {
                                        foreach ($rent as $index => $r) {
                                            $first = $start_date[$index];

                                            list($f_m, $f_d, $f_y) = explode('/', $first);
                                            $f_first0 = $f_y . "-" . $f_m . "-" . $f_d;
                                            $d = str_replace(' ', '', $f_first0);


                                            $first1 = $end_date[$index];

                                            list($f_m1, $f_d1, $f_y1) = explode('/', $first1);
                                            $f_first01 = $f_y1 . "-" . $f_m1 . "-" . $f_d1;
                                            $d1 = str_replace(' ', '', $f_first01);

                                            $s1 = "INSERT INTO rent (`jk_id`, `start_date`,`end_date`, `amount`) VALUES($jk_id,'$d','$d1',$r)";
                                            mysqli_query($conn, $s1);
                                        }
                                        echo '<div class="alert alert-success mt-2">
                                        Rent Editted
                                        </div>';
                                    }
                                }

                                if (isset($_POST['sub_day'])) {
                                    $jk_id = $_POST['sub_day'];
                                    $rent = $_POST['rent'];
                                    $day = $_POST['day'];
                                   
                                    $sql = "UPDATE rent set status=1 WHERE jk_id=$jk_id and day!=''";
                                    if (mysqli_query($conn, $sql)) {
                                        foreach ($rent as $index => $r) {
                                            $first = $day[$index];

                                       

                                          

                                            $s1 = "INSERT INTO rent (`jk_id`,`day`, `amount`) VALUES($jk_id,'$first',$r)";
                                            mysqli_query($conn, $s1);
                                        }
                                        echo '<div class="alert alert-success mt-2">
                                        Rent Editted
                                        </div>';
                                    }
                                }
                        ?>



                    <?php
                        }

                        if ($_GET['name'] == "Trust") { ?>
                        <form method="POST">

                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group"> <select class="form-control" name="trust_id">
                                            <option value=''>Select Trust</option>
                                            <?php require('connectDB.php');
                                            $sql = "SELECT name,id from trust";
                                            $run = $conn->query($sql);
                                            while ($row = $run->fetch_assoc()) {
                                                $id = $row['id'];
                                                $name = $row['name'];
                                            ?>
                                                <option value="<?php echo $id; ?>"><?php echo $name; ?></option>

                                            <?php   }


                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <button name="editaccess" value="Add" class=" btn  btn-primary ">Open</button>
                                </div>
                            </div>
                            <?php
                            if (isset($_POST['editaccess'])) {
                                $trust_id = $_POST['trust_id'];
                                $sql = "SELECT name from trust WHERE id=$trust_id";
                                $run = $conn->query($sql);
                                $row = $run->fetch_assoc();
                                $name = $row['name'];
                                echo "<input name='trust_name' value='$name' class='form-control'>";
                                echo "<button name='sub' value='$trust_id' class='btn btn-primary btn-block mt-2'>Submit</button>";
                            }

                            if (isset($_POST['sub'])) {

                                $trust_id = $_POST['sub'];
                                $name = $_POST['trust_name'];
                                $sql = "UPDATE trust SET name='$name' WHERE id=$trust_id";
                                if (mysqli_query($conn, $sql)) {
                                    echo '<div class="alert alert-success mt-2">
                                       Trust Editted
                                       </div>';
                                }
                            } ?>
                        </form>


                    <?php       }


                    ?>


                        </form>
                </div>

            </div>

        </div>




    </div>




    <script>
        $(document).ready(function() {
            var i = 1;
            $('#add').click(function() {
                i++;
                $('#dynamic_field').append('<div class="form-group" id="row' + i + '"><br>  <div> <label>Label</label> <input name="label_name[]" class="form-control" placeholder="Enter Label" required> <label>Start Time</label> <div class="row"> <div class="col-lg-4"> <input name="start_hour[]" class="form-control" placeholder="Hour" required> </div> <div class="col-lg-4"> <input name="start_min[]" class="form-control" placeholder="Minutes" required> </div> <div class="col-lg-4"> <select class="form-control" name="start_type[]"> <option value="AM">AM</option> <option value="PM">PM</option> </select> </div> </div> <label>End Time</label> <div class="row"> <div class="col-lg-4"> <input name="end_hour[]" class="form-control" placeholder="Hour" required> </div> <div class="col-lg-4"> <input name="end_min[]" class="form-control" placeholder="Minutes" required> </div> <div class="col-lg-4"> <select class="form-control" name="end_type[]"> <option value="AM">AM</option> <option value="PM">PM</option> </select> </div> </div><br><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button> </div>');
            });
            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });

        });
    </script>
    <script>
        $(function() {
            $('input[name="daterange"]').daterangepicker({
                opens: 'left'
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
        });
    </script>
    <script src="select.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <?php
    require('footer.php');
    ?>
</body>

</html>