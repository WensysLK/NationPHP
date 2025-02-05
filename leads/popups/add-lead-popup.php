<!-- Add Lead Modal -->
<div class="modal fade" id="addLeadModal" tabindex="-1" aria-labelledby="addLeadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="./funtions/insert-leads.php" method="POST">

                <div class="modal-header">
                    <h5 class="modal-title" id="addLeadModalLabel">Add New Lead</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Lead Form Fields -->
                    <div class="container">
                        <div class="mb-3 row">
                            <!-- First Name (Column 1) -->
                            <div class="col-md-6">
                                <label for="firstName" class="form-label">First Name:</label>
                                <input type="text" name="firstName" class="form-control" required>
                            </div>

                            <!-- Last Name (Column 2) -->
                            <div class="col-md-6">
                                <label for="lastName" class="form-label">Last Name:</label>
                                <input type="text" name="lastName" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <!-- NIC (Column 1) -->
                            <div class="col-md-6">
                                <label for="nic" class="form-label">NIC:</label>
                                <input type="text" name="nic" class="form-control" required>
                            </div>

                            <!-- Passport Number (Column 2) -->
                            <div class="col-md-6">
                                <label for="passport" class="form-label">Passport Number:</label>
                                <input type="text" name="passport" class="form-control" >
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>

                        <!-- Phone -->
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone:</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>

                        <!-- Campaign Source (Dropdown) -->
                        <div class="mb-3">
                            <label for="source" class="form-label">Campaign Source:</label>
                            <select name="source" class="form-control" required>
                                <option value="" disabled selected>Select Campaign Source</option>
                                <option value="Facebook">Facebook</option>
                                <option value="Website">Website</option>
                                <option value="Calls">Calls</option>
                                <option value="Paper Ads">Paper Ads</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="satus" value="new">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Lead</button>
                    </div>
            </form>
        </div>
    </div>
</div>