<?php 
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include('query/db.php'); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css">

        <link href="css/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="styles.css">


    <title>Barangay Information Management System</title>
</head>
<body>

	<header>
		<div style="width: 20%; display: flex; justify-content: flex-start;">

	    <img src="./logo.png" style="width: 100px; height: 89px;" alt="" loading="lazy"  />
	    <a href="index.php"><i><h4 style="font-family:Bodoni FLF; line-height: 1.1; font-size:30px; font-weight: bold; margin: 0">Barangay <br/>Information</h4></i></a>
		</div>
		
		<div style="left: 405px; position:absolute; height: 80px; width: 1488px; background: white; display: flex; justify-content: flex-end">
		<button class="btn" style="box-shadow: 2px 2px black; border-radius: 50px; align-items:center; justify-content:center; display:flex; height:40px; border: 1px solid black; color: black; width:100px;" onclick="location.href='profile.php';"><?= ucwords($_SESSION['user_type']); ?> <span style="color: green; padding: 0 10px">●</span></button>
		</div>
	</header>

	<div class="parent"  style="height: 815px;">

	  <nav style="width:385px;">
	    <ul>
	        <li style="box-sizing:border-box; border: 1px solid black"><img src="./icons/home.png" width="30" height="30" alt="" loading="lazy" style="margin-right: 20px" />
	        	<a href="index.php">Dashboard</a>
	        </li>
	        <li style="box-sizing:border-box; border: 1px solid black"><img src="./icons/information.png" width="30" height="30" alt="" loading="lazy" style="margin-right: 20px" /><a href="information.php">Barangay Information</a>
	        </li>
	        <li style="box-sizing:border-box; border: 1px solid black"><img src="./icons/users.png" width="30" height="30" alt="" loading="lazy" style="margin-right: 20px" />
	        	<a href="official.php">Barangay Official</a>
	        </li>
	        <li style="box-sizing:border-box; border: 1px solid black" class="active"><img src="./icons/group.png" width="30" height="30" alt="" loading="lazy" style="margin-right: 20px" />
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
	   <style>
	   .btn:hover {
		background-color: #c8ff70;/* Darker green on hover */
        box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.2); /* Slight shadow on hover */
  		color: aquamarine; /* White text on hover */
	   }
  </style>
	  <div class="content" style="display: flex; flex-direction:column; row-gap: 20px; align-items: center; width: 80%; margin: 15px; padding: 10px">
			<button id="buttonAdd" class="btn" style="width:200px; height: 50px; margin:35px; color: black; border: 1px solid black;" onclick="openAddModal()">
				<i class="fa fa-plus" style=" border: 1px solid black; color: white; font-size: 16px; cursor: pointer; background-color: black; border-radius: 110%;">
					
				</i> Add Resident 
			</button>
			<style>
