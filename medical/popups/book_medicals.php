
<div class="modal fade" id="bookmedical" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content tx-14">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel4">Update Medicals Payment</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <?php var_dump($applicantID); ?>
            <div class="modal-body">
                <form action="medical-process-data/medical_payment_insert.php" method="POST"
                    enctype="multipart/form-data">
                    <input type="hidden" name="appId" value="<?php echo $applicantID?>" id="appId">
                    <input type="hidden" name="contractId" value="<?php echo $contractId?>" id="contractId">
                    <input type="hidden" name="medcialId" value="<?php echo $medicalId?>" id="medicalId">
                    <div class="row">
                        <div class="col-4">
                            <img src="../uploads/img/fallback-image.png" class="img-fluid" alt="Responsive image">

                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col">
                                    <label for="clientname" class="form-label">Clinet Name :</label>
                                    <input type="text" name="clinetName" class="form-control" id="clientmedicalfname" value="<?php echo $applicationTitle; ?> <?php echo  $applicationFname; ?> <?php echo  $applicationLname; ?>"
                                        readonly>

                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <label for="passport" class="form-label">Passport No</label>
                                    <input type="text" name="passportnumbermedi" class="form-control"
                                        id="passportnumbermedi" value="<?php echo $applicationPassport; ?>" readonly>
                                </div>
                                <div class="col">
                                    <label for="medidob" class="form-label">Date of Birth</label>
                                    <input type="text" name="medidob" class="form-control" id="medidob" value="<?php echo $applicantDob?>" readonly>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <label for="allocationdate" class="form-label">Allocation Date</label>
                                    <input type="text" name="allocationdate" class="form-control"
                                        id="allocationdate" value="<?php echo $allocationDateNew?>" readonly>
                                </div>
                                <div class="col">
                                    <label for="gccdate" class="form-label">Gcc Date</label>
                                    <input type="text" name="gccdate" class="form-control" id="gccdate" value="<?php echo $gccDateNew?>" readonly>
                                </div>
                            </div>



                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label for="medicalcenter" class="form-label">Medical Center</label>
                                <input type="text" class="form-control" name="medicalcenter" id="medicalcenter" value="<?php echo $medicalCenter?>" readonly>
                            </div>
                            <div class="col">
                                <lable class="form-label">Payment Amount</lable>
                                <input type="text" class="form-control" name="payment" id="payment" required>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">
<!--                                <label for="medicalreport" class="form-label">Upload Medical Report</label>-->
<!--                                <input type="file" name="medicalreport mb-10" class="form-control" id="">-->
                                <button type="submit" class="btn btn-primary mt-3" name="submit">Book Medical</button>
                            </div>

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