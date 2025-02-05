<?php include('../../includes/header.php');
$applicationId =$_POST['applicationID'];
$sqlmedical="SELECT  job_orders.*,job_positions.*,foreign_agent_details.*
                 FROM job_orders
                 JOIN job_positions ON job_positions.jobOrderId = job_orders.JobOrderId
                 JOIN foreign_agent_details ON foreign_agent_details.fagentId = job_orders.AgentID
                 WHERE job_orders.softdeletestatus = 1 AND job_orders.JobOrderId=$applicationId ";

$resmedicalNew = mysqli_query($conn, $sqlmedical);
$row = mysqli_fetch_assoc($resmedicalNew);



?>

<body>
<?php include('../../includes/navigation-admin.php'); ?>
<div class="content content-fixed bd-b">
    <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1 mg-b-5">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item"><a href="#">Job Orders</a></li>
                    </ol>
                </nav>
                <h4 class="mg-b-0">Create Job Orders</h4>
            </div>
            <div class="mg-t-20 mg-sm-t-0">



            </div>
        </div>
        <div class="content">
            <form action="../functions/job_order_insert.php" method="POST" enctype="multipart/form-data">
                <div class="row border border-info p-2 bg-light">
                    <div class="col">
                        <label for="agentName" class="form-label">Agent Name</label>
                        <select name="agentName" id="agentName" class="form-control" onchange="fetchAgentDetails()">
                            <option value="<?php echo $row['fagentTitle']?> <?php echo $row['fagentFname']?> <?php echo $row['fagentMname']?> <?php echo $row['fagentLname']?>"><?php echo $row['fagentTitle']?> <?php echo $row['fagentFname']?> <?php echo $row['fagentMname']?> <?php echo $row['fagentLname']?></option>
                            <!-- Options will be dynamically populated by AJAX -->
                        </select>
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="col p-2">
                        <label for="visaQty">Job Position Quantity</label>
                        <input type="number" class="form-control" id="visaQty" name="visaQty" required>
                    </div>
                </div>

                <div class="row">
                    <div id="repeaterContainer">
                        <!-- Fields will be added dynamically here -->
                    </div>
                    <div class="col">
                        <button type="button" id="addPositionBtn" class="btn btn-warning mt-3">Add Position</button>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-2" name="submit">Create Job Order</button>
            </form>
        </div>

    </div>
    <!--Popup form for Precheck Registration -->

    <!-- End popup -->



    <?php include('../../includes/footer.php'); ?>


</body>

