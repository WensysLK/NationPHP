<?php
include('../../../includes/db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $agentId = $_POST['agentId'];
//    var_dump($_POST);die();
    // Insert personal data into agentdetails
    $fagentType = $_POST['agentType'];
    $fAgentTitle = $_POST['name-title'];
    $fAgentFname = $_POST['ownerFname'];
    $fAgnetMname = $_POST['ownerFname'];
    $fAgentLname = $_POST['ownerLname'];
    $iqamaNo = $_POST['iqamaNumber'];
    $AgentWhatzapp = $_POST['ownerWhatzapp'];
    $AgentEMail = $_POST['ownerEmail'];
    $fagentRemark = $_POST['fAgentRemark'];
    $fagentMap = $_POST['mapEmbedCode'];
    $regStatus =$_POST['status'];
    $contactAddress1 = $_POST['fagentddress1'];
    $contactAddress2 = $_POST['fagentaddress2'];
    $contactCity = $_POST['fagentcity'];
    $contactProvince = $_POST['fagentprovince'];
    $softdeletestatus = "1";
    $creatAt=date('y-m-d');


    $query = "UPDATE foreign_agent_details SET fagentType = ?, fagentTitle = ?,fagentFname = ?,fagentMname = ?,fagentLname = ?,adressline_1 = ?, addressline2 = ?, city = ?, provinecs = ?, fagentIqamaNo = ?,
                               fagentWhatzapp = ?,fagentEmail = ?,fagentRemark = ?,fagentMap = ?, status =?,
                                   softdeletestatus = ?,createdAt = ? WHERE fagentId = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssssssssssssssi", $fagentType,
        $fAgentTitle,
        $fAgentFname,
        $fAgnetMname,
        $fAgentLname,
        $contactAddress1,
        $contactAddress2,
        $contactCity,
        $contactProvince,
        $iqamaNo,
        $AgentWhatzapp,
        $AgentEMail,
        $fagentRemark,
        $fagentMap,
        $regStatus,
        $softdeletestatus,
        $creatAt,
        $agentId
    );
    $stmt->execute();



    $query = "SELECT * FROM forginagent_company_details WHERE fagentID = ?";

    $stmtSiblings = $conn->prepare($query);
    $stmtSiblings->bind_param("i", $agentId);
    $stmtSiblings->execute();
    $result = $stmtSiblings->get_result();
    $guardian = $result->fetch_assoc();


