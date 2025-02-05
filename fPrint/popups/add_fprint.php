<div class="modal fade" id="modal6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Finger Print Booking</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="registrationForm" class="needs-validation" method="post"
                    action="functions/insert_fprint.php" novalidate>
                    <div class="row mt-3">
                        <div class="col-4 ">
                            <img class="img-fluid" id="applicantImage" alt="Responsive image"
                                src="" alt="Fallback Image" />
                        </div>

                        <div class="col">
                            <div class="row mb-1">
                                <div class="col">
                                    <input type="hidden" id="applicantIDInput" name="applicantID" value="">
                                    <input type="hidden" id="appContract" name="appContract" value="">
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
                            <label for="fprintbooking">Booking Date</label>
                            <input type="date" name="bookingdate" class="form-control" id="">
                        </div>
                        <div class="col">
                            <label for="MedicalEntered">Entered Date</label>
                            <input type="date" name="entereddate" class="form-control" id="">

                        </div>
                        <div class="col">
                            <div class="row">

                                <label class="form-label">System</label>

                                <div class="col">
                                    <input type="radio" name="finegrsystem" id="finegrsystemLounge" value="Lounge">
                                    <label for="finegrsystem">Lounge</label>
                                </div>
                                <div class="col">
                                    <input type="radio" name="finegrsystem" id="finegrsystemNormal" value="Normal">
                                    <label for="finegrsystem">Normal</label>
                                </div>

                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2" name="submit">Book Now</button>
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