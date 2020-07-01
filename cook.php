<?php session_start(); ?>
<?php include 'connection.php' ?>
<?php 
 //Declaring session variables
 $_SESSION['status'] = ''; 
 $_SESSION ['reject'] = ''; 
 $_SESSION ['failed'] = ''; 
 ?>
<?php
//Declaraing fields and error variables
$nameErr = $emailErr = $nicErr = $contactErr = $passErr = $cpassErr = $districtErr = "";
$fname = $lname = $fullName = $user = $nic = $contact = $email = $pass = $cpass = $gender = $date = $month = $year = $DOB = "";
$tradition = $taste = $speciality = $time_prefer = $experience = $time = $dishes_quantity = $people_quantity = $agreement = $trad = $tas = $special = $prefer = "";
$traditionErr = $tasteErr = $specialityErr = $time_preferErr = $experienceErr = $timeErr = $dishes_quantityErr = $people_quantityErr = $agreementErr = "";
  //Validating input field values
	if(isset($_POST['submit'])){
		
		if(!empty($_POST['fname'])){
			if(!preg_match("|^[A-Za-z]'?[- a-zA-Z]{3,25}+$|",$_POST['fname'])){
				$nameErr = "Only letters, white space and - allowed";
			}
			else{
				$fname = $_POST['fname'];
			}
		}
        if(!empty($_POST['lname'])){
            if(!preg_match("|^[A-Za-z]'?[- a-zA-Z]{3,25}+$|",$_POST['lname'])){
                    $nameErr = "Only letters, white space and - allowed";
            }
            else{
                $lname = $_POST['lname'];
            }
		}
		
        if(!empty($_POST['fname']) && !empty($_POST['lname'])){
            $fullName = $fname . " " . $lname;
		}
		if(!empty($_POST['email'])){
			if(!preg_match("|^[a-zA-Z0-9_.]+@[a-z]{3,5}.[a-z]{2,3}$|",$_POST['email'])){
				$emailErr = "Please provide correct email address";
			}
			else{
				$email = $_POST['email'];
			}
		}
        if(!empty($_POST['username'])){
            if(!preg_match("|^[A-Za-z]'?[- a-zA-Z]{3,25}+$|",$_POST['username'])){
                $nameErr = "Only letters, white space and - allowed";
            }
            else{
                $user = $_POST['username'];
            }
        }
        if(!empty($_POST['NIC'])){
			if(!preg_match("|^[0-9]{13}$|",$_POST['NIC'])){
                $nicErr = "Incorrect NIC number";
                if(strlen($_POST['NIC'])<13 || strlen($_POST['NIC'])>13){
                    $nicErr = "NIC number must be of 13 digits";
                }
			}
			else{
				$nic = $_POST['NIC'];
			}
        }
        if(!empty($_POST['contact'])){
			if(!preg_match("|^[03]{2}+[0-9]{9}$|",$_POST['contact'])){
				$contactErr = "Incorrect contact number";
			}
			else{
				$contact = $_POST['contact'];
			}
		}
		if(!empty($_POST['password'])){
			if(!preg_match("|^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$|",$_POST['password'])){
				$passErr = "Password must contain atleast one lower case, one upper case and one digit";
				if(strlen($_POST['password'])<6){
					$passErr = "Too short password";
					}
			}
			else{
				$pass = $_POST['password'];
			}
        }
        if(!empty($_POST['pass'])){
			if($pass !== $_POST['password']){
				$cpassErr = "The two passwords are not identical";
			}
			else{
				$cpass = $_POST['pass'];
			}
        }
        if(!empty($_POST['gender'])){
            $gender = $_POST['gender'];
        }
		if(!empty($_POST['date']) && !empty($_POST['month']) && !empty($_POST['year'])){
            $date = $_POST['date'];
            $month = $_POST['month'];
            $year = $_POST['year'];
            $DOB = $date . "-" . $month . "-" . $year;
		}
		if(!empty($_POST['tradition'])){
            $tradition = $_POST['tradition'];
            $trad = implode(",",$tradition);
            }
            else{
                $traditionErr = "Please select atleast one";
            }
        if(!empty($_POST['taste'])){
            $taste = $_POST['taste'];
            $tas = implode(",",$taste);
        }
        else{
            $traditionErr = "Please select atleast one";
        }
        if(!empty($_POST['speciality'])){
                $speciality = $_POST['speciality'];
                $special = implode(",",$speciality);
            }
            else{
                $traditionErr = "Please select atleast one";
            }
        if(!empty($_POST['time_prefer'])){
            $time_prefer = $_POST['time_prefer'];
            $prefer = implode(",",$time_prefer);
            }
            else{
                $traditionErr = "Please select atleast one";
            }
        if(!empty($_POST['experience'])){
            $experience = $_POST['experience'];
        }
        else{
            $experienceErr = "Please mention year of experience";
        }
        if(!empty($_POST['time'])){
            $time = $_POST['time'];
        }
        else{
            $timeErr = "Please mention time you can spent on cooking";
        }
        if(!empty($_POST['dishes_quantity'])){
            $dishes_quantity = $_POST['dishes_quantity'];
        }
        else{
            $dishes_quantityErr = "Please mention number of dishes you can prepare at a time";
		}
        if(!empty($_POST['people_quantity'])){
            $people_quantity = $_POST['people_quantity'];
        }
        else{
            $people_quantityErr = "Please mention for how many people you can prepare meal";
		}
	}
	//Sanitize form data
	$fullName = mysqli_real_escape_string($con,$fullName);
	$email = mysqli_real_escape_string($con,$email);
	$pass = mysqli_real_escape_string($con,$pass);
    $user = mysqli_real_escape_string($con,$user);
    $pass = md5($pass);
    $cpass = md5($cpass);
	//Generate vkey
    $vkey = 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM0123456789~!@{}[]><$%^*()';
    $vkey = str_shuffle($vkey);
    $vkey = substr($vkey, 0 , 10);
	//Check for primary key
	if(!empty($fullName) && !empty($email) && !empty($pass) && !empty($cpass) && !empty($user) && !empty($nic) && !empty($contact) && !empty($gender) && !empty($DOB) && !empty($trad) && !empty($tas) && !empty($special) && !empty($prefer) && !empty($experience) && !empty($time) && !empty($dishes_quantity) && !empty($people_quantity)){
		if($_POST['agreement'] == "disagree"){
			$agreementErr = "You must agree the terms and condition to register";	
		}
		else{
			$sql = "SELECT * FROM `cook_registration` WHERE Email='$email'";
			$result = mysqli_query($con,$sql);
			$num = mysqli_num_rows($result);
			if($num == 1){
                $_SESSION['reject'] = 'Email already Registered. Try to Login to your account';
	}
	//Inserting data into Database
    else{
		
        $reg="INSERT INTO `cook_registration`(`Full_name`, `Email`, `Username`, `CNIC`, `Contact`, `Password`, `Gender`, `DOB`, `Traditional_Food`, `Taste`, `Specialty`, `Time_Prefer`, `Experience`, `Time`, `Dishes_Quantity`, `People_Quantity`, `vkey`) 
		VALUES ('$fullName','$email','$user','$nic','$contact','$pass','$gender','$DOB','$trad','$tas','$special','$prefer','$experience','$time','$dishes_quantity','$people_quantity','$vkey')";
		$insert = mysqli_query($con,$reg);
		if($insert == true){
			//send email
			$to = "anumr32@gmail.com";
			$subject = "Registration Approval";
			$message = "<p>New user wants to register. Kindly approve the request.</p><br/><a href='http://localhost/testing/verify.php?Email=$email&vkey=$vkey'><button style='font-size:16px; font-family:Calibri; color:white; background-color:red; width:170px; height: 50px; border-radius: 5px;'>Approve</button></a>";
			$headers = "From: ". $email;
			$headers .= "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			mail($to,$subject,$message,$headers);
            $_SESSION['status'] = 'Registration Successful. Kindly visit our office between 9AM to 5PM (Monday to Saturday) for Approval';
            $fname = $lname = $fullName = $user = $nic = $contact = $email = $pass = $cpass = $gender = $date = $month = $year = $DOB = "";
            $tradition = $taste = $speciality = $time_prefer = $experience = $time = $dishes_quantity = $people_quantity = $agreement = $trad = $tas = $special = $prefer = "";
        }
        else{
            $_SESSION['failed'] = 'Registration Failed.';
		}
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
							<div class="alert alert-success alert-dismissible" role="alert" style="width:60%; margin:auto; justify-content:center;">
  								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                      <strong>Status: </strong> <?php echo $_SESSION['status'] ?> 
                            </div>
							<?php } ?>
							<?php if($_SESSION['reject']) { ?>
							<div class="alert alert-danger alert-dismissible" role="alert" style="width:60%; margin:auto;">
  								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  									<strong>Reject: </strong> <?php echo $_SESSION['reject'] ?> 
							</div>
							<?php } ?>
							<?php if($_SESSION['failed']) { ?>
							<div class="alert alert-danger alert-dismissible" role="alert" style="width:60%; margin:auto;">
  								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  									<strong>Failed: </strong> <?php echo $_SESSION['failed'] ?> 
							</div>
							<?php } ?>
    <form role="form" class="form-horizontal cook-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" name="signup_form">
						<div class="note" id="warning">Fields with * are required fields</div>
							<div class="form-group">
								<label for="name" class="control-label col-sm-4">Full Name:<b class="note"> *</b></label>
								<div class="col-lg-4">
									<input type="text" class="form-control" id="name" name="fname" placeholder="First Name" required value="<?php echo htmlspecialchars($fname);?>">
								</div>
								<div class="col-lg-4">
									<input type="text" class="form-control" name="lname" placeholder="Last Name" required value="<?php echo htmlspecialchars($lname);?>">
								</div>
								<div class="col-sm-4"></div>
								<div id="nameErr" class="col-sm-8 note"><?php echo $nameErr ?></div>
							</div>
							<div class="form-group">
								<label for="email" class="control-label col-lg-4">Email:<b class="note"> *</b></label>
								<div class="col-lg-8">
									<input type="email" class="form-control" placeholder="Email Address" name="email" required value="<?php echo htmlspecialchars($email);?>">
								</div>
								<div class="col-sm-4"></div>
								<div id="emailErr" class="col-sm-8 note"><?php echo $emailErr ?></div>
							</div>
							<div class="form-group">
								<label for="username" class="control-label col-lg-4">Username:<b class="note"> *</b></label>
								<div class="col-lg-8">
									<input type="text" class="form-control" placeholder="Username" name="username" required value="<?php echo htmlspecialchars($user);?>">
								</div>
								<div class="col-sm-4"></div>
								<div id="nameErr" class="col-sm-8 note"><?php echo $nameErr ?></div>
                            </div>
                            <div class="form-group">
								<label for="email" class="control-label col-lg-4">CNIC:<b class="note"> *</b></label>
								<div class="col-lg-8">
									<input type="number" class="form-control" placeholder="NIC Number" name="NIC" required value="<?php echo htmlspecialchars($nic);?>">
								</div>
								<div class="col-sm-4"></div>
								<div id="nicErr" class="col-sm-8 note"><?php echo $nicErr ?></div>
							</div>
							<div class="form-group">
								<label for="contact" class="control-label col-lg-4">Contact:<b class="note"> *</b></label>
								<div class="col-sm-8">
									<input type="number" class="form-control" name="contact" placeholder="Contact Number" required value="<?php echo htmlspecialchars($contact);?>">
								</div>
								<div class="col-sm-4"></div>
								<div id="contactErr" class="col-sm-8 note"><?php echo $contactErr ?></div>
							</div>
							<div class="form-group">
								<label for="psw" class="control-label col-lg-4">Password:<b class="note"> *</b></label>
								<div class="col-sm-8">
									<input type="password" name="password" class="form-control" placeholder="Password" required value="<?php echo htmlspecialchars($pass);?>">
								</div>
								<div class="col-sm-4"></div>
								<div id="passErr" class="col-sm-8 note"><?php echo $passErr ?></div>
							</div>
							<div class="form-group">
								<label for="pw" class="control-label col-lg-4">Confirm Password:<b class="note"> *</b></label>
								<div class="col-sm-8">
									<input type="password" class="form-control" placeholder="Confirm Password" name="pass" required value="<?php echo htmlspecialchars($cpass);?>">
								</div>
								<div class="col-sm-4"></div>
								<div id="cpassErr" class="col-sm-8 note"><?php echo $cpassErr ?></div>
                            </div>
                            <div class="form-group">
								<label class="control-label col-lg-4">Gender:<b class="note"> *</b></label>
								<div class="col-sm-1">
                                    <label class="radio-inline"><input type="radio" name="gender" value="male" required style="margin-top:10px;">Male</label>
                                </div>
                                <div class="col-sm-1">
									<label class="radio-inline"><input type="radio" name="gender" value="female" style="margin-top:10px;">Female</label>
								</div>
                            </div>
                            <!-- Date of Birth -->
							<div class="form-group">
								<label class="control-label col-lg-4" for="sel1">Date of Birth:<b class="note"> *</b></label>
								<div class="col-sm-8">
									<div class="row">
										<div class="col-lg-4">
											<select name="date" class="form-control" id="sel1" required value="<?php echo htmlspecialchars($date);?>">
												<option value="day">Day</option>
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="6">6</option>
												<option value="7">7</option>
												<option value="8">8</option>
												<option value="9">9</option>
												<option value="10">10</option>
												<option value="11">11</option>
												<option value="12">12</option>
												<option value="13">13</option>
												<option value="14">14</option>
												<option value="15">15</option>
												<option value="16">16</option>
												<option value="17">17</option>
												<option value="18">18</option>
												<option value="19">19</option>
												<option value="20">20</option>
												<option value="21">21</option>
												<option value="22">22</option>
												<option value="23">23</option>
												<option value="24">24</option>
												<option value="25">25</option>
												<option value="26">26</option>
												<option value="27">27</option>
												<option value="28">28</option>
												<option value="29">29</option>
												<option value="30">30</option>
												<option value="31">31</option>
											</select>
										</div>
										<div class="col-lg-4">
											<select name="month" class="form-control" id="month" required value="<?php echo htmlspecialchars($month);?>">
												<option value="month">Month</option>
												<option value="jan">Jan</option>
												<option value="feb">Feb</option>
												<option value="march">March</option>
												<option value="april">April</option>
												<option value="may">May</option>
												<option value="june">June</option>
												<option value="july">July</option>
												<option value="aug">Aug</option>
												<option value="sep">Sep</option>
												<option value="oct">Oct</option>
												<option value="nov">Nov</option>
												<option value="dec">Dec</option>
											</select>
										</div>
										<div class="col-lg-4">
											<select name="year" class="form-control" id="year" required value="<?php echo htmlspecialchars($year);?>">
												<option>Year</option>
												<option>2018</option>
												<option>2017</option>
												<option>2016</option>
												<option>2015</option>
												<option>2014</option>
												<option>2013</option>
												<option>2012</option>
												<option>2011</option>
												<option>2010</option>
												<option>2009</option>
												<option>2008</option>
												<option>2007</option>
												<option>2006</option>
												<option>2005</option>
												<option>2004</option>
												<option>2003</option>
												<option>2002</option>
												<option>2001</option>
												<option>2000</option>
												<option>1999</option>
												<option>1998</option>
												<option>1997</option>
												<option>1996</option>
												<option>1995</option>
												<option>1994</option>
												<option>1993</option>
												<option>1992</option>
												<option>1991</option>
												<option>1990</option>
												<option>1989</option>
												<option>1988</option>
												<option>1987</option>
												<option>1986</option>
												<option>1985</option>
												<option>1984</option>
												<option>1983</option>
												<option>1982</option>
												<option>1981</option>
												<option>1980</option>
												<option>1979</option>
												<option>1978</option>
												<option>1977</option>
												<option>1976</option>
												<option>1975</option>
												<option>1974</option>
												<option>1973</option>
												<option>1972</option>
												<option>1971</option>
												<option>1970</option>
												<option>1969</option>
												<option>1968</option>
												<option>1967</option>
												<option>1966</option>
												<option>1965</option>
												<option>1964</option>
												<option>1963</option>
												<option>1962</option>
												<option>1961</option>
												<option>1960</option>
											</select>
										</div>
									</div>
								</div>
								<div id="birth_error" class="val_error"></div>
							</div>
							<h1 style="text-align: center; font-family: 'Merriweather', serif; font-weight:bold;">COOKING ABILITY</h1>
							<div class="form-group">
		<div class="col-sm-offset-2 col-sm-12 col-auto my-1">
            <label for="name" class="control-label col-sm-4">Traditional Food Speciality:<b class="note"> *</b></label>
        </div>
        <div class="checkbox">
            <div class="col-sm-3"></div>
                <label for="indian">
                    <input type="checkbox" id="indian" name="tradition[]" value="Indian" style="margin-top:10px;"> Indian
                </label>
        </div>
        <div class="checkbox">
            <div class="col-sm-3"></div>
                <label for="pak">
                    <input type="checkbox" id="pak" name="tradition[]" value="Pakistani" style="margin-top:10px;"> Pakistani
                </label>
        </div>
        <div class="checkbox">
            <div class="col-sm-3"></div>
                <label for="chinese">
                    <input type="checkbox" id="chinese" name="tradition[]" value="Chinese" style="margin-top:10px;"> Chinese
                </label>
        </div>
        <div class="checkbox">
            <div class="col-sm-3"></div>
                <label for="italian">
                    <input type="checkbox" id="italian" name="tradition[]" value="Italian" style="margin-top:10px;"> Italian
                </label>
        </div>
        <div class="checkbox">
            <div class="col-sm-3"></div>
                <label for="mexican">
                    <input type="checkbox" id="mexican" name="tradition[]" value="Mexican" style="margin-top:10px;"> Mexican
                </label>
        </div>
        <div class="checkbox">
            <div class="col-sm-3"></div>
                <label for="singaporian">
                    <input type="checkbox" id="singaporian" name="tradition[]" value="Singaporian" style="margin-top:10px;"> Singaporian
                </label>
        </div>
        <div class="checkbox">
            <div class="col-sm-3"></div>
                <label for="other">
                    <input type="checkbox" id="other" name="tradition[]" value="" style="margin-top:10px;"> other
                    <input type="text" style="border: none; border-bottom: 1px solid black">
                </label>
        </div>
        <div class="col-sm-4"></div>
        <div class="col-sm-8 note"><?php echo $traditionErr ?></div>
        <div class="col-sm-offset-2 col-sm-12 col-auto my-1">
            <label for="name" class="control-label col-sm-3">Taste of your food:<b class="note"> *</b></label>
        </div>
        <div class="checkbox">
            <div class="col-sm-3"></div>
                <label for="spicy">
                    <input type="checkbox" id="spicy" name="taste[]" value="Spicy" style="margin-top:10px;"> Spicy
                </label>
        </div>
        <div class="checkbox">
            <div class="col-sm-3"></div>
                <label for="salty">
                    <input type="checkbox" id="salty" name="taste[]" value="Salty" style="margin-top:10px;"> Salty
                </label>
        </div>
        <div class="checkbox">
            <div class="col-sm-3"></div>
                <label for="sweet">
                    <input type="checkbox" id="sweet" name="taste[]" value="Sweet" style="margin-top:10px;"> Sweet
                </label>
        </div>
        <div class="checkbox">
            <div class="col-sm-3"></div>
                <label for="sour">
                    <input type="checkbox" id="sour" name="taste[]" value="Sour" style="margin-top:10px;"> Sour
                </label>
        </div>
        <div class="checkbox">
            <div class="col-sm-3"></div>
                <label for="other_taste">
                    <input type="checkbox" id="other_taste" name="taste[]" value="" style="margin-top:10px;"> other
                    <input type="text" style="border: none; border-bottom: 1px solid black">
                </label>
        </div>
        <div class="col-sm-4"></div>
        <div class="col-sm-8 note"><?php echo $traditionErr ?></div>
        <div class="col-sm-offset-2 col-sm-12 col-auto my-1">
            <label for="name" class="control-label col-sm-3">Speciality In:<b class="note"> *</b></label>
        </div>
        <div class="checkbox">
            <div class="col-sm-3"></div>
                <label for="sweet_dish">
                    <input type="checkbox" id="sweet_dish" name="speciality[]" value="Sweet Dishes" style="margin-top:10px;"> Sweet Dishes
                </label>
        </div>
        <div class="checkbox">
            <div class="col-sm-3"></div>
                <label for="routine">
                    <input type="checkbox" id="routine" name="speciality[]" value="Routine Dishes" style="margin-top:10px;"> Routine Dishes
                </label>
        </div>
        <div class="checkbox">
            <div class="col-sm-3"></div>
                <label for="vegetarian">
                    <input type="checkbox" id="vegetarian" name="speciality[]" value="Vegetarian Dishes" style="margin-top:10px;"> Vegetarian Dishes
                </label>
        </div>
        <div class="checkbox">
            <div class="col-sm-3"></div>
                <label for="non-veg">
                    <input type="checkbox" id="non-veg" name="speciality[]" value="Non-Vegeterian Dishes" style="margin-top:10px;"> Non-Vegetarian Dishes
                </label>
        </div>
        <div class="checkbox">
            <div class="col-sm-3"></div>
                <label for="rice">
                    <input type="checkbox" id="rice" name="speciality[]" value="Rice" style="margin-top:10px;"> Rice with different flavours
                </label>
        </div>
        <div class="checkbox">
            <div class="col-sm-3"></div>
                <label for="loaf">
                    <input type="checkbox" id="loaf" name="speciality[]" value="Roti & Paratha" style="margin-top:10px;"> Different Roti & Paratha
                </label>
        </div>
        <div class="checkbox">
            <div class="col-sm-3"></div>
                <label for="soup">
                    <input type="checkbox" id="soup" name="speciality[]" value="Different Soups" style="margin-top:10px;"> Different Soups
                </label>
        </div>
        <div class="checkbox">
            <div class="col-sm-3"></div>
                <label for="juices">
                    <input type="checkbox" id="juices" name="speciality[]" value="Different Juices" style="margin-top:10px;"> Different Juices
                </label>
        </div>
        <div class="checkbox">
            <div class="col-sm-3"></div>
                <label for="bake">
                    <input type="checkbox" id="bake" name="speciality[]" value="Baked Dishes" style="margin-top:10px;"> Baked Dishes
                </label>
        </div>
        <div class="checkbox">
            <div class="col-sm-3"></div>
                <label for="pizza">
                    <input type="checkbox" id="non-veg" name="speciality[]" value="Pizza" style="margin-top:10px;"> Different flavours Pizza
                </label>
        </div>
        <div class="checkbox">
            <div class="col-sm-3"></div>
                <label for="other_dish">
                    <input type="checkbox" id="other_dish" name="speciality[]" value="" style="margin-top:10px;"> other
                    <input type="text" style="border: none; border-bottom: 1px solid black">
                </label>
        </div>
        <div class="col-sm-4"></div>
        <div class="col-sm-8 note"><?php echo $traditionErr ?></div>
        <div class="col-sm-offset-2 col-sm-12 col-auto my-1">
            <label class="control-label col-sm-3">Interested to Prepare:<b class="note"> *</b></label>
        </div>
        <div class="checkbox">
            <div class="col-sm-3"></div>
                <label for="breakfast">
                    <input type="checkbox" id="breakfast" name="time_prefer[]" value="Breakfast" style="margin-top:10px;"> Breakfast
                </label>
        </div>
        <div class="checkbox">
            <div class="col-sm-3"></div>
                <label for="lunch">
                    <input type="checkbox" id="lunch" name="time_prefer[]" value="Lunch" style="margin-top:10px;"> Lunch
                </label>
        </div>
        <div class="checkbox">
            <div class="col-sm-3"></div>
                <label for="supper">
                    <input type="checkbox" id="supper" name="time_prefer[]" value="Supper" style="margin-top:10px;"> Supper
                </label>
        </div>
        <div class="checkbox">
            <div class="col-sm-3"></div>
                <label for="dinner">
                    <input type="checkbox" id="dinner" name="time_prefer[]" value="Dinner" style="margin-top:10px;"> Dinner
                </label>
        </div>
        <div class="col-sm-4"></div>
        <div class="col-sm-8 note"><?php echo $traditionErr ?></div>
        <br>
        <div class="form-group">
            <label class="control-label col-sm-6">Year of Experience in cooking:<b class="note"> *</b></label>
				<div class="col-sm-4">
					<input type="number" class="form-control" name="experience" value="<?php echo htmlspecialchars($experience);?>" placeholder="Years of Experience" required>
				</div>
				<div class="col-sm-4"></div>
                <div class="col-sm-8 note"><?php echo $experienceErr ?></div>
		</div>
        <div class="form-group">
            <label class="control-label col-sm-6">How much time you can give a day (in hours):<b class="note"> *</b></label>
				<div class="col-sm-4">
					<input type="number" class="form-control" name="time" placeholder="Time" required value="<?php echo htmlspecialchars($time);?>">
				</div>
				<div class="col-sm-4"></div>
				<div class="col-sm-8 note"><?php echo $timeErr ?></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-6">Number of dishes prepare at a time:<b class="note"> *</b></label>
				<div class="col-sm-4">
					<input type="number" class="form-control" name="dishes_quantity" placeholder="How many dishes at a time" required value="<?php echo htmlspecialchars($dishes_quantity);?>">
				</div>
				<div class="col-sm-4"></div>
				<div class="col-sm-8 note"><?php echo $timeErr ?></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-6">For how many people at a time?<b class="note"> *</b></label>
				<div class="col-sm-4">
					<input type="number" class="form-control" name="people_quantity" placeholder="Quantity of People" required value="<?php echo htmlspecialchars($people_quantity);?>">
				</div>
				<div class="col-sm-4"></div>
				<div class="col-sm-8 note"><?php echo $people_quantityErr ?></div>
        </div>
        <div class="col-sm-offset-2 col-sm-12 col-auto my-1">
            <label for="name" class="control-label ">Terms & Conditions</label>
            <ol class="col-sm-12"> 
                <li>Candidate must be elder than 18 years.</li>
                <li>Candidate must be able to use internet.</li>
                <li>Have the ability to upgrade his/her taste of food with time.</li>
                <li>Must be humble and patient to communicate with customers and to act on their requirement and complaint.</li>
                <li>Interested candidate once have to come at our office & have to qualify our cooking test and interview for their selection.</li>
            </ol>
        </div>
        <div class="row">
        <div class="col-sm-3"></div>
        <div class="form-check col-sm-6">
            <input class="form-check-input" type="radio" name="agreement" id="agree" value="agree" required>
                <label class="form-check-label" for="agree">
                    I agree to all the terms and conditions.
                </label>
        </div>
        </div>
        <div class="row">
        <div class="col-sm-3"></div>
        <div class="form-check col-sm-6">
            <input class="form-check-input" type="radio" name="agreement" id="disagree" value="disagree" required>
                <label class="form-check-label" for="disagree">
                    I do not agree to all the terms and conditions.
                </label>
		</div>
		<div class="col-sm-4"></div>
				<div class="col-sm-8 note"><?php echo $agreementErr ?></div>
        </div>
        <hr/>
            <button class="btn btn-primary pull-right" type="submit" style="font-size:16px; font-family:Calibri" name="submit">Submit</button>
</form>
    </section>
    <!-- Main JS -->
	<script src="js/main.js"></script>
</body>
</html>