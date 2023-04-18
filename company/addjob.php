<?php require_once("c_config.php");
if(!isset($_SESSION["login_sess"])) 
{
    header("location:c_login.php"); 
}
  $email=$_SESSION["login_email"];
  $findresult = mysqli_query($dbc, "SELECT * FROM company WHERE email= '$email'");
if($res = mysqli_fetch_array($findresult))
{

$name = $res['name'];   
$email = $res['email'];  
$cid = $res['cid'];
}
 ?>
<!DOCTYPE html>
<?php require_once("c_config.php"); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Registeration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="c_style.css">
</head>
<body>
    
<div class="container">
    <div class="row">
        <?php
        if(isset($_POST['signup'])){
            extract($_POST);
            $sql="select * from job j
           NATURAL JOIN company c
           WHERE j.cid = c.cid
           AND j.j_title = '$j_title';";
           $res=mysqli_query($dbc,$sql); 

           if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            
                   if($j_title==$row['j_title'])
                   {
                        $error[] ='This Job is alredy Exists for this Company.';
                    } 
                  }

                  if(!isset($error)){ 
                  $result = mysqli_query($dbc,"INSERT into job(cid,j_title,j_category,j_desc,j_location,cpi,ctc,i_date,j_type,moi) values('$cid','$j_title','$j_category','$j_desc','$j_location','$cpi','$ctc','$i_date','$j_type','$moi')");
      
                 if($result)
          {
           $done=2; 
          }
          else{
            $error[] ='Failed : Something went wrong';
          }
       }
        }
        ?>
        <div class="col-sm-4">
            <?php
            if(isset($error)){
                foreach($error as $error){
                    echo '<p class="errmsg">&#x26A0;'.$error.'</p>';
                }
            }
            ?>
            </div>
        <div class="col-sm-4">
        <?php if(isset($done)) 
      { ?>
    <div class="successmsg"><span style="font-size:100px;">&#9989;</span> <br> You have registered successfully . <br> <a href="c_login.php" style="color:#fff;">Login here... </a> </div>
      <?php } else { ?>
            <div class="signup_form">
        <form style="margin-top: 10%;padding: 30px;border-radius: 5px;" action="" method="POST">
        <p style="font-size: 30px;text-align: center; color:#fff;font-weight:bold">Fill the required</p>
  <div class="form-group">
    <label class="label_txt"></label>
    <input type="text" class="form-control" name="j_title" value="<?php if(isset($error)) {echo $lname;}?>" required="" placeholder="Job title"><br></div>
<div class="form-group">
    <label class="label_txt"></label>
    <input type="text" class="form-control" name="j_category" value="<?php if(isset($error)) {echo $email;}?>" required="" placeholder="job category"><br></div>
 <div class="form-group">
    <label class="label_txt"></label>
    <input type="text" class="form-control" name="j_desc" required="" placeholder="Job description"><br></div>
<div class="form-group">
    <label class="label_txt"></label>
    <input type="text" class="form-control" name="j_location" required="" placeholder="Job location"><br></div>

    <div class="form-group">
    <label class="label_txt"></label>
    <input type="float" class="form-control" name="cpi" required="" placeholder="CPI Cutoff"><br></div>

    <div class="form-group">
    <label class="label_txt"></label>
    <input type="bigint" class="form-control" name="ctc" required="" placeholder="CTC"><br></div>

    <div class="form-group">
    <label class="label_txt"></label>
    <input type="date" class="form-control" name="i_date" required="" placeholder="Interview date"><br></div>

    <div class="form-group">
    <label class="label_txt"></label>
    <input type="text" class="form-control" name="j_type" required="" placeholder="job type"><br></div>

    <div class="form-group">
    <label class="label_txt"></label>
    <input type="text" class="form-control" name="moi" required="" placeholder="Method of Interview"><br></div>
  
  <button type="submit" name="signup" class="btn btn-primary btn-group-lg form_btn">Register</button>
  <?php } ?>
</form>
<br>
</div>
            </div>
        <div class="col-sm-4">
            </div>
        
    </div>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js" integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous"></script>
</html>

