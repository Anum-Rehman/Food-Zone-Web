<?php include ('../connection.php'); ?>
<?php 
session_start();
if(empty($_SESSION['userID'])){
	header("../location:index.php");
}
?>
<?php
if(isset($_GET['menuid'])){
    $fetch_menu_id = $_GET['menuid'];
}
$fetch_user_id = $_SESSION['userID'];
$fetch_media_id="";
    include ('../connection.php');
    if(!empty($_GET['menuid'])){
        $edit_query = mysqli_query($con,"SELECT * FROM menu WHERE MenuID = '$fetch_menu_id'");
        $fetch = mysqli_fetch_assoc($edit_query);
        $fetch_title = $fetch['Title'];
        $fetch_foodType = $fetch['Food_type'];
        $fetch_ingredients = $fetch['Ingredients'];
        $fetch_dishType = $fetch['Dish_Type'];
        $fetch_people = $fetch['People_Quantity'];
        $fetch_price = $fetch['Price'];
        $fetch_des = $fetch['Description'];
        $fetch_loc = $fetch['Location'];
        $fetch_time = $fetch['Time'];
        $fetch_media = mysqli_query($con,"SELECT * FROM media WHERE MenuID = '$fetch_menu_id'");
       $data_media = mysqli_fetch_assoc($fetch_media);
       $fetch_media_id = $data_media['MediaID'];
       $fetch_media_name = $data_media['MediaName'];
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
 //Validating input field values
   if(isset($_POST['submit'])){
       $form_menu_id = $_POST["form_menu_id"];
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
       $query = mysqli_query($con,"UPDATE `menu` SET `Title`='$title', `Food_type`= '$tradition', `Ingredients`='$ingredients', `Dish_Type`='$dishType', `People_Quantity`='$peopleQuantity', `Price`='$price', `Description`='$description', `Location`='$location' WHERE `UID` ='$fetch_user_id' AND `MenuID` = '$form_menu_id'");
       if($query == true){
           $img = $_FILES['img'];
           if(!empty($img))
           {
               $img_desc = reArrayFiles($img);
           
               
               foreach($img_desc as $val)
               {
                   $newname = $val['name'];
                   move_uploaded_file($val['tmp_name'],'../uploads/'.$newname);
                   mysqli_query($con,"UPDATE `media` SET MediaName = '$newname' WHERE MenuID = '$fetch_menu_id' AND MediaID = '$form_menu_id'");
               }
           }
           $sql = "SELECT * FROM `foodee`";
           $result=mysqli_query($con, $sql);
           $i=1;
           header("Location: editPost.php?menuid=".$form_menu_id."&update=1");
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
   <h1 style="text-align: center; font-family: 'Merriweather', serif; font-weight:bold;">TODAY'S MENU<span><img src="../images/cook/chef.png" alt="" height="120px" width="120px"></span></h1>
                           <!-- Message alerts for signup form -->
                           <?php if(isset($_GET['update']) == '1') { ?>
                           <div class="alert alert-success alert-dismissible" role="alert" style="width:60%; margin:auto;">
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                     <strong>Status: </strong> <?php echo "Updated Successfully" ?> 
                           </div>

                           <?php } ?>
                           <?php if($_SESSION['failed']) { ?>
                           <div class="alert alert-danger alert-dismissible" role="alert" style="width:60%; margin:auto;">
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                     <strong>Failed: </strong> <?php echo $_SESSION['failed'] ?> 
                           </div>
                           <?php } ?>
                           <form multipart="" enctype="multipart/form-data" role="form" class="form-horizontal cook-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" name="menu_form">
                           <input type="hidden" value="<?php echo $fetch_menu_id; ?>" name="form_menu_id"/>
                               <div class="note" id="warning">Fields with * are required fields</div>
                               <div class="form-group">
                                   <label for="Title" class="control-label col-sm-4">Title:<b class="note"> *</b></label>
                                   <div class="col-sm-8">
                                       <input type="text" id="Title" class="form-control" placeholder="Dish Title" name="title" required value="<?php echo htmlspecialchars($fetch_title);?>">
                                   </div>
                                   <div class="col-sm-4"></div>
                                   <div id="emailErr" class="col-sm-8 note"><?php echo $titleErr ?></div>
                               </div>
                               <div class="form-group">
                                   <label for="tradition" class="control-label col-sm-4">Food Type: <b class="note"> *</b></label>
                                   <div class="col-sm-8">
                                       <select name="tradition" class="form-control" id="tradition" required>
                                       <option value="Pakistani" <?php if($fetch_foodType == "Pakistani") {echo 'selected';} ?>>Pakistani</option>
                                       <option value="Chinese" <?php if($fetch_foodType == "Chinese") {echo 'selected';} ?>>Chinese</option>
                                       <option value="Indian" <?php if($fetch_foodType == "Indian") {echo 'selected';} ?>>Indian</option>
                                       <option value="Italian" <?php if($fetch_foodType == "Italian") {echo 'selected';} ?>>Italian</option>
                                       <option value="Mexican" <?php if($fetch_foodType == "Mexican") {echo 'selected';} ?>>Mexican</option>
                                       <option value="Singaporian" <?php if($fetch_foodType == "Singaporian") {echo 'selected';} ?>>Singaporian</option>
                                       <option value="other">Other</option>
                           </select>
                                   </div>
                               </div>
                               <div class="form-group">
                                   <label for="ingredients" class="control-label col-sm-4">Taste 0f Dish: <b class="note"> *</b></label>
                                   <div class="col-sm-8">
                                       <select name="ingredients" class="form-control" id="ingredients" required>
                                       <option value="Spicy" <?php if($fetch_ingredients == "Spicy") {echo 'selected';} ?>>Spicy</option>
                                       <option value="Salty" <?php if($fetch_ingredients == "Salty") {echo 'selected';} ?>>Salty</option>
                                       <option value="Sweet" <?php if($fetch_ingredients == "Sweet") {echo 'selected';} ?>>Sweet</option>
                                       <option value="Sour" <?php if($fetch_ingredients == "Sour") {echo 'selected';} ?>>Sour</option>
                                       <option value="Other" <?php if($fetch_ingredients == "Other") {echo 'selected';} ?>>Other</option>
                           </select>
                                   </div>
                               </div>
                               <div class="form-group">
                                   <label for="type" class="control-label col-sm-4">Type 0f Dish: <b class="note"> *</b></label>
                                   <div class="col-sm-8">
                                       <select name="type" class="form-control" id="type" required>
                                       <option value="Sweet Dish" <?php if($fetch_dishType == "Sweet Dish") {echo 'selected';} ?>>Sweet Dish</option>
                                       <option value="Routine Dish" <?php if($fetch_dishType == "Routine Dish") {echo 'selected';} ?>>Routine Dish</option>
                                       <option value="Vegeterian" <?php if($fetch_dishType == "Vegeterian") {echo 'selected';} ?>>Vegeterian</option>
                                       <option value="Non-Vegeterian" <?php if($fetch_dishType == "Non-Vegeterian") {echo 'selected';} ?>>Non-Vegeterian</option>
                                       <option value="Rice" <?php if($fetch_dishType == "Rice") {echo 'selected';} ?>>Rice</option>
                                       <option value="Roti or Paratha" <?php if($fetch_dishType == "Roti or Paratha") {echo 'selected';} ?>>Roti or Paratha</option>
                                       <option value="Soup" <?php if($fetch_dishType == "Soup") {echo 'selected';} ?>>Soup</option>
                                       <option value="Juice" <?php if($fetch_dishType == "Juice") {echo 'selected';} ?>>Juice</option>
                                       <option value="Baked Dish" <?php if($fetch_dishType == "Baked Dish") {echo 'selected';} ?>>Baked Dishes</option>
                                       <option value="Pizza" <?php if($fetch_dishType == "Pizza") {echo 'selected';} ?>>Pizza</option>
                                       <option value="Other" <?php if($fetch_dishType == "Other") {echo 'selected';} ?>>Other</option>
                           </select>
                                   </div>
                               </div>
                           <div class="form-group">
                               <label class="control-label col-sm-4">For how many People?<b class="note"> *</b></label>
                               <div class="col-sm-8">
                                   <input type="number" class="form-control" name="people_quantity" placeholder="Quantity of People" required value="<?php echo htmlspecialchars($fetch_people);?>">
                               </div>
                           </div>
                           <div class="form-group">
                               <label class="control-label col-sm-4">Price<b class="note"> *</b></label>
                               <div class="col-sm-8">
                                   <input type="number" class="form-control" name="price" placeholder="Price" required value="<?php echo htmlspecialchars($fetch_price);?>">
                               </div>
                           </div>
                           <div class="form-group">
                               <label class="control-label col-sm-4">Description<b class="note"> *</b></label>
                               <div class="col-sm-8">
                               <textarea class="form-control" name="description" rows="5" placeholder="Description about the Dish..." required><?php echo $fetch_des;?></textarea>
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
                                   <input type="text" class="form-control" name="location" placeholder="Your Location" required value="<?php echo htmlspecialchars($fetch_loc);?>">
                               </div>
                               <div class="col-sm-4"></div>
                               <div class="col-sm-8 note"><?php echo $locationErr; ?></div>
                           </div>
                           <hr/>
           <button class="btn btn-primary pull-right" type="submit" style="font-size:16px; font-family:Calibri" name="submit">Submit</button>
                           </form>
</body>
</html>