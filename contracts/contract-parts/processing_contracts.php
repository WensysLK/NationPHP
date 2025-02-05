<?php 
 function getBadge($status) {
    switch ($status) {
        case 'not_started':
            return ['badge bg-danger', 'Pending'];
        case 'processing':
            return ['badge bg-warning', 'Processing'];
        case 'finance':
                return ['badge bg-primary', 'Finance'];
        case 'completed':
            return ['badge bg-success', 'Completed'];
        default:
            return ['badge bg-light', 'Unknown'];
    }
}





?>

<table id="viewclintsprocesscontracts" class="table table-striped table-bordered mt-2" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Contract</th>
            <th>Passport</th>
            <th>Medical</th>
            <th>Enjaz</th>
            <th>Muzaned</th>
            <th>Fprint</th>
            <th>Beauro</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
                        $sqlapplication = "SELECT a.*, c.*
                        FROM applications a
                        LEFT JOIN contract_details c ON a.applicationID = c.applicationID
                        WHERE a.softdeletStatus = 1 AND a.ContractCreated = 1 AND a.applicantStatus='Completed'";

                        $resapplication = mysqli_query($conn,$sqlapplication);
                        
                        if($resapplication==true){
                            $count_rows = mysqli_num_rows($resapplication);
                            $num = 1;
                           
                            if($count_rows>0){
                                while($row=mysqli_fetch_assoc($resapplication)){
                                  $applicationID = $row['applicationID'];
                                  $applicationTitle = $row['applicantTitle'];
                                  $applicationFname = $row['applicatFname'];
                                  $applcationMname = $row['applicantMname'];
                                  $applicationLname = $row['applicantLname'];
                                  $applicationPassport = $row['applicantPassno'];
                                  $country = $row['country'];
                                  $contractType = $row['contractType'];
                                  $contractMedical = $row['medicalStatus'];
                                  $contractEnhjaz = $row['EnjazSatus'];
                                  $contractMuzaned = $row['MuzanedStatus'];
                                  $contractfprinnt = $row['fprintStatus'];
                                  $contractBeauro = $row['BeauroStatus'];
                                  $contractID = $row['contractId'];
                                  $profilepciture = $row['profile_image']; 
                              
                                  $profileImage = '../uploads/profile_images/'.$profilepciture;

                                  $fallbackimage = '../uploads/img/fallback-image.png';
 
                                  // Check if image path exists and is not empty
                                $imgSrc = !empty($profileImage) ? $profileImage : $fallbackimage;

                                //Badget Status 
                                // Function to get badge class and text based on status
                               

                                $medicalBadge = getBadge($contractMedical);
                                $enjazBadge = getBadge($contractEnhjaz);
                                $muzanedBadge = getBadge($contractMuzaned);
                                $fprintdBadge = getBadge($contractfprinnt);
                                $beauroBadge = getBadge($contractBeauro);
                                ?>
        <tr>
            <td><?php echo $num++; ?></td>
            <td>
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center">

                        <img class="rounded-circle" style="width: 40px; height: 40px;"
                            src="<?php echo $imgSrc; ?>" alt="Fallback Image" />

                        <div class="ms-2">
                            <?php echo $applicationTitle . "." . $applicationFname . " " . $applicationLname; ?>
                        </div>
                    </div>
                </div>
            </td>
            <td style="display: none"> <?php echo $applicationTitle . "." . $applicationFname . " " . $applicationLname; ?></td>
            <td style="display: none"><?php echo $country; ?></td>
            <td style="display: none"><?php echo $contractType; ?></td>
            <td><?php echo $contractID; ?></td>
            <td><?php echo $applicationPassport; ?></td>
            <td><span class="<?php echo $medicalBadge[0]; ?>"><?php echo $medicalBadge[1]; ?></span></td>
            <td><span class="<?php echo $enjazBadge[0]; ?>"><?php echo $enjazBadge[1]; ?></span></td>
            <td><span class="<?php echo $muzanedBadge[0]; ?>"><?php echo $muzanedBadge[1]; ?></td>
            <td><span class="<?php echo $fprintdBadge[0]; ?>"><?php echo $fprintdBadge[1]; ?></td>
            <td><span class="<?php echo $beauroBadge[0]; ?>"><?php echo $beauroBadge[1]; ?></span></td>
            <td>
                <button type="button" class="btn btn-primary buttonNew">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2">
                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                    </svg>
                </button>
                <form id="registrationForm" method="post"  action="contract-process/delete_contract.php"style="display:inline;">
                    <!--        <form method="POST" action="Funtions/delete_license_precheck.php" style="display:inline;">-->
                    <input type="hidden" name="contractID" value="<?php echo $contractID; ?>">
                    <input type="hidden" name="applicationId" value="<?php echo $applicationID; ?>">
                    <button type="submit" class="btn btn-danger btn-sm"
                                                                                                                                               onclick="return confirm('Are you sure you want to delete this Contract?');">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>

                <a href="application-profile.php?client_id=<?php echo $applicationID;?>" class="btn btn-success btn-sm lni lni-eye"><svg xmlns="http://www.w3.org/2000/svg"
                                                                                                                                                      width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"
                                                                                                                                                      stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg></a>


            </td>
        </tr>
        <?php } } }?>
        <!-- Add more rows as needed -->
    </tbody>
</table>

<?php include('popups/edit_contract_form.php'); ?>

