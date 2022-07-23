function change_jk() {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "ajax.php?jk_id=" + document.getElementById("jk_id").value, false);
    xmlhttp.send(null);
    document.getElementById("timing_date").innerHTML = xmlhttp.responseText;

}
function change_edit_option()
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "ajax.php?choice_id=" + document.getElementById("choice_id").value, false);
    xmlhttp.send(null);
    document.getElementById("jk_id_edit").innerHTML = xmlhttp.responseText;

}

function change_edit_jk()
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "ajax.php?jk_id_edit=" + document.getElementById("jk_id").value, false);
    xmlhttp.send(null);
    document.getElementById("timing_id_edit").innerHTML = xmlhttp.responseText;

}

function change_jk_transfer() {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "ajax.php?jk_id_transfer=" + document.getElementById("jk_id").value, false);
    xmlhttp.send(null);
    document.getElementById("timing_date").innerHTML = xmlhttp.responseText;

}

function change_jk_day() {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "ajax.php?jk_id=" + document.getElementById("jk_id_day").value, false);
    xmlhttp.send(null);
    document.getElementById("timing_day").innerHTML = xmlhttp.responseText;

}

function change_jk_range() {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "ajax.php?jk_id=" + document.getElementById("jk_id_range").value, false);
    xmlhttp.send(null);
    document.getElementById("timing_range").innerHTML = xmlhttp.responseText;

}

function change_jk_rent() {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "ajax.php?jk_id_rent=" + document.getElementById("jk_id_rent").value, false);
    xmlhttp.send(null);
    document.getElementById("date_rent").innerHTML = xmlhttp.responseText;

}

function change_type() {
    $("#2").empty();
    $("#3").empty();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "ajax.php?type=" + document.getElementById("type").value, false);
    xmlhttp.send(null);
    document.getElementById("1").innerHTML = xmlhttp.responseText;
    $(function () {
        $('input[name="daterange"]').daterangepicker({
           
            opens: 'left'
        }, function (start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });


}

function change_ledger_report() {
   
    document.getElementById("2").innerHTML = '<select class="form-control" name="c_ledger_1" id="c_ledger_1" onchange="change_ledger_report_1()" required><option value="">--Select--</option><option value="6">All</option><option value="0">Hall Rent</option><option value="3">Garbage</option><option value="4">Miscellaneous</option><option value="5">Payment Voucher</option><option value="1">Security Deposit</option><option value="2">Refund Security Deposit</option></select>';
   
}

function change_ledger_report_1() {
   
  
    document.getElementById("3").innerHTML = '<input type="text" class="form-control" name="daterange" />';
    $(function () {
        $('input[name="daterange"]').daterangepicker({
            startDate: '12/01/2020',
            opens: 'left'
        }, function (start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });
}
function change_pp() {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "ajax.php?pp=" + document.getElementById("pp").value, false);
    xmlhttp.send(null);
    document.getElementById("2").innerHTML = xmlhttp.responseText;

    $(function () {
        $('input[name="daterange"]').daterangepicker({
           
            opens: 'left'
        }, function (start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });


}

function change_jk_report() {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "ajax.php?jk_id_report=" + document.getElementById("jk_id_report").value, false);
    xmlhttp.send(null);
    document.getElementById("1").innerHTML = xmlhttp.responseText;

}
function change_timing_report() {

    document.getElementById("2").innerHTML = "<select class='form-control' name='status' onchange='change_status_report()' required><option value=''>Select Status</option><option value='0'>All Status</option><option value='6'>All Status (Except Cancelled)</option><option value='1'>Payment Pending</option><option value='2'>Clearance Pending</option><option value='3'>Booked</option><option value='4'>Cancelled</option><option value='5'>Booked with no Laagat and Thaals</option><option value='7'>Deleted Booking</option></select>";

}

function change_status_report() {

 
    document.getElementById("3").innerHTML = '<input type="text" class="form-control" name="daterange" />';

    $(function () {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left'
        }, function (start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });


}