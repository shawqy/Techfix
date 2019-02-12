<?php 
session_start();
$clientID = $_SESSION['clientId']; //use this id to render data from database
//Render data code here
$dsn='mysql:host=localhost;dbname=techfix';
           try{
         $connection=new PDO($dsn,'root','');
              }
              catch(PDOException $e){
               echo $e->getMessage();
                                    }
//edit client profile here
 $sql="SELECT * FROM client WHERE id=$clientID";
 $stmt= $connection->prepare($sql);
 $stmt->execute();
 
 $row=$stmt->fetch(PDO::FETCH_ASSOC);
  
      if(isset($_POST['save']))
      {
          $name=$_POST['name'];
          $address=$_POST['address'];
          $number=$_POST['phone'];
          $email=$_POST['email'];

          $sql="UPDATE `client` SET Name='$name' ,Phone='$number',Email='$email',Address ='$address' WHERE id=$clientID"; 
          $stmt= $connection->prepare($sql);
          $stmt->execute();
     header("location:ClientProfile.php");
   



      }   

if(isset($_POST['change']))
 {
  $filename=addslashes($_FILES["img"]["name"]);
$tmpname=addslashes(file_get_contents($_FILES["img"]["tmp_name"]));
$filetype=addslashes($_FILES["img"]["type"]);
   $sql="UPDATE `client` SET Photo='$tmpname'  WHERE id=$clientID"; 
          $stmt= $connection->prepare($sql);
          $stmt->execute();
     header("location:ClientProfile.php");
 }
