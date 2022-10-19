<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="../style/add.css" />
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <?php
  require_once '../connection/connection.php';
  $nurseOptions = mysqli_query($conn, "SELECT * FROM employee WHERE jobType=1");
  $medications = mysqli_query($conn, "SELECT * FROM medication");
  $medArr = ["Paracetamod", "Corticoit"];
  if (isset($_POST['add'])) {
    $outPatient = (isset($_GET['outPatient']) ? $_GET['outPatient'] : '');
    $inPatient = (isset($_GET['outPatient']) ? $_GET['inPatient'] : '');
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $dOb = $_POST['dOb'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    // if(!empty($outPatient)) {
    // $examDate = $_GET['examDate'];
    // $diagnosis = $_GET['diagnosis'];
    // $nextExamDate = $_GET['nextExamDate'];
    // $medications = $_GET['medications'];
    // $fee = $_GET['fee'];
    $query = "INSERT INTO patients(fName,lName,dOb,gender,address,phone)
      VALUES('$firstName','$lastName','$dOb','$gender','$address','$phone')";
    $result = mysqli_query($conn, $query);
    // $outPatientQuery = "INSERT INTO examination() VALUES('$examDate','$diagnosis','$nextExamDate','$medications','$fee')";
    // $result2 = mysqli_query($conn, $outPatientQuery);
    // if($result) {
    echo "<script>window.location='treatment.php'</script>";
  }
  // }
  // if(!empty($inPatient)) {
  //   $dateAdmission = $_GET['dateAdmission'];
  //   $fee = $_GET['fee'];
  //   $treatingDoctor = $_GET['treatingDoctor'];
  //   $caringNurse = $_GET['caringNurse'];
  //   $diagnosis = $_GET['diagnosis'];
  //   $sickRoom = $_GET['sickRoom'];
  //   $dateOfCharge = $_GET['dateOfCharge'];
  //   $fee = $_GET['fee'];

  // }


  // $result2 = mysqli_query($conn, "SELECT * FROM patients");
  // if ($result)
  //   echo "<script>alert('Thêm thành công!'); window.location = 'add.php' </script>";
  // else
  //   echo "<script>alert('Thêm thất bại'); window.location='add.php'</script>";
  // }
  ?>
  <div class="container">
    <div class="left__container">
      <div class="left__component">
        <h1 class="left__title">Hospital Management</h1>
        <ul class="lc__options">
          <span>
            <li>
              <i class="fa-regular fa-address-book"></i><a href="">Add new patient</a>
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
      <form method="POST" action="" id="patientInputForm" enctype="multipart/form-data">
        <div class="name-group">
          <div class="form-group">
            <label for="fFame">First name</label>
            <input name="firstName" type="text" class="form-control" id="fFame" placeholder="First Name" required />
          </div>
          <div class="form-group">
            <label for="lName">Last name</label>
            <input name="lastName" type="text" class="form-control" id="lName" placeholder="Last Name" required />
          </div>
        </div>
        <div class="form-group">
          <label for="phoneNum">Phone number</label>
          <input name="phone" type="text" class="form-control" id="phoneNum" placeholder="Phone Number" required />
        </div>
        <div class="form-group">
          <label for="dateOfBirth">Date of birth</label>
          <input name="dOb" type="date" class="form-control" id="dateOfBirth" placeholder="" required />
        </div>
        <div class="form-group">
          <label for="gender">Gender</label>
          <select name="gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select>
        </div>
        <div class="form-group">
          <label for="address">Address</label>
          <input name="address" type="text" class="form-control" id="address" placeholder="Address" required />
        </div>
        <div class="form-group">
          <label for="address">Type patient</label>
          OutPatient
          <input name="Patient" onchange="selectFormInput(0)" type="radio" class="typePatient" value="OP" checked>
          Inpatient
          <input name="Patient" onchange="selectFormInput(1)" type="radio" class="typePatient" value="IP">
        </div>
        <div class="out-patient-form show">
          <div class="form-group">
            <label for="examDate">Examination Date</label>
            <input type="date" class="form-control" id="examDate">
          </div>
          <div class="form-group">
            <label for="address">Diagnosis</label>
            <input name="diagnosis" type="text" class="form-control" id="diagnosis" placeholder="Diagnosis" />
          </div>
          <div class="form-group">
            <label for="address">The next examination date</label>
            <input name="nextExamDate" type="date" class="form-control" id="nextExamDate" placeholder="The Next Exam Date" />
          </div>
          <div class="form-group">
            <label for="medications">Medications</label>
            <select name="medications[]" class="form-group js-example-basic-multiple" multiple="multiple">
              <?php while ($row = mysqli_fetch_array($medications)) : { ?>
                  <option value="<?php echo $row['medication_Id'] ?>"><?php echo $row['nameMedication'] ?></option>
              <?php }
              endwhile ?>
            </select>
          </div>
          <div class="form-group">
            <label for="address">Fee</label>
            <input name="fee" type="text" class="form-control" id="fee" placeholder="Fee" />
          </div>
        </div>
        <div class="in-patient-form hide">
          <div class="form-group">
            <label for="dateAdmission">Date admission</label>
            <input name="dateAdmission" type="date" class="form-control" id="dateAdmission" placeholder="Date admission" />
          </div>
          <!-- <div class="form-group">
            <label for="address">Treatment</label>
            <input name="address" type="text" class="form-control" id="treatment" placeholder="" />
          </div> -->
          <!-- <div class="form-group">
            <label for="address">Treating doctors</label>
            <input name="treatingDoctor" type="date" class="form-control" id="treatingDoctors" placeholder="Treating Doctor" />
          </div> -->
          <!-- <div class="form-group">
            <label for="address">Caring nurse</label>
            <select name="caringNurse" id="">
              <?php while ($row = mysqli_fetch_row($nurseOptions)) : ?>
              <option value="<?php echo $row['employee_Id'] ?>"><?php echo $row['fName'];
                                                                echo $row['lName'] ?></option>
              <?php endwhile ?>
            </select>
            <input name="address" type="text" class="form-control" id="caringNurse" placeholder="Caring Nurse" /> -->
          <!-- </div> -->
          <div class="form-group">
            <label for="diagnosis">Diagnosis</label>
            <input name="diagnosis" type="text" class="form-control" id="diagnosis" placeholder="Diagnonsis" />
          </div>
          <div class="form-group">
            <label for="sickRoom">Sickroom</label>
            <input name="sickRooom" type="text" class="form-control" id="sickroom" placeholder="Sick Room" />
          </div>
          <div class="form-group">
            <label for="dateOfCharge">Date of charge</label>
            <input name="dateOfCharge" type="date" class="form-control" id="dateOfCharge" placeholder="" />
          </div>
          <div class="form-group">
            <label for="fee">Fee</label>
            <input name="fee" type="text" class="form-control" id="fee" placeholder="Fee" />
          </div>
        </div>
        <button name="add" type="submit" class="btn btn-primary">Submit</button>
      </form>

    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="index.js"></script>
  <script>
    $(document).ready(function() {
      $('.js-example-basic-multiple').select2();
    });
  </script>
</body>

</html>