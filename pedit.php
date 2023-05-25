<?php
$con=mysqli_connect("localhost","root","","clinicalportal");
$Id=$_GET['id'];
$value;
if(isset($_GET["id"]))
    {
        $sql="select * from appoinment where id='".$Id."'";
        $result=mysqli_query($con,$sql);
        $value=mysqli_fetch_array($result);
        $date=date_create($value['Date']);
        date_add($date,date_interval_create_from_date_string("5 days"));
        $Newdate = date_format($date,"Y-m-d");
    }
if(isset($_POST['submit']))
{
    $date=$_POST["DATE"];
    $sql="update appoinment set Date='".$_POST['DATE']."' where id='".$Id."'";
    mysqli_query($con,$sql);
    echo mysqli_error($con);
    header("Location:/clinicalportal/doctor.php?id=".$value['Did']);
    exit();
}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Design by foolishdeveloper.com -->
    <title>Register</title>
 
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
.background{
    width: 430px;
    height: 520px;
    position: absolute;
    transform: translate(-50%,-50%);
    left: 50%;
    top: 50%;
}
.background .shape{
    height: 200px;
    width: 200px;
    position: absolute;
    border-radius: 50%;
}
button{
    margin-top: 50px;
    width: 100%;
    background-color: #ffffff;
    color: #000080;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
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
form{
    height: 700px;
    width: 400px;
    background-color: rgba(255,255,255,0.13);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 50px 35px;
}
form *{
    font-family: 'Poppins',sans-serif;
    color: #000080;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}
form h3{
    font-size: 32px;
    font-weight: 500;
    line-height: 42px;
    text-align: center;
}

label{
    display: block;
    margin-top: 30px;
    font-size: 16px;
    font-weight: 500;
}
input,select{
    display: block;
    height: 50px;
    width: 100%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
}
::placeholder{
    color: #0E4C92;
}
.Submit{
    margin-top: 50px;
    width: 100%;
    background-color: #ffffff;
    color: #000080;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
}
    </style>
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form method="post" action="<?php $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
        <h3>EDIT FORM</h3>

        <label for="name">Name of Patient</label>
        <input type="text" placeholder="Name" id="name" name="PNAME" value=<?php echo $value['PName'];?> required>
       
        <label for="pid">Patinet ID</label>
        <input type="text" id="pid" name="PID" value=<?php echo $value['Pid'];?> required>

        <label for="date">Date</label>
        <input type="date"  id="date" value=<?php echo $value['Date'];?> name="DATE" min=<?php echo $value['Date'];?> max=<?php echo $Newdate ?>>

        <button name="submit">Submit</button>
    </form>
</body>
</html>
