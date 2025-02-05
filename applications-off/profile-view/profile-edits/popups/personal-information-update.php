<!-- Customer Precheck -->
<div class="modal fade" id="personalinfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content tx-14">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel3">Modal Title</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <form id="registrationForm" method="post" action="Functions/user_registartion_precheck.php">
                    <div class="row">
                        <div class="col">
                                <input type="hidden" value="<?php echo $applicant['applicationID']; ?>" name="clientID">
                            <div class="row mb-3">
                                <div class="col p-2">
                                    <label class="form-label">Title</label>
                                    <select name="name-title" class="form-control" id="exampleFormControlSelect1">
                                        <option selected Value="<?php echo $applicant['applicantTitle']; ?>">
                                            <?php echo $applicant['applicantTitle']; ?></option>
                                        <option Value="Dr">Dr</option>
                                        <option Value="Mr">Mr</option>
                                        <option Value="Mrs">Mrs</option>
                                        <option Value="Ms">Ms</option>
                                        <option Vlaue="Rev.Fr">Rev.Fr</option>
                                        <option Vlaue="Rev.Sis">Rev.Sis</option>
                                        <option Vlaue="Jr">Junior</option>
                                    </select>
                                </div>
                                <div class="col p-2">
                                    <label class="form-label">First Name </label>
                                    <input type="text" class="form-control" placeholder="First name"
                                        value="<?php echo $applicant['applicatFname']; ?>" name="Cfname" required>
                                </div>
                                <div class="col p-2">
                                    <label class="form-label">Middle Name </label>
                                    <input type="text" class="form-control" placeholder="middle name"
                                        value="<?php echo $applicant['applicantMname']; ?>" name="cmname">
                                </div>
                                <div class="col p-2">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control" placeholder="Last name"
                                        value="<?php echo $applicant['applicantLname']; ?>" name="clname" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col p-2">
                                    <label class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control" id="dob" placeholder="Birthday"
                                        value="<?php echo $applicant['applicantDob']; ?>" name="dateofbirth">
                                    <div id="ageDisplay"></div>
                                </div>
                                <div class="col p-2">
                                    <label for="heightFeet" class="form-label">Hieght (in feet):</label>
                                    <input type="number" id="heightFeet" class="form-control" name="height"
                                        value="<?php echo $applicant['applicanthight']; ?>" step="0.1" min="0"
                                        onchange="convertHeight()">
                                    <div id="resultHeight" style="font-size:12px;"></div>
                                </div>
                                <div class="col p-2">
                                    <label class="form-label">Weight </label>
                                    <input type="number" class="form-control" name="weight"
                                        value="<?php echo $applicant['applicantWeight']; ?>" step="0.1" min="0" id="">
                                </div>
                                <div class="col p-2">
                                    <label class="form-label">NIC No</label>
                                    <input type="text" class="form-control" name="nicnumber"
                                        value="<?php echo $applicant['applicantNICno']; ?>" id="">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col p-2">
                                    <label class="form-label">Gender</label>
                                    <div class="wslk-radio">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="male" name="gender"
                                                value="male"
                                                <?php if ($applicant['applicantGender'] == "male") echo "checked"; ?>>
                                            <label class="form-check-label" for="male">
                                                Male
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="female" name="gender"
                                                value="female"
                                                <?php if ($applicant['applicantGender'] == "female") echo "checked"; ?>>
                                            <label class="form-check-label" for="female">
                                                Female
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col p-2">
                                    <label class="form-label">Religion</label>
                                    <div class="wslk-radio">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="male" name="Religion"
                                                value="Muslim"
                                                <?php if ($applicant['appReligion'] == "Muslim") echo "checked"; ?>>
                                            <label class="form-check-label" for="male">
                                                Muslim
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="female" name="Religion"
                                                value="Non-muslim"
                                                <?php if ($applicant['appReligion'] == "Non-muslim") echo "checked"; ?>>
                                            <label class="form-check-label" for="female">
                                                Non-Muslim
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col p-2">
                                    <label class="form-label">Rase</label>
                                    <input type="text" class="form-control" value="<?php echo $applicant['appRase']; ?>"
                                        name="rase" id="">
                                </div>
                                <div class="col p-2">
                                    <label class="form-label">Nationality</label>
                                    <input type="text" class="form-control" name="nationality"
                                        value="<?php echo $applicant['applicantNationality']; ?>" id="">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col p-2">
                                    <label class="form-label">Passport Details</label>
                                    <input type="text" class="form-control" name="cpassport"
                                        value="<?php echo $applicant['applicantPassno']; ?>">
                                </div>
                                <div class="col p-2">
                                    <label class="form-label">Pasport Issue.Date </label>
                                    <input type="date" class="form-control" placeholder="Passport Exp.Date"
                                        id="expiryDate" name="cpassportdate"
                                        value="<?php echo $applicant['applicantPassdate']; ?>">
                                    <div id="expiryDisplay"></div>
                                </div>
                                <div class="col p-2">
                                    <label class="form-label">Marital Status</label>
                                    <select name="maritalstatus" class="form-control" id="exampleFormControlSelect1">
                                        <option value=""
                                            <?php if ($applicant['maritalestatus'] == "") echo "selected"; ?>>Select
                                            Marital Status</option>
                                        <option value="single"
                                            <?php if ($applicant['maritalestatus'] == "single") echo "selected"; ?>>
                                            Single</option>
                                        <option value="married"
                                            <?php if ($applicant['maritalestatus'] == "married") echo "selected"; ?>>
                                            Married</option>
                                        <option value="widow"
                                            <?php if ($applicant['maritalestatus'] == "widow") echo "selected"; ?>>
                                            Widowed</option>
                                    </select>
                                </div>
                                <div class="col p-2">
                                    <label class="form-label">File Number Details</label>
                                    <input type="text" class="form-control" placeholder="File No" value="#"
                                        name="cffileno">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-4 mt-2">
                            <label for="findUs">How Did You Hear About Us?</label>
                            <select id="findUs" class="form-control" name="findUs">
                                <option value="" <?php if ($applicant['how_foun_us'] == "") echo "selected"; ?>>Select
                                    an option</option>
                                <option value="none" <?php if ($applicant['how_foun_us'] == "none") echo "selected"; ?>>
                                    None</option>
                                <option value="newspaper"
                                    <?php if ($applicant['how_foun_us'] == "newspaper") echo "selected"; ?>>Newspaper
                                </option>
                                <option value="onlineAds"
                                    <?php if ($applicant['how_foun_us'] == "onlineAds") echo "selected"; ?>>Online Ads
                                </option>
                                <option value="subAgent"
                                    <?php if ($applicant['how_foun_us'] == "subAgent") echo "selected"; ?>>Sub Agent
                                </option>
                            </select>

                            <!-- Sub Agent Fields, hidden initially -->
                            <div id="subAgentField" class="sub-agent-field" style="display: none;">
                                <div class="form-group mt-2">
                                    <label for="subAgentSearch">Search Subagent:</label>
                                    <input type="text" id="subAgentSearch" class="form-control"
                                        placeholder="Enter name, NIC, or phone number">
                                    <input type="hidden" id="subAgentId" name="subAgentId">
                                </div>
                                <!-- Button to add a new sub-agent-->
                                <div id="addNewSubagentBtn" class="add-new-subagent" style="display: none;">
                                    <a href="javascript:;" data-bs-toggle="modal"
                                        data-bs-target="#mainmodlesubagent">Add
                                        New</a>
                                </div>
                                <!-- Suggestions will be shown here  -->
                                <div id="subAgentSuggestions" class="list-group"></div>
                            </div>
                        </div>
                    </div>
                    <div id="clientName"></div>

                    <hr>
                    <button type="submit" class="btn btn-primary" name="saveContineue">Update</button>
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


