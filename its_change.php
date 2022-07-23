<?php
session_start();
if (isset($_SESSION['access'])) {
    $access = $_SESSION['access'];
} else {
    header("Location: main.php");
    die();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="https://use.fontawesome.com/3582a84b00.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITS Change</title>
    <style>
        .btn-block {
            background-color: #4e73df;
        }

        .btn {
            color: #fff;
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
            <div class="card shadow mb-4 ">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">ITS Change</h6>
                </div>
                <div class="card-body">


                    <div class="row mt-4">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="5px">
                                <thead>
                                    <tr>
                                       
                                        <th>ITS</th>
                                        <th>Change</th>
                                        <th>Name</th>
                                        <th>Mobile</th>

                                       
                                      


                                    </tr>

                                </thead>
                                <tbody>
                                    <?php require('connectDB.php');
                                $sql2 = "SELECT * from booking_info WHERE its=11111111 GROUP BY name";


$run2 = $conn->query($sql2); ?>
<?php if ($run2->num_rows > 0) {
     while ($row = $run2->fetch_assoc()) {
        $id = $row['id'];
        $its = $row['its'];
        $name = $row['name'];
        $mobile = $row['mobile'];
        $date = $row['date'];
        $status = $row['status'];
        $jk_id = $row['jk_id'];
        $s4 = "SELECT * from jk_info WHERE id=$jk_id";
        $run4 = $conn->query($s4);
        $row4 = $run4->fetch_assoc();
        $jk_name = $row4['name'];
        $amount = $row4['amount'];
        $capacity = $row4['capacity'];
        $timings_id = $row['timings_id'];
        $s6 = "SELECT * from timings WHERE id=$timings_id";
        $run6 = $conn->query($s6);
        $row6 = $run6->fetch_assoc();
        $label_name = $row6['label'];
        $start_time = $row6['start_time'];
        $end_time = $row6['end_time'];
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
        }
        else if ($start_time == 12) {
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
        }
        else if ($end_time == 12) {
            $whole_end = floor($end_time);
            $fraction_end = ($end_time - $whole_end) * 60;
            if ($fraction_end == "0") {
                $final_end_time = $whole_end . ":00 PM";
            } else {
                $final_end_time = $whole_end . ":" . $fraction_end . " PM";
            }
        } ?>
        <tr>
           
            <form method="POST">
            <td><input type="number" max="99999999" class="form-control" name="its" ></td>
            <td><button name="change" value='<?php echo $name ?>' class="btn btn-primary">Change</button></td>
            <?php
if(isset($_POST['change']))
{
    $its=$_POST['its'];
    $name=$_POST['change'];
    $sql="UPDATE booking_info SET its='$its' WHERE name='$name'";
    if(mysqli_query($conn,$sql))
    {
        echo '<script>window.location="its_change.php"</script>';

    }
}
            ?>
            </form>
            <td><?php echo $name ?></td>
            <td><?php echo $mobile ?></td>
            



        </tr>
    <?php     }
}

    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
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
        $(document).ready(function() {

            $('input[type=number][max]:not([max=""])').on('input', function(ev) {
                var $this = $(this);
                var maxlength = $this.attr('max').length;
                var value = $this.val();
                if (value && value.length >= maxlength) {
                    $this.val(value.substr(0, maxlength));
                }
            });

        });
    </script>

  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>





</body>

</html>