table, th{	
  border: 1px solid black;
  border-collapse: collapse;
}
</style>

	  			<h5 style=" display: flex;flex-direction: row;justify-content: flex-start;width: 100%;margin-bottom: -50px; font-size: 20px;">List of  Residents</h5>
	  		<table id="example" class="display" style=" justify-content:center; width:100%; height: 100%;">
		        <thead>
		            <tr>
		                <th style="text-align: center;">Name</th>
		                <th style="text-align: center;">Gender</th>
		                <th style="text-align: center;">Status</th>
		                <th style="text-align: center;">Tools</th>
		            </tr>
		        </thead>
		        <tbody>




                        <?php 
                            $query = "SELECT * FROM `resident`"; 
                            $result = mysqli_query($con, $query); 

                            if (mysqli_num_rows($result) > 0) :
                              while($row = mysqli_fetch_assoc($result)) :
                         ?>


                        <tr>
                            <td><?php echo $row["resident_fname"] . " " .$row["resident_mname"]. " ".$row["resident_lname"]. " " ; ?></td>
                            <td><?php echo $row["resident_gender"]; ?></td>

                            <td><?php echo ($row["resident_voter"] == "Active") ? '<span style="color: green; padding: 0 10px">●</span>' : '<span style="color: red; padding: 0 10px">●</span>'; ?></td>
                            


			                <td><button class="btn" style="background-color: #3BA6E3;" data-toggle="tooltip" data-placement="top" title="View Reservation" style="margin-right: 10px" type="button" class="btn btn-primary" data-id="<?php echo $row["resident_id"]; ?>" data-role="view"> View
								</button>
								<button style="background-color: #E60012;" data-toggle="tooltip" data-placement="top" title="Delete" type="button" class="delete btn btn-danger" data-id="<?php echo $row["resident_id"]; ?>"> Delete
								</button>
							</td>                               
                        </tr>

                         <?php 
                              endwhile;
                            endif; 
                          ?>


		        </tbody>
		    </table>


	  	</div>




	  </div>

	</div>

            <!-- Add Modal -->
            <div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" style="margin: 0 auto;" id="exampleModalLabel">NEW RESIDENT</h5>
                    <button type="button" class="close" onclick="closeAddModal()" aria-label="Close">

                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="card shadow-xl border-0 rounded-lg mt-12">
                        <div class="card-body">
                            <form action='query/residents.php' method='post' id='myform'>
                            <input id="action_name"  name="action_name" type="hidden"  value="add" />

                                <div class="row mb-12">

                                    <div class="col-md-6">

                                          <div class="form-group row mb-3">
										    <label for="lastname" class="col-sm-4 col-form-label">Last Name</label>
										    <div class="col-sm-8">
											    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name">
										    </div>
										  </div>


                                          <div class="form-group row mb-3">
										    <label for="firstname" class="col-sm-4 col-form-label">First Name</label>
										    <div class="col-sm-8">
											    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name">
										    </div>
										  </div>


                                          <div class="form-group row mb-3">
										    <label for="middlename" class="col-sm-4 col-form-label">Middle Name</label>
										    <div class="col-sm-8">
											    <input type="text" class="form-control" id="middlename" name="middlename" placeholder="Middle Name">
										    </div>
										  </div>



                                          <div class="form-group row mb-3">
										    <label for="gender" class="col-sm-4 col-form-label">Gender</label>
										    <div class="col-sm-8">
											    <select class="form-select" name="gender" id="gender">
	                                                <option value='Male'> Male</option>
	                                                <option value='Female'> Female</option>                            
	                                            </select>
											</div>
										  </div>


                                          <div class="form-group row mb-3">
										    <label for="status" class="col-sm-4 col-form-label">Marital Status</label>
										    <div class="col-sm-8">
											    <select class="form-select" name="status" id="status">
	                                                <option value='Single'> Single</option>
	                                                <option value='Married'> Married</option>                            
	                                            </select>
											</div>
										  </div>


                                          <div class="form-group row mb-3">
										    <label for="spouse" class="col-sm-4 col-form-label">Name of Spouse</label>
										    <div class="col-sm-8">
											    <input type="text" class="form-control" id="spouse" name="spouse" placeholder="Name of Spouse">
										    </div>
										  </div>

                                          <div class="form-group row mb-3">
										    <label for="purok" class="col-sm-4 col-form-label">Purok</label>
										    <div class="col-sm-8">
											    <select class="form-select" name="purok" id="purok">
	                                                <option value='1'> 1</option>
	                                                <option value='2'> 2</option>         
													<option value='3'> 3</option>  
													<option value='4'> 4</option>  
													<option value='5'> 5</option>  
													<option value='6'> 6</option>                     
	                                            </select>
											</div>
										  </div>


                                          <div class="form-group row mb-3">
										    <label for="empstatus" class="col-sm-4 col-form-label">Employment Status</label>
										    <div class="col-sm-8">
											    <input type="text" class="form-control" id="empstatus" name="empstatus" placeholder="Employment Status">
										    </div>
										  </div>
                                    </div>
                                	
                                    <div class="col-md-6 ml-3">


                                          <div class="form-group row mb-3">
										    <label for="birthdate" class="col-sm-4 col-form-label">Birthdate</label>
										    <div class="col-sm-8">
											    <input type="date" class="form-control" id="birthdate"  name="birthdate" placeholder="Birthdate">
										    </div>
										  </div>

                                          <div class="form-group row mb-3">
										    <label for="birthplace" class="col-sm-4 col-form-label">Place of Birth</label>
										    <div class="col-sm-8">
											    <input type="text" class="form-control" id="birthplace" name="birthplace" placeholder="Place of Birth">
										    </div>
										  </div>

                                          <div class="form-group row mb-3">
										    <label for="age" class="col-sm-4 col-form-label">Age</label>
										    <div class="col-sm-8">
											    <input type="number" class="form-control" id="age" name="age" placeholder="Age">
										    </div>
										  </div>


                                          <div class="form-group row mb-3">
										    <label for="height" class="col-sm-4 col-form-label">Height in (CM)</label>
										    <div class="col-sm-8">
											    <input type="text" class="form-control" id="height"  name="height" placeholder="Height in (CM)">
										    </div>
										  </div>


                                          <div class="form-group row mb-3">
										    <label for="weight" class="col-sm-4 col-form-label">Weight in (KG)</label>
										    <div class="col-sm-8">
											    <input type="text" class="form-control" id="weight" name="weight" placeholder="Weight in (KG)">
										    </div>
										  </div>


                                          <div class="form-group row mb-3">
										    <label for="religion" class="col-sm-4 col-form-label">Religion</label>
										    <div class="col-sm-8">
											    <input type="text" class="form-control" id="religion" name="religion" placeholder="Religion">
										    </div>
										  </div>


                                          <div class="form-group row mb-3">
										    <label for="nationality" class="col-sm-4 col-form-label">Nationality</label>
										    <div class="col-sm-8">
											    <input type="text" class="form-control" id="nationality"  name="nationality" placeholder="Nationality">
										    </div>
										  </div>


                                          <div class="form-group row mb-3">
										    <label for="voter" class="col-sm-4 col-form-label">Voter Status</label>
										    <div class="col-sm-8">
											    <select class="form-select" name="voter" id="voter">
	                                                <option value='Active'> Active</option>
	                                                <option value='Inactive'> Inactive</option>                            
	                                            </select>
										    </div>
										  </div>



                                          <div class="form-group row mb-3">

										    <label class="col-sm-4 col-form-label"></label>

										    <div class="col-sm-8">
											  <input class="form-check-input" type="checkbox" value="1" id="pwd" name="pwd">
										    <label for="pwd" class="col-sm-4 col-form-label">Person with Disability</label>
										    </div>
										  </div>                                    	
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                  </div>
                  <div class="modal-footer">
				  <style>
	   .btn-primary:hover, .btn-primary.hover {
  /* Same hover effect styles as before */
  background-color: gray;
  color: white;
  border-color: #4CAF50;
  cursor: pointer;
}

