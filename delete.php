<?php
    $con = mysqli_connect("localhost","root","","clinicalportal");
    $Id=$_GET['id'];
    if(isset($_GET["id"]))
    {
        $sql="delete from user where id='".$Id."'";
        mysqli_query($con,$sql);
        header("Location:/clinicalportal/admin.php");
        exit();
    }
?>