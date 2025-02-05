<style>
    #viewcompanyagent {
    white-space: nowrap;
    overflow-x: auto; /* Horizontal scroll if content overflows */
    table-layout: auto;
}
</style>
<table id="viewcompanyagent" class="table table-striped table-bordered mt-2" style="width:100%">
    <?php
        $sqlapplication = "
     SELECT * FROM sponcer_details where softdeletestatus ='1' ;
    ";

        $resapplication = mysqli_query($conn,$sqlapplication);

        if($resapplication == true) {
            $count_rows = mysqli_num_rows($resapplication);
            $num = 1;

            if($count_rows > 0) { ?>
    <thead>
        <tr>
            <th>No</th>
            <th>Sponsor ID</th>
            <th>Sponsor Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = mysqli_fetch_assoc($resapplication)) {
                        $agentId = $row['sponcerId'];
                        $agenttitle = $row['sponcerName'];

                        
                        
                    ?>
        <tr>
            <td><?php echo $num++; ?></td>
            <td><?php echo $agentId; ?></td>
            <td>
                <div class="d-flex align-items-center">
                    <img class="rounded-circle" style="width: 40px; height: 40px;"
                        src="../../uploads/img/fallback-image.png" alt="Fallback Image" />
                    <div class="ms-2">
                        <?php echo $agenttitle ; ?>
                    </div>

                </div>
            </td>


            <td>
                <form action="edit-sponcers.php" style="display: inline-block;" method="POST">
                    <input type="hidden" name="sponserId" value="<?php echo $agentId; ?>">
                    <button type="submit" class="btn btn-primary btn-sm lni lni-pencil">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-edit-2">
                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                        </svg>
                    </button>
                </form>
                <form action="view-sponcers.php" style="display: inline-block;" method="POST">
                    <input type="hidden" name="sponserId" value="<?php echo $agentId; ?>">
                    <button type="submit" class="btn btn-primary btn-sm lni lni-pencil">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-eye">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </button>
                </form>
                <form method="POST" action="functions/delete_sponsor_data.php" style="display:inline;">
                    <input type="hidden" name="sponserId" value="<?php echo $agentId; ?>">
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
// $('.btn-warning').tooltip({
//     template: '<div class="tooltip tooltip-primary" role="tooltip"> <
//         div class = "arrow" > < /div> <
//         div class = "tooltip-inner" > < /div> <
//         /div>'
// })
</script>