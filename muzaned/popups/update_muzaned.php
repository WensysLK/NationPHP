<div class="modal fade" id="updatemuzaned" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Muzaned Updated</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form method="post" action="functions/update_muzaned.php" enctype="multipart/form-data">
                    <div class="row">
                    <input type="hidden" name="muzanedID" id="muzanedID" value="<?php echo $muzanedId; ?>">
                    <input type="hidden" name="cleintID" id="cleintID" value="<?php echo $applicantID; ?>">
                        <input type="hidden" name="currentUser" value="<?php echo $userid; ?>">
                        <input type="hidden" name="exptyp" value="Muzaned">
                    </div>

                    <!-- Sponsor Selection -->
                    <div class="row">
                        <div class="col">
                            <?php
                                // Fetch the sponsors from the database
                                $query = "SELECT fagentId, fagentTitle, fagentFname, fagentLname FROM foreign_agent_details WHERE softdeletestatus=1";
                                $result = mysqli_query($conn, $query);
                            ?>
                            <label for="sponcer">Wakala Agent</label>
                            <select name="fagent" id="sponsorSelect" class="form-control" onchange="loadJobOrdersmuzaned(this.value)">
                                <option value="">Select Sponsor</option>
                                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <option value="<?php echo $row['fagentId']; ?>">
                                        <?php echo $row['fagentTitle'] . " " . $row['fagentFname'] . " " . $row['fagentLname']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <!-- Job Order Dropdown -->
                        <div class="col">
                            <label>Job Order</label>
                            <select id="jobOrderSelect" name="jobordername" class="form-control" onchange="loadVisaAndPositionsmuzaned(this.value)">
                                <option>Select Job Order</option>
                                <!-- Job Orders will be dynamically populated -->
                            </select>
                        </div>

                        <!-- Position Dropdown -->
                        <div class="col">
                            <label for="positions"><b>Positions:</b></label>
                            <select id="positionSelect" name="jobpositions" class="form-control">
                                <option>Select Position </option>
                                <option value="1">Driver</option>
                                <option value="2">Accountant</option>
                                <option value="3">House Maid</option>

                                <!-- Positions will be dynamically populated -->
                            </select>
                        </div>
                    </div>

                    <!-- Other Fields -->
                    <div class="row mt-2">
<!--                        <div class="col">-->
<!--                            <label for="contractno">Contract No:</label>-->
<!--                            <input type="text" class="form-control" name="contractno" id="contractno">-->
<!--                        </div>-->

                    </div>

                    <div class="row mt-2">
                   <div class="col">
                            <label for="visanumber">Visa No:</label>
                            <input type="text" class="form-control" name="visanumber" id="visanumber">
                        </div>
                        <div class="col">
                            <label for="SponcerID">Sponsor ID:</label>
                            <input type="text" class="form-control" name="SponcerID" id="SponcerID">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="">Sponcer Name</label>
                            <input type="text" class="form-control" name="sponcername" id="">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <label for="muzanedreport">Upload Muzaned Document</label>
                            <input type="file" class="form-control mb-10" name="muzanedreport" id="muzanedreport">
                            <input type="hidden" name="muzanedstatus" value="completed">
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col">
                            <label for="expremark">Remark:</label>
                            <textarea class="form-control" name="expremark" id="expremark"></textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary" name="updatemuzaned">Update Muzaned</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
// Function to load job orders based on the selected foreign agent
// Function to load job orders based on the selected foreign agent
function loadJobOrdersmuzaned(agentId) {
    if (agentId === "") {
        document.getElementById("jobOrderSelect").innerHTML = "<option>Select Job Order</option>";
        return;
    }

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "functions/get_job_orders.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("jobOrderSelect").innerHTML = this.responseText; // Populate job orders
        }
    };
    xhr.send("fagentId=" + agentId); // Send foreign agent ID to fetch job orders
}

// function loadVisaAndPositionsmuzaned(jobOrderId) {
//     if (jobOrderId === "") {
//         document.getElementById("positionSelect").innerHTML = "<option>Select Position</option>";
//         return;
//     }
//
//     const xhr = new XMLHttpRequest();
//     xhr.open("POST", "functions/get_positions.php", true);
//     xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//
//     xhr.onreadystatechange = function() {
//         if (this.readyState == 4 && this.status == 200) {
//             try {
//                 // Parse the JSON response
//                 const response = JSON.parse(this.responseText);
//
//                 // Check if there are positions returned
//                 if (response.positions) {
//                     // Set the positions dropdown with the options
//                     document.getElementById("positionSelect").innerHTML = response.positions;
//                 } else if (response.error) {
//                     console.error(response.error);
//                 }
//             } catch (e) {
//                 console.error("Error parsing JSON response:", e);
//             }
//         }
//     };
//
//     xhr.send("jobOrderId=" + jobOrderId); // Send the selected jobOrderId to PHP
// }

</script>