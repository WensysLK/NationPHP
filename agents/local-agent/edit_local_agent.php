<?php include('../../includes/header.php'); 


?>
<?php
$localagentId = $_POST['applicationID'];


$query = "SELECT * FROM local_agent_details WHERE localagentId = ?";

$stmtSiblings = $conn->prepare($query);
$stmtSiblings->bind_param("i", $localagentId);
$stmtSiblings->execute();
$result = $stmtSiblings->get_result();
$guardian = $result->fetch_assoc();

$querynew = "SELECT * FROM attachemnts_data_id_back WHERE attachemnet_ClientID = ? ORDER BY createdAt DESC 
LIMIT 1";

$stmtImg = $conn->prepare($querynew);
$stmtImg->bind_param("i", $localagentId);
$stmtImg->execute();
$resultim = $stmtImg->get_result();
$imagesid_back = $resultim->fetch_assoc();


$querynewFront = "SELECT * FROM attachemnts_data_id_front WHERE attachemnet_ClientID = ? ORDER BY createdAt DESC 
LIMIT 1";

$stmtImgFront = $conn->prepare($querynewFront);
$stmtImgFront->bind_param("i", $localagentId);
$stmtImgFront->execute();
$resultimFront = $stmtImgFront->get_result();
$imagesid_front = $resultimFront->fetch_assoc();

$querynewLicense = "SELECT * FROM attachemnts_data_license WHERE attachemnet_ClientID = ? ORDER BY createdAt DESC 
LIMIT 1";
$stmtImgLicense = $conn->prepare($querynewLicense);
$stmtImgLicense->bind_param("i", $localagentId);
$stmtImgLicense->execute();
$resultimLicense = $stmtImgLicense->get_result();
$imagesidLicense = $resultimLicense->fetch_assoc();


$querynewIdbr = "SELECT * FROM attachemnts_data_idbr WHERE attachemnet_ClientID = ? ORDER BY createdAt DESC 
LIMIT 1";
$stmtImgIdbr = $conn->prepare($querynewIdbr);
$stmtImgIdbr->bind_param("i", $localagentId);
$stmtImgIdbr->execute();
$resultimIdbr = $stmtImgIdbr->get_result();
$imagesid_Idbr = $resultimIdbr->fetch_assoc();


$querynewAttacment = "SELECT * FROM attachemnts_data WHERE attachemnet_ClientID = ?";
$stmtImgAttachemnts = $conn->prepare($querynewAttacment);
$stmtImgAttachemnts->bind_param("i", $localagentId);
$stmtImgAttachemnts->execute();
$resultimAttachemnts = $stmtImgAttachemnts->get_result();
$imagesidAttachemnts = $resultimAttachemnts->fetch_assoc();


$query_company = "SELECT * FROM fagent_company_details WHERE fagentID = ?";

$stmtCompany = $conn->prepare($query_company);
$stmtCompany->bind_param("i", $localagentId);
$stmtCompany->execute();
$result_com = $stmtCompany->get_result();
$company = $result_com->fetch_assoc();


//var_dump($imagesid_front['attachFilename']);die();
// Fetch results

 ?>
