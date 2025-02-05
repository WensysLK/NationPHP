<div class="modal fade" id="submitburea" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Finger Print Booking</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="registrationForm" class="needs-validation" method="post" action="functions/insert_bureau.php"
                    novalidate>
                    <div class="row mt-3">
                        <div class="col-4 ">
                            <img class="img-fluid" id="applicantImage" alt="Responsive image" src=""
                                alt="Fallback Image" />
                        </div>

                        <div class="col">
                            <div class="row mb-1">
                                <div class="col">
                                    <input type="hidden" id="applicantIDInput" name="applicantID" value="">
                                    <input type="hidden" id="appContract" name="appContract" value="">
                                    <input type="hidden" id="enjazId" name="enjazId" value="">
                                    
                                    <label for="cleintName"><b>Client Name:</b><br></label>
                                    <input type="text" class="form-control" name="clientName" id="ClientName" readonly>
                                </div>
                                <div class="col">
                                    <label for="passportNumber"><b>Passport Number:</b></label>
                                    <input type="text" name="passportnumber" class="form-control" id="passportnumber" readonly>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col">
                                    <label for="nicNumber"><b>NIC Number:</b></label><br>
                                    <input type="text" name="clientnic" class="form-control" id="clientNIC" readonly>
                                </div>
                                <div class="col">
                                    <label for="dob"><b>Date Of Birth:</b></label><br>
                                    <input type="text" name="clientdob" class="form-control" id="clientdob" readonly>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="sponcername" class="form-label">Sponcer Name</label>
                            <input type="text" name="sponcername" class="form-control" id="sponcername" readonly>
                        </div>
                        <div class="col">
                            <label for="visano" class="form-label">Visa No</label>
                            <input type="text" name="visano" class="form-control" id="visano" readonly>

                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col" >
                            <label for="visaCategory" class="form-label">Visa Category</label>
                            <input type="text" name="visaCategory" class="form-control" id="visaCategory" readonly>
                        </div>
                        <div class="col">
                            <label for="positions" class="form-label">Positions</label>
                            <input type="text" name="positions" class="form-control" id="positions" readonly>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <label for="fprintRemark">Remarks</label>
                            <textarea name="bureaRemark" id="" class="form-control"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2" name="submit">Update Now</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary tx-13" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>

</div>


<script>
(function() {
    'use strict'

    var forms = document.querySelectorAll('.needs-validation')

    Array.prototype.slice.call(forms)
        .forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
})()
</script>