<?php
    include ('connection.php');
    $newpass = $cpass = $passErr = $cpassErr = $email = $emailErr = "";
    $_SESSION['status'] = "";
    function redirect(){
        header('location: index.php');
        exit();
    }
    if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  if(isset($_POST['change'])){
    if(!empty($_POST['email'])){
        if(!preg_match("|^[a-zA-Z0-9_.]+@[a-z]{3,5}.[a-z]{2,3}$|",$_POST['email'])){
            $emailErr = "Please provide correct email address";
        }
        else{
            $email = $_POST['email'];
        }
    }
    //Validating input field values
    if(!empty($_POST['new_pass'])){
        if(!preg_match("|^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$|",$_POST['new_pass'])){
            $passErr = "Password must contain atleast one lower case, one upper case and one digit";
            if(strlen($_POST['new_pass'])<6){
                $passErr = "Too short password";
                }
        }
        else{
            $newpass = $_POST['new_pass'];
        }
    }
    if(!empty($_POST['cpass'])){
        if($newpass !== $_POST['cpass']){
            $cpassErr = "The two passwords are not identical";
        }
        else{
            $cpass = $_POST['cpass'];
        }
    }
    $newpass = md5($newpass);
    $cpass = md5($cpass);
    if(!empty($_POST['new_pass']) && !empty($_POST['cpass'])){
        $fetch = mysqli_query($con,"SELECT `UID` FROM `cook_registration` WHERE `Email` = '$email'");
    if(mysqli_num_rows($fetch)>0){
        $data = mysqli_fetch_array($fetch);
        mysqli_query($con,"UPDATE `cook_registration` SET `Password` = '$newpass' WHERE `Email`='$email'");
        $_SESSION['status'] = "Password updated successfully";
    }
    else{
            $_SESSION['status'] = "Email not registered please register first";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">

<link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,700,400italic,700italic|Merriweather:300,400italic,300italic,400,700italic' rel='stylesheet' type='text/css'>

<!-- Animate.css -->
<link rel="stylesheet" href="css/animate.css">
<!-- Icomoon Icon Fonts-->
<link rel="stylesheet" href="css/icomoon.css">
<!-- Simple Line Icons -->
<link rel="stylesheet" href="css/simple-line-icons.css">
<!-- Datetimepicker -->
<link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
<!-- Flexslider -->
<link rel="stylesheet" href="css/flexslider.css">
<!-- Bootstrap  -->
<link rel="stylesheet" href="css/bootstrap.css">

<link rel="stylesheet" href="css/style.css">


<!-- Modernizr JS -->
<script src="js/modernizr-2.6.2.min.js"></script>
<!-- FOR IE9 below -->
<!--[if lt IE 9]>
<script src="js/respond.min.js"></script>
<![endif]-->
</head>
<body>
<section class="inside-banner" id="cook-header">
        <div class="container"> 
            <span class="pull-right head"><button class="btn btn-primary" style="background-color:white!important; border-radius: 15px;"><a href="index.php" class="cook-link">Home</a></button></span>
            <h2 class="head fh5co-logo" style="font-weight:bold; font-size:60px;">food zone</h2>
</section>
    <section>
	<h1 style="text-align: center; font-family: 'Merriweather', serif; font-weight:bold;">COOK'S REGISTRATION<span><img src="images/cook/chef.png" alt="" height="120px" width="120px"></span></h1>
							<!-- Message alerts for signup form -->
							<?php if($_SESSION['status']) { ?>
							<div class="alert alert-success alert-dismissible" role="alert" style="width:60%; margin:auto;">
  								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  									<strong>Status: </strong> <?php echo $_SESSION['status'] ?> 
							</div>
                            <?php }?>
                            <form role="form" class="form-horizontal cook-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
                            <input type="hidden" id="email" class="form-control" placeholder="Email Address" name="email" required value="<?php if(isset($_GET['Email'])){echo $email = $_GET['Email'];}?>">
                            <!--<div class="form-group">
								<label for="email" class="control-label col-lg-4">Email Address:<b class="note"> *</b></label>
								<div class="col-sm-8">
									
								</div>
								<div class="col-sm-4"></div>
								<div id="emailErr" class="col-sm-8 note"><?php //echo $emailErr ?></div>
							</div> -->_
                                <div class="form-group">
								<label for="new" class="control-label col-lg-4">New Password:<b class="note"> *</b></label>
								<div class="col-sm-8">
									<input type="password" id="new" class="form-control" placeholder="New Password" name="new_pass" required value="<?php echo htmlspecialchars($newpass);?>">
								</div>
								<div class="col-sm-4"></div>
								<div id="passErr" class="col-sm-8 note"><?php echo $passErr ?></div>
							</div>
                            <div class="form-group">
								<label for="cpass" class="control-label col-sm-4">Confirm Password:<b class="note"> *</b></label>
								<div class="col-sm-8">
									<input type="password" id="cpass" class="form-control" placeholder="Confirm Password" name="cpass" required value="<?php echo htmlspecialchars($cpass);?>">
								</div>
								<div class="col-sm-4"></div>
								<div id="cpassErr" class="col-sm-8 note"><?php echo $cpassErr ?></div>
							</div>
                            <button class="btn btn-primary pull-right" type="submit" style="font-size:16px; font-family:Calibri" name="change">Change Password</button>
                            </form>
    </section>
</body>
</html>
    </section>
</body>
</html>