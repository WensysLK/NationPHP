<?php
include('../../includes/db_config.php');
if(isset($_POST['submit'])){

    $trainingCenterId = htmlspecialchars($_POST['trainingCenterId']);
    $trainingCenterName = htmlspecialchars($_POST['trainingCenterName']);
    $phoneNumber = htmlspecialchars($_POST['phoneNumber']);
    $trainingEmail = htmlspecialchars($_POST['trainingEmail']);
    $trainingAddress= htmlspecialchars($_POST['trainingAddress']);
    $wesiteurl = htmlspecialchars($_POST['wesiteurl']);
    $date= date('Y-m-d');
    $status=1;




    $sqlmedicalupdates = "UPDATE `training_centers` SET 
                          `centerName` = ?, 
                          `address` = ?, 
                          `phoneNumber` = ?, 
                          `email` = ?, 
                          `website` = ?, 
                          `createdAt` = ?, 
                          `softdeletestatus` = ? 
                          WHERE `centerID` = ?";

    $smtpmedicalupdate = $conn->prepare($sqlmedicalupdates);

    if ($smtpmedicalupdate) {
        // Bind the parameters
        $smtpmedicalupdate->bind_param("sssssssi",
       $trainingCenterName,     // medicalresult (string)
           $trainingAddress,     // CollectedDate (string)
            $phoneNumber,       // collectedBy (string)
            $trainingEmail,           // medicalRemark (string)
            $wesiteurl,
            $date,// updateAt (string, date)
            $status,              // updatedBy (integer)
            $trainingCenterId          // medicalId (integer)
        );
        if($smtpmedicalupdate->execute()){

            header("Location: ../training-centers.php");


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