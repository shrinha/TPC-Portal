<?php
session_start();
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$cid = $_POST['cid'];
	$jid = $_POST['jid'];
	$roll = $_POST['roll'];

	// Check if the roll, company ID, and job ID combination already exists
	$check_query = "SELECT * FROM applications WHERE Roll='$roll' AND Company_ID='$cid' AND Job_ID='$jid'";
	$check_result = mysqli_query($conn, $check_query);

	if (mysqli_num_rows($check_result) > 0) {
		echo "You have already applied to this job at this company.";
	} else {
		$query = "INSERT INTO applications (Roll, Company_ID, Job_ID) VALUES ('$roll', '$cid', '$jid')";
		if (mysqli_query($conn, $query)) {
			echo "Application successful!";
		} else {
			echo "Error: " . mysqli_error($conn);
		}
	}
	echo '<br><a href="./home.php">Click here to go to home</a>';
}

mysqli_close($conn);
?>
