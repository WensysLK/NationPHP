<?php include('../../includes/header.php');



$complain_id= $_GET['complain_id'];
$sqlNew="SELECT complains.* FROM complains  WHERE complains.softdeletestatus = 1 AND complains.id=$complain_id ";
$resmedicalNew = mysqli_query($conn, $sqlNew);
$row = mysqli_fetch_assoc($resmedicalNew);
//var_dump($row['type']);die();
$application_id=$row['complainant_id'];
if ($row['type']=="Employee"){
    $sqlmedical="SELECT  applications.*
                 FROM applications
                 WHERE applications.applicationID = $application_id ";
    $resmedical = mysqli_query($conn, $sqlmedical);
    $row_new = mysqli_fetch_assoc($resmedical);
}elseif ($row['type']=="LocalAgent"){
    $sqlmedical="SELECT  local_agent_details.*
                 FROM local_agent_details
                 WHERE local_agent_details.localagentId = $application_id ";
    $resmedical = mysqli_query($conn, $sqlmedical);
    $row_new = mysqli_fetch_assoc($resmedical);
}elseif ($row['type']=="ForeignAgent"){
    $sqlmedical="SELECT  foreign_agent_details.*
                 FROM foreign_agent_details
                 WHERE foreign_agent_details.fagentId = $application_id ";
    $resmedical = mysqli_query($conn, $sqlmedical);
    $row_new = mysqli_fetch_assoc($resmedical);
}



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
                            <li class="breadcrumb-item"><a href="#">Help Desk</a></li>
                            <li class="breadcrumb-item"><a href="#">Follow Up</a></li>
                        </ol>
                    </nav>
                    <!--<h4 class="mg-b-0">View All</h4>-->
                </div>
                <div class="mg-t-20 mg-sm-t-0">

                   <!-- Button to trigger follow-up form modal -->
                <a class="btn btn-primary" href="#followUpModal" data-bs-toggle="modal" data-bs-target="#followUpModal">
                                Add Follow-Up
                </a>


                </div>
            </div>

            <div class="content">
                <!-- Display Lead Name -->
                <h4>Follow Up with Complains</h4>
                <hr style="background: black">
<!--                <h3>Lead: --><?php //echo $lead_name; // Assuming $lead_name contains the lead's name ?><!--</h3>-->

                <div class="col-md">
                    <?php    if ($row['type']=="Employee"){ ?>
                        <h5>Passport Number : <?php echo $row_new['applicantPassno']?></h5><br>
                        <h5>Name : <?php echo $row_new['applicantTitle']?> <?php echo $row_new['applicatFname']?> <?php echo $row_new['applicantMname']?> <?php echo $row_new['applicantLname']?>  </h5><br>
                    <?php }elseif ($row['type']=="LocalAgent"){ ?>
                        <h5>NIC Number : <?php echo $row_new['Local_Agent_Nic']?></h5><br>
                        <h5>Name : <?php echo $row_new['Local_Agent_Title']?> <?php echo $row_new['Local_Agent_Fname']?> <?php echo $row_new['Local_Agent_Mname']?> <?php echo $row_new['Local_Agent_Lname']?></h5><br>
                    <?php }elseif ($row['type']=="ForeignAgent"){ ?>
                        <h5>IQAMA Number : <?php echo $row_new['fagentIqamaNo']?></h5><br>
                        <h5>Name : <?php echo $row_new['fagentTitle']?> <?php echo $row_new['fagentFname']?> <?php echo $row_new['fagentMname']?> <?php echo $row_new['fagentLname']?></h5><br>

                    <?php } ?>

                    <?php    if ($row['type']=="Employee"){ ?>
                        <h5>Complainant Type : Employee</h5><br>
                    <?php }elseif ($row['type']=="LocalAgent"){ ?>
                        <h5>Complainant Type : Local Agent</h5><br>
                    <?php }elseif ($row['type']=="ForeignAgent"){ ?>
                        <h5>Complainant Type : Foreign Agent</h5><br>
                    <?php }?>
                    <h5>Complains : <span><?php echo $row['message']?></span></h5><br>
                    <h5>Complains Date: <span><?php echo $row['create_date']?></span></h5><br>


                </div>



                <!-- Modal for Follow-Up Form -->
                <div class="modal fade" id="followUpModal" tabindex="-1" aria-labelledby="followUpModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
<!--                               <a href="#addfolloupModal"> <button type="button" data-bs-toggle="modal" class="btn-close" data-bs-dismiss="modal"-->
<!--                                    aria-label="Close">Add Follow-Up</button></a>-->
                            </div>
                            <div class="modal-body">
                                <!-- Follow-up Form -->
                                <form method="POST" action="../functions/processing-complains.php">
                                    <div class="mb-3">
                                        <label for="followup_type" class="form-label">Follow-Up Type:</label>
                                        <select name="followup_type" class="form-select" required>
                                            <option value="call">Call</option>
                                            <option value="email">Email</option>
                                        </select>
                                    </div>
                                    <input type="hidden" name="follupid" value="<?php echo $complain_id; ?>">
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
                <h3 class="mt-5">Previous Complains Follow-Ups</h3>
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
$followups_sql = "SELECT * FROM complains_follow_up WHERE complainant_id = '$complain_id' AND softdeletestatus=1 ORDER BY create_date DESC";
$followups_result = $conn->query($followups_sql);
        
        
        ?>
                    <tbody>
                        <?php while ($row = $followups_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['create_date']; ?></td>
                            <td><?php echo $row['follow_up_type']; ?></td>
                            <td><?php echo $row['message']; ?></td>
                            <td>
                                <!-- Edit Button -->
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editFollowUpModal-<?php echo $row['id']; ?>">
                                    Edit
                                </button>

                                <!-- Delete Button -->
                                <form method="POST" action="../functions/delete-followup.php" style="display:inline;">
                                    <input type="hidden" name="followup_id" value="<?php echo $row['id']; ?>">
                                    <input type="hidden" name="clientId" value="<?php echo $row['complainant_id']; ?>">
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
                                        <form method="POST" action="../functions/processing-complains-follow-up.php">
                                            <input type="hidden" name="followup_id" value="<?php echo $row['id']; ?>">
                                            <input type="hidden" name="complainant_id" value="<?php echo $row['complainant_id']; ?>">
                                            <div class="mb-3">
                                                <label for="followup_type" class="form-label">Follow-Up Type:</label>
                                                <select name="followup_type" class="form-select" required>
                                                    <option value="call"
                                                        <?php if($row['follow_up_type'] == 'call') echo 'selected'; ?>>
                                                        Call</option>
                                                    <option value="email"
                                                        <?php if($row['follow_up_type'] == 'email') echo 'selected'; ?>>
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
                                                    value="<?php echo $row['create_date']; ?>" required>
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
//                include('../popups/add-followup-popup.php'); ?>
            </div>