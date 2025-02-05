<table id="medicalcomplete" class="table table-striped table-bordered mt-2" style="width:100%">
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
        md.medicalresult = 'unfit' AND md.softdeletestatus=1
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
            <th>Gcc Date</th>
            <th>Status<s/th>
            <th>Result</th>
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
                $medicalstatus=$row['medicalStatus'];
                $medicalresult=$row['medicalresult'];

                $profileImage = '../uploads/profile_images/'.$profilePic;
                $fallbackimage = '../uploads/img/fallback-image.png';
                $imgSrc = !empty($profileImage) ? $profileImage : $fallbackimage;
                ?>
        <tr>
            <td><?php echo $num++; ?></td>
            <td><?php echo $contractId; ?></td> <!-- Display Contract ID -->
            <td>
                <div class="d-flex align-items-center">
                    <img class="rounded-circle" style="width: 40px; height: 40px;"
                        src="<?php echo $imgSrc; ?>" alt="Fallback Image" />
                    <div class="ms-2">
                        <?php echo $applicationTitle . " " . $applicationFname . " " . $applicationLname; ?>
                    </div>
                </div>
            </td>
            <td><?php echo $applicationPassport; ?></td>
            <td><?php echo $medicalCenter; ?></td>
            <td><?php echo $allocationDate->format('Y-m-d'); ?></td>
            <td><?php echo $gccDate->format('Y-m-d'); ?></td>
            <td><?php echo $medicalstatus; ?></td>
            <td><?php echo $medicalresult; ?></td>
            <td>
<!--                <a href="#updatemedical" class="btn btn-primary btn-sm lni "-->
<!--                    data-bs-toggle="modal"-->
<!--                    data-animation="effect-slide-in-bottom" -->
<!--                    data-applicant-id="--><?php //echo $applicantID; ?><!--"-->
<!--                    data-contract-id="--><?php //echo $contractId; ?><!--" -->
<!--                    data-name-title="--><?php //echo $applicationTitle; ?><!--"-->
<!--                    data-app-fname="--><?php //echo $applicationFname; ?><!--" -->
<!--                    data-app-lname="--><?php //echo $applicationLname; ?><!--"-->
<!--                    data-dob="--><?php //echo $applicantDob; ?><!--" -->
<!--                    data-passport="--><?php //echo $applicationPassport; ?><!--"-->
<!--                    data-image="--><?php //echo $profilePic; ?><!--" -->
<!--                    data-medical-id="--><?php //echo $medicalId; ?><!--"-->
<!--                    data-medical-center="--><?php //echo $medicalcenter; ?><!--"-->
<!--                    data-allocation-date="--><?php //echo $formattedAllocationDate; ?><!--" -->
<!--                    data-gcc-date="--><?php //echo $formattedGccDate; ?><!--">-->
<!--                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"-->
<!--                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"-->
<!--                        class="feather feather-file-plus">-->
<!--                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>-->
<!--                        <polyline points="14 2 14 8 20 8"></polyline>-->
<!--                        <line x1="12" y1="18" x2="12" y2="12"></line>-->
<!--                        <line x1="9" y1="15" x2="15" y2="15"></line>-->
<!--                    </svg>-->
<!--                </a>-->
<!--                <a href="" class="btn btn-primary btn-sm lni ">-->
<!--                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"-->
<!--                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"-->
<!--                        class="feather feather-edit">-->
<!--                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>-->
<!--                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>-->
<!--                    </svg>-->
<!--                </a>-->
                <a href="application-profile.php?client_id=<?php echo $applicantID;?>" class="btn btn-success btn-sm lni lni-eye">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-eye">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                </a>
                <form id="registrationForm" method="post"  action="medical-process-data/delete_medical_data.php"style="display:inline;">
                    <!--        <form method="POST" action="Funtions/delete_license_precheck.php" style="display:inline;">-->
                    <input type="hidden" name="contractId" value="<?php echo $contractId; ?>">                               <button type="submit" class="btn btn-danger btn-sm"
                                                                                                                                     onclick="return confirm('Are you sure you want to delete this Contract?');">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </tbody>
    <?php 
        } else {
            echo "<div class='alert alert-primary mt-2' role='alert'> No Available Contracts for Medical!</div>";
        }
    } ?>
</table>