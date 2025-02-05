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
                    <option Value="Rev.Fr">Rev.Fr</option>
                    <option Value="Rev.Sis">Rev.Sis</option>
                    <option Value="Jr">Junior</option>
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
                <select name="rase" class="form-control" id="rase">
                    <option selected Value="none">Rase Status</option>
                    <option Value="sinhalese">Sinhalese</option>
                    <option Value="sriLankanTamils">SriLankan Tamils</option>
                    <option Value="indianTamils">Indian Tamils</option>
                    <option Value="sriLankanMoors">SriLankan Moors</option>
                    <option Value="burghers">Burghers</option>
                    <option Value="malays">Malays</option>
                    <option Value="vedda">Vedda</option>
                </select>
             
            </div>
            <div class="col p-2">
                <label class="form-label">Nationality</label>
                <select name="nationality" class="form-control" id="nationality">
                    <option selected Value="none">Nationality Status</option>
                    <option Value="SriLankan">Sri Lankan</option>
                    <option Value="Indian">Indian</option>
                    <option Value="australian">Australian</option>
                    <option Value="canadian">Canadian</option>
                    <option Value="chinese">Chinese</option>
                    <option Value="french">French</option>
                    <option Value="german">German</option>
                    <option Value="singaporean">Singaporean</option>
                </select>

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
        </div>


    </div>
</div>
<div class="row mb-5">
    <div class="col p-2">
        <label class="form-label">Passport Details</label>
        <input type="text" class="form-control" name="cpassport" value="<?php echo $passportNumber; ?>">
    </div>
    <div class="col p-2">
        <label class="form-label">Pasport Issue.Date </label>
        <input type="date" class="form-control" placeholder="Passport Issue.Date" id="issueDate"
               name="cpassportdate">
<!--        <div id="expiryDisplay"></div>-->
    </div>
    <div class="col p-2">
        <label class="form-label">Pasport Exp.Date </label>
        <input type="date" class="form-control" placeholder="Passport Exp.Date" id="expiryDate"
               name="cpassportExpdate" onchange="convertExpDate()">
        <div id="expiryDisplay"></div>
    </div>

    <div class="col p-2">
        <label class="form-label">File Number Details</label>
        <input type="text" class="form-control" placeholder="File No" name="cffileno">
    </div>
</div>
<div class="row mb-5">

    <div class="col p-2">
        <label class="form-label" for="findUs">How Did You Hear About Us?</label>
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
                <a href="#mainmodlesubagent" data-bs-toggle="modal" data-bs-target="#mainmodlesubagent">Add New</a>
            </div> 
            <!-- Suggestions will be shown here  -->
            <div id="subAgentSuggestions" class="list-group"></div>
        </div>
    </div>
    <div class="col p-2">
            <label class="form-label">Address Line 01</label>
            <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name="caddress1">
        </div>
    <div class="col p-2">
            <label class="form-label">Address Line 02</label>
            <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor" name="caddress2">
        </div>
    <div class="col p-2">
            <label class="form-label">Province</label>
            <select class="form-control" id="province" name="cprovince">
                <option value="none" selected >Select Province</option>
            </select>
        </div>
    <div class="col p-2">
            <label class="form-label">City</label>
            <select class="form-control" id="city" name="ccity">
                <option value="none" selected >Select City</option>
            </select>
        </div>
    <div class="col p-2">
            <label class="form-label">Gramasevaka Division</label>
            <select class="form-control" id="gsdevision" name="gsdevision">
                <option value="none" selected >Select GS Division</option>
            </select>
        </div>

</div>
<div class="row mb-5">
    <div class="col p-2">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="cemail">
    </div>
    <div class="col p-2">
        <label class="form-label">Land Phone</label>
        <input type="text" class="form-control" placeholder="+94770000000" name="clphone">
    </div>
    <div class="col p-2">
        <label class="form-label">Mobile No (1)</label>
        <input type="text" class="form-control" id="mobileNumber1" placeholder="+94770000000" name="cphone2">
        <div id="messagingIcons1">
            <!-- Icons for mobile number 1 will be dynamically inserted here -->
        </div>
    </div>
    <div class="col p-2">
        <label class="form-label">Mobile No (2)</label>
        <input type="text" class="form-control" id="mobileNumber2" placeholder="+94770000000" name="cphone">
        <div id="messagingIcons2">
            <!-- Icons for mobile number 2 will be dynamically inserted here -->
        </div>
    </div>
