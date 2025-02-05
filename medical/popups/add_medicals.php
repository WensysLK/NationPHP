<?php

$sqlMedicalCenters = "SELECT medicalCenterID, MediName FROM medical_center WHERE softdeletestatus = 1"; // Assuming there's a `status` column to filter active centers
$resultMedicalCenters = mysqli_query($conn, $sqlMedicalCenters);


?>
<div class="modal fade" id="modal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content tx-14">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel4">Book Medicals</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="medical-process-data/medical_booking_insert.php" method="POST"
                    enctype="multipart/form-data">
                    <input type="hidden" name="appId" value="" id="appId">
                    <input type="hidden" name="contractId" value="" id="contractId">
                    <div class="row">
                        <div class="col-4">
                            <img src="../uploads/img/fallback-image.png" class="img-fluid" alt="Responsive image">

                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col">
                                    <label for="clientname" class="form-label">Clinet Name</label>
                                    <input type="text" name="clinetName" class="form-control" id="clientmedicalfname"
                                        readonly>

                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                <label for="passport" class="form-label">Passport No</label>
                                    <input type="text" name="passportnumbermedi" class="form-control" id="passportnumbermedi"
                                        readonly>
                                </div>
                                <div class="col">
                                <label for="medidob" class="form-label">Date of Birth</label>
                                    <input type="text" name="medidob" class="form-control" id="medidob"
                                        readonly>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <label for="allocationdate">Allocation Date:</label>
                                    <input type="date" name="allocationdate" class="form-control" id="">
                                </div>
                                <div class="col">
                                    <label for="gccdate">Gcc Date:</label>
                                    <input type="date" name="gccDate" class="form-control" id="">

                                </div>
                            </div>



                            <label for="contractType" class="mt-2">Medical Center</label>
                            <select name="medicalCenter" id="medicalCenter" class="form-control">
                                <option value="none" selected>Select Medical Center</option>
                                <?php
                                        // Populate dropdown with medical center details
                                        if (mysqli_num_rows($resultMedicalCenters) > 0) {
                                            while ($row = mysqli_fetch_assoc($resultMedicalCenters)) {
                                                echo "<option value='" . $row['medicalCenterID'] . "'>" . $row['MediName'] . "</option>";
                                            }
                                        } else {
                                            echo "<option value='none'>No Centers Available</option>";
                                        }
                                        ?>
                            </select>
                            <button type="submit" class="btn btn-primary mt-2" name="submit">Book Medical</button>

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