<table id="viewclints" class="table table-striped table-bordered mt-2" style="width:100%">
    <?php
    // Query to get clients whose contracts have started
    $sqlmedicalprocessing = "
    SELECT 
        md.*,  -- Select all columns from the medical_details table
        a.applicantTitle, 
        a.applicatFname, 
        a.applicantLname, 
        a.applicantPassno,
        a.applicantDob,
        a.profile_image, 
        mc.MediName, 
        cd.contractId
    FROM 
        medical_details md
    JOIN 
        applications a ON md.MedicalAppId = a.applicationID
    JOIN 
        medical_center mc ON md.MedicalCenter = mc.medicalCenterID
    JOIN 
        contract_details cd ON md.MedicalContractId = cd.contractId
    WHERE 
        md.medicalStatus = 'pending' AND md.softdeletestatus=1
    ";

    $resmedicalprocessing = mysqli_query($conn, $sqlmedicalprocessing);

    if ($resmedicalprocessing == true) {
        $count_rows = mysqli_num_rows($resmedicalprocessing);
        $num = 1;

        if ($count_rows > 0) { ?>
    <thead>
        <tr>
            <th>No</th>
            <th>Contract Number</th>
            <th>Name</th>
            <th>Passport</th>
            <th>Medical Center</th>
            <th>Allocation Date</th>
            <th>Expiry (Allocation)</th>
            <th>Gcc Date</th>
            <th>Expiry (GCC)</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
            while ($row = mysqli_fetch_assoc($resmedicalprocessing)) {
                $contractId = $row['contractId']; // Contract ID
                $applicantID = $row['MedicalAppId'];
                $applicationTitle = $row['applicantTitle'];
                $applicantDob = $row['applicantDob'];
                $applicationFname = $row['applicatFname'];
                $applicationLname = $row['applicantLname'];
                $applicationPassport = $row['applicantPassno'];
                $allocationDate = new DateTime($row['allocationDate']);
                $gccDate = new DateTime($row['gccDate']);
                $medicalCenter = $row['MediName'];
                $profilePic = $row['profile_image'];
                $medicalId = $row['medicalId'];
                // Format the dates to a string (for example, in 'Y-m-d' format)
                $formattedAllocationDate = $allocationDate->format('Y-m-d');
                $formattedGccDate = $gccDate->format('Y-m-d');
                
                // Calculate 21-day expiry for allocationDate
                $allocationExpiryDate = clone $allocationDate;
                $allocationExpiryDate->modify('+21 days');
                $allocationExpiryDateFormatted = $allocationExpiryDate->format('Y-m-d');  // Store in a variable

                // Calculate 21-day expiry for gccDate
                $gccExpiryDate = clone $gccDate;
                $gccExpiryDate->modify('+21 days');
                $gccExpiryDateFormatted = $gccExpiryDate->format('Y-m-d');  // Store in a variable
                
                ?>
        <tr>
            <td><?php echo $num++; ?></td>
            <td><?php echo $contractId; ?></td> <!-- Display Contract ID -->
            <td>
                <div class="d-flex align-items-center">
                    <img class="rounded-circle" style="width: 40px; height: 40px;"
                        src="../../uploads/img/fallback-image.png" alt="Fallback Image" />
                    <div class="ms-2">
                        <?php echo $applicationTitle . " " . $applicationFname . " " . $applicationLname; ?>
                    </div>
                </div>
            </td>
            <td><?php echo $applicationPassport; ?></td>
            <td><?php echo $medicalCenter; ?></td>
            <td><?php echo $allocationDate->format('Y-m-d'); ?></td>
            <td><?php echo $allocationExpiryDateFormatted; ?></td>
            <td><?php echo $gccDate->format('Y-m-d'); ?></td>
            <td><?php echo $gccExpiryDateFormatted; ?></td>
            <td>
                <a href="#medicalpaymentNewOne" class="btn btn-primary btn-sm lni "
                    data-bs-toggle="modal"
                    data-animation="effect-slide-in-bottom" 
                    data-applicant-id="<?php echo $applicantID; ?>"
                    data-contract-id="<?php echo $contractId; ?>" 
                    data-name-title="<?php echo $applicationTitle; ?>"
                    data-app-fname="<?php echo $applicationFname; ?>" 
                    data-app-lname="<?php echo $applicationLname; ?>"
                    data-dob="<?php echo $applicantDob; ?>" 
                    data-passport="<?php echo $applicationPassport; ?>"
                    data-image="<?php echo $profilePic; ?>" 
                    data-medical-id="<?php echo $medicalId; ?>"
                    data-medical-center="<?php echo $medicalCenter; ?>"
                    data-allocation-date="<?php echo $formattedAllocationDate; ?>" 
                    data-gcc-date="<?php echo $formattedGccDate; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-file-plus">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="12" y1="18" x2="12" y2="12"></line>
                        <line x1="9" y1="15" x2="15" y2="15"></line>
                    </svg>
                </a>

            </td>
        </tr>
        <?php } ?>
    </tbody>
    <?php 
        } else {
            echo "<div class='alert alert-primary mt-2' role='alert'> No Pending Medical Payements</div>";
        }
    } ?>