</html>
<script>
    // Fetch the list of agents and populate the dropdown
    $(document).ready(function() {
        var positions = []; // Store positions fetched from the API

        // Fetch positions from the API when the page loads
        function fetchPositions() {
            $.ajax({
                url: '../api-request/get_positions.php', // API URL
                method: 'GET',
                success: function(response) {
                    positions = response; // Store the fetched positions in the positions array
                    console.log(positions); // Check what response is coming from the API
                },
                error: function(err) {
                    console.error('Error fetching positions:', err);
                    alert('Error fetching positions. Please try again.');
                }
            });
        }

        // Call fetchPositions when the page loads
        fetchPositions();

        // Event listener for the "Add Position" button
        $('#addPositionBtn').off('click').on('click', function() {
            var visaQty = parseInt($('#visaQty').val()); // Get visa quantity
            if (isNaN(visaQty) || visaQty <= 0) {
                alert('Please enter a valid visa quantity.');
                return;
            }

            var existingPositions = {};
            var totalQty = 0;

            // Collect existing positions and their quantities
            $('#repeaterContainer').find('.positionDropdown').each(function() {
                var position = $(this).val();
                var qty = parseInt($(this).closest('.row').find('.qtyInput').val() || 0);
                if (position !== '0') {
                    existingPositions[position] = qty;
                    totalQty += qty;
                }
            });

            if (totalQty >= visaQty) {
                alert('Total quantity cannot exceed the visa quantity (' + visaQty + ').');
                return;
            }

            // Filter available positions (those that haven't been selected)
            var availablePositions = positions.filter(function(pos) {
                return !(pos.id in existingPositions); // Filter out already selected positions
            });

            if (availablePositions.length === 0) {
                alert('All positions are already selected.');
                return;
            }

            // Create new row for position, salary, quantity, and remark
            var html = '<div class="row mb-3">';
            html += '<div class="col">';
            html += '<label for="positionDropdown">Position</label>';
            html += '<select class="form-control positionDropdown" name="position[]">';
            html += '<option value="0">Select Position</option>';

            availablePositions.forEach(function(pos) {
                html += '<option value="' + pos.id + '">' + pos.job_title + '</option>'; // Use `job_title`
            });

            html += '</select>';
            html += '</div>';

            // Salary and currency input
            html += '<div class="col">';
            html += '<label for="salaryInput">Salary</label>';
            html += '<div class="input-group">';
            html += '<input type="text" class="form-control salaryInput" name="salary[]">';
            html += '<select class="form-control" name="currency[]">'; // Currency dropdown
            html += '<option value="USD">USD</option>';
            html += '<option value="EUR">EUR</option>';
            html += '<option value="GBP">GBP</option>';
            html += '<option value="LKR">LKR</option>';
            html += '</select>';
            html += '</div>';
            html += '</div>';

            // Quantity input
            html += '<div class="col">';
            html += '<label for="qtyInput">Qty</label>';
            html += '<input type="number" class="form-control qtyInput" name="qty[]" min="1" max="' + (visaQty - totalQty) + '">';
            html += '</div>';

            // Remark input
            html += '<div class="col">';
            html += '<label for="remarkInput">Remark</label>';
            html += '<input type="text" class="form-control remarkInput" name="jobsremark[]">';
            html += '</div>';

            // Remove button
            html += '<div class="col">';
            html += '<button type="button" class="btn btn-danger removeBtn">Remove</button>';
            html += '</div>';
            html += '</div>';

            $('#repeaterContainer').append(html);
        });

        // Remove position row
        $('#repeaterContainer').on('click', '.removeBtn', function() {
            $(this).closest('.row').remove();
        });
    });



    $(document).ready(function() {
        // Fetch the list of agents and populate the dropdown when the page loads
        $.ajax({
            url: '../functions/get_agents.php', // Correct URL to fetch agents
            method: 'GET',
            success: function(response) {
                const dropdown = $('#agentName');
                dropdown.empty(); // Clear any previous options
                dropdown.append('<option value="none">Select an Agent</option>'); // Default option

                if (Array.isArray(response)) {
                    response.forEach(agent => {
                        // Construct full agent name from the fields returned by PHP
                        const fullName = `${agent.fagentTitle || ''} ${agent.fagentFname || ''} ${agent.fagentMname || ''} ${agent.fagentLname || ''}`.trim();

                        // Check if fagentId and fullName exist before appending
                        if (agent.fagentId && fullName) {
                            dropdown.append(`<option value="${agent.fagentId}">${fullName}</option>`);
                        } else {
                            console.warn('Agent data is incomplete:', agent);
                        }
                    });
                } else {
                    console.error('Invalid response:', response);
                    alert('Error fetching agent list. Please try again.');
                }
            },
            error: function(err) {
                console.error('Error fetching agents:', err);
                alert('Error fetching agent list. Please check your connection.');
            }
        });
    });

    function  fetchAgentDetails() {
        const agentId = $('#agentName').val();

        if (agentId === 'none') {
            alert('Please select a valid agent');
            return;
        }

        $.ajax({
            url: '../functions/get_agent_details.php', // Ensure the URL is correct
            method: 'GET',
            data: { agentId: agentId }, // Send the selected agent ID as data
            success: function(agentDetails) {
                if (agentDetails && !agentDetails.error) { // Make sure the response doesn't have an error field
                    // Update agent details in the DOM
                    $('#address').html(agentDetails.address || 'No address available');
                    $('#agentType').text(agentDetails.fagentType || '-');
                    $('#companyName').text(`${agentDetails.fagentTitle || ''} ${agentDetails.fagentFname || ''} ${agentDetails.fagentLname || ''}`.trim());
                    $('#brNumber').text(agentDetails.br_number || '-');
                    $('#agencyLicense').text(agentDetails.agency_license || '-');
                    $('#agreementNumber').text(agentDetails.agreement_number || '-');
                } else {
                    console.error('Invalid agent details:', agentDetails);
                    alert('Error fetching agent details. Please try again later.');
                }
            },
            error: function(err) {
                console.error('Error fetching agent details:', err);
                alert('Error fetching agent details. Please check your connection.');
            }
        });
    }
</script>