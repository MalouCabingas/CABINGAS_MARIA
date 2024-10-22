<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Barangay Information Management System</title>
    <style>

    </style>
</head>
<body>
    <div style="display: flex; flex-direction: row; align-items: flex-start; justify-content: flex-start; padding: 5px;">
            <img src="./logo.png" style="margin-left: 9px; margin-top: 10px; width: 100px; background: white;margin-right:18px ;" alt="" loading="lazy" class="logo" />
            <h2 style="font-size: 30px;font-weight:bold; font-style: oblique; border: 2px solid black; padding: 15px">Barangay Information Management System </h2>
        </div>

	<div class="" style="display: flex; flex-direction: column; align-items: center; background-image: url(2.jpg); margin: 5px; height: 800px; ">
        <div  style="border: 5px black solid;  display: flex; flex-direction: column; align-items: center; padding: 30px; row-gap: 50px; background-color: white;  width: 400px; justify-content: center; margin: 50px; padding: 5px;">
            
		
    		<div style="display: flex; flex-direction: column; align-items: center; row-gap: 50px; background-color: white; justify-content: center; padding: 5px; width: 97%">

    			<div style="display:flex; justify-content: center; border-bottom: 3px solid black; width: 80%;">
    				<h2>Registration</h2>
    			</div>
    				
                <form action="query/user.php" id="myform" method='post' style="display: flex; flex-direction:column; align-items: center; row-gap: 35px">
                    <input id="action_name"  name="action_name" type="hidden"  value="add" />
                    <div >
                        <input name="user_name" id="user_name" type="text" placeholder=" Enter your Name" style="border: 1px black solid; border-radius: 20px; height: 30px; width: 250px;  text-align: center" />
                    </div>

                    <div>
                        <input name="user_email" id="user_email" type="email" placeholder="Enter your Email" style="border: 1px black solid; border-radius: 20px; height: 30px; width: 250px;  text-align: center" />
                    </div>
                    <div  >
                        <input name="user_password" id="user_password" type="password" style="border: 1px black solid; border-radius: 20px; height: 30px; width: 250px; text-align: center"   placeholder="Create a password" />
                    </div>
                    <div  >
                        <input name="user_password_confirm" id="user_password_confirm" type="password" style="border: 1px black solid; border-radius: 20px; height: 30px; width: 250px; text-align: center"   placeholder="Confirm a password" />
                    </div>

                    <button type="botton" style="background: #E4F577; width: 200px; height: 30px;" id="addUser">Register Now</button>
                    <div style="margin-bottom: 50px">
                        <a  style="text-decoration: none; color: black;">Already have an Account ? </a>
                        <a class="btn btn-primary" href="login.php" style="color: blue;">Log in now</a>
                    </div>
                </form>
    		</div>

        </div>

	</div>
    <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/jquery-3.6.0.min.js"></script>

    <script type="text/javascript">

        $('#addUser').click(function(){
            $.post($('#myform').attr('action'),
                $('#myform :input').serializeArray(),
                    function(result){
                        if (result == 'success') {
                            alert('User Added');    
                        } else {
                            alert(result);
                        } 
                        location.reload();
                    }
            );
        });

    </script>

</body>
</html>
