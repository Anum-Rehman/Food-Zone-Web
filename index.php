<?php include 'connection.php' ?>
<?php session_start();
 ?>
<?php 
 //Declaring session variables
 $_SESSION['status'] = ''; 
 $_SESSION ['reject'] = ''; 
 $_SESSION ['failed'] = ''; 
 $_SESSION ['record'] = ''; 
 $_SESSION ['error'] ='';
 ?>
<?php
//Declaraing fields and error variables
$nameErr = $emailErr = $passErr = $districtErr = "";
$fname = $email = $pass = $district = "";
//Checking error connectivity
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  //Validating input field values
	if(isset($_POST['submit'])){
		if(!empty($_POST['fullName'])){
			if(!preg_match("|^[A-Z]'?[- a-zA-Z]{3,25}+$|",$_POST['fullName'])){
				$nameErr = "Only letters, white space and - allowed";
			}
			else{
				$fname = $_POST['fullName'];
			}
		}
		if(!empty($_POST['email'])){
			if(!preg_match("|^[a-zA-Z0-9_.]+@[a-z]{3,5}.[a-z]{2,3}$|",$_POST['email'])){
				$emailErr = "Please provide correct email address";
			}
			else{
				$email = $_POST['email'];
			}
		}
		if(!empty($_POST['district'])){
			if(!preg_match("|^[A-Z]'?[- a-zA-Z]{3,30}+$|",$_POST['district'])){
				$nameErr = "Only letters, white space and - allowed";
			}
			else{
				$district = $_POST['district'];
			}
		}
	}
	//Check for primary key
	if(!empty($fname) && !empty($email) && !empty($district)){
			$sql = "select * from foodee where Email='$email'";
			$result = mysqli_query($con,$sql);
			$num = mysqli_num_rows($result);
			if($num == 1){
				$_SESSION['reject'] = 'Email already Registered. Try to Login to your account';
	}
	//Inserting data into Database
    else{
        $reg="INSERT INTO `foodee`(`Name`, `Email`, `District`) VALUES ('$fname','$email','$district')";
        $insert = mysqli_query($con,$reg);
        if($insert == true){
			$_SESSION['status'] = 'Registration Successful';
			$fname = $email = $pass = $district = "";
        }
        else{
			$_SESSION['failed'] = 'Registration Failed.';
        }
		}
	}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Food Zone</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Template by FREEHTML5.CO" />
	<meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
	<meta name="author" content="FREEHTML5.CO" />

  <!-- 
	//////////////////////////////////////////////////////

	FREE HTML5 TEMPLATE 
	DESIGNED & DEVELOPED by FREEHTML5.CO
		
	Website: 		http://freehtml5.co/
	Email: 			info@freehtml5.co
	Twitter: 		http://twitter.com/fh5co
	Facebook: 		https://www.facebook.com/fh5co

	//////////////////////////////////////////////////////
	 -->

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

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
	<link rel="stylesheet" href="css/bootstrap.min.css">
	
	<link rel="stylesheet" href="css/style.css">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	</head>
	<body>
	<div id="fh5co-container">
		<div id="fh5co-home" class="js-fullheight" data-section="home">
			<div class="flexslider">
				<!-- For dark overlay -->
				<div class="fh5co-overlay"></div>
				<div class="fh5co-text">
					<div class="container">				
						<!-- Side button -->
					<div id="mySidenav" class="sidenav">  
  						<a href="cook.php" id="cook">Cook's Registration</a>
					</div>
						<div class="row">
							<!-- Main home page heading -->
							<h1 class="to-animate">food zone</h1>
							<!-- Signup Form -->
							<h3 style="text-align:center; color:#fb6e14;"><b>Sign up for daily updates</b></h3>
								<form role="form" class="form-inline" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" >
									<div class="form-row">
									<div class="col-sm-12">
										<div class="col-sm-4">
											<input type="text" class="form-control user" placeholder="Full name" name="fullName" required value="<?php echo htmlspecialchars($fname);?>">
											<div id="nameErr" class="note"><?php echo $nameErr?></div>
									</div>
									<div class="col-sm-4">
										<input type="email" class="form-control user" placeholder="Email Address" name="email" required value="<?php echo htmlspecialchars($email);?>">
										<div id="emailErr" class="note"><?php echo $emailErr?></div>
									</div>
									<div class="col-sm-4">
										<input type="text" class="form-control user" placeholder="Area" name="district" required value="<?php echo htmlspecialchars($district);?>">
										<div id="districtErr" class="note"><?php echo $districtErr?></div>
									</div>
									</div>
							</div>
							<br/><br/>
								<button class="btn btn-primary" type="submit" name="submit">SIGNUP NOW</button>
							</form>
							<!-- Message alerts for signup form -->
							<?php if($_SESSION['status']) { ?>
							<div class="alert alert-success alert-dismissible" role="alert">
  								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  									<strong>Status: </strong> <?php echo $_SESSION['status'] ?> 
							</div>

							<?php } ?>
							<?php if($_SESSION['reject']) { ?>
							<div class="alert alert-danger alert-dismissible" role="alert">
  								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  									<strong>Reject: </strong> <?php echo $_SESSION['reject'] ?> 
							</div>
							<?php } ?>
							<?php if($_SESSION['failed']) { ?>
							<div class="alert alert-danger alert-dismissible" role="alert">
  								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  									<strong>Failed: </strong> <?php echo $_SESSION['failed'] ?> 
							</div>
							<?php } ?>
							<div>
							</div>
						</div>
					</div>
				</div>
				<!-- Setting slider images -->
			  	<ul class="slides">
			   	<li style="background-image: url(images/slide_01.jpg);" data-stellar-background-ratio="0.5"></li>
			   	<li style="background-image: url(images/slide_02.jpg);" data-stellar-background-ratio="0.5"></li>
				<li style="background-image: url(images/slide_03.jpg);" data-stellar-background-ratio="0.5"></li>
				<li style="background-image: url(images/slide_04.jpg);" data-stellar-background-ratio="0.5"></li>   
			  	</ul>

			</div>
			
		</div>
		<!-- Nav Menu -->
		<div class="js-sticky">
			<div class="fh5co-main-nav">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-5"></div>
					
					<div class="col-sm-5"></div>
				</div>
					<div class="row fh5co-menu-1">
					<!-- Left Menu -->	
					<div class="col-sm-4">
						<a href="#fh5co-home" data-nav-section="fh5co-home">Home</a>
						<a href="#fh5co-about" data-nav-section="fh5co-about">About</a>
						<a href="#fh5co-menus" data-nav-section="fh5co-menus">Menu</a>
						<a href="#fh5co-contact" data-nav-section="fh5co-contact">Contact</a>
					</div>
					<!-- Center logo -->
					<div class="fh5co-logo col-sm-3">
							<a href="index.html">food zone</a>
						</div>
						<div class="row fh5co-menu-2">
							<!-- Right Menu -->	
							<div class="col-sm-5">
								
						                  
					<?php
	$password = $mail = $button = $myEmail = "";
	if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  //Checking input field values in Database
	if(isset($_POST['login'])){
		if(!empty($_POST['pswrd'])){
			$password = $_POST['pswrd'];
		}
		if(!empty($_POST['mail'])){
			$mail = $_POST['mail'];
		}
		//santize the input values
		$mail = mysqli_real_escape_string($con,$mail);
		$password = mysqli_real_escape_string($con,$password);
		$password = md5($password);
		if(!empty($password) && !empty($mail)){
			$login_query = mysqli_query($con,"SELECT `UID`, `Password`, `verified`, `Email` FROM `cook_registration` WHERE `Email` = '$mail'");
			if(mysqli_num_rows($login_query)>0){
                $data = mysqli_fetch_array($login_query);
                   
					$myEmail = $data['Email'];
					$myEmail = mysqli_real_escape_string($con,$myEmail);
					if($data['verified']==0){ 
					?>
						<script>
							$('#login').click();
							$( document ).ready(function() {
							$('#login').click();
							});
						</script>	
					<?php
					$_SESSION['error']="User not verified yet";
					}
					else if($data['Password']!==$password){
					?>
						<script>
							$('#login').click();
							$( document ).ready(function() {
							$('#login').click();
							});
						</script>	
					<?php
						$_SESSION['error'] = "Invalid password <a href='forgot.php?Email=$myEmail'>Forgot Password?</a>";
					}
					else{ 
						$_SESSION['userID'] = $data['UID'];
						$_SESSION['userEmail'] = $data['Email'];
	}
			}
			else{
				?>
				<script>
				$( document ).ready(function() {
					$('#login').click();
				});
				</script>	
			<?php
			$_SESSION['error'] = "No such record exist. Please register first.";
			}
				}
				}
