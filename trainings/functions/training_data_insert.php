<?php
include('../../includes/db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert personal data into agentdetails
    $clientId = $_POST['clientId'];
    $trainingProgram = $_POST['traningProgram'];
    $trainingCenter = $_POST['traningCenter'];
    $trainingRemark= $_POST['trainingRemark'];
    $trainingdate= $_POST['trainingDate'];

    $status="pending";
    $createBy="1";
    $data=date('Y-m-d');
    $softdeletestatus =1;
    $trainingCompleted=1;


        $sql = "INSERT INTO `training_details`(`clientId`, `traingCenter`, `trainingCourse`, `trainigDate`, `trainingRemark`,`trainnigStatus`,`createdBy`,`CreatedAt`,`softdeletestatus`) VALUES (?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issssssss", $clientId, $trainingCenter,$trainingProgram,$trainingdate,$trainingRemark,$status,$createBy,$data,$softdeletestatus);
        $stmt->execute();



        $query = "UPDATE applications SET  trainingCompleted = ? WHERE applicationID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $trainingCompleted,$clientId);
        $stmt->execute();




    $conn->close();

    // Redirect or show success message
    header("Location: ../view_all_trainings.php");

}