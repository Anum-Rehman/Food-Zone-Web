<?php include ('../connection.php') ?>
<?php 
session_start();
    $_SESSION['error'] = "";
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
		$password = $password;
		if(!empty($password) && !empty($mail)){
			$login_query = mysqli_query($con,"SELECT `AID`, `Password`, `Email` FROM `admin` WHERE `Email` = '$mail'");
			if(mysqli_num_rows($login_query)>0){
                    $data = mysqli_fetch_array($login_query);
					$myEmail = $data['Email'];
					$myEmail = mysqli_real_escape_string($con,$myEmail);
					if($data['Password']!==$password){
						$_SESSION['error'] = "Invalid password <a href='http://localhost/testing/forgot.php?Email=$myEmail'>Forgot Password?</a>";
					}
					else{ 
						$_SESSION['adminID'] = $data['AID'];
                        $_SESSION['adminEmail'] = $data['Email'];
                        if(isset($_SESSION["adminID"])) {
                            ?>
                            <script>window.location.href="index.php";</script>
    <?php
    }
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
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel</title>
    <!-- Animate.css -->
	<link rel="stylesheet" href="../css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="../css/icomoon.css">
	<!-- Simple Line Icons -->
	<link rel="stylesheet" href="../css/simple-line-icons.css">
	<!-- Datetimepicker -->
	<link rel="stylesheet" href="../css/bootstrap-datetimepicker.min.css">
	<!-- Flexslider -->
	<link rel="stylesheet" href="./css/flexslider.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div class="jumbotron"></div>
	<div class="container" style="padding:10px 300px;">
		<!-- Modal -->
		<div>
			<div>

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header" style="padding:35px 50px; background-color:#bf4c03!important;">
						<h4 style="background-color:#bf4c03; font-family: 'Times New Roman', Times, serif; color:white; font-size:24px;" class="text-center"><i class="fas fa-lock"></i><b >Login</b></h4>
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
								<input type="text" class="form-control" id="usrname" placeholder="Email Address" name="mail" required value="<?php echo htmlspecialchars($mail); ?>">
							</div>
							<div class="form-group">
								<label for="pswrd"><i class="fas fa-eye"></i> Password</label>
								<input type="password" class="form-control" id="pswrd" name="pswrd" placeholder = "Password" required value="<?php echo htmlspecialchars($password); ?>">
							</div>
							<div class="checkbox">
								<label><input type="checkbox" value="" checked>Remember me</label>
							</div>
							<button type="submit" name="login" class="btn btn-success btn-block" style="background-color:#bf4c03;font-size:20px; font-family: 'Times New Roman', Times, serif;"><i class="fas fa-power-off"></i></span>Login</button>
						</form>
					</div>
					<div class="modal-footer">
						
						Forgot <a href="#">Password?</a></p>
					</div>
				</div>
			</div>
		</div>
</body>
</html>