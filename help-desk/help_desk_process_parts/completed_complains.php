<table id="viewclints" class="table table-striped table-bordered mt-2" style="width:100%">
    <?php
    // Query to get clients whose contracts have started
    $sqlmedicalNew="SELECT  complains.*
                 FROM complains
               
                 WHERE complains.softdeletestatus = 1 AND complains.status='completed'";
    $sqlmedicalprocessing="SELECT  applications.*,complains.*
                 FROM applications
                 JOIN complains ON applications.applicationID = complains.complainant_id
                 WHERE complains.softdeletestatus = 1 AND complains.status='completed'";

    $resmedicalprocessing = mysqli_query($conn, $sqlmedicalNew);

    if ($resmedicalprocessing == true) {
        $count_rows = mysqli_num_rows($resmedicalprocessing);
        $num = 1;

        if ($count_rows > 0) { ?>
            <thead>
            <tr>
                <th>No</th>
                <th>Application ID</th>
                <th>Complain Type</th>
                <th>Complains</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($resmedicalprocessing)) {


                $applicantID = $row['complainant_id'];
                $complain_type=$row['type'];
                $message=$row['message'];
                $complain_id=$row['id'];





                ?>
                <tr>
                    <td><?php echo $num++; ?></td>
                    <td><?php echo $applicantID; ?></td>
                    <td><?php echo $complain_type; ?></td>
                    <td><?php echo $message; ?></td>
                    <td>


                        <a href="help_desk_process_parts/followup-view.php?complain_id=<?php echo $complain_id ; ?>" class="btn btn-success btn-sm lni lni-eye">
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