</div>
<div class="row mb-5">
    <div class="row">
        <label class="form-label mt-3"><b>Social Media Links</b></label>
        <hr>
        <div class="input-group mb-3 col">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"> <i class="fab fa-facebook-f fa-2x" style="color: #3b5998;"></i></span>
            </div>
            <input type="text" class="form-control" placeholder="Facebook Link" aria-label="Username" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3 col">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"> <i class="fab fa-twitter fa-2x" style="color: #55acee;"></i></span>
            </div>
            <input type="text" class="form-control" placeholder="Twitter Link" aria-label="Username" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3 col">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fab fa-instagram fa-2x" style="color: #ac2bac;"></i></span>
            </div>
            <input type="text" class="form-control" placeholder="Instagram Link" aria-label="Username" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3 col">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"> <i class="fab fa-whatsapp fa-2x" style="color: #25d366;"></i></span>
            </div>
            <input type="text" class="form-control" placeholder="Whatsapp Link" aria-label="Username" aria-describedby="basic-addon1">
        </div>
    </div>
</div>
<div class="row mb-5">
    <div class="row">
        <label class="form-label mt-3"><b>Attachments</b></label>
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
<?php include('popup/add-sub-agent.php'); ?>

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
                        let img = document.createElement('img');
                        img.src =
                            'http://localhost/projects/PHPNation/';
                        img.style='width: 40px; height: 40px;'
                        // suggestionsContainer.appendChild(img);
                        // res.innerHTML = "Image Element Added.";
                        const suggestionItem1 = document.createElement('div');

                        const suggestionItem = document.createElement('div');
                        suggestionItem.className = 'list-group-item list-group-item-action';
                        suggestionItem.icon = ' <img src="https://media.geeksforgeeks.org/wp-content/uploads/20190529122828/bs21.png" class="rounded-circle shadow" width="130"height="130" alt="" />',
                            suggestionItem.textContent = `${agent.name} (${agent.nic})`;
                        suggestionItem.href = 'javascript:void(0);';
                        suggestionItem.onclick = function() {
                            // Fill the hidden subAgentId field with the selected agent's ID
                            document.getElementById('subAgentId').value = agent.id;
                            document.getElementById('subAgentSearch').value = agent.name;

                            // document.getElementById("myImg").src = '../../uploads/profile_images';

                            suggestionsContainer.innerHTML = ''; // Clear the suggestions
                        };
                        suggestionItem.appendChild(img);

                        // suggestionItem.appendChild(suggestionItem);

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
})

    function convertExpDate (){
        let expiryDate = document.getElementById("expiryDate").value;
        let issueDate = document.getElementById("issueDate").value;


        const date1 = new Date(expiryDate);
        const date2 = new Date(issueDate);

        const diffTime = Math.abs(date1 - date2);
        const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));
        console.log(diffTime + " milliseconds");
        console.log(diffDays + " days");
        var expiryDisplay = document.getElementById('expiryDisplay');
        if (!isNaN(diffDays)) {
            expiryDisplay.innerHTML =
                `Take the remaining days for the passport to expire: ${diffDays} days`;
            expiryDisplay.style.display = 'block';
        } else {
            expiryDisplay.style.display = 'none';
        }

    }
</script>
<script>
    // Ensure the script runs after the DOM is fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Fetch provinces from the server
        fetch('./api-requests/fetch_provinces.php')
            .then(response => response.json())
            .then(data => {
                const provinceSelect = document.getElementById('province');
                data.provinces.forEach(province => {
                    const option = document.createElement('option');
                    option.value = province.id;  // Province ID from the database
                    option.text = province.name;
                    provinceSelect.add(option);
                });
            })
            .catch(error => console.error('Error fetching provinces:', error));
    });

    // Fetch cities when a province is selected
    document.getElementById('province').addEventListener('change', function() {
        const provinceId = this.value;
        const citySelect = document.getElementById('city');
        citySelect.innerHTML = '<option value="">Select City</option>';  // Clear previous options

        if (provinceId) {
            fetch(`./api-requests/fetch_cities.php?province_id=${provinceId}`)
                .then(response => response.json())
                .then(data => {
                    data.cities.forEach(city => {
                        const option = document.createElement('option');
                        option.value = city.id;  // City ID from the database
                        option.text = city.name;
                        citySelect.add(option);
                    });
                })
                .catch(error => console.error('Error fetching cities:', error));
        }
    });

    // Fetch GS divisions when a city is selected
    document.getElementById('city').addEventListener('change', function() {
        const cityId = this.value;
        const gsDivisionSelect = document.getElementById('gsdevision');
        gsDivisionSelect.innerHTML = '<option value="">Select GS Division</option>';  // Clear previous options

        if (cityId) {
            fetch(`./api-requests/fetch_gs_divisions.php?city_id=${cityId}`)
                .then(response => response.json())
                .then(data => {
                    data.gs_divisions.forEach(gsDivision => {
                        const option = document.createElement('option');
                        option.value = gsDivision.id;  // GS Division ID from the database
                        option.text = gsDivision.name;
                        gsDivisionSelect.add(option);
                    });
                })
                .catch(error => console.error('Error fetching GS divisions:', error));
        }
    });
</script>



