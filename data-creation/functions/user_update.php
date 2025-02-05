<?php
include('../../includes/db_config.php');
if(isset($_POST['submit'])){

    $userId = htmlspecialchars($_POST['userId']);
    $userName = htmlspecialchars($_POST['userName']);
    $email = htmlspecialchars($_POST['userEmail']);
    $password = htmlspecialchars($_POST['userPassword']);
    $userRole = htmlspecialchars($_POST['userRole']);
    $date = date('Y-m-d');
    $status = 1;




    $sqlmedicalupdates = "UPDATE `users` SET 
                          `Username` = ?, 
                          `Email` = ?, 
                          `password` = ?, 
                          `userRoleID` = ?, 
                           `createdDate` = ?, 
                          `softdeletestatus` = ? 
                          WHERE `userID` = ?";

    $smtpmedicalupdate = $conn->prepare($sqlmedicalupdates);

    if ($smtpmedicalupdate) {
        // Bind the parameters
        $smtpmedicalupdate->bind_param("ssssssi",
       $userName,     // medicalresult (string)
           $email,     // CollectedDate (string)
            $password,       // collectedBy (string)
            $userRole,           // medicalRemark (string)
            $date,
            $status,              // updatedBy (integer)
            $userId          // medicalId (integer)
        );
        if($smtpmedicalupdate->execute()){

            header("Location: ../users.php");


        }else{
            echo "Error Creating Training Center";
        }
        $smtpmedicalupdate->close();
    }




//    $sqlmedicalCenetr = "INSERT INTO `medical_center`(`MediName`, `AddressLine1`, `mediCity`, `mediPhone`, `mediEmail`, `mediWebsite`) VALUES ( ?, ?, ?, ?, ?, ?, ?)";
//
//    $stmtmedicalcenter = $conn->prepare($sqlmedicalCenetr);
//
//    $stmtmedicalcenter->bind_param("sssssss",
//    $medicalCentername,$medicalCenteraddress1,$medicalCenteraddress2,$medicalCentercity,$medicalCenterphone,$medicalCenteremail,$medicalCenterwebsite );



}