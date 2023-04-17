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
$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}




$roll=$_SESSION['name'];

$query1 = "Select * From Accounts where Roll='$roll'";
$result1= mysqli_query($conn,$query1);
$row1=mysqli_fetch_assoc($result1);

$query2 = "Select * From stud_acad  where Roll_Number='$roll'";
$result2= mysqli_query($conn,$query2);
$row2=mysqli_fetch_assoc($result2);

$query3 = "Select * From stud_personal where Roll='$roll'";
$result3= mysqli_query($conn,$query3);
$row3=mysqli_fetch_assoc($result3);




?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile Page</title>
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
			<h2>Student Profile</h2>
			<div>
				<p>Your account details are below :</p>
				<table>
					<tr>
						<td>Roll Number </td>
						<td><?=$row1['Roll']?></td>
					</tr>
					
                    <tr>
						<td>Name</td>
						<td><?=$row3['Name']?></td>
					</tr>

                    <tr>
						<td>Email</td>
						<td><?=$row1['email']?></td>
					</tr>

                    <tr>
						<td>Age</td>
						<td><?=$row3['Age']?></td>
					</tr>

                    <tr>
						<td>Graduating Year</td>
						<td><?=$row3['Year']?></td>
					</tr>

                    <tr>
						<td>Branch</td>
						<td><?=$row2['Branch']?></td>
					</tr>

                    <tr>
						<td>Gender</td>
						<td><?=$row3['Gender']?></td>
					</tr>

                    <tr>
						<td>Contact</td>
						<td><?=$row3['Contact']?></td>
					</tr>

            
                    <tr>
						<td>Class 10 Marks</td>
						<td><?=$row2['Class 10 Marks']?></td>
					</tr>

                    <tr>
						<td>Class 12 Marks</td>
						<td><?=$row2['Class 12 Marks']?></td>
					</tr>

                    <tr>
						<td>CPI</td>
						<td><?=$row2['CPI']?></td>
					</tr>

                    <tr>
						<td>Area of Interest</td>
						<td><?=$row2['Area of Interest']?></td>
					</tr>

				
				</table>
			</div>
		</div>


   <h4>To edit your data, Click <a href= 'edit_data.php'>here.</a><h4> 



	</body>
</html>
