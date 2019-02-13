<?php 
session_start();
//echo "Your ID is";
$tecID = $_SESSION['techId']; //use this id to render data from 
//echo $tecID;
//render data
$dsn='mysql:host=localhost;dbname=techfix';
           try{

         $connection=new PDO($dsn,'root','');
           }catch(PDOException $e){
               echo $e->getMessage();
           }

$sql="SELECT * FROM technician WHERE id=$tecID";
 $stmt= $connection->prepare($sql);
 $stmt->execute();
 
 $row=$stmt->fetch(PDO::FETCH_ASSOC);
 if (isset($_POST['Save'])) {

$name=$_POST['name'];
$category=$_POST['category'];
$address=$_POST['address'];
$number=$_POST['phone'];
$email=$_POST['email'];
$password=$_POST['password'];
  $sql="UPDATE technician SET Name='$name',Password ='$password' ,Phone='$number',workshopAddress='$address',Email='$email' WHERE id=$tecID"; 
          $stmt= $connection->prepare($sql);
          $stmt->execute();
     header("location:TechProfile.php");
   
    
 							}//end of save edit condition


$sql="SELECT * FROM `feedbacks` WHERE Technician_ID = '$tecID'";
$stmt= $connection->prepare($sql);
$stmt->execute();
$returnData=$stmt->fetchall(PDO::FETCH_ASSOC);
$returnResult = sizeof($returnData);
//echo "no. of Comments" . $returnResult ;


