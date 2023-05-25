<?php
$con=mysqli_connect("localhost","root","","clinicalportal");
$id=$_GET['id'];
$sql = "select * from appoinment where Did=$id";
$result=mysqli_query($con,$sql);
$value=mysqli_fetch_all($result);
if(isset($_POST['Back']))
{
    header("Location:/clinicalportal/admin.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Appointments</title>
    </head>
    <style>
body{
    background-color:#6693F5;
}
table,th,td{
    border: 1px solid black;
    border-collapse:collapse;
    text-align:left;
    padding-left:5px;
}
tr{
    background-color:white;
} 
tr:hover{
    background-color:rgba(195,99,71,0.3);
}
button{
  width:150px;
  color: #000080;
  padding: 8px 16px;
  text-decoration: none;
  background-color:white;
  border:none;
}
button:hover {
  background-color:rgba(195,99,71,0.3);
  color: white;
}
    </style>
    <body>
        <form method="post" action="<?php $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
            <button name="Back">Back</button><br><br>
        </form>
        <table>
            <tr>
                <th>Name of Patient</th>
                <th>Patient ID</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
            <?php foreach($value as $data){?>
            <tr>
                <td><?php echo $data[1];?></td>
                <td><?php echo $data[2];?></td>
                <td><?php echo $data[6];?></td>
                <td><?php echo $data[7];?></td>
            </tr>
            <?php } ?>
        </table>
    </body>
</html>