<?php include ('../connection.php'); ?>
<?php 
session_start();
if(empty($_SESSION['userID'])){
    header("../location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include ('links.php'); ?>
</head>
<body>
    <?php include ('header.php');?>
    PENDING POSTS
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
									 $session_user_id = $_SESSION['userID'];
									if(isset($_POST['search'])){
                                        $value = $_POST['find'];
                                        $post_query = mysqli_query($con,"SELECT * FROM `menu` WHERE `MenuID` LIKE '%$value%' OR `Title` LIKE '%$value%' OR `UID` LIKE '%$value%' AND UID='$session_user_id'");
                                    }
                                    else{
                                        $post_query = mysqli_query($con,"SELECT * FROM `menu` WHERE UID = '$session_user_id'");
                                    }
                                        $i=1;
                                        while($row = mysqli_fetch_assoc($post_query)){
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
									if($approved == 0){
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
												
												<img src='../uploads/<?php echo $media_row["MediaName"]; ?>' class='img-responsive' alt='Free HTML5 Templates by FREEHTML5.co'>
												<?php
										echo "</figure>
											<div>
											<h3>$title</h3>
											<p>$description</p>
											</div>
											</div>
											<div class='fh5co-food-pricing'>
											Rs $price
											</div>
											<div class='fh5co-food-pricing' style='width:1000px;'>
											<a class='btn btn-primary' href='../menuDetails.php?menuid=$menuId'>View</a>
											<a class='btn btn-primary' href='editPost.php?menuid=$menuId'>Edit</a>
											<a class='btn btn-danger' href='deletePost.php?menuid=$menuId'>Delete</a>
										 </div>
										  </li>";
											$i++;
									} 
								}
								?>
							</ul>
						</div>
					</div>
				</div>
        <?php include ('footer.php');?>
</body>
</html>