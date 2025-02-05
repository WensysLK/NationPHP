<?php
include('../../../includes/db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }




    // Insert personal data into agentdetails
    $agentId = $_POST['agentId'];
    $lagentType = $_POST['agentType'];
    $lAgentTitle = $_POST['name-title'];
    $lAgentFname = $_POST['ownerFname'];
    $lAgnetMname = $_POST['ownerFname'];
    $lAgentLname = $_POST['ownerLname'];
    $nicNo = $_POST['nicNumber'];
    $lgentWhatzapp = $_POST['phoneNumber'];
    $lgentEMail = $_POST['ownerEmail'];
    $lagentRemark = $_POST['fAgentRemark'];
    $lagentMap = $_POST['mapEmbedCode'];
    $regStatus =$_POST['status'];
    $softdeletestatus = "1";
    $contactAddress1 = $_POST['agentPAddress'];
    $contactAddress2 = $_POST['agentPAddress2'];
    $contactCity = $_POST['agentPCity'];
    $contactProvince = $_POST['agentPprovince'];
    $creatAt=date('y-m-d');



    $query = "UPDATE local_agent_details SET localAgentType = ?, Local_Agent_Title = ?,Local_Agent_Fname = ?,Local_Agent_Mname = ?,Local_Agent_Lname = ?,Local_Agent_Nic = ?, Local_Agent_Phone = ?, Local_Agent_Email = ?, Local_Agent_Remark = ?, Local_Agent_Map = ?,
                               Local_Agent_address_1 = ?,Local_Agent_address_2 = ?,local_agent_city = ?,local_agent_province = ?, regStatus =?,
                                   softdeletestatus = ?,creatAt = ? WHERE localagentId = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssssssssssssssi", $lagentType,
        $lAgentTitle,
        $lAgentFname,
        $lAgnetMname,
        $lAgentLname,
        $nicNo,
        $lgentWhatzapp,
        $lgentEMail,
        $lagentRemark,
        $lagentMap,
        $contactAddress1,
        $contactAddress2,
        $contactCity,
        $contactProvince,
        $regStatus,
        $softdeletestatus,
        $creatAt,
        $agentId
    );
    $stmt->execute();




    // Check if company data is provided before inserting into agentcompany
    $companyName = isset($_POST['companyName']) ? $_POST['companyName'] : '';
    $CompanyWebsite = $_POST['companyWebsite'];
    $companyBrNo = $_POST['companyBr'];
    $companyLNo = $_POST['RecLicens'];
    $CompanyAddress1 = $_POST['fagentddress1'];
    $CompanyAddress2 = $_POST['fagentaddress2'];
    $companyCity = $_POST['fagentcity'];
    $CompanyProvince = $_POST['fagentprovince'];
    $contactPerson = $_POST['inchargeName'];
    $contactPno = $_POST['inchargePhone'];
    $contactEmail = $_POST['inchargeEmail'];
    $contactDesignation = $_POST['inchargedesignation'];

    $agentsource = "LA";

    $query = "SELECT * FROM fagent_company_details WHERE fagentID = ?";

    $stmtSiblings = $conn->prepare($query);
    $stmtSiblings->bind_param("i", $agentId);
    $stmtSiblings->execute();
    $result = $stmtSiblings->get_result();
    $guardian = $result->fetch_assoc();
    $fagnetCompanyID=$guardian['fagnetCompanyID'];
    $newAgent=$guardian['fagentID'];

    $queryFrontImg = "SELECT * FROM attachemnts_data_id_front WHERE attachemnetId = ?";
    $stmtfrontImg = $conn->prepare($queryFrontImg);
    $stmtfrontImg->bind_param("i", $agentId);
    $stmtfrontImg->execute();
    $resultfrontImg = $stmtfrontImg->get_result();
    $frontImg = $resultfrontImg->fetch_assoc();

    $queryBackImg = "SELECT * FROM attachemnts_data_id_back WHERE attachemnetId = ?";
    $stmtbackImg = $conn->prepare($queryBackImg);
    $stmtbackImg->bind_param("i", $agentId);
    $stmtbackImg->execute();
    $resultbackImg = $stmtbackImg->get_result();
    $backImg = $resultbackImg->fetch_assoc();

    $queryBrImg = "SELECT * FROM attachemnts_data_idbr WHERE attachemnetId = ?";
    $stmtbrImg = $conn->prepare($queryBrImg);
    $stmtbrImg->bind_param("i", $agentId);
    $stmtbrImg->execute();
    $resultbrImg = $stmtbrImg->get_result();
    $brImg = $resultbrImg->fetch_assoc();

    $querylicenseImg = "SELECT * FROM attachemnts_data_license WHERE attachemnetId = ?";
    $stmtlicenseImg = $conn->prepare($querylicenseImg);
    $stmtlicenseImg->bind_param("i", $agentId);
    $stmtlicenseImg->execute();
    $resultlicenseImg = $stmtlicenseImg->get_result();
    $licenseImg = $resultlicenseImg->fetch_assoc();



    if (!empty($companyName)) {


        $query = "UPDATE fagent_company_details SET fagentID = ?, 
                                  AgentSource = ?,
                                  fagentRecruitmentID = ?,
                                  AddressLine1 = ?,
                                  AddressLine2 = ?,
                                  companyCity = ?,
                                  companyProvinceState = ?, 
                                  fagentCompanyName = ?, 
                                  fagnetComWebsite = ?, 
                                  personIncharge = ?, 
                                  pi_contact_number =?,
                                pi_email_address = ?,
                              pi_designation = ?,
                                fagentComID = ?, 
                                softdeletestatus = ?,
                                createdAt = ? WHERE fagnetCompanyID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssssssssssssssi", $newAgent,
            $agentsource,
            $companyLNo,
            $CompanyAddress1,
            $CompanyAddress2,
            $companyCity,
            $CompanyProvince,
            $companyName,
            $CompanyWebsite,
            $contactPerson,
            $contactPno,
            $contactEmail,
            $contactDesignation,
            $companyBrNo,
            $softdeletestatus,
            $creatAt ,
            $fagnetCompanyID);
        $stmt->execute();
    }
    


    // Check if any attachments are provided before inserting into attachments