//logout
if($clientID)
{

    if(isset($_POST['logout']))
    {
        unset($_SESSION['clientEmail']);
        unset($_SESSION['clientPassword']);
        unset($_SESSION['clientId']);
        session_destroy(); 
        header("location: ../login/login.php"); 
    }
}
else
{
    header("location:../home/index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Client Profile</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/resume.min.css" rel="stylesheet">
      
    <link rel="shortcut icon" href='img/hq%20logo2.png'>
    <link rel="icon" href='img/hq%20logo2.png'>
      
      <script type="text/javascript">
            function edit1(){
                if(document.getElementById("nameword").style.display=="none")
                    {
                        document.getElementById("editbtn").style.display='inline-block';
                        document.getElementById("edit2btn").style.display='none';
                        document.getElementById("age").style.display='block';
                        
                        document.getElementById("nameword").innerHTML= document.getElementById("nameedit").value;
                        document.getElementById("nameedit").style.display='none';
                        document.getElementById("namesub").style.display='none';
                        document.getElementById("nameword").style.display='block';
                        
                        document.getElementById("addressword").innerHTML= document.getElementById("addressedit").value;
                        document.getElementById("addressedit").style.display='none';
                        document.getElementById("addresssub").style.display='none';
                        document.getElementById("addressword").style.display='block';
                        
                        document.getElementById("numberword").innerHTML= document.getElementById("numberedit").value;
                        document.getElementById("numberedit").style.display='none';
                        document.getElementById("numbersub").style.display='none';
                        document.getElementById("numberword").style.display='block';
                        
                        document.getElementById("mailword").innerHTML= document.getElementById("mailedit").value;
                        document.getElementById("mailedit").style.display='none';
                        document.getElementById("mailsub").style.display='none';
                        document.getElementById("mailword").style.display='block';

                        document.getElementById("password").innerHTML= document.getElementById("passedit").value;
                        document.getElementById("passedit").style.display='none';
                        document.getElementById("passsub").style.display='none';
                        document.getElementById("password").style.display='none';

                      
                        
                    }
                else{
                        document.getElementById("editbtn").style.display='none';
                        document.getElementById("edit2btn").style.display='inline-block';
                        document.getElementById("age").style.display='none';
                    
                        document.getElementById("nameedit").value= document.getElementById("nameword").innerHTML;
                        document.getElementById("nameword").style.display='none';
                        document.getElementById("namesub").style.display='block';                        
                        document.getElementById("nameedit").style.display='block';
                    
                        document.getElementById("addressedit").value= document.getElementById("addressword").innerHTML;
                        document.getElementById("addressword").style.display='none';
                        document.getElementById("addresssub").style.display='block';                        
                        document.getElementById("addressedit").style.display='block';
                    
                        document.getElementById("numberedit").value= document.getElementById("numberword").innerHTML;
                        document.getElementById("numberword").style.display='none';
                        document.getElementById("numbersub").style.display='block';                        
                        document.getElementById("numberedit").style.display='block';
                    
                        document.getElementById("mailedit").value= document.getElementById("mailword").innerHTML;
                        document.getElementById("mailword").style.display='none';
                        document.getElementById("mailsub").style.display='block';                        
                        document.getElementById("mailedit").style.display='block';

                        document.getElementById("passedit").value= document.getElementById("password").innerHTML;
                        document.getElementById("password").style.display='none';
                        document.getElementById("passsub").style.display='block';                        
                        document.getElementById("passedit").style.display='block';
                    
                        
                }
            }
          
      </script>
  </head>
    
  <body id="page-top">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">
        <span class="d-none d-lg-block">
<!-- ================================ Profie Pic of Client to be retrived from database ================================================= -->
          <?php echo'<img src="data:image/jpeg;base64,'.base64_encode($row['Photo']).'"class="img-fluid img-profile rounded-circle mx-auto mb-2">';  ?>

        </span>
      </a>
      <form action="ClientProfile.php" method="post"  enctype="multipart/form-data">
        <input id="file" type="file" name="img" style="margin-left: 100px; margin-bottom: 10px; ">
        <input type="submit" name="change" style="float: right; margin-right:120px;margin-top: 20px; background-color: rgba(197, 197, 197, 0.62);font-family:'metropolis-semibold',sans-serif;text-transform: uppercase;font-size: 0.8rem;padding: 10px 25px;border:0rem solid #c5c5c5;border-radius: 3px;color: #123e64;font-weight:bold;" value="Change Photo">
</form>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <!--<li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#about">About</a>
            </li>-->
          <li class="nav-item">
              <div class="col-md-1" style="float: right;">
<!-- ============================================= Button to go back to Search Page ================================================ -->
                    <button type="submit" onclick="e"  class="btn btn" style="float: right; margin-right:-10px;margin-top: 20px; background-color: rgba(197, 197, 197, 0.62);font-family:'metropolis-semibold',sans-serif;text-transform: uppercase;font-size: 0.8rem;padding: 10px 25px;border:0rem solid #c5c5c5;border-radius: 3px;color: #123e64;font-weight:bold;">Search For a Technician</button>      
            </div>
          </li>
          <li class="nav-item">
            <form action="ClientProfile.php" method="POST">
            <div class="col-md-1" style="float: right;">
<!-- ============================================= Button to Sign Out and go back to Homepage ================================================ -->
                    <button type="submit" onclick="e"  class="btn btn " style="float:inherit; margin-right: 40px;margin-top: 160px; background-color: rgba(197, 197, 197, 0.62);font-family:'metropolis-semibold',sans-serif;text-transform: uppercase;font-size: 0.8rem;padding: 10px 25px;border:0rem solid #c5c5c5;border-radius: 3px;letter-spacing: 0.15rem;color: #123e64;font-weight:bold;" name="logout">Sign Out</button>
            </div>
          </form>
            </li>
        </ul>
      </div>
    </nav>

   <div class="container-fluid p-0 home"  style="background-image: url(img/pattern1.jpg); background-repeat: no-repeat; background-size:cover;height: inherit;">
      <section class="resume-section p-3 p-lg-5 d-flex d-column" id="about" >
        <div class="my-auto">


<div class="col-md-1" style="float: right;">
                <button type="submit" onclick="edit1();" id="editbtn" class="btn btn" style="float: right; margin-left: 700px;background-color: cornflowerblue;color: white">Edit Info</button>
            </div><!-- ===========================
 ================== Name Retrived from DataBase ================================================ -->
<form action="ClientProfile.php"  method="POST" >
            <h1 class="mb-0" id="nameword" style="color: white;"><?php echo$row['Name']?></h1>
            <h4 style="display: none; color: white;" id="namesub" >Name : </h4>
<!-- ============================================= Name change to be sent to the database ================================================ -->
              
            <input type="text" class="form-control" id= "nameedit" placeholder="Enter title" name="name" style="display: none;max-width: 500px;margin-bottom: 10px">
<!-- ============================================= Button to submit changes and send them to database  ====================================== -->
            
            <div class="col-md-1" style="float: right;">
                <button type="submit" name="save" onclick="edit1();" id="edit2btn" class="btn btn" style="float: right; margin-left: 700px;background-color: cornflowerblue;color: white; display: none;">Save Info</button>
            </div>
          <div class="subheading mb-5">
<!-- ============================================= Address retrived from the database =============================================== -->
              <h4 style="display: block; color: white;" id="addressword" ><?php echo$row['Address']?></h4>
              <h4 style="display: none;color: white;" id="addresssub">Address : </h4>
<!-- ============================================= Address change to be sent to the database =============================================== -->
              <input type="text" class="form-control" id= "addressedit" style="display: none;max-width: 500px;margin-bottom: 10px;font-family:'metropolis-semibold',sans-serif; "  name="address">
<!-- ============================================= Number Retrived from the database =============================================== -->
              <h4 style="display: block; color: white;" id="numberword" ><?php echo$row['Phone']?></h4>
              <h4 style="display: none;color: white;" id="numbersub">Number : </h4>
<!-- ============================================= Number change to be sent to the database =============================================== -->
              <input type="text" class="form-control" id= "numberedit" style="display: none;max-width: 500px;margin-bottom: 10px;font-family:'metropolis-semibold',sans-serif; " name="phone">
<!-- ============================================= Email Retrived from the database =============================================== -->
              <h4 style="display: block; color: white;" id="mailword" style="color: white;"><?php echo$row['Email']?></h4>
              <h4 style="display: none;color: white;" id="mailsub">Email : </h4>
<!-- ============================================= Email change to be sent to the database =============================================== -->
              <input type="text" class="form-control"  id= "mailedit" style="display: none; max-width: 500px;margin-bottom: 10px;font-family:'metropolis-semibold',sans-serif;" name="email"> <br> <br>

<!-- ============================================= Password Retrived from the database =============================================== -->
              <h4 style="display: none; color: white;" id="password" style="color: white;"><?php echo$row['Password']?></h4>
              <h4 style="display: none;color: white;" id="passsub">Password : </h4>
<!-- ============================================= Password change to be sent to the database =============================================== -->
              <input type="text" class="form-control"  id= "passedit" style="display: none; max-width: 500px;margin-bottom: 10px;font-family:'metropolis-semibold',sans-serif;" name="password">


<!-- ===================================================== Age retrived from the database  =================================================== -->
             <h4 style="color: white;" id="age"> </h4>

             
          </div>
        </form>
        </div>
       </section>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/resume.min.js"></script>

  </body>

</html>