// Handle the search functionality
document.getElementById('subAgentSearch').addEventListener('input', function() {
    const query = this.value.trim();

    if (query.length > 2) {
        // Perform an AJAX request to search subagents
        fetch(`form-functions/search-fucntions/search-agent.php?query=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                const suggestionsContainer = document.getElementById('subAgentSuggestions');
                suggestionsContainer.innerHTML = ''; // Clear previous suggestions

                if (data.length > 0) {
                    data.forEach(agent => {
                        const suggestionItem = document.createElement('a');
                        suggestionItem.className = 'list-group-item list-group-item-action';
                        suggestionItem.textContent = `${agent.name} (${agent.nic})`;
                        suggestionItem.href = 'javascript:void(0);';
                        suggestionItem.onclick = function() {
                            // Fill the hidden subAgentId field with the selected agent's ID
                            document.getElementById('subAgentId').value = agent.id;
                            document.getElementById('subAgentSearch').value = agent.name;
                            suggestionsContainer.innerHTML = ''; // Clear the suggestions
                        };
                        suggestionsContainer.appendChild(suggestionItem);
                    });
                    document.getElementById('addNewSubagentBtn').style.display =
                        'none'; // Hide "Add New" button
                } else {
                    // Show the "Add New Subagent" button if no agents were found
                    document.getElementById('addNewSubagentBtn').style.display = 'block';
                }
            })
            .catch(error => {
                console.error('Error fetching subagents:', error);
                alert('An error occurred while searching. Please try again.');
            });
    } else {
        // Hide the suggestions if the query is too short
        document.getElementById('subAgentSuggestions').innerHTML = '';
        document.getElementById('addNewSubagentBtn').style.display = 'none';
    }
});
</script>