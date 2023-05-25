<?php
$con=mysqli_connect("localhost","root","","clinicalportal");
$today=new DateTime('now');
$today=$today->format('Y-m-d');
$value;
$Id=$_GET['id'];
$sql="select * from appoinment where Pid='".$Id."'";
$result1=mysqli_query($con,$sql);
if(isset($_GET["id"]))
{
    $sql="select * from user where id='".$Id."'";
    $result=mysqli_query($con,$sql);
    $value=mysqli_fetch_assoc($result);
}
if(isset($_POST['submit']))
{
    $dname=$_POST["NAME"];
    $department=$_POST["DEPARTMENT"];
    $date=$_POST["DATE"];
    $pname=$value['Name'];
    $sql1="select id from user where Role='Doctor' and Name='".$dname."' and Department='".$department."'";
    $result= mysqli_query($con,$sql1);
    $result2=mysqli_fetch_array($result);
    $did=$result2['id'];
    $sql="insert into appoinment(PName,Pid,Dname,Did,Department,Date) values('$pname','$Id','$dname','$did','$department','$date')";
    mysqli_query($con,$sql);
    echo mysqli_error($con);
    header("Location:/clinicalportal/patient.php?id=".$Id);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Design by foolishdeveloper.com -->
    <title>Patient</title>
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <!--Stylesheet-->
    <style media="screen">
      *,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body{
    background-color:#6693F5;
}
div{
    height: 700px;
    width: 100%;
    padding:20px;
    background-color: rgba(255,255,255,0.47);
}
.social{
  margin-top: 30px;
  display: flex;
}
.social div{
  background: red;
  width: 150px;
  border-radius: 3px;
  padding: 5px 10px 10px 5px;
  background-color: rgba(255,255,255,0.27);
  color: #eaf0fb;
  text-align: center;
}
.social div:hover{
  background-color: rgba(255,255,255,0.47);
}
.social .fb{
  margin-left: 25px;
}
.social i{
  margin-right: 4px;
}
.nav{
    background-color: #ffffff;
    color: #000080;
    font-weight: 400;
    font-size:17px;
    border-radius: 5px;
    cursor: pointer;
    text-align:center;
    border:none;
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
 </style>
</head>
<body>
  <br>
  <h2>Hi,<?php echo $value['Name'];?> </h2>
  <img src="./image/<?php echo $value['Filename']; ?>">
  <div>
        <button class="nav" onclick="bookappointment()">Book Appointment</button>
        <button class="nav" onclick="checkstatus()">Check Status </button>
        <div id="appointment" >
            <form method="post" action="<?php $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
                <h3>Book Appointment</h3><br>

                <label for="name">Name of Doctor</label>
                <input type="text" placeholder="Name of Doctor" id="name" name="NAME" required><br><br>
       
                <label for="dep">Department</label>
                <input type="text"  placeholder="Department" id="dep" name="DEPARTMENT" required><br><br>

                <label for="date">Date</label>
                <input type="date" id="date"  name="DATE" min=<?php echo $today;?> required><br><br>

                <button name="submit">Submit</button>
            </form>
        </div>
        <div id="status" style="display:none">
          <table style="width:75%">
            <tr>
              <th>Name of Doctor</th>
              <th>Department</th>
              <th>Date</th>
              <th>Status</th>
            </tr>
            <?php while($status=mysqli_fetch_array($result1)){?>
                <tr>
                    <td><?php echo $status["Dname"];?></td>
                    <td><?php echo $status["Department"];?></td>
                    <td><?php echo $status["Date"];?></td>
                    <td><?php echo $status["Status"];?></td>
                </tr>
            <?php }?>
          </table>
        </div>
  </div>
</body>
<script>
  function bookappointment()
  {
    var a=document.getElementById("appointment");
    var s=document.getElementById("status");
    a.style.display="block";
    s.style.display="none";
  }
  function checkstatus(){
    var a=document.getElementById("appointment");
    var s=document.getElementById("status");
    a.style.display="none";
    s.style.display="block";
  }
</script>
</html>