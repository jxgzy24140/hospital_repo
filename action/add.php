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
  $nurseOptions = mysqli_query($conn, "SELECT * FROM employee WHERE jobType='1'");
  $doctors = mysqli_query($conn, "SELECT * FROM employee WHERE jobType='0'");
  $inDoctors = mysqli_query($conn, "SELECT * FROM employee WHERE jobType='0'");
  $medications = mysqli_query($conn, "SELECT * FROM medication");
  if (isset($_POST['add'])) {
    $getId = mysqli_query($conn, "SELECT * FROM id_value_patients ORDER BY ID DESC LIMIT 1");
    if (mysqli_num_rows($getId) > 0) {
      $iR = mysqli_fetch_assoc($getId);
      $id = $iR['ID'];
    } else {
      $id = 0;
    }
    $outPatient = (isset($_POST['outPatient']) ? $_POST['outPatient'] : '');
    $inPatient = (isset($_POST['inPatient']) ? $_POST['inPatient'] : '');
    $firstName = (isset($_POST['firstName']) ? $_POST['firstName'] : '');
    $lastName = (isset($_POST['lastName']) ? $_POST['lastName'] : '');
    $dOb = (isset($_POST['dOb']) ? $_POST['dOb'] : '');
    $gender = (isset($_POST['gender']) ? $_POST['gender'] : '');
    $address = (isset($_POST['address']) ? $_POST['address'] : '');
    $phone = (isset($_POST['phone']) ? $_POST['phone'] : '');
    if (!empty($outPatient)) {
      $query = "INSERT INTO patients(ID,type,fName,lName,dOb,gender,address,phone)
  VALUES('$id','OP','$firstName','$lastName','$dOb','$gender','$address','$phone')";
      $result = mysqli_query($conn, $query);
    } else {
      $query = "INSERT INTO patients(ID,type,fName,lName,dOb,gender,address,phone)
    VALUES('$id','IP','$firstName','$lastName','$dOb','$gender','$address','$phone')";
      $result = mysqli_query($conn, $query);
    }
    $getCurrentId = mysqli_query($conn, "SELECT * FROM patients WHERE ID = '$id'");
    if (mysqli_num_rows($getCurrentId) > 0) {
      foreach ($getCurrentId as $rowp) {
        $patient_Id = $rowp['UniqueCode'];
      }
    }
    if (!empty($outPatient)) {
      $examDate = (isset($_POST['examDate']) ? $_POST['examDate'] : '');
      $doctorId = (isset($_POST['doctor']) ? $_POST['doctor'] : '');
      $diagnosis = (isset($_POST['diagnosis']) ? $_POST['diagnosis'] : '');
      $nextExamDate = (isset($_POST['nextExamDate']) ? $_POST['nextExamDate'] : '');
      $med_Id = (isset($_POST['medications']) ? $_POST['medications'] : '');
      $fee = (isset($_POST['fee']) ? $_POST['fee'] : '');
      if (!empty($med_Id)) {
        if (!empty($nextExamDate)) {
          foreach ($med_Id as $med) {
            $outPatientQuery = "INSERT INTO examination(patient_Id,employee_Id,medication_Id,examDate,diagnosis,nextExamDate,fee) 
          VALUES('$patient_Id','$doctorId','$med','$examDate','$diagnosis','$nextExamDate', '$fee')";
            $result2 = mysqli_query($conn, $outPatientQuery);
          }
        } else {
          foreach ($med_Id as $med) {
            $outPatientQuery = "INSERT INTO examination(patient_Id,employee_Id,medication_Id,examDate,diagnosis,fee) 
          VALUES('$patient_Id','$doctorId','$med','$examDate','$diagnosis', '$fee')";
            $result2 = mysqli_query($conn, $outPatientQuery);
          }
        }
      }
      $outPatientRun = mysqli_query($conn, "INSERT INTO outpatient(patient_Id) VALUES ('$patient_Id')");
    }
    if (!empty($inPatient)) {
      $dateAdmission = $_POST['dateAdmission'];
      $treatingDoctor = $_POST['inDoctor'];
      $nurseId = $_POST['inNurse'];
      $diagnosis = $_POST['diagnosis'];
      $sickRoom = $_POST['sickRoom'];
      $dateOfCharge = $_POST['dateOfCharge'];
      $fee = $_POST['fee'];
      foreach ($treatingDoctor as $doc) {
        $docById = mysqli_query($conn, "SELECT * FROM employee WHERE employee_Id = '$doc'");
        $docRow = mysqli_fetch_array($docById);
        $fName = $docRow['fName'];
        $lName = $docRow['lName'];
        $docName = "{$fName} {$lName}";
        $inPatientQuery = "INSERT INTO inpatient(patient_Id,dateAdmission,treatingDoctors,caringNurse,sickRoom,diagnosis,dateDischarge,fee, employee_Id) 
        VALUES('$patient_Id','$dateAdmission','$docName','$nurseId','$sickRoom','$diagnosis','$dateOfCharge','$fee','$doc')";
        $result2 = mysqli_query($conn, $inPatientQuery);
      }
    }
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
        <form action="../index.php" method="GET" id="inputForm">
          <input name="patientId" class="input" placeholder="Enter patient id..." />
          <button class="submit_btn" type="submit" name="submit_btn">
            Tìm
          </button>
        </form>
      </div>
      <form method="POST" action="" id="patientInputForm" enctype="multipart/form-data">
        <div class="left-form-component">
          <div class="form-group">
            <label for="fFame">First name</label>
            <input name="firstName" type="text" class="form-control" id="fFame" placeholder="First Name" />
          </div>
          <div class="form-group">
            <label for="lName">Last name</label>
            <input name="lastName" type="text" class="form-control" id="lName" placeholder="Last Name" />
          </div>
          <div class="form-group">
            <label for="phoneNum">Phone number</label>
            <input name="phone" type="text" class="form-control" id="phoneNum" placeholder="Phone Number" />
          </div>
          <div class="form-group">
            <label for="dateOfBirth">Date of birth</label>
            <input name="dOb" type="date" class="form-control" id="dateOfBirth" placeholder="" />
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
            <input name="address" type="text" class="form-control" id="address" placeholder="Address" />
          </div>
          <div class="form-group">
            <label for="outPatient">Type patient</label>
            OutPatient
            <input name="outPatient" onchange="selectFormInput(0)" type="radio" class="typePatient" value="OP" checked>
            Inpatient
            <input name="inPatient" onchange="selectFormInput(1)" type="radio" class="typePatient" value="IP">
          </div>
          <button name="add" type="submit" class="btn btn-primary">Submit</button>

        </div>
        <div class="right-form-component">

          <div class="out-patient-form show">
            <div class="form-group">
              <label for="examDate">Examination Date</label>
              <input type="date" class="form-control" name="examDate">
            </div>
            <div class="form-group">
              <label for="doctor">Doctors</label>
              <select name="doctor" class="js-example-basic-multiple">
                <option value="" selected="true" disabled="disabled">--Doctors--</option>
                <?php while ($row1 = mysqli_fetch_array($doctors)) : ?>
                  <option value="<?php echo $row1['employee_Id'] ?>"><?php echo $row1['fName'];
                                                                      echo "\x20";
                                                                      echo $row1['lName'] ?></option>
                <?php endwhile ?>
              </select>
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
            <div class="form-group">
              <label for="diagnosis">Diagnosis</label>
              <input name="diagnosis" type="text" class="form-control" id="diagnosis" placeholder="Diagnonsis" />
            </div>
            <div class="form-group">
              <label for="sickRoom">Sickroom</label>
              <input name="sickRoom" type="text" class="form-control" id="sickroom" placeholder="Sick Room" />
            </div>
            <div class="form-group">
              <label for="doctor">Doctors</label>
              <select name="inDoctor[]" class="js-example-basic-multiple" multiple="multiple">
                <?php while ($row = mysqli_fetch_array($inDoctors)) : ?>
                  <option value="<?php echo $row['employee_Id'] ?>"><?php echo $row['fName'];
                                                                    echo "\x20";
                                                                    echo $row['lName'] ?></option>
                <?php endwhile ?>
              </select>
            </div>
            <div class="form-group">
              <label for="inNurse">Nurse</label>
              <select name="inNurse" class="js-example-basic-multiple">
                <option value="" selected="true" disabled="disabled">--Nurse--</option>
                <?php while ($nurseRow = mysqli_fetch_array($nurseOptions)) : ?>
                  <option value="<?php echo $nurseRow['employee_Id']; ?>"><?php echo $nurseRow['fName'];
                                                                          echo "\x20";
                                                                          echo $nurseRow['lName'] ?></option>
                <?php endwhile ?>
              </select>
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
        </div>
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
    $(document).ready(function() {
      $("input[type=radio]").prop("checked", false);
      $("input[type=radio]:first").prop("checked", true);

      $("input[type=radio]").click(function(event) {
        $("input[type=radio]").prop("checked", false);
        $(this).prop("checked", true);

        //event.preventDefault();
      });
    });
  </script>
</body>

</html>