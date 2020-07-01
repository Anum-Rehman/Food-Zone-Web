<?php include ('../connection.php'); ?>
<?php 
session_start();
if(empty($_SESSION['userID'])){
    header("../location:index.php");
}
    $cook_id = $_SESSION['userID'];
    
   
//	if(isset($_POST['submit'])){
		for($x = 1; $x <=7; $x++){
           
		/*	$insert_menu = mysqli_query($con,"INSERT INTO week_menu (`breakfast`, `Lunch`, `Supper`, `Dinner`, `week_ID`, `UID`) 
			VALUES ('$break_val','$lunch_val','$supper_val','$dinner_val','$x','$session_user_id')");
			if($insert_menu){
				echo "posted successfully";
			}
			else{
				echo "failed to post";
			} */
		}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Food Zone</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Template by FREEHTML5.CO" />
	<meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
	<meta name="author" content="FREEHTML5.CO" />
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
	<link rel="stylesheet" href="../css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="../css/icomoon.css">
	<!-- Simple Line Icons -->
	<link rel="stylesheet" href="../css/simple-line-icons.css">
	<!-- Datetimepicker -->
	<link rel="stylesheet" href="../css/bootstrap-datetimepicker.min.css">
	<!-- Flexslider -->
	<link rel="stylesheet" href="../css/flexslider.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	
	<link rel="stylesheet" href="../css/style.css">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<!-- Modernizr JS -->
	<script src="../js/modernizr-2.6.2.min.js"></script>
	<!-- jQuery -->
	<script src="../js/jquery.min.js"></script>
</head>
<body>
<section class="inside-banner" id="cook-header">
        <div class="container"> 
            <span class="pull-right head"><button class="btn btn-primary" style="background-color:white!important; border-radius: 15px;"><a href="index.php" class="cook-link">Home</a></button></span>
            <h2 class="head fh5co-logo" style="font-weight:bold; font-size:60px;">food zone</h2>
</section>
<div class="container">    
<h1 style="text-align: center; font-family: 'Merriweather', serif; font-weight:bold;">YOUR WEEKLY MENU<span><img src="../images/menu.png" alt="" height="120px" width="120px"></span></h1>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
  <table class="table table-bordered">
    <thead>
      <tr>
	  	<th></th>
        <th>BREAKFAST</th>
        <th>LUNCH</th>
        <th>SUPPER</th>
		<th>DINNER</th>
      </tr>
    </thead>
    <tbody>
	<?php 
		$select_week = mysqli_query($con,"SELECT * FROM week");
		while($fetch_week_data = mysqli_fetch_assoc($select_week)){
			$week_id = $fetch_week_data['week_ID'];
            $week_day = $fetch_week_data['Day'];
            $select_menu = mysqli_query($con,"SELECT * FROM week_menu WHERE UID = '$cook_id'");
            $fetch_menu = mysqli_fetch_assoc($select_menu);
            $break_val = $fetch_menu['breakfast'];
			$lunch_val = $fetch_menu['Lunch'];
			$supper_val = $fetch_menu['Supper'];
            $dinner_val = $fetch_menu['Dinner'];	
	?>
      <tr>
        <th name="monday"><?php echo $week_day; ?></th>
        <td><input type="text" class="form-control" name="break_val_<?php echo $week_id; ?>" value="<?php echo $break_val; ?>"></td>
		<td><input type="text" class="form-control" name="lunch_val_<?php echo $week_id; ?>" value="<?php echo $lunch_val; ?>"></td>
		<td><input type="text" class="form-control" name="supper_val_<?php echo $week_id; ?>" value="<?php echo $supper_val; ?>"></td>
		<td><input type="text" class="form-control" name="dinner_val_<?php echo $week_id; ?>" value="<?php echo $dinner_val; ?>"></td>
      </tr>
		<?php } ?>
    
    </tbody>
  </table>
  <button class="btn btn-primary pull-right" name="submit">SUBMIT</button>
</div>
</form>
</body>
</html>