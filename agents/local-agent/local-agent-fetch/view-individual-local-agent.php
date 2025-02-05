<style>
    #viewindividual {
    white-space: nowrap;
    overflow-x: auto; /* Horizontal scroll if content overflows */
    table-layout: auto;
}
</style>
<table id="viewindividual" class="table table-striped table-bordered mt-2" style="width:100%">
    <?php
        $sqlapplication = "
        SELECT `localagentId`,`localAgentType`, `localagnetProfile`, `Local_Agent_Title`, `Local_Agent_Fname`, `Local_Agent_Mname`, `Local_Agent_Lname`, `Local_Agent_Nic`, `Local_Agent_Phone`, `Local_Agent_Email`, `Local_Agent_Remark`, `Local_Agent_Map` FROM `local_agent_details` WHERE `softdeletestatus`=1 AND `localAgentType`='Individual'
    ";

        $resapplication = mysqli_query($conn,$sqlapplication);

        if($resapplication == true) {
            $count_rows = mysqli_num_rows($resapplication);
            $num = 1;

            if($count_rows > 0) { ?>
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th style="width:auto;">IQAMA No</th>
            <th style="width:auto;">Contacts</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = mysqli_fetch_assoc($resapplication)) {
                        $agentId = $row['localagentId'];
                        $agenttitle = $row['Local_Agent_Title'];
                        $agentFname = $row['Local_Agent_Fname'];
                        $agentMname = $row['Local_Agent_Mname'];
                        $agentLname = $row['Local_Agent_Lname'];
                        $agentType = $row['localAgentType'];
                        $agentprofile = $row['localagnetProfile'];
                        $agentwhatzapp = $row['Local_Agent_Phone'];
                        $agentemail = $row['Local_Agent_Email'];
                        $agentIqama = $row['Local_Agent_Nic'];
                        
                        
                    ?>
        <tr>
            <td><?php echo $num++; ?></td>
            <td>
                <div class="d-flex align-items-center">
                    <img class="rounded-circle" style="width: 40px; height: 40px;"
                        src="../../uploads/img/fallback-image.png" alt="Fallback Image" />
                    <div class="ms-2">
                        <?php echo $agenttitle . " " . $agentFname . " " . $agentLname; ?>
                    </div>

                </div>
            </td>
            <td><?php echo $agentIqama; ?></td>
            <td>

                
                <a href="#" class="btn btn-info btn-sm lni lni-eye" data-bs-placement="top" title="<?php echo $agentemail;  ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-at-sign">
                        <circle cx="12" cy="12" r="4"></circle>
                        <path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path>
                    </svg>
                </a>
                <a href="#" class="btn btn-success btn-sm lni lni-eye" data-bs-placement="top" title="<?php echo $agentwhatzapp;  ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-circle"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                </a>
            </td>
            <td>
                <form action="../local-agent/edit_local_agent.php" style="display: inline-block;" method="POST">
                    <input type="hidden" name="applicationID" value="<?php echo $agentId; ?>">
                    <button type="submit" class="btn btn-primary btn-sm lni lni-pencil">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-edit-2">
                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                        </svg>
                    </button>
                </form>
                <form action="../local-agent/view_local_agent.php" style="display: inline-block;" method="POST">
                    <input type="hidden" name="applicationID" value="<?php echo $agentId; ?>">
                    <button type="submit" class="btn btn-primary btn-sm lni lni-pencil">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-eye">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                    </button>
                </form>
                <form method="POST" action="../local-agent/form-parts-insert/delete_agent_data.php" style="display:inline;">
                    <input type="hidden" name="applicationID" value="<?php echo $agentId; ?>">
                    <!--                    <input type="hidden" name="clientId" value="--><?php //echo $row['complainant_id']; ?><!--">-->
                    <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure?');">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>

            </td>
        </tr>
        <?php } ?>
    </tbody>
    <?php } else {
                echo "<div class='alert alert-primary mt-2' role='alert'> No Registere Agencies!</div>";
            }
        } ?>
</table>


<script>

</script>

