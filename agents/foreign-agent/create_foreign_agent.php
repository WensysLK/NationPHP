<?php include('../../includes/header.php'); 



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
                <form method="POST" action="form-parts-insert/foreign_agent_data_insert.php"
                    enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-3">
                            <div class="profile-image-container">
                                <img src="../../uploads/img/fallback-image.png" alt="Profile Image"
                                    name="fagentprofileimage" class="profile-image" id="profileImage">
                                <label for="profileImageInput" class="camera-icon">
                                    <img src="../../uploads/img/camera-icon.png" alt="Camera Icon">
                                </label>
                                <input type="file" id="profileImageInput" name="fagentprofileimage" accept="image/*"
                                    class="profile-image-input">
                            </div>

                        </div>
                        <div class="col-9">
                            <div class="row">
                                <div class="col">
                                    <label for="AgentType" class="form-label">Agent Type</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="agentType" type="radio" class="form-control"
                                            name="inlineRadioOptions" id="inlineRadio1" value="Recruitment_Company">
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
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="agentType" type="radio" name="inlineRadioOptions"
                                            id="inlineRadio4" value="coporatecompany">
                                        <label class="form-check-label" for="inlineRadio3">Coperate Company</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="agentType" type="radio" name="inlineRadioOptions"
                                            id="inlineRadio5" value="direct">
                                        <label class="form-check-label" for="inlineRadio3">Direct</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <h4 class="mt-2">Personal Details</h4>
                                <div class="col-1">
                                    <label for="ownertitile" class="form-label">Titile</label>
                                    <select name="name-title" class="form-control" id="exampleFormControlSelect1">
                                        <option selected Value="none">Non</option>
                                        <option Value="Dr">Dr</option>
                                        <option Value="Mr">Mr</option>
                                        <option Value="Mrs">Mrs</option>
                                        <option Value="Ms">Ms</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label for="ownerFname" class="form-label">First Name</label>
                                    <input type="text" name="ownerFname" class="form-control" id="ownerFname">
                                </div>
                                <div class="col-3">
                                    <label for="ownerMname" class="form-label">Middle Name</label>
                                    <input type="text" name="ownerMname" class="form-control" id="ownerMname">
                                </div>
                                <div class="col-4">
                                    <label for="ownerLname" class="form-label">Last Name</label>
                                    <input type="text" name="ownerLname" class="form-control" id="ownerLname">
                                </div>

                            </div>
                            <div class="row mt-2">
                                <div class="col  ">
                                    <label for="Address">Address</label>
                                    <input type="text" class="form-control" id="" placeholder="1234 Main St"
                                           name="fagentddress1">
                                </div>
                                <div class="col  ">
                                    <label for="Address2">Address 2</label>
                                    <input type="text" class="form-control" id="" placeholder="Apartment, studio, or floor"
                                           name="fagentaddress2">
                                </div>
                                <div class="col">
                                    <label for="City">City</label>
                                    <input type="text" class="form-control" id="" name="fagentcity">
                                </div>
                                <div class="col">
                                    <label for="Province">Province / State</label>
                                    <input type="text" class="form-control" id="" name="fagentprovince">
                                </div>

                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <label for="iqamaNumber" class="form-label">IQAMA No</label>
                                    <input type="text" name="iqamaNumber" class="form-control" id="iqamaNumber">
                                </div>
                                <div class="col">
                                    <label for="iqamaCopy" class="form-label">IQAMA Copy</label>
                                    <input type="file" name="iqamaNumber" class="form-control" id="iqamaCopy">
                                </div>
                                <div class="col">
                                    <label for="OwnerWhatzapp" class="form-label">Whatzapp No</label>
                                    <input type="text" name="ownerWhatzapp" class="form-control" id="ownerWhatzapp">
                                </div>
                                <div class="col">
                                    <label for="ownerEmail" class="form-label">Email</label>
                                    <input type="text" name="ownerEmail" class="form-control" id="ownerEmail">
                                </div>

                            </div>

                        </div>



                    </div>
                    <div class="row mt-2">
                        <h4>Company Details</h4>
                        <hr>
                        <div class="col">
                            <label for="companyname" class="form-lable">Company Name</label>
                            <input type="text" name="companyName" id="companyName" class="form-control">
                        </div>
                        <div class="col-2">
                            <label for="companywebsit" class="form-lable">Website</label>
                            <input type="text" name="companyWebsite" id="companywebsite" class="form-control">
                        </div>

                    </div>
                    <div class="row mt-2">

                        <div class="col">
                            <label for="Passport" class="form-lable">ID No / BR</label>
                            <input type="text" class="form-control" placeholder="NIC No" name="companyBr" id="subageNic"
                                required>
                        </div>
                        <div class="col">
                            <label for="attachBr" class="form-lable">Attach Copy</label>
                            <input type="file" name="attachbBrcopy" class="form-control" id="attachbBrcopy">
                        </div>
                        <div class="col">
                            <label for="RecLicense" class="form-lable">Recruitment L No</label>
                            <input type="text" name="RecLicens" class="form-control" id="RecLicens">
                        </div>

                        <div class="col">
                            <label for="attachLicenseCopy" class="form-lable">Attach License</label>
                            <input type="file" name="licenseCopy" class="form-control" id="licenseCopy">

                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col  ">
                            <label for="Address">Address</label>
                            <input type="text" class="form-control" id="" placeholder="1234 Main St"
                                name="fagentddress1">
                        </div>
                        <div class="col  ">
                            <label for="Address2">Address 2</label>
                            <input type="text" class="form-control" id="" placeholder="Apartment, studio, or floor"
                                name="fagentaddress2">
                        </div>
                        <div class="col">
                            <label for="City">City</label>
                            <input type="text" class="form-control" id="" name="fagentcity">
                        </div>
                        <div class="col">
                            <label for="Province">Province / State</label>
                            <input type="text" class="form-control" id="" name="fagentprovince">
                        </div>

                    </div>
                    <div class="row mt-2">
                        <div class="col  ">
                            <label for="Status">Status</label>
                            <select class="form-select" aria-label="Default select example" id="" name="status">
                                <option selected>Select Status</option>
                                <option value="pending">Pending</option>
                                <option value="completed">Completed</option>

                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-2">
                        <h4>Incharge Details</h4>
                        <hr>
                        <div class="col">
                            <label for="inchargeName" class="form-label">Contact Person</label>
                            <input type="text" name="inchargeName" class="form-control" id="inchargeName">
                        </div>
                        <div class="col">
                            <label for="incharPhone" class="form-label">Phone Number</label>
                            <input type="text" name="inchargePhone" class="form-control" id="inchargePhone">
                        </div>
                        <div class="col">
                            <label for="incharemail" class="form-label">Email</label>
                            <input type="text" name="inchargeEmail" class="form-control" id="inchargeEmail">
                        </div>
                        <div class="col">
                            <label for="incharDesignation" class="form-label">Designation</label>
                            <input type="text" name="inchargedesignation" class="form-control" id="inchargedesignation">
                        </div>

                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <label for="formFile" class="form-label">Remark</label>
                            <textarea name="fAgentRemark" id="" class="form-control" cols="80" rows="4"></textarea>
                        </div>
                        <div class="col">
                            <label for="mapEmbedCode" class="form-label">Google Maps Embed Code:</label>
                            <textarea id="mapEmbedCode" name="mapEmbedCode" class="form-control" rows="4"
                                cols="50"></textarea>
                        </div>
                    </div>
                    <!-- Repeater Section -->
                    <div class="row mt-3">
                        <div class="col">
                        <h4>Document Attachments</h4>
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
                    <button type="submit" name="submit" id="subagentcreate" class="btn btn-primary mt-2">Create</button>
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