if($tecID) 
{
	if (isset($_POST['logout']))
	{
	    unset($_SESSION['techEmail']);
	    unset($_SESSION['techPassword']);
	    unset($_SESSION['techId']);
	    session_destroy();
	    header("location: ../login/login.php"); 
	}
}
else 
{
	header("location:../login/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Technician Profile</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/resume.css" rel="stylesheet">
    <link href="css/resume.min.css" rel="stylesheet">
      
    <link rel="shortcut icon" href='img/hq%20logo2.png'>
    <link rel="icon" href='img/hq%20logo2.png'>
      
      <script type="text/javascript">
            function edit1(){
                if(document.getElementById("nameword").style.display=="none")
                    {
                        document.getElementById("editbtn").style.display='inline-block';
                        document.getElementById("edit2btn").style.display='none';
                        document.getElementById("rating").style.display='block';
                        
                        document.getElementById("catword").innerHTML= document.getElementById("catedit").value;
                        document.getElementById("catedit").style.display='none';
                        document.getElementById("catsub").style.display='none';
                        document.getElementById("catword").style.display='block';
                        
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
                        
                        document.getElementById("desword").innerHTML= document.getElementById("desedit").value;
                        document.getElementById("desedit").style.display='none';
                        document.getElementById("dessub").style.display='none';
                        document.getElementById("desword").style.display='block';
                        
                        document.getElementById("hrsword").innerHTML= document.getElementById("hrsedit").value;
                        document.getElementById("hrsedit").style.display='none';
                        document.getElementById("hrssub").style.display='none';
                        document.getElementById("hrsword").style.display='block';
                        
                        document.getElementById("daysword").innerHTML= document.getElementById("daysedit").value;
                        document.getElementById("daysedit").style.display='none';
                        document.getElementById("dayssub").style.display='none';
                        document.getElementById("daysword").style.display='block';
                        
                    }
                else{
                        document.getElementById("editbtn").style.display='none';
                        document.getElementById("edit2btn").style.display='inline-block';
                        document.getElementById("rating").style.display='none';
                    
                        document.getElementById("catedit").value= document.getElementById("catword").innerHTML;
                        document.getElementById("catword").style.display='none';
                        document.getElementById("catsub").style.display='block';                        
                        document.getElementById("catedit").style.display='block';
                    
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
                    
                        document.getElementById("desedit").value= document.getElementById("desword").innerHTML;
                        document.getElementById("desword").style.display='none';
                        document.getElementById("dessub").style.display='block';                        
                        document.getElementById("desedit").style.display='block';
                    
                        document.getElementById("hrsedit").value= document.getElementById("hrsword").innerHTML;
                        document.getElementById("hrsword").style.display='none';
                        document.getElementById("hrssub").style.display='block';                        
                        document.getElementById("hrsedit").style.display='block';
                    
                        document.getElementById("daysedit").value= document.getElementById("daysword").innerHTML;
                        document.getElementById("daysword").style.display='none';
                        document.getElementById("dayssub").style.display='block';                        
                        document.getElementById("daysedit").style.display='block';
                }
            }
 /*         function edit2(){
                if(document.getElementById("job1word").style.display=="none")
                    {
                        document.getElementById("editbtn1").style.display='inline-block';
                        document.getElementById("edit2btn1").style.display='none';
                        
                        document.getElementById("job1word").innerHTML= document.getElementById("job1edit").value;
                        document.getElementById("job1edit").style.display='none';
                        document.getElementById("job1sub").style.display='none';
                        document.getElementById("job1word").style.display='block';
                        
                        document.getElementById("des1word").innerHTML= document.getElementById("des1edit").value;
                        document.getElementById("des1edit").style.display='none';
                        document.getElementById("des1sub").style.display='none';
                        document.getElementById("des1word").style.display='block';
                        
                        document.getElementById("date1word").innerHTML= document.getElementById("date1edit").value;
                        document.getElementById("date1edit").style.display='none';
                        document.getElementById("date1sub").style.display='none';
                        document.getElementById("date1word").style.display='block';
                        
                        
                        document.getElementById("job2word").innerHTML= document.getElementById("job2edit").value;
                        document.getElementById("job2edit").style.display='none';
                        document.getElementById("job2sub").style.display='none';
                        document.getElementById("job2word").style.display='block';
                        
                        document.getElementById("des2word").innerHTML= document.getElementById("des2edit").value;
                        document.getElementById("des2edit").style.display='none';
                        document.getElementById("des2sub").style.display='none';
                        document.getElementById("des2word").style.display='block';
                        
                        document.getElementById("date2word").innerHTML= document.getElementById("date2edit").value;
                        document.getElementById("date2edit").style.display='none';
                        document.getElementById("date2sub").style.display='none';
                        document.getElementById("date2word").style.display='block';
                        
                        
                        document.getElementById("job3word").innerHTML= document.getElementById("job3edit").value;
                        document.getElementById("job3edit").style.display='none';
                        document.getElementById("job3sub").style.display='none';
                        document.getElementById("job3word").style.display='block';
                        
                        document.getElementById("des3word").innerHTML= document.getElementById("des3edit").value;
                        document.getElementById("des3edit").style.display='none';
                        document.getElementById("des3sub").style.display='none';
                        document.getElementById("des3word").style.display='block';
                        
                        document.getElementById("date3word").innerHTML= document.getElementById("date3edit").value;
                        document.getElementById("date3edit").style.display='none';
                        document.getElementById("date3sub").style.display='none';
                        document.getElementById("date3word").style.display='block';
                    }
              else{
                        document.getElementById("editbtn1").style.display='inline-block';
                        document.getElementById("edit2btn1").style.display='none';
                  
                        document.getElementById("job1edit").value= document.getElementById("job1word").innerHTML;
                        document.getElementById("job1word").style.display='none';
                        document.getElementById("job1sub").style.display='block';                        
                        document.getElementById("job1edit").style.display='block';
                  
                        document.getElementById("des1edit").value= document.getElementById("des1word").innerHTML;
                        document.getElementById("des1word").style.display='none';
                        document.getElementById("des1sub").style.display='block';                        
                        document.getElementById("des1edit").style.display='block';
                  
                        document.getElementById("date1edit").value= document.getElementById("date1word").innerHTML;
                        document.getElementById("date1word").style.display='none';
                        document.getElementById("date1sub").style.display='block';                        
                        document.getElementById("date1edit").style.display='block';
                  
                  
                        document.getElementById("job2edit").value= document.getElementById("job2word").innerHTML;
                        document.getElementById("job2word").style.display='none';
                        document.getElementById("job2sub").style.display='block';                        
                        document.getElementById("job2edit").style.display='block';
                  
                        document.getElementById("des2edit").value= document.getElementById("des2word").innerHTML;
                        document.getElementById("des2word").style.display='none';
                        document.getElementById("des2sub").style.display='block';                        
                        document.getElementById("des2edit").style.display='block';
                  
                        document.getElementById("date2edit").value= document.getElementById("date2word").innerHTML;
                        document.getElementById("date2word").style.display='none';
                        document.getElementById("date2sub").style.display='block';                        
                        document.getElementById("date2edit").style.display='block';
                  
                  
                        document.getElementById("job3edit").value= document.getElementById("job3word").innerHTML;
                        document.getElementById("job3word").style.display='none';
                        document.getElementById("job3sub").style.display='block';                        
                        document.getElementById("job3edit").style.display='block';
                  
                        document.getElementById("des3edit").value= document.getElementById("des3word").innerHTML;
                        document.getElementById("des3word").style.display='none';
                        document.getElementById("des3sub").style.display='block';                        
                        document.getElementById("des3edit").style.display='block';
                  
                        document.getElementById("date3edit").value= document.getElementById("date3word").innerHTML;
                        document.getElementById("date3word").style.display='none';
                        document.getElementById("date3sub").style.display='block';                        
                        document.getElementById("date3edit").style.display='block';
              }
          }*/
          
      </script>
  </head>
    
  <body id="page-top">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">
        <span class="d-none d-lg-block">
<!-- ================================ Profie Pic of Technician to be retrived from database ================ ================== -->
 <?php echo'<img src="data:image/jpeg;base64,'.base64_encode($row['Photo']).'"class="img-fluid img-profile rounded-circle mx-auto mb-2">';  ?>
         
        </span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#about">About</a>
          </li>
         <!-- <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#experience">Experience</a>
          </li>-->
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#education">Comments</a>
          </li>
           <li class="nav-item">
<!-- ============================================= Button to Sign Out and go back to Homepage ================================================ -->
             <form action="TechProfile.php" method="post">
            <div class="col-md-1" style="float: right;">
                    <button type="submit" onclick="e"  class="btn btn" id="sign" style="float:inherit; margin-top: 160px;margin-right: 40px;arg background-color: rgba(197, 197, 197, 0.62);font-family:'metropolis-regular',sans-serif;text-transform: uppercase;font-size: 0.8rem;padding: 10px 25px;border:0rem solid #c5c5c5;border-radius: 3px;letter-spacing: 0.15rem;color: #123e64;font-weight:bold;" name="logout">Sign Out</button>     
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
            </div>
        <form action="TechProfile.php"  method="post">
<!-- ============================================= Name Retrived from DataBase ================================================ -->
            <h1 class="mb-0" id="nameword" style="color: white;"><?php echo$row['Name']?></h1>
            <h4 style="display: none; color: white;" id="namesub" >Name : </h4>
<!-- ============================================= Name change to be sent to the database ================================================ -->
            <input type="text" class="form-control" id= "nameedit" placeholder="Enter title" name="name" style="display: none;max-width: 500px;margin-bottom: 10px">
<!-- ============================================= Button to submit changes and send them to database  ====================================== -->
            <div class="col-md-1" style="float: right;">
                <button type="submit" name = "Save" onclick="edit1();" id="edit2btn" class="btn btn" style="float: right; margin-left: 700px;background-color: cornflowerblue;color: white; display: none;">Save Edits</button>
            </div>
            <br>
          <div class="subheading mb-5">
<!-- ============================================= Category Retrived from database ================================================ -->
              <h4 style="display: block; color: white;" id="catword">Plumber</h4>
              <h4 style="display: none;color: white;" id="catsub">Category : </h4>
<!-- ============================================= Category change to be sent to the database =============================================== -->
              <select class="form-control"name="category" id= "catedit" style="display: none;max-width: 500px;margin-bottom: 10px;font-family:'metropolis-semibold',sans-serif;">
                 <option value="Electrician" class="dropmenu">Electrician</option>
                 <option value="Carpenter" class="dropmenu">Carpenter</option>
                 <option value="Plumber" class="dropmenu">Plumber</option>
              </select>
<!-- ============================================= Address retrived from the database =============================================== -->
              <h4 style="display: block; color: white;" id="addressword" ><?php echo$row['workshopAddress']?></h4>
              <h4 style="display: none;color: white;" id="addresssub">Address : </h4>
<!-- ============================================= Address change to be sent to the database =============================================== -->
              <input type="text" class="form-control" name ="address" id= "addressedit" style="display: none;max-width: 500px;margin-bottom: 10px;font-family:'metropolis-semibold',sans-serif; ">
<!-- ============================================= Number Retrived from the database =============================================== -->
              <h4 style="display: block; color: white;" id="numberword" ><?php echo$row['Phone']?></h4>
              <h4 style="display: none;color: white;" id="numbersub">Number : </h4>
<!-- ============================================= Number change to be sent to the database =============================================== -->
              <input type="text" class="form-control" id= "numberedit" style="display: none;max-width: 500px;margin-bottom: 10px;font-family:'metropolis-semibold',sans-serif; " name="phone">
<!-- ============================================= Email Retrived from the database =============================================== -->
              <h4 style="display: block; color: white;" id="mailword" style="color: white;"><?php echo$row['Email']?></h4>
              <h4 style="display: none;color: white;" id="mailsub">Email : </h4>
<!-- ============================================= Email change to be sent to the database =============================================== -->
              <input type="text" class="form-control"  id= "mailedit" style="display: none; max-width: 500px;margin-bottom: 10px;font-family:'metropolis-semibold',sans-serif; " name="email">



<!-- ============================================= Working hours Retrived from the database =============================================== -->
              <h4 style="display: block; color: white;" id="hrsword" style="color: white;"><?php echo$row['startHour']." - ".$row['endHour']?></h4>
              <h4 style="display: none;color: white;" id="hrssub">Working hours : </h4>
<!-- ============================================= Working hours change to be sent to the database =========================================== -->
              <input type="text" class="form-control"  id= "hrsedit" style="display: none; max-width: 500px;margin-bottom: 10px;font-family:'metropolis-semibold',sans-serif; " name="work">
<!-- ============================================= Password Retrived from the database =============================================== -->
              <h4 style="display: block; color: white;" id="daysword" style="color: white;"></h4>
              <h4 style="display: none;color: white;" id="dayssub">password : </h4>
<!-- ============================================= Password change to be sent to the database =========================================== -->
              <input type="text" class="form-control"  id= "daysedit" style="display: none; max-width: 500px;margin-bottom: 10px;font-family:'metropolis-semibold',sans-serif;" name="password">
<!-- ===================================================== Age retrived from the database  =================================================== -->
              <h4 style="display: block; color: white;" id="rating">Age :<?php echo$row['age']?></h4>
<!-- ============================================= Overall Rating retrived from the database  =============================================== -->
<?php
                 $t =(int)$tecID;
                 $sql="SELECT AVG(rate) as avg FROM `feedbacks` WHERE Technician_ID='$t'";
                 $stmt= $connection->prepare($sql);
                 $stmt->execute();
                 $avg=$stmt->fetch(PDO::FETCH_ASSOC);
                 $v = $avg['avg'];
                // echo $v ;
?>
              <h4 style="display: block; color: white;" id="rating">Rating:<?php echo $v ?> /5.0000</h4>
          </div>

         <p class="lead mb-5" id="desword" style="color: white;"><?php echo $row['about'];?></p>
          <h4 style="display: none;color: white;" id="dessub">Description : </h4>
<!-- ============================================= Description change to be sent to the database ============================================= -->
            <textarea class="form-control" id= "desedit" rows="3" style="display: none;"></textarea>
        </form>
        </div>
      </section>
<!--
      <hr class="m-0" >

      <section class="resume-section p-3 p-lg-5 d-flex flex-column" id="experience" style="background-color: white;">
        <div class="my-auto">
   
          <h2 class="mb-5">Experience</h2>
            
          <div class="resume-item d-flex flex-column flex-md-row mb-5">
            <div class="resume-content mr-auto">
            <div class="col-md-1" style="float: right;">
                <button type="submit" onclick="edit2();" id="editbtn1" class="btn btn" style="float: right; margin-left: 700px;background-color: cornflowerblue;color: white">Edit Info</button>
            </div>
        <form action="TechProfile.php"  method="get">
             <div class="col-md-1" style="float: right;">
                    <button type="submit" onclick="edit2();" id="edit2btn1" class="btn btn btn-success" style="float: right; margin-left: 200px; margin-bottom: 500px; background-color: cornflowerblue; display: inline-block; display: none;">Save Info</button>      
            </div>

              <h3 class="mb-0" style="display: block;" id="job1word">Building plumbing system</h3>
              <h4 style="display: none;" id="job1sub">Job : </h4>

             <input type="text" class="form-control" id= "job1edit" style="display: none;max-width: 500px;margin-bottom: 20px ">

              <p style="display: block;" id="des1word">Bring to the table win-win survival strategies to ensure proactive domination. At the end of the day, going forward, a new normal that has evolved from generation X is on the runway heading towards a streamlined cloud solution. User generated content in real-time will have multiple touchpoints for offshoring.</p>
                <h4 style="display: none;" id="des1sub" style="color: white;">Description : </h4>

                <textarea type="text" class="form-control" id= "des1edit" rows="4" style="display: none;min-width: 1000px;margin-bottom: 20px"></textarea>
                <br>
                <h4 style="display: none; float:left; margin-top: 10px;margin-right: 20px" id="date1sub">Date : </h4>

             <input type="text" class="form-control" id= "date1edit" style="display: none;max-width:500px;margin-bottom: 20px ">
            </div>
            <div class="resume-date text-md-right">

              <span class="text-primary" style="display: block;" id="date1word">March 2013</span>
            </div>
            
          </div>

          <div class="resume-item d-flex flex-column flex-md-row mb-5">
            <div class="resume-content mr-auto">

              <h3 class="mb-0" style="display: block;" id="job2word">Working on a sewer system</h3>
                 <h4 style="display: none;" id="job2sub">Job : </h4>

             <input type="text" class="form-control" id= "job2edit" style="display: none;max-width: 500px;margin-bottom: 20px ">

              <p style="display: block;" id="des2word">Capitalize on low hanging fruit to identify a ballpark value added activity to beta test. Override the digital divide with additional clickthroughs from DevOps. Nanotechnology immersion along the information highway will close the loop on focusing solely on the bottom line.</p>
                <h4 style="display: none;" id="des2sub" style="color: white;">Description : </h4>

                <textarea type="text" class="form-control" id= "des2edit" rows="4" style="display: none; min-width: 1000px;margin-bottom: 20px "></textarea>
                <br>
                <h4 style="display: none; height: 50px; float:left; margin-top: 10px;margin-right: 20px" id="date2sub">Date : </h4>

             <input type="text" class="form-control" id= "date2edit" style="display: none;max-width: 500px;margin-bottom: 20px ">
            </div>
            <div class="resume-date text-md-right">

              <span class="text-primary" style="display: block;" id="date2word">December 2011 - March 2013</span>
            </div>
          </div>

          <div class="resume-item d-flex flex-column flex-md-row mb-5">
            <div class="resume-content mr-auto">

              <h3 class="mb-0" style="display: block;" id="job3word">Fixed more than 25 Bathrooms</h3>
                <h4 style="display: none;" id="job3sub">Job : </h4>

             <input type="text" class="form-control" id= "job3edit" style="display: none; max-width: 500px;margin-bottom: 20px ">

              <p style="display: block;" id="des3word">Podcasting operational change management inside of workflows to establish a framework. Taking seamless key performance indicators offline to maximise the long tail. Keeping your eye on the ball while performing a deep dive on the start-up mentality to derive convergence on cross-platform integration.</p>
                <h4 style="display: none;" id="des3sub" style="color: white;">Description : </h4>

                <textarea type="text" class="form-control" id= "des3edit" rows="4" style="display: none;min-width: 1000px;margin-bottom: 20px "></textarea>
                <br>
                <h4 style="display: none; height: 50px; float:left; margin-top: 10px;margin-right: 20px" id="date3sub">Date : </h4>

             <input type="text" class="form-control" id= "date3edit" style="display: none;max-width: 500px;margin-bottom: 20px ">
            </div>
            <div class="resume-date text-md-right">

              <span class="text-primary" style="display: block;" id="date3word">July 2010 - December 2011</span>
            </div>
          </div>
      </form>
        </div>

      </section>
-->
      <hr class="m-0">

      <section class="resume-section p-3 p-lg-5 d-flex flex-column" id="education" tyle="background-image: url(img/pattern1.jpg); background-repeat: no-repeat; background-size: contain; width:100%;" style="background-color: white;">
        <div class="my-auto">
          <h2 class="mb-5">Comments</h2>
          <?php 
          for ($i=0; $i < $returnResult ; $i++) { 
          $rating = $returnData[$i]['rate'];
          $feed = $returnData[$i]['The Feedback'];
          $client = $returnData[$i]['Client_ID'];

          $sql1="SELECT * FROM `client` WHERE id ='$client'";
		  $stmt1= $connection->prepare($sql1);
		  $stmt1->execute();
		  $Data=$stmt1->fetch(PDO::FETCH_ASSOC);
		  $clientName = $Data['Name'];
          
          ?>
          <div class="resume-item d-flex flex-column flex-md-row mb-5">
            <div class="resume-content mr-auto">

              <h3 class="mb-0"><?php echo $clientName ; ?> </h3>
<!-- ============================================= Rating of commenter 1 retrived from database  ====================================== -->
              <div class="subheading mb-3">Rating: <?php echo $rating ; ?> / 5.0</div>
<!-- ============================================= Feedback of commenter 1 retrived from database  ====================================== -->
              <p> <?php echo $feed ; ?></p>
            </div>
            <div class="resume-date text-md-right">
<!-- ============================================= Date of commenter 1 retrived from database  ====================================== -->
              
            </div>
          </div>
      <?php } ?>

        </div>
      </section>


    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/resume.min.js"></script>

  </body>

</html>
