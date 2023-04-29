<!DOCTYPE html>
<?php require_once("config.php"); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Registeration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    
<div class="container">
    <div class="row">
        <?php
        if(isset($_POST['signup'])){
            extract($_POST);
            if($passwordConfirm==''){
                $error[]='please confirm the password';
            }
            if($password !=$passwordConfirm){
                $error[]='Password does not match';
            }
            if(strlen($password)<5){
                $error[]='Password is too short';
            }
            if(strlen($password)>300){
                $error[]='Password is too long';
            }
            
           $sql="select * from alumni where(email='$email');";
           $res=mysqli_query($dbc,$sql); 

           if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            
                   if($email==$row['email'])
                   {
                        $error[] ='Email alredy Exists ';
                    } 
                  }

                  if(!isset($error)){ 
                    $year=date('Y');
                  $options = array("cost"=>4);
          $password = password_hash($password,PASSWORD_BCRYPT,$options);
                  
                  $result = mysqli_query($dbc,"INSERT into alumni (name,roll_no,contact_number,passout_year,company_name,ctc,cpi,email,password)  values ('$name','$roll_no','$contact_number','$passout_year','$company_name','$ctc','$cpi','$email','$password')");
      
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
    <div class="successmsg"><span style="font-size:100px;">&#9989;</span> <br> You have registered successfully . <br> <a href="login.php" style="color:#fff;">Login here... </a> </div>
      <?php } else { ?>
            <div class="signup_form">
        <form style="margin-top: 10%;padding: 30px;border-radius: 5px;" action="" method="POST">
        <p style="font-size: 30px;text-align: center; color:#fff;font-weight:bold">Fill the required</p>
  <div class="form-group">
    <label class="label_txt"></label>
    <input type="text" class="form-control" name="name" value="<?php if(isset($error)) {echo $lname;}?>" required="" placeholder="Name"><br></div>
<div class="form-group">
    <label class="label_txt"></label>
    <input type="text" class="form-control" name="roll_no" value="<?php if(isset($error)) {echo $email;}?>" required="" placeholder="Roll No"><br></div>
    <div class="form-group">
    <label class="label_txt"></label>
    <input type="phone" class="form-control" name="contact_number" required="" placeholder="Contact number"><br></div>
    <div class="form-group">
    <label class="label_txt"></label>
    <input type="text" class="form-control" name="passout_year" required="" placeholder="Passout year"><br></div>
<div class="form-group">
    <label class="label_txt"></label>
    <input type="text" class="form-control" name="cpi" required="" placeholder="CPI"><br></div>

    <div class="form-group">
    <label class="label_txt"></label>
    <input type="text" class="form-control" name="company_name" required="" placeholder="Current Company"><br></div>

    <div class="form-group">
    <label class="label_txt"></label>
    <input type="text" class="form-control" name="ctc" required="" placeholder="CTC"><br></div>

    <div class="form-group">
    <label class="label_txt"></label>
    <input type="email" class="form-control" name="email" required="" placeholder="Email"><br></div>

    <div class="form-group">
    <label class="label_txt"></label>
    <input type="password" class="form-control" name="password" required="" placeholder="Password"><br></div>

    <div class="form-group">
    <label class="label_txt"></label>
    <input type="password" class="form-control" name="passwordConfirm" required="" placeholder="Confirm Password"><br></div>
  
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