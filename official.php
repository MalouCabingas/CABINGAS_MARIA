<?php 
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include('query/db.php'); 
$result = mysqli_query($con,"SELECT * FROM `official`");

$official = array();
if ($result->num_rows > 0) {
    // Fetch all rows and store them in an array
    while($row = $result->fetch_assoc()) {
        $official[$row['official_id']] = $row;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Information Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles.css">

</head>
<body>

	<header>
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
		<div style="left: 405px; position:absolute; height:70px; width: 1468px; background: white; display: flex; justify-content: flex-end">
		<button class="btn" style="font-size:16px; box-shadow: 2px 2px black; border-radius: 50px;align-items: center; justify-content:center; display:flex; height:40px; border: 1px solid black; color: black; width:100px;" onclick="location.href='profile.php';"><?= ucwords($_SESSION['user_type']); ?> <span style="color: green; padding: 0 10px">●</span></button>
		</div>
	</header>

	<div class="parent" style="height: 813px;">

	  <nav style="width:388px;">
	    <ul>
	        <li style="box-sizing:border-box; border: 1px solid black"><img src="./icons/home.png" width="30" height="30" alt="" loading="lazy" style="margin-right: 20px" />
	        	<a href="index.php">Dashboard</a>
	        </li>
	        <li style="box-sizing:border-box; border: 1px solid black"><img src="./icons/information.png" width="30" height="30" alt="" loading="lazy" style="margin-right: 20px" /><a href="information.php">Barangay Information</a>
	        </li>
	        <li style="box-sizing:border-box; border: 1px solid black" class="active"><img src="./icons/users.png" width="30" height="30" alt="" loading="lazy" style="margin-right: 20px" />
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
	        <li style="cursor:pointer; box-sizing:border-box; border: 1px solid black" class="logout"><img src="./icons/sign.png" width="30" height="30" alt="" loading="lazy" /><a class="logout">Logout</a></li>
	    </ul>
	  </nav>
	  
	   <!--Content-->

		   	<div class="content" style="display: flex; flex-direction:column; align-items: center; padding: 10px; margin: 15px;">
				<div style="display: flex; flex-direction:row; justify-content: space-between; align-items: center; border-radius: 10px; width: 100%; margin-right:60px;">
					<img src="./barangay.png" width="90" height="90" alt="" loading="lazy" style="margin-left: 150px;"><h3 style="color:white; font-family:Bodoni FLF; font-size:25px; width: 390px; display: flex; flex-direction:row; justify-content: center; align-items: center; padding: 25px 15px; background-color: #CCC14F;">Barangay Councils of San Nicolas </h3>
					<p style="font-weight:bold; font-size:20px; margin-right: 20px;">Year 2024-2027</p>
				</div>

				<div style="border-radius:15px; border: 1px solid black; margin-top: 10px; display: flex; flex-direction: column; align-items: center; background-color: #eef9a9; padding: 10px; height: 70px; justify-content: space-between; width: 260px;">
					<div class="editing">
						<h4 style="padding-top:15px; margin: 0"><?php echo $official[1]['official_name'];?></h4>
						<p><?php echo $official[1]['official_position'];?></p>
						
					</div>
					<div class="update">
						<input type="text" name="1_name" value="<?php echo $official[1]['official_name'];?>">
						<input type="text" name="1_position" value="<?php echo $official[1]['official_position'];?>">
					</div>
				</div>

				<div style="padding-top: 45px;margin: 20px; margin-bottom: 0px; display: flex; flex-direction: row;  justify-content: center; column-gap: 30px;  width: 100%">
					<div style="border-radius:15px; border: 1px solid black; display: flex; flex-direction: column; align-items: center; background-color: #eef9a9; padding: 10px; height: 70px; justify-content: space-between; width: 260px;">


						<div class="editing">
							<h4 style="padding-top:15px; margin: 0"><?php echo $official[2]['official_name'];?></h4>

							<?php
									if (strpos($official[2]['official_position'], ',') !== false) {								
									    $array1 = explode(',', $official[2]['official_position']);
									    foreach ($array1 as $value) {
							?>
											<p><?php echo $value;?></p>
							<?php
									    }

									} else {
							?>
										<p><?php echo $official[2]['official_position'];?></p>
							<?php
									}
							?>
						
						</div>
						<div class="update">
							<input type="text" name="2_name" value="<?php echo $official[2]['official_name'];?>">
							<input type="text" name="2_position" value="<?php echo $official[2]['official_position'];?>">
						</div>


					</div>
					<div style="border-radius:15px; border: 1px solid black; display: flex; flex-direction: column; align-items: center; background-color: #eef9a9; padding: 10px; height: 70px; justify-content: space-between; width: 260px;">
						
						<div class="editing">
							<h4 style="padding-top:15px; margin: 0"><?php echo $official[3]['official_name'];?></h4>

							<?php
									if (strpos($official[3]['official_position'], ',') !== false) {								
									    $array1 = explode(',', $official[3]['official_position']);
									    foreach ($array1 as $value) {
							?>
											<p><?php echo $value;?></p>
							<?php
									    }

									} else {
							?>
										<p><?php echo $official[3]['official_position'];?></p>
							<?php
									}
							?>
						
						</div>
						<div class="update">
							<input type="text" name="3_name" value="<?php echo $official[3]['official_name'];?>">
							<input type="text" name="3_position" value="<?php echo $official[3]['official_position'];?>">
						</div>
					</div>
					<div style="border-radius:15px; border: 1px solid black; display: flex; flex-direction: column; align-items: center; background-color: #eef9a9; padding: 10px; height: 70px; justify-content: space-between; width: 260px;">
						
						<div class="editing">
							<h4 style="padding-top:15px; margin: 0"><?php echo $official[4]['official_name'];?></h4>

							<?php
									if (strpos($official[4]['official_position'], ',') !== false) {								
									    $array1 = explode(',', $official[4]['official_position']);
									    foreach ($array1 as $value) {
							?>
											<p><?php echo $value;?></p>
							<?php
									    }

									} else {
							?>
										<p><?php echo $official[4]['official_position'];?></p>
							<?php
									}
							?>
						
						</div>
						<div class="update">
							<input type="text" name="4_name" value="<?php echo $official[4]['official_name'];?>">
							<input type="text" name="4_position" value="<?php echo $official[4]['official_position'];?>">
						</div>
					</div>
					<div style="border-radius:15px; border: 1px solid black; display: flex; flex-direction: column; align-items: center; background-color: #eef9a9; padding: 10px; height: 70px; justify-content: space-between; width: 260px;">
						
						<div class="editing">
							<h4 style="padding-top:15px; margin: 0"><?php echo $official[5]['official_name'];?></h4>

							<?php
									if (strpos($official[5]['official_position'], ',') !== false) {								
									    $array1 = explode(',', $official[5]['official_position']);
									    foreach ($array1 as $value) {
							?>
											<p><?php echo $value;?></p>
							<?php
									    }

									} else {
							?>
										<p><?php echo $official[5]['official_position'];?></p>
							<?php
									}
							?>
						
						</div>
						<div class="update">
							<input type="text" name="5_name" value="<?php echo $official[5]['official_name'];?>">
							<input type="text" name="5_position" value="<?php echo $official[5]['official_position'];?>">
						</div>
					</div>
				</div>

				<div style="margin: 20px; margin-bottom: 0px; display: flex; flex-direction: row;  justify-content: center; column-gap: 30px; width: 100%">
					<div style="border-radius:15px; border: 1px solid black; display: flex; flex-direction: column; align-items: center; background-color: #eef9a9; padding: 10px; height: 70px; justify-content: space-between; width: 260px;">
						
						<div class="editing">
							<h4 style="padding-top:15px; margin: 0"><?php echo $official[6]['official_name'];?></h4>

							<?php
									if (strpos($official[6]['official_position'], ',') !== false) {								
									    $array1 = explode(',', $official[6]['official_position']);
									    foreach ($array1 as $value) {
							?>
											<p><?php echo $value;?></p>
							<?php
									    }

									} else {
							?>
										<p><?php echo $official[6]['official_position'];?></p>
							<?php
									}
							?>
						
						</div>
						<div class="update">
							<input type="text" name="6_name" value="<?php echo $official[6]['official_name'];?>">
							<input type="text" name="6_position" value="<?php echo $official[6]['official_position'];?>">
						</div>
					</div>
					<div style="border-radius:15px; border: 1px solid black; display: flex; flex-direction: column; align-items: center; background-color: #eef9a9; padding: 10px; height: 70px; justify-content: space-between; width: 260px;">
						
						<div class="editing">
							<h4 style="padding-top:15px; margin: 0"><?php echo $official[7]['official_name'];?></h4>

							<?php
									if (strpos($official[7]['official_position'], ',') !== false) {								
									    $array1 = explode(',', $official[7]['official_position']);
									    foreach ($array1 as $value) {
							?>
											<p><?php echo $value;?></p>
							<?php
									    }

									} else {
							?>
										<p><?php echo $official[7]['official_position'];?></p>
							<?php
									}
							?>
						
						</div>
						<div class="update">
							<input type="text" name="7_name" value="<?php echo $official[7]['official_name'];?>">
							<input type="text" name="7_position" value="<?php echo $official[7]['official_position'];?>">
						</div>
					</div>
					<div style="border-radius:15px; border: 1px solid black; display: flex; flex-direction: column; align-items: center; background-color: #eef9a9; padding: 10px; height: 70px; justify-content: space-between; width: 260px;">
						
						<div class="editing">
							<h4 style="padding-top:15px; margin: 0"><?php echo $official[8]['official_name'];?></h4>

							<?php
									if (strpos($official[8]['official_position'], ',') !== false) {								
									    $array1 = explode(',', $official[8]['official_position']);
									    foreach ($array1 as $value) {
							?>
											<p><?php echo $value;?></p>
							<?php
									    }

									} else {
							?>
										<p><?php echo $official[8]['official_position'];?></p>
							<?php
									}
							?>
						
						</div>
						<div class="update">
							<input type="text" name="8_name" value="<?php echo $official[8]['official_name'];?>">
							<input type="text" name="8_position" value="<?php echo $official[8]['official_position'];?>">
						</div>
					</div>
					<div style="border-radius:15px; border: 1px solid black; display: flex; flex-direction: column; align-items: center; background-color: #eef9a9; padding: 10px; height: 70px; justify-content: space-between; width: 260px;">
						
						<div class="editing">
							<h4 style="padding-top:15px; margin: 0"><?php echo $official[9]['official_name'];?></h4>

							<?php
									if (strpos($official[9]['official_position'], ',') !== false) {								
									    $array1 = explode(',', $official[9]['official_position']);
									    foreach ($array1 as $value) {
							?>
											<p><?php echo $value;?></p>
							<?php
									    }

									} else {
							?>
										<p><?php echo $official[9]['official_position'];?></p>
							<?php
									}
							?>
						
						</div>
						<div class="update">
							<input type="text" name="9_name" value="<?php echo $official[9]['official_name'];?>">
							<input type="text" name="9_position" value="<?php echo $official[9]['official_position'];?>">
						</div>
					</div>
				</div>

				<div style="display: flex; flex-direction:row; justify-content: center; align-items: center; border-radius: 10px; width: 100%;">
					<h3 style="color:white; font-family:Bodoni FLF; margin-top:50px;display: flex; flex-direction:row; justify-content: flex-start; align-items: center; padding: 10px 30px; background-color: #CCC14F; ">SUPPORT ADMINISTRATIVE STAFF</h3>
				</div>
				<div style="margin: 20px; margin-top: 0px; display: flex; flex-direction: row; justify-content: center; column-gap: 30px; width: 100%">
					<div style="border-radius:15px; border: 1px solid black; display: flex; flex-direction: column; align-items: center; background-color: #eff9af; padding: 10px; height: 70px; justify-content: space-between; width: 260px;">
						
						<div class="editing">
							<h4 style="font-size: 15px; padding-top:15px; margin: 0"><?php echo $official[10]['official_name'];?></h4>

							<?php
									if (strpos($official[10]['official_position'], ',') !== false) {								
									    $array1 = explode(',', $official[10]['official_position']);
									    foreach ($array1 as $value) {
							?>
											<p><?php echo $value;?></p>
							<?php
									    }

									} else {
							?>
										<p><?php echo $official[10]['official_position'];?></p>
							<?php
									}
							?>
						
						</div>
						<div class="update">
							<input type="text" name="10_name" value="<?php echo $official[10]['official_name'];?>">
							<input type="text" name="10_position" value="<?php echo $official[10]['official_position'];?>">
						</div>
					</div>
					<div style="border-radius:15px; border: 1px solid black; display: flex; flex-direction: column; align-items: center; background-color: #eff9af; padding: 10px; height: 70px; justify-content: space-between; width: 260px;">
						
						<div class="editing">
							<h4 style="font-size: 15px; padding-top:15px; margin: 0"><?php echo $official[11]['official_name'];?></h4>

							<?php
									if (strpos($official[11]['official_position'], ',') !== false) {								
									    $array1 = explode(',', $official[11]['official_position']);
									    foreach ($array1 as $value) {
							?>
											<p><?php echo $value;?></p>
							<?php
									    }

									} else {
							?>
										<p><?php echo $official[11]['official_position'];?></p>
							<?php
									}
							?>
						
						</div>
						<div class="update">
							<input type="text" name="11_name" value="<?php echo $official[11]['official_name'];?>">
							<input type="text" name="11_position" value="<?php echo $official[11]['official_position'];?>">
						</div>
					</div>
				</div>
				<div id="actionbutton" style="align-items:center; justify-content:flex-end; margin: 20px; margin-top: 0px; display: flex; flex-direction: row; column-gap: 10px; width: 100%">
					<button onClick="showDivs()" class="btn" style="color:black; box-shadow: 4px 3px black; border-radius: 10px; margin-left: 10px; font-size: 18px; padding: 5px 21px; background-color: #7ED957; height: 30px;"><i class="fa fa-edit" style="align-items:center; text-align:center; border: none;color: black;font-size: 16px;cursor: pointer;"></i> Edit</button>
					<button onClick="hideDivs()" class="btn" style="color:black; box-shadow: 4px 3px black; border-radius: 10px; font-size: 18px; padding:5px 10px; background-color: #ABE3F9; height: 30px;"><i class="fa fa-refresh" style="border: none;color: black;cursor: pointer;"></i> Update</button>
				</div>
			</div>


	</div>


	</div>

	<script src="js/scripts.js"></script>
    <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">


		$(document).ready(function() {

            var usertype = "<?php echo $_SESSION['user_type']; ?>";

            if (usertype == 'user') {
                document.getElementById("actionbutton").style.display = "none";

            } else {

                document.getElementById("actionbutton").style.display = "flex";
            }

			});


       $('.logout').click(function(){
                  $.ajax({
                    url: 'query/user.php',
                    type: 'POST',
                    data: { 
                        action_name:'logout', 
                    },
                    success: function(response){
                            window.location.href = 'index.php'; 
                    }
            });
          });


    function hideDivs() {

			var name_1 = $("input[name='1_name']").val();
			var position_1 = $("input[name='1_position']").val();
			var name_2 = $("input[name='2_name']").val();
			var position_2 = $("input[name='2_position']").val();
			var name_3 = $("input[name='3_name']").val();
			var position_3 = $("input[name='3_position']").val();
			var name_4 = $("input[name='4_name']").val();
			var position_4 = $("input[name='4_position']").val();
			var name_5 = $("input[name='5_name']").val();
			var position_5 = $("input[name='5_position']").val();
			var name_6 = $("input[name='6_name']").val();
			var position_6 = $("input[name='6_position']").val();
			var name_7 = $("input[name='7_name']").val();
			var position_7 = $("input[name='7_position']").val();
			var name_8 = $("input[name='8_name']").val();
			var position_8 = $("input[name='8_position']").val();
			var name_9 = $("input[name='9_name']").val();
			var position_9 = $("input[name='9_position']").val();
			var name_10 = $("input[name='10_name']").val();
			var position_10 = $("input[name='10_position']").val();
			var name_11 = $("input[name='11_name']").val();
			var position_11 = $("input[name='11_position']").val();


            $.ajax({
                url: 'query/official.php',
                type: 'POST',
                data: {
                	action_name: 'update',
                    name_1: name_1,
                    name_2: name_2,
                    name_3: name_3,
                    name_4: name_4,
                    name_5: name_5,
                    name_6: name_6,
                    name_7: name_7,
                    name_8: name_8,
                    name_9: name_9,
                    name_10: name_10,
                    name_11: name_11,
                    position_1: position_1,
                    position_2: position_2,
                    position_3: position_3,
                    position_4: position_4,
                    position_5: position_5,
                    position_6: position_6,
                    position_7: position_7,
                    position_8: position_8,
                    position_9: position_9,
                    position_10: position_10,
                    position_11: position_11
                },

                success: function(response) {
                    if(response == "success"){      
	                    alert('Data Updated');                              
                       location.reload();
                    }
                }
            });




        var divs = document.getElementsByClassName('update');
        for (var i = 0; i < divs.length; i++) {
            divs[i].style.display = 'none';
        }


        var divs1 = document.getElementsByClassName('editing');
        for (var i = 0; i < divs1.length; i++) {
            divs1[i].style.display = 'block';
        }
    }


    function showDivs() {


        var divs = document.getElementsByClassName('update');
        for (var i = 0; i < divs.length; i++) {
            divs[i].style.display = 'flex';
        }


        var divs1 = document.getElementsByClassName('editing');
        for (var i = 0; i < divs1.length; i++) {
            divs1[i].style.display = 'none';
        }
    }

    </script>
</body>
</html>
