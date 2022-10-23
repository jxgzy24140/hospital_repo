<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="./style/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <?php
  require_once './connection/connection.php';
  if (isset($_GET['timkiem'])) {
    $search_value = $_GET['value'];
    if($search_value == '') {

    } else {
      $result = mysqli_query($conn, "SELECT * FROM patients WHERE phone LIKE '%$search_value%' OR lName LIKE '%$search_value%'
    OR fName LIKE '%$search_value%' OR lName LIKE '%$search_value%' OR patient_Id LIKE '%$search_value%'");
    }
  }
  ?>
  <div class="container">
    <div class="left__container">
      <div class="left__component">
        <h1 class="left__title">Hospital Management</h1>
        <ul class="lc__options">
          <span>
            <li><i class="fa-regular fa-address-book"></i><a href="./action/add.php">Add new patient</a></li>
          </span>
          <span>
            <li><i class="fa-solid fa-list"></i><a href="./pages/patients.php">List all patient are treated by a doctor</a></li>
          </span>
          <span>
            <li><i class="fa-solid fa-plus"></i><a href="">Make a report</a></li>
          </span>
        </ul>
      </div>
    </div>

    <div class="right__container">
      <div class="right__component">
        <form method="GET" action="" id="inputForm">
          <input value="<?php if(!empty($search_value)) echo $search_value ?>" name="value" class="input" placeholder="Enter patient id..." />
          <input class="submit_btn" type="submit" name="timkiem" value="Search" />
        </form>
      </div>
    <?php if(!empty($result)) { ?>
      <table class="table" style="width: 100%; text-align:center; margin-top: 10px">
        <thead>
          <tr>
            <th scope="col">Patient ID</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">DoB</th>
            <th scope="col">Gender</th>
            <th scope="col">Address</th>
            <th scope="col">Phone</th>
            <th scope="col">Detail</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php if(!empty($result)) { while ($temp = mysqli_fetch_array($result)) : ?>
              <td><?php echo $temp['patient_Id']; ?></td>
              <td><?php echo $temp['fName']; ?></td>
              <td><?php echo $temp['lName']; ?></td>
              <td><?php echo $temp['dOb']; ?></td>
              <td><?php if($temp['gender']==0) echo "Male"; else echo "Female"; ?></td>
              <td><?php echo $temp['address']; ?></td>
              <td><?php echo $temp['phone']; ?></td>
              <td><a href="./pages/detail.php?id=<?php echo $temp['patient_Id'] ?>"><i class="fa-thin fa-circle-info"></i></a></td>
          </tr>
        <?php endwhile; }?>
        </tbody>
      </table>
      <?php }?> 
    </div>
  </div>
</body>

</html>