<?php include 'connection.php' ?>
<?php 
session_start();
if(empty($_SESSION['userID'])){
	header("location:index.php");
}
 //Declaring session variables
 $_SESSION['status'] = ''; 
 $_SESSION ['failed'] = ''; 
 ?>
<?php
$title = $tradition = $ingredients = $dishType = $peopleQuantity = $price = $description = $location = $contact = $name = "";
$titleErr = $traditionErr = $ingredientsErr = $dishTypeErr = $peopleQuantityErr = $priceErr = $descriptionErr = $locationErr = $timeErr = $contactErr = $nameErr = "";
function reArrayFiles($file)
{
    $file_ary = array();
    $file_count = count($file['name']);
    $file_key = array_keys($file);
    
    for($i=0;$i<$file_count;$i++)
    {
        foreach($file_key as $val)
        {
            $file_ary[$i][$val] = $file[$val][$i];
        }
    }
    return $file_ary;
}
		
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  //Validating input field values
	if(isset($_POST['submit'])){
		
		if(!empty($_POST['title'])){
			if(!preg_match("|^[A-Za-z]'?[- a-zA-Z]{3,25}+$|",$_POST['title'])){
				$titleErr = "Only letters, white space and - allowed";
            }
            else if($_POST['title']<=100 && $_POST['title']>=10){
                $titleErr = "Title must be of 10 chracters and less the 100 characters";
            }
			else{
				$title = $_POST['title'];
			}
        }
        if(!empty($_POST['tradition'])){
				$tradition = $_POST['tradition'];
        }
        if(!empty($_POST['ingredients'])){
            $ingredients = $_POST['ingredients'];
        }
        if(!empty($_POST['type'])){
            $dishType = $_POST['type'];
        }
        if(!empty($_POST['people_quantity'])){
            $peopleQuantity = $_POST['people_quantity'];
        }
        if(!empty($_POST['price'])){
            $price = $_POST['price'];
        }
        if(!empty($_POST['description'])){
			 if($_POST['description']>=20 && $_POST['description']<=2000)
			{
				$descriptionErr = "Description must be less than 2000 characters and greater than 20 characters.";
            }
            else{
                $description = $_POST['description'];
            }
		}
		if(!empty($_POST['location'])){
			if(!preg_match("|^[A-Za-z]'?[- a-zA-Z]{3,25}+$|",$_POST['title'])){
				$locationErr = "Only letters, white space and - allowed";
            }
			else{
				$location = $_POST['location'];
			}
        }
        date_default_timezone_set("Asia/Karachi");
		$uid = $_SESSION["userID"];
		if(!empty($title) && !empty($tradition) && !empty($ingredients) && !empty($dishType) && !empty($peopleQuantity) && !empty($price) && !empty($description) && !empty($location)){
        $query = mysqli_query($con,"INSERT INTO `menu`(`Title`, `Food_type`, `Ingredients`, `Dish_Type`, `People_Quantity`, `Price`, `Description`, `Location`,`UID`) 
        VALUES ('$title','$tradition','$ingredients','$dishType','$peopleQuantity','$price','$description','$location',$uid)");
        if($query == true){
			$last_id = mysqli_insert_id($con);
			$img = $_FILES['img'];
			if(!empty($img))
			{
				$img_desc = reArrayFiles($img);
			
				
				foreach($img_desc as $val)
				{
					$newname = $val['name'];
					move_uploaded_file($val['tmp_name'],'./uploads/'.$newname);
					mysqli_query($con,"INSERT INTO `media`(`MediaName`, `MenuID`) VALUES ('$newname','$last_id')");
				}
			}
			$sql = "SELECT * FROM `foodee`";
			$result=mysqli_query($con, $sql);
			$i=1;
			while($row=mysqli_fetch_assoc($result))
			{
				$email = $row['Email'];
				//send email
			$to = $email;
			$subject = "FOOD ZONE Updates";
			$message = "<p>Here's the today's menu order now.<br/><br/>"."<h1>".$title."</h1><br/>".$description."<br/>Rs ".$price."<br/><b>".$name."</b> ".$contact."
			<br/><a href='http://localhost/testing/index.php#fh5co-menus'><button style='font-size:16px; font-family:Calibri; color:white; background-color:#fb6e14; width:100px; 
			height: 50px; border-radius: 5px;'>Details</button><a/></p>";
			$headers = "From: anumr32@gmail.com";
			$headers .= "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			mail($to,$subject,$message,$headers);
			}
			$_SESSION['status'] = "Posted Successfully.";
        }
        else{
            $_SESSION['failed'] = "Failed to Post";
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

	</head>
<body>
<section class="inside-banner" id="cook-header">
        <div class="container"> 
            <span class="pull-right head"><button class="btn btn-primary" style="background-color:white!important; border-radius: 15px;"><a href="index.php" class="cook-link">Home</a></button></span>
            <h2 class="head fh5co-logo" style="font-weight:bold; font-size:60px;">food zone</h2>
</section>
    <section>
	<h1 style="text-align: center; font-family: 'Merriweather', serif; font-weight:bold;">TODAY'S MENU<span><img src="images/cook/chef.png" alt="" height="120px" width="120px"></span></h1>
							<!-- Message alerts for signup form -->
							<?php if($_SESSION['status']) { ?>
							<div class="alert alert-success alert-dismissible" role="alert" style="width:60%; margin:auto;">
  								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  									<strong>Status: </strong> <?php echo $_SESSION['status'] ?> 
							</div>

							<?php } ?>
							<?php if($_SESSION['failed']) { ?>
							<div class="alert alert-danger alert-dismissible" role="alert" style="width:60%; margin:auto;">
  								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  									<strong>Failed: </strong> <?php echo $_SESSION['failed'] ?> 
							</div>
							<?php } ?>
							<form multipart="" enctype="multipart/form-data" role="form" class="form-horizontal cook-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" name="menu_form">
								<div class="note" id="warning">Fields with * are required fields</div>
								<div class="form-group">
									<label for="Title" class="control-label col-sm-4">Title:<b class="note"> *</b></label>
									<div class="col-sm-8">
										<input type="text" id="Title" class="form-control" placeholder="Dish Title" name="title" required value="<?php echo htmlspecialchars($title);?>">
									</div>
									<div class="col-sm-4"></div>
									<div id="emailErr" class="col-sm-8 note"><?php echo $titleErr ?></div>
								</div>
								<div class="form-group">
									<label for="tradition" class="control-label col-sm-4">Food Type: <b class="note"> *</b></label>
									<div class="col-sm-8">
										<select name="tradition" class="form-control" id="tradition" required value="<?php echo htmlspecialchars($tradition);?>">
										<option value=""></option>
										<option value="Pakistani">Pakistani</option>
										<option value="Chinese">Chinese</option>
										<option value="Indian">Indian</option>
										<option value="Italian">Italian</option>
										<option value="Mexican">Mexican</option>
										<option value="Singaporian">Singaporian</option>
										<option value="other">Other</option>
							</select>
									</div>
								</div>
								<div class="form-group">
									<label for="ingredients" class="control-label col-sm-4">Taste 0f Dish: <b class="note"> *</b></label>
									<div class="col-sm-8">
										<select name="ingredients" class="form-control" id="ingredients" required value="<?php echo htmlspecialchars($ingredients);?>">
										<option value=""></option>
										<option value="Spicy">Spicy</option>
										<option value="Salty">Salty</option>
										<option value="Sweet">Sweet</option>
										<option value="Sour">Sour</option>
										<option value="Other">Other</option>
							</select>
									</div>
								</div>
								<div class="form-group">
									<label for="type" class="control-label col-sm-4">Type 0f Dish: <b class="note"> *</b></label>
									<div class="col-sm-8">
										<select name="type" class="form-control" id="type" required value="<?php echo htmlspecialchars($dishType);?>">
										<option value=""></option>
										<option value="Sweet Dish">Sweet Dish</option>
										<option value="Routine Dish">Routine Dish</option>
										<option value="Vegeterian">Vegeterian</option>
										<option value="Non-Vegeterian">Non-Vegeterian</option>
										<option value="Rice">Rice</option>
										<option value="Roti or Paratha">Roti or Paratha</option>
										<option value="Soup">Soup</option>
										<option value="Juice">Juice</option>
										<option value="Baked Dish">Baked Dishes</option>
										<option value="Pizza">Pizza</option>
										<option value="Other">Other</option>
							</select>
									</div>
								</div>
							<div class="form-group">
            					<label class="control-label col-sm-4">For how many People?<b class="note"> *</b></label>
								<div class="col-sm-8">
									<input type="number" class="form-control" name="people_quantity" placeholder="Quantity of People" required value="<?php echo htmlspecialchars($peopleQuantity);?>">
								</div>
							</div>
							<div class="form-group">
            					<label class="control-label col-sm-4">Price<b class="note"> *</b></label>
								<div class="col-sm-8">
									<input type="number" class="form-control" name="price" placeholder="Price" required value="<?php echo htmlspecialchars($price);?>">
								</div>
							</div>
							<div class="form-group">
            					<label class="control-label col-sm-4">Description<b class="note"> *</b></label>
								<div class="col-sm-8">
								<textarea class="form-control" name="description" rows="5" placeholder="Description about the Dish..." required value="<?php echo htmlspecialchars($description);?>"></textarea>
								</div>
								<div class="col-sm-4"></div>
								<div class="col-sm-8 note"><?php echo $descriptionErr; ?></div>
							</div>
							<div class="form-group">
            					<label class="control-label col-sm-4">Upload Images<b class="note"> *</b></label>
								<div class="col-sm-8">
								<input type="file" name="img[]" multiple>
								</div>
								<div class="col-sm-4"></div>
							</div>
							<div class="form-group">
            					<label class="control-label col-sm-4">Your Location<b class="note"> *</b></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="location" placeholder="Your Location" required value="<?php echo htmlspecialchars($location);?>">
								</div>
								<div class="col-sm-4"></div>
								<div class="col-sm-8 note"><?php echo $locationErr; ?></div>
							</div>
							<hr/>
            <button class="btn btn-primary pull-right" type="submit" style="font-size:16px; font-family:Calibri" name="submit">Submit</button>
							</form>
</body>
</html>