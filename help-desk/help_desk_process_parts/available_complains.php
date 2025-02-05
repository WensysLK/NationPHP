<table id="viewclints" class="table table-striped table-bordered mt-2" style="width:100%">
    <?php

    $sqlmedical="SELECT  applications.*,complains.*
                 FROM applications
                 JOIN complains ON applications.applicationID = complains.complainant_id
                 WHERE complains.softdeletestatus = 1 AND complains.status='pending'";
           $sqlmedicalNew="SELECT  complains.*
                 FROM complains
               
                 WHERE complains.softdeletestatus = 1 AND complains.status='pending'";
    // Query to get clients whose contracts have started
    $sqlmedicalq = "SELECT contract_details.contractId, contract_details.ContractStartus, 
                          applications.applicationID,applications.applicantDob,applications.applicantTitle, applications.applicatFname, 
                          applications.applicantLname, applications.applicantPassno,applications.profile_image
                   FROM contract_details
                   JOIN applications ON contract_details.applicationID = applications.applicationID
                   WHERE contract_details.ContractStartus = 'started' 
                     AND contract_details.softdeletestatus = 1 AND contract_details.medicalStatus='not_started'";

    $resmedical = mysqli_query($conn, $sqlmedicalNew);
//    $resmedicalNew = mysqli_query($conn, $newQuery);
//    var_dump($resmedicalNew);

    if ($resmedical == true) {
        $count_rows = mysqli_num_rows($resmedical);
        $num = 1;

        if ($count_rows > 0) { ?>
    <thead>
        <tr>
            <th>No</th>
            <th>Application ID</th>
<!--            <th>Passport Number</th>-->
<!--            <th>NIC Number</th>-->
<!--            <th>Name</th>-->
            <th>Complain Type</th>
            <th>Complains</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
            while ($row = mysqli_fetch_assoc($resmedical)) {


                $applicantID = $row['complainant_id'];
//                $applicationTitle = $row['applicantTitle'];
//                $applicationFname = $row['applicatFname'];
//                $applicationLname = $row['applicantLname'];
//                $applicationMname = $row['applicantMname'];
//                $applicationPassport = $row['applicantPassno'];
//                $applicationNic = $row['applicantNICno'];
                $complain_type=$row['type'];
                $message=$row['message'];
                $complain_id=$row['id']

                

                               
                
                ?>
        <tr>
            <td><?php echo $num++; ?></td>
            <td><?php echo $applicantID; ?></td>

            <td><?php echo $complain_type; ?></td>
            <td><?php echo $message; ?></td>
            <td>
                <a href="help_desk_process_parts/followup.php?complain_id=<?php echo $complain_id ; ?>">
                    <button class="btn btn-sm btn-info">Follow Up</button>
                </a>
<!--                <a href="processing-complains.php?complain_id=--><?php //echo $complain_id;?><!--" class="btn btn-primary btn-sm lni "-->
<!---->
<!---->
<!---->
<!--                    data-animation="effect-slide-in-bottom">-->
<!--                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"-->
<!--                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"-->
<!--                        class="feather feather-file-plus">-->
<!--                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z">-->
<!---->
<!--                        </path>-->
<!--                        <polyline points="14 2 14 8 20 8"></polyline>-->
<!--                        <line x1="12" y1="18" x2="12" y2="12"></line>-->
<!--                        <line x1="9" y1="15" x2="15" y2="15"></line>-->
<!--                    </svg>-->
<!--                </a>-->

                <a href="processing-complains_view.php?complain_id=<?php echo $complain_id;?>" class="btn btn-success btn-sm lni lni-eye">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                </a>


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
