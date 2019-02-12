<?php
 $dsn='mysql:host=localhost;dbname=techfix';
   try
   {
     $connection=new PDO($dsn,'root','');

   }
   catch(PDOException $e)
   {
    echo $e->getMessage();
   }
 
if (  isset($_POST['submit']) )
{

$email = $_POST['email'];
$password = $_POST['password'];
$name = $_POST['name'];
$mobile = $_POST['mobile'];
$address = $_POST['address'];
$gender=$_POST['radio'];
$filename=addslashes($_FILES["img"]["name"]);
$tmpname=addslashes(file_get_contents($_FILES["img"]["tmp_name"]));
$filetype=addslashes($_FILES["img"]["type"]);
$array=array('jpg','jpeg','PNG');
$ext=pathinfo($filename,PATHINFO_EXTENSION);

//1 for male
//0 for female

$query = "INSERT INTO `client` (Email,Password,Name,Phone,Address,Gender,Photo) ";
$query .= "VALUES ('$email','$password','$name','$mobile','$address','$gender','$tmpname')";
$stml=$connection->prepare($query);
$stml->execute();
    
}


?>

<!doctype html>
<html>
 <head>
  <meta charset="utf-8">   
  <title>Sign Up Client</title>   
  <link rel="stylesheet" href="style3.css">
  <link rel="icon" href='hq%20logo2.png'>
 </head>
 <body>
     <img src="logo.png" id="photo"> 
     <img src="satisfiedperson.png" id="Tech">
     <div class="registration">
     <form method="post" id="register" action="SignUpClient.php" enctype="multipart/form-data">
         <label style="text-align: center; font-size: 30px;">Join Our Clients</label>
         <br><br>
          <label>Name :</label><br>
<!-- ======================= Name that will be sent to database ==================================== -->
          <input type="text" name="name" class="name" placeholder="Enter your Name"><br><br>
          <label>E-mail :</label><br>
 <!-- ======================= Email that will be sent to database ==================================== -->       
          <input type="email" name="email" class="name" placeholder="Enter your E-mail "><br><br>
          <label>Password :</label><br>
<!-- ======================= Password that will be sent to database ==================================== -->
          <input type="password" name="password" class="name" placeholder="Enter your Password "><br><br>
          <label>Mobile Number :</label><br>
<!-- ======================= Mobile Number that will be sent to database ==================================== -->
          <input type="text" name="mobile" class="name" placeholder="Enter your Mobile Number"><br><br>
          <label>Address :</label><br>
<!-- ======================= Address that will be sent to database ==================================== -->
          <input type="text" name="address" class="name" placeholder="Enter your Address "><br><br>
         <label>Gender :</label><br>
         <input type="radio" name="radio" value="male" id="male">&nbsp; Male &nbsp;&nbsp;&nbsp;
         <input type="radio" name="radio" value="female" id="male">&nbsp; Female
         <br><br>
         <!-- -->
         <label>Photo :</label><br>
         <input type="file" name="img"> <br> <br>
<!-- ======================= Gender that will be sent to database ==================================== -->
         
         <br><br>
<!-- ======================= Button submit data to database ==================================== -->
         <input type="submit" name="submit" value="signup" id="sub">
         <br>
      </form>      
  </div>       
 </body>
</html>