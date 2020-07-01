<?php include ('../connection.php');?>
<?php 
session_start();?>
<?php
if(!isset($_SESSION['adminID'])){
	header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include ('link.php'); ?>
</head>
<body>
	<?php include ('header.php');?>
	<div class='col-md-6'>
                    <br>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" class='form-inline'>
                      <div class='form-group mx-sm-3 mb-2'>
                        <label for='inputPassword2' class='sr-only'>Password</label>
                        <input type='search' class='form-control' name='find' required value='' placeholder='Search'>
                    </div>
                    <input type='submit' class='btn btn-primary' value='Search' name='search'>
                    </form>
                    
                    
                    
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
               
                         <div class='panel panel-default'>
                        <div class='panel-heading text-center'>
    LIVE POSTS
    </div>
    <div class="panel-body">
        <div id="morris-donut-chart"></div>
        <div id="fh5co-menus" data-section="menu" style="margin-top:-90px;">
			<div class="container">
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
                                        $post_query = mysqli_query($con,"SELECT * FROM `menu` WHERE `MenuID` LIKE '%$value%' OR `Title` LIKE '%$value%' OR `UID` LIKE '%$value%'");
                                    }
                                    else{
                                        $post_query = mysqli_query($con,"SELECT * FROM `menu`");
                                    }
                                        $i=1;
                                        while($fetch = mysqli_fetch_assoc($post_query)){
                                            $menu_id = $fetch['MenuID'];
                                            $title = $fetch['Title'];
                                            $foodType = $fetch['Food_type'];
                                            $ingredients = $fetch['Ingredients'];
                                            $dishType = $fetch['Dish_Type'];
                                            $people = $fetch['People_Quantity'];
                                            $price = $fetch['Price'];
                                            $des = $fetch['Description'];
                                            $loc = $fetch['Location'];
                                            $time = $fetch['Time'];
                                            $approve = $fetch['approved'];
                                            $user_id = $fetch['UID'];
                                            if($approve==1){ 
										//Start table
    								echo "<li>";
    								echo "<div class='fh5co-food-desc'>";
									// Loop through the results from the database
									
									// Show entries
										echo    
											"<figure>";
											$media_query="SELECT * FROM media where MenuID = $menu_id";
											$media_result=mysqli_query($con, $media_query);
											$media_row=mysqli_fetch_assoc($media_result);
												?>
												
												<img src='../uploads/<?php echo $media_row["MediaName"]; ?>' class='img-responsive' alt='Free HTML5 Templates by FREEHTML5.co'>
												<?php
										echo "</figure>
											<div>
											<h3>$title</h3>
											<p>$des</p>
											</div>
											</div>
											<div class='fh5co-food-pricing'>
											Rs $price
											</div>
											<div class='fh5co-food-pricing' style='width:1000px;'>
											<a class='btn btn-primary' href='../menuDetails.php?menuid=$menu_id'>View</a>
											<a class='btn btn-danger' href='deletePost.php?menuid=$menu_id'>Delete</a>
											</div>
										  </li>";
											$i++;
									} 
								}
								?>
							</ul>
						</div>
        <?php include ('footer.php');?>
</body>
</html>