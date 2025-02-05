<?php
include('../../includes/db_config.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//var_dump($_POST);die();
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $type=$_POST['flexRadioDefault'];
//    $followup_type = $_POST['followup_type'];
    $message = $_POST['message'];
//    $date = $_POST['followup_date'];

    $date=date("Y-m-d");
    $applicationId="";
    $status_delete=1;
    if($type == "Employee") {
        $applicationId = $_POST['applicationId'];
    }elseif ($type == "LocalAgent"){
        $applicationId = $_POST['localApplicationId'];
    }elseif ($type == "ForeignAgent"){
        $applicationId = $_POST['foreignApplicationId'];
    }
    $status="pending";

//        $sql = "SELECT * FROM applications  WHERE applicationID='$applicationId' ";
//        $res = mysqli_query($conn,$sql);
//        if($row = mysqli_fetch_assoc($res)) {
//
//            $applicationId = $row["applicationID"];
            $sql = "INSERT INTO `complains` (`complainant_id`, `type`, `message`,`status`, `create_date`, `softdeletestatus`) VALUES (?,?,?,?,?,?)";
            $stmt = $conn->prepare($sql);

            $stmt->bind_param("isssss", $applicationId, $type,$message,$status, $date,$status_delete);
//    var_dump($applicationId, $type,$message,$status, $date,$status);die();
                header("Location: ../view-all-complains.php");
            if (!$stmt->execute()) {
                echo "Error inserting agent details: " . $stmt->error;
                exit;

        }


}