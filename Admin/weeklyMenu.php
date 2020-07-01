<?php include ('../connection.php');?>
<?php 
session_start();?>
<?php
if(!isset($_SESSION['adminID'])){
	header("location:login.php");
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include ('link.php'); ?>
</head>
<body>
    <?php include ('header.php'); ?>
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
                            Registered Cooks
                        </div>
                        <div class="panel-body">
                            <div id="morris-donut-chart"></div>
                            <table class="table">
                            <thead class="thead-dark">
                              <tr>
                                <th scope="col" class="text-center">WEEK MENU ID</th>
                                <th scope="col" class="text-center">WEEK DAY</th>
                                <th scope="col" class="text-center">COOK'S NAME</th>
                                <th scope="col" class="text-center">BREAKFAST</th>
                                <th scope="col" class="text-center">LUNCH</th>
                                <th scope="col" class="text-center">SUPPER</th>
                                <th scope="col" class="text-center">DINNER</th>
                              </tr>
                            </thead>
                            <?php
                             if(isset($_POST['search'])){
                              $value = $_POST['find'];
                              $menu_query = mysqli_query($con,"SELECT * FROM week_menu WHERE week_menu_ID LIKE '%$value%' OR breakfast LIKE '%$value%'
                              OR Lunch LIKE '%$value%' OR Supper LIKE '%$value%' OR Dinner LIKE '%$value%' WHERE UID='$cook_id'");
                            }
                            else{
                            $menu_query=mysqli_query($con,"SELECT * FROM `week_menu`");
                            }
                            $i=1;
                            while($data = mysqli_fetch_assoc($menu_query))
							{
                            $week_menu_id = $data['week_menu_ID'];
                            $week_id = $data['week_ID'];
                            $user_id = $data['UID'];
                            $cook_data = mysqli_query($con,"SELECT * FROM cook_registration WHERE UID = '$user_id'");
                            $fetch_cook = mysqli_fetch_assoc($cook_data);
                            $cook_name = $fetch_cook['Full_name'];
                            $week_query = mysqli_query($con,"SELECT * FROM week WHERE week_ID = '$week_id'");
                            $fetch_week = mysqli_fetch_assoc($week_query);
                            $week_day = $fetch_week['Day'];
                            $breakfast = $data['breakfast'];
                            $lunch = $data['Lunch'];
                            $supper = $data['Supper'];
                            $dinner = $data['Dinner'];
                            ?>
                            <tbody>
                              <tr>
                                <th scope="row" class="thead-light text-center"><?php echo $week_menu_id ?></th>
                                <td class="text-center"><?php echo $week_day; ?></td>
                                <td class="text-center"><?php echo $cook_name; ?></td>
                                <td class="text-center"><?php echo $breakfast; ?></td>
                                <td class="text-center"><?php echo $lunch ?></td>
                                <td class="text-center"><?php echo $supper; ?></td>
                                <td class="text-center"><?php echo $dinner ?></td>

                              </tr>
                            <?php
                            $i++;
                            }
                            ?>
                            </table>
    <?php include ('footer.php');?>   
</body>
</html>
