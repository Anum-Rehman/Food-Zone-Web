<?php include ('connection.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
<link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,700,400italic,700italic|Merriweather:300,400italic,300italic,400,700italic' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/style.css">
<meta charset="utf-8">
<link rel="stylesheet" href="Menu_Detail/css/reset.css" type="text/css" media="screen">
<link href="http://fonts.googleapis.com/css?family=PT+Serif+Caption:400,400italic" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="Menu_Detail/css/flexslider.css" type="text/css" media="screen">
<script src="Menu_Detail/js/jquery-1.7.1.min.js" ></script>
<script src="Menu_Detail/js/superfish.js"></script>
<script src="Menu_Detail/js/jquery.flexslider-min.js"></script>
<script>
jQuery(window).load(function () {
    jQuery('.flexslider').flexslider({
        animation: "fade",
        slideshow: true,
        slideshowSpeed: 7000,
        animationDuration: 600,
        prevText: "",
        nextText: "",
        controlNav: false
    })
});
</script>
</head>
<body>
    <?php
    if(isset($_GET["menuid"])){
        $menu = $_GET["menuid"];
        $detail_query = mysqli_query($con,"SELECT * FROM `menu` WHERE `MenuID` = $menu");
        $data = mysqli_fetch_assoc($detail_query);
        $title = $data['Title'];
        $foodType = $data['Food_type'];
        $ingredients = $data['Ingredients'];
        $dishType = $data['Dish_Type'];
        $people_quantity = $data['People_Quantity'];
        $price = $data['Price'];
        $des = $data['Description'];
        $loc = $data['Location'];
        $time = $data['Time'];
        $user_id = $data['UID'];
        $media_query = mysqli_query($con,"SELECT * FROM `media` WHERE `MenuID`='$menu'");
        $media_data = mysqli_fetch_assoc($media_query);
        $media_name = $media_data['MediaName'];
        $user_query = mysqli_query($con,"SELECT * FROM `cook_registration` WHERE `UID` = '$user_id'");
        $user_data = mysqli_fetch_assoc($user_query);
        $name = $user_data['Full_name'];
        $email = $user_data['Email'];
        $cont = $user_data['Contact'];
        $gender = $user_data['Gender'];
        ?>
        <section class="inside-banner" id="cook-header">
        <div class="container"> 
            <span class="pull-right head"><button class="btn btn-primary" style="background-color:white!important; border-radius: 15px;"><a href="index.php" class="cook-link">Home</a></button></span>
            <h2 class="head fh5co-logo" style="font-weight:bold; font-size:60px;">food zone</h2>
</section>
<header>
  <div class="line-top"></div>
  <br>
  <div class="box-slogan">
 <?php echo "<h1>$title</h1>" ?>
</div>
  <div class="box-slider">
    <div class="flexslider">
      <ul class="slides">
        <li> <img alt="" src="uploads/<?php echo $media_name;?>"></li>
      </ul>
    </div>
  </div>
  <div class="box-slogan">
    <br/>
    <p style="color:black;"> <?php echo $des; ?> 
    <br>
    Charges of Each: Rs. <?php echo $price; ?>/=
    </p>
  </div>
</header>
<section id="content">
  <div class="border-horiz"></div>
  <div class="container_12">
      <br>
    <section class="grid_4">
      <h3 style="font-size:20px;">COOK'S DETAIL</h3>
      <ul>
        <p>Name: <b><?php echo $name; ?></b></p>
        <li>Contact Number: <a href="<?php echo $cont; ?>"><?php echo $cont; ?></a></li>
        <li>Email Address: <a href="mailto:anumr32@gmail.com"><?php echo $email ?></a></li>
        <p>Residence: <b><?php echo $loc;?></b></p>
      </ul>
    </section>
    <section class="grid_8">
      <h3 style="font-size:20px;">DISH DETAILS</h3>
      <ul>
        <div class="row">
            <li class="col-sm-4">FOOD TYPE: <?php echo $foodType; ?></li>
            <li class="col-sm-3">TASTE: <?php echo $ingredients; ?></li>
            <li class="col-sm-5">DISH TYPE: <?php echo $dishType; ?></li>
        </div>
        <div class="row">
            <li class="col-sm-4">No. of Dishes: <?php echo $people_quantity ?></li>
            <li class="col-sm-6">Time of Post: <?php echo $time; ?></li>
        </div>
      </ul>
    <div class="clear"></div>
  </div>
</section>
<?php 
}
    ?>
</body>
</html>