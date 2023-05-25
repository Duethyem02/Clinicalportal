<?php
$con=mysqli_connect("localhost","root","","clinicalportal");
$Id=$_GET['id'];
if(isset($_GET["id"]))
    {
        $sql="select * from user where id='".$Id."'";
        $result=mysqli_query($con,$sql);
        $value=mysqli_fetch_array($result);
    }
if(isset($_POST['submit']))
{
    $name=$_POST["NAME"];
    $role=$_POST["ROLE"];
    $phone=$_POST["PHONE"];
    $email=$_POST['EMAIL'];
    $password=$_POST['PASSWORD'];
    $sql="update user set Name='$name',Role='$role',Phone='$phone',Username='$email',Password='$password' where id='$Id'";
    mysqli_query($con,$sql);
    echo mysqli_error($con);
    header("Location:/clinicalportal/admin.php");
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
    height: 800px;
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

        <label for="name">Name</label>
        <input type="text" placeholder="Name" id="name" name="NAME" value=<?php echo $value['Name'];?> required>
       
        <label for="phno">Phone</label>
        <input type="text" id="phno" name="PHONE" value=<?php echo $value['Phone'];?> required>

        <label for="role">Role</label>
        <select name="ROLE" id="role" required onchange="setdiv()">
            <option value="Doctor" <?php echo ($value['Role']=='Doctor')?'selected':''?>>Doctor</option>
            <option value="Pharmacist" <?php echo ($value['Role']=='Pharmacist')?'selected':''?>>Pharmacist</option>
        </select>
        

        <div id="dep" style="display:none">
         <label for="department" >Department</label>
         <input type="text" id="department" name="DEPARTMENT" value=<?php echo $value['Department'];?> >
        </div>
       
        
        <?php if($value['Role']=='Doctor'){?>
         <div id="dept">
         <label for="department" >Department</label>
         <input type="text" id="department"  value=<?php echo $value['Department'];?> >
         </div>
        <?php } ?>
        <?php if($value['Role']=='Pharmacist'){?>
         <div></div>
        <?php } ?>
        
        
        <label for="username">Username</label>
        <input type="email" placeholder="Email" id="username" value=<?php echo $value['Username'];?> name="EMAIL"  required>

        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password" value=<?php echo $value['Password'];?>  name="PASSWORD" required>

        <button type="submit" name="submit">Submit</button>
    </form>
</body>
<script>
    function setdiv(){
        var x=document.getElementById("role").value;
        var d=document.getElementById("dep");
        if(x=="Doctor"){
            d.style.display="block";
        }
        if(x=="Pharmacist"){
            d.style.display="none";
            var e=document.getElementById("dept");
            e.style.display="none";
        }
    }
</script>
</html>
