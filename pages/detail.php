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
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $patient = mysqli_query($conn, "SELECT * FROM patients WHERE UniqueCode = '$id'");
    if (mysqli_num_rows($patient) > 0) {
      foreach ($patient as $prow) {
        $type = $prow['type'];
      }
    }
  }
  if (strcmp($type, "OP") == 0) {
    $result = mysqli_query($conn, "SELECT * FROM examination WHERE patient_Id = '$id'");
  } else {
    $result = mysqli_query($conn, "SELECT * FROM inpatient WHERE patient_Id = '$id'");
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
      <table class="table" style="width: 100%; text-align:center; margin-top: 10px">
        <thead>
          <?php if (strcmp($type, "OP") == 0) { ?>
            <tr>
              <th scope="col">Patient ID</th>
              <th scope="col">Doctor's ID</th>
              <th scope="col">Medication ID</th>
              <th scope="col">Exam Date</th>
              <th scope="col">Diagnosis</th>
              <th scope="col">Next Exam Date</th>
              <th scope="col">Fee</th>
            </tr>
          <?php } else { ?>
            <tr>
              <th scope="col">Patient ID</th>
              <th scope="col">Date Admission</th>
              <th scope="col">TreatingDoctors</th>
              <th scope="col">CaringNurse</th>
              <th scope="col">Sick Room</th>
              <th scope="col">Diagnosis</th>
              <th scope="col">DateDischarge</th>
              <th scope="col">Fee</th>
              <th scope="col">Treatment detail</th>
            </tr>
          <?php } ?>
        </thead>
        <tbody>
          <?php if (strcmp($type, "OP") == 0) { ?>
            <?php while ($row = mysqli_fetch_array($result)) : ?>
              <tr>
                <td><?php echo $row['patient_Id']; ?></td>
                <td><?php echo $row['employee_Id']; ?></td>
                <td><?php echo $row['medication_Id']; ?></td>
                <td><?php echo $row['examDate']; ?></td>
                <td><?php echo $row['diagnosis']; ?></td>
                <td><?php echo $row['nextExamDate']; ?></td>
                <td><?php echo $row['fee']; ?></td>
              </tr>
            <?php endwhile; ?>
          <?php } else { ?>
            <?php while ($row = mysqli_fetch_array($result)) : ?>
              <tr>
                <td><?php echo $row['patient_Id']; ?></td>
                <td><?php echo $row['dateAdmission']; ?></td>
                <td><?php echo $row['treatingDoctors']; ?></td>
                <td>
                  <?php
                  $nurse_Id = $row['caringNurse'];
                  $nurse_run = mysqli_query($conn, "SELECT * FROM employee WHERE employee_Id = '$nurse_Id'");
                  while ($nrow = mysqli_fetch_array($nurse_run)) {
                    echo $nrow['fName'];
                    echo "\x20";
                    echo $nrow['lName'];
                  }
                  ?>
                </td>
                <td><?php echo $row['sickRoom']; ?></td>
                <td><?php echo $row['diagnosis']; ?></td>
                <td><?php echo $row['dateDischarge']; ?></td>
                <td><?php echo $row['fee']; ?></td>
                <td><a href="./treatmentDetail.php?id=<?php echo $row['patient_Id']; ?>">
                    <i class="fa-light fa-circle-info"></i>
                  </a>
                </td>
              </tr>
            <?php endwhile; ?>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
  <script src="index.js"></script>
</body>

</html>