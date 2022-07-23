<?php
ini_set('display_errors', 0);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();
date_default_timezone_set('Asia/Kolkata');
$c_d = date('Y-m-d');
if (isset($_SESSION['access']) && $_SESSION['exp_date'] > $c_d) {
    $forms_access = $_SESSION['forms_access'];
    $flag = 0;
    foreach ($forms_access as $formid) {
        if ($formid == "35") {
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

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="https://use.fontawesome.com/3582a84b00.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <style>
        .btn-block {
            background-color: #4e73df;
        }

        .btn {
            color: #fff;
        }

        .ui-datepicker-calendar {
            display: none;
        }

        .overlay{
        display: none;
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 999;
        background: rgba(255,255,255,0.8) url("/photos/loader.gif") center no-repeat;
    }
  
    /* Turn off scrollbar when body element has the loading class */
    body.loading{
        overflow: hidden;   
    }
    /* Make spinner image visible when body element has the loading class */
    body.loading .overlay{
        display: block;
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
                    <h6 class="m-0 font-weight-bold text-primary">Report</h6>
                </div>
                <div class="card-body">
                    <form id="form1" method="GET">
                        <div class="row">

                            <div class="col-lg-2">


                                <select name="type" class="form-control" onChange="change_type()" id="type" required>
                                    <option>Select Report By</option>
                                    <option value="6">Jamaat Khaana</option>
                                    <option value="1">ITS</option>
                                    <option value="7">Booking ID</option>
                                    <option value="2">Name</option>
                                    <option value="3">Mobile</option>
                                    <option value="4">Payment Pending</option>
                                    <option value="5">Jamaat Khaana Block Dates</option>
                                    <option value="8">Cash Ledger</option>
                                    <option value="9">Cheque Ledger</option>
                                    <option value="10">Online Txn Ledger</option>

                                </select>
                            </div>
                            <div class="col-lg-2">
                                <div id="1">

                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div id="2">

                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div id="3">

                                </div>
                            </div>

                        </div>
                        <div class="row mt-4">
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="bkid" name="checkbox[]" value="bkid" checked>
                                <label class="form-check-label" for="bkid">Booking ID</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="its" name="checkbox[]" value="its" checked>
                                <label class="form-check-label" for="its">ITS</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="its" name="checkbox[]" value="name" checked>
                                <label class="form-check-label" for="name">Name</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="mobile" name="checkbox[]" value="mobile" checked>
                                <label class="form-check-label" for="mobile">Mobile</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="jk" name="checkbox[]" value="jk" checked>
                                <label class="form-check-label" for="jk">Jamaat Khaana</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="capacity" name="checkbox[]" value="capacity">
                                <label class="form-check-label" for="capacity">Capacity</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="date" name="checkbox[]" value="date" checked>
                                <label class="form-check-label" for="date">Booking Date</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="timing" name="checkbox[]" value="timing" checked>
                                <label class="form-check-label" for="timing">Timing</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="start_time" name="checkbox[]" value="start_time">
                                <label class="form-check-label" for="start_time">Start Time</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="end_time" name="checkbox[]" value="end_time">
                                <label class="form-check-label" for="end_time">End Time</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="rent" name="checkbox[]" value="rent" checked>
                                <label class="form-check-label" for="rent">Rent</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="rentp" name="checkbox[]" value="rentp" checked>
                                <label class="form-check-label" for="rentp">Rent Paid</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="rentc" name="checkbox[]" value="rentc" checked>
                                <label class="form-check-label" for="rentc">Rent Cleared</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="admin" name="checkbox[]" value="admin">
                                <label class="form-check-label" for="admin">Admin</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="laagat" name="checkbox[]" value="laagat">
                                <label class="form-check-label" for="laagat">Laagat</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="thaals" name="checkbox[]" value="thaals">
                                <label class="form-check-label" for="thaals">Thaals</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="purpose" name="checkbox[]" value="purpose">
                                <label class="form-check-label" for="purpose">Purpose</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="scd" name="checkbox[]" value="scd" checked>
                                <label class="form-check-label" for="scd">Security Deposit</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="m" name="checkbox[]" value="m">
                                <label class="form-check-label" for="m">Manager Status</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="rs" name="checkbox[]" value="rs">
                                <label class="form-check-label" for="rs">Refund Status</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="bks" name="checkbox[]" value="bks" checked>
                                <label class="form-check-label" for="bks">Booking Status</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="formid" name="checkbox[]" value="formid">
                                <label class="form-check-label" for="formid">Form ID</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="pdf" name="checkbox[]" value="pdf">
                                <label class="form-check-label" for="pdf">Pdf/Image</label>
                            </div>
                            <div class="form-check ml-2">
                                <input type="checkbox" class="form-check-input" id="garbage" name="checkbox[]" value="garbage" checked>
                                <label class="form-check-label" for="garbage">Garbage Charge</label>
                            </div>
                            <button name="submit" class="btn btn-primary ml-2 mt-2" value="submit">Submit</button>
                        </div>

                </div>
            </div>
            </form>
            <div id="report_table">
            </div>
            <div class="overlay"></div>
        </div>
    </div>




    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>


    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>

    <script src="js/demo/datatables-demo.js"></script>


    <script src="select1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  

    <script>
        $(function() {

            $('#form1').on('submit', function(e) {

                e.preventDefault();

                $.ajax({
                    type: 'GET',
                    url: 'ajax_report.php',
                    data: $('#form1').serialize(),
                    success: function(response) {
                        $('#report_table').html(response);

                    }
                });

            });

        });

        $(document).on({
    ajaxStart: function(){
        $("body").addClass("loading"); 
    },
    ajaxStop: function(){ 
        $("body").removeClass("loading"); 
    }    
});
    </script>
<?php
require('footer.php');
?>

</body>

</html>