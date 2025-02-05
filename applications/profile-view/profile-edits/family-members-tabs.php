<?php

// Check if 'client_id' is set in the URL
if (isset($_GET['client_id'])) {
    $client_id = $_GET['client_id'];






    $sqlParents = "SELECT `parentId`, `parentname`, `parentcontact`, `parentNic`, `parentDob`, `parent_Type` 
                    FROM `parents_details` WHERE `ParentClientID` = ? AND softdeletestatus=1 ";
    $stmtParents = $conn->prepare($sqlParents);
    $stmtParents->bind_param("i", $client_id);
    $stmtParents->execute();
    $resultParents = $stmtParents->get_result();

//    $parent = $resultParents->fetch_assoc();

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
                  FROM `spouce_details` WHERE `spoceClientId` = ? AND softdeletestatus=1";
    $stmtSpouse = $conn->prepare($sqlSpouse);
    $stmtSpouse->bind_param("i", $client_id);
    $stmtSpouse->execute();
    $resultSpouse = $stmtSpouse->get_result();
     // Single spouse record
    $spouseData = [];
    while ($spouse = $resultSpouse->fetch_assoc()) {
        $spouseData[] = $spouse;
    }
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
    $parentData = [];
    while ($parent = $resultParents->fetch_assoc()) {
        $parentData[] = $parent;
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

                <?php if ($parentData): ?>
                    <div class="col-md-12">
                        <h4>Parent Information</h4>
<!--                        <a href="#" class="btn btn-primary btn-sm" style="float: right;">-->
<!--                            + Add New-->
<!--                        </a>-->
                        <table class="table table-bordered">
                            <thead>
                            <tr style="background-color: #f2f2f2;">
                                <th>Parent Name</th>
                                <th>Parent Type</th>
                                <th>Date of Birth</th>
                                <th>NIC</th>
                                <th>Contact</th>
                                <th>Actions</th> <!-- Add Actions column -->
                            </tr>
                            </thead>
                            <tbody>

        <?php foreach ($parentData as $parent): ?>
                            <tr>
                                <td><?php echo $parent['parentname']; ?></td>
                                <td><?php echo $parent['parent_Type']; ?></td>
                                <td><?php echo $parent['parentDob']; ?></td>
                                <td><?php echo $parent['parentNic']; ?></td>
                                <td><?php echo $parent['parentcontact']; ?></td>
                                <td>
                                    <!-- Edit and Delete buttons -->
                                    <a type="button"  class="btn btn-primary btn-sm" style="background-color: yellow;" data-bs-toggle="modal" data-bs-target="#familyAddinfonew">
                                        Edit
                                    </a>
<!--                                    <a href="#familyAddinfonew"-->
<!--                                       class="btn btn-warning btn-sm">Edit</a>-->
<!--                                    <a href="delete_guardian.php?id=--><?php //echo $parent['parentId']; ?><!--"-->
<!--                                       class="btn btn-danger btn-sm"-->
<!--                                       onclick="return confirm('Are you sure you want to delete this guardian?');">Delete</a>-->
                                </td>
                            </tr>
        <?php endforeach; ?>
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
                <?php if ($spouseData): ?>
                <hr>
                <div class="col-md-12">
                    <h4>Spouse Information</h4>
                    <a type="button"  class="btn btn-primary btn-sm" style="float: right;" data-bs-toggle="modal" data-bs-target="#spouseAddinfonew">
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
        <?php foreach ($spouseData as $spouse): ?>
                            <tr>
                                <td><?php echo $spouse['SpouceName']; ?></td>
                                <td><?php echo $spouse['SpouceType']; ?></td>
                                <td><?php echo $spouse['maritalStatus']; ?></td>
                                <td><?php echo $spouse['spouceDob']; ?></td>
                                <td><?php echo $spouse['spouceNic']; ?></td>
                                <td><?php echo $spouse['spouceContact']; ?></td>
                                <td>
                                    <!-- Edit and Delete buttons -->
                                    <a type="button"  class="btn btn-warning btn-sm"  data-bs-toggle="modal" data-bs-target="#spouseEditinfonew">
                                        Edit
                                    </a>
                                    <form id="registrationForm" method="post"  action="Functions/delete_spouse_precheck.php"style="display:inline;">
                                        <!--        <form method="POST" action="Funtions/delete_license_precheck.php" style="display:inline;">-->
                                        <input type="hidden" name="spouceId" id="spouceId" value="<?php echo $spouse['spouceId'] ?>">
                                        <input type="hidden" name="client_id" id="langClientId" value="<?php echo $client_id; ?>">                                <button type="submit" class="btn btn-danger btn-sm"
                                                                                                                                                                          onclick="return confirm('Are you sure you want to delete this spouse?');">
                                            Delete
                                        </button>
                                    </form>


                                </td>
                            </tr>
        <?php endforeach; ?>
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
                    <a type="button"  class="btn btn-primary btn-sm" style="float: right;" data-bs-toggle="modal" data-bs-target="#sblingsinfonew">
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
                                    <a type="button"  class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#sblingsEditinfonew">
                                        Edit
                                    </a>
                                    <form id="registrationForm" method="post"  action="Functions/delete_sblings_precheck.php"style="display:inline;">
                                        <!--        <form method="POST" action="Funtions/delete_license_precheck.php" style="display:inline;">-->
                                        <input type="hidden" name="sibilingId" id="sibilingId" value="<?php echo $sibling['sibilingId']; ?>">
                                        <input type="hidden" name="client_id" id="langClientId" value="<?php echo $client_id; ?>">                                <button type="submit" class="btn btn-danger btn-sm"
                                                                                                                                                                          onclick="return confirm('Are you sure you want to delete this sibling?');">
                                            Delete
                                        </button>
                                    </form>

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
    <div class="modal fade" id="familyAddinfonew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel3">Edit Driving License Details</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="registrationForm" method="post"  action="Functions/parent_precheck.php"">
                    <input type="hidden" name="client_id" id="client_id" value="<?php echo $client_id ?>">
                    <input type="hidden" name="parentid" id="parentid" value="<?php echo $parent['parentId'] ?>"> <!-- Add this if you need client ID -->

                    <div class="row">
                        <div class="col p-2">
                            <label for="fatherFullName" class="form-label">Parent's Name</label>
                            <input type="text" class="form-control" id="parentFullName" name="parentFullName" value="<?php echo $parent['parentname'] ?>">
                            <input type="hidden" name="parentType" value="<?php echo $parent['parent_Type'] ?>">
                        </div>
                        <div class="col p-2">
                            <label for="fatherDOB" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="parentDOB" name="parentDOB"
                                   onchange="calculateAgeFather('father')"value="<?php echo $parent['parentDob'] ?>">
                        </div>
<!--                        <div class="col p-2">-->
<!--                            <label for="fatherAge" class="form-label">Age</label>-->
<!--                            <input type="text" class="form-control" id="fatherAge" name="fatherAge" readonly>-->
<!--                        </div>-->

                        <div class="col p-2">
                            <label for="fatherContactNumber" class="form-label">Contact Number</label>
                            <input type="text" class="form-control" id="parentContactNumber" name="parentContactNumber"value="<?php echo $parent['parentcontact'] ?>">
                        </div>
                        <div class="col p-2">
                            <label for="fatherNIC" class="form-label">NIC</label>
                            <input type="text" class="form-control" id="fatherNIC" name="fatherNIC"value="<?php echo $parent['parentNic'] ?>">
                        </div>

                    </div>

                    <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="spouseAddinfonew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel3">Add Spouse Details</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="registrationForm" method="post"  action="Functions/spouse_precheck.php"">
                    <input type="hidden" name="client_id" id="client_id" value="<?php echo $client_id ?>">

                    <div class="row">
                        <div class="col p-2">
                            <label for="spouseFullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="spouseFullName" name="spouseFullName">
                        </div>
                        <div class="col p-2">
                            <label for="relationship" class="form-label">Relationship</label>
                            <select name="relationship" class="form-control" id="relationship">
                                <option value="">Select</option>
                                <option value="husband">Husband</option>
                                <option value="wife">Wife</option>
                            </select>
                        </div>
                        <div class="col p-2">
                            <label for="spouseDOB" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="spouseDOB" name="spouseDOB" onchange="calculateAgespouce('spouse')">
                        </div>
                        <div class="col p-2">
                            <label for="spouseAge" class="form-label">Age</label>
                            <input type="text" class="form-control" id="spouseAge" name="spouseAge" readonly>
                        </div>
                        <div class="col p-2">
                            <label for="maritalStatus" class="form-label">Status</label>
                            <select name="maritalStatus" class="form-control" id="maritalStatus">
                                <option value="">Select Status</option>
                                <option value="active">Active</option>
                                <option value="divorced">Divorced</option>
                                <option value="widowed">Widowed</option>
                            </select>
                        </div>
                        <div class="col p-2">
                            <label for="spouseContactNumber" class="form-label">Contact Number</label>
                            <input type="text" class="form-control" id="spouseContactNumber" name="spouseContactNumber">
                        </div>
                    </div>

                    <div class="row">
<!--                        <div class="col p-2">-->
<!--                            <label for="spouseContactNumber" class="form-label">Contact Number</label>-->
<!--                            <input type="text" class="form-control" id="spouseContactNumber" name="spouseContactNumber">-->
<!--                        </div>-->
                        <div class="col p-2">
                            <label for="spouseNIC" class="form-label">NIC No</label>
                            <input type="text" class="form-control" id="spouseNIC" name="spouseNIC">
                        </div>

                        <div class="col p-2" id="">
                            <label for="spoucenicfront" class="form-label ">Spouce Nic Front</label>
                            <input type="file" class="form-control" name="spoucenicfront" id="">
                        </div>
                        <div class="col p-2" id="">
                            <label for="spoucenicback" class="form-label ">Spouce Nic Back</label>
                            <input type="file" class="form-control" name="spoucenicback" id="">
                        </div>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="spouseEditinfonew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel3">Add Spouse Details</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="registrationForm" method="post"  action="Functions/sposeEditprecheck.php">
                    <input type="hidden" name="client_id" id="client_id" value="<?php echo $client_id ?>">
                    <input type="hidden" name="spoceId" id="spoceId" value="<?php echo $spouse['spouceId'] ?>">

                    <div class="row">
                        <div class="col p-2">
                            <label for="spouseFullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="spouseFullName" name="spouseFullName" value="<?php echo $spouse['SpouceName'] ?>">
                        </div>
                        <div class="col p-2">
                            <label for="relationship" class="form-label">Relationship</label>
                            <select name="relationship" class="form-control" id="relationship">
                               <?php if ($spouse['SpouceType'] == "husband"){ ?>
                                <option value="husband" selected>Husband</option>
                                <option value="wife">Wife</option>
                                <?php }elseif ($spouse['SpouceType'] == "wife"){ ?>
                                <option value="husband" >Husband</option>
                                <option value="wife"selected>Wife</option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col p-2">
                            <label for="spouseDOB" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="spouseDOB" name="spouseDOB" value="<?php echo $spouse['spouceDob'] ?>" >
                        </div>
<!--                        <div class="col p-2">-->
<!--                            <label for="spouseAge" class="form-label">Age</label>-->
<!--                            <input type="text" class="form-control" id="spouseAge" name="spouseAge" readonly>-->
<!--                        </div>-->
                        <div class="col p-2">
                            <label for="maritalStatus" class="form-label">Status</label>
                            <select name="maritalStatus" class="form-control" id="maritalStatus">
                                <?php if ($spouse['maritalStatus'] == "active"){ ?>
                                <option value="active" selected>Active</option>
                                <option value="divorced">Divorced</option>
                                <option value="widowed">Widowed</option>
                                <?php }elseif ($spouse['maritalStatus'] == "divorced"){ ?>
                                <option value="active">Active</option>
                                <option value="divorced" selected>Divorced</option>
                                <option value="widowed">Widowed</option>
                                <?php }elseif ($spouse['maritalStatus'] == "widowed"){ ?>
                                <option value="active">Active</option>
                                <option value="divorced" >Divorced</option>
                                <option value="widowed"selected>Widowed</option>
                                 <?php } ?>
                            </select>
                        </div>
                        <div class="col p-2">
                            <label for="spouseContactNumber" class="form-label">Contact Number</label>
                            <input type="text" class="form-control" id="spouseContactNumber" name="spouseContactNumber" value="<?php echo $spouse['spouceContact'] ?>">
                        </div>
                    </div>

                    <div class="row">
                        <!--                        <div class="col p-2">-->
                        <!--                            <label for="spouseContactNumber" class="form-label">Contact Number</label>-->
                        <!--                            <input type="text" class="form-control" id="spouseContactNumber" name="spouseContactNumber">-->
                        <!--                        </div>-->
                        <div class="col p-2">
                            <label for="spouseNIC" class="form-label">NIC No</label>
                            <input type="text" class="form-control" id="spouseNIC" name="spouseNIC" value="<?php echo $spouse['spouceNic'] ?>">
                        </div>

                        <div class="col p-2" id="">
                            <label for="spoucenicfront" class="form-label ">Spouce Nic Front</label>
                            <input type="file" class="form-control" name="spoucenicfront" id="">
                        </div>
                        <div class="col p-2" id="">
                            <label for="spoucenicback" class="form-label ">Spouce Nic Back</label>
                            <input type="file" class="form-control" name="spoucenicback" id="">
                        </div>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="sblingsinfonew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel3">Add Children & Sibiling Details</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="registrationForm" method="post"  action="Functions/sblings_precheck.php">
                        <input type="hidden" name="client_id" id="client_id" value="<?php echo $client_id ?>">

                        <div id="repeaterContainer">
                            <!-- Initial set of fields -->
                            <div class="row repeater-group">
                                <div class="row">
                                    <div class="col p-2">
                                        <label class="form-label ">Name</label>
                                        <input class="form-control" type="text" name="childName">
                                    </div>
                                    <div class="col p-2">
                                        <label class="form-label ">Relationship</label>
                                        <select name="childRelationship" class="form-control">
                                            <option value="son">Son</option>
                                            <option value="daughter">Daughter</option>
                                            <option value="brother">Brother</option>
                                            <option value="sister">Sister</option>
                                        </select>
                                    </div>
                                    <div class="col p-2">
                                        <label class="form-label ">Date of Birth</label>
                                        <input class="form-control" type="date" name="childDOB"
                                               onchange="calculateAge2(this)">
                                    </div>
                                    <div class="col p-2">
                                        <label class="form-label ">Age</label>
                                        <input class="form-control" type="text" name="childAge" readonly>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col p-2">
                                        <label class="form-label ">School Attended</label>
                                        <select name="childSchoolAttended" class="form-control"
                                                onchange="toggleSchoolFields(this)">
                                            <option value="none">Select Option</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                    <div class="col school-fields" style="display: none;">
                                        <div class="row">
                                            <div class="col p-2">
                                                <label class="form-label ">School Name</label>
                                                <input class="form-control" type="text"
                                                       name="childSchoolName">
                                            </div>
                                            <div class="col p-2">
                                                <label class="form-label ">Grade</label>
                                                <input class="form-control" type="text" name="childGrade">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col p-2" id="nationalIdField">
                                        <label class="form-label ">National ID</label>
                                        <input class="form-control" type="text" name="childNIC">
                                    </div>
                                    <div class="col p-2" id="">
                                        <label for="sibilingnicfront" class="form-label ">Sibiling NIC
                                            Front</label>
                                        <input type="file" class="form-control" name="sibilingnicfront" id="">
                                    </div>
                                    <div class="col p-2" id="">
                                        <label for="sibilingnicback" class="form-label ">Sibiling NIC
                                            Back</label>
                                        <input type="file" class="form-control" name="sibilingnicback" id="">
                                    </div>

                                </div>



                            </div>
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="sblingsEditinfonew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel3">Add Children & Sibiling Details</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="registrationForm" method="post"  action="Functions/sblingsEdit_precheck.php">
                        <input type="hidden" name="client_id" id="client_id" value="<?php echo $client_id ?>">
                        <input type="hidden" name="sibilingId" id="sibilingId" value="<?php echo $sibling['sibilingId'] ?>">
                        <div id="repeaterContainer">
                            <!-- Initial set of fields -->
                            <div class="row repeater-group">
                                <div class="row">
                                    <div class="col p-2">
                                        <label class="form-label ">Name</label>
                                        <input class="form-control" type="text" name="childName" value="<?php echo $sibling['SibilingName'] ?>">
                                    </div>
                                    <div class="col p-2">
                                        <label class="form-label ">Relationship</label>
                                        <select name="childRelationship" class="form-control">
                                            <?php if ($sibling['SibilingType'] == "son"){ ?>
                                            <option value="son" selected>Son</option>
                                            <option value="daughter">Daughter</option>
                                            <option value="brother">Brother</option>
                                            <option value="sister">Sister</option>
                                            <?php }elseif ($sibling['SibilingType'] == "daughter"){ ?>
                                            <option value="son" >Son</option>
                                            <option value="daughter"selected>Daughter</option>
                                            <option value="brother">Brother</option>
                                            <option value="sister">Sister</option>
                                            <?php }elseif ($sibling['SibilingType'] == "brother"){ ?>
                                            <option value="son" >Son</option>
                                            <option value="daughter">Daughter</option>
                                            <option value="brother"selected>Brother</option>
                                            <option value="sister">Sister</option>
                                            <?php }elseif ($sibling['SibilingType'] == "sister"){ ?>
                                            <option value="son" >Son</option>
                                            <option value="daughter">Daughter</option>
                                            <option value="brother">Brother</option>
                                            <option value="sister" selected>Sister</option>
                                             <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col p-2">
                                        <label class="form-label ">Date of Birth</label>
                                        <input class="form-control" type="date" name="childDOB"
                                               value="<?php echo $sibling['SibilingDob']?>">
                                    </div>
<!--                                    <div class="col p-2">-->
<!--                                        <label class="form-label ">Age</label>-->
<!--                                        <input class="form-control" type="text" name="childAge" readonly>-->
<!--                                    </div>-->


                                </div>
                                <div class="row">
                                    <div class="col p-2">
                                        <label class="form-label ">School Attended</label>
                                        <select name="childSchoolAttended" class="form-control"
                                                onchange="toggleSchoolFields(this)">
                                            <?php if ($sibling['schoolAttended'] == "yes"){ ?>
                                            <option value="yes" selected>Yes</option>
                                            <option value="no">No</option>
                                            <?php } elseif ($sibling['schoolAttended'] == "no"){ ?>
                                            <option value="yes">Yes</option>
                                            <option value="no" selected>No</option>
                                              <?php } ?>
                                        </select>
                                    </div>
                                    <?php if ($sibling['schoolAttended'] == "yes"){ ?>
                                    <div class="col school-fields" >
                                        <div class="row">
                                            <div class="col p-2">
                                                <label class="form-label ">School Name</label>
                                                <input class="form-control" type="text"
                                                       name="childSchoolName"   value="<?php echo $sibling['schoolName']?>">
                                            </div>
                                            <div class="col p-2">
                                                <label class="form-label ">Grade</label>
                                                <input class="form-control" type="text" name="childGrade" value="<?php echo $sibling['schoolGrade']?>">

                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <div class="col p-2" id="nationalIdField">
                                        <label class="form-label ">National ID</label>
                                        <input class="form-control" type="text" name="childNIC" value="<?php echo $sibling['sibilingNic']?>">
                                    </div>
                                    <div class="col p-2" id="">
                                        <label for="sibilingnicfront" class="form-label ">Sibiling NIC
                                            Front</label>
                                        <input type="file" class="form-control" name="sibilingnicfront" id="">
                                    </div>
                                    <div class="col p-2" id="">
                                        <label for="sibilingnicback" class="form-label ">Sibiling NIC
                                            Back</label>
                                        <input type="file" class="form-control" name="sibilingnicback" id="">
                                    </div>

                                </div>



                            </div>
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<!-- Ensure Bootstrap's JavaScript is loaded correctly -->

<?php
    
}
?>
<script>
    function calculateAgespouce(){
        const inputField = document.getElementById("spouseDOB"); // Get the input element
        const value = inputField.value;
        alert(value);
        const birthDate = new Date(value); // Convert the birthday string to a Date object
        const today = new Date(); // Get today's date

        let age = today.getFullYear() - birthDate.getFullYear(); // Calculate the difference in years
        const monthDiff = today.getMonth() - birthDate.getMonth(); // Calculate the month difference

        // Adjust age if the birthday hasn't occurred yet this year
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        console.log(age)
        document.getElementById("spouseAge").value=age;
    }
</script>
<script>
    // Function to show or hide school fields based on "School Attended" selection
    function toggleSchoolFields(selectElement) {
        const schoolFields = selectElement.closest('.row').querySelector('.school-fields');
        if (selectElement.value === 'yes') {
            schoolFields.style.display = 'block';
        } else {
            schoolFields.style.display = 'none';
        }
    }

    // Example function to calculate age based on DOB (You need to implement it based on your requirements)
    function calculateAge2(dobInput) {
        const dob = new Date(dobInput.value);
        const today = new Date();
        const age = today.getFullYear() - dob.getFullYear();
        dobInput.closest('.row').querySelector('input[name="childAge[]"]').value = age;
    }
</script>