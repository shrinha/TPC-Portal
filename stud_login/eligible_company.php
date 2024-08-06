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

$query2 = "SELECT cpi FROM stud_acad WHERE Roll_Number='$roll'";
$result2 = mysqli_query($conn, $query2);
$row2 = mysqli_fetch_assoc($result2);
$cpi = $row2["cpi"];

$query3 = "SELECT ctc FROM stud_personal WHERE Roll='$roll'";
$result3 = mysqli_query($conn, $query3);
$row3 = mysqli_fetch_assoc($result3);
$ctc = $row3["ctc"];

$query = "SELECT c.cid, c.name, j.jid, j.j_title, j.j_location, c.year, j.cpi, j.ctc, j.j_category 
          FROM company c 
          NATURAL JOIN job j 
          WHERE j.ctc > '$ctc' AND j.cpi < $cpi 
          ORDER BY j.ctc DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Profile Page</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
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
    <h2>Companies You are Eligible For :</h2>
    <div>
        <table id="companyTable" class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Location</th>
                    <th>Year</th>
                    <th>CPI Cutoff</th>
                    <th>CTC</th>
                    <th>Domain</th>
                    <th>Apply</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while($row = $result->fetch_assoc()){
                    echo "<tr>
                        <td>" . htmlspecialchars($row["name"]) . "</td>
                        <td>" . htmlspecialchars($row["j_title"]) . "</td>
                        <td>" . htmlspecialchars($row["j_location"]) . "</td>
                        <td>" . htmlspecialchars($row["year"]) . "</td>
                        <td>" . htmlspecialchars($row["cpi"]) . "</td>
                        <td>" . htmlspecialchars($row["ctc"]) . "</td>
                        <td>" . htmlspecialchars($row["j_category"]) . "</td>
                        <td>
                            <form action='apply.php' method='post'>
                                <input type='hidden' name='cid' value='" . htmlspecialchars($row["cid"]) . "'>
                                <input type='hidden' name='jid' value='" . htmlspecialchars($row["jid"]) . "'>
                                <input type='hidden' name='roll' value='" . htmlspecialchars($roll) . "'>
                                <input type='submit' value='Apply' class='btn btn-primary'>
                            </form>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#companyTable').DataTable();
    });
</script>

</body>
</html>
