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

$roll = $_SESSION['name'];

$query = "SELECT c.name, j.j_title, j.j_location, j.ctc, j.j_category
          FROM applications a
          JOIN company c ON a.Company_ID = c.cid
          JOIN job j ON a.Job_ID = j.jid
          WHERE a.Roll = '$roll'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
	<head>
        <link href="style.css" rel="stylesheet" type="text/css">
		<meta charset="utf-8">
		<title>Home Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Training & Placement Cell</h1>
				<a href="eligible_company.php"><i class="fas fa-briefcase"></i>Eligible Companies</a>
				<a href="companylist.php"><i class="fas fa-archive"></i>Company Listing</a>
				<a href="profile_check.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Home Page</h2>
			<p>Welcome back, <?=$_SESSION['name']?>!</p>
			
			<h3>Jobs and Companies You've Applied To:</h3>
			<div>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Company Name</th>
							<th>Job Title</th>
							<th>Location</th>
							<th>CTC</th>
							<th>Category</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if (mysqli_num_rows($result) > 0) {
							while($row = mysqli_fetch_assoc($result)) {
								echo "<tr>
									<td>" . $row['name'] . "</td>
									<td>" . $row['j_title'] . "</td>
									<td>" . $row['j_location'] . "</td>
									<td>" . $row['ctc'] . "</td>
									<td>" . $row['j_category'] . "</td>
								</tr>";
							}
						} else {
							echo "<tr><td colspan='5'>No applications found.</td></tr>";
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>

<?php
mysqli_close($conn);
?>
