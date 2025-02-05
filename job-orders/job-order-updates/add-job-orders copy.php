<?php include('../../includes/header.php'); 
include('../../includes/db_config.php');


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
                <form action="../functions/job_order_insert.php" method="POST"
                    enctype="multipart/form-data">
                    <div class="row border border-info p-2 bg-light">
                        <div class="col">
                            <label for="agentName" class="form-label">Agent Name</label>
                            <select name="agentName" id="agentName" class="form-control" onchange="fetchAgentDetails()">
                                <option value="none">Select an Agent</option>
                                <!-- Options will be dynamically populated by AJAX -->
                            </select>
                        </div>
                        <div class="col">
                            <label for="address">Address</label>
                            <p id="address">No address selected</p>
                        </div>
                        <div class="col">
                            <p id="agentDetails">
                                Agent Type: <span id="agentType">-</span><br>
                                Company Name: <span id="companyName">-</span><br>
                                BR No: <span id="brNumber">-</span><br>
                                Agency License No: <span id="agencyLicense">-</span><br>
                                Agreement No: <span id="agreementNumber">-</span><br>
                            </p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <hr>
                        <div class="col p-2">
                            <label for="accountName">Visa Category</label>
                            <input type="text" class="form-control" name="VisaCategory">
                        </div>
                        <div class="col p-2">
                            <label for="bankName">Visa Number</label>
                            <input type="text" class="form-control" name="visaNo" id="">
                        </div>

                        <div class="col p-2">
                            <label for="visaQty">Visa Quantity</label>
                            <input type="number" class="form-control" id="visaQty" name="visaQty">
                        </div>
                    </div>
                    <div class="row">
                        <div id="repeaterContainer">
                            <!-- Fields will be added dynamically here -->
                        </div>
                        <div class="col">
                            <button type="button" id="addPositionBtn" class="btn btn-warning mt-3">Add
                                Position</button>
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
    $.ajax({
        url: '../functions/get_agents.php',
        method: 'GET',
        success: function(response) {
            const dropdown = $('#agentName');
            if (response && Array.isArray(response)) {
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
                alert('Error fetching agent list. Please try again later.');
            }
        },
        error: function(err) {
            console.error('Error fetching agents:', err);
            alert('Error fetching agent list. Please check your connection.');
        }
    });
});

// Fetch agent details based on the selected agent
/*
function fetchAgentDetails() {
    const agentId = $('#agentName').val();

    if (agentId === 'none') {
        alert('Please select a valid agent');
        return;
    }

    $.ajax({
        url: '../functions/get_agent_details.php',
        method: 'GET',
        data: { agentId: agentId },
        success: function(agentDetails) {
            if (agentDetails && agentDetails.address) {
                $('#address').html(agentDetails.address);
                $('#agentType').text(agentDetails.fagentType || '-');
                $('#companyName').text(agentDetails.fagentTitle || '-');
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
}*/
</script>
<script>
$(document).ready(function() {
    var positions = ['Driver', 'Electrician', 'Accountant', 'Engineer']; // Example positions

    $('#addPositionBtn').on('click', function() {
        var visaQty = parseInt($('#visaQty').val());
        if (isNaN(visaQty) || visaQty <= 0) {
            alert('Please enter a valid visa quantity.');
            return;
        }

        var existingPositions = {};
        var totalQty = 0;
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

        var availablePositions = positions.filter(function(pos) {
            return !(pos in existingPositions);
        });

        if (availablePositions.length === 0) {
            alert('All positions are already selected.');
            return;
        }

        var html = '<div class="row mb-3">';
        html += '<div class="col">';
        html += '<label for="positionDropdown">Position</label>';
        html += '<select class="form-control positionDropdown" name="position[]">';
        html += '<option value="0">Select Position</option>';
        availablePositions.forEach(function(pos) {
            html += '<option value="' + pos + '">' + pos + '</option>';
        });
        html += '</select>';
        html += '</div>';
        html += '<div class="col">';
        html += '<label for="salaryInput">Salary</label>';
        html += '<input type="text" class="form-control salaryInput" name="salary[]">';
        html += '</div>';
        html += '<div class="col">';
        html += '<label for="qtyInput">Qty</label>';
        html += '<input type="number" class="form-control qtyInput" name="qty[]" min="0" max="' + (
            visaQty - totalQty) + '">';
        html += '</div>';
        html += '<div class="col">';
        html += '<label for="remarkInput">Remark</label>';
        html += '<input type="text" class="form-control remarkInput" name="jobsremark[]">';
        html += '</div>';
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

    // Validate on form submission
    $('form').on('submit', function() {
        var visaQty = parseInt($('#visaQty').val());
        var totalQty = 0;
        var valid = true;

        $('.qtyInput').each(function() {
            var qty = parseInt($(this).val() || 0);
            if (isNaN(qty) || qty < 0 || qty > visaQty) {
                valid = false;
                alert('Please enter a valid quantity for all positions.');
                return false; // Exit each loop
            }
            totalQty += qty;
        });

        if (totalQty > visaQty) {
            valid = false;
            alert('Total quantity cannot exceed the visa quantity (' + visaQty + ').');
        }

        return valid; // Prevent form submission if not valid
    });

    // Validate qtyInput on change
    $('#repeaterContainer').on('change', '.qtyInput', function() {
        var visaQty = parseInt($('#visaQty').val());
        var totalQty = 0;
        var valid = true;

        $('.qtyInput').each(function() {
            var qty = parseInt($(this).val() || 0);
            if (isNaN(qty) || qty < 0 || qty > visaQty) {
                valid = false;
                alert('Please enter a valid quantity for all positions.');
                return false; // Exit each loop
            }
            totalQty += qty;
        });

        if (totalQty > visaQty) {
            valid = false;
            alert('Total quantity cannot exceed the visa quantity (' + visaQty + ').');
        }

        if (!valid) {
            $(this).val(''); // Clear invalid input
            return false;
        }
    });
});
</script>