<?php
 $dsn='mysql:host=localhost;dbname=techfix';
           try{

         $connection=new PDO($dsn,'root','');
           }catch(PDOException $e){
               echo $e->getMessage();
           }
 
if (  isset($_POST['req']) )
{
$email = $_POST['email'];
$password = $_POST['password'];
$name = $_POST['name'];
$mobile = $_POST['mobile'];
$address = $_POST['address'];
$startHour=$_POST['starthour'];
$endhour=$_POST['endhour'];
$gender=$_POST['gender'];
$age=$_POST['age'];
$cat=$_POST['Categroy'];

$filename=addslashes($_FILES["img"]["name"]);
$tmpname=addslashes(file_get_contents($_FILES["img"]["tmp_name"]));
$filetype=addslashes($_FILES["img"]["type"]);
$array=array('jpg','jpeg','PNG');
$ext=pathinfo($filename,PATHINFO_EXTENSION);


$query = "INSERT INTO `request technician` (Email,Password,Name,Phone,WorkshopAddress,startHour,endHour,Gender,age,Categroy,Photo) ";
$query .= "VALUES ('$email','$password','$name','$mobile','$address','$startHour','$endhour','$gender','$age','$cat','$tmpname')";
$stml=$connection->prepare($query);
$stml->execute();
    
}

?>

<!doctype html>
<html>
 <head>
  <meta charset="utf-8">   
  <title>Sign Up/Recommend Technicians</title>   
  <link rel="stylesheet" href="style2.css">
  <link rel="icon" href='hq%20logo2.png'>
 </head>
 <body>
     <img src="logo.png" id="photo"> 
     <img src="515.png" id="Tech">
     <div class="registration">
     <form method="post" id="register" action="Technician.php" enctype="multipart/form-data">
         <label style="text-align: center; font-size: 30px;">Join Our Technicians</label>
         <br><br>
          <label>Name :</label><br>
          <input type="text" name="name" class="name" placeholder="Enter your Name"><br><br>

          <label>E-mail :</label><br>
          <input type="email" name="email" class="name" placeholder="Enter your E-mail "><br><br>

          <label>Password :</label><br>
          <input type="password" name="password" class="name" placeholder="Enter your Password "><br><br>

          <label>Mobile Number :</label><br>
          <input type="text" name="mobile" class="name" placeholder="Enter your Mobile Number"><br><br>

          <label>Workshop Address :</label><br>
          <input type="text" name="address" class="name" placeholder="Enter your Workshop Address "><br><br>

          <label>Start Working Hour :</label><br>
          <input type="text" name="starthour" class="name" placeholder="Enter your Start Working Hour"><br><br>

          <label>End Working Hour :</label><br>
          <input type="text" name="endhour" class="name" placeholder="Enter your End Working Hour "><br><br>


          <label>Age :</label><br>
          <input type="text" name="age" class="name" placeholder="Enter your Age"><br><br>

          <label>Categroy :</label><br><br>

          <select name="Categroy"id="sub1"  >
              <option value="Carpenter">Carpenter</option>
              <option value="Plumber">Plumber</option>
              <option value="Electrician">Electrician</option>       
          </select><br><br>

         <label>Gender :</label><br><br>
         <input type="radio" name="gender" value="male" id="male">&nbsp; Male &nbsp;&nbsp;&nbsp;
         <input type="radio" name="gender" value="female" id="male">&nbsp; Female
         <br><br><br>

         


         <label>Photo :</label><br>
         <input type="file" name="img"> <br> <br>

         <input type="submit" value="Submit" name="req" id="sub">
         <br>
      </form>      
  </div>       
 </body>
</html>