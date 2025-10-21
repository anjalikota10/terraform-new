<?php
session_start();
$conn=mysqli_connect("db","vertex", "vertex123" , "wedmegood");
 if($conn)
 {
    // echo"Connected";
 }
 else
 {
    // echo"Connection fail".mysqli_connect_error();
 }
?>


<?php
$msg="";
 if(isset($_POST['signup']))
 { 

    $email=$_POST['email'];
	  $name=$_POST['name'];
    $password=$_POST['password'];
    $cpassword=$_POST['cpassword']; 

    $sql="select count(id) from registration where email='$email'";
    
    $res=mysqli_query($conn,$sql);
    $count=mysqli_fetch_row($res);
    if($count[0]==1)
    {
      echo "<script>alert('Already registered')</script>";
    }
    else
    {
    if($password==$cpassword)
    {
      $query="insert into registration(email,name,password,cpassword) values('$email','$name','$password','$cpassword')";

      if(mysqli_query($conn,$query))
      {
      echo "<script>alert('Registration Successful')</script>";
      }
      else{
        echo "error".$conn->error;
      }
    }
    else
    {
       $msg="password and confirm password doesnt match";
    }
  }
 }


   
?>

<?php

if(isset($_POST['login']))
{

  $email=$_POST['email'];
  $password=$_POST['password'];
  $query="select * from registration where email='$email' && password='$password' ";
  $data=mysqli_query($conn,$query);
  $total=mysqli_num_rows($data);
  if($total==1)
  {
    $_SESSION['wed']=$email;
    echo"<script> alert('login successfully')
     window.location.href='registration.php'</script>";
  }
  else
  {
    echo"<script> alert('login Failed')</script>";
  }

}

?>

<!DOCTYPE html>
<head>
	<title>Login</title>
	<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<style>
		body {
			margin: 0;
			padding: 0;
			display: flex;
			justify-content: center;
			align-items: center;
			min-height: 100vh;
			font-family: 'Jost', sans-serif;
			background: linear-gradient(to bottom, #FF7F00, #E72E77);
		} 
		.main {
			width: 350px;
			height: 480px;
			background: red;
			overflow: hidden;
			background: url("https://doc-08-2c-docs.googleusercontent.com/docs/securesc/68c90smiglihng9534mvqmq1946dmis5/fo0picsp1nhiucmc0l25s29respgpr4j/1631524275000/03522360960922298374/03522360960922298374/1Sx0jhdpEpnNIydS4rnN4kHSJtU1EyWka?e=view&authuser=0&nonce=gcrocepgbb17m&user=03522360960922298374&hash=tfhgbs86ka6divo3llbvp93mg4csvb38") no-repeat center/cover;
			border-radius: 10px;
			box-shadow: 5px 20px 50px #000;
		}
		#chk {
			display: none;
		}
		.signup {
			position: relative;
			width: 100%;
			height: 600px;
		}
		label {
			color: #fff;
			font-size: 2.3em;
			justify-content: center;
			display: flex;
			margin: 10px;
			font-weight: bold;
			cursor: pointer;
			transition: .5s ease-in-out;
		}
		input {
			width: 65% !important;
			height: 20px;
			background: #e0dede;
			justify-content: center;
			display: flex;
			margin: 20px auto;
			padding: 10px;
			border: none;
			outline: none;
			border-radius: 5px;
		}
		input[type="password"] {
			margin-left: 50px !important;
			width: 70px;
		}
		.password-icon {
			position: absolute;
			right: 70px;
			top: 45%;
			transform: translateY(-50%);
			cursor: pointer;
			color: #888;
		}
		button {
			width: 60%;
			height: 40px;
			margin: 10px auto;
			justify-content: center;
			display: block;
			color: #fff;
			background: #E72E77;
			font-size: 1em;
			font-weight: bold;
			margin-top: 20px;
			outline: none;
			border: none;
			border-radius: 5px;
			transition: .2s ease-in;
			cursor: pointer;
		}
		button:hover {
			background: #E72E77;
		}
		.login {
			height: 250px;
			background: #eee;
			border-radius: 60% / 10%;
			transform: translateY(-180px);
			transition: .8s ease-in-out;
		}
		.login label {
			color: #E72E77;
			transform: scale(.6);
		}
		#chk:checked ~ .login {
			transform: translateY(-500px);
		}
		#chk:checked ~ .login label {
			transform: scale(1);	
		}
		#chk:checked ~ .signup label {
			transform: scale(.6);
		}
	</style>
</head>
<body>
	<div class="main">  
		<input type="checkbox" id="chk" aria-hidden="true">
			<div class="signup">
				<form method='POST' enctype="multipart/form-data" autocomplete="off">
					<label style="color:#E72E77;">Registration</label>
					<input type="email" name="email" title="Enter valid Email" placeholder="Email" required="">
					<input type="text" name="name" maxlength="32" pattern="[A-Za-z ]+" title="Enter valid name" placeholder="Full Name" required="">
					<div class="password-wrapper">
						<input type="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?!.*\s).{8,}" id="password" title="Password must contain at least 8 characters, including one uppercase letter, one lowercase letter, one digit, and one special character. No spaces allowed." placeholder="Password" required="">
						<i class="fas fa-eye-slash password-icon" onclick="togglePassword()"></i>
					</div>
					<input type="password" name="cpassword" placeholder="Confirm Password" required="">
					<button name="signup">Sign up</button>
				</form>
			</div>
			<div class="login">
				<form method='POST'>
					<label for="chk" aria-hidden="true">Login</label>
					<input type="email" name="email" placeholder="Email" required="">
					<input type="password" name="password" placeholder="Password" required="">
					<button name="login">Login</button>
				</form>
			</div>
	</div>
</body>

<script>
function togglePassword() {
  var passwordField = document.getElementById("password");
  var icon = document.querySelector(".password-icon");
  
  if (passwordField.type === "password") {
    passwordField.type = "text";
    icon.classList.remove("fa-eye-slash");
    icon.classList.add("fa-eye");
  } else {
    passwordField.type = "password";
    icon.classList.remove("fa-eye");
    icon.classList.add("fa-eye-slash");
  }
}
</script>
</html>
