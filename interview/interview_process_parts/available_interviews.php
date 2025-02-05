<table id="viewclints" class="table table-striped table-bordered mt-2" style="width:100%">
    <?php

    $sqlmedical="SELECT contract_details.*, 
                          applications.*
                   FROM contract_details
                   JOIN applications ON contract_details.applicationID = applications.applicationID
                   WHERE contract_details.ContractStartus = 'started' 
                     AND contract_details.softdeletestatus = 1 AND contract_details.interviewStatus='not_started';";
    // Query to get clients whose contracts have started
    $sqlmedicalq = "SELECT contract_details.contractId, contract_details.ContractStartus, 
                          applications.applicationID,applications.applicantDob,applications.applicantTitle, applications.applicatFname, 
                          applications.applicantLname, applications.applicantPassno,applications.profile_image
                   FROM contract_details
                   JOIN applications ON contract_details.applicationID = applications.applicationID
                   WHERE contract_details.ContractStartus = 'started' 
                     AND contract_details.softdeletestatus = 1 AND contract_details.interviewStatus='not_started'";

    $resmedical = mysqli_query($conn, $sqlmedical);
    //    $resmedicalNew = mysqli_query($conn, $newQuery);
    //    var_dump($resmedicalNew);

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
                $applicationMname = $row['applicantMname'];
                $applicationPassport = $row['applicantPassno'];
                $interviewStatus=$row['interviewStatus'];
                $medicalStatus=$row['medicalStatus'];
                $EnjazSatus=$row['EnjazSatus'];
                $MuzanedStatus=$row['MuzanedStatus'];
                $fprintStatus=$row['fprintStatus'];
                $BeauroStatus=$row['BeauroStatus'];
                $contractType=$row['contractType'];
                $profilepciture = $row['profile_image'];

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
                            <img class="rounded-circle" style="width: 40px; height: 40px;"
                                 src="<?php echo $imgSrc; ?>" alt="Fallback Image" />
                            <div class="ms-2">
                                <?php echo $applicationTitle . " " . $applicationFname . " " . $applicationLname; ?>
                            </div>
                        </div>
                    </td>
                    <td><?php echo $applicationPassport; ?></td>
                    <td>

                        <a href="client_interview.php?client_id=<?php echo $applicantID;?>" class="btn btn-primary btn-sm lni">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="feather feather-file-plus">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z">

                                </path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="12" y1="18" x2="12" y2="12"></line>
                                <line x1="9" y1="15" x2="15" y2="15"></line>
                            </svg>
                        </a>
                        <a href="application-profile.php?client_id=<?php echo $applicantID;?>" class="btn btn-success btn-sm lni lni-eye">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </a>
<!--                        <form id="registrationForm" method="post"  action="medical-process-data/delete_medical_data.php"style="display:inline;">-->
<!--                                   <form method="POST" action="Funtions/delete_license_precheck.php" style="display:inline;">-->
<!--                            <input type="hidden" name="contractId" value="--><?php //echo $contractId; ?><!--">                               <button type="submit" class="btn btn-danger btn-sm"-->
<!--                                                                                                                                             onclick="return confirm('Are you sure you want to delete this Contract?');">-->
<!--                                <i class="fas fa-trash-alt"></i>-->
<!--                            </button>-->
<!--                        </form>-->

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
