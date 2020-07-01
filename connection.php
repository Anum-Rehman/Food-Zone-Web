<?php
        $db_host = "localhost"; //can be "localhost" for local development
        $db_username = "id8594613_root";
        $db_password = "Engineer@12";
        $db_name = "id8594613_food_zone";
        $con=mysqli_connect($db_host,$db_username,$db_password,$db_name);
        //Checking error connectivity
        if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
      ?>