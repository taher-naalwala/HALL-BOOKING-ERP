<?php
require('connectDB.php');
$sql="SELECT id,bk_id,amount,debit,c_date,status from ledger3 WHERE type=0";
$run=$conn->query($sql);
while($row=$run->fetch_assoc())
{
    $bk_id=$row['bk_id'];
    $ledger_id=$row['id'];
    $amount=$row['amount'];
    $debit=$row['debit'];
    $c_date=$row['c_date'];

    $s1="UPDATE ledger SET ledger_id=$ledger_id WHERE booking_id=$bk_id AND amount='$amount' AND debit=$debit AND c_date='$c_date' AND trust_id=2";
mysqli_query($conn,$s1);

}
                                                  
?>