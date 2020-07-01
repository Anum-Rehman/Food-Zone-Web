<?php
$name= '';
$contact = '';
$location = '';
$no_of_order = '';
  if(isset($_POST['order_btn'])){
      if(!empty($_POST['name'])){

      }
      if(!empty($_POST['contact'])){

      }
      if(!empty($_POST['loc'])){

      }
      if(!empty($_POST['no_of_order'])){

      }
      if(!empty($_POST['mail'])){

      }
  }
?>
<?php include ('../connection.php'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include ('link.php'); ?>
</head>
<body>
    <?php include ('header.php'); ?>
    <div class='col-md-6'>
                    <br>
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
    <div class='panel panel-default'>
                        <div class='panel-heading text-center'>
                            MONDAY
                        </div>
                        <div class="panel-body">
                            <div id="morris-donut-chart"></div>
                            <table class="table">
                            <thead class="thead-dark">
                              <tr>
                                <th scope="col" class="text-center">BREAKFAST</th>
                                <th scope="col" class="text-center">LUNCH</th>
                                <th scope="col" class="text-center">SUPPER</th>
                                <th scope="col" class="text-center">DINNER</th>
                                <th scope="col" class="text-center">ORDER</th>
                              </tr>
                            </thead>
                            <?php
                             if(isset($_POST['search'])){
                              $value = $_POST['find'];
                              $week_query = mysqli_query($con,"SELECT * FROM week_menu WHERE week_menu_ID LIKE '%$value%' OR breakfast LIKE '%$value%'
                              OR Lunch LIKE '%$value%' OR Supper LIKE '%$value%' OR Dinner LIKE '%$value%' WHERE UID='$cook_id'");
                            }
                            else{
                                $week_query = mysqli_query($con,"SELECT * FROM week_menu WHERE week_ID = '1'");
                            }
                            $i=1;
                            while($data = mysqli_fetch_assoc($week_query))
							{
                            $breakfast = $data['breakfast'];
                            $lunch = $data['Lunch'];
                            $supper = $data['Supper'];
                            $dinner = $data['Dinner'];
                            ?>
                            <tbody>
                              <tr>
                                <td class="text-center"><?php echo $breakfast; ?></td>
                                <td class="text-center"><?php echo $lunch ?></td>
                                <td class="text-center"><?php echo $supper; ?></td>
                                <td class="text-center"><?php echo $dinner ?></td>
                                <td class="text-center"><a href="#" data-toggle="modal" data-target="#orderModal" class="btn btn-primary">Order</a></td>
                              </tr>
                            <?php
                            $i++;
                            }
                            ?>
</tbody>
</table>
<div class="container">
		<!-- Modal -->
		<div class="modal fade" id="orderModal" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header" style="padding:35px 50px; background-color:#bf4c03!important;">
						<h4 style="background-color:#bf4c03; font-family: 'Times New Roman', Times, serif;"><b >Order Dish</b></h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body" style="padding:40px 50px;">
				<!--	<?php// if($_SESSION['error']) { ?>
							<div class="alert alert-warning alert-dismissible" role="alert">
  								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  									<strong>Error: </strong> <?php // echo $_SESSION['error']; ?> 
							</div>

					<?php //} ?> -->
						<form role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" name="signin_form">
            <div class="form-group">
								<label for="name"><i class="fas fa-user-circle"></i>Name</label>
								<input type="text" class="form-control" id="name" placeholder="Full Name" name="name" required value="<?php ?>">
							</div>
              <div class="form-group">
								<label for="contact"><i class="fas fa-user-circle"></i>Contact</label>
								<input type="number" class="form-control" id="contact" placeholder="Contact Number" name="contact" required value="<?php ?>">
							</div>
              <div class="form-group">
								<label for="loc"><i class="fas fa-user-circle"></i>Location</label>
								<input type="text" class="form-control" id="loc" placeholder="Location" name="loc" required value="<?php ?>">
							</div>
              <div class="form-group">
								<label for="order"><i class="fas fa-user-circle"></i>Number of Orders</label>
								<input type="text" class="form-control" id="order" placeholder="Number of Orders" name="no_of_order" required value="<?php ?>">
							</div>
							<div class="form-group">
								<label for="usrname"><i class="fas fa-user-circle"></i>Email Address:</label>
								<input type="email" class="form-control" id="usrname" placeholder="Email Address" name="mail" required value="<?php ?>">
							</div>
							<div class="checkbox">
								<label><input type="checkbox" value="" checked>Remember me</label>
							</div>
							<button type="submit" name="order_btn" class="btn btn-success btn-block" style="background-color:#bf4c03; font-family: 'Times New Roman', Times, serif;"><i class="fas fa-power-off"></i></span>Order</button>
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
<?php include ('footer.php');?>   
</body>
</html>
