
<?php 
require_once("c_config.php");

// Check if the user is logged in
if (!isset($_SESSION["login_sess"])) {
    header("location:c_login.php"); 
    exit;
}

$email = $_SESSION["login_email"];
$findresult = mysqli_query($dbc, "SELECT * FROM company WHERE email= '$email'");
if ($res = mysqli_fetch_array($findresult)) {
    $cid = $res['cid'];
}

// Query to get all job applications for the company
$sql = "
    SELECT 
        job.j_title, 
        stud_personal.name, 
        stud_acad.CPI, 
        stud_acad.Branch,
        applications.application_date 
    FROM 
        applications
    INNER JOIN 
        job ON applications.job_id = job.jid
    INNER JOIN 
        stud_personal ON applications.Roll = stud_personal.Roll
    INNER JOIN 
        stud_acad ON applications.Roll = stud_acad.Roll_Number
    WHERE 
        job.cid = '$cid'
    ORDER BY 
        job.j_title, stud_acad.CPI
";
$result = mysqli_query($dbc, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Applicants List</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <style>
        body, h1, h2, h3, h4, h5 {font-family: "Poppins", sans-serif}
        body {font-size:16px;}
    </style>
</head>
<body>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-red w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;" id="mySidebar"><br>
    <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px">Close Menu</a>
    <div class="w3-container">
        <h3 class="w3-padding-64"><b>Applicants</b></h3>
    </div>
    <div class="w3-bar-block">
        <a href="c_account.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Home</a>
        <a href="addjob.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Add Jobs</a> 
        <a href="c_update.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Update</a>
        <a href="applicants.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Applicants</a>
        <a href="c_logout.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">LogOut</a>
    </div>
</nav>

<!-- Top menu on small screens -->
<header class="w3-container w3-top w3-hide-large w3-red w3-xlarge w3-padding">
    <a href="javascript:void(0)" class="w3-button w3-red w3-margin-right" onclick="w3_open()">&#9776;</a>
    <span>Applicants List</span>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:340px;margin-right:40px">

    <!-- Header -->
    <div class="w3-container" style="margin-top:80px" id="showcase">
        <h1 class="w3-jumbo"><b>Applicants List</b></h1>
        <hr style="width:50px;border:5px solid red" class="w3-round">
    </div>
    
 
    <!-- Applicants Table -->
    <div class="w3-container" id="applicants" style="margin-top:75px">
        <h1 class="w3-xxxlarge w3-text-red"><b>Applications</b></h1>
        <hr style="width:50px;border:5px solid red" class="w3-round">
        <table class="w3-table w3-bordered w3-striped">
               <!-- Download CSV Button -->
        <form method="post" action="download_applicants.php">
            <button type="submit" name="download_csv" class="w3-button w3-red w3-large">Download CSV</button>
        </form>
            <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Student Name</th>
                    <th>CPI</th>
                    <th>Branch</th>
                    <th>Application Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['j_title']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['CPI']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Branch']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['application_date']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No applications found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    
    <!-- Footer -->
    <div class="w3-light-grey w3-container w3-padding-32" style="margin-top:75px;padding-right:58px">
        <p class="w3-right">Powered by <a href="https://www.iitp.ac.in" title="IITP" target="_blank" class="w3-hover-opacity">IITP</a></p>
    </div>
</div>

<script>
// Script to open and close sidebar
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("myOverlay").style.display = "block";
}
 
function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("myOverlay").style.display = "none";
}
</script>

</body>
</html>
