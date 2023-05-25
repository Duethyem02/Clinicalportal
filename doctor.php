<?php
$con=mysqli_connect("localhost","root","","clinicalportal");
$id=$_GET['id'];
$sql = "select * from appoinment where Did=$id";
$result=mysqli_query($con,$sql);
$value=mysqli_fetch_all($result);
$data2;
$displaymedicine = "";
if(isset($_POST['Back']))
{
  header("Location:/clinicalportal/doctor.php?id=".$id);
  exit();
}
if(isset($_POST['submit'])){
  $sql1 = "select * from appoinment where Did=$id and PName='".$_POST['PNAME']."' and Pid=".$_POST['PID']."";
  $r=mysqli_query($con,$sql1);
  $data=mysqli_fetch_array($r);
  foreach($_POST['checkbox'] as $mid){
    $sql2="insert into patientmedicine(Pid,Did,Mid) values('".$data['Pid']."','$id','$mid')";
    mysqli_query($con,$sql2);
  }
  header("Location:/clinicalportal/doctor.php?id=".$id);
  exit();
}
if(isset($_POST['display'])){
  $sql1 = "select * from appoinment where Did=$id and PName='".$_POST['PNAME']."' and Pid=".$_POST['PID']."";
  $r=mysqli_query($con,$sql1);
  $displaydata=mysqli_fetch_array($r);
  $sql2="select * from patientmedicine where Did=$id and Pid=".$displaydata['Pid']."";
  $r2=mysqli_query($con,$sql2);
  $data2=mysqli_fetch_all($r2);
  $displaymedicine = "true";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Design by foolishdeveloper.com -->
    <title>Doctor</title>
 
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
 #horizontal{
  display:inline;
 }
