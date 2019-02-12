<?php 
session_start();
$clientID = $_SESSION['clientId']; //use this id to render data from database
//echo $clientID;
//Render data code here

if(isset($_GET['profile']))
{
    header("location: ../ClientProfile/ClientProfile.php");
}

if($clientID)//if there is 
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
<html>
<head>
    
    <title>Search for Technician</title>
<link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
 <link rel="icon" href="hq%20logo2.png" > 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link href="style.css" rel="stylesheet">
    <script type="text/javascript">
        
        function on(){
/***************************** Recieve number of search results from php and put it in variable numOfRes MAX 6 RESULTS *************************/
            var numOfRes,i;  //i serves as counter for displayed cards
            numOfRes=6; //initial value for testing ****** value of numOfRes should be recieved from php MAX 6 RESULTS*****
            
            for(i=0;i<numOfRes; i+=1) //display only the number of cards required
            {
            document.getElementsByClassName('card')[i].style.display='inline-block';
            }
        }
        
        function feed1()
        {
             if(document.getElementById("rating1").style.display=="none")
                    {
                        document.getElementById("feed1btn").style.display='block';
                        document.getElementById("submitfeed").style.display='none';
                        document.getElementById("cat1").style.display='none';
                        document.getElementById("catword1").style.display='none';
                        document.getElementById("address1").style.display='none';
                        document.getElementById("addressword1").style.display='none';
                        document.getElementById("rating1").style.display='block';
                        document.getElementById("ratingword1").style.display='block';
                        document.getElementById("comment1").style.display='block';
                        document.getElementById("commentword1").style.display='block';
                    }
            else
                {
                    
                        document.getElementById("feed1btn").style.display='none';
                        document.getElementById("submitfeed").style.display='block';
                        document.getElementById("catword1").style.display='block';
                        document.getElementById("address1").style.display='block';
                        document.getElementById("addressword1").style.display='block';
                        document.getElementById("rating1").style.display='none';
                        document.getElementById("ratingword1").style.display='none';
                        document.getElementById("comment1").style.display='none';
                        document.getElementById("commentword1").style.display='none';
                }
        
        
       
        }
    
    </script>
    </head>
<body>
    <dev style="display: block;background-color: rgba(0, 0, 0, 0.49);">
    <form action="search.php" method="GET">
     <button type="submit" class="btn btn header" style=" margin: 15px 200px; background-color: rgba(197, 197, 197, 0.62);font-family:'metropolis-regular',sans-serif;text-transform: uppercase;font-size: 0.8rem;padding: 10px 25px;border:0rem solid #c5c5c5;border-radius: 3px;letter-spacing: 0.15rem;color: #123e64;font-weight:bold;" name="profile">Profile</button>
     </form>


     <form action="search.php" method="POST">
    <button type="submit" class="btn btn header" style=" margin: 15px 200px; background-color: rgba(197, 197, 197, 0.62);font-family:'metropolis-regular',sans-serif;text-transform: uppercase;font-size: 0.8rem;padding: 10px 25px;border:0rem solid #c5c5c5;border-radius: 3px;letter-spacing: 0.15rem;color: #123e64;font-weight:bold;" name="logout">Sign Out</button>
    </form>
    </dev>
     <br>
     <br>
    <img src="techfix.png"   width="20%" class="mx-auto d-block logo">
    
    <form class="reg" action="" method="post" onsubmit="return false">
        <div class="form-group col-lg-4 mx-auto d-block">   
            <label >Search For Your Technician </label>
            <br>
            <input  class="form1-control" type="text" placeholder="Search" name="search">
            <select class = "list"name="Choose">
                <option value="name">Name</option>
                <option value="categ">Category</option>
                <option value="area">Area</option>
                </select>
            <br>
            <br>
           <button type="submit" id="Search" onclick="on()" class="btn sub">Search</button>            
        </div>
    </form>
    
    
    
        <div class = " card">
            <img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="user.png">
            <h6 style="margin-top: 15px">NAME:</h6>
            <p>Zyad mohamed</p>
            <h6>AGE:</h6>
            <p>25</p>
            <h6>RATING:</h6>
            <p>4.1/5.0</p>
            <h6>previous comments:</h6>
            <p>- He gets the work done but he can do better next times. He is an okay plumber.</p>
            <p>- He is a truly fantastic Plumber.</p>
            <h6>PHONE NUMBER:</h6>
            <p>01012345678</p>
            <h6>WORKING HOURS:</h6>
            <p>10AM-2PM</p>
            <h6>WORKING DAYS:</h6>
            <p>sat-sun</p>
            <h6 id="cat1">CATEGORY:</h6>
            <h6 id="rating1" style="display: none; color: white;">Rating from 1 to 5 :</h6>
            <p id="catword1">computer ad donya</p>
            <input type="text" class="form-control" id= "ratingword1" style="display: none;max-width:200px;max-height: 30px;margin-bottom: 10px;font-family:'metropolis-semibold',sans-serif;">
            <h6 id="address1">Address:</h6>
            <h6 id="comment1" style="display: none; color: white;">Comment :</h6>
            <p id="addressword1">kol 7ta w kol makan</p>
            <input type="text" class="form-control" id= "commentword1" style="display: none;max-width: 500px;max-height: 30px;margin-bottom: 10px;font-family:'metropolis-semibold',sans-serif;">
            <button type="submit" class="btn feedbtn" onclick="feed1();" id="feed1btn">Give Feedback</button>
            <button type="submit" class="btn feedbtn" onclick="feed1();" id="submitfeed" style="display: none;">Send Feedback</button>
        </div>
    
    
        
    </body>

</html>