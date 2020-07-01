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
                            WEDNESDAY
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
                                $week_query = mysqli_query($con,"SELECT * FROM week_menu WHERE week_ID = '3'");
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
<?php include ('footer.php');?>   
</body>
</html>
