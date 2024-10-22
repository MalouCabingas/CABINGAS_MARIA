<?php 
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include('query/db.php'); 

// var_dump(date('Y-m-d'));


$result = mysqli_query($con,"select count(*) FROM issue WHERE `issue_type` = 'Certificate'");
$row = mysqli_fetch_array($result);

$totalcertificate = $row[0];


$result2 = mysqli_query($con,"select count(*) FROM issue WHERE `issue_type` = 'Clearance' && `issue_date` = CURDATE()");
$row2 = mysqli_fetch_array($result2);


$totalclearance = $row2[0];


$result1 = mysqli_query($con,"select count(*) FROM resident");
$row1 = mysqli_fetch_array($result1);

$totalresident = $row1[0];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Barangay Information Management System</title>
</head>
<body>

	<header>
	<style>
	   .header.btn:hover {
		background-color: #c8ff70; /* Darker green on hover */
        box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.2); /* Slight shadow on hover */
  		color: aquamarine; /* White text on hover */
	   }
  </style>
		<div style="width: 20%; display: flex; justify-content: flex-start;">

	    <img src="./logo.png" style="width: 100px; height: 89px;" alt="" loading="lazy"  />
	    <a href="index.php" style="font-size: 30px;"><i><h4 style="font-family:Bodoni FLF; line-height: 1.1; margin: 0">Barangay <br/>Information</h4></i></a>
			
		</div>
		<style>
	   .btn:hover {
		background-color: #c8ff70; /* Darker green on hover */
        box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.2); /* Slight shadow on hover */
  		color: aquamarine; /* White text on hover */
	   }
  </style>
		<div style="left: 405px; position:absolute; height: 70px; width: 1468px; background: white; display: flex; justify-content: flex-end">
		<button class="btn" style="cursor:pointer; font-size:16px; box-shadow: 2px 2px black; border-radius: 50px;align-items: center; justify-content:center; display:flex; height:40px; border: 1px solid black; color: black; width:100px;" onclick="location.href='profile.php';"><?= ucwords($_SESSION['user_type']); ?> <span style="color: green; padding: 0 10px">●</span></button>
		</div>
	</header>

	<div class="parent" style="height: 813px;">

	  <nav style="width:378px";>
	    <ul>
	        <li style="box-sizing:border-box; border: 1px solid black" class="active"><img src="./icons/home.png" width="30" height="30" alt="" loading="lazy" style="margin-right: 20px" />
	        	<a href="index.php">Dashboard</a>
	        </li>
	        <li style="box-sizing:border-box; border: 1px solid black"><img src="./icons/information.png" width="30" height="30" alt="" loading="lazy" style="margin-right: 20px" /><a href="information.php">Barangay Information</a>
	        </li>
	        <li style="box-sizing:border-box; border: 1px solid black"><img src="./icons/users.png" width="30" height="30" alt="" loading="lazy" style="margin-right: 20px" />
	        	<a href="official.php">Barangay Official</a>
	        </li>
	        <li style="box-sizing:border-box; border: 1px solid black"><img src="./icons/group.png" width="30" height="30" alt="" loading="lazy" style="margin-right: 20px" />
	        	<a href="residents.php">Residents</a>
	        </li>
	        <li style="box-sizing:border-box; border: 1px solid black"><img src="./icons/edit.png" width="30" height="30" alt="" loading="lazy" style="margin-right: 20px" />
	        	<a href="certificates.php">Certificate  / Clearance</a>
	        </li>
	        <li style="box-sizing:border-box; border: 1px solid black"><img src="./icons/checklist.png" width="30" height="30" alt="" loading="lazy" style="margin-right: 20px" />
	        	<a href="forms.php">Issued forms</a>
	        </li>
	    </ul>
<style>
	.logout img{
		margin-left: 90px;
	}
</style>
	    <ul style="margin: 20px">	    	
	        <li style="cursor:pointer; box-sizing:border-box; border: 1px solid black" class="logout"><img src="./icons/sign.png" margin-left="30px" width="30" height="30" alt="" loading="lazy" /><a class="logout">Logout</a></li>
	    </ul>
	  </nav>
	  
	   <!--Content-->
	  <div class="content" style="display: flex; flex-direction:row; justify-content: space-evenly; align-items: center; background-image: url(2.jpg); background-size: cover; background-position: center; background-repeat: no-repeat; width: 80%; margin-left: 10px; border: 1px black solid;">
<style>
	.summary{
		margin-bottom: 400px;
		font-weight: bold;
		font-size: 20px;
	}
</style>
	  	<div class="summary" style="display: flex; flex-direction:row; justify-content: space-between; align-items: center; padding: 40px 50px;   background-color: #FFDE59;  border-radius: 10px; border: 1px solid black;" >
	  		<img src="./icons/group.png" width="60" height="60" alt="" loading="lazy" style="margin-right: 20px;" />
	  		<div style=" border-left: 0.25rem solid green; display: flex; flex-direction: column; justify-content: space-evenly; align-items: center; padding: 0 20px;"> 
	  			<p><?php echo $totalresident;?></p>
	  			<p>RESIDENTS</p>
	  			<p>as of 2024</p>
  			</div>	  		
	  	</div>


	  	<div class="summary" style="display: flex; flex-direction:row; justify-content: space-between; align-items: center; padding: 40px 50px;   background-color: #D9F2FC; border-radius: 10px; border: 1px solid black;" >
	  		<img src="./icons/edit.png" width="60" height="60" alt="" loading="lazy" style="margin-right: 20px;" />
	  		<div style=" border-left: 0.25rem solid green; display: flex; flex-direction: column; justify-content: space-evenly; align-items: center; padding: 0 20px;"> 
	  			<p><?php echo $totalcertificate;?></p>
	  			<p>CERTIFICATE</p>
	  			<p>as of 2024</p>
  			</div>	  		
	  	</div>


	  	<div class="summary" style="display: flex; flex-direction:row; justify-content: space-between; align-items: center; padding: 40px 50px;  background-color: #E4F577;  border-radius: 10px; border: 1px solid black;" >
	  		<img src="./icons/checklist.png" width="60" height="60" alt="" loading="lazy" style="margin-right: 20px;" />
	  		<div style=" border-left: 0.25rem solid green; display: flex; flex-direction: column; justify-content: space-evenly; align-items: center; padding: 0 20px;"> 
	  			<p><?php echo $totalclearance;?></p>
	  			<p>SERVED</p>
	  			<p>CLEARANCE</p>
	  			<p>Today</p>
  			</div>	  		
	  	</div>




	  </div>

	</div>

    <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">

       $('.logout').click(function(){
                  $.ajax({
                    url: 'query/user.php',
                    type: 'POST',
                    data: { 
                        action_name:'logout', 
                    },
                    success: function(response){
                            window.location.href = 'login.php'; 
                    }
            });
          });
    </script>
</body>
</html>
