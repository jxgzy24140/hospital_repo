<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="../style/treatment.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php
    require_once '../connection/connection.php';
    //   if (isset($_GET['timkiem'])) {
    //     $search_value = $_GET['value'];
    //     if($search_value == '') {

    //     } else {
    //       $result = mysqli_query($conn, "SELECT * FROM patients WHERE phone LIKE '%$search_value%' OR lName LIKE '%$search_value%'
    //     OR fName LIKE '%$search_value%' OR lName LIKE '%$search_value%' OR UniqueCode LIKE '%$search_value%'");
    //     }
    //   }
    $id = (isset($_GET['id']) ? $_GET['id'] : '');
    $result = mysqli_query($conn, "SELECT * FROM treatment WHERE patient_Id = '$id' LIMIT 1");
    $docs = mysqli_query($conn, "SELECT DISTINCT employee_Id FROM treatment WHERE patient_Id = '$id'");
    $meds = mysqli_query($conn, "SELECT DISTINCT medication_Id FROM treatment WHERE patient_Id = '$id'");
    ?>
    <div class="container">
        <div class="left__container">
            <div class="left__component">
                <div class="left__title">
                    <a href="../index.php">Hospital Management</a>
                </div>
                <ul class="lc__options">
                    <span>
                        <li><i class="fa-regular fa-address-book"></i><a href="../action/add.php">Add new patient</a></li>
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
                    <input value="<?php if (!empty($search_value)) echo $search_value ?>" name="value" class="input" placeholder="Enter patient id..." />
                    <input class="submit_btn" type="submit" name="timkiem" value="Search" />
                </form>
            </div>
            <?php if (mysqli_num_rows($result) > 0) { ?>
                <table class="table" style="width: 100%; text-align:center; margin-top: 10px">
                    <thead>
                        <tr>
                            <th scope="col">Doctor's ID</th>
                            <th scope="col">Patient ID</th>
                            <th scope="col">Medication ID</th>
                            <th scope="col">StartDate</th>
                            <th scope="col">EndDate</th>
                            <th scope="col">Result</th>
                            <th scope="col">TreatmentPeriod</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($result)) {
                            while ($temp = mysqli_fetch_array($result)) : ?>
                                <tr>
                                    <td>
                                        <ul>
                                            <?php
                                            // echo $row['patient_Id'];
                                            while ($drow = mysqli_fetch_array($docs)) { ?>
                                                <li style="list-style-type: none">
                                                    <?php echo $drow['employee_Id'] ?>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </td>
                                    <td><?php echo $temp['patient_Id']; ?></td>
                                    <td>
                                        <ul>
                                            <?php
                                            // echo $row['patient_Id'];
                                            while ($mrow = mysqli_fetch_array($meds)) { ?>
                                                <li style="list-style-type: none">
                                                    <?php echo $mrow['medication_Id'] ?>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </td>
                                    <td><?php echo $temp['startDate']; ?></td>
                                    <td><?php echo $temp['endDate']; ?></td>
                                    <td><?php echo $temp['result']; ?></td>
                                    <td><?php echo $temp['treatmentPeriod']; echo "\x20"; echo ($temp['treatmentPeriod'] > 1) ? "days" : "day"  ?></td>
                                </tr>
                        <?php endwhile;
                        } ?>
                    </tbody>
                </table>
                <div class="" style="text-align: center; margin-top: 10px">
                    <a href="./treatment.php?id=<?php echo $id ?>">Add more treatment</a>
                </div>
            <?php } else { ?>
                <h2 style="text-align: center">Not treatment for patient <?php echo $id ?></h2>
                <div class="add-treatment" style="text-align: center; margin-top: 5px">
                    <a href="./treatment.php?id=<?php echo $id ?>">Add more treatment</a>
                </div>
            <?php } ?>

        </div>
    </div>
</body>

</html>