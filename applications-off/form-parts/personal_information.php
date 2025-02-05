<!-- Step 1: Personal Information -->

<?php
// Pre-fill data (this could be fetched from the database if it exists)
$name = $_POST['name'] ?? '';
$passportNumber = $_POST['passportNumber'] ?? '';
$phoneNumber = $_POST['phone_number'] ?? '';
$contactInfo = $_POST['contact_info'] ?? ''; // for next step
?>
<div class="row">
    <div class="col-3">
        <div class="profile-image-container">
            <img src="../uploads/img/fallback-image.png" alt="Profile Image" class="profile-image" id="profileImage">
            <label for="profileImageInput" class="camera-icon">
                <img src="../uploads/img/camera-icon.png" alt="Camera Icon">
            </label>
            <input type="file" id="profileImageInput" name="profileImage" accept="image/*" class="profile-image-input">
        </div>
        <div class="camera-options">
            <button type="button" id="openCameraButton">Take Photo</button>
            <button type="button" id="saveCameraPhotoButton" style="display:none;">Save Photo</button>
        </div>
        <video id="cameraPreview" style="display: none; width: 150px; height: 150px; border-radius: 50%;"></video>
        <canvas id="cameraCanvas" style="display: none;"></canvas>
    </div>

    <div class="col-9">

        <div class="row mb-3">
            <div class="col p-2">
                <label class="form-label">Title</label>
                <select name="name-title" class="form-control" id="exampleFormControlSelect1">
                    <option selected Value="<?php echo $applicantTitle; ?>"><?php echo $applicantTitle; ?></option>
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
                <input type="text" class="form-control" placeholder="First name" value="<?php echo $applicantFname; ?>"
                    name="Cfname" required>
            </div>
            <div class="col p-2">
                <label class="form-label">Middle Name </label>
                <input type="text" class="form-control" placeholder="middle name" value="<?php echo $applicantMname; ?>"
                    name="cmname">
            </div>
            <div class="col p-2">
                <label class="form-label">Last Name</label>
                <input type="text" class="form-control" placeholder="Last name" value="<?php echo $applicantLname; ?>"
                    name="clname" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col p-2">
                <label class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="dob" placeholder="Birthday"
                    value="<?php echo $applicantDob; ?>" name="dateofbirth">
                <div id="ageDisplay"></div>
            </div>
            <div class="col p-2">
                <label for="heightFeet" class="form-label">Hieght (in feet):</label>
                <input type="number" id="heightFeet" class="form-control" name="height" step="0.1" min="0" onchange="convertHeight()">
                <div id="resultHeight" style="font-size:12px;"></div>
            </div>
            <div class="col p-2">
                <label class="form-label">Weight </label>
                <input type="number" class="form-control" name="weight" step="0.1" min="0" id="">
            </div>
            <div class="col p-2">
                <label class="form-label">NIC No</label>
                <input type="text" class="form-control" name="nicnumber" value="<?php echo $nicNumber; ?>" id="">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col p-2">
                <label class="form-label">Gender</label>
                <div class="wslk-radio">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="male" name="gender" value="male">
                        <label class="form-check-label" for="male">
                            Male
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input " type="radio" id="female" name="gender" value="female">
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
                        <input class="form-check-input" type="radio" id="male" name="Religion" value="Muslim">
                        <label class="form-check-label" for="Muslim">
                            Muslim
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input " type="radio" id="female" name="Religion" value="Non-muslim">
                        <label class="form-check-label" for="Non-Muslim">
                            Non-Muslim
                        </label>
                    </div>
                </div>
            </div>
            <div class="col p-2">
                <label class="form-label">Rase</label>
                <input type="text" class="form-control" name="rase" id="">
            </div>
            <div class="col p-2">
                <label class="form-label">Nationality</label>
                <input type="text" class="form-control" name="nationality" id="">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col p-2">
                <label class="form-label">Passport Details</label>
                <input type="text" class="form-control" name="cpassport" value="<?php echo $passportNumber; ?>">
            </div>
            <div class="col p-2">
                <label class="form-label">Pasport Issue.Date </label>
                <input type="date" class="form-control" placeholder="Passport Exp.Date" id="expiryDate"
                    name="cpassportdate">
                <div id="expiryDisplay"></div>
            </div>
            <div class="col p-2">
                <label class="form-label">Marital Status</label>
                <select name="maritalstatus" class="form-control" id="exampleFormControlSelect1">
                    <option selected Value="none">Merital Status</option>
                    <option Value="single">Single</option>
                    <option Value="married">Married</option>
                    <option Value="widow">Widowed</option>
                </select>
            </div>
            <div class="col p-2">
                <label class="form-label">File Number Details</label>
                <input type="text" class="form-control" placeholder="File No" name="cffileno">
            </div>
        </div>

    </div>
</div>
<div class="row mb-5">
    <div class="col-4 mt-2">
        <label for="findUs">How Did You Hear About Us?</label>
        <select id="findUs" class="form-control" name="findUs">
            <option value="">Select an option</option>
            <option value="none">None</option>
            <option value="newspaper">Newspaper</option>
            <option value="onlineAds">Online Ads</option>
            <option value="subAgent">Sub Agent</option>
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
                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#mainmodlesubagent">Add New</a>
            </div> 
            <!-- Suggestions will be shown here  -->
            <div id="subAgentSuggestions" class="list-group"></div>
        </div>
    </div>
 
    <div class="col">
        <div class="row">
            <label class="form-label mt-3">Attachments</label>
            <hr>
            <div class="col">
                <lable class="form-label">Nic Front Copy</lable>
                <input type="file" class="form-control" name="clientNicFront" id="">
            </div>
            <div class="col">
                <lable class="form-label">Nic Back Copy</lable>
                <input type="file" class="form-control" name="clientNicBack" id="">
            </div>
            <div class="col">
                <lable class="form-label">Passport Copy o1</lable>
                <input type="file" class="form-control" name="clientpassportCopy1" id="">
            </div>
            <div class="col">
                <lable class="form-label">Full Phonto</lable>
                <input type="file" class="form-control" name="clinetfullphoto" id="">
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('findUs').addEventListener('change', function() {
    const subAgentField = document.getElementById('subAgentField');
    if (this.value === 'subAgent') {
        subAgentField.style.display = 'block';
    } else {
        subAgentField.style.display = 'none';
    }
});

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
                    document.getElementById('addNewSubagentBtn').style.display = 'none'; // Hide "Add New" button
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