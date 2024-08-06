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

// Create a file pointer connected to the output stream
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename="applicants_list.csv"');

$output = fopen('php://output', 'w');

// Output column headings
fputcsv($output, array('Job Title', 'Student Name', 'CPI', 'Branch', 'Application Date'));

// Output rows
while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, $row);
}

fclose($output);
exit;
?>
