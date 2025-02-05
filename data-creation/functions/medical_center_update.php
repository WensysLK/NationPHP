<?php
include('../../includes/db_config.php');
if(isset($_POST['submit'])){

    $medicalcenterId = htmlspecialchars($_POST['medicalcenterId']);
    $medicalCentername = htmlspecialchars($_POST['medicalcentername']);
    $medicalCenteraddress1 = htmlspecialchars($_POST['addressline1']);
    $medicalCentercity = htmlspecialchars($_POST['medicalCity']);
    $medicalCenterphone = htmlspecialchars($_POST['phonenumber']);
    $medicalCenteremail = htmlspecialchars($_POST['medicalCenteremail']);
    $medicalCenterwebsite = htmlspecialchars($_POST['wesiteurl']);
    $date= date('Y-m-d');
    $status=1;




    $sqlmedicalupdates = "UPDATE `medical_center` SET 
                          `MediName` = ?, 
                          `AddressLine1` = ?, 
                          `mediCity` = ?, 
                          `mediPhone` = ?, 
                          `mediEmail` = ?, 
                          `mediWebsite` = ?, 
                          `createdAt` = ? ,
                          `softdeletestatus` = ? 
                          WHERE `medicalCenterID` = ?";

    $smtpmedicalupdate = $conn->prepare($sqlmedicalupdates);

    if ($smtpmedicalupdate) {
        // Bind the parameters
        $smtpmedicalupdate->bind_param("ssssssssi",
            $medicalCentername,     // medicalStatus (string)
            $medicalCenteraddress1,     // medicalresult (string)
            $medicalCentercity,     // CollectedDate (string)
            $medicalCenterphone,       // collectedBy (string)
            $medicalCenteremail,           // medicalRemark (string)
            $medicalCenterwebsite,
            $date,// updateAt (string, date)
            $status,              // updatedBy (integer)
            $medicalcenterId          // medicalId (integer)
        );
        if($smtpmedicalupdate->execute()){

            header("Location: ../medical-centers.php");


        }else{
            echo "Error Creating Medical Center";
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