<div class="modal fade" id="updatefstatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Finger Print Booking</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="registrationForm" class="needs-validation" method="post" action="functions/update_fprint.php"
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
                                    <input type="hidden" id="fprintid" name="fprintId" value="">
                                    
                                    <label for="cleintName"><b>Client Name:</b><br></label>
                                    <input type="text" class="form-control" name="clientName" id="ClientName">
                                </div>
                                <div class="col">
                                    <label for="passportNumber"><b>Passport Number:</b></label>
                                    <input type="text" name="passportnumber" class="form-control" id="passportnumber">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col">
                                    <label for="nicNumber"><b>NIC Number:</b></label><br>
                                    <input type="text" name="clientnic" class="form-control" id="clientNIC">
                                </div>
                                <div class="col">
                                    <label for="dob"><b>Date Of Birth:</b></label><br>
                                    <input type="text" name="clientdob" class="form-control" id="clientdob">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label for="fprintbooking" class="form-label">Booking Date</label>
                            <input type="date" name="bookingdate" class="form-control" id="fprintbooking" readonly>
                        </div>
                        <div class="col">
                            <label for="fprintEnteredDate" class="form-label">Entered Date</label>
                            <input type="date" name="entereddate" class="form-control" id="fprintentered" readonly>

                        </div>
                        <div class="col">
                            <label class="form-label">System</label>
                            <input type="text" name="systemype" class="form-control" id="systemtype" readonly>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col" >
                            <label for="collectiondate" class="form-label">Collection Date</label>
                            <input type="date" name="collectiondate" class="form-control" id="">
                        </div>
                        <div class="col">
                            <label for="collectedby" class="form-label">Collected By</label>
                            <input type="date" name="collectedBy" class="form-control" id="">
                        </div>
                        <div class="col">
                        <label for="uploadenjaz" class="form-label">upload Documents</label>
                        <input type="file" name="enjazdocument" class="form-control" id="">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <label for="fprintRemark">Remarks</label>
                            <textarea name="fprintremarks" id="" class="form-control"></textarea>
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