<body>
    <?php include('../../includes/navigation-admin.php'); ?>
    <div class="content content-fixed bd-b">
        <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
            <div class="d-sm-flex align-items-center justify-content-between">
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-style1 mg-b-5">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item"><a href="#">Foreign Agent</a></li>
                        </ol>
                    </nav>
                    <h4 class="mg-b-0">View All</h4>
                </div>
                <div class="mg-t-20 mg-sm-t-0">
                </div>
            </div> 
            <div class="content">
                <form method="POST" action="form-parts-insert/local_agent_data_edit.php"
                    enctype="multipart/form-data">
                    <input type="hidden" name="agentId" class="form-control" id="agentId" value="<?php echo $guardian['localagentId']?>">

                    <div class="row">
                        <div class="col-3">
                            <div class="profile-image-container">
                                <img src="../../uploads/img/fallback-image.png" alt="Profile Image"
                                    name="fagentprofileimage" class="profile-image" id="profileImage">
                                <label for="profileImageInput" class="camera-icon">
                                    <img src="../../uploads/img/camera-icon.png" name="lagentprofileimage" alt="Camera Icon">
                                </label>
                                <input type="file" id="profileImageInput" name="lagentprofileimage" accept="image/*"
                                    class="profile-image-input">
                            </div>

                        </div>
                        <div class="col-9">
                            <div class="row">
                                <div class="col">
                                    <label for="AgentType" class="form-label">Agent Type</label><br>
                                    <?php if($guardian['localAgentType']=="Recruitment_Company") {?>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="agentType" type="radio" class="form-control"
                                            name="inlineRadioOptions" id="inlineRadio1" value="Recruitment_Company" checked>
                                        <label class="form-check-label" for="inlineRadio1">Recruitment Company</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input"name="agentType" type="radio" class="form-control"
                                            name="inlineRadioOptions" id="inlineRadio2" value="company">
                                        <label class="form-check-label" class="form-control"
                                            for="inlineRadio2">Company</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="agentType" type="radio" name="inlineRadioOptions"
                                            id="inlineRadio3" value="Individual">
                                        <label class="form-check-label" for="inlineRadio3">Individual</label>
                                    </div>
                                    <?php }elseif($guardian['localAgentType']==="company") {?>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="agentType" type="radio" class="form-control"
                                               name="inlineRadioOptions" id="inlineRadio1" value="Recruitment_Company" >
                                        <label class="form-check-label" for="inlineRadio1">Recruitment Company</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input"name="agentType" type="radio" class="form-control"
                                               name="inlineRadioOptions" id="inlineRadio2" value="company"checked>
                                        <label class="form-check-label" class="form-control"
                                               for="inlineRadio2">Company</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="agentType" type="radio" name="inlineRadioOptions"
                                               id="inlineRadio3" value="Individual">
                                        <label class="form-check-label" for="inlineRadio3">Individual</label>
                                    </div>
                                    <?php }elseif($guardian['localAgentType']==="Individual") {?>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="agentType" type="radio" class="form-control"
                                               name="inlineRadioOptions" id="inlineRadio1" value="Recruitment_Company" >
                                        <label class="form-check-label" for="inlineRadio1">Recruitment Company</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input"name="agentType" type="radio" class="form-control"
                                               name="inlineRadioOptions" id="inlineRadio2" value="company">
                                        <label class="form-check-label" class="form-control"
                                               for="inlineRadio2">Company</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="agentType" type="radio" name="inlineRadioOptions"
                                               id="inlineRadio3" value="Individual" checked>
                                        <label class="form-check-label" for="inlineRadio3">Individual</label>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="row">
                                <h4 class="mt-2">Personal Details</h4>
                                <div class="col-1">
                                    <label for="ownertitile" class="form-label">Titile</label>
                                    <select name="name-title" class="form-control" id="exampleFormControlSelect1">
                                        <?php if($guardian['Local_Agent_Title']=="Dr") {?>
                                        <option Value="Dr" selected>Dr</option>
                                        <option Value="Mr">Mr</option>
                                        <option Value="Mrs">Mrs</option>
                                        <option Value="Ms">Ms</option>
                                        <?php } elseif($guardian['Local_Agent_Title']=="Mr") {?>
                                        <option Value="Dr">Dr</option>
                                        <option Value="Mr"selected>Mr</option>
                                        <option Value="Mrs">Mrs</option>
                                        <option Value="Ms">Ms</option>
                                        <?php } elseif($guardian['Local_Agent_Title']=="Mrs") {?>
                                        <option Value="Dr">Dr</option>
                                        <option Value="Mr">Mr</option>
                                        <option Value="Mrs"selected>Mrs</option>
                                        <option Value="Ms">Ms</option>
                                        <?php } elseif($guardian['Local_Agent_Title']=="Ms") {?>
                                        <option Value="Dr">Dr</option>
                                        <option Value="Mr">Mr</option>
                                        <option Value="Mrs">Mrs</option>
                                        <option Value="Ms"selected>Ms</option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label for="ownerFname" class="form-label">First Name</label>
                                    <input type="text" name="ownerFname" class="form-control" id="ownerFname" value="<?php echo $guardian['Local_Agent_Fname']?>">
                                </div>
                                <div class="col-3">
                                    <label for="ownerMname" class="form-label">Middle Name</label>
                                    <input type="text" name="ownerMname" class="form-control" id="ownerMname" value="<?php echo $guardian['Local_Agent_Mname']?>">
                                </div>
                                <div class="col-4">
                                    <label for="ownerLname" class="form-label">Last Name</label>
                                    <input type="text" name="ownerLname" class="form-control" id="ownerLname" value="<?php echo $guardian['Local_Agent_Lname']?>">
                                </div>

                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <label for="iqamaNumber" class="form-label">NIC No</label>
                                    <input type="text" name="nicNumber" class="form-control" id="iqamaNumber" value="<?php echo $guardian['Local_Agent_Nic']?>">
                                </div>
                                <div class="col">
                                    <label for="iqamaCopy" class="form-label">NIC Front</label>
                                    <img id="preview" src="<?php echo $baseUrl.'/uploads/agents/nicCopy/'. $imagesid_front['attachFilename'] ?>" alt="Profile Image" style="width: 100px;height: 100px"><br><br>

                                    <input type="file" name="nicCopy1" class="form-control" id="">
                                </div>
                                <div class="col">
                                    <label for="iqamaCopy" class="form-label">NIC Back</label>
                                    <img id="preview" src="<?php echo $baseUrl.'/uploads/agents/nicBack/'. $imagesid_back['attachFilename'] ?>" alt="Profile Image" style="width: 100px;height: 100px">
                                    <input type="file" name="nicCopy2" class="form-control" id="">
                                </div>
                                <div class="col">
                                    <label for="OwnerWhatzapp" class="form-label">Phone No</label>
                                    <input type="text" name="phoneNumber" class="form-control" id="ownerWhatzapp" value="<?php echo $guardian['Local_Agent_Phone']?>">
                                </div>
                                <div class="col">
                                    <label for="ownerEmail" class="form-label">Email</label>
                                    <input type="text" name="ownerEmail" class="form-control" id="ownerEmail"value="<?php echo $guardian['Local_Agent_Email']?>">
                                </div>

                            </div>
                            <div class="row mt-2">
                                <div class="col  ">
                                    <label for="Address">Address</label>
                                    <input type="text" class="form-control" id="" placeholder="1234 Main St"
                                           name="agentPAddress" value="<?php echo $guardian['Local_Agent_address_1']?>">
                                </div>
                                <div class="col  ">
                                    <label for="Address2">Address 2</label>
                                    <input type="text" class="form-control" id="" placeholder="Apartment, studio, or floor"
                                           name="agentPAddress2"  value="<?php echo $guardian['Local_Agent_address_2']?>">
                                </div>
                                <div class="col">
                                    <label for="City">City</label>
                                    <input type="text" class="form-control" id="" name="agentPCity" value="<?php echo $guardian['local_agent_city']?>">
                                </div>
                                <div class="col">
                                    <label for="Province">Province / State</label>
                                    <input type="text" class="form-control" id="" name="agentPprovince"  value="<?php echo $guardian['local_agent_province']?>">
                                </div>

                            </div>

                        </div>



                    </div>
                    <div class="row mt-2">
                        <h4>Company Details</h4>
                        <hr>
                        <div class="col">
                            <label for="companyname" class="form-lable">Company Name</label>
                            <input type="text" name="companyName" id="companyName" class="form-control"  value="<?php echo $company['fagentCompanyName']?>">
                        </div>
                        <div class="col-2">
                            <label for="companywebsit" class="form-lable">Website</label>
                            <input type="text" name="companyWebsite" id="companywebsite" class="form-control" value="<?php echo $company['fagnetComWebsite']?>">
                        </div>

                    </div>
                    <div class="row mt-2">

                        <div class="col">
                            <label for="Passport" class="form-lable">ID No / BR</label>
                            <input type="text" class="form-control" placeholder="NIC No" name="companyBr" id="subageNic" value="<?php echo $company['fagentComID']?>"
                                required>
                        </div>
                        <div class="col">
                            <label for="attachBr" class="form-lable">Attach Copy</label>
                            <img id="preview" src="<?php echo $baseUrl.'/uploads/agents/brCopy/'. $imagesid_Idbr['attachFilename'] ?>" alt="Profile Image" style="width: 100px;height: 100px">
                            <input type="file" name="attachbBrcopy" class="form-control" id="attachbBrcopy">
                        </div>
                        <div class="col">
                            <label for="RecLicense" class="form-lable">Recruitment L No</label>
                            <input type="text" name="RecLicens" class="form-control" id="RecLicens" value="<?php echo $company['fagentRecruitmentID']?>">
                        </div>

                        <div class="col">
                            <label for="attachLicenseCopy" class="form-lable">Attach License</label>
                            <img id="preview" src="<?php echo $baseUrl.'/uploads/agents/licenseCopy/'. $imagesidLicense['attachFilename'] ?>" alt="Profile Image" style="width: 100px;height: 100px">

                            <input type="file" name="licenseCopy" class="form-control" id="licenseCopy">

                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col  ">
                            <label for="Address">Address</label>
                            <input type="text" class="form-control" id="" placeholder="1234 Main St"
                                name="fagentddress1" value="<?php echo $company['AddressLine1']?>">
                        </div>
                        <div class="col  ">
                            <label for="Address2">Address 2</label>
                            <input type="text" class="form-control" id="" placeholder="Apartment, studio, or floor"
                                name="fagentaddress2" value="<?php echo $company['AddressLine2']?>">
                        </div>
                        <div class="col">
                            <label for="City">City</label>
                            <input type="text" class="form-control" id="" name="fagentcity" value="<?php echo $company['companyCity']?>">
                        </div>
                        <div class="col">
                            <label for="Province">Province / State</label>
                            <input type="text" class="form-control" id="" name="fagentprovince" value="<?php echo $company['companyProvinceState']?>">
                        </div>

                    </div>
                    <div class="row mt-2">
                        <div class="col  ">
                            <label for="Status">Status</label>
                        <select class="form-select" aria-label="Default select example" id="" name="status">
                          <?php if ($guardian['regStatus'] == "pending"){ ?>
                            <option value="pending" selected>Pending</option>
                            <option value="completed">Completed</option>
                            <?php }elseif($guardian['regStatus'] == "completed"){ ?>
                            <option value="pending" >Pending</option>
                            <option value="completed" selected>Completed</option>
                            <?php } ?>

                        </select>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-2">
                        <h4>Incharge Details</h4>
                        <hr>
                        <div class="col">
                            <label for="inchargeName" class="form-label">Contact Person</label>
                            <input type="text" name="inchargeName" class="form-control" id="inchargeName" value="<?php echo $company['personIncharge']?>">
                        </div>
                        <div class="col">
                            <label for="incharPhone" class="form-label">Phone Number</label>
                            <input type="text" name="inchargePhone" class="form-control" id="inchargePhone" value="<?php echo $company['pi_contact_number']?>">
                        </div>
                        <div class="col">
                            <label for="incharemail" class="form-label">Email</label>
                            <input type="text" name="inchargeEmail" class="form-control" id="inchargeEmail" value="<?php echo $company['pi_email_address']?>">
                        </div>
                        <div class="col">
                            <label for="incharDesignation" class="form-label">Designation</label>
                            <input type="text" name="inchargedesignation" class="form-control" id="inchargedesignation" value="<?php echo $company['pi_designation']?>">
                        </div>

                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <label for="formFile" class="form-label">Remark</label>
                            <textarea name="fAgentRemark" id="" class="form-control" cols="80" rows="4"><?php echo $guardian['Local_Agent_Remark']?></textarea>
                        </div>
                        <div class="col">
                            <label for="mapEmbedCode" class="form-label">Google Maps Embed Code:</label>
                            <textarea id="mapEmbedCode" name="mapEmbedCode" class="form-control" rows="4"
                                cols="50"><?php echo $guardian['Local_Agent_Map']?></textarea>
                        </div>
                    </div>
                    <!-- Repeater Section -->
                    <div class="row mt-3">
                        <div class="col">

                        <h4>Document Attachments</h4>
<!--                            --><?php // for ($i = 0; $i < count($imagesidAttachemnts); $i++) { ?>

                                <a href="<?php echo $baseUrl.'/uploads/agents/'. $imagesidAttachemnts['attachFilename'] ?>"><?php echo $imagesidAttachemnts['attachFilename']?></a>

<!--                            --><?php //} ?>
                        <table class="table" id="documentTable">
                            <thead>
                                <tr>
                                    <th>Document Name</th>
                                    <th>Document Attachment</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="documentTableBody">
                                <!-- Document rows will be appended here dynamically -->
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-success" style="width: auto;display: inline-block;" id="addDocumentRow">Add Document</button>
                        </div>
                    </div>
                    <button type="submit" name="submit" id="subagentcreate" class="btn btn-primary mt-2">Update</button>
                </form>
            </div>
        </div>
        <!--Popup form for Precheck Registration -->

        <!-- End popup -->

        <?php include('../../includes/footer.php'); ?>
</body>

</html>

<!-- JavaScript to handle repeater fields -->
<script>
    document.getElementById('addDocumentRow').addEventListener('click', function() {
        // Create a new row
        const tableBody = document.getElementById('documentTableBody');
        const newRow = document.createElement('tr');

        newRow.innerHTML = `
            <td><input type="text" name="documentName[]" class="form-control" required></td>
            <td><input type="file" name="documentAttachment[]" class="form-control" required></td>
            <td>
                <button type="button" class="btn btn-warning editDocumentRow">Edit</button>
                <button type="button" class="btn btn-danger deleteDocumentRow">Delete</button>
            </td>
        `;
        
        tableBody.appendChild(newRow);
    });

    // Event delegation for edit and delete buttons
    document.getElementById('documentTableBody').addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('deleteDocumentRow')) {
            // Delete the row
            e.target.closest('tr').remove();
        } else if (e.target && e.target.classList.contains('editDocumentRow')) {
            // Edit functionality: enable input fields for editing
            const row = e.target.closest('tr');
            const nameField = row.querySelector('input[name="documentName[]"]');
            const fileField = row.querySelector('input[name="documentAttachment[]"]');
            nameField.disabled = !nameField.disabled;
            fileField.disabled = !fileField.disabled;
        }
    });
</script>