</table>

<div class="modal fade" id="medicalpaymentNewOne" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content tx-14">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel4">Book Medicals</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="functions/add-medical-payment.php" method="POST"
                      enctype="multipart/form-data">
                    <input type="hidden" name="appId" value="<?php echo $applicantID  ?>" id="appId">
                    <input type="hidden" name="contractId" value="<?php echo $contractId  ?>" id="contractId">
                    <input type="hidden" name="medcialId" value="<?php echo $medicalId  ?>" id="medicalId">
                    <div class="row">
                        <div class="col-4">
                            <img src="../../uploads/img/fallback-image.png" class="img-fluid" alt="Responsive image">

                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col">
                                    <label for="clientname" class="form-label">Clinet Name</label>
                                    <input type="text" name="clinetName" class="form-control" id="clientmedicalfname"
                                           readonly value="<?php echo $applicationTitle  ?><?php echo $applicationFname  ?><?php echo $applicationLname  ?>">

                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <label for="passport" class="form-label">Passport No</label>
                                    <input type="text" name="passportnumbermedi" class="form-control" id="passportnumbermedi"
                                           readonly value="<?php echo $applicationPassport  ?>">
                                </div>
                                <div class="col">
                                    <label for="medidob" class="form-label">Date of Birth</label>
                                    <input type="text" name="medidob" class="form-control" id="medidob" value="<?php echo $applicantDob ?>"
                                           readonly>
                                </div>

                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <label for="allocationdate">Allocation Date:</label>
                                    <input type="date" name="allocationdate" class="form-control" id="" readonly value="<?php echo $formattedAllocationDate ?>">
                                </div>
                                <div class="col">
                                    <label for="gccdate">Gcc Date:</label>
                                    <input type="date" name="gccDate" class="form-control" id="" readonly value="<?php echo $formattedGccDate ?>">

                                </div>
                            </div>

                            <label for="contractType" class="mt-2">Medical Center</label>
                            <input type="text" name="medicalCenter" class="form-control" id="medicalCenter" value="<?php echo $medicalCenter ?>">



                            <div class="row mt-2">
                                <div class="col">
                                    <label for="allocationdate">Payment Date:</label>
                                    <input type="date" name="paymentDate" class="form-control" id="">
                                </div>
                                <div class="col">
                                    <label for="gccdate">Payment Method:</label>
                                    <input type="text" name="paymentTpe" class="form-control" id="">

                                </div>
                            </div>
                            <div class="col">
                                <label for="gccdate">Payment Amount</label>
                                <input type="text" name="paymentAmount" class="form-control" id="" value="">

                            </div>
                            <button type="submit" class="btn btn-primary mt-2" name="submit">Book Enjaz</button>

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary tx-13" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
