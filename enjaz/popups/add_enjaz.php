<div class="modal fade" id="modal6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Add Enjaz</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="registrationForm" class="needs-validation" method="post"
                    action="functions/insert_job_orders.php" novalidate>
                    <div class="row mt-3">
                        <div class="col-4 ">
                            <img class="img-fluid" id="applicantImage" alt="Responsive image" src=""
                                alt="Fallback Image" />
                        </div>

                        <div class="col">
                            <div class="row mb-1">
                                <div class="col">
                                    <input type="hidden" id="applicantIDInput" name="applicantID" value="">
                                    <input type="hidden" id="appContract" name="appContract" value="<?php echo $contractId ?>">
                                    <label for="cleintName"><b>Client Name:</b><br></label>
                                    <input type="text" class="form-control" name="clientName" id="ClientName">
                                </div>
                                <div class="col">
                                    <label for="passportNumber"><b>Passport Number:</b></label>
                                    <input type="text" name="passportnumber" class="form-control" id="passportnumber">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col">
                                    <label for="nicNumber"><b>NIC Number:</b></label><br>
                                    <input type="text" name="clientnic" class="form-control" id="clientNIC">
                                </div>
                                <div class="col">
                                    <label for="dob"><b>Date Of Birth:</b></label><br>
                                    <input type="text" name="clientdob" class="form-control" id="clientdob">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <?php
                                    // Fetch the sponsors from the sponsor_table
                                    $query = "SELECT fagentId, fagentTitle,fagentFname,fagentLname FROM foreign_agent_details WHERE softdeletestatus=1";
                                    $result = mysqli_query($conn, $query);

                                    ?>
                                    <label for="sponcer">Sponcer</label>
                                    <select name="fagent" id="sponsorSelect" class="form-control"
                                        onchange="loadJobOrders(this.value)">
                                        <option value="">Select Sponsor</option>
                                        <?php while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                        <option value="<?php echo $row['fagentId']; ?>">
                                            <?php echo $row['fagentTitle']." ".$row['fagentFname']." ".$row['fagentLname']; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col">
                                    <label>Job Order</label>
                                    <select id="jobOrderSelect" name="jobordername" class="form-control"
                                        >
                                        <option>Select Job Order</option>
                                        <!-- Job Orders will be dynamically filled by AJAX -->
                                    </select>
<!--                                    onchange="loadVisaAndPositions(this.value)"-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <!-- Removed Visa Category and Visa Number -->
                        <!-- Positions Dropdown -->
                        <div class="col">
                            <label for="positions"><b>Positions:</b></label>
                            <select id="positionSelect1" name="jobpositions" class="form-control">
                                <option value="">Select Position</option>
                                <option value="1">Driver</option>
                                <option value="2">Accountant</option>
                                <option value="3">House Maid</option>
                                <option value="4">Electrician</option>
                                <!-- Positions will be dynamically populated -->
                            </select>
                        </div>

                        <div class="row mt-2">
                            <div class="col">
                                <label class="form-label">Enjaz REF</label>
                                <input type="text" class="form-control" name="enjazref" id="" value="">
                            </div>
                            <div class="col">
                                <label class="form-label">Enjazapp Date</label>
                                <input type="date" class="form-control" name="ejazappdate" id="" value="">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2" name="submit">Book Enjaz</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary tx-13" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
// Function to load job orders based on the selected foreign agent
function loadJobOrders(agentId) {
    // alert(agentId);
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

// Function to load positions when a job order is selected
function loadVisaAndPositions(jobOrderId) {
    if (jobOrderId === "") {
        document.getElementById("positionSelect").innerHTML = "<option>Select Position</option>";
        return;
    }

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "functions/get_positions.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            try {
                const data = JSON.parse(this.responseText);

                // Update positions dropdown
                document.getElementById("positionSelect").innerHTML = data.positions;
            } catch (e) {
                console.error("Error parsing JSON response:", e);
            }
        }
    };

    xhr.send("jobOrderId=" + jobOrderId); // Send the selected jobOrderId to PHP
}
</script>
