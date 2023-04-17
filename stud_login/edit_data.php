<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'SHREY2002';
$DATABASE_NAME = 'php_test';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title> Profile Page </title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Training & Placement Cell</h1>
                <a href="eligible_company.php"><i class="fas fa-briefcase"></i>Eligible Companies</a>
				<a href="companylist.php"><i class="fas fa-archive"></i>Company Listing</a>
				<a href="view_data.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
                
			</div>
		</nav>
		<div class="content">
			<h2>Edit Your Profile</h2>
			
				<p>Please Provide all the details Below :</p>
				
			
</div>



<?php

if(isset($_POST["submit"])){
  $roll = $_SESSION['name'];
  $name = $_POST["name"];
  $age = $_POST["age"];
  $year = $_POST["year"];
  $gender = $_POST["gender"];
  $contact = $_POST["contact"];
  $ctc =$_POST["ctc"];

  $branch = $_POST["branch"];
  $marks_10 =$_POST["marks_10"];
  $marks_12 =$_POST["marks_12"];
  $cpi =$_POST["cpi"];
  $aoi =$_POST["aoi"];

  $query10="DELETE FROM stud_personal where Roll='$roll'";
  $query11 = "INSERT INTO stud_personal VALUES('$roll','$name', '$age','$year', '$gender', '$contact', '$ctc')";

  mysqli_query($con,$query10);
  $result1= mysqli_query($con,$query11);

  $query20="DELETE FROM stud_acad where Roll_Number='$roll'";
  $query21 = "INSERT INTO stud_acad VALUES('$roll','$branch', '$marks_10', '$marks_12', '$cpi','$aoi')";

  mysqli_query($con,$query20);
  $result2= mysqli_query($con,$query21);



  
  // echo
  // "
  // <script> alert('Data Inserted Successfully'); </script>
//   // ";
//   if ($result) {
//     echo "<div class='form'>
//           <h3>You are registered successfully.</h3><br/>
//           <p class='link'>Click here to <a href='User_landing.php'>Login</a></p>
//           </div>";
// } else {
//     echo "<div class='form'>
//           <h3>Required fields are missing.</h3><br/>
//           <p class='link'>Click here to <a href='index.php'>registration</a> again.</p>
//           </div>";
// }


if ($result1 and $result2){
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



  <body><center>

  <!-- <h1> Profile</h1> -->
    <form class="" action="" method="post" autocomplete="off" >

    

      <fieldset>
        <Legend> Personal Information </Legend>
      <!-- <label for=""> Roll Number </label>
      <input type="text" name="roll" required value="" placeholder="Roll Number">
      <br> -->

      <label for="">Name</label>
      <input type="text" name="name" required value="" placeholder="Name">
      <br>

      <label for="">Age</label>
      <input type="number" name="age" required value="" placeholder="Age">
      <br>
      <label for="">Graduating Year<br></label>
      <input type="text" name="year" required value="" placeholder="Graduating Year">
      <label for="">Contact<br></label>
      <input type="text" name="contact" required value="" placeholder="Contact Number" >

      <label for="">CTC of Package( Enter 0 if not placed.)</label>
      <input type="number" name="ctc" required value="">

      <label for="">Gender</label>
      <input type="radio" name="gender" value="Male" required> Male
      <input type="radio" name="gender" value="Female"> Female
      <input type="radio" name="gender" value="Other"> Other

      


     
  </fieldset>
      <br>




  <fieldset>
    <Legend>Academic </Legend>
    
    <label for="">Branch</label>
      <select id="branch" name="branch">
        <option value="NULL"> </option>
        <option value="CSE"> Btech CSE</option>
        <option value="AI & DS"> Btech AI & DS</option>
        <option value="MnC"> BS MnC</option>
        <option value="EEE"> Btech EEE</option>
        <option value="ME"> Btech Mechanical</option>
        <option value="CEE"> Btech Civil </option>
        <option value="CH"> Btech Chemical Engineering</option>
        <option value="MME"> Btech Materials & Metallurgical</option>
        
  </select>

    <label for="">Class 10 Marks</label>
      <input type="text" name="marks_10" required value="">

    
      <label for="">Class 12 Marks</label>
      <input type="text" name="marks_12" required value="">
      
      
    <label for="">CPI</label>
      <input type="text" name="cpi" required value="">



      <label for="">Area of Interest</label>
      <input type="text" name="aoi" required value="">
  </fieldset>


  <br>
  <br>
      <button type="submit" name="submit">Submit</button>
    </form></center>
  </body>
</html>










	</body>
</html>