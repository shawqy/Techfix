<?php 
//Database connection
$dsn='mysql:host=localhost;dbname=techfix';
           try{
         $connection=new PDO($dsn,'root','');
              }
              catch(PDOException $e)
              {
               echo $e->getMessage();
              }

session_start();
$clientID = $_SESSION['clientId']; //use this id to render data from database
//echo $clientID;
//Render data code here
$returnData = [];
$returnResult = 0;
$flag = 0;
if (isset($_POST['searchStart']))
{
	$searchWord = $_POST['data'];
	$searchCat= $_POST['Choose'];
	
	//echo "searchStart";

	if(empty($searchWord))
	{
		$sql="SELECT * FROM `technician`";
 		$stmt= $connection->prepare($sql);
 		$stmt->execute();
 		$returnData=$stmt->fetchall(PDO::FETCH_ASSOC);
 		$returnResult = sizeof($returnData);
	}
	else //if the input search field is not empty
	{
		if($searchCat == "Name")// if search by name
		{
			$sql="SELECT * FROM `technician` WHERE Name LIKE '%$searchWord%'";
	 		$stmt= $connection->prepare($sql);
	 		$stmt->execute();
	 		$returnData=$stmt->fetchall(PDO::FETCH_ASSOC);
	 		$returnResult = sizeof($returnData);
	 		//if there is no results for search word show all results
	 		if ($returnResult == 0)
	 		{
	 			$flag = 1;
	 			$sql="SELECT * FROM `technician`";
		 		$stmt= $connection->prepare($sql);
		 		$stmt->execute();
		 		$returnData=$stmt->fetchall(PDO::FETCH_ASSOC);
		 		$returnResult = sizeof($returnData);

	 		}
		}
		else if($searchCat == "Category") //search by category
		{
			$sql="SELECT * FROM `technician` WHERE Categroy LIKE '%$searchWord%'";
	 		$stmt= $connection->prepare($sql);
	 		$stmt->execute();
	 		$returnData=$stmt->fetchall(PDO::FETCH_ASSOC);
	 		$returnResult = sizeof($returnData);
	 		//if there is no results for search word show all results
	 		if ($returnResult == 0)
	 		{
	 			$flag = 1;
	 			$sql="SELECT * FROM `technician`";
		 		$stmt= $connection->prepare($sql);
		 		$stmt->execute();
		 		$returnData=$stmt->fetchall(PDO::FETCH_ASSOC);
		 		$returnResult = sizeof($returnData);

	 		}
		}
		else// if search by zone
		{
			$sql="SELECT * FROM `technician` WHERE 	workshopAddress LIKE '%$searchWord%'";
	 		$stmt= $connection->prepare($sql);
	 		$stmt->execute();
	 		$returnData=$stmt->fetchall(PDO::FETCH_ASSOC);
	 		$returnResult = sizeof($returnData);
	 		//if there is no results for search word show all results
	 		if ($returnResult == 0)
	 		{
	 			$flag = 1;
	 			$sql="SELECT * FROM `technician`";
		 		$stmt= $connection->prepare($sql);
		 		$stmt->execute();
		 		$returnData=$stmt->fetchall(PDO::FETCH_ASSOC);
		 		$returnResult = sizeof($returnData);

	 		}
		}


	}


}//end of searchStart condition 

if(isset($_POST['feed']))
{
	$tID 		=$_POST['techID'] ;
	$cID 		=$_POST['cliID'] ;
	$rating 	=$_POST['rating'] ;
	$comment 	=$_POST['comment'] ;

	$sql="INSERT INTO `feedbacks` (`Client_ID`, `Technician_ID`, `The Feedback`, `rate`) VALUES ('$cID','$tID','$comment','$rating')";
 	$stmt= $connection->prepare($sql);
 	$stmt->execute();

}//end of send feedback condition


if(isset($_GET['profile']))
{
    header("location: ../ClientProfile/ClientProfile.php");
}