.btn-danger:hover {
  /* Hover effect styles */
  background-color: gray; /* Change background color on hover to a darker red */
  color: white; /* Change text color on hover */
  border-color: #d33; /* Change border color on hover (optional) */
  cursor: pointer; /* Indicate clickable element on hover */
}
  </style>
                    <button type="button" class="btn btn-primary" id="addResidents">
                    	<i class="fa fa-refresh" style="color: black"></i>
                    	Update
                    </button>
                    <button type="button" class="btn btn-danger"  onclick="closeAddModal()">
                    	<i class="fa fa-close" style="color: black"></i>
                    Close</button>
                  </div>
                </div>
              </div>
            </div>




            <!-- View Modal -->
            <div class="modal fade" id="ViewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" style="margin: 0 auto;" id="exampleModalLabel">RESIDENT PROFILE</h5>
                    <button type="button" class="close" onclick="closeAddModal()" aria-label="Close">

                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="card shadow-xl border-0 rounded-lg mt-12">
                        <div class="card-body">
                            <form action='query/residents.php' method='post' id='myform2'>
                            <input id="action_name"  name="action_name" type="hidden"  value="view" />

                                <div class="row mb-12">

                                    <div class="col-md-6">

                                          <div class="form-group row mb-3">
										    <label for="lastname" class="col-sm-4 col-form-label">Last Name</label>
										    <div class="col-sm-8">
											    <input readonly type="text" class="form-control" id="view_lastname" name="view_lastname" placeholder="Last Name">
										    </div>
										  </div>


                                          <div class="form-group row mb-3">
										    <label for="firstname" class="col-sm-4 col-form-label">First Name</label>
										    <div class="col-sm-8">
											    <input readonly type="text" class="form-control" id="view_firstname" name="view_firstname" placeholder="First Name">
										    </div>
										  </div>


                                          <div class="form-group row mb-3">
										    <label for="middlename" class="col-sm-4 col-form-label">Middle Name</label>
										    <div class="col-sm-8">
											    <input readonly type="text" class="form-control" id="view_middlename" name="view_middlename" placeholder="Middle Name">
										    </div>
										  </div>



                                          <div class="form-group row mb-3">
										    <label for="gender" class="col-sm-4 col-form-label">Gender</label>
										    <div class="col-sm-8">
											    <select readonly class="form-select" name="view_gender" id="view_gender" style="pointer-events: none;">
	                                                <option value='Male'> Male</option>
	                                                <option value='Female'> Female</option>                            
	                                            </select>
											</div>
										  </div>


                                          <div class="form-group row mb-3">
										    <label for="status" class="col-sm-4 col-form-label">Marital Status</label>
										    <div class="col-sm-8">
											    <select readonly class="form-select" name="view_status" id="status" style="pointer-events: none;">
	                                                <option value='Single'> Single</option>
	                                                <option value='Married'> Married</option>                            
	                                            </select>
											</div>
										  </div>


                                          <div class="form-group row mb-3">
										    <label for="spouse" class="col-sm-4 col-form-label">Name of Spouse</label>
										    <div class="col-sm-8">
											    <input readonly type="text" class="form-control" id="view_spouse" name="view_spouse" placeholder="Name of Spouse">
										    </div>
										  </div>

                                          <div class="form-group row mb-3">
										    <label for="purok" class="col-sm-4 col-form-label">Purok</label>
										    <div class="col-sm-8">
											    <select readonly class="form-select" name="view_purok" id="view_purok" style="pointer-events: none;pointer-events: none;">
	                                                <option value='1'> 1</option>
	                                                <option value='2'> 2</option>
													<option value='3'> 3</option>   
													<option value='4'> 4</option>   
													<option value='5'> 5</option>   
													<option value='6'> 6</option>                               
	                                            </select>
											</div>
										  </div>


                                          <div class="form-group row mb-3">
										    <label for="empstatus" class="col-sm-4 col-form-label">Employment Status</label>
										    <div class="col-sm-8">
											    <input readonly type="text" class="form-control" id="view_empstatus" name="view_empstatus" placeholder="Name of Spouse">
										    </div>
										  </div>
                                    </div>
                                	
                                    <div class="col-md-6 ml-3">


                                          <div class="form-group row mb-3">
										    <label for="birthdate" class="col-sm-4 col-form-label">Birthdate</label>
										    <div class="col-sm-8">
											    <input readonly type="date" class="form-control" id="view_birthdate"  name="view_birthdate" placeholder="Birthdate">
										    </div>
										  </div>

                                          <div class="form-group row mb-3">
										    <label for="birthplace" class="col-sm-4 col-form-label">Place of Birth</label>
										    <div class="col-sm-8">
											    <input readonly type="text" class="form-control" id="view_birthplace" name="view_birthplace" placeholder="Place of Birth">
										    </div>
										  </div>

                                          <div class="form-group row mb-3">
										    <label for="age" class="col-sm-4 col-form-label">Age</label>
										    <div class="col-sm-8">
											    <input readonly type="number" class="form-control" id="view_age" name="view_age" placeholder="Age">
										    </div>
										  </div>


                                          <div class="form-group row mb-3">
										    <label for="height" class="col-sm-4 col-form-label">Height in (CM)</label>
										    <div class="col-sm-8">
											    <input readonly type="text" class="form-control" id="view_height"  name="view_height" placeholder="Height in (CM)">
										    </div>
										  </div>


                                          <div class="form-group row mb-3">
										    <label for="weight" class="col-sm-4 col-form-label">Weight in (KG)</label>
										    <div class="col-sm-8">
											    <input readonly type="text" class="form-control" id="view_weight" name="view_weight" placeholder="Weight in (KG)">
										    </div>
										  </div>


                                          <div class="form-group row mb-3">
										    <label for="religion" class="col-sm-4 col-form-label">Religion</label>
										    <div class="col-sm-8">
											    <input readonly type="text" class="form-control" id="view_religion" name="view_religion" placeholder="Religion">
										    </div>
										  </div>


                                          <div class="form-group row mb-3">
										    <label for="nationality" class="col-sm-4 col-form-label">Nationality</label>
										    <div class="col-sm-8">
											    <input readonly type="text" class="form-control" id="view_nationality"  name="view_nationality" placeholder="Nationality">
										    </div>
										  </div>


                                          <div class="form-group row mb-3">
										    <label for="voter" class="col-sm-4 col-form-label">Voter Status</label>
										    <div class="col-sm-8">
											    <select readonly class="form-select" name="view_voter" id="view_voter" style="pointer-events: none;">
	                                                <option value='Active'> Active</option>
	                                                <option value='Inactive'> Inactive</option>                            
	                                            </select>
										    </div>
										  </div>



                                          <div class="form-group row mb-3">

										    <label class="col-sm-4 col-form-label"></label>

										    <div class="col-sm-8">
											<input class="form-check-input" readonly type="checkbox" value="1"  id="view_pwd" name="view_pwd">

											<label class="form-check-label" for="pwd">Person with Disability</label>



										    </div>
										  </div>                                    	
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger"  onclick="closeAddModal()">
                    	<i class="fa fa-close" style="color: black"></i>
                    Close</button>
                  </div>
                </div>
              </div>
            </div>


        <script src="js/all.js"></script>
        <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="js/simple-datatables.min.js"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script src="js/jquery-3.6.0.min.js"></script>

	<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
	<script type="text/javascript">
		// new DataTable('#example');
		$(document).ready(function() {
			$('#example').dataTable({
			    // "bPaginate": false,
			    "bLengthChange": false,
			    "bFilter": true,
			    "bInfo": false});
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
		$(document).ready(function() {

            var usertype = "<?php echo $_SESSION['user_type']; ?>";

            if (usertype == 'user') {
                document.getElementById("buttonAdd").style.display = "none";

            } else {

                document.getElementById("buttonAdd").style.display = "block";
            }

			});

            function openAddModal() {
                document.getElementById("myform").reset();
                $('#AddModal').modal('show');
            }

            function closeAddModal() {
                $('#AddModal').modal('hide');
                $('#UpdateModal').modal('hide');
                $('#ViewModal').modal('hide');
            }


            $('#addResidents').click(function(){
                $.post($('#myform').attr('action'),
                    $('#myform :input').serializeArray(),
                        function(result){
                            if (result == 'success') {
                                alert('Resident Added');    
                            } else {
                                alert(result);
                            } 
                            location.reload();
                        }
                );
            });

            $(document).on('click', 'button[data-role=view]', function() {
                var id = $(this).data('id');
                
			    document.getElementById('myform2').reset();
                            
                $.ajax({
                        url: 'query/residents.php',
                        type: 'POST',
                        data: { 
                            action_name:'select', 
                            id:id
                        },
                        success: function(data){

							document.getElementById('view_pwd').addEventListener('click', function(event) {
							    event.preventDefault();
							});

                            $.each(JSON.parse(data), function(index, item) {
                            	console.log(item)

                               $("#view_lastname").val(item.resident_lname);
                               $("#view_firstname").val(item.resident_fname);
                               $("#view_middlename").val(item.resident_mname);
                               $("#view_gender").val(item.resident_gender);
                               $("#view_status").val(item.resident_status);
                               $("#view_spouse").val(item.resident_spouse);
                               $("#view_purok").val(item.resident_address);
                               $("#view_empstatus").val(item.resident_employment);
                               $("#view_birthdate").val(item.resident_birthdate);
                               $("#view_birthplace").val(item.resident_placebirth);
                               $("#view_age").val(item.resident_age);
                               $("#view_height").val(item.resident_height);
                               $("#view_weight").val(item.resident_weight);
                               $("#view_religion").val(item.resident_religion);
                               $("#view_nationality").val(item.resident_nationality);
                               $("#view_voter").val(item.resident_voter);

                               if (item.resident_pwd == 1) {
								   document.getElementById('view_pwd').checked = true;
                               } else {
								   document.getElementById('view_pwd').checked = false;
                               }

                            });

                        }
                });
                $('#ViewModal').modal('show');
            });


            $(document).ready(function(){

                $('.delete').click(function(){
                    var el = this;
                    var deleteid = $(this).data('id');

                    var confirmalert = confirm("Are you sure you want to delete resident?");
                    if (confirmalert == true) {
                        $.ajax({
                            url: 'query/residents.php',
                            type: 'POST',
                            data: { 
                            action_name:'delete', 
                            id:deleteid
                            },
                            success: function(response){
				            	alert("Resident successfully deleted!");
                                if(response == 1){                                    
                                    location.reload();
                                }
                            }
                        });
                    }
                });




            });

	</script>

</body>
</html>
