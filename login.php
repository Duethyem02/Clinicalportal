<?php
$con=mysqli_connect("localhost","root","","clinicalportal");
if(isset($_POST['submit']))
{
    $email=$_POST['EMAIL'];
    $password=$_POST['PASSWORD'];
    $sql="select * from user where Username='$email' and Password='$password'";
    $r=mysqli_query($con,$sql);
    $value=mysqli_fetch_array($r);
    if($r->num_rows==0)
    {?>
        <script> alert("User not Found/Incorrect Email or Password ");</script>
<?php   }
    else {
        $id=$value['id'];
        $role=$value['Role'];
        if($role=="Admin"){
            header("Location:/clinicalportal/admin.php?id=".$id);
            exit();
        }
        elseif($role=="Doctor"){
            header("Location:/clinicalportal/doctor.php?id=".$id);
            exit();
        }
        elseif($role=="Pharmacist"){
            header("Location:/clinicalportal/pharmacist.php?id=".$id);
            exit();
        }
        else{
            header("Location:/clinicalportal/patient.php?id=".$id);
            exit();
        }
    }
    echo mysqli_error($con);

} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Design by foolishdeveloper.com -->
    <title>Login</title>
 
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
form{
    height: 520px;
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

    </style>
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form method="post" action="<?php $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
        <h3>Login Here</h3>

        <label for="username">Username</label>
        <input type="text" placeholder="Email" id="username" name="EMAIL" required>

        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password" name="PASSWORD" required>

        <button name="submit">Log In</button>
        <a href="http://localhost/clinicalportal/register.php" >Sign Up</a>
    </form>
</body>
</html>
