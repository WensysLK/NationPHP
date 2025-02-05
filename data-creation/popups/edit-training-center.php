<div class="modal fade" id="modal78New" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel6" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content tx-14">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel6">Edit Training Center</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="functions/training_center_update.php" method="POST">
                    <div class="row">
                        <input type="hidden" class="form-control" name="trainingCenterId" id="trainingCenterId">
                        <div class="col">
                            <label for="medicalCentername" class="form-label">Medical Center Name</label>
                            <input type="text" class="form-control" name="trainingCenterName" id="trainingCenterName">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <label for="Phonenumber" class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phoneNumber" id="phoneNumber">
                        </div>
                        <div class="col">
                            <label for="Email" class="form-label">Email</label>
                            <input type="text" class="form-control" name="trainingEmail" id="trainingEmail">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="addressline1" class="form-label">Address </label>
                            <input type="text" class="form-control" name="trainingAddress" id="trainingAddress" >
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <label for="website" class="form-label">Website</label>
                            <input type="text" class="form-control" name="wesiteurl" id="wesiteurl">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2" name="submit">Update</button>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary tx-13" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>