<?php

$sql = "SELECT * FROM leads WHERE (status='pending' OR status='processing') AND softdeletStatus=1
";
$result = $conn->query($sql);
?>

<!-- Content Area -->
<div class="container mt-4">
    <!-- Leads Section -->
    <div class="row" id="leadsSection">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h4>Leads</h4>
            <!-- Add New Lead Button -->
            <a href="#addfolloupModal" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addLeadModal">
                Add New Lead
            </a>
        </div>
        <div class="col-12">
            <table class="table table-bordered mt-3">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Source</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $num = 1; ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $num++; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo $row['source']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td>
                        <a href="followups/followup.php?lead_id=<?php echo $row['id']; ?>"><button
                        class="btn btn-sm btn-info">Follow Up</button></a> |
                            <!-- Register Button that opens Registration Modal -->
                            <a class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                data-bs-target="#registerModal-<?php echo $row['id']; ?>">Register</a>

                            <!-- Edit Button that opens Edit Modal -->
                            <a class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                data-bs-target="#editLeadModal-<?php echo $row['id']; ?>">Edit</a>

                            <!-- Delete Button with Confirmation -->
                            <form method="POST" action="funtions/delete-lead.php" style="display:inline;">
                                <input type="hidden" name="clientId" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?');">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Registration Modal with Prefilled Data -->
                    <div class="modal fade" id="registerModal-<?php echo $row['id']; ?>" tabindex="-1"
             aria-labelledby="registerModalLabel-<?php echo $row['id']; ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="registrationForm" method="post" action="funtions/register_lead.php">
                        <div class="modal-header">
                            <h5 class="modal-title" id="registerModalLabel-<?php echo $row['id']; ?>">Register Lead</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Hidden Field for Lead ID -->
                            <input type="hidden" name="lead_id" value="<?php echo $row['id']; ?>">

                            <!-- Passport and NIC -->
                            <div class="row mt-3">
                                <div class="col form-group">
                                    <label for="passportNumber">Passport Number:</label>
                                    <input type="text" class="form-control" name="passportNumber" 
                                           value="<?php echo htmlspecialchars($row['passportNumber'] ?? '', ENT_QUOTES); ?>" required>
                                </div>
                                <div class="col form-group">
                                    <label for="nicNumber">NIC Number:</label>
                                    <input type="text" class="form-control" name="nicNumber"
                                           value="<?php echo htmlspecialchars($row['nic'] ?? '', ENT_QUOTES); ?>" required>
                                </div>
                            </div>

                            <!-- Title and Names -->
                            <div class="row mt-3">
                                <div class="col">
                                    <label>Title</label>
                                    <select name="name-title" class="form-control" required>
                                        <option selected value="none">Title</option>
                                        <option value="Dr" >Dr</option>
                                        <option value="Mr" >Mr</option>
                                        <option value="Mrs" >Mrs</option>
                                        <option value="Ms">Ms</option>
                                        <option value="Rev.Fr" >Rev.Fr</option>
                                        <option value="Rev.Sis" >Rev.Sis</option>
                                        <option value="Jr" >Junior</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" name="Cfname"
                                           value="<?php echo htmlspecialchars($row['name'] ?? '', ENT_QUOTES); ?>" required>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <label>Middle Name</label>
                                    <input type="text" class="form-control" name="cmname"
                                           value="<?php echo htmlspecialchars($row['middle_name'] ?? '', ENT_QUOTES); ?>" required>
                                </div>
                                <div class="col">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" name="clname"
                                           value="<?php echo htmlspecialchars($row['lname'] ?? '', ENT_QUOTES); ?>" required>
                                </div>
                            </div>

                            <!-- Date of Birth -->
                            <div class="col mt-3 mb-3">
                                <label>Date of Birth</label>
                                <input type="date" class="form-control" name="dateofbirth"
                                       value="<?php echo htmlspecialchars($row['date_of_birth'] ?? '', ENT_QUOTES); ?>" required>
                            </div>

                            <!-- "How did you find us?" Dropdown -->
                            <div class="mb-3">
                                <label for="found_us" class="form-label">How did you find us?</label>
                                <input type="text" class="form-control" name="sourcelead" value="<?php echo htmlspecialchars($row['source'] ?? '', ENT_QUOTES); ?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="saveContinue">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

                    <!-- Edit Lead Modal -->
                    <div class="modal fade" id="editLeadModal-<?php echo $row['id']; ?>" tabindex="-1"
                        aria-labelledby="editLeadModalLabel-<?php echo $row['id']; ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="funtions/update-lead.php" method="POST">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editLeadModalLabel-<?php echo $row['id']; ?>">Edit
                                            Lead</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Hidden field to pass lead ID -->
                                        <input type="hidden" name="lead_id" value="<?php echo $row['id']; ?>">

                                        <div class="mb-3 row">
                                            <div class="col-md-6">
                                                <label for="firstName" class="form-label">First Name:</label>
                                                <input type="text" name="firstName" class="form-control"
                                                    value="<?php echo htmlspecialchars($row['first_name'] ?? '', ENT_QUOTES); ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="lastName" class="form-label">Last Name:</label>
                                                <input type="text" name="lastName" class="form-control"
                                                    value="<?php echo htmlspecialchars($row['last_name'] ?? '', ENT_QUOTES); ?>">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <div class="col-md-6">
                                                <label for="nic" class="form-label">NIC:</label>
                                                <input type="text" name="nic" class="form-control"
                                                    value="<?php echo htmlspecialchars($row['nic'] ?? '', ENT_QUOTES); ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="passport" class="form-label">Passport Number:</label>
                                                <input type="text" name="passport" class="form-control"
                                                    value="<?php echo htmlspecialchars($row['passportNumber'] ?? '', ENT_QUOTES); ?>">
                                            </div>
                                        </div>

                                        <!-- Email -->
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email:</label>
                                            <input type="email" class="form-control" name="email"
                                                value="<?php echo htmlspecialchars($row['email'] ?? '', ENT_QUOTES); ?>"
                                                required>
                                        </div>

                                        <!-- Phone -->
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone:</label>
                                            <input type="text" name="phone" class="form-control"
                                                value="<?php echo htmlspecialchars($row['phone'] ?? '', ENT_QUOTES); ?>"
                                                required>
                                        </div>

                                        <!-- Campaign Source (Dropdown) -->
                                        <div class="mb-3">
                                            <label for="source" class="form-label">Campaign Source:</label>
                                            <select name="source" class="form-control" required>
                                                <option value="Facebook"
                                                    <?php if($row['source'] == 'Facebook') echo 'selected'; ?>>Facebook
                                                </option>
                                                <option value="Website"
                                                    <?php if($row['source'] == 'Website') echo 'selected'; ?>>Website
                                                </option>
                                                <option value="Calls"
                                                    <?php if($row['source'] == 'Calls') echo 'selected'; ?>>Calls
                                                </option>
                                                <option value="Paper Ads"
                                                    <?php if($row['source'] == 'Paper Ads') echo 'selected'; ?>>Paper
                                                    Ads</option>
                                            </select>
                                        </div>

                                        <!-- Status Dropdown -->
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status:</label>
                                            <select name="status" class="form-select" required>
                                                <option value="new"
                                                    <?php if($row['status'] == 'new') echo 'selected'; ?>>New</option>
                                                <option value="follow-up"
                                                    <?php if($row['status'] == 'follow-up') echo 'selected'; ?>>
                                                    Follow-Up</option>
                                                <option value="registered"
                                                    <?php if($row['status'] == 'registered') echo 'selected'; ?>>
                                                    Registered</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update Lead</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </tbody>
            </table>

        </div>
    </div>



    <!-- Repeat similar sections for Agents, Job Orders, Reports, and Accounts -->

</div>