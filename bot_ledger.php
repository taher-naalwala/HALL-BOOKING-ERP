<?php require('connectDB.php');

$sql="SELECT DISTINCT bk_id from ledger3 WHERE bk_id!=0";
$run=$conn->query($sql);
$array=array();
while($row=$run->fetch_assoc())
{
    $string=$row['bk_id'];
    array_push($array,$string);
   
}
$ids = join("','",$array);
$sql1 = "SELECT booking_id,amount,check_number,account_number,pay_mode,debit,credit,c_date,check_cleared_date FROM ledger WHERE booking_id NOT IN ('$ids') AND trust_id=2 AND amount!=0 AND status!=0 ORDER BY c_date ASC";
$run1=$conn->query($sql1);
while($row1=$run1->fetch_assoc())
{
    $bk_id=$row1['booking_id'];
    $amount=$row1['amount'];
    $check_number=$row1['check_number'];
    $ac=$row1['account_number'];
    $pay_mode=$row1['pay_mode'];
    $debit=$row1['debit'];
    $credit=$row1['credit'];
    $c_date=$row1['c_date'];
    $cl_date=$row1['check_cleared_date'];
    $s1="SELECT name from booking_info WHERE id=$bk_id";
    $run2=$conn->query($s1);
    $row2=$run2->fetch_assoc();
    $name=$row2['name'];
    $s2 = "INSERT INTO ledger3 ( `bk_id`, `amount`,`trust_id`, `check_number`, `account_number`, `pay_mode`, `debit`, `credit`, `c_date`, `time`, `status`, `check_cleared_date`, `name`, `type`) VALUES($bk_id,'$amount',2,'$check_number','$ac',$pay_mode,$debit,$credit,'$c_date','10:00:00',4,'$cl_date','$name',0)";
    mysqli_query($conn,$s2);
                           
}
?>