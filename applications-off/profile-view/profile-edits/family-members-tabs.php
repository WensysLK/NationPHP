<?php

// Check if 'client_id' is set in the URL
if (isset($_GET['client_id'])) {
    $client_id = $_GET['client_id'];

    // Query to fetch guardian details from `guardian_details`
    $sqlGuardian = "SELECT `GuardianId`, `GuardianName`, `GuardianContact`, `GuardianType`, `GuardianDob`, `GuargdianNic` 
                    FROM `guardian_details` WHERE `GuardianClient` = ? AND softdeletestatus=1 LIMIT 1";
    $stmtGuardian = $conn->prepare($sqlGuardian);
    $stmtGuardian->bind_param("i", $client_id);
    $stmtGuardian->execute();
    $resultGuardian = $stmtGuardian->get_result();
    $guardian = $resultGuardian->fetch_assoc(); // Single guardian record

    // Query to fetch spouse details from `spouse_details`
    $sqlSpouse = "SELECT `spouceId`, `SpouceName`, `SpouceType`, `maritalStatus`, `spouceContact`, `spouceNic`, `spouceDob` 
                  FROM `spouce_details` WHERE `spoceClientId` = ? AND softdeletestatus=1 LIMIT 1";
    $stmtSpouse = $conn->prepare($sqlSpouse);
    $stmtSpouse->bind_param("i", $client_id);
    $stmtSpouse->execute();
    $resultSpouse = $stmtSpouse->get_result();
    $spouse = $resultSpouse->fetch_assoc(); // Single spouse record

    // Query to fetch sibling details from `siblings_details`
    $sqlSiblings = "SELECT `sibilingId`, `SibilingName`, `SibilingType`, `SibilingDob`, `schoolAttended`, `schoolName`, 
                    `schoolGrade`, `sibilingNic` FROM `sibilings_details` WHERE `sibilingClientID` = ? AND softdeletestatus=1";
    $stmtSiblings = $conn->prepare($sqlSiblings);
    $stmtSiblings->bind_param("i", $client_id);
    $stmtSiblings->execute();
    $resultSiblings = $stmtSiblings->get_result(); // Multiple sibling records

    // Fetch attachment details for Guardian, Spouse, and Sibling by using `attachmentsourceId` from `attachments_data`
    $sqlAttachments = "SELECT `attachmentsourceId`, `attachmentType`, `attachFilename` 
                       FROM `attachemnts_data` 
                       WHERE `attachemnet_ClientID` = ? AND softdeletestatus=1";
    $stmtAttachments = $conn->prepare($sqlAttachments);
    $stmtAttachments->bind_param("i", $client_id);
    $stmtAttachments->execute();
    $resultAttachments = $stmtAttachments->get_result();

    // Organize attachments by source id (Guardian, Spouse, Sibling)
    $guardianAttachments = [];
    $spouseAttachments = [];
    $siblingAttachments = [];

    // Fetch sibling data and store in an array to avoid re-fetching
    $siblingData = [];
    while ($sibling = $resultSiblings->fetch_assoc()) {
        $siblingData[] = $sibling;
    }

    // Process attachments by checking the source IDs
    while ($attachment = $resultAttachments->fetch_assoc()) {
        if ($guardian && $attachment['attachmentsourceId'] == $guardian['GuardianId']) {
            $guardianAttachments[] = $attachment;
        } elseif ($spouse && $attachment['attachmentsourceId'] == $spouse['spouceId']) {
            $spouseAttachments[] = $attachment;
        } else {
            foreach ($siblingData as $sibling) {
                if ($attachment['attachmentsourceId'] == $sibling['sibilingId']) {
                    $siblingAttachments[$sibling['sibilingId']][] = $attachment;
                }
            }
        }
    }

    // Now display the data in tabs
    ?>
<div class="container mt-5">

    <div class="tab-content" id="myTabContent">
        <!-- Family & Attachments Tab -->
        <div class="tab-pane fade show active" id="family" role="tabpanel" aria-labelledby="family-tab">
            <div class="row mt-3">
                <!-- Guardian Details -->
                <!-- Guardian Details -->
                <?php if ($guardian): ?>
                <div class="col-md-12">
                    <h4>Guardian Information</h4>
                    <a href="#" class="btn btn-primary btn-sm" style="float: right;">
                    + Add New
                </a>
                    <table class="table table-bordered">
                        <thead>
                            <tr style="background-color: #f2f2f2;">
                                <th>Guardian Name</th>
                                <th>Guardian Type</th>
                                <th>Date of Birth</th>
                                <th>NIC</th>
                                <th>Contact</th>
                                <th>Actions</th> <!-- Add Actions column -->
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $guardian['GuardianName']; ?></td>
                                <td><?php echo $guardian['GuardianType']; ?></td>
                                <td><?php echo $guardian['GuardianDob']; ?></td>
                                <td><?php echo $guardian['GuargdianNic']; ?></td>
                                <td><?php echo $guardian['GuardianContact']; ?></td>
                                <td>
                                    <!-- Edit and Delete buttons -->
                                    <a href="edit_guardian.php?id=<?php echo $guardian['GuardianId']; ?>"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <a href="delete_guardian.php?id=<?php echo $guardian['GuardianId']; ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this guardian?');">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <!-- Guardian Attachments -->
                    <?php if (!empty($guardianAttachments)): ?>
                    <h4>Guardian Attachments</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr style="background-color: #f2f2f2;">
                                <th>Attachment Type</th>
                                <th>Filename</th>
                                <th>Actions</th> <!-- Add Actions column -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($guardianAttachments as $attachment): ?>
                            <tr>
                                <td><?php echo $attachment['attachmentType']; ?></td>
                                <td><?php echo $attachment['attachFilename']; ?></td>
                                <td>
                                    <!-- Edit and Delete buttons for attachments -->
                                    <a href="edit_attachment.php?id=<?php echo $attachment['attachmentsourceId']; ?>"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <a href="delete_attachment.php?id=<?php echo $attachment['attachmentsourceId']; ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this attachment?');">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <!-- Spouse Details -->
                <?php if ($spouse): ?>
                <hr>
                <div class="col-md-12">
                    <h4>Spouse Information</h4>
                    <a href="#" class="btn btn-primary btn-sm" style="float: right;">
                    + Add New
                </a>
                    <table class="table table-striped table-bordered mt-2">
                        <thead>
                            <tr style="background-color: #f2f2f2;">
                                <th>Spouse Name</th>
                                <th>Spouse Type</th>
                                <th>Marital Status</th>
                                <th>Date of Birth</th>
                                <th>NIC</th>
                                <th>Contact</th>
                                <th>Actions</th> <!-- Add Actions column -->
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $spouse['SpouceName']; ?></td>
                                <td><?php echo $spouse['SpouceType']; ?></td>
                                <td><?php echo $spouse['maritalStatus']; ?></td>
                                <td><?php echo $spouse['spouceDob']; ?></td>
                                <td><?php echo $spouse['spouceNic']; ?></td>
                                <td><?php echo $spouse['spouceContact']; ?></td>
                                <td>
                                    <!-- Edit and Delete buttons -->
                                    <a href="edit_spouse.php?id=<?php echo $spouse['spouceId']; ?>"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <a href="delete_spouse.php?id=<?php echo $spouse['spouceId']; ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this spouse?');">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <!-- Spouse Attachments -->
                    <?php if (!empty($spouseAttachments)): ?>
                    <h4>Spouse Attachments</h4>
                    <table class="table table-striped table-bordered mt-2">
                        <thead>
                            <tr style="background-color: #f2f2f2;">
                                <th>Attachment Type</th>
                                <th>Filename</th>
                                <th>Actions</th> <!-- Add Actions column -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($spouseAttachments as $attachment): ?>
                            <tr>
                                <td><?php echo $attachment['attachmentType']; ?></td>
                                <td><?php echo $attachment['attachFilename']; ?></td>
                                <td>
                                    <!-- Edit and Delete buttons for attachments -->
                                    <a href="edit_attachment.php?id=<?php echo $attachment['attachmentsourceId']; ?>"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <a href="delete_attachment.php?id=<?php echo $attachment['attachmentsourceId']; ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this attachment?');">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <!-- Sibling Details -->
                <div class="col-md-12">
                    <h4>Sibling Information</h4>
                    <a href="#" class="btn btn-primary btn-sm" style="float: right;">
                    + Add New
                </a>
                    <table class="table table-striped table-bordered mt-2">
                        <thead>
                            <tr style="background-color: #f2f2f2;">
                                <th>Sibling Name</th>
                                <th>Type</th>
                                <th>Date of Birth</th>
                                <th>NIC</th>
                                <th>School Attended</th>
                                <th>School Name</th>
                                <th>Grade</th>
                                <th>Attachment Type</th>
                                <th>Attachment Filename</th>
                                <th>Actions</th> <!-- Add Actions column -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($siblingData as $sibling): ?>
                            <tr>
                                <td><?php echo $sibling['SibilingName']; ?></td>
                                <td><?php echo $sibling['SibilingType']; ?></td>
                                <td><?php echo $sibling['SibilingDob']; ?></td>
                                <td><?php echo $sibling['sibilingNic']; ?></td>
                                <td><?php echo $sibling['schoolAttended']; ?></td>
                                <td><?php echo $sibling['schoolName']; ?></td>
                                <td><?php echo $sibling['schoolGrade']; ?></td>
                                <td>
                                    <?php 
                    if (isset($siblingAttachments[$sibling['sibilingId']])) {
                        foreach ($siblingAttachments[$sibling['sibilingId']] as $attachment) {
                            echo $attachment['attachmentType'] . '<br>';
                        }
                    } else {
                        echo 'No attachments';
                    }
                    ?>
                                </td>
                                <td>
                                    <?php 
                    if (isset($siblingAttachments[$sibling['sibilingId']])) {
                        foreach ($siblingAttachments[$sibling['sibilingId']] as $attachment) {
                            echo $attachment['attachFilename'] . '<br>';
                        }
                    } else {
                        echo 'No attachments';
                    }
                    ?>
                                </td>
                                <td>
                                    <!-- Edit and Delete buttons -->
                                    <a href="edit_sibling.php?id=<?php echo $sibling['sibilingId']; ?>"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <a href="delete_sibling.php?id=<?php echo $sibling['sibilingId']; ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this sibling?');">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Ensure Bootstrap's JavaScript is loaded correctly -->

<?php
    
}
?>