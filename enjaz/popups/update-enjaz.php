
<div class="modal fade" id="enjazupdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enjaz Update</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form method="post" action="functions/update-enjaz-status.php" enctype="multipart/form-data">
                    <div class="row">
                        <input type="hidden" name="EnjazID" id="enjazidnumber" >
                        <input type="hidden" name="enjazapplicantID" id="enjazapplicantID">
                        <input type="hidden" name="appContract" id="appContract">
                        <input type="hidden" name="exptyp" value="completed">
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="hospitalreport" class="form-label">Upload Enjaz Report</label>
                            <input type="file" class="form-control mb-10" name="enjazreport" id="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <lable class="form-label">Remark</lable>
                            <textarea class="form-control" name="expremark" id=""></textarea>
                        </div>
                    </div>

                    <br>

                    <button type="submit" class="btn btn-primary" name="updateenjaz">Update Enjaz</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
