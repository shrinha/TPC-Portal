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
            if($passwordConfirm==''){
                $error[]='please confirm the password.';
            }
            if($password !=$passwordConfirm){
                $error[]='Password do not match';
            }
            if(strlen($password)<5){
                $error[]='The password is 6 characters long.';
            }
            if(strlen($password)>20){
                $error[]='password: Max length 20 characters not allowed.';
            }
            
           $sql="select * from company where(email='$email');";
           $res=mysqli_query($dbc,$sql); 

           if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            
                   if($email==$row['email'])
                   {
                        $error[] ='Email alredy Exists.';
                    } 
                  }

                  if(!isset($error)){ 
                    $year=date('Y');
                  $options = array("cost"=>4);
          $password = password_hash($password,PASSWORD_BCRYPT,$options);
                  
                  $result = mysqli_query($dbc,"INSERT into company(name,email,password,year,website,p_name,p_contact,location,description) values('$name','$email','$password','$year','$website','$p_name','$p_contact','$location','$description')");
      
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
    <input type="text" class="form-control" name="name" value="<?php if(isset($error)) {echo $lname;}?>" required="" placeholder="Company Name"><br></div>
<div class="form-group">
    <label class="label_txt"></label>
    <input type="email" class="form-control" name="email" value="<?php if(isset($error)) {echo $email;}?>" required="" placeholder="Email"><br></div>
 <div class="form-group">
    <label class="label_txt"></label>
    <input type="password" class="form-control" name="password" required="" placeholder="Password"><br></div>
<div class="form-group">
    <label class="label_txt"></label>
    <input type="password" class="form-control" name="passwordConfirm" required="" placeholder="Confirm Password"><br></div>

    <div class="form-group">
    <label class="label_txt"></label>
    <input type="text" class="form-control" name="website" required="" placeholder="Company Website"><br></div>

    <div class="form-group">
    <label class="label_txt"></label>
    <input type="text" class="form-control" name="p_name" required="" placeholder="Person name whom to contact"><br></div>

    <div class="form-group">
    <label class="label_txt"></label>
    <input type="phone" class="form-control" name="p_contact" required="" placeholder="Contact number"><br></div>

    <div class="form-group">
    <label class="label_txt"></label>
    <input type="text" class="form-control" name="location" required="" placeholder="Company Address"><br></div>

    <div class="form-group">
    <label class="label_txt"></label>
    <input type="text" class="form-control" name="description" required="" placeholder="Description"><br></div>
  
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

