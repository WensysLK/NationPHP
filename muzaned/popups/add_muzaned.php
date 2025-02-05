<?php

$sqlMedicalCenters = "SELECT medicalCenterID, MediName FROM medical_center WHERE softdeletestatus = 1"; // Assuming there's a `status` column to filter active centers
$resultMedicalCenters = mysqli_query($conn, $sqlMedicalCenters);


?>
<div class="modal fade" id="modal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content tx-14">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel4">Submit Muzaned</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="functions/insert_muzaned.php" method="POST"
                    enctype="multipart/form-data">
                    <input type="hidden" name="appId" id="applicantIDInput" value="">
                    <input type="hidden" name="contractId" id="contractId" value="">
                    <div class="row">
                        <div class="col-4">
                        <img src="../../uploads/img/fallback-image.png" class="img-fluid" alt="Responsive image">


                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col">
                                <label for="clientName">Client Name:</label>
                                <input type="text" class="form-control" name="clientFullname" id="clientFullname"
                                    readonly>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col">
                                    <label for="passportnumber">Passport No:</label>
                                    <input type="text" class="form-control" name="passport" id="clinetPassport" readonly>
                                </div>
                                <div class="col">
                                    <label for="DateOfBirth">Date Of Birth:</label>
                                    <input type="text" class="form-control" name="dob" id="clientdob" readonly>
                                </div>

                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                <label for="muzanesDate">Muzaned Date:</label>
                                <input type="date" name="muzaneddate" class="form-control" id="muzaneddate">
                                </div>
                                <div class="col">
                                <label for="muzanedserialno">Serial No:</label>
                                <input type="text" name="muzanedserialno" class="form-control" id="muzaneddate">   
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary mt-2" name="submit">Submit Muzaned</button>

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary tx-13" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>