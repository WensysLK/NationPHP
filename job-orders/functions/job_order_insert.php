<?php
// Database connection
include('../../includes/db_config.php');
if(isset($_POST['submit'])){

    $agentName = $_POST['agentName'];
    $visQty = $_POST['visaQty'];

    $sqljoborder = "INSERT INTO `job_orders`(`AgentID`, `VisaQty`) VALUES (?,?)";

    $smtpjobs = $conn->prepare($sqljoborder);
    $smtpjobs->bind_param("ii", $agentName,$visQty);
    
    if($smtpjobs->execute()){

        $lastinsertId = $smtpjobs->insert_id;

        // Job Orders Details
        $positionName = $_POST['position'];
        $remarkjobs = $_POST['jobsremark'];
        $salary = $_POST['salary'];
        $currency = $_POST['currency'];
        $qty = $_POST['qty'];

        for ($i = 0; $i < count($positionName); $i++) {
            $posName = mysqli_real_escape_string($conn, $positionName[$i]);
            $sal = mysqli_real_escape_string($conn, $salary[$i]);
            $currency = mysqli_real_escape_string($conn, $currency[$i]);
            $jobqty = mysqli_real_escape_string($conn, $qty[$i]);
            $remark = mysqli_real_escape_string($conn, $remarkjobs[$i]);
        
            // Build and execute the SQL query
            $sqlposition = "INSERT INTO `job_positions`(`agentID`, `jobOrderId`, `positionName`, `Salary`,`currency`, `jobsQty`, `jobsRemark`) VALUES (?,?,?,?,?,?,?)";
        
            $smtppositions = $conn->prepare($sqlposition);
            $smtppositions->bind_param("iisssss", $agentName, $lastinsertId, $posName, $sal,$currency, $jobqty, $remark);
            
            if (!$smtppositions->execute()) {
                echo "Error: " . $smtppositions->error;
            }else{
                header("Location: ../view_all_Joborders.php");
            }
        }
    }}