//    var_dump($guardian ,$agentId);die();
    $fagnetCompanyID=$guardian['fagnetCompanyID'];
    $newAgent=$guardian['fagentID'];


    $queryFrontImg = "SELECT * FROM attachemnts_data_iqama WHERE attachemnet_ClientID = ?";
    $stmtfrontImg = $conn->prepare($queryFrontImg);
    $stmtfrontImg->bind_param("i", $agentId);
    $stmtfrontImg->execute();
    $resultfrontImg = $stmtfrontImg->get_result();
    $frontImg = $resultfrontImg->fetch_assoc();

    $queryBrImg = "SELECT * FROM attachemnts_data_idbr WHERE forigen_agent_id = ?";
    $stmtbrImg = $conn->prepare($queryBrImg);
    $stmtbrImg->bind_param("i", $agentId);
    $stmtbrImg->execute();
    $resultbrImg = $stmtbrImg->get_result();
    $brImg = $resultbrImg->fetch_assoc();

    $querylicenseImg = "SELECT * FROM attachemnts_data_license WHERE forigen_agent_id = ?";
    $stmtlicenseImg = $conn->prepare($querylicenseImg);
    $stmtlicenseImg->bind_param("i", $agentId);
    $stmtlicenseImg->execute();
    $resultlicenseImg = $stmtlicenseImg->get_result();
    $licenseImg = $resultlicenseImg->fetch_assoc();




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
    $agentsource = "FA";

    if (!empty($companyName)) {


        $query = "UPDATE forginagent_company_details SET fagentID = ?, 
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

    if (!empty($_FILES['iqamaNumber']['name'])) {
//        for ($i = 0; $i < count($_FILES['attachbBrcopy']['name']); $i++) {
//            $documentName = $_POST['documentName'][$i]; // Document type or name
        $documentAttachmentIQA = $_FILES['iqamaNumber']['name']; // File name
        $doctype = 'Foreign-Agent';

        // Check if both document name and attachment are provided
        if (  !empty($documentAttachmentIQA)) {
            // Define the target directory
            $targetDir = "../../../uploads/agents/IQA/";

            // Get the file extension
            $fileExtension = pathinfo($documentAttachmentIQA, PATHINFO_EXTENSION);

            // Create a new file name with the document type and agent_id
            $newFileName =  $agentId . "." . $fileExtension;
            $targetFile = $targetDir . $newFileName;

            // Move the uploaded file to the target directory with the new file name
            if (move_uploaded_file($_FILES['iqamaNumber']['tmp_name'], $targetFile)) {
                // Insert the file details into the attachments table
                $sql = "INSERT INTO `attachemnts_data_iqama` 
                            (`attachemnet_ClientID`,attachmentsourceId, `attachmentType`, `attachemnt`, `attachFilename`) 
                            VALUES (?, ?, ?, ?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("iisss", $agentId, $agentId, $doctype, $targetFile, $newFileName);
                $stmt->execute();
            } else {
                echo "Error uploading the file: " . $documentAttachmentIQA;
            }
        }

    }
    if (!empty($_FILES['licenseCopy']['name'])) {
//        for ($i = 0; $i < count($_FILES['licenseCopy']['name']); $i++) {
//            $documentName = $_POST['documentName'][$i]; // Document type or name
        $documentAttachmentForeignLicenseCopy = $_FILES['licenseCopy']['name']; // File name
        $doctype = 'Foreign-Agent';

        // Check if both document name and attachment are provided
        if ( !empty($documentAttachmentForeignLicenseCopy)) {
            // Define the target directory
            $targetDir = "../../../uploads/agents/foreignLicenseCopy/";

            // Get the file extension
            $fileExtensionFLi = pathinfo($documentAttachmentForeignLicenseCopy, PATHINFO_EXTENSION);

            // Create a new file name with the document type and agent_id
            $newFileNameFLi = $agentId . "." . $fileExtensionFLi;
            $targetFileFLi = $targetDir . $newFileNameFLi;

            // Move the uploaded file to the target directory with the new file name
            if (move_uploaded_file($_FILES['licenseCopy']['tmp_name'], $targetFileFLi)) {
                // Insert the file details into the attachments table
                $sql = "INSERT INTO `attachemnts_data_license` 
                            (`forigen_agent_id`,attachmentsourceId, `attachmentType`, `attachemnt`, `attachFilename`) 
                            VALUES (?, ?, ?, ?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("iisss", $agentId, $agentId, $doctype, $targetFileFLi, $newFileNameFLi);
                $stmt->execute();
            } else {
                echo "Error uploading the file: " . $documentAttachmentForeignLicenseCopy;
            }

        }
    }
    if (!empty($_FILES['attachbBrcopy']['name'])) {
//        for ($i = 0; $i < count($_FILES['attachbBrcopy']['name']); $i++) {
//            $documentName = $_POST['documentName'][$i]; // Document type or name
        $documentAttachmentFBrCopy = $_FILES['attachbBrcopy']['name']; // File name
        $doctype = 'Foreign-Agent';

        // Check if both document name and attachment are provided
        if (  !empty($documentAttachmentFBrCopy)) {
            // Define the target directory
            $targetDir = "../../../uploads/agents/FBrCopy/";

            // Get the file extension
            $fileExtensionFBrCopy = pathinfo($documentAttachmentFBrCopy, PATHINFO_EXTENSION);

            // Create a new file name with the document type and agent_id
            $newFileNameFBrCopy =  $agentId . "." . $fileExtensionFBrCopy;
            $targetFileFBrtCopy = $targetDir . $newFileNameFBrCopy;

            // Move the uploaded file to the target directory with the new file name
            if (move_uploaded_file($_FILES['attachbBrcopy']['tmp_name'], $targetFileFBrtCopy)) {
                // Insert the file details into the attachments table
                $sql = "INSERT INTO `attachemnts_data_idbr` 
                            (`forigen_agent_id`,attachmentsourceId, `attachmentType`, `attachemnt`, `attachFilename`) 
                            VALUES (?, ?, ?, ?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("iisss", $agentId, $agentId, $doctype, $targetFileFBrtCopy, $newFileNameFBrCopy);
                $stmt->execute();
            } else {
                echo "Error uploading the file: " . $documentAttachmentFBrCopy;
            }
        }

    }
    // Check if any attachments are provided before inserting into attachments
    if (!empty($_FILES['documentAttachment']['name'][0])) {
        for ($i = 0; $i < count($_FILES['documentAttachment']['name']); $i++) {
            $documentName = $_POST['documentName'][$i]; // Document type or name
            $documentAttachment = $_FILES['documentAttachment']['name'][$i]; // File name
            $doctype = 'Foreign-Agent';

            // Check if both document name and attachment are provided
            if (!empty($documentName) && !empty($documentAttachment)) {
                // Define the target directory
                $targetDir = "../../../uploads/agents/";

                // Get the file extension
                $fileExtension = pathinfo($documentAttachment, PATHINFO_EXTENSION);

                // Create a new file name with the document type and agent_id
                $newFileName = $documentName . "_" . $agentId . "." . $fileExtension;
                $targetFile = $targetDir . $newFileName;

                // Move the uploaded file to the target directory with the new file name
                if (move_uploaded_file($_FILES['documentAttachment']['tmp_name'][$i], $targetFile)) {
                    // Insert the file details into the attachments table
                    $sql = "INSERT INTO `attachemnts_data` (`attachemnet_ClientID`, attachmentsourceId, `attachmentType`, `attachemnt`, `attachFilename`) VALUES (?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("iisss", $agentId, $agentId, $doctype, $targetFile, $newFileName);

                    if (!$stmt->execute()) {
                        echo "Error inserting attachment: " . $stmt->error;
                        exit;
                    }
                } else {
                    echo "Error uploading the file: " . $documentAttachment;
                }
            }
        }
    }

    // Close the database connection
    $conn->close();

    // Redirect or show success message
    header("Location: ".$baseUrl."/agents/foreign-agent/view_all_foreign_agent.php");
    exit;
}
?>
