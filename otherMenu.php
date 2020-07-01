<?php include ('connection.php'); ?>
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
<link rel="stylesheet" href="css/bootstrap.min.css">

<link rel="stylesheet" href="css/style.css">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<!-- Modernizr JS -->
<script src="js/modernizr-2.6.2.min.js"></script>
<script src="js/jquery.min.js"></script>
</head>
<body>
<section class="inside-banner" id="cook-header">
        <div class="container"> 
            <span class="pull-right head"><button class="btn btn-primary" style="background-color:white!important; border-radius: 15px;"><a href="index.php" class="cook-link">Home</a></button></span>
            <h2 class="head fh5co-logo" style="font-weight:bold; font-size:60px;">food zone</h2>
</section>
<div class="container">
				<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?> method="POST" >
				<div class="col-sm-6"></div>
                        <div class="form-group">
                                <label class="control-label col-sm-1">Search</label>
                                    <div class="col-sm-4">
                                        <input type="search" class="form-control" name="find" required value="">
                                    </div>
                                    <div class="col-sm-1">
                                        <input type="submit" class="btn btn-primary" value="Search" name="search">
                                    </div>
                            </div>
                        </div>
                        </form>
						</div>
			<div id="fh5co-menus" data-section="menu" style="margin-top:-50px;">
			<div class="container">
				<div class="row text-center fh5co-heading row-padded">
					<div class="col-md-8 col-md-offset-2">
						<h2 class="heading ">Food Menu</h2>
					</div>
				</div>
				
						<div>
						</div>
				<div class="row row-padded">
					<div class="col-md-12">
						<div class="fh5co-food-menu">
						
							<ul>
								<?php
									 // Check connection
									if (mysqli_connect_errno($con)) {
										echo "Failed to connect to MySQL: " . mysqli_connect_error();
									}
									if(isset($_POST['search'])){
										$value = $_POST['find'];
										$sql = "SELECT * FROM `menu` WHERE `MenuID` LIKE '%$value%' OR `Title` LIKE '%$value%' OR `UID` LIKE '%$value%'";
									  }
									else{
    								//Get number of rows
									$sql="SELECT * FROM `menu`";
									}
    								$result=mysqli_query($con, $sql);
									$i=1;
									$j=1;
    								while($row=mysqli_fetch_assoc($result))
									{
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
											<div class='fh5co-food-pricing'>
											Rs $price
											<br/>
											<a class='btn btn-primary' href='menuDetails.php?menuid=$menuId'>View</a>
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
</body>
</html>