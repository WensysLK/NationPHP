<?php


?>
<div class="modal fade" id="updatemedical" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content tx-14">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel4">Update Medicals</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="medical-process-data/medical_update_insert.php" method="POST"
                    enctype="multipart/form-data">
                    <input type="hidden" name="appId" value="" id="appId">
                    <input type="hidden" name="contractId" value="" id="contractId">
                    <input type="hidden" name="medcialId" value="" id="medicalId">
                    <div class="row">
                        <div class="col-4">
                            <img src="../uploads/img/fallback-image.png" class="img-fluid" alt="Responsive image">

                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col">
                                    <label for="clientname" class="form-label">Clinet Name :</label>
                                    <input type="text" name="clinetName" class="form-control" id="clientmedicalfname"
                                        readonly>

                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <label for="passport" class="form-label">Passport No</label>
                                    <input type="text" name="passportnumbermedi" class="form-control"
                                        id="passportnumbermedi" readonly>
                                </div>
                                <div class="col">
                                    <label for="medidob" class="form-label">Date of Birth</label>
                                    <input type="text" name="medidob" class="form-control" id="medidob" readonly>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <label for="allocationdate" class="form-label">Allocation Date</label>
                                    <input type="text" name="allocationdate" class="form-control"
                                        id="allocationdate" readonly>
                                </div>
                                <div class="col">
                                    <label for="gccdate" class="form-label">Gcc Date</label>
                                    <input type="text" name="gccdate" class="form-control" id="gccdate" readonly>
                                </div>
                            </div>



                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <lable class="form-label">Medical Collected Date</lable>
                                <input type="date" class="form-control" name="medicalcollecteddate" id="medicalcollecteddate">
                            </div>
                            <div class="col">
                                <label for="medicalcenter" calss="form-label">Medical Center</label>
                                <input type="text" class="form-control" name="medicalcenter" id="medicalcenter" readonly>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <lable class="form-label">Collected By</lable>
                                <input type="text" class="form-control" name="collectedby" id="">
                            </div>
                            <div class="col">
                                <lable class="form-label">Status</lable>
                                <select class="form-control" name="medicalstatus">
                                    <option value="none">Status</option>
                                    <option value="fit">Fit</option>
                                    <option value="unfit">Un Fit</option>
                                    <option value="Pending">Pending</option>
                                    <option value="recheck">Recheck</option>
                                    <option value="guarantee">Guarantee</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <lable class="form-label">Remark</lable>
                                <textarea class="form-control" name="medicalRemark" id=""></textarea>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label for="medicalreport" class="form-label">Upload Medical Report</label>
                                <input type="file" name="medicalreport mb-10" class="form-control" id="">
                                <button type="submit" class="btn btn-primary mt-3" name="submit">Update Medical</button>
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