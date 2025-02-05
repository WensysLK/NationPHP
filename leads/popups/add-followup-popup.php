<!-- Add Lead Modal -->
<div class="modal fade" id="addfolloupModal" tabindex="-1" aria-labelledby="addLeadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="../funtions/insert-followup.php" method="POST">

                <div class="modal-header">
                    <h5 class="modal-title" id="addLeadModalLabel">Add New Lead</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Lead Form Fields -->
                    <div class="container">
                        <div class="mb-3 row">
                            <!-- First Name (Column 1) -->
                            <div class="col-md">
                                <input type="hidden" name="follupid" value="<?php echo $lead_id; ?>">
                                <label for="followup_type" class="form-label">Follow-Up Type:</label>
                                <select name="followup_type" class="form-control" required>
                                    <option value="call">Call</option>
                                    <option value="email">Email</option>
                                </select>
                                <label for="message" class="form-label">Message:</label>
                                <textarea name="message" class="form-control" required></textarea><br>

                                <label for="followup_date" class="form-label">Follow-Up Date:</label>
                                <input type="date" name="followup_date" class="form-control" required><br>
                                <input type="hidden" name="status" value="processing">
                                <button type="submit" class="btn btn-primary">Submit Follow-Up</button>
                            </div>


                            
            </form>
        </div>
    </div>
</div>