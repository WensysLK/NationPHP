<style>
    #viewcompanyagent {
        white-space: nowrap;
        overflow-x: auto; /* Horizontal scroll if content overflows */
        table-layout: auto;
    }
</style>

<table id="viewcompanyagent" class="table table-striped table-bordered mt-2" style="width:100%">
    <?php
        $sqljoborder = "SELECT 
    jo.JobOrderId,
    a.fagentProfile,
    a.fagentTitle,
    a.fagentFname,
    a.fagentLname,
    jo.VisaQty,
    IFNULL(SUM(e.positionQty), 0) AS TotalPositionsQty,  -- Sum of positions from the enjaz table
    (jo.VisaQty - IFNULL(SUM(e.positionQty), 0)) AS AvailableVisaQty  -- Calculate available visas
FROM 
    job_orders jo
INNER JOIN 
    foreign_agent_details a ON jo.AgentID = a.fagentId
LEFT JOIN 
    enjaz_details e ON jo.JobOrderId = e.jobOrderId  -- Join the enjaz table
GROUP BY 
    jo.JobOrderId, a.fagentProfile, a.fagentTitle, a.fagentFname, a.fagentLname, jo.VisaQty
HAVING 
    (jo.VisaQty - IFNULL(SUM(e.positionQty), 0)) > 0  -- Only show job orders with available visas
ORDER BY 
    jo.JobOrderId;";

        $resjoborder = mysqli_query($conn,$sqljoborder);

        if($resjoborder == true) {
            $count_rows = mysqli_num_rows($resjoborder);
            $num = 1;

            if($count_rows > 0) { ?>
    <thead>
        <tr>
            <th>No</th>
            <th>Agent Name</th>
            <th>Job Order</th>
            <th>Total Visa</th>
            <th>Available Visa</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        // Loop through the results and only display rows where available visa quantity is greater than 0
        while($row = mysqli_fetch_assoc($resjoborder)) {
            $availablevisa = $row['AvailableVisaQty'];

            // Check if available visa quantity is greater than 0
            if ($availablevisa > 0) {
                $agenttitle = $row['fagentTitle'];
                $agentFname = $row['fagentFname'];
                $agentLname = $row['fagentLname'];
                $agentprofile = $row['fagentProfile'];
                $jobOrdernumber = $row['JobOrderId'];
                $totalvisa = $row['VisaQty'];
                
                ?>
        <tr>
            <td><?php echo $num++; ?></td>
            <td>
                <div class="d-flex align-items-center">
                    <img class="rounded-circle" style="width: 40px; height: 40px;"
                        src="../uploads/img/fallback-image.png" alt="Fallback Image" />
                    <div class="ms-2">
                        <?php echo $agenttitle . " " . $agentFname . " " . $agentLname; ?>
                    </div>
                </div>
            </td>
            <td><?php echo $jobOrdernumber; ?></td>
            <td><?php echo $totalvisa; ?></td>
            <td><?php echo $availablevisa; ?></td>
            <td>
                <form action="job-order-updates/edit_job_order.php" style="display: inline-block;" method="POST">
                    <input type="hidden" name="applicationID" value="<?php echo $jobOrdernumber; ?>">
                    <button type="submit" class="btn btn-primary btn-sm lni lni-pencil">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-edit-2">
                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                        </svg>
                    </button>
                </form>
                <a href="#" class="btn btn-success btn-sm lni lni-eye">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-eye">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                </a>
                <button href="#" class="btn btn-danger btn-sm lni lni-trash">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </td>
        </tr>
        <?php 
            } // end of available visa check
        } ?>
    </tbody>
    <?php } else {
                echo "<div class='alert alert-primary mt-2' role='alert'> No Registered Agencies!</div>";
            }
        } ?>
</table>

<script>
$('.btn-warning').tooltip({
    template: '<div class="tooltip tooltip-primary" role="tooltip"> <div class="arrow"></div> <div class="tooltip-inner"></div></div>'
})
</script>