</style>
</head>
<body>
  <nav>
  <ul>
        <li><button onclick="fappointments()">APPOINTMENTS</button></li>
        <li><button onclick="fmedicine()" >MEDICINE</button></li>
  </ul> 
  </nav>
  <div id="appointment" >
    <table style="width:75%">
      <tr>
        <th>Name of Patient</th>
        <th>Patient ID</th>
        <th>Date</th>
        <th>Status</th>
        <th>EDIT</th>
        <th>ACTION</th>
      </tr>
      <?php
      if(isset($displaydata) && !empty($displaydata)) {
      ?>
      <tr> 
        <td><?php echo $displaydata[1];?></td>
        <td><?php echo $displaydata[2];?></td>
        <td><?php echo $displaydata[6];?></td>
        <td><?php echo $displaydata[7];?></td>
        <?php
        if($displaydata[7] != "Pending") {
        ?>
        <td>---</td>
        <?php
        } else {
        ?>
        <td><a href="/clinicalportal/pedit.php?id=<?php echo $displaydata[0]?>">EDIT</a></td>
        <?php
        }
        ?>
        <td><a href="/clinicalportal/verify.php?id=<?php echo $displaydata[0]?>">APPROVE</a></td>
      </tr>
      <?php
      } else {
        foreach($value as $data){?>
          <tr> 
            <td><?php echo $data[1];?></td>
            <td><?php echo $data[2];?></td>
            <td><?php echo $data[6];?></td>
            <td><?php echo $data[7];?></td>
            <?php
            if($data[7] != "Pending") {
            ?>
            <td>---</td>
            <?php
            } else {
            ?>
            <td><a href="/clinicalportal/pedit.php?id=<?php echo $data[0]?>">EDIT</a></td>
            <?php
            }
            ?>
            <td><a href="/clinicalportal/verify.php?id=<?php echo $data[0]?>">APPROVE</a></td>
          </tr>
        <?php 
        } 
        }
        ?>
      </table>
    <?php
    if(isset($displaymedicine) && !empty($displaymedicine)){
    ?>
    <div>
      <label for="medicine" name="MEDICINE">Medicine</label><br>
      <!-- <?php foreach($data2 as $d){?> 
        
      <input type="checkbox" name="checkbox[]" value="1" <?php echo($d[3]=='1')?'checked':''?>>Paracetamol
      <input type="checkbox" name="checkbox[]" value="2" <?php echo($d[3]=='2')?'checked':''?>>Atorvastatin
      <input type="checkbox" name="checkbox[]" value="3" <?php echo($d[3]=='3')?'checked':''?> >Losartan
      <input type="checkbox" name="checkbox[]" value="4" <?php echo($d[3]=='4')?'checked':''?>>Metoprolol
      <input type="checkbox" name="checkbox[]" value="5" <?php echo($d[3]=='5')?'checked':''?>>Omeprazole<br><br>

      <?php } ?> -->
      <?php
      if(isset($data2[0]) && !empty($data2[0])) {
        if($data2[0][3] == '1') {
      ?>
        <input type="checkbox" name="checkbox[]" value="1" checked>Paracetamol
        <?php
        } elseif ($data2[0][3] == '2') {
        ?>
        <input type="checkbox" name="checkbox[]" value="2" checked>Atorvastatin
        <?php
        } elseif ($data2[0][3] == '3') {
        ?>
        <input type="checkbox" name="checkbox[]" value="3" checked>Losartan
        <?php
        } elseif ($data2[0][3] == '4') {
        ?>
        <input type="checkbox" name="checkbox[]" value="4" checked>Metoprolol
        <?php
        } elseif ($data2[0][3] == '5') {
        ?>
        <input type="checkbox" name="checkbox[]" value="5" checked>Omeprazole
        <?php
        }
      } 
      if(isset($data2[1]) && !empty($data2[1])) {
        if($data2[1][3] == '1') {
      ?>
        <input type="checkbox" name="checkbox[]" value="1" checked>Paracetamol
        <?php
        } elseif ($data2[1][3] == '2') {
        ?>
        <input type="checkbox" name="checkbox[]" value="2" checked>Atorvastatin
        <?php
        } elseif ($data2[1][3] == '3') {
        ?>
        <input type="checkbox" name="checkbox[]" value="3" checked>Losartan
        <?php
        } elseif ($data2[1][3] == '4') {
        ?>
        <input type="checkbox" name="checkbox[]" value="4" checked>Metoprolol
        <?php
        } elseif ($data2[1][3] == '5') {
        ?>
        <input type="checkbox" name="checkbox[]" value="5" checked>Omeprazole
        <?php
        }
      }
      ?>
      <button name="edit" >Edit</button>
    </div>
    <?php
    }
    ?>
  </div>
  <div id="medicine" style="display:none">
    <nav>
      <ul>
        <li class="horizontal"><button onclick="fprescribe()">PRESCRIBE</button></li>
        <li class="horizontal"><button onclick="fedit()" >EDIT</button></li>
      </ul> 
    </nav>
    <div id="prescribe">
      <form method="post" action="<?php $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
        <h3>Prescribe Medicine</h3><br>

        <label for="name">Name Of Patient</label>
        <input type="text" placeholder="Name" id="name" name="PNAME" required><br><br>

        <label for="pid">Patient ID</label>
        <input type="text" placeholder="ID" id="pid" name="PID" required><br><br>
       
        <label for="medicine" name="MEDICINE">Medicine</label><br>
        <input type="checkbox" name="checkbox[]" value="1">Paracetamol
        <input type="checkbox" name="checkbox[]" value="2">Atorvastatin
        <input type="checkbox" name="checkbox[]" value="3" >Losartan
        <input type="checkbox" name="checkbox[]" value="4">Metoprolol
        <input type="checkbox" name="checkbox[]" value="5">Omeprazole<br><br>

        <button name="submit">Prescribe Medicine</button>
      </form>
    </div>
    <div id="edit" style="display:none">
      <form method="post" action="<?php $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
        <h3>Edit Medicine</h3><br>

        <label for="name">Name Of Patient</label>
        <input type="text" placeholder="Name" id="name" name="PNAME" required>

        <label for="pid">   Patient ID</label>
        <input type="text" placeholder="ID" id="pid" name="PID" required>

        <button type="submit" onclick="fedit()" name="display" >Submit</button><br> 
      </form>
    </div>
  </div>
</body>
<script>
  function fappointments()
    {
        var m=document.getElementById("medicine");
        var a=document.getElementById("appointment");
        a.style.display = "block";
        m.style.display = "none";      
    }
    function fmedicine()
    {
        var m=document.getElementById("medicine");
        var a=document.getElementById("appointment");
        m.style.display = "block";
        a.style.display="none";  
    }
    function fprescribe()
    {
        var p=document.getElementById("prescribe");
        var e=document.getElementById("edit");
        p.style.display = "block";
        e.style.display = "none";      
    }
    function fedit()
    {
        var p=document.getElementById("prescribe");
        var e=document.getElementById("edit");
        e.style.display = "block";
        p.style.display = "none";   
    }
</script>
</html>