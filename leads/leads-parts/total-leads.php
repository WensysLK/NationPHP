<?php

$sql = "SELECT * FROM leads WHERE status='new' AND softdeletStatus=1";
$result = $conn->query($sql);
?>

<!-- Content Area -->
<div class="container mt-4">
    <!-- Leads Section -->
    <div class="row" id="leadsSection">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h4>Leads</h4>
            <!-- Add New Lead Button -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addLeadModal">
                Add New Lead
            </button>
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
                    <?php $num=1; ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $num++; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo $row['source']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td>
                        <a href="funtions/update-follupstatus.php?lead_id=<?php echo $row['id']; ?>">
        <button class="btn btn-sm btn-info">Follow Up</button>
    </a> |
                            <a class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                data-bs-target="#editLeadModal-<?php echo $row['id']; ?>">Edit</a>
                            <form method="POST" action="funtions/delete-lead.php" style="display:inline;">
                                <input type="hidden" name="clientId" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?');">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    <!-- Edit Lead Modal Popup -->
                    <div class="modal fade" id="editLeadModal-<?php echo $row['id']; ?>" tabindex="-1"
                        aria-labelledby="editLeadModalLabel-<?php echo $row['id']; ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editLeadModalLabel-<?php echo $row['id']; ?>">Edit Lead
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Edit Lead Form -->
                                    <form action="funtions/update-lead.php" method="POST">
                                        <div class="modal-body">
                                            <!-- Lead Form Fields -->
                                            <div class="container">
                                                <!-- Hidden field to pass lead ID -->
                                                <input type="hidden" name="lead_id" value="<?php echo $row['id']; ?>">

                                                <div class="mb-3 row">
                                                    <!-- First Name (Column 1) -->
                                                    <div class="col-md-6">
                                                        <label for="firstName" class="form-label">First Name:</label>
                                                        <input type="text" name="firstName" class="form-control"
                                                            value="<?php echo $row['name']; ?>">
                                                    </div>

                                                    <!-- Last Name (Column 2) -->
                                                    <div class="col-md-6">
                                                        <label for="lastName" class="form-label">Last Name:</label>
                                                        <input type="text" name="lastName" class="form-control"
                                                            value="<?php echo $row['lname']; ?>">
                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <!-- NIC (Column 1) -->
                                                    <div class="col-md-6">
                                                        <label for="nic" class="form-label">NIC:</label>
                                                        <input type="text" name="nic" class="form-control"
                                                            value="<?php echo $row['nic']; ?>">
                                                    </div>

                                                    <!-- Passport Number (Column 2) -->
                                                    <div class="col-md-6">
                                                        <label for="passport" class="form-label">Passport
                                                            Number:</label>
                                                        <input type="text" name="passport" class="form-control"
                                                            value="<?php echo $row['passportNumber']; ?>">
                                                    </div>
                                                </div>

                                                <!-- Email -->
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email:</label>
                                                    <input type="email" class="form-control" name="email"
                                                        value="<?php echo $row['email']; ?>" required>
                                                </div>

                                                <!-- Phone -->
                                                <div class="mb-3">
                                                    <label for="phone" class="form-label">Phone:</label>
                                                    <input type="text" name="phone" class="form-control"
                                                        value="<?php echo $row['phone']; ?>" required>
                                                </div>

                                                <!-- Campaign Source (Dropdown) -->
                                                <div class="mb-3">
                                                    <label for="source" class="form-label">Campaign Source:</label>
                                                    <select name="source" class="form-control" required>
                                                        <option value="Facebook"
                                                            <?php if($row['source'] == 'Facebook') echo 'selected'; ?>>
                                                            Facebook</option>
                                                        <option value="Website"
                                                            <?php if($row['source'] == 'Website') echo 'selected'; ?>>
                                                            Website</option>
                                                        <option value="Calls"
                                                            <?php if($row['source'] == 'Calls') echo 'selected'; ?>>
                                                            Calls</option>
                                                        <option value="Paper Ads"
                                                            <?php if($row['source'] == 'Paper Ads') echo 'selected'; ?>>
                                                            Paper Ads</option>
                                                    </select>
                                                </div>
                                               
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
                    </div>

                    <?php endwhile; ?>
                </tbody>

            </table>
        </div>
    </div>


    <!-- Repeat similar sections for Agents, Job Orders, Reports, and Accounts -->

</div>