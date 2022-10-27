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
    $doctor_Id = $_GET['doctor_Id'];
    $query = "SELECT * FROM inpatient WHERE employee_Id = '$doctor_Id'";
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
              <i class="fa-solid fa-list"></i><a href="">List all patient are treated by a doctor</a>
            </li>
          </span>
          <span>
            <li>
              <i class="fa-solid fa-plus"></i><a href="">Make a report</a>
            </li>
          </span>
        </ul>
      </div>
    </div>

    <div class="right__container">
      <div class="right__component">
        <form action="" method="GET" id="inputForm">
          <input name="doctor_Id" class="input" placeholder="Enter doctor id..." />
          <input class="submit_btn" type="submit" name="timkiem" value="Search">
          </input>
        </form>
      </div>
      <?php if (!empty($result)) { ?>
        <table class="table" style="width: 100%; text-align:center; margin-top: 10px">
          <thead>
            <tr>
              <th scope="col">Patient ID</th>
              <th scope="col">Date Admission</th>
              <th scope="col">Treating Doctors</th>
              <th scope="col">Caring Nurse</th>
              <th scope="col">SickRoom</th>
              <th scope="col">Diagnosis</th>
              <th scope="col">Date Of Discharge</th>
              <th scope="col">Fee</th>
              <th scope="col">About Treatment</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <?php if (!empty($result)) {
                while ($temp = mysqli_fetch_array($result)) : ?>
                  <td><?php echo $temp['patient_Id']; ?></td>
                  <td><?php echo $temp['dateAdmission']; ?></td>
                  <td><?php echo $temp['treatingDoctors']; ?></td>
                  <td><?php echo $temp['caringNurse']; ?></td>
                  <td><?php echo $temp['sickRoom']; ?></td>
                  <td><?php echo $temp['diagnosis']; ?></td>
                  <td><a href=""><i class="fa-thin fa-circle-info"></i></a></td>
            </tr>
        <?php endwhile;
              } ?>
          </tbody>
        </table>
      <?php } ?>
    </div>
  </div>
  <script src="index.js"></script>
</body>

</html>