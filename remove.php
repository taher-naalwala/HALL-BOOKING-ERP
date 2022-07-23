<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
$c_d=date('Y-m-d');
if (isset($_SESSION['access']) && $_SESSION['exp_date'] > $c_d) {

    if ($_GET['name'] == "Access") {
        $forms_access = $_SESSION['forms_access'];
        $flag = 0;
        foreach ($forms_access as $formid) {
            if ($formid == "34" || $formid == "31") {
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
            if ($formid == "5" || $formid == "1") {
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
            if ($formid == "11" || $formid == "8") {
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
            if ($formid == "15" || $formid == "12") {
                $flag = 1;
            }
        }
        if ($flag == 0) {
            header('Location:main.php');
            exit();
        }
    }
} else if (isset($_SESSION['access']) && $_SESSION['exp_date'] <= $c_d) {
    header("Location: maintainence.php");
    
    die();
}
else{
    header("Location: login.php");
    die();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {
            $(".datepicker").datepicker();
        });
    </script>



    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="https://use.fontawesome.com/3582a84b00.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove <?php echo $_GET['name'] ?></title>
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
                    <h6 class="m-0 font-weight-bold text-primary">Remove <?php echo $_GET['name'] ?></h6>
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
                                    <button name="editaccess" value="Add" class=" btn  btn-primary ">Remove</button>
                                </div>
                            </div>
                            <?php
                            if (isset($_POST['editaccess'])) {
                                $adminid = $_POST['adminid'];
                                $sql = "DELETE from web_login WHERE id=$adminid";
                                if(mysqli_query($conn,$sql))
                                {
                                    echo '<div class="alert alert-success mt-2">
                                    Access Removed
                                    </div>';
                                } else {
                                    echo '<div class="alert alert-danger mt-2">
                                    Fail
                                    </div>';
                                }
                               
                            ?>


                            <?php
                            }
                            
                        } else if ($_GET['name'] == "Jamaat Khaana") { ?>

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
                                        <button name="editaccess" value="Add" class=" btn  btn-primary ">Remove</button>
                                    </div>
                                </div>
                            </form>
                            <?php
                            if (isset($_POST['editaccess'])) {
                                $jk_id = $_POST['jk_id'];
                                $s1 = "DELETE from jk_info WHERE id=$jk_id";
                                if(mysqli_query($conn,$s1))
                                {
                                    $s2="DELETE FROM timings WHERE jk_id=$jk_id";
                                    if(mysqli_query($conn,$s2))
                                    {
                                        $s3="DELETE FROM rent WHERE jk_id=$jk_id";
                                        if(mysqli_query($conn,$s3))
                                        {
                                            echo '<div class="alert alert-success mt-2">
                                            Jamaat Khaana Removed
                                            </div>';
                                        } else {
                                            echo '<div class="alert alert-danger mt-2">
                                            Fail
                                            </div>';
                                        }
    
                                    }
                                }
                           
                            }
                            
                        }

                        if ($_GET['name'] == "Rent") { ?>
                            <form method="POST">

                                <div class="row">
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group"> <select onchange="change_jk_rent()" id="jk_id_rent" class="form-control" name="jk_id">
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
                                    <div class="col-lg-4 col-md-4">
                                        <div id="date_rent">
                                            <select class="form-control" required>
                                                <option value="">Select Date</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <button name="editaccess" value="Add" class=" btn  btn-primary ">Remove</button>
                                    </div>
                                </div>
                                <?php
                                if (isset($_POST['editaccess'])) {
                                    $jk_id = $_POST['jk_id'];
                                    $id = $_POST['date'];
                                    $sql = "UPDATE rent set status=1 WHERE jk_id=$jk_id AND id=$id";
                                    if (mysqli_query($conn, $sql)) {
                                        echo '<div class="alert alert-success mt-2">
                                        Rent Removed
                                        </div>';
                                    } else {
                                        echo '<div class="alert alert-danger mt-2">
                                        Fail
                                        </div>';
                                    }


                                ?>
                            </form>


                        <?php
                                }
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
                                    <button name="editaccess" value="Add" class=" btn  btn-primary ">Remove</button>
                                </div>
                            </div>
                            <?php
                                if (isset($_POST['editaccess'])) {
                                    $trust_id = $_POST['trust_id'];
                                    $sql = "DELETE from trust WHERE id=$trust_id";
                                    if (mysqli_query($conn, $sql)) {
                                        echo '<div class="alert alert-success mt-2">
                                        Trust Removed
                                        </div>';
                                    } else {
                                        echo '<div class="alert alert-danger mt-2">
                                        Fail
                                        </div>';
                                    }
                                }

                            ?>
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