if($clientID)//if there is someone logged in 
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
    header("location:../login/login.php");
}
//echo "The Result are " . $returnResult;
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
    
    <form class="reg" action="search.php" method="POST" >
        <div class="form-group col-lg-4 mx-auto d-block">   
            <label >Search For Your Technician </label>
            <br>
             
             	<!-- subit data in array -->
          	  <input  class="form1-control" type="text" placeholder="Search" name="data">
           		 <select class = "list"name="Choose">
	                <option value="Name">Name</option>
	                <option value="Category">Category</option>
	                <option value="Zone">Zone</option>
                 </select>
            <br>
            <br>

           
           <button type="submit" id="Search" onclick="on();" class="btn sub" name="searchStart">Search</button>    
              
        </div>
    </form>
    <h6>  </h6>
    
    <?php 
    //echo "The Result are " . $returnResult;
    for ($i=0; $i < $returnResult ; $i++)
	{ 
	
?>

        <div class = " card">
            <?php echo'<img src="data:image/jpeg;base64,'.base64_encode($returnData[$i]['Photo']).'"class="img-fluid img-profile rounded-circle mx-auto mb-2">';  ?>
            <h6 style="margin-top: 15px">NAME:</h6>
            <p> <?php echo  $returnData[$i]['Name']; ?> </p>
            <h6>AGE:</h6>
            <p>  <?php echo  $returnData[$i]['age']; ?> </p>
            <h6>RATING:</h6>
            <?php
            	 $t =(int)$returnData[$i]['id'];
				 $sql="SELECT AVG(rate) as avg FROM `feedbacks` WHERE Technician_ID='$t'";
				 $stmt= $connection->prepare($sql);
				 $stmt->execute();
				 $avg=$stmt->fetch(PDO::FETCH_ASSOC);
				 $v = $avg['avg'];
				?>
				            <p>  <?php echo $v ; ?> /5.0</p>
            <h6>About The Tech:</h6>
            <p><?php echo  $returnData[$i]['about']; ?></p>
            
            <h6>PHONE NUMBER:</h6>
            <p><?php echo  $returnData[$i]['Phone']; ?></p>
            <h6>WORKING HOURS:</h6>
            <p><?php echo  $returnData[$i]['startHour']; ?> - <?php echo  $returnData[$i]['endHour']; ?> </p>
            
            <h6 id="cat1">CATEGORY:</h6>
            <p id="catword1"><?php echo  $returnData[$i]['Categroy']; ?></p>
            <h6 id="address1">Address:</h6>
            <p ><?php echo  $returnData[$i]['workshopAddress']; ?></p>
            <br>

            <form action="search.php" method="POST">
            <input type="hidden" class="form-control" id= "ratingword1" style="max-width:200px;max-height: 30px;margin-bottom: 10px;font-family:'metropolis-semibold',sans-serif;" name="techID" value="<?php echo  $returnData[$i]['id']; ?>"> 
             <input type="hidden" class="form-control" id= "ratingword1" style="max-width:200px;max-height: 30px;margin-bottom: 10px;font-family:'metropolis-semibold',sans-serif;" name="cliID" value="<?php echo $clientID; ?>"> 

            <h6 id="comment1" style="color: white;">Give a rate From 1 to 5 :</h6>
            <input type="text" class="form-control" id= "ratingword1" style="max-width:200px;max-height: 30px;margin-bottom: 10px;font-family:'metropolis-semibold',sans-serif;" name="rating">
            
            <h6 id="comment1" style="color: white;"> Add Comment :</h6>
            <input type="text" class="form-control" id= "commentword1" style="max-width: 500px;max-height: 30px;margin-bottom: 10px;font-family:'metropolis-semibold',sans-serif;" name="comment">
           
            <button type="submit" class="btn feedbtn" name="feed">Send Feedback</button>
            </form>
        </div>
    <?php } ?>

	<script type="text/javascript">
        
        function on(){
/***************************** Recieve number of search results from php and put it in variable numOfRes MAX 6 RESULTS *************************/
            var numOfRes,i;  //i serves as counter for displayed cards
            numOfRes=<?php echo $returnResult ; ?>; //initial value for testing ****** value of numOfRes should be recieved from php MAX 6 RESULTS*****
            
            for(i=0;i<numOfRes; i+=1) //display only the number of cards required
            {
            document.getElementsByClassName('card')[i].style.display='inline-block';
            }
        }
        
        // function feed1()
        // {
        //      if(document.getElementById("rating1").style.display=="none")
        //             {
        //                 document.getElementById("feed1btn").style.display='block';
        //                 document.getElementById("submitfeed").style.display='none';
        //                 document.getElementById("cat1").style.display='none';
        //                 document.getElementById("catword1").style.display='none';
        //                 document.getElementById("address1").style.display='none';
        //                 document.getElementById("addressword1").style.display='none';
        //                 document.getElementById("rating1").style.display='block';
        //                 document.getElementById("ratingword1").style.display='block';
        //                 document.getElementById("comment1").style.display='block';
        //                 document.getElementById("commentword1").style.display='block';
        //             }
        //     else
        //         {
                    
        //                 document.getElementById("feed1btn").style.display='none';
        //                 document.getElementById("submitfeed").style.display='block';
        //                 document.getElementById("catword1").style.display='block';
        //                 document.getElementById("address1").style.display='block';
        //                 document.getElementById("addressword1").style.display='block';
        //                 document.getElementById("rating1").style.display='none';
        //                 document.getElementById("ratingword1").style.display='none';
        //                 document.getElementById("comment1").style.display='none';
        //                 document.getElementById("commentword1").style.display='none';
        //         }
        
        
       
        // }
    
    </script>    
    </body>

</html>