//var_dump($_FILES['nicCopy1']['name']);die();
    if (!empty($_FILES['nicCopy1']['name'])) {

//        for ($i = 0; $i < count($_FILES['nicCopy1']['name']); $i++) {
//            $documentName = $_POST['documentName'][$i]; // Document type or name
            $documentAttachment = $_FILES['nicCopy1']['name']; // File name
            $doctype = 'Local-Agent';

            // Check if both document name and attachment are provided
            if ( !empty($documentAttachment)) {
                // Define the target directory
                $targetDir = "../../../uploads/agents/";

                // Get the file extension
                $fileExtension = pathinfo($documentAttachment, PATHINFO_EXTENSION);

                // Create a new file name with the document type and agent_id
                $newFileName =  $agent_id . "." . $fileExtension;
                $targetFile = $targetDir . $newFileName;

                // Move the uploaded file to the target directory with the new file name
                if (move_uploaded_file($_FILES['nicCopy1']['tmp_name'], $targetFile)) {
                    // Insert the file details into the attachments table


                    $query = "UPDATE attachemnts_data_id_front SET attachemnet_ClientID = ?, attachmentsourceId = ?,attachmentType = ?,attachemnt = ?,attachFilename = ?,
                                    createdAt = ?,softdeletestatus = ? WHERE localagentId = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("sssssi", $agent_id, $agent_id, $doctype, $targetFile, $newFileName,$frontImg['attachemnetId']);
                    $stmt->execute();





                } else {
                    echo "Error uploading the file: " . $documentAttachment;
                }
            }
        }
