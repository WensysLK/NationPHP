<?php

include ('../../includes/db_config.php');

if (isset($_POST['submit'])) {

    $contractId = $_POST['contractId'];
    $countryType = $_POST['countryType'];
    $contractType="not_started";
    $interviewStatus ="not_started";
    $medicalStatus = "not_started";
    $EnjazSatus = "not_started" ;
    $MuzanedStatus = "not_started";
    $fprintStatus = "not_started" ;
    $BeauroStatus = "not_started";
    $visa_status="";

    if($countryType=="noCountry"){
        $contractType=$_POST['contractType_1'];
    }elseif ($countryType=="saudi"){
        $contractType=$_POST['contractType_2'];
    }elseif ($countryType=="kwait"){
        $contractType=$_POST['contractType_3'];
    }elseif ($countryType=="quatar"){
        $contractType=$_POST['contractType_4'];
    }

    // Validate contract type
    if ($contractType == 'none') {
        $_SESSION['status'] = 'error';
        $_SESSION['message'] = 'Please select a valid contract type.';
        header("Location: ../view_all_Contracts.php");
        exit();
    }

    // Default values for options
    $hasMuzaned = 0;
    $hasEnjaze = 0;
    $hasFingerprint = 0;

    // Check if options are selected
    if (isset($_POST['options'])) {
        $options = $_POST['options']; // This will be an array of selected options

        if (in_array('muzaned', $options)) {
            $hasMuzaned = 1;
        }
        if (in_array('enjaze', $options)) {
            $hasEnjaze = 1;
        }
        if (in_array('fingerprint', $options)) {
            $hasFingerprint = 1;
        }
    }


    $sqlmedicalupdates = "UPDATE `contract_details` SET 
                          `country` = ?, 
                          `interviewStatus` = ?, 
                          `medicalStatus` = ?, 
                          `EnjazSatus` = ?, 
                          `MuzanedStatus` = ?, 
                          `fprintStatus` = ? ,
                          `BeauroStatus` = ? ,
                          `contractType` = ?, 
                          `hasMuzaned` = ? ,
                          `hasEnjaze` = ? ,
                          `hasFingerprint` = ?, 
                          `visa_status` = ?
                          
                          WHERE `contractId` = ?";

    $smtpmedicalupdate = $conn->prepare($sqlmedicalupdates);

    if ($smtpmedicalupdate) {
        // Bind the parameters
        $smtpmedicalupdate->bind_param("ssssssssssssi",
            $countryType,     // medicalStatus (string)
            $interviewStatus,     // medicalresult (string)
            $medicalStatus,     // CollectedDate (string)
            $EnjazSatus,       // collectedBy (string)
            $MuzanedStatus,           // medicalRemark (string)
            $fprintStatus,
            $BeauroStatus,
            $contractType,// updateAt (string, date)
            $hasMuzaned,
            $hasEnjaze,
            $hasFingerprint,
            $visa_status,              // updatedBy (integer)
            $contractId          // medicalId (integer)
        );
        if($smtpmedicalupdate->execute()){

            header("Location: ../view_all_Contracts.php");


        }else{
            echo "Error Creating Medical Center";
        }
        $smtpmedicalupdate->close();
    }



    $conn->close();
}
?>
