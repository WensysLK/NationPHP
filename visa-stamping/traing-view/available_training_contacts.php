<table id="viewclints" class="table table-striped table-bordered mt-2" style="width:100%">
    <?php
    // Query to get clients whose contracts have started
    $sqlmedical = "SELECT contract_details.contractId, contract_details.ContractStartus, 
                          applications.applicationID,applications.applicantDob,applications.applicantTitle, applications.applicatFname, 
                          applications.applicantLname, applications.applicantPassno,applications.profile_image,contract_details.visa_status
                   FROM contract_details
                   JOIN applications ON contract_details.applicationID = applications.applicationID
                   WHERE contract_details.ContractStartus = 'started' AND contract_details.medicalStatus = 'completed' AND contract_details.EnjazSatus = 'completed' AND contract_details.MuzanedStatus = 'completed'
                   AND contract_details.fprintStatus = 'completed' AND contract_details.BeauroStatus = 'completed'
                     AND contract_details.softdeletestatus = 1 ";

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
                $applicationPhoto = $row['profile_image'];
                $visaStatus=$row['visa_status'];
                              
                $profileImage = '../uploads/profile_images/'.$applicationPhoto;

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
                <?php if($visaStatus=="completed"){ ?>
<!--                <form action="functions/stamping_data_edit.php" style="display: inline-block;" method="POST">-->
                    <input type="hidden" name="contractId" value="<?php echo $contractId; ?>">
                    <button type="submit" class="btn btn-info btn-sm lni lni-pencil">
                    Visa Stamped
                    </button>
<!--                </form>-->
                    <?php }else{ ?>
                    <form action="functions/stamping_data_edit.php" style="display: inline-block;" method="POST">
                        <input type="hidden" name="contractId" value="<?php echo $contractId; ?>">
                        <button type="submit" class="btn btn-success btn-sm lni lni-pencil">
                            Visa Stamp
                        </button>
                    </form>
                    <?php } ?>

            </td>
        </tr>
        <?php } ?>
    </tbody>
    <?php 
        } else {
            echo "<div class='alert alert-primary mt-2' role='alert'> No Available Contracts for Trainings!</div>";
        }
    } ?>
</table>