//    }
    if (!empty($_FILES['nicCopy2']['name'])) {
//        for ($i = 0; $i < count($_FILES['nicCopy2']['name']); $i++) {
//            $documentName = $_POST['documentName'][$i]; // Document type or name
            $documentAttachment = $_FILES['nicCopy2']['name']; // File name
            $doctype = 'Local-Agent';

            // Check if both document name and attachment are provided
            if ( !empty($documentAttachment)) {
                // Define the target directory
                $targetDir = "../../../uploads/agents/";

                // Get the file extension
                $fileExtension = pathinfo($documentAttachment, PATHINFO_EXTENSION);

                // Create a new file name with the document type and agent_id
                $newFileName = $agent_id . "." . $fileExtension;
                $targetFile = $targetDir . $newFileName;

                // Move the uploaded file to the target directory with the new file name
                if (move_uploaded_file($_FILES['nicCopy2']['tmp_name'], $targetFile)) {
                    // Insert the file details into the attachments table
                    $query = "UPDATE attachemnts_data_id_back SET attachemnet_ClientID = ?, attachmentsourceId = ?,attachmentType = ?,attachemnt = ?,attachFilename = ?,
                                    createdAt = ?,softdeletestatus = ? WHERE localagentId = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("sssssi", $agent_id, $agent_id, $doctype, $targetFile, $newFileName,$backImg['attachemnetId']);
                    $stmt->execute();
                } else {
                    echo "Error uploading the file: " . $documentAttachment;
                }
            }

    }
    if (!empty($_FILES['licenseCopy']['name'])) {
//        for ($i = 0; $i < count($_FILES['licenseCopy']['name']); $i++) {
//            $documentName = $_POST['documentName'][$i]; // Document type or name
            $documentAttachment = $_FILES['licenseCopy']['name']; // File name
            $doctype = 'Local-Agent';

            // Check if both document name and attachment are provided
            if ( !empty($documentAttachment)) {
                // Define the target directory
                $targetDir = "../../../uploads/agents/";

                // Get the file extension
                $fileExtension = pathinfo($documentAttachment, PATHINFO_EXTENSION);

                // Create a new file name with the document type and agent_id
                $newFileName = $agent_id . "." . $fileExtension;
                $targetFile = $targetDir . $newFileName;

                // Move the uploaded file to the target directory with the new file name
                if (move_uploaded_file($_FILES['licenseCopy']['tmp_name'], $targetFile)) {
                    // Insert the file details into the attachments table

                    $query = "UPDATE attachemnts_data_license SET attachemnet_ClientID = ?, attachmentsourceId = ?,attachmentType = ?,attachemnt = ?,attachFilename = ?,
                                    createdAt = ?,softdeletestatus = ? WHERE localagentId = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("sssssi", $agent_id, $agent_id, $doctype, $targetFile, $newFileName,$licenseImg['attachemnetId']);
                    $stmt->execute();
                } else {
                    echo "Error uploading the file: " . $documentAttachment;
                }

        }
    }
    if (!empty($_FILES['attachbBrcopy']['name'])) {
//        for ($i = 0; $i < count($_FILES['attachbBrcopy']['name']); $i++) {
//            $documentName = $_POST['documentName'][$i]; // Document type or name
            $documentAttachment = $_FILES['attachbBrcopy']['name']; // File name
            $doctype = 'Local-Agent';

            // Check if both document name and attachment are provided
            if (  !empty($documentAttachment)) {
                // Define the target directory
                $targetDir = "../../../uploads/agents/";

                // Get the file extension
                $fileExtension = pathinfo($documentAttachment, PATHINFO_EXTENSION);

                // Create a new file name with the document type and agent_id
                $newFileName =  $agent_id . "." . $fileExtension;
                $targetFile = $targetDir . $newFileName;

                // Move the uploaded file to the target directory with the new file name
                if (move_uploaded_file($_FILES['attachbBrcopy']['tmp_name'], $targetFile)) {
                    // Insert the file details into the attachments table
                    $query = "UPDATE attachemnts_data_idbr SET attachemnet_ClientID = ?, attachmentsourceId = ?,attachmentType = ?,attachemnt = ?,attachFilename = ?,
                                    createdAt = ?,softdeletestatus = ? WHERE localagentId = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("sssssi", $agent_id, $agent_id, $doctype, $targetFile, $newFileName,$brImg['attachemnetId']);
                    $stmt->execute();
                } else {
                    echo "Error uploading the file: " . $documentAttachment;
                }
            }

    }
    if (!empty($_FILES['documentAttachment']['name'][0])) {
        for ($i = 0; $i < count($_FILES['documentAttachment']['name']); $i++) {
            $documentName = $_POST['documentName'][$i]; // Document type or name
            $documentAttachment = $_FILES['documentAttachment']['name'][$i]; // File name
            $doctype = 'Local-Agent';
    
            // Check if both document name and attachment are provided
            if (!empty($documentName) && !empty($documentAttachment)) {
                // Define the target directory
                $targetDir = "../../../uploads/agents/";
    
                // Get the file extension
                $fileExtension = pathinfo($documentAttachment, PATHINFO_EXTENSION);
    
                // Create a new file name with the document type and agent_id
                $newFileName = $documentName . "_" . $agent_id . "." . $fileExtension;
                $targetFile = $targetDir . $newFileName;
    
                // Move the uploaded file to the target directory with the new file name
                if (move_uploaded_file($_FILES['documentAttachment']['tmp_name'][$i], $targetFile)) {
                    // Insert the file details into the attachments table
                    $sql = "INSERT INTO `attachemnts_data` 
                            (`attachemnet_ClientID`,attachmentsourceId, `attachmentType`, `attachemnt`, `attachFilename`) 
                            VALUES (?, ?, ?, ?,?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("iisss", $agent_id, $agent_id, $doctype, $targetFile, $newFileName);
                    $stmt->execute();
                } else {
                    echo "Error uploading the file: " . $documentAttachment;
                }
            }
        }
    }
       

    // Close the database connection
    $conn->close();

    // Redirect or show success message
    header("Location: ../view_all_local_agent.php");

}