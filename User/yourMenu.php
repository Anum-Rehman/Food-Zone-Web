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
    ORDERS
    </div>
    <div class="panel-body">
        <div id="morris-donut-chart"></div>
        <table class="table">
                            <thead class="thead-dark">
                              <tr>
                                <th scope="col" class="text-center">WEEK MENU ID</th>
                                <th scope="col" class="text-center">WEEK DAY</th>
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
                            $cook_id = $_SESSION['userID'];
                            $menu_query=mysqli_query($con,"SELECT * FROM `week_menu` WHERE UID='$cook_id'");
                            }
                            $i=1;
                            while($data = mysqli_fetch_assoc($menu_query))
							{
                            $week_menu_id = $data['week_menu_ID'];
                            $week_id = $data['week_ID'];
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
                            1`
        <?php include ('footer.php');?>
</body>
</html>