?>	
<?php
								if(isset($_SESSION["userID"])) {
									echo "<a href='logout.php' class='links' id='logout' name='logout'><i class='fas fa-sign-out-alt'></i>Logout</a>";
					echo "<a href='todayMenu.php' id='post' target='_blank' class='links' name='post'><button class='btn btn-primary'> POST</button></a>" ;
					echo "<a href='weeklyMenu.php' id='menu' target='_blank' class='links' name='menu'><button class='btn btn-primary'> WEEKLY MENU</button></a>" ;
					echo "<a href='User/index.php' id='user-panel' target='_blank' class='links' name='user-panel'><button class='btn btn-primary'>COOK PANEL</button></a>" ;
								}
								else{
									echo '<a href="#" class="links" id="login" data-toggle="modal" data-target="#loginModal" name="login"><i class="fas fa-sign-in-alt"></i> Login</a>';
									echo '<a href="customer/index.php" class="links" name="customer-panel"><button class="btn btn-primary">USER PANEL</button></a>';
								}
								?>
						</div>
						<!-- Right Menu -->
					</div>
				</div>
				</div>
			</div>
		</div>
	<!-- Popup Signin -->
	<div class="container">
		<!-- Modal -->
		<div class="modal fade" id="loginModal" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header" style="padding:35px 50px; background-color:#bf4c03!important;">
						<h4 style="background-color:#bf4c03; font-family: 'Times New Roman', Times, serif;"><i class="fas fa-lock"></i><b >Login</b></h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body" style="padding:40px 50px;">
					<?php if($_SESSION['error']) { ?>
							<div class="alert alert-warning alert-dismissible" role="alert">
  								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  									<strong>Error: </strong> <?php echo $_SESSION['error']; ?> 
							</div>

					<?php } ?>
						<form role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" name="signin_form">
							<div class="form-group">
								<label for="usrname"><i class="fas fa-user-circle"></i>Email Address:</label>
								<input type="text" class="form-control" id="usrname" placeholder="Email Address" name="mail" required value="<?php echo htmlspecialchars($mail);?>">
							</div>
							<div class="form-group">
								<label for="pswrd"><i class="fas fa-eye"></i> Password</label>
								<input type="password" class="form-control" id="pswrd" name="pswrd" placeholder = "Password" required value="<?php echo htmlspecialchars($password);?>">
							</div>
							<div class="checkbox">
								<label><input type="checkbox" value="" checked>Remember me</label>
							</div>
							<button type="submit" name="login" class="btn btn-success btn-block" style="background-color:#bf4c03; font-family: 'Times New Roman', Times, serif;"><i class="fas fa-power-off"></i></span>Login</button>
						</form>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><i class="fas fa-times"></i>
							Cancel</button>
						<p>Not a member? <a href="cook.php">Sign
								Up</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- About Section -->
		<div id="fh5co-about" data-section="about" style="-50px">
			<div class="fh5co-2col fh5co-bg to-animate-2" style="background-image: url(images/boti.jpg)"></div>
			<div class="fh5co-2col fh5co-text">
				<h2 class="heading to-animate">About Us</h2>
				<p class="to-animate"><span class="firstcharacter">F</span>ood zone provides the healthy and tasty homemade food all over the Karachi. Far away from home? Tired of Restaurants? Don't want oily and unhealthy food? Want some hygienic homemade food? No worries, because Food zone is here for you...Yes Food zone provide you the healthy and hygienic food prepared by best cooks. All you need is to order here and your food will be deliver at your door step no matters where you are, either in your office or want your food at your home or outside the home your food will be provided anywhere in Karachi.<br>So, what are you waiting for<br>Order Now....</p>
				<p class="text-center to-animate"><a href="#" class="btn btn-primary btn-outline">Get in touch</a></p>
			</div>
		</div>

		<div id="fh5co-sayings">
			<div class="container">
				<div class="row to-animate">

					<div class="flexslider">
						<ul class="slides">
							
							<li>
								<blockquote>
									<p>&ldquo;Cooking is an art, but all art requires knowing something about the techniques and materials&rdquo;</p>
									<p class="quote-author">&mdash; Nathan Myhrvold</p>
								</blockquote>
							</li>
							<li>
								<blockquote>
									<p>&ldquo;Give a man food, and he can eat for a day. Give a man a job, and he can only eat for 30 minutes on break.&rdquo;</p>
									<p class="quote-author">&mdash; Lev L. Spiro</p>
								</blockquote>
							</li>
							<li>
								<blockquote>
									<p>&ldquo;Find something you’re passionate about and keep tremendously interested in it.&rdquo;</p>
									<p class="quote-author">&mdash; Julia Child</p>
								</blockquote>
							</li>
							<li>
								<blockquote>
									<p>&ldquo;Never work before breakfast; if you have to work before breakfast, eat your breakfast first.&rdquo;</p>
									<p class="quote-author">&mdash; Josh Billings</p>
								</blockquote>
							</li>
							
							
						</ul>
					</div>

				</div>
			</div>
		</div>

				<div id="fh5co-menus" data-section="menu" style="margin-top:-100px;">
			<div class="container">
				<div class="row text-center fh5co-heading row-padded">
					<div class="col-md-8 col-md-offset-2">
						<h2 class="heading to-animate">Food Menu</h2>
						<p class="sub-heading to-animate">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
					</div>
				</div>
				<div class="row row-padded">
					<div class="col-md-12">
						<div class="fh5co-food-menu to-animate-2">
							<ul>
								<?php
									 // Check connection
									if (mysqli_connect_errno($con)) {
										echo "Failed to connect to MySQL: " . mysqli_connect_error();
									}

    								//Get number of rows
									$sql="SELECT * FROM `menu`";
    								$result=mysqli_query($con, $sql);
									$i=1;
    								while($row=mysqli_fetch_assoc($result))
									{
										if($i>10)
										  break;
										$title = $row['Title'];
										$foodType = $row['Food_type'];
										$ingredients = $row['Ingredients'];
										$dishType = $row['Dish_Type'];
										$people = $row['People_Quantity'];
										$price = $row['Price'];
										$description = $row['Description'];
										$loc = $row['Location'];
										$time = $row['Time'];
										$menuId = $row['MenuID'];
										$approved = $row['approved'];
									if($approved == 1){
										//Start table
    								echo "<li>";
    								echo "<div class='fh5co-food-desc'>";
									// Loop through the results from the database
									
									// Show entries
										echo    
											"<figure>";
											$media_query="SELECT * FROM media where MenuID = $menuId";
											$media_result=mysqli_query($con, $media_query);
											$media_row=mysqli_fetch_assoc($media_result);
												?>
												
												<img src='uploads/<?php echo $media_row["MediaName"]; ?>' class='img-responsive' alt='Free HTML5 Templates by FREEHTML5.co'>
												<?php
										echo "</figure>
											<div>
											<h3>$title</h3>
											<p>$description</p>
											</div>
											</div>
											<div class='fh5co-food-pricing' style='width:200px;'>
											<b>Rs $price</b>
											<br/>
											<a class='btn btn-primary' href='menuDetails.php?menuid=$menuId'>View</a>
											<a class='btn btn-primary' href='order.php?menuid=$menuId'>Order</a>
											";						

									echo "</div>
										  </li>";
											$i++;
									} 
								}
								?>
							</ul>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 col-md-offset-4 text-center to-animate-2">
						<p><a href="otherMenu.php" class="btn btn-primary btn-outline">More Food Menu</a></p>
					</div>
				</div>
			</div>
		</div>
		<div id="fh5co-contact" data-section="reservation" style="margin-top:-200px;">
			<div class="container">
				<div class="row text-center fh5co-heading row-padded">
					<div class="col-md-8 col-md-offset-2">
						<h2 class="heading to-animate">Event Ordering</h2>
						<p class="sub-heading to-animate">Food Zone not only provides you the daily routine meal but you may even order Home Made Food for your events. All you have to do is just reserve you events by filling this form.</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 to-animate-2">
						<h3>Contact Info</h3>
						<ul class="fh5co-contact-info">
							<li class="fh5co-contact-address ">
								<i class="icon-home"></i>
								5555 Love Paradise 56 New Clity 5655, <br>Excel Tower United Kingdom
							</li>
							<li><i class="icon-phone"></i> (123) 465-6789</li>
							<li><i class="icon-envelope"></i>anumr32@gmail.com</li>
							<li><i class="icon-globe"></i> <a href="https://food-zone.000webhostapp.com/index.php" target="_blank">food-zone.000webhostapp.com</a></li>
						</ul>
					</div>
					<?php
					$con_date = $con_name = $con_mail = $con_ossacion = $con_message = "";
						 // Check connection
						 if (mysqli_connect_errno($con)) {
							echo "Failed to connect to MySQL: " . mysqli_connect_error();
						}
						if(isset($_POST['contact_submit'])){
							//Getting form values
							if(!empty($_POST['contact_name']))
							{
								$con_name = $_POST['contact_name'];
							}
							if(!empty($_POST['contact_mail']))
							{
								$con_mail = $_POST['contact_mail'];
							}
							if(!empty($_POST['occassion']))
							{
								$con_ossacion = $_POST['occasion'];
							}
							if(!empty($_POST['event_date']))
							{
								$con_date = $_POST['event_date'];
							}
							if(!empty($_POST['contact_message']))
							{
								$con_message = $_POST['contact_message'];
							}
							$to = "anumr32@gmail.com";
							$subject = "Event Reservation";
							$message = "<h1>$con_ossacion Reservation</h1><br/><b>$con_name</b><br/><p>$con_message</p><br/><b>Event Date: $con_date</b>";
							$headers = "From: ". $con_mail;
							$headers .= "MIME-Version: 1.0" . "\r\n";
							$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
							mail($to,$subject,$message,$headers);
						}
					?>
					<div class="col-md-6 to-animate-2">
						<h3>Reservation Form</h3>
						<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
						<div class="form-group ">
							<label for="name" class="sr-only">Name</label>
							<input id="name" class="form-control" placeholder="Name" type="text" name="contact_name" required>
						</div>
						<div class="form-group ">
							<label for="email" class="sr-only">Email</label>
							<input id="email" class="form-control" placeholder="Email" type="email" name="contact_mail" required>
						</div>
						<div class="form-group">
							<label for="occation" class="sr-only">Occation</label>
							<select class="form-control" id="occation" name="occasion" required>
								<option>Select an Occation</option>
							  <option value="Wedding Ceremony">Wedding Ceremony</option>
							  <option value="Birthday">Birthday</option>
							  <option value="Other Event">Others</option>
							</select>
						</div>
						<div class="form-group ">
							<label for="date" class="sr-only">Date</label>
							<input id="date" class="form-control" placeholder="Date &amp; Time" type="text" nme="event_date" required>
						</div>


							
						<div class="form-group ">
							<label for="message" class="sr-only">Message</label>
							<textarea name="" id="message" cols="30" rows="5" class="form-control" placeholder="Message" name="contact_message"></textarea>
						</div>
						<div class="form-group ">
							<input type="submit" class="btn btn-primary" value="Send Message" type="submit" name="contact_submit">
						</div>
						</form>
						</div>
				</div>
			</div>
		</div>

		
	</div>

	<div id="fh5co-footer">
		<div class="container">
			<div class="row row-padded">
				<div class="col-md-12 text-center">
					<p class="text-center to-animate"><a href="#" class="js-gotop">Go To Top</a></p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-center">
					<ul class="fh5co-social">
						<li class="to-animate-2"><a href="#"><i class="icon-facebook"></i></a></li>
						<li class="to-animate-2"><a href="#"><i class="icon-twitter"></i></a></li>
						<li class="to-animate-2"><a href="#"><i class="icon-instagram"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>


	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Flexslider -->
	<script src="js/jquery.flexslider-min.js"></script>
	<!-- Stellar Parallax -->
	<script src="js/jquery.stellar.min.js"></script>
	<!-- Bootstrap DateTimePicker -->
	<script src="js/moment.js"></script>
	<script src="js/bootstrap-datetimepicker.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	

	
	<script>
		$(function () {
	       $('#date').datetimepicker();
	   });

	   var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
};

var logout = getUrlParameter("logout");
if(logout == "1"){
	$("#login").click();
}
	</script>
	<!-- Main JS -->
	<script src="js/main.js"></script>

	</body>
</html>