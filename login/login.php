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
$flag =0;
session_start();
if(isset($_POST['login']))
{
    //if one field is empty
    if(empty($_POST['email']) || empty($_POST['password'])) 
    {
        header("location:login.php");
    }
    //if email and password filed
    else
    {
        if($_POST['type'] == 1)//client login
        {
          $sql="select * from `client` where Email='".$_POST['email']."' and Password='".$_POST['password']."'";
          $stmt= $connection->prepare($sql);
          $stmt->execute();
          $row=$stmt->fetch(PDO::FETCH_ASSOC);
          //print_r($row);
          //echo sizeof($row);
          if(empty($row))
          {
          	//echo "Please Check Your Email and Password Again";
            $flag =1;
            //header("location:login.php");
            
          }
          else
          {
            	//echo "You are sussfly loged in";
            $_SESSION['clientEmail']       = $_POST['email'];
            $_SESSION['clientPassword']    = $_POST['password'];
            $_SESSION['clientId']          = $row['id']; //use id to render all data of this id from database
            header("location: ../search/search.php");
          }
        }

        else if($_POST['type'] == 0)//technician  login
        {
          $sql1="select * from `technician` where Email='".$_POST['email']."' and Password='".$_POST['password']."'";
          $stmt1= $connection->prepare($sql1);
          $stmt1->execute();
          $row1=$stmt1->fetch(PDO::FETCH_ASSOC);
          //print_r($row1);
          if(empty($row1))
          {
            
            $flag =1;
          }
          	else
			{
			$_SESSION['techEmail']       = $_POST['email'];
            $_SESSION['techPassword']    = $_POST['password'];
            $_SESSION['techId']          = $row1['id']; //use id to render all data of this id from database
            header("location: ../TechProfile/TechProfile.php");
			}
        }
        else
			        {
			            
			            //header("location:login.php");
			            $flag =1;
			        }

        

    }

}


?>


<html>
<head>
    <title>login page </title>
     <link rel="stylesheet" href="style1.css">
    <link rel="icon" href='hq%20logo2.png'>
</head>
<style>
   
    </style>
    <body>

    <img src="logo.png" id="photo">  
    <div class="login-box">
        <img src="user.png" class="avatar">
        <h1>Welcome</h1>
        <h6> <?php if($flag ==1) echo "Please Check Your Email and Password Again";  ?></h6>

        <form action="login.php" method="POST">
            <p>Email:</p>
            <input type="text" name="email" placeholder="Enter your Email">

            <p>Password</p>
            <input type="password" name="password" placeholder="Enter Password">

            <input  type="radio" name="type" value="1">Client &nbsp; &nbsp;&nbsp;
            <input type="radio" name="type" value="0">Technician

            <input type="submit" name="login" value="Login">
        </form> 
    </div>
        
    </body>
</html>
