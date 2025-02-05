
<div class="modal fade" id="medicalpaymentNewOne" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content tx-14">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel4">Book Medicals</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="functions/add-medical-payment.php" method="POST"
                    enctype="multipart/form-data">
                    <input type="hidden" name="appId" value="<?php $applicantID ?>" id="appId">
                    <input type="hidden" name="contractId" value="<?php $contractId ?>" id="contractId">
                    <input type="hidden" name="medicalId" value="<?php $medicalId ?>" id="medicalId">
                    <div class="row">
                        <div class="col-4">
                            <img src="../uploads/img/fallback-image.png" class="img-fluid" alt="Responsive image">

                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col">
                                    <label for="clientname" class="form-label">Clinet Name</label>
                                    <input type="text" name="clinetName" class="form-control" id="clientmedicalfname" value="<?php $applicationTitle ?> <?php $applicationFname ?> <?php $applicationLname ?>"
                                        readonly>

                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                <label for="passport" class="form-label">Passport No</label>
                                    <input type="text" name="passportnumbermedi" class="form-control" id="passportnumbermedi" value="<?php $applicationPassport ?>"
                                        readonly>
                                </div>
                                <div class="col">
                                <label for="medidob" class="form-label">Date of Birth</label>
                                    <input type="text" name="medidob" class="form-control" id="medidob" value="<?php $applicantDob ?>"
                                        readonly>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <label for="allocationdate">Allocation Date:</label>
                                    <input type="date" name="allocationdate" class="form-control" id="" value="<?php $formattedAllocationDate ?>">
                                </div>
                                <div class="col">
                                    <label for="gccdate">Gcc Date:</label>
                                    <input type="date" name="gccDate" class="form-control" id="" value="<?php $formattedGccDate ?>">

                                </div>
                            </div>



                            <label for="contractType" class="mt-2">Medical Center</label>
                            <select name="medicalCenter" id="medicalCenter" class="form-control">

                                </div>
                            </div>
                            <div class="col">
                                <label for="gccdate">Payment Amount</label>
                                <input type="text" name="paymentAmount" class="form-control" id="" value="" fdprocessedid="nuhpid">

                            </div>
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