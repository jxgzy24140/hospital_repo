<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="../style/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>
  <body>
<?php
  require_once '../connection/connection.php';
  if (isset($_GET['search'])) {
    $search_value = $_GET['search'];
}
$sql_find = "SELECT * FROM hospital_db";
$result = mysqli_query($conn, $sql_find);
echo $result;
  ?>
    <div class="container">
      <div class="left__container">
        <div class="left__component">
          <h1 class="left__title">Hospital Management</h1>
          <ul class="lc__options">
            <span>
              <li><i class="fa-regular fa-address-book"></i><a href="./pages/add.php">Add new patient</a></li>
            </span>
            <span>
              <li><i class="fa-solid fa-list"></i><a href="">List all patient are treated by a doctor</a></li>
            </span>
            <span>
              <li><i class="fa-solid fa-plus"></i><a href="">Make a report</a></li>
            </span>
          </ul>
        </div>
      </div>

      <div class="right__container">
        <div class="right__component">
          <form action="timkiem.php?" method="GET" id="inputForm">
            <input name="search" class="input" placeholder="Enter patient id..." />
            <button class="submit_btn" type="submit" name="submit_btn">Tìm</button>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
