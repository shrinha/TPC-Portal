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

$query2 = "Select cpi From stud_acad  where Roll_Number='$roll'";
$result2= mysqli_query($conn,$query2);
$row2=mysqli_fetch_assoc($result2);
$cpi=$row2["cpi"];



$query3 = "Select ctc From stud_personal where Roll='$roll'";
$result3= mysqli_query($conn,$query3);
$row3=mysqli_fetch_assoc($result3);
$ctc=$row3["ctc"];


$query = "select c.cid,c.name,j.j_title,j.j_location,c.year, j.cpi,j.ctc,j.j_category from company c natural join job j where ( j.ctc > '$ctc' and j.cpi < $cpi ) order by ctc desc; ";
$result= mysqli_query($conn,$query);
$row=mysqli_fetch_assoc($result);




?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	</head>
	<body class="loggedin" >
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
			<h2>Companies You are Eligible For :</h2>
			<div>
			
				<table class="table"> 

					<thead>
						<tr>
							<th>Name</th>
							<th>Role</th>
							<th>Location</th>
							<th>Year</th>
							<th>CPI Cutoff</th>
							<th>CTC</th>
							<th>Domain</th>
						</tr>
					</thead>	
					
					
					<tr>
                            <td><?=$row['name']?></td>
                            <td><?=$row['j_title']?>  </td>
							<td><?=$row['j_location']?>  </td>
                            <td><?=$row['year']?>  </td>
							<td><?=$row['cpi']?>  </td>
							<td><?=$row['ctc']?>  </td>
							<td><?=$row['j_category']?>  </td>
                        </tr>

                <?php
                    while($row = $result->fetch_assoc()){
                        echo "<tr>
                            <td>" . $row["name"] . "</td>
                            <td>" . $row["j_title"] . "  </td>
							<td>" . $row["j_location"] . "  </td>
							<td>" . $row["year"] . "</td>
                            <td>" . $row["cpi"] . "  </td>
							<td>" . $row["ctc"] . "  </td>
							<td>" . $row["j_category"] . "  </td>
                            
                        </tr>";
                    }
                ?>
				
                </table>
			</div>
		</div>





	</body>
</html>
