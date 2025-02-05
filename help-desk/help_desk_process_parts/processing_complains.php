<table id="viewclints" class="table table-striped table-bordered mt-2" style="width:100%">
    <?php
    // Query to get clients whose contracts have started
    $sqlmedicalNew="SELECT  complains.*
                 FROM complains
               
                 WHERE complains.softdeletestatus = 1 AND complains.status='processing'";
    $sqlmedicalprocessing="SELECT  applications.*,complains.*
                 FROM applications
                 JOIN complains ON applications.applicationID = complains.complainant_id
                 WHERE complains.softdeletestatus = 1 AND complains.status='processing'";


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
                        <br>
                        <a href="functions/status-update.php?complain_id=<?php echo $complain_id ; ?>">
                            <button class="btn btn-sm btn-warning">Completed</button>
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
