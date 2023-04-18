<?php
session_start();
if(!isset($_SESSION["login_sess"])) 
{
    
    header("location:login.php"); 
}

?>

<!DOCTYPE html>
<html>
	<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Registeration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Training & Placement Cell</h1>

				<a href="home.php"><i class="fas fa-user-circle"></i>back</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
                
			</div>
		</nav>
		<div class="content">
			<h2>Edit Your Profile</h2>
	      
			
</div>
<?php

if(isset($_POST["submit"])){
    extract($_POST);
    $email_old =$_SESSION['login_email'];

  $query10="DELETE FROM alumni where email='$email_old'";
  $query11 = "INSERT into alumni values ('$name','$roll_no','$contact_number','$passout_year','$cpi','$current_company','$ctc','$email','$password')";

  mysqli_query($con,$query10);
  $result1= mysqli_query($con,$query11);


if ($result1){
	echo
	"
	<script> alert('Data Edited Successfully'); </script>
	 ";
  header("Location: .\home.php");
  exit();
}  
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Insert Data</title>
  </head>
  <style media="screen">
    label{
      display: block;
    }
    
  </style>






  <body>


  <!-- <center> -->
  <form style="margin-top: 10%;padding: 30px;border-radius: 5px;" action="" method="POST">
        <p style="font-size: 30px;text-align: center; color:#fff;font-weight:bold">Fill the required</p>
  <div class="form-group">
    <label class="label_txt"></label>
    <input type="text" class="form-control" name="name" value="<?php if(isset($error)) {echo $lname;}?>" required="" placeholder="Name"><br></div>
    <br>
    <div class="form-group">
    <label class="label_txt"></label>
    <input type="text" class="form-control" name="roll_no" value="<?php if(isset($error)) {echo $email;}?>" required="" placeholder="Roll No"><br></div>
    <div class="form-group">
    <br>
    <label class="label_txt"></label>
    <input type="phone" class="form-control" name="contact_number-" required="" placeholder="Contact number"><br></div>
    <div class="form-group">
    <br>
    <label class="label_txt"></label>
    <input type="text" class="form-control" name="passout_year" required="" placeholder="Passout year"><br></div>
    <br>
    <div class="form-group">
    <label class="label_txt"></label>
    <input type="text" class="form-control" name="cpi" required="" placeholder="CPI"><br></div>
    <br>
    <div class="form-group">
    <label class="label_txt"></label>
    <input type="text" class="form-control" name="current_company" required="" placeholder="Current Company"><br></div>
    <br>
    <div class="form-group">
    <label class="label_txt"></label>
    <input type="text" class="form-control" name="ctc" required="" placeholder="CTC"><br></div>
    <br>
    <div class="form-group">
    <label class="label_txt"></label>
    <input type="email" class="form-control" name="email" required="" placeholder="Email"><br></div>
    <br>
    <div class="form-group">
    <label class="label_txt"></label>
    <input type="password" class="form-control" name="password" required="" placeholder="Password"><br></div>
    <br>
    <div class="form-group">
    <label class="label_txt"></label>
    <input type="password" class="form-control" name="passwordConfirm" required="" placeholder="Confirm Password"><br></div>
    <br>
  <button type="submit" name="signup" class="btn btn-primary btn-group-lg form_btn">Update</button>

</form>
<br>
<!-- </center> -->









  
  </body>
</html>
