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
   $query = "SELECT * FROM treatment WHERE patient_Id = $id";
   $result = mysqli_query($conn,$query);
  }
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
        <form action="" method="GET" id="inputForm">
          <input name="doctor_Id" class="input" placeholder="Enter doctor id..." />
          <input class="submit_btn" type="submit" name="timkiem" value="Search">
          </input>
        </form>
      </div>
    <?php if(!empty($result)) { ?>
      <table class="table" style="width: 100%; text-align:center; margin-top: 10px">
        <thead>
          <tr>
            <th scope="col">Patient ID</th>
            <th scope="col">Doctor ID</th>
            <th scope="col">Medication ID</th>
            <th scope="col">Start Date</th>
            <th scope="col">End Date</th>
            <th scope="col">Period</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php if(!empty($result)) { while ($temp = mysqli_fetch_array($result)) : ?>
              <td><?php echo $temp['patient_Id']; ?></td>
              <td><?php echo $temp['dateAdmission']; ?></td>
              <td><?php echo $temp['treatingDotocs']; ?></td>
              <td><?php echo $temp['caringNurse']; ?></td>
              <td><?php echo $temp['sickRoom']; ?></td>
              <td><?php echo $temp['diagnosis']; ?></td>
              <td><a href=""><i class="fa-thin fa-circle-info"></i></a></td>
          </tr>
        <?php endwhile; } ?>
        </tbody>
      </table>
     <?php } ?>
    </div>
  </div>
  <script src="index.js"></script>
</body>

</html>