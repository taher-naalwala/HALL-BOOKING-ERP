<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://use.fontawesome.com/3582a84b00.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jamaat Khana Booking</title>
    <style>
        .row {
            margin-right: 10px;
        }

        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }
    </style>
</head>

<body>
    <?php
    require('style_user.php');
    ?>
    <div class="card mt-2" id="forms">
        <div class="card-header" style="background-color: #52658F;color:white">
            OTP Verification
        </div>
        <div class="card-body" style="background-color: #F7F5E6;">
            <?php
            require('connectDB.php');
            if (isset($_GET['book'])) {
                $its = $_GET['its'];
                $name = $_GET['name'];
                $mobile = $_GET['mobile'];
                $_SESSION['its'] = $its;
                $_SESSION['name'] = $name;
                $_SESSION['mobile'] = $mobile;
                $date = $_SESSION['date'];

                $jk_id = $_SESSION['jk_id'];
                $timings_id = $_SESSION['timings_id'];

                if (strlen($its) == "8" && strlen($mobile) == "10") {
                    $s1 = "SELECT * from booking_info WHERE (its='$its' OR mobile='$mobile') AND (status=1 OR status=2)";
                    $run1 = $conn->query($s1);
                    if ($run1->num_rows > 1) { ?>
                        <img src="photos/wrong.png" class="center" style="width: 15%;">
                        <br>

                        <div class="alert alert-danger text-center" role="alert">
                            <h3> Booking Failed </h3>
                        </div>
                        <div class="alert alert-danger" role="alert">
                            You can have only 2 bookings per ITS at a time
                        </div>
                        <?php    } else {
                        $s2 = "SELECT * from booking_info WHERE date='$date' AND jk_id=$jk_id AND timings_id=$timings_id";
                        $run2 = $conn->query($s2);
                        if ($run2->num_rows > 0) { ?>

                            <div class="alert alert-danger" role="alert">
                                Already Reserved
                            </div>
                        <?php      } else {
                           $number = rand(1000, 9999);
                           $_SESSION['number']=$number;
                           $msg = "Your OTP for Jamaat Khana Booking is: " . $number;
                           $final_msg = str_replace(" ", "%20", $msg);
                           $url = 'http://prime.sms-excel.com/submitsms.jsp?user=aesindor&key=00a7b283abXX&mobile=+91' . $mobile . '&message=' . $final_msg . '&senderid=INFOSM&accusage=1';

                           $ch = curl_init();

                           // set url 
                           curl_setopt($ch, CURLOPT_URL, $url);

                           //return the transfer as a string 
                           curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                           // $output contains the output string 
                           $output = curl_exec($ch);


                           // close curl resource to free up system resources 
                           curl_close($ch);
                        ?>

                            <form method="POST" action="check_booking.php">
                                <div class="form-group">
                                    <label>Enter OTP</label>
                                    <input type="number" class="form-control" name="otp" max="9999" placeholder="Enter 4 digit OTP" required>
                                </div>
                                <button name="submit" class="btn btn-primary btn-block" value="submit">Submit</button>
                                
                            </form>

                        <?php      }

                        ?>



                    <?php

                    }
                } else {
                    ?>
                    <div class="alert alert-danger" role="alert">
                        Invalid ITS or Mobile Number
                    </div>
            <?php   }
            }

            ?>

        </div>
    </div>
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
</body>

</html>