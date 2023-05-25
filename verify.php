<?php
$Id=$_GET['id'];
$con=mysqli_connect("localhost","root","","clinicalportal");
if(isset($_GET['id'])){
    $sql="update appoinment set Status='Approved' where id='".$Id."'";
    mysqli_query($con,$sql);
    $sql1="select * from appoinment where id='".$Id."'";
    $result=mysqli_query($con,$sql1);
    $value=mysqli_fetch_array($result);
    header("Location:/clinicalportal/doctor.php?id=".$value['Did']);
    exit();
}
?>