<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="../style/add.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <?php
  require_once '../connection/connection.php';
  if (isset($_GET['timkiem'])) {
    $id = (isset($_GET['id']) ? $_GET['id'] : '');
    if (!empty($id)) {
      $query = "SELECT * FROM patients WHERE UniqueCode NOT IN (SELECT patient_Id FROM inpatient WHERE inpatient.status = 'relapse') AND patients.type = 'IP' AND patients.UniqueCode = '$id'";
    } else {
      $query = "SELECT * FROM patients WHERE UniqueCode NOT IN (SELECT patient_Id FROM inpatient WHERE inpatient.status = 'relapse') AND patients.type = 'IP'";
    }
    $result = mysqli_query($conn, $query);
  }
  ?>
  <div class="container">
    <div class="left__container">
      <div class="left__component">
        <div class="left__title">
          <a href="../index.php">Hospital Management</a>
        </div>
        <ul class="lc__options">
          <span>
            <li>
              <i class="fa-regular fa-address-book"></i><a href="../action/add.php">Add new patient</a>
            </li>
          </span>
          <span>
            <li>
              <i class="fa-solid fa-list"></i><a href="./listPatients.php">List all patient are treated by a doctor</a>
            </li>
          </span>
          <span>
            <li><i class="fa-solid fa-plus"></i><a href="./recoveredPage.php">List all recovered patient</a></li>
          </span>
        </ul>
      </div>
    </div>

    <div class="right__container">
      <div class="right__component">
        <form action="" method="GET" id="inputForm">
          <input name="id" class="input" placeholder="Enter patient id..." />
          <input class="submit_btn" type="submit" name="timkiem" value="Search">
          </input>
        </form>
      </div>
      <?php if (isset($result) && mysqli_num_rows($result) != 0) { ?>
        <table class="table" style="width: 100%; text-align:center; margin-top: 10px">
          <thead>
            <tr>
              <th scope="col">Patient ID</th>
              <th scope="col">FirstName</th>
              <th scope="col">LastName</th>
              <th scope="col">dOb</th>
              <th scope="col">Gender</th>
              <th scope="col">Address</th>
              <th scope="col">Phone</th>
              <th scope="col">Detail</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <?php if (!empty($result)) {
                while ($temp = mysqli_fetch_array($result)) : ?>
                  <td><?php echo $temp['UniqueCode']; ?></td>
                  <td><?php echo $temp['fName']; ?></td>
                  <td><?php echo $temp['lName']; ?></td>
                  <td><?php echo $temp['dOb']; ?></td>
                  <td><?php echo $temp['gender']; ?></td>
                  <td><?php echo $temp['address']; ?></td>
                  <td><?php echo $temp['phone']; ?></td>
                  <td><a href="./treatmentDetail.php?id=<?php echo $temp['UniqueCode'] ?>"><i class="fa-thin fa-circle-info"></i></a></td>
            </tr>
        <?php endwhile;
              } ?>
          </tbody>
        </table>
      <?php }
      if (isset($result) && mysqli_num_rows($result) == 0) { ?>
        <h2>Không tìm thấy...</h2>
      <?php } ?>

    </div>
  </div>
  <script src="index.js"></script>
</body>

</html>