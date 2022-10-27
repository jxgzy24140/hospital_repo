<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="../style/treatment.css" />
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <?php
  require_once '../connection/connection.php';
  $medication = mysqli_query($conn, "SELECT * FROM medication");
  $doctors = mysqli_query($conn, "SELECT * FROM employee WHERE jobType='0'");
  $nurses = mysqli_query($conn, "SELECT * FROM employee WHERE jobType='1'");
  $patient_Id = (isset($_GET['id']) ? $_GET['id'] : '');
  $getDocs = mysqli_query($conn, "SELECT employee_Id FROM inpatient WHERE patient_Id = '$patient_Id'");
  if (isset($_POST['add'])) {
    $meds = $_POST['medications'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $res = $_POST['result'];
    $temp = strtotime($endDate) - strtotime($startDate);
    $treatmentPeriod = abs(round($temp / 86400));
    while ($row = mysqli_fetch_array($getDocs)) {
      $doc = $row['employee_Id'];
      foreach ($meds as $med) {
        $query = "INSERT INTO treatment(employee_Id,patient_Id,medication_Id,startDate,endDate,result,treatmentPeriod) 
        VALUES('$doc','$patient_Id','$med','$startDate','$endDate','$res','$treatmentPeriod')";
        $notcheck = mysqli_query($conn, "SET FOREIGN_KEY_CHECKS = 0");
        $result = mysqli_query($conn, $query);
      }
    }
    echo "<script>window.location = 'treatmentDetail.php?id=$patient_Id'</script>";
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
        <form action="../action/timkiem.php" method="GET" id="inputForm">
          <input name="patientId" class="input" placeholder="Enter patient id..." />
          <button class="submit_btn" type="submit" name="submit_btn">
            Tìm
          </button>
        </form>
      </div>
      <form method="POST" action="" id="patientInputFrom" enctype="multipart/form-data">
        <!-- <div class="form-group">
          <label for="doctors">Doctors</label>
          <select name="doctors[]" class="js-example-basic-multiple" multiple="multiple">
            <?php while ($row1 = mysqli_fetch_array($doctors)) : ?>
              <option value="<?php $row1['employee_Id'] ?>"><?php echo $row1['fName'] ?></option>
            <?php endwhile ?>
          </select>
        </div>
        <div class="form-group">
          <label for="nurse">Nurse</label>
          <select name="nurse">
            <option value="" disabled selected="true">--Nurse--</option>
            <?php while ($row2 = mysqli_fetch_array($nurses)) : ?>
              <option value="<?php $row2['employee_Id'] ?>"><?php echo $row2['fName'] ?></option>
            <?php endwhile ?>
          </select>
        </div> -->
        <div class="form-group">
          <label for="startDate">Start Date</label>
          <input name="startDate" type="date" class="form-control" id="" placeholder="" required />
        </div>
        <div class="form-group">
          <label for="endDate">End Date</label>
          <input name="endDate" type="date" class="form-control" id="" placeholder="" required />
        </div>
        <div class="form-group">
          <label for="medications">Medications</label>
          <select name="medications[]" class="js-example-basic-multiple" multiple="multiple">
            <?php while ($row = mysqli_fetch_array($medication)) : ?>
              <option value="<?php echo $row['medication_Id'] ?>"><?php echo $row['nameMedication'] ?></option>
            <?php endwhile ?>
          </select>
        </div>
        <div class="form-group">
          <label for="result">Result</label>
          <input name="result" type="text" class="form-control" id="result" placeholder="" />
        </div>
        <button name="add" type="submit" class="btn btn-primary">Submit</button>
      </form>

    </div>
  </div>
  <script src="index.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.js-example-basic-multiple').select2();
    });
  </script>
</body>

</html>