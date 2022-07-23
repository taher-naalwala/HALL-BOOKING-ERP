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
			.footer {
  position:fixed;
    bottom: 0;
    width: 100%;
    height: 30px;
	
	text-align:center;
  
    background-color: #f5f5f5;
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
            if (isset($_SESSION['mobile_client'])) {
                $mobile = $_SESSION['mobile_client'];
                 $number = rand(1000, 9999);
                $_SESSION['number'] = $number;
                $msg = "Your OTP for Security Deposit Refund: " . $number;
                $final_msg = str_replace(" ", "%20", $msg);
                $url = 'http://prime.sms-excel.com/submitsms.jsp?user=aesindor&key=00a7b283abXX&mobile=+91' . $mobile . '&message=' . $final_msg . '&senderid=INFOSM&accusage=1';

                 $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);

                //return the transfer as a string 
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                // $output contains the output string 
                $output = curl_exec($ch);


                // close curl resource to free up system resources 
                curl_close($ch); 
            } else {
                $mobile = $_SESSION['mobile'];
                $email = $_SESSION['email'];

                if (isset($_SESSION['number'])) {
                    $_SESSION['number'];
                } else {
                     $number = rand(1000, 9999);
                    $_SESSION['number'] = $number;
                    $msg = "Your OTP for Admin Login: " . $number;
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

                    mail($email, "OTP Authentication", $msg);
                }

                if (isset($_POST['resend'])) {
                    unset($_SESSION['number']);

                    $number = rand(1000, 9999);
                    $_SESSION['number'] = $number;
                    $msg = "Your OTP for Admin Login: " . $number;
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

                    mail($email, "OTP Authentication", $msg);
                }
            }

            ?>

            <form method="POST" action="check.php">
                <div class="form-group">
                    <label>Enter OTP</label>
                    <input type="number" class="form-control" name="otp" max="9999" placeholder="Enter 4 digit OTP" required>
                </div>
                <button name="submit" class="btn btn-success btn-block" value="submit">Submit</button>

            </form>
            <br>
            <form method="POST" id="resend_form">
                <button name="resend" id="resend" class="btn btn-info btn-block" value="submit">Resend OTP</button>

            </form>



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



        $(function() {
            timer();
            $("#resend").attr("disabled", "disabled");
            //  $('#resend').text('Resend OTP (Wait For 30 seconds)');
            setTimeout(function() {
                $("#resend").removeAttr("disabled");
                // $('#resend').text('Resend OTP');
            }, 30000);

        });

        function timer() {
            var timeLeft = 30;
            var elem = document.getElementById('resend');

            var timerId = setInterval(countdown, 934);

            function countdown() {
                if (timeLeft == -1) {
                    clearTimeout(timerId);
                    elem.textContent = "Resend OTP";
                } else {
                    elem.textContent = "Resend OTP (Wait For " + timeLeft + ' seconds)';
                    timeLeft--;
                }
            }
        }
    </script>
	<footer class="footer">
     
        <span class="text-muted">Developed By Taher Naalwala (<a target="_blank" href="https://mail.google.com/mail/?view=cm&fs=1&to=naalwala12taher@gmail.com">naalwala12taher@gmail.com</a>)</span>
    
    </footer>
</body>


</html>