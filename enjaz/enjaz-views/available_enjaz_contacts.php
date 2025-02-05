<table id="viewclints" class="table table-striped table-bordered mt-2" style="width:100%">
    <?php
    // Query to get clients whose contracts have started
    $sqlmedical = "SELECT contract_details.contractId, contract_details.ContractStartus, 
                          applications.applicationID,applications.applicantDob,applications.applicantTitle, applications.applicatFname, 
                          applications.applicantLname, applications.applicantPassno,applications.profile_image,applications.applicantNICno
                   FROM contract_details
                   JOIN applications ON contract_details.applicationID = applications.applicationID
                   WHERE contract_details.ContractStartus = 'started' AND contract_details.hasEnjaze=1
                     AND contract_details.softdeletestatus = 1 AND contract_details.EnjazSatus='not_started'";

    $resmedical = mysqli_query($conn, $sqlmedical);

    if ($resmedical == true) {
        $count_rows = mysqli_num_rows($resmedical);
        $num = 1;

        if ($count_rows > 0) { ?>
    <thead>
        <tr>
            <th>No</th>
            <th>Contract Number</th>
            <th>Name</th>
            <th>Passport</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
            while ($row = mysqli_fetch_assoc($resmedical)) {
                $contractId = $row['contractId']; // Contract ID
                $applicantID = $row['applicationID'];
                $applicantDob = $row['applicantDob'];
                $applicationTitle = $row['applicantTitle'];
                $applicationFname = $row['applicatFname'];
                $applicationLname = $row['applicantLname'];
                $applicationPassport = $row['applicantPassno'];
                $profilepciture = $row['profile_image'];
                $applicationNic = $row['applicantNICno'];
                
                $profileImage = '../uploads/profile_images/'.$profilepciture;
                $fallbackimage = '../uploads/img/fallback-image.png';

                                 // Check if image path exists and is not empty
                $imgSrc = !empty($profileImage) ? $profileImage : $fallbackimage;
                               
                
                ?>
        <tr>
            <td><?php echo $num++; ?></td>
            <td><?php echo $contractId; ?></td> <!-- Display Contract ID -->
            <td>
                <div class="d-flex align-items-center">
                    <img class="rounded-circle" style="width: 40px; height: 40px;" src="<?php echo $imgSrc; ?>"
                        alt="Fallback Image" />
                    <div class="ms-2">
                        <?php echo $applicationTitle . " " . $applicationFname . " " . $applicationLname; ?>
                    </div>
                </div>
            </td>
            <td><?php echo $applicationPassport; ?></td>
            <td>
                <a href="#modal6" class="btn btn-primary btn-sm lni" data-applicant-id="<?php echo $applicantID; ?>"
                    data-applicant-title="<?php echo $applicationTitle; ?>" data-image="<?php echo $profilepciture; ?>"
                    data-applicant-fname="<?php echo $applicationFname; ?>"
                    data-applicant-lname="<?php echo $applicationLname; ?>"
                    data-passport-number="<?php echo $applicationPassport; ?>"
                    data-contract-id="<?php echo $contractId; ?>" data-dob="<?php echo $applicantDob; ?>"
                    data-nic="<?php echo $applicationNic; ?>" data-bs-toggle="modal"
                    data-animation="effect-slide-in-bottom">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-file-plus">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="12" y1="18" x2="12" y2="12"></line>
                        <line x1="9" y1="15" x2="15" y2="15"></line>
                    </svg>
                </a>
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
                <form id="registrationForm" method="post"  action="functions/delete_medical_data.php"style="display:inline;">
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
            echo "<div class='alert alert-primary mt-2' role='alert'> No Available Contracts!</div>";
        }
    } ?>
</table>

<?php 
//popups add new enjaz
include('popups/add_enjaz.php');

?>