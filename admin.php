<?php
$con=mysqli_connect("localhost","root","","clinicalportal");
$sql = "select * from user where Role='Doctor' or Role='Pharmacist'";
$result=mysqli_query($con,$sql); 
$user;
if(isset($_POST['submit']))
{
    $name=$_POST["NAME"];
    $role=$_POST["ROLE"];
    $phone=$_POST["PHONE"];
    $email=$_POST['EMAIL'];
    $password=$_POST['PASSWORD'];
    $department=$_POST['DEPARTMENT'];
    $sql1="insert into user(Name,Role,Phone,Username,Password,Department) values('$name','$role','$phone','$email','$password','$department')";
    mysqli_query($con,$sql1);
    echo mysqli_error($con);
    header("Location:/clinicalportal/admin.php");
    exit();
}
if(isset($_POST['search']))
{
    $sql2="select * from user where Role='Doctor' and Name='".$_POST['DNAME']."' and Department='".$_POST['DEPARTMENT']."'";
    $result1=mysqli_query($con,$sql2);
    $user=mysqli_fetch_array($result1);
    header("location:/clinicalportal/appointment.php?id=".$user['id']);
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Design by foolishdeveloper.com -->
    <title>Admin</title>
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <!--Stylesheet-->
    <style media="screen">
body{
    background-color:#6693F5;
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
#edit{
    display:none;
}
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}
li button{
  width:150px;
  color: #000080;
  padding: 8px 16px;
  text-decoration: none;
  background-color:white;
  border:none;
}
li button:hover {
  background-color:rgba(195,99,71,0.3);
  color: white;
}
    </style>
</head>
<body>
  <nav >
    <ul>
        <li><button onclick="fcreatecall()" >CREATE</button></li>
        <li><button  onclick="feditcall()">EDIT/DELETE</button></li>
        <li><button onclick="fappointments()">APPOINTMENTS</button></li>
    </ul>  
  </nav>
    <div id="create" style="disply:none">
    <form method="post" action="<?php $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
        <h3>Create Form</h3>

        <label for="name">Name</label>
        <input type="text" placeholder="Name" id="name" name="NAME" pattern="[a-zA-Z ]{1,32}" required>
       
        <label for="role">Role</label>
        <select name="ROLE" id="role" required onchange="setdiv()">
            <option value="">Select a Option</option>
            <option value="Doctor">Doctor</option>
            <option value="Pharmacist">Pharmacist</option>
        </select>
        
        <div id="dep" style="display:none">
         <label for="department" >Department</label>
         <input type="text" id="department" name="DEPARTMENT" pattern="[a-zA-Z ]{1,32}" required>
        </div>

        <label for="phno">Phone</label>
        <input type="text" id="phno" name="PHONE" pattern="[0-9]{10}" maxlength="10"  required>

        <label for="username">Username</label>
        <input type="email" placeholder="Email" id="username"  name="EMAIL" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>

        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password"  name="PASSWORD" minlength="6"  required>

        <button name="submit" class="Submit">Submit</button>
    </form>
    </div>
    <div id="edit" style="disply:none">
    <br><br>
    <table style="width:50%">
            <tr>
                <th>NAME</th>
                <th>ROLE</th>
                <th>DEPARTMENT</th>
                <th>PHONE</th>
                <th>USERNAME</th>
                <th>EDIT</th>
                <th>DELETE</th>
            </tr>
            <?php while($value=mysqli_fetch_array($result)){?>
                <tr>
                    <td><?php echo $value["Name"];?></td>
                    <td><?php echo $value["Role"];?></td>
                    <td><?php echo $value["Department"];?></td>
                    <td><?php echo $value["Phone"];?></td>
                    <td><?php echo $value["Username"];?></td>
                    <td><a href="/clinicalportal/edit.php?id=<?php echo $value["id"]?>">EDIT</a></td>
                    <td><a href="/clinicalportal/delete.php?id=<?php echo $value["id"]?>">DELETE</a></td>
                </tr>
            <?php }?>
        </table>
    </div>
    <div id="appointment" style="display:none">
        <form method="post" action="<?php $_SERVER['PHP_SELF']?>" enctype="multipart/form-data" >
            Name Of Doctor:<input type="text" id="dname" name="DNAME"><br>
            Department:<input type="text" id="dep" name="DEPARTMENT"><br>
            <button name="search" >Submit</button>
        </form>
    </div>
</body>
<script>
    function fcreatecall()
    {
        var c=document.getElementById("create");
        var e=document.getElementById("edit");
        var a=document.getElementById("appointment");
        c.style.display = "block";
        e.style.display = "none";      
        a.style.display="none";
    }
    function feditcall()
    {
        var c=document.getElementById("create");
        var e=document.getElementById("edit");
        var a=document.getElementById("appointment");
        e.style.display = "block";
        c.style.display = "none"; 
        a.style.display="none";  
    }
    function setdiv(){
        var x=document.getElementById("role").value;
        var d=document.getElementById("dep");
        if(x=="Doctor"){
            d.style.display="block";
        }
    }
    function fappointments(){
        var c=document.getElementById("create");
        var e=document.getElementById("edit");
        var a=document.getElementById("appointment");
        e.style.display = "none";
        c.style.display = "none"; 
        a.style.display="block";
    }
</script>
</html>