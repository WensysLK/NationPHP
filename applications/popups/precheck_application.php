<!-- Customer Precheck -->
<div class="modal fade" id="modal6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel6" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content tx-14">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel6">Application Pre Registration</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <form id="registrationForm" method="post" action="Functions/user_registartion_precheck.php">
                    <div class="row mt-3 ">
                        <div class="col form-group">
                            <label for="passportNumber">Passport Number:</label>
                            <input type="text" class="form-control" id="passportNumber" name="passportNumber">
                            <span id="passportError" class="text-danger"></span>
                        </div>
                        <div class="col form-group">
                            <div class="form-group">
                                <label for="nicNumber">NIC Number:</label>
                                <input type="text" class="form-control" id="nicNumber" name="nicNumber">
                                <span id="nicError" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label>Title</label>
                            <select name="name-title" class="form-control" id="exampleFormControlSelect1">
                                <option selected Value="none">Title</option>
                                <option Value="Dr">Dr</option>
                                <option Value="Mr">Mr</option>
                                <option Value="Mrs">Mrs</option>
                                <option Value="Ms">Ms</option>
                                <option Vlaue="Rev.Fr">Rev.Fr</option>
                                <option Vlaue="Rev.Sis">Rev.Sis</option>
                                <option Vlaue="Jr">Junior</option>
                            </select>
                        </div>
                        <div class="col">
                            <label>First Name </label>
                            <input type="text" class="form-control" placeholder="First name" name="Cfname" required>
                        </div>

                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label>Middle Name </label>
                            <input type="text" class="form-control" id="firstname" placeholder="middle name"
                                name="cmname">
                        </div>
                        <div class="col">
                            <label>Last Name</label>
                            <input type="text" class="form-control" placeholder="Last name" name="clname" required>
                            <input type="hidden" name="regstatus" value="Pending">
                        </div>

                    </div>

                    <div class="col mt-3 mb-3">
                        <label>Date of Birth</label>
                        <input type="date" class="form-control" id="dob" placeholder="Birthday" name="dateofbirth">
                        <div id="ageDisplay"></div>
                    </div>

                    <div id="warning"
                        style="display: none; background-color: red; color: white; padding: 10px; border-radius: 5px; margin-top: 10px; margin-bottom:10px;">
                        Client already exists. Please click the name to view the profile.
                    </div>
                    <div id="clientName"></div>

                    <hr>
                    <button type="submit" class="btn btn-primary" name="saveContineue">Save & Contineue</button>
                    <button type="submit" class="btn btn-primary" name="saveExit">Save & Exit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary tx-13" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
(function() {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
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