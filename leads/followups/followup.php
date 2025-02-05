<?php include('../../includes/header.php'); 

// Assuming lead_id is passed via URL (e.g., ?lead_id=123)
$lead_id = isset($_GET['lead_id']) ? $_GET['lead_id'] : null;
// Check if lead_id is present
if ($lead_id) {
    // Prepare the query to fetch the lead's name using the lead_id
    $sql = "SELECT name, lname FROM leads WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $lead_id); // Assuming id is an integer
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the lead's name
    if ($result->num_rows > 0) {
        $lead = $result->fetch_assoc();
        $lead_name = $lead['name'] . ' ' . $lead['lname'];
    } else {
        $lead_name = "Lead not found"; // Handle case where lead is not found
    }
} else {
    $lead_name = "No lead selected"; // Handle case where no lead_id is provided
}



?>


?>

<body>
    <?php include('../../includes/navigation-admin.php'); ?>
    <div class="content content-fixed bd-b">
        <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
            <div class="d-sm-flex align-items-center justify-content-between">
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-style1 mg-b-5">
                            <li class="breadcrumb-item"><a href="#">Leads</a></li>
                            <li class="breadcrumb-item"><a href="#">Follow Up</a></li>
                        </ol>
                    </nav>
                    <!--<h4 class="mg-b-0">View All</h4>-->
                </div>
                <div class="mg-t-20 mg-sm-t-0">

                   <!-- Button to trigger follow-up form modal -->
                <a class="btn btn-primary" href="#addfolloupModal" data-bs-toggle="modal" data-bs-target="#addfolloupModal">
    Add Follow-Up
</a>


                </div>
            </div>

            <div class="content">
                <!-- Display Lead Name -->
                <h4>Follow Up with Lead</h4>
                <h3>Lead: <?php echo $lead_name; // Assuming $lead_name contains the lead's name ?></h3>

                


                <!-- Modal for Follow-Up Form -->
                <div class="modal fade" id="followUpModal" tabindex="-1" aria-labelledby="followUpModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                               <a href="#addfolloupModal"> <button type="button" data-bs-toggle="modal" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close">Add Follow-Up</button></a>
                            </div>
                            <div class="modal-body">
                                <!-- Follow-up Form -->
                                <form method="POST" action="funtions/insert-followup.php">
                                    <div class="mb-3">
                                        <label for="followup_type" class="form-label">Follow-Up Type:</label>
                                        <select name="followup_type" class="form-select" required>
                                            <option value="call">Call</option>
                                            <option value="email">Email</option>
                                        </select>
                                    </div>
                                    <input type="hidden" name="follupid" value="<?php echo $lead_id; ?>">
                                    <div class="mb-3">
                                        <label for="message" class="form-label">Message:</label>
                                        <textarea name="message" class="form-control" rows="4" required></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="followup_date" class="form-label">Follow-Up Date:</label>
                                        <input type="date" name="followup_date" class="form-control" required>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit Follow-Up</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Display Previous Follow-Ups -->
                <h3 class="mt-5">Previous Follow-Ups</h3>
                <table class="table table-bordered table-hover mt-3">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Message</th>
                            <th>Actions</th> <!-- Add actions column -->
                        </tr>
                    </thead>
                    <?php
        
        // Fetch all follow-ups for the current lead
$followups_sql = "SELECT * FROM follow_ups WHERE lead_id = '$lead_id' AND softdeletestatus=1 ORDER BY followup_date DESC";
$followups_result = $conn->query($followups_sql);
        
        
        ?>
                    <tbody>
                        <?php while ($row = $followups_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['followup_date']; ?></td>
                            <td><?php echo ucfirst($row['followup_type']); ?></td>
                            <td><?php echo $row['message']; ?></td>
                            <td>
                                <!-- Edit Button -->
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editFollowUpModal-<?php echo $row['id']; ?>">
                                    Edit
                                </button>

                                <!-- Delete Button -->
                                <form method="POST" action="../funtions/delete-followup.php" style="display:inline;">
                                    <input type="hidden" name="followup_id" value="<?php echo $row['id']; ?>">
                                    <input type="hidden" name="clientId" value="<?php echo $row['lead_id']; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure?');">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal for Edit Follow-Up -->
                        <div class="modal fade" id="editFollowUpModal-<?php echo $row['id']; ?>" tabindex="-1"
                            aria-labelledby="editFollowUpModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editFollowUpModalLabel">Edit Follow-Up</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Follow-up Edit Form -->
                                        <form method="POST" action="../funtions/update-followup.php">
                                            <input type="hidden" name="followup_id" value="<?php echo $row['id']; ?>">
                                            <input type="hidden" name="leadid" value="<?php echo $row['lead_id']; ?>">
                                            <div class="mb-3">
                                                <label for="followup_type" class="form-label">Follow-Up Type:</label>
                                                <select name="followup_type" class="form-select" required>
                                                    <option value="call"
                                                        <?php if($row['followup_type'] == 'call') echo 'selected'; ?>>
                                                        Call</option>
                                                    <option value="email"
                                                        <?php if($row['followup_type'] == 'email') echo 'selected'; ?>>
                                                        Email
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="message" class="form-label">Message:</label>
                                                <textarea name="message" class="form-control" rows="4"
                                                    required><?php echo $row['message']; ?></textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label for="followup_date" class="form-label">Follow-Up Date:</label>
                                                <input type="date" name="followup_date" class="form-control"
                                                    value="<?php echo $row['followup_date']; ?>" required>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Update Follow-Up</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <a href="../view_all_leads.php">Back to Lead List</a>

                <?php  include('../../includes/footer.php');   
                include('../popups/add-followup-popup.php'); ?>
            </div>