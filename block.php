<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
$c_d = date('Y-m-d');
if (isset($_SESSION['access']) && $_SESSION['exp_date'] > $c_d) {
    $access = $_SESSION['access'];
    $forms_access = $_SESSION['forms_access'];
    $flag = 0;
    foreach ($forms_access as $formid) {
        if ($formid == "6" || $formid == "1") {
            $flag = 1;
        }
    }
    if ($flag == 0) {
        header('Location:main.php');
        exit();
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

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="https://use.fontawesome.com/3582a84b00.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <link rel="stylesheet" href="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1569006288/BBBootstrap/choices.min.css?version=7.0.0">
    <script src="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1569006273/BBBootstrap/choices.min.js?version=7.0.0"></script>


    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="modal_box.css" rel="stylesheet">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Block Jamaat Khana</title>
    <style>
        .btn-block {
            background-color: #4e73df;
        }

        .btn {
            color: #fff;
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
    <?php
    require('modal.php');
    ?>
    <div id="wrapper">
        <?php
        require('style.php');
        ?>

        <div class="container-fluid">
            <!-- DataTales Example -->
            <div class="card shadow mb-4 ">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Block Jamaat Khana</h6>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group">
                            <label>Select</label>
                            <select class="form-control" onchange="change_type()" name="type" id="type">
                                <option value="1">DATES</option>
                                <option value="0">DATE-RANGE</option>

                            </select>
                        </div>

                        <script>
                            $(document).ready(function() {
                                $('#datepicker').datepicker({
                                    startDate: new Date(),
                                    multidate: true,
                                    format: "yyyy-mm-dd",
                                    daysOfWeekHighlighted: "5,6",

                                    language: 'en'
                                }).on('changeDate', function(e) {
                                    // `e` here contains the extra attributes
                                    $(this).find('.input-group-addon .count').text(' ' + e.dates.length);
                                });
                            });
                        </script>
                        <label>Dates</label>
                        <div id="type_result">
                            <div class="input-group date form-group" id="datepicker">
                                <input type="text" class="form-control" id="Dates" name="dates" placeholder="Select dates" required />
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i><span class="count"></span></span>
                            </div>
                        </div>


                        <div class="form-group">
                            <label>Jamaat Khana</label>
                            <select placeholder="CHOOSE JAMAAT KHANA" name="jk_id[]" class="choices-multiple-remove-button" multiple required>

                                <option value="">Select Jamaat Khaana</option>
                                <option value="0">All Jamaat Khaana</option>
                                <?php require('connectDB.php');
                                $sql = "SELECT id,name from jk_info";
                                $run = $conn->query($sql);
                                if ($run->num_rows > 0) {
                                    while ($row = $run->fetch_assoc()) {
                                        $id = $row['id'];
                                        $name = $row['name'];
                                ?>
                                        <option value='<?php echo $id ?>'><?php echo $name ?></option>
                                <?php }
                                }

                                ?>
                            </select>
                        </div>


                        <div class="form-group">
                            <div id="timing_date">
                                <label>Label</label>
                                <select placeholder="CHOOSE LABEL" name="label_id[]" class="choices-multiple-remove-button" multiple required>

                                    <?php

                                    $sql = "SELECT DISTINCT label,start_time,end_time from timings";
                                    $run = $conn->query($sql);
                                
                                    if ($run->num_rows > 0) {
                                        while ($row = $run->fetch_assoc()) {
                                            $label = $row['label'];
                                            $start_time = $row['start_time'];
                                            $end_time = $row['end_time'];
                                     
                                            $whole = floor($start_time);
                                            $fraction = $start_time - $whole;

                                            if ($start_time < 12) {
                                                $whole = floor($start_time);
                                                $fraction = ($start_time - $whole) * 60;
                                                if ($fraction == "0") {
                                                    $final_start_time = $whole . ":00 AM";
                                                } else {
                                                    $final_start_time = $whole . ":" . $fraction . " AM";
                                                }
                                            } else  if ($start_time > 12) {
                                                $whole = floor($start_time) - 12;
                                                $fraction = ($start_time - ($whole + 12)) * 60;
                                                if ($fraction == "0") {
                                                    $final_start_time = $whole . ":00 PM";
                                                } else {
                                                    $final_start_time = $whole . ":" . $fraction . " PM";
                                                }
                                            } else if ($start_time == 12) {
                                                $whole = floor($start_time);
                                                $fraction = ($start_time - $whole) * 60;
                                                if ($fraction == "0") {
                                                    $final_start_time = $whole . ":00 PM";
                                                } else {
                                                    $final_start_time = $whole . ":" . $fraction . " PM";
                                                }
                                            }

                                            $whole_end = floor($end_time);
                                            $fraction_end = $end_time - $whole_end;

                                            if ($end_time < 12) {
                                                $whole_end = floor($end_time);
                                                $fraction_end = ($end_time - $whole_end) * 60;
                                                if ($fraction_end == "0") {
                                                    $final_end_time = $whole_end . ":00 AM";
                                                } else {
                                                    $final_end_time = $whole_end . ":" . $fraction_end . " AM";
                                                }
                                            } else  if ($end_time > 12) {
                                                $whole_end = floor($end_time) - 12;
                                                $fraction_end = ($end_time - ($whole_end + 12)) * 60;
                                                if ($fraction_end == "0") {
                                                    $final_end_time = $whole_end . ":00 PM";
                                                } else {
                                                    $final_end_time = $whole_end . ":" . $fraction_end . " PM";
                                                }
                                            } else if ($end_time == 12) {
                                                $whole_end = floor($end_time);
                                                $fraction_end = ($end_time - $whole_end) * 60;
                                                if ($fraction_end == "0") {
                                                    $final_end_time = $whole_end . ":00 PM";
                                                } else {
                                                    $final_end_time = $whole_end . ":" . $fraction_end . " PM";
                                                }
                                            }






                                    ?>
                                           <option value='<?php echo $label . "," . $start_time . "," . $end_time ?>'><?php echo $label . "(" . $final_start_time . "-" . $final_end_time . ")"  ?></option>
        

                                    <?php   }
                                    } ?>



                                </select>
                            </div>

                        </div>

                        <div class="form-group">
                            <label>Reason</label>
                            <textarea name="label" class="form-control" placeholder="Enter Reason(40 Characters)" maxlength="40"></textarea>
                        </div>

                        <div class="form-group">

                            <button name="sub" value="sub" class="btn btn-primary">Submit</button>
                        </div>

                </div>
                <?php
                if (isset($_POST['sub'])) {
                    $user_label = $_POST['label'];

                    $type = $_POST['type'];

                    $jk_id = $_POST['jk_id'];
                    $label_id = $_POST['label_id'];
                    $flag = 0;

                    if ($type == 1) {
                        $dates = explode(',', $_POST['dates']);

                        foreach ($dates as $date) {

                            if (in_array("0", $jk_id)) {
                                $sql = "SELECT id from jk_info";
                                $run = $conn->query($sql);
                                if ($run->num_rows > 0) {
                                    while ($row = $run->fetch_assoc()) {
                                        $id = $row['id'];
                                        foreach ($label_id as $label_id_) {
                                            list($label, $start_time, $end_time) = explode(',', $label_id_);

                                            $s1 = "SELECT id from timings WHERE jk_id=$id AND (label='$label' AND start_time='$start_time' AND end_time='$end_time')";
                                            $run1 = $conn->query($s1);
                                            if ($run1->num_rows > 0) {
                                                $row1 = $run1->fetch_assoc();
                                                $timing_id = $row1['id'];
                                            
                                                $s222="SELECT COUNT(*) as c2 from blocked where date='$date' and jk_id=$id and timings_id=$timing_id";
                                                $run222=$conn->query($s222);
                                                $row222=$run222->fetch_assoc();
                                                $c222=$row222['c2'];
                                                if($c222>0)
                                                {
                                                    $s2 = "UPDATE blocked SET status=0,label='$user_label' WHERE timings_id=$timing_id and jk_id=$id and date='$date'";
                                                    mysqli_query($conn, $s2);
        
                                                }
                                                else
                                                {


                                            $s2 = "INSERT INTO blocked (`jk_id`, `date`, `label`, `timings_id`, `type`) VALUES($id,'$date','$user_label',$timing_id,0)";
                                            mysqli_query($conn, $s2);
                                                }
                                            }
                                        }
                                    }
                                }
                            } else {
                                foreach ($jk_id as $id) {
                                    foreach ($label_id as $label_id_) {
                                        list($label, $start_time, $end_time) = explode(',', $label_id_);

                                        $s1 = "SELECT id from timings WHERE jk_id=$id AND (label='$label' AND start_time='$start_time' AND end_time='$end_time')";
                                        $run1 = $conn->query($s1);
                                        if ($run1->num_rows > 0) {
                                            $row1 = $run1->fetch_assoc();
                                            $timing_id = $row1['id'];
                                        $s222="SELECT COUNT(*) as c2 from blocked where date='$date' and jk_id=$id and timings_id=$timing_id";
                                        $run222=$conn->query($s222);
                                        $row222=$run222->fetch_assoc();
                                        $c222=$row222['c2'];
                                        if($c222>0)
                                        {
                                            $s2 = "UPDATE blocked SET status=0,label='$user_label' WHERE timings_id=$timing_id and jk_id=$id and date='$date'";
                                            mysqli_query($conn, $s2);

                                        }
                                        else
                                        {





                                        $s2 = "INSERT INTO blocked (`jk_id`, `date`, `label`, `timings_id`, `type`) VALUES($id,'$date','$user_label',$timing_id,1)";
                                        mysqli_query($conn, $s2);
                                        }
                                        }
                                    }
                                }
                            }
                        }
                    } else {
                        $range = $_POST['daterange'];
                        list($first, $second) = explode('-', $range);

                        list($f_m, $f_d, $f_y) = explode('/', $first);
                        $f_first0 = $f_y . "-" . $f_m . "-" . $f_d;
                        $f_first = str_replace(' ', '', $f_first0);

                        list($s_m, $s_d, $s_y) = explode('/', $second);
                        $f_second0 = $s_y . "-" . $s_m . "-" . $s_d;
                        $f_second = str_replace(' ', '', $f_second0);

                        $date_from = strtotime($f_first); // Convert date to a UNIX timestamp  


                        $date_to = strtotime($f_second); // Convert date to a UNIX timestamp  

                        // Loop from the start date to end date and output all dates inbetween  
                        for ($i = $date_from; $i <= $date_to; $i += 86400) {
                            $date = date("Y-m-d", $i);

                            if (in_array("0", $jk_id)) {
                                $sql = "SELECT id from jk_info";
                                $run = $conn->query($sql);
                                if ($run->num_rows > 0) {
                                    while ($row = $run->fetch_assoc()) {
                                        $id = $row['id'];
                                        foreach ($label_id as $label_id_) {
                                            list($label, $start_time, $end_time) = explode(',', $label_id_);

                                            $s1 = "SELECT id from timings WHERE jk_id=$id AND (label='$label' AND start_time='$start_time' AND end_time='$end_time')";
                                            $run1 = $conn->query($s1);
                                            if ($run1->num_rows > 0) {
                                                $row1 = $run1->fetch_assoc();
                                                $timing_id = $row1['id'];
                                            
                                                $s222="SELECT COUNT(*) as c2 from blocked where date='$date' and jk_id=$id and timings_id=$timing_id";
                                                $run222=$conn->query($s222);
                                                $row222=$run222->fetch_assoc();
                                                $c222=$row222['c2'];
                                                if($c222>0)
                                                {
                                                    $s2 = "UPDATE blocked SET status=0,label='$user_label' WHERE timings_id=$timing_id and jk_id=$id and date='$date'";
                                                    mysqli_query($conn, $s2);
        
                                                }
                                                else
                                                {



                                            $s2 = "INSERT INTO blocked (`jk_id`, `date`, `label`, `timings_id`, `type`) VALUES($id,'$date','$user_label',$timing_id,0)";
                                            mysqli_query($conn, $s2);
                                            }
                                        }
                                    }
                                    }
                                }
                            } else {
                                foreach ($jk_id as $id) {
                                    foreach ($label_id as $label_id_) {
                                        list($label, $start_time, $end_time) = explode(',', $label_id_);

                                        $s1 = "SELECT id from timings WHERE jk_id=$id AND (label='$label' AND start_time='$start_time' AND end_time='$end_time')";
                                        $run1 = $conn->query($s1);
                                        if ($run1->num_rows > 0) {
                                            $row1 = $run1->fetch_assoc();
                                            $timing_id = $row1['id'];
                                        

                                            $s222="SELECT COUNT(*) as c2 from blocked where date='$date' and jk_id=$id and timings_id=$timing_id";
                                            $run222=$conn->query($s222);
                                            $row222=$run222->fetch_assoc();
                                            $c222=$row222['c2'];
                                            if($c222>0)
                                            {
                                                $s2 = "UPDATE blocked SET status=0,label='$user_label' WHERE timings_id=$timing_id and jk_id=$id and date='$date'";
                                                mysqli_query($conn, $s2);
    
                                            }
                                            else
                                            {

                                        $s2 = "INSERT INTO blocked (`jk_id`, `date`, `label`, `timings_id`, `type`) VALUES($id,'$date','$user_label',$timing_id,1)";
                                        mysqli_query($conn, $s2);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                ?>
                    <script>
                        // Get the modal
                        var modal = document.getElementById("right_modal");

                        // Get the button that opens the modal
                        var btn = document.getElementById("myBtn");

                        // Get the <span> element that closes the modal
                        var span = document.getElementsByClassName("close")[0];



                        // When the user clicks on <span> (x), close the modal
                        span.onclick = function() {
                            modal.style.display = "none";
                        }

                        // When the user clicks anywhere outside of the modal, close it
                        window.onclick = function(event) {
                            if (event.target == modal) {
                                modal.style.display = "none";
                            }
                        }




                        modal.style.display = "block";
                    </script>
                <?php
                }
                ?>
                </form>
            </div>
        </div>
    </div>
    <script>
        function change_type() {
            var type = document.getElementById("type").value;
            if (type == 1) {
                document.getElementById("type_result").innerHTML = '<div class="input-group date form-group" id="datepicker"> <input type="text" class="form-control" id="Dates" name="dates" placeholder="Select dates" required /> <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i><span class="count"></span></span> </div>';

                $(document).ready(function() {
                    $('#datepicker').datepicker({
                        startDate: new Date(),
                        multidate: true,
                        format: "yyyy-mm-dd",
                        daysOfWeekHighlighted: "5,6",

                        language: 'en'
                    }).on('changeDate', function(e) {
                        // `e` here contains the extra attributes
                        $(this).find('.input-group-addon .count').text(' ' + e.dates.length);
                    });
                });

            } else {
                document.getElementById("type_result").innerHTML = ' <input type="text" class="form-control" name="daterange" /><br>';

                $(function() {
                    $('input[name="daterange"]').daterangepicker({
                        opens: 'left',

                    }, function(start, end, label) {
                        console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
                    });
                });

            }
        }
    </script>

    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script src="js/demo/datatables-demo.js"></script>

    <?php
    require('footer.php');
    ?>
</body>

</html>